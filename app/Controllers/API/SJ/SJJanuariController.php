<?php

namespace App\Controllers\API\SJ;

use App\Models\JanuariSJModel;
use App\Models\LOJanuariModel;
use App\Models\PBPJanuariModel;
use CodeIgniter\RESTful\ResourceController;

class SJJanuariController extends ResourceController
{
    protected $model;
    protected $modelPBP;
    protected $modelLO;

    public function __construct()
    {
        $this->model = new JanuariSJModel();
        $this->modelPBP = new PBPJanuariModel();
        $this->modelLO = new LOJanuariModel();
    }

    // NANA CEK SURAT JALAN
    public function ceknomorsj($nomorlo)
    {
        $data = $this->model->ceknomorsj($nomorlo);
        if ($data == null) {
            $datasuratjalan = [
                "id_gudang" => session()->get('id_gudang'),
                "id_kantor_cabang" => session()->get('id_kantor_cabang'),
                "id_akun" => session()->get('id_akun'),
                "status" => "404",
                "data" => $data
            ];
        } else {
            $datasuratjalan = [
                "id_gudang" => session()->get('id_gudang'),
                "id_kantor_cabang" => session()->get('id_kantor_cabang'),
                "id_akun" => session()->get('id_akun'),
                "status" => "200",
                "data" => $data
            ];
        }
        return $this->respond($datasuratjalan);
    }

    public function create()
    {
        $data = $this->request->getJSON();
        $datapbp = $this->modelPBP->find($data->id_pbp);
        $this->model->insert($data);
        $datapbpupdate = [
            "jumlah_alokasi" => $datapbp->jumlah_alokasi - $data->jumlah_penyaluran_januari,
        ];
        $this->modelPBP->update($data->id_pbp, $datapbpupdate);
        $datainsert = [
            "status" => "200",
        ];
        return $this->respond($datainsert);
    }

    public function datasj($nomorlo)
    {
        $data = $this->model->datasj($nomorlo);
        $datasuratjalan = [
            "status" => "200",
            "data" => $data
        ];
        return $this->respond($datasuratjalan);
    }

    public function deletesj()
    {
        $data = $this->request->getJSON();
        $datasj = $this->model->detailsj($data->id_sj);
        $dataupdate = [
            "id_pbp" => $datasj->id_pbp,
            "jumlah_alokasi" => $datasj->jumlah_alokasi + $data->alokasi_hapus,
        ];
        $this->model->delete($data->id_sj);
        $this->modelPBP->update($datasj->id_pbp, $dataupdate);
        $datasuratjalan = [
            "status" => "200",
        ];
        return $this->respond($datasuratjalan);
    }

    public function ceknomorlo($nomorlo)
    {
        $data = $this->model->ceknomorlo($nomorlo);
        if ($data == null) {
            $datasuratjalan = [
                "id_gudang" => session()->get('id_gudang'),
                "id_kantor_cabang" => session()->get('id_kantor_cabang'),
                "id_akun" => session()->get('id_akun'),
                "status" => "404",
                "data" => $data
            ];
        } else {
            $datasuratjalan = [
                "id_gudang" => session()->get('id_gudang'),
                "id_kantor_cabang" => session()->get('id_kantor_cabang'),
                "id_akun" => session()->get('id_akun'),
                "status" => "200",
                "data" => $data
            ];
        }
        return $this->respond($datasuratjalan);
    }

    public function detailitemsj($idsj)
    {
        $data = $this->model->detailsj($idsj);
        if ($data == null) {
            $datasuratjalan = [
                "status" => "404",
            ];
        } else {
            $datasuratjalan = [
                "status" => "200",
                "data" => $data
            ];
        }
        return $this->respond($datasuratjalan);
    }

    public function jampenerimaan($idsj)
    {
        $data = $this->request->getJSON();
        $this->model->update($idsj, $data);
        $response = [
            'status' => '200',
            'message' => 'Berhasil',
        ];
        return $this->respond($response);
    }
}
