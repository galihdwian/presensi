<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PPID RSMS ADMIN DASHBOARD</title>
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
                        <a href="index.html" class="site_title"><span>PPID RSMS</span></a>
                    </div>
                    <div class="clearfix"></div>
                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="<?= base_url(); ?>assets/admin/images/img.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Selamat Datang,</span>
                            <h2><?= $this->session->userdata['nama_user']; ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->
                    <br />
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>&nbsp;</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?= site_url('adminppid'); ?>"><i class="fa fa-home"></i> Admin Dashboard</a></li>
                                <li><a><i class="fa fa-table"></i> Daftar Informasi Publik <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= site_url('adminppid/klasifikasi'); ?>">Klasifikasi</a></li>
                                        <li><a href="<?= site_url('adminppid/categori'); ?>">Kategori</a>
                                        <li><a href="<?= site_url('adminppid/dipstatus'); ?>">DIP Status</a></li>
                                        <!--<li><a href="<?php //echo site_url('adminppid/groupfile');
                                                            ?>">Group File DIP</a></li>-->
                                        <li><a href="<?= site_url('adminppid/dipmanajemen'); ?>">Manajemen DIP</a></li>
                                        <li><a href="<?= site_url('adminppid/manajemenfiles'); ?>">Manajemen Files</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-download"></i> Permohonan Informasi <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= site_url('adminpermohonan/user'); ?>">User Permohonan</a></li>
                                        <li><a href="<?= site_url('adminpermohonan/daftarpermohonan'); ?>">Permohonan</a></li>
                                        <li><a href="<?= site_url('adminpermohonan/daftarkeberatan'); ?>">Keberatan</a></li>
                                        <li><a href="<?= site_url('adminpermohonan/statistik'); ?>">Statistik</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-dropbox"></i> Pengadaan <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= site_url('adminppid/pengadaan'); ?>">List Informasi Pengadaan</a></li>
                                        <li><a href="<?= site_url('adminppid/pengadaan/master_dokumen'); ?>">Master Dokumen</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-heartbeat"></i> Siaga Covid-19 <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= site_url('adminppid/siaga-covid-19'); ?>">Siaga Covid-19</a></li>
                                        <li><a href="<?= site_url('adminppid/siaga-covid-19/statistik-covid-19'); ?>">Statistik Covid-19</a></li>
                                        <li><a href="<?= site_url('adminppid/siaga-covid-19/regulasi-terkait-covid-19'); ?>">Regulasi</a></li>
                                        <li><a href="<?= site_url('adminppid/siaga-covid-19/informasi-donasi-covid-19'); ?>">Donasi</a></li>
                                        <li><a href="<?= site_url('adminppid/siaga-covid-19/informasi-anggaran-program-kegiatan-realisasi-terkait-covid-19'); ?>">Anggaran, Program & Kegiatan, Realisasi</a></li>
                                        <li><a href="<?= site_url('adminppid/siaga-covid-19/informasi-pengadaan-terkait-covid-19'); ?>">Pengadaan</a></li>
                                        <li><a href="<?= site_url('adminppid/siaga-covid-19/informasi-inovasi-terkait-covid-19'); ?>">Inovasi</a></li>
                                        <li><a href="<?= site_url('adminppid/siaga-covid-19/dopokan-sehat'); ?>">Dopokan Sehat</a></li>
                                        <li><a href="<?= site_url('adminppid/siaga-covid-19/informasi-posko-covid'); ?>">Informasi Posko Covid</a></li>
                                        <li><a href="<?= site_url('adminppid/siaga-covid-19/sosialisasi-dan-pengelolaan-jenazah-covid-19'); ?>">Sosialisasi Covid-19 dan Pengelolaan Jenazah Covid-19</a></li>
                                        <li><a href="<?= site_url('adminppid/siaga-covid-19/simulasi-penanganan-covid-19'); ?>">Simulasi Penanganan Covid-19</a></li>
                                        <li><a href="<?= site_url('adminppid/siaga-covid-19/pedoman-ketentuan-pelayanan-penangan-kewaspadaan-covid-19'); ?>">Pedoman Ketentuan Pelayanan Penangan Kewaspadaan Covid-19</a></li>
                                        <li><a href="<?= site_url('adminppid/siaga-covid-19/pengumuman-ketentuan-pelayanan-penanganan-kewaspadaan-covid-19'); ?>">Pengumuman Ketentuan Pelayanan Penanganan Kewaspadaan Covid-19</a></li>
                                        <li><a href="<?= site_url('adminppid/siaga-covid-19/alur-dan-prosedur'); ?>">Alur dan Prosedur</a></li>
                                        <li><a href="<?= site_url('adminppid/siaga-covid-19/vaksinasi'); ?>">Vaksinasi</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-street-view"></i> Zona Integritas <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= site_url('adminppid/zona-integritas'); ?>">Zona Integritas</a></li>
                                        <li><a href="<?= site_url('adminppid/zona-integritas/regulasi'); ?>">Regulasi Zona Integritas</a></li>
                                        <li><a href="<?= site_url('adminppid/zona-integritas/foto-kegiatan'); ?>">Foto Kegiatan</a></li>
                                        <li><a href="<?= site_url('adminppid/zona-integritas/video-kegiatan'); ?>">Video Kegiatan</a></li>
                                        <li><a href="<?= site_url('adminppid/zona-integritas/transferabilitas'); ?>">Transferabilitas</a></li>
                                        <li><a href="<?= site_url('adminppid/zona-integritas/inovasi'); ?>">Inovasi</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-gift"></i> Donasi <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= site_url('adminppid/donasi/master-satuan'); ?>">Master Satuan</a></li>
                                        <li><a href="<?= site_url('adminppid/donasi'); ?>">Donasi</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?= site_url('adminpartisipasipublik/topik'); ?>"><i class="fa fa-thumbs-o-up"></i> Partisipasi Publik</a></li>
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
                                    <img src="<?= base_url(); ?>assets/admin/images/img.jpg" alt=""><?= $this->session->userdata['nama_user']; ?>
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
                switch ($page) {
                    case 'index':
                        include 'ppidadmin_index.php';
                        break;
                    case 'dipstatus':
                        include 'dip/status/status_index.php';
                        break;
                    case 'dipmanajemen':
                        include 'dip/manajemen/manajemen_index.php';
                        break;
                    case 'dipmanajemenadd':
                        include 'dip/manajemen/dipmanajemenadd.php';
                        break;
                    case 'dipmanajemenaddchild':
                        include 'dip/manajemen/dipmanajemenaddchild.php';
                        break;
                    case 'dipmanajemenedit':
                        include 'dip/manajemen/dipmanajemen_edit.php';
                        break;
                    case 'dipmanajemenfiles':
                        include 'dip/manajemen/dipmanajemen_files.php';
                        break;
                    case 'dipmanajemenuploadfiles':
                        include 'dip/manajemen/dipmanajemen_uploadfiles.php';
                        break;
                    case 'dipmanajemenfilesedit':
                        include 'dip/manajemen/dipmanajemen_editfiles.php';
                        break;
                    case 'klasifikasi':
                        include 'klasifikasi/klasifikasi_index.php';
                        break;
                    case 'categori':
                        include 'categori/categori_index.php';
                        break;
                    case 'categori_list_file':
                        include 'categori/categori_list_files.php';
                        break;
                    case 'categori_list_file_upload':
                        include 'categori/categori_list_file_upload.php';
                        break;
                    case 'categori_list_file_edit':
                        include 'categori/categori_list_file_edit.php';
                        break;
                    case 'groupfile':
                        include 'dip/groupfile/groupfile.php';
                        break;
                    case 'groupfile_add':
                        include 'dip/groupfile/groupfile_add.php';
                        break;
                    case 'permohonaninformasi_user':
                        include 'permohonaninformasi/user/user_index.php';
                        break;
                    case 'permohonaninformasi_user_detail':
                        include 'permohonaninformasi/user/user_detail.php';
                        break;
                    case 'permohonaninformasi_permohonan':
                        include 'permohonaninformasi/permohonan/permohonan_index.php';
                        break;
                    case 'permohonaninformasi_permohonan_detail':
                        include 'permohonaninformasi/permohonan/permohonan_detail.php';
                        break;
                    case 'permohonaninformasi_permohonan_konfirmasi':
                        include 'permohonaninformasi/permohonan/permohonan_konfirmasi.php';
                        break;
                    case 'permohonaninformasi_permohonan_keputusan':
                        include 'permohonaninformasi/permohonan/permohonan_keputusan.php';
                        break;
                    case 'permohonaninformasi_keberatan':
                        include 'permohonaninformasi/keberatan/keberatan_index.php';
                        break;
                    case 'permohonaninformasi_keberatan_detail':
                        include 'permohonaninformasi/keberatan/keberatan_detail.php';
                        break;
                    case 'permohonaninformasi_keberatan_verifikasi':
                        include 'permohonaninformasi/keberatan/keberatan_verifikasi.php';
                        break;
                    case 'permohonan_informasi_statistik':
                        include 'permohonaninformasi/statistik/permohonan_informasi_statistik_list.php';
                        break;
                    case 'permohonan_informasi_statistik_tambah':
                        include 'permohonaninformasi/statistik/permohonan_informasi_statistik_tambah.php';
                        break;
                    case 'permohonan_informasi_statistik_edit':
                        include 'permohonaninformasi/statistik/permohonan_informasi_statistik_edit.php';
                        break;
                    case 'partisipasipublik_topik':
                        include 'partisipasipublik/topik/topik_index.php';
                        break;
                    case 'partisipasipublik_topik_detail':
                        include 'partisipasipublik/topik/topik_detail.php';
                        break;
                    case 'manajemenfiles':
                        include 'manajemenfiles/manajemenfiles_index.php';
                        break;
                    case 'manajemenfiles_edit':
                        include 'manajemenfiles/manajemenfiles_edit.php';
                        break;
                    case 'pengadaan':
                        include 'pengadaan/pengadaan_index.php';
                        break;
                    case 'pengadaan_tambah_data':
                        include 'pengadaan/pengadaan_tambah_data.php';
                        break;
                    case 'pengadaan_edit_data':
                        include 'pengadaan/pengadaan_edit_data.php';
                        break;
                    case 'pengadaan_list_dokumen_pengadaan':
                        include 'pengadaan/pengadaan_list_dokumen_pengadaan.php';
                        break;
                    case 'pengadaan_tambah_dokumen_pengadaan':
                        include 'pengadaan/pengadaan_tambah_dokumen_pengadaan.php';
                        break;
                    case 'pengadaan_master_dokumen':
                        include 'pengadaan/master_dokumen/master_dokumen_index.php';
                        break;
                    case 'pengadaan_master_dokumen_tambah_data':
                        include 'pengadaan/master_dokumen/master_dokumen_tambah_data.php';
                        break;
                    case 'pengadaan_master_dokumen_edit_data':
                        include 'pengadaan/master_dokumen/master_dokumen_edit_data.php';
                        break;
                    case 'pengadaan_dokumen_rs_set':
                        include 'pengadaan/dokumen_rs/dokumen_rs_set.php';
                        break;
                    case 'thread_content':
                        include 'thread/thread_content.php';
                        break;
                    case 'thread_tambah_media':
                        include 'thread/thread_tambah_media.php';
                        break;
                    case 'thread_edit_media':
                        include 'thread/thread_edit_media.php';
                        break;
                    case 'thread_main_content':
                        include 'thread/main_content/thread_main_content.php';
                        break;
                    case 'thread_main_content_tambah':
                        include 'thread/main_content/thread_main_content_tambah.php';
                        break;
                    case 'thread_main_content_edit':
                        include 'thread/main_content/thread_main_content_edit.php';
                        break;
                    case 'donasi-master-satuan':
                        include 'donasi/satuan_list.php';
                        break;
                    case 'donasi-master-satuan-tambah':
                        include 'donasi/satuan_tambah.php';
                        break;
                    case 'donasi-master-satuan-edit':
                        include 'donasi/satuan_edit.php';
                        break;
                    case 'donasi':
                        include 'donasi/donasi_list.php';
                        break;
                    case 'donasi-tambah':
                        include 'donasi/donasi_tambah.php';
                        break;
                    case 'donasi-edit':
                        include 'donasi/donasi_edit.php';
                        break;
                    default:
                        include 'ppidadmin_index.php';
                        break;
                }
                ?>
                <!-- footer content -->
                <footer>
                    <div class="copyright-info">
                        <p class="pull-right">
                            PPID RSMS Admin Dashboard &copy; Imam Syaifulloh -
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