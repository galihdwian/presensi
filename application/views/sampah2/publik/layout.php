<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>KOMKORDIK Prof. Dr. Margono Soekarjo</title>
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
    <header class="header" style="background-color:#20B2AA;">
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
                                    <li><a href="<?php echo site_url('strukturorganisasi'); ?>">Struktur Organisasi</a></li>
                                    <li><a href="<?php echo site_url('sk_komkordik'); ?>">SK Tim Komkordik</a></li>
                                    <!-- <li><a href="<?php echo site_url('ppdtp_fk_unsoed'); ?>">PPDTP FK Unsoed</a></li> -->

                                </ul>
                            </li>
                        <?php } else { ?>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profil <span class="caret"></span></a></a>
                                <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right" role="menu">
                                    <li><a href="<?php echo site_url('visimisi'); ?>">Visi Dan Misi</a></li>
                                    <li><a href="<?php echo site_url('strukturorganisasi'); ?>">Struktur Organisasi</a></li>
                                    <li><a href="<?php echo site_url('sk_komkordik'); ?>">SK Tim Komkordik</a></li>
                                    <!-- <li><a href="<?php echo site_url('ppdtp_fk_unsoed'); ?>">PPDTP FK Unsoed</a></li> -->
                                </ul>
                            </li>
                        <?php
                        }
                        if ($menu == 'kegiatan') {
                        ?>
                            <li class="active"><a href="<?php echo site_url('kegiatan'); ?>">Kegiatan</a></li>
                        <?php } else { ?>
                            <li><a href="<?php echo site_url('kegiatan'); ?>">Kegiatan</a></li>
                        <?php
                        }
                        if ($menu == 'peserta_didik') {
                        ?>
                            <li class="dropdown active"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Peserta Didik<span class="caret"></span></a></a>
                                <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right" role="menu">
                                    <li><a href="<?php echo site_url('daftarpesertadidik'); ?>">Daftar Peserta Didik</a></li>
                                    <!-- <li><a href="<?php echo site_url('alurpendaftaran'); ?>">Alur Pendaftaran</a></li>
                                    <li><a href="<?php echo site_url('tatatertib'); ?>">Tata Tertib</a></li>
                                    <li><a href="<?php echo site_url('hakdankewajiban'); ?>">Hak dan Kewajiban</a></li> -->

                                </ul>
                            </li>
                        <?php } else { ?>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Peserta Didik <span class="caret"></span></a></a>
                                <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right" role="menu">
                                    <li><a href="<?php echo site_url('daftarpesertadidik'); ?>">Daftar Peserta Didik</a></li>
                                    <!-- <li><a href="<?php echo site_url('alurpendaftaran'); ?>">Alur Pendaftaran</a></li>
                                    <li><a href="<?php echo site_url('tatatertib'); ?>">Tata Tertib</a></li>
                                    <li><a href="<?php echo site_url('hakdankewajiban'); ?>">Hak dan Kewajiban</a></li> -->
                                </ul>
                            </li>
                        <?php
                        }
                        ?>

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
        case '404':
            include 'error_404.php';
            break;
        case 'index':
            include 'layout_item_slider.php';
            include 'layout_berita.php';
            include 'layout_item_galeri.php';
            break;
        case 'visimisi':
            include 'profil/visimisi.php';
            break;
        case 'strukturorganisasi':
            include 'profil/strukturorganisasi.php';
            break;
        case 'sk_komkordik':
            include 'profil/sk_komkordik.php';
            break;
        case 'ppdtp_fk_unsoed':
            include 'profil/ppdtp_fk_unsoed.php';
            break;
        case 'daftarpesertadidik':
            include 'profil/daftarpesertadidik.php';
            break;
        case 'kegiatan':
            include 'kegiatan/kegiatan.php';
            break;
        case 'detail_kegiatan':
            include 'kegiatan/detail_kegiatan.php';
            break;
        case 'loginpage':
            include 'login_index.php';
            break;
    }
    ?>
    <footer id="footer" style="background-color:#20B2AA;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2022 KOMKORDIK RSUD Prof. Dr. Margono Soekarjo. All Rights Reserved.
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