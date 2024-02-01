<?php $this->extend('kantorcabang/layout') ?>
<?php $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Loading Order (LO)</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorcabang/spmbast') ?>">disini</a> untuk mengelola Loading Order (LO)
            </h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tanggalpembuatan" class="h6">Tanggal Pembuatan</label>
                    <input readonly value="" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="tanggalpembuatan" name="tanggalpembuatan">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nomorlo" class="h6">No Loading Order (LO)</label>
                    <input readonly value="<?= $nomorlo ?>" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="nomorlo" name="nomorlo">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nopoldriver" class="h6">Nopol Mobil / Driver</label>
                    <input readonly value="" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="nopoldriver" name="nopoldriver">
                </div>
                <div class="col-md-6 mb-3" id="formupload">
                    <form id="uploadForm" class="" enctype="multipart/form-data">
                        <label for="filebuktilo" class="h6">Upload Bukti Penyerahan Loading Order (LO)</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px;" id="filebuktilo" name="filebuktilo">
                                <label class="custom-file-label custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px; border-radius: 25px; padding-top: 5px;" for="filebuktilo"></label>
                            </div>
                        </div>
                        <input type="text" id="kodedtt" name="kodedtt" value="<?= $nomorlo ?>" hidden>
                    </form>
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
            <h6 class="card-subtitle mb-3">
                <a href="<?= base_url('gudang/spmbast/download/' . $nomorlo) ?>" style="font-weight: bolder;" class="text-primary" id="downloadspm">Download</a> File Loading Order (LO) & Surat Jalan
            </h6>
            <h6 class="card-subtitle mb-3" id="lengkap">
                <a href="<?= base_url('gudang/spmbast/download/' . $nomorlo) ?>" style="font-weight: bolder;" class="text-primary" id="downloadspm">Download</a> File Bukti Penyerahan Loading Order (LO) & Surat Jalan
            </h6>
        </div>
    </div>
</div>
<script src="<?= base_url('assets\js\kantorcabang\spmbast\getdetailspmbast.js') ?>"></script>
<?php $this->endSection() ?>