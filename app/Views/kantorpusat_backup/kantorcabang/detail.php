<?php $this->extend('kantorpusat/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Detail Kantor Cabang</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorpusat/kc') ?>">disini</a> untuk kembali ke menu utama Kantor Cabang
            </h6>

            <div class="row mt-4">
                <div class="col-12 mb-3">
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Kantor Disini" id="id" name="id" value="<?= session()->getFlashdata("id") ?>" hidden>

                    <label for="namakantorcabang" class="h6">Nama Kantor Cabang</label>
                    <input id="namakantorcabang" name="namakantorcabang" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Kantor Cabang Disini" oninput="toUpperKantorCabang()">
                </div>
                <div class="col-12 mb-3">
                    <label for="provinsi" class="h6">Provinsi</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="provinsi" name="provinsi" style="height: 50px !important; font-size: 14px;">
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="alamat" class="h6">Alamat</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Username Disini" id="alamat" name="alamat" oninput="toUpperAlamat()">
                </div>
                <div class="col-8 mb-3">
                    <label for="wilayahkerja" class="h6">Pilih Wilayah Kerja</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="wilayahkerja" name="wilayahkerja" style="height: 50px !important; font-size: 14px;">
                        <option value="0" selected disabled>Pilih Kabupaten/Kota</option>
                    </select>
                </div>
                <div class="col-md-4 col-sm-12 mt-2">
                    <label for="" class="h6"></label>
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="tambahDataWilayahKerja">Tambah Wilayah Kerja</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table mt-3">
                        <table class="table" id="tablewilayakerja">
                            <thead>
                                <tr>
                                    <th scope="col">Wilayah Kerja</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="datawilayahkerja">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 mt-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="simpanKantorCabang">Simpan Data</button>
                </div>
                <div class="col-md-6 col-sm-12 mt-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-danger w-100" id="hapusKantorCabang" name="hapusKantorCabang">Hapus Data</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/js/kantorpusat/kantorcabang/detailkantorcabang.js') ?>"></script>
    <?php $this->endSection() ?>