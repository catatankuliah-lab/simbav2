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


    // Mengambil data Loading Order dari Kantor Cabang (Panji)
    public function getAllLoByCabang($idkantor) 
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, gudang.*, januari_sj.*')
            ->selectSum('januari_sj.jumlah_penyaluran_januari', 'total')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->where('januari_lo.id_kantor', $idkantor)
            ->groupBy('januari_sj.nomor_lo')
            ->orderBy('januari_lo.tanggal_muat', 'DESC')
            ->orderBy('januari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    // Mengambil data Gudang dari Kantor Cabang (Panji)
    public function LOGudangByIdKantor($namaGudang, $idkantor) 
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, gudang.*, januari_sj.*')
            ->selectSum('januari_sj.jumlah_penyaluran_januari', 'total')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->where('januari_lo.id_kantor', $idkantor)
            ->where('gudang.nama_gudang', $namaGudang)
            ->groupBy('januari_sj.nomor_lo')
            ->orderBy('januari_lo.tanggal_muat', 'DESC')
            ->orderBy('januari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    // Mengambil data Kabupaten dari Kantor Cabang (Panji)
    public function LOKabupatenByIdKantor($namaKabupaten, $idkantor)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, gudang.*, januari_pbp.*, januari_sj.*')
            ->selectSum('januari_sj.jumlah_penyaluran_januari', 'total')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_lo.id_kantor', $idkantor)
            ->where('januari_pbp.nama_kabupaten_kota', $namaKabupaten)
            ->groupBy('januari_sj.nomor_lo')
            ->orderBy('januari_lo.tanggal_muat', 'DESC')
            ->orderBy('januari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    // Mengambil LO dari Nomor LO  (Panji)
    public function getLOByNomorLo($nomorlo) 
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, januari_sj.*, januari_pbp.*')
            ->selectSum('januari_sj.jumlah_penyaluran_januari', 'total')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_lo.nomor_lo', $nomorlo)
            ->get();
        return $query->getResult();
    }

    // Mengambil data Surat Jalan dari Id_lo (Panji)
    public function getDetailSuratJalan($id_lo) 
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, januari_sj.*')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->where('januari_lo.id_lo', $id_lo)
            ->get();
        return $query->getResult();
    }

    public function dashboard($idakun)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*')
            ->where('januari_lo.id_akun', $idakun)
            ->get();
        return $query->getResult();
    }
}
