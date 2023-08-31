
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <h3><a href="" class="white-text mx-3">Piutang Pasien</a></h3>

      </div>

      <div class="card-body">
        <div class="table-responsive" id="kunjungan_sudah">
          <table id="example" class="table table-striped table-bordered hover-table">
            <thead>
              <tr>
                <th>#</th>
                <th>No Rm</th>
                <th>Nama pasien</th>
                <th>Total tagihan</th>
                <th>Sudah Bayar</th>
                <th>Sisa</th>
                <th>Pembayaran</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="jurnal">
              <?php $no=1;foreach ($piutang as $value):

                 ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $value->noRM?></td>
                  <td><?php echo $value->namapasien?></td>
                  <td>Rp.<?php echo number_format($value->total);?></td>
                  <td>Rp.<?php echo number_format($value->bayar)?></td>
                  <td>Rp.<?php echo number_format($value->total-$value->bayar)?></td>
                  <td><?php echo $value->pembayaran?>X</td>
                  <td><button kun="<?php echo $value->kunjungan_no_urutkunjungan?>" norm="<?php echo $value->noRM?>" type="button" data-toggle="modal" data-target="#pembayaran" class="btn btn-sm btn-success aksi_bayar">Bayar</button></td>
                </tr>
              <?php $no++;
              endforeach; ?>
            </tbody>
          </table>

        </div>

      </div>
    </div>
  </div>
</div>
</div>
<!-- Central Modal Large Info-->
  <div class="modal fade" id="pembayaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <p class="heading lead">Bayar Sisa</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <!--Body-->
        <div class="modal-body">
          <?php echo form_open(base_url()."Piutang/bayar") ?>
          <div class="row form-group">
            <div class="col col-md-4">
                <label for="noBPJS" class=" form-control-label">Jumlah Bayar</label>
            </div>
            <div class="col-8 col-md-8">
              <input type="text" name="jumlah_bayar" value="" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-4">
                <!-- <label for="noBPJS" class=" form-control-label">Jumlah Bayar</label> -->
            </div>
            <div class="col-8 col-md-8">
              <button type="submit" class="btn btn-sm btn-success">Bayar</button>
            </div>
          </div>

          <input type="hidden" id="nokun" value="" name="nokun">
          <input type="hidden" id="no_rm" value="" name="no_rm">
          <?php echo form_close()?>

        </div>

        <!--Footer-->
        <div class="modal-footer">
          <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">CLOSE</a>
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <!-- Central Modal Large Info-->

<div class="loader" id="loader">
    <div class="loader__figure"></div>
    <!-- <p class="loader__label"></p> -->
</div>
<?php echo form_close();?>
<script>
$(document).ready(function(){
  $("#loader").hide();
  $(document).on("click",".aksi_bayar",function(){
    var nokun = $(this).attr("kun");
    var norm = $(this).attr("norm");
    $("#nokun").val(nokun);
    $("#no_rm").val(norm);
  })
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
          $("#loader").hide();
          // $('#kunjungan_sudah').show('medium');
          $("#billing").html(response);
          $('#example').DataTable();
        }
    })
})

});
</script>
