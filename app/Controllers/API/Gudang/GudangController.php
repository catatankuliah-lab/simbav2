<?php

namespace App\Controllers\API\Gudang;

use App\Models\GudangModel;
use CodeIgniter\RESTful\ResourceController;

class GudangController extends ResourceController
{
    protected $model;

    public function __construct()
    {
        $this->model = new GudangModel();
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
            return $this->failNotFound('Record gudang tidak ditemukan.');
        }
    }

    public function showbykantor($id = null)
    {
        $data = $this->model->getGudangByKantor($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Record gudang tidak ditemukan.');
        }
    }

    public function create()
    {
        $data = $this->request->getJSON();

        if ($this->model->insert($data)) {
            $response = [
                'messages' => 'Record Gudang Berhasil Ditambahkan.'
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
            return $this->fail('Record gudang tidak ditemukan.', 404);
        }

        if ($this->model->update($id, $data)) {
            $response = [
                'messages' => 'Record gudang berhasil diperbaharui.'
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
            return $this->fail('Record gudang tidak ditemukan.', 404);
        }
        if ($this->model->delete($id)) {
            $response = [
                'status'   => 200,
                'error'    => 0,
                'messages' => 'Record gudang berhasil dihapus.'
            ];
            return $this->respond($response);
        } else {
            return $this->fail($this->model->errors(), 400);
        }
    }
}
