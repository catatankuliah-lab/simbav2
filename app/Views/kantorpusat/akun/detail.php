<?php $this->extend('kantorpusat/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title">Detail Akun</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorpusat/akun') ?>">disini</a> untuk kembali ke menu utama Akun
            </h6>
            <div class="row mt-4">
                <div class="col-12 mb-3">
                    <input id="id" name="id" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Cantumkan id" value="<?= session()->getFlashdata("id") ?>" readonly hidden>
                </div>
                <div id="kantorcabang" class="col-12 mb-3 d-none">
                    <label for="pilihkantorcabang" class="h6">Pilih Kantor Cabang</label>
                    <input id="pilihkantorcabang" name="pilihkantorcabang" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" readonly>
                </div>
                <div id="gudang" class="col-12 mb-3 d-none">
                    <label for="pilihgudang" class="h6">Pilih Gudang</label>
                    <input id="pilihgudang" name="pilihgudang" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" readonly>
                </div>
                <div class="col-12 mb-3">
                    <label for="nama" class="h6">Nama Akun</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Lengkap Disini" id="nama" name="nama" oninput="toUpperNama()">
                </div>
                <div class="col-12 mt-3 mb-3">
                    <label for="username" class="h6">Username</label>
                    <input id="username" name="username" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Cantumkan Username">
                </div>
                <div class="col-12 mt-3 mb-3">
                    <label for="password" class="h6">Password</label>
                    <input id="password" name="password" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="password" style="height: 50px !important; font-size: 14px;" placeholder="Cantumkan password">
                </div>
                <div class="col-md-6 mt-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="simpanAkun" name="simpanAkun">Simpan Data</button>
                </div>
                <div class="col-md-6 mt-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-danger w-100" id="hapusAkun" name="hapusAkun">Hapus Data</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="<?= base_url('assets/js/kantorpusat/akun/detailakun.js') ?>"></script>

<?php $this->endSection() ?>