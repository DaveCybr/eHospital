<table id="TablePasien" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
              <th width="5%">#
              </th>
              <th>No.RM Pasien</th>
              <th>Kepala Keluarga</th>
              <th>Nama Pasien</th>
              <th>Status</th>
              <th>Alamat</th>
              <th>No.Telp</th>
              <th>Kunjungan Terakhir</th>
              <th>TDS</th>
              <th>TDD</th>
              <th>GDP</th>
                <!-- <th>Jabatan</th> -->
                <th width="%5">Kunjungan</th>
            </tr>
        </thead>
        <tbody>
          <?php
          $jml_dm = 0; $jml_ht=0; $jml_dmht=0;
           $no = 1; foreach ($keluarga->result() as $value):
            $id_check = $value->idpasien_binaan;
            $cek = $this->ModelKBinaan->getKunjungan($value->pasien_noRM, $tanggal);
            $riwayat = $this->ModelKBinaan->kunjunganAkhir($value->pasien_noRM)->row_array();?>
            <?php if ($cek->num_rows() > 0): ?>
              <tr>
                <td>
                  <?php echo $no ?>
                </td>
                <td><?php echo $value->pasien_noRM;
                if ($this->ModelKBinaan->get_riwayat_dm($value->pasien_noRM)->num_rows() > 0) {
                  echo "<br> <span class='badge bg-primary'>Pasien DM</span>";
                }
                if ($this->ModelKBinaan->get_riwayat_ht($value->pasien_noRM)->num_rows() > 0) {
                  echo "<span class='badge bg-secondary'>Pasien HT</span>";
                }?></td>
                <td>Kepala Keluarga : <?php echo $this->ModelKBinaan->getPasien($value->norm_kk)->row_array()["namapasien"]; ?></td>
                <td><?php echo $value->namapasien; ?></td>
                <td><?php
                if ($this->ModelKBinaan->get_riwayat_ht($value->pasien_noRM)->num_rows() > 0 && $this->ModelKBinaan->get_riwayat_dm($value->pasien_noRM)->num_rows() > 0) {
                  echo "<span class='badge bg-warning'>Pasien DM - HT</span>"; $jml_dmht++;
                }elseif ($this->ModelKBinaan->get_riwayat_ht($value->pasien_noRM)->num_rows() > 0) {
                  echo "<span class='badge bg-secondary'>Pasien HT</span>"; $jml_ht++;
                }elseif ($this->ModelKBinaan->get_riwayat_dm($value->pasien_noRM)->num_rows() > 0) {
                  echo "<span class='badge bg-primary'>Pasien DM</span>"; $jml_dm++;
                } ?></td>
                <td><?php echo $value->status_pasien; ?></td>
                <td><?php echo $value->alamat; ?></td>
                <td><?php echo $value->telepon; ?></td>
                <td><?php echo date("d-m-Y", strtotime($value->kunjungan_terakhir)); ?></td>
                <?php $cek = $this->ModelKBinaan->getKunjungan($value->pasien_noRM, $tanggal); ?>
                <td><?php echo $retVal = ($cek->num_rows() > 0) ? $riwayat['osiastole'] : "-" ; ?></td>
                <td><?php echo $retVal = ($cek->num_rows() > 0) ? $riwayat['odiastole'] : "-" ; ?></td>
                <td><?php echo $retVal = ($cek->num_rows() > 0) ? $riwayat['gl_puasa'] : "-" ; ?></td>
                  <td id="col<?php echo $id_check; ?>">
                    <?php if ($cek->row_array()['status_kunjungan'] == "1"): ?>
                        <button id="btnsudah<?php echo $id_check; ?>" type="button" class="btn btn-sm aqua-gradient">
                          <i class="fas fa-check"></i> Sudah Terkunjungi
                        </button>
                      <?php else: ?>
                        <button id="btnsudah<?php echo $id_check; ?>" type="button" class="btn btn-sm blue-gradient">
                          <i class="fas fa-check"></i> Berkunjung Mandiri
                        </button>
                    <?php endif; ?>
                  </td>
              </tr>
            <?php endif; ?>

          <?php $no++;  endforeach; ?>
        </tbody>
    </table>
    <br>
    <table class="table table-bordered table-hover table-striped">
      <tr>
        <th>Jumlah Pasien DM : <?php echo $jml_dm ?></th>
        <th>Jumlah Pasien HT : <?php echo $jml_ht ?></th>
        <th>Jumlah Pasien DM - HT : <?php echo $jml_dmht ?></th>
      </tr>
    </table>
