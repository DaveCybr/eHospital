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
    background-image:url(<?php echo base_url() ?>desain/watermark.png);
    width: 750px;
    min-height: 900px;
    background-size: 750px 900px;
   background-repeat: repeat-y;
  }
  .striped tr:nth-child(even) {
    background-color: #b7e2fcc7;
  }
  .striped tr:nth-child(odd) {
    background-color: #f1faffdb;
  }
/* } */


</style>

<div class="row">
  <div class="col-logo">
    <img src="<?php echo base_url() ?>desain/assets/images/<?php echo $this->Core->logo_klinik()?>" class="logo">
  </div>
  <div class="col-header">
    <h1 align="center" class="m-0"><?php echo strtoupper($this->Core->nama_klinik())?></h1>
    <h4 align="center" class="m-0"><?php echo ($this->Core->alamat_klinik())?></h4>
    <h4 align="center" class="m-0"><?php echo ($this->Core->kontak_klinik())?></h4>
  </div>

</div>
<hr style="margin-bottom: -5px;">
<hr size="6" color="#000000" style="bgcolor: #000;">
<div class="bg">
  <br>
<h2 align="center">Pasien Baru Hari Ini</h2>

<br>
  <table border="1" width="100%">
      <tr style="background-color:#fff">
        <th align="left">NO</th>
          <th align="left">NO RM</th>
          <th align="left">Nama Pasien</th>
          <th align="left">Jenis Kelamin</th>
          <th align="left">Umur</th>
          <th align="left">Alamat</th>
      </tr>
      <?php $no= 1;
      foreach ($pasien as $value): ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $value->noRM; ?></td>
        <td><?php echo $value->namapasien; ?></td>
        <td><?php echo $value->jenis_kelamin; ?></td>
        <td><?php echo $this->Core->umur($value->tgl_lahir); ?></td>
        <td><?php echo $value->alamat; ?></td>
      </tr>
      <?php $no++; endforeach; ?>
  </table>
</div>


<script src="<?php echo base_url(); ?>desain/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
<script>
$(document).ready(function(){
window.print()
});
</script>
