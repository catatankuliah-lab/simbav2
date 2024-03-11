<?php $this->extend('kantorcabang/layout') ?>
<?php $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Loading Order (LO)</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('gudang/spmbast') ?>">disini</a> untuk kembali ke menu utama Loading Order (LO)
            </h6>
            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <label for="tanggal_pembuatan" class="h6">Tanggal Dokumen</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="date" style="height: 50px !important; font-size: 14px;" placeholder="" id="tanggal_pembuatan" name="tanggal_pembuatan">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="alokasi" class="h6">Pilih Alokasi</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="alokasi" name="alokasi" style="height: 50px !important; font-size: 14px;" placeholder="Alokasi" onchange="cekNomorSPM()">
                        <option value="0">Pilih Alokasi</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nomor_spm" class="h6">No LO</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No LO Disini" id="nomor_spm" name="nomor_spm" readonly>
                </div>
                <div class="col-md-4 mb-3 d-none">
                    <label for="nomor_lo" class="h6">No LO</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No LO Disini" id="nomor_lo" name="nomor_lo">
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
                    <label for="pilihgudang" class="h6">Gudang Pengiriman</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No DO Disini" id="pilihgudang" name="pilihgudang" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="pilihmobil" class="h6">Nopol Mobil</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nopol Mobil Disini" id="pilihmobil" name="pilihmobil">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="pilihdriver" class="h6">Nama Driver</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="pilihdriver" name="pilihdriver">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nomordriver" class="h6">Nomor Telpon Driver</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No Telpon Driver Disini" id="nomordriver" name="nomordriver">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="pilihkabupatenkota" class="h6">Pilih Kabupaten/Kota</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihkabupatenkota" name="pilihkabupatenkota" style="height: 50px !important; font-size: 14px;" placeholder="Pilih Kabupaten Kota" onchange="showKecamatan()">
                        <option value="0">Pilih Kabupaten/Kota</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="pilihkecamatan" class="h6">Pilih Kecamatan</label>
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihkecamatan" name="pilihkecamatan" style="height: 50px !important; font-size: 14px;" placeholder="Pilih Kecamatan" onchange="preprosesSPMBAST()">
                        <option value="0">Pilih Kecamatan</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
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
                            <tbody id="datadtt">
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
<script src="<?= base_url('assets/js/gudang/spmbast/postspmbast.js') ?>"></script>
<?php $this->endSection() ?>