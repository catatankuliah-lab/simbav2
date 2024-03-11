<?php $this->extend('kantorpusat/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h5 class="card-title">Tambah Akun</h5>
            <div class="row mt-4">
                <div class="col-12 mb-3">
                    <label for="pilihhakakses" class="h6">Pilih Hak Akses</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihhakakses" name="pilihhakakses" style="height: 50px !important; font-size: 14px;" placeholder="Pilih Hak Akses" onchange="showDataHakAkses()">
                    </select>
                </div>
                <div id="kantorcabang" class="col-12 mb-3">
                    <label for="pilihkantorcabang" class="h6">Pilih Kantor Cabang</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihkantorcabang" name="pilihkantorcabang" style="height: 50px !important; font-size: 14px;" placeholder="Pilih Kantor Gudang" onchange="showGudang()">
                    </select>
                </div>
                <div id="gudang" class="col-12 mb-3 d-none">
                    <label for="pilihgudang" class="h6">Pilih Gudang</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihgudang" name="pilihgudang" style="height: 50px !important; font-size: 14px;" placeholder="Pilih Kantor Gudang">
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="nama" class="h6">Nama Lengkap</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Lengkap Disini" id="nama" name="nama">
                </div>
                <div class="col-12 mt-3 mb-3">
                    <label for="username" class="h6">Username</label>
                    <input id="username" name="username" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Cantumkan Username">
                </div>
                <div class="col-12 mt-3 mb-3">
                    <label for="password" class="h6">Password</label>
                    <input id="password" name="password" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="password" style="height: 50px !important; font-size: 14px;" placeholder="Cantumkan password">
                </div>
                <div class="col-12 mt-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="simpanAkun" name="simpanAkun">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/kantorpusat/akun/postakun.js') ?>"></script>
<?php $this->endSection() ?>