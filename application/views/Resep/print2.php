<html>
<head>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script>
window.print()
</script>
<style>
@font-face {
font-family: "avant";
src:
url("<?php echo base_url() ?>desain/custom/font/avant/album-avantquelombre-webfont.woff") format("woff"),
url("<?php echo base_url() ?>desain/custom/font/avant/album-avantquelombre-webfont.woff2") format("woff2")
}
@font-face {
font-family: "beth";
src:
url("<?php echo base_url() ?>desain/custom/font/beth/bethhrg.woff") format("woff"),
url("<?php echo base_url() ?>desain/custom/font/beth/bethhrg.woff2") format("woff2")
}
  .logo{
    width: 50px;
    height: 50px;
    margin-left: 15px;
    position: fixed;
    left: 0;
  }
  .resep {
/* font-family: 'avant', 'beth',sans-serif; */
font-weight:normal;
font-style:normal;
padding-left:10px;
}
@media print {
  .kop{
    font-size: 10px;
    width: 50%;
    margin-left: 50px;
  }
  .col-md-7{
    margin-bottom: -20px;
  }
  .garis{
    margin-bottom: 10px;
    width:100px;
  }
}
body{
  width: 100px;
}
table{
  font-size: 7.5px;
}
h5{
  font-size: 10px;
  margin-bottom: 1.5px !important;
}
h6{
  font-size: 9px;
  margin-bottom: 1.5px !important;
}
</style>
</head>
<body>
  <!-- <button class="btn btn-primary">dkjakd</button> -->
  <div class="container" style="margin-left:0px">
    <div class="row">
      <div class="col-md-7" style="font-size:9px;">
          <img src="<?php echo base_url() ?>desain/assets/images/<?php echo $this->Core->logo_klinik()?>" class="logo">
          <p align="center" class="kop"><?php echo $this->Core->nama_klinik()."<br>".$this->Core->alamat_klinik()?><br></p>
          <hr class="garis">
      </div>

      <!-- <hr style="margin-bottom: -5px;"> -->
      <!-- <hr color="#000000" style="bgcolor: #000;" class="garis"> -->
        <div class="col-md-12">
          <table class="table table-bordered table-striped table-color table-warning" style="max-width: 450px;">
            <thead>
              <tr>
                <th colspan="2">Jember, <?php echo date("d-m-Y",strtotime($dokter['tanggal']))?><br>
                Nama Dokter : <?php echo $dokter['nama']?> <br>
                SIP : <?php echo $dokter['sip']?><br>
                Unit : <?php echo $dokter['tujuan_pelayanan']?><br>
                Riwayat Alergi : <br>
                <div>
                <?php if (!empty($alergi)): ?>
                  <?php foreach ($alergi as $value): ?>
                    <?php echo $value->alergi_reaksi." (".$value->konsumsi.")"?>
                  <?php endforeach; ?>
                <?php else:?>
                  Tidak ada riwayat alergi
                <?php endif; ?>

              </div>
                </th>
                <!-- <th>dkajkad</th> -->
              <tr>
            </thead>
            <tbody style="max-width:500px">
              <tr>
                <th style="width:250px">
                  <h6>R/</h6>
                  <div class="resep">
                    <?php foreach ($resep as $value) {
                      echo $value->nama_obat." no ".$value->jumlah_beri."   <br>(".$value->signa.")<br>";
                    }?>
                  </div>
                  <table width="100%" <?php if (count($resep)>=8): ?>
                     style="margin-top:50px;"
                     <?php else: ?>
                        style="margin-top:150px;"
                  <?php endif; ?>>
                    <tr>
                      <td class="kolom" colspan="4" style="padding-bottom:20px;">PCC</td>
                    </tr>
                    <tr>
                      <td class="kolom" width="25%">Pro</td>
                      <td class="kolom" width="75%"><?php echo $pasien['namapasien']?></td>

                    </tr>
                    <tr>

                      <td class="kolom" width="25%">BB</td>
                      <td class="kolom" width="75%"><?php echo $dokter['bb']?></td>
                    </tr>
                    <tr>
                      <td class="kolom" width="25%">No RM</td>
                      <td class="kolom" width="75%"><?php  echo $pasien['noRM'];?></td>
                    </tr>

                    <tr>
                      <td class="kolom" width="25%">Untuk</td>
                      <td class="kolom" width="75%">Instalasi farmasi RSUH</td>
                    </tr>

                    <tr>
                      <td class="kolom" width="25%">Tgl Lahir</td>
                      <td class="kolom" width="75%"><?php echo date("d-m-Y",strtotime(@$pasien['tgl_lahir']));?></td>
                    </tr>

                    <tr>
                      <td class="kolom" width="25%">Ruang / Poli</td>
                      <td class="kolom" width="75%"><?php echo $dokter['tujuan_pelayanan']?></td>
                    </tr>
                  </table></th>
                <th style="width:250px">
                  <center><h5>SKRINNING/PENGKAJIAN RESEP</h5></center>
                  <table border="1" width="100%">
                    <tr>
                      <td class="kolom"><h6>KRITERIA</h6></td>
                      <td class="kolom"><h6>CHECK LIST</h6></td>
                      <td class="kolom"><h6>KRITERIA</h6></td>
                      <td class="kolom"><h6>CHECK LIST</h6></td>
                    </tr>
                    <tr>
                      <td class="kolom">Nama & SIP Dokter</td>
                      <td class="kolom"></td>
                      <td class="kolom">Signa</td>
                      <td class="kolom"></td>
                    </tr>
                    <tr>
                      <td class="kolom">Tanggal Resep</td>
                      <td class="kolom"></td>
                      <td class="kolom">Alergi</td>
                      <td class="kolom"></td>
                    </tr>
                    <tr>
                      <td class="kolom">Paraf Dokter</td>
                      <td class="kolom"></td>
                      <td class="kolom">Efek Samping Obat</td>
                      <td class="kolom"></td>
                    </tr>
                    <tr>
                      <td class="kolom">Nama,umur,bb pasien</td>
                      <td class="kolom"></td>
                      <td class="kolom">Interaksi</td>
                      <td class="kolom"></td>
                    </tr>
                    <tr>
                      <td class="kolom">Nama,petensi,& jumlah obat</td>
                      <td class="kolom"></td>
                      <td class="kolom">Kesesuaian (dosis,durasi,jumlah,lama pemberian)</td>
                      <td class="kolom"></td>
                    </tr>
                    <tr>
                      <td class="kolom">Bentuk sediaan & dosis obat</td>
                      <td class="kolom"></td>
                      <td class="kolom">Kontra Indiksi</td>
                      <td class="kolom"></td>
                    </tr>
                  </table>
                  <center><h5>Verifikasi Obat</h5></center>
                  <table border="1" width="100%">
                    <tr>
                      <td class="kolom"><h6>KRITERIA</h6></td>
                      <td class="kolom"><h6>CHECK LIST</h6></td>
                    </tr>
                    <tr>
                      <td class="kolom">Obat dengan resep</td>
                      <td class="kolom"></td>
                    </tr>
                    <tr>
                      <td class="kolom">Jumlah dosis dengan resep</td>
                      <td class="kolom"></td>
                    </tr>
                    <tr>
                      <td class="kolom">Signa dengan resep</td>
                      <td class="kolom"></td>
                    </tr>
                    <tr>
                      <td class="kolom">Rute dengan resep</td>
                      <td class="kolom"></td>
                    </tr>
                    <tr>
                      <td class="kolom">Waktu/frekuensi dengan resep</td>
                      <td class="kolom"></td>
                    </tr>
                  </table>
                  <center><h5>KIE</h5></center>
                  <h6 style="margin-top:0px;">Bahwa telah dilakukan edukasi dan informasi mengenai</h6>
                  <table border="1" width="100%">
                    <tr>
                      <td class="kolom"><h6>KRITERIA</h6></td>
                      <td class="kolom"><h6>CHECK LIST</h6></td>
                    </tr>
                    <tr>
                      <td class="kolom">Nama Obat</td>
                      <td class="kolom"></td>
                    </tr>
                    <tr>
                      <td class="kolom">Indikasi Obat</td>
                      <td class="kolom"></td>
                    </tr>
                    <tr>
                      <td class="kolom">Cara pemakaian obat</td>
                      <td class="kolom"></td>
                    </tr>
                    <tr>
                      <td class="kolom">Efek samping</td>
                      <td class="kolom"></td>
                    </tr>
                    <tr>
                      <td class="kolom">Penyimpanan</td>
                      <td class="kolom"></td>
                    </tr>
                  </table>
                </th>
              <tr>
              <tr>
                <th colspan="2">
                  <table border="1" width="100%">
                    <tr>
                      <td style="padding-bottom:35px" width="20%"><center>Petugas Farmasi</center><td>
                      <td style="padding-bottom:35px" width="20%"><center>Petugas Skrinning</center><td>
                      <td style="padding-bottom:35px" width="20%"><center>Petugas Verifikasi</center><td>
                      <td style="padding-bottom:35px" width="20%"><center>Petugas KIE</center><td>
                      <td style="padding-bottom:35px" width="20%"><center>Pasien</center><td>
                    </tr>
                    <tr>
                      <td style="padding-bottom:10px" width="20%">Nama : <td>
                      <td style="padding-bottom:10px" width="20%">Nama : <td>
                      <td style="padding-bottom:10px" width="20%">Nama : <td>
                      <td style="padding-bottom:10px" width="20%">Nama : <td>
                      <td style="padding-bottom:10px" width="20%">Nama : <td>
                    </tr>
                  <table>
                </th>
              <tr>
            </tbody>
          </table>
        </div>
    </div>
  </div>
</body>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</html>
