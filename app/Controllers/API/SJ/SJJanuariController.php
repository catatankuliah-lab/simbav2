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

    public function uploadfile($idsj)
    {
        $datasj = $this->model->detailsj($idsj);
        $namagudang = substr($datasj->nama_gudang, 5);
        $alamatnya = FCPATH  . 'UPLOAD/1/SJ/' . $namagudang . '/' . $datasj->tanggal_muat . '/';
        $path = 'UPLOAD/1/SJ/' . $namagudang . '/' . $datasj->tanggal_muat . '/';
        $file1 = $this->request->getFile('filesj');
        $file2 = $this->request->getFile('filebukti');
        $bahandata = $this->request->getPost('additionalData');
        if ($bahandata == null) {
            $bahandata = "";
        }
        $additionalData = json_decode($bahandata, true);
        if ($file1->isValid() && !$file1->hasMoved() && $file2->isValid() && !$file2->hasMoved()) {
            if ($file1->getExtension() == 'jpg' || $file1->getExtension() == 'png' || $file1->getExtension() == 'jpeg' || $file2->getExtension() == 'jpg' || $file2->getExtension() == 'png' || $file2->getExtension() == 'jpeg') {
                $namasj = $datasj->nomor_surat_jalan . ".png";
                $namabukti = "BUKTI-" . $datasj->nomor_surat_jalan . ".png";
                $file1->move($alamatnya, $namasj);
                $file2->move($alamatnya, $namabukti);
                $datadokumen = [
                    'file_surat_jalan' => $namasj,
                    'file_bukti_surat_jalan' => $namabukti,
                    'path_surat_jalan' => $path,
                    'path_bukti_surat_jalan' => $path
                ];
                $this->model->update($idsj, $datadokumen);
                $datacekstatus = $this->modelLO->cekstatusdokumen($datasj->id_lo);
                $lengkap = false;
                $ulangi = true;
                foreach ($datacekstatus as $cek) {
                    if ($ulangi == true) {
                        if ($cek->file_uplaod_lo == NULL || $cek->file_upload_bast_bulog == NULL || $cek->file_upload_do == NULL || $cek->file_upload_salur_bulog == NULL || $cek->file_upload_sj_bulog == NULL || $cek->file_upload_wo == NULL || $cek->file_bukti_surat_jalan == NULL || $cek->file_surat_jalan == NULL) {
                            $lengkap = false;
                            $ulangi = false;
                        } else {
                            $lengkap = true;
                        }
                    }
                }
                if ($lengkap == false) {
                    $datalo = [
                        "status_dokumen_muat" => "BELUM LENGKAP"
                    ];
                } else {
                    $datalo = [
                        "status_dokumen_muat" => "LENGKAP"
                    ];
                }
                $this->modelLO->update($datacekstatus[0]->id_lo, $datalo);
                $response = [
                    'status' => '200',
                    'message' => 'Berkas Surat Jalan berhasil diupload',
                ];
                return $this->respond($response, 200);
            } else {
                $response = [
                    'status' => '400',
                    'message' => 'GAGAL'
                ];
                return $this->respond($response, 200);
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'GAGAL'
            ];
            return $this->respond($response, 400);
        }
    }
}
