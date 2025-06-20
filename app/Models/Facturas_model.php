<?php

namespace App\Models;
use CodeIgniter\Model;

class Facturas_model extends Model{

    protected $table = 'facturas';
    protected $primaryKey = 'id_factura';

    protected $autoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['fecha_factura', 'total_factura', 'id_usuario'];

}
