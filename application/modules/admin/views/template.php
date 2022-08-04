<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIMONA RSMS | HALAMAN ADMIN</title>
    <link rel="shortcut icon" type="image/icon" href="<?php echo base_url('assets/main/'); ?>images/favicon.ico" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>dist/css/mystyle.css?v=<?= date('ymdhis'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>dist/css/skins/skin-purple.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>plugins/iCheck/all.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>plugins/bootstrap-toggle/css/bootstrap-toggle.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>bower_components/select2/dist/css/select2.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>bower_components/sweetalert/dist/sweetalert2.min.css">
    <link href="<?php echo base_url('assets/main/'); ?>css/bootstrap-fileupload.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="<?php echo base_url('assets/admin/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
</head>
<?php
$sidebar_collapse = !empty($sidebar_collapse) ? $sidebar_collapse : false;
?>

<body class="hold-transition skin-purple sidebar-mini <?= ($sidebar_collapse == true ? 'sidebar-collapse' : ''); ?>">
    <div class="wrapper">
        <header class="main-header">
            <a href="<?php echo site_url('admin/dashboard'); ?>" class="logo">
                <span class="logo-mini">SIMONA</span>
                <span class="logo-lg">SIMONA</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url($this->session->userdata('avatar')); ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $this->session->userdata('nama_user'); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?php echo base_url($this->session->userdata('avatar')); ?>" class="img-circle" alt="User Image">
                                    <p>
                                        <?php
                                        echo $this->session->userdata('nama_user');
                                        ?>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url('admin/manajemen_pengguna/profil'); ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('admin/login/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">ADMIN NAVIGATION</li>
                    <li <?php echo ($activemenu == 'Dashboard' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo site_url('admin/dashboard'); ?>">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="treeview <?php echo ($activemenu == 'Manajemen Pengguna' ? 'active menu-open' : ''); ?>">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>Manajemen Pengguna</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?php echo ($activesubmenu == 'Pengaturan Pengguna' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('admin/manajemen_pengguna'); ?>"><i class="fa fa-circle-o"></i> Pengaturan Pengguna</a></li>
                            <li <?php echo ($activesubmenu == 'Ubah Password' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('admin/manajemen_pengguna/ubah_password'); ?>"><i class="fa fa-circle-o"></i> Ubah Password</a></li>
                        </ul>
                    </li>

                    <li class="treeview <?php echo ($activemenu == 'Pengaturan' ? 'active menu-open' : ''); ?>">
                        <a href="#">
                            <i class="fa fa-gear"></i>
                            <span>Pengaturan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?php echo ($activesubmenu == 'Master Pendidikan' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('admin/master/pendidikan'); ?>"><i class="fa fa-circle-o"></i> Master Pendidikan</a></li>
                            <li <?php echo ($activesubmenu == 'Master Formasi' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('admin/master/formasi'); ?>"><i class="fa fa-circle-o"></i> Master Formasi</a></li>
                            <li <?php echo ($activesubmenu == 'Master Berkas' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('admin/master/berkas'); ?>"><i class="fa fa-circle-o"></i> Master Berkas</a></li>
                            <li <?php echo ($activesubmenu == 'Setting Periode' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('admin/setting/periode'); ?>"><i class="fa fa-circle-o"></i> Setting Periode</a></li>
                            <li <?php echo ($activesubmenu == 'Setting Konfigurasi Periode' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('admin/setting/periode_config'); ?>"><i class="fa fa-circle-o"></i> Setting Konfigurasi Periode</a></li>
                            <li <?php echo ($activesubmenu == 'Setting Formasi Periode' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('admin/setting/formasiperiode'); ?>"><i class="fa fa-circle-o"></i> Setting Formasi Periode</a></li>
                            <li <?php echo ($activesubmenu == 'Setting Pendidikan Periode' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('admin/setting/pendidikanperiode'); ?>"><i class="fa fa-circle-o"></i> Setting Pendidikan Periode</a></li>
                            <li <?php echo ($activesubmenu == 'Setting Timeline' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('admin/setting/timeline'); ?>"><i class="fa fa-circle-o"></i> Setting Timeline</a></li>
                        </ul>
                    </li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">
            <section class="content-header">
                <?php
                // echo '<h3 class="section-title">' . $namaperiode . '</h3>';
                echo '<span class="section-divider"></span>';
                echo '<h1>' . $titlepage . '</h1>';
                ?>
            </section>
            <section class="content">
                <?php
                if (!empty($message)) {
                    echo $message;
                }
                echo $this->session->flashdata('message');
                $this->load->view($loadcontent);
                ?>
            </section>
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> <?= $this->config->item('versionproject'); ?>
            </div>
            <strong>Copyright &copy; 2022 RSUD Prof. Dr. Margono Soekarjo. All rights reserved.
        </footer>
    </div>
    <script src="<?php echo base_url('assets/admin/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/admin/'); ?>bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?php echo base_url('assets/admin/'); ?>dist/js/adminlte.min.js"></script>
    <script src="<?php echo base_url('assets/main/'); ?>js/validator.js"></script>
    <script src="<?php echo base_url('assets/admin/'); ?>plugins/iCheck/icheck.min.js"></script>
    <script src="<?php echo base_url('assets/admin/'); ?>plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
    <script src="<?php echo base_url('assets/main/'); ?>dist/jQuery-Mask-Plugin/jquery.mask.min.js"></script>
    <script src="<?php echo base_url('assets/admin/'); ?>bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url('assets/admin/'); ?>plugins/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url('assets/main/'); ?>js/bootstrap-fileupload.js"></script>
    <script src="<?php echo base_url('assets/admin/'); ?>bower_components/sweetalert/dist/sweetalert2.all.js"></script>
</body>

</html>