<?php $this->extend('kantorcabang/layout') ?>
<?php $this->section('content') ?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h5 class="card-title mb-1">SPTJM</h5>
            <p style="font-size: 11px;">Sistem Informasi Manajamen Bantuan Pangan</p>

            <div class="row mt-12">
                <div class="col-md-10 mb-3">
                    <label for="nospm" class="h6">No SPM</label>
                    <input type="number" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="nospm" name="nospm">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" style="width: 90%; margin-top: 30px; border-radius: 10px;">Cari</button>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col d-flex justify-content-between">
                                    <h4 class="card-title">Data SPTJM</h4>
                                    <button class="btn btn-danger" style="border-radius: 3px;"><i class="fas fa-print"></i></button>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-primary">
                                            <div class="card-title text-white">Data PBP Lama</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-md-12 mb-3">
                                                <label for="nospm" class="h6">No SPM</label>
                                                <input type="number" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="nospm" name="nospm">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="nospm" class="h6">No SPM</label>
                                                <input type="number" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="nospm" name="nospm">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="nospm" class="h6">No SPM</label>
                                                <input type="number" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="nospm" name="nospm">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="nospm" class="h6">No SPM</label>
                                                <input type="number" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="nospm" name="nospm">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="nospm" class="h6">No SPM</label>
                                                <input type="number" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="nospm" name="nospm">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="nospm" class="h6">No SPM</label>
                                                <input type="number" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="nospm" name="nospm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-danger">
                                            <div class="card-title text-white">Data PBP Baru</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-md-12 mb-3">
                                                <label for="nospm" class="h6">No SPM</label>
                                                <input type="number" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="nospm" name="nospm">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="nospm" class="h6">No SPM</label>
                                                <input type="number" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="nospm" name="nospm">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="nospm" class="h6">No SPM</label>
                                                <input type="number" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="nospm" name="nospm">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="nospm" class="h6">No SPM</label>
                                                <input type="number" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="nospm" name="nospm">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="nospm" class="h6">No SPM</label>
                                                <input type="number" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="nospm" name="nospm">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="nospm" class="h6">No SPM</label>
                                                <input type="number" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" id="nospm" name="nospm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-block">Simpan Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showDetail(spmNumber) {
        // alert('Detail for SPM ' + spmNumber);
        window.location.href = '<?= base_url('gudang/spmbast/detail') ?>';
    }
</script>
<?php $this->endSection() ?>