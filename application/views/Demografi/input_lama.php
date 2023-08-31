<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
            <div class="card card-cascade narrower z-depth-1">
              <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

                    <h4><a href="" class="white-text mx-3">Asasmen Keperawatan</a></h4>

              </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('Asesmen/insert_lama');?>
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

                <div class="col-lg-12">
                  <div class="card border-info" style="border: 2px solid;">
                    <div class="card-header bg-info text-white">
                      <strong>Kondisi Pasien</strong>
                      <small>Form</small>
                    </div>
                    <div class="card-body card-block">
                      <div class="row p-t-20">
                        <div class="col-md-4">
                          <div class="form-group animated flipIn m-l-10">
                            <label for="exampleInputuname">BB</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-face-smile"></i></span>
                              </div>
                              <input type="number" min="0" name="bb" class="form-control" placeholder="BB" value="<?php echo @$demografi['pn_bb']?>">

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
                              <input type="number" min="0" name="tb" class="form-control" placeholder="TB" value="<?php echo @$demografi['pn_tb']?>">

                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Temperatur</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-pin"></i></span>
                              </div>
                              <input type="number" step="0.01" name="temp" class="form-control" placeholder="36.5" value="<?php echo @$demografi['temp']?>" >

                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
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
                        <div class="col-md-8">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Siastole</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <input type="number" min="0" name="siastole" class="form-control" placeholder="120" value="<?php echo @$kunjungan['sistole']?>">

                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Diastole</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <input type="number" min="0" name="diastole" class="form-control" placeholder="75" value="<?php echo @$kunjungan['diastole']?>">

                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Nadi</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-pulse"></i></span>
                              </div>
                              <input type="number" min="0" name="nadi" class="form-control" placeholder="80" value="<?php echo @$kunjungan['nadi']?>">

                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">RR</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <input type="number" min="0" name="rr" class="form-control" placeholder="18" value="<?php echo @$demografi['rr']?>">

                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Lingkar Perut</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                              </div>
                              <input type="number" min="0" step="0.1" name="lingkarperut" class="form-control" placeholder="--" value="<?php echo @$demografi['pn_tb']?>">

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
