<?php echo form_open('');?>
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <h4><a href="" class="white-text mx-3">Kunjungan Laborat</a></h4>
      </div>

      <div class="card-body">
        <div class="row form-group">
                <div class="col col-md-2 text-right">
                  <label for="tb" class="form-control-label">Filter Tanggal</label>
                </div>
                <div class="col-12 col-md-4 input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="icon-calender"></i></span>
                    </div>
                    <input type="date" name="tb" id="tanggal" class="form-control" placeholder="tinggi badan" value="<?php echo date('Y-m-d'); ?>" required>
                    <div class="input-group-prepend">
                        <button type="button" onclick="filter_kunjungan()" class="btn btn-info"> <i class="fa fa-search"></i> Filter</button>
                    </div>
                </div>
        </div>
        <div class="table-responsive" id="kunjungan_lab">
          <table id="example_lab" class="table table-bordered table-striped table-striped hover-table">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>NO RM</th>
                          <th>Nama Pasien</th>
                          <th>Asal Pelayanan</th>
                          <th>Jam Permintaan</th>
                          <th>Hasil</th>
                          <th>Status Billing</th>
                          <th>Opsi</th>
                      </tr>
                  </thead>
                  <tbody id="lab">

                    <?php $no=1;foreach ($permintaan as $value): ?>
                      <?php $id_check = $value->no_urutkunjungan;
                      $k = $value->kode_tupel;
                      $warna = "badge-primary";
                      if ($k == "UMU"){$warna = "badge-success";}elseif($k == "IGD"){$warna = "badge-danger";}elseif($k == "OBG"){$warna = "badge-info";}elseif ($k == "GIG") {$warna = "badge-warning";}

                      ?>
                      <tr>
                        <td><?php echo $no;?></td>
                        <td><?php echo $value->pasien_noRM ?></td>
                        <td><?php echo $value->namapasien ?></td>
                        <td><h4><span class="badge badge-pill <?php echo $warna?>"><?php echo $value->tujuan_pelayanan;?></span></h4></td>
                        <td><?php echo date("H:i:s",strtotime($value->jam))?></td>
                        <td><?php if ($value->status==1) {?>
                          <span class="badge badge-pill badge-danger">Belum Input</span>
                        <?php
                      }else{?>
                          <span class="badge badge-pill badge-success">Sudah Input</span>
                        <?php
                        }?></td>
                        <td>
                          <?php
                            if ($value->billing!=1) {?>
                                <span class="badge badge-pill badge-danger">Belum Billing</span>
                              <?php
                            }else{?>
                              <span class="badge badge-pill badge-success">Sudah Billing</span>

                            <?php
                            }?>
                        </td>
                        <td>
                          <?php
                            if ($value->billing!=1) {?>
                              <?php
                                if ($value->status==1) {?>
                                  <a href="<?php echo base_url()."KunjunganLab/periksa/".$value->no_urutkunjungan."/".$value->nokunjlab; ?>">
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Analisa">
                                      <i class="fa fa-flask"></i> Analisa
                                    </button>
                                  </a>

                                                                  <a href="<?php echo base_url()."KunjunganLab/hapus_kunjungan/".$value->nokunjlab; ?>">
                                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus">
                                                                      <i class="fa fa-trash"></i>
                                                                    </button>
                                                                  </a>
                                <?php
                              }else{?>
                                <a href="<?php echo base_url()."KunjunganLab/edit/".$value->no_urutkunjungan."/".$value->nokunjlab; ?>">
                                  <button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Analisa">
                                    <i class="fa fa-edit"></i> Edit
                                  </button>
                                </a>

                              <?php
                              }
                              ?>
                          <?php
                        }else{
                          if ($value->status==1) {?>
                            <a href="<?php echo base_url()."KunjunganLab/periksa/".$value->no_urutkunjungan."/".$value->nokunjlab; ?>" >
                              <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Analisa">
                                <i class="fa fa-flask"></i> Analisa
                              </button>
                            </a>

                          <?php
                          }
                        }
                          ?>

                          <a href="<?php echo base_url()."KunjunganLab/cetak_hasil/".$value->no_urutkunjungan."/".$value->nokunjlab; ?>" target="_blank">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cetak Hasil">
                              <i class="fa fa-print"></i>
                            </button>
                          </a>
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
<div class="loader" id="loader">
    <div class="loader__figure"></div>
    <!-- <p class="loader__label">Utama Husada</p> -->
</div>
<!-- <div id="kunjungan_belum">
asdaskdjaskdhakjshdkjah
</div> -->
<?php echo form_close();?>
<?php echo $this->Core->Fungsi_JS_Hapus(); ?>
<script type="text/javascript">

$(document).ready(function(){
        $("#loader").hide();
        $('#example_lab').DataTable();
});

function filter_kunjungan() {
  var tgl = $("#tanggal").val();
   $.ajax({
     type: 'POST',
     url: '<?php echo base_url();?>KunjunganLab/filter/' + tgl,
     data: { filter_tgl: tgl },
     beforeSend: function () {
            // $('#kunjungan_load').hide();
            $('#loader').show();
        },
     success: function(response) {
       $("#loader").hide();
       // $('#kunjungan_lab').show('medium');
       $("#lab").html(response);
       $('#example_lab').DataTable();
       // $('.datatables').DataTable();
     }
   });


}
</script>
