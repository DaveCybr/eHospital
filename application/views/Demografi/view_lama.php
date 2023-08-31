
        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

                  <h5><a href="" class="white-text mx-3">Asasmen Keperawatan</a></h5>

            </div>
            <div class="card-body card-block">

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
                              <input type="number" name="bb" class="form-control" placeholder="BB" value="<?php echo $kunjungan['bb']?>" disabled>

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
                              <input type="number" name="tb" class="form-control" placeholder="TB" disabled value="<?php echo $kunjungan['tb']?>">

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
                              <input type="text" name="temp" class="form-control" placeholder="Temp" value="<?php echo $kunjungan['suhu']?>" disabled>

                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Kesadaran</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                              </div>
                              <input type="text" name="siastole" class="form-control" placeholder="---" value="<?php echo $kunjungan['kesadaran']?>" disabled>
                              <!-- <select name="kesadaran" class="mdb-select colorful-select dropdown-info sm-form">
                                <option value="KOMPOMENTIS" <?php if ($kunjungan['kesadaran']=='KOMPOMENTIS'): ?>
                                  selected
                                <?php endif; ?>>KOMPOMENTIS (CM)</option>
                                <option value="SOMNOLENSE" <?php if ($kunjungan['kesadaran']=='SOMNOLENSE'): ?>
                                  selected
                                <?php endif; ?>>SOMNOLENSE</option>
                                <option value="STUPOR" <?php if ($kunjungan['kesadaran']=='STUPOR'): ?>
                                  selected
                                <?php endif; ?>>STUPOR</option>
                                <option value="KOMA" <?php if ($kunjungan['kesadaran']=='KOMA'): ?>
                                  selected
                                <?php endif; ?>>KOMA</option>
                              </select> -->
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
                              <input type="number" name="siastole" class="form-control" placeholder="---" value="<?php echo $kunjungan['sistole']?>" disabled>

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
                              <input type="number" name="diastole" class="form-control" placeholder="---" value="<?php echo $kunjungan['diastole']?>" disabled>

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
                              <input type="number" name="nadi" class="form-control" placeholder="---" value="<?php echo $kunjungan['nadi']?>" disabled>

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
                              <input type="number" name="rr" class="form-control" placeholder="---" value="<?php echo $kunjungan['rr']?>" disabled>

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
