<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>PEMERIKSAAN 1</strong>
              <small> Form</small>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('Periksa/input_pemeriksaan',array("id"=>"form_pemeriksaan"));?>
              <?php echo @$error;?>

              <div class="row col-lg-12">
                <div class="col-lg-12">
                  <div class="card border-info" style="border: 2px solid;">
                    <div class="card-header bg-info text-white">
                      <strong>Data Kunjungan</strong>
                      <small>Form</small>
                    </div>
                    <div class="card-body card-block">

                      <div class="row p-t-20">
                        <div class="row col-xl-2 col-md-6 col-sm-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">No Kunjungan</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span>
                              </div>
                              <input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$idkunjungan; ?>" required readonly>

                            </div>
                          </div>
                        </div>
                        <div class="row col-xl-3 m-l-6 col-md-6 col-sm-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Tgl Berkunjung</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-timer"></i></span>
                              </div>
                              <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo date('Y-m-d'); ?>" required readonly>

                            </div>
                          </div>
                        </div>
                        <div class="row col-xl-2 col-md-6 col-sm-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">No Rekam Medis</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span>
                              </div>
                              <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" required readonly>

                            </div>
                          </div>
                        </div>
                        <div class="row col-xl-3 col-md-6 col-sm-6 m-l-1">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Nama Pasien</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                              </div>
                              <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo @$pasien['namapasien']; ?>" required readonly>

                            </div>
                          </div>
                        </div>
                        <div class="row col-xl-3 col-md-6 col-sm-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Jenis Kunjungan</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <input type="text" name="jenis_kunjungan" id="jenis_kunjungan" class="form-control" placeholder="jenis_kunjungan" value="<?php echo @$jenispasien['jenis_pasien']; ?>" required readonly>

                            </div>
                          </div>
                        </div>
                      </div>


                    </div>
                  </div>
                </div>
              </div>
              <div class="row col-lg-12">
                <div class="col-lg-6">
                  <div class="card border-info" style="border: 2px solid;">
                    <div class="card-header bg-info text-white">
                      <strong>Keluhan Dan Riwayat Sakit</strong>
                      <small>Form</small>
                    </div>
                    <div class="card-body card-block">

                      <div class="row p-t-20">
                        <div class="col-md-12">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Keluhan</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-face-sad"></i></span>
                              </div>
                              <!-- <input type="text" name="keluhan" id="keluhan" class="form-control" placeholder="Keluhan Pasien" required> -->
                              <textarea class="form-control" name="keluhan" id="keluhan"  placeholder="Keluhan Pasien" required><?php echo $kunjungan['keluhan']?></textarea>

                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Riwayat Penyakit Dulu</label>
                            <div class="input-group mb-3 p-l-10">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span> -->
                              </div>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" id="hipertensi" name="riwayat_dulu" value="Hipertensi" onclick="coba()" class="custom-control-input" >
                                <label class="custom-control-label" for="hipertensi">Hipertensi</label>
                              </div>
                              <div class="custom-control custom-checkbox" style="margin-left:10px">
                                <input type="checkbox" id="hepa" name="riwayat_dulu" value="Hipatitis" onclick="coba()" class="custom-control-input" >
                                <label class="custom-control-label" for="hepa">Hepatitis</label>
                              </div>
                              <div class="custom-control custom-checkbox" style="margin-left:10px">
                                <input type="checkbox" id="dm" name="riwayat_dulu" value="DM" onclick="coba()" class="custom-control-input">
                                <label class="custom-control-label" for="dm">DM</label>
                              </div>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" id="lain_ridul_check" name="riwayat_dulu" value="lain" onclick="coba()" class="custom-control-input"><input disabled type="text" id="lain_ridul" name="lain_ridul" class="form-control" placeholder="Lain - Lain">
                                <label class="custom-control-label" for="lain_ridul_check"></label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Riwayat Sekarang</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-wheelchair"></i></span>
                              </div>
                              <!-- <input type="text" name="riwayat_skrg" class="form-control" placeholder="Riwayat Penyakit Sekarang"> -->
                              <textarea class="form-control" rows="5" name="riwayat_skrg" placeholder="Riwayat Penyakit Sekarang"></textarea>

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
                      <strong>Kondisi Pasien</strong>
                      <small>Form</small>
                    </div>
                    <div class="card-body card-block">
                      <div class="row p-t-20">
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">BB</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-face-smile"></i></span>
                              </div>
                              <input type="number" name="bb" class="form-control" placeholder="BB" value="<?php echo $kunjungan['bb']?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">TB</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-stats-up"></i></span>
                              </div>
                              <input type="number" name="tb" class="form-control" placeholder="TB" value="<?php echo $kunjungan['tb']?>">

                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="imt">IMT</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-stats-up"></i></span>
                              </div>
                              <input type="number" name="imt" id="imt" class="form-control" placeholder="TB" value="<?php echo $kunjungan['imt']?>" >
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="lingkar_perut">Lingkar Perut</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-stats-up"></i></span>
                              </div>
                              <input type="number" name="lingkar_perut" id="lingkar_perut"class="form-control" placeholder="Lingkar Perut" value="<?php echo $kunjungan['lingkar_perut']?>" >
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Temperatur <?php echo $kunjungan['suhu'] ?></label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-pin"></i></span>
                              </div>
                              <?php $suhu = ($kunjungan['suhu'] > 0 || $kunjungan['suhu'] != null) ? $kunjungan['suhu'] : '36.5';?>
                              <input type="number" step="0.01" name="temp" class="form-control" value="<?php echo $suhu; ?>">

                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Kesadaran</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span> -->
                              </div>
                              <select name="kesadaran" class="mdb-select colorful-select dropdown-info sm-form">
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
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Sistole</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <?php $sistole = ($kunjungan['sistole'] > 0 || $kunjungan['sistole'] != null) ? $kunjungan['sistole'] : '120';?>
                              <input type="number" name="siastole" class="form-control" max="300"  placeholder="120" value="<?php echo $sistole; ?>">
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Diastole</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <?php $diastole = ($kunjungan['diastole'] > 0 || $kunjungan['diastole'] != null) ? $kunjungan['diastole'] : '75';?>
                              <input type="number" name="diastole" max="170" min="0" class="form-control" placeholder="75" value="<?php echo $diastole; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="nadi">Nadi/HeartRate</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-pulse"></i></span>
                              </div>

                              <?php $heartRate = ($kunjungan['nadi'] > 0 || $kunjungan['nadi'] != null) ? $kunjungan['nadi'] : '80';?>
                              <input type="number" name="nadi" id="nadi" class="form-control" placeholder="Nadi" value="<?php echo $heartRate; ?>">
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">RespRate (rr)</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-pulse"></i></span>
                              </div>

                              <?php $rr = ($kunjungan['rr'] > 0 || $kunjungan['rr'] != null) ? $kunjungan['rr'] : '20';?>
                              <input type="number" name="rr" class="form-control" placeholder="RespRate" value="<?php echo $rr; ?>">
                            </div>
                          </div>
                        </div>
                        <!-- <div class="col-md-6" style="margin-bottom:40px;">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">RR</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <?php $rr = ($kunjungan['rr'] > 0 || $kunjungan['rr'] != null) ? $kunjungan['rr'] : '18';?>
                              <input type="number" name="rr" class="form-control" placeholder="18" value="<?php echo $rr; ?>">
                            </div>
                          </div>
                        </div> -->

                        <div class="col-md-6" style="margin-bottom:40px;">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">SpO2</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <?php $spo2 = ($kunjungan['spo2'] > 0 || $kunjungan['spo2'] != null) ? $kunjungan['spo2'] : '90';?>
                              <input type="number" name="spo2" class="form-control" placeholder="SpO2" value="<?php echo $spo2; ?>">
                            </div>
                          </div>
                        </div>

                      </div>


                    </div>
                  </div>
                </div>
              </div>
              <div class="row col-lg-12">
                <div class="col-lg-12">
                  <div class="card border-info" style="border: 2px solid;">
                    <div class="card-header bg-info text-white">
                      <strong>Gula Darah</strong>
                      <small>Form</small>
                    </div>
                    <div class="card-body card-block">
                      <div class="row p-t-20">

                        <div class="col-md-3">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Gula Darah Sewaktu</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <input id="x_card_code" name="gl_sewaktu" type="text" class="form-control cc-cvc" placeholder="0" >

                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Gula Darah Puasa</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <input id="x_card_code" name="gl_puasa" type="text" class="gula_darah form-control cc-cvc" placeholder="0" >

                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Gula Darah Post Prandial</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <input id="x_card_code" name="gl_post_prandial" type="text" class="form-control cc-cvc" placeholder="0" >

                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Gula Darah HBA1C</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <input id="x_card_code" name="gl_hba" type="text" class="form-control cc-cvc" placeholder="0" >

                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row col-lg-12">
                <div class="col-lg-4">
                  <div class="card border-info" style="border: 2px solid;">
                    <div class="card-header bg-info text-white">
                      <strong>Kepala/Leher</strong>
                      <small>Form</small>
                    </div>
                    <div class="card-body card-block">

                      <div class="row p-t-20">
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Mata</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span> -->
                              </div>
                              <select name="mata" class="mdb-select colorful-select dropdown-info sm-form">
                                <option value="TAA">TAA</option>
                                <option value="ANEMI">ANEMI</option>
                                <option value="IDERUS">IDERUS</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Telinga</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-timer"></i></span> -->
                              </div>
                              <select name="telinga" class="mdb-select colorful-select dropdown-info sm-form">
                                <option value="TAA">TAA</option>
                                <option value="HIPERMI">HIPERMI</option>
                                <option value="CAIRAN">CAIRAN</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Tonsil</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span> -->
                              </div>
                              <select name="tonsil" class="mdb-select colorful-select dropdown-info sm-form">
                                <option value="TAA">TAA</option>
                                <option value="T1">T1</option>
                                <option value="T2">T2</option>
                                <option value="T3">T3</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Leher</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span> -->
                              </div>
                              <select name="leher" class="mdb-select colorful-select dropdown-info sm-form">
                                <option value="TAA">TAA</option>
                                <option value="Tiroid Membesar">Tiroid Membesar</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Hidung</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span> -->
                              </div>
                              <select name="hidung" class="mdb-select colorful-select dropdown-info sm-form">
                                <option value="TAA">TAA</option>
                                <option value="polip D">polip D</option>
                                <option value="polip S">polip S</option>
                                <option value="polip D-S">polip D-S</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Gigi/Mulut</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span> -->
                              </div>
                              <select name="gigimulut" class="mdb-select colorful-select dropdown-info sm-form">
                                <option value="TAA">TAA</option>
                                <option value="Lidah Kotor">Lidah Kotor</option>
                                <option value="Selaput Putih">Selaput Putih</option>
                                <option value="Caries">Caries</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Lain-Lain</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <!-- <input type="text" name="lainkl" class="form-control"> -->
                              <textarea class="form-control" rows="4" name="lainkl"></textarea>

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
                      <strong>Perut/Abomen</strong>
                      <small>Form</small>
                    </div>
                    <div class="card-body card-block">
                      <div class="row p-t-20">
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Hepar</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span> -->
                              </div>
                              <select name="hepar" class="mdb-select colorful-select dropdown-info sm-form">
                                <option value="TTB">TTB</option>
                                <option value="Membesar">Membesar</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Usus</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-timer"></i></span> -->
                              </div>
                              <select name="usus" class="mdb-select colorful-select dropdown-info sm-form">
                                <option value="B U Normal">B U normal</option>
                                <option value="Meningkat">Meningkat</option>
                                <option value="Menurun">Menurun</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Dinding Perut</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span> -->
                              </div>
                              <select name="dinperut" class="mdb-select colorful-select dropdown-info sm-form">
                                <option value="soufel">Soufel</option>
                                <option value="keras">Keras</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Ulu Hati</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span> -->
                              </div>
                              <select name="uluhati" class="mdb-select colorful-select dropdown-info sm-form">
                                <option value="TAA">TAA</option>
                                <option value="Nyeri Tekan">Nyeri Tekan</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Lien</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span> -->
                              </div>
                              <select name="lien" class="mdb-select colorful-select dropdown-info sm-form">
                                <option value="TTB">TTB</option>
                                <option value="Membesar">Membesar</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Lain-Lain</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <!-- <input type="text" name="lainperut" class="form-control"> -->
                              <textarea class="form-control" rows="4" name="lainperut"></textarea>


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
                      <strong>Urogenetal</strong>
                      <small>Form</small>
                    </div>
                    <div class="card-body card-block">
                      <div class="row p-t-20">
                        <div class="col-md-12">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Ginjal</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span> -->
                              </div>
                              <select name="ginjal" class="mdb-select colorful-select dropdown-info sm-form">
                                <option value="TAA">TAA</option>
                                <option value="Nyeri Ketok D">Nyeri Ketok D</option>
                                <option value="Nyeri Ketok S">Nyeri Ketok S</option>
                                <option value="Nyeri Ketok D-S">Nyeri Ketok D-S</option>
                              </select>
                            </div>
                          </div>
                        </div><div class="col-md-12">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Lain lain</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <!-- <input id="x_card_code" name="lainurogenital" type="text" class="form-control cc-cvc" placeholder="Lain - Lain" > -->
                              <textarea class="form-control" rows="4" name="lainurogenital" placeholder="Lain - Lain"></textarea>

                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row col-lg-12">
                <div class="col-lg-6">
                  <div class="card border-info" style="border: 2px solid;">
                    <div class="card-header bg-info text-white">
                      <strong>Thorak</strong>
                      <small>Form</small>
                    </div>
                    <div class="card-body card-block">
                      <div class="row p-t-20">
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Core/jantung</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span> -->
                              </div>
                              <div class="col-12 col-md-6" style="padding-left: 0px;">

                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="tdbn" name="corejantung" value="DBN" class="custom-control-input" checked>
                                  <label class="custom-control-label" for="tdbn">DBN</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="tmembesar" name="corejantung" value="Membesar" class="custom-control-input">
                                  <label class="custom-control-label" for="tmembesar">Membesar</label>
                                </div>

                              </div>
                              <div class="col-12 col-md-6">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="tmur" name="corejantung" value="Murmur" class="custom-control-input">
                              <label class="custom-control-label" for="tmur">Murmur</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="galop" name="corejantung" value="Galop" class="custom-control-input">
                                  <label class="custom-control-label" for="galop">Galop</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Paru</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-timer"></i></span> -->
                              </div>
                              <div class="col-12 col-md-6" style="padding-left: 0px;">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="dbn" name="paru" value="DBN" class="custom-control-input" checked>
                                  <label class="custom-control-label" for="dbn">DBN</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="wzd" name="paru" value="Whezing D" class="custom-control-input">
                                  <label class="custom-control-label" for="wzd">Whezing D</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="wzs" name="paru" value="Whezing S" class="custom-control-input">
                                  <label class="custom-control-label" for="wzs">Whezing S</label>
                                </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="rd" name="paru" value="Ronchi D" class="custom-control-input">
                                  <label class="custom-control-label" for="rd">Ronchi D</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="rs" name="paru" value="Ronchi S" class="custom-control-input">
                                  <label class="custom-control-label" for="rs">Ronchi S</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Lain-Lain</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <input id="x_card_code" name="lainthorak" type="text" class="form-control cc-cvc" placeholder="Lain - Lain" >

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
                      <strong>Extremitas</strong>
                      <small>Form</small>
                    </div>
                    <div class="card-body card-block">
                      <div class="row p-t-20">
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Extremitas Atas</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span> -->
                              </div>
                              <div class="col-12 col-md-6" style="padding-left: 0px;">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="eta" name="exatas" value="TAA" class="custom-control-input" checked>
                                  <label class="custom-control-label" for="eta">TAA</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="epd" name="exatas" value="Parase D" class="custom-control-input">
                                  <label class="custom-control-label" for="epd">Parase D</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="epsd" name="exatas" value="Paralise D" class="custom-control-input">
                                  <label class="custom-control-label" for="epsd">Paralise D</label>
                                </div>

                              </div>
                              <div class="col-12 col-md-6">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="eps" name="exatas" value="Parase S" class="custom-control-input">
                                  <label class="custom-control-label" for="eps">Parase S</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="epss" name="exatas" value="Paralise S" class="custom-control-input">
                                  <label class="custom-control-label" for="epss">Paralise S</label>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Extremitas Bawah</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-timer"></i></span> -->
                              </div>
                              <div class="col-12 col-md-6" style="padding-left: 0px;">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="ebta" name="exbawah" value="TAA" class="custom-control-input" checked>
                                  <label class="custom-control-label" for="ebta">TAA</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="ebpd" name="exbawah" value="Paralise D" class="custom-control-input">
                                  <label class="custom-control-label" for="ebpd">Paralise D</label>
                                </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="ebps" name="exbawah" value="Parase S" class="custom-control-input">
                                  <label class="custom-control-label" for="ebps">Parase S</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" id="ebpss" name="exbawah" value="Paralise S" class="custom-control-input">
                                  <label class="custom-control-label" for="ebpss">Paralise S</label>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Lain-Lain</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <input id="x_card_code" name="lainex" type="text" class="form-control cc-cvc" placeholder="Lain - Lain" >

                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer" style='    display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                /* flex-wrap: wrap; */'>
                <div class="col col-sm-12 com-md-12">
                <button type="button" class="btn btn-outline-secondary btn-sm pull-left" onclick="window.history.back()"><i class="fa fa-reply"></i> Kembali</button>

                    <button type="button" id="simpan" class="btn btn-primary btn-sm pull-right">SIMPAN</button>
                </div>
              </div>
              <?php echo form_close(); ?>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_dm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Alert</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <h4>Pasien pernah di diagnosa DM dan pemeriksaan gula darah belum tersisi.</h4>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">Batal Dan Isi</a>
        <button type="button" id="lanjutkan" class="btn btn-outline-success waves-effect" >Lanjutkan Tanpa Isi</button>
      </div>
    </div>
    <!--/.Content-->
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
  let dm = <?php echo $dm?>;
  // dm = 1;
  // alert(dm);
  $(document).on("click","#lanjutkan",function(){

      $("#form_pemeriksaan").submit();
  })
  $(document).on("click","#simpan",function(){
    let status = 0;
    $(".gula_darah").each(function(){
      let gl = $(this).val();
      if (gl=='' && dm > 0) {
        status =1;
        return false;
      }
    });
    if (status==1) {
      // alert("Ada gula darah kosong");
      $("#modal_dm").modal("toggle");


    }else{
      $("#form_pemeriksaan").submit();

    }

  })
})
</script>
