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
        $pdf->SetFont('times', 'B', 10);
        $pdf->Cell(0, 10, 'REKAPITULASI HARIAN', 0, 1, 'C');
        $pdf->Cell(0, 0, 'BANTUAN PANGAN CADANGAN BERAS PEMERINTAH 2024 ', $data[0], 0, 1, 'C');
        $pdf->Ln(10);
        $html = '<hr>';
        // Output the HTML content to the PDF
        $pdf->writeHTML('<hr>', true, false, true, false, '');
        $pdf->SetFont('times', 'B', 10);
        $pdf->Ln(10);

        $pdf->SetFont('times', 'B', 8);

        $html = '<table border="1" style="width:100%" cellspacing="0" cellpadding="5">';
        $html .= '<tr>
                    <td width="25%">Transporter</td>
                    <td width="25%">: ' . "PT DELAPAN DELAPAN LOGISTICS" . '</td>
                    <td width="25%">Kabupaten/Kota</td>
                    <td width="25%">: ' . $data[0]->nama_kabupaten_kota . '</td>
                </tr>';
        $html .= '<tr>
                    <td width="25%">Gudang Muat</td>
                    <td width="25%">: ' . $data[0]->nama_gudang . '</td>
                    <td width="25%">Kantor Cabang</td>
                    <td width="25%">: ' . $data[0]->nama_kantor . '</td>
                </tr>';
        $html .= '<tr>
                    <td width="25%">Tanggal</td>
                    <td width="25%">: ' . $data[0]->tanggal_muat . '</td>
                    <td width="25%">Keterangan</td>
                    <td width="25%">: ' . $data[0]->nama_kantor . '</td>
                </tr>';
        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Ln(0);
        $pdf->SetFont('times', 'B', 7);
        // Add table header
        $html = '<table border="1" style="width:100%" cellspacing="0" cellpadding="5">';
        $html .= '<tr style="text-align: center">
                    <th style="width: 30px">NO</th>
                    <th style="width: 30%">NOPOL</th>
                    <th style="width: 10%">DRIVER</th>
                    <th style="width: 7.5%">KECAMATAN</th>
                    <th style="width: 7.5%">KELURAHAN/DESA</th>
                    <th style="width: 7.5%">KOLL (Bags)</th>
                    <th style="width: 7.5%">KUANTUM</th>
                    <th style="width: 7.5%">NO DANOM</th>
                    <th style="width: 7.5%">NO DOC OUT</th>
                    <th style="width: *%">NO SO</th>
                </tr>';
        $jumlah = 0;
        $no = 1;
        foreach ($data as $row) {
            $jumlah = $jumlah + $row->jumlah_penyaluran_januari;
            $html .= '<tr>';
            $html .= '<td style="text-align : center">' . $no++ . '</td>';
            $html .= '<td style="text-align : center" >' . $row->nomor_mobil . '</td>';
            $html .= '<td style="text-align : center" >' . $row->nama_driver . '</td>';
            $html .= '<td style="text-align : center" >' . $row->nama_kecamatan . '</td>';
            $html .= '<td style="text-align : center" >' . $row->nama_desa_kelurahan . '</td>';
            $html .= '<td style="text-align : center" >' . $row->jumlah_penyaluran_januari / 10 . '</td>';
            $html .= '<td style="text-align : center" >' . $row->jumlah_penyaluran_januari . '</td>';
            $html .= '<td style="text-align : center" >NO DANOM</td>';
            $html .= '<td style="text-align : center" >' . $row->nomor_do . '</td>';
            $html .= '<td style="text-align : center" >' . $row->nomor_so . '</td>';
            $html .= '</tr>';
        }
        $html .= '<tr>
                    <td colspan="5" style="text-align: center;">TOTAL REALISASI HARIAN</td>
                    <td>' . $data[0]->jumlah_penyaluran_januari / 10  . '</td>
                    <td>' . $data[0]->jumlah_penyaluran_januari . '</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>';
        $html .= '</table>';
        $pdf->writeHTML($html, true, false, true, false, '');


        // Table ke dua
        $html = '<table border="1" style="width:100%" cellspacing="0" cellpadding="5">';
        $html .= '<tr>
            <td colspan="2" style="text-align: center;">TOTAL ALOKASI DESA</td>
          </tr>';

        $jumlah = 0;
        $no = 1;
        foreach ($data as $row) {
            $jumlah = $jumlah + $row->jumlah_penyaluran_januari;
            $html .= '<tr>';
            $html .= '<td style="text-align : center" >' . $row->nama_desa_kelurahan . '</td>';
            $html .= '<td style="text-align : center" >' . $row->jumlah_penyaluran_januari . '</td>';
            $html .= '</tr>';
        }
        $html .= '<tr>
                    <td >TOTAL</td>
                    <td>' . $jumlah . '</td>
                </tr>';
        $html .= '</table>';
        $pdf->writeHTML($html, true, false, true, false, '');

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
