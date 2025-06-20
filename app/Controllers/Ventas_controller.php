<?php

namespace App\Controllers;

use App\Models\Ventas_model;
use App\Models\Detalle_venta_model;
use App\Models\Productos_model;
use App\Models\Usuarios_model;

class Ventas_controller extends BaseController
{
    public function lista_ventas()
    {
        $cart = \Config\Services::cart();
        $ventaModel = new Ventas_model();
        $detalleModel = new Detalle_venta_model();
        $productoModel = new Productos_model();
        $usuarioModel = new Usuarios_model();

        // Traer todas las ventas
        $ventas = $ventaModel->findAll();
        

        foreach ($ventas as &$venta) {
            // Obtener usuario
            $usuario = $usuarioModel->find($venta['id_usuario']);
            if ($usuario) {
                $venta['nombre_usuario'] = $usuario['nombre'] . ' ' . $usuario['apellido'];
            } else {
                $venta['nombre_usuario'] = 'Usuario eliminado';
            }

            // Obtener detalles de productos de esta venta
            $detalles = $detalleModel->where('id_venta', $venta['id_venta'])->findAll();

            // Agregar productos con nombre, cantidad y precio
            
            $totalVenta = 0;
            foreach ($detalles as &$detalle) {
                $producto = $productoModel->find($detalle['id_producto']);
                $detalle['nombre_producto'] = $producto['nombre_producto'] ?? 'Producto eliminado';
                $totalVenta += $detalle['detalle_precio'] * $detalle['detalle_cantidad'];
            }
            $venta['total'] = $totalVenta;
            $venta['detalles'] = $detalles;
        }

        $data['ventas'] = $ventas; 

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Ventas/lista_ventas', $data)
            . view('Plantillas/footer_view');
    }

    public function lista_compras()
{
    $ventaModel = new \App\Models\Ventas_model();
    $detalleModel = new \App\Models\Detalle_venta_model();
    $productoModel = new \App\Models\Productos_model();

    $usuario_id = session('id'); // Asegurate de tener el ID en la sesión

    $ventas = $ventaModel->where('id_usuario', $usuario_id)->findAll();

    foreach ($ventas as &$venta) {
        $detalles = $detalleModel->where('id_venta', $venta['id_venta'])->findAll();

        $totalVenta = 0;
        foreach ($detalles as &$detalle) {
            $producto = $productoModel->find($detalle['id_producto']);
            $detalle['nombre_producto'] = $producto['nombre_producto'];
            $totalVenta += $detalle['detalle_precio'] * $detalle['detalle_cantidad'];
        }

        $venta['total'] = $totalVenta;
        $venta['detalles'] = $detalles;
    }

    $data['ventas'] = $ventas;

    return view('Plantillas/header_view')
        . view('Plantillas/nav_view')
        . view('Contenidos/perfil', $data)
        . view('Plantillas/footer_view');
}
    
}
