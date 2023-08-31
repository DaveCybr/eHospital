

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <h4><a href="" class="white-text mx-3">Laporan L/R</a></h4>
      </div>
      <div class="card-body">
        <div class="row p-t-20">
          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Dari Tanggal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                <input type="date" name="tgl_mulai" value="<?php echo date("Y-m-d")?>" id="tgl_mulai" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Sampai Tanggal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <input type="date" name="tgl_sampai" value="<?php echo date("Y-m-d")?>" id="tgl_sampai" class="form-control" required>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Nomor Rekening</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <input type="text" name="norek" id="cari_norek" class="form-control" required>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Proses</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-instagram"></i></span> -->
                </div>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <button type="button" id="proses" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Prosses</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row col-md-12">
          <h4>Rekapitulasi Buku Besar</h4>
          <div class="table-responsive">
            <div class="table-responsive" id="kunjungan_sudah">
              <table id="exampledd" class="table table-striped table-bordered hover-table">
                <thead>
                  <tr>
                    <th width="5%">#</th>
                    <th>No Rekening</th>
                    <th>Nama Rekening</th>
                    <th width="15%">Debet</th>
                    <th width="15%">Kredit</th>
                    <th width="15%">Saldo</th>
                  </tr>
                </thead>
                <tbody id="pendapatan">


                </tbody>
                <tfoot>
                  <tr>
                    <!-- <th>#</th> -->
                    <th colspan="3">Total</th>
                    <th id="total_debet" align="right">Rp.0</th>
                    <th id="total_kredit" align="right">Rp.0</th>
                    <th id="total_saldo" align="right">Rp.0</th>
                  </tr>
                </tfoot>
                <input type="hidden" id="kode_rek" value="">
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Central Modal Large Info-->
  <div class="modal fade" id="rekening" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <p class="heading lead">Daftar Rekening</p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <!--Body-->
        <div class="modal-body">
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered hover-table">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th>No Rekening</th>
                  <th>Nama Rekening</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody id="daftar_rekening">

                <?php $no=1; foreach ($buku as $value): ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $value->norek_mbesar;?></td>
                    <td><?php echo $value->namarek;?></td>
                    <td><button class="floating-button btn-sm btn-primary pilih_norek" nama="<?php echo $value->namarek?>" id="<?php echo $value->norek_mbesar?>"><i class="fa fa-check"></i></button></td>

                  </tr>
                <?php endforeach; ?>

              </tbody>

            </table>

          </div>

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
<script type="text/javascript">
function addCommas(nStr){
  nStr += '';
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return x1 + x2;
}
$(document).ready(function(){

        $("#loader").hide();
        $(document).on("focus","#cari_norek",function(){
          $("#rekening").modal("toggle");
        });
        $(document).on("click",".pilih_norek",function(){
          var norek = $(this).attr("id");
          var nama = $(this).attr("nama");
          $("#kode_rek").val(norek);
          $("#cari_norek").val(norek+" - "+nama);
          $("#rekening").modal("toggle");

        })
        $(document).on("click","#proses",function(){
          var tgl_mulai = $("#tgl_mulai").val();
          var tgl_sampai = $("#tgl_sampai").val();
          var kode = $("#kode_rek").val();
          if (tgl_mulai=='') {
            alert("Harap pilih tanggal");
          }
          else if (tgl_sampai=='') {
            alert("Harap pilih tanggal");
          }else if(kode == ''){
            alert("Harap pilik nomor rekening");
          }
          else{
            // alert(tgl_mulai);
            $.ajax({
              type: 'POST',
              url: '<?php echo base_url();?>Laporan/get_buku_besar_detail',
              data: { tgl_sampai:tgl_sampai,tgl_mulai:tgl_mulai,norek:kode },
              dataType : 'json',
              beforeSend: function () {
                     // $('#kunjungan_belum').hide();
                     $('#loader').show();
                 },
              success: function(response) {
                $("#loader").hide();
                // alert(response);
                var pendapatan = response;
                var html1 = "";
                var no1=1;
                var total_debet=0,total_kredit=0,total_saldo=0;
                for (var i = 0; i < pendapatan.length; i++) {
                    var rek =parseInt(pendapatan[i].norek.substring(0,3));
                    if (rek<200) {
                      var saldo = (parseInt(pendapatan[i].debet)-parseInt(pendapatan[i].kredit));
                    }else{
                      var saldo = (parseInt(pendapatan[i].kredit)-parseInt(pendapatan[i].debet));
                    }
                    html1 += '<tr>'+
                    '<td>'+no1+'</td>'+
                    '<td>'+pendapatan[i].norek+'</td>'+
                    '<td>'+pendapatan[i].namarek+'</td>'+
                    '<td align="right">Rp.'+addCommas(pendapatan[i].debet)+'</td>'+
                    '<td align="right">Rp.'+addCommas(pendapatan[i].kredit)+'</td>'+
                    '<td align="right">Rp.'+addCommas(saldo)+'</td>';
                    total_saldo+=saldo;
                    total_debet+=parseInt(pendapatan[i].debet);
                    total_kredit+=parseInt(pendapatan[i].kredit);
                    // total_p+= parseInt(pendapatan[i].debet);
                    no1++;
                }
                $("#total_saldo").html("Rp."+addCommas(total_saldo));
                $("#total_debet").html("Rp."+addCommas(total_debet));
                $("#total_kredit").html("Rp."+addCommas(total_kredit));
                // var selisih = total_pendapatan-total_pengeluaran;
                $("#pendapatan").html(html1);

              }
            });
          }

        })
});
</script>
