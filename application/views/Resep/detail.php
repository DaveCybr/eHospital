<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header text-center">
        <h4>Permintaan Resep</h4>
      </div><br><br>
      <div class="col col-md-12" style="margin-left:20px;">
        <table>
        <tr><td><h5>Nama pasien</h5></td><td><h5>:</h5></td><td><h5><b> <?php echo $pasien['namapasien']?></b></h5></td>
        </tr>
        <tr><td><h5>Asal Poli</h5></td><td><h5>:</h5></td><td><h5><b><?php echo $pasien['tujuan_pelayanan']?></b></h5></td>
          <tr><td><h5>Keluhan</h5></td><td><h5>:</h5></td><td><h5><b><?php echo $pasien['keluhan']?></b></h5></td>
        <tr><td><h5>Jenis Pasien</h5></td><td><h5>:</h5></td><td><h5><b><?php echo $pasien['sumber_dana']==7?"<span class='badge badge-pill badge-success'>".$pasien['jenis_pasien']."</span>":"<span class='badge badge-pill badge-danger'>".$pasien['jenis_pasien']."</span>"?></b></h5></td>
      </tr>
      </table>
    </div>
      <div class="card-body">
        <div class="table-responsive">
          <h4>Obat Diresepkan</h4>
          <table  class="table color-table info-table tab ">
              <thead>
                  <tr><th></th>
                      <th>Kode Obat</th>
                      <th>Nama Obat</th>
                      <th>Jumlah</th>
                      <th>Signa</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($detail as $value):
                  ?>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $value->obat_idobat; ?></td>
                      <td><?php echo $value->nama_obat; ?></td>
                      <td><?php echo $value->jumlah; ?></td>
                      <td><?php echo $value->signa?></td>
                  </tr>
                <?php $no++;  endforeach; ?>
              </tbody>
            </table>
            <br><br>
            <h4>Obat Diberikan</h4>
            <table  class="table color-table danger-table tab ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Jumlah Resep</th>
                        <th>Jumlah Diberikan</th>
                        <th>Signa</th>
                        <th>No Batch</th>
                    </tr>
                </thead>
                <tbody id="pemberian_resep">
                  <?php $no = 1; foreach ($tebusan as $value):
                    ?>
                    <td><?php echo $no; ?></td>
                        <td><?php echo $value->idobat; ?></td>
                        <td><?php echo $value->nama_obat; ?></td>
                        <td><?php echo $value->jumlah_resep; ?></td>
                        <td><?php echo $value->jumlah_beri?></td>

                        <td><?php echo $value->signa?></td>

                        <td><?php echo $value->no_batch?></td>
                    </tr>
                  <?php $no++;  endforeach; ?>
                </tbody>
                </tbody>
              </table>
              <input type="hidden" name="kode_resep" value="<?php echo $this->uri->segment(3)?>"><br><br>
        </div>
      </div>
      <div class="card-footer" style='display: -ms-flexbox;
      display: flex;
      -ms-flex-wrap: wrap;
      /* flex-wrap: wrap; */'>
      <div class="col col-sm-10">
      <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.history.back()"><i class="fa fa-reply"></i> Kembali</button>
      </div>
        <div class="col col-sm-2">
          <!-- <button type=\"submit\" class=\"btn btn-primary btn-sm text-right\">SIMPAN</button> -->
        </div>
      </div></div>

  </div>

</div>
