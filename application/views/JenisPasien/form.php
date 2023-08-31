<style>
.form-group{
  margin-bottom: 5px;
}
</style>
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jenis_pasien" class=" form-control-label">Jenis Pasien</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="jenis_pasien" id="jenis_pasien" class="form-control" placeholder="Jenis Pasien" value="<?php echo @$jenis_pasien['jenis_pasien']; ?>" required>
            </div>
    </div>
  </div>
</div>
