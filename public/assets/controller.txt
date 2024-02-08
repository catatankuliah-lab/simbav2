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
}
