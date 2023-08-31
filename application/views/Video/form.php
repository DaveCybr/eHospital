<style>
.form-group{
  margin-bottom: 5px;
}
</style>
<div class="card">
<div class="card-body card-block">

  <div class="row form-group">
        <div class="col col-md-3">
          <label for="text-input" class=" form-control-label">Nama Video</label>
        </div>
        <div class="col-12 col-md-9">
            <input type="text" name="nama" id="nama_kamar" class="form-control" placeholder="" value="<?php echo @$tempat_tidur['nama_kamar']; ?>" required>
        </div>
  </div>
  <div class="row form-group">
        <div class="col col-md-3">
          <label for="text-input" class=" form-control-label">File Video</label>
        </div>
        <div class="col-12 col-md-9">
            <input type="file" accept=".mp4 .mkv .flv" name="file" id="kelas" class="form-control" placeholder="" value="<?php echo @$tempat_tidur['kelas']; ?>" required>
        </div>
  </div>



</div>
</div>
