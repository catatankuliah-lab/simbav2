<?php

namespace Config\Routes;

$routes->group('/', ['namespace' => 'App\Controllers\Auth'], function ($routes) {
    $routes->get('', 'AuthController::index');
});
