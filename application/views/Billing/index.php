<?php echo form_open('Kunjungan/delete');?>
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <h3><a href="" class="white-text mx-3">Billing Pasien</a></h3>

      </div>

      <div class="card-body">
        <div class="row col-xl-12">
          <div class="col-xl-2 col-md-6 col-sm-6">
            <input type="text" class="tanggalku form-control" placeholder="dd-mm-YYYY" value="<?php echo date("d-m-Y")?>" id="tanggal_fil">
          </div>

          <div class="col-xl-2 col-md-6 col-sm-6">
            <select class="mdb-select colorful-select dropdown-info sm-form" id="sts">
              <option value="" selected>Semua Status</option>
              <option value="0">Belum Bayar</option>
              <option value="1">Sudah Bayar</option>
            </select>
          </div>
          <div class="col-xl-2 col-md-6 col-sm-6">
            <select class="mdb-select colorful-select dropdown-info sm-form" id="asal_poli">
              <option value="" selected>Semua Poli</option>
              <option value="UMU">Poli Umum</option>
            </select>
          </div>
          <div class="col-xl-2 col-md-6 col-sm-6">
            <button class="btn btn-info btn-sm" type="button" id="filter_data">Filter</button>
          </div>
        </div>
        <div class="table-responsive" id="kunjungan_sudah">
          <table id="example" class="table table-striped table-bordered hover-table">
            <thead>
              <tr>
                <th>No</th>
                <th>#</th>
                <th>Tujuan Pelayanan</th>
                <th>Tanggal</th>
                <th>Jam Kunjungan</th>
                <th>NO RM</th>
                <th>Nama Pasien</th>
                <th>Jenis</th>
                <!-- <th>Status</th> -->
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="billing">
              <?php $no=1;foreach ($kunjungan as $value): ?>
                <?php $id = $value->no_urutkunjungan;?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $value->kd_antrian."".$value->no_antrian;?></td>
                  <td><?php $k = $value->kode_tupel;
                    $warna = "badge-primary";
                    $type = "IN";
                    if ($k == "UMU"){$warna = "badge-success"; $type="U";}elseif($k == "OBG"){$warna = "badge-info";$type="O";}elseif ($k == "GIG") {$warna = "badge-warning";$type="G";}
                    elseif ($k == "IGD") {$warna = "badge-danger";$type="IG";} ?>
                    <h4><span class="badge badge-pill <?php echo $warna; ?>"><?php echo $value->tujuan_pelayanan;?></span></h4></td>
                    <td><?php echo date("d-m-Y",strtotime($value->tgl));?></td>
                    <td><?php echo $value->jam_daftar;?></td>
                    <td><?php echo $value->pasien_noRM ?></td>
                    <td><?php echo $value->namapasien ?></td>
                    <td><?php echo $value->sumber_dana==7?"<h4><span class='badge badge-pill badge-success'>".$value->jenis_pasien."</h4>":"<h4><span class='badge badge-pill badge-danger'>".$value->jenis_pasien."</h4>"?></td>
                      <td>
                        <?php if ($value->billing==null || $value->billing!=1): ?>
                          <a href="<?php echo base_url()."Billing/Invoice/".$value->no_urutkunjungan; ?>">
                            <button type="button" class="btn btn-success btn-sm"
                            style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-credit-card"></i></button>
                          </a>
                        <?php else: ?>
                          <a  target="_blank" href="<?php echo base_url()."Billing/print_tagihan/".$value->no_urutkunjungan; ?>">
                            <button type="button" class="btn btn-danger btn-sm"
                            style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-print"></i> Cetak Ulang</button>
                          </a>
                          <a  target="_blank" href="<?php echo base_url()."Billing/kwitansi/".$value->no_urutkunjungan; ?>">
                            <button type="button" class="btn btn-warning btn-sm"
                            style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-print"></i> Kwitansi</button>
                          </a>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
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
    <!-- <p class="loader__label"></p> -->
  </div>
  <?php echo form_close();?>
  <script>
    $(document).ready(function(){
      $("#loader").hide();
      $(document).on("click","#filter_data",function(){
        var tgl = $("#tanggal_fil").val();
        var sts = $("#sts").val();
        var poli = $("#asal_poli").val();
        $.ajax({
          type: 'POST',
          url: '<?php echo base_url();?>Billing/filter_billing/',
          data: { tanggal:tgl,sts:sts,poli:poli},
          beforeSend: function () {
            // $('#kunjungan_sudah').hide();
            $('#loader').show();
            // alert(tgl);
          },
          success: function(response) {
            console.log(response);
            $("#loader").hide();
            // $('#kunjungan_sudah').show('medium');
            $("#billing").html(response);
            $('#example').DataTable();
          }
        })
      })

    });
  </script>
