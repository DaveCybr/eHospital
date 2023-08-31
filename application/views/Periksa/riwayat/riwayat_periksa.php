
      <div class="row form-group">
            <div class="col col-md-3 text-right">
              <label for="keluhan" class=" form-control-label">Keluhan :</label>
            </div>
            <div class="col-12 col-md-6">
                <input value="<?php echo $hasil_periksa['keluhan']; ?>" type="text" id="keluhan" class="form-control" readonly>
            </div>
      </div>

      <div class="row form-group">
            <div class="col col-md-3 text-right">
              <label for="keluhan" class=" form-control-label">Riwayat Penyakit Dulu :</label>
            </div>
            <div class="col-12 col-md-5">
              <input value="<?php echo $hasil_periksa['riwayat_dulu']; ?>" type="text" id="keluhan" class="form-control" readonly>
            </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3 text-right">
          <label for="keluhan" class=" form-control-label">Riwayat Penyakit Sekarang</label>
        </div>
        <div class="col-12 col-md-8">
          <input value="<?php echo $hasil_periksa['riwayat_skrg']; ?>" type="text" id="keluhan" class="form-control" readonly>
        </div>
      </div>


  <div class="card">
    <div class="card-body card-block">
      <div class="row form-group">
        <div class="col col-md-2 text-right">
          <label class=" form-control-label">BB:</label>
        </div>
        <div class="col-12 col-md-2">
          <input value="<?php echo $hasil_periksa['obb']; ?>" type="text" class="form-control" readonly>
        </div>

        <div class="col col-md-2 text-right">
          <label class=" form-control-label">TB:</label>
        </div>
        <div class="col-12 col-md-2">
          <input value="<?php echo $hasil_periksa['otb']; ?>" type="text" class="form-control" readonly>
        </div>

        <div class="col col-md-2 text-right">
          <label class=" form-control-label">Temperatur:</label>
        </div>
        <div class="col-12 col-md-2">
          <input value="<?php echo $hasil_periksa['otemp']; ?>" type="text" class="form-control" readonly>
        </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-2 text-right">
          <label class=" form-control-label">Kesadaran:</label>
        </div>
        <div class="col-12 col-md-3">
          <input value="<?php echo $hasil_periksa['osadar']; ?>" type="text" class="form-control" readonly>
        </div>
        <div class="col col-md-1 text-right">
          <label class=" form-control-label">Siastole:</label>
        </div>
        <div class="col-12 col-md-2">
          <input value="<?php echo $hasil_periksa['osiastole']; ?>" type="text" class="form-control" readonly>
        </div>
        <div class="col col-md-2 text-right">
          <label class=" form-control-label">Diastole:</label
        </div>
        <div class="col-12 col-md-2">
          <input value="<?php echo $hasil_periksa['odiastole']; ?>" type="text" class="form-control" readonly>
        </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-2 text-right">
          <label class=" form-control-label">Nadi:</label>
        </div>
        <div class="col-12 col-md-3">
          <input value="<?php echo $hasil_periksa['onadi']; ?>" type="text" class="form-control" readonly>
        </div>
        <div class="col-12 col-md-2">
          <input value="<?php echo $hasil_periksa['onadi']; ?>" type="text" class="form-control" readonly>
        </div>
        <div class="col col-md-3 text-right">
          <label class=" form-control-label">RR:</label>
        </div>
        <div class="col-12 col-md-2">
          <input value="<?php echo $hasil_periksa['orr']; ?>" type="text" class="form-control" readonly>
        </div>
      </div>
    </div>
  </div>

  <div class="row col-lg-12">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <strong>KEPALA / LEHER</strong>
          <small>Form</small>
        </div>
        <div class="card-body card-block">
          <div class="row form-group">
            <div class="col col-md-2 text-right">
              <label class=" form-control-label">Mata:</label>
            </div>
            <div class="col-12 col-md-4">
              <input value="<?php echo $hasil_periksa['kmata']; ?>" type="text" class="form-control" readonly>
            </div>
            <div class="col col-md-2 text-right">
              <label class=" form-control-label">Telinga:</label>
            </div>
            <div class="col-12 col-md-4">
              <input value="<?php echo $hasil_periksa['ktelinga']; ?>" type="text" class="form-control" readonly>
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-2 text-right">
              <label class=" form-control-label">Tonsil:</label>
            </div>
            <div class="col-12 col-md-4">
              <input value="<?php echo $hasil_periksa['ktonsil']; ?>" type="text" class="form-control" readonly>
            </div>
            <div class="col col-md-2 text-right">
              <label class=" form-control-label">Leher:</label>
            </div>
            <div class="col-12 col-md-4">
              <input value="<?php echo $hasil_periksa['kleher']; ?>" type="text" class="form-control" readonly>
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-4 text-right">
              <label class=" form-control-label">Hidung:</label>
            </div>
            <div class="col-12 col-md-8">
              <input value="<?php echo $hasil_periksa['khidung']; ?>" type="text" class="form-control" readonly>
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-4 text-right">
              <label class=" form-control-label">Gigi / Mulut:</label>
            </div>
            <div class="col-12 col-md-8">
              <input value="<?php echo $hasil_periksa['kgilut']; ?>" type="text" class="form-control" readonly>
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-4 text-right">
              <label class=" form-control-label">Lain - Lain:</label>
            </div>
            <div class="col-12 col-md-8">
              <input value="<?php echo $hasil_periksa['klain']; ?>" type="text" class="form-control" readonly>
            </div>
          </div>
        </div>
        </div>
      </div>

    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <strong>PERUT / ABOMEN</strong>
          <small>SubForm</small>
        </div>
        <div class="card-body card-block">
          <div class="row form-group">
            <div class="col col-md-2 text-right">
              <label class=" form-control-label">Hepar:</label>
            </div>
            <div class="col-12 col-md-4">
              <input value="<?php echo $hasil_periksa['phepar']; ?>" type="text" class="form-control" readonly>
            </div>
            <div class="col col-md-2 text-right">
              <label class=" form-control-label">Usus:</label>
            </div>
            <div class="col-12 col-md-4">
              <input value="<?php echo $hasil_periksa['pusus']; ?>" type="text" class="form-control" readonly>
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-4 text-right">
              <label class=" form-control-label">Dinding Perut</label>
            </div>
            <div class="col-12 col-md-8">
              <input value="<?php echo $hasil_periksa['pdinperut']; ?>" type="text" class="form-control" readonly>
            </div>

          </div>
          <div class="row form-group">
            <div class="col col-md-4 text-right">
              <label class=" form-control-label">Ulu Hati:</label>
            </div>
            <div class="col-12 col-md-8">
              <input value="<?php echo $hasil_periksa['puluhati']; ?>" type="text" class="form-control" readonly>
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-4 text-right">
              <label class=" form-control-label">Lien:</label>
            </div>
            <div class="col-12 col-md-6">
              <input value="<?php echo $hasil_periksa['plien']; ?>" type="text" class="form-control" readonly>
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-4 text-right">
              <label class=" form-control-label">Lain - Lain:</label>
            </div>
            <div class="col-12 col-md-8">
              <input value="<?php echo $hasil_periksa['plain']; ?>" type="text" class="form-control" readonly>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          <strong>THORAK</strong>
          <small>SubForm</small>
        </div>
        <div class="card-body card-block">
          <div class="row form-group">
                <div class="col col-md-12" >
                  <label class=" form-control-label">Core/Jantung:</label>
                </div>
                <div class="col-12 col-md-6" style="padding-left: 30px;">
                  <input value="<?php echo $hasil_periksa['tcor']; ?>" type="text" class="form-control" readonly>
                </div>
          </div>
          <div class="row form-group">
                <div class="col col-md-12">
                  <label class=" form-control-label">Paru:</label>
                </div>
                <div class="col-12 col-md-6" style="padding-left: 30px;">
                  <input value="<?php echo $hasil_periksa['tparu']; ?>" type="text" class="form-control" readonly>
                </div>
          </div>
          <div class="row form-group">
          <div class="col-lg-12">
            <label for="x_card_code" class="control-label mb-1">Lain - Lain :</label>
            <div class="input-group">
              <input value="<?php echo $hasil_periksa['tlain']; ?>" type="text" class="form-control" readonly>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          <strong>UROGENITAL</strong>
          <small>SubForm</small>
        </div>
        <div class="card-body card-block">
          <div class="row form-group">
          <div class="col-lg-12">
            <label for="x_card_code" class="control-label mb-1">Ginjal :</label>
            <div class="input-group">
              <input value="<?php echo $hasil_periksa['uginjal']; ?>" type="text" class="form-control" readonly>
            </div>
          </div>
        </div>
          <div class="row form-group">
          <div class="col-lg-12">
            <label for="x_card_code" class="control-label mb-1">Lain - Lain :</label>
            <div class="input-group">
              <input value="<?php echo $hasil_periksa['ulain']; ?>" type="text" class="form-control" readonly>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          <strong>EXTREMITAS</strong>
          <small>SubForm</small>
        </div>
        <div class="card-body card-block">
          <div class="row form-group">
                <div class="col col-md-12" >
                  <label class=" form-control-label">Extrimtas Atas:</label>
                </div>
                <div class="col-12 col-md-6" style="padding-left: 30px;">
                  <input value="<?php echo $hasil_periksa['eatas']; ?>" type="text" class="form-control" readonly>
                </div>
          </div>
          <div class="row form-group">
                <div class="col col-md-12" >
                  <label class=" form-control-label">Extrimtas Bawah:</label>
                </div>
                <div class="col-12 col-md-6" style="padding-left: 30px;">
                  <input value="<?php echo $hasil_periksa['ebawah']; ?>" type="text" class="form-control" readonly>
                </div>
          </div>
          <div class="row form-group">
          <div class="col-lg-12">
            <label for="x_card_code" class="control-label mb-1">Lain - Lain :</label>
            <div class="input-group">
              <input value="<?php echo $hasil_periksa['elain']; ?>" type="text" class="form-control" readonly>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
