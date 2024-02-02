<?php

namespace App\Models;

use CodeIgniter\Model;

class LOJanuariModel extends Model
{
    protected $table            = 'januari_lo';
    protected $primaryKey       = 'id_lo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_gudang', 'id_kantor', 'id_akun', 'nomor_lo', 'tanggal_muat', 'nama_driver', 'nomor_driver', 'nomor_mobil', 'file_dokumen_muat', 'file_upload_dokumen_muat', 'path_dokumen_muat', 'path_upload_dokumen_muat'];


    public function getAllLoByCabang($idkantor)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, gudang.*,')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->where('januari_lo.id_kantor', $idkantor)
            ->orderBy('januari_lo.tanggal_muat', 'DESC')
            ->orderBy('januari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    // public function getAllLoByCabang($idkantor)
    // {
    //     $query = $this->db->table('januari_lo')
    //     ->select('januari_lo.*, gudang.*, januari_sj.*')
    //     ->selectSum('januari_sj.jumlah_penyaluran_januari', 'total')
    //     ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
    //     ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
    //     ->where('januari_lo.id_kantor', $idkantor)
    //         ->groupBy('januari_sj.nomor_lo')
    //         ->orderBy('januari_lo.tanggal_muat', 'DESC')
    //         ->orderBy('januari_lo.id_lo', 'DESC')
    //         ->get();
    //     return $query->getResult();
    // }
}
