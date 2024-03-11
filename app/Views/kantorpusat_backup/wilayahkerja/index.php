<?php $this->extend('kantorpusat/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Kelola Wilayah Kantor Cabang</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorpusat/kc/create-kc') ?>">disini</a> untuk mengelola wilayah kerja Kantor Cabang
            </h6>
            <!-- <label for="provinsi" class="h6">Pilih Kantor</label>
            <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4 mb-5" id="provinsi" style="height: 50px !important; font-size: 14px;" onchange="showKantorCabangByProvinsi()">
                <option value="0" selected disabled>Pilih Kantor</option>
                <option value="32">JAWA BARAT</option>
                <option value="33">JAWA TENGAH</option>
            </select> -->

            <div class="table">
                <table class="table" id="tableKantorCabang">
                    <thead>
                        <tr>

                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody id="tablekantorcabang">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets\js\kantorpusat\wilayahkerja\getallwilayahkantorcabang.js') ?>"></script>
<?php $this->endSection() ?>