<?php $this->extend('kantorcabang/layout') ?>
<?php $this->section('content') ?>
<div class="row p-3">
    <div class="col-md-12">
        <div class="card shadow-sm" style="border-radius: 5px;">
            <div class="">
                <div class="row">
                    <div class="col-lg-3 border-right pr-0">
                        <div class="card-body border-bottom" style="background-color: rgb(10,97,236); border-radius: 5px 0 0 0;">
                            <h4 class="card-title text-white">Cetak Document</h4>
                            <p class="text-light" style="font-size: 11px;">Sistem Informasi Manajemen Bantuan Pangan</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="kecamatan">Pilih Kecamatan</label>
                                <input type="number" id="kecamatan" name="kecamatan" class="form-control shadow-sm border-2 bg-shadow text-secondary" placeholder="Masukkan No Kecamatan" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group">
                                <label for="kelurahan">Pilih Kelurahan</label>
                                <input type="text" id="kelurahan" name="kelurahan" class="form-control shadow-sm border-2 bg-white text-secondary" placeholder="Masukkan Nama Kelurahan" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group">
                                <label for="no_kpm_awal">No KPM Awal</label>
                                <textarea id="no_kpm_awal" name="no_kpm_awal" class="form-control shadow-sm border-2 bg-white text-secondary" rows="3" placeholder="Masukkan No KPM Awal"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="no_kpm_akhir">No KPM Akhir</label>
                                <input type="text" id="no_kpm_akhir" name="no_kpm_akhir" class="form-control shadow-sm border-2 bg-white text-secondary" placeholder="Masukkan No KPM Akhir" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group">
                                <label for="no_surat">No Surat</label>
                                <input type="text" id="no_surat" name="no_surat" class="form-control shadow-sm border-2 bg-white text-secondary" placeholder="Masukkan No Surat" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group">
                                <label for="hari_tanggal">Hari/Tanggal</label>
                                <input type="text" id="hari_tanggal" name="hari_tanggal" class="form-control shadow-sm border-2 bg-white text-secondary" placeholder="Masukkan Hari/Tanggal" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group">
                                <label for="waktu_mulai">Waktu(Mulai)</label>
                                <input type="text" id="waktu_mulai" name="waktu_mulai" class="form-control shadow-sm border-2 bg-white text-secondary" placeholder="Masukkan Waktu Mulai" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group">
                                <label for="waktu_selesai">Waktu(Selesai)</label>
                                <input type="text" id="waktu_selesai" name="waktu_selesai" class="form-control shadow-sm border-2 bg-white text-secondary" placeholder="Masukkan Waktu Selesai" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group">
                                <label for="tempat">Tempat</label>
                                <input type="text" id="tempat" name="tempat" class="form-control shadow-sm border-2 bg-white text-secondary" placeholder="Masukkan Tempat" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group">
                                <label for="transporter">Transporter</label>
                                <input type="text" id="transporter" name="transporter" class="form-control shadow-sm border-2 bg-white text-secondary" placeholder="Masukkan Transporter" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>