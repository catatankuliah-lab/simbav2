<?php

namespace Config\Routes;

$routes->group('/kantorcabang', ['namespace' => 'App\Controllers\KantorCabang'], function ($routes) {
    $routes->get('', 'HomeController::index');
    $routes->get('lo/1/detail/(:any)', 'HomeController::detail_lo/$1');
    $routes->get('lo/suratjalan/(:num)', 'HomeController::detail_suratjalan/$1');
    $routes->post('lo/1/downloadexcel/(:num)', 'HomeController::generateReport/$1');

    $routes->get('wo/1/getdetailwo/(:any)', 'HomeController::detail_wo/$1');
    $routes->get('wo/1/generatelaporanwo/(:any)', 'HomeController::generateLaporanwo/$1');

});
