<?php

namespace App\Models;

use CodeIgniter\Model;

class Productos_model extends Model
{

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre_producto', 'descripcion_producto', 'precio_producto', 'stock_producto', 'id_categoria', 'imagen_producto', 'estado_producto'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}
