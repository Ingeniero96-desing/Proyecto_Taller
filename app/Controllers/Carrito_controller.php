<?php

namespace App\Controllers;

use App\Models\Productos_model;
use App\Models\Categorias_model;
use App\Models\Ventas_Model;
use App\Models\Detalle_Venta_Model;

class Carrito_controller extends BaseController
{

    public function ver_carrito()
    {
        $cart = \Config\Services::cart();

        $data['titulo'] = 'Carrito de compras';

        return view('Plantillas/header_view', $data)
            . view('plantillas/nav_view')
            . view('Contenidos/carrito', $data)
            . view('Plantillas/footer_view');
    }

    public function agregar_producto()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para agregar productos al carrito.');
        }

        $cart = \Config\Services::cart();
        $request = \Config\Services::request();
        $producto_model = new \App\Models\Productos_model();

        $id_producto = $request->getPost('id_productos');

        // Obtener producto desde la base de datos
        $producto = $producto_model->find($id_producto);

        if (!$producto) {
            return redirect()->to('catalogo')->with('error', 'Producto no encontrado.');
        }

        $stock_disponible = $producto['stock_producto'];
        $cantidad_en_carrito = 0;

        // Verificar cuántas unidades ya hay en el carrito
        foreach ($cart->contents() as $item) {
            if ($item['id'] == $id_producto) {
                $cantidad_en_carrito += $item['qty'];
            }
        }

        if ($cantidad_en_carrito >= $stock_disponible) {
            return redirect()->to('carrito')->with('error', 'No hay suficiente stock disponible para "' . $producto['nombre_producto'] . '".');
        }

        // Insertar el producto al carrito
        $data = [
            'id'      => $producto['id_producto'],
            'qty'     => 1,
            'price'   => $producto['precio_producto'],
            'name'    => $producto['nombre_producto'],
            'options' => [
                'descripcion' => $producto['descripcion_producto'],
                'imagen'      => $producto['imagen_producto'],
            ]
        ];

        $cart->insert($data);

        return redirect()->to('carrito')->with('success', 'Producto agregado al carrito.');
    }

    public function vaciar_carrito($all = null)
    {
        $cart = \Config\Services::cart();

        $cart->destroy();

        return redirect()->to('carrito');
    }

    public function eliminar_producto($rowid)
    {
        $cart = \Config\Services::cart();

        // Verificar si el rowid no es nulo o vacío
        if ($rowid) {
            // Eliminar el elemento del carrito
            $cart->remove($rowid);
        }

        // Redireccionar al carrito d compras
        return redirect()->to('carrito');
    }

    public function modificar_cantidad($modif, $rowid)
    {
        $cart = \Config\Services::cart();
        $producto_model = new Productos_model();

        // Obtener los artículos del carrito
        $cartItems = $cart->contents();
        $item = null;

        // Buscar el artículo con el rowid dado
        foreach ($cartItems as $cartItem) {
            if ($cartItem['rowid'] === $rowid) {
                $item = $cartItem;
                break;
            }
        }

        if (!$item) {
            session()->setFlashdata('error', 'Artículo no encontrado en el carrito.');
            return redirect()->to('carrito');
        }

        $cantidad = $item['qty'];

        if ($modif == 'mas') {
            $id = $item['id'];
            $producto = $producto_model->where('id_producto', $id)->first();

            if ($cantidad >= $producto['stock_producto']) {
                session()->setFlashdata('error', 'No hay más stock disponible para "' . $item['name'] . '".');
            } else {
                $cantidad++;
                $cart->update([
                    'rowid' => $rowid,
                    'qty' => $cantidad
                ]);
            }
        } elseif ($modif == 'menos') {
            // Solo actualiza si hay más de 1
            if ($cantidad > 1) {
                $cantidad--;
                $cart->update([
                    'rowid' => $rowid,
                    'qty' => $cantidad
                ]);
            }
        }

        return redirect()->to('carrito');
    }

    public function guardar_venta()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesion para completar la compra');
        }

        $cart = \Config\Services::cart();
        $venta = new Ventas_Model();
        $detalle = new Detalle_Venta_Model();
        $productos = new Productos_model();

        $cart1 = $cart->contents();

        // Verificar stock
        foreach ($cart1 as $item) {
            $producto = $productos->where('id_producto', $item['id'])->first();
            if ($producto['stock_producto'] < $item['qty']) {
                session()->setFlashdata('error', 'Producto sin stock suficiente: ' . $item['name']);
                return redirect()->route('ver_carrito')->with('mensaje', 'No hay suficientee stock de este producto');
            }
        }

        // Insertar venta
        $data = [
            'id_usuario' => session('id'),
            'fecha_venta' => date('Y-m-d'),
        ];
        $venta_id = $venta->insert($data);

        // Detalle de la venta + actualización de stock
        foreach ($cart1 as $item) {
            $detalle_venta = [
                'id_venta'        => $venta_id,
                'id_producto'     => $item['id'],
                'detalle_cantidad'        => $item['qty'],
                'detalle_precio' => $item['price']
            ];

            $producto = $productos->where('id_producto', $item['id'])->first();
            $nuevo_stock = $producto['stock_producto'] - $item['qty'];

            $productos->update($item['id'], ['stock_producto' => $nuevo_stock]);
            $detalle->insert($detalle_venta);
        }

        $cart->destroy();
        session()->setFlashdata('success', 'Compra realizada con éxito');

        return redirect()->route('carrito');
    }
}
