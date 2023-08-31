<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>desain/assets/images/<?php echo $this->Core->logo_klinik()?>">
  <title><?php echo $this->Core->nama_klinik();?></title>
  <meta charset="utf-8">
  <link href="<?php echo base_url()?>desain/Login/css/style.css" rel='stylesheet' type='text/css' />
  <link href="<?php echo base_url()?>desain/Login/css/loader.css" rel='stylesheet' type='text/css' />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <!--webfonts-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <!--//webfonts-->
</head>
<body style="background:url(http://eklinik.klinikdokterku.com/desain/assets/images/bgLoginPasien.png)  center fixed !important; ">

       <!--start-main-->
      <div class="login-form animated fadeInDown delay-0.5s">

        <div class="loader animated flipInX" style="display:none;">
          <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
        </div>

        <div id="login-form">
          <div class="head">
            <img src="<?php echo base_url()?>desain/assets/images/<?php echo $this->Core->logo_klinik()?>" alt=""/>
          </div>
        <form id="FormLogin">
          <h5><span class="badge badge-primary">NO. Rekam Medis / No. BPJS</span></h5>
          <h5 class="badge-username"><span class="badge badge-danger nobpjs">NO. Rekam Medis / No. BPJS Anda Salah</span></h5>
          <li class="username">
            <input type="text" id="no" class="text" placeholder="No.RM / No.BPJS" ><i href="#" class=" icon user"></i>
          </li>
          <h5><span class="badge badge-primary">Penulisan Tanggal Lahir: Tanggal Bulan Tahun</span></h5>
          <h5 class="badge-password"><span class="badge badge-danger">Tanggal Lahir Anda Tidak Sesuai</span> <small></small></h5>
          <li class="password">
            <input type="text" id="tgl" class="text" placeholder="Contoh : 22031999"><i href="#" class=" icon lock"></i>
          </li>
          <div class="p-container">
                <input type="submit" value="LOG IN" >
              <div class="clear"> </div>
          </div>
        </form>
        </div>
    </div>
    <!--//End-login-form-->
    <!---start-copyright---->
          <div class="copy-right">
          <p>copy-right <a href="#" onclick="coba()">E-Solusindo</a></p>
        </div>
      <!---//end-copyright---->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


    <!-- <script  src="<?php echo base_url(); ?>desain_backup/Login/js/index.js"></script> -->


</body>

</html>
<script type="text/javascript">
function coba() {
  $('#FormLogin').addClass('animated bounceOutLeft');
}
$(document).ready(function(e){
  $("#FormLogin").on('submit', function(e){
    e.preventDefault();
    var no = $('#no').val();
    var tgl = $('#tgl').val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>APO/LoginPasien/aksi_login',
      data: { no: no, tgl: tgl },
      beforeSend: function () {
            if (  $( '#login-form' ).css( "transform" ) == 'none' ){
                $('#FormLogin').addClass('animated flipOutX');
               var delay=100;
                setTimeout(function(){
                  $('.loader').css("display","block");
                }, delay);
            } else {
                $('#login-form').css("transform","" );
            }
         },
      error: function(err) {
           alert(err);
      },
      success: function(response) {

        if (response == "u") {
          $('#FormLogin').addClass('animated flipOutX');
          $('#FormLogin').css("display","block");

        } else if (response == "p") {
          $('#FormLogin').removeClass('animated flipOutX');
          $('.loader').css("display","none");
          $('.badge-password').css("display","block");
          $('.username').addClass('input-success');
          $('.password').addClass('input-fail');

        } else if (response == "up") {
          $('#FormLogin').removeClass('animated flipOutX');
          $('.loader').css("display","none");
          $('.badge-password').css("display","block");
          $('.badge-username').css("display","block");
          $('.username').addClass('input-fail');
          $('.password').addClass('input-fail');
        } else if (response == "berhasil") {
          window.location = "<?php echo base_url() ?>APO/Home";
        }else {
          window.location = "<?php echo base_url() ?>APO/Home";
        }
        alert(response);
      }
    });
  });
});

</script>
