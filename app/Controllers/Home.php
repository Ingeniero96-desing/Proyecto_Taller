<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('/Plantillas/header_view')
            . view('/Plantillas/nav_view')
            . view('/Contenidos/principal')
            . view('/Plantillas/footer_view');
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
}