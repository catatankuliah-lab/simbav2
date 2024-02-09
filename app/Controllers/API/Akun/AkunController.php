<?php

namespace App\Controllers\API\Akun;

use App\Models\AkunModel;
use CodeIgniter\RESTful\ResourceController;

class AkunController extends ResourceController
{
    protected $model;

    public function __construct()
    {
        $this->model = new AkunModel();
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

    public function index()
    {
        $data = $this->model->findAll();
        return $this->respondCreated($data);
    }

    public function show($id = null)
    {
        $data = $this->model->getAkunByIdAkun($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Record akun ditemukan.');
        }
    }

    public function showbykantor($id = null)
    {
        $data = $this->model->getAkunByKantor($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Record akun ditemukan.');
        }
    }

    public function showbyhakakses($id = null)
    {
        $data = $this->model->getAkunByHakAkses($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Record akun ditemukan.');
        }
    }

    public function hakaksesdankantor($id = null, $id2 = null)
    {
        $data = $this->model->getAkunByHakAksesAndKantor($id, $id2);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Record akun ditemukan.');
        }
    }

    public function create()
    {
        $data = $this->request->getJSON();

        if ($this->model->insert($data)) {
            $response = [
                'messages' => 'Record akun berhasil ditambahkan.'
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
            return $this->fail('Record akun tidak ditemukan.', 404);
        }

        if ($this->model->update($id, $data)) {
            $response = [
                'messages' => 'Record akun berhasil diperbaharui.'
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
            return $this->fail('Record akun tidak ditemukan.', 404);
        }
        if ($this->model->delete($id)) {
            $response = [
                'messages' => 'Record akun berhasil dihapus.'
            ];
            return $this->respond($response);
        } else {
            return $this->fail($this->model->errors(), 400);
        }
    }

    public function proseslogin()
    {
        $data = $this->request->getJSON();

        $data = $this->model->getAkunByUsernamePassword($data->username, $data->password);
        if ($data) {
            session()->set('id_akun', $data->id_akun);
            session()->set('id_gudang', $data->id_gudang);
            session()->set('id_kantor_cabang', $data->id_kantor_cabang);
            session()->set('id_hak_akses', $data->id_hak_akses);
            session()->set('nama_lengkap', $data->nama_lengkap);
            session()->set('login', true);
            return $this->respond($data);
        } else {
            return $this->respond("Username atau Password Salah");
        }
    }
}
