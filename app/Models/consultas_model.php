<?php

namespace App\Models;

use CodeIgniter\Model;

class consultas_model extends Model
{

    protected $table = 'consultas';
    protected $primaryKey = 'id_mensaje';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre_mensaje', 'correo_mensaje', 'asunto_mensaje', 'consulta_mensaje', 'id_usuarios'];

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
