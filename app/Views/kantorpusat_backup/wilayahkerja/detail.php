<?php $this->extend('kantorpusat/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">Detail Wilayah Kerja Kantor Cabang</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorpusat/wilayahkerja') ?>">disini</a> untuk kembali ke menu utama Wilayah Kerja Kantor Cabang
            </h6>
            <div class="row mt-4">
                <div class="col-12 mb-3">
                    <input class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Kantor Disini" id="id" name="id" value="<?= session()->getFlashdata("id") ?>" hidden>
                    <label for="namakantorcabang" class="h6">Nama Kantor Cabang</label>
                    <input id="namakantorcabang" name="namakantorcabang" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Nama Kantor Cabang Disini" readonly oninput="toUpperKantorCabang()">
                </div>
                <div class="table">
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
                <div class="col-md-12 col-sm-12 mt-3">
                    <button type="button" style="height: 50px !important; font-size: 14px;" class="btn waves-effect custom-shadow waves-light btn-rounded btn-primary w-100" id="tambahDataWilayahKerja" onclick="tambahWilayahKerja()">Tambah Wilayah Kerja</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets\js\kantorpusat\wilayahkerja\detailwilayahkerjakantorcabang.js') ?>"></script>
<script>
    function tambahWilayahKerja() {
        var id_kantor = $("#id").val();
        window.location.href = "<?= base_url('kantorpusat/wilayahkerja/detail-wilayahkerja/create/') ?>" + id_kantor;
    }
</script>
<?php $this->endSection() ?>