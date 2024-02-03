<?php

namespace App\Controllers\Gudang;

use App\Models\GudangModel;
use CodeIgniter\Controller;

class GudangController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new GudangModel();
    }


    public function index_gudang()
    {
        $data = [
            'menu1' => 'selected',
            'menu2' => '',
        ];
        return view('gudang/dashboard/index', $data);
    }

    public function index_lo()
    {
        $data = [
            'menu1' => '',
            'menu2' => 'selected',
        ];
        return view('gudang/lo/index', $data);
    }

    public function create_lo()
    {
        $data = [
            'menu1' => '',
            'menu2' => 'selected',
        ];
        return view('gudang/lo/create', $data);
    }

    public function detail_lo($nomorspm)
    {

        $dataspm = $this->model->getSPMByNomorSPM($nomorspm, session()->get('id_akun'));

        $data = [
            'menu1' => '',
            'menu2' => 'selected',
            'nomorlo' => $dataspm[0]->nomor_spm,
        ];

        return view('gudang/lo/detail', $data);
    }
}
