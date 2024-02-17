<?php

namespace App\Models;

use CodeIgniter\Model;

class LOFebruariModel extends Model
{
    protected $table            = 'februari_lo';
    protected $primaryKey       = 'id_lo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id_gudang",
        "id_kantor",
        "id_akun",
        "nomor_wo",
        "nomor_lo",
        "nomor_do",
        "nomor_so",
        "kode_wo",
        "kode_do",
        "kode_so",
        "tanggal_muat",
        "nama_driver",
        "nomor_driver",
        "nomor_mobil",
        "file_lo",
        "file_uplaod_lo",
        "path_lo",
        "file_upload_wo",
        "path_upload_wo",
        "file_upload_salur_bulog",
        "path_upload_salur_bulog",
        "file_upload_do",
        "path_uplaod_do",
        "file_upload_sj_bulog",
        "path_upload_sj_bulog",
        "file_upload_bast_bulog",
        "path_upload_bast_bulog",
        "status_dokumen_muat"
    ];


    public function getAllLoByCabang($idkantor)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, gudang.*, februari_sj.*')
            ->selectSum('februari_sj.jumlah_penyaluran_januari', 'total')
            ->join('gudang', 'gudang.id_gudang = februari_lo.id_gudang')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->where('februari_lo.id_kantor', $idkantor)
            ->groupBy('februari_sj.nomor_lo')
            ->orderBy('februari_lo.tanggal_muat', 'DESC')
            ->orderBy('februari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    public function detaillocabang($nomorlo)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, februari_sj.*, februari_pbp.*')
            ->selectSum('februari_sj.jumlah_penyaluran_januari', 'total')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->where('februari_lo.nomor_lo', $nomorlo)
            ->get();
        return $query->getResult();
    }

    public function gudangbykantor($gudang)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, gudang.*, februari_sj.*')
            ->selectSum('februari_sj.jumlah_penyaluran_januari', 'total')
            ->join('gudang', 'gudang.id_gudang = februari_lo.id_gudang')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->where('gudang.id_gudang', $gudang)
            ->groupBy('februari_sj.nomor_lo')
            ->orderBy('februari_lo.tanggal_muat', 'DESC')
            ->orderBy('februari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    public function kabupatenbykantor($kabupaten)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, gudang.*, februari_sj.*, februari_pbp.*, kabupaten_kota.*')
            ->selectSum('februari_sj.jumlah_penyaluran_januari', 'total')
            ->join('gudang', 'gudang.id_gudang = februari_lo.id_gudang')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->join('kabupaten_kota', 'kabupaten_kota.nama_kabupaten_kota = februari_pbp.nama_kabupaten_kota')
            ->where('kabupaten_kota.kode_kabupaten_kota', $kabupaten)
            ->groupBy('februari_sj.nomor_lo')
            ->orderBy('februari_lo.tanggal_muat', 'DESC')
            ->orderBy('februari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    public function gudangdankabupaten($gudang, $kabupaten)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, gudang.*, februari_sj.*, februari_pbp.*, kabupaten_kota.*')
            ->selectSum('februari_sj.jumlah_penyaluran_januari', 'total')
            ->join('gudang', 'gudang.id_gudang = februari_lo.id_gudang')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->join('kabupaten_kota', 'kabupaten_kota.nama_kabupaten_kota = februari_pbp.nama_kabupaten_kota')
            ->where('gudang.id_gudang', $gudang)
            ->where('kabupaten_kota.kode_kabupaten_kota', $kabupaten)
            ->groupBy('februari_sj.nomor_lo')
            ->orderBy('februari_lo.tanggal_muat', 'DESC')
            ->orderBy('februari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    public function kecamatanbykabupaten($kabupaten, $kecamatan)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, gudang.*, februari_sj.*, februari_pbp.*, kabupaten_kota.*')
            ->selectSum('februari_sj.jumlah_penyaluran_januari', 'total')
            ->join('gudang', 'gudang.id_gudang = februari_lo.id_gudang')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->join('kabupaten_kota', 'kabupaten_kota.nama_kabupaten_kota = februari_pbp.nama_kabupaten_kota')
            ->where('kabupaten_kota.kode_kabupaten_kota', $kabupaten)
            ->where('februari_pbp.nama_kecamatan', $kecamatan)
            ->groupBy('februari_sj.nomor_lo')
            ->orderBy('februari_lo.tanggal_muat', 'DESC')
            ->orderBy('februari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    public function gudangkabupatenkecamatan($gudang, $kabupaten, $kecamatan)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, gudang.*, februari_sj.*, februari_pbp.*, kabupaten_kota.*')
            ->selectSum('februari_sj.jumlah_penyaluran_januari', 'total')
            ->join('gudang', 'gudang.id_gudang = februari_lo.id_gudang')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->join('kabupaten_kota', 'kabupaten_kota.nama_kabupaten_kota = februari_pbp.nama_kabupaten_kota')
            ->where('gudang.id_gudang', $gudang)
            ->where('kabupaten_kota.kode_kabupaten_kota', $kabupaten)
            ->where('februari_pbp.nama_kecamatan', $kecamatan)
            ->groupBy('februari_sj.nomor_lo')
            ->orderBy('februari_lo.tanggal_muat', 'DESC')
            ->orderBy('februari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    public function detailsuratjalan($id_sj)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, februari_sj.*, februari_pbp.*')
            ->selectSum('februari_sj.jumlah_penyaluran_januari', 'total')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->where('februari_sj.id_sj', $id_sj)
            ->get();
        return $query->getResult();
    }

    public function FilterAllLOByCabang($namaKabupaten, $idkantor)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, februari_pbp.*, februari_sj.*')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->where('februari_lo.id_kantor', $idkantor)
            ->where('februari_pbp.nama_kabupaten_kota', $namaKabupaten)
            ->get();
        return $query->getResult();
    }

    public function getDetailSuratJalan($id_lo)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, februari_sj.*')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->where('februari_lo.id_lo', $id_lo)
            ->get();
        return $query->getResult();
    }

    // NANA DASHBOARD GUDANG
    public function dashboard($idakun)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*')
            ->where('februari_lo.id_akun', $idakun)
            ->where('februari_lo.status_dokumen_muat !=', "DIBUAT")
            ->get();
        return $query->getResult();
    }

    // NANA CEK NOMOR LO
    public function ceknomorlo($idakun)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*')
            ->where('februari_lo.id_akun', $idakun)
            ->where('februari_lo.status_dokumen_muat', "DIBUAT")
            ->get();
        return $query->getRow();
    }

    //  NANA CEK NOMOR LO DI SJ
    public function ceknomorlodisj($idakun)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*')
            ->where('februari_lo.id_akun', $idakun)
            ->where('februari_lo.status_dokumen_muat', "DIBUAT")
            ->get();
        return $query->getRow();
    }

    //  NANA CEK NOMOR LO DI SJ
    public function bahannomorlo($idakun)
    {
        $query = $this->db->table('februari_lo')
            ->selectCount('februari_lo.id_lo', "jumlahnya")
            ->where('februari_lo.id_akun', $idakun)
            ->where('februari_lo.status_dokumen_muat !=', "DIBUAT")
            ->get();
        return $query->getRow();
    }

    // DELETE LO
    public function deletelo($nomorlo)
    {
        // Hapus data berdasarkan kondisi
        return $this->db->table($this->table)->delete($nomorlo);
    }

    //  NANA FILTER LO
    public function filter($awal, $akhir, $idakun)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, februari_sj.*')
            ->selectSum('februari_sj.jumlah_penyaluran_januari', 'total')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->where('februari_lo.id_akun', $idakun)
            ->where('februari_lo.tanggal_muat BETWEEN ' . "'" . $awal . "' AND '" . $akhir . "'", null, false)
            ->where('februari_lo.status_dokumen_muat !=', "DIBUAT")
            ->groupBy('februari_sj.nomor_lo')
            ->orderBy('februari_lo.tanggal_muat', 'DESC')
            ->orderBy('februari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }


    // NANA AMBIL DATA BUAT LO DETAIL
    public function cekstatusdokumen($idlo)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, februari_sj.*, februari_pbp.*')
            ->selectSum('februari_sj.jumlah_penyaluran_januari', 'total')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->where('februari_lo.id_lo', $idlo)
            ->get();
        return $query->getResult();
    }

    public function detaillo($nomorlo)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, februari_sj.*, februari_pbp.*')
            ->selectSum('februari_sj.jumlah_penyaluran_januari', 'total')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->where('februari_lo.nomor_lo', $nomorlo)
            ->get();
        return $query->getRow();
    }

    public function getallsjbynomorlo($nomorlo)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, februari_sj.*, februari_pbp.*')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->where('februari_lo.nomor_lo', $nomorlo)
            ->get();
        return $query->getRow();
    }

    public function getSPMPerKecamtanTanggal($idKantor)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, februari_sj.*, februari_pbp.*, gudang.*, kantor_cabang.*')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->join('gudang', 'gudang.id_gudang = februari_lo.id_gudang')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = februari_lo.id_kantor')
            ->where('februari_lo.id_kantor', $idKantor)
            ->groupBy('februari_lo.tanggal_muat')
            ->orderBy('februari_lo.tanggal_muat', 'ASC')
            ->get();
        return $query->getResult();
    }

    public function getSPMPerKecamtan($idKantor, $tanggal)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, februari_sj.*, februari_pbp.*, gudang.*, kantor_cabang.*')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->join('gudang', 'gudang.id_gudang = februari_lo.id_gudang')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = februari_lo.id_kantor')
            ->where('februari_lo.id_kantor', $idKantor)
            ->where('februari_lo.tanggal_muat', $tanggal)
            ->groupBy('februari_lo.id_gudang')
            ->get();
        return $query->getResult();
    }

    public function getRekap($idGudang, $tanggal)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, februari_sj.*, februari_pbp.*, gudang.*')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->join('gudang', 'gudang.id_gudang = februari_lo.id_gudang')
            ->where('februari_lo.id_gudang', $idGudang)
            ->where('februari_lo.tanggal_muat', $tanggal)
            ->get();
        return $query->getResult();
    }
    // NANA AMBIL DATA BUAT SJ PAKE LO
    public function downloadPDF($nomorlo)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, februari_sj.*, februari_pbp.*, gudang.nama_gudang')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->join('gudang', 'gudang.id_gudang = februari_lo.id_gudang')
            ->where('februari_lo.nomor_lo', $nomorlo)
            ->get();
        return $query->getResult();
    }
    // NANA AMBIL DATA KEBUTUHAN UPLOAD
    public function getkebutuhanupload($idlo)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, februari_sj.*, februari_pbp.*, gudang.nama_gudang')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->join('gudang', 'gudang.id_gudang = februari_lo.id_gudang')
            ->where('februari_lo.id_lo', $idlo)
            ->get();
        return $query->getRow();
    }

    public function showDetailWO($nomorwo)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, kantor_cabang.*, februari_sj.*, februari_pbp.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = februari_lo.id_kantor')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->where('februari_lo.nomor_wo', $nomorwo)
            ->get();
        return $query->getResult();
    }

    public function woPDF($nomorwo)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, kantor_cabang.*, februari_sj.*, februari_pbp.*, gudang.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = februari_lo.id_kantor')
            ->join('gudang', 'gudang.id_gudang = februari_lo.id_gudang')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->where('februari_lo.kode_wo', $nomorwo)
            ->get();
        return $query->getResult();
    }

    public function showWoByIdKantor($idkantor, $awal, $akhir)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*,februari_sj.*, februari_pbp.*')
            ->selectSum('februari_sj.jumlah_penyaluran_januari', 'total')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->where('februari_lo.id_kantor', $idkantor)
            ->where('februari_lo.status_dokumen_muat', 'LENGKAP')
            ->where('februari_lo.tanggal_muat >=', $awal)
            ->where('februari_lo.tanggal_muat <=', $akhir)
            ->groupBy('februari_sj.nomor_lo')
            ->orderBy('februari_lo.tanggal_muat', 'DESC')
            ->orderBy('februari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    public function getwobykodewo($kodewo)
    {
        $query = $this->db->table('februari_lo')
            ->select('februari_lo.*, kantor_cabang.*, februari_sj.*, februari_pbp.*, gudang.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = februari_lo.id_kantor')
            ->join('gudang', 'gudang.id_gudang = februari_lo.id_gudang')
            ->join('februari_sj', 'februari_sj.nomor_lo = februari_lo.nomor_lo')
            ->join('februari_pbp', 'februari_pbp.id_pbp = februari_sj.id_pbp')
            ->where('februari_lo.kode_wo', $kodewo)
            ->get();
        return $query->getResult();
    }
}
