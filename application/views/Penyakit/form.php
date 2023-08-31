<style>
.form-group{
  margin-bottom: 5px;
}
</style>
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jenis_pasien" class=" form-control-label">Kode ICDX</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="kodeicdx" id="kodeicdx" class="form-control" placeholder="kode icdx" value="<?php echo @$penyakit['kodeicdx']; ?>" required>
            </div>
    </div>

    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jenis_pasien" class=" form-control-label">Nama Penyakit</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="nama_penyakit" id="nama_penyakit" class="form-control" placeholder="nama penyakit" value="<?php echo @$penyakit['nama_penyakit']; ?>" required>
            </div>
    </div>

    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jenis_pasien" class=" form-control-label">Wabah</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="wabah" id="wabah" class="form-control" placeholder="wabah" value="<?php echo @$penyakit['wabah']; ?>" required>
            </div>
    </div>

    <div class="row form-group">
            <div class="col col-md-3">
              <label for="nular" class=" form-control-label">Menular</label>
            </div>
            <div class="col-12 col-md-9">
              <div class="custom-control custom-radio">
                <input type="radio" id="ya" name="nular" value="1" class="custom-control-input" <?php if (@$penyakit['nular']=='1') {
                  echo "checked";
          }?> required>

                <label class="custom-control-label" for="ya">Ya</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="tidak" name="nular" value="0" class="custom-control-input" <?php if (@$penyakit['nular']=='0') {
                  echo "checked";
          }?> required>

                <label class="custom-control-label" for="tidak">Tidak</label>
              </div>

            </div>
    </div>

    <div class="row form-group">
            <div class="col col-md-3">
              <label for="bpjs" class=" form-control-label">BPJS</label>
            </div>
            <div class="col-12 col-md-9">
              <div class="custom-control custom-radio">
                <input type="radio" id="bpjsya" name="bpjs" value="1" class="custom-control-input" <?php if (@$penyakit['bpjs']=='1') {
                  echo "checked";
          }?> required>

                <label class="custom-control-label" for="bpjsya">Ya</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="bpjsno" name="bpjs" value="0" class="custom-control-input" <?php if (@$penyakit['bpjs']=='0') {
                  echo "checked";
                }?> required>

                <label class="custom-control-label" for="bpjsno">Tidak</label>
              </div>

            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="non_spesialis" class=" form-control-label">Non Spesialis</label>
            </div>
            <div class="col-12 col-md-9">
              <div class="custom-control custom-radio">
                <input type="radio" id="non_spesialisya" name="non_spesialis" value="1" class="custom-control-input" <?php if (@$penyakit['non_spesialis']=='1') {
                  echo "checked";
          }?> required>

                <label class="custom-control-label" for="non_spesialisya">Ya</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="non_spesialisno" name="non_spesialis" value="0" class="custom-control-input" <?php if (@$penyakit['non_spesialis']=='0') {
                  echo "checked";
                }?> required>

                <label class="custom-control-label" for="non_spesialisno">Tidak</label>
              </div>

            </div>
    </div>
  </div>
</div>
