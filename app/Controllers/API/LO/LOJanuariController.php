<?php

namespace App\Controllers\API\LO;

use App\Models\LOJanuariModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class LOJanuariController extends ResourceController
{

    use ResponseTrait;
    protected $model;

    public function __construct()
    {
        $this->model = new LOJanuariModel();
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
        $dataspm = $this->model->getAllLOByCabang($idkantor, session()->get('id_kantor'));
        if ($dataspm) {
            return $this->respond($dataspm);
        } else {
            return $this->failNotFound('Record LO Kantor Cabang aktif tidak ditemukan.');
        }
    }
}
