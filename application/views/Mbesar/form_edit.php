<style>
.form-group{
  margin-bottom: 5px;
}
</style>
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">No rekening</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="norek" id="kategori_obat" class="form-control" placeholder="no rek" value="<?php echo @$mbesar['norek_mbesar']; ?>" <?php if($this->uri->segment(2)=='edit'){ echo "disabled";}?> required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Nama Rekening</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="nama_rek" id="kategori_obat" class="form-control" placeholder="nama rekening" value="<?php echo @$mbesar['namarek']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Posisi Rugi Laba/Neraca</label>
            </div>
            <div class="col-12 col-md-9">
              <div class="custom-control custom-radio">
                <input type="radio" id="l" name="rugi_laba" value="1" <?php echo $mbesar['posisi']==1?'checked':''?> class="custom-control-input" required>

                <label class="custom-control-label" for="l">Rugi/Laba</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="l2" name="rugi_laba" value="2" <?php echo $mbesar['posisi']==2?'checked':''?> class="custom-control-input" required>

                <label class="custom-control-label" for="l2">Neraca</label>
              </div>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kategori_obat" class=" form-control-label">Posisi Neraca</label>
            </div>
            <div class="col-12 col-md-9">
              <div class="custom-control custom-radio">
                <input type="radio" id="pn1" name="pos" value="1" <?php echo $mbesar['posneraca']==1?'checked':''?> class="custom-control-input" required>

                <label class="custom-control-label" for="pn1">Aktiva Lancar</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="pn2" name="pos" value="2" <?php echo $mbesar['posneraca']==2?'checked':''?> class="custom-control-input" required>

                <label class="custom-control-label" for="pn2">Aktiva Tetap</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="pn3" name="pos" value="3" <?php echo $mbesar['posneraca']==3?'checked':''?> class="custom-control-input" required>

                <label class="custom-control-label" for="pn3">Pasiva (Hutang)</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="pn4" name="pos" value="4" <?php echo $mbesar['posneraca']==4?'checked':''?> class="custom-control-input" required>

                <label class="custom-control-label" for="pn4">Pasiva (Modal)</label>
              </div>


            </div>
    </div>

  </div>
</div>
