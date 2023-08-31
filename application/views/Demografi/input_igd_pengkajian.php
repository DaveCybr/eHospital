<div class="card border-info" style="border: 2px solid;">
  <div class="card-header bg-info text-white">
    <strong>PENGKAJIAN</strong>
  </div>
  <div class="card-body card-block row">
    <div class="col-sm-12">
      <h4>1. AIRWAY</h4>
    </div>

    <div class="col-sm-12 col-lg-6 custom-control custom-radio">
      <input type="radio" id="airway_bebas" name="airway_bebas" value="Bebas" <?php if (@$asesmen['airway_bebas']=='Bebas') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="airway_bebas">Bebas</label>
    </div>

    <div class="col-sm-12 col-lg-12 custom-control custom-radio">
      <input type="radio" id="airway_obstruksi" name="airway_obstruksi" value="Obstruksi" <?php if (@$asesmen['airway_obstruksi']=='Obstruksi') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="airway_obstruksi">Obstruksi</label>
      <div class="row">
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="airway_obstruksi1" name="sub_obstruksi" value="Muntahan" <?php if (@$asesmen['sub_obstruksi']=='Muntahan') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="airway_obstruksi1">Muntahan</label>
        </div>
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="airway_obstruksi2" name="sub_obstruksi" value="Sekret" <?php if (@$asesmen['sub_obstruksi']=='Sekret') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="airway_obstruksi2">Sekret</label>
        </div>
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="airway_obstruksi3" name="sub_obstruksi" value="Darah" <?php if (@$asesmen['sub_obstruksi']=='Darah') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="airway_obstruksi3">Darah</label>
        </div>
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="airway_obstruksi4" name="sub_obstruksi" value="Lidah" <?php if (@$asesmen['sub_obstruksi']=='Lidah') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="airway_obstruksi4">Lidah</label>
        </div>
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="airway_obstruksi5" name="sub_obstruksi" value="Benda Asing" <?php if (@$asesmen['sub_obstruksi']=='Benda Asing') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="airway_obstruksi5">Benda Asing</label>
        </div>
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="text" name="lain_sub_obstruksi" value="" placeholder="Lainnya ..." class="form-control">
        </div>
      </div>
    </div>

    <div class="col-sm-12">
      <br>
      <h4>2. BREATHING</h4>
    </div>
    <div class="col-sm-12 col-lg-12 custom-control custom-radio">
      <input type="radio" id="airway_polanafas" name="airway_polanafas" value="polanafas" <?php if (@$asesmen['airway_polanafas']=='polanafas') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="airway_polanafas">Pola Nafas</label>
      <div class="row">
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="airway_polanafas1" name="sub_polanafas" value="Sesak" <?php if (@$asesmen['sub_polanafas']=='Sesak') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="airway_polanafas1">Sesak</label>
        </div>
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="airway_polanafas2" name="sub_polanafas" value="Asimetris" <?php if (@$asesmen['sub_polanafas']=='Asimetris') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="airway_polanafas2">Asimetris</label>
        </div>
        <div class="col-12 col-lg-12 input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Frekuensi :</span>
          </div>
          <input type="text" class="form-control" aria-label="" name="polanafas_frekuensi" value="<?php echo @$asesmen['bb'] ?>">
          <div class="input-group-prepend">
            <span class="input-group-text">/mnt</span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-lg-12 custom-control custom-radio">
      <input type="radio" id="airway_suaranafas" name="airway_suaranafas" value="Suara Nafas" <?php if (@$asesmen['airway_suaranafas']=='Suara Nafas') {echo "checked";} ?> class="custom-control-input">
      <label class="custom-control-label" for="airway_suaranafas">Suara Nafas</label>
      <div class="row">
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="airway_suaranafas1" name="sub_suaranafas" value="Vesikuler" <?php if (@$asesmen['sub_suaranafas']=='Vesikuler') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="airway_suaranafas1">Vesikuler</label>
        </div>
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="airway_suaranafas2" name="sub_suaranafas" value="Broncho Vesikuler" <?php if (@$asesmen['sub_suaranafas']=='Broncho Vesikuler') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="airway_suaranafas2">Broncho Vesikuleretris</label>
        </div>
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="airway_suaranafas3" name="sub_suaranafas" value="Bronchiale" <?php if (@$asesmen['sub_suaranafas']=='Bronchiale') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="airway_suaranafas3">Bronchiale</label>
        </div>
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="airway_suaranafas4" name="sub_suaranafas" value="Ronchi" <?php if (@$asesmen['sub_suaranafas']=='Ronchi') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="airway_suaranafas4">Ronchi</label>
        </div>
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="airway_suaranafas5" name="sub_suaranafas" value="Rales" <?php if (@$asesmen['sub_suaranafas']=='Rales') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="airway_suaranafas5">Rales</label>
        </div>
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="airway_suaranafas6" name="sub_suaranafas" value="Wheezing" <?php if (@$asesmen['sub_suaranafas']=='Wheezing') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="airway_suaranafas6">Wheezing</label>
        </div>
      </div>
    </div>

    <div class="col-sm-12">
      <br>
      <h4>3. CIRCULATION</h4>
    </div>
    <!-- <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">TD :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="circulationtd" value="<?php echo @$asesmen['circulationtd'] ?>">
      <div class="input-group-prepend">
        <span class="input-group-text">mmHg</span>
      </div>
    </div> -->

        <h6>Kesadaran</h6>
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">

          <div class="row">
            <div class="col-sm-12 col-lg-12 custom-control custom-radio">
              <input type="radio" id="Kesadaran1" name="kesadaran" value="KOMPOMENTIS" <?php if (@$asesmen['kesadaran']=='KOMPOMENTIS') {echo "checked";} ?> class="custom-control-input">
              <label class="custom-control-label" for="Kesadaran1">KOMPOMENTIS (CM)</label>
            </div>
            <div class="col-sm-12 col-lg-12 custom-control custom-radio">
              <input type="radio" id="Kesadaran2" name="kesadaran" value="SOMNOLENSE" <?php if (@$asesmen['kesadaran']=='SOMNOLENSE') {echo "checked";} ?> class="custom-control-input">
              <label class="custom-control-label" for="Kesadaran2">SOMNOLENSE</label>
            </div>
            <div class="col-sm-12 col-lg-12 custom-control custom-radio">
              <input type="radio" id="Kesadaran3" name="kesadaran" value="STUPOR" <?php if (@$asesmen['kesadaran']=='STUPOR') {echo "checked";} ?> class="custom-control-input">
              <label class="custom-control-label" for="Kesadaran3">STUPOR</label>
            </div>
            <div class="col-sm-12 col-lg-12 custom-control custom-radio">
              <input type="radio" id="Kesadaran4" name="kesadaran" value="KOMA" <?php if (@$asesmen['kesadaran']=='KOMA') {echo "checked";} ?> class="custom-control-input">
              <label class="custom-control-label" for="Kesadaran4">KOMA</label>
            </div>
          </div>
        </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Suhu :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="suhu" value="<?php echo @$asesmen['suhu'] ?>">
      <div class="input-group-prepend">
        <span class="input-group-text">*C</span>
      </div>
    </div>

    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Sistole :</span>
      </div>
      <input type="number" class="form-control" aria-label="" name="siastole" value="<?php echo @$asesmen['siastole'] ?>">
      <div class="input-group-prepend">
        <span class="input-group-text"></span>
      </div>
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Diastole :</span>
      </div>
      <input type="number" class="form-control" aria-label="" name="diastole" value="<?php echo @$asesmen['diastole'] ?>">
      <div class="input-group-append">
        <span class="input-group-text"></span>
      </div>
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Nadi :</span>
      </div>
      <input type="number" class="form-control" aria-label="" name="nadi" value="<?php echo @$asesmen['nadi'] ?>">
      <div class="input-group-prepend">
        <span class="input-group-text">x/mnt</span>
      </div>
    </div>
    <div class="col-12 col-lg-12 m-b-10 input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">RR : </span>
      </div>
      <input type="text" class="form-control" aria-label="" name="rr" value="<?php echo @$asesmen['rr'] ?>">
      <div class="input-group-append">
        <span class="input-group-text">x/mnt</span>
      </div>
    </div>

    <h6>Perfusi</h6>
    <div class="col-sm-12 col-lg-12 custom-control custom-radio">

      <div class="row">
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="sub_perfusi1" name="sub_perfusi" value="Hangat Kering Merah" <?php if (@$asesmen['sub_perfusi']=='Hangat Kering Merah') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="sub_perfusi1">Hangat Kering Merah</label>
        </div>
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="sub_perfusi2" name="sub_perfusi" value="Dingin Basah Pucat" <?php if (@$asesmen['sub_perfusi']=='Dingin Basah Pucat') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="sub_perfusi2">Dingin Basah Pucat</label>
        </div>
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="sub_perfusi3" name="sub_perfusi" value="Dingin Basah Merah" <?php if (@$asesmen['sub_perfusi']=='Dingin Basah Merah') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="sub_perfusi3">Dingin Basah Merah</label>
        </div>
      </div>
    </div>

    <h6>Capilary Refil Time</h6>
    <div class="col-sm-12 col-lg-12 custom-control custom-radio">
      <div class="row">
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="sub_capilary1" name="sub_capilary" value="Hangat Kering Merah" <?php if (@$asesmen['sub_capilary']=='>3dtk') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="sub_capilary1"> > 3 dtk</label>
        </div>
        <div class="col-sm-12 col-lg-12 custom-control custom-radio">
          <input type="radio" id="sub_capilary2" name="sub_capilary" value="Dingin Basah Pucat" <?php if (@$asesmen['sub_capilary']=='<3dtk') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="sub_capilary2"> < 3 dtk</label>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Bunyi Jantung :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="bunyijantung" value="<?php echo @$asesmen['bunyijantung'] ?>">
    </div>

    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Turgor :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="turgor" value="<?php echo @$asesmen['turgor'] ?>">
    </div>

    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Mokusa Mulut :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="mokusamulut" value="<?php echo @$asesmen['mokusamulut'] ?>">
    </div>

    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">BAB :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="bab" value="<?php echo @$asesmen['bab'] ?>">
    </div>

    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">BAK :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="bak" value="<?php echo @$asesmen['bak'] ?>">
    </div>

    <div class="col-sm-12">
      <br>
      <h4>4. DISABILITY</h4>
    </div>
    <h6>Tingkat Kesadaran</h6>
    <div class="col-sm-12 col-lg-12 m-b-10">
      <div class="row custom-control custom-radio">
        <div class="col-sm-12 col-lg-6 custom-control custom-radio">
          <input type="radio" id="sub_tingkatkesadaran1" name="sub_tingkatkesadaran" value="Alert" <?php if (@$asesmen['sub_tingkatkesadaran1']=='Alert') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="sub_tingkatkesadaran1">Alert</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-radio">
          <input type="radio" id="sub_tingkatkesadaran2" name="sub_tingkatkesadaran" value="Pain" <?php if (@$asesmen['sub_tingkatkesadaran2']=='Pain') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="sub_tingkatkesadaran2">Pain</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-radio">
          <input type="radio" id="sub_tingkatkesadaran3" name="sub_tingkatkesadaran" value="Verbal" <?php if (@$asesmen['sub_tingkatkesadaran3']=='Verbal') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="sub_tingkatkesadaran3">Verbal</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-radio">
          <input type="radio" id="sub_tingkatkesadaran4" name="sub_tingkatkesadaran" value="Verbal" <?php if (@$asesmen['sub_tingkatkesadaran4']=='Unrespon') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="sub_tingkatkesadaran4">Unrespon</label>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-md-12">
      <label class=" form-control-label">GCS :</label>
    </div>
      <div class="col-12 col-lg-12 input-group m-b-5">
        <div class="input-group-prepend">
          <span class="input-group-text">E :</span>
        </div>
        <input type="number" min="1" max="4" class="eb form-control" aria-label="" name="GCS_E2" value="<?php echo @$asesmen['GCS_E2'] ?>">

      </div>
      <div class="col-12 col-lg-12 input-group m-b-5">
        <div class="input-group-prepend">
          <span class="input-group-text">M :</span>
        </div>
        <input type="number" min="1" max="5" class="mb form-control" aria-label="" name="GCS_M2" value="<?php echo @$asesmen['GCS_M2'] ?>">
      </div>
      <div class="col-12 col-lg-12 input-group m-b-5">
        <div class="input-group-prepend">
          <span class="input-group-text">V :</span>
        </div>
        <input type="number" min="1" max="6" class="vb form-control" aria-label="" name="GCS_V2" value="<?php echo @$asesmen['GCS_V2'] ?>">
      </div>
    <div class="col-12 col-lg-12 input-group m-b-5">
      <div class="input-group-prepend">
        <span class="input-group-text">Pupil :</span>
      </div>
      <input type="text" class="pupil_b form-control" aria-label="" name="pupil" value="<?php echo @$asesmen['pupil'] ?>">
    </div>

    <div class="col-12 col-lg-12 input-group p-b-10 m-b-5">
      <div class="input-group-prepend">
        <span class="input-group-text">Refleksi Cahaya : +/- :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="rc" value="<?php echo @$asesmen['rc'] ?>">
    </div>

    <div class="col-sm-12">
      <br>
      <h4>5. EXPOSURE</h4>
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Kepala :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="kepala" value="<?php echo @$asesmen['kepala'] ?>">
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Leher :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="leher" value="<?php echo @$asesmen['leher'] ?>">
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Dada :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="dada" value="<?php echo @$asesmen['dada'] ?>">
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Perut :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="perut" value="<?php echo @$asesmen['perut'] ?>">
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Extermitas :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="extermitas" value="<?php echo @$asesmen['extermitas'] ?>">
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Derajat Luka Bakar :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="dlukabakar" value="<?php echo @$asesmen['dlukabakar'] ?>">
    </div>
    <h6>Nyeri</h6>
    <div class="row">
      <div class="col-12 col-lg-12 input-group p-b-10">
        <div class="input-group-prepend">
          <span class="input-group-text">Skala :</span>
        </div>
        <input type="text" class="form-control" aria-label="" name="skala" value="<?php echo @$asesmen['skala'] ?>">
      </div>
      <div class="col-12 col-lg-12 input-group p-b-10">
        <div class="input-group-prepend">
          <span class="input-group-text">Lokasi :</span>
        </div>
        <input type="text" class="form-control" aria-label="" name="lokasi" value="<?php echo @$asesmen['lokasi'] ?>">
      </div>
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Fraktur :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="fraktur" value="<?php echo @$asesmen['fraktur'] ?>">
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Dislokasi :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="dislokasi" value="<?php echo @$asesmen['dislokasi'] ?>">
    </div>

    <div class="col-sm-12">
      <br>
      <h4>6. INTOKSIKASI</h4>
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Makanan :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="makanan" value="<?php echo @$asesmen['makanan'] ?>">
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Gigitan Binatang :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="gigitanbinatang" value="<?php echo @$asesmen['gigitanbinatang'] ?>">
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Zat Kimia :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="zatkimia" value="<?php echo @$asesmen['zatkimia'] ?>">
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Narkotik :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="narkotik" value="<?php echo @$asesmen['narkotik'] ?>">
    </div>

    <div class="col-sm-12">
      <br>
      <h4>7. PSIKO, SOSIO, SPIRITUAL</h4>
    </div>
    <div class="col-sm-12 col-lg-12 ">
      <div class="row custom-control custom-checkbox">
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input type="checkbox" id="takgelisah" name="takgelisah" value="Tak Gelisah" <?php if (@$asesmen['takgelisah']=='Tak Gelisah') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="takgelisah">Tak Gelisah</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input type="checkbox" id="rendahdiri" name="rendahdiri" value="Rendah Diri" <?php if (@$asesmen['rendahdiri']=='Rendah Diri') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="rendahdiri">Rendah Diri</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input type="checkbox" id="sedih" name="sedih" value="Sedih" <?php if (@$asesmen['sedih']=='Sedih') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="sedih">Sedih</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input type="checkbox" id="menarikdiri" name="menarikdiri" value="Menarik Diri" <?php if (@$asesmen['menarikdiri']=='Menarik Diri') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="menarikdiri">Menarik Diri</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input type="checkbox" id="takut" name="takut" value="Takut" <?php if (@$asesmen['takut']=='Takut') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="takut">Takut</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input type="checkbox" id="gelisah" name="gelisah" value="Gelisah" <?php if (@$asesmen['gelisah']=='Gelisah') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="gelisah">Gelisah</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input type="checkbox" id="marah" name="marah" value="Marah" <?php if (@$asesmen['marah']=='marah') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="marah">Marah</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input type="checkbox" id="kombaik" name="kombaik" value="Komunikasi Baik" <?php if (@$asesmen['komunikasibaik']=='Komunikasi Baik') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="kombaik">Komunikasi Baik</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input type="checkbox" id="bantuanspiritual" name="bantuanspiritual" value="Bantuan Spriritual" <?php if (@$asesmen['bantuanspiritual']=='Bantuan Spriritual') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="bantuanspiritual">Bantuan Spriritual</label>
        </div>
      </div>
    </div>

    <div class="col-sm-12">
      <br>
      <h4>8. OBGYN</h4>
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Gravida :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="gravida" value="<?php echo @$asesmen['gravida'] ?>">
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Tafsiran Persalinan :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="taper" value="<?php echo @$asesmen['taper'] ?>">
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Pembukaan :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="pembukaan" value="<?php echo @$asesmen['pembukaan'] ?>">
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Ketuban +/- :</span>
      </div>
      <input type="text" class="form-control" aria-label="" name="ketuban" value="<?php echo @$asesmen['ketuban'] ?>">
    </div>
  </div>
</div>
