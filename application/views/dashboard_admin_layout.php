<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRESENSI DASHBOARD</title>
    <link href="<?= base_url(); ?>assets/admin/css/mystyle.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/admin/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/admin/css/animate.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/admin/js/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/admin/js/select2/dist/select2-bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/admin/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/js/datatables/datatables.min.css">
    <script src="<?= base_url(); ?>assets/admin/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/nprogress.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/ckeditor/ckeditor.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/validator/validator.min.js"></script>
    <!--[if lt IE 9]>
              <script src="../assets/js/ie8-responsive-file-warning.js"></script>
              <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
              <![endif]-->
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?= site_url(''); ?>" target="_blank" class="site_title"><span>DAHSBOARD</span></a>
                    </div>
                    <div class="clearfix"></div>
                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="<?= base_url(); ?>assets/admin/images/img.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Selamat Datang,</span>
                            <h2><?= $this->session->userdata['username']; ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->
                    <br />
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>&nbsp;</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?= site_url('dashboard'); ?>"><i class="fa fa-home"></i>Dashboard</a></li>

                                <li><a href="<?= site_url('management_user'); ?>"><i class="fa fa-users"></i> Management User</a></li>
                                <li><a><i class="fa fa-hospital-o"></i> Master <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= site_url('jurusan'); ?>">Jurusan</a></li>
                                        <li><a href="<?= site_url('dosen'); ?>">Dosen</a></li>
                                        <li><a href="<?= site_url('mahasiswa'); ?>">Mahasiswa</a></li>
                                        <li><a href="<?= site_url('matkul'); ?>">Mata Kuliah</a></li>
                                        <li><a href="<?= site_url('ruangan'); ?>">Ruangan</a></li>
                                        <li><a href="<?= site_url('pertemuan'); ?>">Pertemuan</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?= site_url('presensi'); ?>"><i class="fa fa-folder-open"></i>Presensi</a></li>
                                <li><a href="<?= site_url('logout'); ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>
            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= base_url(); ?>assets/admin/images/img.jpg" alt=""><?= $this->session->userdata['username']; ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="<?= site_url('logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="row x_title">
                        <div class="col-md-12">
                            <h3><?= $titlepage; ?></h3>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <br />
                <br />
                <?php
                echo $this->session->flashdata('message');
                switch ($page) {
                    case 'index':
                        include 'dashboard_index.php';
                        break;
                        //end of dahsboard index
                    case 'management_user':
                        include 'users/management_user.php';
                        break;
                    case 'tambah_user':
                        include 'users/tambah_user.php';
                        break;
                        //end of user modul
                    case 'jurusan':
                        include 'jurusan/jurusan.php';
                        break;
                    case 'tambah_jurusan':
                        include 'jurusan/tambah_jurusan.php';
                        break;
                    case 'edit_jurusan':
                        include 'jurusan/edit_jurusan.php';
                        break;
                        //end of jurusan modul
                    case 'dosen':
                        include 'dosen/dosen.php';
                        break;
                    case 'tambah_dosen':
                        include 'dosen/tambah_dosen.php';
                        break;
                    case 'edit_dosen':
                        include 'dosen/edit_dosen.php';
                        break;
                        //end of dosen modul
                    case 'mahasiswa':
                        include 'mahasiswa/mahasiswa.php';
                        break;
                    case 'tambah_mahasiswa':
                        include 'mahasiswa/tambah_mahasiswa.php';
                        break;
                    case 'edit_mahasiswa':
                        include 'mahasiswa/edit_mahasiswa.php';
                        break;
                        //end of mahasiswa modul
                    case 'matkul':
                        include 'matkul/matkul.php';
                        break;
                    case 'tambah_matkul':
                        include 'matkul/tambah_matkul.php';
                        break;
                    case 'edit_matkul':
                        include 'matkul/edit_matkul.php';
                        break;
                    case 'detail_matkul':
                        include 'matkul/detail_matkul.php';
                        break;
                    case 'tambah_detail_matkul':
                        include 'matkul/tambah_detail_matkul.php';
                        break;
                        //end of matkul modul
                    case 'ruangan':
                        include 'ruangan/ruangan.php';
                        break;
                    case 'tambah_ruangan':
                        include 'ruangan/tambah_ruangan.php';
                        break;
                    case 'edit_ruangan':
                        include 'ruangan/edit_ruangan.php';
                        break;
                    case 'hapus_ruangan':
                        include 'ruangan/hapus_ruangan.php';
                        break;
                        //end of ruangan modul
                    case 'pertemuan':
                        include 'pertemuan/pertemuan.php';
                        break;
                    case 'tambah_pertemuan':
                        include 'pertemuan/tambah_pertemuan.php';
                        break;
                    case 'edit_pertemuan':
                        include 'pertemuan/edit_pertemuan.php';
                        break;
                    case 'hapus_pertemuan':
                        include 'pertemuan/hapus_pertemuan.php';
                        break;
                        //end of pertemuan modul
                    case 'presensi':
                        include 'presensi/presensi.php';
                        break;
                    case 'detail_pertemuan':
                        include 'presensi/detail_presensi_pertemuan.php';
                        break;
                    case 'detail_absen':
                        include 'presensi/detail_absen.php';
                        break;
                        //end of Presensi modul

                }
                ?>
                <!-- footer content -->
                <footer>
                    <div class="copyright-info">
                        <p class="pull-right">
                            Presensi Dashboard &copy;
                            Gentelella Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
            <!-- /page content -->
        </div>
    </div>
    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>
    <script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/icheck/icheck.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/nicescroll/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/moment/moment.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/datepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/admin/js/datatables/datatables.min.js"></script>

    <script>
        NProgress.done();

        function likeUcWords(str) {
            if (str.length > 0) {
                str = str.toLowerCase();
                return str.replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
                    function($1) {
                        return $1.toUpperCase();
                    });
            }
        }

        function currencyFormatID(num, decimalPoint = 0) {
            return (
                num
                .toFixed(decimalPoint) // always two decimal digits
                .replace('.', ',') // replace decimal point character with ,
                .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
            ) // use . as a separator
        }
    </script>
</body>

</html>