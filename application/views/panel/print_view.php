<?php 
$this->load->view('template/head');
?>
<style>
    #panelInfo {
        margin-top: 80px;
    }
    #panelPrint {
        margin-top: 10px;
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
    .text-poli {
        font-size: 20px;
    }
</style>
</head>
<!-- Main content -->
<section class="content">
    <button class="btn btn-large btn-block btn-default" role="button" onclick="mKeyF11()">Full Screen</button>
    <!-- Default box -->
    <div class= "row" class="panel" id="panelInfo">
        <div class="col-xs-4">
           
        </div>  
        <div class="col-xs-4">
            <div class="info-box">
              <h2>Panel Print Antrian Farmasi</h2>
            </div><!-- /.info-box -->
        </div>
        <div class="col-xs-4">
        
        </div> 
    </div>
    <div class= "row" class="panel" id="panelPrint">
        <div class="col-xs-4">
         
        </div>  
        <div class="col-xs-4">
            <div class="info-box" id="panelFarmasi">
              <!-- Apply any bg-* class to to the icon to color it -->
              <span class="info-box-icon bg-red"><img src="<?php echo base_url('assets/aplikasi/images/touch_icon.ico') ?>" class="img-responsive" alt="Image"></span>
              <div class="info-box-content">
                <!-- <span class="info-box-text">Pasien BPJS</span> -->
                <span class="info-box-number">Farmasi</span>
                <span class="info-box-text">Click Di Sini</span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>
        <div class="col-xs-4">
           
        </div> 
    </div>
    <div class="row">
        <div class="col-xs-4">
            
        </div>
        <div class="col-xs-4">
            <div class="box box-danger">
                <div class="box-header with-border text-center">
                    <h1 class="box-title"><b>Nomor Antrian Farmasi<b></h1>
                    <div class="box-tools ">
                      <!-- Buttons, labels, and many other things can be placed here! -->
                      <!-- Here is a label for example -->
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body text-center">
                        <span class="panelNomor" id="nomor_farmasi"></span>
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-xs-4">
            
        </div>
    </div>
</section><!-- /.content -->
<script>
    var base_url = "<?php echo base_url() ?>";
</script>
<script>
    $(document).ready(function (){
        $('#panelFarmasi').click(function(){
            countNomor("farmasi");
        });
        getNomor();

    });

    function countNomor(jenis) {
        setNomor(jenis);
    }

    function getNomor() {
        $.ajax({
            url : base_url+"panel/getNomorPrint",
            type : "POST",
            dataType : "JSON",
            success : function (e) {
                $("#nomor_farmasi").text(e.farmasi);
            }
        });
    }

    function setNomor(jenis){
        $.ajax({
            url : base_url+"panel/setNomorPrint",
            type : "POST",
            data : {type:jenis},
            success : function (e) {
                getNomor();
            },
            error : function (e) {
                console.log(e.responseText);
            }
        });
    }

    function mKeyF11(e){
        if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
           (!document.mozFullScreen && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {  
              document.documentElement.requestFullScreen();  
            } else if (document.documentElement.mozRequestFullScreen) {  
              document.documentElement.mozRequestFullScreen();  
            } else if (document.documentElement.webkitRequestFullScreen) {  
              document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
            }  
        } else {  
            if (document.cancelFullScreen) {  
              document.cancelFullScreen();  
            } else if (document.mozCancelFullScreen) {  
              document.mozCancelFullScreen();  
            } else if (document.webkitCancelFullScreen) {  
              document.webkitCancelFullScreen();  
            }  
        }  
    }
</script>
