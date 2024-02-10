<?php

namespace Config\Routes;

$routes->group('/kantorcabang', ['namespace' => 'App\Controllers\KantorCabang'], function ($routes) {
    $routes->get('', 'HomeController::index');

    $routes->get('lo/1/detail/(:segment)', 'HomeController::detail_lo/$1');
    $routes->get('lo/1/generatelaporanwo/(:segment)', 'HomeController::generateLaporanwo/$1');
    $routes->get('lo/laporan/(:segment)/detail/(:segment)', 'HomeController::getwobykodewo/$1/$2');
    $routes->post('lo/1/downloadexcel/(:num)', 'HomeController::generateReport/$1');

    
});
