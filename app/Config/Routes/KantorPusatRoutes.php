<?php

namespace Config\Routes;

$routes->group('/kantorpusat', ['namespace' => 'App\Controllers\KantorPusat'], function ($routes) {
    $routes->get('', 'HomeController::index');
});
