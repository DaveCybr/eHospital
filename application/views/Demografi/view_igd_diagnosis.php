<div class="col-sm-12 col-lg-12">
  <br>
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="jnb1" name="jnb1" value="Ketidak Efektifan bersihan jalan nafas ybd" <?php echo @$asesmen['jnb1']!==NULL?'checked':''; ?> class="custom-control-input">
      <label class="custom-control-label" for="jnb1">Ketidak Efektifan bersihan jalan nafas ybd</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="jnb2" name="jnb2" value="Penumpukan secret/darah" <?php echo @$asesmen['jnb2']!==NULL?'checked':''; ?> class="custom-control-input">
      <label class="custom-control-label" for="jnb2">Penumpukan secret/darah</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="jnb3" name="jnb3" value="Muntahan" <?php echo @$asesmen['jnb3']!==NULL?'checked':''; ?> class="custom-control-input">
      <label class="custom-control-label" for="jnb3">Muntahan</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="jnb4" name="jnb4" value="Lidah jatuh ke belakang" <?php echo @$asesmen['jnb4']!==NULL?'checked':''; ?> class="custom-control-input">
      <label class="custom-control-label" for="jnb4">Lidah jatuh ke belakang</label>
    </div>
  </div>
<h6>T : Jalan nafas bebas</h6>
</div>

<br>

<div class="col-sm-12 col-lg-12">
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="tta" name="tta" value="1" <?php echo @$asesmen['tta']!==NULL?'checked':''; ?> class="custom-control-input">
      <label class="custom-control-label" for="tta">Resiko aspirasi ybd, muntahan/penumpukan secret/ darah </label>
    </div>
  </div>
<h6>T : Tidak terjadi aspirasi</h6>
<br>
</div>

<div class="col-sm-12 col-lg-12">
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="polanafas1" name="polanafas1" value="1" <?php if (@$asesmen['polanafas1']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="polanafas1">Ketidak efektifan pola nafas ybd </label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="polanafas2" name="polanafas2" value="1" <?php if (@$asesmen['polanafas2']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="polanafas2">Depresi pernafasan</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="polanafas3" name="polanafas3" value="1" <?php if (@$asesmen['polanafas3']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="polanafas3">Penumpukan kadar CO2</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="polanafas4" name="polanafas4" value="1" <?php if (@$asesmen['polanafas4']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="polanafas4">Penyempitan saluran nafas</label>
    </div>
  </div>
<h6>T : Pola nafas kembali normal</h6>
<br>
</div>

<div class="col-sm-12 col-lg-12">
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="curahjantung" name="curahjantung" value="1" <?php if (@$asesmen['curahjantung']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="curahjantung">Penurunan curah jantung ybd penurunan kontraktilitas otot jantung</label>
    </div>
  </div>
<h6>T : Curah jantung meningkat</h6>
<br>
</div>

<div class="col-sm-12 col-lg-12">
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="perfusijaringan" name="perfusijaringan" value="1" <?php if (@$asesmen['perfusijaringan']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="perfusijaringan">Ketidak efektifan perfusi jaringan Penifer / Cerebral</label>
    </div>
  </div>
<h6>T : Perfusi jaringan membaik</h6>
<br>
</div>

<div class="col-sm-12 col-lg-12">
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="keseimbangancariran" name="keseimbangancariran" value="1" <?php if (@$asesmen['keseimbangancariran']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="keseimbangancariran">Gangguan Keseimbangan cairan : Kurang / Lebih</label>
    </div>
  </div>
<h6>T : Keseimbangan cairan kembali normal</h6>
<br>
</div>

<div class="col-sm-12 col-lg-12">
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="peningkatanTIK" name="peningkatanTIK" value="1" <?php if (@$asesmen['peningkatanTIK']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="peningkatanTIK">Resiko peningkaatan TIK ybd oedema, cerebri / perdarahan</label>
    </div>
  </div>
<h6>T : Tidak terjadi peningkatan TIK</h6>
<br>
</div>

<div class="col-sm-12 col-lg-12">
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="adaptasinyeri" name="adaptasinyeri" value="1" <?php if (@$asesmen['adaptasinyeri']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="adaptasinyeri">Gangguan rasa nyaman nyeri</label>
    </div>
  </div>
<h6>T : Klien beradaptasi dengan nyerinya</h6>
<br>
</div>

<div class="col-sm-12 col-lg-12">
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="resikocidera" name="resikocidera" value="1" <?php if (@$asesmen['resikocidera']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="resikocidera">Risiko Cidera</label>
    </div>
  </div>
<h6>T : Cidera Tidak Terjadi</h6>
<br>
</div>

<div class="col-sm-12 col-lg-12">
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="klienaktifitas" name="klienaktifitas" value="1" <?php if (@$asesmen['klienaktifitas']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="klienaktifitas">Intoleransi aktivitas Ybd penurunan suplai O2 ke jaringan</label>
    </div>
  </div>
<h6>T : Klien dapat melakukan aktifitas sesuai dengan kondisinya</h6>
<br>
</div>

<div class="col-sm-12 col-lg-12">
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="kerusakanintergritas" name="kerusakanintergritas" value="1" <?php if (@$asesmen['klienaktifitas']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="kerusakanintergritas">Kerusakan intergritas kulit</label>
    </div>
  </div>
<h6>T : kerusakan intergritas tidak bertambah</h6>
<br>
</div>

<div class="col-sm-12 col-lg-12">
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="tidakinfeksi" name="tidakinfeksi" value="1" <?php if (@$asesmen['tidakinfeksi']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="tidakinfeksi">Resiko infrksi ybd kondisi luka yang jelek</label>
    </div>
  </div>
<h6>T : Tidak terjadi infeksi</h6>
<br>
</div>

<div class="col-sm-12 col-lg-12">
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="hipotermi" name="hipotermi" value="1" <?php if (@$asesmen['hipotermi']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="hipotermi">Hipotermi</label>
    </div>
  </div>
<br>
</div>

<div class="col-sm-12 col-lg-12">
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="cemas" name="cemas" value="1" <?php if (@$asesmen['cemas']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="cemas">Cemas / kurang pengetahuan </label>
    </div>
  </div>
<h6>T : cemas berkurang / hilang</h6>
<br>
</div>
