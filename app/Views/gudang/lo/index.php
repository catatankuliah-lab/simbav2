<?php $this->extend('gudang/layout') ?>
<?php $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Loading Order (LO)</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('gudang/lo/create') ?>">disini</a> untuk mengelola Loading Order (LO)
            </h6>
            <div class="row mt-4">
                <div class="col-12 h6">Pilih Berdasarkan</div>
                <div class="col-md-4 my-3">
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="alokasi" name="alokasi" style="height: 50px !important; font-size: 14px;" placeholder="Alokasi">
                        <option value="0" disabled selected>Pilih Alokasi</option>
                        <option value="1">Januari 2024</option>
                        <option value="2">Februari 2024</option>
                        <option value="3">Maret 2024</option>
                        <option value="4">April 2024</option>
                        <option value="5">Mei 2024</option>
                        <option value="6">Juni 2024</option>
                    </select>
                </div>
                <div class="col-md-4 my-3">
                    <input type="text" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="datatanggal" name="datatanggal" style="height: 50px !important; font-size: 14px;" placeholder="Pilih Range Tanggal">
                </div>
                <div class="col-md-4 d-none my-3">
                    <input type="text" name="gudang" id="gudang" value="<?= session()->get('id_gudang') ?>">
                </div>
                <div class="col-md-4 my-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="tamilkanlo" name="tamilkanlo">Tampilkan</button>
                </div>
            </div>
            <div class="row d-none" id="filterdatatable">
                <div class="col-md-6 col-sm-12 my-3">
                    <label for="keyword" class="h6">Pencarian</label>
                    <input oninput="cari()" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Keyword Pencarian" id="keyword" name="keyword">
                </div>
                <div class="col-md-6 col-sm-12 my-3">
                    <label for="banyaknya" class="h6">Tampilkan Dalam (Data)</label>
                    <select onchange="banyaknya()" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="banyaknya" name="banyaknya" style="height: 50px !important; font-size: 14px;" placeholder="">
                        <option value="10">10 Data</option>
                        <option value="25">25 Data</option>
                        <option value="50">50 Data</option>
                        <option value="100">100 Data</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive h6 mt-3">
                <table class="display d-none" id="tablelo">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal</th>
                            <th scope="col">No WO</th>
                            <th scope="col">Nopol Mobil/Driver</th>
                            <th scope="col">Total Muatan (Kg)</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody id="datalo1">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://catatankuliah-lab.github.io/jssimbav2/gudang/lo/getalllo2.js"></script>
<?php $this->endSection() ?>