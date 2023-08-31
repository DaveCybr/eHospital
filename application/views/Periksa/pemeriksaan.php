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
              <?php echo form_open_multipart('Periksa/input_pemeriksaan');?>
              <?php echo @$error;?>
              <div class="card-body card-block">

                <div class="row form-group">
                      <div class="col col-md-2">
                        <label for="nokun" class=" form-control-label">NO.Kunjungan :</label>
                      </div>
                      <div class="col-12 col-md-4">
                          <input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$idkunjungan; ?>" required readonly>
                      </div>
                      <div class="col col-md-1">
                        <label for="tanggal" class=" form-control-label">Tanggal</label>
                      </div>
                      <div class="col-12 col-md-4">
                          <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo date('Y-m-d'); ?>" required readonly>
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

                <div class="card color-bordered-table info-bordered-table">
                  <div class="card-body card-block">
                    <div class="row form-group">
                          <div class="col col-md-3 text-right">
                            <label for="keluhan" class=" form-control-label">Keluhan :</label>
                          </div>
                          <div class="col-12 col-md-6">
                              <input type="text" name="keluhan" id="keluhan" class="form-control" placeholder="Keluhan Pasien" required>
                          </div>
                    </div>

                    <div class="row form-group">
                          <div class="col col-md-3 text-right">
                            <label for="keluhan" class=" form-control-label">Riwayat Penyakit Dulu :</label>
                          </div>
                          <div class="col-12 col-md-5">
                            <label for="riwayat_dulu" class="form-check-label col-md-4">
                                <input type="checkbox" id="riwayat_dulu" name="riwayat_dulu" value="Hipertensi" onclick="coba()" class="form-check-input" >Hipertensi
                            </label>
                            <label for="riwayat_dulu" class="form-check-label col-md-4">
                                <input type="checkbox" id="riwayat_dulu" name="riwayat_dulu" value="Hipatitis" onclick="coba()" class="form-check-input" >Hepatitis
                            </label>
                            <label for="riwayat_dulu" class="form-check-label col-md-2">
                                <input type="checkbox" id="riwayat_dulu" name="riwayat_dulu" value="DM" onclick="coba()" class="form-check-input">DM
                            </label>
                            <label for="riwayat_dulu" class="form-check-label col-md-9">
                                <input type="checkbox" id="lain_ridul_check" name="riwayat_dulu" value="lain" onclick="coba()" class="form-check-input"><input type="text" id="lain_ridul" name="lain_ridul" class="form-control" placeholder="Lain - Lain">
                            </label>
                          </div>
                    </div>

                    <div class="row form-group">
                      <div class="col col-md-3 text-right">
                        <label for="keluhan" class=" form-control-label">Riwayat Penyakit Sekarang</label>
                      </div>
                      <div class="col-12 col-md-8">
                        <input type="text" name="riwayat_skrg" class="form-control" placeholder="Riwayat Penyakit Sekarang">
                      </div>
                    </div>
                  </div>
                </div>


                <div class="card color-bordered-table info-bordered-table">
                  <div class="card-body card-block">
                    <div class="row form-group">
                      <div class="col col-md-2 text-right">
                        <label class=" form-control-label">BB:</label>
                      </div>
                      <div class="col-12 col-md-2">
                        <input type="number" name="bb" class="form-control" placeholder="BB">
                      </div>

                      <div class="col col-md-2 text-right">
                        <label class=" form-control-label">TB:</label>
                      </div>
                      <div class="col-12 col-md-2">
                        <input type="number" name="tb" class="form-control" placeholder="TB">
                      </div>

                      <div class="col col-md-2 text-right">
                        <label class=" form-control-label">Temperatur:</label>
                      </div>
                      <div class="col-12 col-md-2">
                        <input type="number" name="temp" class="form-control" placeholder="Temp">
                      </div>
                    </div>

                    <div class="row form-group">
                      <div class="col col-md-2 text-right">
                        <label class=" form-control-label">Kesadaran:</label>
                      </div>
                      <div class="col-12 col-md-3">
                        <select name="kesadaran" class="form-control-sm form-control">
                          <option value="KOMPOMENTIS">KOMPOMENTIS (CM)</option>
                          <option value="SOMNOLENSE">SOMNOLENSE</option>
                          <option value="STUPOR">STUPOR</option>
                          <option value="KOMA">KOMA</option>
                        </select>
                      </div>
                      <div class="col col-md-1 text-right">
                        <label class=" form-control-label">Siastole:</label>
                      </div>
                      <div class="col-12 col-md-2">
                        <input type="number" name="siastole" class="form-control" placeholder="---">
                      </div>
                      <div class="col col-md-2 text-right">
                        <label class=" form-control-label">Diastole:</label>
                      </div>
                      <div class="col-12 col-md-2">
                        <input type="number" name="diastole" class="form-control" placeholder="---">
                      </div>
                    </div>

                    <div class="row form-group">
                      <div class="col col-md-2 text-right">
                        <label class=" form-control-label">Nadi:</label>
                      </div>
                      <div class="col-12 col-md-3">
                        <input type="number" name="nadi" class="form-control" placeholder="---">
                      </div>
                      <div class="col-12 col-md-2">
                        <input type="number" name="nadi" class="form-control" placeholder="---">
                      </div>
                      <div class="col col-md-3 text-right">
                        <label class=" form-control-label">RR:</label>
                      </div>
                      <div class="col-12 col-md-2">
                        <input type="number" name="rr" class="form-control" placeholder="---">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row col-lg-12">
                  <div class="col-lg-6">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>KEPALA / LEHER</strong>
                        <small>Form</small>
                      </div>
                      <div class="card-body card-block">
                        <div class="row form-group">
                          <div class="col col-md-2 text-right">
                            <label class=" form-control-label">Mata:</label>
                          </div>
                          <div class="col-12 col-md-4">
                            <select name="mata" class="form-control-sm form-control">
                              <option value="TAA">TAA</option>
                              <option value="ANEMI">ANEMI</option>
                              <option value="IDERUS">IDERUS</option>
                            </select>
                          </div>
                          <div class="col col-md-2 text-right">
                            <label class=" form-control-label">Telinga:</label>
                          </div>
                          <div class="col-12 col-md-4">
                            <select name="telinga" class="form-control-sm form-control">
                              <option value="TAA">TAA</option>
                              <option value="HIPERMI">HIPERMI</option>
                              <option value="CAIRAN">CAIRAN</option>
                            </select>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-2 text-right">
                            <label class=" form-control-label">Tonsil:</label>
                          </div>
                          <div class="col-12 col-md-4">
                            <select name="tonsil" class="form-control-sm form-control">
                              <option value="TAA">TAA</option>
                              <option value="T1">T1</option>
                              <option value="T2">T2</option>
                              <option value="T3">T3</option>
                            </select>
                          </div>
                          <div class="col col-md-2 text-right">
                            <label class=" form-control-label">Leher:</label>
                          </div>
                          <div class="col-12 col-md-4">
                            <select name="leher" class="form-control-sm form-control">
                              <option value="TAA">TAA</option>
                              <option value="Tiroid Membesar">Tiroid Membesar</option>
                            </select>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-4 text-right">
                            <label class=" form-control-label">Hidung:</label>
                          </div>
                          <div class="col-12 col-md-8">
                            <select name="hidung" class="form-control-sm form-control">
                              <option value="TAA">TAA</option>
                              <option value="polip D">polip D</option>
                              <option value="polip S">polip S</option>
                              <option value="polip D-S">polip D-S</option>
                            </select>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-4 text-right">
                            <label class=" form-control-label">Gigi / Mulut:</label>
                          </div>
                          <div class="col-12 col-md-8">
                            <select name="gigimulut" class="form-control-sm form-control">
                              <option value="TAA">TAA</option>
                              <option value="Lidah Kotor">Lidah Kotor</option>
                              <option value="Selaput Putih">Selaput Putih</option>
                              <option value="Caries">Caries</option>
                            </select>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-4 text-right">
                            <label class=" form-control-label">Lain - Lain:</label>
                          </div>
                          <div class="col-12 col-md-8">
                            <input type="text" name="lainkl" class="form-control">
                          </div>
                        </div>
                      </div>
                      </div>
                    </div>

                  <div class="col-lg-6">
                    <div class="card color-bordered-table muted-bordered-table">
                      <div class="card-header bg-dark text-white">
                        <strong>PERUT / ABOMEN</strong>
                        <small>SubForm</small>
                      </div>
                      <div class="card-body card-block">
                        <div class="row form-group">
                          <div class="col col-md-2 text-right">
                            <label class=" form-control-label">Hepar:</label>
                          </div>
                          <div class="col-12 col-md-4">
                            <select name="hepar" class="form-control-sm form-control">
                              <option value="TTB">TTB</option>
                              <option value="Membesar">Membesar</option>
                            </select>
                          </div>
                          <div class="col col-md-2 text-right">
                            <label class=" form-control-label">Usus:</label>
                          </div>
                          <div class="col-12 col-md-4">
                            <select name="usus" class="form-control-sm form-control">
                              <option value="B U Normal">B U normal</option>
                              <option value="Meningkat">Meningkat</option>
                              <option value="Menurun">Menurun</option>
                            </select>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-4 text-right">
                            <label class=" form-control-label">Dinding Perut</label>
                          </div>
                          <div class="col-12 col-md-8">
                            <select name="dinperut" class="form-control-sm form-control">
                              <option value="soufel">Soufel</option>
                              <option value="keras">Keras</option>
                            </select>
                          </div>

                        </div>
                        <div class="row form-group">
                          <div class="col col-md-4 text-right">
                            <label class=" form-control-label">Ulu Hati:</label>
                          </div>
                          <div class="col-12 col-md-8">
                            <select name="uluhati" class="form-control-sm form-control">
                              <option value="TAA">TAA</option>
                              <option value="Nyeri Tekan">Nyeri Tekan</option>
                            </select>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-4 text-right">
                            <label class=" form-control-label">Lien:</label>
                          </div>
                          <div class="col-12 col-md-6">
                            <select name="lien" class="form-control-sm form-control">
                              <option value="TTB">TTB</option>
                              <option value="Membesar">Membesar</option>
                            </select>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-4 text-right">
                            <label class=" form-control-label">Lain - Lain:</label>
                          </div>
                          <div class="col-12 col-md-8">
                            <input type="text" name="lainperut" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="card color-bordered-table success-bordered-table">
                      <div class="card-header bg-success text-white">
                        <strong>THORAK</strong>
                        <small>SubForm</small>
                      </div>
                      <div class="card-body card-block">
                        <div class="row form-group">
                              <div class="col col-md-12" >
                                <label class=" form-control-label">Core/Jantung:</label>
                              </div>
                              <div class="col-12 col-md-6" style="padding-left: 30px;">
                                <label class="form-check-label">
                                    <input type="checkbox" id="corejantung" name="corejantung" value="DBN" class="form-check-input">DBN
                                </label><br>
                                <label class="form-check-label">
                                    <input type="checkbox" id="corejantung" name="corejantung" value="Membesar" class="form-check-input">Membesar
                                </label>
                              </div>
                              <div class="col-12 col-md-6">

                                <label class="form-check-label">
                                    <input type="checkbox" id="corejantung" name="corejantung" value="Murmur" class="form-check-input">Murmur
                                </label><br>
                                <label class="form-check-label">
                                    <input type="checkbox" id="corejantung" name="corejantung" value="Galop" class="form-check-input">Galop
                                </label>
                              </div>
                        </div>
                        <div class="row form-group">
                              <div class="col col-md-12">
                                <label class=" form-control-label">Paru:</label>
                              </div>
                              <div class="col-12 col-md-6" style="padding-left: 30px;">
                                <label class="form-check-label">
                                    <input type="checkbox" id="paru" name="paru" value="DBN" class="form-check-input">DBN
                                </label><br>
                                <label class="form-check-label">
                                    <input type="checkbox" id="paru" name="paru" value="Whezing D" class="form-check-input">Whezing D
                                </label><br>
                                <label class="form-check-label">
                                    <input type="checkbox" id="paru" name="paru" value="Whezing S" class="form-check-input">Whezing S
                                </label><br>
                              </div>
                              <div class="col-12 col-md-6">
                                <label class="form-check-label">
                                    <input type="checkbox" id="paru" name="paru" value="Ronchi D" class="form-check-input">Ronchi D
                                </label><br>
                                <label class="form-check-label">
                                    <input type="checkbox" id="paru" name="paru" value="Ronchi S" class="form-check-input">Ronchi S
                                </label>
                              </div>
                        </div>
                        <div class="row form-group">
                        <div class="col-lg-12">
                          <label for="x_card_code" class="control-label mb-1">Lain - Lain :</label>
                          <div class="input-group">
                            <input id="x_card_code" name="lainthorak" type="text" class="form-control cc-cvc" placeholder="Lain - Lain" >
                          </div>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="card color-bordered-table warning-bordered-table">
                      <div class="card-header bg-warning text-white">
                        <strong>UROGENITAL</strong>
                        <small>SubForm</small>
                      </div>
                      <div class="card-body card-block">
                        <div class="row form-group">
                        <div class="col-lg-12">
                          <label for="x_card_code" class="control-label mb-1">Ginjal :</label>
                          <div class="input-group">
                            <select name="ginjal" class="form-control-sm form-control">
                              <option value="TAA">TAA</option>
                              <option value="Nyeri Ketok D">Nyeri Ketok D</option>
                              <option value="Nyeri Ketok S">Nyeri Ketok S</option>
                              <option value="Nyeri Ketok D-S">Nyeri Ketok D-S</option>
                            </select>
                          </div>
                        </div>
                      </div>
                        <div class="row form-group">
                        <div class="col-lg-12">
                          <label for="x_card_code" class="control-label mb-1">Lain - Lain :</label>
                          <div class="input-group">
                            <input id="x_card_code" name="lainurogenital" type="text" class="form-control cc-cvc" placeholder="Lain - Lain" >
                          </div>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="card color-bordered-table primary-bordered-table">
                      <div class="card-header bg-primary text-white">
                        <strong>EXTREMITAS</strong>
                        <small>SubForm</small>
                      </div>
                      <div class="card-body card-block">
                        <div class="row form-group">
                              <div class="col col-md-12" >
                                <label class=" form-control-label">Extrimtas Atas:</label>
                              </div>
                              <div class="col-12 col-md-6" style="padding-left: 30px;">
                                <label class="form-check-label">
                                    <input type="checkbox" id="exatas" name="exatas" value="TAA" class="form-check-input">TAA
                                </label><br>
                                <label class="form-check-label">
                                    <input type="checkbox" id="exatas" name="exatas" value="Parase D" class="form-check-input">Parase D
                                </label>
                                <label class="form-check-label">
                                    <input type="checkbox" id="exatas" name="exatas" value="Paralise D" class="form-check-input">Paralise D
                                </label>
                              </div>
                              <div class="col-12 col-md-6">
                                <label class="form-check-label">
                                    <input type="checkbox" id="exatas" name="exatas" value="Parase S" class="form-check-input">Parase S
                                </label>
                                <label class="form-check-label">
                                    <input type="checkbox" id="exatas" name="exatas" value="Paralise S" class="form-check-input">Paralise S
                                </label>
                              </div>
                        </div>
                        <div class="row form-group">
                              <div class="col col-md-12" >
                                <label class=" form-control-label">Extrimtas Bawah:</label>
                              </div>
                              <div class="col-12 col-md-6" style="padding-left: 30px;">
                                <label class="form-check-label">
                                    <input type="checkbox" id="corejantung" name="exbawah" value="TAA" class="form-check-input">TAA
                                </label><br>
                                <label class="form-check-label">
                                    <input type="checkbox" id="corejantung" name="exbawah" value="Parase D" class="form-check-input">Parase D
                                </label>
                                <label class="form-check-label">
                                    <input type="checkbox" id="corejantung" name="exbawah" value="Paralise D" class="form-check-input">Paralise D
                                </label>
                              </div>
                              <div class="col-12 col-md-6">
                                <label class="form-check-label">
                                    <input type="checkbox" id="corejantung" name="exbawah" value="Parase S" class="form-check-input">Parase S
                                </label>
                                <label class="form-check-label">
                                    <input type="checkbox" id="corejantung" name="exbawah" value="Paralise S" class="form-check-input">Paralise S
                                </label>
                              </div>
                        </div>
                        <div class="row form-group">
                        <div class="col-lg-12">
                          <label for="x_card_code" class="control-label mb-1">Lain - Lain :</label>
                          <div class="input-group">
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
