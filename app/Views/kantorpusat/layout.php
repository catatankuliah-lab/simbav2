<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/favicon.ico') ?>">
    <title>SIMBA - 88</title>
    <!-- Custom CSS -->
    <script src="<?= base_url('assetss/libs/jquery/dist/jquery.min.js') ?>"></script>

    <link href="<?= base_url('dist/css/style.min.css') ?>" rel="stylesheet">

    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Load DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('dist/css/jquery.dataTables.min.css') ?>">

    <!-- Load DataTables JavaScript -->
    <script src="<?= base_url('dist/js/jquery.dataTables.min.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link href="<?= base_url('dist/css/style.min.css') ?>" rel="stylesheet">

    <meta name="theme-color" content="#FFFFFF" />
    <link rel="manifest" href="<?= base_url('assets/js/web.webmanifest') ?>" />
    <style>
        .gapake {
            border: none !important;
            opacity: 0.5 !important;
            color: grey !important;
            font-size: 14px !important;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            display: none !important;
        }
    </style>

</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <b class="logo-icon" style="display: none;">
                            <img src="<?= base_url('assets/img/logo88.png') ?>" alt="homepage" class="dark-logo" width="30px" height="40px" style="margin-left: 10px;" />
                            <img src="<?= base_url('assets/img/logo.png') ?>" alt="homepage" class="light-logo" />
                        </b>
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="<?= base_url('assets/img/logo.png') ?>" alt="homepage" class="dark-logo" width="200px" />
                            <!-- Light Logo text -->
                            <!-- <img src="<?= base_url('assets/img/logo.png') ?>" class="light-logo" alt="homepage" /> -->
                        </span>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                        <li class="nav-item d-none d-md-block">
                            <span class="text-dark"></span>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="ml-2"><span>Hello,</span> <span class="text-dark">Kantor Pusat</span> <i data-feather="chevron-down" class="svg-icon"></i></span>
                                <img src="<?= base_url('assetss/images/users/profile-pic.jpg') ?>" alt="user" class="rounded-circle" width="40">

                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <a class="mt-2 dropdown-item" href="<?= base_url('auth/login') ?>"><i data-feather="power" class="svg-icon mr-2 ml-1"></i>
                                    Logout</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap mt-3"><span class="hide-menu">Dashboard</span></li>
                        <li class="sidebar-item <?= $menu1 ?>">
                            <a class="sidebar-link" onclick="dashboard()" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li class="nav-small-cap mt-2"><span class="hide-menu">Kelola</span></li>
                        <li class="sidebar-item <?= $menu2 ?>">
                            <a class="sidebar-link" onclick="hakakses()" aria-expanded="false"><i data-feather="key" class="feather-icon"></i><span class="hide-menu">Hak Akses
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item <?= $menu3 ?>">
                            <a class="sidebar-link" onclick="akun()" aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span class="hide-menu">Akun
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item <?= $menu4 ?>">
                            <a class="sidebar-link" onclick="kc()" aria-expanded="false"><span class="hide-menu"><i class="far fa-building"></i>Kantor Cabang
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item <?= $menu5 ?>">
                            <a class="sidebar-link" onclick="gudang()" aria-expanded="false"></i><span class="hide-menu"><i class="far fa-building"></i>Gudang
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item <?= $menu8 ?>" hidden>
                            <a class="sidebar-link" onclick="wilayahkerja()" aria-expanded="false"></i><span class="hide-menu"><i class="far fa-building"></i>Wilayah Kerja
                                </span>
                            </a>
                        </li>
                        <li class="nav-small-cap mt-2"><span class="hide-menu">Menu</span></li>
                        <li class="sidebar-item <?= $menu6 ?>" hidden>
                            <a class="sidebar-link" onclick="dtt()" aria-expanded="false"><i data-feather="file" class="feather-icon"></i><span class="hide-menu">DTT
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item <?= $menu7 ?>">
                            <a class="sidebar-link" onclick="spm()" aria-expanded="false"><i data-feather="file" class="feather-icon"></i><span class="hide-menu">Loading Order (LO)
                                </span>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <div class="page-wrapper">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <script src="<?= base_url('assetss/libs/popper.js/dist/umd/popper.min.js') ?>"></script>
    <script src="<?= base_url('assetss/libs/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('dist/js/app-style-switcher.js') ?>"></script>
    <script src="<?= base_url('dist/js/feather.min.js') ?>"></script>
    <script src="<?= base_url('assetss/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') ?>"></script>
    <script src="<?= base_url('dist/js/sidebarmenu.js') ?>"></script>
    <script src="<?= base_url('dist/js/custom.min.js') ?>"></script>
    <script src="<?= base_url('assetss/extra-libs/c3/d3.min.js') ?>"></script>
    <script src="<?= base_url('assetss/extra-libs/c3/c3.min.js') ?>"></script>
    <script src="<?= base_url('assetss/libs/chartist/dist/chartist.min.js') ?>"></script>
    <script src="<?= base_url('assetss/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') ?>"></script>
    <script src="<?= base_url('assetss/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') ?>"></script>
    <script src="<?= base_url('assetss/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') ?>"></script>
    <script src="<?= base_url('dist/js/pages/dashboards/dashboard1.min.js') ?>"></script>


    <script>
        function dashboard() {
            window.location.href = "<?= base_url('kantorpusat/') ?>"
        }

        function hakakses() {
            window.location.href = "<?= base_url('kantorpusat/akses') ?>"
        }

        function akun() {
            window.location.href = "<?= base_url('kantorpusat/akun') ?>"
        }

        function kc() {
            window.location.href = "<?= base_url('kantorpusat/kc') ?>"
        }

        function gudang() {
            window.location.href = "<?= base_url('kantorpusat/gudang') ?>"
        }

        function dtt() {
            window.location.href = "<?= base_url('kantorpusat/dtt') ?>"
        }

        function spm() {
            window.location.href = "<?= base_url('kantorpusat/spmbast') ?>"
        }

        function wilayahkerja() {
            window.location.href = "<?= base_url('kantorpusat/wilayahkerja') ?>"
        }
    </script>
</body>

</html>