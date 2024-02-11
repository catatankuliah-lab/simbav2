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

    // Alokasi
    $routes->get('alokasi', 'Alokasi\AlokasiController::index');
    $routes->get('alokasi/(:num)', 'Alokasi\AlokasiController::show/$1');

    // Loading Order Routes
    $routes->get('lo/', 'LO\LOJanuariController::index');
    $routes->get('lo/(:num)', 'LO\LOJanuariController::show/$1');
    $routes->post('lo/', 'LO\LOJanuariController::create');
    $routes->put('lo/(:num)', 'LO\LOJanuariController::update/$1');
    $routes->delete('lo/(:num)', 'LO\LOJanuariController::delete/$1');
    $routes->get('lo/sessionya', 'LO\LOJanuariController::getSession');

    // ========================================= ROUTES AKUN KANTOR CABANG  ============================================ //

    // (MENU LOADING ORDER)

    // GET LOADING ORDER BY ID_KANTOR
    $routes->get('lo/1/getbyidkantor/(:num)', 'LO\LOJanuariController::getbyidkantor/$1');
    $routes->get('lo/2/getbyidkantor/(:num)', 'LO\LOFebruariController::getbyidkantor/$1');
    $routes->get('lo/3/getbyidkantor/(:num)', 'LO\LOMaretController::getbyidkantor/$1');
    $routes->get('lo/4/getbyidkantor/(:num)', 'LO\LOAprilController::getbyidkantor/$1');
    $routes->get('lo/5/getbyidkantor/(:num)', 'LO\LOMeiController::getbyidkantor/$1');
    $routes->get('lo/6/getbyidkantor/(:num)', 'LO\LOJuniController::getbyidkantor/$1');

    // SHOW DETAIL LO BY NOMOR LO 
    $routes->get('lo/1/detail/(:segment)', 'LO\LOJanuariController::showdetaillo/$1');
    $routes->get('lo/2/detail/(:segment)', 'LO\LOJanuariController::showdetaillo/$1');
    $routes->get('lo/3/detail/(:segment)', 'LO\LOJanuariController::showdetaillo/$1');
    $routes->get('lo/4/detail/(:segment)', 'LO\LOJanuariController::showdetaillo/$1');
    $routes->get('lo/5/detail/(:segment)', 'LO\LOJanuariController::showdetaillo/$1');
    $routes->get('lo/6/detail/(:segment)', 'LO\LOJanuariController::showdetaillo/$1');


    // SHOW DETAIL SURAT JALAN BY NOMOR ID_LO
    $routes->get('lo/1/detail/suratjalan/(:segment)', 'LO\LOJanuariController::showDetailSuratJalan/$1');
    $routes->get('lo/2/detail/suratjalan/(:segment)', 'LO\LOFebruariController::showDetailSuratJalan/$1');
    $routes->get('lo/3/detail/suratjalan/(:segment)', 'LO\LOMaretController::showDetailSuratJalan/$1');
    $routes->get('lo/4/detail/suratjalan/(:segment)', 'LO\LOAprilController::showDetailSuratJalan/$1');
    $routes->get('lo/5/detail/suratjalan/(:segment)', 'LO\LOMeiController::showDetailSuratJalan/$1');
    $routes->get('lo/6/detail/suratjalan/(:segment)', 'LO\LOJuniController::showDetailSuratJalan/$1');

    // GUDANG BY ID_KANTOR
    $routes->get('lo/1/gudangbykantor/(:segment)', 'LO\LOJanuariController::gudangbykantor/$1');
    $routes->get('lo/2/gudangbykantor/(:segment)', 'LO\LOFebruariController::gudangbykantor/$1');
    $routes->get('lo/3/gudangbykantor/(:segment)', 'LO\LOMaretController::gudangbykantor/$1');
    $routes->get('lo/4/gudangbykantor/(:segment)', 'LO\LOAprilController::gudangbykantor/$1');
    $routes->get('lo/5/gudangbykantor/(:segment)', 'LO\LOMeiController::gudangbykantor/$1');
    $routes->get('lo/6/gudangbykantor/(:segment)', 'LO\LOJuniController::gudangbykantor/$1');

    // KABUPATEN BY ID_KANTOR
    $routes->get('lo/1/namakabupatenkantor/(:segment)', 'LO\LOJanuariController::getKabupatenByIdKantor/$1');
    $routes->get('lo/2/namakabupatenkantor/(:segment)', 'LO\LOFebruariController::getKabupatenByIdKantor/$1');
    $routes->get('lo/3/namakabupatenkantor/(:segment)', 'LO\LOMaretController::getKabupatenByIdKantor/$1');
    $routes->get('lo/4/namakabupatenkantor/(:segment)', 'LO\LOAprilController::getKabupatenByIdKantor/$1');
    $routes->get('lo/5/namakabupatenkantor/(:segment)', 'LO\LOMeiController::getKabupatenByIdKantor/$1');
    $routes->get('lo/6/namakabupatenkantor/(:segment)', 'LO\LOJuniController::getKabupatenByIdKantor/$1');

    // KABUPATEN BY KECAMATAN
    $routes->get('lo/1/kabupatenkecamatankantor/(:segment)/(:segment)', 'LO\LOJanuariController::getKabupatenKecamatanByIdKantor/$1/$2');
    $routes->get('lo/2/kabupatenkecamatankantor/(:segment)/(:segment)', 'LO\LOFebruariController::getKabupatenKecamatanByIdKantor/$1/$2');
    $routes->get('lo/3/kabupatenkecamatankantor/(:segment)/(:segment)', 'LO\LOMaretController::getKabupatenKecamatanByIdKantor/$1/$2');
    $routes->get('lo/4/kabupatenkecamatankantor/(:segment)/(:segment)', 'LO\LOAprilController::getKabupatenKecamatanByIdKantor/$1/$2');
    $routes->get('lo/5/kabupatenkecamatankantor/(:segment)/(:segment)', 'LO\LOMeiController::getKabupatenKecamatanByIdKantor/$1/$2');
    $routes->get('lo/6/kabupatenkecamatankantor/(:segment)/(:segment)', 'LO\LOJuniController::getKabupatenKecamatanByIdKantor/$1/$2');


    // (MENU LAPORAN DOC)

    // GET WORKING ORDER BY ID_KANTOR
    $routes->get('lo/alokasi/1/awal/(:segment)/akhir/(:segment)', 'LO\LOJanuariController::getWoByIdKantor/$1/$2');
    $routes->get('lo/alokasi/2/awal/(:segment)/akhir/(:segment)', 'LO\LOFebruariController::getWoByIdKantor/$1/$2');
    $routes->get('lo/alokasi/3/awal/(:segment)/akhir/(:segment)', 'LO\LOMaretController::getWoByIdKantor/$1/$2');
    $routes->get('lo/alokasi/4/awal/(:segment)/akhir/(:segment)', 'LO\LOAprilController::getWoByIdKantor/$1/$2');
    $routes->get('lo/alokasi/5/awal/(:segment)/akhir/(:segment)', 'LO\LOMeiController::getWoByIdKantor/$1/$2');
    $routes->get('lo/alokasi/6/awal/(:segment)/akhir/(:segment)', 'LO\LOJuniController::getWoByIdKantor/$1/$2');

    // SHOW DETAIL WORKING ORDER BY KODE WO
    $routes->get('lo/1/laporan/detail/(:segment)', 'LO\LOJanuariController::getwobykodewo/$1');
    $routes->get('lo/2/laporan/detaillo/(:segment)', 'LO\LOFebruariController::getLoByNoLo/$1');
    $routes->get('lo/3/laporan/detaillo/(:segment)', 'LO\LOMaretController::getLoByNoLo/$1');
    $routes->get('lo/4/laporan/detaillo/(:segment)', 'LO\LOAprilController::getLoByNoLo/$1');
    $routes->get('lo/5/laporan/detaillo/(:segment)', 'LO\LOMeiController::getLoByNoLo/$1');
    $routes->get('lo/6/laporan/detaillo/(:segment)', 'LO\LOJuniController::getLoByNoLo/$1');

    // (PBP) KECAMATAN BY KABUPATEN
    $routes->get('pbp/1/getkecamatanbykabupaten/(:any)', 'PBP\PBPJanuariController::showByKabupatenKota/$1');
    $routes->get('pbp/2/getkecamatanbykabupaten/(:any)', 'PBP\PBPFebruariController::showByKabupatenKota/$1');
    $routes->get('pbp/3/getkecamatanbykabupaten/(:any)', 'PBP\PBPMaretController::showByKabupatenKota/$1');
    $routes->get('pbp/4/getkecamatanbykabupaten/(:any)', 'PBP\PBPAprilController::showByKabupatenKota/$1');
    $routes->get('pbp/5/getkecamatanbykabupaten/(:any)', 'PBP\PBPMeiController::showByKabupatenKota/$1');
    $routes->get('pbp/6/getkecamatanbykabupaten/(:any)', 'PBP\PBPJuniController::showByKabupatenKota/$1');

    // (PBP) DESA BY KECAMATAN
    $routes->get('pbp/1/getdesabykecamatan/(:any)', 'PBP\PBPJanuariController::showByDesa/$1');
    $routes->get('pbp/2/getdesabykecamatan/(:any)', 'PBP\PBPFebruariController::showByDesa/$1');
    $routes->get('pbp/3/getdesabykecamatan/(:any)', 'PBP\PBPMaretController::showByDesa/$1');
    $routes->get('pbp/4/getdesabykecamatan/(:any)', 'PBP\PBPAprilController::showByDesa/$1');
    $routes->get('pbp/5/getdesabykecamatan/(:any)', 'PBP\PBPMeiController::showByDesa/$1');
    $routes->get('pbp/6/getdesabykecamatan/(:any)', 'PBP\PBPJuniController::showByDesa/$1');

    // MENU DOWNLOAD DOC WORKING ORDER
    $routes->get('lo/1/downloadwo/(:segment)', 'LO\LOJanuariController::downloadWO/$1');
    $routes->get('lo/2/downloadwo/(:segment)', 'LO\LOJanuariController::downloadWO/$1');
    $routes->get('lo/3/downloadwo/(:segment)', 'LO\LOJanuariController::downloadWO/$1');
    $routes->get('lo/4/downloadwo/(:segment)', 'LO\LOJanuariController::downloadWO/$1');
    $routes->get('lo/5/downloadwo/(:segment)', 'LO\LOJanuariController::downloadWO/$1');
    $routes->get('lo/6/downloadwo/(:segment)', 'LO\LOJanuariController::downloadWO/$1');


    // ======================================= END ROUTES AKUN KANTOR CABANG  ============================================ //

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

    // CEK LO SESUAI ALOKASI NANA
    $routes->get('lo/1/bahannomorlo', 'LO\LOJanuariController::bahannomorlo');
    $routes->get('lo/2/bahannomorlo', 'LO\LOFebruariController::bahannomorlo');
    $routes->get('lo/3/bahannomorlo', 'LO\LOMaretController::bahannomorlo');
    $routes->get('lo/4/bahannomorlo', 'LO\LOAprilController::bahannomorlo');
    $routes->get('lo/5/bahannomorlo', 'LO\LOMeiController::bahannomorlo');
    $routes->get('lo/6/bahannomorlo', 'LO\LOJuniController::bahannomorlo');

    // SURAT JALAN CREATE
    $routes->post('suratjalan/1/create', 'SJ\SJJanuariController::create');
    $routes->post('suratjalan/2/create', 'SJ\SJFebruariController::create');
    $routes->post('suratjalan/3/create', 'SJ\SJMaretController::create');
    $routes->post('suratjalan/4/create', 'SJ\SJAprilController::create');
    $routes->post('suratjalan/5/create', 'SJ\SJMeiController::create');
    $routes->post('suratjalan/6/create', 'SJ\SJJuniController::create');

    // CEK LO SESUAI ALOKASI NANA
    $routes->get('lo/1/filter/(:segment)/(:segment)', 'LO\LOJanuariController::filter/$1/$2');
    $routes->get('lo/2/filter/(:segment)/(:segment)', 'LO\LOFebruariController::filter/$1/$2');
    $routes->get('lo/3/filter/(:segment)/(:segment)', 'LO\LOMaretController::filter/$1/$2');
    $routes->get('lo/4/filter/(:segment)/(:segment)', 'LO\LOAprilController::filter/$1/$2');
    $routes->get('lo/5/filter/(:segment)/(:segment)', 'LO\LOMeiController::filter/$1/$2');
    $routes->get('lo/6/filter/(:segment)/(:segment)', 'LO\LOJuniController::filter/$1/$2');

    // CEK LO SESUAI ALOKASI NANA
    $routes->get('lo/1/ceknomorlosubmit', 'LO\LOJanuariController::ceknomorlosubmit');
    $routes->get('lo/2/ceknomorlosubmit', 'LO\LOFebruariController::ceknomorlosubmit');
    $routes->get('lo/3/ceknomorlosubmit', 'LO\LOMaretController::ceknomorlosubmit');
    $routes->get('lo/4/ceknomorlosubmit', 'LO\LOAprilController::ceknomorlosubmit');
    $routes->get('lo/5/ceknomorlosubmit', 'LO\LOMeiController::ceknomorlosubmit');
    $routes->get('lo/6/ceknomorlosubmit', 'LO\LOJuniController::ceknomorlosubmit');

    // LO BY NOMOR LO
    $routes->get('lo/detail/1/(:segment)', 'LO\LOJanuariController::detaillo/$1');
    $routes->get('lo/detail/2/(:segment)', 'LO\LOFebruariController::detaillo/$1');
    $routes->get('lo/detail/3/(:segment)', 'LO\LOMaretController::detaillo/$1');
    $routes->get('lo/detail/4/(:segment)', 'LO\LOAprilController::detaillo/$1');
    $routes->get('lo/detail/5/(:segment)', 'LO\LOMeiController::detaillo/$1');
    $routes->get('lo/detail/6/(:segment)', 'LO\LOJuniController::detaillo/$1');

    // UPLOAD FILE
    $routes->post('lo/1/uploadfile/(:segment)', 'LO\LOJanuariController::uploadfile/$1');
    $routes->post('lo/2/uploadfile/(:segment)', 'LO\LOFebruariController::uploadfile/$1');
    $routes->post('lo/3/uploadfile/(:segment)', 'LO\LOMaretController::uploadfile/$1');
    $routes->post('lo/4/uploadfile/(:segment)', 'LO\LOAprilController::uploadfile/$1');
    $routes->post('lo/5/uploadfile/(:segment)', 'LO\LOMeiController::uploadfile/$1');
    $routes->post('lo/6/uploadfile/(:segment)', 'LO\LOJuniController::uploadfile/$1');

    // SURAT JALAN DETAIL SJ NANA
    $routes->get('sj/detailitemsj/1/(:segment)', 'SJ\SJJanuariController::detailitemsj/$1');
    $routes->get('sj/detailitemsj/2/(:segment)', 'SJ\SJFebruariController::detailitemsj/$1');
    $routes->get('sj/detailitemsj/3/(:segment)', 'SJ\SJMaretController::detailitemsj/$1');
    $routes->get('sj/detailitemsj/4/(:segment)', 'SJ\SJAprilController::detailitemsj/$1');
    $routes->get('sj/detailitemsj/5/(:segment)', 'SJ\SJMeiController::detailitemsj/$1');
    $routes->get('sj/detailitemsj/6/(:segment)', 'SJ\SJJuniController::detailitemsj/$1');

    // SURAT JALAN UPLOAD FILE SJ NANA
    $routes->post('sj/1/uploadfile/(:segment)', 'SJ\SJJanuariController::uploadfile/$1');
    $routes->post('sj/2/uploadfile/(:segment)', 'SJ\SJFebruariController::uploadfile/$1');
    $routes->post('sj/3/uploadfile/(:segment)', 'SJ\SJMaretController::uploadfile/$1');
    $routes->post('sj/4/uploadfile/(:segment)', 'SJ\SJAprilController::uploadfile/$1');
    $routes->post('sj/5/uploadfile/(:segment)', 'SJ\SJMeiController::uploadfile/$1');
    $routes->post('sj/6/uploadfile/(:segment)', 'SJ\SJJuniController::uploadfile/$1');

    // DASHBOARD KANTOR CABANG
    $routes->get('pbp/1/(:segment)', 'PBP\PBPJanuariController::bahandashboardkc/$1');
    $routes->get('pbp/2/(:segment)', 'PBP\PBPFebruariController::bahandashboardkc/$1');
    $routes->get('pbp/3/(:segment)', 'PBP\PBPMaretController::bahandashboardkc/$1');
    $routes->get('pbp/4/(:segment)', 'PBP\PBPAprilController::bahandashboardkc/$1');
    $routes->get('pbp/5/(:segment)', 'PBP\PBPMeiController::bahandashboardkc/$1');
    $routes->get('pbp/6/(:segment)', 'PBP\PBPJuniController::bahandashboardkc/$1');
});
