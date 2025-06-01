<?php

namespace App\Controllers;

use App\Models\usuarios_model;
// use App\Models\perfiles_model;

class Register_controller extends BaseController
{
    public function mostrar_formulario()
    {
        return view('Plantillas/header_view')
            . view('Views/Contenidos/register');
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
        ], 
        [
            'nombre' => [
                'required'   => 'El nombre es obligatorio.',
                'max_length' => 'El nombre no puede superar los 30 caracteres.',
            ],
            'apellido' => [
                'required'   => 'El apellido es obligatorio.',
                'max_length' => 'El apellido no puede superar los 30 caracteres.',
            ],
            'email' => [
                'required'   => 'El correo electrónico es obligatorio.',
                'valid_email'=> 'Debes ingresar un correo electrónico válido.',
                'max_length' => 'El correo electrónico no puede superar los 50 caracteres.',
                'is_unique'  => 'Este correo ya está registrado.',
            ],
            'telefono' => [
                'required' => 'El número de teléfono es obligatorio.',
                'integer'  => 'El número de teléfono debe contener solo números.',
            ],
            'pass' => [
                'required'   => 'La contraseña es obligatoria.',
                'min_length' => 'La contraseña debe tener al menos 6 caracteres.',
                'max_length' => 'La contraseña no puede superar los 50 caracteres.',
            ],
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
