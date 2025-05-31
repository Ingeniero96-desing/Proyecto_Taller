<?php

namespace App\Controllers;

use App\Models\productos_model;
use App\Models\usuarios_model;
use App\Models\perfiles_model;
use App\Models\consultas_model;

class Productos_controller extends BaseController
{
    public function lista_productos() {
        $productos_model = new productos_model();
        $data['productos'] = $productos_model->findAll();

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Productos/lista_productos', $data);
    }

    // public function crear_producto() {
    //     $productos_model = new productos_model();
    //     $data['productos'] = $productos_model->findAll();

    //     return view('Plantillas/header_view')
    //         . view('Plantillas/nav_view')
    //         . view('Admin/crear_producto', $data);
    // }

    public function crear_producto() {
        $validation = \Config\Services::validation();
        $request = $this->request;

        $validation->setRules(
            [
                'nombre_producto' => 'required|max_length[30]',
                'descripcion_producto' => 'required|max_length[100]',
                'precio_producto' => 'required|numeric',
                'stock_producto' => 'required|integer',
                'id_categoria' => 'required|integer',
                'imagen_categoria' => 'required|max_length[100]',
            ]
        );

        if (!$validation->withRequest($request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $model = new productos_model();
        $model->insert(
            [
                'nombre_producto' => $request->getPost('nombre_producto'),
                'descripcion_producto' => $request->getPost('descripcion_producto'),
                'precio_producto' => $request->getPost('precio_producto'),
                'stock_producto' => $request->getPost('stock_producto'),
                'id_categoria' => $request->getPost('id_categoria'),
                'imagen_categoria' => $request->getPost('imagen_categoria'),
            ]
        );

        return redirect()->to('/productos')->with('mensaje', 'Producto agregado correctamente');
    }

    public function editar_producto($id) {
        $model = new productos_model();
        $producto = $model->find($id);

        if (!$producto) {
            return redirect()->to('/productos')->with('mensaje', 'Producto no encontrado');
        }

        $data['producto'] = $producto;

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Productos/editar_producto', $data);
    }

    public function actualizar_producto($id) {
        $request = $this->request;
        $validation = \Config\Services::validation();

        $validation->setRules(
            [
                'nombre_producto' => 'required|max_length[30]',
                'descripcion_producto' => 'required|max_length[100]',
                'precio_producto' => 'required|numeric',
                'stock_producto' => 'required|integer',
                'id_categoria' => 'required|integer',
                'imagen_categoria' => 'required|max_length[100]',
            ]
        );

        if (!$validation->withRequest($request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $model = new productos_model();
        $model->update($id, [
            'nombre_producto' => $request->getPost('nombre_producto'),
            'descripcion_producto' => $request->getPost('descripcion_producto'),
            'precio_producto' => $request->getPost('precio_producto'),
            'stock_producto' => $request->getPost('stock_producto'),
            'id_categoria' => $request->getPost('id_categoria'),
            'imagen_categoria' => $request->getPost('imagen_categoria'),
        ]);

        return redirect()->to('/productos')->with('mensaje', 'Producto actualizado correctamente');
    }

    public function eliminar_producto($id) {
        $model = new productos_model();
        $model->delete($id);

        return redirect()->to('/productos')->with('mensaje', 'Producto eliminado correctamente');
    }
}