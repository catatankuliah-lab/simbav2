<?php

namespace Config\Routes;

$routes->group('/itkantorpusat', ['namespace' => 'App\Controllers\KantorPusat'], function ($routes) {
    $routes->get('', 'HomeController::index');
});
