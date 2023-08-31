<style>
.form-group{
  margin-bottom: 5px;
}
</style>
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jenis_obat" class=" form-control-label">Pekerjaan</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Pekerjaan Pasien" value="<?php echo @$pekerjaan['pekerjaan']; ?>" required>
            </div>
    </div>
  </div>
</div>
