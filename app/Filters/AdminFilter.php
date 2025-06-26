<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Verifica si está logueado y si es admin (id_perfil = 1)
        if (!$session->get('logueado') || $session->get('id_perfil') != 1) {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
