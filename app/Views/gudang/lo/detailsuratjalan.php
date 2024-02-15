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
                <input type="text" value="<?= $idsj ?>" id="idsj" hidden readonly>
                <input type="text" value="<?= $alokasi ?>" id="bahanalokasi" hidden readonly>
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
                    <label for="kabupatenkota" class="h6">Kabupaten / Kota</label>
                    <input readonly class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No WO Disini" id="kabupatenkota" name="kabupatenkota">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kecamatan" class="h6">Kecamatan</label>
                    <input readonly class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No SO Disini" id="kecamatan" name="kecamatan">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="desakelurahan" class="h6">Desa / Kelurahan</label>
                    <input readonly class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No DO Disini" id="desakelurahan" name="desakelurahan">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nopolmobil" class="h6">Nopol Mobil</label>
                    <input readonly class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nopol Mobil Disini" id="nopolmobil" name="nopolmobil">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="namadriver" class="h6">Nama Driver</label>
                    <input readonly class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="namadriver" name="namadriver">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nomordriver" class="h6">Nomor Telpon Driver</label>
                    <input readonly class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No Telpon Driver Disini" id="nomordriver" name="nomordriver">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="totalpengiriman" class="h6">Total Pengiriman</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Kg" id="totalpengiriman" name="totalpengiriman" readonly>
                </div>
            </div>
            <form id="uploadForm" class="row" enctype="multipart/form-data">
                <div class="col-md-6 mb-3 mt-2" id="formupload">
                    <label for="filesj" class="h6">Upload Surat Jalan</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px;" id="filesj" name="filesj">
                            <label class="custom-file-label custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px; border-radius: 25px; padding-top: 15px;" for="filesj">Upload Surat Jalan Disini</label>
                        </div>
                    </div>
                    <a href="" type="button" class="h6 ml-4 mt-2" data-bs-toggle="modal" data-bs-target="#modalsj">
                        Preview Surat Jalan
                    </a>
                </div>
                <div class="col-md-6 mb-3 mt-2" id="formupload">
                    <label for="filebukti" class="h6">Upload Bukti Penyerahan (Driver)</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px;" id="filebukti" name="filebukti">
                            <label class="custom-file-label custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px; border-radius: 25px; padding-top: 15px;" for="filebukti">Upload Bukti Penyerahan Disini</label>
                        </div>
                    </div>
                    <a href="" type="button" class="h6 ml-4 mt-2" data-bs-toggle="modal" data-bs-target="#modalbukti">
                        Preview LO
                    </a>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12 my-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="prosesupdate" name="prosesupdate">Upload Data</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalsj" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Privew Dokumen Surat Jalan</h6>
            </div>
            <div class="modal-body">
                <img id="outsj" src="" width="100%" alt="">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalbukti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Privew Dokumen Bukti Penyerahan (Driver)</h6>
            </div>
            <div class="modal-body">
                <img id="outbukti" src="" width="100%" alt="">
            </div>
        </div>
    </div>
</div>
<script src="https://catatankuliah-lab.github.io/jssimbav2/gudang/lo/getdetailsuratjalan.js"></script>
<?php $this->endSection() ?>