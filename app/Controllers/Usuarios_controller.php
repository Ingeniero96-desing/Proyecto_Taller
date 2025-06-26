<?php

namespace App\Controllers;

use App\Models\Usuarios_model;
use App\Models\perfiles_model;

class Usuarios_controller extends BaseController
{
    public function lista_usuarios()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('usuarios');
        $builder->select('usuarios.*, perfiles.descripcion as perfil');
        $builder->join('perfiles', 'perfiles.id_perfiles = usuarios.id_perfil');
        $query = $builder->get();
        $data['usuarios'] = $query->getResultArray();

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Usuarios/lista_usuarios', $data);
    }

    public function crear_usuario()
    {
        $perfiles_model = new perfiles_model();
        $data['perfiles'] = $perfiles_model->findAll();

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Usuarios/crear_usuario', $data);
    }

    public function guardar_usuario()
    {
        $validation = \Config\Services::validation();
        $request = $this->request;

        $validation->setRules(
            [
                'nombre' => 'required|max_length[30]',
                'apellido' => 'required|max_length[30]',
                'email' => 'required|valid_email|max_length[20]|is_unique[usuarios.email]',
                'telefono' => 'required|integer',
                'pass' => 'required|max_length[50]|min_length[6]',
                'baja' => 'required|integer',
                'id_perfil' => 'required|integer',
            ],
            [   // Mensajes personalizados de validación
                'nombre' => [
                    'required' => 'Nombre requerido',
                    'max_length' => 'Máximo 30 caracteres',
                ],
                'apellido' => [
                    'required' => 'Apellido requerido',
                    'max_length' => 'Máximo 30 caracteres',
                ],
                'email' => [
                    'required' => 'El correo electrónico es obligatorio.',
                    'valid_email' => 'La dirección de correo debe ser válida.',
                    'max_length' => 'Máximo 20 caracteres.',
                    'is_unique' => 'El email ya está registrado.',
                ],
                'telefono' => [
                    'required' => 'El teléfono es obligatorio.',
                    'integer'  => 'El número de teléfono debe contener solo números.'
                ],
                'pass' => [
                    'required' => 'La contraseña es obligatoria.',
                    'max_length' => 'Máximo 50 caracteres.',
                    'min_length' => 'La contraseña debe tener al menos 6 caracteres.',
                ],
                'baja' => [
                    'required' => 'El campo "baja" es obligatorio.',
                    'integer' => 'El estado de "baja" debe ser un número válido.',
                ],
                'id_perfil' => [
                    'required' => 'Debe seleccionar un perfil.',
                    'integer' => 'El perfil debe ser un número válido.',
                ],
            ]
        );


        if (!$validation->withRequest($request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $model = new Usuarios_model();
        $model->insert([
            'nombre' => $request->getPost('nombre'),
            'apellido' => $request->getPost('apellido'),
            'email' => $request->getPost('email'),
            'telefono' => $request->getPost('telefono'),
            'pass' => password_hash($request->getPost('pass'), PASSWORD_DEFAULT),
            'id_perfil' => $request->getPost('id_perfil'),
            'baja' => $request->getPost('baja')
        ]);

        return redirect()->to('/usuarios')->with('mensaje', 'Usuario creado correctamente');
    }

    public function editar_usuario($id)
    {
        $model = new Usuarios_model();
        $perfiles_model = new perfiles_model();

        $data['usuario'] = $model->find($id);
        $data['perfiles'] = $perfiles_model->findAll();

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Usuarios/editar_usuario', $data);
    }

    public function actualizar_usuario($id)
    {
        $request = $this->request;
        $model = new Usuarios_model();
        $usuario_actual = $model->find($id);

        $rules = [
            'nombre' => 'required|max_length[30]',
            'apellido' => 'required|max_length[30]',
            'telefono' => 'required|integer',
            'id_perfil' => 'required|integer',
            'baja' => 'required|integer'
        ];

        if ($request->getPost('email') !== $usuario_actual['email']) {
            $rules['email'] = 'required|valid_email|max_length[20]|is_unique[usuarios.email]';
        } else {
            $rules['email'] = 'required|valid_email|max_length[20]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

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

        return redirect()->to('/lista_usuarios')->with('mensaje', 'Usuario actualizado correctamente');
    }

    public function eliminar_usuario($id)
    {
        $model = new Usuarios_model();

        try {
            $model->delete($id);
            return redirect()->to('/lista_usuarios')->with('mensaje', 'Usuario eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->to('/lista_usuarios')->with('error', 'No se puede eliminar el usuario porque tiene registros relacionados.');
        }
    }

    public function perfil_view()
    {
        $usuarioModel = new Usuarios_model();
        $ventasModel = new \App\Models\Ventas_model();

        $idUsuario = session()->get('id');

        $usuario = $usuarioModel->find($idUsuario);

        if (!$usuario) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Usuario no encontrado');
        }

        $ventas = $ventasModel->obtenerVentasConDetalles($idUsuario);

        $data = [
            'usuario' => $usuario,
            'ventas' => $ventas
        ];

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Contenidos/perfil', $data);
    }
}
