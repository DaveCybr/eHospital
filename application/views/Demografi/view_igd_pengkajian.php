<div class="card border-info" style="border: 2px solid;">
  <div class="card-header bg-info text-white">
    <strong>PENGKAJIAN</strong>
  </div>
  <div class="card-body card-block row">
    <div class="col-sm-12">
      <h4>1. AIRWAY</h4>
    </div>
    <input disabled type="text" name="keluhan" class="form-control" value="<?php echo @$asesmen['airway_bebas']."".@$asesmen['airway_obstruksi']." ".@$asesmen['sub_obstruksi']."".@$asesmen['lain_sub_obstruksi']?>" readonly>


    <div class="col-sm-12">
      <br>
      <h4>2. BREATHING</h4>
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Pola Nafas</span>
      </div>
      <input disabled type="text" class="form-control" readonly aria-label="" name="polanafas_frekuensi" value="<?php echo @$asesmen['airway_polanafas'] ?>">

    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Frekuensi :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="polanafas_frekuensi" value="<?php echo @$asesmen['polanafas_frekuensi'] ?>">
      <div class="input-group-prepend">
        <span class="input-group-text">/mnt</span>
      </div>
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Suara Nafas</span>
      </div>
      <input disabled type="text" class="form-control" readonly aria-label="" name="polanafas_frekuensi" value="<?php echo @$asesmen['sub_suaranafas'] ?>">

    </div>


    <div class="col-sm-12">
      <br>
      <h4>3. CIRCULATION</h4>
    </div>

        <h6>Kesadaran</h6>
        <input disabled type="text" class="form-control mb-3" readonly aria-label="" name="polanafas_frekuensi" value="<?php echo @$asesmen['kesadaran'] ?>">

    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Suhu :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="suhu" value="<?php echo @$asesmen['suhu'] ?>">
      <div class="input-group-prepend">
        <span class="input-group-text">*C</span>
      </div>
    </div>

    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Sistole :</span>
      </div>
      <input disabled type="number" class="form-control" readonly aria-label="" name="siastole" value="<?php echo @$asesmen['sistole'] ?>">
      <div class="input-group-prepend">
        <span class="input-group-text"></span>
      </div>
    </div>
    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Diastole :</span>
      </div>
      <input disabled type="number" readonly class="form-control" aria-label="" name="diastole" value="<?php echo @$asesmen['diastole'] ?>">
      <div class="input-group-append">
        <span class="input-group-text"></span>
      </div>
    </div>
    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Nadi :</span>
      </div>
      <input disabled type="number" readonly class="form-control" aria-label="" name="nadi" value="<?php echo @$asesmen['nadi'] ?>">
      <div class="input-group-prepend">
        <span class="input-group-text">x/mnt</span>
      </div>
    </div>
    <div class="m-b-10 input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">RR : </span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="rr" value="<?php echo @$asesmen['rr'] ?>">
      <div class="input-group-append">
        <span class="input-group-text">x/mnt</span>
      </div>
    </div>

    <h6>Perfusi</h6>
    <input disabled type="text" class="form-control mb-3" readonly aria-label="" name="siastole" value="<?php echo @$asesmen['sub_perfusi'] ?>">


    <h6>Capilary Refil Time</h6>
    <input disabled type="text" class="form-control mb-3" readonly aria-label="" name="siastole" value="<?php echo @$asesmen['sub_capilary'] ?>">


    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Bunyi Jantung :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="bunyijantung" value="<?php echo @$asesmen['bunyijantung'] ?>">
    </div>

    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Turgor :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="turgor" value="<?php echo @$asesmen['turgor'] ?>">
    </div>

    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Mokusa Mulut :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="mokusamulut" value="<?php echo @$asesmen['mokusamulut'] ?>">
    </div>

    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">BAB :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="bab" value="<?php echo @$asesmen['bab'] ?>">
    </div>

    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">BAK :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="bak" value="<?php echo @$asesmen['bak'] ?>">
    </div>

    <div class="col-sm-12">
      <br>
      <h4>4. DISABILITY</h4>
    </div>
    <h6>Tingkat Kesadaran</h6>
    <input disabled type="text" class="form-control mb-3" readonly aria-label="" name="siastole" value="<?php echo @$asesmen['sub_tingkatkesadaran'] ?>">

    <div class="col-sm-12 col-md-12">
      <label class=" form-control-label">GCS :</label>
    </div>
    <div class="col-sm-12 col-lg-12 row mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">E :</span>
        </div>
        <input disabled type="text" readonly class="eb form-control" aria-label="" name="GCS_E2" value="<?php echo @$asesmen['GCS_E2'] ?>">
        <div class="input-group-prepend">
          <span class="input-group-text">V :</span>
        </div>
        <input disabled type="text" readonly class="vb form-control" aria-label="" name="GCS_V2" value="<?php echo @$asesmen['GCS_V2'] ?>">
        <div class="input-group-prepend">
          <span class="input-group-text">M :</span>
        </div>
        <input disabled type="text" class="mb form-control" aria-label="" name="GCS_M2" value="<?php echo @$asesmen['GCS_M2'] ?>" readonly>
      </div>
    </div>
    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Pupil :</span>
      </div>
      <input disabled type="text" readonly class="pupil_b form-control" aria-label="" name="pupil" value="<?php echo @$asesmen['pupil'] ?>">
    </div>

    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Refleksi Cahaya : +/- :</span>
      </div>
      <input disabled type="text" class="form-control" readonly aria-label="" name="rc" value="<?php echo @$asesmen['rc'] ?>">
    </div>

    <div class="col-sm-12">
      <br>
      <h4>5. EXPOSURE</h4>
    </div>
    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Kepala :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="kepala" value="<?php echo @$asesmen['kepala'] ?>">
    </div>
    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Leher :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="leher" value="<?php echo @$asesmen['leher'] ?>">
    </div>
    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Dada :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="dada" value="<?php echo @$asesmen['dada'] ?>">
    </div>
    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Perut :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="perut" value="<?php echo @$asesmen['perut'] ?>">
    </div>
    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Extermitas :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="extermitas" value="<?php echo @$asesmen['extermitas'] ?>">
    </div>
    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Derajat Luka Bakar :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="dlukabakar" value="<?php echo @$asesmen['dlukabakar'] ?>">
    </div>
    <h6>Nyeri</h6>
    <!-- <div class="row"> -->
      <div class="input-group p-b-10">
        <div class="input-group-prepend">
          <span class="input-group-text">Skala :</span>
        </div>
        <input disabled type="text" readonly class="form-control" aria-label="" name="skala" value="<?php echo @$asesmen['skala'] ?>">
      </div>
      <div class="input-group p-b-10">
        <div class="input-group-prepend">
          <span class="input-group-text">Lokasi :</span>
        </div>
        <input disabled type="text" readonly class="form-control" aria-label="" name="lokasi" value="<?php echo @$asesmen['lokasi'] ?>">
      </div>
    <!-- </div> -->
    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Fraktur :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="fraktur" value="<?php echo @$asesmen['fraktur'] ?>">
    </div>
    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Dislokasi :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="dislokasi" value="<?php echo @$asesmen['dislokasi'] ?>">
    </div>

    <div class="col-sm-12">
      <br>
      <h4>6. INTOKSIKASI</h4>
    </div>
    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Makanan :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="makanan" value="<?php echo @$asesmen['makanan'] ?>">
    </div>
    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Gigitan Binatang :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="gigitanbinatang" value="<?php echo @$asesmen['gigitanbinatang'] ?>">
    </div>
    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Zat Kimia :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="zatkimia" value="<?php echo @$asesmen['zatkimia'] ?>">
    </div>
    <div class="input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Narkotik :</span>
      </div>
      <input disabled type="text" readonly class="form-control" aria-label="" name="narkotik" value="<?php echo @$asesmen['narkotik'] ?>">
    </div>

    <div class="col-sm-12">
      <br>
      <h4>7. PSIKO, SOSIO, SPIRITUAL</h4>
    </div>
    <div class="col-sm-12 col-lg-12 ">
      <div class="row custom-control custom-checkbox">
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input disabled type="checkbox" id="takgelisah" name="takgelisah" value="Tak Gelisah" disabled <?php echo @$asesmen['takgelisah']!==NULL?'checked':''?> class="custom-control-input">
          <label class="custom-control-label" for="takgelisah">Tak Gelisah</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input disabled type="checkbox" id="rendahdiri" name="rendahdiri" value="Rendah Diri" disabled <?php echo @$asesmen['rendahdiri']!==NULL?'checked':''?> class="custom-control-input">
          <label class="custom-control-label" for="rendahdiri">Rendah Diri</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input disabled type="checkbox" id="sedih" name="sedih" value="Sedih" disabled <?php echo @$asesmen['sedih']!==NULL?'checked':''?> class="custom-control-input">
          <label class="custom-control-label" for="sedih">Sedih</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input disabled type="checkbox" id="menarikdiri" name="menarikdiri" disabled value="Menarik Diri" <?php echo @$asesmen['menarikdiri']!==NULL?'checked':''?> class="custom-control-input">
          <label class="custom-control-label" for="menarikdiri">Menarik Diri</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input disabled type="checkbox" id="takut" name="takut" value="Takut" disabled <?php echo @$asesmen['takut']!==NULL?'checked':''?> class="custom-control-input">
          <label class="custom-control-label" for="takut">Takut</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input disabled type="checkbox" id="gelisah" name="gelisah" value="Gelisah" disabled <?php if (@$asesmen['gelisah']=='Gelisah') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="gelisah">Gelisah</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input disabled type="checkbox" id="marah" name="marah" value="Marah" disabled <?php if (@$asesmen['marah']=='marah') {echo "checked";} ?> class="custom-control-input">
          <label class="custom-control-label" for="marah">Marah</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input disabled type="checkbox" id="kombaik" name="kombaik" value="Komunikasi Baik" disabled <?php echo @$asesmen['kombaik']!==NULL?'checked':''?> class="custom-control-input">
          <label class="custom-control-label" for="kombaik">Komunikasi Baik</label>
        </div>
        <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
          <input disabled type="checkbox" id="bantuanspiritual" name="bantuanspiritual" disabled value="Bantuan Spriritual" <?php if (@$asesmen['bantuanspiritual']=='Bantuan Spriritual') {echo "checked";} ?> class="custom-control-input">
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
      <input disabled type="text" class="form-control" aria-label="" readonly name="gravida" value="<?php echo @$asesmen['gravida'] ?>">
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Tafsiran Persalinan :</span>
      </div>
      <input disabled type="text" class="form-control" aria-label="" readonly name="taper" value="<?php echo @$asesmen['taper'] ?>">
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Pembukaan :</span>
      </div>
      <input disabled type="text" class="form-control" aria-label="" readonly name="pembukaan" value="<?php echo @$asesmen['pembukaan'] ?>">
    </div>
    <div class="col-12 col-lg-12 input-group p-b-10">
      <div class="input-group-prepend">
        <span class="input-group-text">Ketuban +/- :</span>
      </div>
      <input disabled type="text" class="form-control" aria-label="" readonly name="ketuban" value="<?php echo @$asesmen['ketuban'] ?>">
    </div>
  </div>
</div>
