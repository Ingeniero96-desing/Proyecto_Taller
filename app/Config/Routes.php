<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Register
$routes->get('registro', 'Register_controller::mostrar_formulario');
$routes->post('registro', 'Register_controller::registrar');

// Login
$routes->get('login', 'Login_controller::mostrar_login');
$routes->post('loguear', 'Login_controller::loguear');
$routes->get('logout', 'Login_controller::logout');


// VISTAS DEL ADMINISTRADOR
$routes->group('', ['filter' => 'adminAuth'], function ($routes) {
    $routes->get('panelAdmin', 'Home::panelAdmin');

    // Consultas
    $routes->get('consultas', 'Consulta_controller::lista_consultas');

    $routes->get('consultas_leidas', 'Consulta_controller::consultas_leidas');
    $routes->get('consultas/marcar_leido/(:num)', 'Consulta_controller::marcar_leido/$1');

    // Productos
    $routes->get('productos', 'Productos_controller::lista_productos');
    $routes->get('crear_producto', 'Productos_controller::form_crear_producto');
    $routes->post('crear_producto', 'Productos_controller::crear_producto');
    $routes->get('editar_producto/(:num)', 'Productos_controller::editar_producto/$1');
    $routes->post('actualizar_producto/(:num)', 'Productos_controller::actualizar_producto/$1');
    $routes->get('eliminar_producto/(:num)', 'Productos_controller::eliminar_producto/$1');

    // Ventas
    $routes->get('ventas', 'Ventas_controller::lista_ventas');

    // Usuarios
    $routes->get('lista_usuarios', 'Usuarios_controller::lista_usuarios');
    $routes->get('editar_usuario/(:num)', 'Usuarios_controller::editar_usuario/$1');
    $routes->post('actualizar_usuario/(:num)', 'Usuarios_controller::actualizar_usuario/$1');
    $routes->get('usuarios/eliminar/(:num)', 'Usuarios_controller::eliminar_usuario/$1');
});

// VISTAS DEL CLIENTE
$routes->get('/', 'Home::index');;
$routes->get('principal', 'Home::index');;
$routes->get('quienes_somos', 'Home::quienes_somos');
$routes->get('comercializacion', 'Home::comercializacion');
$routes->get('informacion_de_contactos', 'Home::informacion_de_contactos');
$routes->get('terminos_y_usos', 'Home::terminos_y_usos');
$routes->get('catalogo', 'Home::catalogo');

// Carrito
$routes->get('carrito', 'Carrito_controller::ver_carrito');
$routes->post('carrito/agregar', 'Carrito_controller::agregar_producto');
$routes->get('carrito/vaciar', 'Carrito_controller::vaciar_carrito');
$routes->get('carrito/eliminar/(:any)', 'Carrito_controller::eliminar_producto/$1');
$routes->get('carrito/modificar/(:any)/(:any)', 'Carrito_controller::modificar_cantidad/$1/$2');
$routes->get('carrito/confirmar', 'Carrito_controller::guardar_venta');

$routes->get('mis-compras', 'Ventas_controller::lista_compras');

// Enviar una consulta 
$routes->post('crearConsulta', 'Consulta_controller::crear_consulta');

// Vista del perfil
$routes->get('perfil', 'Usuarios_controller::perfil_view');
