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
                <input type="text" id="idlo" hidden readonly>
                <div class="col-md-6 mb-3">
                    <label for="tanggal_pembuatan" class="h6">Tanggal Dokumen</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="date" style="height: 50px !important; font-size: 14px;" placeholder="Tanggal Pembuatan" id="tanggal_pembuatan" name="tanggal_pembuatan">
                </div>
                <div class="col-md-6 mb-3">
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
                <div class="col-md-6 mb-3 d-none">
                    <label for="nomor_lo" class="h6">No Loading Order (LO)</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Nomor LO" id="nomor_lo" name="nomor_lo" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="totalpengiriman" class="h6">Total Pengiriman</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Kg" id="totalpengiriman" name="totalpengiriman" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nomor_wo" class="h6">No WO</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No WO Disini" id="nomor_wo" name="nomor_wo">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nomor_so" class="h6">No SO</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No SO Disini" id="nomor_so" name="nomor_so">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nomor_do" class="h6">No DO</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No DO Disini" id="nomor_do" name="nomor_do">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nopolmobil" class="h6">Nopol Mobil</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nopol Mobil Disini" id="nopolmobil" name="nopolmobil">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="namadriver" class="h6">Nama Driver</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Driver Disini" id="namadriver" name="namadriver">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nomordriver" class="h6">Nomor Telpon Driver</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan No Telpon Driver Disini" id="nomordriver" name="nomordriver">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jampengiriman" class="h6">Jam Pengiriman</label>
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="time" style="height: 50px !important; font-size: 14px;" placeholder="Jam Pengiriman" id="jampengiriman" name="jampengiriman">
                </div>
            </div>
            <div class="row">
                <div class="col-12 table-responsive h6 mt-3">
                    <table class="table" id="tablejs">
                        <thead>
                            <tr>
                                <th scope="col">Kabupaten/Kota</th>
                                <th scope="col">Kecamatan</th>
                                <th scope="col">Desa/Kelurahan</th>
                                <th scope="col">Total Muatan (Kg)</th>
                                <th scope="col" class="text-center">Jam Penerimaan</th>
                            </tr>
                        </thead>
                        <tbody id="datasj">
                        </tbody>
                    </table>
                </div>
            </div>
            <form id="uploadForm" class="row mt-3" enctype="multipart/form-data">
                <div class="col-md-4 mb-3 mt-2" id="formupload">
                    <label for="file1" class="h6">Upload WO dan Tonase</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px;" id="file1" name="file1">
                            <label class="custom-file-label custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px; border-radius: 25px; padding-top: 15px;" for="file1">Upload WO Disini</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex flex-row">
                                <div class="">
                                    <a href="" type="button" class="h6 mt-2" data-bs-toggle="modal" data-bs-target="#modal4">
                                        Contoh Dokumen
                                    </a>
                                </div>
                                <div class="ml-auto">
                                    <a href="" type="button" class="h6 mt-2" data-bs-toggle="modal" data-bs-target="#modal1">
                                        Preview Dokumen
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mt-2" id="formupload">
                    <label for="file2" class="h6">Upload Loading Order (LO) dan Surat Jalan</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px;" id="file2" name="file2">
                            <label class="custom-file-label custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px; border-radius: 25px; padding-top: 15px;" for="file2">Upload LO Disini</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex flex-row">
                                <div class="">
                                    <a href="" type="button" class="h6 mt-2" data-bs-toggle="modal" data-bs-target="#modal5">
                                        Contoh Dokumen
                                    </a>
                                </div>
                                <div class="ml-auto">
                                    <a href="" type="button" class="h6 ml-4 mt-2" data-bs-toggle="modal" data-bs-target="#modal2">
                                        Preview Dokumen
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mt-2" id="formupload">
                    <label for="file3" class="h6">Upload DO, SO, dan Surat Jalan Bulog</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px;" id="file3" name="file3">
                            <label class="custom-file-label custom-shadow border-0 bg-white text-secondary px-4" style="height: 50px !important; font-size: 14px; border-radius: 25px; padding-top: 15px;" for="file3">Upload DO Disini</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex flex-row">
                                <div class="">
                                    <a href="" type="button" class="h6 mt-2" data-bs-toggle="modal" data-bs-target="#modal6">
                                        Contoh Dokumen
                                    </a>
                                </div>
                                <div class="ml-auto">
                                    <a href="" type="button" class="h6 ml-4 mt-2" data-bs-toggle="modal" data-bs-target="#modal3">
                                        Preview Dokumen
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row mt-3">
                <div class="col-md-12 mb-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="prosesedit" name="prosesedit">Update Data</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Dokumen Contoh-->
<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Preview Dokumen WO dan Tonase</h6>
            </div>
            <div class="modal-body">
                <embed id="out1" type="application/pdf" width="100%" height="600px" src="" />
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Preview Loading Order (LO) dan Surat Jalan</h6>
            </div>
            <div class="modal-body">
                <embed id="out2" type="application/pdf" width="100%" height="600px" src="" />
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Privew DO, SO, dan Surat Jalan Bulog</h6>
            </div>
            <div class="modal-body">
                <embed id="out3" type="application/pdf" width="100%" height="600px" src="" />
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Contoh Dokumen WO dan Tonase</h6>
            </div>
            <div class="modal-body">
                <embed type="application/pdf" width="100%" height="600px" src="<?= base_url('contoh/contohwo.pdf') ?>" />
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Contoh Loading Order (LO) dan Surat Jalan</h6>
            </div>
            <div class="modal-body">
                <embed type="application/pdf" width="100%" height="600px" src="<?= base_url('contoh/contohlo.pdf') ?>" />
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Contoh DO, SO, dan Surat Jalan Bulog</h6>
            </div>
            <div class="modal-body">
                <embed type="application/pdf" width="100%" height="600px" src="<?= base_url('contoh/contohdo.pdf') ?>" />
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/gudang/lo/getdetaillo.js') ?>"></script>
<?php $this->endSection() ?>