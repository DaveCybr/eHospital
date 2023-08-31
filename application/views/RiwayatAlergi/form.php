<style>
.form-group{
  margin-bottom: 5px;
}
</style>
<div class="row">
<input type="hidden" name="idkunjungan" value="<?php echo $kunjungan ?>">
  <div class="col-md-4">
    <label for="norm">NO Rekamedik</label>
    <input type="text" class="form-control" name="pasien_noRM" id="norm" value="<?php echo $pasien['noRM'] ?>" readonly>
  </div>
  <div class="col-md-4">
    <label for="norm">Nama Pasien</label>
    <input type="text" class="form-control" id="norm" value="<?php echo $pasien['namapasien'] ?>" readonly>
  </div>
  <div class="col-md-4">
    <label for="norm">Tanggal Lahir</label>
    <input type="text" class="form-control" id="norm" value="<?php echo date('d-m-Y',strtotime($pasien['tgl_lahir'])) ?>" readonly>
  </div>
</div><br>
<div class="row form-group">
  <div class="col col-md-3">
    <label for="alergi_reaksi" class=" form-control-label">Alergi Reaksi</label>
  </div>
  <div class="col-12 col-md-9">
    <input type="text" name="alergi_reaksi" id="alergi_reaksi" class="form-control" placeholder="Alergi Reaksi" value="<?php echo @$riwayatalergi['alergi_reaksi']; ?>" required>
  </div>
</div>

<div class="row form-group">
  <div class="col col-md-3">
    <label for="konsumsi" class=" form-control-label">Makanan / Minuman / Obat yang dikonsumsi</label>
  </div>
  <div class="col-12 col-md-9">
    <input type="text" name="konsumsi" id="konsumsi" class="form-control" placeholder="Yang Di Konsumsi" value="<?php echo @$riwayatalergi['konsumsi']; ?>" required>
  </div>
</div>

<div class="row form-group">
  <div class="col col-md-3">
    <label for="jenis_penyakit" class=" form-control-label">Jenis Penyakit</label>
  </div>
  <div class="col-12 col-md-9">
    <input type="text" name="jenis_penyakit" id="jenis_penyakit" class="form-control" placeholder="Jenis Penyakit" value="<?php echo @$riwayatalergi['jenis_penyakit']; ?>" required>
  </div>
</div>

<div class="row form-group">
  <div class="col col-md-3">
    <label for="tgl_alergi" class=" form-control-label">Tanggal</label>
  </div>
  <div class="col-12 col-md-9">
    <input type="date" name="tgl_alergi" id="tgl_alergi" class="form-control" placeholder="Tanggal" value="<?php echo @$riwayatalergi['tgl_alergi']; ?>" required>
  </div>
</div>

</div>

    </div>
