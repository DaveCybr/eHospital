<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>PEMERIKSAAN</strong>
              <small> Form</small>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('Periksa/update_pemeriksaan/'.$periksa['idperiksa']);?>
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
                              <textarea class="form-control" name="keluhan" id="keluhan"  placeholder="Keluhan Pasien" required><?php echo $periksa['keluhan']?></textarea>

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
                              <textarea class="form-control" rows="5" name="riwayat_skrg" placeholder="Riwayat Penyakit Sekarang"><?php echo $periksa['riwayat_skrg']?></textarea>

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
                        <div class="col-md-4">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">BB</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-face-smile"></i></span>
                              </div>
                              <input type="number" name="bb" class="form-control" placeholder="BB" value="<?php echo $periksa['obb']?>">

                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">TB</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-stats-up"></i></span>
                              </div>
                              <input type="number" name="tb" class="form-control" placeholder="TB" value="<?php echo $periksa['otb']?>">

                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Temperatur <?php echo $periksa['otemp'] ?></label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-pin"></i></span>
                              </div>
                              <?php $suhu = ($periksa['otemp'] > 0 || $periksa['otemp'] != null) ? $periksa['otemp'] : '36.5';?>
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
                                <option value="KOMPOMENTIS" <?php if (@$periksa['kesadaran']=='KOMPOMENTIS'): ?>
                                  selected
                                <?php endif; ?>>KOMPOMENTIS (CM)</option>
                                <option value="SOMNOLENSE" <?php if (@$periksa['kesadaran']=='SOMNOLENSE'): ?>
                                  selected
                                <?php endif; ?>>SOMNOLENSE</option>
                                <option value="STUPOR" <?php if (@$periksa['kesadaran']=='STUPOR'): ?>
                                  selected
                                <?php endif; ?>>STUPOR</option>
                                <option value="KOMA" <?php if (@$periksa['kesadaran']=='KOMA'): ?>
                                  selected
                                <?php endif; ?>>KOMA</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Siastole</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <?php $sistole = ($periksa['osiastole'] > 0 || $periksa['osiastole'] != null) ? $periksa['osiastole'] : '120';?>
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
                              <?php $diastole = ($periksa['odiastole'] > 0 || $periksa['odiastole'] != null) ? $periksa['odiastole'] : '75';?>
                              <input type="number" name="diastole" max="170" min="0" class="form-control" placeholder="75" value="<?php echo $diastole; ?>">

                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Nadi</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-pulse"></i></span>
                              </div>
                              <?php $nadi = ($periksa['onadi'] > 0 || $periksa['onadi'] != null) ? $periksa['onadi'] : '80';?>
                              <input type="number" name="nadi" class="form-control" placeholder="80" value="<?php echo $nadi; ?>">

                            </div>
                          </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom:40px;">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">RR</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <?php $rr = ($periksa['orr'] > 0 || $periksa['orr'] != null) ? $periksa['orr'] : '20';?>
                              <input type="number" name="rr" class="form-control" placeholder="18" value="<?php echo $rr; ?>">

                            </div>
                          </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom:40px;">
                          <div class="form-group animated flipIn">
                            <label for="spo2">SpO2</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <?php $rr = ($periksa['ospo2'] > 0 || $periksa['ospo2'] != null) ? $periksa['ospo2'] : '98';?>
                              <input type="number" name="spo2" class="form-control" placeholder="18" value="<?php echo $rr; ?>">

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
                              <input id="x_card_code" value="<?php echo $periksa['gl_sewaktu']; ?>" name="gl_sewaktu" type="text" class="form-control cc-cvc" placeholder="0" >

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
                              <input id="x_card_code" name="gl_puasa" value="<?php echo $periksa['gl_puasa']; ?>" type="text" class="form-control cc-cvc" placeholder="0" >

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
                              <input id="x_card_code" name="gl_post_prandial" value="<?php echo $periksa['gl_post_prandial']; ?>" type="text" class="form-control cc-cvc" placeholder="0" >

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
                              <input id="x_card_code" name="gl_hba" type="text" value="<?php echo $periksa['gl_hba']; ?>" class="form-control cc-cvc" placeholder="0" >

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
                                <option value="TAA" <?php if ($periksa['kmata']=="TAA"): ?>
                                  selected
                                <?php endif; ?>>TAA</option>
                                <option value="ANEMI" <?php if ($periksa['kmata']=="ANEMI"): ?>
                                  selected
                                <?php endif; ?>>ANEMI</option>
                                <option value="IDERUS" <?php if ($periksa['kmata']=="IDERUS"): ?>
                                  selected
                                <?php endif; ?>>IDERUS</option>
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
                                <option value="TAA" <?php if ($periksa['ktelinga']=="TAA"): ?>
                                  selected
                                <?php endif; ?>>TAA</option>
                                <option value="HIPERMI" <?php if ($periksa['ktelinga']=="HIPERMI"): ?>
                                  selected
                                <?php endif; ?>>HIPERMI</option>
                                <option value="CAIRAN" <?php if ($periksa['ktelinga']=="CAIRAN"): ?>
                                  selected
                                <?php endif; ?>>CAIRAN</option>
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
                                <option value="TAA" <?php if ($periksa['ktonsil']=="TAA"): ?>
                                  selected
                                <?php endif; ?>>TAA</option>
                                <option value="T1" <?php if ($periksa['ktonsil']=="T1"): ?>
                                  selected
                                <?php endif; ?>>T1</option>
                                <option value="T2" <?php if ($periksa['ktonsil']=="T2"): ?>
                                  selected
                                <?php endif; ?>>T2</option>
                                <option value="T3" <?php if ($periksa['ktonsil']=="T3"): ?>
                                  selected
                                <?php endif; ?>>T3</option>
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
                                <option value="TAA" <?php if ($periksa['kleher']=="TAA"): ?>
                                  selected
                                <?php endif; ?>>TAA</option>
                                <option value="Tiroid Membesar" <?php if ($periksa['kleher']=="Tiroid Membesar"): ?>
                                  selected
                                <?php endif; ?>>Tiroid Membesar</option>
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
                                <option value="TAA" <?php if ($periksa['khidung']=="TAA"): ?>
                                  selected
                                <?php endif; ?>>TAA</option>
                                <option value="polip D" <?php if ($periksa['khidung']=="polip D"): ?>
                                  selected
                                <?php endif; ?>>polip D</option>
                                <option value="polip S" <?php if ($periksa['khidung']=="polip S"): ?>
                                  selected
                                <?php endif; ?>>polip S</option>
                                <option value="polip D-S" <?php if ($periksa['khidung']=="polip D-S"): ?>
                                  selected
                                <?php endif; ?>>polip D-S</option>
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
                                <option value="TAA" <?php if ($periksa['gilut']=="TAA"): ?>
                                  selected
                                <?php endif; ?>>TAA</option>
                                <option value="Lidah Kotor" <?php if ($periksa['gilut']=="Lidah Kotor"): ?>
                                  selected
                                <?php endif; ?>>Lidah Kotor</option>
                                <option value="Selaput Putih" <?php if ($periksa['gilut']=="Selaput Putih"): ?>
                                  selected
                                <?php endif; ?>>Selaput Putih</option>
                                <option value="Caries" <?php if ($periksa['gilut']=="Caries"): ?>
                                  selected
                                <?php endif; ?>>Caries</option>
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
                              <textarea class="form-control" rows="4" name="lainkl"><?php echo $periksa['klain']?></textarea>

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
                                <option value="TTB" <?php if ($periksa['tparu']=="TBB"): ?>
                                  selected
                                <?php endif; ?>>TTB</option>
                                <option value="Membesar" <?php if ($periksa['tparu']=="membesar"): ?>
                                  selected
                                <?php endif; ?>>Membesar</option>
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
                                <option value="B U Normal" <?php if ($periksa['pusus']=="B U Normal"): ?>
                                  selected
                                <?php endif; ?>>B U normal</option>
                                <option value="Meningkat" <?php if ($periksa['pusus']=="Meningkat"): ?>
                                  selected
                                <?php endif; ?>>Meningkat</option>
                                <option value="Menurun" <?php if ($periksa['pusus']=="Menurun"): ?>
                                  selected
                                <?php endif; ?>>Menurun</option>
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
                                <option value="soufel" <?php if ($periksa['pdinperut']=="soufel"): ?>
                                  selected
                                <?php endif; ?>>Soufel</option>
                                <option value="keras" <?php if ($periksa['pdinperut']=="keras"): ?>
                                  selected
                                <?php endif; ?>>Keras</option>
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
                                <option value="TAA" <?php if ($periksa['puluhati']=="TAA"): ?>
                                  selected
                                <?php endif; ?>>TAA</option>
                                <option value="Nyeri Tekan" <?php if ($periksa['puluhati']=="Nyeri Tekan"): ?>
                                  selected
                                <?php endif; ?>>Nyeri Tekan</option>
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
                                <option value="TTB" <?php if ($periksa['plien']=="TBB"): ?>
                                  selected
                                <?php endif; ?>>TTB</option>
                                <option value="Membesar" <?php if ($periksa['plien']=="Membesar"): ?>
                                  selected
                                <?php endif; ?>>Membesar</option>
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
                              <textarea class="form-control" rows="4" name="lainperut"><?php echo $periksa['plain']?></textarea>


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
                                <option value="TAA" <?php if ($periksa['uginjal']=="TAA"): ?>
                                  selected
                                <?php endif; ?>>TAA</option>
                                <option value="Nyeri Ketok D" <?php if ($periksa['uginjal']=="Nyeri Ketok D"): ?>
                                  selected
                                <?php endif; ?>>Nyeri Ketok D</option>
                                <option value="Nyeri Ketok S" <?php if ($periksa['uginjal']=="Nyeri Ketok S"): ?>
                                  selected
                                <?php endif; ?>>Nyeri Ketok S</option>
                                <option value="Nyeri Ketok D-S" <?php if ($periksa['uginjal']=="Nyeri Ketok D-S"): ?>
                                  selected
                                <?php endif; ?>>Nyeri Ketok D-S</option>
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
                              <textarea class="form-control" rows="4" name="lainurogenital" placeholder="Lain - Lain"><?php echo $periksa['ulain']?></textarea>

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
function coba() {
  if ($("input#lain_ridul_check:checked").length == 0) {
    $("#lain_ridul").attr('disabled', true);
  } else {
    $("#lain_ridul").attr('disabled', false)
    $("#lain_ridul").focus();;
  }
}
</script>
