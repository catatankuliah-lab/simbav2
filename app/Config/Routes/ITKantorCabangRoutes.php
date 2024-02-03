<?php

namespace Config\Routes;

$routes->group('/itkantorcabang', ['namespace' => 'App\Controllers\KantorCabang'], function ($routes) {
    $routes->get('', 'HomeController::index');
    $routes->get('lo', 'HomeController::index_lo');
    $routes->get('laporan', 'HomeController::index_laporan');
});
