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
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('PT Delapan Delapan Logistics');
        $pdf->SetAuthor('PT Delapan Delapan Logistics');
        $pdf->SetTitle('LAPORAN PENYERAHAN-' . "CEK");
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage(); // Page Untuk Dokumen Work Order
        $imagePath = FCPATH . 'assets/img/contohWO.png';
        $pdf->Image($imagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight()); // x, y, widht. height

        $pdf->AddPage(); // Page Untuk Dokumen Rekapitulasi
        $imagePath = FCPATH . 'assets/img/contohRekapitulasi.png';
        $pdf->Image($imagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight()); // x, y, widht. height

        $pdf->AddPage(); // Page Untuk Dokumen Loading Order
        $imagePath = FCPATH . 'assets/img/lo.jpg';
        $pdf->Image($imagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight()); // x, y, widht. height

        $pdf->AddPage(); // Page Untuk Dokumen LO Surat Jalan
        $imagePath = FCPATH . 'assets/img/losj.jpg';
        $pdf->Image($imagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight()); // x, y, widht. height

        $pdf->AddPage(); // Page Untuk Dokumen DO (Drop Out)
        $imagePath = FCPATH . 'assets/img/do.jpg';
        $pdf->Image($imagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight()); // x, y, widht. height
        // Simpan PDF ke file di server
        $filePath = FCPATH . 'LAPORAN-CEK.pdf';
        $pdf->Output($filePath, 'F');
        $pdf->Output($filePath, 'D');
    }
}
