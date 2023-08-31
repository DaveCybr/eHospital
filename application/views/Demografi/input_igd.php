<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>ASESMEN GAWAT DARURAT</strong>
              <small> Form</small>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('Asesmen/insert_igd');?>
              <?php echo @$error;?>
              <div class="card-body card-block">
                <div class="row form-group">
                  <div class="col col-md-2">
                    <label for="nokun" class=" form-control-label">NO.Kunjungan :</label>
                  </div>
                  <div class="col-12 col-md-4">
                    <input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$kunjungan['no_urutkunjungan']; ?>" required readonly>
                  </div>
                  <div class="col col-md-1">
                    <label for="tanggal" class=" form-control-label">Tanggal</label>
                  </div>
                  <div class="col-12 col-md-4">
                    <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo @$kunjungan['tgl']; ?>" required readonly>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-2">
                    <label for="norm" class=" form-control-label">Pasien :</label>
                  </div>
                  <div class="col-12 col-md-3">
                    <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" required readonly>
                  </div>
                  <div class="col-12 col-md-4">
                    <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo @$pasien['namapasien']; ?>" required readonly>
                  </div>
                  <div class="col-12 col-md-3">
                    <input type="text" name="jenis_kunjungan" id="jenis_kunjungan" class="form-control" placeholder="jenis_kunjungan" value="<?php echo @$jenispasien['jenis_pasien']; ?>" required readonly>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>ASESMEN AWAL KEPERAWATAN</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row form-group">
                          <div class="col col-md-3 text-right">
                            <label class=" form-control-label">Tanggal Kunjungan :</label>
                          </div>
                          <div class="input-group mb-3 col-md-6">
                            <input type="date" class="form-control" aria-label="" name="tanggal_kunjungan" value="<?php echo date('Y-m-d') ?>">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Pukul : </span>
                            </div>
                            <input type="time" class="form-control" aria-label="" name="tanggal_jam_kunjungan" value="<?php echo date('H:i:s') ?>">
                            <div class="input-group-append">
                              <span class="input-group-text">WIB</span>
                            </div>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-3 text-right">
                            <label class=" form-control-label">Sumber Data :</label>
                          </div>
                          <div class="input-group mb-3 col-md-9">
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="sumberdata1" name="sumberdata" checked class="custom-control-input" value="Pasien" <?php if (@$asesmen['sumberdata']=='Pasien') {echo "checked";}?> >
                              <label class="custom-control-label" for="sumberdata1">Pasien</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="sumberdata2" name="sumberdata" class="custom-control-input" value="Keluarga" <?php if (@$asesmen['sumberdata']=='Keluarga') {echo "checked";}?> >
                              <label class="custom-control-label" for="sumberdata2">Keluarga</label>
                            </div>
                            <div class="col-12 col-lg-6 custom-control custom-radio">
                              <input type="radio" id="sumberdata3" name="sumberdata" class="custom-control-input" value="lain" <?php if (@$asesmen['sumberdata']=='lain') {echo "checked";}?> >
                              <label class="custom-control-label" for="sumberdata3">
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Lainnya : </span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="sumberdatalain" value="">
                                </div>
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-3 text-right">
                            <label class=" form-control-label">Rujukan :</label>
                          </div>
                          <div class="input-group mb-3 col-md-9">
                            <div class="col-12 col-lg-1 custom-control custom-radio">
                              <input type="radio" id="rujukan1" name="rujukan" class="custom-control-input" value="Ya" <?php if (@$asesmen['rujukan']=='Ya') {echo "checked";}?> >
                              <label class="custom-control-label" for="rujukan1">ya</label>
                            </div>
                            <div class="col-12 col-lg-1 custom-control custom-radio">
                              <input type="radio" id="rujukan2" name="rujukan" class="custom-control-input" value="Tidak" <?php if (@$asesmen['rujukan']!='Ya') {echo "checked";}?> >
                              <label class="custom-control-label" for="rujukan2">tidak</label>
                            </div>
                            <div class="input-group mb-3 col-md-9">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Dokter : </span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="rujukandokter" value="<?php echo @$asesmen['rujukandokter']?>">
                              <div class="input-group-prepend">
                                <span class="input-group-text">RS : </span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="rujukanrs" value="<?php echo @$asesmen['rujukanrs'] ?>">
                              <div class="input-group-append">
                                <span class="input-group-text">Lainnya</span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="rujukanlain" value="<?php echo @$asesmen['rujukanlain'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-3 text-right">
                            <label class=" form-control-label">Diagnosa Rujukan :</label>
                          </div>
                          <div class="col-md-8">
                            <input type="text" name="diagnosa_rujukan" value="<?php echo @$asesmen['diagnosa_rujukan']; ?>" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>ASESMEN GAWAT DARURAT</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">Keluhan Utama:</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <textarea class="form-control" rows="2" name="keluhan_utama"<?php echo @$asesmen['keluhan_utama']; ?>></textarea>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">Riwayat Penyakit:</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <textarea class="form-control" rows="4" name="riwayat_penyakit"><?php echo @$asesmen['riwayat_penyakit']; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>PRIMARY SURVEY</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">AIRWAY:</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="airway1" name="airway" class="custom-control-input" value="Bebas" <?php if (@$asesmen['airway']=='Bebas' || @$asesmen['airway']==null) {echo "checked";} ?>>
                              <label class="custom-control-label" for="airway1">Bebas</label>
                            </div>
                            <div class="col-12 col-lg-3 custom-control custom-radio">
                              <input type="radio" id="airway2" name="airway" class="custom-control-input" value="Gargling" <?php if (@$asesmen['airway']=='Gargling') {echo "checked";} ?>>
                              <label class="custom-control-label" for="airway2">Gargling</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="airway3" name="airway" class="custom-control-input" value="Wheezing" <?php if (@$asesmen['airway']=='Wheezing') {echo "checked";} ?>>
                              <label class="custom-control-label" for="airway3">Wheezing</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="airway4" name="airway" class="custom-control-input" value="Rhonci" <?php if (@$asesmen['airway']=='Rhonci') {echo "checked";} ?>>
                              <label class="custom-control-label" for="airway4">Rhonci</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="airway5" name="airway" class="custom-control-input" value="Stridor" <?php if (@$asesmen['airway']=='Stridor') {echo "checked";} ?>>
                              <label class="custom-control-label" for="airway5">Stridor</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="airway6" name="airway" class="custom-control-input" value="Snoring" <?php if (@$asesmen['airway']=='Snoring') {echo "checked";} ?>>
                              <label class="custom-control-label" for="airway6">Snoring</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="airway7" name="airway" class="custom-control-input" value="Terintubasi" <?php if (@$asesmen['airway']=='Terintubasi') {echo "checked";} ?>>
                              <label class="custom-control-label" for="airway7">Terintubasi</label>
                            </div>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">BREATHING :</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="breathing1" name="breathing" value="Spontan" <?php if (@$asesmen['breathing']=='Spontan'|| @$asesmen['breathing']==null) {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="breathing1">Spontan</label>
                            </div>
                            <div class="col-12 col-lg-3 custom-control custom-radio">
                              <input type="radio" id="breathing2" name="breathing" value="Tachipneu" <?php if (@$asesmen['breathing']=='Tachipneu') {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="breathing2">Tachipneu</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="breathing3" name="breathing" value="Dispneu" <?php if (@$asesmen['breathing']=='Dispneu') {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="breathing3">Dispneu</label>
                            </div>
                            <div class="col-12 col-lg-5 custom-control custom-radio">
                              <input type="radio" id="breathing4" name="breathing" value="Ventilasi Mekanik" <?php if (@$asesmen['breathing']=='Ventilasi Mekanik') {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="breathing4">Ventilasi Mekanik</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="breathing5" name="breathing" value="Memakai Ventilator" <?php if (@$asesmen['breathing']=='Memakai Ventilator') {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="breathing5">Memakai Ventilator</label>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-6">
                            <div class="card border-info" style="border: 2px solid;">
                              <div class="card-header bg-info text-white">
                                <strong>CIRCULATION</strong>
                              </div>
                              <div class="card-body card-block">
                                <div class="row form-group">
                                  <!-- <div class="col col-md-2">
                                    <label class=" form-control-label">Sistole :</label>
                                  </div>
                                  <div class="col-sm-12 col-lg-10 row p-b-10">
                                    <div class="col-12 col-lg-9 input-group">
                                      <input type="text" class="form-control" aria-label="" name="sistole" value="<?php echo @$asesmen['sistole'] ?>">
                                    </div>
                                  </div>
                                  <div class="col col-md-2">
                                    <label class=" form-control-label">Diastole :</label>
                                  </div>
                                  <div class="col-sm-12 col-lg-10 row p-b-10">
                                    <div class="col-12 col-lg-9 input-group">
                                      <input type="text" class="form-control" aria-label="" name="diastole" value="<?php echo @$asesmen['diastole'] ?>">
                                    </div>
                                  </div> -->

                                  <div class="col-sm-12 col-md-2">
                                    <label class=" form-control-label">N :</label>
                                  </div>
                                  <div class="col-sm-12 col-lg-10 row">
                                    <div class="col-12 col-lg-12 input-group">
                                      <div class="col-6 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="n1" name="n" value="Kuat" <?php if (@$asesmen['n']=='Kuat') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="n1">Kuat</label>
                                      </div>
                                      <div class="col-6 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="n2" name="n" value="Lemah" <?php if (@$asesmen['n']=='Lemah') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="n2">Lemah</label>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-sm-12 col-md-2">
                                    <label class=" form-control-label">CRT :</label>
                                  </div>
                                  <div class="col-12 col-md-10 row">
                                    <div class="col-12 col-lg-10 input-group">
                                      <div class="col-6 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="crt1" name="crt" value="< 3" <?php if (@$asesmen['crt']=='< 3') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="crt1">< 3</label>
                                      </div>
                                      <div class="col-6 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="crt2" name="crt" value="> 3" <?php if (@$asesmen['crt']=='> 3') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="crt2">> 3</label>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-sm-12 col-md-3">
                                    <label class=" form-control-label">Warna Kulit :</label>
                                  </div>
                                  <div class="col-sm-12 col-md-9 row">
                                    <input type="text" class="form-control" aria-label="" name="warna_kulit" value="<?php echo @$asesmen['warna_kulit'] ?>">
                                  </div>

                                  <div class="col-sm-12 col-md-3">
                                    <label class=" form-control-label">pendarahan :</label>
                                  </div>
                                  <div class="col-sm-12 col-md-9 row">
                                    <div class="col-12 col-lg-12 input-group">
                                      <div class="col-sm-6 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="pendarahan1" name="pendarahan" value="Gr I" <?php if (@$asesmen['pendarahan']=='Gr I') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="pendarahan1">Gr I</label>
                                      </div>
                                      <div class="col-sm-6 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="pendarahan2" name="pendarahan" value="Gr II" <?php if (@$asesmen['pendarahan']=='Gr II') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="pendarahan2">Gr II</label>
                                      </div>
                                      <div class="col-6 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="pendarahan3" name="pendarahan" value="Gr III" <?php if (@$asesmen['pendarahan']=='Gr III') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="pendarahan3">Gr III</label>
                                      </div>
                                      <div class="col-6 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="pendarahan4" name="pendarahan" value="Gr IV" <?php if (@$asesmen['pendarahan']=='Gr IV') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="pendarahan4">Gr II</label>
                                      </div>
                                      <div class="col-6 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="pendarahan5" name="pendarahan" value="Teratasi" <?php if (@$asesmen['pendarahan']=='Teratasi') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="pendarahan5">Teratasi</label>
                                      </div>
                                      <div class="col-6 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="pendarahan6" name="pendarahan" value="Tidak Teratasi" <?php if (@$asesmen['pendarahan']=='Tidak Teratasi') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="pendarahan6">Tidak Teratasi</label>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-sm-12 col-md-3">
                                    <label class=" form-control-label">Turgor Kulit :</label>
                                  </div>
                                  <div class="col-sm-12 col-md-9 row">
                                    <div class="col-12 col-lg-12 input-group">
                                      <div class="col-sm-12 col-lg-4 custom-control custom-radio">
                                        <input type="radio" id="tugor_kulit1" name="tugor_kulit" value="Baik" <?php if (@$asesmen['tugor_kulit']=='Baik') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="tugor_kulit1">Baik</label>
                                      </div>
                                      <div class="col-sm-12 col-lg-4 custom-control custom-radio">
                                        <input type="radio" id="tugor_kulit2" name="tugor_kulit" value="Sedang" <?php if (@$asesmen['tugor_kulit']=='Sedang') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="tugor_kulit2">Sedang</label>
                                      </div>
                                      <div class="col-sm-12 col-lg-4 custom-control custom-radio">
                                        <input type="radio" id="tugor_kulit3" name="tugor_kulit" value="Kurang" <?php if (@$asesmen['tugor_kulit']=='Kurang') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="tugor_kulit3">Kurang</label>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-lg-6">
                            <div class="card border-info" style="border: 2px solid;">
                              <div class="card-header bg-info text-white">
                                <strong>DISABILITY</strong>
                              </div>
                              <div class="card-body card-block">
                                <div class="row form-group">

                                  <div class="col-sm-12 col-md-2">
                                    <label class=" form-control-label">Respon :</label>
                                  </div>
                                  <div class="col-sm-12 col-lg-10 row">
                                    <div class="col-12 col-lg-12 input-group">
                                      <div class="col-sm-12 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="respon1" name="respon" value="Alert" <?php if (@$asesmen['respon']=='Alert') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="respon1">Alert</label>
                                      </div>
                                      <div class="col-sm-12 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="respon2" name="respon" value="Verbal" <?php if (@$asesmen['respon']=='Verbal') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="respon2">Verbal</label>
                                      </div>
                                      <div class="col-sm-12 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="respon3" name="respon" value="Pain" <?php if (@$asesmen['respon']=='Pain') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="respon3">Pain</label>
                                      </div>
                                      <div class="col-sm-12 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="respon4" name="respon" value="Unrespon" <?php if (@$asesmen['respon']=='Unrespon') {echo "checked";} ?> class="custom-control-input">
                                        <label class="custom-control-label" for="respon4">Lemah</label>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-sm-12 col-md-2">
                                    <label class=" form-control-label">Pupil :</label>
                                  </div>
                                  <div class="col-sm-12 col-lg-10 row">
                                    <div class="col-12 col-lg-12 input-group">
                                      <div class="col-sm-12 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="pupil1" name="pupil" value="Isokor" <?php if (@$asesmen['pupil']=='Isokor') {echo "checked";} ?> class="pupil_a custom-control-input">
                                        <label class="custom-control-label" for="pupil1">Isokor</label>
                                      </div>
                                      <div class="col-sm-12 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="pupil2" name="pupil" value="Anisokor" <?php if (@$asesmen['pupil']=='Anisokor') {echo "checked";} ?> class="pupil_a custom-control-input">
                                        <label class="custom-control-label" for="pupil2">Anisokor</label>
                                      </div>
                                      <div class="col-sm-12 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="pupil3" name="pupil" value="Pain" <?php if (@$asesmen['respon']=='Pain') {echo "checked";} ?> class="pupil_a custom-control-input">
                                        <label class="custom-control-label" for="pupil3">Pain</label>
                                      </div>
                                      <div class="col-sm-12 col-lg-6 custom-control custom-radio">
                                        <input type="radio" id="pupil4" name="pupil" value="Unrespon" <?php if (@$asesmen['respon']=='Unrespon') {echo "checked";} ?> class="pupil_a custom-control-input">
                                        <label class="custom-control-label" for="pupil4"> <input type="text" class="pupil_lain form-control" name="pupil_lain" value="" placeholder="Lainnya"> </label>
                                      </div>
                                      <br><br>
                                    </div>
                                  </div>

                                  <div class="col-sm-12 col-md-2">
                                    <label class=" form-control-label">Reflek :</label>
                                  </div>
                                  <div class="col-sm-12 col-lg-10 row ">
                                    <div class="col-12 col-lg-12 input-group" style="padding-bottom:9px">
                                      <input type="text" class="form-control" aria-label="" name="reflek1" value="<?php echo @$asesmen['reflek1'] ?>">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">/</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="reflek2" value="<?php echo @$asesmen['reflek2'] ?>">
                                    </div>
                                  </div>


                                  <div class="col-sm-12 col-md-2">
                                    <label class=" form-control-label">GCS :</label>
                                  </div>
                                  <div class="col-sm-12 col-lg-10 row">

                                  </div>
                                  <div class="col-sm-12 col-lg-12 row">
                                    <div class="col-12 col-lg-12 input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">E :</span>
                                      </div>
                                      <input type="number" min="1" max="4" class="ea form-control in_max" aria-label="" name="GCS_E" value="<?php echo @$asesmen['GCS_E'] ?>">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">M :</span>
                                      </div>
                                      <input type="number" min="1" max="5" class="ma form-control in_max" aria-label="" name="GCS_M" value="<?php echo @$asesmen['GCS_M'] ?>">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">V :</span>
                                      </div>
                                      <input type="number" min="1" max="6" class="va form-control in_max" aria-label="" name="GCS_V" value="<?php echo @$asesmen['GCS_V'] ?>">
                                    </div>
                                  </div>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="card border-info" style="border: 2px solid;">
                  <div class="card-header bg-info text-white">
                    <strong>SECONDARY SURVEY</strong>
                  </div>
                  <div class="card-body card-block row">
                    <div class="col-sm-12 col-lg-4">
                      <img src="<?php echo base_url() ?>desain/OrganIGD.PNG" alt="">
                    </div>

                    <div class="col-sm-12 col-lg-4">
                      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
                        <input type="checkbox" id="cidera1" name="cidera[]" value="Nyeri" <?php if (@$asesmen['cidera']=='Nyeri') {echo "checked";} ?> class="custom-control-input">
                        <label class="custom-control-label" for="cidera1">Nyeri</label>
                      </div>
                      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
                        <input type="checkbox" id="cidera2" name="cidera[]" value="Keterbatasan Gerak" <?php if (@$asesmen['cidera']=='Keterbatasan Gerak') {echo "checked";} ?> class="custom-control-input">
                        <label class="custom-control-label" for="cidera2">Keterbatasan Gerak</label>
                      </div>
                      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
                        <input type="checkbox" id="cidera3" name="cidera[]" value="Deformitas" <?php if (@$asesmen['cidera']=='Deformitas') {echo "checked";} ?> class="custom-control-input">
                        <label class="custom-control-label" for="cidera3">Deformitas</label>
                      </div>
                      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
                        <input type="checkbox" id="cidera4" name="cidera[]" value="Abrasi" <?php if (@$asesmen['cidera']=='Abrasi') {echo "checked";} ?> class="custom-control-input">
                        <label class="custom-control-label" for="cidera4">Abrasi</label>
                      </div>
                      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
                        <input type="checkbox" id="cidera5" name="cidera[]" value="Leserasi" <?php if (@$asesmen['cidera']=='Leserasi') {echo "checked";} ?> class="custom-control-input">
                        <label class="custom-control-label" for="cidera5">Leserasi</label>
                      </div>
                      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
                        <input type="checkbox" id="cidera6" name="cidera[]" value="Kontusio" <?php if (@$asesmen['cidera']=='Kontusio') {echo "checked";} ?> class="custom-control-input">
                        <label class="custom-control-label" for="cidera6">Kontusio</label>
                      </div>
                      <div class="col-sm-12 col-lg-12 custom-control custom-radio">
                        <input type="text" name="cidera_lain" value="" class="form-control" placeholder="Lainnya ... ">
                      </div>
                      <div class="col-sm-12 col-lg-12 custom-control custom-radio">
                        <br>
                        Skala Resiko Cidera :
                        <div class="col-sm-12 col-lg-4 custom-control custom-radio">
                          <input type="radio" id="skalacidera1" name="skalacidera" value="Ringan" <?php if (@$asesmen['skalacidera']=='Ringan') {echo "checked";} ?> class="custom-control-input">
                          <label class="custom-control-label" for="skalacidera1">Ringan</label>
                        </div>
                        <div class="col-sm-12 col-lg-4 custom-control custom-radio">
                          <input type="radio" id="skalacidera2" name="skalacidera" value="Sedang" <?php if (@$asesmen['skalacidera']=='Sedang') {echo "checked";} ?> class="custom-control-input">
                          <label class="custom-control-label" for="skalacidera2">Sedang</label>
                        </div>
                        <div class="col-sm-12 col-lg-4 custom-control custom-radio">
                          <input type="radio" id="skalacidera3" name="skalacidera" value="Tinggi" <?php if (@$asesmen['skalacidera']=='Tinggi') {echo "checked";} ?> class="custom-control-input">
                          <label class="custom-control-label" for="skalacidera3">Tinggi</label>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-12 col-lg-4">
                      <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
                        <input type="checkbox" id="luka1" name="luka[]" value="Luka Bakar" <?php if (@$asesmen['luka']=='Luka Bakar') {echo "checked";} ?> class="custom-control-input">
                        <label class="custom-control-label" for="luka1">Luka Bakar</label>
                      </div>
                      <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
                        <input type="checkbox" id="luka2" name="luka[]" value="Gigitan" <?php if (@$asesmen['luka']=='Gigitan') {echo "checked";} ?> class="custom-control-input">
                        <label class="custom-control-label" for="luka2">Gigitan</label>
                      </div>
                      <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
                        <input type="checkbox" id="luka3" name="luka[]" value="Tusuk" <?php if (@$asesmen['luka']=='Tusuk') {echo "checked";} ?> class="custom-control-input">
                        <label class="custom-control-label" for="luka3">Tusuk</label>
                      </div>
                      <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
                        <input type="checkbox" id="luka4" name="luka[]" value="V Apertum" <?php if (@$asesmen['luka']=='V Apertum') {echo "checked";} ?> class="custom-control-input">
                        <label class="custom-control-label" for="luka4">V. Apertum</label>
                      </div>
                      <div class="col-sm-12 col-lg-6 custom-control custom-checkbox">
                        <input type="checkbox" id="luka5" name="luka[]" value="Ptichiae" <?php if (@$asesmen['luka']=='Ptichiae') {echo "checked";} ?> class="custom-control-input">
                        <label class="custom-control-label" for="luka5">Ptichiae</label>
                      </div>
                      <div class="col-sm-12 col-lg-12 custom-control custom-checkbox">
                        <input type="text" name="luka_lain" value="" class="form-control" placeholder="Lainnya ... ">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <hr>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                      <div class="col-12 col-lg-12 input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Skala Nyeri :</span>
                        </div>
                        <input type="text" class="form-control" aria-label="" name="skalanyeri" value="<?php echo @$asesmen['skalanyeri'] ?>">
                      </div>
                      <br>
                      <div class="col-12 col-lg-12 input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Berat Badan :</span>
                        </div>
                        <input type="text" class="form-control" aria-label="" name="bb" value="<?php echo @$asesmen['bb'] ?>">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Kg</span>
                        </div>
                      </div>
                      <br>
                      <div class="col-12 col-lg-12 input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Tinggi Badan :</span>
                        </div>
                        <input type="text" class="form-control" aria-label="" name="tb" value="<?php echo @$asesmen['tb'] ?>">
                        <div class="input-group-prepend">
                          <span class="input-group-text">CM</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 text-right">
                      <img src="<?php echo base_url() ?>desain/skala-nyeri.JPG" alt="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <?php $this->load->view("Demografi/input_igd_pengkajian") ?>
                </div>


                <div class="col-lg-4 col-sm-12">
                  <div class="card border-info" style="border: 2px solid;">
                    <div class="card-header bg-info text-white">
                      <strong>DIAGNOSIS KEPERAWATAN</strong>
                    </div>
                    <?php $this->load->view("Demografi/input_igd_diagnosis") ?>
                  </div>
                </div>

                <div class="col-lg-4 col-sm-12">
                  <div class="card border-info" style="border: 2px solid;">
                    <div class="card-header bg-info text-white">
                      <strong>RENCANA / TINDAKAN KEPERAWATAN</strong>
                    </div>
                    <?php $this->load->view("Demografi/input_igd_tindakan") ?>
                  </div>
                </div>
              </div>




              <?php echo $this->Core->btn_input(); ?>
              <?php echo form_close(); ?>
            </div></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function coba() {
    if ($("input#lain_ridul_check:checked").length == 0) {
      $("#lain_ridul").attr('disabled', true);
    } else {
      $("#lain_ridul").attr('disabled', false)
      $("#lain_ridul").focus();;
    }
  }
  $(document).ready(function(){
    $(document).on("blur",".ea",function(){
      if ($(this).val()>4) {
        $(".eb").val(4);
      }else{

        $(".eb").val($(this).val());
      }
    })
    $(document).on("blur",".va",function(){
      if ($(this).val()>6) {
        $(".vb").val(6);
      }else{

        $(".vb").val($(this).val());
      }
    })
    $(document).on("blur",".ma",function(){
      if ($(this).val()>5) {
        $(".mb").val(5);
      }else{

        $(".mb").val($(this).val());
      }
    })
    $(document).on("click",".pupil_a",function(){
      var nilai = $(this).val();
      // if (nilai=="Unrespon") {
        $(".pupil_b").val(nilai);
      // }
    })
  })
</script>
