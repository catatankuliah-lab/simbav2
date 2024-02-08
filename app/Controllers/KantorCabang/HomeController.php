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
            'menu2' => 'selected',
            'menu3' => '',
            'menu4' => '',
            'nomorwo' => $datawo[0]->nomor_wo,
        ];
        return view('kantorcabang/laporan/detail', $data);
    }

    public function generateLaporanwo($nomorwo)
    {
        $data = $this->woJanuari->woPDF($nomorwo);

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('PT Delapan Delapan Logistics');
        $pdf->SetAuthor('PT Delapan Delapan Logistics');
        $pdf->SetTitle('LAPORAN PENYERAHAN-' . $data[0]->nomor_wo);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pathhasil = $data[0]->path_wo;
        $pdf->AddPage('P', 'A4');
        $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $pathhasil . DIRECTORY_SEPARATOR . $data[0]->file_wo;
        $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());
        foreach ($data as $row) {
            $pdf->AddPage('P', 'A4');
            $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $row->path_wo . DIRECTORY_SEPARATOR . $row->file_dokumen_muat;
            $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());

            $pdf->AddPage('P', 'A4');
            $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $row->path_wo . DIRECTORY_SEPARATOR . $row->file_surat_jalan;
            $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());
        }
        if (!file_exists($pathhasil)) {
            mkdir($pathhasil, 0777, true);
        }
        $filePath = FCPATH . DIRECTORY_SEPARATOR . $pathhasil . DIRECTORY_SEPARATOR . ' LAPORAN-WO-' . $data[0]->nomor_wo . '.pdf';
        // Compress File
        $pdf->SetCompression(true);
        // Save the PDF to the specified directory
        $pdf->Output($filePath, 'F');
        $pdf->Output($filePath, 'D');
    }
}
