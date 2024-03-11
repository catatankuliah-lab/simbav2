<?php $this->extend('kantorpusat/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Tambah Kantor Cabang</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorpusat/kc') ?>">disini</a> untuk kembali ke menu utama Kantor Cabang
            </h6>
            <div class="row mt-4">
                <div class="col-12 mb-3">
                    <label for="namakantorcabang" class="h6">Nama Kantor Cabang</label>
                    <input id="namakantorcabang" name="namakantorcabang" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Kantor Cabang Disini" oninput="toUpperKantorCabang()">
                </div>
                <div class="col-12 mb-3">
                    <label for="provinsi" class="h6">Provinsi</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="provinsi" name="provinsi" style="height: 50px !important; font-size: 14px;">
                    </select>
                </div>
                <div class="col-12 mt-3 mb-3">
                    <label for="alamat" class="h6">Alamat</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Username Disini" id="alamat" name="alamat" oninput="toUpperAlamat()">
                </div>
                <div class="col-12 mt-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="simpanKantorCabang">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/kantorpusat/kantorcabang/postkantorcabang.js') ?>"></script>
<?php $this->endSection() ?>