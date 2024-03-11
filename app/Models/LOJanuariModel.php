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
        "status_dokumen_muat",
        "jam_pemberangkatan"
    ];


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

    public function detaillocabang($nomorlo)
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

    public function gudangbykantor($gudang)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, gudang.*, januari_sj.*')
            ->selectSum('januari_sj.jumlah_penyaluran_januari', 'total')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->where('gudang.id_gudang', $gudang)
            ->groupBy('januari_sj.nomor_lo')
            ->orderBy('januari_lo.tanggal_muat', 'DESC')
            ->orderBy('januari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    public function kabupatenbykantor($kabupaten)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, gudang.*, januari_sj.*, januari_pbp.*, kabupaten_kota.*')
            ->selectSum('januari_sj.jumlah_penyaluran_januari', 'total')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->join('kabupaten_kota', 'kabupaten_kota.nama_kabupaten_kota = januari_pbp.nama_kabupaten_kota')
            ->where('kabupaten_kota.kode_kabupaten_kota', $kabupaten)
            ->groupBy('januari_sj.nomor_lo')
            ->orderBy('januari_lo.tanggal_muat', 'DESC')
            ->orderBy('januari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    public function gudangdankabupaten($gudang, $kabupaten)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, gudang.*, januari_sj.*, januari_pbp.*, kabupaten_kota.*')
            ->selectSum('januari_sj.jumlah_penyaluran_januari', 'total')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->join('kabupaten_kota', 'kabupaten_kota.nama_kabupaten_kota = januari_pbp.nama_kabupaten_kota')
            ->where('gudang.id_gudang', $gudang)
            ->where('kabupaten_kota.kode_kabupaten_kota', $kabupaten)
            ->groupBy('januari_sj.nomor_lo')
            ->orderBy('januari_lo.tanggal_muat', 'DESC')
            ->orderBy('januari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    public function kecamatanbykabupaten($kabupaten, $kecamatan)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, gudang.*, januari_sj.*, januari_pbp.*, kabupaten_kota.*')
            ->selectSum('januari_sj.jumlah_penyaluran_januari', 'total')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->join('kabupaten_kota', 'kabupaten_kota.nama_kabupaten_kota = januari_pbp.nama_kabupaten_kota')
            ->where('kabupaten_kota.kode_kabupaten_kota', $kabupaten)
            ->where('januari_pbp.nama_kecamatan', $kecamatan)
            ->groupBy('januari_sj.nomor_lo')
            ->orderBy('januari_lo.tanggal_muat', 'DESC')
            ->orderBy('januari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    public function gudangkabupatenkecamatan($gudang, $kabupaten, $kecamatan)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, gudang.*, januari_sj.*, januari_pbp.*, kabupaten_kota.*')
            ->selectSum('januari_sj.jumlah_penyaluran_januari', 'total')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->join('kabupaten_kota', 'kabupaten_kota.nama_kabupaten_kota = januari_pbp.nama_kabupaten_kota')
            ->where('gudang.id_gudang', $gudang)
            ->where('kabupaten_kota.kode_kabupaten_kota', $kabupaten)
            ->where('januari_pbp.nama_kecamatan', $kecamatan)
            ->groupBy('januari_sj.nomor_lo')
            ->orderBy('januari_lo.tanggal_muat', 'DESC')
            ->orderBy('januari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    public function detailsuratjalan($id_sj)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, januari_sj.*, januari_pbp.*')
            ->selectSum('januari_sj.jumlah_penyaluran_januari', 'total')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_sj.id_sj', $id_sj)
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



    public function getDetailSuratJalan($id_lo)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, januari_sj.*')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->where('januari_lo.id_lo', $id_lo)
            ->get();
        return $query->getResult();
    }

    // NANA DASHBOARD GUDANG
    public function dashboard($idakun)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*')
            ->where('januari_lo.id_akun', $idakun)
            ->where('januari_lo.status_dokumen_muat !=', "DIBUAT")
            ->get();
        return $query->getResult();
    }

    // NANA CEK NOMOR LO
    public function ceknomorlo($idakun)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*')
            ->where('januari_lo.id_akun', $idakun)
            ->where('januari_lo.status_dokumen_muat', "DIBUAT")
            ->get();
        return $query->getRow();
    }

    //  NANA CEK NOMOR LO DI SJ
    public function ceknomorlodisj($idakun)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*')
            ->where('januari_lo.id_akun', $idakun)
            ->where('januari_lo.status_dokumen_muat', "DIBUAT")
            ->get();
        return $query->getRow();
    }

    //  NANA CEK NOMOR LO DI SJ
    public function bahannomorlo($idakun)
    {
        $query = $this->db->table('januari_lo')
            ->selectCount('januari_lo.id_lo', "jumlahnya")
            ->where('januari_lo.id_akun', $idakun)
            ->where('januari_lo.status_dokumen_muat !=', "DIBUAT")
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
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, januari_sj.*')
            ->selectSum('januari_sj.jumlah_penyaluran_januari', 'total')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->where('januari_lo.id_akun', $idakun)
            ->where('januari_lo.tanggal_muat BETWEEN ' . "'" . $awal . "' AND '" . $akhir . "'", null, false)
            ->where('januari_lo.status_dokumen_muat !=', "DIBUAT")
            ->groupBy('januari_sj.nomor_lo')
            ->orderBy('januari_lo.tanggal_muat', 'DESC')
            ->orderBy('januari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }


    // NANA AMBIL DATA BUAT LO DETAIL
    public function cekstatusdokumen($idlo)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, januari_sj.*, januari_pbp.*')
            ->selectSum('januari_sj.jumlah_penyaluran_januari', 'total')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_lo.id_lo', $idlo)
            ->get();
        return $query->getResult();
    }

    public function detaillo($nomorlo)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, januari_sj.*, januari_pbp.*')
            ->selectSum('januari_sj.jumlah_penyaluran_januari', 'total')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_lo.nomor_lo', $nomorlo)
            ->get();
        return $query->getRow();
    }

    public function getallsjbynomorlo($nomorlo)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, januari_sj.*, januari_pbp.*')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_lo.nomor_lo', $nomorlo)
            ->get();
        return $query->getRow();
    }

    public function getSPMPerKecamtan($idKantor)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, januari_sj.*, januari_pbp.*, gudang.*, kantor_cabang.*')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = januari_lo.id_kantor')
            ->where('januari_lo.id_kantor', $idKantor)
            ->groupBy('januari_lo.id_gudang')
            ->get();
        return $query->getResult();
    }

    public function getRekap($idGudang)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, januari_sj.*, januari_pbp.*, gudang.*')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->where('januari_lo.id_gudang', $idGudang)
            ->get();
        return $query->getResult();
    }
    // NANA AMBIL DATA BUAT SJ PAKE LO
    public function downloadPDF($nomorlo)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, januari_sj.*, januari_pbp.*, gudang.nama_gudang')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->where('januari_lo.nomor_lo', $nomorlo)
            ->get();
        return $query->getResult();
    }
    // NANA AMBIL DATA KEBUTUHAN UPLOAD
    public function getkebutuhanupload($idlo)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, januari_sj.*, januari_pbp.*, gudang.nama_gudang')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->where('januari_lo.id_lo', $idlo)
            ->get();
        return $query->getRow();
    }

    public function showDetailWO($nomorwo)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, kantor_cabang.*, januari_sj.*, januari_pbp.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = januari_lo.id_kantor')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_lo.nomor_wo', $nomorwo)
            ->get();
        return $query->getResult();
    }

    public function woPDF($nomorwo)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, kantor_cabang.*, januari_sj.*, januari_pbp.*, gudang.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = januari_lo.id_kantor')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_lo.kode_wo', $nomorwo)
            ->get();
        return $query->getResult();
    }

    public function showWoByIdKantor($idkantor, $awal, $akhir)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*,januari_sj.*, januari_pbp.*')
            ->selectSum('januari_sj.jumlah_penyaluran_januari', 'total')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_lo.id_kantor', $idkantor)
            ->where('januari_lo.status_dokumen_muat', 'LENGKAP')
            ->where('januari_lo.tanggal_muat >=', $awal)
            ->where('januari_lo.tanggal_muat <=', $akhir)
            ->groupBy('januari_sj.nomor_lo')
            ->orderBy('januari_lo.tanggal_muat', 'DESC')
            ->orderBy('januari_lo.id_lo', 'DESC')
            ->get();
        return $query->getResult();
    }

    public function getwobykodewo($kodewo)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, kantor_cabang.*, januari_sj.*, januari_pbp.*, gudang.*')
            ->join('kantor_cabang', 'kantor_cabang.id_kantor_cabang = januari_lo.id_kantor')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->join('januari_sj', 'januari_sj.nomor_lo = januari_lo.nomor_lo')
            ->join('januari_pbp', 'januari_pbp.id_pbp = januari_sj.id_pbp')
            ->where('januari_lo.kode_wo', $kodewo)
            ->get();
        return $query->getResult();
    }

    public function gettanggalwo($idkantor)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.tanggal_muat')
            ->where('januari_lo.id_kantor', $idkantor)
            ->groupBy('januari_lo.tanggal_muat')
            ->get();
        return $query->getResult();
    }

    public function getallwo($idkantor, $tanggal)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*, gudang.nama_gudang')
            ->join('gudang', 'gudang.id_gudang = januari_lo.id_gudang')
            ->where('januari_lo.id_kantor', $idkantor)
            ->where('januari_lo.tanggal_muat', $tanggal)
            ->where('januari_lo.status_dokumen_muat', "LENGKAP")
            ->groupBy('januari_lo.nomor_wo')
            ->get();
        return $query->getResult();
    }

    public function findbykodewo($kodewo)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*')
            ->where('januari_lo.kode_wo', $kodewo)
            ->get();
        return $query->getResult();
    }

    public function bahandokumenwotanggal($tanggal, $idkantor)
    {
        $query = $this->db->table('januari_lo')
            ->select('januari_lo.*')
            ->where('januari_lo.tanggal_muat', $tanggal)
            ->where('januari_lo.id_kantor', $idkantor)
            ->groupBy('januari_lo.kode_wo')
            ->get();
        return $query->getResult();
    }
}
