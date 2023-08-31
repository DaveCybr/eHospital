<style>
.form-group{
  margin-bottom: 5px;
}
</style>
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Kategori Obat</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="kategori_obat" id="kategori_obat" class="form-control" placeholder="Kategori Obat" value="<?php echo @$kategori_obat['kategori_obat']; ?>" required>
            </div>
    </div>
  </div>
</div>
