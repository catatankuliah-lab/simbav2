<?php

namespace Config\Routes;

$routes->group('/bulog', ['namespace' => 'App\Controllers\Bulog'], function ($routes) {
    $routes->get('', 'HomeController::index');
});
