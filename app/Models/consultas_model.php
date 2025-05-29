<?php

namespace App\Models;

use CondeIgniter\Model;

class consultas_model extends Model
{

    protected $table = 'consultas';
    protected $primaryKey = 'id_mensaje';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = 'false';

    protected $allowedFields = ['nombre', 'correo', 'asunto', 'consulta', 'id_usuarios'];

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}