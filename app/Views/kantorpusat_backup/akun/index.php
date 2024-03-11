<?php $this->extend('kantorpusat/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h5 class="card-title mb-1">Kelola Akun</h5>
            <h6 class="card-subtitle mt-2 mb-4">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorpusat/akun/create-akun') ?>">disini</a> untuk menambahkan Akun
            </h6>
            <div class="row">
                <div class="col-md-4 col-sm-12 my-3"">
                 <label for=" hakakses" class="h6">Pilih Hak Akses</label>
                    <select class=" form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="hakakses" name="hakakses" style="height: 50px !important; font-size: 14px;" placeholder="hakakses">
                        <option value="0">Pilih Hak Akses</option>
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
            <div class="table">
                <table class="table table-striped" id="tableakun">
                    <thead>
                        <tr style="background-color: #FAFAFC; border-radius: 10px;">
                            <th scope="col">Username</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="getTableAkun" class="m-4">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/kantorpusat/akun/getallakun.js') ?>"></script>
<?php $this->endSection() ?>