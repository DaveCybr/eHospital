<style>
.form-group{
  margin-bottom: 5px;
}
</style>
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="tujuan_pelayanan" class=" form-control-label">Biaya Administrasi</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="rajal" id="tujuan_pelayanan" class="form-control" placeholder="" value="<?php echo @$adm['rawat_jalan']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="tujuan_pelayanan" class=" form-control-label">Rekam Medis (Pasien Baru)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="medis_baru" id="tujuan_pelayanan" class="form-control" placeholder="" value="<?php echo @$adm['rekam_medis']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="tujuan_pelayanan" class=" form-control-label">Rekam Medis (Pasien Lama)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="medis_lama" id="tujuan_pelayanan" class="form-control" placeholder="" value="<?php echo @$adm['rekam_medis_lama']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="tujuan_pelayanan" class=" form-control-label">Biaya Blanko</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="blanko" id="tujuan_pelayanan" class="form-control" placeholder="" value="<?php echo @$adm['blanko']; ?>" required>
            </div>
    </div>


  </div>
</div>
