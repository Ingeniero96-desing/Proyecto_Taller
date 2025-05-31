<?php

namespace App\Controllers;

use App\Models\usuarios_model;
// use App\Models\perfiles_model;

class Register_controller extends BaseController
{
    public function mostrar_formulario()
    {
        return view('Plantillas/header_view')
            . view('Views/Contenidos/registrate');
    }

    public function registrar()
    {
        $validation = \Config\Services::validation();
        $request = $this->request;

        $validation->setRules([
            'nombre' => 'required|max_length[30]',
            'apellido' => 'required|max_length[30]',
            'email' => 'required|valid_email|max_length[50]|is_unique[usuarios.email]',
            'telefono' => 'required|integer',
            'pass' => 'required|min_length[6]|max_length[50]',
        ]);

        if (!$validation->withRequest($request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $model = new usuarios_model();

        $model->insert([
            'nombre' => $request->getPost('nombre'),
            'apellido' => $request->getPost('apellido'),
            'email' => $request->getPost('email'),
            'telefono' => $request->getPost('telefono'),
            'pass' => password_hash($request->getPost('pass'), PASSWORD_BCRYPT),
            'id_perfil' => 2, // Asumimos que "2" es cliente
            'baja' => 0 // Activo por defecto
        ]);

        return redirect()->to('/login')->with('mensaje', 'Usuario registrado correctamente. Inicia sesión.');
    }
}
