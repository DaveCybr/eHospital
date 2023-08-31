
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">No rek</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="norek" id="kategori_obat" class="form-control" placeholder="no rek" value="<?php echo @$kelompok['norek']; ?>" <?php if($this->uri->segment(2)=='edit'){ echo "disabled";}?> required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Kelompok</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="nama_kel" id="kategori_obat" class="form-control" placeholder="kelompok" value="<?php echo @$kelompok['namakel']; ?>" required>
            </div>
    </div>
  </div>
</div>
