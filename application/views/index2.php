<!DOCTYPE html>
<html lang="en">
<?php
if (!isset($_SESSION['username']) && !isset($_SESSION['id_login'])) {
  redirect('Login');
}else{
  $menu_diakses = $this->uri->segment(0)."/".$this->uri->segment(1)."/".$this->uri->segment(2);
  $this->Core->save_riwayat($_SESSION['id_login'],date("Y-m-d h:i:s"),$menu_diakses);
}

?>
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
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- <link href="<?php echo base_url(); ?>desain/dist/css/fa.css" rel="stylesheet"> -->

  <!-- <script src="<?php echo base_url()?>desain/custom/jSignature/libs/modernizr.js"></script> -->
  <script src="<?php echo base_url(); ?>desain/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
</head>

<body class="skin-megna fixed-layout">
  <input type="hidden" value="<?php echo $_SESSION['poli']?>" id="poli_sekarang">
  <input type="hidden" value="<?php echo $_SESSION['jabatan']?>" id="user_jabatan">
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
      <ul class="navbar-nav mr-auto">
        <!-- This is  -->
        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-sm-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
        <!-- ============================================================== -->
        <!-- Search -->
        <!-- ============================================================== -->
        <!-- <li class="nav-item">
        <form class="app-search d-none d-md-block d-lg-block">
        <input type="text" class="form-control" placeholder="Search & enter">
      </form>
    </li> -->
  </ul>
  <!-- ============================================================== -->
  <!-- User profile and search -->
  <!-- ============================================================== -->
  <ul class="navbar-nav my-lg-0">
    <!-- ============================================================== -->
    <!-- Comment -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- End mega menu -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- User Profile -->
    <!-- ============================================================== -->
    <li class="nav-item dropdown u-pro">
      <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="<?php echo base_url(); ?>desain/user.png" alt="user" class="">
        <span class="hidden-md-down"><?php echo $_SESSION['karyawan']." (".$_SESSION['username'].")" ?> &nbsp;<i class="fa fa-angle-down"></i></span> </a>
        <div class="dropdown-menu dropdown-menu-right animated flipInY">
          <!-- text-->
          <!-- <a href="javascript:void(0)" class="dropdown-item"><i class="ti-user"></i> My Profile</a> -->
          <!-- text-->
          <!-- <a href="javascript:void(0)" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a> -->
          <!-- text-->
          <!-- <a href="javascript:void(0)" class="dropdown-item"><i class="ti-email"></i> Inbox</a> -->
          <!-- text-->
          <!-- <div class="dropdown-divider"></div> -->
          <!-- text-->
          <!-- <a href="javascript:void(0)" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a> -->
          <!-- text-->
          <!-- <div class="dropdown-divider"></div> -->
          <!-- text-->
          <a href="<?php echo base_url(); ?>Login/logout" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
          <!-- text-->
        </div>
      </li>
      <!-- ============================================================== -->
      <!-- End User Profile -->
      <!-- ============================================================== -->
      <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
    </ul>
  </div>
</nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
      <ul id="sidebarnav">
        <!-- <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="<?php echo base_url(); ?>desain/user.png" alt="user-img" class="img-circle">
        <span class="hide-menu"><?php echo $_SESSION['karyawan']; ?></span></a>
        <ul aria-expanded="false" class="collapse">
        <li><a href="<?php echo base_url(); ?>Login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
      </ul>
    </li> -->
    <?php $this->load->view('menu') ?>
  </ul>
</nav>
<!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Container fluid  -->
  <!-- ============================================================== -->
  <div class="container-fluid">
    <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">FORM <?php echo @$this->uri->segment(1); ?></h4>
      </div>
      <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo base_url().@$this->uri->segment(1); ?>"><?php echo @$this->uri->segment(1); ?></a>
            </li>
            <?php if ($this->uri->segment(2) !== null): ?>
              <li class="breadcrumb-item active"><?php echo @$this->uri->segment(2); ?></li>
            <?php endif; ?>
          </ol>
        </div>
      </div>
    </div>
    <?php $this->load->view($body); ?>

    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <div class="right-sidebar">
      <div class="slimscrollright">
        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
        <div class="r-panel-body">
          <ul id="themecolors" class="m-t-20">
            <li><b>With Light sidebar</b></li>
            <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme">1</a></li>
            <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme">2</a></li>
            <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>
            <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme">4</a></li>
            <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>
            <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme working">6</a></li>
            <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
            <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme ">7</a></li>
            <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a></li>
            <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a></li>
            <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a></li>
            <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme">11</a></li>
            <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme ">12</a></li>
          </ul>

        </div>
      </div>
    </div>
    <?php
    if ($this->session->flashdata()) {
      echo $this->session->flashdata('notif');
    }
    ?>

    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- End Container fluid  -->
  <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer">
  © 2018 E-SOLUSINDO
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
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

  // Data Picker Initialization
  $('.datepicker').pickadate();
  // Material Select Initialization
  $('.mdb-select').material_select();
  $(document).on("click",".hapus-disable",function(){
    $("#Hapus_disable").modal("toggle");
  })
  $(document).on("click",".hapus-aktif",function(){
    $("#Hapus_aktif").modal("toggle");
  })
  $('#optgroup').multiSelect({
    selectableOptgroup: true
  });
  $('#public-methods').multiSelect();
  $( ".tanggal" ).datepicker({
    format:'dd-mm-yyyy',
  });
  $('.tanggalku').pickadate({
    // Escape any “rule” characters with an exclamation mark (!).
    format: 'dd-mm-yyyy',
    formatSubmit: 'yyyy-mm-dd',
  })

  // select2
  $(document).on("click",".to-top",function(){
        $('html, body').animate({scrollTop : 0},500);
      })
      $(document).on("click",".to-top-modal",function(){
        $('.modal').animate({ scrollTop: 0 }, 'slow');
      })
  $('.select2').select2();
  $('#myTable').DataTable();
  $(document).ready(function () {

      var table = $('#example_group').DataTable({
        "columnDefs": [
          {
            "visible": false,
            "targets": 2
          }
        ],
        "order": [
          [2, 'asc']
        ],
        "displayLength": 25,
        "drawCallback": function (settings) {
          var api = this.api();
          var rows = api.rows({page: 'current'}).nodes();
          var last = null;
          api.column(2, {page: 'current'}).data().each(function (group, i) {
            if (last !== group) {
              $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
              last = group;
            }
          });
        }
      });
      // Order by the grouping
      $('#example tbody').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
          table.order([2, 'desc']).draw();
        } else {
          table.order([2, 'asc']).draw();
        }
      });
    });
  });
  $('.print-view').DataTable({
    dom: 'Bfrtip',
    buttons: ['copy', 'excel', 'pdf', 'print'],

  })
  $('#example').DataTable();

  </script>
  <script type="text/javascript">
  $('document').ready(function() {
    $(document).on('click',".id_checkbox", function (e) {
      $("#jumlah_pilih").html($("input.id_checkbox:checked").length);
      if ($("input.id_checkbox:checked").length == 0) {
        $(".btn_hapus").addClass("btn-outline-white");
        $(".btn_hapus").removeClass("btn-outline-danger");
        $(".btn_hapus").addClass("hapus-disable");
        $(".btn_hapus").removeClass("hapus-aktif");
        $(".select-all").prop("checked",false);

      } else {
        $(".btn_hapus").removeClass("btn-outline-white");
        $(".btn_hapus").addClass("btn-outline-danger");
        $(".btn_hapus").addClass("hapus-aktif");
        $(".btn_hapus").removeClass("hapus-disable");
      }
    });
    $(document).on('click',".select-all", function (e) {
      // alert('djahjhd');
      var th = $(this);
      if ($("input.id_checkbox:checked").length == 0) {
        $("input.id_checkbox").prop("checked",true);
        $(".btn_hapus").removeClass("btn-outline-white");
        $(".btn_hapus").addClass("btn-outline-danger");
        $(".btn_hapus").addClass("hapus-aktif");
        $(".btn_hapus").removeClass("hapus-disable");
      } else {
        $("input.id_checkbox").prop("checked",false);
        $(".btn_hapus").addClass("btn-outline-white");
        $(".btn_hapus").removeClass("btn-outline-danger");
        $(".btn_hapus").addClass("hapus-disable");
        $(".btn_hapus").removeClass("hapus-aktif");
        if ($(th).prop("checked")==true) {
          $(th).prop("checked",false);
        }
      }
      $("#jumlah_pilih").html($("input.id_checkbox:checked").length);

    });


  });


  </script>
  <script src="https://js.pusher.com/4.3/pusher.min.js"></script>

  <script>

  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('58f10ec738925cc9cf18', {
    cluster: 'ap1',
    forceTLS: true
  });

  var channel = pusher.subscribe('ci_pusher');
  channel.bind('my-event', function(data) {
    // alert(JSON.stringify(data));
    var html = "";
    var poli = $("#poli_sekarang").val();
    var kode_tupel = data.tupel_kode_tupel;
    var warna = 'badge-primary';
    var type = "IN";
    if (kode_tupel == "UMU"){
      warna = "badge-success";
      type = "U";
    }else if(kode_tupel == "OBG"){
      warna = "badge-info";
      type = "O";
    }else if (kode_tupel == "GIG") {
      warna = "badge-warning";
      type = "G"
    }
    else if (kode_tupel == "IGD") {
      warna = "badge-danger";
      type = "IG"
    }

    var jk='';
    if (data.jenis_kunjungan == 1) {
      jk = "Baru";
    } else {
      jk = "Lama";
    }
    var no = [];
    $('.no_kunjungan_hari_ini').each(function(){
      no.push($(this).text());
    });
    var pnjng_no = no.length+1;
    html+='<tr>'+
    '<td class="no_kunjungan_hari_ini">'+pnjng_no+'</td>'+
    '<td>'+data.pasien_noRM+'</td>'+
    '<td>'+data.nama+'</td>'+
    '<td><h4><span class="badge badge-pill '+warna+'">'+data.tujuan_pelayanan+'</span></h4></td>'+
    '<td>'+type+data.no_antrian+'</td>'+
    '<td>'+data.jam_daftar+'</td>'+
    '<td>'+jk+'</td>'+
    '<td class="periksa">'+
    '<a href="'+data.url+'">'+
    '<button type="button" class="btn btn-primary btn-sm periksa">'+
    '<i class="fa fa-medkit"></i> Periksa'+
    '</button>'+
    '</a>'+
    '</td>'+
    '</tr>';
    var user = $("#user_jabatan").val();
    if (kode_tupel==poli || user=="kasir") {
      var audio = new Audio('http://utamahusada.esolusindo.com/desain/assets/custom/qr_reader/audio/notif.mp3');
      audio.play();
      $("#tabel_belum_periksa").append(html);
      var total = parseInt($(".total_billing").text());
      total +=1;
      $(".total_billing").text(total);
    }
  });
  </script>
  <script>

  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('58f10ec738925cc9cf18', {
    cluster: 'ap1',
    forceTLS: true
  });

  var channel = pusher.subscribe('ci_pusher2');
  channel.bind('my-event2', function(data) {
    // alert(data.gambar);
    var i = new Image()
    var signature = data.gambar;
  //Here signatureDataFromDataBase is the string that you saved earlier
    i.src = 'data:' + signature;
    $(i).appendTo('#signature'+data.nokun);
    $("#val_signature"+data.nokun).val(data.gambar);
  });
  </script>

</body>

</html>
