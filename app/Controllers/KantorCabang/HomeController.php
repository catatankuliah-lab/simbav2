<?php

namespace App\Controllers\KantorCabang;

use CodeIgniter\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'menu1' => 'selected',
            'menu2' => '',
            'menu3' => '',
            'menu4' => '',
        ];
        return view('kantorcabang/dashboard/index', $data);
    }

    public function index_lo()
    {
        session()->set('id_akun', '6');
        session()->set('kode_provinsi', '32');
        $data = [
            'menu1' => '',
            'menu2' => 'selected',
            'menu3' => '',
            'menu4' => '',
        ];
        return view('kantorcabang/lo/index', $data);
    }

    public function index_laporan()
    {
        $data = [
            'menu1' => '',
            'menu2' => '',
            'menu3' => 'selected',
            'menu4' => '',
        ];
        return view('kantorcabang/laporan/index', $data);
    }
}
