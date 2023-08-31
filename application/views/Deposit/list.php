
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <h3><a href="" class="white-text mx-3">Deposit Kunjungan</a></h3>

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
                        <button type="button" onclick="filter_kunjungan()" class="btn btn-success"> <i class="fa fa-search"></i> Filter</button>
                    </div>
                </div>
        </div>
        <div class="table-responsive" id="kunjungan_sudah">
          <table id="example" class="table table-striped table-bordered hover-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Pasien</th>
                <th>NO RM</th>
                <th>Tujuan Pelayanan</th>
                <th>Tanggal</th>
                <th>Jam Kunjungan</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="depo">

              <?php $no=1;foreach ($kunjungan as $value): ?>
                <?php $id = $value->no_urutkunjungan;?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $value->namapasien ?></td>
                  <td><?php echo $value->pasien_noRM ?></td>
                  <td><h4><?php echo $value->tujuan_pelayanan?></h4></td>
                  <td><?php echo date("d-m-Y",strtotime($value->tgl));?></td>
                  <td><?php echo $value->jam_daftar;?></td>
                  <td>
                    <?php if ($value->status_deposit==0): ?>
                      <button type="button" namapasien="<?php echo $value->namapasien?>" nokun="<?php echo $value->no_urutkunjungan?>" no_rm= "<?php echo $value->pasien_noRM?>" class="btn btn-warning btn-sm bayar_deposit" id="<?php echo $value->no_urutkunjungan;?>" data-toggle="modal" data-target="#detail_sajian"
                        style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-bill"></i> Bayar Deposit</button>

                    <?php else: ?>
                    <span class="badge badge-pill badge-success">  Sudah Bayar </span>
                    <a  target="_blank" href="<?php echo base_url()."Deposit/print/".$value->no_urutkunjungan; ?>">
                      <button type="button" class="btn btn-danger btn-sm"
                      style="border-bottom-right-radius: 0rem !important;border-top-right-radius: 0rem !important;"> <i class="fa fa-print"></i> Cetak Bukti Deposit</button>
                    </a>
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
    'judul' => 'Pembayaran Deposit Kunjungan',
    'icon' => 'fas fa-user-secret',
    'view' => 'Deposit/deposit',
    'edit' => 0

  ));
?>
<div class="loader" id="loader">
    <div class="loader__figure"></div>
    <!-- <p class="loader__label"></p> -->
</div>
<script type="text/javascript" src="<?php echo base_url();?>desain/dist/simple.money.format.js"></script>
<script type="text/javascript">
		$('.money').simpleMoneyFormat();
</script>

<script>
function filter_kunjungan() {
  var tgl = $("#tanggal").val();
   $.ajax({
     type: 'POST',
     url: '<?php echo base_url();?>Deposit/filter/' + tgl,
     data: { filter_tgl: tgl },
     beforeSend: function () {
            $('#depo').hide();
            $('#loader').show();
        },
     success: function(response) {
       $("#loader").hide();
       $('#depo').show('medium');
       $("#depo").html(response);
       $('#example').DataTable();
     }
   });
 }
$(document).ready(function(){
  $(document).on("click",".bayar_deposit",function(){
    var nokun = $(this).attr("nokun");
    var norm = $(this).attr("no_rm");
    var nama = $(this).attr("namapasien");
    $("#nokun").val(nokun);
    $("#no_rm").val(norm);
    $("#namapasien").val(nama);
  })
  $("#loader").hide();

});
</script>
