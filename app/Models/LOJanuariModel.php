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

    public function LOKabupatenKecamatanByIdKantor($namaKabupaten, $namaKecamatan, $idkantor)
    {
        $query = $this->db->table('dokumen_muat_januari')
            ->select('dokumen_muat_januari.*,gudang.*, kabupaten_kota.*, pbp_januari.*, surat_jalan_januari.*, kecamatan.*')
            ->selectSum('surat_jalan_januari.jumlah_penyaluran_januari', 'total')
            ->join('gudang', 'gudang.id_gudang = dokumen_muat_januari.id_gudang')
            ->join('surat_jalan_januari', 'surat_jalan_januari.nomor_lo = dokumen_muat_januari.nomor_lo')
            ->join('pbp_januari', 'pbp_januari.id_pbp_januari = surat_jalan_januari.id_pbp')
            ->join('kabupaten_kota', 'kabupaten_kota.kode_kabupaten_kota = pbp_januari.kode_kabupaten_kota')
            ->join('kecamatan', 'kecamatan.kode_kecamatan = pbp_januari.kode_kecamatan')
            ->where('dokumen_muat_januari.id_kantor', $idkantor)
            ->where('kabupaten_kota.nama_kabupaten_kota', $namaKabupaten)
            ->where('kecamatan.nama_kecamatan', $namaKecamatan)
            ->groupBy('surat_jalan_januari.nomor_lo')
            ->orderBy('dokumen_muat_januari.tanggal_muat', 'DESC')
            ->orderBy('dokumen_muat_januari.id_dokumen_muat', 'DESC')
            ->get();
        return $query->getResult();
    }

    public function FilterAllLOByCabang($namaKabupaten, $idkantor)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, januari_pbp.*, januari_sj.*')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_lo.id_kantor', $idkantor)
            ->where('januari_pbp.nama_kabupaten_kota', $namaKabupaten)
            ->get();
        return $query->getResult();
    }

    public function getDokumenMuatByNomorLo($nomorlo)
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
}
