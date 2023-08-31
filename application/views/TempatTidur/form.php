<style>
.form-group{
  margin-bottom: 5px;
}
</style>
<div class="card">
<div class="card-body card-block">

<div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Nama Kamar</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="text" name="nama_kamar" id="nama_kamar" class="form-control" placeholder="" value="<?php echo @$tempat_tidur['nama_kamar']; ?>" required>
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Kelas</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="kelas" id="kelas" class="form-control" placeholder="" value="<?php echo @$tempat_tidur['kelas']; ?>" required>
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Tarif</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="tarif" id="tarif" class="form-control" placeholder="" value="<?php echo @$tempat_tidur['tarif']; ?>" required>
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Biaya Makan Pasien</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="biaya_makan" id="biaya_makan" class="form-control" placeholder="" value="<?php echo @$tempat_tidur['biaya_makan']; ?>" required>
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Biaya Makan Penunggu</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="biaya_makan_penunggu" id="biaya_makan_penunggu" class="form-control" placeholder="" value="<?php echo @$tempat_tidur['biaya_makan_penunggu']; ?>" required>
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Biaya Air</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="biaya_air" id="biaya_air" class="form-control" placeholder="" value="<?php echo @$tempat_tidur['biaya_air']; ?>" >
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Biaya Listrik</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="biaya_listrik" id="biaya_listrik" class="form-control" placeholder="" value="<?php echo @$tempat_tidur['biaya_listrik']; ?>">
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Biaya Kebersihan</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="numbert" name="biaya_kebersihan" id="biaya_kebersihan" class="form-control" placeholder="" value="<?php echo @$tempat_tidur['biaya_kebersihan']; ?>" >
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Biaya Laundry</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="biaya_laundry" id="biaya_laundry" class="form-control" placeholder="" value="<?php echo @$tempat_tidur['biaya_laundry']; ?>" >
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Biaya Perawatan</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="biaya_perawatan" id="biaya_perawatan" class="form-control" placeholder="" value="<?php echo @$tempat_tidur['biaya_perawatan']; ?>" >
      </div>
</div>

<div class="row form-group">
      <div class="col col-md-3">
        <label for="status_terisi" class=" form-control-label">Status Terisi</label>
      </div>
      <div class="col-12 col-md-9">
        <!-- <select name="status_terisi" id="select" class="form-control" required>
          <option>...Pilih...</option>
          <option value="1" <?php if (@$tempat_tidur['status_terisi'] == 1) {echo "selected";} ?> >Ada</option>
          <option value="0" <?php if (@$tempat_tidur['status_terisi'] == 0) {echo "selected";} ?>>Kosong</option>
        </select> -->


        <div class="custom-control custom-radio">
          <input type="radio" id="l" name="status_terisi" value="1" class="custom-control-input" <?php if (@$tempat_tidur['status_terisi']=='1') {
            echo "checked";
    }?> required>

          <label class="custom-control-label" for="l">Ada</label>
        </div>
        <div class="custom-control custom-radio">

              <input type="radio" id="p" name="status_terisi" value="0" class="custom-control-input" <?php if (@$tempat_tidur['status_terisi']=='0') {
                echo "checked";
              }?> required>

          <label class="custom-control-label" for="p">Kosong</label>
        </div>
      </div>
</div>


</div>
</div>
