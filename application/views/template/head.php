<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Display Information</title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/aplikasi/images/logo.ico">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/ionicons-2.0.1/css/ionicons.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins 
             folder instead of downloading all of them to reduce the load. -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/skins/_all-skins.min.css') ?>" rel="stylesheet" type="text/css" />

        <!-- ################ -->
        <!-- Clock Stylesheet -->
        <!-- ################ -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/AdminLTE-2.0.5/plugins/countdown/timeTo.css">

        <style>
            /* Important part */
            .modal-dialog{
                overflow-y: initial !important
            }
            .modal-body{
                max-height: calc(100vh - 200px);
                overflow-y: auto;
            }
        </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->


        <!-- js -->
        <!-- jQuery 2.1.3 -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <!-- SlimScroll -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/slimScroll/jquery.slimScroll.min.js') ?>" type="text/javascript"></script>
        <!-- FastClick -->
        <script src='<?php echo base_url('assets/AdminLTE-2.0.5/plugins/fastclick/fastclick.min.js') ?>'></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/app.min.js') ?>" type="text/javascript"></script>

        <!--tambahkan custom js disini-->
        <!-- jQuery UI 1.11.2 -->
        <script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Morris.js charts -->
        <script src="<?php echo base_url('assets/js/raphael-min.js') ?>"></script>
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.min.js') ?>" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/sparkline/jquery.sparkline.min.js') ?>" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/knob/jquery.knob.js') ?>" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker.js') ?>" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js') ?>" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
        <!-- DATA TABLES -->
        <link href="<?php echo base_url()?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABES SCRIPT -->
       <!--  <script src="<?php //echo base_url()?>assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script> -->
       <!--  <script src="<?php //echo base_url()?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script> -->

        <!-- DATA TABES SCRIPT -->
        <script src="<?php echo base_url()?>assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.bootstrap.min.js" type="text/javascript"></script>

        <!-- bootbox -->
         <script src="<?php echo base_url() ?>assets/AdminLTE-2.0.5/plugins/bootbox/bootbox.min.js"></script>

        <!-- ################ -->
        <!-- clock javascripts -->
        <!-- ################ -->
        <script src="<?php echo base_url() ?>assets/AdminLTE-2.0.5/plugins/countdown/jquery.time-to.js" type="text/javascript"></script>