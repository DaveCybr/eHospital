<table id="myTable" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
              <th width="10%" rowspan="2">#</th>
              <th rowspan="2">NIK</th>
              <th rowspan="2">Nama</th>
              <th colspan="3" class="text-center">Capaian Keluarga Binaan</th>
              <th width="%5" rowspan="2">List Keluarga Binaan</th>
            </tr>
            <tr>
              <th>Target</th>
              <th>Sudah</th>
              <th>Belum</th>
            </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($perawat as $data_pegawai):
            $id_check = $data_pegawai->idkb_perawat;
            $Semua_pasien = $this->ModelKBinaan->getKeluarga(null, $data_pegawai->idkb_perawat)->num_rows();
            $PasienSudah = $this->ModelKBinaan->getAllKunjungan($tanggal,$data_pegawai->NIK)->num_rows();
            ?>
            <tr>
              <td>
                <!-- <input type="checkbox" class="form-check-input id_checkbox" id="tableMaterialCheck<?php echo $id_check ?>" name="id[]" value="<?php echo $id_check ?>">
                <label class="form-check-label" for="tableMaterialCheck<?php echo $id_check ?>"></label> -->
                <?php echo $no ?>
              </td>
              <td><?php echo $data_pegawai->NIK; ?></td>
                <td><?php echo $data_pegawai->nama; ?></td>
                <td><?php echo $Semua_pasien; ?></td>
                <td><?php echo $PasienSudah; ?></td>
                <td><?php echo $Semua_pasien - $PasienSudah; ?></td>
                <td>
                  <a href="<?php echo base_url().'K_Binaan/KBPasien/getKeluarga/'.$id_check; ?>">
                  <button type="button" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Keluarga Binaan">
                    <i class="fas fa-user-friends"></i>
                  </button>
                  </a>
                </td>
            </tr>
          <?php $no++;  endforeach; ?>
        </tbody>
    </table>
