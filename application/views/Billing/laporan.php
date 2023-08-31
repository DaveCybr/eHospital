
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header text-center">
        <h4>LAPORAN BILLING PASIEN</h4>
      </div>
      <br>
      <div class="row form-group">
                <div class="col col-md-2 text-right">
                  <label for="tb" class="form-control-label">Filter Tanggal</label>
                </div>
                <div class="col-12 col-md-8 ">
                  <div class="input-daterange input-group" id="date-range">
                                              <input type="date" class="form-control" name="start">
                                              <div class="input-group-append">
                                                  <span class="input-group-text bg-info b-0 text-white">S/D</span>
                                              </div>
                                              <input type="date" class="form-control" name="end">
                                              <div class="input-group-prepend">
                                                  <button type="button" onclick="filter_kunjungan()" class="btn btn-success"> <i class="fa fa-search"></i> Filter</button>
                                              </div>
                                          </div>

                </div>
        </div>
      <div class="card-body">
        <div class="table-responsive" id="kunjungan_sudah">
          <table id="example" class="table color-table success-table hover-table">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>No Antrian</th>
                          <th>NO RM</th>
                          <th>Nama Pasien</th>
                          <th>Tujuan Pelayanan</th>
                          <th>Biaya</th>
                          <th>Tanggal</th>
                          <th>Jam Kunjungan - Pulang</th>
                          <th>Opsi</th>
                      </tr>
                  </thead>
                  <tbody>

                    <?php $no=1;foreach ($kunjungan as $value): ?>
                      <?php $id = $value->no_urutkunjungan;?>
                      <tr>
                        <td><?php echo $no;?></td>
                        <td class="text-right"><?php echo $value->no_antrian;?></td>
                        <td><?php echo $value->pasien_noRM ?></td>
                        <td><?php echo $value->namapasien ?></td>
                        <td><?php echo $value->tujuan_pelayanan;?></td>
                        <td><?php echo "Rp. ".number_format($value->bayar,2,",",".");?></td>
                        <td><?php echo $value->tgl;?></td>
                        <td><?php echo $value->jam_daftar?></td>
                        <td>
                          <button type="button" class="btn btn-primary" name="button"> <i class="fa fa-book"></i> </button>
                        </td>
                      </tr>
                    <?php $no++; endforeach; ?>


                  </tbody>

              </table>

        </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- <div class="loader" id="loader">
    <div class="loader__figure"></div>
    <p class="loader__label">Utama Husada</p>
</div> -->
<!-- <div id="kunjungan_belum">
asdaskdjaskdhakjshdkjah
</div> -->
<?php echo $this->Core->Fungsi_JS_Hapus(); ?>
