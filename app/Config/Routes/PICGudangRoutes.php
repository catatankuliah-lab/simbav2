<?php

namespace Config\Routes;

$routes->group('/gudang', ['namespace' => 'App\Controllers\Gudang'], function ($routes) {
    $routes->get('', 'GudangController::index_gudang');
    $routes->get('lo', 'GudangController::index_lo');
});
