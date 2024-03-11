<?php

namespace App\Controllers\Gudang;

use App\Models\GudangModel;
use App\Models\LOJanuariModel;
use App\Models\LOFebruariModel;
use CodeIgniter\Controller;
use TCPDF;

class GudangController extends Controller
{
    protected $model;
    protected $modelLOJanuari;
    protected $modelLOFebruari;
    protected $modelLOMaret;
    protected $modelLOApril;
    protected $modelLOMei;
    protected $modelLOJuni;

    public function __construct()
    {
        $this->model = new GudangModel();
        $this->modelLOJanuari = new LOJanuariModel();
        $this->modelLOFebruari = new LOFebruariModel();
        $this->modelLOMaret = new LOJanuariModel();
        $this->modelLOApril = new LOJanuariModel();
        $this->modelLOMei = new LOJanuariModel();
        $this->modelLOJuni = new LOJanuariModel();
    }


    public function index_gudang()
    {
        $data = [
            'menu1' => 'selected',
            'menu2' => '',
            'js' => base64_decode("aHR0cHM6Ly9jYXRhdGFua3VsaWFoLWxhYi5naXRodWIuaW8vanNzaW1iYXYyL2d1ZGFuZy9kYXNoYm9hcmQvZGFzaGJvYXJkLmpz")
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

    public function detail_lo()
    {
        $data = [
            'menu1' => '',
            'menu2' => 'selected',
        ];
        return view('gudang/lo/detail', $data);
    }

    function downloadPDFLOJanuari($nomorlo)
    {
        $datalo = $this->modelLOJanuari->downloadPDF($nomorlo);
        $pdf = new TCPDF();
        // Set document properties
        $pdf->SetCreator('PT Delapan Delapan Logistics');
        $pdf->SetAuthor('PT Delapan Delapan Logistics');
        $pdf->SetTitle($nomorlo);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        // Add a page
        $pdf->AddPage('L', 'A5');
        // Add header with images on both sides
        $leftImagePath = FCPATH . 'assets/img/bulog.png'; // Adjust the path to your left image
        $rightImagePath = FCPATH . 'assets/img/pos.png'; // Adjust the path to your right image
        // Add left image
        $pdf->Image($leftImagePath, 10, 5, 40); // X, Y, Width
        // Move to the right for the right image
        $pdf->SetX($pdf->GetPageWidth() - 29);
        // Add right image
        $pdf->Image($rightImagePath, '', 5, 18); // X, Y, Width
        // Center-align the text between the images
        $pdf->SetY(7);
        // Set font
        $pdf->SetFont('times', 'B', 8);
        $pdf->Cell(0, 0, 'BERITA ACARA SERAH TERIMA BARANG', 0, 1, 'C');
        $pdf->Cell(0, 0, 'BANTUAN PANGAN CADANGAN BERAS 2024', 0, 1, 'C');
        $pdf->Ln(3);
        // Output the HTML content to the PDF
        $pdf->SetFont('times', 'B', 8);
        $pdf->Cell(0, 0, 'PENYERAHAN BARANG DARI GUDANG', 0, 1, 'C');
        $pdf->Ln(3);
        // HTML table
        $pdf->SetFont(
            'times',
            'B',
            6
        );
        $html = '<table border="1" style="width:100%" cellspacing="0" cellpadding="5">';
        $html .= '<tr>
                    <td width="25%">Nomor LO</td>
                    <td width="25%">:</td>
                    <td width="25%">Gudang Pengirim</td>
                    <td width="25%">: ' . $datalo[0]->nama_gudang . '</td>
                </tr>';
        $html .= '<tr>
                    <td width="25%">Tanggal Penyerahan</td>
                    <td width="25%">: ' . date("d-m-Y", strtotime($datalo[0]->tanggal_muat)) . '</td>
                    <td width="25%">Driver/Nopol</td>
                    <td width="25%">: ' . $datalo[0]->nama_driver . ' / ' . $datalo[0]->nomor_mobil . '</td>
                </tr>';
        $html .= '</table>';
        // Output the HTML content to the PDF
        $pdf->writeHTML($html, false, false, true, false, '');
        $pdf->Ln(5);
        $pdf->SetFont('times', 'B', 6);
        // Add table header
        $html = '<table border="1" style="width:100%" cellspacing="0" cellpadding="5">';
        $html .= '<tr style="text-align: center">
                    <th style="width: 30px" valign="center">No</th>
                    <th style="width: 30%" valign="center">ITEM</th>
                    <th style="width: 10%" valign="center">Jumlah Diserahkan (Kg)</th>
                    <th style="width: 7.5%" valign="center">Kondisi</th>
                    <th style="width: 7.5%" valign="center">Koll (Bags)</th>
                    <th style="width: 7.5%" valign="center">Cek Isi (Y/N)</th>
                    <th style="width: *%" valign="center">Desa/Kecamatan</th>
                </tr>';
        // Fetch data from your database and populate the table
        $jumlah = 0;
        $no = 1;
        foreach ($datalo as $row) {
            $jumlah = $jumlah + $row->jumlah_penyaluran_januari;
            $html .= '<tr>';
            $html .= '<td style="text-align: center">' . $no++ . '</td>';
            $html .= '<td>Beras Bantuan Pangan Kemasan 10 Kg</td>';
            $html .= '<td style="text-align: center" >' . $row->jumlah_penyaluran_januari . '</td>';
            $html .= '<td style="text-align: center" >Baik</td>';
            $html .= '<td style="text-align: center" >' . $row->jumlah_penyaluran_januari / 10 . '</td>';
            $html .= '<td style="text-align: center" >Y</td>';
            $html .= '<td>' . $row->nama_desa_kelurahan . ' / ' . $row->nama_kecamatan . '</td>';
            $html .= '</tr>';
        }
        $html .= '<tr>
                    <td colspan="2">JUMLAH TOTAL</td>
                    <td style="text-align: center">' . $jumlah . '</td>
                    <td></td>
                    <td style="text-align: center">' . $jumlah / 10 . '</td>
                    <td></td>
                    <td></td>
                </tr>';
        $html .= '</table>';
        // Output the HTML content to the PDF
        $pdf->writeHTML($html, false, false, true, false, '');
        $pdf->Ln(3);
        $pdf->Cell(0, 0, 'Pihak yang menyerahkan dan pihak yang menerima telah sepakat bahwa jumlah dan kondisi barang sesuai dengan rincian diatas', 0, 0, 'L');
        $pdf->Ln(5);
        $pdf->SetFont('times', 'B', 6);
        $html = '<table border="0" style="width:100%">';
        $html .= '<tr style="text-align: center">
                    <td width="33%">Diserahkan Oleh</td>
                    <td>Diverifikasi Oleh</td>
                    <td width="33%">Diterima Oleh</td>
                </tr>';
        $html .= '<tr style="text-align: center; height: 50px">
                    <td width="33%" height="50px">Bulog</td>
                    <td>PT.POS Indonesia</td>
                    <td width="33%">Supir</td>
                </tr>';
        $html .= '<tr style="text-align: center;">
                    <td width="33%"><hr></td>
                    <td><hr></td>
                    <td width="33%"><hr></td>
                </tr>';
        $html .= '<tr>
                    <td width="33%">Telp.</td>
                    <td>Nippos.</td>
                    <td width="33%">Telp.</td>
                </tr>';
        $html .= '</table>';
        // Output the HTML content to the PDF
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Cell(0, 0, 'Catatan : ', 0, 1, 'L');
        $pdf->Cell(0, 0, '1. PT.POS Indonesia (Persero) hanya menerima paket sesuai dengan jumlah ', 0, 1, 'L');
        $pdf->Cell(0, 0, '2. Apaliba ditemukan isi paket yang rusak, akan dikembalikan keperusahaan', 0, 1, 'L');

        // foreach
        $no = 1;
        foreach ($datalo as $row) {
            // Add a page
            $pdf->AddPage('L', 'A5');
            // Path right image
            $rightImagePath = FCPATH . 'assets/img/pos.png'; // Adjust the path to your right image
            // Move to the right for the right image
            $pdf->SetX($pdf->GetPageWidth() - 29);
            // Add right image
            $pdf->Image($rightImagePath, '', 5, 18); // X, Y, Width
            // Center-align the text between the images
            $pdf->SetY(5);
            // Set font
            $pdf->SetFont('times', 'B', 8);
            $pdf->Cell(0, 5, 'PT. POS INDONESIA (PERSERO)', 0, 1, 'L');
            $pdf->Cell(0, 5, 'SPP/KCU/KC ………………………………', 0, 1, 'L');
            $pdf->Ln(0);
            $pdf->SetFont('times', 'B', 8);
            $pdf->Cell(0, 0, 'SURAT JALAN', 0, 1, 'C');
            $pdf->Cell(0, 0, 'NOMOR SURAT : ', 0, 1, 'C');
            $pdf->Ln(3);
            // HTML table
            $pdf->SetFont(
                'times',
                'B',
                6
            );
            $html = '<table border="1" style="width:100%" cellspacing="0" cellpadding="2">';
            $html .= '<tr>
                    <td width="25%">No.BAST/Danom</td>
                    <td width="25%">: ' . $row->nomor_danom . '</td>
                    <td width="25%">Nama Driver</td>
                    <td width="25%">: ' . $row->nama_driver . '</td>
                </tr>';
            $html .= '<tr>
                    <td width="25%">Tanggal</td>
                    <td width="25%">: ' . date("d-m-Y", strtotime($row->tanggal_muat)) . '</td>
                    <td width="25%">No.Pol.</td>
                    <td width="25%">: ' . $row->nomor_mobil . '</td>
                </tr>';
            $html .= '<tr>
                    <td width="25%">Gudang Bulog</td>
                    <td width="25%">: ' . $row->nama_gudang . '</td>
                    <td width="25%">Nama Checker</td>
                    <td width="25%">: </td>
                </tr>';
            $html .= '<tr>
                    <td width="25%">Tujuan (Kecamatan)</td>
                    <td width="25%">: ' . $row->nama_kecamatan . '</td>
                    <td width="25%">No Telp</td>
                    <td width="25%">: ' . $row->nomor_driver . '</td>
                </tr>';
            $html .= '<tr>
                    <td width="25%">Surat Jalan Bulog</td>
                    <td width="25%">: SO/</td>
                    <td width="25%">No Doc Out</td>
                    <td width="25%">: OUT/</td>
                </tr>';
            $html .= '</table>';
            // Output the HTML content to the PDF
            $pdf->writeHTML($html, true, false, true, false, '');

            $html2 = '<table border="1" style="width:100%" cellspacing="0" cellpadding="5">';
            $html2 .= '<tr >
                            <td style="text-align:center; width: 30px" rowspan="2" >No</td>
                            <td style="text-align:center; width: 30%" rowspan="2">Nama Desa/Kelurahan</td>
                            <td style="text-align:center; width: 60px" rowspan="2">Jumlah PBP</td>
                            <td style="text-align:center; width: 60px" >Kuantitas</td>
                            <td style="text-align:center; width: 60px" >Berat</td>
                            <td style="text-align:center; width: 60px" rowspan="2">Ket</td>
                            <td style="text-align:center; width: 108px" rowspan="2">Tanda Tangan & Nama Jelas</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;" >(Karung)</td>
                            <td style="text-align:center;" >(Kg)</td>
                        </tr>';
            $html2 .= '<tr>
                            <td style="text-align:center; width: 30px">1</td>
                            <td style="width: 30%">' . $row->nama_desa_kelurahan . '</td>
                            <td style="text-align:center; width: 60px" >' . $row->jumlah_penyaluran_januari / 10 . '</td>
                            <td style="text-align:center; width: 60px" >' . $row->jumlah_penyaluran_januari / 10 . '</td>
                            <td style="text-align:center; width: 60px" >' . $row->jumlah_penyaluran_januari . '</td>
                            <td style="text-align:center; width: 60px"></td>
                            <td style="text-align:center; width: 108px;" height="80px"></td>
                        </tr>';
            $html2 .= '</table>';
            // Output the HTML content to the PDF
            $pdf->writeHTML($html2, true, false, true, false, '');

            $html3 = '<table border="1" style="width:100%" cellspacing="0" cellpadding="5">';
            $html3 .= '<tr style="text-align: center">
                    <td width="50%" height="20px">Diserahkan Oleh<br>Admin Gudang</td>
                    <td width="50%" height="20px">Diterima Oleh<br>Admin/Driver/Checker</td>
                </tr>';
            $html3 .= '<tr style="text-align: center;">
                    <td width="50%" height="40px"></td>
                    <td width="50%" height="40px"></td>
                </tr>';
            $html3 .= '<tr>
                    <td width="50%"><br><hr><br>Nippos : </td>
                    <td width="50%"></td>
                </tr>';
            $html3 .= '</table>';
            // Output the HTM3 content to the PDF
            $pdf->writeHTML($html3, true, false, true, false, '');
        }
        $namafilepdf = $nomorlo . ".pdf";
        // Compress File
        $pdf->SetCompression(true);
        // Save the PDF to the specified directory
        $pdf->Output($namafilepdf, 'D');
    }

    function downloadPDFLOFebruari($nomorlo)
    {
        $datalo = $this->modelLOFebruari->downloadPDF($nomorlo);
        $pdf = new TCPDF();
        // Set document properties
        $pdf->SetCreator('PT Delapan Delapan Logistics');
        $pdf->SetAuthor('PT Delapan Delapan Logistics');
        $pdf->SetTitle($nomorlo);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        // Add a page
        $pdf->AddPage('L', 'A5');
        // Add header with images on both sides
        $leftImagePath = FCPATH . 'assets/img/bulog.png'; // Adjust the path to your left image
        $rightImagePath = FCPATH . 'assets/img/pos.png'; // Adjust the path to your right image
        // Add left image
        $pdf->Image($leftImagePath, 10, 5, 40); // X, Y, Width
        // Move to the right for the right image
        $pdf->SetX($pdf->GetPageWidth() - 29);
        // Add right image
        $pdf->Image($rightImagePath, '', 5, 18); // X, Y, Width
        // Center-align the text between the images
        $pdf->SetY(7);
        // Set font
        $pdf->SetFont('times', 'B', 8);
        $pdf->Cell(0, 0, 'BERITA ACARA SERAH TERIMA BARANG', 0, 1, 'C');
        $pdf->Cell(0, 0, 'BANTUAN PANGAN CADANGAN BERAS 2024', 0, 1, 'C');
        $pdf->Ln(3);
        // Output the HTML content to the PDF
        $pdf->SetFont('times', 'B', 8);
        $pdf->Cell(0, 0, 'PENYERAHAN BARANG DARI GUDANG', 0, 1, 'C');
        $pdf->Ln(3);
        // HTML table
        $pdf->SetFont(
            'times',
            'B',
            6
        );
        $html = '<table border="1" style="width:100%" cellspacing="0" cellpadding="5">';
        $html .= '<tr>
                    <td width="25%">Nomor LO</td>
                    <td width="25%">:</td>
                    <td width="25%">Gudang Pengirim</td>
                    <td width="25%">: ' . $datalo[0]->nama_gudang . '</td>
                </tr>';
        $html .= '<tr>
                    <td width="25%">Tanggal Penyerahan</td>
                    <td width="25%">: ' . date("d-m-Y", strtotime($datalo[0]->tanggal_muat)) . '</td>
                    <td width="25%">Driver/Nopol</td>
                    <td width="25%">: ' . $datalo[0]->nama_driver . ' / ' . $datalo[0]->nomor_mobil . '</td>
                </tr>';
        $html .= '</table>';
        // Output the HTML content to the PDF
        $pdf->writeHTML($html, false, false, true, false, '');
        $pdf->Ln(5);
        $pdf->SetFont('times', 'B', 6);
        // Add table header
        $html = '<table border="1" style="width:100%" cellspacing="0" cellpadding="5">';
        $html .= '<tr style="text-align: center">
                    <th style="width: 30px" valign="center">No</th>
                    <th style="width: 30%" valign="center">ITEM</th>
                    <th style="width: 10%" valign="center">Jumlah Diserahkan (Kg)</th>
                    <th style="width: 7.5%" valign="center">Kondisi</th>
                    <th style="width: 7.5%" valign="center">Koll (Bags)</th>
                    <th style="width: 7.5%" valign="center">Cek Isi (Y/N)</th>
                    <th style="width: *%" valign="center">Desa/Kecamatan</th>
                </tr>';
        // Fetch data from your database and populate the table
        $jumlah = 0;
        $no = 1;
        foreach ($datalo as $row) {
            $jumlah = $jumlah + $row->jumlah_penyaluran_januari;
            $html .= '<tr>';
            $html .= '<td style="text-align: center">' . $no++ . '</td>';
            $html .= '<td>Beras Bantuan Pangan Kemasan 10 Kg</td>';
            $html .= '<td style="text-align: center" >' . $row->jumlah_penyaluran_januari . '</td>';
            $html .= '<td style="text-align: center" >Baik</td>';
            $html .= '<td style="text-align: center" >' . $row->jumlah_penyaluran_januari / 10 . '</td>';
            $html .= '<td style="text-align: center" >Y</td>';
            $html .= '<td>' . $row->nama_desa_kelurahan . ' / ' . $row->nama_kecamatan . '</td>';
            $html .= '</tr>';
        }
        $html .= '<tr>
                    <td colspan="2">JUMLAH TOTAL</td>
                    <td style="text-align: center">' . $jumlah . '</td>
                    <td></td>
                    <td style="text-align: center">' . $jumlah / 10 . '</td>
                    <td></td>
                    <td></td>
                </tr>';
        $html .= '</table>';
        // Output the HTML content to the PDF
        $pdf->writeHTML($html, false, false, true, false, '');
        $pdf->Ln(3);
        $pdf->Cell(0, 0, 'Pihak yang menyerahkan dan pihak yang menerima telah sepakat bahwa jumlah dan kondisi barang sesuai dengan rincian diatas', 0, 0, 'L');
        $pdf->Ln(5);
        $pdf->SetFont('times', 'B', 6);
        $html = '<table border="0" style="width:100%">';
        $html .= '<tr style="text-align: center">
                    <td width="33%">Diserahkan Oleh</td>
                    <td>Diverifikasi Oleh</td>
                    <td width="33%">Diterima Oleh</td>
                </tr>';
        $html .= '<tr style="text-align: center; height: 50px">
                    <td width="33%" height="50px">Bulog</td>
                    <td>PT.POS Indonesia</td>
                    <td width="33%">Supir</td>
                </tr>';
        $html .= '<tr style="text-align: center;">
                    <td width="33%"><hr></td>
                    <td><hr></td>
                    <td width="33%"><hr></td>
                </tr>';
        $html .= '<tr>
                    <td width="33%">Telp.</td>
                    <td>Nippos.</td>
                    <td width="33%">Telp.</td>
                </tr>';
        $html .= '</table>';
        // Output the HTML content to the PDF
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Cell(0, 0, 'Catatan : ', 0, 1, 'L');
        $pdf->Cell(0, 0, '1. PT.POS Indonesia (Persero) hanya menerima paket sesuai dengan jumlah ', 0, 1, 'L');
        $pdf->Cell(0, 0, '2. Apaliba ditemukan isi paket yang rusak, akan dikembalikan keperusahaan', 0, 1, 'L');

        // foreach
        $no = 1;
        foreach ($datalo as $row) {
            // Add a page
            $pdf->AddPage('L', 'A5');
            // Path right image
            $rightImagePath = FCPATH . 'assets/img/pos.png'; // Adjust the path to your right image
            // Move to the right for the right image
            $pdf->SetX($pdf->GetPageWidth() - 29);
            // Add right image
            $pdf->Image($rightImagePath, '', 5, 18); // X, Y, Width
            // Center-align the text between the images
            $pdf->SetY(5);
            // Set font
            $pdf->SetFont('times', 'B', 8);
            $pdf->Cell(0, 5, 'PT. POS INDONESIA (PERSERO)', 0, 1, 'L');
            $pdf->Cell(0, 5, 'SPP/KCU/KC ………………………………', 0, 1, 'L');
            $pdf->Ln(0);
            $pdf->SetFont('times', 'B', 8);
            $pdf->Cell(0, 0, 'SURAT JALAN', 0, 1, 'C');
            $pdf->Cell(0, 0, 'NOMOR SURAT : ', 0, 1, 'C');
            $pdf->Ln(3);
            // HTML table
            $pdf->SetFont(
                'times',
                'B',
                6
            );
            $html = '<table border="1" style="width:100%" cellspacing="0" cellpadding="2">';
            $html .= '<tr>
                    <td width="25%">No.BAST/Danom</td>
                    <td width="25%">: ' . $row->nomor_danom . '</td>
                    <td width="25%">Nama Driver</td>
                    <td width="25%">: ' . $row->nama_driver . '</td>
                </tr>';
            $html .= '<tr>
                    <td width="25%">Tanggal</td>
                    <td width="25%">: ' . date("d-m-Y", strtotime($row->tanggal_muat)) . '</td>
                    <td width="25%">No.Pol.</td>
                    <td width="25%">: ' . $row->nomor_mobil . '</td>
                </tr>';
            $html .= '<tr>
                    <td width="25%">Gudang Bulog</td>
                    <td width="25%">: ' . $row->nama_gudang . '</td>
                    <td width="25%">Nama Checker</td>
                    <td width="25%">: </td>
                </tr>';
            $html .= '<tr>
                    <td width="25%">Tujuan (Kecamatan)</td>
                    <td width="25%">: ' . $row->nama_kecamatan . '</td>
                    <td width="25%">No Telp</td>
                    <td width="25%">: ' . $row->nomor_driver . '</td>
                </tr>';
            $html .= '<tr>
                    <td width="25%">Surat Jalan Bulog</td>
                    <td width="25%">: SO/</td>
                    <td width="25%">No Doc Out</td>
                    <td width="25%">: OUT/</td>
                </tr>';
            $html .= '</table>';
            // Output the HTML content to the PDF
            $pdf->writeHTML($html, true, false, true, false, '');

            $html2 = '<table border="1" style="width:100%" cellspacing="0" cellpadding="5">';
            $html2 .= '<tr >
                            <td style="text-align:center; width: 30px" rowspan="2" >No</td>
                            <td style="text-align:center; width: 30%" rowspan="2">Nama Desa/Kelurahan</td>
                            <td style="text-align:center; width: 60px" rowspan="2">Jumlah PBP</td>
                            <td style="text-align:center; width: 60px" >Kuantitas</td>
                            <td style="text-align:center; width: 60px" >Berat</td>
                            <td style="text-align:center; width: 60px" rowspan="2">Ket</td>
                            <td style="text-align:center; width: 108px" rowspan="2">Tanda Tangan & Nama Jelas</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;" >(Karung)</td>
                            <td style="text-align:center;" >(Kg)</td>
                        </tr>';
            $html2 .= '<tr>
                            <td style="text-align:center; width: 30px">1</td>
                            <td style="width: 30%">' . $row->nama_desa_kelurahan . '</td>
                            <td style="text-align:center; width: 60px" >' . $row->jumlah_penyaluran_januari / 10 . '</td>
                            <td style="text-align:center; width: 60px" >' . $row->jumlah_penyaluran_januari / 10 . '</td>
                            <td style="text-align:center; width: 60px" >' . $row->jumlah_penyaluran_januari . '</td>
                            <td style="text-align:center; width: 60px"></td>
                            <td style="text-align:center; width: 108px;" height="80px"></td>
                        </tr>';
            $html2 .= '</table>';
            // Output the HTML content to the PDF
            $pdf->writeHTML($html2, true, false, true, false, '');

            $html3 = '<table border="1" style="width:100%" cellspacing="0" cellpadding="5">';
            $html3 .= '<tr style="text-align: center">
                    <td width="50%" height="20px">Diserahkan Oleh<br>Admin Gudang</td>
                    <td width="50%" height="20px">Diterima Oleh<br>Admin/Driver/Checker</td>
                </tr>';
            $html3 .= '<tr style="text-align: center;">
                    <td width="50%" height="40px"></td>
                    <td width="50%" height="40px"></td>
                </tr>';
            $html3 .= '<tr>
                    <td width="50%"><br><hr><br>Nippos : </td>
                    <td width="50%"></td>
                </tr>';
            $html3 .= '</table>';
            // Output the HTM3 content to the PDF
            $pdf->writeHTML($html3, true, false, true, false, '');
        }
        $namafilepdf = $nomorlo . ".pdf";
        // Compress File
        $pdf->SetCompression(true);
        // Save the PDF to the specified directory
        $pdf->Output($namafilepdf, 'D');
    }


    public function detail_sj($alokasi, $idsj)
    {
        $data = [
            'menu1' => '',
            'menu2' => 'selected',
            'idsj' => $idsj,
            'alokasi' => $alokasi,
        ];
        return view('gudang/lo/detailsuratjalan', $data);
    }
}
