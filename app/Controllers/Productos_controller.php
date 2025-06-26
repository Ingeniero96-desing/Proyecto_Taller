<?php

namespace App\Controllers;

use App\Models\Productos_model;
use App\Models\Categorias_model;

class Productos_controller extends BaseController
{
    public function lista_productos()
    {
        $db = \Config\Database::connect();
        $query = $db->table('productos')
            ->select('productos.*, categorias.nombre_categoria')
            ->join('categorias', 'categorias.id_cate = productos.id_categoria')
            ->get();

        // $productos_model = new productos_model();
        $data['productos'] = $query->getResultArray();

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Productos/lista_productos', $data);
    }

    public function form_crear_producto()
    {
        $categoriaModel = new CategoriaS_model();
        $data['categorias'] = $categoriaModel->findAll();

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Productos/crear_producto', $data);
    }

    public function crear_producto()
    {
        $validation = \Config\Services::validation();
        $request = $this->request;

        $validation->setRules(
            [
                'nombre_producto' => 'required|max_length[30]',
                'descripcion_producto' => 'max_length[100]',
                'precio_producto' => 'required|numeric',
                'stock_producto' => 'required|integer',
                'id_categoria' => 'required|integer',
                'imagen_producto' => 'uploaded[imagen_producto]|is_image[imagen_producto]',

            ],
            [   // Mensajes personalizados de validación
                'nombre_producto' => [
                    'required' => 'Nombre requerido',
                    'max_length' => 'Máximo 30 caracteres.',
                ],
                'descripcion_producto' => [
                    'max_length' => 'Máximo 100 caracteres.',
                ],
                'precio_producto' => [
                    'required' => 'El precio es obligatorio.',
                    'numeric' => 'El precio debe ser un número válido.'
                ],
                'stock_producto' => [
                    'required' => 'El stock es obligatorio.',
                    'integer'  => 'El stock debe ser un número válido.'
                ],
                'id_categoria' => [
                    'required' => 'Debe seleccionar un tipo de categoria.',
                    'integer' => 'Debe ser un número válido.',
                ],
                'imagen_producto' => [
                    'uploaded' => 'La imagen del producto es obligatoria.',
                    'is_image' => 'El archivo debe ser una imagen válida.'
                ],

            ]
        );

        if (!$validation->withRequest($request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $img = $this->request->getFile('imagen_producto');
        $imgName = null;

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move(ROOTPATH . 'assets/uploads/', $imgName);
        }


        $model = new Productos_model();
        $model->insert(
            [
                'nombre_producto' => $request->getPost('nombre_producto'),
                'descripcion_producto' => $request->getPost('descripcion_producto'),
                'precio_producto' => $request->getPost('precio_producto'),
                'stock_producto' => $request->getPost('stock_producto'),
                'id_categoria' => $request->getPost('id_categoria'),
                'imagen_producto'  => $imgName,

            ]
        );

        return redirect()->to('/productos')->with('mensaje', 'Producto agregado correctamente');
    }

    public function editar_producto($id)
    {
        $productos_model = new Productos_model();
        $categoriaModel = new Categorias_model();

        $producto = $productos_model->find($id);

        if (!$producto) {
            return redirect()->to('/productos')->with('mensaje', 'Producto no encontrado');
        }

        $data['producto'] = $producto;
        $data['categorias'] = $categoriaModel->findAll();

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Admin/Productos/editar_producto', $data);
    }

    public function actualizar_producto($id)
    {
        $request = $this->request;
        $validation = \Config\Services::validation();

        $productos_model = new Productos_model();
        $producto = $productos_model->find($id);

        $validation->setRules(
            [
                'nombre_producto' => 'required|max_length[30]',
                'descripcion_producto' => 'max_length[100]',
                'precio_producto' => 'required|numeric',
                'stock_producto' => 'required|integer',
                'id_categoria' => 'required|integer',
                'imagen_producto' => 'permit_empty|uploaded[imagen_producto]|is_image[imagen_producto]',
                'estado_producto' => 'required|integer'
            ],
            [   // Mensajes personalizados de validación
                'nombre_producto' => [
                    'required' => 'Nombre requerido',
                    'max_length' => 'Máximo 30 caracteres.',
                ],
                'descripcion_producto' => [
                    'max_length' => 'Máximo 100 caracteres.',
                ],
                'precio_producto' => [
                    'required' => 'El precio es obligatorio.',
                    'numeric' => 'El precio debe ser un número válido.'
                ],
                'stock_producto' => [
                    'required' => 'El stock es obligatorio.',
                    'integer'  => 'El stock debe ser un número válido.'
                ],
                'id_categoria' => [
                    'required' => 'Debe seleccionar un tipo de categoria.',
                    'integer' => 'Debe ser un número válido.',
                ],
                'estado_producto' => [
                    'required' => 'El campo "estado" es obligatorio.',
                    'integer' => 'El estado de "baja" debe ser un número válido.',
                ],
            ]
        );

        if (!$validation->withRequest($request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        $img = $this->request->getFile('imagen_producto');
        $imgName = $producto['imagen_producto'];

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move(ROOTPATH . 'assets/uploads/', $imgName);
        }

        $model = new Productos_model();
        $model->update($id, [
            'nombre_producto' => $request->getPost('nombre_producto'),
            'descripcion_producto' => $request->getPost('descripcion_producto'),
            'precio_producto' => $request->getPost('precio_producto'),
            'stock_producto' => $request->getPost('stock_producto'),
            'id_categoria' => $request->getPost('id_categoria'),
            'imagen_producto' => $imgName,
            'estado_producto' => $request->getPost('estado_producto')
        ]);

        return redirect()->to('/productos')->with('mensaje', 'Producto actualizado correctamente');
    }

    public function eliminar_producto($id)
    {
        $model = new Productos_model();
        $model->delete($id);

        return redirect()->to('/productos')->with('mensaje', 'Producto eliminado correctamente');
    }
}
