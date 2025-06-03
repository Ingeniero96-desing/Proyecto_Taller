<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuarios_model extends Model
{

    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    // protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'apellido', 'email', 'telefono', 'pass', 'baja', 'id_perfil'];

    protected bool $allowEmptyInserts = false; // esto impide que se inserten registros vacios.
    protected bool $updateOnlyChanged = true; // esto permite que solo se actualicen los campos que realmente hayan cambiado.
}