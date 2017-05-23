<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE 2 | Log in</title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/aplikasi/images/logo.ico">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/square/blue.css') ?>" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- bootbox -->
    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>Display Informasi</a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Form Login Page</p>
                <form action="<?php echo base_url() ?>auth/cek_login" method="post" onsubmit="return cekLogin()">
                  <div class="form-group has-feedback">
                    <input type="username" class="form-control" placeholder="Username" name="username" id="username">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <select class="form-control" name="loket_login" id="loket_login">
                        <option value="Farmasi">Farmasi</option>
                        <option value="poli1">Poli Lantai 1</option>
                        <option value="poli2">Poli Lantai 2</option>
                    </select>
                  </div>
                  <div class="row">
                    <div class="col-xs-8">
                      <div class="checkbox icheck">
                        <label>
                          <input type="checkbox" name='remember_me'> Remember Me
                        </label>
                      </div>
                    </div>
                    <div class="col-xs-12">
                        <?php
                          $info = $this->session->flashdata('info');
                          if (!empty($info)) {
                          echo "<p class='text-red center'>Password dan Username Tidak Dikenal<p>"; 
                          }
                        ?>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                      <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
                <div class="pull-right"><a href="<?php echo site_url("panel") ?>" target="_blank" class="text-right">Go To Panel</a></div>

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.3 -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/AdminLTE-2.0.5/plugins/bootbox/bootbox.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
             function cekLogin() {
                var username = $("#username").val();
                var password = $("#password").val();
                  if(username=='') {
                    bootbox.alert("USERNAME TIDAK BOLEH KOSONG");
                    $("#username").focus();
                    return false;
                  }
                  if (password=='') {
                    bootbox.alert("PASSWORD TIDAK BOLEH KOSONG");
                    $("#username").focus();
                    return false;
                  }
            } 
        </script>
    </body>
</html>