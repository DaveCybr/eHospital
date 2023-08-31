
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>ASESMEN AWAL KEPERAWATAN DAN MEDIS POLI UMUM</strong>
              <small> Form</small>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('Asesmen/insert');?>
              <?php echo @$error;?>
              <div class="card-body card-block">

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
                            <input type="text" class="form-control" aria-label="" name="tanggal_kunjungan" value="<?php echo date('d-m-Y') ?>">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Pukul : </span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="tanggal_jam_kunjungan" value="<?php echo date('H:i:s') ?>">
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
                              <input type="radio" id="sumberdata1" name="sumberdata[]" class="custom-control-input" value="Baik" <?php if (@$demografi['sumberdata']=='Baik') {echo "checked";}?> >
                              <label class="custom-control-label" for="sumberdata1">Pasien</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="sumberdata2" name="sumberdata[]" class="custom-control-input" value="Baik" <?php if (@$demografi['keadaan']=='Baik') {echo "checked";}?> >
                              <label class="custom-control-label" for="sumberdata2">Keluarga</label>
                            </div>
                            <div class="col-12 col-lg-6 custom-control custom-radio">
                              <input type="radio" id="sumberdata3" name="sumberdata[]" class="custom-control-input" value="Baik" <?php if (@$demografi['keadaan']=='Baik') {echo "checked";}?> >
                              <label class="custom-control-label" for="sumberdata3">
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Lainnya : </span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="sumberdata[]" value="">
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
                              <input type="radio" id="rujukan1" name="rujukan" class="custom-control-input" value="Baik" <?php if (@$demografi['rujukan']=='Baik') {echo "checked";}?> >
                              <label class="custom-control-label" for="rujukan1">ya</label>
                            </div>
                            <div class="col-12 col-lg-1 custom-control custom-radio">
                              <input type="radio" id="rujukan2" name="rujukan" class="custom-control-input" value="Tidak" <?php if (@$demografi['rujukan']=='Tidak') {echo "checked";}?> >
                              <label class="custom-control-label" for="rujukan2">tidak</label>
                            </div>
                            <div class="input-group mb-3 col-md-9">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Dokter : </span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="dokter" value="<?php echo @$asesmen['dokter']?>">
                              <div class="input-group-prepend">
                                <span class="input-group-text">RS : </span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="rs" value="<?php echo @$asesmen['rs'] ?>">
                              <div class="input-group-append">
                                <span class="input-group-text">Lainnya</span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="aak_lainnya" value="<?php echo @$asesmen['aak_lainnya'] ?>">
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
                  <div class="col-lg-8">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>ASESMEN KEPERAWATAN</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">Keadaan Umum:</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="keadaan1" name="keadaan" class="custom-control-input" value="Baik" <?php if (@$demografi['keadaan']=='Baik') {echo "checked";}?> >
                              <label class="custom-control-label" for="keadaan1">Baik</label>
                            </div>
                            <div class="col-12 col-lg-3 custom-control custom-radio">
                              <input type="radio" id="keadaan2" name="keadaan" class="custom-control-input" value="Tampak Sakit" <?php if (@$demografi['keadaan']=='Tampak Sakit') {echo "checked";}?>>
                              <label class="custom-control-label" for="keadaan2">Tampak Sakit</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="keadaan3" name="keadaan" class="custom-control-input" value="Sesak" <?php if (@$demografi['keadaan']=='Sesak') {echo "checked";}?>>
                              <label class="custom-control-label" for="keadaan3">Sesak</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="keadaan4" name="keadaan" class="custom-control-input" value="Pucat" <?php if (@$demografi['keadaan']=='Pucat') {echo "checked";}?>>
                              <label class="custom-control-label" for="keadaan4">Pucat</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="keadaan5" name="keadaan" class="custom-control-input" value="Lemah" <?php if (@$demografi['keadaan']=='Lemah') {echo "checked";}?>>
                              <label class="custom-control-label" for="keadaan5">Lemah</label>
                            </div>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">GCS:</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">E</span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="GCS_E" value="<?php echo @$demografi['GCS_E'] ?>">
                              <div class="input-group-append">
                                <span class="input-group-text">M</span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="GCS_M" value="<?php echo @$demografi['GCS_M'] ?>">
                              <div class="input-group-append">
                                <span class="input-group-text">V</span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="GCS_V" value="<?php echo @$demografi['GCS_V'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">Tanda Vital:</label>
                          </div>
                          <div class="col-12 col-md-5">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Sistole</span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="td" value="<?php echo @$demografi['sistole'] ?>">
                            </div>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Diastole</span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="td" value="<?php echo @$demografi['diastole'] ?>">
                            </div>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">RR</span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="rr" value="<?php echo @$demografi['rr'] ?>">
                              <div class="input-group-append">
                                <span class="input-group-text">x/menit</span>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-5">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Suhu</span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="suhu" value="<?php echo @$demografi['suhu'] ?>">
                              <div class="input-group-append">
                                <span class="input-group-text">^C</span>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">HR</span>
                              </div>
                              <input type="text" class="form-control" aria-label="" name="hrtandavital" value="<?php echo @$demografi['hr'] ?>">
                              <div class="input-group-append">
                                <span class="input-group-text">x/menit</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>Fungsional</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">Alat Bantu:</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <input type="text" class="form-control" name="alatbantu" value="<?php echo @$demografi['alatbantu'] ?>">
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">Cacat Tubuh:</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <input type="text" class="form-control" name="cacattubuh" value="<?php echo @$demografi['cacattubuh'] ?>">
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">ADL:</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <div class="col-12 col-lg-6 custom-control custom-radio">
                              <input type="radio" id="adl1" name="adl" class="custom-control-input" value="Mandiri" <?php if (@$demografi['adl']=='Mandiri') {echo "checked";} ?>>
                              <label class="custom-control-label" for="adl1">Mandiri</label>
                            </div>
                            <div class="col-12 col-lg-6 custom-control custom-radio">
                              <input type="radio" id="adl2" name="adl" class="custom-control-input" value="Dibantu" <?php if (@$demografi['adl']=='Dibantu') {echo "checked";} ?>>
                              <label class="custom-control-label" for="adl2">Dibantu</label>
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
                        <strong>PSIKOSIAL - EKONOMI - SPIRITUAL</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">Status Emosional:</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="semosi1" name="semosi" class="custom-control-input" value="Normal" <?php if (@$demografi['semosi']=='Normal') {echo "checked";} ?>>
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
                              <input type="radio" id="seperkawinan1" name="seperkawinan" value="Kawin" <?php if (@$demografi['seperkawinan']=='Kawin') {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="seperkawinan1">Kawin</label>
                            </div>
                            <div class="col-12 col-lg-3 custom-control custom-radio">
                              <input type="radio" id="seperkawinan2" name="seperkawinan" value="Belum Kawin" <?php if (@$demografi['seperkawinan']=='Belum Kawin') {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="seperkawinan2">Belum Kawin</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="radio" id="seperkawinan3" name="seperkawinan" value="Janda / Duda" <?php if (@$demografi['seperkawinan']=='Janda / Duda') {echo "checked";} ?> class="custom-control-input">
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
                              <input type="radio" id="tinggal_dengan1" name="tinggal_dengan" value="Orang Tua" <?php if (@$demografi['tinggal_dengan']=='Orang Tua') {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="tinggal_dengan1">Orang Tua</label>
                            </div>
                            <div class="col-12 col-lg-3 custom-control custom-radio">
                              <input type="radio" id="tinggal_dengan2" name="tinggal_dengan" value="Suami" <?php if (@$demografi['tinggal_dengan']=='Suami') {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="tinggal_dengan2">Suami</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="tinggal_dengan3" name="tinggal_dengan" value="Anak" <?php if (@$demografi['tinggal_dengan']=='Anak') {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="tinggal_dengan3">Anak</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="tinggal_dengan4" name="tinggal_dengan" value="Sendiri" <?php if (@$demografi['tinggal_dengan']=='Sendiri') {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="tinggal_dengan4">Sendiri</label>
                            </div>
                            <div class="col-12 col-lg-12 custom-control custom-radio">
                              <input type="radio" id="tinggal_dengan5" name="tinggal_dengan" class="custom-control-input" value="lain"
                              <?php if (@$demografi['tinggal_dengan']!=='Orang Tua' && @$demografi['tinggal_dengan']!=='Suami' && @$demografi['tinggal_dengan']!=='Anak' && @$demografi['tinggal_dengan']!=='Sendiri' && @$demografi['tinggal_dengan'] !== null) {echo "checked";} ?>>
                              <label class="custom-control-label" for="tinggal_dengan5"><input type="text" name="tinggal_dengan_lain" class="form-control" placeholder="Lain - Lain"
                              <?php if (@$demografi['tinggal_dengan']!=='Orang Tua' && @$demografi['tinggal_dengan']!=='Suami' && @$demografi['tinggal_dengan']!=='Anak' && @$demografi['tinggal_dengan']!=='Sendiri' && @$demografi['tinggal_dengan'] !== null) {echo "value='".@$demografi['tinggal_dengan']."'";} ?> > </label>
                            </div>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">Pekerjaan:</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="pekerjaan1" name="pekerjaan" value="PNS/TNI/POLRI" <?php if (@$demografi['pekerjaan']=="PNS/TNI/POLRI") {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="pekerjaan1">PNS/TNI/POLRI</label>
                            </div>
                            <div class="col-12 col-lg-3 custom-control custom-radio">
                              <input type="radio" id="pekerjaan2" name="pekerjaan" value="Wiraswasta" <?php if (@$demografi['pekerjaan']=="Wiraswasta") {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="pekerjaan2">Wiraswasta</label>
                            </div>
                            <div class="col-12 col-lg-6 custom-control custom-radio">
                              <input type="radio" id="pekerjaan3" name="pekerjaan" class="custom-control-input" value="lain"
                              <?php if (@$demografi['pekerjaan']!=='PNS/TNI/POLRI' && @$demografi['pekerjaan']!=='Wiraswasta' && @$demografi['pekerjaan'] !== null) {echo "checked";} ?>>
                              <label class="custom-control-label" for="pekerjaan3"><input type="text" name="pekerjaan_lain" class="form-control" placeholder="Lain - Lain" id="pekerjaan" style="min-width:300px;"
                              <?php if (@$demografi['pekerjaan']!=='PNS/TNI/POLRI' && @$demografi['pekerjaan']!=='Wiraswasta' && @$demografi['pekerjaan'] !== null) {echo "value='".@$demografi['pekerjaan']."'";} ?> > </label>
                            </div>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">Cara Pembayaran:</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="cara_pembayaran1" name="cara_pembayaran" value="Pribadi" <?php if (@$demografi['cara_pembayaran']=="Pribadi") {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="cara_pembayaran1">Pribadi</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="cara_pembayaran2" name="cara_pembayaran" value="Asuransi" <?php if (@$demografi['cara_pembayaran1']=="Asuransi") {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="cara_pembayaran2">Asuransi</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="cara_pembayaran3" name="cara_pembayaran" value="BBJS" <?php if (@$demografi['cara_pembayaran']=="BBJS") {echo "checked";} ?> class="custom-control-input">
                              <label class="custom-control-label" for="cara_pembayaran3">BBJS</label>
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
                              <input type="radio" id="agama1" value="Islam" <?php if (@$demografi['agama']=="Islam") {echo "checked";} ?> name="agama" class="custom-control-input">
                              <label class="custom-control-label" for="agama1">Islam</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="agama2" value="Hindu" <?php if (@$demografi['agama']=="Hindu") {echo "checked";} ?> name="agama" class="custom-control-input">
                              <label class="custom-control-label" for="agama2">Hindu</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="agama3" value="Buddha" <?php if (@$demografi['agama']=="Buddha") {echo "checked";} ?> name="agama" class="custom-control-input">
                              <label class="custom-control-label" for="agama3">Buddha</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="agama4" value="Khatolik" <?php if (@$demografi['agama']=="Khatolik") {echo "checked";} ?> name="agama" class="custom-control-input">
                              <label class="custom-control-label" for="agama4">Khatolik</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="agama5" value="Kristen" <?php if (@$demografi['agama']=="Kristen") {echo "checked";} ?> name="agama" class="custom-control-input">
                              <label class="custom-control-label" for="agama5">Kristen</label>
                            </div>
                            <div class="col-12 col-lg-5 custom-control custom-radio">
                               <input type="radio" id="agama6" name="agama" class="custom-control-input" value="lain"
                              <?php if (@$demografi['agama']!=='Islam' && @$demografi['agama']!=='Hindu' && @$demografi['agama']!=='Buddha' && @$demografi['agama']!=='Khatolik' && @$demografi['agama']!=='Kristen' && @$demografi['agama'] !== null) {echo "checked";} ?>>
                              <label class="custom-control-label" for="agama6"><input type="text" name="agama_lain" class="form-control" placeholder="Lain - Lain"
                              <?php if (@$demografi['agama']!=='Islam' && @$demografi['agama']!=='Hindu' && @$demografi['agama']!=='Buddha' && @$demografi['agama']!=='Khatolik' && @$demografi['agama']!=='Kristen' && @$demografi['agama'] !== null) {echo "value='".@$demografi['kebiasaan']."'";} ?> > </label>
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
                              <input type="radio" id="kebiasaan3" name="kebiasaan" class="custom-control-input" value="lain"
                              <?php if (@$demografi['kebiasaan']!=='Merokok' && @$demografi['kebiasaan']!=='Alchohol' && @$demografi['kebiasaan'] !== null) {echo "checked";} ?>>
                              <label class="custom-control-label" for="kebiasaan3"><input type="text" name="kebiasaan_lain" class="form-control" placeholder="Lain - Lain"
                              <?php if (@$demografi['kebiasaan']!=='Merokok' && @$demografi['kebiasaan']!=='Alchohol' && @$demografi['kebiasaan'] !== null)  {echo "value='".@$demografi['kebiasaan']."'";} ?> > </label>
                            </div>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-4">
                            <label class=" form-control-label">Nilai - Nilai Budaya Dalam keluarga yang Mepengaruhi pada kesalhan:</label>
                          </div>
                          <div class="col-12 col-md-8 row text-right">
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="kebudayaan1" value="Ya" <?php if (@$demografi['kebudayaan']=="Ya") {echo "checked";} ?> name="kebudayaan" class="custom-control-input">
                              <label class="custom-control-label" for="kebudayaan1">Ya</label>
                            </div>
                            <div class="col-12 col-lg-2 custom-control custom-radio">
                              <input type="radio" id="kebudayaan2" value="Tidak" <?php if (@$demografi['kebudayaan']=="Tidak") {echo "checked";} ?> name="kebudayaan" class="custom-control-input">
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
                </div>
              </div>
              <div class="row">
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
                              <input type="radio" id="masbir2" value="Tidak" <?php if (@$demografi['masbir']=="Tidak") {echo "checked";} ?> name="masbir" class="custom-control-input">
                              <label class="custom-control-label" for="masbir2">Tidak</label>
                            </div>
                            <div class="col-12 col-lg-4 custom-control custom-radio">
                              <input type="text" name="masbir_lain" value="<?php echo @$demografi['masbir_lain'] ?>" maxlength="200" placeholder="Jelaskan ......" class="custom-control">
                            </div>
                        </div>
                      </div>
                      <div class="row form-group">
                        <div class="col col-md-5">
                          <label class=" form-control-label">Bahasa Sehari - Hari :</label>
                        </div>
                        <div class="col-12 col-md-12 row">
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="bahasa1" value="B.Indonesia" <?php if (@$demografi['bahasa']=="B.Indonesia") {echo "checked";} ?> name="bahasa" class="custom-control-input">
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
                            <input type="radio" id="potensi1" value="Proses Penyakit" <?php if (@$demografi['potensi']=="Proses Penyakit") {echo "checked";} ?> name="potensi" class="custom-control-input">
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
                            <input type="radio" id="alergi2" value="Tidak Ada" <?php if (@$demografi['alergi']=="Tidak Ada") {echo "checked";} ?> name="alergi" class="custom-control-input">
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
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="penyakit_dahulu1" value="Tidak Ada" <?php if (@$demografi['penyakit_dahulu']=="Tidak Ada") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                            <label class="custom-control-label" for="penyakit_dahulu1">Tidak Ada</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="penyakit_dahulu2" value="Hipertensi" <?php if (@$demografi['penyakit_dahulu']=="Hipertensi") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                            <label class="custom-control-label" for="penyakit_dahulu2">Hipertensi</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="penyakit_dahulu3" <?php if (@$demografi['penyakit_dahulu']=="TB Paru") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                            <label class="custom-control-label" for="penyakit_dahulu3">TB Paru</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="penyakit_dahulu4" value="Jantung" <?php if (@$demografi['penyakit_dahulu']=="Jantung") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                            <label class="custom-control-label" for="penyakit_dahulu4">Jantung</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="penyakit_dahulu5" value="Stroke" <?php if (@$demografi['penyakit_dahulu']=="Stroke") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                            <label class="custom-control-label" for="penyakit_dahulu5">Stroke</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="penyakit_dahulu6" value="Asma" <?php if (@$demografi['penyakit_dahulu']=="Asma") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                            <label class="custom-control-label" for="penyakit_dahulu6">Asma</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="penyakit_dahulu6" value="Kejang" <?php if (@$demografi['penyakit_dahulu']=="Kejang") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                            <label class="custom-control-label" for="penyakit_dahulu6">Kejang</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="penyakit_dahulu7" value="Diabetes Melitus" <?php if (@$demografi['penyakit_dahulu']=="Diabetes Melitus") {echo "checked";} ?> name="penyakit_dahulu[]" class="custom-control-input">
                            <label class="custom-control-label" for="penyakit_dahulu7">Diabetes Melitus</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="penyakit_dahulu8" name="penyakit_dahulu[]" class="custom-control-input">
                            <label class="custom-control-label" for="penyakit_dahulu8"> <input type="text" placeholder="Lain - Lain ......" class="form-control" name="penyakit_dahulu_lain" value=""> </label>
                          </div>
                        </div>
                      </div>
                      <div class="row form-group">
                        <div class="col col-md-7">
                          <label class=" form-control-label">Riwayat Penyakit Keluarga :</label>
                        </div>
                        <div class="col-12 col-md-12 row">
                          <div class="col-12 col-lg-5 custom-control custom-radio">
                            <input type="radio" id="riwayat_penyakit_keluarga1" name="riwayat_penyakit_keluarga[]" class="custom-control-input">
                            <label class="custom-control-label" for="riwayat_penyakit_keluarga1">Tidak Ada</label>
                          </div>
                          <div class="col-12 col-lg-3 custom-control custom-radio">
                            <input type="radio" id="riwayat_penyakit_keluarga2" name="riwayat_penyakit_keluarga[]" class="custom-control-input">
                            <label class="custom-control-label" for="riwayat_penyakit_keluarga2">Hipertensi</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="riwayat_penyakit_keluarga3" name="riwayat_penyakit_keluarga[]" class="custom-control-input">
                            <label class="custom-control-label" for="riwayat_penyakit_keluarga3">TB Paru</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="riwayat_penyakit_keluarga4" name="riwayat_penyakit_keluarga[]" class="custom-control-input">
                            <label class="custom-control-label" for="riwayat_penyakit_keluarga4">Diabetes Melitus</label>
                          </div>
                          <div class="col-12 col-lg-9 custom-control custom-radio">
                            <input type="radio" id="riwayat_penyakit_keluarga5" name="riwayat_penyakit_keluarga[]" class="custom-control-input">
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
                            <input type="radio" id="riwayat_operasi1" name="riwayat_operasi[]" value="Tidak" class="custom-control-input">
                            <label class="custom-control-label" for="riwayat_operasi1">Tidak</label>
                          </div>
                          <div class="col-12 col-lg-9 custom-control custom-radio">
                            <input type="radio" id="riwayat_operasi2" name="riwayat_operasi[]" class="custom-control-input">
                            <label class="custom-control-label" for="riwayat_operasi2">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Ya,</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Riwayat Operasi :" aria-label="" name="riwayat_operasi[]">
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
                            <input type="radio" id="riwayat_tranfusi" name="riwayat_tranfusi[]" value="Tidak" class="custom-control-input">
                            <label class="custom-control-label" for="riwayat_tranfusi">Tidak</label>
                          </div>
                          <div class="col-12 col-lg-9 custom-control custom-radio">
                            <input type="radio" id="riwayat_tranfusi2" name="riwayat_tranfusi[]" class="custom-control-input">
                            <label class="custom-control-label" for="riwayat_tranfusi2">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Ya,</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Reaksi Muncul :" aria-label="" name="riwayat_tranfusi[]">
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
                            <input type="radio" id="golongan_darah5" name="golongan_darah" class="custom-control-input">
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
                            <input type="radio" id="keluhan_nyeri1" name="keluhan_nyeri" value="Tidak" class="custom-control-input">
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
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="kualitas_quality1" name="kualitas_quality" value="Menekan" class="custom-control-input">
                            <label class="custom-control-label" for="kualitas_quality1">Menekan</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="kualitas_quality2" name="kualitas_quality" value="Menusuk" class="custom-control-input">
                            <label class="custom-control-label" for="kualitas_quality2">Menusuk</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="kualitas_quality3" name="kualitas_quality" value="Berdenyut - Denyut" class="custom-control-input">
                            <label class="custom-control-label" for="kualitas_quality3">Berdenyut - Denyut</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="kualitas_quality4" name="kualitas_quality" value="Menyebar" class="custom-control-input">
                            <label class="custom-control-label" for="kualitas_quality4">Menyebar</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="kualitas_quality5" name="kualitas_quality" value="Menyengat" class="custom-control-input">
                            <label class="custom-control-label" for="kualitas_quality5">Menyengat</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="kualitas_quality6" name="kualitas_quality" value="Pedih" class="custom-control-input">
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
                            <input type="radio" id="intensitas1" name="intensitas[]" value="Wong Baker Face Pain" class="custom-control-input">
                            <label class="custom-control-label" for="intensitas1">Wong Baker Face Pain</label>
                          </div>
                          <div class="col-12 col-lg-5 custom-control custom-radio">
                            <input type="radio" id="intensitas2" name="intensitas[]" value="Numeric Ranting Scale (NRS)" class="custom-control-input">
                            <label class="custom-control-label" for="intensitas2">Numeric Ranting Scale (NRS)</label>
                          </div>
                          <div class="col-12 col-lg-3 custom-control custom-radio">
                            <input type="radio" id="intensitas3" name="intensitas[]" value="FLACC" class="custom-control-input">
                            <label class="custom-control-label" for="intensitas3">FLACC</label>
                          </div>
                          <div class="col-12 col-lg-9 custom-control custom-radio">
                            <input type="radio" id="intensitas4" name="intensitas[]" class="custom-control-input">
                            <label class="custom-control-label" for="intensitas4">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Lainnya</span>
                                </div>
                                <input type="text" class="form-control" aria-label="" name="intensitas[]">
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
                            <input type="radio" id="kategori_nyeri1" name="kategori_nyeri[]" value="Tidak Nyeri" class="custom-control-input">
                            <label class="custom-control-label" for="kategori_nyeri1">Tidak Nyeri</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="kategori_nyeri2" name="kategori_nyeri[]" value="Ringan" class="custom-control-input">
                            <label class="custom-control-label" for="kategori_nyeri2">Ringan</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="kategori_nyeri3" name="kategori_nyeri[]" value="Sedang" class="custom-control-input">
                            <label class="custom-control-label" for="kategori_nyeri3">Sedang</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="kategori_nyeri4" name="kategori_nyeri[]" value="Berat" class="custom-control-input">
                            <label class="custom-control-label" for="kategori_nyeri4">Berat</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="kategori_nyeri5" name="kategori_nyeri[]" value="Hebat" class="custom-control-input">
                            <label class="custom-control-label" for="kategori_nyeri5">Hebat</label>
                          </div>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="kategori_nyeri6" name="kategori_nyeri[]" value="Sangat Hebat" class="custom-control-input">
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
                            <input type="radio" id="prj_umur1" name="prj_umur" class="custom-control-input" value="Anak">
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
                            <input type="radio" id="prj_kategori1" name="prj_kategori" class="custom-control-input" value="Risiko Rendah">
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
                            <input type="text" class="form-control" aria-label="" name="pn_bb" value="<?php echo @$demografi['pn_bb'] ?>">
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
                            <input type="text" class="form-control" aria-label="" name="pn_tb" value="<?php echo @$demografi['pn_tb'] ?>">
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
                            <input type="text" class="form-control" aria-label="" name="pn_lila" value="<?php echo @$demografi['pn_lila'] ?>">
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
                            <input type="text" class="form-control" aria-label="" name="pn_imt" value="<?php echo @$demografi['pn_imt'] ?>">
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
                            <input type="radio" id="mst_11" name="mst_1" class="custom-control-input" value="Tidak" <?php if (@$demografi['mst_1']=="Tidak"): ?>checked<?php endif; ?>>
                            <label class="custom-control-label" for="mst_11">Tidak : skor 0</label>
                          </div>
                          <div class="col-12 col-lg-6 custom-control custom-radio">
                            <input type="radio" id="mst_12" name="mst_1" class="custom-control-input" value="Tidak Yakin" <?php if (@$demografi['mst_1']=="Tidak Yakin"): ?>checked<?php endif; ?>>
                            <label class="custom-control-label" for="mst_12">Tidak Yakin : skor 1</label>
                          </div>
                          <div class="col-12 col-lg-12 custom-control custom-radio">
                            <input type="radio" id="mst_13" name="mst_1" class="custom-control-input" value="lain">
                            <label class="custom-control-label" for="mst_13">Ya, 1-5kg (skor 1), 6-10 (skor 2), 10-15 (skor 3), <= 15 (skor 4)</label>
                            <input type="text" class="form-control" placeholder="Penurunan Berat badan" name="mst_1_lain" value="<?php echo @$demografi['mst_1'] ?>">
                          </div>
                          <br><br><br><br>
                          <strong>2. Apakah asupan makan menurun dikarenakan adanya penurunan nafsu makan atau kesulitan menerima makanan ?</strong>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="mst_21" name="mst_2" class="custom-control-input" value="Tidak" <?php if (@$demografi['mst_2']=="Tidak"): ?>checked<?php endif; ?>>
                            <label class="custom-control-label" for="mst_21">Tidak : skor 0</label>
                          </div>
                          <div class="col-12 col-lg-6 custom-control custom-radio">
                            <input type="radio" id="mst_22" name="mst_2" class="custom-control-input" value="Ya" <?php if (@$demografi['mst_2']=="Ya"): ?>checked<?php endif; ?>>
                            <label class="custom-control-label" for="mst_22">Ya : skor 2</label>
                          </div>
                        </div>
                        <div class="col-lg-6 shadow-sm">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">TOTAL SKOR :</span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="mst_skor" value="<?php echo @$demografi['mst_skor'] ?>">
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
                            <input type="radio" id="strongkids11" name="strongkids1" class="custom-control-input" value="Tidak" <?php if (@$demografi['strongkids1']=="Tidak"): ?>checked<?php endif; ?>>
                            <label class="custom-control-label" for="strongkids11">Tidak : skor 0</label>
                          </div>
                          <div class="col-12 col-lg-6 custom-control custom-radio">
                            <input type="radio" id="strongkids12" name="strongkids1" class="custom-control-input" value="Ya" <?php if (@$demografi['strongkids1']=="Ya"): ?>checked<?php endif; ?>>
                            <label class="custom-control-label" for="strongkids12">Ya : skor 2</label>
                          </div>
                          <br><br>
                          <strong class="col-12">2. Apakah pasien tampak kurus ?</strong>
                          <div class="col-12 col-lg-6 custom-control custom-radio">
                            <input type="radio" id="strongkids21" name="strongkids2" class="custom-control-input" value="Tidak" <?php if (@$demografi['strongkids2']=="Tidak"): ?>checked<?php endif; ?>>
                            <label class="custom-control-label" for="strongkids21">Tidak : skor 0</label>
                          </div>
                          <div class="col-12 col-lg-6 custom-control custom-radio">
                            <input type="radio" id="strongkids22" name="strongkids2" class="custom-control-input" value="Ya" <?php if (@$demografi['strongkids2']=="Ya"): ?>checked<?php endif; ?>>
                            <label class="custom-control-label" for="strongkids22">Ya : skor 1</label>
                          </div>
                          <br><br>
                          <strong class="col-12">3. Apakah terdapat salah satu dari kondisi berikut (dalam 1 minggu terakhir) ?</strong>
                          <div class="col-12">
                            - Diare >5x/hari dan/atau muntah >3xhari <br>
                            - Asupan makan berkurang
                          </div>
                          <div class="col-12 col-lg-6 custom-control custom-radio">
                            <input type="radio" id="strongkids31" name="strongkids3" class="custom-control-input" value="Tidak" <?php if (@$demografi['strongkids3']=="Tidak"): ?>checked<?php endif; ?>>
                            <label class="custom-control-label" for="strongkids31">Tidak : skor 0</label>
                          </div>
                          <div class="col-12 col-lg-6 custom-control custom-radio">
                            <input type="radio" id="strongkids32" name="strongkids3" class="custom-control-input" value="Ya" <?php if (@$demografi['strongkids3']=="Ya"): ?>checked<?php endif; ?>>
                            <label class="custom-control-label" for="strongkids32">Ya : skor 1</label>
                          </div>
                          <br><br>
                          <strong class="col-12">4. Apakah terjadi penurunan berat badan ataukah tidak ada peningkatan berat badan dalam 1 bulan terakhir ?</strong>
                          <div class="col-12 col-lg-4 custom-control custom-radio">
                            <input type="radio" id="strongkids41" name="strongkids4" class="custom-control-input" value="Tidak" <?php if (@$demografi['strongkids4']=="Tidak"): ?>checked<?php endif; ?>>
                            <label class="custom-control-label" for="strongkids41">Tidak : skor 0</label>
                          </div>
                          <div class="col-12 col-lg-6 custom-control custom-radio">
                            <input type="radio" id="strongkids42" name="strongkids4" class="custom-control-input" value="Ya" <?php if (@$demografi['strongkids4']=="Ya"): ?>checked<?php endif; ?>>
                            <label class="custom-control-label" for="strongkids42">Ya : skor 1</label>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">TOTAL SKOR :</span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="strongkids_skor" value="<?php echo @$demografi['strongkids_skor'] ?>">
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
                </div>
                <?php echo form_close(); ?>
                </div>
              </div>
              </div>


    <script type="text/javascript">
    function coba() {
    if (@$("input#lain_ridul_check:checked").length == 0) {
    @$("#lain_ridul").attr('disabled', true);
    } else {
    @$("#lain_ridul").attr('disabled', false)
    @$("#lain_ridul").focus();;
    }
    }
    </script>
