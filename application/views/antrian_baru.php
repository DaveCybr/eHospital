<!DOCTYPE html>
<html lang="en">
<style>
  body{
    font-family: sans-serif;
  }
</style>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>desain/assets/images/kdtg.png">
  <title>Klinik Dokterku Taman Gading</title>
  <link href="<?php echo base_url()?>desain/assets/node_modules/morrisjs/morris.css" rel="stylesheet">
  <!--Toaster Popup message CSS -->
  <link href="<?php echo base_url()?>desain/assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="<?php echo base_url()?>desain/dist/css/style.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="<?php echo base_url()?>desain/dist/css/style2.css" rel="stylesheet">
  <!-- Dashboard 1 Page CSS -->
  <link href="<?php echo base_url()?>desain/dist/css/pages/dashboard1.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>desain/MyCSS.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>desain/assets/node_modules/icheck/skins/all.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>desain/dist/css/pages/form-icheck.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>desain/dist/css/pages/file-upload.css" rel="stylesheet">
  <!-- <link href="<?php echo base_url(); ?>desain/dist/css/main.css" rel="stylesheet"> -->
  <!-- autocomplate -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/easy-autocomplete.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/easy-autocomplete.themes.min.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>desain/assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>desain/assets/node_modules/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>desain/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>desain/assets/node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
  <!-- steps -->
<link href="<?php echo base_url(); ?>desain/assets/node_modules/wizard/steps.css" rel="stylesheet">
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>desain/assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

  <link href="<?php echo base_url(); ?>desain/dist/css/pages/other-pages.css" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- <link href="<?php echo base_url(); ?>desain/dist/css/fa.css" rel="stylesheet"> -->

  <!-- <script src="<?php echo base_url()?>desain/custom/jSignature/libs/modernizr.js"></script> -->
  <script src="<?php echo base_url(); ?>desain/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
  <style>
    #utama{
      /* background-color: black; */
      color:white;
      /* background: url("https://www.technocrazed.com/wp-content/uploads/2015/12/Blue-Wallpaper-For-Background-5.jpg"); */
    }
    .wrap-antrian{
      border-radius:10px;
      padding: 10px;
    }
    .atas{
      color:white;
    }
  </style>
</head>

<body class="skin-megna fixed-layout" style="padding-right:20px">
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <!-- <div class="preloader">
  <div class="loader">
  <div class="loader__figure"></div>
  <p class="loader__label">Utama Husada</p>
</div>
</div> -->
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
  <!-- ============================================================== -->
  <!-- Topbar header - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
      <!-- ============================================================== -->
      <!-- Logo -->
      <!-- ============================================================== -->
      <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo base_url() ?>">
          <!-- Logo icon --><b>
          <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
          <!-- Dark Logo icon -->
          <img src="<?php echo base_url(); ?>desain/assets/images/kdtg.png" style="max-width: 55px;" alt="homepage" class="dark-logo" />
          <!-- Light Logo icon -->
          <img src="<?php echo base_url(); ?>desain/assets/images/kdtg.png" style="max-width: 55px;" alt="homepage" class="light-logo" />
        </b>
        <!--End Logo icon -->
        <span class="hidden-xs"><span class="font-bold">KDTG
      </a>
    </div>
    <div class="col-md-8 pengumuman atas">
        <marquee><h5 style="font-size:20px;"> <?php foreach ($pengumuman as $value) {
          echo $value->pengumuman."   |   ";
        }?></h5></marquee>

    </div>
    <div class="col-md-4 atas">
      <h5><?php echo date("d/m/Y")."  <span class='jam'>".date("H:i:s")."</span>";?></h4>
      <input type="hidden" value="<?php echo date("H:i:s")?>" id="input_jam">
    </div>
    <!-- ============================================================== -->
    <!-- End Logo -->
    <!-- ============================================================== -->
    <div class="navbar-collapse">
      <!-- ============================================================== -->
      <!-- toggle and nav items -->
      <!-- ============================================================== -->

  <!-- ============================================================== -->
  <!-- User profile and search -->
  <!-- ============================================================== -->

  </div>
</nav>

</header>
<div class="page-wrapper" id="utama" style="margin-left:0px;padding-left:50px;">
    <div id="plylistvideo">
    <?php foreach ($video as $value): ?>

      <input type="hidden" class="list_video" value="<?php echo base_url();?>desain/video/<?php echo $value->url?>">
    <?php endforeach; ?>


  </div>
  <div class="row mt-3">
    <div class="col-md-12" style="min-height:350px;">
      <div class="col-md-12 blue-gradient wrap-antrian" style="width:100%;height: 100%;">
        <div class="col-md-12 blue-gradient wrap-antrian" style="height:100%">
          <center><h2>Antrian Saat Ini</h2></center>
          <hr style="background-color:white;"></hr>
        <center><h1 style="font-size:150px;font-family:Consolas;" class="antrian_terakhir"><?php echo $antrian['antrian_terakhir']==null?"--":$antrian['antrian_terakhir']?></h1></center>
        <hr style="background-color:white;"></hr>
        <center><h2 style="font-family:Consolas;" class="nama_terakhir"><?php echo $antrian['nama_terakhir']==null?"--":$antrian['nama_terakhir']?></h2></center>
        <center><h2 style="font-family:Consolas;" class="unit_terakhir"><?php echo $antrian['unit_terakhir']==null?"--":$antrian['unit_terakhir']?></h2></center>
        </div>
      </div>
    </div>

    <!-- <div class="col-md-8" style="min-height:350px;">
      <div class="col-md-12 blue-gradient wrap-antrian" style="height:100%;">
        <video width="100%" height="300" controls id="myVideo">
          <source id="video_src" src="<?php echo base_url(); ?>desain/video/<?php echo $video_awal['url']?>" type="video/mp4">
        </video>
      </div>
    </div> -->
    <div class="col-md-4" style="min-height:150px;margin-top:10px;margin-bottom:10px">
      <div class="col-md-12 purple-gradient wrap-antrian" style="height:100%">
        <center><h4>Antrian</h4></center>
        <hr style="background-color:white;"></hr>
        <center><h2 style="font-family:Consolas;" class="antrian_poliumum"><?php echo $antrian['UMU']==null?"--":$antrian['UMU']?></h2></center>
        <hr style="background-color:white;"></hr>
        <center><h2 style="font-family:Consolas;" class="nama_poliumum"><?php echo $antrian['nama_pasien']==null?"--":$antrian['nama_pasien']?></h2></center>
        <center><h4 style="font-family:Consolas;">Poli Umum 1</h4></center>
      </div>
    </div>
    <div class="col-md-4" style="min-height:150px;margin-top:10px;margin-bottom:10px">
      <div class="col-md-12 purple-gradient wrap-antrian" style="height:100%">
        <center><h4>Antrian</h4></center>
        <hr style="background-color:white;"></hr>
        <center><h2 style="font-family:Consolas;" class="antrian_poliumum2"><?php echo $antrian['UMU2']==null?"--":$antrian['UMU2']?></h2></center>
        <hr style="background-color:white;"></hr>
        <center><h2 style="font-family:Consolas;" class="nama_poliumum2"><?php echo $antrian['nama_pasien_umu2']==null?"--":$antrian['nama_pasien_umu2']?></h2></center>
        <center><h4 style="font-family:Consolas;">Poli Umum 2</h4></center>
      </div>
    </div>
    <!-- <div class="col-md-2" style="min-height:150px;margin-top:10px ;margin-bottom:10px ">
      <div class="col-md-12 peach-gradient wrap-antrian" style="height:100%">
        <center><h4>Antrian</h4></center>
        <hr style="background-color:white;"></hr>
        <center><h1 style="font-size:30px;font-family:Consolas;" class="antrian_poliozon"><?php echo $antrian['OZO']==null?"--":$antrian['OZO']?></h1></center>
        <hr style="background-color:white;"></hr>
        <center><h4 style="font-family:Consolas;">Poli Ozon</h4></center>
      </div>
    </div> -->
    <div class="col-md-4" style="min-height:150px;margin-top:10px;margin-bottom:10px">
      <div class="col-md-12 aqua-gradient wrap-antrian" style="height:100%">
        <center><h4>Antrian</h4></center>
        <hr style="background-color:white;"></hr>
        <center><h2 style="font-family:Consolas;" class="antrian_poligigi"><?php echo $antrian['GIG']==null?"--":$antrian['GIG']?></h2></center>
        <hr style="background-color:white;"></hr>
        <center><h2 style="font-family:Consolas;" class="nama_poligigi"><?php echo $antrian['nama_pasien_gig']==null?"--":$antrian['nama_pasien_gig']?></h2></center>
        <center><h4 style="font-family:Consolas;">Poli Gigi</h4></center>
      </div>
    </div>
    <!-- <div class="col-md-2" style="min-height:150px;margin-top:10px;margin-bottom:10px">
      <div class="col-md-12 aqua-gradient wrap-antrian" style="height:100%">
        <center><h4>Antrian</h4></center>
        <hr style="background-color:white;"></hr>
        <center><h1 style="font-size:30px;font-family:Consolas;" class="antrian_poliobgyn"><?php echo $antrian['OBG']==null?"--":$antrian['OBG']?></h1></center>
        <hr style="background-color:white;"></hr>
        <center><h4 style="font-family:Consolas;">Poli Obgyn</h4></center>
      </div>
    </div> -->
    <!-- <div class="col-md-2" style="min-height:150px;margin-top:10px;margin-bottom:10px">
      <div class="col-md-12 purple-gradient wrap-antrian" style="height:100%">
        <center><h4>Antrian</h4></center>
        <hr style="background-color:white;"></hr>
        <center><h1 style="font-size:30px;font-family:Consolas;" class="antrian_poliinternis"><?php echo $antrian['INTERNIS']==null?"--":$antrian['INTERNIS']?></h1></center>
        <hr style="background-color:white;"></hr>
        <center><h4 style="font-family:Consolas;">Poli Internis</h4></center>
      </div>
    </div> -->
    <!-- <div class="col-md-4" style="min-height:150px;margin-top:10px;margin-bottom:10px">
      <div class="col-md-12 aqua-gradient wrap-antrian" style="height:100%">
        <center><h4>Antrian</h4></center>
        <hr style="background-color:white;"></hr>
        <center><h1 style="font-size:30px;font-family:Consolas;" class="antrian_laborat"><?php echo $antrian['LAB']==null?"--":$antrian['LAB']?></h1></center>
        <hr style="background-color:white;"></hr>
        <center><h4 style="font-family:Consolas;">Laboratorium</h4></center>
      </div>
    </div> -->

  </div>
</div>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer" style="margin-left:0px;" >
  © 2018 E-SOLUSINDO
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<!-- Bootstrap popper Core JavaScript -->
<script src="<?php echo base_url(); ?>desain/assets/node_modules/popper/popper.min.js"></script>
<script src="<?php echo base_url(); ?>desain/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="<?php echo base_url(); ?>desain/dist/js/perfect-scrollbar.jquery.min.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url(); ?>desain/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?php echo base_url(); ?>desain/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?php echo base_url(); ?>desain/dist/js/custom.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--morris JavaScript -->
<script src="<?php echo base_url(); ?>desain/assets/node_modules/raphael/raphael-min.js"></script>
<script src="<?php echo base_url(); ?>desain/assets/node_modules/morrisjs/morris.min.js"></script>
<script src="<?php echo base_url(); ?>desain/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
<!-- Popup message jquery -->
<script src="<?php echo base_url(); ?>desain/assets/node_modules/toast-master/js/jquery.toast.js"></script>
<!-- jQuery peity -->
<script src="<?php echo base_url(); ?>desain/assets/node_modules/peity/jquery.peity.min.js"></script>
<script src="<?php echo base_url(); ?>desain/assets/node_modules/peity/jquery.peity.init.js"></script>
<!-- <script src="<?php echo base_url(); ?>desain/dist/js/dashboard1.js"></script> -->
<!--stickey kit -->
<script src="<?php echo base_url(); ?>desain/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="<?php echo base_url(); ?>desain/assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
<!-- This is data table -->
<script src="<?php echo base_url(); ?>desain/assets/node_modules/datatables/jquery.dataTables.min.js"></script>
<!-- icheck -->
<script src="<?php echo base_url(); ?>desain/assets/node_modules/icheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>desain/assets/node_modules/icheck/icheck.init.js"></script>
<script src="<?php echo base_url(); ?>desain/dist/js/pages/jasny-bootstrap.js"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- select2 -->
<script src="<?php echo base_url(); ?>desain/assets/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<!-- <script src="<?php echo base_url(); ?>desain/dist/js/custom.min.js"></script> -->
<script src="<?php echo base_url(); ?>desain/dist/js/pages/mask.js"></script>
<!-- Editable -->
<script type="text/javascript" src="<?php echo base_url();?>desain/assets/node_modules/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js"></script>

<!-- end - This is for export functionality only -->
<script src="<?php echo base_url(); ?>desain/assets/node_modules/switchery/dist/switchery.min.js"></script>
<script src="<?php echo base_url(); ?>desain/assets/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>desain/assets/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>desain/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url(); ?>desain/assets/node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>desain/assets/node_modules/multiselect/js/jquery.multi-select.js"></script>
<!-- Chart JS -->
<script src="<?php echo base_url(); ?>desain/assets/node_modules/echarts/echarts-all.js"></script>
<!-- <script src="<?php echo base_url(); ?>desain/assets/node_modules/echarts/echarts-init.js"></script> -->
<!-- Sweet-Alert  -->
<script src="<?php echo base_url()?>desain/assets/node_modules/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url()?>desain/dist/js/sweet.js"></script>
<script src="<?php echo base_url()?>desain/dist/js/main.js"></script>
<!-- autocomplate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>
<script src="<?php echo base_url()?>desain/dist/js/autocomplate-init.js"></script>
<!-- steps -->
<script src="<?php echo base_url()?>desain/assets/node_modules/wizard/jquery.steps.min.js"></script>
<script src="<?php echo base_url()?>desain/assets/node_modules/wizard/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>desain/assets/node_modules/wizard/steps.js"></script>
<!-- Tour Bootstrap -->
<script src="<?php echo base_url()?>desain/assets/node_modules/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url()?>desain/assets/node_modules/sweetalert/jquery.sweet-alert.custom.js"></script>
<script>
$(document).ready(function () {
  swal("Selamat Datang Di Antrian KDTG!");
  // alert("Antrian KDTG");
  var audio = new Audio("https://eklinik.klinikdokterku.com//desain/antrian/awal.mp3");
  audio.play();
  // alert("https://eklinik.klinikdokterku.com//desain/antrian/awal.mp3");

});
</script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<!-- <script type="text/javascript">
document.getElementById("myVideo").play();

$('#myVideo').trigger('play');

$('#myVideo').play();
</script> -->
<!-- <script src="<?php echo base_url()?>desain/custom/pusher/kunjungan.js"></script> -->
<!-- <script src="<?php echo base_url()?>desain/custom/pusher/signature.js"></script> -->
<!-- <script src="<?php echo base_url()?>desain/custom/pusher/antrian.js"></script> -->
<script type="text/javascript">
var playlist = [];
var panggilan = [];
var nama = "--";
var i = 0;
var active = false;
var list_video =[];
var base_url = window.location.origin;
var url = base_url+'/desain/antrian/';

playlist.push("awal.mp3");
reset();


// $(".list_video").each(function() {
//   list_video.push($(this).val());
// })
// var vid = document.getElementById("myVideo");

function playVid() {
  const playPromise = vid.play();
  if (playPromise !== null) {
    playPromise.catch(() => {
      vid.play();
    })
  }
  // vid.play();
}

var counter = 0;
// vid.onended = function(){
//
//
//
//
//   if (++counter<list_video.length) {
//     $("#video_src").attr("src",list_video[counter]);
//     $("#myVideo")[0].load();
//     playVid();
//   }else{
//     counter = 0;
//     $("#video_src").attr("src",list_video[counter]);
//     $("#myVideo")[0].load();
//     playVid();
//   }
// }

$(document).ready(function() {

});

function pauseVid() {
  vid.pause();
}

function reset() {
  $.ajax({
    type: 'GET',
    url: base_url+'/Antrian/reset',
    async: false,
    dataType: 'json',
    success: function(response) {
      active = false;
    }

  })
};

function pad(str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}

function get_audio(poli, no, inisial) {
  var list = Array('kosong.mp3', 'satu.mp3', 'dua.mp3', 'tiga.mp3', 'empat.mp3', 'lima.mp3', 'enam.mp3', 'tujuh.mp3', 'delapan.mp3', 'sembilan.mp3', 'sepuluh.mp3', 'sebelas.mp3');
  // if (poli=="UMU") {
  //   playlist.push("u.mp3");
  // }
  // if (poli=="OBG") {
  //   playlist.push("o.mp3")
  // }
  // if (poli=="OZO") {
  //   playlist.push("oz.mp3")
  // }
  // if (poli=="INT") {
  //   playlist.push("in.mp3")
  // }
  // if (poli=="GIG") {
  //   playlist.push("ig.mp3")
  // }
  let no_baru = no.split(".");
  inisial = no_baru[0];
  no = no_baru[1];
  if (inisial == "A") {
    playlist.push("a.mp3")
  }
  if (inisial == "B") {
    playlist.push("b.mp3")
  }
  if (inisial == "C") {
    playlist.push("c.mp3")
    // playlist.push("g.mp3")

  }
  if (inisial == "U") {
    playlist.push("u.mp3")
    // playlist.push("p.mp3")
  }
  if (inisial == "G") {
    playlist.push("g.mp3")
    // playlist.push("i.mp3")

  }
  if (inisial == "MD") {
    playlist.push("m.mp3")
    playlist.push("d.mp3")
  }
  if (inisial == "DD") {
    playlist.push("d.mp3")
    playlist.push("d.mp3")

  }

  if (inisial == "YM") {
    playlist.push("y.mp3")
    playlist.push("m.mp3")

  }

  if (inisial == "AD") {
    playlist.push("a.mp3")
    playlist.push("d.mp3")

  }

  if (no > 100 && no < 200) {
    playlist.push('seratus.mp3');
    var no = parseInt(no - 100);
  }

  if (no > 19 && no < 100) {
    var puluhan = parseInt(no / 10);
    playlist.push(list[puluhan]);
    playlist.push("puluh.mp3");
    var satuan = parseInt(no % 10);
    playlist.push(list[satuan]);
  } else if (no > 11 && no < 20) {
    var no = parseInt(no - 10);
    playlist.push(list[no]);
    playlist.push("belas.mp3");
  } else {
    if (no < 12) {
      playlist.push(list[no]);
    } else {
      playlist.push("seratus.mp3");
    }
  }

  // if (no < 1000) {
  //   var puluhan = parseInt(no/100);
  //   playlist.push(list[puluhan]);
  //   playlist.push("puluh.mp3");
  //   var satuan = parseInt(no%10);
  //   playlist.push(list[satuan]);
  // }
  if (poli == "UMU") {
    playlist.push("umum.mp3");
    playlist.push("satu.mp3");

  }
  if (poli == "UMU2") {
    playlist.push("umum.mp3");
    playlist.push("dua.mp3");
  }
  if (poli == "OBG") {
    playlist.push("obgyn.mp3")
  }
  if (poli == "OZO") {
    playlist.push("ozon.mp3")
  }
  if (poli == "INT") {
    playlist.push("internis.mp3")
  }
  if (poli == "GIG") {
    playlist.push("gigi.mp3")
  }
  if (poli == "LOKET1") {
    playlist.push("loket1.mp3")
  }
  if (poli == "LOKET2") {
    playlist.push("loket2.mp3")
  }
}

function play_panggilan() {
  // if (!active) {

  var audio = new Audio();
  var poli = panggilan[0];
  // audio.src = url + "umum.mp3";
  // audio.play();
  // alert(poli);
  var p = poli.split('-');
  get_audio(p[0], p[1], p[2]);
  if (p[0] == "UMU") {
    $(".antrian_poliumum").text(pad(p[1], 3).replace(".",""));
    $(".nama_poliumum").text(nama);
    $(".antrian_terakhir").text(pad(p[1], 3).replace(".",""));
    $(".nama_terakhir").text(nama);
    $(".unit_terakhir").text("POLI UMUM 1");
  }
  if (p[0] == "UMU2") {
    $(".antrian_poliumum2").text(pad(p[1], 3).replace(".",""));
    $(".nama_poliumum2").text(nama);
    $(".antrian_terakhir").text(pad(p[1], 3).replace(".",""));
    $(".nama_terakhir").text(nama);
    $(".unit_terakhir").text("POLI UMUM 2");
  }
  if (p[0] == "OBG") {
    $(".antrian_poliobgyn").text(pad(p[1], 3));
    $(".nama_poliobgyn").text(nama);
  }
  if (p[0] == "OZO") {
    $(".antrian_poliozon").text(pad(p[1], 3));
    $(".nama_poliozon").text(nama);
  }
  if (p[0] == "INT") {
    $(".antrian_poliinternis").text(pad(p[1], 3));
    $(".nama_poliinternis").text(nama);
  }
  if (p[0] == "GIG") {
    $(".antrian_poligigi").text(pad(p[1].replace(".",""), 3));
    $(".nama_poligigi").text(nama);
    $(".antrian_terakhir").text(pad(p[1].replace(".",""), 3));
    $(".nama_terakhir").text(nama);
    $(".unit_terakhir").text("POLI GIGI");
  }
  if (p[0] == "LOKET1") {
    $(".antrian_loket1").text(pad(p[1], 3));
    $(".nama_loket1").text(nama);
  }
  if (p[0] == "LOKET2") {
    $(".antrian_loket2").text(pad(p[1], 3));
    $(".nama_loket2").text(nama);
  }
  // alert(p[1]);
  // var playlist = new Array('http://utamahusada.com/sim/desain/antrian/awal.mp3', 'http://utamahusada.com/sim/desain/antrian/u.mp3','http://utamahusada.com/sim/desain/antrian/satu.mp3','http://utamahusada.com/sim/desain/antrian/umum.mp3');
  audio.volume = 0.3;
  audio.loop = false;
  audio.src = url + playlist[0];
  audio.play();
  audio.addEventListener('ended', function() {
    i = ++i < playlist.length ? i : 0;
    // console.log(i)
    audio.src = url + playlist[i];
    audio.play();
    // if (i==0) {
    //   break;
    // }
    if (i == 0) {
      audio.pause();
      audio.currentTime = 0;
      playlist = [];
      playlist.push("awal.mp3");
      if (p[0] == "UMU") {
        $(".antrian_poliumum").text(pad(p[1].replace(".",""), 3));
        $(".nama_poliumum").text(nama);
        $(".antrian_terakhir").text(pad(p[1].replace(".",""), 3));
        $(".nama_terakhir").text(nama);
        $(".unit_terakhir").text("POLI UMUM 1");
      }
      if (p[0] == "UMU2") {
        $(".antrian_poliumum2").text(pad(p[1].replace(".",""), 3));
        $(".nama_poliumum2").text(nama);
        $(".antrian_terakhir").text(pad(p[1].replace(".",""), 3));
        $(".nama_terakhir").text(nama);
        $(".unit_terakhir").text("POLI UMUM 2");
      }
      if (p[0] == "OBG") {
        $(".antrian_poliobgyn").text(pad(p[1].replace(".",""), 3));
        $(".nama_poliobgyn").text(nama);
      }
      if (p[0] == "OZO") {
        $(".antrian_poliozon").text(pad(p[1].replace(".",""), 3));
        $(".nama_poliozon").text(nama);
      }
      if (p[0] == "INT") {
        $(".antrian_poliinternis").text(pad(p[1], 3));
        $(".nama_poliinternis").text(nama);
      }
      if (p[0] == "GIG") {
        $(".antrian_poligigi").text(pad(p[1], 3));
        $(".nama_poligigi").text(nama);
        $(".antrian_terakhir").text(pad(p[1], 3));
        $(".nama_terakhir").text(nama);
        $(".unit_terakhir").text("POLI GIGI");
      }
      if (p[0] == "LOKET1") {
        $(".antrian_loket1").text(pad(p[1], 3));
        $(".nama_loket1").text(nama);
      }
      if (p[0] == "LOKET2") {
        $(".antrian_loket2").text(pad(p[1], 3));
        $(".nama_loket2").text(nama);
      }
      panggilan.shift();
      if (panggilan.length !== 0) {
        setTimeout(() => {
          play_panggilan();
        }, Math.floor(Math.random() * 2000) + 1000)

      } else {
        active = false;
        // playVid();
        reset();
      }


    }
  }, true);
  // }

}
// $(document).on("click",'#panggilan',function(){
//   // var audio = new Audio('http://utamahusada.com/sim/desain/antrian/awal.mp3');
//   // audio.play();
//
//
// })
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('7d98f72380966ec579c6', {
  cluster: 'ap1',
  forceTLS: true
});

var channel = pusher.subscribe('ci_pusher3');
channel.bind('my-event3', function(data) {
  // alert(data.no_antrian);
  // if (i==0) {
  // }
  var delayInMilliseconds = 10000; //1 second
  // alert(data.no_antrian);
  panggilan.push(data.no_antrian);
  nama = data.nama;

  if (active) {
    console.log(active);
    // alert("false");
    reset();
  } else {
    console.log(active);
    // pauseVid();
    active = true;
    // alert("true");
    // setTimeout(function() {
    //your code to be executed after 1 second
    play_panggilan();
    // }, delayInMilliseconds);
  }

  // alert(data.gambar);
  // var i = new Image(150,150)
  // var signature = data.gambar;
  //Here signatureDataFromDataBase is the string that you saved earlier
  // i.src = 'data:' + signature;
  // $(i).appendTo('#signature'+data.nokun);
  // $("#val_signature"+data.nokun).val(data.gambar);
});
</script>
<!-- <script type="text/javascript">
  var base_url = window.location.origin;
  alert(base_url);
</script> -->
</body>

</html>
