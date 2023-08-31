
<?php echo form_open('Laporan/cetak_pemakaian_obat');?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <h4><a href="" class="white-text mx-3">Laporan Pengeluaran Obat Harian</a></h4>
      </div>
      <div class="card-body">
        <div class="row p-t-20">
          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Tanggal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                <input type="date" name="tgl_mulai" id="tgl" class="form-control" value="<?php echo date("Y-m-d")?>" required>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group animated flipIn">

                <select name="unit" class="mdb-select colorful-select dropdown-info md-form">
                  <option value="" disabled selected>Pilih Unit</option>
                  <option value="">Semua</option>
                  <option value="APOTEK">Apotek</option>
                  <option value="UGD">Ugd</option>

                </select>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <!-- <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan</button> -->

            </div>
          </div>
          <div class="col-md-3">
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
          <h2 >Laporan Pengeluaran Obat Harian</h2>
          <div class="table-responsive">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo form_close();?>
