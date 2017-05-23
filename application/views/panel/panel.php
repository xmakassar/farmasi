<?php 
$this->load->view('template/head');
?>
<style>
    #panelPrint {
        margin-top: 100px;
    }
    .panelClick {
        height: 150px;
    }
    .info-box-tex {

    }
    .panelNomor {
        font-size: 100px;
        font-weight: bold;
    }

    .panelCaption {
        font-size: 18px;
    }
</style>
</head>
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class= "row" class="panel" id="panelPrint">
        <div class="col-xs-3">
        </div>
        <div class="col-xs-6">
            <div class="row">
                <div class="col-xs-4" class="panelIcon">
                    <a href="<?php echo site_url('panel/lcd_admission') ?>"><img src="<?php echo base_url('assets/aplikasi/images/lcd_icon.png') ?>" class="img-responsive" alt="Image"></a>
                    <center>
                        <span class="label label-warning panelCaption">Tampilan LCD</span>
                    </center>
                </div>
                <div class="col-xs-2"></div>
                <div class="col-xs-4">
                     <a href="<?php echo site_url('panel/antrian_print') ?>"><img src="<?php echo base_url('assets/aplikasi/images/print_icon.png') ?>" class="img-responsive" alt="Image"></a>
                    <center>
                        <span class="label label-warning panelCaption">Antrian Print</span>
                    </center>
                </div>
               
            </div>
        </div>    
    </div>
    <div class="row">
        <div class="col-xs-3">

        </div>
        <div class="col-xs-6">
          
        </div>
        <div class="col-xs-3">
            
        </div>
    </div>
</section><!-- /.content -->
<script>
    $(document).ready(function (){
        $('#panelBpjs').click(function(){
            alert("bpjs");
        });
        $('#panelUmum').click(function(){
            alert("umum");
        });
    });
   
</script>
