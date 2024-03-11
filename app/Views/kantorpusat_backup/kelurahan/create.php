<?php $this->extend('kantorpusat/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h5 class="card-title">Provinsi</h5>
            <div class="row mt-4">
                <div class="col-12 mb-3">
                    <label for="nama" class="h6">Nama Lengkap</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Lengkap Disini">
                </div>
                <div class="col-12 mb-3">
                    <label for="nama" class="h6">Nama dan Lokasi Gudang</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="exampleFormControlSelect1" style="height: 50px !important; font-size: 14px;">
                        <option value="Gudang 1 (Jl.Disana Disini, Kuningan-Jawa Barat)">Gudang 1 (Jl.Disana Disini, Kuningan-Jawa Barat)</option>
                        <option value="Gudang 2 (Jl.Disana Disini, Kuningan-Jawa Barat)">Gudang 2 (Jl.Disana Disini, Kuningan-Jawa Barat)</option>
                    </select>
                </div>
                <div class="col-12 mt-3">
                    <label for="nama" class="h6">Username</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Username Disini">
                </div>
                <div class="col-12 mt-3 mb-3">
                    <label for="nama" class="h6">Password</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="password" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Password Disini">
                </div>
                <div class="col-12 mt-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>