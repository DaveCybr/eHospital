<style>
.form-group{
  margin-bottom: 5px;
}
</style>

<div class="row form-group">
  <div class="col col-md-3">
    <label for="text-input" class=" form-control-label">Nama Supplier</label>
  </div>
  <div class="col-12 col-md-9">
    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Supplier" value="<?php echo @$supplier['nama']; ?>" required>
  </div>
</div>

<div class="row form-group">
  <div class="col col-md-3">
    <label for="text-input" class=" form-control-label">Alamat</label>
  </div>
  <div class="col-5">
    <textarea name="alamat" rows="8"  required class="form-control">
      <?php echo @$supplier['alamat']; ?>
    </textarea>
  </div>
</div>

<div class="row form-group">
  <div class="col col-md-3">
    <label for="text-input" class=" form-control-label">Kota</label>
  </div>
  <div class="col-5">
      <input type="text" name="kota" id="kota" class="form-control" placeholder="Kota" value="<?php echo @$supplier['kota']; ?>" required>
  </div>
</div>

<div class="row form-group">
  <div class="col col-md-3">
    <label for="text-input" class=" form-control-label">Telepon</label>
  </div>
  <div class="col-5">
      <input type="tel" name="telepon" id="telepon" class="form-control" placeholder="Telepon" value="<?php echo @$supplier['telepon']; ?>" required>
  </div>
</div>

</div>

    </div>
