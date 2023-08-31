<?php echo form_open('Kunjungan/delete');?>
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <h3><a href="" class="white-text mx-3">Dapur Rawat Inap</a></h3>

      </div>

      <div class="card-body">
        <div class="table-responsive" id="kunjungan_sudah">
          <table id="example" class="table table-striped table-bordered hover-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Nama Pasien</th>
                <th>Perkiraan Jam Kunjungan</th>
                <th>Dokter</th>
                <th>Poli</th>
                <th>Nominal</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="billing">

              <?php $no=1;foreach ($booking as $value): ?>
                <?php $id = $value->idbooking;?>
                <?php $pasien = $this->Core->get_pasien($value->noRM);
                    // die(var_dump($pasien));

                ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo date("d-m-Y",strtotime($value->tanggal));?></td>
                  <td><?php echo $pasien['namapasien'] ?></td>
                  <td><?php echo $value->jam;?></td>
                  <td><?php echo $value->nama ?></td>
                  <td><?php echo $value->tujuan_pelayanan ?></td>
                  <td><?php echo "Rp.".number_format($value->nominal) ?></td>
                  <td>
                    <?php if ($value->status_booking!=0): ?>
                      <?php if ($value->status_booking==1): ?>
                        <div class="btn-group">
                          <button type="button" class="btn btn-warning btn-sm detail" id="<?php echo $id;?>"
                            style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-eye"></i> Lihat Bukti</button>

                          <a href="<?php echo base_url()."Verif/verifikasi/".$id; ?>">
                            <button type="button" class="btn btn-success btn-sm"
                            style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fas fa-check"></i> Verifikasi Pembayaran</button>
                          </a>
                        </div>
                        <?php else: ?>
                          <span class="badge badge-success">Sudah Verifikasi</span>
                      <?php endif; ?>
                    <?php else: ?>
                      <span class="badge badge-danger">Belum Bayar</span>
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
</div>
<?php
  $this->load->view("Periksa/modal_large",array(
    'id'=>'detail_sajian',
    'judul' => 'Bukti Pembayaran',
    'icon' => 'fas fa-user-secret',
    'view' => 'Verif/bukti',
    'edit' => 0

  ));
?>
<div class="loader" id="loader">
    <div class="loader__figure"></div>
</div>
<?php echo form_close();?>
<script>
$(document).ready(function(){
  $("#loader").hide();
    $(document).on("click",".detail",function(){
      var url = '<?php echo base_url()."foto/pembayaran/"?>';
      var id = $(this).attr("id");
      var valid = url+id+".jpg";
      $("#img").attr("src",valid);
      $("#detail_sajian").modal("toggle");

    })
});
</script>
