<style>
.form-group{
  margin-bottom: 5px;
}
</style>
<div class="card">
  <div class="card-body card-block">

    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Nama Ruangan</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="nama" class="form-control" placeholder="nama ruangan" value="<?php echo @$ruangan['namaruangan']; ?>" required>
            </div>
    </div>


  </div>
</div>
