<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base_url = config_item('base_url');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>PPID RSUD Prof. Dr. Margono Soekarjo</title>
        <link rel="apple-touch-icon" sizes="57x57" href="<?= $base_url; ?>assets/images/favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?= $base_url; ?>assets/images/favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?= $base_url; ?>assets/images/favicons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?= $base_url; ?>assets/images/favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?= $base_url; ?>assets/images/favicons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?= $base_url; ?>assets/images/favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?= $base_url; ?>assets/images/favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?= $base_url; ?>assets/images/favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= $base_url; ?>assets/images/favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="<?= $base_url; ?>assets/images/favicons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= $base_url; ?>assets/images/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?= $base_url; ?>assets/images/favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= $base_url; ?>assets/images/favicons/favicon-16x16.png">
        <link href="<?= $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= $base_url; ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?= $base_url; ?>assets/css/bootstrap-dropdownhover.css" rel="stylesheet">
        <link href="<?= $base_url; ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?= $base_url; ?>assets/css/informasipublik.css" rel="stylesheet">
        <link href="<?= $base_url; ?>assets/css/responsive.css" rel="stylesheet">
        <link href="<?= $base_url; ?>assets/css/prettyPhoto.css" rel="stylesheet">
        <script type="text/javascript" src="<?= $base_url; ?>assets/js/jquery.min.js"></script>       
    </head>
    <body id="error-page">
        <div class="intro-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="intro-message">
                            <h1 class="animated fadeInDown">Error 403</h1>
                            <hr class="intro-divider animated zoomInDown">
                            <h3 class="animated zoomIn mt-5 mb-30">Pengiriman data tidak diijinkan.</h3>
                            <div class="detail-message animated zoomIn">
                                <p class="mb-0">Hal ini disebabkan karena beberapa hal diantaranya</p>
                                <p>1. Pengiriman data melalui form yang telah kadaluarsa karena terlalu lama dibuka.</p>
                                <p>2. Pengiriman data kembali dari form yang telah dikirimkan sebelumnya, hal ini terjadi saat proses <i>reload</i> / memuat ulang halaman.</p>
                                <p>3. Pengiriman data dari form yang tidak kami sediakan.</p>                                
                            </div>
                            <hr class="intro-divider animated zoomInDown">
                            <ul class="list-inline intro-social-buttons">                               
                                <li>
                                    <a href="javascript:void(0);" class="btn btn-default btn-lg mb-5 animated fadeInUp" onclick="goBack()"><span class="network-name">Kembali Ke Halaman Sebelumnya</span></a>
                                </li>
                                <li>
                                    <a href="<?= $base_url; ?>" class="btn btn-default btn-lg mb-5 animated fadeInUp"><span class="network-name">Portal PPID</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function goBack() {
                window.history.back();
            }
        </script>
    </body>
</html>