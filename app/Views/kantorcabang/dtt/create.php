<?php $this->extend('kantorcabang/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">DTT</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorcabang/dtt') ?>">disini</a> untuk kembali ke menu DTT
            </h6>
            <div class="row mt-4">
                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="kabupatenkota" class="h6">Kabupaten/Kota</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="kabupatenkota" name="kabupatenkota" style="height: 50px !important; font-size: 14px;" onchange="showKecamatan()">
                    </select>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="kecamatan" class="h6">Kecamatan</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="kecamatan" name="kecamatan" style="height: 50px !important; font-size: 14px;" onchange="preprosesDTT()">
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive h6">
                        <table class="table" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">Kode DTT</th>
                                    <th scope="col">Kabupaten/Kota</th>
                                    <th scope="col">Kecamatan</th>
                                    <th scope="col">Desa/Kelurahan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Detail</th>
                                </tr>
                            </thead>
                            <tbody id="datadtt">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/kantorcabang/dtt/postdtt.js') ?>"></script>
<?php $this->endSection() ?>