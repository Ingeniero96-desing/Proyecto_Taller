<?php

namespace App\Models;
use CodeIgniter\Model;

class Detalle_venta_model extends Model
{
    protected $table = 'detalle_venta';
    protected $primaryKey = 'id_detalle';

    protected $returnType = 'array';
    protected $allowedFields = ['id_venta', 'id_producto', 'detalle_cantidad', 'detalle_precio'];
}
