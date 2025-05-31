<?php

namespace App\Controllers;

use App\Models\usuarios_model;
use App\Models\perfiles_model;

class Usuarios_controller extends BaseController
{
    public function lista_usuarios() {
        $usuarios_model = new usuarios_model();
        $data['usuarios'] = $usuarios_model->findAll();

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Usuarios/lista_usuarios', $data);
    }

    public function crear_usuario() {
        $perfiles_model = new perfiles_model();
        $data['perfiles'] = $perfiles_model->findAll();

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Usuarios/crear_usuario', $data);
    }

    public function guardar_usuario() {
        $validation = \Config\Services::validation();
        $request = $this->request;

        $validation->setRules([
            'nombre' => 'required|max_length[30]',
            'apellido' => 'required|max_length[30]',
            'email' => 'required|max_length[20]',
            'telefono' => 'required|integer',
            'pass' => 'required|max_length[50]',
            'baja' => 'required|max_length[2]',
            'id_perfil' => 'required|integer',
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
            'id_perfil' => $request->getPost('id_perfil'),
            'baja' => $request->getPost('baja')
        ]);

        return redirect()->to('/usuarios')->with('mensaje', 'Usuario creado correctamente');

    }

    public function editar_usuario($id) {
        $model = new usuarios_model();
        $perfiles_model = new perfiles_model();
        
        $data['usuario'] = $model->find($id);
        $data['perfiles'] = $perfiles_model->findAll();

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Usuarios/editar_usuario', $data);
    }

    public function actualizar_usuario($id) {
        $request = $this->request;
        $model = new usuarios_model();

        $data = [
            'nombre' => $request->getPost('nombre'),
            'apellido' => $request->getPost('apellido'),
            'email' => $request->getPost('email'),
            'telefono' => $request->getPost('telefono'),
            'id_perfil' => $request->getPost('id_perfil'),
            'baja' => $request->getPost('baja')
        ];

        if (!empty($request->getPost('pass'))) {
            $data['pass'] = password_hash($request->getPost('pass'), PASSWORD_BCRYPT);
        }

        $model->update($id, $data);

        return redirect()->to('/usuarios')->with('mensaje', 'Usuario actualizado correctamente');
    }

    public function eliminar_usuario($id) {
        $model = new usuarios_model();
        $model->delete($id);

        return redirect()->to('/usuarios')->with('mensaje', 'Usuario eliminado correctamente');
    }
}