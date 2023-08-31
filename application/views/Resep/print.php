<html>
<head>
  <link href="<?php echo base_url(); ?>desain/assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>desain/assets/node_modules/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>desain/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>desain/assets/node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

<style >
/* @media print{ */
  .row{
    display: flex;
flex-wrap: wrap;
margin-right: -10px;
margin-left: -10px;
  }
  .col-logo{
    flex: 0 0 4cm;
        max-width: 6.2cm;
        max-height: 3.1cm;
        vertical-align: middle;
        text-align: center;
        padding-top: 8px;
  }
  .col-header{
    flex: 0 0 14cm;
    max-width: 14cm;
    max-height: 3.1cm;
    vertical-align: middle;
    text-align: center;
  }

  .logo{
    width: 90px;height: 90px;
    margin-left: 8px;
  }
  .m-0{
    margin: 0 !important;
  }
  .borderless{
    border-collapse:collapse;
  }
  .background {
    position: absolute;
    width: 750px;
    height: 82%;
    z-index: -1;
  }
  .bg{
    /* background-image:url(<?php echo base_url() ?>desain/watermark.png); */
    width: auto;
    min-height: auto;
    /* background-size: 750px 900px; */
   background-repeat: repeat-y;
  }
  .striped tr:nth-child(even) {
    background-color: #b7e2fcc7;
  }
  .striped tr:nth-child(odd) {
    background-color: #f1faffdb;
  }
/* } */
  .kolom{
    padding:10px;
  }

</style>
</head>
  <body>
<div class="row">
  <div class="col-logo">
    <img src="<?php echo base_url() ?>desain/assets/images/rsuh_7.png" class="logo">
  </div>
  <center>
  <div class="col-header">
    <h1 align="center" class="m-0">RUMAH SAKIT UTAMA HUSADA</h1>
    <h4 align="center" class="m-0">Jl. Manggar No.134, Tegalsari, Ambulu, Kabupaten Jember, Jawa Timur</h4>
    <h4 align="center" class="m-0">Telepon / HP: 0336 - 881186 / 881187 / +6282302227892; Email: utamahusada@yahoo.com</h4>
  </div>
</center>
</div>
<hr style="margin-bottom: -5px;">
<hr size="6" color="#000000" style="bgcolor: #000;">
<!-- <img src="<?php echo base_url() ?>desain/assets/images/watermark.png" class="background"> -->
<table>
  <tr>
    <td class="kolom" colspan="2">
      Jember,<br>
      Nama Dokter : <br>
      SIP <br>
      Unit<br>
      Riwayat Alergi
    </td>

  </tr>
  <tr>
    <button class="btn btn-sm btn-primary">djakdjka</button>
    <td class="kolom" style="min-width:500px">
      R/
    </td>
    <td class="kolom" rowspan="2" style="min-width:400px">

      <center><h4>SKRINNING/PENGKAJIAN RESEP</h4></center>
      <table border="1" width="100%">
        <tr>
          <td class="kolom"><h5>KRITERIA</h5></td>
          <td class="kolom"><h5>CHECK LIST</h5></td>
          <td class="kolom"><h5>KRITERIA</h5></td>
          <td class="kolom"><h5>CHECK LIST</h5></td>
        </tr>
        <tr>
          <td class="kolom">Nama & SIP Dokter</td>
          <td class="kolom"></td>
          <td class="kolom">Signa</td>
          <td class="kolom"></td>
        </tr>
        <tr>
          <td class="kolom"><h5>KRITERIA</h5></td>
          <td class="kolom"><h5>KRITERIA</h5></td>
          <td class="kolom"><h5>KRITERIA</h5></td>
          <td class="kolom"><h5>KRITERIA</h5></td>
        </tr>
        <tr>
          <td class="kolom"><h5>KRITERIA</h5></td>
          <td class="kolom"><h5>KRITERIA</h5></td>
          <td class="kolom"><h5>KRITERIA</h5></td>
          <td class="kolom"><h5>KRITERIA</h5></td>
        </tr>
        <tr>
          <td class="kolom"><h5>KRITERIA</h5></td>
          <td class="kolom"><h5>KRITERIA</h5></td>
          <td class="kolom"><h5>KRITERIA</h5></td>
          <td class="kolom"><h5>KRITERIA</h5></td>
        </tr>
      </table>
    </td>
    <!-- <td class="kolom" style="min-width:400px">jdkakd</td> -->
  </tr>
</table>
<div class="bg">
<br>
</div>

<script src="<?php echo base_url(); ?>desain/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>desain/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
<script>
$(document).ready(function(){
window.print()
});
</script>
</body>
</html>
