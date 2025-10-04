<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');
// $routes->get('login', 'Auth/login::index');

// $routes->group('', ['hostname' => '(:segment).axproo.fr'], function($routes) {
//     // Routes statiques communes

// });
