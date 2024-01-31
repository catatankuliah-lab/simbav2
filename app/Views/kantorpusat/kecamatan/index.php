<?php $this->extend('kantorpusat/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h5 class="card-title mb-1">Kelola Kecamatan</h5>
            <p style="font-size: 11px;">Sistem Informasi Manajamen Bantuan Pangan</p>
            <h6 class="card-subtitle mt-2 mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorpusat/kecamatan/create-kecamatan') ?>">disini</a> untuk mengelola Kecamatan
            </h6>
            <div class="table-responsive h6">
                <table class="table" id="example">
                    <thead>
                        <tr>
                            <th scope="col">NIK</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Nama dan Lokasi Gudang</th>
                            <th scope="col" class="text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Cari Berdasarkan NIK</th>
                            <th>Cari Berdasarkan Nama</th>
                            <th>Cari Berdasarkan Lokasi</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>