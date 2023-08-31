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
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>desain/assets/images/rsuh_7.png">
  <title>Rumah Sakit Utama Husada</title>
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

  <link href="<?php echo base_url(); ?>desain/dist/css/pages/other-pages.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>desain/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
</head>

<body class="skin-megna fixed-layout">
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
          <img src="<?php echo base_url(); ?>desain/assets/images/rsuh_7.png" style="max-width: 55px;" alt="homepage" class="dark-logo" />
          <!-- Light Logo icon -->
          <img src="<?php echo base_url(); ?>desain/assets/images/rsuh_7.png" style="max-width: 55px;" alt="homepage" class="light-logo" />
        </b>
        <!--End Logo icon -->
        <span class="hidden-xs"><span class="font-bold">Utama</span>Husada</span>
      </a>
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
<div class="page-wrapper" style="margin-left:0px;padding-left:50px;">
  <div class="row mt-3">
    <div class="col-md-4 blue-gradient" style="padding-top: 100px;min-height:500px;color:white;"><center><h1 class="mt-2">Antrian Loket 1</h1></center><center><h1 style="font-size:150px;font-family:Consolas;" class="antrian_loket1"><?php echo str_pad($antrian['LOKET1'],3,"0",STR_PAD_LEFT)?></h1></center></div>
    <div class="col-md-4 blue-gradient" style="padding-top: 100px;min-height:500px;color:white;"><center><h1 class="mt-2">Antrian Loket 2</h1></center><center><h1 style="font-size:150px;font-family:Consolas;" class="antrian_loket2"><?php echo str_pad($antrian['LOKET2'],3,"0",STR_PAD_LEFT)?></h1></center></div>

    <div class="col-md-4" style="padding-left:20px;color:white;text-align:right;">
      <div class="row col-md-12 purple-gradient">
        <center><h1 class="antrian_poliumum" style="margin-left:10px;font-size:65px;font-family:Consolas;"><?php echo str_pad($antrian['UMU'],3,"0",STR_PAD_LEFT)?></h1></center>
        <p style="font-size:20px;margin-left:30px">Poli Umum</p>
      </div>
      <div class="row col-md-12 purple-gradient mt-3">
        <center><h1 class="antrian_poliozon" style="margin-left:10px;font-size:65px;font-family:Consolas;"><?php echo str_pad($antrian['OZO'],3,"0",STR_PAD_LEFT)?></h1></center>
        <p style="font-size:20px;margin-left:30px">Poli Ozon</p>
      </div>
      <div class="row col-md-12 purple-gradient mt-3">
        <center><h1 class="antrian_poliobgyn" style="margin-left:10px;font-size:65px;font-family:Consolas;"><?php echo str_pad($antrian['OBG'],3,"0",STR_PAD_LEFT)?></h1></center>
        <p style="font-size:20px;margin-left:30px">Poli Obgyn</p>
      </div>
      <div class="row col-md-12 purple-gradient mt-3">
        <center><h1 class="antrian_poliinternis" style="margin-left:10px;font-size:65px;font-family:Consolas;"><?php echo str_pad($antrian['INTERNIS'],3,"0",STR_PAD_LEFT)?></h1></center>
        <p style="font-size:20px;margin-left:30px">Poli Internis</p>
      </div>
      <div class="row col-md-12 purple-gradient mt-3">
        <h1 class="antrian_poligigi" style="margin-left:10px;text-align: right;font-size:65px;font-family:Consolas;"><?php echo str_pad($antrian['GIG'],3,"0",STR_PAD_LEFT)?></h1>
        <p style="font-size:20px;margin-left:30px;text-align:right">Poli Gigi</p>
      </div>
    </div>
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
<footer class="footer" style="margin-left:0px;">
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
<script>
$(document).ready(function () {

});
</script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<!-- <script src="<?php echo base_url()?>desain/custom/pusher/kunjungan.js"></script> -->
<!-- <script src="<?php echo base_url()?>desain/custom/pusher/signature.js"></script> -->
<script src="<?php echo base_url()?>desain/custom/pusher/antrian.js"></script>

</body>

</html>
