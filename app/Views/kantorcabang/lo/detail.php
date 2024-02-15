<?php $this->extend('kantorcabang/layout') ?>
<?php $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Loading Order (LO)</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tanggalpembuatan" class="h6">Tanggal Pembuatan</label>
                    <input readonly value="" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="tanggalpembuatan" name="tanggalpembuatan">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nomorlo" class="h6">No Loading Order (LO)</label>
                    <input readonly class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" value="<?= $nomorlo ?>" id="nomorlo" name="nomorlo">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nopoldriver" class="h6">Nopol Mobil / Driver</label>
                    <input readonly value="" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="nopoldriver" name="nopoldriver">
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
                                <th scope="col" class="text-center">Detail</th>
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
<script src="https://catatankuliah-lab.github.io/jssimbav2/kantorcabang/lo/getdetaillo.js"></script>
<?php $this->endSection() ?>