<div class="col-sm-12 col-lg-12">
  <br>
  <h4>1. Health Education</h4>
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="healtheducation1" name="healtheducation1" value="1" <?php if (@$asesmen['healtheducation1']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="healtheducation1">Berikan penjelasan kepada pasien / keluarga tentang kondisi penyebab nyeri, rencana pemeriksaan dan tindakan yang akan dilakukan</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control">
      <textarea name="healtheducation2" rows="2" class="form-control" placeholder="Lainnya .... "><?php echo @$asesmen['healtheducation2']; ?></textarea>
    </div>
  </div>

</div>

<div class="col-sm-12 col-lg-12">
  <br>
  <h4>2. Nursing Treatmen</h4>
  <h5>Atur Posisi klien</h5>
  <div class="row custom-control custom-radio">
    <div class="col-sm-12 col-lg-6 custom-control custom-radio">
      <input disabled type="radio" id="posisiklien1" name="posisiklien1" value="Head Up" <?php if (@$asesmen['posisiklien1']=='Head Up') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="posisiklien1">Head UP</label>
    </div>
    <div class="col-sm-12 col-lg-6 custom-control custom-radio">
      <input disabled type="radio" id="posisiklien2" name="posisiklien1" value="Posisi Syok" <?php if (@$asesmen['posisiklien1']=='Posisi Syok') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="posisiklien2">Posisi Syok</label>
    </div>
    <div class="col-sm-12 col-lg-6 custom-control custom-radio">
      <input disabled type="radio" id="posisiklien3" name="posisiklien1" value="Semi Flower" <?php if (@$asesmen['posisiklien1']=='Semi Flower') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="posisiklien3">Semi Flower</label>
    </div>
  </div>
  <div class="col-12 col-lg-12 input-group">
    <div class="input-group-prepend">
      <span class="input-group-text">Lainnya :</span>
    </div>
    <input disabled type="text" class="form-control" aria-label="" name="posisiklienlian" value="<?php echo @$asesmen['posisiklienlain'] ?>">
  </div>
  <div class="row custom-control custom-checkbox p-b-10">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="pengamantempattidur" name="pengamantempattidur" value="1" <?php if (@$asesmen['pengamantempattidur']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="pengamantempattidur">Pasang pengaman tempat tidur</label>
    </div>
  </div>

  <h5>A. Airway</h5>
  <div class="row custom-control custom-checkbox p-b-10">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="neccollar" name="neccollar" value="1" <?php if (@$asesmen['neccollar']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="neccollar">Pasang Nec Collar</label>
    </div>
  </div>

  <h5>Bebaskan jalan nafas dan teknik</h5>
  <div class="row custom-control custom-checkbox p-b-10">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="fingersweep" name="fingersweep" value="1" <?php if (@$asesmen['fingersweep']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="fingersweep">Finger Sweep</label>
    </div>
  </div>

  <h5>Bebaskan jalan nafas tanpa alat</h5>
  <div class="row custom-control custom-checkbox p-b-10">
    <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
      <input disabled type="checkbox" id="headtuil" name="headtuil" value="1" <?php if (@$asesmen['headtuil']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="headtuil">Head Tuil</label>
    </div>
    <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
      <input disabled type="checkbox" id="jawthurst" name="jawthurst" value="1" <?php if (@$asesmen['jawthurst']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="jawthurst">Jaw Thrust</label>
    </div>
    <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
      <input disabled type="checkbox" id="chinlift" name="chinlift" value="1" <?php if (@$asesmen['chinlift']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="chinlift">Chin Lift</label>
    </div>
  </div>

  <h5>Bebaskan jalan nafas dengan alat</h5>
  <div class="row custom-control custom-checkbox p-b-10">
    <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
      <input disabled type="checkbox" id="orofaring" name="orofaring" value="1" <?php if (@$asesmen['orofaring']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="orofaring">Orofaring tube</label>
    </div>
    <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
      <input disabled type="checkbox" id="nasofaring" name="nasofaring" value="1" <?php if (@$asesmen['nasofaring']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="nasofaring">Nasofaring tube</label>
    </div>
    <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
      <input disabled type="checkbox" id="suction" name="suction" value="1" <?php if (@$asesmen['suction']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="suction">Suction</label>
    </div>
  </div>

  <h5>Atasi sumbatan jalan nafas parsial dengan cara:</h5>
  <div class="row custom-control custom-checkbox p-b-10">
    <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
      <input disabled type="checkbox" id="abdominal" name="abdominal" value="1" <?php if (@$asesmen['abdominal']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="abdominal">Abdominal thrust</label>
    </div>
    <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
      <input disabled type="checkbox" id="chesthrust" name="chesthrust" value="1" <?php if (@$asesmen['chesthrust']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="chesthrust">Chest thrust</label>
    </div>
    <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
      <input disabled type="checkbox" id="backblow" name="backblow" value="1" <?php if (@$asesmen['backblow']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="backblow">Back blow</label>
    </div>
  </div>

  <div class="row custom-control custom-checkbox p-b-10">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="monitornafas" name="monitornafas" value="1" <?php if (@$asesmen['monitornafas']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="monitornafas">Monitor bersihan jalan nafas</label>
    </div>
  </div>

  <h5>B. Breathing</h5>
  <div class="col-12 col-lg-12 input-group p-b-10">
    <div class="input-group-prepend">
      <span class="input-group-text">Berikan oksigen:</span>
    </div>
    <input disabled type="text" class="form-control" aria-label="" name="berioksigen" value="<?php echo @$asesmen['td'] ?>">
    <div class="input-group-prepend">
      <span class="input-group-text">L/mnt</span>
    </div>

    <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
      <input disabled type="checkbox" id="nassal" name="nassal" value="1" <?php if (@$asesmen['nassal']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="nassal">Nassal Canul</label>
    </div>
    <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
      <input disabled type="checkbox" id="sm" name="sm" value="1" <?php if (@$asesmen['sm']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="sm">S.M</label>
    </div>
    <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
      <input disabled type="checkbox" id="bvm" name="bvm" value="1" <?php if (@$asesmen['bvm']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="bvm">B.V.M</label>
    </div>
    <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
      <input disabled type="checkbox" id="mnr" name="mnr" value="1" <?php if (@$asesmen['mnr']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="mnr">M n R</label>
    </div>
    <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
      <input disabled type="checkbox" id="mr" name="mnr" value="1" <?php if (@$asesmen['mr']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="mr">M.R</label>
    </div>
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="nafasdalam" name="nafasdalam" value="1" <?php if (@$asesmen['nafasdalam']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="nafasdalam">Anjurkan klien melakukan nafas dalam</label>
      </div>
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="chestfisi" name="chestfisi" value="1" <?php if (@$asesmen['chestfisi']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="chestfisi">Chest fisioterapy</label>
      </div>
  </div>

  <h5>C. Circulation</h5>
  <div class="col-12 col-lg-12 input-group p-b-10">
    <div class="row custom-control custom-checkbox">
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="rpj" name="rpj" value="1" <?php if (@$asesmen['rpj']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="rpj">Lakukan RJP</label>
      </div>
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="ecg" name="ecg" value="1" <?php if (@$asesmen['ecg']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="ecg">Pemeriksaan ECG</label>
      </div>
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="hentikanperdarahan" name="hentikanperdarahan" value="1" <?php if (@$asesmen['hentikanperdarahan']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="hentikanperdarahan">Hentikan perdarahan dengan bebat tekan</label>
      </div>
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="rehidrasi" name="rehidrasi" value="1" <?php if (@$asesmen['rehidrasi']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="rehidrasi">Rehidrasi cairan</label>
      </div>
      <div class="col-12 col-lg-12 input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Lainnya :</span>
        </div>
        <input disabled type="text" class="form-control" aria-label="" name="circulationlain" value="<?php echo @$asesmen['circulationlain'] ?>">
      </div>
    </div>
  </div>


  <h5>D. Disability</h5>
  <div class="col-12 col-lg-12 input-group p-b-10">
    <div class="row custom-control custom-checkbox">
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="bebatbidai" name="bebatbidai" value="1" <?php if (@$asesmen['bebatbidai']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="bebatbidai">Pasang bebat bidai</label>
      </div>
    </div>
    <div class="row custom-control custom-checkbox">
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="rangsel" name="rangsel" value="1" <?php if (@$asesmen['rangsel']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="rangsel">Pasang rangsel verban</label>
      </div>
    </div>
    <div class="row custom-control custom-checkbox">
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="tekniksi" name="tekniksi" value="1" <?php if (@$asesmen['tekniksi']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="tekniksi">Ajarkan tekhnik distraksi dan relaksasi</label>
      </div>
    </div>
    <div class="row custom-control custom-checkbox">
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="rawatluka" name="rawatluka" value="1" <?php if (@$asesmen['rawatluka']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="rawatluka">Rawat luka dengan tekhnik aseptic</label>
      </div>
    </div>
    <div class="row custom-control custom-checkbox">
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="kliensuhu" name="kliensuhu" value="1" <?php if (@$asesmen['kliensuhu']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="kliensuhu">Hindari klien terpapar suhu dingin berlebihan dan berikan selimut</label>
      </div>
    </div>
    <div class="row custom-control custom-checkbox">
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="kompres" name="kompres" value="1" <?php if (@$asesmen['kompres']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="kompres">Berikan kompres dingin/hangat</label>
      </div>
    </div>
  </div>

  <h5>E. Intoxikasi</h5>
  <div class="col-12 col-lg-12 input-group p-b-10">
    <div class="col-12 col-lg-12 input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">Mengkaji jenis racun :</span>
      </div>
      <input disabled type="text" class="form-control" aria-label="" name="jenisracun" value="<?php echo @$asesmen['jenisracun'] ?>">
    </div>
    <div class="row custom-control custom-checkbox">
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="kumbahlambung" name="kumbahlambung" value="1" <?php if (@$asesmen['kumbahlambung']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="kumbahlambung">Kumbah lambung</label>
      </div>
    </div>
  </div>

  <h5>F. Psiko, Sosio, spiritual</h5>
  <div class="col-12 col-lg-12 input-group p-b-10">
    <div class="row custom-control custom-checkbox">
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="bhsp" name="bhsp" value="1" <?php if (@$asesmen['bhsp']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="bhsp">BHSP</label>
      </div>
    </div>
    <div class="row custom-control custom-checkbox">
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="suasana" name="suasana" value="1" <?php if (@$asesmen['suasana']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="suasana">Ciptakan suasana aman dan nyaman</label>
      </div>
    </div>
    <div class="row custom-control custom-checkbox">
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="bataspengunjung" name="bataspengunjung" value="1" <?php if (@$asesmen['bataspengunjung']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="bataspengunjung">Batasi jumlah pengunjung</label>
      </div>
    </div>
    <div class="row custom-control custom-checkbox">
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="kecemasan" name="kecemasan" value="1" <?php if (@$asesmen['kecemasan']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="kecemasan">Kaji penyebab kecemasan </label>
      </div>
    </div>
    <div class="row custom-control custom-checkbox">
      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
        <input disabled type="checkbox" id="ungkapperasaan" name="ungkapperasaan" value="1" <?php if (@$asesmen['ungkapperasaan']=='1') {echo "checked";} ?> class="custom-control-input">
        <label class="custom-control-label" for="ungkapperasaan">Berikan kesempatan untuk ungkapkan perasaan</label>
      </div>
    </div>
  </div>
</div>

<div class="col-sm-12 col-lg-12">
  <br>
  <h4>3. Observasi</h4>
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="potensinafas" name="potensinafas" value="1" <?php if (@$asesmen['potensinafas']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="potensinafas">Potensi jalan nafas</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="vitalsign" name="vitalsign" value="1" <?php if (@$asesmen['vitalsign']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="vitalsign">Vital Sign (TD, N, S, RR)</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="observasifrekuensi" name="observasifrekuensi" value="1" <?php if (@$asesmen['observasifrekuensi']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="observasifrekuensi">Observasi frekuensi/ pola/ irama nafas/ penggunaan otot bantu nafas</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="sianosis" name="sianosis" value="1" <?php if (@$asesmen['sianosis']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="sianosis">Sianosis, akral, CRT, warna kulit, Oedema daerah estermitas.</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="keseimbanganintake" name="keseimbanganintake" value="1" <?php if (@$asesmen['keseimbanganintake']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="keseimbanganintake">Keseimbangan intake dan output (produksi urin, NGT)</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="GCSpupil" name="GCSpupil" value="1" <?php if (@$asesmen['GCSpupil']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="GCSpupil">GCS, ukuran pupil, Reflek cahaya</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="peradangan" name="peradangan" value="1" <?php if (@$asesmen['peradangan']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="peradangan">Tanda-tanda peradangan</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="lingkarabdomen" name="lingkarabdomen" value="1" <?php if (@$asesmen['lingkarabdomen']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="lingkarabdomen">Lingkar abdomen</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="hbd" name="hb" value="1" <?php if (@$asesmen['hb']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="hbd">HB</label>
    </div>
  </div>
</div>


<div class="col-sm-12 col-lg-12">
  <br>
  <h4>4. Kolaborasi</h4>
  <div class="row custom-control custom-checkbox">
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="ett" name="ett" value="1" <?php if (@$asesmen['ett']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="ett">Pemasangan ETT</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="nebulizer" name="nebulizer" value="1" <?php if (@$asesmen['nebulizer']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="nebulizer">Pemberian broncolidator / nebulizer</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="pasangiv" name="pasangiv" value="1" <?php if (@$asesmen['pasangiv']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="pasangiv">Pasang IV line : Kristalois Koloid</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="pasangtranfusi" name="pasangtranfusi" value="1" <?php if (@$asesmen['pasangtranfusi']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="pasangtranfusi">Pasang tranfusi darah WB/PRC</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="ngt" name="ngt" value="1" <?php if (@$asesmen['ngt']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="ngt">Pasang NGT</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="kateter" name="kateter" value="1" <?php if (@$asesmen['kateter']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="kateter">Pasang kateter</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="wt" name="wt" value="1" <?php if (@$asesmen['wt']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="wt">WT/WTHT</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="pemberianobat" name="pemberianobat" value="1" <?php if (@$asesmen['pemberianobat']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="pemberianobat">Pemberian obat-obatan</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="pemberiananti" name="pemberiananti" value="1" <?php if (@$asesmen['pemberiananti']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="pemberiananti">Pemberian anti dotum</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="pemberianlaboratorium" name="pemberianlaboratorium" value="1" <?php if (@$asesmen['pemberianlaboratorium']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="pemberianlaboratorium">Pemeriksaan laboratorium</label>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
      <input disabled type="checkbox" id="radiologi" name="radiologi" value="1" <?php if (@$asesmen['radiologi']=='1') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="radiologi">Pemeriksaan radiologi (thorax, USG, BOF)</label>
    </div>
    <div class="col-12 col-lg-12 input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">Lainnya :</span>
      </div>
      <input disabled type="text" class="form-control" aria-label="" name="lainradio" value="<?php echo @$asesmen['lainradio '] ?>">
    </div>
  </div>
</div>
