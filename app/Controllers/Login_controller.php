<?php

namespace App\Controllers;

use App\Models\usuarios_model;

class Login_controller extends BaseController
{

    public function mostrar_login()
    {

        return view('Plantillas/header_view')
            . view('Views/Contenidos/login');
    }

    public function autenticar()
    {
        //AGREGUÉ
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            dd('NO está llegando por POST', $_SERVER);
        }

        $request = \Config\Services::request();
        $session = session();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'pass'  => 'required|min_length[6]',
        ],
        [     //AGREGUÉ
            'email' => [
            'required'    => 'El correo electrónico es obligatorio.',
            'valid_email' => 'Debes ingresar un correo electrónico válido.',
            'max_length'  => 'El correo no debe superar los 30 caracteres.',
            ],
            'pass' => [
            'required'   => 'La contraseña es obligatoria.',
            'min_length' => 'La contraseña debe tener al menos 6 caracteres.',
            ]
        ]);

        if (!$validation->withRequest($request)->run()) {
            dd('Falló la validación', $validation->getErrors()); //AGREGUÉ PARA Q APAREZCA UN MENSAJE SI NO AGARRA 
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $userModel = new usuarios_model();
        $user = $userModel->where('email', $request->getPost('email'))->first();

        if ($user && password_verify($request->getPost('pass'), $user['pass'])) {
            dd('Login exitoso', $user); //AGREGUÉ PARA Q APAREZCA UN MENSAJE SI AGARRA 
            $session->set([
                'nombre_usuario'   => $user['nombre'],
                'apellido_usuario' => $user['apellido'],
                'id_perfil'           => $user['id_perfil'],
                'isLogged'            => true,
            ]);

            return $user['id_perfil'] == 1
                ? redirect()->route('panelAdmin')
                : redirect()->route('principal');
        }
            return redirect()->back()->with('error', 'Email o Contraseña incorrectos');
        
    }

    // Cierra la sesion del usuario
    public function logout()
    {

        $session = session();
        $session->destroy(); //Elimina todos los datos de la sesion

        return redirect()->to('/login'); //vuelve al login
    }
}
