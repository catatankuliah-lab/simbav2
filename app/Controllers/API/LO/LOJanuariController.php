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

    // Mengambil data Loading Order dari Kantor Cabang (Panji)
    public function getbyidkantor($idkantor) 
    {
        $dataspm = $this->model->getAllLOByCabang($idkantor);
        if ($dataspm) {
            return $this->respond($dataspm);
        } else {
            return $this->failNotFound('Record LO Kantor Cabang aktif tidak ditemukan.');
        }
    }

     // Mengambil data Gudang dari Kantor Cabang (Panji)
    public function getGudangByIdKantor($namaGudang)
    {
        $data = $this->model->LOGudangByIdKantor($namaGudang, session()->get('id_kantor'));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Loading Order Kantor (LO) tidak ditemukan.');
        }
    }

      // Mengambil data Kabupaten dari Kantor Cabang (Panji)
    public function getKabupatenByIdKantor($namaKabupaten)
    {
        $data = $this->model->LOKabupatenByIdKantor($namaKabupaten, session()->get('id_kantor'));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Loading Order Kantor (LO) tidak ditemukan.');
        }
    }

      // Mengambil LO dari Nomor LO  (Panji)
    function showDetailLo($nomorlo) 
    {
        $data = $this->model->getLOByNomorLo($nomorlo);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Loading Order (LO)tidak ditemukan.');
        }
    }

     // Mengambil data Surat Jalan dari Id_lo (Panji)
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
}
