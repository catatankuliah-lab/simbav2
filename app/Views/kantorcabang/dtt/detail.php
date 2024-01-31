<?php $this->extend('kantorcabang/layout') ?>
<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="card-title mb-3">DTT</h4>
            <h6 class="card-subtitle mb-3">
                Klik <a style="font-weight: bolder;" href="<?= base_url('kantorcabang/dtt') ?>">disini</a> untuk kembali ke menu DTT
            </h6>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <form id="uploadForm" class="" enctype="multipart/form-data">
                        <label for="filedtt" class="h6">Upload file DTT yang sudah diserahkan kepada KPM</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input custom-shadow border-0 bg-white text-secondary px-4" id="filedtt" name="filedtt">
                                <label class="custom-file-label" for="filedtt"></label>
                            </div>
                            <div class="input-group-apend">
                                <span id="uploaddtt" class="input-group-text bg-primary text-white">Upload</span>
                            </div>
                        </div>
                        <input type="text" id="kodedtt" name="kodedtt" value="<?= $kodedtt ?>" hidden>
                    </form>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div id="showpdf"></div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <table id="headdtt" border="1px" style="width: 100%;">
                    </table>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <table id="kontendtt" border="1px" style="width: 100%;">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/kantorcabang/dtt/getdetail.js') ?>"></script>
<?php $this->endSection() ?>