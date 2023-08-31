<div class="row">
  <!-- <div class="col-12"> -->
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <a href="" class="white-text mx-3">Daftar Pasien Sudah Bayar</a>
      </div>
      <div class="card-body">
        <div class="table-responsive" id="resep_sudah">
          <table id="example" class="table table-bordered table-striped hover-table">
            <thead>
              <tr><th></th>
                <th>No Resep</th>
                <th>No RM</th>
                <th>Nama Pasien</th>
                <th>Tujuan Pelayanan</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Status Billing</th>
                <th>Status Ambil</th>
                <th width="%5">opsi</th>
              </tr>
            </thead>
            <tbody id="resep">
              <?php $no = 1; foreach ($resep_sdh as $value):
                $tupel = $value->acc_ranap=='1'?'RANAP':$value->tujuan_pelayanan;
                ?>
                <td><?php echo $no; ?></td>
                <td><?php echo $value->no_resep; ?></td>
                <td><?php echo $value->noRM; ?></td>
                <td><?php echo $value->namapasien; ?></td>
                <td><?php echo $tupel?></td>
                <td><?php echo date("d-m-Y h:i:s",strtotime($value->tanggal))?></td>
                <td><?php echo $value->sumber_dana==7?
                "<h4><span class='badge badge-pill badge-success'>".$value->jenis_pasien."</h4>":"<h4><span class='badge badge-pill badge-danger'>".$value->jenis_pasien."</h4>"
                ?></td>

                <td>
                  <?php if ($tupel!="RANAP"): ?>

                    <?php if ($value->billing==1) {?>
                      <span class="badge badge-success">Sudah Dibayar</span>
                      <?php
                    }else{?><span class="badge badge-danger">Belum Dibayar</span>
                    <?php
                  }
                  ?>
                <?php endif; ?>
              </td>
              <td><?php if ($value->ambil==1) {?>
                <span class="badge badge-success">Sudah Diambil</span>
                <?php
              }else{?><span class="badge badge-secondary">Belum Diambil</span>
              <?php
            }
            ?></td>
            <td>
              <?php if ($value->status_resep==1) {?>

                <a href="<?php echo base_url()."Resep/detail/".$value->no_resep;?>" >
                  <button id="<?php echo $value->no_resep?>" type="button" class="detail_pembelian btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Resep Pasien">
                    Detail
                  </button>
                </a>

                <a href="<?php echo base_url()."Resep/print/".$value->no_resep;?>" target="_blank" >
                  <button id="<?php echo $value->no_resep?>" type="button" class="detail_pembelian btn btn-warning btn-sm"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Print Resep Pasien">
                    Print Resep
                  </button>
                </a>

                <?php
                if ($value->ambil!=1) {?>
                  <a href="<?php echo $value->billing==1 || $value->acc_ranap==1?base_url()."Resep/berikan/".$value->no_resep:"#";?>" >
                    <button id="<?php echo $value->no_resep?>" <?php echo $value->billing==1 || $value->acc_ranap==1?'':'disabled'?> type="button" class="detail_pembelian btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Berikan Resep Pasien">
                      Berikan Obat
                    </button>
                  </a>
                  <?php if ($value->billing!=1 || $value->acc_ranap==1): ?>

                    <button nama="<?php echo $value->namapasien?>" id="<?php echo $value->no_resep?>" data-toggle="modal" data-target="#smallmodal" type="button" class="edit_resep btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Resep Pasien">
                      Edit Resep
                    </button>

                  <?php endif; ?>
                  <?php
                }
                ?>
                <?php
              }else{?>

                <a href="<?php echo $value->billing==1 || $value->acc_ranap==1?base_url()."Resep/tebusan/".$value->no_resep:"#";?>" >
                  <button id="<?php echo $value->no_resep?>" <?php echo $value->billing==1 || $value->acc_ranap==1?'':'disabled'?> type="button" class="detail_pembelian btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Siapkan Resep Pasien">
                    Siapkan Obat
                  </button>
                </a>
                <a href="#" >
                  <button  data-toggle="modal" data-target="#smallmodal2" id="<?php echo $value->no_resep?>" type="button" class="lihat_detail btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lihat Detail Resep">
                    Detail
                  </button>
                </a>

                <?php
              }
              ?>
            </td>
          </tr>
          <?php $no++;  endforeach; ?>
        </tbody>
        </table>
        </div>
        </div>
        </div>
        </div>
