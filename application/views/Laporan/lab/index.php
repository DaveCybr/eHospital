
<?php echo form_open('Laporan/cetak_rekap_lab');?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <h4><a href="" class="white-text mx-3">Laporan Rekapitulasi Kunjungan Laborat Per Poli</a></h4>
      </div>
      <div class="card-body">
        <div class="row p-t-20">
          <div class="col-md-4">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Dari Tanggal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                <input type="date" name="tgl_mulai" id="tgl" value="<?php echo date("Y-m-d")?>" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Sampai Tanggal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <input type="date" name="tgl_sampai" id="tgl" value="<?php echo date("Y-m-d")?>" class="form-control" required>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Tombol Cetak</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-instagram"></i></span> -->
                </div>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row col-md-12">
          <h2>Laporan Rekapitulasi Kunjungan Laborat Per Poli</h2>
          <div class="table-responsive">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo form_close();?>


<?php echo form_open('Laporan/cetak_kunjungan_laborat_detail');?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <h4><a href="" class="white-text mx-3">Laporan Rekapitulasi Kunjungan Laborat Detail Pasien</a></h4>
      </div>
      <div class="card-body">
        <div class="row p-t-20">
          <div class="col-md-4">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Dari Tanggal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                <input type="date" name="tgl_mulai" id="tgl" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Sampai Tanggal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <input type="date" name="tgl_sampai" id="tgl" class="form-control" required>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Tombol Cetak</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-instagram"></i></span> -->
                </div>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan</button>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <h5>Pilih Unit :</h5>
            <div class="custom-control custom-checkbox col-md-12 row ">
              <div class="col-md-12 row">
                <div class="col-sm-2 custom-control custom-checkbox">
                  <input checked type="checkbox" id="umum" name="poli[]" value="UMU" class="custom-control-input">
                  <label class="custom-control-label" for="umum">POLI UMUM</label>
                </div>
                <div class="col-sm-2 custom-control custom-checkbox">
                  <input checked type="checkbox" id="gigi" name="poli[]" value="GIG" class="custom-control-input">
                  <label class="custom-control-label" for="gigi">POLI GIGI</label>
                </div>
                <div class="col-sm-2 custom-control custom-checkbox">
                  <input checked type="checkbox" id="obgyn" name="poli[]" value="OBG" class="custom-control-input">
                  <label class="custom-control-label" for="obgyn">POLI OBGYN</label>
                </div>
                <div class="col-sm-2 custom-control custom-checkbox">
                  <input checked type="checkbox" id="igd" name="poli[]" value="IGD" class="custom-control-input">
                  <label class="custom-control-label" for="igd">POLI IGD</label>
                </div>
                <div class="col-sm-2 custom-control custom-checkbox">
                  <input checked type="checkbox" id="ozon" name="poli[]" value="OZO" class="custom-control-input">
                  <label class="custom-control-label" for="ozon">POLI OZON</label>
                </div>
                <div class="col-sm-2 custom-control custom-checkbox">
                  <input checked type="checkbox" id="internis" name="poli[]" value="INT" class="custom-control-input">
                  <label class="custom-control-label" for="internis">POLI INTERNIS</label>
                </div>

                <div class="col-sm-2 custom-control custom-checkbox">
                  <input checked type="checkbox" id="ranap" name="poli[]" value="RANAP" class="custom-control-input">
                  <label class="custom-control-label" for="ranap">RAWAT INAP</label>
                </div>
              </div>
              <br>
            </div>
          </div>
        </div>
        <div class="row col-md-12">
          <h2>Laporan Rekapitulasi Kunjungan Laborat Detail Pasien Per Unit</h2>
          <div class="table-responsive">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo form_close();?>
