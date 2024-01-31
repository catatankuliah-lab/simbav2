<?php $this->extend('gudang/layout') ?>
<?php $this->section('content') ?>
<div class="row p-3 mt-3">
    <div class="col-md-12 align-self-center px-4">
        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Selamat Datang <br> Admin <?= session()->get('nama_lengkap') ?>.</h3>
        <div class="d-flex align-items-center mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><span class="text-primary">Dashboard</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="col-md-12 mt-5">
        <div class="card-group">
            <div class="mx-2 card border-right">
                <div class="card-body" style="height: 150px;">
                    <div style="margin-top: 15px;" class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium" id="card1"></h2>
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
                            <h2 class="text-dark mb-1 font-weight-medium" id="card2"></h2>
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
                                <h2 class="text-dark mb-1 font-weight-medium" id="card3"></h2>
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
<script src="<?= base_url('assets/js/gudang/dashboard/v1.js') ?>"></script>
<?php $this->endSection() ?>