<?php $this->extend('kantorpusat/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h5 class="card-title mb-1">Kelola Gudang</h5>
            <h6 class="card-subtitle mt-2 mb-4">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorpusat/gudang/create-gudang') ?>">disini</a> untuk menambahkan Gudang
            </h6>
            <div class="row">
                <div class="col-md-4 col-sm-12 my-3">
                    <label for=" kantorcabang" class="h6">Pilih Kantor Cabang</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="kantorcabang" name="kantorcabang" style="height: 50px !important; font-size: 14px;" placeholder="Pilih Kantor Cabang" onchange="showGudangByProvinsi()">
                        <option value="0">Pilih Kantor Cabang</option>
                    </select>
                </div>
                <div class="col-md-4 col-sm-12 my-3">
                    <label for="keyword" class="h6">Pencarian</label>
                    <input oninput="cari()" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Keyword Pencarian" id="keyword" name="keyword">
                </div>
                <div class="col-md-4 col-sm-12 my-3">
                    <label for="banyaknya" class="h6">Tampilkan Dalam (Data)</label>
                    <select onchange="banyaknya()" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="banyaknya" name="banyaknya" style="height: 50px !important; font-size: 14px;" placeholder="">
                        <option value="10">10 Data</option>
                        <option value="25">25 Data</option>
                        <option value="50">50 Data</option>
                        <option value="100">100 Data</option>
                    </select>
                </div>
            </div>

            <div class="table mt-3">
                <table class="table" id="tableGudang">
                    <thead>
                        <tr>
                            <th style="width: 20%;" scope="col">Nama Gudang</th>
                            <th scope="col">Alamat Gudang</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody id="getDataGudang">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/kantorpusat/gudang/getallgudang.js') ?>"></script>
<?php $this->endSection() ?>