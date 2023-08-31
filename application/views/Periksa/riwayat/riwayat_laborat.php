<div class="col-md-12 col-12 col-xl-12">
  <!-- Card Narrower -->
  <div class="card card-cascade narrower z-depth-1">
    <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
          <h4><a href="" class="white-text mx-3">Riwayat Laborat</a></h4>

    </div>

    <!-- Card content -->
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" >
          <thead>
          <th>Kode Lab</th>
          <th>Jenis Lab</th>
          <th>Nilai Normal</th>
          <th>Hasil</th>
        </thead>
        <tbody id="diagnosa">
          <?php
                // $rl = $this->ModelPeriksa->get_riwayat_lab(@$kunjungan['pasien_noRM']);
                $kunjungan = $this->db
                ->limit(5)
                ->order_by("tgl","DESC")
                ->group_by("idperiksa")
                ->join("labkunjungan","labkunjungan.periksa_idperiksa=periksa.idperiksa")
                ->join("kunjungan","periksa.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan")
                ->get_where("periksa",array("pasien_noRM"=>@$kunjungan['pasien_noRM']))->result();
          ?>
          <?php if (!empty($kunjungan)): ?>
            <?php foreach ($kunjungan as $value): ?>
                <tr>
                    <td colspan="4"><?php echo date("d-m-Y",strtotime($value->jam)) ?></td>

                </tr>
                    <?php
                         $rl = $this->ModelPeriksa->get_riwayat_lab(@$value->idperiksa);
                    foreach ($rl as $data): ?>
                      <tr>
                        <td><?php echo $data->kodelab ?></td>
                        <td><?php echo $data->nama?></td>
                        <td><?php echo $data->hasil?></td>
                        <td><?php echo $data->nilainormal?></td>

                      </tr>
                    <?php endforeach; ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
      </div>



      </div>

    </div>
    <!-- Card Narrower -->

  </div>
