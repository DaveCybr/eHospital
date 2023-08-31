<style>
.form-group{
  margin-bottom: 5px;
}
</style>
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="tujuan_pelayanan" class=" form-control-label">Kode Tupel</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="kode" id="kode" class="form-control" placeholder="" value="<?php echo @$tujuan_pelayanan['kode_tupel']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="tujuan_pelayanan" class=" form-control-label">Kode Antrian</label>
            </div>
            <div class="col-12 col-md-9">
              <div class="custom-control custom-radio">
                <input type="radio" id="umum" name="kd_antrian" value="U" class="custom-control-input" <?php if (@$tujuan_pelayanan['kd_antrian']=='U') {
                  echo "checked";
          }?> required>
                <label class="custom-control-label" for="umum">Umum</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="gigi" name="kd_antrian" value="G" class="custom-control-input" <?php if (@$tujuan_pelayanan['kd_antrian']=='G') {
                  echo "checked";
          }?> required>
                <label class="custom-control-label" for="gigi">Gigi</label>
              </div>
            </div>
    </div>

    <div class="row form-group">
            <div class="col col-md-3">
              <label for="tujuan_pelayanan" class=" form-control-label">Tujuan Pelayanan</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="tujuan_pelayanan" id="tujuan_pelayanan" class="form-control" placeholder="" value="<?php echo @$tujuan_pelayanan['tujuan_pelayanan']; ?>" required>
            </div>
    </div>


    <div class="row form-group">
            <div class="col col-md-3">
              <label for="polisakit" class=" form-control-label">Poli Sakit</label>
            </div>
            <div class="col-12 col-md-9">
              <div class="custom-control custom-radio">
                <input type="radio" id="polisakitya" name="polisakit" value="1" class="custom-control-input" <?php if (@$tujuan_pelayanan['polisakit']=='1') {
                  echo "checked";
          }?> required>

                <label class="custom-control-label" for="polisakitya">Ya</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="polisakitno" name="polisakit" value="0" class="custom-control-input" <?php if (@$tujuan_pelayanan['polisakit']=='0') {
                  echo "checked";
          }?> required>
                <label class="custom-control-label" for="polisakitno">Tidak</label>
              </div>

            </div>
    </div>

  </div>
</div>
