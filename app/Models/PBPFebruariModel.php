<?php

namespace App\Models;

use CodeIgniter\Model;

class PBPFebruariModel extends Model
{
    protected $table            = 'februari_pbp';
    protected $primaryKey       = 'id_pbp';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_pbp', 'nomor_danom', 'nama_provinsi', 'nama_kabupaten_kota', 'nama_kecamatan', 'nama_desa_kelurahan', 'jumlah_pbp', 'jumlah_alokasi', 'status_pbp'];

    public function getByKabupatenKota($nama_kabuapaten_kota)
    {
        $query = $this->db->table('februari_pbp')
            ->select('februari_pbp.*')
            ->where('februari_pbp.nama_kabupaten_kota', $nama_kabuapaten_kota)
            ->groupBy('februari_pbp.nama_kecamatan')
            ->get();
        return $query->getResult();
    }

    public function getByDesa($nama_kecamatan)
    {
        $query = $this->db->table('februari_pbp')
            ->select('februari_pbp.*')
            ->where('februari_pbp.nama_kecamatan', $nama_kecamatan)
            ->get();
        return $query->getResult();
    }

    // NANA AMBIL NAMA KECAMATAN
    public function kecamatanbykabupaten($namakabupatenkota)
    {
        $query = $this->db->table('februari_pbp')
            ->select('februari_pbp.nama_kecamatan')
            ->where('februari_pbp.nama_kabupaten_kota', $namakabupatenkota)
            ->groupBy('februari_pbp.nama_kecamatan')
            ->get();
        return $query->getResult();
    }

    // NANA AMBIL NAMA DESA
    public function desabykecamatan($namakecamatan, $namakabupaten)
    {
        $query = $this->db->table('februari_pbp')
            ->select('februari_pbp.*')
            ->where('februari_pbp.nama_kecamatan', $namakecamatan)
            ->where('februari_pbp.nama_kabupaten_kota', $namakabupaten)
            ->groupBy('februari_pbp.nama_desa_kelurahan')
            ->get();
        return $query->getResult();
    }

    // NANA DASHBOAR KANTOR CABANG
    public function getsumpbp($namakabupatenkota)
    {
        $query = $this->db->table('februari_pbp')
            ->select('februari_pbp.nama_kabupaten_kota')
            ->selectSum('februari_pbp.jumlah_pbp', 'jpbp')
            ->selectSum('februari_pbp.jumlah_alokasi', 'jalokasi')
            ->where('februari_pbp.nama_kabupaten_kota', $namakabupatenkota)
            ->get();
        return $query->getRow();
    }

    public function bahandashboardkc($namakabupatenkota)
    {
        $query = $this->db->table('februari_pbp')
            ->selectSum('februari_sj.jumlah_penyaluran_januari', 'jpenyaluran')
            ->join('februari_sj', 'februari_sj.id_pbp = februari_pbp.id_pbp')
            ->where('februari_pbp.nama_kabupaten_kota', $namakabupatenkota)
            ->get();
        return $query->getRow();
    }
}
