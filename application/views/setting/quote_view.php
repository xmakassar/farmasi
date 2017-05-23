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
    <section class="col-lg-5">
        <div class="col-lg-12 col-xs-12">
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
        <div class="col-lg-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <table id="mytable" class="table table-striped table-bordered table-hover">
                        <div id="thead">
                          <thead>
                              <tr>
                                  <th><input type="checkbox" id="check-all"></th>
                                  <th>ID</th>
                                  <th>Sumber</th>
                                  <th>Pesan</th>
                                  <th>Foto</th>
                                  <th>Status Publish</th>
                                  <th>aksi</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th><input type="checkbox" id="check-all"></th>
                                  <th>ID</th>
                                  <th>Sumber</th>
                                  <th>Pesan</th>
                                  <th>Foto</th>
                                  <th>Status Publish</th>
                                  <th>aksi</th>
                              </tr>
                          </tfoot>
                        <div>
                    </table>
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
                        <div class="form-group has-error">
                          <label class="control-label" >Sumber</label>
                          <input type="hidden" class="form-control input-sm" id="id_pk" name="id_pk" placeholder="Enter ..." >
                          <input type="text" class="form-control input-sm" id="sumber" name="sumber" placeholder="Enter ...">
                          <span class="help-block">Help block with error</span>
                        </div>
                        <div class="form-group has-error">
                          <label class="control-label">Pesan/Informasi</label>
                          <textarea name="pesan" id="pesan" class="form-control" rows="3" required="required"></textarea>
                        </div>
                        <div class="form-group has-error">
                          <label class="control-label"></i>Foto</label>
                          <input type="text" class="form-control input-sm" id="foto" name="foto" placeholder="Enter ...">
                          <span class="help-block">Help block with error</span>
                        </div>
                        <div class="form-group has-error">
                          <label class="control-label"></i>Aktifkan</label>
                          <div class="checkbox">
                              <label>
                                  <div class="radio">
                                      <label>
                                          <input type="radio" name="status" id="enable0" value="0" checked="checked">
                                            Nonaktifkan
                                      </label>
                                      <label>
                                          <input type="radio" name="status" id="enable1" value="1">
                                            Aktifkan
                                      </label>
                                  </div>
                              </label>
                          </div>
                          <span class="help-block">Help block with error</span>
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
</script>
<script type="text/javascript" src="<?php echo base_url()?>assets/aplikasi/js/quote.js"> </script>


