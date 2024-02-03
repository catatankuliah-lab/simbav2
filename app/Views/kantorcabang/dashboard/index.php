<?php $this->extend('kantorcabang/layout') ?>
<?php $this->section('content') ?>
<div class="row p-3">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Dashboard</h4>
            <h6 class="card-subtitle mb-3">
                Selamat Datang di <span class="text-primary" style="font-weight: bolder;">Kantor Cabang Cianjur</span>
            </h6>
            <div class="row mt-5 mb-3">
                <div class="col-12 h6">Pilih Berdasarkan</div>
                <div class="col-md-3">
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="alokasi" name="alokasi" style="height: 50px !important; font-size: 14px;" placeholder="Alokasi">
                        <option data-id_alokasi='0' value="0">Pilih Alokasi</option>
                    </select>
                </div>
            </div>
            <div class="row" id="idgrafik">
            </div>
        </div>
    </div>
</div>
<!-- <script src="<?= base_url('assets/js/kantorcabang/dashboard/v2.js') ?>"></script> -->
<?php $this->endSection() ?>