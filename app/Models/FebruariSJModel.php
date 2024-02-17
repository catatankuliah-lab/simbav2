<?php

namespace App\Models;

use CodeIgniter\Model;

class FebruariSJModel extends Model
{
    protected $table            = 'februari_sj';
    protected $primaryKey       = 'id_sj';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id_pbp",
        "nomor_lo",
        "jumlah_penyaluran_januari",
        "nomor_surat_jalan",
        "file_surat_jalan",
        "path_surat_jalan",
        "file_bukti_surat_jalan",
        "path_bukti_surat_jalan"
    ];

    public function ceknomorsj($nomorsj)
    {
        $query = $this->db->table('februari_sj')
            ->select('februari_sj.*')
            ->where('februari_sj.nomor_surat_jalan', $nomorsj)
            ->get();
        return $query->getRow();
    }

    public function datasj($nomorlo)
    {
        $query = $this->db->table('februari_sj')
            ->select('februari_sj.*, februari_pbp.*')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->where('februari_sj.nomor_lo', $nomorlo)
            ->get();
        return $query->getResult();
    }

    public function detailsj($idsj)
    {
        $query = $this->db->table('februari_sj')
            ->select('februari_sj.*, februari_pbp.*, februari_lo.*, gudang.nama_gudang')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->join('februari_lo', 'februari_lo.nomor_lo = februari_sj.nomor_lo')
            ->join('gudang', 'gudang.id_gudang = februari_lo.id_gudang')
            ->where('februari_sj.id_sj', $idsj)
            ->get();
        return $query->getRow();
    }
}