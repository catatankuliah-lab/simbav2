<?php

namespace Config\Routes;

$routes->group('/kantorcabang', ['namespace' => 'App\Controllers\KantorCabang'], function ($routes) {
    $routes->get('', 'HomeController::index');
    $routes->get('lo/detail/(:any)', 'HomeController::detail_lo/$1');
    $routes->get('lo/suratjalan/(:num)', 'HomeController::detail_suratjalan/$1');
});