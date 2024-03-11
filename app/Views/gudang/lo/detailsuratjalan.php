<?php $this->extend('gudang/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Loading Order (LO)</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('gudang/lo') ?>">disini</a> untuk kembali ke menu Loading Order (LO)
            </h6>
            <div class="row">
                <input type="text" value="<?= $idsj ?>" id="idsj" hidden readonly>
                <input type="text" value="<?= $alokasi ?>" id="bahanalokasi" hidden readonly>
                <div class="col-md-4 mb-3">
                    <label for="tanggal_pembuatan" class="h6">Tanggal Dokumen</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="date" style="height: 50px !important; font-size: 14px;" placeholder="Tanggal Pembuatan" id="tanggal_pembuatan" name="tanggal_pembuatan" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="alokasi" class="h6">Pilih Alokasi</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="alokasi" name="alokasi" style="height: 50px !important; font-size: 14px;" placeholder="Alokasi">
                        <option value="0">Pilih Alokasi</option>
                        <option value="1">Januari 2024</option>
                        <option value="2">Februari 2024</option>
                        <option value="3">Maret 2024</option>
                        <option value="4">April 2024</option>
                        <option value="5">Mei 2024</option>
                        <option value="6">Juni 2024</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3 d-none">
                    <label for="nomor_lo" class="h6">No Loading Order (LO)</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Nomor LO" id="nomor_lo" name="nomor_lo" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kabupatenkota" class="h6">Kabupaten / Kota</label>
                    <input readonly class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No WO Disini" id="kabupatenkota" name="kabupatenkota">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kecamatan" class="h6">Kecamatan</label>
                    <input readonly class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No SO Disini" id="kecamatan" name="kecamatan">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="desakelurahan" class="h6">Desa / Kelurahan</label>
                    <input readonly class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No DO Disini" id="desakelurahan" name="desakelurahan">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="totalpengiriman" class="h6">Total Pengiriman</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Kg" id="totalpengiriman" name="totalpengiriman" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="jamditerima" class="h6">Jam Diterima</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="time" style="height: 50px !important; font-size: 14px;" placeholder="Jam Pengiriman" id="jamditerima" name="jamditerima">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 my-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="prosesupdate" name="prosesupdate">Upload Data</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/gudang/lo/getdetailsuratjalan.js') ?>"></script>
<?php $this->endSection() ?>