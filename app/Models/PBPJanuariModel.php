<?php

namespace App\Models;

use CodeIgniter\Model;

class PBPJanuariModel extends Model
{
    protected $table            = 'januari_pbp';
    protected $primaryKey       = 'id_pbp';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_pbp', 'nomor_danom', 'nama_provinsi', 'nama_kabupaten_kota', 'nama_kecamatan', 'nama_desa_kelurahan', 'jumlah_pbp', 'jumlah_alokasi', 'status_pbp'];

    public function getByKabupatenKota($nama_kabuapaten_kota)
    {
        $query = $this->db->table('januari_pbp')
            ->select('januari_pbp.*')
            ->where('januari_pbp.nama_kabupaten_kota', $nama_kabuapaten_kota)
            ->groupBy('januari_pbp.nama_kecamatan')
            ->get();
        return $query->getResult();
    }

    public function getByDesa($nama_kecamatan)
    {
        $query = $this->db->table('januari_pbp')
            ->select('januari_pbp.*')
            ->where('januari_pbp.nama_kecamatan', $nama_kecamatan)
            ->get();
        return $query->getResult();
    }

    // NANA AMBIL NAMA KECAMATAN
    public function kecamatanbykabupaten($namakabupatenkota)
    {
        $query = $this->db->table('januari_pbp')
            ->select('januari_pbp.nama_kecamatan')
            ->where('januari_pbp.nama_kabupaten_kota', $namakabupatenkota)
            ->groupBy('januari_pbp.nama_kecamatan')
            ->get();
        return $query->getResult();
    }

    // NANA AMBIL NAMA DESA
    public function desabykecamatan($namakecamatan, $namakabupaten)
    {
        $query = $this->db->table('januari_pbp')
            ->select('januari_pbp.*')
            ->where('januari_pbp.nama_kecamatan', $namakecamatan)
            ->where('januari_pbp.nama_kabupaten_kota', $namakabupaten)
            ->groupBy('januari_pbp.nama_desa_kelurahan')
            ->get();
        return $query->getResult();
    }

    // NANA AMBIL NAMA DESA
    public function getsumpbp($namakabupatenkota)
    {
        $query = $this->db->table('januari_pbp')
            ->select('januari_pbp.nama_kabupaten_kota')
            ->selectSum('januari_pbp.jumlah_pbp', 'jpbp')
            ->where('januari_pbp.nama_kabupaten_kota', $namakabupatenkota)
            ->get();
        return $query->getRow();
    }

    public function bahandashboardkc($namakabupatenkota)
    {
        $query = $this->db->table('januari_pbp')
            ->selectSum('januari_sj.jumlah_penyaluran_januari', 'jpenyaluran')
            ->join('januari_sj', 'januari_sj.id_pbp = januari_pbp.id_pbp')
            ->where('januari_pbp.nama_kabupaten_kota', $namakabupatenkota)
            ->get();
        return $query->getRow();
    }
}
