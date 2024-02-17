<?php $this->extend('kantorcabang/layout') ?>
<?php $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Working Order (WO)</h4>
            <div class="row">

                <input type="text" id="kodewo" value="<?= $kodewo ?>" hidden>
                <input type="text" id="alokasi" value="<?= $alokasi ?>" hidden>

                <div class="col-md-4 mb-3">
                    <label for="tanggalpembuatan" class="h6">Tanggal Pembuatan</label>
                    <input readonly value="" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="date" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="tanggalpembuatan" name="tanggalpembuatan">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nomorwo" class="h6">No Working Order (WO)</label>
                    <input readonly value="" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No Wo" id="nomorwo" name="nomorwo">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="dok" class="h6">Download Dokumen</label>
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="downloadwo" name="downloadwo">Download Document</button>
                </div>
            </div>
            <div class="row d-none">
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
            <div class="row">
                <div class="col-12 table-responsive h6 mt-3">
                    <table class="table" id="example">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kabupaten/Kota</th>
                                <th scope="col">Kecamatan</th>
                                <th scope="col">Desa/Kelurahan</th>
                                <th scope="col">Total Muatan (Kg)</th>
                                <th scope="col">Status</th>
                                <!-- <th scope="col" class="text-center">Detail</th> -->
                            </tr>
                        </thead>
                        <tbody id="datalo">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://catatankuliah-lab.github.io/jssimbav2/kantorcabang/laporan/getdetailwo2.js"></script>
<?php $this->endSection() ?>