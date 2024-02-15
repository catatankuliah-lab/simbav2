<?php $this->extend('kantorcabang/layout') ?>
<?php $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Loading Order (LO)</h4>
            <div class="row">
                <input type="text" value="<?= $id_sj ?>" id="idsj" name="idsj" hidden>
                <div class="col-md-4 mb-3">
                    <label for="tanggalpembuatan" class="h6">Tanggal Pembuatan</label>
                    <input readonly value="" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="tanggalpembuatan" name="tanggalpembuatan">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nomorlo" class="h6">No Loading Order (LO)</label>
                    <input readonly value="<?= $nomorlo ?>" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="nomorlo" name="nomorlo">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nopoldriver" class="h6">Nopol Mobil / Driver</label>
                    <input readonly value="" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="nopoldriver" name="nopoldriver">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kabupaten" class="h6">Kabupaten/Kota</label>
                    <input readonly value="" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="kabupaten" name="kabupaten">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kecamatan" class="h6">Kecamatan</label>
                    <input readonly value="" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="kecamatan" name="kecamatan">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="desakelurahan" class="h6">Desa/Kelurahan</label>
                    <input readonly value="" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="desakelurahan" name="desakelurahan">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="totalpenyerahan" class="h6">Total Penyerahan</label>
                    <input readonly value="" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="totalpenyerahan" name="totalpenyerahan">
                </div>
                <input type="text" name="iddtt" id="iddtt" hidden>
            </div>
        </div>
    </div>
</div>
<script src="https://catatankuliah-lab.github.io/jssimbav2/kantorcabang/lo/getdetailsuratjalan.js"></script>
<?php $this->endSection() ?>