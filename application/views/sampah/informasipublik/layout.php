<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>PPID RSUD Prof. Dr. Margono Soekarjo</title>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>/assets/images/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>/assets/images/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>/assets/images/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>/assets/images/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>/assets/images/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>/assets/images/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>/assets/images/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>/assets/images/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>/assets/images/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url(); ?>/assets/images/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>/assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>/assets/images/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>/assets/images/favicons/favicon-16x16.png">
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/animate.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap-dropdownhover.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/informasipublik.css?v=202009162'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/responsive.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/prettyPhoto.css'); ?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
</head>

<body>
    <header class="header">
        <div class="container">
            <nav class="navbar navbar-blade" role="navigation">
                <div class="navbar-header">
                    <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a href="<?php echo site_url(); ?>" class="navbar-brand scroll-top logo  animated bounceInDown">
                        <b><img src="<?php echo base_url(); ?>assets/images/logo.png" class="img-responsive"></b>
                    </a>
                </div>
                <!--/.navbar-header-->
                <div class="collapse navbar-collapse" id="main-menu" data-hover="dropdown" data-animations="bounce fadeInLeft fadeInUp fadeInRight">
                    <ul class="nav navbar-nav">
                        <?php if ($menu == 'home') { ?>
                            <li class="active"><a href="<?php echo site_url(); ?>">Home</a></li>
                        <?php } else { ?>
                            <li><a href="<?php echo site_url(); ?>">Home</a></li>
                        <?php
                        }
                        if ($menu == 'profil') {
                        ?>
                            <li class="dropdown active"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profil <span class="caret"></span></a></a>
                                <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right" role="menu">
                                    <li><a href="<?php echo site_url('visimisi'); ?>">Visi Dan Misi</a></li>
                                    <li><a href="<?php echo site_url('strukturorganisasirs'); ?>">Struktur Organisasi RSUD Prof. Dr. Margono Soekarjo</a></li>
                                    <li><a href="<?php echo site_url('profilpejabatstruktural'); ?>">Profil Pejabat Struktural</a></li>
                                    <li><a href="<?php echo site_url('skppid'); ?>">SK TIM PPID</a></li>
                                    <li><a href="<?php echo site_url('strukturorganisasippid'); ?>">Struktur Organisasi PPID RSUD Prof. Dr. Margono Soekarjo</a></li>
                                    <li><a href="<?php echo site_url('profilppid'); ?>">Profil PPID RSUD Prof. Dr. Margono Soekarjo</a></li>
                                    <li><a href="<?php echo site_url('tugasdanwewenangppid'); ?>">Tugas Dan Wewenang PPID RSUD Prof. Dr. Margono Soekarjo</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profil <span class="caret"></span></a></a>
                                <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right" role="menu">
                                    <li><a href="<?php echo site_url('visimisi'); ?>">Visi Dan Misi</a></li>
                                    <li><a href="<?php echo site_url('strukturorganisasirs'); ?>">Struktur Organisasi RSUD Prof. Dr. Margono Soekarjo</a></li>
                                    <li><a href="<?php echo site_url('profilpejabatstruktural'); ?>">Profil Pejabat Struktural</a></li>
                                    <li><a href="<?php echo site_url('skppid'); ?>">SK TIM PPID</a></li>
                                    <li><a href="<?php echo site_url('strukturorganisasippid'); ?>">Struktur Organisasi PPID RSUD Prof. Dr. Margono Soekarjo</a></li>
                                    <li><a href="<?php echo site_url('profilppid'); ?>">Profil PPID RSUD Prof. Dr. Margono Soekarjo</a></li>
                                    <li><a href="<?php echo site_url('tugasdanwewenangppid'); ?>">Tugas Dan Wewenang PPID RSUD Prof. Dr. Margono Soekarjo</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                        if ($menu == 'dip') {
                        ?>
                            <li class="active"><a href="<?php echo site_url('daftarinformasipublik'); ?>">Daftar Informasi Publik</a></li>
                        <?php } else { ?>
                            <li><a href="<?php echo site_url('daftarinformasipublik'); ?>">Daftar Informasi Publik</a></li>
                        <?php
                        }
                        if ($menu == 'informasipublik') {
                        ?>
                            <li class="dropdown active"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Informasi Publik <span class="caret"></span></a></a>
                                <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right" role="menu">
                                    <li><a href="<?php echo site_url('berkala'); ?>">Berkala</a></li>
                                    <li><a href="<?php echo site_url('sertamerta'); ?>">Serta Merta</a></li>
                                    <li><a href="<?php echo site_url('tersediasetiapsaat'); ?>">Setiap Saat</a></li>
                                    <li><a href="<?php echo site_url('dikecualikan'); ?>">Dikecualikan</a></li>
                                </ul>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Informasi Publik <span class="caret"></span></a></a>
                                <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right" role="menu">
                                    <li><a href="<?php echo site_url('berkala'); ?>">Berkala</a></li>
                                    <li><a href="<?php echo site_url('sertamerta'); ?>">Serta Merta</a></li>
                                    <li><a href="<?php echo site_url('tersediasetiapsaat'); ?>">Setiap Saat</a></li>
                                    <li><a href="<?php echo site_url('dikecualikan'); ?>">Dikecualikan</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                        if ($menu == 'permohonan') {
                        ?>
                            <li class="dropdown active"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Permohonan Informasi <span class="caret"></span></a></a>
                                <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right" role="menu">
                                    <li><a href="<?php echo site_url('permohonan_informasi_online'); ?>">Permohonan Informasi</a></li>
                                    <li><a href="<?php echo site_url('pengajuan_keberatan_online'); ?>">Pengajuan Keberatan</a></li>
                                    <li><a href="<?php echo site_url('statistikpermohonaninformasi'); ?>">Statistik Permohonan Informasi</a></li>
                                    <li><a href="<?php echo site_url('pengaduan'); ?>">Pengaduan</a></li>
                                </ul>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Permohonan Informasi <span class="caret"></span></a></a>
                                <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right" role="menu">
                                    <li><a href="<?php echo site_url('permohonan_informasi_online'); ?>">Permohonan Informasi</a></li>
                                    <li><a href="<?php echo site_url('pengajuan_keberatan_online'); ?>">Pengajuan Keberatan</a></li>
                                    <li><a href="<?php echo site_url('statistikpermohonaninformasi'); ?>">Statistik Permohonan Informasi</a></li>
                                    <li><a href="<?php echo site_url('pengaduan'); ?>">Pengaduan</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
                <!--/.navbar-collapse-->
            </nav>
            <!--/.navbar-->
        </div>
        <!--/.container-->
    </header>
    <!--/.header-->
    <?php
    switch ($page) {
        case 'index':
            include 'layout_item_slider.php';
            include 'layout_item_welcome.php';
            include 'layout_item_galeri.php';
            include 'layout_item_klasifikasi.php';
            include 'layout_item_bottom.php';
            break;
        case 'showklasifikasi':
            include 'klasifikasi/klasifikasi_index.php';
            break;
        case 'dip':
            include 'dip/dip_index.php';
            break;
        case 'showkategori':
            include 'kategori/kategori_index.php';
            break;
        case 'showfilekategori':
            include 'kategori/showfilekategori.php';
            break;
        case 'register':
            include 'permohonan/register.php';
            break;
        case 'permohonaninformasi':
            include 'permohonan/permohonaninformasi.php';
            break;
        case 'statistikpermohonaninformasi':
            include 'permohonan/statistikpermohonaninformasi.php';
            break;
        case 'skppid':
            include 'profil/skppid.php';
            break;
        case 'strukturrs':
            include 'profil/strukturrs.php';
            break;
        case 'strukturppid':
            include 'profil/strukturppid.php';
            break;
        case 'visimisi':
            include 'profil/visimisi.php';
            break;
        case 'loginpage':
            include 'login/login_index.php';
            break;
        case 'profilpejabatstruktural':
            include 'profil/profilpejabatstruktural.php';
            break;
        case 'search':
            include 'search/search_index.php';
            break;
        case '404':
            include 'error_404.php';
            include 'layout_item_klasifikasi.php';
            break;
        case 'pemohon_dashboard':
            include 'permohonan/login_in/pemohon_dashboard_index.php';
            break;
        case 'get_byid':
            include 'get_byid/get_byid.php';
            break;
        case 'file_informasipublik':
            include 'file_informasipublik/file_informasipublik.php';
            break;
        case 'tugasdanwewenangppid':
            include 'profil/tugasdanwewenangppid.php';
            break;
        case 'profilppid':
            include 'profil/profilppid.php';
            break;
        case 'permohonan_informasi_online':
            include 'permohonan_informasi_online/permohonan_informasi_online.php';
            break;
        case 'permohonan_informasi_online_data':
            include 'permohonan_informasi_online/permohonan_informasi_online_data.php';
            break;
        case 'pengajuan_keberatan_online':
            include 'pengajuan_keberatan_online/pengajuan_keberatan_online.php';
            break;
        case 'pengajuan_keberatan_online_data':
            include 'pengajuan_keberatan_online/pengajuan_keberatan_online_data.php';
            break;
        case 'form_pengaduan':
            include 'pengaduan/form_pengaduan_index.php';
            break;
        case 'riwayat_pengaduan':
            include 'pengaduan/riwayat_pengaduan.php';
            break;
        default:
            break;
    }
    ?>
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2016 PPID Pelaksana RSUD Prof. Dr. Margono Soekarjo. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="https://www.facebook.com/RSMargono" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
                        <li><a href="https://twitter.com/rsudmargono" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>
                        <li><a href="https://www.instagram.com/rsudmargono/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i> Instagram</a></li>
                        <li><a href="https://www.youtube.com/user/rsmargono" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i> Youtube</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--/#footer-->

    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-dropdownhover.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.prettyPhoto.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.maskedinput.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/validator.min.js'); ?>"></script>
    <script>
        $(function() {
            $('#mycarousel').carousel({
                interval: 3000
            });
            //                var windowheight = $(window).height();
            //                var documentheight = $(document).height();
            //                var screenheight = screen.height;
            //                if (documentheight < screenheight) {
            //                    $('#footer').addClass('navbar-fixed-bottom');
            //                }
        });
        $('body').prepend('<a href="#" class="back-to-top"></a>');
        var amountScrolled = 300;
        $(window).scroll(function() {
            if ($(window).scrollTop() > amountScrolled) {
                $('a.back-to-top').fadeIn('slow');
            } else {
                $('a.back-to-top').fadeOut('slow');
            }
        });
        $('a.back-to-top, a.simple-back-to-top').click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 700);
            return false;
        });
        $("a[rel^='prettyPhoto']").prettyPhoto({
            social_tools: false
        });
    </script>
    <?php include('analyticstracking.php'); ?>
</body>

</html>