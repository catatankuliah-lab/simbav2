<?php $this->extend('kantorpusat/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Wilayah Kerja Kantor Cabang</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorpusat/wilayahkerja') ?>">disini</a> untuk kembali ke menu utama wilayah Kantor Cabang
            </h6>
            <div class="row mt-4">
                <div class="col-12 mb-3">
                    <?php
                    $idKantor = session()->getFlashdata('id')['idkantor'] ?? '';
                    $idWilayah = session()->getFlashdata('id')['idwilayah'] ?? '';
                    ?>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Id Kantor" id="idkantor" name="idkantor" value="<?= $idKantor ?>" hidden>

                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Id Wilayah" id="idwilayah" name="idwilayah" value="<?= $idWilayah ?>" hidden>

                    <label for="namakabupatenkota" class="h6">Nama Kabupaten/Kota</label>
                    <input id="namakabupatenkota" name="namakabupatenkota" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Kantor Cabang Disini" oninput="toUpperKantorCabang()">
                </div>
                <div class="col-12 mb-3">
                    <label for="namakantor" class="h6">Nama Kantor</label>
                    <input id="namakantor" name="namakantor" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Kantor Cabang Disini" readonly>
                </div>
                <div class="col-12 mb-3">
                    <label for="alamatkantor" class="h6">Alamat Kantor</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Username Disini" id="alamatkantor" name="alamatkantor" readonly>
                </div>
                <div class="col-md-12 col-sm-12 mt-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="simpanDataKabupatenWilayah">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets\js\kantorpusat\wilayahkerja\detailkabkotawilayah.js') ?>"></script>
<?php $this->endSection() ?>