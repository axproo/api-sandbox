<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');

/**
 * @var RouteCollection $routes Login & Logout
 */
$routes->get('login', 'Auth\Login::index');
$routes->post('login', 'Auth\Login::signin');
$routes->get('verify', 'Auth\Login::verify');
$routes->get('me', 'Auth\Login::me');
$routes->post('logout', 'Auth\Login::logout');

/**
 * @var RouteCollection $routes OTP
 */
$routes->post('generate', 'Auth\Otp::generate');
$routes->get('code', 'Auth\Otp::code');
$routes->post('otp-check', 'Auth\Otp::check');
$routes->post('otp-resend', 'Auth\Otp::resend');

/**
 * @var RouteCollection $routes Groupe UI
 */
$routes->group('ui', function ($routes) {
    $routes->get('buttons', 'Ui\Buttons::index');
    $routes->get('alerts', 'Ui\Alerts::index');
    $routes->get('services', 'Ui\Services::index');
});

/**
 * @var RouteCollection $routes MSP
 */
$routes->group('msp', function ($routes) {
    $routes->get('panel', 'Msp::index');
});

/**
 * @var RouteCollection $routes Customers
 */
$routes->group('client', function ($routes) {
    $routes->get('account', 'Client\Account::index');
});

// Gérer toutes les requêtes OPTIONS pour CORS
$routes->options('(:any)', function () {
    $response = service('response');
    $origin = service('request')->getServer('HTTP_ORIGIN');

    $allowedOrigins = [
        'http://localhost:5173',
        'https://dashboard.axproo.fr',
    ];

    if ($origin && in_array($origin, $allowedOrigins)) {
        $response->setHeader('Access-Control-Allow-Origin', $origin);
    }

    $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE, PATCH');
    $response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, X-API-KEY');
    $response->setHeader('Access-Control-Allow-Credentials', 'true');
    $response->setStatusCode(200);

    return $response;
});


