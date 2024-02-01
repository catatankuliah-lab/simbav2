<?php $this->extend('kantorcabang/layout') ?>
<?php $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Laporan Document</h4>
            <div class="row mt-4">
                <div class="col-12 h6">Pilih Berdasarkan</div>
                <div class="col-md-6 my-3">
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="datatanggal" name="datatanggal" style="height: 50px !important; font-size: 14px;" placeholder="datatanggal">
                        <option value="0">Pilih Tanggal</option>
                    </select>
                </div>
                <div class="col-md-6 my-3">
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihwo" name="pilihwo" style="height: 50px !important; font-size: 14px;" placeholder="pilihwo">
                        <option value="0">Pilih Work Order (WO)</option>
                    </select>
                </div>
                <div class="col-md-4 my-3">
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihkabupaten" name="pilihkabupaten" style="height: 50px !important; font-size: 14px;" placeholder="pilihkabupaten">
                        <option value="0">Pilih Kabupaten</option>
                    </select>
                </div>
                <div class="col-md-4 my-3">
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihkecamatan" name="pilihkecamatan" style="height: 50px !important; font-size: 14px;" placeholder="pilihkecamatan">
                        <option value="0">Pilih Kecamatan</option>
                    </select>
                </div>
                <div class="col-md-4 my-3">
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihdesa" name="pilihdesa" style="height: 50px !important; font-size: 14px;" placeholder="pilihdesa">
                        <option value="0">Pilih Desa</option>
                    </select>
                </div>
            </div>
            <div class="row">
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
                <div class="col-12">
                    <div class="table-responsive h6 mt-3">
                        <table class="display" id="tablelo">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Gudang</th>
                                    <th scope="col">No Loading Order (LO)</th>
                                    <th scope="col">Nopol Mobil/Driver</th>
                                    <th scope="col">Total Muatan (Kg)</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Detail</th>
                                </tr>
                            </thead>
                            <tbody id="datalo">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <h6 class="card-subtitle mb-3" id="tomboldownload">
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>