<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $judul ?>
        <small><?php echo $subjudul ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $judul ?></a></li>
        <li class="active"><?php echo $subjudul ?></li>
    </ol>
</section>
<section class="content">
    <!-- Small boxes (Stat box) -->
    <section class="col-lg-12">
        <div class="col-lg-4 col-xs-4">
            <div class="box box-default">
                <div class="box-header">
                    Aksi Table
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <button class="btn btn-xs btn-success" data-rel="tooltip" title="Add Data" onClick="add()"><i class="glyphicon glyphicon-plus"></i>Add</button>
                    <button class="btn btn-xs btn-default" data-rel="tooltip" title="Refresh data" onClick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                    <button class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus Data" onClick="bulk_delete()"><i class="glyphicon glyphicon-trash"></i> Bulk Action</button>
                </div>
            </div>
        </div>
    </section>
    <section class="col-lg-12">
      <div class="row">
        <div class="col-lg-6 col-xs-12">
            <div class="box box-primary">
                <table id="table_download" class="table table-striped table-bordered table-hover">
                  <div id="thead">
                        <thead>
                            <tr>
                               <th>No</th>
                               <th>Nama File</th>
                               <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                              <?php
                              $no = 1; 
                              foreach($map_pasien as $row) { ?>
                              <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row?></td>
                                <td><a href="<?php echo base_url()."pasien/download_log_pasien/".$row ?>" target="_blank" class="text-green">download</p></td>
                              </tr>
                              <?php }?>
                        </tbody>     
                    <div>
                </table>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="box box-primary">
                <table id="table_total" class="table table-striped table-bordered table-hover">
                  <div id="thead">
                        <thead>
                            <tr>
                               <th>Tanggal</th>
                               <th>Poli Lt 1</th>
                               <th>Poli Lt 2</th>
                               <th>Khusus</th>
                               <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($total_pasien->result() as $row) {
                            ?>
                            <tr>
                              <td><?php echo $row->tanggal_kunjungan  ?></td>
                              <td><?php echo $row->poli1  ?></td>
                              <td><?php echo $row->poli2  ?></td>
                              <td><?php echo $row->khusus  ?></td>
                              <td><?php echo $row->total  ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>     
                    <div>
                </table>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
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
      </div>
    </section>
</section>
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
<!-- inline scripts related to this page -->
<script>	
	var base_url = "<?php echo base_url() ?>";
  var loket_login = "";
</script>
<script type="text/javascript" src="<?php echo base_url()?>assets/aplikasi/js/pasien.js"> </script>


