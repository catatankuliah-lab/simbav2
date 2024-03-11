<?php $this->extend('kantorpusat/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Tambah Wilayah Kerja</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorpusat/kc') ?>">disini</a> untuk kembali ke menu utama Wilayah Kerja Kantor Cabang
            </h6>
            <div class="row mt-4">
                <div class="col-12 mb-3">
                    <input id="id_kantor" name="id_kantor" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="ID" value="<?= session()->getFlashdata('id') ?>" hidden>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="kodekabupatenkota" class="h6">Kode Kabupaten/Kota</label>
                    <input id="kodekabupatenkota" name="kodekabupatenkota" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Kantor Cabang Disini">
                </div>
                <div class="col-12 mt-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="simpanWilayahKerja">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets\js\kantorpusat\wilayahkerja\postwilayahkerjakantorcabang.js') ?>"></script>
<?php $this->endSection() ?>