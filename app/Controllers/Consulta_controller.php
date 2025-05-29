<?php

namespace App\Controllers;

use App\Models\consultas_model;
use App\Models\usuarios_model;

class Consulta_controller extends BaseController
{

    public function lista_consultas() {
        $consultas_model = new consultas_model();

        $data['consultas'] = $consultas_model
            ->select('consulta.*, usuario.nombre, usuario.apellido')
            ->join('usuario', 'usuario.id = consulta.id_usuarios', 'left')
            ->orderBy('id_mensaje', 'DESC')
            ->findAll();

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/lista_consultas', $data);
    }

    public function agregar_consulta() {
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

            $data = [
                'nombre_mensaje' => $request->getPost('nombre_mensaje'),
                'correo_mensaje' => $request->getPost('correo_mensaje'),
                'asunto_mensaje' => $request->getPost('asunto_mensaje'),
                'consulta_mensaje' => $request->getPost('consulta_mensaje'),
            ];

            $consulta = new consultas_model();
            $consulta -> insert($data);

            return redirect() -> route('contact') -> with('consulta_mensaje', 'Su consulta se envió exitosamente!');
        }else{

            $data['titulo'] = 'Contacto';
            $data['validation'] = $validation -> getErrors();
            return view('Plantillas/header')
                .view('Plantillas/nav')
                .view('Contenidos/informacion_de_contactos_view', $data)
                .view('Plantillas/footer.php');
        }
    }
}