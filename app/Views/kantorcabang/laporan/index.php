<?php $this->extend('kantorcabang/layout') ?>
<?php $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Laporan Document</h4>
            <div class="row mt-4">
                <div class="col-12 h6">Pilih Berdasarkan</div>
                <div class="col-md-4 px-4 mt-3">
                    <label for="alokasi" class="h6">Pilih Alokasi</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="alokasi" name="alokasi" style="height: 50px !important; font-size: 14px;" placeholder="Alokasi">
                        <option value="0" selected disabled>Pilih Alokasi</option>
                    </select>
                </div>
                <div class="col-md-4 my-3">
                    <label for="alokasi" class="h6">Pilih Tanggal</label>
                    <input type="text" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="datatanggal" name="datatanggal" style="height: 50px !important; font-size: 14px;" placeholder="Pilih Range Tanggal">
                </div>
                <div class="col-md-4 my-3 mt-5">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="filterWO" name="filterWO">Filter Document</button>
                </div>
            </div>
            <div class="row d-none" id="filterSearch">
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

            <div class="row d-none" id="tabelhilangdulu">
                <div class="col-12">
                    <div class="table-responsive h6 mt-3">
                        <table class="display" id="tablewo">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">No Working Order (WO)</th>
                                    <th scope="col">Kabupaten</th>
                                    <th scope="col">Kecamatan</th>
                                    <th scope="col">Desa</th>
                                    <th scope="col" class="text-center">Detail</th>
                                </tr>
                            </thead>

                            <tbody id="datawo">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/kantorcabang/laporan/getlaporandoc.js') ?>"></script>
<?php $this->endSection() ?>