<?php

namespace App\Controllers\API\WilayahKerja;

use App\Models\WilayahKerjaModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class WilayahKerjaController extends ResourceController
{

    use ResponseTrait;

    protected $model;
    protected $modelKantor;

    public function __construct()
    {
        $this->model = new WilayahKerjaModel();
        $this->modelKantor = new WilayahKerjaModel();
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
            return $this->failNotFound('Record Wilayah Kerja Tidak Ditemukan.');
        }
    }

    public function create()
    {
        $data = $this->request->getJSON();

        if ($this->model->insert($data)) {
            $response = [
                'messages' => 'Rekaman Detail Wilayah Kerja Kantor Cabang berhasil ditambahkan.'
            ];
            return $this->respond($response, 201);
        } else {
            return $this->fail($this->model->errors());
        }
    }

    public function update($idkantor = null, $idwilayah = null)
    {
        $data = $this->request->getJSON();

        $existingData = $this->model->find($idkantor, $idwilayah);

        if (!$existingData) {
            return $this->fail('Record Wilayah Kerja tidak ditemukan.', 404);
        }

        if ($this->model->update($idwilayah, $data)) {
            $response = [
                'messages' => 'Record Wilayah Kerja berhasil diperbaharui.'
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
            return $this->fail('Record kantor wilayah kerja tidak ditemukan.', 404);
        }

        if ($this->model->delete($id)) {
            $response = [
                'messages' => 'Record kantor wilayah kerja berhasil dihapus.'
            ];
            return $this->respond($response);
        } else {
            return $this->fail($this->model->errors(), 400);
        }
    }



    public function getSession()
    {
        $userData = [
            'id_akun' => session()->get('id_akun'),
            'kode_provinsi' => session()->get('kode_provinsi')
        ];
        return $this->response->setJSON($userData);
    }

    function getWilayahKerjaByIdKantor($idkantor)
    {
        $data = $this->model->getByIdKantor($idkantor);
        return $this->respond($data);
    }

    function getWilayahKerjaByIdKantorIdWilayah($idkantor, $idwilayah)
    {
        $data = $this->model->WilayahKerjaByIdKantorIdWilayah($idkantor, $idwilayah, session()->get('id_akun'));
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Wilayah Kerja tidak ditemukan.');
        }
    }
}
