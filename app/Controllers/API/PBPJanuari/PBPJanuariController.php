<?php

namespace App\Controllers\API\PBPJanuari;

use App\Models\PBPJanuariModel;
use CodeIgniter\RESTful\ResourceController;

class PBPJanuariController extends ResourceController
{
    protected $modelPBP;

    public function __construct()
    {
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

    public function showByKabupatenKota($id = null)
    {
        $data = $this->modelPBP->getByKabupatenKota($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Record kecamatan tidak ditemukan.');
        }
    }

    public function showByDesa($id = null)
    {
        $data = $this->modelPBP->getByDesa($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Record kecamatan tidak ditemukan.');
        }
    }
}
