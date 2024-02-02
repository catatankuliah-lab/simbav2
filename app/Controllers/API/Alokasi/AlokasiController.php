<?php

namespace App\Controllers\API\Alokasi;

use App\Models\AlokasiModel;
use CodeIgniter\RESTful\ResourceController;

class AlokasiController extends ResourceController
{

    protected $model;

    public function __construct()
    {
        $this->model = new AlokasiModel();
    }

    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data);

    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Record alokasi tidak ditemukan.');
        }
    }
}
