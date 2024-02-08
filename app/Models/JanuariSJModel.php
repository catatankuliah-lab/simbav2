<?php

namespace App\Models;

use CodeIgniter\Model;

class JanuariSJModel extends Model
{
    protected $table            = 'januari_sj';
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
        "path_surat_jalan"
    ];

    public function ceknomorsj($nomorsj)
    {
        $query = $this->db->table('januari_sj')
            ->select('januari_sj.*')
            ->where('januari_sj.nomor_surat_jalan', $nomorsj)
            ->get();
        return $query->getRow();
    }

    public function datasj($nomorlo)
    {
        $query = $this->db->table('januari_sj')
            ->select('januari_sj.*, januari_pbp.*')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_sj.nomor_lo', $nomorlo)
            ->get();
        return $query->getResult();
    }

    public function detailsj($idsj)
    {
        $query = $this->db->table('januari_sj')
            ->select('januari_sj.*, januari_pbp.*')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_sj.id_sj', $idsj)
            ->get();
        return $query->getRow();
    }
}
