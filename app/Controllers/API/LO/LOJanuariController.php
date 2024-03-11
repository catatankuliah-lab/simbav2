<?php

namespace App\Controllers\API\LO;

use App\Models\JanuariSJModel;
use App\Models\LOJanuariModel;
use App\Models\PBPJanuariModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class LOJanuariController extends ResourceController
{

    use ResponseTrait;
    protected $model;
    protected $modelSJ;
    protected $modelPBP;

    public function __construct()
    {
        $this->model = new LOJanuariModel();
        $this->modelSJ = new JanuariSJModel();
        $this->modelPBP = new PBPJanuariModel();
    }

    public function getSession()
    {
        $userData = [
            'id_akun' => session()->get('id_akun'),
            'id_gudang' => session()->get('id_gudang'),
            'nama_lengkap' => session()->get('nama_lengkap'),
            'id_kantor_cabang' => session()->get('id_kantor_cabang')
        ];
        return $this->response->setJSON($userData);
    }

    // ================================= MENU LOADING ORDER ===================================== //

    // MENGAMBIL DATA LO BERDASARKAN KANTOR CABANG (PANJI)
    public function getbyidkantor($idkantor)
    {
        $dataspm = $this->model->getAllLOByCabang($idkantor);
        if ($dataspm) {
            return $this->respond($dataspm);
        } else {
            return $this->failNotFound('Record LO Kantor Cabang aktif tidak ditemukan.');
        }
    }

    // MENAMPILKAN DATA LOADING ORDER BERDASARKAN NOMOR LO (PANJI)
    function showdetaillo($nomorlo)
    {
        $data = $this->model->detaillocabang($nomorlo);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Loading Order (LO)tidak ditemukan.');
        }
    }

    // MENAMPILKAN DATA SURAT JALAN BERDASARKAN ID_SURAT_JALAN (PANJI)
    function showDetailSuratJalan($id_sj)
    {
        $data = $this->model->detailsuratjalan($id_sj);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Loading Order (LO)tidak ditemukan.');
        }
    }

    // FILTER GUDANG BERDASARKAN KANTOR CABANG (PANJI)
    public function gudangbykantor($namaGudang)
    {
        $data = $this->model->gudangbykantor($namaGudang, session()->get('id_kantor_cabang'));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Loading Order (LO)tidak ditemukan.');
        }
    }

    // FILTER KABUPATEN BERDASARKAN KANTOR CABANG (PANJI)
    public function kabupatenbykantor($kabupaten)
    {
        $data = $this->model->kabupatenbykantor($kabupaten, session()->get('id_kantor_cabang'));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Loading Order (LO)tidak ditemukan.');
        }
    }

    // FILTER GUDANG DAN KABUPATEN BERDASARKAN KANTOR CABANG (PANJI)
    public function gudangdankabupaten($gudang, $kabupaten)
    {
        $data = $this->model->gudangdankabupaten($gudang, $kabupaten, session()->get('id_kantor_cabang'));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Loading Order (LO)tidak ditemukan.');
        }
    }

    // FILTER KABUPATEN, KECAMATAN BERDASARKAN KANTOR CABANG (PANJI)

    public function kecamatanbykabupaten($kabupaten, $kecamatan)
    {
        $data = $this->model->kecamatanbykabupaten($kabupaten, $kecamatan, session()->get('id_kantor_cabang'));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Loading Order (LO)tidak ditemukan.');
        }
    }

    // FILTER GUDANG, KABUPATEN, KECAMATAN BERDASARKAN KANTOR CABANG (PANJI)
    public function gudangkabupatenkecamatan($gudang, $kabupaten, $kecamatan)
    {
        $data = $this->model->gudangkabupatenkecamatan($gudang, $kabupaten, $kecamatan, session()->get('id_kantor_cabang'));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Loading Order (LO)tidak ditemukan.');
        }
    }

    // MENAMPILKAN DETAIL LO
    function detaillo($nomorlo)
    {
        $data = $this->model->detaillo($nomorlo);
        if ($data) {
            $datalo = [
                "status" => "200",
                "data" => $data
            ];
        } else {
            $datalo = [
                "status" => "404",
            ];
        }
        return $this->respond($datalo);
    }

    // ================================= END MENU LOADING ORDER ===================================== //

    // ================================= MENU WORDKING ORDER ======================================== //


    public function getWoByIdKantor($awal, $akhir)
    {
        $data = $this->model->showWoByIdKantor(session()->get('id_kantor_cabang'), $awal, $akhir);
        if ($data) {
            $response = [
                'status' => "200",
                'data' => $data
            ];
            return $this->respond($response);
        } else {
            $response = [
                'status' => "404",
            ];
            return $this->respond($response);
        }
    }

    public function getwobykodewo($kodewo)
    {
        $data = $this->model->getwobykodewo($kodewo);
        if ($data) {
            $response = [
                'status' => "200",
                'data' => $data
            ];
            return $this->respond($response);
        } else {
            $response = [
                'status' => "404",
            ];
            return $this->respond($response);
        }
    }

    public function downloadWO($status_dokumen_muat)
    {
        $data = $this->model->downloadDokumenWo($status_dokumen_muat, session()->get("id_kantor_cabang"));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data WO Kantor tidak ditemukan.');
        }
    }

    // ================================= END MENU WORDKING ORDER ===================================== //


    // NANA DASHBOARD
    public function dashboard()
    {
        $data = $this->model->dashboard(session()->get('id_akun'));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Record LO aktif tidak ditemukan.');
        }
    }

    // NANA CEK NOMOR LO
    public function ceknomorlo()
    {
        $data = $this->model->ceknomorlo(session()->get('id_akun'));
        if ($data) {
            $bahannomorlo = [
                "status" => "200",
                "data" => $data,
            ];
            return $this->respond($bahannomorlo);
        } else {
            $bahannomorlo = [
                "status" => "404",
                "id_gudang" => session()->get('id_gudang'),
                "id_kantor_cabang" => session()->get('id_kantor_cabang'),
                "id_akun" => session()->get('id_akun'),
            ];
            return $this->respond($bahannomorlo);
        }
    }

    // NANA CEK NOMOR LO
    public function ceknomorlosubmit()
    {
        $data = $this->model->ceknomorlo(session()->get('id_akun'));
        $dataupdate = [
            "status_dokumen_muat" => "BELUM LENGKAP"
        ];
        $this->model->update($data->id_lo, $dataupdate);
        $bahannomorlo = [
            "status" => "200"
        ];
        return $this->respond($bahannomorlo);
    }

    // NANA CEK NOMOR LO
    public function bahannomorlo()
    {
        $data = $this->model->bahannomorlo(session()->get('id_akun'));
        $bahannomorlo = [
            "status" => "200",
            "data" => $data
        ];
        return $this->respond($bahannomorlo);
    }

    public function create()
    {
        $data = $this->request->getJSON();
        $datapbp = $this->modelPBP->find($data->id_pbp);
        $this->model->insert($data);
        $this->modelSJ->insert($data);
        $datapbpupdate = [
            "jumlah_alokasi" => $datapbp->jumlah_alokasi - $data->jumlah_penyaluran_januari,
        ];
        $this->modelPBP->update($data->id_pbp, $datapbpupdate);
        $datainsert = [
            "status" => "200",
        ];
        return $this->respond($datainsert);
    }

    public function deletelo($nomorlo)
    {
        $datahapus = [
            "nomor_lo" => $nomorlo,
        ];
        $this->model->deletelo($datahapus);
        $data = [
            "status" => "200",
        ];
        return $this->respond($data);
    }
    public function filter($awal, $akhir)
    {
        $data = $this->model->filter($awal, $akhir, session()->get('id_akun'));
        if ($data) {
            $datalo = [
                "status" => "200",
                "data" => $data
            ];
        } else {
            $datalo = [
                "status" => "404",
            ];
        }
        return $this->respond($datalo);
    }

    public function getLoByNoLo($nomorlo)
    {
        $data = $this->model->showlobynomorlo($nomorlo);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Loading Order (LO)tidak ditemukan.');
        }
    }

    public function editdatalo($idlo)
    {
        $data = $this->request->getJSON();
        $this->model->update($idlo, $data);

        $bahan = $this->model->find($idlo);
        if ($bahan->file_uplaod_lo == null || $bahan->file_upload_wo == null || $bahan->file_upload_do == null) {
            $status = [
                'status_dokumen_muat' => "BELUM LENGKAP"
            ];
        } else {
            $status = [
                'status_dokumen_muat' => "LENGKAP"
            ];
        }
        $this->model->update($idlo, $status);
        $response = [
            'status' => '200',
            'message' => $bahan,
        ];
        return $this->respond($response);
    }

    public function uploadfile1($idlo)
    {
        $datalo = $this->model->getkebutuhanupload($idlo);
        $bahandata = $this->request->getPost('additionalData');
        if ($bahandata == null) {
            $bahandata = "";
        }
        $additionalData = json_decode($bahandata, true);
        $namagudang = substr($datalo->nama_gudang, 5);
        $alamatnya = FCPATH  . 'upload/JANUARI/WO/' . $namagudang . '/' . $datalo->tanggal_muat . '/';
        $path = 'upload/JANUARI/WO/' . $namagudang . '/' . $datalo->tanggal_muat . '/';
        $cekfile = $alamatnya . "WO-" . $additionalData['kode_wo'] . ".pdf";
        if (file_exists($cekfile)) {
            unlink($cekfile);
        }
        $file1 = $this->request->getFile('file1');
        if ($file1->isValid() && !$file1->hasMoved()) {
            if ($file1->getExtension() == 'pdf') {
                $namawo = "WO-" . $additionalData['kode_wo'] . ".pdf";
                $file1->move($alamatnya, $namawo);
                $datadokumen = [
                    'file_upload_wo' => $namawo,
                    'path_upload_wo' => $path,
                ];
                $this->model->update($datalo->id_lo, $datadokumen);
                $response = [
                    'status' => '200',
                    'message' => 'Berkas Surat Jalan berhasil diupload',
                ];
                return $this->respond($response, 200);
            } else {
                $response = [
                    'status' => '400',
                    'message' => 'GAGAL'
                ];
                return $this->respond($response, 200);
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'GAGAL'
            ];
            return $this->respond($response, 400);
        }
    }

    public function uploadfile2($idlo)
    {
        $datalo = $this->model->getkebutuhanupload($idlo);
        $namagudang = substr($datalo->nama_gudang, 5);
        $alamatnya = FCPATH  . 'upload/JANUARI/LO/' . $namagudang . '/' . $datalo->tanggal_muat . '/';
        $path = 'upload/JANUARI/LO/' . $namagudang . '/' . $datalo->tanggal_muat . '/';
        $file2 = $this->request->getFile('file2');
        $bahandata = $this->request->getPost('additionalData');
        if ($bahandata == null) {
            $bahandata = "";
        }
        $additionalData = json_decode($bahandata, true);
        $cekfile = $alamatnya . $additionalData['nomor_lo'] . ".pdf";
        if (file_exists($cekfile)) {
            unlink($cekfile);
        }
        if ($file2->isValid() && !$file2->hasMoved()) {
            if ($file2->getExtension() == 'pdf') {
                $namawo = $additionalData['nomor_lo'] . ".pdf";
                $file2->move($alamatnya, $namawo);
                $datadokumen = [
                    'file_uplaod_lo' => $namawo,
                    'path_lo' => $path,
                ];
                $this->model->update($datalo->id_lo, $datadokumen);
                $response = [
                    'status' => '200',
                    'message' => 'Berkas Surat Jalan berhasil diupload',
                ];
                return $this->respond($response, 200);
            } else {
                $response = [
                    'status' => '400',
                    'message' => 'GAGAL'
                ];
                return $this->respond($response, 200);
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'GAGAL'
            ];
            return $this->respond($response, 400);
        }
    }

    public function uploadfile3($idlo)
    {
        $datalo = $this->model->getkebutuhanupload($idlo);
        $namagudang = substr($datalo->nama_gudang, 5);
        $alamatnya = FCPATH  . 'upload/JANUARI/DO/' . $namagudang . '/' . $datalo->tanggal_muat . '/';
        $path = 'upload/JANUARI/DO/' . $namagudang . '/' . $datalo->tanggal_muat . '/';
        $file3 = $this->request->getFile('file3');
        $bahandata = $this->request->getPost('additionalData');
        if ($bahandata == null) {
            $bahandata = "";
        }
        $additionalData = json_decode($bahandata, true);
        $cekfile = $alamatnya . "DO-" . $additionalData['kode_do'] . ".pdf";
        if (file_exists($cekfile)) {
            unlink($cekfile);
        }
        if ($file3->isValid() && !$file3->hasMoved()) {
            if ($file3->getExtension() == 'pdf') {
                $namawo = "DO-" . $additionalData['kode_do'] . ".pdf";
                $file3->move($alamatnya, $namawo);
                $datadokumen = [
                    'file_upload_do' => $namawo,
                    'path_uplaod_do' => $path,
                ];
                $this->model->update($datalo->id_lo, $datadokumen);
                $response = [
                    'status' => '200',
                    'message' => 'Berkas Surat Jalan berhasil diupload',
                ];
                return $this->respond($response, 200);
            } else {
                $response = [
                    'status' => '400',
                    'message' => 'GAGAL'
                ];
                return $this->respond($response, 200);
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'GAGAL'
            ];
            return $this->respond($response, 400);
        }
    }

    public function gettanggalwo()
    {
        $data = $this->model->gettanggalwo(session()->get('id_kantor_cabang'));
        if ($data) {
            $datalo = [
                "status" => "200",
                "data" => $data
            ];
        } else {
            $datalo = [
                "status" => "404",
            ];
        }
        return $this->respond($datalo);
    }

    public function getallwo($tanggal)
    {
        $data = $this->model->getallwo(session()->get('id_kantor_cabang'), $tanggal);
        if ($data) {
            $datalo = [
                "status" => "200",
                "data" => $data
            ];
        } else {
            $datalo = [
                "status" => "404",
            ];
        }
        return $this->respond($datalo);
    }
}
