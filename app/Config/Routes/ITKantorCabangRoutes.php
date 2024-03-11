<?php

namespace Config\Routes;

$routes->group('/itkantorcabang', ['namespace' => 'App\Controllers\KantorCabang'], function ($routes) {
    $routes->get('', 'HomeController::index');
    $routes->get('lo', 'HomeController::index_lo');
    $routes->get('laporan', 'HomeController::index_laporan');

    // Menu Loading Order
    $routes->get('lo/1/detail/(:segment)', 'HomeController::detail_lo/$1');
    $routes->get('lo/1/detail/suratjalan/(:segment)', 'HomeController::detailsuratjalan/$1');
    $routes->post('lo/1/downloadexcel/(:num)', 'HomeController::generateReport/$1');
    $routes->post('lo/2/downloadexcel/(:num)', 'HomeController::generateReportFebruari/$1');

    // Menu Laporan Doc
    $routes->get('lo/1/generatelaporanwo/(:segment)', 'HomeController::generateLaporanwo/$1');
    $routes->get('lo/laporan/(:segment)/detail/(:segment)', 'HomeController::getwobykodewo/$1/$2');

    // cek bikin laporan
    $routes->get('wo/1/downloadwo/(:segment)', 'HomeController::downloadwo1/$1');
    $routes->get('wo/2/downloadwo/(:segment)', 'HomeController::downloadwo2/$1');
    $routes->get('wo/3/downloadwo/(:segment)', 'HomeController::downloadwo3/$1');
    $routes->get('wo/4/downloadwo/(:segment)', 'HomeController::downloadwo4/$1');
    $routes->get('wo/5/downloadwo/(:segment)', 'HomeController::downloadwo5/$1');
    $routes->get('wo/6/downloadwo/(:segment)', 'HomeController::downloadwo6/$1');
});
