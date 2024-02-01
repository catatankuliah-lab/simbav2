<?php

namespace Config\Routes;

$routes->group('api', ['namespace' => 'App\Controllers\API'], function ($routes) {

    // Login
    $routes->post('auth/proseslogin', 'Akun\AkunController::proseslogin');

        $routes->group('users', function ($routes) {
            $routes->get('/', 'UserController::index');
            $routes->get('(:num)', 'UserController::show/$1');
            $routes->post('/', 'UserController::create');
            $routes->put('(:num)', 'UserController::update/$1');
            $routes->delete('(:num)', 'UserController::delete/$1');
        });


























































































        // Loading Order
        $routes->group('lo', function ($routes) {
            $routes->get('/', 'LOJanuariController::index');
            $routes->get('(:num)', 'LOJanuariController::show/$1');
            $routes->post('/', 'LOJanuariController::create');
            $routes->put('(:num)', 'LOJanuariController::update/$1');
            $routes->delete('(:num)', 'LOJanuariController::delete/$1');

            $routes->get('/sessionya', 'LOJanuariController::getSession');

        });

});
