<?php $this->extend('gudang/layout') ?>
<?php $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Loading Order (LO)</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('gudang/spmbast/detail/' . $nomorspmbast) ?>">disini</a> untuk mengelola Loading Order (LO)
            </h6>
            <div class="row">
                <input type="text" value="<?= $idspmbast ?>" id="idspmbast" hidden>
                <div class="col-md-4 mb-3">
                    <label for="tanggalpembuatan" class="h6">Tanggal Pembuatan</label>
                    <input readonly value="" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="tanggalpembuatan" name="tanggalpembuatan">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nomorlo" class="h6">No Loading Order (LO)</label>
                    <input readonly value="<?= $nomorspmbast ?>" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="nomorlo" name="nomorlo">
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
                <div class="col-md-4 mb-3" id="formsj">
                    <form id="uploadForm" class="" enctype="multipart/form-data">
                        <label for="filebuktisj" class="h6">Upload Bukti File Surat Jalan</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px;" id="filebuktisj" name="filebuktisj">
                                <label class="custom-file-label custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px; border-radius: 25px; padding-top: 5px;" for="filebuktisj"></label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 mb-3" id="formdriver">
                    <form id="uploadForm2" class="" enctype="multipart/form-data">
                        <label for="filebuktidriver" class="h6">Upload Foto Penyerahan dari Driver</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px;" id="filebuktidriver" name="filebuktidriver">
                                <label class="custom-file-label custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px; border-radius: 25px; padding-top: 5px;" for="filebuktidriver"></label>
                            </div>
                        </div>
                    </form>
                </div>
                <input type="text" name="iddtt" id="iddtt" hidden>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/gudang/spmbast/getdetailsuratjalan.js') ?>"></script>
<?php $this->endSection() ?>