<?php 
$this->load->view('template/head');
?>
<style>
    body {
      /*overflow : hidden;*/
      margin : 0;
      padding : 0;
    }
    #panelContent{
      height : 400px;
      max-height : 400px;
      padding : 10px;
    }
    #panelHead {
      height : 80px;
      max-height: 80px
      padding : 0px;
      margin : 0px;
    }
    #panelFooter{
      height : 50px;
      padding : 0;
      margin : 0;
    }
    #panelVideo {
      height : 400px;
      margin : 0;
    }
    #panelQuote {
      height : 200px;
    }
    #running-text {
      padding : 0px;
    }

    .box-title {
      color : black;
       font-size: 30px;
        font-weight: bold; 
         letter-spacing: -1px;
          line-height: 1;
           text-align: center;
    }
    .box-nomor {
      color : red;
       font-size: 45px;
        font-weight: bold; 
         letter-spacing: -1px;
          line-height: 6;
           text-align: center;
    }
    .box-loket {
      color : blue;
       font-size: 45px;
        font-weight: bold; 
         letter-spacing: -1px;
          line-height: 6;
           text-align: center;
    }
    .font-running {
      font-size : 50px;
      font-weight : bold;
      padding : 0;
      margin : 0;
    }
    /*efek blink*/
    .blink {
      animation: blink 1s steps(5, start) infinite;
      -webkit-animation: blink 1s steps(5, start) infinite;
      color:#ffffff;
    }
    .main-nomor {
      padding : 0;
      margin : 0;
      font-size : 110px;
      text-align: center;
      font-weight: bold;
      color : red;
    }
    .main-loket {
      padding : 0;
      margin : 0;
      font-size : 110px;
      text-align: center;
      font-weight: bold;
      color : blue;
    }

    /*main nomor antrian*/

    @keyframes blink {
      to { visibility: hidden; }
    }
    @-webkit-keyframes blink {
      to { visibility: hidden; }
    }
</style>
</head>
<!-- Main content -->
<section class="content">
    <div class="row" >
      <div id="panelHead">
         <div class="col-xs-3">
           <div class="box box-default">
             <!--  <div class="box-header text-center">
                <h4><b>Jam Sekarang</b></h4>
              </div>
              <div class="box-body text-center">
                <span class="clock" id="sekarang"></span>
              </div> -->
              <img src="<?php echo base_url() ?>assets/aplikasi/images/farmasi.png" class="img-rounded" alt="Image"  height="80" width="350">
          </div>
        </div>
        <div class="col-xs-6">
           <img src="<?php echo base_url() ?>assets/aplikasi/images/banner.jpg" class="img-rounded" alt="Image"  height="80" width="700">
        </div>
        <div class="col-xs-3" style="padding:0,margin:0">
            <h4 class="text-center"><b>Waktu Layanan Tersisa</b></h4>
            <div class="text-center">
              <span class="clock" id="sisa"></span>
            </div>
            <p id="statplay" hidden="hidden">tunggu...</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div id="panelContent">
        <div class="col-xs-6" class="contentBox">
          <div class="box box-danger">
              <div class="box-body text-center">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <td class="box-title">Nomor</td>
                        <td class="box-title">Loket</td>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $loket = "A";
                    for($i=0;$i<5;$i++) {
                    ?>
                      <tr class="">
                        <td class="box-nomor" id="no_antrian<?php echo $loket ?>">OFF</td>
                        <td class="box-loket" id="loket<?php echo $loket ?>"><?php echo $loket; ?></td>
                      </tr>
                     <?php 
                     $loket++;
                     } ?>
                    </tbody>
                  </table>
              </div>
          </div>
        </div>
        <div class="col-xs-6" class="contentBox">
          <div class="row">
            <div class="panelVideo">
              <div class="col-xs-12">
                  <div class="box box-danger">
                       <div class="box-body">
                          <center>
                            <video class="responsive-video" width="600px" id="test1" onended="run()" autoplay muted controls>
                                <source src="<?php echo base_url("assets/aplikasi/video/tips1.mp4") ?>" type="video/mp4" class="center">
                            </video>
                          </center>
                      </div>
                  </div>
              </div>
            </div>
            <div id="panelQuote" style="margin:0;padding:0" >
              <div class="col-xs-12" style="margin:0;padding:0">
                  <div class="box" style="margin:0;padding:0">
                       <div class="box-body" style="margin:0;padding:0">
                          <div class="row">
                            <div class="col-xs-6">
                              <p class="main-nomor" id="main-nomor">OFF</p>
                            </div>
                             <div class="col-xs-6">
                              <p class="main-loket" id="main-loket">OFF</p>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div> 
            </div> 
          </div>
        </div>
      </div>
    </div>
    <div class="row" id="panelFooter" style="margin:0;padding:0" >
      <div class="col-xs-12" id="running-text" style="margin:0;padding:0">
        <div class="box box-success" style="margin:0;padding:0">
          <marquee ><p class="font-running">
            <?php 
              foreach ($running->result() as $running) {
                echo " || ".$running->isi_text."&nbsp&nbsp&nbsp";
              }
            ?>
          </p><marquee>
        </div>
      </div>
    </div>
</section><!-- /.content -->
<!-- audio -->
<audio id="suarabel" src="<?php echo base_url() ?>assets/aplikasi/Airport_Bell.mp3"></audio>
<audio id="suarabelnomorurut" src="<?php echo base_url() ?>assets/aplikasi/rekaman/nomor-urut.mp3"  ></audio>
<audio id="suarabelsuarabelloket" src="<?php echo base_url() ?>assets/aplikasi/rekaman/loket.mp3"  ></audio>

<audio id="belas" src="<?php echo base_url() ?>assets/aplikasi/rekaman/belas.mp3"  ></audio>
<audio id="sebelas" src="<?php echo base_url() ?>assets/aplikasi/rekaman/sebelas.mp3"  ></audio>
<audio id="puluh" src="<?php echo base_url() ?>assets/aplikasi/rekaman/puluh.mp3"  ></audio>
<audio id="sepuluh" src="<?php echo base_url() ?>assets/aplikasi/rekaman/sepuluh.mp3"  ></audio>
<audio id="ratus" src="<?php echo base_url() ?>assets/aplikasi/rekaman/ratus.mp3"  ></audio>
<audio id="seratus" src="<?php echo base_url() ?>assets/aplikasi/rekaman/seratus.mp3"  ></audio>
<audio id="A" src="<?php echo base_url() ?>assets/aplikasi/rekaman/A.mp3"  ></audio>
<audio id="B" src="<?php echo base_url() ?>assets/aplikasi/rekaman/B.mp3"  ></audio>
<audio id="C" src="<?php echo base_url() ?>assets/aplikasi/rekaman/C.mp3"  ></audio>
<audio id="D" src="<?php echo base_url() ?>assets/aplikasi/rekaman/D.mp3"  ></audio>
<audio id="E" src="<?php echo base_url() ?>assets/aplikasi/rekaman/E.mp3"  ></audio>

<?php   for($i=1;$i<=9;$i++){
    ?>
    <audio id="<?php echo $i; ?>" src="<?php echo base_url() ?>assets/aplikasi/rekaman/<?php echo $i ?>.mp3" ></audio>
<?php
} ?>

<script>
  var base_url = "<?php echo base_url() ?>";
</script>
<script>
  $(document).ready(function() {

    // play suara antrian
    setInterval(function (){
      var statplay = $("#statplay").text();
      if (statplay!="memanggil...") {
        getQueue();
      }
    },3000);

    // clock View Sisa
    var e = new Date();
    var d = new Date();
    d.setHours(12,0,0);
    var sekarang = (e.getHours()*3600+e.getMinutes()*60+e.getSeconds());
    var nanti = (d.getHours()*3600+d.getMinutes()*60+d.getSeconds());
    var sisa = nanti-sekarang;
    if (sisa<0) {
        sisa = 1;
    }
    $('#sisa').timeTo(sisa,function(){
    }); 
    $("#sekarang").timeTo();
  });

  var video_count = 0;        
  var video       = document.getElementById("test1");
  var video_list  = <?php echo json_encode($video) ?>;
  var video_url   = base_url+"assets/aplikasi/video/";
  function run(){
        video_count++;
        if (video_count == video_list.length) video_count = 0;
        video.setAttribute("src",video_url+video_list[video_count]);       
        video.play();
  }

  function getQueue() {
    $.ajax({
      url : base_url+"panel/getQueue",
      method : "POST",
      data : {"loket_login":"farmasi"},
      dataType : "JSON",
      success : function (e) {
          $("#statplay").text("memanggil..")
          $("#no_antrian"+e.loket).text(e.nomor);
          $("#main-nomor").text(e.nomor);
          $("#main-loket").text(e.loket);
          $("#loket"+e.loket).parent().addClass('blink');
          $("#main-nomor").parent().parent().addClass('blink');
          startPlay(e.loket,e.nomor);    
      }
    });
  }

  function startPlay(nolkt,norut) {
       //console.log(nolkt);
            $("#nomor"+nolkt).text(norut);
            $("#statplay").text("memanggil...");
            var time  = 0;
            var waktu = 0;

            $('#suarabel')[0].pause();
            $('#suarabel')[0].currentTime=0;
            $('#suarabel')[0].play();
            waktu += $('#suarabel')[0].duration*1000;
            setTimeout(function(){
                $('#suarabelnomorurut')[0].pause();
                $('#suarabelnomorurut')[0].currentTime=0;
                $('#suarabelnomorurut')[0].play();
            },waktu+=1000);
            if (norut < 10) {
                setTimeout(function(){
                    $('#'+norut)[0].pause();
                    $('#'+norut)[0].currentTime=0;
                    $('#'+norut)[0].play();
                },waktu+=2000);
            } else if (norut == 10) {
                setTimeout(function(){
                    $('#sepuluh')[0].pause();
                    $('#sepuluh')[0].currentTime=0;
                    $('#sepuluh')[0].play();
                },waktu+=2000);
            } else if (norut == 11) {
                setTimeout(function(){
                    $('#sebelas')[0].pause();
                    $('#sebelas')[0].currentTime=0;
                    $('#sebelas')[0].play();
                },waktu+=2000);
            } else if (norut > 11 && norut < 20) {
                setTimeout(function(){
                    $('#'+norut.charAt(1))[0].pause();
                    $('#'+norut.charAt(1))[0].currentTime=0;
                    $('#'+norut.charAt(1))[0].play();
                },waktu+=2000);
                setTimeout(function(){
                    $('#belas')[0].pause();
                    $('#belas')[0].currentTime=0;
                    $('#belas')[0].play();
                },waktu+=1000);
            } else if (norut >= 20 && norut <= 99){
                if (norut.charAt(1) == 0) {
                    setTimeout(function(){
                        $('#'+norut.charAt(0))[0].pause();
                        $('#'+norut.charAt(0))[0].currentTime=0;
                        $('#'+norut.charAt(0))[0].play();
                    },waktu+=2000);
                    setTimeout(function(){
                        $('#puluh')[0].pause();
                        $('#puluh')[0].currentTime=0;
                        $('#puluh')[0].play();
                    },waktu+=1000);
                } else {
                    setTimeout(function(){
                        $('#'+norut.charAt(0))[0].pause();
                        $('#'+norut.charAt(0))[0].currentTime=0;
                        $('#'+norut.charAt(0))[0].play();
                    },waktu+=2000);
                    setTimeout(function(){
                        $('#puluh')[0].pause();
                        $('#puluh')[0].currentTime=0;
                        $('#puluh')[0].play();
                    },waktu+=1000);
                    setTimeout(function(){
                        $('#'+norut.charAt(1))[0].pause();
                        $('#'+norut.charAt(1))[0].currentTime=0;
                        $('#'+norut.charAt(1))[0].play();
                    },waktu+=1000);
                }
            } else if (norut >= 100 && norut <= 999){
                if (norut.charAt(0) == 1) {
                    setTimeout(function(){
                        $('#seratus')[0].pause();
                        $('#seratus')[0].currentTime=0;
                        $('#seratus')[0].play();
                    },waktu+=2000); 
                } else {
                    setTimeout(function(){
                        $('#'+norut.charAt(0))[0].pause();
                        $('#'+norut.charAt(0))[0].currentTime=0;
                        $('#'+norut.charAt(0))[0].play();
                    },waktu+=2000); 
                    setTimeout(function(){
                        $('#ratus')[0].pause();
                        $('#ratus')[0].currentTime=0;
                        $('#ratus')[0].play();
                    },waktu+=1000); 
                }
                if (norut.charAt(1) == 0) {
                    if (norut.charAt(2) > 0) {
                        setTimeout(function(){
                            $('#'+norut.charAt(2))[0].pause();
                            $('#'+norut.charAt(2))[0].currentTime=0;
                            $('#'+norut.charAt(2))[0].play();
                        },waktu+=1000);                     
                    }
                } else if (norut.charAt(1) == 1) {
                    if (norut.charAt(2) == 0) {
                        setTimeout(function(){
                            $('#sepuluh')[0].pause();
                            $('#sepuluh')[0].currentTime=0;
                            $('#sepuluh')[0].play();
                        },waktu+=1000);
                    } else if (norut.charAt(2) == 1) {
                        setTimeout(function(){
                            $('#sebelas')[0].pause();
                            $('#sebelas')[0].currentTime=0;
                            $('#sebelas')[0].play();
                        },waktu+=1000);
                    } else {
                        setTimeout(function(){
                            $('#'+norut.charAt(2))[0].pause();
                            $('#'+norut.charAt(2))[0].currentTime=0;
                            $('#'+norut.charAt(2))[0].play();
                        },waktu+=1000);
                        setTimeout(function(){
                            $('#belas')[0].pause();
                            $('#belas')[0].currentTime=0;
                            $('#belas')[0].play();
                        },waktu+=1000);
                    }
                } else {
                    setTimeout(function(){
                        $('#'+norut.charAt(1))[0].pause();
                        $('#'+norut.charAt(1))[0].currentTime=0;
                        $('#'+norut.charAt(1))[0].play();
                    },waktu+=1000);
                    setTimeout(function(){
                        $('#puluh')[0].pause();
                        $('#puluh')[0].currentTime=0;
                        $('#puluh')[0].play();
                    },waktu+=1000);
                    if (norut.charAt(2) > 0) {
                        setTimeout(function(){
                            $('#'+norut.charAt(2))[0].pause();
                            $('#'+norut.charAt(2))[0].currentTime=0;
                            $('#'+norut.charAt(2))[0].play();
                        },waktu+=1000);
                    }
                }
            } else {

            }
            setTimeout(function(){
                $('#suarabelsuarabelloket')[0].pause();
                $('#suarabelsuarabelloket')[0].currentTime=0;
                $('#suarabelsuarabelloket')[0].play();
            },waktu+=1000);
            setTimeout(function(){
                $('#'+nolkt)[0].pause();
                $('#'+nolkt)[0].currentTime=0;
                $('#'+nolkt)[0].play();
            },waktu+=1000);

            setTimeout(function(){ 
                $(".box-loket").parent().removeClass('blink');
                  $("#main-nomor").parent().parent().removeClass('blink');
                $("#statplay").text("tunggu...");
            },waktu+=1000); 
  }
</script>


