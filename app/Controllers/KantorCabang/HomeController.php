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
    protected $loJanuari;

    public function __construct()
    {
        $this->muatJanuari = new LOJanuariModel();
        $this->woJanuari = new WOJanuariModel();
        $this->loJanuari = new WOJanuariModel();
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
        $datawo = $this->loJanuari->showDetailWO($nomorwo);
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
        $data = $this->loJanuari->woPDF($nomorwo);

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('PT Delapan Delapan Logistics');
        $pdf->SetAuthor('PT Delapan Delapan Logistics');
        $pdf->SetTitle('LAPORAN PENYERAHAN-' . $data[0]->nomor_wo);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pathhasil = $data[0]->path_wo;

        // Halaman untuk dokument working order
        $pdf->AddPage('P', 'A4');
        $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $pathhasil . DIRECTORY_SEPARATOR . $data[0]->file_wo;
        $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());

        // Halaman untuk dokumet penyaluran
        $pdf->AddPage('L', 'A4');
        $pdf->Cell(0, 10, 'REKAPITULASI HARIAN BANTUAN PANGAN CADANGAN BERAS PEMERINTAH', +$data[0]->tanggal_muat, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $pdf->Ln(10); // Spasi antara tabel dan entri baru
        $pdf->Cell(0, 10, 'TRANSPORTER : PT LOGISTICS DELAPAN DELAPAN', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $pdf->Cell(0, 10, 'GUDANG MUAT : ', + $data[0]->nama_gudang, 0, false, 'C', 0, '', 0, false, 'M', 'M');



        // Looping data Loading Order (LO)
        foreach ($data as $row) {
            // LO 
            $pdf->AddPage('P', 'A4');
            $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $row->path_wo . DIRECTORY_SEPARATOR . $row->file_uplaod_lo;
            $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());

            // lopiing surat jalan by nomor lo
            foreach ($data as $row) {
                $pdf->AddPage('P', 'A4');
                $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $row->path_wo . DIRECTORY_SEPARATOR . $row->file_surat_jalan;
                $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());
            }

            // Dokumen DO BULOG
            $pdf->AddPage('P', 'A4');
            $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $row->path_wo . DIRECTORY_SEPARATOR . $row->file_upload_do;
            $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());

            // Dokumen Surat Jalan BULOG
            $pdf->AddPage('P', 'A4');
            $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $row->path_wo . DIRECTORY_SEPARATOR . $row->file_upload_sj_bulog;
            $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());

            // Dokumen BAST BULOG
            $pdf->AddPage('P', 'A4');
            $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $row->path_wo . DIRECTORY_SEPARATOR . $row->file_upload_bast_bulog;
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
