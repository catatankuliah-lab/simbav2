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

    // Loading Order (Panji)
    $routes->get('lo/1/sessionya', 'LO\LOJanuariController::getSession');
    $routes->get('lo/getbyidkantor/(:num)', 'LO\LOJanuariController::getbyidkantor/$1');
    $routes->get('lo/namagudangkantor/(:any)', 'LO\LOJanuariController::getGudangByIdKantor/$1');
    $routes->get('lo/namakabupatenkantor/(:any)', 'LO\LOJanuariController::getKabupatenByIdKantor/$1');
    $routes->get('lo/kabupatenkecamatankantor/(:any)/(:any)', 'LO\LOJanuariController::getKabupatenKecamatanByIdKantor/$1/$2');
    $routes->get('lo/detail/(:any)', 'LO\LOJanuariController::showDetailLo/$1');


    // Alokasi (Panji)
    $routes->get('alokasi', 'Alokasi\AlokasiController::index');
    $routes->get('alokasi/(:num)', 'Alokasi\AlokasiController::show/$1');

    // Gudang (Panji)
    $routes->get('gudang', 'Gudang\GudangController::index');
    $routes->get('gudang/(:num)', 'Gudang\GudangController::show/$1');
    $routes->get('gudang/kantor/(:num)', 'Gudang\GudangController::showbykantor/$1');
    $routes->post('gudang', 'Gudang\GudangController::create');
    $routes->put('gudang/(:num)', 'Gudang\GudangController::update/$1');
    $routes->delete('gudang/(:num)', 'Gudang\GudangController::delete/$1');

    // Wilayah Kerja (Panji)
    $routes->get('wilayahkerja/(:num)', 'WilayahKerja\WilayahKerjaController::getWilayahKerjaByIdKantor/$1');

    // WO Januari (Panji)
    $routes->get('wo/getwobyidkantor/(:any)', 'WOJanuari\WOJanuariController::getWoByIdKantor/$1');
    $routes->get('wo/getalldatawo/(:any)', 'WOJanuari\WOJanuariController::showDetailWo/$1');
    $routes->get('wo/alokasi/1/awal/(:segment)/akhir/(:segment)', 'WOJanuari\WOJanuariController::getAlokasiFilter/$1/$2');
    $routes->get('wo/1/detailwo/(:any)', 'WOJanuari\WOJanuariController::getDetailWO/$1');

    // PBP Januari
    $routes->get('pbp/getkecamatanbykabupaten/(:any)', 'PBP\PBPJanuariController::showByKabupatenKota/$1');
    $routes->get('pbp/getdesabykecamatan/(:any)', 'PBP\PBPJanuariController::showByDesa/$1');

    // LO NANA
    $routes->get('lo/1/dashboard', 'LO\LOJanuariController::dashboard');
    $routes->get('lo/2/dasshboard', 'LO\LOFebruariController::index');
    $routes->get('lo/3/dasshboard', 'LO\LOMaretController::index');
    $routes->get('lo/4/dasshboard', 'LO\LOAprilController::index');
    $routes->get('lo/5/dasshboard', 'LO\LOMeiController::index');
    $routes->get('lo/6/dasshboard', 'LO\LOJuniController::index');

    // CEK LO SESUAI ALOKASI NANA
    $routes->get('lo/1/ceknomorlo', 'LO\LOJanuariController::ceknomorlo');
    $routes->get('lo/2/ceknomorlo', 'LO\LOFebruariController::ceknomorlo');
    $routes->get('lo/3/ceknomorlo', 'LO\LOMaretController::ceknomorlo');
    $routes->get('lo/4/ceknomorlo', 'LO\LOAprilController::ceknomorlo');
    $routes->get('lo/5/ceknomorlo', 'LO\LOMeiController::ceknomorlo');
    $routes->get('lo/6/ceknomorlo', 'LO\LOJuniController::ceknomorlo');

    // CEK LO SESUAI ALOKASI NANA
    $routes->post('lo/1/create', 'LO\LOJanuariController::create');
    $routes->get('lo/2/create', 'LO\LOFebruariController::create');
    $routes->get('lo/3/create', 'LO\LOMaretController::create');
    $routes->get('lo/4/create', 'LO\LOAprilController::create');
    $routes->get('lo/5/create', 'LO\LOMeiController::create');
    $routes->get('lo/6/create', 'LO\LOJuniController::create');

    // PBP SELECT KECAMATAN BY KABUPATEN KOTA NANA
    $routes->get('pbp/1/kecamatanbykabupaten/(:segment)', 'PBP\PBPJanuariController::kecamatanbykabupaten/$1');
    $routes->get('pbp/2/kecamatanbykabupaten/(:segment)', 'PBP\PBPFebruariController::kecamatanbykabupaten/$1');
    $routes->get('pbp/3/kecamatanbykabupaten/(:segment)', 'PBP\PBPMaretController::kecamatanbykabupaten/$1');
    $routes->get('pbp/4/kecamatanbykabupaten/(:segment)', 'PBP\PBPAprilController::kecamatanbykabupaten/$1');
    $routes->get('pbp/5/kecamatanbykabupaten/(:segment)', 'PBP\PBPMeiController::kecamatanbykabupaten/$1');
    $routes->get('pbp/6/kecamatanbykabupaten/(:segment)', 'PBP\PBPJuniController::kecamatanbykabupaten/$1');

    // PBP SELECT DESA BY KECAMATAN KOTA NANA
    $routes->get('pbp/1/desabykecamatan/(:segment)', 'PBP\PBPJanuariController::desabykecamatan/$1');
    $routes->get('pbp/2/desabykecamatan/(:segment)', 'PBP\PBPFebruariController::desabykecamatan/$1');
    $routes->get('pbp/3/desabykecamatan/(:segment)', 'PBP\PBPMaretController::desabykecamatan/$1');
    $routes->get('pbp/4/desabykecamatan/(:segment)', 'PBP\PBPAprilController::desabykecamatan/$1');
    $routes->get('pbp/5/desabykecamatan/(:segment)', 'PBP\PBPMeiController::desabykecamatan/$1');
    $routes->get('pbp/6/desabykecamatan/(:segment)', 'PBP\PBPJuniController::desabykecamatan/$1');

    // SURAT JALAN CEK NOMOR SJ
    $routes->get('suratjalan/1/ceknomorsj/(:segment)', 'SJ\SJJanuariController::ceknomorsj/$1');
    $routes->get('suratjalan/2/ceknomorsj/(:segment)', 'SJ\SJFebruariController::ceknomorsj/$1');
    $routes->get('suratjalan/3/ceknomorsj/(:segment)', 'SJ\SJMaretController::ceknomorsj/$1');
    $routes->get('suratjalan/4/ceknomorsj/(:segment)', 'SJ\SJAprilController::ceknomorsj/$1');
    $routes->get('suratjalan/5/ceknomorsj/(:segment)', 'SJ\SJMeiController::ceknomorsj/$1');
    $routes->get('suratjalan/6/ceknomorsj/(:segment)', 'SJ\SJJuniController::ceknomorsj/$1');

    // SURAT JALAN GET DATA SJ
    $routes->get('suratjalan/1/datasj/(:segment)', 'SJ\SJJanuariController::datasj/$1');
    $routes->get('suratjalan/2/datasj/(:segment)', 'SJ\SJFebruariController::datasj/$1');
    $routes->get('suratjalan/3/datasj/(:segment)', 'SJ\SJMaretController::datasj/$1');
    $routes->get('suratjalan/4/datasj/(:segment)', 'SJ\SJAprilController::datasj/$1');
    $routes->get('suratjalan/5/datasj/(:segment)', 'SJ\SJMeiController::datasj/$1');
    $routes->get('suratjalan/6/datasj/(:segment)', 'SJ\SJJuniController::datasj/$1');

    // SURAT JALAN HAPUS BY NOMOR SJ
    $routes->post('suratjalan/1/delete', 'SJ\SJJanuariController::deletesj');
    $routes->post('suratjalan/2/delete', 'SJ\SJFebruariController::deletesj');
    $routes->post('suratjalan/3/delete', 'SJ\SJMaretController::deletesj');
    $routes->post('suratjalan/4/delete', 'SJ\SJAprilController::deletesj');
    $routes->post('suratjalan/5/delete', 'SJ\SJMeiController::deletesj');
    $routes->post('suratjalan/6/delete', 'SJ\SJJuniController::deletesj');

    // LO CEK NOMOR LO
    $routes->get('lo/1/ceknomorlo/(:segment)', 'LO\LOJanuariController::ceknomorlo/$1');
    $routes->get('lo/2/ceknomorlo/(:segment)', 'LO\LOFebruariController::ceknomorlo/$1');
    $routes->get('lo/3/ceknomorlo/(:segment)', 'LO\LOMaretController::ceknomorlo/$1');
    $routes->get('lo/4/ceknomorlo/(:segment)', 'LO\LOAprilController::ceknomorlo/$1');
    $routes->get('lo/5/ceknomorlo/(:segment)', 'LO\LOMeiController::ceknomorlo/$1');
    $routes->get('lo/6/ceknomorlo/(:segment)', 'LO\LOJuniController::ceknomorlo/$1');

    // CEK LO SESUAI ALOKASI NANA
    $routes->delete('lo/1/deletelo/(:segment)', 'LO\LOJanuariController::deletelo/$1');
    $routes->delete('lo/2/deletelo/(:segment)', 'LO\LOFebruariController::deletelo/$1');
    $routes->delete('lo/3/deletelo/(:segment)', 'LO\LOMaretController::deletelo/$1');
    $routes->delete('lo/4/deletelo/(:segment)', 'LO\LOAprilController::deletelo/$1');
    $routes->delete('lo/5/deletelo/(:segment)', 'LO\LOMeiController::deletelo/$1');
    $routes->delete('lo/6/deletelo/(:segment)', 'LO\LOJuniController::deletelo/$1');

    // SURAT JALAN CREATE
    $routes->post('suratjalan/1/create', 'SJ\SJJanuariController::create');
    $routes->post('suratjalan/2/create', 'SJ\SJFebruariController::create');
    $routes->post('suratjalan/3/create', 'SJ\SJMaretController::create');
    $routes->post('suratjalan/4/create', 'SJ\SJAprilController::create');
    $routes->post('suratjalan/5/create', 'SJ\SJMeiController::create');
    $routes->post('suratjalan/6/create', 'SJ\SJJuniController::create');
});
