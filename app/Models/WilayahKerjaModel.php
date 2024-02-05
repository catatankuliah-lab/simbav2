<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahKerjaModel extends Model
{
    protected $table = 'wilayah_kerja';
    protected $primaryKey = 'id_wilayah_kerja';
    protected $allowedFields = ['nama_kabupaten_kota', 'id_kantor_cabang'];
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;

    protected $validationRules = [
        'nama_kabupaten_kota' => 'required|is_unique[wilayah_kerja.nama_kabupaten_kota]',
        'id_kantor_cabang' => 'required'
    ];

    protected $validationMessages = [
        'nama_kabupaten_kota' => [
            'required' => 'Kabupaten/Kota kantor harus diisi.',
            'is_unique' => 'Wilayah Kerja sudah ada.',
        ],
        'id_kantor_cabang' => [
            'required' => 'Kantor Cabang harus diisi.',
        ]
    ];

    public function getByIdKantor($idkantor)
    {
        $query = $this->db->table('wilayah_kerja')
            ->select('wilayah_kerja.*, kantor_cabang.*, kabupaten_kota.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = wilayah_kerja.id_kantor_cabang', 'left')
            ->join('kabupaten_kota', 'kabupaten_kota.nama_kabupaten_kota = wilayah_kerja.nama_kabupaten_kota', 'left')
            ->where('wilayah_kerja.id_kantor_cabang', $idkantor)
            ->get();
        return $query->getResult();
    }

    public function getById($id)
    {
        $query = $this->db->table('kantor_cabang')
            ->select('kantor_cabang.*, provinsi.nama_provinsi')
            ->join('provinsi', 'provinsi.kode_provinsi = kantor_cabang.kode_provinsi', 'left')
            ->where('kantor_cabang.id_kantor_cabang', $id)
            ->get();
        return $query->getRow();
    }

    public function getByKodeProvinsi($kodeProvinsi)
    {
        $query = $this->db->table('kantor')
            ->select('kantor.*, provinsi.nama_provinsi')
            ->join('provinsi', 'provinsi.kode_provinsi = kantor.kode_provinsi', 'left')
            ->where('kantor.kode_provinsi', $kodeProvinsi)
            ->get();
        return $query->getResult();
    }

    public function WilayahKerjaByIdKantorIdWilayah($idkantor, $idwilayah)
    {
        $query = $this->db->table('wilayah_kerja')
            ->select('wilayah_kerja.*, kantor_cabang.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = wilayah_kerja.id_kantor_cabang', 'left')
            ->where('wilayah_kerja.id_kantor_cabang', $idkantor)
            ->where('wilayah_kerja.id_wilayah_kerja', $idwilayah)
            ->get();
        return $query->getResult();
    }
}
