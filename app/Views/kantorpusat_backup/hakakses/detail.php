<?php $this->extend('kantorpusat/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title">Detail Hak Akses</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorpusat/akses') ?>">disini</a> untuk kembali ke menu utama Hak Akses
            </h6>
            <div class="row mt-4">
                <div class="col-12 mb-3">
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Lengkap Disini" id="id" name="id" value="<?= session()->getFlashdata("id") ?>" hidden>

                    <label for="nama" class="h6">Nama Lengkap</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Lengkap Disini" oninput="toUpperNama()" id="nama" name="nama">
                </div>
                <div class="col-12 mt-3 mb-3">
                    <label for="deskripsi" class="h6">Deskripsi</label>
                    <input id="deskripsi" name="deskripsi" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Cantumkan Deskripsi" oninput="toUpperDeskripsi()">
                </div>
                <div class="col-md-6 mt-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="simpanHakAkses" name="simpanHakAkses">Simpan Data</button>
                </div>
                <div class="col-md-6 mt-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-danger w-100" id="deleteHakAkses" name="deleteHakAkses">Hapus Data</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/kantorpusat/hakakses/detailhakakses.js') ?>"></script>
<?php $this->endSection() ?>