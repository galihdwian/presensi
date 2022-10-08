<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SISTEM PRESENSI</title>
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
    <header class="header" style="background-color:#101307 ;">
        <div class="container">
            <nav class="navbar navbar-blade" role="navigation">
                <div class="navbar-header" style="padding-bottom:40px;">
                    <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a href="<?php echo site_url(); ?>" class="navbar-brand scroll-top logo  animated bounceInDown">
                        <b><img src="<?php echo base_url(); ?>assets/images/logo.jpg" class="img-responsive"></b>
                    </a>
                </div>
                <!--/.navbar-header-->
                <div class="collapse navbar-collapse" id="main-menu" data-hover="dropdown" data-animations="bounce fadeInLeft fadeInUp fadeInRight">

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
        case 'loginpage':
            include 'login_index.php';
            break;
    }
    ?>
    <footer id="footer" style="background-color:#101307;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2022 SISTEM PRESENSI All Rights Reserved.
                </div>
                <div class="col-sm-6">

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

    <?php include('analyticstracking.php'); ?>
</body>

</html>