<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMONA RSMS</title>
    <link rel="shortcut icon" type="image/icon" href="<?php echo base_url('assets/main/'); ?>images/favicon.ico" />
    <link href="<?php echo base_url('assets/main/'); ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/main/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link id="switcher" href="<?php echo base_url('assets/main/'); ?>css/theme-color/orange-theme.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/main/'); ?>css/style.css?v=<?= date('ymdhis'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/main/'); ?>dist/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/main/'); ?>dist/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/main/'); ?>dist/select2/css/select2-bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/main/'); ?>css/bootstrap-fileupload.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/main/'); ?>css/bootstrap-social.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>
    <header id="mu-header" class="" role="banner" style="background-color:dodgerblue">
        <div class="container">
            <nav class="navbar navbar-default mu-navbar">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo_dashboard.png" style="height:40px" class="img-responsive"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav mu-menu navbar-right">
                            <?php echo (!empty($str_link) ? $str_link : ''); ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main role="main">
        <div class="header-wraper">&nbsp;</div>
        <?php
        if (!empty($page)) {
            switch ($page):
                case 'indexpage':
                    include_once 'new_indexpage/indexpage.php';
                    break;
            // case 'register':
            //     include_once 'new_registrasi/registrasi.php';
            //     break;
            // case 'regsuccess':
            //     include_once 'new_registrasi/regsuccess.php';
            //     break;
            // case 'pengumuman':
            //     include_once 'pengumuman.php';
            //     break;
            // case 'helpdesk':
            //     include_once 'pusatbantuan/faq.php';
            //     break;
            // case 'statistik':
            //     include_once 'statistik/indexstatistik.php';
            //     break;
            endswitch;
        }
        ?>
    </main>
    <footer id="mu-footer" role="contentinfo">
        <div class="container">
            <div class="mu-footer-area">
                <div class="mu-social-media">
                    <a href="https://www.facebook.com/RSMargono" rel="nofollow" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="https://twitter.com/rsudmargono" rel="nofollow" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="https://www.instagram.com/rsudmargono/" rel="nofollow" target="_blank"><i class="fa fa-instagram"></i></a>
                    <a href="https://www.youtube.com/user/rsmargono" rel="nofollow" target="_blank"><i class="fa fa-youtube"></i></a>
                </div>
                <p class="mu-copyright">&copy; Copyright <a rel="nofollow" target="_blank" href="http://rsmargono.jatengprov.go.id">RSUD Prof. Dr. Margono Soekarjo</a>. All right reserved.</p>
            </div>
        </div>

    </footer>
    <!-- <?php include_once 'analyticstracking.php'; ?> -->
    <script src="<?php echo base_url('assets/main/'); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/main/'); ?>js/validator.js"></script>
    <script src="<?php echo base_url('assets/main/'); ?>dist/jQuery-Mask-Plugin/jquery.mask.min.js"></script>
    <script src="<?php echo base_url('assets/main/'); ?>js/bootstrap-fileupload.js"></script>
    <script src="<?php echo base_url('assets/main/'); ?>dist/select2/js/select2.min.js"></script>
</body>

</html>