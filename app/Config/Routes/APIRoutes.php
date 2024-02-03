<?php

namespace Config\Routes;

$routes->group('api', ['namespace' => 'App\Controllers\API'], function ($routes) {

    $routes->post('auth/proseslogin', 'Akun\AkunController::proseslogin');

    $routes->group('users', function ($routes) {
        $routes->get('users', 'UserController::index');
        $routes->get('(:num)', 'UserController::show/$1');
        $routes->post('/', 'UserController::create');
        $routes->put('(:num)', 'UserController::update/$1');
        $routes->delete('(:num)', 'UserController::delete/$1');
    });

    // Loading Order Routes
    $routes->get('lo/', 'LO\LOJanuariController::index');
    $routes->get('lo/(:num)', 'LO\LOJanuariController::show/$1');
    $routes->post('lo/', 'LO\LOJanuariController::create');
    $routes->put('lo/(:num)', 'LO\LOJanuariController::update/$1');
    $routes->delete('lo/(:num)', 'LO\LOJanuariController::delete/$1');
    $routes->get('lo/sessionya', 'LO\LOJanuariController::getSession');
    $routes->get('lo/getbyidkantor/(:num)', 'LO\LOJanuariController::getbyidkantor/$1');
    $routes->get('lo/namagudangkantor/(:any)', 'LO\LOJanuariController::getGudangByIdKantor/$1');
    $routes->get('lo/namakabupatenkantor/(:any)', 'LO\LOJanuariController::getKabupatenByIdKantor/$1');
    $routes->get('lo/kabupatenkecamatankantor/(:any)/(:any)', 'LO\LOJanuariController::getKabupatenKecamatanByIdKantor/$1/$2');

    // Detail LO
    $routes->get('lo/detail/(:any)', 'LO\LOJanuariController::showDetailLo/$1');

    // Alokasi
    $routes->get('alokasi', 'Alokasi\AlokasiController::index');
    $routes->get('alokasi/(:num)', 'Alokasi\AlokasiController::show/$1');

    // Gudang
    $routes->get('gudang', 'Gudang\GudangController::index');
    $routes->get('gudang/(:num)', 'Gudang\GudangController::show/$1');
    $routes->get('gudang/kantor/(:num)', 'Gudang\GudangController::showbykantor/$1');
    $routes->post('gudang', 'Gudang\GudangController::create');
    $routes->put('gudang/(:num)', 'Gudang\GudangController::update/$1');
    $routes->delete('gudang/(:num)', 'Gudang\GudangController::delete/$1');

    // Wilayah Kerja
    $routes->get('wilayahkerja/(:num)', 'WilayahKerja\WilayahKerjaController::getWilayahKerjaByIdKantor/$1');














    // LO NANA
    $routes->get('lo/1/dashboard', 'LO\LOJanuariController::dashboard');
    // $routes->get('lo/2/dasshboard/februari', 'LO\LOJanuariController::index');
    // $routes->get('lo/dasshboard/maret', 'LO\LOJanuariController::index');
    // $routes->get('lo/dasshboard/april', 'LO\LOJanuariController::index');
    // $routes->get('lo/dasshboard/mei', 'LO\LOJanuariController::index');
    // $routes->get('lo/dasshboard/juni', 'LO\LOJanuariController::index');
});
