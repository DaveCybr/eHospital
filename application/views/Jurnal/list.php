<?php echo form_open(base_url().'Jurnal/list');?>
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <h3><a href="" class="white-text mx-3">Laporan jurnal</a></h3>

      </div>

      <div class="card-body">
        <div class="row p-t-20">
          <div class="col-md-4">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Dari Tanggal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                <input type="date" name="tgl_mulai" id="tgl" value="<?php echo isset($mulai)?$mulai:date("Y-m-d")?>" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Sampai Tanggal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                  <input type="date" name="tgl_sampai" id="tgl" value="<?php echo isset($sampai)?$sampai:date("Y-m-d")?>" class="form-control" required>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Aksi</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-instagram"></i></span> -->
                </div>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <button type="submit" name="submit" class="btn btn-info"><i class="fa fa-search"></i> Filter Sekarang</button>
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive" id="kunjungan_sudah">
          <table id="example" class="table table-striped table-bordered hover-table">
            <thead>
              <tr>
                <th>#</th>
                <th>No Transaksi</th>
                <th>No Rekening</th>
                <th>Nama Akun</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody id="jurnal">

              <?php $debet =0;
              $kredit =0; $no=1;foreach ($jurnal as $value):

                 ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $value->no_transaksi?></td>
                  <td><?php echo $value->norek?></td>
                  <td><?php echo $value->namarek?></td>
                  <td><?php echo date("d-m-Y",strtotime($value->tanggal));?></td>
                  <td><?php echo $value->keterangan==''||$value->keterangan==null?"-":$value->keterangan;?></td>
                  <td align="right"><?php echo $value->debet==0||$value->debet==''?"Rp.0":"Rp.".number_format($value->debet)?></td>
                  <td align="right"><?php echo $value->kredit==0||$value->kredit==''?"Rp.0":"Rp.".number_format($value->kredit)?></td>
              </tr>
              <?php $no++;
              $debet += $value->debet;
              $kredit += $value->kredit;
             endforeach; ?>

            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th colspan="5">Balance</th>
                <th>Rp.<?php echo number_format($debet)?></th>
                <th>Rp.<?php echo number_format($kredit)?></th>
              </tr>
            </tfoot>

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
          $("#loader").hide();
          // $('#kunjungan_sudah').show('medium');
          $("#billing").html(response);
          $('#example').DataTable();
        }
    })
})

});
</script>
