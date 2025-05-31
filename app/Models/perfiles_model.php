<?php

namespace App\Models;

use CodeIgniter\Model;

class perfiles_model extends Model
{

    protected $table = 'perfiles';
    protected $primaryKey = 'id_perfiles';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = 'false';

    protected $allowedFields = ['descripcion'];

    protected bool $allowEmptyInserts = false; // esto impide que se inserten registros vacios.
    protected bool $updateOnlyChanged = true; // esto permite que solo se actualicen los campos que realmente hayan cambiado.
}