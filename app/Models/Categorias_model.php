<?php

namespace App\Models;
use CodeIgniter\Model;

class Categorias_model extends Model{

    protected $table = 'categorias';
    protected $primaryKey = 'id_cate';

    protected $autoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre_categoria'];
}