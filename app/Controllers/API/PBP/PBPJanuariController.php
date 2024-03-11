<?php

namespace App\Controllers\API\PBP;

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
    public function desabykecamatan($namakecamatan, $namakabupaten)
    {
        $data = $this->modelPBP->desabykecamatan($namakecamatan, $namakabupaten);
        $datadesakelurhan = [
            "status" => "200",
            "datadesakelurahan" => $data,
        ];
        return $this->respond($datadesakelurhan);
    }

    // NANA BAHAN DASHBOARD KANCAB
    public function bahandashboardkc($namakabupaten)
    {
        $data1 = $this->modelPBP->getsumpbp($namakabupaten);
        $data2 = $this->modelPBP->bahandashboardkc($namakabupaten);
        $dataperkabupaten = [
            "status" => "200",
            "datakabupaten" => $data1->nama_kabupaten_kota,
            "datasj" => $data2->jpenyaluran,
            "dataalokasi" => $data1->jpbp,
        ];
        return $this->respond($dataperkabupaten);
    }
}
