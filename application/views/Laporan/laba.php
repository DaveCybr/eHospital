

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <h4><a href="" class="white-text mx-3">Laporan L/R</a></h4>
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
                <input type="date" name="tgl_mulai" value="<?php echo date("Y-m-d")?>" id="tgl_mulai" class="form-control" required>
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
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <input type="date" name="tgl_sampai" value="<?php echo date("Y-m-d")?>" id="tgl_sampai" class="form-control" required>
              </div>
            </div>
          </div>

          <div class="col-md-4">
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
          <h4>Pendapatan</h4>
          <div class="table-responsive">
            <div class="table-responsive" id="kunjungan_sudah">
              <table id="exampledd" class="table table-striped table-bordered hover-table">
                <thead>
                  <tr>
                    <th width="5%">#</th>
                    <th>Nama Rekening</th>
                    <th width="25%">Jumlah</th>
                  </tr>
                </thead>
                <tbody id="pendapatan">


                </tbody>
                <tfoot>
                  <tr>
                    <!-- <th>#</th> -->
                    <th colspan="2">Total</th>
                    <th id="total_pendapatan" align="right">Rp.0</th>
                  </tr>
                </tfoot>

              </table>

            </div>
          </div>
        </div>
        <div class="row col-md-12">
          <h4>Beban</h4>
          <div class="table-responsive">
            <div class="table-responsive" id="kunjungan_sudah">
              <table id="exampledd" class="table table-striped table-bordered hover-table">
                <thead>
                  <tr>
                    <th width="5%">#</th>
                    <th>Nama Rekening</th>
                    <th width="25%">Jumlah</th>
                  </tr>
                </thead>
                <tbody id="pengeluaran">


                </tbody>
                <tfoot>
                  <tr>
                    <!-- <th>#</th> -->
                    <th colspan="2">Total</th>
                    <th align="right" id="total_pengeluaran">Rp.0</th>
                  </tr>
                </tfoot>

              </table>

            </div>
          </div>
          <div class="table-responsive">
            <div class="table-responsive" id="kunjungan_sudah">
              <table id="exampledd" class="table table-striped table-bordered hover-table">
                <thead>
                  <tr>
                    <th>Selisih</th>
                    <th width="25%" id="selisih">Rp.0</th>
                  </tr>
                </thead>

              </table>

            </div>
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
        $(document).on("click","#proses",function(){
          var tgl_mulai = $("#tgl_mulai").val();
          var tgl_sampai = $("#tgl_sampai").val();
          // alert(tgl_sampai);
          if (tgl_mulai=='') {
            alert("Harap pilih tanggal");
          }
          else if (tgl_sampai=='') {
            alert("Harap pilih tanggal");
          }else{
            // alert(tgl_mulai);
            $.ajax({
              type: 'POST',
              url: '<?php echo base_url();?>Laporan/get_laba',
              data: { tgl_sampai:tgl_sampai,tgl_mulai:tgl_mulai },
              dataType : 'json',
              beforeSend: function () {
                     // $('#kunjungan_belum').hide();
                     $('#loader').show();
                 },
              success: function(response) {
                $("#loader").hide();
                // alert(response);

                var pendapatan = response.pendapatan;
                var pengeluaran = response.pengeluaran;
                // alert(pendapatan.length);
                var html1 = "";
                var html2 = "";
                var no1 = 1;
                var no2 = 1;
                var total_pendapatan = 0,total_pengeluaran=0;
                for (var i = 0; i < pendapatan.length; i++) {
                  if (pendapatan[i].kredit!=0) {
                    html1 += '<tr>'+
                    '<td>'+no1+'</td>'+
                    '<td>'+pendapatan[i].namarek+'</td>'+
                    '<td align="right">Rp.'+addCommas(pendapatan[i].kredit)+'</td>';
                    total_pendapatan += parseInt(pendapatan[i].kredit);
                    no1++;

                  }
                }
                for (var i = 0; i < pengeluaran.length; i++) {
                  if (pengeluaran[i].debet!=0) {

                    html2 += '<tr>'+
                    '<td>'+no2+'</td>'+
                    '<td>'+pengeluaran[i].namarek+'</td>'+
                    '<td align="right">Rp.'+addCommas(pengeluaran[i].debet)+'</td>';
                    total_pengeluaran += parseInt(pengeluaran[i].debet);
                    no2++;
                  }
                }
                var selisih = total_pendapatan-total_pengeluaran;
                $("#pendapatan").html(html1);
                $("#total_pendapatan").html("Rp."+addCommas(total_pendapatan));
                $("#pengeluaran").html(html2);
                $("#total_pengeluaran").html("Rp."+addCommas(total_pengeluaran));
                $("#selisih").html("Rp."+addCommas(selisih));

              }
            });
          }

        })
});
</script>
