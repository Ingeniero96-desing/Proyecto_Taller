<?php

namespace App\Controllers;

use App\Models\Productos_model;
use App\Models\Categorias_model;

class Home extends BaseController
{
    public function index()
    {
        $productoModel = new Productos_model();

        $productos = $productoModel
            ->select('productos.*, categorias.nombre_categoria')
            ->join('categorias', 'categorias.id_cate = productos.id_categoria')
            ->findAll();

        $productosPorCategoria = [];

        foreach ($productos as $producto) {
            $cat = $producto['nombre_categoria'];
            if (!isset($productosPorCategoria[$cat])) {
                $productosPorCategoria[$cat] = [];
            }
            $productosPorCategoria[$cat][] = $producto;
        }

        $data['productosPorCategoria'] = $productosPorCategoria;

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('Contenidos/principal', $data)
            . view('Plantillas/footer_view');
    }

    public function comercializacion()
    {
        return view('/Plantillas/header_view')
            . view('/Plantillas/nav_view')
            . view('/Contenidos/comercializacion')
            . view('/Plantillas/footer_view');
    }

    public function informacion_de_contactos()
    {
        return view('/Plantillas/header_view')
            . view('/Plantillas/nav_view')
            . view('/Contenidos/informacion_de_contactos')
            . view('/Plantillas/footer_view');
    }

    public function quienes_somos()
    {
        return view('/Plantillas/header_view')
            . view('/Plantillas/nav_view')
            . view('/Contenidos/quienes_somos')
            . view('/Plantillas/footer_view');
    }

    public function terminos_y_usos()
    {
        return view('/Plantillas/header_view')
            . view('/Plantillas/nav_view')
            . view('/Contenidos/terminos_y_usos')
            . view('/Plantillas/footer_view');
    }

    public function login()
    {
        return view('/Plantillas/header_view')
            . view('/Contenidos/login');
    }

    public function registrate()
    {
        return view('/Plantillas/header_view')
            . view('/Contenidos/registrate');
    }

    public function panelAdmin()
    {
        if (session()->get('id_perfil') != 1) {
            return redirect()->to(base_url('login'));
        }

        return view('Plantillas/header_view')
            . view('Plantillas/nav_view')
            . view('/Admin/panelAdmin');
    }

    public function catalogo()
    {
        $productoModel = new Productos_model();

        // Obtener el término de búsqueda
        $busqueda = $this->request->getGet('busqueda');

        // Construir la consulta con join
        $builder = $productoModel
            ->select('productos.*, categorias.nombre_categoria')
            ->join('categorias', 'categorias.id_cate = productos.id_categoria');

        // Si hay búsqueda, filtramos
        if (!empty($busqueda)) {
            $builder->groupStart()
                ->like('productos.nombre_producto', $busqueda)
                ->orLike('productos.descripcion_producto', $busqueda)
                ->groupEnd();
        }

        $productos = $builder->findAll();

        // Agrupar por categoría
        $productosPorCategoria = [];
        foreach ($productos as $producto) {
            $cat = $producto['nombre_categoria'];
            if (!isset($productosPorCategoria[$cat])) {
                $productosPorCategoria[$cat] = [];
            }
            $productosPorCategoria[$cat][] = $producto;
        }

        $data['productosPorCategoria'] = $productosPorCategoria;
        $data['busqueda'] = $busqueda;

        return view('/Plantillas/header_view')
            . view('/Plantillas/nav_view')
            . view('/Contenidos/catalogo', $data)
            . view('/Plantillas/footer_view');
    }
}
