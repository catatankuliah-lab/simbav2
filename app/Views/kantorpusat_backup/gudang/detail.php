<?php $this->extend('kantorpusat/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Detail Gudang</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorpusat/gudang') ?>">disini</a> untuk
                kembali ke menu utama Gudang
            </h6>
            <div class="row mt-4">
                <div class="col-12 mb-3">
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Gudang" id="id" name="id" value="<?= session()->getFlashdata("id") ?>" hidden>

                    <label for="namagudang" class="h6">Nama Gudang</label>
                    <input id="namagudang" name="namagudang" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Gudang" oninput="toUpperGudang()">
                </div>
                <div class="col-12 mb-3 d-none">
                    <label for="kantorcabang" class="h6">ID Kantor Cabang</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="kantorcabang" name="kantorcabang" style="height: 50px !important; font-size: 14px;" placeholder="Pilih Kantor Cabang">
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="alamatGudang" class="h6">Alamat Gudang</label>
                    <input id="alamatGudang" name="alamatGudang" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Gudang" oninput="toUpperAlamatGudang()">
                </div>
                <div class="col-md-6 mt-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="simpanDataGudang">Simpan Data</button>
                </div>
                <div class="col-md-6 col-sm-12 mt-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-danger w-100" id="hapusGudang" name="hapusGudang">Hapus Data</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/kantorpusat/gudang/detailgudang.js') ?>"></script>
<?php $this->endSection() ?>