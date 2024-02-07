<?php

namespace App\Controllers\API\WOJanuari;

use App\Models\WOJanuariModel;
use CodeIgniter\RESTful\ResourceController;

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

    public function getalldatawo($idkantor) {
        $data = $this->modelWOJanuari->getAllByIdKantor($idkantor, session()->get("id_akun"));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data WO Kantor tidak ditemukan.');
        }
    }
}
