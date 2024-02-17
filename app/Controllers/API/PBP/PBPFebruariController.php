<?php

namespace App\Controllers\API\PBP;

use App\Models\PBPFebruariModel;
use CodeIgniter\RESTful\ResourceController;

class PBPFebruariController extends ResourceController
{
    protected $modelPBP;

    public function __construct()
    {
        $this->modelPBP = new PBPFebruariModel();
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

    // NANA SHOW KECAMATAN BY KABUPATEN
    public function kecamatanbykabupaten($namakabupatenkota)
    {
        $data = $this->modelPBP->kecamatanbykabupaten($namakabupatenkota);
        $datakecamatan = [
            "status" => "200",
            "datakecamatan" => $data,
        ];
        return $this->respond($datakecamatan);
    }

    // NANA SHOW DESA BY KECAMATAN
    public function desabykecamatan($namakecamatan)
    {
        $data = $this->modelPBP->desabykecamatan($namakecamatan);
        $datadesakelurhan = [
            "status" => "200",
            "datadesakelurahan" => $data,
        ];
        return $this->respond($datadesakelurhan);
    }

    // NANA SHOW DESA BY KECAMATAN
    public function bahandashboardkc($namakabupaten)
    {
        $data = $this->modelPBP->bahandashboardkc($namakabupaten);
        $dataperkabupaten = [
            "status" => "200",
            "data" => $data,
        ];
        return $this->respond($dataperkabupaten);
    }
}
