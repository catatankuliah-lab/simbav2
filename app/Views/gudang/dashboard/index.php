<?php $this->extend('gudang/layout') ?>
<?php $this->section('content') ?>
<div class="row p-3 mt-3">
    <div class="col-md-12 align-self-center px-4">
        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Selamat Datang <br> PIC <?= session()->get('nama_lengkap') ?>.</h3>
    </div>
    <div class="col-md-4 px-4 mt-3">
        <label for="alokasi" class="h6">Pilih Alokasi</label>
        <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="alokasi" name="alokasi" style="height: 50px !important; font-size: 14px;" placeholder="Alokasi">
            <option value="0" selected disabled>Pilih Alokasi</option>
        </select>
    </div>
    <div class="col-md-12 mt-4">
        <div class="card-group">
            <div class="mx-2 card border-right">
                <div class="card-body" style="height: 150px;">
                    <div style="margin-top: 15px;" class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium" id="card1">0</h2>
                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Loading Order (LO) <br>Dibuat</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-primary" style="font-size: 40px;"><i class="fas fa-file"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-2 card border-right">
                <div class="card-body" style="height: 150px;">
                    <div style="margin-top: 15px;" class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium" id="card2">0</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Loading Order (LO) <br>Lengkap
                            </h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-success" style="font-size: 40px;"><i class="fas fa-check"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-2 card border-right">
                <div class="card-body" style="height: 150px;">
                    <div style="margin-top: 15px;" class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium" id="card3">0</h2>
                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Loading Order (LO) <br>Belum Lengkap</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-danger" style="font-size: 40px;"><i class="fas fa-exclamation"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://catatankuliah-lab.github.io/jssimbav2/gudang/dashboard/dashboard.js"></script>
<?php $this->endSection() ?>