<?php $this->extend('gudang/layout') ?>
<?php $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Loading Order (LO)</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('gudang/lo') ?>">disini</a> untuk kembali ke menu utama Loading Order (LO)
            </h6>
            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <label for="tanggal_pembuatan" class="h6">Tanggal Dokumen</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="date" style="height: 50px !important; font-size: 14px;" placeholder="" value="<?= date('Y-m-d') ?>" id="tanggal_pembuatan" name="tanggal_pembuatan">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="alokasi" class="h6">Pilih Alokasi</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="alokasi" name="alokasi" style="height: 50px !important; font-size: 14px;" placeholder="Alokasi">
                        <option value="0">Pilih Alokasi</option>
                        <option value="1">Januari 2024</option>
                        <option value="2">Februari 2024</option>
                        <option value="3">Maret 2024</option>
                        <option value="4">April 2024</option>
                        <option value="5">Mei 2024</option>
                        <option value="6">Juni 2024</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nomor_lo" class="h6">No LO</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No LO Disini" id="nomor_lo" name="nomor_lo" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nomor_wo" class="h6">No WO</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No WO Disini" id="nomor_wo" name="nomor_wo">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nomor_so" class="h6">No SO</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No SO Disini" id="nomor_so" name="nomor_so">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nomor_do" class="h6">No DO</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No DO Disini" id="nomor_do" name="nomor_do">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nopolmobil" class="h6">Nopol Mobil</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nopol Mobil Disini" id="nopolmobil" name="nopolmobil">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="namadriver" class="h6">Nama Driver</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="namadriver" name="namadriver">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nomordriver" class="h6">Nomor Telpon Driver</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No Telpon Driver Disini" id="nomordriver" name="nomordriver">
                </div>
                <div class="col-md-4 mb-3 d-none" id="containergudang">
                    <label for="gudang" class="h6">Gudang Pengiriman</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No DO Disini" id="gudang" name="gudang" value="<?= session()->get('id_gudang') ?>" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="pilihkabupatenkota" class="h6">Pilih Kabupaten/Kota</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihkabupatenkota" name="pilihkabupatenkota" style="height: 50px !important; font-size: 14px;" placeholder="Pilih Kabupaten Kota" onchange="showKecamatan()">
                        <option value="0">Pilih Kabupaten/Kota</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="pilihkecamatan" class="h6">Pilih Kecamatan</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihkecamatan" name="pilihkecamatan" style="height: 50px !important; font-size: 14px;" placeholder="Pilih Kecamatan" onchange="showDesaKelurahan()">
                        <option value="0">Pilih Kecamatan</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="totalpengiriman" class="h6">Total Pengiriman</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Total Pengiriman Disini" id="totalpengiriman" name="totalpengiriman" readonly value="0">
                </div>
                <div class="col-12">
                    <label for="" class="h6">Input Data Muat</label>
                    <div class="table-responsive h6">
                        <table class="table" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">Kabupaten/Kota</th>
                                    <th scope="col">Kecamatan</th>
                                    <th scope="col">Desa/Kelurahan</th>
                                    <th scope="col">Alokasi</th>
                                    <th scope="col" style="width: 50px;">Jumlah</th>
                                    <th scope="col" class="text-center">Proses</th>
                                </tr>
                            </thead>
                            <tbody id="datalo">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12">
                    <label for="" class="h6">Detail Data Muat</label>
                    <div class="table-responsive h6">
                        <table class="table" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">Kabupaten/Kota</th>
                                    <th scope="col">Kecamatan</th>
                                    <th scope="col">Desa/Kelurahan</th>
                                    <th scope="col">Alokasi</th>
                                    <th scope="col" style="width: 50px;">Jumlah</th>
                                    <th scope="col" class="text-center">Proses</th>
                                </tr>
                            </thead>
                            <tbody id="datamuat">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="d-none btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="simpanspm" name="simpanspm">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/gudang/lo/postlo.js') ?>"></script>
<?php $this->endSection() ?>