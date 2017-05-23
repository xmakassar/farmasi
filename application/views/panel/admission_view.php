<?php 
$this->load->view('template/head');
?>
<style>
    .content {
        margin-top : 0px;
    }
    #panelAdmission {
        padding : 0;
        margin : 0;
    }
    .info-box-number {
        font-size : 50px;
    }
</style>
</head>
<!-- header -->
<body class="skin-blue">
<header class="main-header">
  <a href="../../index2.html" class="logo">
    <!-- LOGO -->
    RSUD PARIAMAN
  </a> 
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url('assets/aplikasi/images/logo.ico') ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $this->session->userdata('username') ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo base_url('assets/aplikasi/images/logo.ico') ?>" class="img-circle" alt="User Image">
              <p>
               <?php echo $this->session->userdata('username') ?>
                <small>Member since Nov. 2012</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="<?php echo base_url('auth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<!-- Main content -->
<section class="content">
    <div class="panelAdmission">
        <div class="row">
            <div class="col-xs-6">
                <div class="box box-danger">
                    <div class="box-header text-center">
                        <h3>Data Antrian Pasien <?php echo $this->session->userdata("poli"); ?></h3>
                    </div>
                     <button class="btn btn-xs btn-default" data-rel="tooltip" title="Refresh data" onClick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                     <button class="btn btn-xs btn-danger" data-rel="tooltip" title="Refresh data" onClick="print_table()"><i class="fa fa-print"></i> Print</button>
                     <button class="btn btn-xs btn-success" data-rel="tooltip" title="Refresh data" onClick="return(download_table())"><i class="fa fa-download"></i> Download</button>
                    <div class="box-body" >
                        <table id="mytable" class="table table-striped table-bordered table-hover">
                            <div id="thead">
                              <thead>
                                  <tr>
                                      <th><input type="checkbox" id="check-all"></th>
                                      <th>ID</th>
                                      <th>Type</th>
                                      <th>Nomor Antrian</th>
                                      <th>Waktu Kedatangan</th>
                                      <th>Nama Pasien</th>
                                      <th>Nomor MR</th>
                                      <th>Petugas</th>
                                      <th>aksi</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                 <tr>
                                      <th><input type="checkbox" id="check-all"></th>
                                      <th>ID</th>
                                      <th>Type</th>
                                      <th>Nomor Antrian</th>
                                      <th>Waktu Kedatangan</th>
                                      <th>Nama Pasien</th>
                                      <th>Nomor MR</th>
                                      <th>Petugas</th>
                                      <th>aksi</th>
                                  </tr>
                              </tfoot>
                            <div>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-danger">
                            <div class="box-header text-center">
                                <h3>Panel Click</h3>
                            </div>
                            <div class="box-body text-center">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="info-box">
                                          <!-- Apply any bg-* class to to the icon to color it -->
                                          <span class="info-box-icon bg-aqua"><i class="fa fa-star-o"></i></span>
                                          <div class="info-box-content">
                                            <span class="info-box-text">Antrian Sekarang</span>
                                            <span class="info-box-number" id="nomor_antrian">OFF</span>
                                          </div><!-- /.info-box-content -->
                                        </div><!-- /.info-box -->
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="info-box">
                                          <!-- Apply any bg-* class to to the icon to color it -->
                                          <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                                          <div class="info-box-content">
                                            <span class="info-box-text">Loket</span>
                                            <span class="info-box-number" id="loket"><?php print_r($loket) ?></span>
                                          </div><!-- /.info-box-content -->
                                        </div><!-- /.info-box -->
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="info-box">
                                          <!-- Apply any bg-* class to to the icon to color it -->
                                          <span class="info-box-icon bg-yello"><i class="fa fa-star-o"></i></span>
                                          <div class="info-box-content">
                                            <span class="info-box-text">Total Antrian</span>
                                            <span class="info-box-number" id="total_print">OFF</span>
                                          </div><!-- /.info-box-content -->
                                        </div><!-- /.info-box -->
                                    </div>
                                </div>
                            </div>
                        </div>      
                    </div>
                    <div class="col-xs-12">
                        <div class="box box-danger">
                            <div class="box-header text-center">
                                <h3>Panel Click</h3>
                            </div>
                            <div class="box-body text-center">
                                  <a class="btn btn-app" href="javascript:void(0)" onclick="return next()">
                                    <i  class="fa  fa-step-forward"></i> Next
                                  </a>
                                  <a href="javascript:void(0)" onclick="return call()" id="call" class="btn btn-app">
                                    <i class="fa fa-microphone"></i> Panggil
                                  </a>
                                  <a href="javascript:void(0)" onclick="return jump()" class="btn btn-app">
                                    <i class="fa  fa-rocket"></i> Jump
                                  </a>
                                  <?php if($this->session->userdata('username')=="lt11") { ?>
                                  <a href="javascript:void(0)" onclick="return resetPrint()" class="btn btn-app">
                                    <i class="fa fa-repeat"></i> Reset Print
                                  </a>
                                  <a class="btn btn-app" href="javascript:void(0)" onclick="return resetAntrian()">
                                    <i  class="fa fa-repeat"></i> Reset Antrian
                                  </a>
                                  <?php } ?>
                                  <a class="btn btn-app" href="javascript:void(0)" onclick="return setLoket()">
                                    <i  class="fa fa-edit"></i> Atur Loket
                                  </a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->
<!-- Modal Form -->
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <form action="#" id="form" class="form-horizontal" class='has-error' method="post">
                   <div class="box box-warning">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <form role="form">
                        <input type="hidden" class="form-control input-sm" id="id_pk" name="id_pk" placeholder="Enter ..." >
                        <div class="form-group has-error">
                          <label class="control-label">Nomor Antrian</label>
                          <input type="text" class="form-control input-sm" id="no_antrian" name="no_antrian" placeholder="Enter ..." disabled>
                        </div>
                        <div class="form-group has-error">
                          <label class="control-label">Type Pasien</label>
                          <input type="text" class="form-control input-sm" id="type_pasien" name="type_pasien" placeholder="Enter ..." disabled>
                        </div>
                        <div class="form-group has-error">
                          <label class="control-label" >Nama Pasien</label>
                          <input type="text" class="form-control input-sm" id="nama" name="nama" placeholder="Enter ...">
                          <span class="help-block">Help block with error</span>
                        </div>
                        
                        <div class="form-group has-error">
                          <label class="control-label">Nomor MR</label>
                          <input type="text" class="form-control input-sm" id="no_mr" name="no_mr" placeholder="Enter ...">
                        </div>
                      </form>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

</body>
<script>
    var base_url = "<?php echo base_url() ?>";
    var site_url = "<?php echo site_url() ?>";
    var loket = "<?php echo $loket ?>";
    var loket_login = "<?php echo $this->session->userdata('poli'); ?>";
</script>
<script type="text/javascript" src="<?php echo base_url()?>assets/aplikasi/js/pasien.js"> </script>
<script type="text/javascript" src="<?php echo base_url()?>assets/aplikasi/js/admission.js"> </script>

