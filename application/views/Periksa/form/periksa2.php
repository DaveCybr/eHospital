
<div class="row col-lg-12">
  <div class="col-lg-6">
    <div class="card border-info" style="border: 2px solid;">
      <div class="card-header bg-info text-white">
        <strong>Keluhan Dan Riwayat Sakit</strong>
        <small>Form</small>
      </div>
      <div class="card-body card-block">

        <div class="row p-t-20">
          <div class="col-md-6">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Keluhan</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-face-sad"></i></span>
                </div>
                <input value="<?php echo $periksa['keluhan']; ?>" type="text" id="keluhan" class="form-control" readonly>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Riwayat Penyakit Dulu</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-timer"></i></span>
                </div>
                <input value="<?php echo $periksa['riwayat_dulu']; ?>" type="text" id="keluhan" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-12" style="margin-bottom:30px;">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Riwayat Sekarang</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-wheelchair"></i></span>
                </div>
                <!-- <input value="<?php echo $periksa['riwayat_skrg']; ?>" type="text" id="keluhan" class="form-control" readonly> -->
                  <textarea class="form-control" rows="4" name="lainkl" readonly><?php echo @$periksa['riwayat_skrg']; ?></textarea>

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
                <input value="<?php echo $periksa['obb']; ?>" type="text" class="form-control" readonly>

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
                <input value="<?php echo $periksa['otb']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">lingkar Perut</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-stats-up"></i></span>
                </div>
                <input value="<?php echo $periksa['olingkar_perut']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-g  roup animated flipIn">
              <label for="exampleInputuname">Temperatur</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-pin"></i></span>
                </div>
                <input value="<?php echo $periksa['otemp']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Kesadaran</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-pulse"></i></span>
                </div>
                <input value="<?php echo $periksa['osadar']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Siastole</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                </div>
                <input value="<?php echo $periksa['osiastole']; ?>" type="text" class="form-control" readonly>

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
                <input value="<?php echo $periksa['odiastole']; ?>" type="text" class="form-control" readonly>

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
                <input value="<?php echo $periksa['onadi']; ?>" type="text" class="form-control" readonly>

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
                <input value="<?php echo $periksa['orr']; ?>" type="text" class="form-control" readonly>

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
                <input id="x_card_code" value="<?php echo $periksa['gl_sewaktu']; ?>" readonly name="gl_sewaktu" type="text" class="form-control cc-cvc" placeholder="0" >

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
                <input id="x_card_code" name="gl_puasa" value="<?php echo $periksa['gl_puasa']; ?>" readonly type="text" class="form-control cc-cvc" placeholder="0" >

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
                <input id="x_card_code" name="gl_post_prandial" value="<?php echo $periksa['gl_post_prandial']; ?>" readonly type="text" class="form-control cc-cvc" placeholder="0" >

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
                <input id="x_card_code" name="gl_hba" type="text" value="<?php echo $periksa['gl_hba']; ?>" readonly class="form-control cc-cvc" placeholder="0" >

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
                  <span class="input-group-text" id="basic-addon1"><i class="ti-eye"></i></span>
                </div>
                <input value="<?php echo $periksa['kmata']; ?>" type="text" class="form-control" readonly>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Telinga</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-clip"></i></span>
                </div>
                <input value="<?php echo $periksa['ktelinga']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Tonsil</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span>
                </div>
                <input value="<?php echo $periksa['ktonsil']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Leher</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                </div>
                <input value="<?php echo $periksa['kleher']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Hidung</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
                </div>
                <input value="<?php echo $periksa['khidung']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Gigi/Mulut</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-face-smile"></i></span>
                </div>
                <input value="<?php echo $periksa['kgilut']; ?>" type="text" class="form-control" readonly>

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
                <!-- <input value="<?php echo $periksa['klain']; ?>" type="text" class="form-control" readonly> -->
                <textarea class="form-control" rows="4" readonly name="lainkl"><?php echo @$periksa['klain']; ?></textarea>
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
                  <span class="input-group-text" id="basic-addon1"><i class="ti-face-sad"></i></span>
                </div>
                <input value="<?php echo $periksa['phepar']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Usus</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-face-sad"></i></span>
                </div>
                <input value="<?php echo $periksa['pusus']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Dinding Perut</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-face-sad"></i></span>
                </div>
                <input value="<?php echo $periksa['pdinperut']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Ulu Hati</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-face-sad"></i></span>
                </div>
                <input value="<?php echo $periksa['puluhati']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Lien</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-face-sad"></i></span>
                </div>
                <input value="<?php echo $periksa['plien']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Lain-Lain</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-face-sad"></i></span>
                </div>
                <!-- <input value="<?php echo $periksa['plain']; ?>" type="text" class="form-control" readonly> -->
                <textarea class="form-control" rows="4" name="lainkl" readonly><?php echo @$periksa['plain']; ?></textarea>

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
                  <span class="input-group-text" id="basic-addon1"><i class="ti-face-sad"></i></span>
                </div>
                <input value="<?php echo $periksa['uginjal']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div><div class="col-md-12">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Lain lain</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-face-sad"></i></span>
                </div>
                <!-- <input value="<?php echo $periksa['ulain']; ?>" type="text" class="form-control" readonly> -->
                  <textarea class="form-control" rows="4" name="lainkl" readonly><?php echo @$periksa['ulain']; ?></textarea>
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
                  <span class="input-group-text" id="basic-addon1"><i class="ti-heart"></i></span>
                </div>
                <input value="<?php echo $periksa['tcor']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Paru</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-face-sad"></i></span>
                </div>
                <input value="<?php echo $periksa['tparu']; ?>" type="text" class="form-control" readonly>

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
                <!-- <input value="<?php echo $periksa['tlain']; ?>" type="text" class="form-control" readonly> -->
                  <textarea class="form-control" rows="4" name="tainkl" readonly><?php echo @$periksa['tlain']; ?></textarea>

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
                  <span class="input-group-text" id="basic-addon1"><i class="ti-face-sad"></i></span>
                </div>
                <input value="<?php echo $periksa['eatas']; ?>" type="text" class="form-control" readonly>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Extremitas Bawah</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-face-sad"></i></span>
                </div>
                <input value="<?php echo $periksa['ebawah']; ?>" type="text" class="form-control" readonly>

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
                  <textarea class="form-control" rows="4" name="lainkl" readonly><?php echo @$periksa['elain']; ?></textarea>
                <!-- <input value="<?php echo $periksa['elain']; ?>" type="text" class="form-control" readonly> -->

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
