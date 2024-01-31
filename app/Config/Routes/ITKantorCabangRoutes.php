<?php

namespace Config\Routes;

$routes->group('/itkantorcabang', ['namespace' => 'App\Controllers\KantorCabang'], function ($routes) {
    $routes->get('', 'HomeController::index');
});
