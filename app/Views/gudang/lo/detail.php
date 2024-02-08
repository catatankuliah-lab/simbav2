<?php $this->extend('gudang/layout') ?>
<?php $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Loading Order (LO)</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('gudang/lo') ?>">disini</a> untuk kembali ke menu Loading Order (LO)
            </h6>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="tanggal_pembuatan" class="h6">Tanggal Dokumen</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="date" style="height: 50px !important; font-size: 14px;" placeholder="Tanggal Pembuatan" id="tanggal_pembuatan" name="tanggal_pembuatan" readonly>
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
                    <label for="nomor_lo" class="h6">No Loading Order (LO)</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Nomor LO" id="nomor_lo" name="nomor_lo" readonly>
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
                <div class="col-md-4 mb-3 d-none" id="containergudang">
                    <label for="gudang" class="h6">Gudang Pengiriman</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Gudang Pengirirman" id="gudang" name="gudang">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="totalpengiriman" class="h6">Total Pengiriman</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Kg" id="totalpengiriman" name="totalpengiriman" readonly>
                </div>
            </div>
            <form id="uploadForm" class="row" enctype="multipart/form-data">
                <div class="col-md-4 mb-3 mt-2" id="formupload">
                    <label for="filewo" class="h6">Upload WO</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px;" id="filewo" name="filewo">
                            <label class="custom-file-label custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px; border-radius: 25px; padding-top: 15px;" for="filewo">Upload WO Disini</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mt-2" id="formupload">
                    <label for="filelo" class="h6">Upload Loading Order (LO)</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px;" id="filelo" name="filelo">
                            <label class="custom-file-label custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px; border-radius: 25px; padding-top: 15px;" for="filelo">Upload LO Disini</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mt-2" id="formupload">
                    <label for="filepenyerahan" class="h6">Dokumen Penyerahan</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px;" id="filepenyerahan" name="filepenyerahan">
                            <label class="custom-file-label custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px; border-radius: 25px; padding-top: 15px;" for="filepenyerahan">Upload Bukti Penyerahan Disini</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mt-2" id="formupload">
                    <label for="filedo" class="h6">Upload DO</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px;" id="filedo" name="filedo">
                            <label class="custom-file-label custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px; border-radius: 25px; padding-top: 15px;" for="filedo">Upload DO Disini</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mt-2" id="formupload">
                    <label for="fileso" class="h6">Uplaod Surat Jalan Bulog</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px;" id="fileso" name="fileso">
                            <label class="custom-file-label custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px; border-radius: 25px; padding-top: 15px;" for="fileso">Upload Surat Jalan Bulog Disini</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mt-2" id="formupload">
                    <label for="filebast" class="h6">Upload BAST Bulog</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px;" id="filebast" name="filebast">
                            <label class="custom-file-label custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px; border-radius: 25px; padding-top: 15px;" for="filebast">Upload BAST Bulog Disini</label>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-12 table-responsive h6 mt-3">
                    <table class="table" id="tablelo">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kabupaten/Kota</th>
                                <th scope="col">Kecamatan</th>
                                <th scope="col">Desa/Kelurahan</th>
                                <th scope="col">Total Muatan (Kg)</th>
                                <th scope="col" class="text-center">Detail</th>
                            </tr>
                        </thead>
                        <tbody id="datalo">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/gudang/lo/getdetaillo.js') ?>"></script>
<?php $this->endSection() ?>