<?php echo form_open(base_url()."Deposit/bayar") ?>
<div class="row form-group">
  <div class="col col-md-4">
      <label for="noBPJS" class=" form-control-label">Nomor Kunjungan</label>
  </div>
  <div class="col-8 col-md-8">
    <input type="text" name="nokun" id="nokun" value="" class="form-control" readonly>
  </div>
</div>
<div class="row form-group">
  <div class="col col-md-4">
      <label for="noBPJS" class="form-control-label">Nomor Rekam Medis</label>
  </div>
  <div class="col-8 col-md-8">
    <input type="text" name="no_rmr" value="" class="form-control" readonly id="no_rm">
  </div>
</div>
<div class="row form-group">
  <div class="col col-md-4">
      <label for="noBPJS" class=" form-control-label">Nama Pasien</label>
  </div>
  <div class="col-8 col-md-8">
    <input type="text" name="namapasien" value="" class="form-control" readonly id="namapasien">
  </div>
</div>
<div class="row form-group">
  <div class="col col-md-4">
      <label for="noBPJS" class=" form-control-label">Jumlah Bayar</label>
  </div>
  <div class="col-8 col-md-8">
    <input type="text" name="jumlah_bayar" value="200000" class="money form-control" value="">
  </div>
</div>

<div class="row form-group">
  <div class="col col-md-4">
      <!-- <label for="noBPJS" class=" form-control-label">Jumlah Bayar</label> -->
  </div>
  <div class="col-8 col-md-8">
    <button type="submit" class="btn btn-sm btn-success">Bayar</button>
  </div>
</div>

<!-- <input type="hidden" id="nokun" value="" name="nokun">
<input type="hidden" id="no_rm" value="" name="no_rm"> -->
<?php echo form_close()?>
