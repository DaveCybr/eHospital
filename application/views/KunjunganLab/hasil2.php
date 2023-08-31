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
  width: 750px;
  /* min-height: 900px; */
}
.cover{
  background-image:url(<?php echo base_url() ?>desain/watermark.png);
  background-size: 750px 900px;
  background-repeat: repeat-y;
  position: fixed;
  width: 750px;
  height: 900px;
  top: 300px;
  z-index: -1;
}
.striped tr:nth-child(even) {
  background-color: #b7e2fcc7;
}
.striped tr:nth-child(odd) {
  background-color: #f1faffdb;
}
body {
  /* background-color: #CCC; */
  /* margin:135px 0px 0px 0px; */
  font-size: 12px;
}
.jarak-atas{
  padding-top: 340px;
}
.jarak-bawah{
  padding-top: 550px;
}
.trans{
  background-color: #fff0 !important;
}
div#header {
  position:fixed;
  top:0px;
  left:0px;
  width:100%;
  /* color:#CCC; */
  background:#fff;
  padding:0px 8px 8px 8px;
}
div#footer {
  position:fixed;
  bottom:0px;
  left:0px;
  width:100%;
  color:#CCC;
  /* background:#333; */
  padding:8px;
}
/* } */


</style>
<div class="cover">
</div>
<div id="header">
  <div class="row" style="">
    <div class="col-logo">
      <img src="<?php echo $this->Core->logo_klinik()?>" class="logo">
    </div>
    <div class="col-header">
      <h1 align="center" class="m-0"><?php echo $this->Core->nama_klinik()?></h1>
      <h4 align="center" class="m-0"><?php echo $this->Core->alamat_klinik()?></h4>
      <!-- <h4 align="center" class="m-0"><?php echo $this->Core->kontak_klinik()?></h4> -->
    </div>

  </div>
  <hr style="margin-bottom: -5px;">
  <hr size="6" color="#000000" style="bgcolor: #000;">
  <h2 align="center">HASIL PEMERIKSAAN LAB</h2>
  <div style="background: linear-gradient(40deg,#a5e2fb99,#5aa4ffeb)!important;padding: 25px;border-radius: 10px;margin-right:20px">
    <table width="100%" class="borderless" style="font-size:14px">

      <tr>
        <th width="15%" align="left">NO LAB</th>
        <th width="35%" align="left">: <?php echo $data_lab['nokunjlab']; ?> </th>

        <th width="15%" align="left"></th>
        <th width="35%" align="left"></th>
      </tr>
      <tr>
        <th width="15%" align="left">NO RM </th>
        <th width="35%" align="left">: <?php echo $data_lab['noRM']; ?></th>
        <th width="15%" align="left"></th>
        <th width="35%" align="left"></th>
      </tr>
      <tr>
        <th width="15%" align="left">PASIEN </th>
        <th width="35%" align="left" colspan="3">: <?php echo $data_lab['namapasien']; ?></th>
      </tr>

      <tr>
        <th width="15%" align="left">ALAMAT </th>
        <th width="35%" align="left" colspan="3" >: <?php echo $data_lab['alamat']; ?></th>

      </tr>

      <tr>
        <th width="15%" align="left">TGL LAHIR </th>
        <th width="35%" align="left">: <?php echo date("d-m-Y",strtotime($data_lab['tgl_lahir']))."<span style='margin-left:60px'> J.Kel : ".$data_lab_2['jenis_kelamin']."</span>"; ?></th>
        <th width="15%" align="left">DOKTER</th>
        <th width="35%" align="left">: <?php echo $data_lab_2['nama_dokter']; ?></th>
      </tr>

      <tr>
        <th width="15%" align="left">UMUR </th>
        <th width="35%" align="left">: <?php echo $this->Core->umur($data_lab['tgl_lahir']); ?></th>
        <th width="15%" align="left">TANGGAL </th>
        <th width="35%" align="left">: <?php echo date("d-m-Y",strtotime($data_lab_2['jam'])) ?></th>
      </tr>
      <tr>
        <th width="15%" align="left">Telepon </th>
        <th width="35%" align="left">: <?php echo $data_lab['telepon']; ?></th>
        <th width="15%" align="left"></th>
        <th width="35%" align="left"></th>
      </tr>

    </table>
  </div>
</div>

<div class="bg jarak-atas data">

  <table class="striped" cellspacing="0" cellpadding="4" width="100%">
    <tr style="background-color:#fff">
      <th align="left">PEMERIKSAAN </th>
      <th align="left">HASIL LAB</th>
      <th align="left">NILAI NORMAL</th>
    </tr>

    <?php $no = 1;
    // for ($j=0; $j < 3; $j++) {
    // code...

    $jml=count($hasil_lab);
    $cov = 0;
    foreach ($hasil_lab as $value): ?>
    <?php
      if ($value->kode_lab=="14.02" || $value->kode_lab=="14.01") {
        $cov = 1;
      }
      if ($value->kode_lab=="17.01") {
        $cov = 2;
      }
    ?>

    <tr>
      <td <?php if (strlen($value->kode_lab) > 3 && strlen($value->kode_lab) < 6): ?>
        style="padding-left:20px;"
      <?php else: ?>
        <?php if (strlen($value->kode_lab) >= 6): ?>

          style="padding-left:50px;"
        <?php endif; ?>
      <?php endif; ?>><?php echo $value->nama ?></td>
      <?php if ($value->hasil == "Reaktif" || ($value->kode_lab=="17.01" && strtolower($value->hasil) == "positif" )): ?>
        <td style="color:red"><?php echo $value->hasil; ?></td>
      <?php else: ?>
        <td><?php echo $value->hasil; ?></td>
      <?php endif; ?>
      <td><?php echo $value->nilainormal; ?></td>
    </tr>
    <?php if ($jml > 28): ?>
      <?php if ($no == 28): ?>
        <tr class="trans">
          <td colspan="4" style="padding-top: 345px;"></td>
        </tr>
      <?php endif; ?>
    <?php else: ?>
      <?php $t=0; for ($k=24; $k <= 40; $k++) { ?>
        <?php if ($jml == $k) {
          if ($no == $k) { ?>
            <tr class="trans">
              <td colspan="4" style="padding-top: <?php echo 550-(25*$t).'px'; ?>;"></td>
            </tr>
            <tr style="background-color:#fff">
              <th align="left">PEMERIKSAAN</th>
              <th align="left">HASIL LAB</th>
              <th align="left">NILAI NORMAL</th>
            </tr>
          <?php  } } ?>
          <?php $t++; } ?>
        <?php endif; ?>
      <?php $no++; endforeach; ?>
      </table>
      <?php if ($cov == 1): ?>
        <div>
          <table width="80%" style="margin-top: 20px">
            <tr>
              <th width="20%"  align="left"  >Catatan :</th>
              <th width="20%" align="left"  style="padding-top:10px;"><?php echo $catatan[1]->catatan?></th>
            </tr>
            <tr>
              <th width="20%" align="left"  >Saran:</th>
              <th width="80%" align="left"  style="padding-top:10px;"><?php echo $catatan[1]->saran?></th>
            </tr>
          </table>
        </div>
      <?php endif; ?>

      <?php if ($cov == 2): ?>
        <div>
          <table width="80%" style="margin-top: 60px">
            <tr>
              <th width="20%"  align="left"  >Catatan :</th>
              <th width="20%" align="left"  style="padding-top:10px;"><?php echo $catatan[0]->catatan?></th>
            </tr>
            <tr>
              <th width="20%" align="left"  >Saran:</th>
              <th width="80%" align="left"  style="padding-top:10px;"><?php echo $catatan[0]->saran?></th>
            </tr>
          </table>
        </div>
      <?php endif; ?>
      <table width="100%" style="margin-top: 30px">
        <tr>
          <th align="left" style="padding-left:50px;">Analis</th>
          <th align="right" style="padding-right:50px;">Penanggung Jawab</th>
        </tr>
      </table>

      <table width="100%" style="margin-top: 30px">
        <tr>
          <th align="left" style="padding-left:50px;">Zahrah</th>
          <th align="right" style="padding-right:50px;"><?php echo $data_lab_2['nama_dokter']; ?></th>
        </tr>
        <tr>
          <th align="left" style="padding-left:50px;"></th>
          <th align="right" style="padding-right:50px;"><?php echo $data_lab_2['sip']; ?></th>
        </tr>
      </table>
    </div>

  </div>

  <script src="<?php echo base_url(); ?>desain/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
  <script>
  $(document).ready(function(){
    window.print()
  });
</script>
