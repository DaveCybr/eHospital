<style>
.form-group{
  margin-bottom: 5px;
}
</style>
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jenis_obat" class=" form-control-label">Jenis Obat</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="jenis_obat" id="jenis_obat" class="form-control" placeholder="Jenis Obat" value="<?php echo @$jenis_obat['jenis_obat']; ?>" required>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="idjenis_obat" id="jenis_obat" class="form-control" placeholder="Jenis Obat" value="<?php echo @$jenis_obat['idjenis_obat']; ?>" hidden>
            </div>
    </div>
  </div>
</div>
