<?php

namespace Config\Routes;

$routes->group('/posind', ['namespace' => 'App\Controllers\POSIND'], function ($routes) {
    $routes->get('', 'HomeController::index');
});
