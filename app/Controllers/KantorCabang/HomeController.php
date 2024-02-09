<?php

namespace App\Controllers\KantorCabang;

use App\Models\JanuariSJModel;
use App\Models\LOJanuariModel;
use App\Models\WOJanuariModel;
use App\Models\AkunModel;
use CodeIgniter\Controller;
use TCPDF;


class HomeController extends Controller
{

    protected $muatJanuari;
    protected $woJanuari;
    protected $loJanuari;
    protected $januariSJ;
    protected $akunModel;

    public function __construct()
    {
        $this->muatJanuari = new LOJanuariModel();
        $this->woJanuari = new WOJanuariModel();
        $this->loJanuari = new LOJanuariModel();
        $this->januariSJ = new JanuariSJModel();
        $this->akunModel = new AkunModel();
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

    public function detail_wo($nomorwo)
    {
        $datawo = $this->loJanuari->showDetailWO($nomorwo);
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

        $data = $this->loJanuari->woPDF($nomorwo);

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('PT Delapan Delapan Logistics');
        $pdf->SetAuthor('PT Delapan Delapan Logistics');
        $pdf->SetTitle('LAPORAN PENYERAHAN-' . $data[0]->nomor_wo);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pathhasil = $data[0]->path_lo;

        // Halaman untuk dokument working order
        $pdf->AddPage('P', 'A4');
        // $leftImagePath = FCPATH . 'assets/img/Wo01.png';
        $leftImagePath =  base_url('UPLOAD/1/LO/SIDARAJA/2024-02-08/logo.png');
        // dd($data[0]->file_upload_wo);

        $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());

        // Halaman untuk dokumet penyaluran
        $pdf->AddPage('L', 'A4');
        $pdf->SetFont('times', 'B', 10);
        $pdf->Cell(0, 10, 'REKAPITULASI HARIAN', 0, 1, 'C');
        $pdf->Cell(0, 0, 'BANTUAN PANGAN CADANGAN BERAS PEMERINTAH 2024 ', 0, 1, 'C');
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
            $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $row->path_lo . DIRECTORY_SEPARATOR . $row->file_uplaod_lo;
            $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());

            // lopiing surat jalan by nomor lo
            foreach ($data as $row) {
                $pdf->AddPage('P', 'A4');
                $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $row->path_lo . DIRECTORY_SEPARATOR . $row->file_surat_jalan;
                $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());
            }

            // Dokumen DO BULOG
            $pdf->AddPage('P', 'A4');
            $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $row->path_lo . DIRECTORY_SEPARATOR . $row->file_upload_do;
            $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());

            // Dokumen Surat Jalan BULOG
            $pdf->AddPage('P', 'A4');
            $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $row->path_lo . DIRECTORY_SEPARATOR . $row->file_upload_sj_bulog;
            $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());

            // Dokumen BAST BULOG
            $pdf->AddPage('P', 'A4');
            $leftImagePath = FCPATH . DIRECTORY_SEPARATOR . $row->path_lo . DIRECTORY_SEPARATOR . $row->file_upload_bast_bulog;
            $pdf->Image($leftImagePath, 10, 10, $pdf->GetPageWidth(), $pdf->getPageHeight());
        }
        $filePath = FCPATH . DIRECTORY_SEPARATOR . $pathhasil . DIRECTORY_SEPARATOR . ' LAPORAN-WO-' . $data[0]->nomor_wo . '.pdf';
        // Compress File
        $pdf->SetCompression(true);
        // Save the PDF to the specified directory
        $pdf->Output($filePath, 'D');
    }

    public function generateReport($idalokasi)
    {

        $idKantor = session()->get('id_kantor_cabang');
        $bahan = $this->loJanuari->getSPMPerKecamtan($idKantor);
        $excel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $no = 1;
        foreach ($bahan as $b) {

            if ($b != null) {
                if ($no == 1) {
                    $sheet = $excel->getActiveSheet();
                } else {
                    $sheet = $excel->createSheet($b->id_gudang);
                }
                $no++;
                $sheet->setTitle($b->nama_gudang, true);
                $sheet->setCellValue("A1", "REKAPITULASI HARIAN BANTUAN PANGAN CADANGAN BERAS PEMERINTAH 2024 Januari");
                $sheet->mergeCells('A1:J1');
                $alignment = $sheet->getStyle('A1:J1')->getAlignment();
                $alignment->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $boldStyle = $sheet->getStyle('A1:J1')->getFont();
                $boldStyle->setBold(true);
                $sheet->setCellValue('A3', 'TRANSPORTER');
                $sheet->setCellValue('C3', ': PT POS INDONESIA (Persero)');
                $sheet->mergeCells('A3:B3');
                $sheet->setCellValue('A4', 'GUDANG MUAT');
                $sheet->setCellValue('C4', ': ' . $b->nama_gudang . '');
                $sheet->mergeCells('A4:B4');
                $sheet->setCellValue('A5', 'TANGGAL');
                $sheet->setCellValue('C5', ': ' . date('Y-m-d'));
                $sheet->mergeCells('A5:B5');
                $sheet->setCellValue('E3', 'KABUPATEN/KOTA');
                $sheet->setCellValue('G3', ': ' . $b->nama_kabupaten_kota);
                $sheet->mergeCells('E3:F3');
                $sheet->setCellValue('E4', 'BULOG KANCAB');
                $sheet->setCellValue('G4', ': ' . $b->nama_kantor);
                $sheet->mergeCells('E4:F4');
                $sheet->setCellValue('E5', 'KETERANGAN');
                $sheet->setCellValue('G5', ': ');
                $sheet->mergeCells('E5:F5');
                $sheet->getColumnDimension('A')->setWidth(6);
                $sheet->getColumnDimension('B')->setWidth(16);
                $sheet->getColumnDimension('C')->setWidth(16);
                $sheet->getColumnDimension('D')->setWidth(16);
                $sheet->getColumnDimension('E')->setWidth(16);
                $sheet->getColumnDimension('F')->setWidth(16);
                $sheet->getColumnDimension('G')->setWidth(16);
                $sheet->getColumnDimension('H')->setWidth(16);
                $sheet->getColumnDimension('I')->setWidth(16);
                $sheet->getColumnDimension('J')->setWidth(16);
                $header = ['NO', 'NOPOL', 'DRIVER', 'KECAMATAN', 'KELURAHAN/DESA', 'KOLI (BAGS)', 'KUANTUM (KG)', 'NO DANOM', 'NO DOC OUT', 'NO SO'];
                $sheet->fromArray([$header], null, 'A7');
                $greenFill = $sheet->getStyle('A7:J7')->getFill();
                $greenFill->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $greenFill->getStartColor()->setARGB('00FF00');
                $alignment = $sheet->getStyle('A7:J7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A7:J7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $boldStyle = $sheet->getStyle('A7:J7')->getFont();
                $boldStyle->setBold(true);
                $sheet->getStyle('A7:J7')->getAlignment()->setWrapText(true);
                $borderStyle = $sheet->getStyle('A7:J7')->getBorders();
                $borderStyle->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $mulai = 8;
                $no = 1;
                $total = 0;
                $idGudang = $b->id_gudang;
                $gudang = $this->loJanuari->getRekap($idGudang);
                foreach ($gudang as $row) {
                    $total = $total + ($row->jumlah_penyaluran_januari / 10);
                    $sheet->setCellValue('A' . $mulai, $no);
                    $sheet->setCellValue('B' . $mulai, $row->nomor_mobil);
                    $sheet->setCellValue('C' . $mulai, $row->nama_driver);
                    $sheet->setCellValue('D' . $mulai, $row->nama_kecamatan);
                    $sheet->setCellValue('E' . $mulai, $row->nama_desa_kelurahan);
                    $sheet->setCellValue('F' . $mulai, $row->jumlah_penyaluran_januari / 10);
                    $sheet->setCellValue('G' . $mulai, $row->jumlah_penyaluran_januari);
                    $sheet->setCellValue('H' . $mulai, '');
                    $sheet->setCellValue('I' . $mulai, $row->nomor_do);
                    $sheet->setCellValue('J' . $mulai, $row->nomor_so);
                    $sheet->getStyle('A' . $mulai . ':E' . $mulai)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                    $sheet->getStyle('F' . $mulai . ':G' . $mulai)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                    $sheet->getStyle('H' . $mulai . ':J' . $mulai)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                    $no++;
                    $mulai++;
                }
                $greenFill = $sheet->getStyle('A' . $mulai . ':J' . $mulai)->getFill();
                $greenFill->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $greenFill->getStartColor()->setARGB('00FF00');
                $sheet->setCellValue('A' . $mulai, 'TOTAL REALISASI HARIAN');
                $alignment = $sheet->getStyle('A' . $mulai . ':E' . $mulai)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->mergeCells('A' . $mulai . ':E' . $mulai);
                $sheet->setCellValue('F' . $mulai, $total);
                $sheet->setCellValue('G' . $mulai, ($total * 10));
                $boldStyle = $sheet->getStyle('A' . $mulai . ':J' . $mulai)->getFont();
                $boldStyle->setBold(true);
                $alignment = $sheet->getStyle('A' . $mulai . ':E' . $mulai)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $alignment = $sheet->getStyle('F' . $mulai . ':G' . $mulai)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $borderStyle = $sheet->getStyle('A8' . ':J' . $mulai)->getBorders();
                $borderStyle->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $mulai2 = $mulai + 2;
                $total2 = 0;
                $greenFill = $sheet->getStyle('A' . $mulai2 . ':D' . $mulai2)->getFill();
                $greenFill->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $greenFill->getStartColor()->setARGB('ffd700');
                $sheet->setCellValue('A' . $mulai2, 'TOTAL ALOKASI DESA');
                $sheet->mergeCells('A' . $mulai2 . ':D' . $mulai2);
                $alignment = $sheet->getStyle('A' . $mulai2 . ':D' . $mulai2)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                // foreach ($dataspm as $row) {
                //     $total2 = $total2 + $row->total;
                //     $sheet->setCellValue('A' . $mulai2 + 1, $row->nama_desa_kelurahan);
                //     $sheet->mergeCells('A' . $mulai2 + 1 . ':C' . $mulai2 + 1);
                //     $sheet->setCellValue('D' . $mulai2 + 1, $row->total);
                //     $mulai2++;
                // }
                $sheet->setCellValue('A' . $mulai2 + 1, "TOTAL");
                $sheet->setCellValue('D' . $mulai2 + 1, $total2);
                $sheet->mergeCells('A' . $mulai2 + 1 . ':C' . $mulai2 + 1);
                $alignment = $sheet->getStyle('A' . $mulai2 + 1 . ':C' . $mulai2 + 1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $alignment = $sheet->getStyle('D' . $mulai2 + 1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $boldStyle = $sheet->getStyle('A' . $mulai + 2 . ':D' . $mulai2 + 1)->getFont();
                $boldStyle->setBold(true);
                $greenFill = $sheet->getStyle('A' . $mulai2 + 1 . ':D' . $mulai2 + 1)->getFill();
                $greenFill->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $greenFill->getStartColor()->setARGB('ffd700');
                $borderStyle = $sheet->getStyle('A' . $mulai + 2 . ':D' . $mulai2 + 1)->getBorders();
                $borderStyle->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            }
        }

        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="REKAP PENYALURAN ' . $bahan[0]->nama_kantor . ' ' . date('d-m-Y') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($excel, 'Xlsx');
        $xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($excel);
        exit($xlsxWriter->save('php://output'));
    }

    public function getwobykodewo($alokasi, $kodewo)
    {
        $data = [
            'menu1' => '',
            'menu2' => 'selected',
            'menu3' => '',
            'menu4' => '',
            'alokasi' => $alokasi,
            'kodewo' => $kodewo,
        ];
        return view('kantorcabang/laporan/detail', $data);
    }

    public function downloadwo()
    {
    }
}
