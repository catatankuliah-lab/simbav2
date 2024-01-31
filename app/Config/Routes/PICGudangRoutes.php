<?php

namespace Config\Routes;

$routes->group('/picgudang', ['namespace' => 'App\Controllers\Gudang'], function ($routes) {
    $routes->get('', 'HomeController::index');
});
