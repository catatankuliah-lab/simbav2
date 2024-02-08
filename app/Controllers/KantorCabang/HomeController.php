<?php

namespace App\Controllers\KantorCabang;

use App\Models\LOJanuariModel;
use App\Models\WOJanuariModel;
use CodeIgniter\Controller;
use TCPDF;


class HomeController extends Controller
{

    protected $muatJanuari;
    protected $woJanuari;

    public function __construct()
    {
        $this->muatJanuari = new LOJanuariModel();
        $this->woJanuari = new WOJanuariModel();
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

        $datalo = $this->muatJanuari->getDokumenMuatByNomorLo($nomorlo);
        $data = [
            'menu1' => '',
            'menu2' => 'selected',
            'menu3' => '',
            'menu4' => '',
            'nomorlo' => $datalo[0]->nomor_lo,
        ];

        return view('kantorcabang/lo/detail', $data);
    }

    public function detail_wo($nomorwo)
    {
        $datawo = $this->woJanuari->showDetailWO($nomorwo);
        $data = [
            'menu1' => '',
            'menu2' => '',
            'menu3' => 'selected',
            'menu4' => '',
            'nomorwo' => $datawo[0]->nomor_wo,
        ];
        return view('kantorcabang/laporan/detail', $data);
    }

    public function generateLaporanwo($nomorwo)
    {
        $dataWO = $this->woJanuari->laporanWO($nomorwo);
        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);
        foreach ($dataWO as $wo) {
            $pdf->Cell(0, 10, 'Nomor WO: ' . $wo->nomor_wo, 0, true, 'L');
            // ...
        }
        $pdf->Output('laporan_wo.pdf', 'D'); // Download PDF
    }

}
