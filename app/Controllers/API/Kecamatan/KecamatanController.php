<?php

namespace App\Controllers\API\Kecamatan;

use App\Models\KecamatanModel;
use CodeIgniter\RESTful\ResourceController;

class KecamatanController extends ResourceController
{
    protected $model;

    public function __construct()
    {
        $this->model = new KecamatanModel();
    }

    public function index()
    {
        $data = $this->model->findAll();
        return $this->respondCreated($data);
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Record kecamatan tidak ditemukan.');
        }
    }

    public function showByKabupatenKota($id = null)
    {
        $data = $this->model->getByKabupatenKota($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Record kecamatan tidak ditemukan.');
        }
    }

    public function showByGudang($id = null)
    {
        $data = $this->model->getKecamatanByGudang($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Record Gudang tidak ditemukan.');
        }
    }
    

    public function create()
    {
        $data = $this->request->getJSON();

        if ($this->model->insert($data)) {
            $response = [
                'status'   => 201,
                'error'    => 0,
                'messages' => 'Record kecamatan berhasil ditambahkan.'
            ];
            return $this->respond($response, 201);
        } else {
            return $this->fail($this->model->errors());
        }
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON();

        $existingData = $this->model->find($id);

        if (!$existingData) {
            return $this->fail('Record kecamatan tidak ditemukan.', 404);
        }

        if ($this->model->update($id, $data)) {
            $response = [
                'status'   => 200,
                'error'    => 0,
                'messages' => 'Record kecamatan berhasil diperbaharui.'
            ];
            return $this->respond($response);
        } else {
            return $this->fail($this->model->errors(), 400);
        }
    }

    public function delete($id = null)
    {
        $existingData = $this->model->find($id);

        if (!$existingData) {
            return $this->fail('Record kecamatan tidak ditemukan.', 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'status'   => 200,
                'error'    => 0,
                'messages' => 'Record kecamatan berhasil dihapus.'
            ];
            return $this->respond($response);
        } else {
            return $this->fail($this->model->errors(), 400);
        }
    }
}
