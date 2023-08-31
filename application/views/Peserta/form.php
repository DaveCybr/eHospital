
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="nama_jumlah_peserta" class=" form-control-label">Per tanggal</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="date" name="tanggal"  class="form-control" placeholder="" value="<?php echo @$jumlah_peserta['tanggal']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="nama_jumlah_peserta" class=" form-control-label">Jumlah peserta</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="jumlah" class="form-control" placeholder="" value="<?php echo @$jumlah_peserta['jumlah']; ?>" required>
            </div>
    </div>
  </div>

</div>
