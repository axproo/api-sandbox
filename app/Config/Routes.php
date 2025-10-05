<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');

$routes->get('login', 'Auth\Login::index');
$routes->post('login', 'Auth\Login::signin');
$routes->get('verify', 'Auth\Login::verify');
$routes->post('generate', 'Auth\Otp::generate');
$routes->get('code', 'Auth\Otp::code');

$routes->group('account', function ($routes) {
    // $routes->get('verify', 'Account::verify');
});

