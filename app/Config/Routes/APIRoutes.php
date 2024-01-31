<?php

namespace Config\Routes;

$routes->group('api', ['namespace' => 'App\Controllers\API'], function ($routes) {
    $routes->get('users', 'UserController::index');
    $routes->get('users/(:num)', 'UserController::show/$1');
    $routes->post('users', 'UserController::create');
    $routes->put('users/(:num)', 'UserController::update/$1');
    $routes->delete('users/(:num)', 'UserController::delete/$1');
});
