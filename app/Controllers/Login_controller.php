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

    // public function autenticar()
    // {

    //     $request = \Config\Services::request();

    //     //necesarios para autenticar al usuario
    //     $email = $request->getPost('email');
    //     $pass = $request->getPost('pass');

    //     $usuarioModel = new usuarios_model();

    //     $usuario = $usuarioModel->where('email', $email)->first();

    //     if ($usuario && password_verify($pass, $usuario['pass'])) {

    //         //verifica si está dado de baja
    //         if ($usuario['baja'] == 1) {
    //             return redirect()->back()->with('error', 'El usuario está dado de baja.');
    //         }

    //         //Crea la sesión
    //         $session = session();
    //         $session->set([
    //             'id_usuario' => $usuario['id'],
    //             'nombre' => $usuario['nombre'],
    //             'apellido' => $usuario['apellido'],
    //             'perfil' => $usuario['id_perfil'],
    //             'logged_in' => true
    //         ]);

    //         //Muestra segun el tipo de perfil
    //         if ($usuario['id_perfil'] == 1) {
    //             return redirect()->to('panelAdmin'); //ruta del admin
    //         } else {
    //             return redirect()->to('/'); //ruta del cliente
    //         }
    //     } else {
    //         return redirect()->back()->with('error', 'Email o Contraseña incorrectos');
    //     }
    // }

    // public function autenticar()
    // {
    //     $request = \Config\Services::request();
    //     $session = session();

    //     $validation = \Config\Services::validation();
    //     $validation->setRules([
    //         'email' => 'required|valid_email',
    //         'pass'  => 'required|min_length[8]',
    //     ]);

    //     if (!$validation->withRequest($request)->run()) {
    //         return redirect()->back()->withInput()->with('validation', $validation->getErrors());
    //     }

    //     $userModel = new usuarios_model();
    //     $user = $userModel->where('email', $request->getPost('email'))->first();

    //     if ($user && password_verify($request->getPost('pass'), $user['pass'])) {
    //         $session->set([
    //             'id_usuario'       => $user['id'],
    //             'nombre'   => $user['nombre'],
    //             'apellido' => $user['apellido'],
    //             'perfil'           => $user['id_perfil'],
    //             'isLogged'            => true,
    //         ]);

    //         return $user['id_perfil'] == 1
    //             ? redirect()->route('panelAdmin')
    //             : redirect()->route('/');
    //     }

    //     return redirect()->route('login')->with('mensaje', 'Credenciales inválidas');
    // }

    public function autenticar()
    {
        $request = \Config\Services::request();
        $session = session();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'pass'  => 'required|min_length[8]',
        ]);

        if (!$validation->withRequest($request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $userModel = new usuarios_model();
        $user = $userModel->where('email', $request->getPost('email'))->first();

        if ($user && password_verify($request->getPost('pass'), $user['pass'])) {
            if ($user['baja'] == 1) {
                return redirect()->back()->with('mensaje', 'Usuario dado de baja');
            }

            $session->set([
                'id_usuario' => $user['id'],
                'nombre'     => $user['nombre'],
                'apellido'   => $user['apellido'],
                'perfil'     => $user['id_perfil'],
                'isLogged'   => true,
            ]);

            return $user['id_perfil'] == 1
                ? redirect()->to('panelAdmin')
                : redirect()->to('/');
        }

        return redirect()->back()->with('mensaje', 'Credenciales inválidas');
    }


    // Cierra la sesion del usuario
    public function logout()
    {

        $session = session();
        $session->destroy(); //Elimina todos los datos de la sesion

        return redirect()->to('/login'); //vuelve al login
    }
}
