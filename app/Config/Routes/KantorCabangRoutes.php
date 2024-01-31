<?php

namespace Config\Routes;

$routes->group('/kantorcabang', ['namespace' => 'App\Controllers\KantorCabang'], function ($routes) {
    $routes->get('', 'HomeController::index');
});
