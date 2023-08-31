<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <?php echo form_open_multipart('Asesmen/insert');?>
          <?php echo @$error;?>
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
              <h3><a href="" class="white-text mx-3">ASESMEN AWAL KEPERAWATAN</a><h3>
              </div>
              <div class="card-body card-block">
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

                  <!-- <input type="hidden" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$kunjungan['no_urutkunjungan']; ?>" required readonly>
                  <input type="hidden" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" required readonly> -->

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>ASESMEN AWAL KEPERAWATAN</strong>
                        </div>
                        <div class="card-body card-block">
                          <div class="row p-t-20 p-b-50">
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Tanggal Kunjungan</label>
                                <div class="input-group mb-3">
                                  <input type="date" class="form-control" aria-label="" name="tanggal_kunjungan" value="<?php echo date('Y-m-d') ?>" readonly>
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Pukul : </span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="tanggal_jam_kunjungan" value="<?php echo date('H:i:s') ?>" readonly>
                                  <div class="input-group-append">
                                    <span class="input-group-text">WIB</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Keluhan Pasien</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-face-sad"></i></span>
                                  </div>
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo $kunjungan['keluhan']?>" >
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Sumber Data</label>
                                <div class="input-group mb-3">
                                  <div class="col-lg-4 col-md-6 custom-control custom-radio">
                                    <input type="radio" id="sumberdata1" name="sumberdata" checked class="custom-control-input" value="Pasien" <?php if (@$demografi['keadaan']=='Baik') {echo "checked";}?> >
                                    <label class="custom-control-label" for="sumberdata1">Pasien</label>
                                  </div>
                                  <div class="col-lg-4 col-md-6 custom-control custom-radio">
                                    <input type="radio" id="sumberdata2" name="sumberdata" class="custom-control-input" value="Keluarga" <?php if (@$demografi['keadaan']=='Baik') {echo "checked";}?> >
                                    <label class="custom-control-label" for="sumberdata2">Keluarga</label>
                                  </div>

                                  <div class="col-lg-12 col-md-12 custom-control custom-radio">
                                    <input type="radio" id="sumberdata3" name="sumberdata" class="custom-control-input" value="lain" <?php if (@$demografi['keadaan']=='Baik') {echo "checked";}?> >
                                    <label class="custom-control-label" for="sumberdata3">
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Lainnya : </span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="" name="sumberdata" value="">
                                      </div>
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Rujukan</label>
                                <div class="input-group mb-3 col-md-12">
                                  <div class="col-md-6 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="rujukan1" name="rujukan" class="custom-control-input" value="Ya" <?php if (@$demografi['keadaan']=='Baik') {echo "checked";}?> >
                                    <label class="custom-control-label" for="rujukan1">ya</label>
                                  </div>
                                  <div class="col-md-6 col-lg-4 mb-3 custom-control custom-radio">
                                    <input type="radio" id="rujukan2" name="rujukan" checked class="custom-control-input" value="Tidak" <?php if (@$demografi['keadaan']=='Baik') {echo "checked";}?> >
                                    <label class="custom-control-label" for="rujukan2">tidak</label>
                                  </div>
                                  <div class="input-group mb-3 col-md-12">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Dokter : </span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="dokter" value="<?php echo @$asesmen['dokter']?>">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">RS : </span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="rs" value="<?php echo @$asesmen['rs'] ?>">
                                  </div>
                                  <div class="input-group mb-3 col-md-12">
                                    <div class="input-group-append">
                                      <span class="input-group-text">Lainnya</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="aak_lainnya" value="<?php echo @$asesmen['aak_lainnya'] ?>">

                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12" style="margin-bottom:100px">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Diagnosa Rujukan</label>
                                <input type="text" name="diagnosa_rujukan" value="<?php echo @$asesmen['diagnosa_rujukan']; ?>" class="form-control">

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>ASESMEN KEPERAWATAN</strong>
                        </div>
                        <div class="card-body card-block">
                          <div class="row p-t-20">
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Kesadaran Umum</label>
                                <div class="input-group mb-3">
                                  <div class="col-lg-4 col-md-6 col-sm-6 custom-control custom-radio">
                                    <input type="radio" id="keadaan1" name="keadaan" checked class="custom-control-input" value="Baik" <?php if (@$demografi['keadaan']=='Baik') {echo "checked";}?> >
                                    <label class="custom-control-label" for="keadaan1">Baik</label>
                                  </div>
                                  <div class="col-lg-4 col-md-6 col-sm-6 custom-control custom-radio">
                                    <input type="radio" id="keadaan2" name="keadaan" class="custom-control-input" value="Tampak Sakit" <?php if (@$demografi['keadaan']=='Tampak Sakit') {echo "checked";}?>>
                                    <label class="custom-control-label" for="keadaan2">Tampak Sakit</label>
                                  </div>
                                  <div class="col-lg-4 col-md-6 col-sm-6 custom-control custom-radio">
                                    <input type="radio" id="keadaan3" name="keadaan" class="custom-control-input" value="Sesak" <?php if (@$demografi['keadaan']=='Sesak') {echo "checked";}?>>
                                    <label class="custom-control-label" for="keadaan3">Sesak</label>
                                  </div>
                                  <div class="col-lg-4 col-md-6 col-sm-6 custom-control custom-radio">
                                    <input type="radio" id="keadaan4" name="keadaan" class="custom-control-input" value="Pucat" <?php if (@$demografi['keadaan']=='Pucat') {echo "checked";}?>>
                                    <label class="custom-control-label" for="keadaan4">Pucat</label>
                                  </div>
                                  <div class="col-lg-4 col-md-6 col-sm-6 custom-control custom-radio">
                                    <input type="radio" id="keadaan5" name="keadaan" class="custom-control-input" value="Lemah" <?php if (@$demografi['keadaan']=='Lemah') {echo "checked";}?>>
                                    <label class="custom-control-label" for="keadaan5">Lemah</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">GCS</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">E</span>
                                  </div>
                                  <input type="number" min="1" max="6" class="form-control in_max" aria-label="" name="GCS_E" value="<?php echo @$demografi['GCS_E'] ?>" required>
                                  <div class="input-group-append">
                                    <span class="input-group-text">M</span>
                                  </div>
                                  <input type="number" min="1" max="6" class="form-control in_max" aria-label="" name="GCS_M" value="<?php echo @$demografi['GCS_M'] ?>" required>
                                  <div class="input-group-append">
                                    <span class="input-group-text">V</span>
                                  </div>
                                  <input type="number" min="1" max="6" class="form-control in_max" aria-label="" name="GCS_V" value="<?php echo @$demografi['GCS_V'] ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Tanda Vital (TTV)</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text suhu">Suhu</span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="suhu" value="<?php echo @$demografi['suhu'] ?>" required>
                                  <div class="input-group-append">
                                    <span class="input-group-text">^C</span>
                                  </div>

                                </div>
                                <div class="input-group">
                                  <div class="form-group animated flipIn">
                                    <label for="exampleInputuname">Kesadaran</label>
                                    <div class="input-group ">
                                      <div class="input-group-prepend">
                                        <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span> -->
                                      </div>
                                      <select name="kesadaran" class="mdb-select colorful-select dropdown-info sm-form" required>
                                        <option value="KOMPOMENTIS" <?php if (@$kunjungan['kesadaran']=='KOMPOMENTIS'): ?>
                                          selected
                                        <?php endif; ?>>KOMPOMENTIS (CM)</option>
                                        <option value="SOMNOLENSE" <?php if (@$kunjungan['kesadaran']=='SOMNOLENSE'): ?>
                                          selected
                                        <?php endif; ?>>SOMNOLENSE</option>
                                        <option value="STUPOR" <?php if (@$kunjungan['kesadaran']=='STUPOR'): ?>
                                          selected
                                        <?php endif; ?>>STUPOR</option>
                                        <option value="KOMA" <?php if (@$kunjungan['kesadaran']=='KOMA'): ?>
                                          selected
                                        <?php endif; ?>>KOMA</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Sistole</span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="siastole" value="<?php echo @$demografi['td'] ?>" required>
                                  <div class="input-group-append">
                                    <span class="input-group-text">mmhg</span>
                                  </div>

                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Diastole</span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="diastole" value="<?php echo @$demografi['hr'] ?>" required>
                                  <div class="input-group-append">
                                    <span class="input-group-text">mmhg</span>
                                  </div>

                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Nadi</span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="nadi" value="<?php echo @$demografi['nadi'] ?>" required>
                                  <div class="input-group-append">
                                    <span class="input-group-text">x/menit</span>
                                  </div>
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">RR</span>
                                  </div>
                                  <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$demografi['rr'] ?>" required>
                                  <div class="input-group-append">
                                    <span class="input-group-text">x/menit</span>
                                  </div>

                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>Fungsional</strong>
                        </div>
                        <div class="card-body card-block">
                          <div class="row ">
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">ADL</label>
                                <div class="input-group mb-3">
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="adl1" name="adl" checked class="custom-control-input" value="Mandiri" <?php if (@$demografi['adl']=='Mandiri') {echo "checked";} ?>>
                                    <label class="custom-control-label" for="adl1">Mandiri</label>
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="adl2" name="adl" class="custom-control-input" value="Dibantu" <?php if (@$demografi['adl']=='Dibantu') {echo "checked";} ?>>
                                    <label class="custom-control-label" for="adl2">Dibantu</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-6 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Alat Bantu</label>
                                <input type="text" class="form-control" name="alatbantu" value="<?php echo @$demografi['alatbantu'] ?>">
                              </div>
                            </div>
                            <div class="col-xl-6 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Cacat Tubuh</label>
                                <input type="text" class="form-control" name="cacattubuh" value="<?php echo @$demografi['cacattubuh'] ?>">

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="col-lg-12">
                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>PSIKOSIAL - EKONOMI - SPIRITUAL</strong>
                        </div>
                        <div class="card-body card-block">
                          <div class="row form-group">
                            <div class="col col-md-2">
                              <label class=" form-control-label">Status Emosional:</label>
                            </div>
                            <div class="col-12 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="semosi1" name="semosi" checked class="custom-control-input" value="Normal" <?php if (@$demografi['semosi']=='Normal') {echo "checked";} ?>>
                                <label class="custom-control-label" for="semosi1">Normal</label>
                              </div>
                              <div class="col-12 col-lg-3 custom-control custom-radio">
                                <input type="radio" id="semosi2" name="semosi" class="custom-control-input" value="Tidak Semangat" <?php if (@$demografi['semosi']=='Tidak Semangat') {echo "checked";} ?>>
                                <label class="custom-control-label" for="semosi2">Tidak Semangat</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="semosi3" name="semosi" class="custom-control-input" value="Tertekan" <?php if (@$demografi['semosi']=='Tertekan') {echo "checked";} ?>>
                                <label class="custom-control-label" for="semosi3">Tertekan</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="semosi4" name="semosi" class="custom-control-input" value="Depresi" <?php if (@$demografi['semosi']=='Depresi') {echo "checked";} ?>>
                                <label class="custom-control-label" for="semosi4">Depresi</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="semosi5" name="semosi" class="custom-control-input" value="Cemas" <?php if (@$demografi['semosi']=='Cemas') {echo "checked";} ?>>
                                <label class="custom-control-label" for="semosi5">Cemas</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="semosi6" name="semosi" class="custom-control-input" value="Sulit Tidur" <?php if (@$demografi['semosi']=='Sulit Tidur') {echo "checked";} ?>>
                                <label class="custom-control-label" for="semosi6">Sulit Tidur</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="semosi7" name="semosi" class="custom-control-input">
                                <label class="custom-control-label" for="semosi7">Takut</label>
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-2">
                              <label class=" form-control-label">Status Perkawinan:</label>
                            </div>
                            <div class="col-12 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="seperkawinan1" checked name="seperkawinan" value="Kawin" <?php if (@$pasien['status_kawin']=='Kawin') {echo "checked";} ?> class="custom-control-input">
                                <label class="custom-control-label" for="seperkawinan1">Kawin</label>
                              </div>
                              <div class="col-12 col-lg-3 custom-control custom-radio">
                                <input type="radio" id="seperkawinan2" name="seperkawinan" value="Belum Kawin" <?php if (@$pasien['status_kawin']=='Belum Kawin') {echo "checked";} ?> class="custom-control-input">
                                <label class="custom-control-label" for="seperkawinan2">Belum Kawin</label>
                              </div>
                              <div class="col-12 col-lg-4 custom-control custom-radio">
                                <input type="radio" id="seperkawinan3" name="seperkawinan" value="Janda / Duda" <?php if (@$pasien['status_kawin']=='Janda / Duda') {echo "checked";} ?> class="custom-control-input">
                                <label class="custom-control-label" for="seperkawinan3">Janda / Duda</label>
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-2">
                              <label class=" form-control-label">Tinggal Dengan:</label>
                            </div>
                            <div class="col-12 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="tinggal_dengan1" checked name="tinggal_dengan" value="Orang Tua" <?php if (@$pasien['tinggal_dengan']=='Orang Tua') {echo "checked";} ?> class="custom-control-input">
                                <label class="custom-control-label" for="tinggal_dengan1">Orang Tua</label>
                              </div>
                              <div class="col-12 col-lg-3 custom-control custom-radio">
                                <input type="radio" id="tinggal_dengan2" name="tinggal_dengan" value="Suami/Istri" <?php if (@$pasien['tinggal_dengan']=='Suami/Istri') {echo "checked";} ?> class="custom-control-input">
                                <label class="custom-control-label" for="tinggal_dengan2">Suami/Istri</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="tinggal_dengan3" name="tinggal_dengan" value="Anak" <?php if (@$pasien['tinggal_dengan']=='Anak') {echo "checked";} ?> class="custom-control-input">
                                <label class="custom-control-label" for="tinggal_dengan3">Anak</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="tinggal_dengan4" name="tinggal_dengan" value="Sendiri" <?php if (@$pasien['tinggal_dengan']=='Sendiri') {echo "checked";} ?> class="custom-control-input">
                                <label class="custom-control-label" for="tinggal_dengan4">Sendiri</label>
                              </div>
                              <div class="col-12 col-lg-12 custom-control custom-radio">
                                <input type="radio" id="tinggal_dengan5" name="tinggal_dengan" class="custom-control-input" value="lain"
                                <?php if (@$pasien['tinggal_dengan']!=='Orang Tua' && @$pasien['tinggal_dengan']!=='Suami' && @$pasien['tinggal_dengan']!=='Anak' && @$pasien['tinggal_dengan']!=='Sendiri' && @$pasien['tinggal_dengan'] !== null) {echo "checked";} ?>>
                                <label class="custom-control-label" for="tinggal_dengan5"><input type="text" name="tinggal_dengan_lain" class="form-control" placeholder="Lain - Lain"
                                <?php if (@$pasien['tinggal_dengan']!=='Orang Tua' && @$pasien['tinggal_dengan']!=='Suami' && @$pasien['tinggal_dengan']!=='Anak' && @$pasien['tinggal_dengan']!=='Sendiri' && @$pasien['tinggal_dengan'] !== null) {echo "value='".@$pasien['tinggal_dengan']."'";} ?> > </label>
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-2">
                              <label class=" form-control-label">Pekerjaan:</label>
                            </div>
                            <div class="col-12 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="pekerjaan1" name="pekerjaan" value="PNS/TNI/POLRI" <?php if (@$pasien['pekerjaan']=="PNS/TNI/POLRI") {echo "checked";} ?> class="custom-control-input">
                                <label class="custom-control-label" for="pekerjaan1">PNS/TNI/POLRI</label>
                              </div>
                              <div class="col-12 col-lg-3 custom-control custom-radio">
                                <input type="radio" id="pekerjaan2" name="pekerjaan" value="Wiraswasta" <?php if (@$pasien['pekerjaan']=="Wiraswasta") {echo "checked";} ?> class="custom-control-input">
                                <label class="custom-control-label" for="pekerjaan2">Wiraswasta</label>
                              </div>
                              <div class="col-12 col-lg-6 custom-control custom-radio">
                                <input type="radio" id="pekerjaan3" name="pekerjaan" class="custom-control-input" value="lain"
                                <?php if (@$pasien['pekerjaan']!=='PNS/TNI/POLRI' && @$pasien['pekerjaan']!=='Wiraswasta' && @$pasien['pekerjaan'] !== null) {echo "checked";} ?>>
                                <label class="custom-control-label" for="pekerjaan3"><input type="text" name="pekerjaan_lain" class="form-control" placeholder="Lain - Lain" id="pekerjaan"
                                <?php if (@$pasien['pekerjaan']!=='PNS/TNI/POLRI' && @$pasien['pekerjaan']!=='Wiraswasta' && @$pasien['pekerjaan'] !== null) {echo "value='".@$pasien['pekerjaan']."'";} ?> > </label>
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-2">
                              <label class=" form-control-label">Cara Pembayaran:</label>
                            </div>
                            <div class="col-12 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="cara_pembayaran1" name="cara_pembayaran" value="Pribadi" <?php if (@$jenispasien['jenis_pasien']=="UMUM") {echo "checked";} ?> class="custom-control-input">
                                <label class="custom-control-label" for="cara_pembayaran1">Pribadi</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="cara_pembayaran2" name="cara_pembayaran" value="Asuransi" <?php if (@$jenispasien['jenis_pasien']=="ASURANSI LAIN") {echo "checked";} ?> class="custom-control-input">
                                <label class="custom-control-label" for="cara_pembayaran2">Asuransi</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="cara_pembayaran3" name="cara_pembayaran" value="BBJS" <?php if (@$jenispasien['jenis_pasien']=="BPJS KESEHATAN" || @$jenispasien['jenis_pasien']=="BPJS KETENAGAKERJAAN") {echo "checked";} ?> class="custom-control-input">
                                <label class="custom-control-label" for="cara_pembayaran3">BPJS</label>
                              </div>
                              <div class="col-12 col-lg-5 custom-control custom-radio">
                                <input type="radio" id="cara_pembayaran4" name="cara_pembayaran" class="custom-control-input" value="lain"
                                <?php if (@$demografi['cara_pembayaran']!=='Pribadi' && @$demografi['cara_pembayaran']!=='Asuransi' && @$demografi['cara_pembayaran'] !== 'BBJS' && @$demografi['cara_pembayaran'] !== null) {echo "checked";} ?>>
                                <label class="custom-control-label" for="cara_pembayaran4"><input type="text" name="cara_pembayaran_lain" class="form-control" placeholder="Lain - Lain"
                                <?php if (@$demografi['cara_pembayaran']!=='Pribadi' && @$demografi['cara_pembayaran']!=='Asuransi' && @$demografi['cara_pembayaran'] !== 'BBJS' && @$demografi['cara_pembayaran'] !== null) {echo "value='".@$demografi['cara_pembayaran']."'";} ?> > </label>
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-2">
                              <label class=" form-control-label">Agama:</label>
                            </div>
                            <div class="col-12 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" checked id="agama1" value="Islam" <?php if (@$pasien['agama']=="islam") {echo "checked";} ?> name="agama" class="custom-control-input">
                                <label class="custom-control-label" for="agama1">Islam</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="agama2" value="Hindu" <?php if (@$pasien['agama']=="hindu") {echo "checked";} ?> name="agama" class="custom-control-input">
                                <label class="custom-control-label" for="agama2">Hindu</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="agama3" value="Buddha" <?php if (@$pasien['agama']=="buddha") {echo "checked";} ?> name="agama" class="custom-control-input">
                                <label class="custom-control-label" for="agama3">Buddha</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="agama4" value="Khatolik" <?php if (@$pasien['agama']=="khatolik") {echo "checked";} ?> name="agama" class="custom-control-input">
                                <label class="custom-control-label" for="agama4">Khatolik</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="agama5" value="Kristen" <?php if (@$pasien['agama']=="kristen") {echo "checked";} ?> name="agama" class="custom-control-input">
                                <label class="custom-control-label" for="agama5">Kristen</label>
                              </div>
                              <div class="col-12 col-lg-5 custom-control custom-radio">
                                 <input type="radio" id="agama6" name="agama" class="custom-control-input" value="lain"
                                <?php if (@$pasien['agama']!=='islam' && @$pasien['agama']!=='hindu' && @$pasien['agama']!=='buddha' && @$pasien['agama']!=='khatolik' && @$pasien['agama']!=='kristen' && @$pasien['agama'] !== null) {echo "checked";} ?>>
                                <label class="custom-control-label" for="agama6"><input type="text" name="agama_lain" class="form-control" placeholder="Lain - Lain"
                                <?php if (@$pasien['agama']!=='islam' && @$pasien['agama']!=='hindu' && @$pasien['agama']!=='buddha' && @$pasien['agama']!=='khatolik' && @$pasien['agama']!=='kristen' && @$pasien['agama'] !== null) {echo "value='".@$demografi['kebiasaan']."'";} ?> > </label>
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-2">
                              <label class=" form-control-label">Kebiasaan:</label>
                            </div>
                            <div class="col-12 col-md-10 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="kebiasaan1" value="Merokok" <?php if (@$demografi['kebiasaan']=="Merokok") {echo "checked";} ?> name="kebiasaan" class="custom-control-input">
                                <label class="custom-control-label" for="kebiasaan1">Merokok</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="kebiasaan2" value="Alchohol" <?php if (@$demografi['kebiasaan']=="Alchohol") {echo "checked";} ?> name="kebiasaan" class="custom-control-input">
                                <label class="custom-control-label" for="kebiasaan2">Alchohol</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input checked type="radio" id="kebiasaan3" name="kebiasaan" class="custom-control-input" value="lain"
                                <?php if (@$demografi['kebiasaan']!=='Merokok' && @$demografi['kebiasaan']!=='Alchohol' && @$demografi['kebiasaan'] !== null) {echo "checked";} ?>>
                                <label class="custom-control-label" for="kebiasaan3"><input type="text" name="kebiasaan_lain" class="form-control" placeholder="Lain - Lain"
                                <?php if (@$demografi['kebiasaan']!=='Merokok' && @$demografi['kebiasaan']!=='Alchohol' && @$demografi['kebiasaan'] !== null)  {echo "value='".@$demografi['kebiasaan']."'";} ?> > </label>
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-4">
                              <label class=" form-control-label">Nilai - Nilai Budaya Dalam keluarga yang Mepengaruhi pada kesalahan:</label>
                            </div>
                            <div class="col-12 col-md-8 row text-right">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="kebudayaan1" value="Ya" <?php if (@$demografi['kebudayaan']=="Ya") {echo "checked";} ?> name="kebudayaan" class="custom-control-input">
                                <label class="custom-control-label" for="kebudayaan1">Ya</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="kebudayaan2" checked value="Tidak" <?php if (@$demografi['kebudayaan']=="Tidak") {echo "checked";} ?> name="kebudayaan" class="custom-control-input">
                                <label class="custom-control-label" for="kebudayaan2">Tidak</label>
                              </div>
                              <div class="col-12 col-lg-8 custom-control custom-radio">
                                <input type="text" name="kebudayaan_lain" maxlength="200" placeholder="Jelaskan ......" class="form-control" value="<?php echo @$demografi['kebudayaan_lain'] ?>">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>KOMUNIKASI DAN EDUKASI</strong>
                        </div>
                        <div class="card-body card-block">
                          <div class="row form-group">
                            <div class="col col-md-4">
                              <label class=" form-control-label">Masalah Bicara :</label>
                            </div>
                            <div class="col-12 col-md-12 row">
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="masbir1" value="Ya" <?php if (@$demografi['masbir']=="Ya") {echo "checked";} ?> name="masbir" class="custom-control-input">
                                <label class="custom-control-label" for="masbir1">Ya</label>
                              </div>
                              <div class="col-12 col-lg-2 custom-control custom-radio">
                                <input type="radio" id="masbir2" checked value="Tidak" <?php if (@$demografi['masbir']=="Tidak") {echo "checked";} ?> name="masbir" class="custom-control-input">
                                <label class="custom-control-label" for="masbir2">Tidak</label>
                              </div>
                              <div class="col-12 col-lg-8 custom-control custom-radio">
                                <input type="text" name="masbir_lain" value="<?php echo @$demografi['masbir_lain'] ?>" maxlength="200" placeholder="Jelaskan ......" class="form-control">
                              </div>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-5">
                              <label class=" form-control-label">Bahasa Sehari - Hari :</label>
                            </div>
                            <div class="col-12 col-md-12 row">
                              <div class="col-12 col-lg-4 custom-control custom-radio">
                                <input type="radio" id="bahasa1" checked value="B.Indonesia" <?php if (@$demografi['bahasa']=="B.Indonesia") {echo "checked";} ?> name="bahasa" class="custom-control-input">
                                <label class="custom-control-label" for="bahasa1">B. Indonesia</label>
                              </div>
                              <div class="col-12 col-lg-4 custom-control custom-radio">
                                <input type="radio" id="bahasa2" value="B.Inggris" <?php if (@$demografi['bahasa']=="B.Inggris") {echo "checked";} ?> name="bahasa" class="custom-control-input">
                                <label class="custom-control-label" for="bahasa2">B. Inggris</label>
                              </div>
                              <div class="col-12 col-lg-4 custom-control custom-radio">
                                <input type="radio" id="bahasa3" value="B.Isyarat" <?php if (@$demografi['bahasa']=="B.Isyarat") {echo "checked";} ?> name="bahasa" class="custom-control-input">
                                <label class="custom-control-label" for="bahasa3">B. Isyarat</label>
                              </div>
                              <div class="col-12 col-lg-9 custom-control custom-radio">
                                <input type="radio" id="bahasa4" name="bahasa" class="custom-control-input" value="lain"
                                <?php if (@$demografi['bahasa']!=='B.Indonesia' && @$demografi['bahasa']!=='B.Inggris' && @$demografi['bahasa']!=='B.Isyarat' && @$demografi['bahasa'] !== null) {echo "checked";} ?>>
                                <label class="custom-control-label" for="bahasa4"><input type="text" name="bahasa_lain" class="form-control" placeholder="Lain - Lain"
                                  <?php if (@$demografi['bahasa']!=='B.Indonesia' && @$demografi['bahasa']!=='B.Inggris' && @$demografi['bahasa']!=='B.Isyarat' && @$demografi['bahasa'] !== null)  {echo "value='".@$demografi['bahasa']."'";} ?> > </label>
                                </div>
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-7">
                                <label class=" form-control-label">Potensial Kebutuhan Edukasi :</label>
                              </div>
                              <div class="col-12 col-md-12 row">
                                <div class="col-12 col-lg-5 custom-control custom-radio">
                                  <input type="radio" id="potensi1" checked value="Proses Penyakit" <?php if (@$demografi['potensi']=="Proses Penyakit") {echo "checked";} ?> name="potensi" class="custom-control-input">
                                  <label class="custom-control-label" for="potensi1">Proses Penyakit</label>
                                </div>
                                <div class="col-12 col-lg-3 custom-control custom-radio">
                                  <input type="radio" id="potensi2" value="Nutrisi" <?php if (@$demografi['potensi']=="Nutrisi") {echo "checked";} ?>  name="potensi" class="custom-control-input">
                                  <label class="custom-control-label" for="potensi2">Nutrisi</label>
                                </div>
                                <div class="col-12 col-lg-4 custom-control custom-radio">
                                  <input type="radio" id="potensi3" value="Pengobatan/Tindakan" <?php if (@$demografi['potensi']=="Pengobatan/Tindakan") {echo "checked";} ?>  name="potensi" class="custom-control-input">
                                  <label class="custom-control-label" for="potensi3">Pengobatan/Tindakan</label>
                                </div>
                                <div class="col-12 col-lg-9 custom-control custom-radio">
                                  <input type="radio" id="potensi4" name="potensi" class="custom-control-input" value="lain"
                                  <?php if (@$demografi['potensi']!=='Proses Penyakit' && @$demografi['potensi']!=='Nutrisi' && @$demografi['potensi']!=='Pengobatan/Tindakan' && @$demografi['potensi'] !== null) {echo "checked";} ?>>
                                  <label class="custom-control-label" for="potensi4"><input type="text" name="potensi_lain" class="form-control" placeholder="Lain - Lain"
                                    <?php if (@$demografi['potensi']!=='Proses Penyakit' && @$demografi['potensi']!=='Nutrisi' && @$demografi['potensi']!=='Pengobatan/Tindakan' && @$demografi['potensi'] !== null)  {echo "value='".@$demografi['potensi']."'";} ?> > </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>RIWAYAT KESEHATAN</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row form-group">
                                <div class="col col-md-4">
                                  <label class=" form-control-label">Riwayat Alergi :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-5 custom-control custom-radio">
                                    <input type="radio" id="alergi1" value="Belum Diketahui" <?php if (@$demografi['alergi']=="Belum Diketahui") {echo "checked";} ?> name="alergi" class="custom-control-input">
                                    <label class="custom-control-label" for="alergi1">Belum Diketahui</label>
                                  </div>
                                  <div class="col-12 col-lg-3 custom-control custom-radio">
                                    <input type="radio" id="alergi2" checked value="Tidak Ada" <?php if (@$demografi['alergi']=="Tidak Ada") {echo "checked";} ?> name="alergi" class="custom-control-input">
                                    <label class="custom-control-label" for="alergi2">Tidak Ada</label>
                                  </div>
                                  <div class="col-12 col-lg-12 custom-control custom-radio">
                                    <input type="radio" id="alergi3" name="alergi" class="custom-control-input" value="lain"
                                    <?php if (@$demografi['alergi']!=='Belum Diketahui' && @$demografi['alergi']!=='Tidak Ada' && @$demografi['alergi'] !== null) {echo "checked";} ?>>
                                    <label class="custom-control-label" for="alergi3">
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Alergi Jenis</span>
                                        </div>
                                        <input type="text" name="potensi_lain" class="form-control" placeholder="Lain - Lain"
                                        <?php if (@$demografi['alergi']!=='Belum Diketahui' && @$demografi['alergi']!=='Tidak Ada' && @$demografi['potensi']!=='Pengobatan/Tindakan' && @$demografi['alergi'] !== null)  {echo "value='".@$demografi['alergi']."'";} ?> >
                                        <div class="input-group-append">
                                          <span class="input-group-text">Reaksi</span>
                                        </div>
                                        <input type="text" value="<?php echo @$demografi['alergi_reaksi'] ?>" name="alergi_reaksi" class="form-control" aria-label="" name="hr">
                                      </div>
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-5">
                                  <label class=" form-control-label">Riwayat Penyakit Dulu :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="penyakit_dahulu1" checked value="Tidak Ada" <?php if (@$demografi['penyakit_dahulu']=="Tidak Ada") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                                    <label class="custom-control-label" for="penyakit_dahulu1">Tidak Ada</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="penyakit_dahulu2" value="Hipertensi" <?php if (@$demografi['penyakit_dahulu']=="Hipertensi") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                                    <label class="custom-control-label" for="penyakit_dahulu2">Hipertensi</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="penyakit_dahulu3" <?php if (@$demografi['penyakit_dahulu']=="TB Paru") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                                    <label class="custom-control-label" for="penyakit_dahulu3">TB Paru</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="penyakit_dahulu4" value="Jantung" <?php if (@$demografi['penyakit_dahulu']=="Jantung") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                                    <label class="custom-control-label" for="penyakit_dahulu4">Jantung</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="penyakit_dahulu5" value="Stroke" <?php if (@$demografi['penyakit_dahulu']=="Stroke") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                                    <label class="custom-control-label" for="penyakit_dahulu5">Stroke</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="penyakit_dahulu6" value="Asma" <?php if (@$demografi['penyakit_dahulu']=="Asma") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                                    <label class="custom-control-label" for="penyakit_dahulu6">Asma</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="penyakit_dahulu66" value="Kejang" <?php if (@$demografi['penyakit_dahulu']=="Kejang") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                                    <label class="custom-control-label" for="penyakit_dahulu66">Kejang</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="penyakit_dahulu7" value="Diabetes Melitus" <?php if (@$demografi['penyakit_dahulu']=="Diabetes Melitus") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                                    <label class="custom-control-label" for="penyakit_dahulu7">Diabetes Melitus</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="penyakit_dahulu8" name="penyakit_dahulu" value="lain" class="custom-control-input">
                                    <label class="custom-control-label" for="penyakit_dahulu8"> <input type="text" placeholder="Lain - Lain ......" class="form-control" name="penyakit_dahulu[]" value=""> </label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-7">
                                  <label class=" form-control-label">Riwayat Penyakit Keluarga :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-5 custom-control custom-checkbox">
                                    <input type="checkbox" id="riwayat_penyakit_keluarga1" checked name="riwayat_penyakit_keluarga[]" class="custom-control-input" value="Tidak Ada">
                                    <label class="custom-control-label" for="riwayat_penyakit_keluarga1">Tidak Ada</label>
                                  </div>
                                  <div class="col-12 col-lg-3 custom-control custom-checkbox">
                                    <input type="checkbox" id="riwayat_penyakit_keluarga2" name="riwayat_penyakit_keluarga[]" class="custom-control-input" value="Hipertensi">
                                    <label class="custom-control-label" for="riwayat_penyakit_keluarga2">Hipertensi</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="riwayat_penyakit_keluarga3" name="riwayat_penyakit_keluarga[]" class="custom-control-input" value="TB Paru">
                                    <label class="custom-control-label" for="riwayat_penyakit_keluarga3">TB Paru</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="riwayat_penyakit_keluarga4" name="riwayat_penyakit_keluarga[]" class="custom-control-input" value="Diabetes Melitus">
                                    <label class="custom-control-label" for="riwayat_penyakit_keluarga4">Diabetes Melitus</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-checkbox">
                                    <input type="checkbox" id="riwayat_penyakit_keluarga5" name="riwayat_penyakit_keluarga[]" class="custom-control-input" valu="lain">
                                    <label class="custom-control-label" for="riwayat_penyakit_keluarga5"><input type="text" class="form-control" placeholder="Lain - Lain ...." name="riwayat_penyakit_keluarga[]" value=""> </label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-7">
                                  <label class=" form-control-label">Riwayat Operasi :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-3 custom-control custom-radio">
                                    <input type="radio" id="riwayat_operasi1" checked name="riwayat_operasi" value="Tidak" class="custom-control-input" value="Tidak">
                                    <label class="custom-control-label" for="riwayat_operasi1">Tidak</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-radio">
                                    <input type="radio" id="riwayat_operasi2" name="riwayat_operasi" class="custom-control-input" value="Ya">
                                    <label class="custom-control-label" for="riwayat_operasi2">
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Ya,</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Riwayat Operasi :" aria-label="" name="riwayat_operasi">
                                      </div>
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-7">
                                  <label class=" form-control-label">Riwayat Tranfusi :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-3 custom-control custom-radio">
                                    <input type="radio" id="riwayat_tranfusi" checked name="riwayat_tranfusi" value="Tidak" class="custom-control-input">
                                    <label class="custom-control-label" for="riwayat_tranfusi">Tidak</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-radio">
                                    <input type="radio" id="riwayat_tranfusi2" name="riwayat_tranfusi" class="custom-control-input" value="Ya">
                                    <label class="custom-control-label" for="riwayat_tranfusi2">
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Ya,</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Reaksi Muncul :" aria-label="" name="riwayat_tranfusi_ya">
                                      </div>
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-7">
                                  <label class=" form-control-label">Golongan Darah :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="golongan_darah1" name="golongan_darah" value="A" class="custom-control-input">
                                    <label class="custom-control-label" for="golongan_darah1">A</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="golongan_darah2" name="golongan_darah" value="B" class="custom-control-input">
                                    <label class="custom-control-label" for="golongan_darah2">B</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="golongan_darah3" name="golongan_darah" value="AB" class="custom-control-input">
                                    <label class="custom-control-label" for="golongan_darah3">AB</label>
                                  </div>
                                  <div class="col-12 col-lg-2 custom-control custom-radio">
                                    <input type="radio" id="golongan_darah4" name="golongan_darah" value="O" class="custom-control-input">
                                    <label class="custom-control-label" for="golongan_darah4">O</label>
                                  </div>
                                  <div class="col-12 col-lg-3 custom-control custom-radio">
                                    <input type="radio" id="golongan_darah5" checked name="golongan_darah" value="tidak tahu" class="custom-control-input">
                                    <label class="custom-control-label" for="golongan_darah5">Tidak Tahu</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="col-lg-6">
                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>PENILAIAN NYERI</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row form-group">
                                <div class="col col-md-4">
                                  <label class=" form-control-label">Adakan Keluhan Nyeri :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-3 custom-control custom-radio">
                                    <input type="radio" id="keluhan_nyeri1" checked name="keluhan_nyeri" value="Tidak" class="custom-control-input">
                                    <label class="custom-control-label" for="keluhan_nyeri1">Tidak</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-radio">
                                    <input type="radio" id="keluhan_nyeri2" name="keluhan_nyeri" value="Ya" class="custom-control-input">
                                    <label class="custom-control-label" for="keluhan_nyeri2">Ya, Lanjutkan Pengisian</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-5">
                                  <label class=" form-control-label">Penyebab / Provoke :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-12 custom-control custom-radio">
                                    <input type="text" class="form-control" name="penyebab_provoke" value="">
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-7">
                                  <label class=" form-control-label">Kualitas / Quality :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="kualitas_quality1" name="kualitas_quality[]" value="Menekan" class="custom-control-input">
                                    <label class="custom-control-label" for="kualitas_quality1">Menekan</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="kualitas_quality2" name="kualitas_quality[]" value="Menusuk" class="custom-control-input">
                                    <label class="custom-control-label" for="kualitas_quality2">Menusuk</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="kualitas_quality3" name="kualitas_quality[]" value="Berdenyut - Denyut" class="custom-control-input">
                                    <label class="custom-control-label" for="kualitas_quality3">Berdenyut - Denyut</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="kualitas_quality4" name="kualitas_quality[]" value="Menyebar" class="custom-control-input">
                                    <label class="custom-control-label" for="kualitas_quality4">Menyebar</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="kualitas_quality5" name="kualitas_quality[]" value="Menyengat" class="custom-control-input">
                                    <label class="custom-control-label" for="kualitas_quality5">Menyengat</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-checkbox">
                                    <input type="checkbox" id="kualitas_quality6" name="kualitas_quality[]" value="Pedih" class="custom-control-input">
                                    <label class="custom-control-label" for="kualitas_quality6">Pedih</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-5">
                                  <label class=" form-control-label">Lokasi / Radius :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-12 custom-control custom-radio">
                                    <input type="text" class="form-control" name="lokasi_radius" value="<?php echo @$asesmen['lokasi_radius'] ?>">
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-4">
                                  <label class=" form-control-label">Intensitas / Scala :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="intensitas1" name="intensitas" value="Wong Baker Face Pain" class="custom-control-input">
                                    <label class="custom-control-label" for="intensitas1">Wong Baker Face Pain</label>
                                  </div>
                                  <div class="col-12 col-lg-5 custom-control custom-radio">
                                    <input type="radio" id="intensitas2" name="intensitas" value="Numeric Ranting Scale (NRS)" class="custom-control-input">
                                    <label class="custom-control-label" for="intensitas2">Numeric Ranting Scale (NRS)</label>
                                  </div>
                                  <div class="col-12 col-lg-3 custom-control custom-radio">
                                    <input type="radio" id="intensitas3" name="intensitas" value="FLACC" class="custom-control-input">
                                    <label class="custom-control-label" for="intensitas3">FLACC</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-radio">
                                    <input type="radio" id="intensitas4" name="intensitas" value="lain" class="custom-control-input">
                                    <label class="custom-control-label" for="intensitas4">
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Lainnya</span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="" name="intensitas">
                                        <div class="input-group-append">
                                          <span class="input-group-text">Score</span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="" name="intensitas_score">
                                      </div>
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-7">
                                  <label class=" form-control-label">Kategori Nyeri :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="kategori_nyeri1" checked name="kategori_nyeri" value="Tidak Nyeri" class="custom-control-input">
                                    <label class="custom-control-label" for="kategori_nyeri1">Tidak Nyeri</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="kategori_nyeri2" name="kategori_nyeri" value="Ringan" class="custom-control-input">
                                    <label class="custom-control-label" for="kategori_nyeri2">Ringan</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="kategori_nyeri3" name="kategori_nyeri" value="Sedang" class="custom-control-input">
                                    <label class="custom-control-label" for="kategori_nyeri3">Sedang</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="kategori_nyeri4" name="kategori_nyeri" value="Berat" class="custom-control-input">
                                    <label class="custom-control-label" for="kategori_nyeri4">Berat</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="kategori_nyeri5" name="kategori_nyeri" value="Hebat" class="custom-control-input">
                                    <label class="custom-control-label" for="kategori_nyeri5">Hebat</label>
                                  </div>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="kategori_nyeri6" name="kategori_nyeri" value="Sangat Hebat" class="custom-control-input">
                                    <label class="custom-control-label" for="kategori_nyeri6">Sangat Hebat</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-4">
                                  <label class=" form-control-label">Durasi Nyeri :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-12 custom-control custom-radio">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Mulai Kapan</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="durasi_nyeri_mk">
                                      <div class="input-group-append">
                                        <span class="input-group-text">Berapa Lama</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="durasi_nyeri_bl">
                                      <div class="input-group-append">
                                        <span class="input-group-text">Frekuensi</span>
                                      </div>
                                      <input type="text" class="form-control" aria-label="" name="durasi_nyeri_f">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-5">
                                  <label class=" form-control-label">Nyeri Hilang Jika :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-12 custom-control custom-radio">
                                    <input type="text" class="form-control" name="nyeri_hilang" value="<?php echo @$asesmen['nyeri_hilang'] ?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>PENILAIAN RESIKO JATUH</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row form-group">
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-9 custom-control custom-radio">
                                    <input type="radio" id="prj_umur1" checked name="prj_umur" class="custom-control-input" value="Anak">
                                    <label class="custom-control-label" for="prj_umur1">Anak - Anak / < 18Th (Humpty Dumpty Fall Scale)</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-radio">
                                    <input type="radio" id="prj_umur2" name="prj_umur" class="custom-control-input" value="Dewasa">
                                    <label class="custom-control-label" for="prj_umur2">Dewasa / 18 - 59 Th (Morse Fall Scale)</label>
                                  </div>
                                  <div class="col-12 col-lg-9 custom-control custom-radio">
                                    <input type="radio" id="prj_umur3" name="prj_umur" class="custom-control-input" value="Lansia">
                                    <label class="custom-control-label" for="prj_umur3">Lansia / >60 Th (Sidney Fall Scale)</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-12 col-md-12 row">
                                  <div class="col col-md-2">
                                    <label class=" form-control-label">Total Skor :</label>
                                  </div>
                                  <div class="col-12 col-lg-10 custom-control custom-radio">
                                    <input type="text" placeholder="Total Skor ....." class="form-control" name="prj_skor" value="<?php echo @$asesmen['prj_skor'] ?>">
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-12 col-md-12 row">
                                  <div class="col col-md-2">
                                    <label class=" form-control-label">Kategori :</label>
                                  </div>
                                  <div class="col-12 col-lg-3 custom-control custom-radio">
                                    <input type="radio" id="prj_kategori1" checked name="prj_kategori" class="custom-control-input" value="Risiko Rendah">
                                    <label class="custom-control-label" for="prj_kategori1">Risiko Rendah</label>
                                  </div>
                                  <div class="col-12 col-lg-3 custom-control custom-radio">
                                    <input type="radio" id="prj_kategori2" name="prj_kategori" class="custom-control-input" value="Risiko Sedang">
                                    <label class="custom-control-label" for="prj_kategori2">Risiko Sedang</label>
                                  </div>
                                  <div class="col-12 col-lg-3 custom-control custom-radio">
                                    <input type="radio" id="prj_kategori3" name="prj_kategori" class="custom-control-input" value="Risiko Tinggi">
                                    <label class="custom-control-label" for="prj_kategori3">Risiko Tinggi</label>
                                  </div>
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
                              <strong>PENILAIAN NUTRISI</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row form-group col-12">
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">BB</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="pn_bb" id="bb_dewasa" onkeyup="hitung_imt()" >
                                    <div class="input-group-append">
                                      <span class="input-group-text">/Kg</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">TB</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="pn_tb" id="tb_dewasa" onkeyup="hitung_imt()">
                                    <div class="input-group-append">
                                      <span class="input-group-text">cm</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">LILA</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="pn_lila" >
                                    <div class="input-group-append">
                                      <span class="input-group-text">cm</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">IMT</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="pn_imt" id="imt">
                                    <div class="input-group-append">
                                      <span class="input-group-text">kh/cm2</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group col-12">
                                <div class="card-header col-12">
                                  <strong>Malnutrion Screening Tool (MST)</strong> untuk pasien dewasa
                                </div><br>
                                <div class="col-lg-6 row">
                                  <strong>1. Apakah ada penurunan berat badan yang tidak diinginkan selam 6 bulan terakhir?</strong>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="mst_11" checked name="mst_1" class="custom-control-input" value="Tidak">
                                    <label class="custom-control-label" for="mst_11">Tidak : skor 0</label>
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="mst_12" name="mst_1" class="custom-control-input" value="Tidak Yakin">
                                    <label class="custom-control-label" for="mst_12">Tidak Yakin : skor 1</label>
                                  </div>
                                  <div class="col-12 col-lg-12 custom-control custom-radio">
                                    <input type="radio" id="mst_13" name="mst_1" class="custom-control-input" value="lain">
                                    <label class="custom-control-label" for="mst_13">Ya, 1-5kg (skor 1), 6-10 (skor 2), 10-15 (skor 3), <= 15 (skor 4)</label>
                                    <input type="text" class="form-control" placeholder="Penurunan Berat badan" name="mst_1_lain">
                                  </div>
                                  <br><br><br><br>
                                  <strong>2. Apakah asupan makan menurun dikarenakan adanya penurunan nafsu makan atau kesulitan menerima makanan ?</strong>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="mst_21" checked name="mst_2" class="custom-control-input" value="Tidak">
                                    <label class="custom-control-label" for="mst_21">Tidak : skor 0</label>
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="mst_22" name="mst_2" class="custom-control-input" value="Ya">
                                    <label class="custom-control-label" for="mst_22">Ya : skor 2</label>
                                  </div>
                                </div>
                                <div class="col-lg-6 bg-secondary">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">TOTAL SKOR :</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="mst_skor" value="0">
                                  </div>
                                  <b>Keterangan :</b><br>
                                  Skor 0 - 1 : Tidak beresiko<br>
                                  Skor 3 - 4 : beresiko (memerlukan asesmen gizi)<br>
                                  Skor <= 4  : Malnutrisi
                                </div>
                              </div>
                              <div class="row form-group col-12">
                                <div class="card-header col-12">
                                  <strong>Modifikasi strongkids</strong> untuk pasien anak
                                </div><br>
                                <div class="col-lg-6 row">
                                  <strong class="col-12">1. Apakah ada penyakit yang beresiko Malnutrisi atau adakah tindakan pembedahan besar?</strong>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="strongkids11" checked name="strongkids1" class="custom-control-input" value="Tidak">
                                    <label class="custom-control-label" for="strongkids11">Tidak : skor 0</label>
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="strongkids12" name="strongkids1" class="custom-control-input" value="Ya">
                                    <label class="custom-control-label" for="strongkids12">Ya : skor 2</label>
                                  </div>
                                  <br><br>
                                  <strong class="col-12">2. Apakah pasien tampak kurus ?</strong>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="strongkids21" checked name="strongkids2" class="custom-control-input" value="Tidak">
                                    <label class="custom-control-label" for="strongkids21">Tidak : skor 0</label>
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="strongkids22" name="strongkids2" class="custom-control-input" value="Ya">
                                    <label class="custom-control-label" for="strongkids22">Ya : skor 1</label>
                                  </div>
                                  <br><br>
                                  <strong class="col-12">3. Apakah terdapat salah satu dari kondisi berikut (dalam 1 minggu terakhir) ?</strong>
                                  <div class="col-12">
                                    - Diare >5x/hari dan/atau muntah >3xhari <br>
                                    - Asupan makan berkurang
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="strongkids31" checked name="strongkids3" class="custom-control-input" value="Tidak">
                                    <label class="custom-control-label" for="strongkids31">Tidak : skor 0</label>
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="strongkids32" name="strongkids3" class="custom-control-input" value="Ya">
                                    <label class="custom-control-label" for="strongkids32">Ya : skor 1</label>
                                  </div>
                                  <br><br>
                                  <strong class="col-12">4. Apakah terjadi penurunan berat badan ataukah tidak ada peningkatan berat badan dalam 1 bulan terakhir ?</strong>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="strongkids41" checked name="strongkids4" class="custom-control-input" value="Tidak">
                                    <label class="custom-control-label" for="strongkids41">Tidak : skor 0</label>
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="strongkids42" name="strongkids4" class="custom-control-input" value="Ya">
                                    <label class="custom-control-label" for="strongkids42">Ya : skor 1</label>
                                  </div>
                                </div>
                                <div class="col-lg-6 bg-secondary">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">TOTAL SKOR :</span>
                                    </div>
                                    <input type="text" value="0" class="form-control" aria-label="" name="strongkids_skor">
                                  </div>
                                  <b>Keterangan :</b><br>
                                  Skor 0 - 1 : Tidak beresiko<br>
                                  Skor 3 - 4 : beresiko (memerlukan asesmen gizi)<br>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php if ($_SESSION['poli']=="OBG"): ?>
                          <hr>
                          <h4> <b>Riwayat Kehamilan, Persalinan dan Nifas yang lalu</b> <button class="btn btn-info" type="button" data-toggle="modal" data-target="#tambahriwayat"><i class="fa fa-plus"></i> Tambah Riwayat
                          </button></h4>
                          <div class="table-responsive mb-3" id="riwayat">
                            <table id="example22" class="table table-striped table-bordered table-hover">
                              <thead>
                                <th>Tahun Partus</th>
                                <th>Tempat Partus</th>
                                <th>Umur Hamil</th>
                                <th>Jenis Persalinan</th>
                                <th>Penolong</th>
                                <th>Penyulit</th>
                                <th>JK</th>
                                <th>BB</th>
                                <th>H/M</th>
                                <th>Opsi</th>
                              </thead>
                              <tbody id="tabel_riwayat">

                              </tbody>
                            </table>
                          </div>
                          <div id="tambahriwayat" class="modal fade" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Tambah Riwayat</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="fa fa-window-close"></i></button>
                                  </div>
                                  <div class="modal-body">
                                    <?php $this->load->view('Pasien/riwayatobgyn') ?>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-primary input_riwayat">Tambahkan</button>
                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card border-primary" style="border: 2px solid;">
                            <div class="card-header bg-primary text-white">
                              <strong>Riwayat Kesehatan Sekarang :</strong>
                            </div>
                            <input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$idkunjungan; ?>" hidden>
                            <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" hidden>
                            <div class="card-body card-block">
                              1. Riwayat Menstruasi
                              <div class="row p-t-10">
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <label class=" form-control-label">Menarche Umur :</label>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="input-group">
                                        <input type="number" name="manarcheumur" class="form-control" placeholder="Menarche Umur">
                                        <div class="input-group-append"><span class="input-group-text">Th</span></div>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <label class=" form-control-label">Lamanya Haid :</label>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="input-group">
                                        <input type="number" name="lamahaid" class="form-control" placeholder="Lamanya Haid :">
                                        <div class="input-group-append"><span class="input-group-text">hari</span></div>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <label class=" form-control-label">Siklus :</label>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-radio">
                                        <input type="radio" id="siklus1" name="siklus" class="custom-control-input" value="Teratur">
                                        <label class="custom-control-label" for="siklus1">Teratur</label>
                                      </div>
                                      <div class="custom-control custom-radio">
                                        <input type="radio" id="siklus2" name="siklus" class="custom-control-input" value="Tidak">
                                        <label class="custom-control-label" for="siklus2">Tidak</label>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <label class=" form-control-label">Keluhan :</label>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="keluhan1" name="keluhan_obgyn[]" value="Dismenorhoe" class="custom-control-input">
                                        <label class="custom-control-label" for="keluhan1">Dismenorhoe</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="keluhan2" name="keluhan_obgyn[]" value="Spotting" class="custom-control-input">
                                        <label class="custom-control-label" for="keluhan2">Spotting</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="keluhan3" name="keluhan_obgyn[]" value="Menorrhargia" class="custom-control-input">
                                        <label class="custom-control-label" for="keluhan3">Menorrhargia</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="keluhan4" name="keluhan_obgyn[]" value="Metrohargia" class="custom-control-input">
                                        <label class="custom-control-label" for="keluhan4">Metrohargia</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="keluhan5" name="keluhan_obgyn[]" value="lain" class="custom-control-input">
                                        <label class="custom-control-label" for="keluhan5"> <input type="text" name="keluhan_obgyn[]" class="form-control" placeholder="Lain - Lain"> </label>
                                      </div>
                                    </div>
                                  </div>

                                </div>

                              </div>

                              <hr>
                              <h5>2. Riwayat Kehamilan (Jika Pasien Hamil)</h5><br>
                              <div class="row p-t-10">
                                <div class="col-xl-6 col-md-12">
                                  <div class="form-group">
                                    <div class="col-md-12 col-xl-12">
                                      <div class="input-group">
                                        <div class="input-group-append"><span class="input-group-text">G</span></div>
                                        <input type="text" name="g" class="form-control" placeholder="...">
                                        <div class="input-group-append"><span class="input-group-text">P</span></div>
                                        <input type="text" name="p" class="form-control" placeholder="...">
                                        <div class="input-group-append"><span class="input-group-text">A</span></div>
                                        <input type="text" name="a" class="form-control" placeholder="...">
                                      </div>
                                    </div>

                                  </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12 col-sm-12">
                                      <div class="input-group">
                                        <div class="input-group-append"><span class="input-group-text">HPHT</span></div>
                                        <input type="text" name="hpht" id="hpht" value="" class="tanggalku form-control" placeholder=".....">
                                      </div>
                                    </div>

                                  </div>

                                </div>
                                <div class="col-xl-3 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12 col-sm-12">
                                      <div class="input-group">
                                        <div class="input-group-append"><span class="input-group-text">UK</span></div>
                                        <input type="text" name="uk" class="form-control" placeholder="....." value="" readonly id="uk">
                                      </div>
                                    </div>

                                  </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12 col-sm-12">
                                      <div class="input-group">
                                        <div class="input-group-append"><span class="input-group-text">HPL</span></div>
                                        <input type="text" name="hpl" class="form-control" value="" placeholder="....." readonly id="hpl">
                                      </div>
                                    </div>

                                  </div>
                                </div>
                                <div class="col-xl-9 col-md-6 col-sm-6">
                                  <div class="form-group">

                                    <div class="col-md-12 col-xl-12">
                                      <input type="text" name="keluhan_kehamilan" class="form-control" placeholder="Keluhan yang dirasakan selama hamil ini">
                                    </div>

                                  </div>
                                </div>
                              </div>


                              <hr>
                              <h5> <b>3. Riwayat Ginekologi</b> </h5><br>
                              <div class="row p-t-10">
                                <div class="col-xl-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Infertilitas" value="Infertilitas" name="infertilitas" class="custom-control-input">
                                        <label class="custom-control-label" for="Infertilitas">Infertilitas</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Infeksi" value="Infeksi Virus" name="Infeksi" class="custom-control-input">
                                        <label class="custom-control-label" for="Infeksi">Infeksi Virus</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="PMS" value="PMS" name="PMS" class="custom-control-input">
                                        <label class="custom-control-label" for="PMS">PMS</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Cervitiscronis" value="Cervitiscronis" name="Cervitiscronis" class="custom-control-input">
                                        <label class="custom-control-label" for="Cervitiscronis">Cervitiscronis</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Endometriosis" value="Endometriosis" name="Endometriosis" class="custom-control-input">
                                        <label class="custom-control-label" for="Endometriosis">Endometriosis</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Myoma" value="Myoma" name="Myoma" class="custom-control-input">
                                        <label class="custom-control-label" for="Myoma">Myoma</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="ok" value="Opreasi Kandungan" name="ok" class="custom-control-input">
                                        <label class="custom-control-label" for="ok">Operasi Kandungan</label>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="pcb" value="Post Coital Bleeding" name="pcb" class="custom-control-input">
                                        <label class="custom-control-label" for="pcb">Post Coital Bleeding</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <div class="col-xl-12 col-md-12">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="fa" value="Flour Albus" name="fag" class="flour_albus custom-control-input">
                                        <label class="custom-control-label" for="fa">Flour Albus</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <div class="col-xl-6 col-md-12">
                                      <label class=" form-control-label">Gatal :</label>
                                    </div>
                                    <div class="col-xl-6 col-md-12">
                                      <div class="custom-control custom-radio">
                                        <input type="radio" id="gatal1" name="gatal" disabled value="Ya" class="gatal custom-control-input">
                                        <label class="custom-control-label" for="gatal1">Ya</label>
                                      </div>
                                      <div class="custom-control custom-radio">
                                        <input type="radio" id="gatal2" name="gatal" disabled value="Tidak" class="gatal custom-control-input">
                                        <label class="custom-control-label" for="gatal2">Tidak</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-4">
                                  <div class="form-group">
                                    <div class="col-xl-6 col-md-12">
                                      <label class=" form-control-label">Berbau :</label>
                                    </div>
                                    <div class="col-xl-6 col-md-12">
                                      <div class="custom-control custom-radio">
                                        <input type="radio" id="berbau1" name="berbau" disabled value="Ya" class="berbau custom-control-input">
                                        <label class="custom-control-label" for="berbau1">Ya</label>
                                      </div>
                                      <div class="custom-control custom-radio">
                                        <input type="radio" id="berbau2" name="berbau" disabled value="Tidak" class="berbau custom-control-input">
                                        <label class="custom-control-label" for="berbau2">Tidak</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <hr>
                            <h5 class="m-l-10"> <b>4. Riwayat KB</b> </h5><br>
                            <div class="row p-t-10">
                              <div class="col-xl-2 col-md-2 col-sm-6">
                                <div class="form-group">
                                  <div class="col-xl-12 col-md-12">
                                    <label class=" form-control-label">Pernah KB</label>
                                  </div>
                                  <div class="col-xl-6 col-md-12">
                                    <div class="custom-control custom-radio">
                                      <input type="radio" id="pernahkb1" name="pernahkb" value="Ya" class="pernahkb custom-control-input">
                                      <label class="custom-control-label" for="pernahkb1">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                      <input type="radio" id="pernahkb2" name="pernahkb" value="Tidak" class="pernahkb custom-control-input" checked>
                                      <label class="custom-control-label" for="pernahkb2">Tidak</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-4 col-md-6 col-sm-6">
                                <div class="form-group">
                                  <div class="col-xl-12 col-md-12">
                                    <label class=" form-control-label">Metode KB yang Pernah Dipakai :</label>
                                  </div>
                                  <div class="col-xl-12 col-md-12">
                                    <div class="input-group">
                                      <input type="text " name="metodekb" class="form-control" placeholder="" id="metode" disabled>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-3 col-md-6 col-sm-6">
                                <div class="form-group">
                                  <div class="col-xl-12 col-md-12">
                                    <label class=" form-control-label">Lamanya :</label>
                                  </div>
                                  <div class="col-xl-12 col-md-12">
                                    <div class="input-group">
                                      <input type="number" name="lamakb" class="form-control" placeholder="" id="lama_thn" disabled>
                                      <div class="input-group-append"><span class="input-group-text">tahun</span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-3 col-md-6 col-sm-6">
                                <div class="form-group">
                                  <div class="col-xl-12 col-md-12">
                                    <label class=" form-control-label">Lamanya :</label>
                                  </div>
                                  <div class="col-xl-12 col-md-12">
                                    <div class="input-group">
                                      <input type="number" name="lamakb_bln" class="form-control" placeholder="" id="lama_bln" disabled>
                                      <div class="input-group-append"><span class="input-group-text">bulan</span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-6 col-md-6">
                                <div class="form-group">
                                  <div class="col-xl-12 col-md-12">
                                    <label class=" form-control-label">Komplikasi :</label>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" id="Komplikasi1" name="Komplikasi[]" value="Tidak Ada" class="custom-control-input" checked>
                                      <label class="custom-control-label" for="Komplikasi1">Tidak Ada</label>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" id="Komplikasi2" name="Komplikasi[]" value="Pendaharan" class="custom-control-input">
                                      <label class="custom-control-label" for="Komplikasi2">Pendaharan</label>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" id="Komplikasi3" name="Komplikasi[]" value="PID/radang panggul" class="custom-control-input">
                                      <label class="custom-control-label" for="Komplikasi3">PID/radang panggul</label>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <input type="text" name="Komplikasi[]" class="form-control" placeholder="Lain - Lain">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php endif; ?>


                    </div>
                    <div class="card-footer" style='    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-wrap: wrap;
                    /* flex-wrap: wrap; */'>
                    <div class="col col-sm-12 com-md-12">
                      <button type="button" class="btn btn-outline-secondary btn-sm pull-left" onclick="window.history.back()"><i class="fa fa-reply"></i> Kembali</button>
                      <button type="button" class="btn to-top btn-outline-primary btn-sm pull-left"><i class="fa fa-up"></i> Keatas</button>

                      <button type="submit" class="btn btn-primary btn-sm pull-right">SIMPAN</button>
                    </div>
                  </div>
                  <input type="hidden" id="sekarang" value="<?php echo date("m/d/Y")?>">
                  <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
      function hitung_imt(){
        // alert("hdja");
        var tb = $("#tb_dewasa").val();
        var bb = $("#bb_dewasa").val();
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
      <script type="text/javascript">
      // When the user scrolls down 20px from the top of the document, show the button

      function coba() {
        if ($("input#lain_ridul_check:checked").length == 0) {
          $("#lain_ridul").attr('disabled', true);
        } else {
          $("#lain_ridul").attr('disabled', false)
          $("#lain_ridul").focus();;
        }
      }
      function daysBetween(first, second) {

        var newDate = Date.now() + -5*24*3600*1000;

        // Copy date parts of the timestamps, discarding the time parts.
        var one = new Date(first[2], first[0], first[1]);
        var two = new Date(second[2], second[0], second[1]);

        // // Do the math.
        var millisecondsPerDay = 1000 * 60 * 60 * 24;
        var millisBetween = two.getTime() - one.getTime();
        var days = millisBetween / millisecondsPerDay;

        // Round down.
        return Math.floor(days);
      }
      function deleteRow(r) {
              var i = r.parentNode.parentNode.rowIndex;
              document.getElementById("example22").deleteRow(i);
          }
      $(document).ready(function(){
        $(document).on("click",".input_riwayat",function(){
          var partus = $("#thnpartus").val();
          var tempatpartus = $("#tempatpartus").val();
          var umurhamil = $("#umurhamil").val();
          var jenis_persalinan = $("#jenis_persalinan").val();
          var penolong = $("#penolong").val();
          var penyulit = $("#penyulit").val();
          var jenis_kelamin = $(".jk_bayi:checked").val();
          var bb = $("#bb_bayi").val();
          var hm = $("#hm_bayi").val();
          var html='';
          html += '<tr>'+
          '<td><input type="hidden" name="thnpartus[]" value="'+partus+'">'+partus+'</td>'+
          '<td><input type="hidden" name="tempatpartus[]" value="'+tempatpartus+'">'+tempatpartus+'</td>'+
          '<td><input type="hidden" name="umur[]" value="'+umurhamil+'">'+umurhamil+'</td>'+
          '<td><input type="hidden" name="jenis_persalinan[]" value="'+jenis_persalinan+'">'+jenis_persalinan+'</td>'+
          '<td><input type="hidden" name="penolong[]" value="'+penolong+'">'+penolong+'</td>'+
          '<td><input type="hidden" name="penyulit[]" value="'+penyulit+'">'+penyulit+'</td>'+
          '<td><input type="hidden" name="jk[]" value="'+jenis_kelamin+'">'+jenis_kelamin+'</td>'+
          '<td><input type="hidden" name="bb[]" value="'+bb+'">'+bb+'</td>'+
          '<td><input type="hidden" name="hm[]" value="'+hm+'">'+hm+'</td>'+
          '<td><button type="button" onclick="deleteRow(this)" class="btn-danger btn btn-circle" data-toggle="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-trash"></i></button></td>'+
          '</tr>';
          if (partus!='') {
            $("#tabel_riwayat").append(html);

          }
          $("#tambahriwayat").modal("toggle");
        })
        $(document).on("click",".flour_albus",function(){
          if ($(".flour_albus:checked").length == 0) {
            $(".berbau").removeAttr("checked");
            $(".berbau").attr("disabled","disabled");
            $(".gatal").removeAttr("checked");
            $(".gatal").attr("disabled","disabled");

          }else{
            $(".berbau").removeAttr("disabled");
            $("#berbau2").attr("checked","checked");
            $(".gatal").removeAttr("disabled");
            $("#gatal2").attr("checked","checked");

          }
        })
        $(document).on("click",".pernahkb",function(){
          if ($(".pernahkb:checked").val()=="Ya") {
            $("#metode").removeAttr("disabled");
            $("#lama_bln").removeAttr("disabled");
            $("#lama_thn").removeAttr("disabled");
          }else{
            $("#metode").attr("disabled","disabled");
            $("#lama_bln").attr("disabled","disabled");
            $("#lama_thn").attr("disabled","disabled");
          }
        })
        // alert(moment("20120620", "YYYYMMDD").fromNow());
        var base_url = '<?php echo base_url()?>';
        function myajax_request(url,data,callback){
          $.ajax({
            type  : 'POST',
            url   : url,
            async : false,
            dataType : 'json',
            data:data,
            success : function(response){
              callback(response);
            }
          })
        }
        $(document).on("change","#hpht",function(){
          var data = $(this).val();
          var data1 = {hpht:$(this).val()};
          var sekarang = $("#sekarang").val();
          var tanggal = data.split("-");
          var end   = sekarang.split('-');
          myajax_request(base_url+"Periksa/kandungan",data1,function(res){
            $("#uk").val(res.uk);
            $("#hpl").val(res.hpl);
          })
        })


      })
      </script>
