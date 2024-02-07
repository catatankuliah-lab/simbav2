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

    public function detail_suratjalan($id_dokumen_muat)
    {

        $datalo = $this->muatJanuari->getDetailSuratJalan($id_dokumen_muat);
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

    public function generateLaporanwo($nomorwo)
    {
        // $datawo = $this->woJanuari->getWOyNomorWO($nomorwo);
        $pdf = new TCPDF();
        $pdf->SetCreator('PT Delapan Delapan Logistics');
        $pdf->SetAuthor('PT Delapan Delapan Logistics');
        $pdf->SetTitle('LAPORAN PENYERAHAN-' . "CEK");
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage('P', 'A4');
        $filePath = FCPATH . DIRECTORY_SEPARATOR . 'LAPORAN-' . "CEK" . '.pdf';
        // Compress File
        $pdf->SetCompression(true);
        // Save the PDF to the specified directory
        $pdf->Output($filePath, 'F');
        $pdf->Output($filePath, 'D');
    }
}
