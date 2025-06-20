<?php

namespace App\Controllers;

use App\Models\consultas_model;
use App\Models\usuarios_model;

class Consulta_controller extends BaseController
{

    public function lista_consultas()
    {
        $consultas_model = new consultas_model();

        $data['consultas'] = $consultas_model
            ->select('consultas.*, usuarios.nombre, usuarios.apellido')
            ->join('usuarios', 'usuarios.id = consultas.id_usuarios', 'left')
            ->orderBy('id_mensaje', 'DESC')
            ->findAll();

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Consultas/lista_consultas', $data);
    }

    public function crear_consulta()
    {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $validation->setRules(
            [
                'nombre_mensaje' => 'required|max_length[100]',
                'correo_mensaje' => 'required|valid_email',
                'asunto_mensaje' => 'required|max_length[100]',
                'consulta_mensaje' => 'required|max_length[250]|min_length[10]',
            ],
            [
                //Errors
                'nombre_mensaje' => [
                    'required' => 'El nombre es requerido.',
                ],

                'correo_mensaje' => [
                    'required' => 'El correo electrónico es obligatorio.',
                    'valid_email' => 'La dirección de correo debe ser válida.',
                ],

                'asunto_mensaje' => [
                    'required' => 'El motivo es obligatorio.',
                    'max_length' => 'El motivo de la consulta debe tener como máximo 100 caracteres.',
                ],

                'consulta_mensaje' => [
                    'required' => 'La consulta es requerido.',
                    'min_length' => 'La consulta debe tener como mínimo 10 caracteres.',
                    'max_length' => 'La consulta debe tener como máximo 250 caracteres.',
                ],
            ]
        );

        if ($validation->withRequest($request)->run()) {

            $idUsuario = session()->get('id');
            $data = [
                'nombre_mensaje' => $request->getPost('nombre_mensaje'),
                'correo_mensaje' => $request->getPost('correo_mensaje'),
                'asunto_mensaje' => $request->getPost('asunto_mensaje'),
                'consulta_mensaje' => $request->getPost('consulta_mensaje'),
            ];

            // Agregar id_usuarios solo si el usuario está logueado
            if (session()->has('id')) {
                $data['id_usuarios'] = session()->get('id');
            }

            $consulta = new consultas_model();
            $consulta->insert($data);

            return redirect()->route('informacion_de_contactos')->with('mensaje', 'Su consulta se envió exitosamente!');
        } else {

            $data['titulo'] = 'Contacto';
            $data['validation'] = $validation->getErrors();
            return view('Plantillas/header_view')
                . view('Plantillas/nav_view')
                . view('Contenidos/informacion_de_contactos', $data)
                . view('Plantillas/footer_view');
        }
    }

    public function editar_consulta($id)
    {
        $model = new consultas_model();
        //$perf_model = new perfiles_model();

        $data['consultas'] = $model->find($id);
        // $data['perfiles'] = $perfiles_model->select('id_perfiles, descripcion')->findAll();

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Consultas/editar_consulta', $data);
    }

    //     public function actualizar_consulta($id){
    //     $request = $this->request;
    //     $model = new consultas_model();
    //     $consulta_actual = $model->find($id);

    //     if (!$consulta_actual) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException('Consulta no encontrada');
    //     }

    //     // Definir reglas de validación
    //     $rules = [
    //         'nombre_mensaje'   => 'required|max_length[100]',
    //         'correo_mensaje'   => 'required|valid_email|max_length[150]',
    //         'asunto_mensaje'   => 'required|max_length[100]',
    //         'consulta_mensaje' => 'required|min_length[10]|max_length[250]',
    //     ]

    //     // Validar formulario
    //     if (!$this->validate($rules)) {
    //         return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
    //     }

    //     // Preparar datos para actualizar
    //     $data = [
    //         'nombre_mensaje'   => $request->getPost('nombre_mensaje'),
    //         'correo_mensaje'   => $request->getPost('correo_mensaje'),
    //         'asunto_mensaje'   => $request->getPost('asunto_mensaje'),
    //         'consulta_mensaje' => $request->getPost('consulta_mensaje'),
    //     ];

    //     // Actualizar la consulta
    //     $model->update($id, $data);

    //     // Redireccionar con mensaje
    //     return redirect()->to('/consultas')->with('mensaje', 'Consulta actualizada correctamente');
    // }
    public function actualizar_consulta($id)
    {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $model = new consultas_model();
        $consulta_actual = $model->find($id);

        if (!$consulta_actual) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Consulta no encontrada');
        }

        $validation->setRules(
            [
                'nombre_mensaje' => 'required|max_length[100]',
                'correo_mensaje' => 'required|valid_email',
                'asunto_mensaje' => 'required|max_length[100]',
                'consulta_mensaje' => 'required|max_length[250]|min_length[10]',
            ],
            [
                //Errors
                'nombre_mensaje' => [
                    'required' => 'El nombre es requerido.',
                ],

                'correo_mensaje' => [
                    'required' => 'El correo electrónico es obligatorio.',
                    'valid_email' => 'La dirección de correo debe ser válida.',
                ],

                'asunto_mensaje' => [
                    'required' => 'El motivo es obligatorio.',
                    'max_length' => 'El motivo de la consulta debe tener como máximo 100 caracteres.',
                ],

                'consulta_mensaje' => [
                    'required' => 'La consulta es requerido.',
                    'min_length' => 'La consulta debe tener como mínimo 10 caracteres.',
                    'max_length' => 'La consulta debe tener como máximo 250 caracteres.',
                ],
            ]
        );

        if (!$validation->withRequest($request)->run()) {
            $data = [
                'validation' => $validation,
                'consultas' => $consulta_actual, // le pasamos la consulta original
            ];
            return view('Plantillas/header_view', $data)
                . view('Plantillas/nav_view', $data)
                . view('Admin/Consultas/editar_consulta', $data);
        }


        // Preparar datos para actualizar
        $data = [
            'nombre_mensaje'   => $request->getPost('nombre_mensaje'),
            'correo_mensaje'   => $request->getPost('correo_mensaje'),
            'asunto_mensaje'   => $request->getPost('asunto_mensaje'),
            'consulta_mensaje' => $request->getPost('consulta_mensaje'),
        ];

        // Actualizar la consulta
        $model->update($id, $data);

        // Redireccionar con mensaje
        return redirect()->to('/consultas')->with('mensaje', 'Consulta actualizada correctamente');
    }




    public function eliminar_consulta($id)
    {
        $consultas_model = new consultas_model();

        $consulta = $consultas_model->find($id);

        if (!$consulta) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Consulta no encontrada');
        }

        $consultas_model->delete($id);

        return redirect()->to('/consultas')->with('mensaje', 'Consulta eliminada correctamente');
    }
}
