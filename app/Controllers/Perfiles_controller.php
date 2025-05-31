<?php

namespace App\Controllers;

use App\Models\perfiles_model;
use App\Models\usuarios_model;
use App\Models\productos_model;

class Perfiles_controller extends BaseController
{
    public function lista_perfiles() {
        $perfiles_model = new perfiles_model();
        $data['perfiles'] = $perfiles_model->findAll();

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Perfiles/lista_perfiles', $data);
    }

    public function crear_perfil() {
        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Perfiles/crear_perfil');
    }

    public function guardar_perfil() {
        $validation = \Config\Services::validation();
        $request = $this->request;

        $validation->setRules(
            [
                'descripcion' => 'required|max_length[50]'
            ]
        );

        if (!$validation->withRequest($request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $model = new perfiles_model();
        $model->insert(
            [
                'descripcion' => $request->getPost('descripcion')
            ]
        );

        return redirect()->to('/perfiles')->with('mensaje', 'Perfil creado correctamente');
    }

    public function editar_perfil($id) {
        $model = new perfiles_model();
        $perfil = $model->find($id);

        if (!$perfil) {
            return redirect()->to('/perfiles')->with('mensaje', 'Perfil no encontrado');
        }

        $data['perfil'] = $perfil;

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Perfiles/editar_perfil', $data);
    }

    public function actualizar_perfil($id) {
        $request = $this->request;
        $validation = \Config\Services::validation();

        $validation->setRules(
            [
                'descripcion' => 'required|max_length[50]'
            ]
        );

        if(!$validation->withRequest($request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $model = new perfiles_model();
        $model->update($id, [
            'descripcion' => $request->getPost('descripcion')
        ]);

        return redirect()->to('/perfiles')->with('mensaje', 'Perfil actualizado correctamente');
    }

    public function eliminar_perfil($id) {
        $usuarios_model = new usuarios_model();
        $usuarios_con_perfil = $usuarios_model->where('id_perfil', $id)->countAllResults();

        if($usuarios_con_perfil > 0) {
            return redirect()->to('/perfiles')->with('mensaje', 'No se puede eliminar el perfil porque esta siendo usado por uno o mas usuarios.');
        }

        $model = new perfiles_model();
        $model->delete($id);

        return redirect()->to('/perfiles')->with('mensaje', 'Perfil eliminado correctamente');
    }
}