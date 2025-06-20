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
            return redirect()->to('/login')->with('error', 'Debes iniciar sesion para agregar productos al carrito.');
        }

        $cart = \Config\Services::cart();
        $request = \Config\Services::request();

        $data = array(
            'id'      => $request->getPost('id_productos'),
            'qty'     => 1,
            'price'   => $request->getPost('precio_producto'),
            'name'    => $request->getPost('nombre_producto'),
            'options' => [
                'descripcion' => $request->getPost('descripcion_producto'),
                'imagen'      => $request->getPost('imagen_producto'),
            ]
        );

        $cart->insert($data);

        return redirect()->to('carrito');
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

        // Si no se encuentra el artículo, redirigir con un error
        if (!$item) {
            session()->setFlashdata('error', 'Articulo no encontrado en el carrito');
            return redirect()->to('carrito');
        }

        // Obtener la cantidad actual del artículo
        $cantidad = $item['qty'];

        // Modificar la cantidad según el parámetro
        if ($modif == 'mas') {
            $id = $item['id'];


            $producto = $producto_model->where('id_producto', $id)->first();

            if ($cantidad >= $producto['stock_producto']) {
                return redirect('carrito');
            } else {
                $cantidad++;
            }
        } elseif ($modif == 'menos') {
            $cantidad--;
        }

        // Actualizar o eliminar el artículo del carrito
        if ($cantidad > 0) {
            $data = array(
                'rowid' => $rowid,
                'qty' => $cantidad
            );

            $cart->update($data);
        } else {
            // Si la cantidad es 0 o menor, elimina el artículo del carrito
            $cart->remove($rowid);
        }

        // Redirigir al carrito
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
