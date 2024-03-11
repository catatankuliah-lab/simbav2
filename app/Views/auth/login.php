    <!DOCTYPE html>
    <html dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/favicon.ico') ?>">
        <title>Login | Logistic 88</title>
        <link href="<?= base_url('dist/css/style.min.css') ?>" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <meta name="theme-color" content="#FFFFFF" />
        <link rel="manifest" href="<?= base_url('assets/js/web.webmanifest') ?>" />
    </head>

    <body style="background-color: #F0F5F9;">
        <div class="main-wrapper">
            <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative vh-100" style="background:url('<?= base_url('assets/img/bg.jpg') ?>')no-repeat center center;">
                <div class="auth-box row shadow-lg">
                    <div class="col-lg-6 col-md-5 d-sm-none modal-bg-img" style="background-image: url('<?= base_url('assets/img/kantor-88.png') ?>')">
                    </div>
                    <div class="col-lg-6 col-md-7 bg-white">
                        <div class="p-3">
                            <div class="text-center pt-3 pb-2">
                                <img src="<?= base_url('assets/img/logo.png') ?>" alt="wrapkit" width="80%">
                            </div>
                            <h3 class="mt-5 text-start"><b>Login</b></h3>
                            <p class="" style="font-size: 12px;">Masukan username dan kata sandi anda</p>
                            <form class="mt-4">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="username" class="h6">Username</label>
                                        <input id="username" name="username" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="text" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Username">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="password" class="h6">Password</label>
                                        <input id="password" name="password" class="form-control custom-shadow custom-radius border-0 bg-white text-secondary px-4" type="password" style="height: 50px !important; font-size: 14px;" placeholder="Masukan Password">
                                        <span class="d-flex justify-content-end mt-3" id="lihatPassword" onclick="showPassword()" style="font-size: 11px;">Lihat Password</span>
                                    </div>
                                    <div class="col-lg-12 mt-2 mb-5 text-center">
                                        <button type="button" class="btn btn-block btn-dark" style="border-radius: 15px;" id="prosesLogin">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5 d-none d-md-block modal-bg-img" style="background-image: url('<?= base_url('assets/img/kantor-88.png') ?>')">
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="<?= base_url('assets/js/auth/proseslogin.js') ?>"></script>
        <script>
            $(".preloader ").fadeOut();
        </script>
    </body>

    </html>