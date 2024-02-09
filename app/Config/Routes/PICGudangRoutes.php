<?php

namespace Config\Routes;

$routes->group('/gudang', ['namespace' => 'App\Controllers\Gudang'], function ($routes) {
    $routes->get('', 'GudangController::index_gudang');
    $routes->get('lo', 'GudangController::index_lo');
    $routes->get('lo/create', 'GudangController::create_lo');
    $routes->get('lo/detail/(:segment)', 'GudangController::detail_lo/$1');

    $routes->get('lo/downloadPDFLO/1/(:segment)', 'GudangController::downloadPDFLOJanuari/$1');
    $routes->get('lo/downloadPDFLO/2/(:segment)', 'GudangController::downloadPDFLOFebruari/$1');
    $routes->get('lo/downloadPDFLO/3/(:segment)', 'GudangController::downloadPDFLOMaret/$1');
    $routes->get('lo/downloadPDFLO/4/(:segment)', 'GudangController::downloadPDFLOApril/$1');
    $routes->get('lo/downloadPDFLO/5/(:segment)', 'GudangController::downloadPDFLOMei/$1');
    $routes->get('lo/downloadPDFLO/6/(:segment)', 'GudangController::downloadPDFLOJuni/$1');
});
