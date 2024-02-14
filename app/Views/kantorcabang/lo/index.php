<?php $this->extend('kantorcabang/layout') ?>
<?php $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Loading Order (LO)</h4>
            <div class="row mt-4">
                <div class="col-12 h6">Pilih Berdasarkan</div>

                <div class="col-md-4 d-none my-3">
                    <input type="text" name="kantor" id="kantor" value="<?= session()->get('id_kantor_cabang') ?>">
                </div>

                <div class="col-md-6 my-3">
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="alokasi" name="alokasi" style="height: 50px !important; font-size: 14px;" placeholder="Alokasi">
                        <option value="0" selected disabled>Pilih Alokasi</option>
                    </select>
                </div>
                <div class="col-md-6 my-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="filterLO" name="filterLO">Tampilkan</button>
                </div>
            </div>

            <div class="row d-none" id="filter">
                <div class="col-md-4 my-3">
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihgudang" name="pilihgudang" style="height: 50px !important; font-size: 14px;" placeholder="Pilih Gudang">
                        <option data-nama_gudang="0" value="0">Pilih Gudang</option>
                    </select>
                </div>
                <div class="col-md-4 my-3">
                    <select class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihkabupatenkota" name="pilihkabupatenkota" style="height: 50px !important; font-size: 14px;" placeholder="Pilih Kabupaten Kota" onchange="showKecamatan()">
                        <option data-nama_kabupaten='0' value="0">Pilih Nama Kabupaten/Kota</option>
                    </select>
                </div>
                <div class="col-md-4 my-3">
                    <select class="form-control cuzstom-shadow custom-radius border-0 bg-white text-secondary px-4" id="pilihkecamatan" name="pilihkecamatan" style="height: 50px !important; font-size: 14px;" placeholder="Pilih Kecamatan">
                        <option value="0">Pilih Kecamatan</option>
                    </select>
                </div>

            </div>
            <div class="row d-none" id="filterSearch">
                <div class="col-md-4 col-sm-12 my-3">
                    <label for="keyword" class="h6">Pencarian</label>
                    <input oninput="cari()" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Keyword Pencarian" id="keyword" name="keyword">
                </div>
                <div class="col-md-4 col-sm-12 my-3">
                    <label for="banyaknya" class="h6">Tampilkan Dalam (Data)</label>
                    <select onchange="banyaknya()" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="banyaknya" name="banyaknya" style="height: 50px !important; font-size: 14px;" placeholder="">
                        <option value="10">10 Data</option>
                        <option value="25">25 Data</option>
                        <option value="50">50 Data</option>
                        <option value="100">100 Data</option>
                    </select>
                </div>
                <div class="col-md-4 col-sm-12 my-3">
                    <form action="" id="formDownload" method="post">
                        <input type="text" id="idAlokasi" value="" hidden>
                        <label for="dok" class="h6">Download Excel</label>
                        <button type="submit" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="downloadexcel" name="downloadexcel">Download Excel</button>
                    </form>
                </div>
            </div>
            <div class="row d-none" id="tabelhilangdulu">
                <div class="col-12">
                    <div class="table-responsive h6 mt-3">
                        <table class="display" id="tablelo">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Gudang</th>
                                    <th scope="col">No Loading Order (LO)</th>
                                    <th scope="col">Nopol Mobil/Driver</th>
                                    <th scope="col">Total Muatan (Kg)</th>
                                    <th scope="col">Status</th>
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
</div>

<script src="<?= base_url('assets/js/kantorcabang/lo/getalllokantor.js') ?>"></script>
<?php $this->endSection() ?>