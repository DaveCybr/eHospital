
<table id="TablePasien" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
              <th width="5%">#
              </th>
                <th>No.RM</th>
                <th>Kepala Keluarga</th>
                <th>Nama Pasien</th>
                <th>Jenis Penyakit</th>
                <th>Status</th>
                <th>Alamat</th>
                <th>No.Telp</th>
                <th>Kunjungan Terakhir</th>
                <th>TDS</th>
                <th>TDD</th>
                <th>GDP</th>
                <!-- <th>Jabatan</th> -->
                <th width="%3">Kunjungan</th>
                <th width="%3">Opsi</th>
            </tr>
        </thead>
        <tbody>
          <?php
            $jml_dm = 0; $jml_ht=0; $jml_dmht=0;
            $no = 1; foreach ($keluarga->result() as $value):
            $id_check = $value->idpasien_binaan;
            $riwayat = $this->ModelKBinaan->kunjunganAkhir($value->pasien_noRM)->row_array();?>
            <tr>
              <td>
                <?php echo $no ?>
              </td>
              <td><?php echo $value->pasien_noRM;?></td>
              <td><a href="<?php echo base_url('K_Binaan/KBPasien/editKeluarga/').$value->kb_perawat_idkb_perawat.'/'.$value->norm_kk ?>" ><button type="button" class="btn btn-rounded btn-sm btn-warning waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><i class="fas fa-pencil-alt mt-0"></i></button></a>
                Kepala Keluarga : <?php echo $this->ModelKBinaan->getPasien($value->norm_kk)->row_array()["namapasien"]; ?></td>
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
                  <?php
                  if ($cek->num_rows() > 0): ?>
                    <?php if ($cek->row_array()['status_kunjungan'] == "1"): ?>
                        <button id="btnsudah<?php echo $id_check; ?>" type="button" class="btn btn-sm aqua-gradient">
                          <i class="fas fa-check"></i> Sudah Terkunjungi
                        </button>
                      <?php else: ?>
                        <button id="btnsudah<?php echo $id_check; ?>" type="button" class="btn btn-sm blue-gradient">
                          <i class="fas fa-check"></i> Berkunjung Mandiri
                        </button>
                    <?php endif; ?>
                    <?php $cekPeriksa = $this->ModelKBinaan->getPeriksa($value->pasien_noRM, $cek->row_array()['tanggal'])->row_array(); ?>
                    <?php if ($cekPeriksa["sudah"] != 0): ?>
                        <span class='badge bg-success'>Sudah Diperiksa</span>
                      <?php else: ?>
                        <span class='badge bg-warning'>Belum Diperiksa</span>
                    <?php endif; ?>
                  <?php else: ?>
                    <!-- <button id="btnblm<?php echo $id_check; ?>" onclick="kunjungan('<?php echo $id_check; ?>','<?php echo @$perawat['NIK']; ?>')" type="button" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="right" title="Kunjungi" data-original-title="Kunjungi" >
                      <i class="far fa-circle"></i> Belum Terkunjungi
                    </button> -->
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg" data-whatever="@mdo" onclick="select_rm('<?php echo $value->pasien_noRM; ?>')">
                      <i class="far fa-circle"></i> Belum Terkunjungi
                    </button>

                  <?php endif; ?>
                </td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn blue-gradient btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Menu
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ModalDiagnosa" data-whatever="@mdo" onclick="filterDiagnosa('<?php echo $value->pasien_noRM ?>')" >Riwayat Diagnosa</a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ModalDiagnosa" data-whatever="@mdo" onclick="filterKunjungan('<?php echo $value->pasien_noRM ?>')" >Riwayat Kunjungan</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?php echo base_url().'K_Binaan/KBPasien/HapusPasien/'.$id_check.'/'.$this->uri->segment(4); ?>">Hapus Pasien</a>
                    </div>
                  </div>
                  <!-- <a href="<?php echo base_url().'K_Binaan/KBPasien/HapusPasien/'.$id_check.'/'.$this->uri->segment(4); ?>">
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit">
                      <i class="fa fa-trash"></i>
                    </button>
                  </a> -->
                </td>
            </tr>
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
