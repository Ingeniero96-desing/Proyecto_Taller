<?php

namespace App\Controllers;

use App\Models\Usuarios_model;

class Login_controller extends BaseController
{

    public function mostrar_login()
    {

        return view('Plantillas/header_view')
            . view('Views/Contenidos/login')
            . view('Plantillas/footer_view');
    }

    public function loguear()
    {

        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        // Asegurarse de que la solicitud sea POST
        if (!$this->request->is('post')) {
    
            return redirect()->to('/login')->with('error', 'Método no permitido.');
        }
      

        // Obtener los datos del formulario
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('pass');

        // Validación
       
        $validation->setRules([
            'email' => 'required|valid_email|max_length[30]',
            'pass'  => 'required|min_length[6]',
        ], [
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
            
            $data ['validation'] = $validation->getErrors();
            return view('Plantillas/header_view', $data).view('Views/Contenidos/login');

            
        }
         
        // Verificación de credenciales en la base de datos
        $userModel = new Usuarios_model();
        $usuario = $userModel->where('email', $email)->first();

        if (!$usuario || !password_verify($pass, $usuario['pass'])) {
            return redirect()->route('login')->with('error', 'Credenciales incorrectas.');
        }

        // Crear sesión
        $session = session();
        $session->set([
            'id'       => $usuario['id'],
            'nombre'   => $usuario['nombre'],
            'email'    => $usuario['email'],
            'id_perfil' => $usuario['id_perfil'],
            'logueado' => true,
        ]);

        // Redireccionar según rol
        if ($usuario['id_perfil'] == 1) {
            return view('Plantillas/header_view')
                . view('Plantillas/nav_admin')
                . view('Admin/panelAdmin');
        } else {
            return view('Plantillas/header_view')
                . view('Plantillas/nav_cliente')
                . view('Contenidos/principal')
                . view('Plantillas/footer_view');
        }
    }

    // Cierra la sesion del usuario
    public function logout()
    {
        $session = session();
        $session->destroy(); //Elimina todos los datos de la sesion

        return redirect()->to('/login'); 
    }
}
