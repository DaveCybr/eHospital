<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
              <h3><a href="" class="white-text mx-3">TIMBANG TERIMA PASIEN</a><h3>
              </div>
              <div class="card-body card-block">
                <?php echo form_open_multipart('Asesmen/insert_timbangterima');?>
                <?php echo @$error;?>
                <input type="hidden" name="nomerkun" value="<?php echo $this->uri->segment(3)?>">
                <div class="card-body card-block">
                  <div class="row form-group">
                    <div class="col col-md-2">
                      <label for="nokun" class=" form-control-label">NO.Kunjungan :</label>
                    </div>
                    <div class="col-12 col-md-4">
                      <input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$kunjungan['no_urutkunjungan']; ?>"  readonly>
                    </div>
                    <div class="col col-md-1">
                      <label for="tanggal" class=" form-control-label">Tanggal</label>
                    </div>
                    <div class="col-12 col-md-4">
                      <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo date("Y-m-d"); ?>"  readonly>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col col-md-2">
                      <label for="norm" class=" form-control-label">Pasien :</label>
                    </div>
                    <div class="col-12 col-md-3">
                      <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>"  readonly>
                    </div>
                    <div class="col-12 col-md-4">
                      <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo @$pasien['namapasien']; ?>"  readonly>
                    </div>
                    <div class="col-12 col-md-3">
                      <input type="text" name="jenis_kunjungan" id="jenis_kunjungan" class="form-control" placeholder="jenis_kunjungan" value="<?php echo @$jenispasien['jenis_pasien']; ?>"  readonly>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>TANDA VITAL</strong>
                        </div>
                        <div class="card-body card-block">
                          <div class="row p-t-20 p-b-50">
                            <div class="col-xl-12 col-md-12 col-sm-12">

                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text suhu">Suhu</span>
                                </div>
                                <input type="number" name="suhu" max="170" min="0" class="form-control" placeholder="---" value="<?php echo @$demografi['suhu'] ?>">
                                <div class="input-group-append">
                                  <span class="input-group-text">^C</span>
                                </div>

                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">

                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Sistole</span>
                                </div>
                                <input type="number" name="siastole" max="170" min="0" class="form-control" placeholder="---" value="<?php echo @$demografi['td'] ?>">

                                <div class="input-group-append">
                                  <span class="input-group-text">mmhg</span>
                                </div>

                                <div class="input-group-prepend">
                                  <span class="input-group-text">Diastole</span>
                                </div>
                                <input type="number" name="diastole" max="170" min="0" class="form-control" placeholder="---" value="<?php echo @$demografi['hr'] ?>">
                                <!-- <input type="number" class="form-control" aria-label="" max="170" min="0" name="diastole" " > -->
                                <div class="input-group-append">
                                  <span class="input-group-text">mmhg</span>
                                </div>

                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">

                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Nadi</span>
                                </div>
                                <input type="number" name="nadi" max="170" min="0" class="form-control" placeholder="---" value="<?php echo @$demografi['nadi'] ?>">
                                <div class="input-group-append">
                                  <span class="input-group-text">x/menit</span>
                                </div>
                                <div class="input-group-prepend">
                                  <span class="input-group-text">RR</span>
                                </div>
                                <input type="number" name="rr" max="170" min="0" class="form-control" placeholder="---" value="<?php echo @$demografi['rr'] ?>">
                                <div class="input-group-append">
                                  <span class="input-group-text">x/menit</span>
                                </div>

                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">

                              <div class="input-group" style="margin-bottom:40px">
                                <div class="input-group-prepend">
                                  <span class="input-group-text suhu">Keluhan</span>
                                </div>
                                <input type="text" class="form-control" aria-label="" name="keluhan" value="<?php echo @$demografi['keluhan_umum'] ?>" >
                                <!-- <div class="input-group-append">
                                <span class="input-group-text">^C</span>
                              </div> -->

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>B1 (SISTEM PERNAPASAN)</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row p-t-20">
                          <!-- <div class="col col-md-7"> -->
                          <label class=" form-control-label">Keluhan napas :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="keluhan_napas1" checked name="keluhan_napas[]" value="Sesak" class="custom-control-input">
                              <label class="custom-control-label" for="keluhan_napas1">Sesak</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="keluhan_napas2" name="keluhan_napas[]" value="Batuk" class="custom-control-input">
                              <label class="custom-control-label" for="keluhan_napas2">Batuk</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="keluhan_napas3" name="keluhan_napas[]" value="Nyeri saat napas" class="custom-control-input">
                              <label class="custom-control-label" for="keluhan_napas3">Nyeri saat napas</label>
                            </div>
                          </div>
                          <label class=" form-control-label">Irama napas :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="irama_napas1" checked name="irama_napas" value="Teratur" class="custom-control-input">
                              <label class="custom-control-label" for="keluhan_napas1">Teratur</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="irama_napas2" name="irama_napas" value="Tidak Teratur" class="custom-control-input">
                              <label class="custom-control-label" for="irama_napas2">Tidak Teratur</label>
                            </div>
                          </div>
                          <label class=" form-control-label">Suara napas :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="suara_napas1" checked name="suara_napas[]" value="Vasikuler" class="custom-control-input">
                              <label class="custom-control-label" for="suara_napas1">Vasikuler</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="suara_napas2" name="suara_napas[]" value="Ronchi D/S" class="custom-control-input">
                              <label class="custom-control-label" for="suara_napas2">Ronchi D/S</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="suara_napas3" name="suara_napas[]" value="Wheezing D/S" class="custom-control-input">
                              <label class="custom-control-label" for="suara_napas3">Wheezing D/S</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="suara_napas4" name="suara_napas[]" value="Rales D/S" class="custom-control-input">
                              <label class="custom-control-label" for="suara_napas4">Rales D/S</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="suara_napas5" name="suara_napas[]" value="Masker" class="custom-control-input">
                              <label class="custom-control-label" for="suara_napas5">Masker</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="suara_napas6" name="suara_napas[]" value="Nasal" class="custom-control-input">
                              <label class="custom-control-label" for="suara_napas6">Nasal</label>
                            </div>
                          </div>
                          <!-- <div class="col-xl-12 col-md-12 col-sm-12"> -->

                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text suhu">Oksigen</span>
                            </div>
                            <input type="number" name="oksigen" max="170" min="0" class="form-control" placeholder="---" value="<?php echo @$demografi['suhu'] ?>">
                            <div class="input-group-append">
                              <span class="input-group-text">L/menit</span>
                            </div>

                          </div>
                          <!-- </div> -->

                        </div>
                      </div>
                    </div>


                  </div>

                  <div class="col-lg-6">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>B2 (SISTEM KARDIOVASKULER)</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row p-t-20">

                          <label class=" form-control-label">Keluhan nyeri dada :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="nyeri_dada1" checked name="nyeri_dada" value="Tidak" class="custom-control-input">
                              <label class="custom-control-label" for="nyeri_dada1">Tidak</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="nyeri_dada2" name="nyeri_dada" value="Ya" class="custom-control-input">
                              <label class="custom-control-label" for="nyeri_dada2">Ya</label>
                            </div>
                          </div>
                          <label class=" form-control-label">Irama Jantung :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="irama_jantung1" checked name="irama_jantung" value="Teratur" class="custom-control-input">
                              <label class="custom-control-label" for="irama_jantung1">Teratur</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="irama_jantung2" name="irama_jantung" value="Tidak Teratur" class="custom-control-input">
                              <label class="custom-control-label" for="irama_jantung2">Tidak Teratur</label>
                            </div>
                          </div>
                          <label class=" form-control-label">CRT :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="crt1" checked name="crt" value="< 3 Detik" class="custom-control-input">
                              <label class="custom-control-label" for="crt1">< 3 Detik</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="crt2" name="crt" value="> 3 Detik" class="custom-control-input">
                              <label class="custom-control-label" for="crt2">> 3 Detik</label>
                            </div>
                          </div>
                          <label class=" form-control-label">Konjungtiva Pucat :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row" style="margin-bottom:200px;">
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="konjungtiva1" checked name="konjungtiva" value="Tidak" class="custom-control-input">
                              <label class="custom-control-label" for="konjungtiva1">Tidak</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="konjungtiva2" name="konjungtiva" value="Ya" class="custom-control-input">
                              <label class="custom-control-label" for="konjungtiva2">Ya</label>
                            </div>
                          </div>
                          <!-- </div> -->

                        </div>
                      </div>
                    </div>


                  </div>
                  <div class="col-lg-6">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>B3 (SISTEM PERSARAFAN)</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row p-t-20">

                          <label class=" form-control-label">kesadaran :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="kesadaran1" no="1" name="kesadaran" value="Composmentis" class="kesadaran custom-control-input">
                              <label class="custom-control-label" for="kesadaran1">Composmentis</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="kesadaran2" no="2" name="kesadaran" value="Sopor" class="kesadaran custom-control-input">
                              <label class="custom-control-label" for="kesadaran2">Sopor</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="kesadaran3" no="3" name="kesadaran" value="Apatis" class="kesadaran custom-control-input">
                              <label class="custom-control-label" for="kesadaran3">Apatis</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="kesadaran4" no="4" name="kesadaran" value="Koma" class="kesadaran custom-control-input">
                              <label class="custom-control-label" for="kesadaran4">Koma</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="kesadaran5" no="5" name="kesadaran" value="Somnolen" class="kesadaran custom-control-input">
                              <label class="custom-control-label" for="kesadaran5">Somnolen</label>
                            </div>
                          </div>
                          <!-- <div class="col-sm-12 col-md-2"> -->
                          <label class=" form-control-label">GCS :</label>
                          <!-- </div> -->
                          <!-- <div class="col-sm-12 col-lg-10 row"> -->
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">E :</span>
                            </div>
                            <input type="number" min="1" max="6" class="ea form-control in_max" aria-label="" name="GCS_E" value="<?php echo @$asesmen['GCS_E'] ?>">
                            <div class="input-group-prepend">
                              <span class="input-group-text">V :</span>
                            </div>
                            <input type="number" min="1" max="6" class="va form-control in_max" aria-label="" name="GCS_V" value="<?php echo @$asesmen['GCS_V'] ?>">
                            <div class="input-group-prepend">
                              <span class="input-group-text">M :</span>
                            </div>
                            <input type="number" min="1" max="6" class="ma form-control in_max" aria-label="" name="GCS_M" value="<?php echo @$asesmen['GCS_M'] ?>">
                          </div>
                          <!-- </div> -->
                          <label class=" form-control-label">Keluhan Pusing :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="keluhan_pusing1" checked name="keluhan_pusing" value="Tidak" class="custom-control-input">
                              <label class="custom-control-label" for="keluhan_pusing1">Tidak</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="keluhan_pusing2" name="keluhan_pusing" value="Ya" class="custom-control-input">
                              <label class="custom-control-label" for="keluhan_pusing2">Ya</label>
                            </div>
                          </div>
                          <label class=" form-control-label">Pupil :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="pupil1" checked name="pupil" value="Isokor" class="custom-control-input">
                              <label class="custom-control-label" for="pupil1">Isokor</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="pupil2" name="pupil" value="Anisokor" class="custom-control-input">
                              <label class="custom-control-label" for="pupil2">Anisokor</label>
                            </div>
                          </div>

                          <!-- <div class="col-xl-12 col-md-12 col-sm-12"> -->

                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text suhu">Diameter</span>
                            </div>
                            <input type="number" name="diameter1" max="170" min="0" class="form-control" placeholder="---" value="<?php echo @$demografi['persarafan'] ?>">
                            <div class="input-group-append">
                              <span class="input-group-text">mm</span>
                            </div>

                            <input type="number" name="diameter2" max="170" min="0" class="form-control" placeholder="---" value="<?php echo @$demografi['persarafan'] ?>">
                            <div class="input-group-append">
                              <span class="input-group-text">mm</span>
                            </div>

                          </div>
                          <!-- </div> -->
                          <label class=" form-control-label">Nyeri :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="nyeri_saraf1" checked name="nyeri_saraf" value="Tidak" class="custom-control-input">
                              <label class="custom-control-label" for="nyeri_saraf1">Tidak</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="nyeri_saraf2" name="nyeri_saraf" value="Ya" class="custom-control-input">
                              <label class="custom-control-label" for="nyeri_saraf2">Ya</label>
                            </div>
                          </div>
                          <div class="input-group mb-3" >
                            <div class="input-group-prepend">
                              <span class="input-group-text suhu">Skala Nyeri</span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="skala_nyeri" value="<?php echo @$demografi['suhu'] ?>" >
                            <div class="input-group-append">
                              <span class="input-group-text">Lokasi Nyeri</span>
                            </div>

                            <input type="text" class="form-control" aria-label="" name="lokasi_nyeri" value="<?php echo @$demografi['suhu'] ?>" >


                          </div>
                          <!-- </div> -->

                        </div>
                      </div>
                    </div>


                  </div>
                  <div class="col-lg-6">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>B4 (SISTEM PERKEMIHAN)</strong>
                      </div>
                      <div class="card-body card-block"  style="padding-bottom:470px">
                        <div class="row p-t-20">

                          <label class=" form-control-label">Keluhan :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="keluhan_kemih1" checked name="keluhan_kemih[]" value="Kencing menetes" class="custom-control-input">
                              <label class="custom-control-label" for="keluhan_kemih1">Kencing menetes</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="keluhan_kemih2" name="keluhan_kemih[]" value="Inkontinensia" class="custom-control-input">
                              <label class="custom-control-label" for="keluhan_kemih2">Inkontinensia</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="keluhan_kemih3" name="keluhan_kemih[]" value="Retensi urine" class="custom-control-input">
                              <label class="custom-control-label" for="keluhan_kemih3">Retensi urine</label>
                            </div>
                          </div>
                          <label class=" form-control-label">Anuria :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="anuria1" checked name="anuria[]" value="Gross Hematuri" class="custom-control-input">
                              <label class="custom-control-label" for="anuria1">Gross Hematuri</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="anuria2" name="anuria[]" value="Disuria" class="custom-control-input">
                              <label class="custom-control-label" for="anuria2">Disuria</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="anuria3" name="anuria[]" value="Poliuri" class="custom-control-input">
                              <label class="custom-control-label" for="anuria3">Poliuri</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="anuria4" name="anuria[]" value="Oliguri" class="custom-control-input">
                              <label class="custom-control-label" for="anuria4">Oliguri</label>
                            </div>
                          </div>
                          <label class=" form-control-label">Kandung Kemih :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="kandung_kemih1" checked name="kandung_kemih" value="Tidak" class="custom-control-input">
                              <label class="custom-control-label" for="kandung_kemih1">Tidak</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="kandung_kemih2" name="kandung_kemih" value="Membesar" class="custom-control-input">
                              <label class="custom-control-label" for="kandung_kemih2">Membesar</label>
                            </div>
                          </div>
                          <label class=" form-control-label">Nyeri Tekan :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="nyeri_tekan1" checked name="nyeri_tekan" value="Tidak" class="custom-control-input">
                              <label class="custom-control-label" for="nyeri_tekan1">Tidak</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="nyeri_tekan2" name="nyeri_tekan" value="Ya" class="custom-control-input">
                              <label class="custom-control-label" for="nyeri_tekan2">Ya</label>
                            </div>
                          </div>
                          <label class=" form-control-label">Alat Bantu :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="alatbantu1" checked name="alatbantu[]" value="Foley cateter" class="custom-control-input">
                              <label class="custom-control-label" for="alatbantu1">Foley cateter</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="alatbantu2" name="alatbantu[]" value="Condom cateter" class="custom-control-input">
                              <label class="custom-control-label" for="alatbantu2">Condom cateter</label>
                            </div>
                          </div>
                          <label class=" form-control-label">Intake cairan :</label>
                          <!-- </div> -->
                          <!-- <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="intake_cair1" checked name="intake_cair" value="Tidak" class="custom-control-input">
                              <label class="custom-control-label" for="intake_cair1">Tidak</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="intake_cair2" name="intake_cair" value="Ya" class="custom-control-input">
                              <label class="custom-control-label" for="intake_cair2">Ya</label>
                            </div>
                          </div> -->
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Oral</span>
                            </div>
                            <input type="number" name="oral" max="2000" min="0" class="form-control" placeholder="---" value="<?php echo @$demografi['oral'] ?>">
                            <div class="input-group-append">
                              <span class="input-group-text">cc/hr</span>
                            </div>

                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Parenteral</span>
                            </div>
                            <input type="number" name="parenteral" max="2000" min="0" class="form-control" placeholder="---" value="<?php echo @$demografi['parenteral'] ?>">
                            <div class="input-group-append">
                              <span class="input-group-text">cc/hr</span>
                            </div>

                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Produksi urine</span>
                            </div>
                            <input type="number" name="produksi_urine" max="2000" min="0" class="form-control" placeholder="---" value="<?php echo @$demografi['urine'] ?>">
                            <div class="input-group-append">
                              <span class="input-group-text">ml/hr</span>
                            </div>

                            <div class="input-group-append">
                              <span class="input-group-text">Warna</span>
                            </div>

                            <input type="text" class="form-control" aria-label="" name="warna_urine" value="<?php echo @$demografi['suhu'] ?>" >


                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Bau</span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="bau_urine" value="<?php echo @$demografi['suhu'] ?>" >

                          </div>
                          <!-- </div> -->

                        </div>
                      </div>
                    </div>


                  </div>


                  <div class="col-lg-6">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>B5 (SISTEM PENCERNAAN)</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row p-t-20">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text suhu">Lingkaran abdomen</span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="abdomen" value="<?php echo @$demografi['lingkarabdomen'] ?>" >
                            <div class="input-group-append">
                              <span class="input-group-text">cm</span>
                            </div>
                          </div>

                          <label class=" form-control-label">Mukosa mulut :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="mukosa_mulut1" checked name="mukosa_mulut[]" value="Lembab" class="custom-control-input">
                              <label class="custom-control-label" for="mukosa_mulut1">Lembab</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="mukosa_mulut2" name="mukosa_mulut[]" value="Kering" class="custom-control-input">
                              <label class="custom-control-label" for="mukosa_mulut2">Kering</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="mukosa_mulut3" name="mukosa_mulut[]" value="Merah" class="custom-control-input">
                              <label class="custom-control-label" for="mukosa_mulut3">Merah</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="mukosa_mulut4" name="mukosa_mulut[]" value="Stomatitis" class="custom-control-input">
                              <label class="custom-control-label" for="mukosa_mulut4">Stomatitis</label>
                            </div>
                          </div>

                          <label class=" form-control-label">Tenggorokan :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="tenggorokan1" checked name="tenggorokan[]" value="Sulit menelan" class="custom-control-input">
                              <label class="custom-control-label" for="tenggorokan1">Sulit menelan</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="tenggorokan2" name="tenggorokan[]" value="Nyeri menelan" class="custom-control-input">
                              <label class="custom-control-label" for="tenggorokan2">Nyeri menelan</label>
                            </div>
                          </div>

                          <label class=" form-control-label">Abdomen :</label>
                          <!-- </div> -->
                          <div class="col-12 col-md-12 row">
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="abdomen_21" checked name="abdomen_2[]" value="Supel" class="custom-control-input">
                              <label class="custom-control-label" for="abdomen_21">Supel</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="abdomen_22" name="abdomen_2[]" value="Tegang" class="custom-control-input">
                              <label class="custom-control-label" for="abdomen_22">Tegang</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="abdomen_23" name="abdomen_2[]" value="Luka operasi" class="custom-control-input">
                              <label class="custom-control-label" for="abdomen_23">Luka operasi</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="abdomen_24" name="abdomen_2[]" value="Nyeri tekan" class="custom-control-input">
                              <label class="custom-control-label" for="abdomen_24">Nyeri tekan</label>

                            </div>
                            <div class="col-12 mb-3 col-lg-4 custom-control custom-checkbox">
                              <input type="checkbox" id="abdomen_25" name="abdomen_2[]" value="Kembung" class="custom-control-input">
                              <label class="custom-control-label" for="abdomen_25">Kembung</label>
                            </div>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">lain-lain</span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="abdomen_2[]" value="" >
                              <!-- <div class="input-group-append">
                              <span class="input-group-text">cm</span>
                            </div> -->
                          </div>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Lokasi nyeri tekan</span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="lokasi_nyeri_tekan" value="<?php echo @$demografi['lokasi_nyeri'] ?>" >
                              <!-- <div class="input-group-append">
                              <span class="input-group-text">cm</span>
                            </div> -->
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-checkbox">
                            <input type="checkbox" id="abdomen_26" name="abdomen_2[]" value="Jejas" class="custom-control-input">
                            <label class="custom-control-label" for="abdomen_26">Jejas</label>

                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text suhu">Lokasi Jejas</span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$demografi['suhu'] ?>" >
                            <!-- <div class="input-group-append">
                            <span class="input-group-text">cm</span>
                          </div> -->
                        </div>

                        <label class="form-control-label">Mual :</label>
                        <!-- </div> -->
                        <div class="col-12 col-md-12 row">
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="mual1" checked name="mual" value="Tidak" class="custom-control-input">
                            <label class="custom-control-label" for="mual1">Tidak</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="mual2" name="mual" value="Ya" class="custom-control-input">
                            <label class="custom-control-label" for="mual2">Ya</label>
                          </div>
                        </div>
                        <label class=" form-control-label">Muntah :</label>
                        <!-- </div> -->
                        <div class="col-12 col-md-12 row">
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="muntah1" checked name="muntah" value="Tidak" class="custom-control-input">
                            <label class="custom-control-label" for="muntah1">Tidak</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="muntah2" name="muntah" value="Ya" class="custom-control-input">
                            <label class="custom-control-label" for="muntah2">Ya</label>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text suhu">Bising Usus</span>
                          </div>

                          <input type="number" name="bising_usus" max="170" min="0" class="form-control" placeholder="---" value="<?php echo @$demografi['bising_usus'] ?>">
                          <div class="input-group-append">
                            <span class="input-group-text">x/menit</span>
                          </div>
                        </div>
                        <label class=" form-control-label">Terpasang NGT :</label>
                        <div class="col-12 col-md-12 row">
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="ngt1" checked name="ngt" value="Tidak" class="custom-control-input">
                            <label class="custom-control-label" for="ngt1">Tidak</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="ngt2" name="ngt" value="Ya" class="custom-control-input">
                            <label class="custom-control-label" for="ngt2">Ya</label>
                          </div>
                        </div>
                        <label class=" form-control-label">Diet :</label>
                        <div class="col-12 col-md-12 row">
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="diet1" checked name="diet" value="Padat" class="custom-control-input diet">
                            <label class="custom-control-label" for="diet1">Padat</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="diet2" name="diet" value="Lunak" class="custom-control-input diet">
                            <label class="custom-control-label" for="diet2">Lunak</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="diet3" name="diet" value="Cair" class="custom-control-input diet">
                            <label class="custom-control-label" for="diet3">Cair</label>
                          </div>
                          <div class="col-12 mb-3 col-lg-12 custom-control custom-radio">
                            <input type="radio" id="diet4" name="diet" value="lain" class="custom-control-input diet">
                            <label class="custom-control-label" for="diet4">
                              <input type="text" disabled placeholder="lain-lain" name="diet_lain" value="" class="diet_lain form-control">
                            </label>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text suhu">Frekuensi</span>
                          </div>
                          <input type="number" name="frekuensi" max="170" min="0" class="form-control" placeholder="---" value="<?php echo @$demografi['frekuensi'] ?>">

                          <div class="input-group-append">
                            <span class="input-group-text">x/hari</span>
                          </div>

                          <div class="input-group-append">
                            <span class="input-group-text">Jumlah</span>
                          </div>

                          <input type="number" max="170" min="0" class="form-control" aria-label="" name="jumlah" value="<?php echo @$demografi['jumlah'] ?>" >


                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text suhu">Jenis</span>
                          </div>
                          <input type="text" class="form-control" aria-label="" name="jenis" value="<?php echo @$demografi['suhu'] ?>" >

                          <div class="input-group-append">
                            <span class="input-group-text">BAB</span>
                          </div>
                          <input type="number" name="bab" max="170" min="0" class="form-control" placeholder="---" value="<?php echo @$demografi['bab'] ?>">


                          <div class="input-group-append">
                            <span class="input-group-text">x/hari</span>
                          </div>

                        </div>
                        <label class=" form-control-label">Konsistensi :</label>
                        <div class="col-12 col-md-12 row">
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="konsistensi1" checked name="konsistensi" value="Padat" class="custom-control-input">
                            <label class="custom-control-label" for="konsistensi1">Padat</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="konsistensi2" name="konsistensi" value="Lunak" class="custom-control-input">
                            <label class="custom-control-label" for="konsistensi2">Lunak</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="konsistensi3" name="konsistensi" value="Cair" class="custom-control-input">
                            <label class="custom-control-label" for="konsistensi3">Cair</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="konsistensi4" name="konsistensi" value="Lendir/Darah" class="custom-control-input">
                            <label class="custom-control-label" for="konsistensi4">Lendir/Darah</label>
                          </div>
                        </div>
                        <label class=" form-control-label">Konstipasi :</label>
                        <div class="col-12 col-md-12 row">
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="konstipasi1" checked name="konstipasi" value="Tidak" class="custom-control-input">
                            <label class="custom-control-label" for="konstipasi1">Tidak</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="konstipasi2" name="konstipasi" value="Ya" class="custom-control-input">
                            <label class="custom-control-label" for="konstipasi2">Ya</label>
                          </div>
                        </div>
                      </div>


                    </div>
                    <!-- </div> -->

                  </div>
                </div>
              </div>


            </div>
            <div class="col-lg-6">
              <div class="card border-info" style="border: 2px solid;">
                <div class="card-header bg-info text-white">
                  <strong>B6 (MUSKULOSKLETAL DAN INTEGUMEN)</strong>
                </div>
                <div class="card-body card-block">
                  <div class="row p-t-20">
                    <label class=" form-control-label">Sendi :</label>
                    <!-- </div> -->
                    <div class="col-12 col-md-12 row">
                      <div class="col-12 col-lg-4 custom-control custom-radio">
                        <input type="radio" id="sendi1" checked name="sendi" value="Bebas" class="custom-control-input">
                        <label class="custom-control-label" for="sendi1">Bebas</label>
                      </div>
                      <div class="col-12 col-lg-4 custom-control custom-radio">
                        <input type="radio" id="sendi2" name="sendi" value="Terbatas" class="custom-control-input">
                        <label class="custom-control-label" for="sendi2">Terbatas</label>
                      </div>
                    </div>
                    <label class=" form-control-label">Frakture :</label>
                    <!-- </div> -->
                    <div class="col-12 col-md-12 row">
                      <div class="col-12 col-lg-4 custom-control custom-radio">
                        <input type="radio" id="fraktur1" checked name="fraktur" value="Tidak" class="custom-control-input">
                        <label class="custom-control-label" for="fraktur1">Tidak</label>
                      </div>
                      <div class="col-12 col-lg-4 custom-control custom-radio">
                        <input type="radio" id="fraktur2" name="fraktur" value="Ya" class="custom-control-input">
                        <label class="custom-control-label" for="fraktur2">Ya</label>
                      </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text suhu">Lokasi Frakture</span>
                        </div>
                        <input type="text" class="form-control" aria-label="" name="lokasi_fraktur" value="<?php echo @$demografi['suhu'] ?>" >
                        <!-- <div class="input-group-append">
                        <span class="input-group-text">cm</span>
                      </div> -->
                    </div>
                    </div>
                    <label class=" form-control-label">Traksi/spalks/gips :</label>
                    <!-- </div> -->
                    <div class="col-12 col-md-12 row">
                      <div class="col-12 col-lg-4 custom-control custom-radio">
                        <input type="radio" id="gips1" checked name="gips" value="Tidak" class="custom-control-input">
                        <label class="custom-control-label" for="gips1">Tidak</label>
                      </div>
                      <div class="col-12 col-lg-4 custom-control custom-radio">
                        <input type="radio" id="gips2" name="gips" value="Ya" class="custom-control-input">
                        <label class="custom-control-label" for="gips2">Ya</label>
                      </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text suhu">Lokasi Gips</span>
                        </div>
                        <input type="text" class="form-control" aria-label="" name="lokasi_gips" value="<?php echo @$demografi['suhu'] ?>" >
                        <!-- <div class="input-group-append">
                        <span class="input-group-text">cm</span>
                      </div> -->
                    </div>
                    </div>
                    <label class=" form-control-label">Kompartemen syndrome:</label>
                    <!-- </div> -->
                    <div class="col-12 col-md-12 row">
                      <div class="col-12 col-lg-4 custom-control custom-radio">
                        <input type="radio" id="syndrome1" checked name="syndrome" value="Tidak" class="custom-control-input">
                        <label class="custom-control-label" for="syndrome1">Tidak</label>
                      </div>
                      <div class="col-12 col-lg-4 custom-control custom-radio">
                        <input type="radio" id="syndrome2" name="syndrome" value="Ya" class="custom-control-input">
                        <label class="custom-control-label" for="syndrome2">Ya</label>
                      </div>
                    </div>
                    <label class=" form-control-label">Kulit :</label>
                    <!-- </div> -->
                    <div class="col-12 col-md-12 row">
                      <div class="col-12 col-lg-4 custom-control custom-checkbox">
                        <input type="checkbox" id="kulit1" checked name="kulit[]" value="Ikterik" class="custom-control-input">
                        <label class="custom-control-label" for="kulit1">Ikterik</label>
                      </div>
                      <div class="col-12 col-lg-4 custom-control custom-checkbox">
                        <input type="checkbox" id="kulit2" name="kulit[]" value="Sianosis" class="custom-control-input">
                        <label class="custom-control-label" for="kulit2">Sianosis</label>
                      </div>
                      <div class="col-12 col-lg-4 custom-control custom-checkbox">
                        <input type="checkbox" id="kulit3" name="kulit[]" value="Kemerahan" class="custom-control-input">
                        <label class="custom-control-label" for="kulit3">Kemerahan</label>
                      </div>
                      <div class="col-12 col-lg-4 custom-control custom-checkbox">
                        <input type="checkbox" id="kulit4" name="kulit[]" value="Hyperpigmentasi" class="custom-control-input">
                        <label class="custom-control-label" for="kulit4">Hyperpigmentasi</label>
                      </div>
                      <div class="col-12 col-lg-4 custom-control custom-checkbox">
                        <input type="checkbox" id="kulit5" name="kulit[]" value="Dekubitus" class="custom-control-input">
                        <label class="custom-control-label" for="kulit5">Dekubitus</label>
                      </div>
                    </div>
                    <label class=" form-control-label">Akral :</label>
                    <!-- </div> -->
                    <div class="col-12 col-md-12 row">
                      <div class="col-12 col-lg-4 custom-control custom-checkbox">
                        <input type="checkbox" id="akral1" checked name="akral[]" value="hangat" class="custom-control-input">
                        <label class="custom-control-label" for="akral1">Hangat</label>
                      </div>
                      <div class="col-12 col-lg-4 custom-control custom-checkbox">
                        <input type="checkbox" id="akral2" name="akral[]" value="Panas" class="custom-control-input">
                        <label class="custom-control-label" for="akral2">Panas</label>
                      </div>
                      <div class="col-12 col-lg-4 custom-control custom-checkbox">
                        <input type="checkbox" id="akral3" name="akral[]" value="Dingin" class="custom-control-input">
                        <label class="custom-control-label" for="akral3">Dingin</label>
                      </div>
                      <div class="col-12 col-lg-4 custom-control custom-checkbox">
                        <input type="checkbox" id="akral4" name="akral[]" value="Kering" class="custom-control-input">
                        <label class="custom-control-label" for="akral4">Kering</label>
                      </div>
                      <div class="col-12 col-lg-4 custom-control custom-checkbox">
                        <input type="checkbox" id="akral5" name="akral[]" value="Besar" class="custom-control-input">
                        <label class="custom-control-label" for="akral5">Besar</label>
                      </div>
                    </div>
                    <label class=" form-control-label">Turgor :</label>
                    <!-- </div> -->
                    <div class="col-12 col-md-12 row mb-3">
                      <div class="col-12 col-lg-4 custom-control custom-checkbox">
                        <input type="checkbox" id="turgor1" checked name="turgor[]" value="Baik" class="custom-control-input">
                        <label class="custom-control-label" for="turgor1">Baik</label>
                      </div>
                      <div class="col-12 col-lg-4 custom-control custom-checkbox">
                        <input type="checkbox" id="turgor2" name="turgor[]" value="Kurang" class="custom-control-input">
                        <label class="custom-control-label" for="turgor2">Kurang</label>
                      </div>
                      <div class="col-12 col-lg-4 custom-control custom-checkbox">
                        <input type="checkbox" id="turgor3" name="turgor[]" value="Jelek" class="custom-control-input">
                        <label class="custom-control-label" for="turgor3">Jelek</label>
                      </div>

                    </div>

                    <label class=" form-control-label">Luka :</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text suhu">Luka Jenis</span>
                      </div>
                      <input type="text" class="form-control" aria-label="" name="jenis_luka" value="<?php echo @$demografi['suhu'] ?>" >

                      <div class="input-group-append">
                        <span class="input-group-text">Luas Luka</span>
                      </div>

                      <input type="text" class="form-control" aria-label="" name="luas_luka" value="<?php echo @$demografi['suhu'] ?>" >


                    </div>
                    <!-- </div> -->
                    <div class="col-12 col-md-12 row">

                      <div class="col-12 col-lg-4 custom-control custom-checkbox">
                        <input type="checkbox" id="jenisluka24" name="jenisluka2[]" value="Bersih" class="custom-control-input">
                        <label class="custom-control-label" for="jenisluka24">Bersih</label>
                      </div>
                      <div class="col-12 col-lg-4 custom-control custom-checkbox">
                        <input type="checkbox" id="jenisluka25" name="jenisluka2[]" value="Kotor" class="custom-control-input">
                        <label class="custom-control-label" for="jenisluka25">Kotor</label>
                      </div>
                    </div>
                    <!-- </div> -->

                  </div>
                </div>
              </div>


            </div>
            <div class="col-lg-12">
                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>LAIN LAIN</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row p-t-20">
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text suhu">Lainnya</span>
                                  </div>
                                  <!-- <input type="text" class="form-control" aria-label="" name="lainnya" value="<?php echo @$demografi['suhu'] ?>" > -->
                                  <textarea class="form-control" rows="4" name="lainnya"><?php echo @$asesmen['riwayat_penyakit']; ?></textarea>




                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text suhu">Rekomendasi</span>
                                  </div>
                                  <!-- <input type="text" class="form-control" aria-label="" name="rekomendasi" value="<?php echo @$demografi['suhu'] ?>"
                                   > -->
                                   <textarea class="form-control" rows="4" name="rekomendasi"><?php echo @$asesmen['riwayat_penyakit']; ?></textarea>



                                </div>
                                <!-- </div> -->

                              </div>
                            </div>
                          </div>


                        </div>


          </div>
        </div>
        <?php echo $this->Core->btn_input(); ?>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  // $(document).on("click",".kesadaran",function(){
  //   var no = $(this).attr("no");
  //   // alert("dahd");
  //   // if ($(this:checked)==true) {
  //   //   alert("dajkd");
  //   // }
  //   if($("#kesadaran"+no).is(':checked')) {
  //     $("#kesadaran"+no).prop("checked",false);
  //   }else{
  //     $("#kesadaran"+no).prop("checked",true);
  //   }
  //   // else{
  //   //   $(this).prop("checked",true);
  //   // }
  // })
  $(document).on("click",".diet",function(){
    if ($(this).val()=="lain") {
      $(".diet_lain").removeAttr("disabled");
    }else{
      $(".diet_lain").attr("disabled","disabled");
    }
  })
});
function hitung_imt(){
  // alert("hdja");
  var tb = $("#tb").val();
  var bb = $("#bb").val();
  if (tb=='') {
    tb=0;
  }
  if (bb=='') {
    bb=0;
  }
  var imt = parseInt(bb / ((tb/100)*(tb/100)));
  if (isNaN(imt) || imt<0) {
    imt=0;
  }
  $("#imt").val(imt);
}
function coba() {
  if ($("input#lain_ridul_check:checked").length == 0) {
    $("#lain_ridul").attr('disabled', true);
  } else {
    $("#lain_ridul").attr('disabled', false)
    $("#lain_ridul").focus();;
  }
}
</script>
