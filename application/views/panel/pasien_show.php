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
    <div class="row">
        <div class="col-xs-6">
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo date("Y-m-d") ?></h3>
                  <h4 class="box-title">Daftar Pasien</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>No MR</th>
                      <th>Type Pasien</th>
                      <th>Operator</th>
                      <th>Nomor Antrian</th>
                      <th>Waktu Tunggu</th>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($pasien->result() as $row) {
                       $awal    = strtotime($row->date_in);
                       $akhir   = strtotime($row->date_modified);
                       $diff    = $akhir - $awal;
                       $waktu_tunggu = $diff;
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row->nama; ?></td>
                        <td><?php echo $row->no_mr; ?></td>
                        <td><?php echo $row->type_pasien; ?></td>
                        <td><?php echo $row->petugas; ?></td>
                        <td><?php echo $row->nomor; ?></td>
                        <td><?php echo gmdate("H:i:s",$waktu_tunggu) ?></td>
                    </tr>
                    <?php
                    $no++;
                    }
                    ?>
                  </table>
                </div>
            </div>
        </div>
    </div>
</body>