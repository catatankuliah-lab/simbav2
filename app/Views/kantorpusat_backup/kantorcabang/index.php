<?php $this->extend('kantorpusat/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Kelola Kantor Cabang</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorpusat/kc/create-kc') ?>">disini</a> untuk
                menambahkan Kantor Cabang
            </h6>
            <div class="row">
                <div class="col-md-4 col-sm-12 mb-3">
                    <label for="provinsi" class="h6">Pilih Berdasarkan</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="provinsi" style="height: 50px !important; font-size: 14px;">
                        <option value="32" selected>JAWA BARAT</option>
                    </select>
                </div>
                <div class="col-md-4 col-sm-12 mb-3">
                    <label for="keyword" class="h6">Pencarian</label>
                    <input oninput="cari()" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Keyword Pencarian" id="keyword" name="keyword">
                </div>
                <div class="col-md-4 col-sm-12 mb-3">
                    <label for="banyaknya" class="h6">Tampilkan Dalam (Data)</label>
                    <select onchange="banyaknya()" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="banyaknya" name="banyaknya" style="height: 50px !important; font-size: 14px;" placeholder="">
                        <option value="10">10 Data</option>
                        <option value="25">25 Data</option>
                        <option value="50">50 Data</option>
                        <option value="100">100 Data</option>
                    </select>
                </div>
            </div>
            <div class="table">
                <table class="table" id="tableKantorCabang">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody id="gettablekantorcabang">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/kantorpusat/kantorcabang/getallkantorcabang.js') ?>"></script>
<?php $this->endSection() ?>