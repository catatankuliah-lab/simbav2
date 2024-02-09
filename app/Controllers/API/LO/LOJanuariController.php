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

    public function getbyidkantor($idkantor)
    {
        $dataspm = $this->model->getAllLOByCabang($idkantor);
        if ($dataspm) {
            return $this->respond($dataspm);
        } else {
            return $this->failNotFound('Record LO Kantor Cabang aktif tidak ditemukan.');
        }
    }

    public function getGudangByIdKantor($namaGudang)
    {
        $data = $this->model->LOGudangByIdKantor($namaGudang, session()->get('id_kantor'));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Loading Order Kantor (LO) tidak ditemukan.');
        }
    }

    public function getKabupatenByIdKantor($namaKabupaten)
    {
        $data = $this->model->LOKabupatenByIdKantor($namaKabupaten, session()->get('id_kantor'));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Loading Order Kantor (LO) tidak ditemukan.');
        }
    }

    public function getKabupatenKecamatanByIdKantor($namaKabupaten, $namaKecamatan)
    {
        $data = $this->model->LOKabupatenKecamatanByIdKantor($namaKabupaten, $namaKecamatan, session()->get('id_kantor'));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Loading Order Kantor (LO) tidak ditemukan.');
        }
    }

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

    function showDetailSuratJalan($id_lo)
    {
        $data = $this->model->getDetailSuratJalan($id_lo);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Loading Order (LO)tidak ditemukan.');
        }
    }

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

    public function uploadfile($idlo)
    {

        $datalo = $this->model->getkebutuhanupload($idlo);
        $namagudang = substr($datalo->nama_gudang, 5);
        // $response = [
        //     'status' => '200',
        //     'message' => $datalo->nomor_lo
        // ];
        // return $this->respond($response);
        $alamatnya = FCPATH  . 'UPLOAD/1/LO/' . $namagudang . '/' . $datalo->tanggal_muat . '/';
        $path = 'UPLOAD/1/LO/' . $namagudang . '/' . $datalo->tanggal_muat . '/';
        $file1 = $this->request->getFile('filewo');
        $file2 = $this->request->getFile('filelo');
        $file3 = $this->request->getFile('filedo');
        $file4 = $this->request->getFile('filepenyerahan');
        $file5 = $this->request->getFile('filesjbulog');
        $file6 = $this->request->getFile('filebast');
        $bahandata = $this->request->getPost('additionalData');
        if ($bahandata == null) {
            $bahandata = "";
        }
        $additionalData = json_decode($bahandata, true);
        if ($file1->isValid() && !$file1->hasMoved() && $file2->isValid() && !$file2->hasMoved() && $file3->isValid() && !$file3->hasMoved() && $file4->isValid() && !$file4->hasMoved() && $file5->isValid() && !$file5->hasMoved() && $file6->isValid() && !$file6->hasMoved()) {
            if ($file1->getExtension() == 'jpg' || $file1->getExtension() == 'png' || $file1->getExtension() == 'jpeg' || $file2->getExtension() == 'jpg' || $file2->getExtension() == 'png' || $file2->getExtension() == 'jpeg' || $file3->getExtension() == 'jpg' || $file3->getExtension() == 'png' || $file3->getExtension() == 'jpeg' || $file4->getExtension() == 'jpg' || $file4->getExtension() == 'png' || $file4->getExtension() == 'jpeg' || $file5->getExtension() == 'jpg' || $file5->getExtension() == 'png' || $file5->getExtension() == 'jpeg' || $file6->getExtension() == 'jpg' || $file6->getExtension() == 'png' || $file6->getExtension() == 'jpeg') {
                $namawo = $additionalData['kode_wo'] . ".png";
                $namalo = $datalo->nomor_lo . ".png";
                $namado = $additionalData['kode_do'] . ".png";
                $namafp = "SP" . $additionalData['kode_do'] . ".png";
                $namasj = "SJB" . $additionalData['kode_do'] . ".png";
                $namabast = "BAST" . $additionalData['kode_do'] . ".png";
                $file1->move($alamatnya, $namawo);
                $file2->move($alamatnya, $namalo);
                $file3->move($alamatnya, $namado);
                $file4->move($alamatnya, $namafp);
                $file5->move($alamatnya, $namasj);
                $file6->move($alamatnya, $namabast);
                $datadokumen = [
                    'nomor_wo' => $additionalData['nomor_wo'],
                    'nomor_do' => $additionalData['nomor_do'],
                    'nomor_so' => $additionalData['nomor_so'],
                    'kode_wo' => $additionalData['kode_wo'],
                    'kode_do' => $additionalData['kode_do'],
                    'kode_so' => $additionalData['kode_so'],
                    'file_upload_wo' => $namawo,
                    'file_upload_do' => $namado,
                    'file_upload_salur_bulog' => $namafp,
                    'file_uplaod_lo' => $namalo,
                    'file_upload_sj_bulog' => $namasj,
                    'file_upload_bast_bulog' => $namabast,
                    'path_upload_wo' => $path,
                    'path_upload_do' => $path,
                    'path_upload_salur_bulog' => $path,
                    'path_uplaod_lo' => $path,
                    'path_upload_sj_bulog' => $path,
                    'path_upload_bast_bulog' => $path,
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
}
