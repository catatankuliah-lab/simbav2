<?php $this->extend('kantorcabang/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">DTT</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorcabang/dtt/create') ?>">disini</a> untuk mengelola DTT
            </h6>
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
                    <tfoot>
                        <tr>
                            <th>Kode DTT</th>
                            <th>Kabupaten/Kota</th>
                            <th>Kecamatan</th>
                            <th>Desa/Kelurahan</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/kantorcabang/dtt/getalldtt.js') ?>"></script>
<?php $this->endSection() ?>