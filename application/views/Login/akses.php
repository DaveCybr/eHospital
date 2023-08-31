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
<body>

       <!---start-main---->
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
        <form action="<?php echo base_url()."Login/redirect/".$username?>" method="POST" id="FormLogin">
          <h5 ><span class="badge badge-success">Pilih layanan login</span></h5>

          <select class="form-control" name="login_poli" >

            <?php foreach ($user as $value): ?>
              <?php if ($value->Jabatan=='dumu' || $value->Jabatan=='pumu') {
                $poli = "UMU";
                $label = "Poli Umum";
              }elseif ($value->Jabatan=='pint' || $value->Jabatan=="dint") {
                $poli = "INT";
                $label = "Poli Internis";

            }elseif ($value->Jabatan=='pgig' || $value->Jabatan=="dgig") {
              $poli = "GIG";
              $label = "Poli GIGI";

          }
            elseif ($value->Jabatan=='bidan' || $value->Jabatan=='dobg') {
              $poli = "OBG";
              $label = "Poli Obgyn";

          }elseif ($value->Jabatan=='pozo' || $value->Jabatan=='dozo') {
                $poli = "OZO";
                $label = "Poli Ozon";

            }elseif ($value->Jabatan=='RANAP') {
              $poli = "RANAP";
              $label = "Rawat Inap";

          }
          elseif ($value->Jabatan=='PRANAP') {
            $poli = "PRANAP";
            $label = "Rawat Inap";

        }
        elseif ($value->Jabatan=='keuangan') {
          $poli = "keuangan";
          $label = "Bagian Keuangan";

      }elseif ($value->Jabatan=='kasir') {
        $poli = "kasir";
        $label = "Kasir";

    }
    elseif ($value->Jabatan=='resepsionis') {
      $poli = "kasir";
      $label = "Kasir";

  }
              elseif ($value->Jabatan=='dugd' || $value->Jabatan=='pugd' ){
                $poli = "IGD";
                $label = "Unit Gawat Darurat";
              }
              elseif ($value->Jabatan=='direktur') {
                $poli = "direktur";
                $label = "Direktur";
              } ?>
              <option jabatan="<?php echo $value->Jabatan?>" value="<?php echo $poli?>"><?php echo $label?></option>
            <?php endforeach; ?>
          </select>
          <div class="p-container">
                <!-- <label class="checkbox"><input type="checkbox" name="checkbox" checked><i></i>Remember Me</label> -->
                <input type="submit" value="Lanjutkan" >
              <div class="clear"> </div>
          </div>
        </form>
        </div>
    </div>
          <div class="copy-right">
          <p>copy-right <a href="#" onclick="coba()">E-Solusindo</a></p>
        </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
