<?php

namespace App\Controllers\API\WOJanuari;

use App\Models\WOJanuariModel;
use CodeIgniter\RESTful\ResourceController;
use Config\Session;

class WOJanuariController extends ResourceController
{
    protected $modelWOJanuari;

    public function __construct()
    {
        $this->modelWOJanuari = new WOJanuariModel();
    }

    public function getWoByIdKantor($idkantor)
    {
        $data = $this->modelWOJanuari->showWoByIdKantor($idkantor, session()->get("id_akun"));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data WO Kantor tidak ditemukan.');
        }
    }

    public function showKabupatenByIdKantor($namaKabupaten)
    {
        $data = $this->modelWOJanuari->showKabupatenByIdKantor($namaKabupaten, session()->get("id_akun"));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data WO Kantor tidak ditemukan.');
        }
    }

    public function getalldatawo($idkantor)
    {
        $data = $this->modelWOJanuari->getAllByIdKantor($idkantor, session()->get("id_akun"));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data WO Kantor tidak ditemukan.');
        }
    }

    public function getAlokasiFilter($awal, $akhir)
    {
        $data = $this->modelWOJanuari->getAlokasiFilter($awal, $akhir, session()->get("id_kantor_cabang"));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data WO Kantor tidak ditemukan.');
        }
    }
    
    public function getDetailWO($nomorwo)
    {
        $data = $this->modelWOJanuari->showDetailWO($nomorwo, session()->get("id_kantor_cabang"));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data WO Kantor tidak ditemukan.');
        }
    }

    public function downloadWO($status_dokumen_muat)
    {
        $data = $this->modelWOJanuari->downloadDokumenWo($status_dokumen_muat, session()->get("id_kantor_cabang"));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data WO Kantor tidak ditemukan.');
        }
    }
}
