<?php

namespace App\Models;

use CodeIgniter\Model;


class Ventas_model extends Model
{

    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';

    protected $autoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['id_usuario', 'fecha_venta'];

    public function obtenerVentasConDetalles($id_usuario)
    {
        $ventas = $this->where('id_usuario', $id_usuario)
            ->orderBy('fecha_venta', 'DESC')
            ->findAll();

        $db = \Config\Database::connect();

        foreach ($ventas as &$venta) {
            $detalles = $db->table('detalle_venta')
                ->select('detalle_venta.*, productos.nombre_producto')
                ->join('productos', 'productos.id_producto = detalle_venta.id_producto')
                ->where('id_venta', $venta['id_venta'])
                ->get()
                ->getResultArray();

            $venta['detalles'] = $detalles;

            $total = 0;
            foreach ($detalles as $detalle) {
                $total += $detalle['detalle_precio'] * $detalle['detalle_cantidad'];
            }
            $venta['total'] = $total;
        }

        return $ventas;
    }
}
