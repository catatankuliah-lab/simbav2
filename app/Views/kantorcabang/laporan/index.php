<?php $this->extend('kantorcabang/layout') ?>
<?php $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Laporan Document</h4>
            <div class="row mt-4">
                <div class="col-12 h6">Pilih Berdasarkan</div>
                <div class="col-md-4 my-3">
                    <input type="date" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="datatanggal" name="datatanggal" style="height: 50px !important; font-size: 14px;" placeholder="datatanggal">
                </div>
                <div class="col-md-4 my-3">
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihwo" name="pilihwo" style="height: 50px !important; font-size: 14px;" placeholder="pilihwo">
                        <option data-nomor_wo="0" value="0">Pilih Work Order (WO)</option>
                    </select>
                </div>
                <div class="col-md-4 my-3">
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihkabupaten" name="pilihkabupaten" style="height: 50px !important; font-size: 14px;" placeholder="pilihkabupaten" onchange="showKecamatan()">
                        <option data-nama_kabupaten_kota="0" value="0">Pilih Kabupaten</option>
                    </select>
                </div>
                <div class="col-md-4 my-3">
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihkecamatan" name="pilihkecamatan" style="height: 50px !important; font-size: 14px;" placeholder="pilihkecamatan" onchange="showDesa()">
                        <option data-nama_kecamatan="0" value="0">Pilih Kecamatan</option>
                    </select>
                </div>
                <div class="col-md-4 my-3">
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihdesa" name="pilihdesa" style="height: 50px !important; font-size: 14px;" placeholder="pilihdesa">
                        <option value="0">Pilih Desa</option>
                    </select>
                </div>
                <div class="col-md-4 my-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="filterSPM" name="filterSPM">Download Dokumen</button>
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
<script src="<?= base_url('assets\js\kantorcabang\laporan\getlaporandoc.js') ?>"></script>
<?php $this->endSection() ?>