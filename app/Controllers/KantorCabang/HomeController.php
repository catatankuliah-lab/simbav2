<?php

namespace App\Controllers\KantorCabang;

use App\Models\LOJanuariModel;
use CodeIgniter\Controller;

class HomeController extends Controller
{

    protected $muatJanuari;

    public function __construct()
    {
        $this->muatJanuari = new LOJanuariModel();
    }

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

    public function detail_lo($nomorlo)
    {

        $datalo = $this->muatJanuari->getDokumenMuatByNomorLo($nomorlo, session()->get('id_kantor'));
        $data = [
            'menu1' => '',
            'menu2' => 'selected',
            'menu3' => '',
            'menu4' => '',
            'nomorlo' => $datalo[0]->nomor_lo,
        ];

        return view('kantorcabang/lo/detail', $data);
    }

    public function detail_suratjalan($id_dokumen_muat)
    {

        $datalo = $this->muatJanuari->getDetailSuratJalan($id_dokumen_muat, session()->get('id_kantor'));
        $data = [
            'menu1' => '',
            'menu2' => 'selected',
            'menu3' => '',
            'menu4' => '',
            'nomorlo' => $datalo[0]->nomor_lo,
            'idspmbast' => $datalo[0]->id_dokumen_muat,
        ];

        return view('kantorcabang/spmbast/detailsuratjalan', $data);
    }
}