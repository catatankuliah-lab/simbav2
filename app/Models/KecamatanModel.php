<?php

namespace App\Models;

use CodeIgniter\Model;

class KecamatanModel extends Model
{
    protected $table = 'kecamatan';
    protected $primaryKey = 'id_kecamatan';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $returnType       = 'object';
    protected $allowedFields = ['kode_kabupaten_kota', 'kode_kecamatan', 'nama_kecamatan'];

    // Validationprotected 
    protected $validationRules = [
        'kode_kabupaten_kota' => 'required|max_length[20]',
        'kode_kecamatan' => 'required|max_length[20]',
        'nama_kecamatan' => 'required|max_length[255]',
    ];

    protected $validationMessages = [
        'kode_kabupaten_kota' => [
            'required' => 'Kode Kecamatan harus diisi.',
            'max_length' => 'Kode Kecamatan tidak boleh lebih dari 10 karakter.',
        ],
        'kode_kecamatan' => [
            'required' => 'Kode Kecamatan harus diisi.',
            'max_length' => 'Kode Kecamatan tidak boleh lebih dari 20 karakter.',
        ],
        'nama_kecamatan' => [
            'required' => 'Nama Kecamatan harus diisi.',
            'max_length' => 'Nama Kecamatan tidak boleh lebih dari 255 karakter.',
        ],
    ];

    public function getByKabupatenKota($kodeKabupatenKota)
    {
        $query = $this->db->table('kecamatan')
            ->select('kecamatan.*')
            ->where('kecamatan.kode_kabupaten_kota', $kodeKabupatenKota)
            ->get();
        return $query->getResult();
    }

    public function getKecamatanByGudang($id_kantor)
    {
        $query = $this->db->table('kecamatan')
            ->select('kecamatan.*, gudang.*, wilayah_kerja.*')
            ->join('wilayah_kerja', 'wilayah_kerja.kode_kabupaten_kota = kabupaten_kota.kode_kabupaten_kota', 'left')
            ->join('gudang', 'gudang.id_kantor = kantor.id_kantor', 'left')
            ->where('kantor.id_kantor', $id_kantor)
            ->get();

        return $query->getResult();
    }
}
