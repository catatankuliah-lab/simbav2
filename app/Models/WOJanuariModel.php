<?php

namespace App\Models;

use CodeIgniter\Model;

class WOJanuariModel extends Model
{
    protected $table            = 'januari_wo';
    protected $primaryKey       = 'id_wo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_lo', 'nomor_wo', 'tanggal_wo', 'file_wo', 'path_wo', 'status_wo', 'id_akun'];

    public function showWoByIdKantor($idkantor)
    {
        $query = $this->db->table('januari_wo')
            ->select('januari_wo.*, kantor_cabang.*, januari_lo.*, januari_sj.*, januari_pbp.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = januari_wo.id_kantor_cabang')
            ->join('januari_lo', 'januari_lo.id_akun = januari_wo.id_akun')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_wo.id_kantor_cabang', $idkantor)
            ->get();
        return $query->getResult();
    }

    public function showKabupatenByIdKantor($namaKabupaten, $idAkun)
    {

        $query = $this->db->table('januari_wo')
            ->select('januari_wo.*, akun.*, januari_lo.*, januari_sj.*, januari_pbp.*')
            ->join('akun', 'akun.id_kantor_cabang = januari_wo.id_kantor_cabang')
            ->join('januari_lo', 'januari_lo.id_kantor = akun.id_kantor_cabang')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('akun.id_akun', $idAkun)
            ->where('januari_pbp.nama_kabupaten_kota', $namaKabupaten)
            ->groupBy('januari_pbp.nama_kabupaten_kota')
            ->get();
        return $query->getResult();
    }

    public function getWOyNomorWO($nomorwo)
    {
        $query = $this->db->table('januari_wo')
            ->select('januari_wo.*, januari_sj.*')
            ->join('januari_sj', 'januari_sj.nomor_wo = januari_wo.nomor_wo')
            ->where('januari_wo.nomor_wo', $nomorwo)
            ->get();
        return $query->getResult();
    }

    public function getAllByIdKantor($idkantor)
    {
        $query = $this->db->table('januari_wo')
            ->select('januari_wo.*, januari_lo.*, januari_sj.*')
            ->join('januari_lo', 'januari_lo.id_kantor = januari_wo.id_kantor_cabang')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->where('januari_wo.id_kantor_cabang', $idkantor)
            ->get();
        return $query->getResult();
    }

    public function getAlokasiFilter($awal, $akhir, $idkantor)
    {
        $query = $this->db->table('januari_wo')
            ->select('januari_wo.*, kantor_cabang.*, januari_lo.*, januari_sj.*, januari_pbp.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = januari_wo.id_kantor_cabang')
            ->join('januari_lo', 'januari_lo.id_akun = januari_wo.id_akun')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_wo.id_kantor_cabang', $idkantor)
            ->where('januari_wo.tanggal_wo >=', $awal)
            ->where('januari_wo.tanggal_wo <=', $akhir)
            ->get();
        return $query->getResult();
    }


    public function showDetailWO($nomorwo)
    {
        $query = $this->db->table('januari_wo')
            ->select('januari_wo.*, kantor_cabang.*, januari_lo.*, januari_sj.*, januari_pbp.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = januari_wo.id_kantor_cabang')
            ->join('januari_lo', 'januari_lo.id_akun = januari_wo.id_akun')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_wo.nomor_wo', $nomorwo)
            ->get();
        return $query->getResult();
    }

    public function downloadDokumenWo($status_dokumen_muat)
    {
        $query = $this->db->table('januari_wo')
            ->select('januari_wo.*, kantor_cabang.*, januari_lo.*, januari_sj.*, januari_pbp.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = januari_wo.id_kantor_cabang')
            ->join('januari_lo', 'januari_lo.id_akun = januari_wo.id_akun')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_lo.status_dokumen_muat', $status_dokumen_muat)
            ->get();
        return $query->getResult();
    }

    public function woPDF($nomorwo)
    {
        $query = $this->db->table('januari_wo')
            ->select('januari_wo.*, kantor_cabang.*, januari_lo.*, januari_sj.*, januari_pbp.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = januari_wo.id_kantor_cabang')
            ->join('januari_lo', 'januari_lo.id_akun = januari_wo.id_akun')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_wo.nomor_wo', $nomorwo)
            ->get();
        return $query->getResult();
    }
    

}
