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

    //======================================================================================================//
    // 1. WO dimabil dari table januari_wo dengan mengambil nilai gambar,                                   //
    // 2. Penyaluran diambil dari data table januari_wo dan januari_sj dengan mengambil data gambar         //
    // 3.Rekap Harian diambil dari data Januari_lo untuk membuat data excel dari database                   //
    // 4. Surat Loading Order dan Surat Jalan diambil dari table Januari_Sj                                 //
    // 5. Nomor DO dan Surat Jalan dari Bulog dan mengambil data gambar                                     //
    //======================================================================================================//

    public function generateLaporanwo($nomorwo)
    {
        $datawo = $this->woJanuari->getWOyNomorWO($nomorwo);
        $pdf = new TCPDF();
        $pdf->SetCreator('PT Delapan Delapan Logistics');
        $pdf->SetAuthor('PT Delapan Delapan Logistics');
        $pdf->SetTitle('LAPORAN PENYERAHAN-' . $datawo[0]->nomor_wo);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pathhasil = $datawo[0]->path_wo;
        $pdf->AddPage('P', 'A4');
        $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $pathhasil . DIRECTORY_SEPARATOR . $datawo[0]->file_wo;
        $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());
        foreach ($datawo as $row) {
            $pdf->AddPage('P', 'A4');
            $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $row->path_lo . DIRECTORY_SEPARATOR . $row->file_surat_jalan;
            $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());

            $pdf->SetFont('poppins', '', 10);
            $pdf->SetXY(10, 50);
            $pdf->MultiCell(0, 10, 'MAS ANIS MAS ANIS MAASS ANIS.', 0, 'L');
        }
        if (!file_exists($pathhasil)) {
            mkdir($pathhasil, 0777, true);
        }
        $filePath = FCPATH . DIRECTORY_SEPARATOR . 'LAPORAN-' . $datawo[0]->nomor_wo . '.pdf';
        // Compress File
        $pdf->SetCompression(true);
        // Save the PDF to the specified directory
        $pdf->Output($filePath, 'F');
        $pdf->Output($filePath, 'D');
    }
}
