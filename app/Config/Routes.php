<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('principal', 'Home::index');
$routes->get('quienes_somos', 'Home::quienes_somos');
$routes->get('comercializacion', 'Home::comercializacion');
$routes->get('informacion_de_contactos', 'Home::informacion_de_contactos');
$routes->get('terminos_y_usos', 'Home::terminos_y_usos');
$routes->get('login', 'Login_controller::mostrar_login');
$routes->post('login', 'Login_controller::autenticar');
$routes->get('registrate', 'Register_controller::mostrar_formulario');
$routes->post('registrate', 'Register_controller::registrar');
$routes->get('panelAdmin', 'Home::panelAdmin');
