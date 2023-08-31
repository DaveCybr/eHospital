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
                <th>Pelayanan</th>
                <th>Tanggal</th>
                <th>Jam Kunjungan</th>
                <th>NO RM</th>
                <th>Nama Pasien</th>
                <th>Kamar</th>
                <th>Kelas Perawatan</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="billing">

              <?php $no=1;foreach ($kunjungan as $value): ?>
                <?php $id = $value->no_urutkunjungan;?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><h4><span class="badge badge-pill purple-gradient">Rawat Inap</span></h4></td>
                  <td><?php echo date("d-m-Y",strtotime($value->tgl));?></td>
                  <td><?php echo $value->jam_daftar;?></td>
                  <td><?php echo $value->pasien_noRM ?></td>
                  <td><?php echo $value->namapasien ?></td>
                  <td><?php echo $value->nama_kamar ?></td>
                  <td><?php echo "Kelas ".$value->kelas ?></td>

                  <td>

                    <div class="btn-group">
                        <a href="<?php echo base_url()."Dapur/sajikan/".$value->no_urutkunjungan; ?>">
                          <button type="button" class="btn btn-success btn-sm"
                          style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fas fa-utensils"></i> Sajikan Makanan</button>
                        </a>
                  </div>
                  <button type="button" class="btn btn-warning btn-sm detail" id="<?php echo $value->no_urutkunjungan;?>" data-toggle="modal" data-target="#detail_sajian"
                    style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-eye"></i></button>


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
    'judul' => 'Detail Penyajian Makanan',
    'icon' => 'fas fa-user-secret',
    'view' => 'Dapur/list',
    'edit' => 0

  ));
?>
<div class="loader" id="loader">
    <div class="loader__figure"></div>
    <!-- <p class="loader__label"></p> -->
</div>
<?php echo form_close();?>
<script>
$(document).ready(function(){
  $("#loader").hide();
    $(document).on("click",".detail",function(){
      var nokun = $(this).attr("id");
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>Dapur/get_detail/',
        data: { nokun:nokun},
        dataType:'json',
        success: function(response) {
          // alert(response);
          $("#sajian").html(response.sajian);
          $(".hari_ini").text(response.hari_ini);
          $(".total_sajian").text(response.total);
          $("#table_sajian").dataTable();
        }

    })
})

});
</script>
