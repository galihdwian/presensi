<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIMONA RSMS | HALAMAN LOGIN ADMIN</title>
    <link rel="shortcut icon" type="image/icon" href="<?php echo base_url('assets/main/'); ?>images/favicon.ico" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/'); ?>dist/css/mystyle.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        html,
        body {
            overflow: hidden;
        }

        .login-page,
        .register-page {
            background-image: url("<?php echo base_url('assets/images/'); ?>bg_login.jpg");
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo site_url(); ?>" style="color: floralwhite;"><b>SIMONA RSMS</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Gunakan <b>Username</b> & <b>Password</b> untuk masuk ke sistem</p>
            <?php
            echo $this->session->flashdata('message');
            echo validation_errors();
            ?>
            <form action="<?php echo site_url('admin/login/auth'); ?>" method="post" data-toggle="validator" role="form">
                <div class="form-group has-feedback">
                    <input type="text" name="username" id="txtusername" class="form-control" placeholder="USERNAME" required="true" autocomplete="off" value="<?php echo set_value('username'); ?>" autofocus>
                    <span class="fa fa-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="PASSWORD" name="password" required="true">
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">&nbsp;</div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="login">Log In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="<?php echo base_url('assets/admin/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/validator.js"></script>
    <script src="<?php echo base_url('assets/admin/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>