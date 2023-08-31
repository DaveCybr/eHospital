<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <a href="" class="white-text mx-3">Daftar Pasien Sudah Di Periksa</a>

      </div>
      <div class="card-body">

        <div class="table-responsive" id="kunjungan_sudah">
          <table id="example" class="table table-bordered table-striped hover-table">
            <thead>
              <tr>
                <th>#</th>

                <th>No Antrian</th>

                <th>Poli Periksa</th>
              <th>Antrian Pcare</th>
                <th>Nama Pasien</th>

                <th>Keluhan</th>
                <th>BPJS</th>
                <th>No Telepon</th>
                <th>No Asuransi lain</th>
                <th>Tujuan Pelayanan</th>
                <th>Jam</th>
                <th>Jenis</th>
                <th class="periksa">Opsi</th>
              </tr>
            </thead>
            <tbody>

              <?php

              // die(var_dump($kunjungan_sudah));
               $no=1;foreach ($kunjungan_sudah as $value): ?>
                <?php $id_check = $value->no_urutkunjungan;?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $value->sumber_dana==7?$value->kd_antrian_bpjs."".$value->no_antrian:$value->kd_antrian."".$value->no_antrian;?></td>
                  <td><?php if ($value->poli_panggil=="GIG") {
                    echo "Poli Gigi";
                  }elseif($value->poli_panggil=="UMU2"){
                    echo "Poli Umum 2";
                  }else{
                    echo "Poli Umum 1";
                  }?></td>

                  <td><?php echo $value->nourut_pcare;?></td>
                  <!-- <td><?php echo $value->pasien_noRM ?></td> -->
                  <td><?php echo $value->namapasien ?></td>
                  <td><?php echo $value->keluhan ?></td>
                  <td><?php echo $value->noBPJS ?></td>
                  <td><?php echo $value->telepon?></td>
                  <td><?php echo $value->noAsuransiLain ?></td>
                  <td><?php $k = $value->kode_tupel;
                  $type = "IN";
                  $warna = "badge-primary";
                  if ($k == "UMU"){$warna = "badge-success"; $type="U";}elseif ($k == "IGD") {$warna = "badge-danger";$type="IG";}elseif($k == "OBG"){$warna = "badge-info";$type="O";}
                  elseif ($k == "GIG") {$warna = "badge-warning";$type="G";}elseif ($k == "OZO") {$warna = "badge-info";$type="OZ";} ?>
                  <h4><span class="badge badge-pill <?php echo $warna; ?>"><?php echo $value->tujuan_pelayanan;?></span></h4></td>
                  <td><?php echo date("H:i:s",strtotime($value->jam_daftar)); ?></td>
                  <td><?php echo $value->sumber_dana==7?"<h4><span class='badge badge-pill badge-success'>".$value->jenis_pasien."</h4>":"<h4><span class='badge badge-pill badge-danger'>".$value->jenis_pasien."</h4>"?></td>
                  <td class="periksa">
                    <a href="<?php echo base_url()."Periksa/index/".$value->no_urutkunjungan; ?>">
                      <button type="button" class="btn btn-sm btn-primary periksa" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Periksa">
                        <i class="fa fa-stethoscope"></i>
                      </button>
                    </a>
                    <?php $rows = $this->db->get_where('rujukan_internal',array('kunjungan_no_urutkunjungan'=>$value->no_urutkunjungan))->num_rows()?>
                    <?php if ($value->billing != 1 && $rows==0): ?>
                      <?php if ($value->siap_pulang !=0): ?>
                        <!-- <a href="<?php echo base_url()."Periksa/batal_pulang/".$value->no_urutkunjungan; ?>">
                          <button data-toggle="tooltip" data-placement="top" title="" data-original-title="Batal Pulang" type="button" class="btn btn-sm btn-warning periksa">
                            <i class="fa fa-home"></i>
                          </button>
                        </a> -->
                      <?php else: ?>
                        <!-- <a href="<?php echo base_url()."Periksa/pulang/".$value->no_urutkunjungan; ?>">
                          <button data-toggle="tooltip" data-placement="top" title="" data-original-title="Pulang" type="button" class="btn btn-sm btn-success periksa">
                            <i class="fa fa-home"></i>
                          </button>
                        </a> -->
                      <?php endif; ?>
                    <?php endif; ?>
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
