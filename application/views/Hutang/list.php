
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <h4><a href="" class="white-text mx-3">Hutang</a></h4>
      </div>

      <ul class="nav nav-tabs customtab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#belum" role="tab">
            <span class="hidden-sm-up">
              <i class="fas fa-user-clock"></i>
            </span>
            <span class="hidden-xs-down">Belum Lunas</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab"  href="#sudah" role="tab">
              <span class="hidden-sm-up">
                <i class="fas fa-user-check"></i>
              </span>
              <span class="hidden-xs-down">Sudah Lunas</span></a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active p-20" id="belum" role="tabpanel">
              <h2 style="text-align:center">Hutang Belum Lunas</h2>
              <br>
              <br>
              <div class="row">
                <div class="col-md-5">
                  <input type="date" id="tanggal" name="tanggal_masuk" class="form-control" onchange="data_hutang()">
                </div>
                <div class="col-md-4">
                  <button type="button" onclick="print()" name="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cetak Laporan">Print</button>
                </div>
              </div>
              <div class="table-responsive hasil_belum_lunas">

              </div>
            </div>
            <div class="tab-pane p-20" id="sudah" role="tabpanel">
              <h2 style="text-align:center">Hutang Lunas</h2>
              <br>
              <br>
              <div class="row">
                <div class="col-md-5">
                  <input type="date" id="tanggal2" name="tanggal_masuk" class="form-control" onchange="data_lunas()">
                </div>
                <div class="col-md-4">
                  <button type="button" name="button" onclick="print_lunas()"  class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cetak Laporan">cetak</button>
                </div>
              </div>
              <div class="table-responsive hasil_lunas">
                <br>
                <br>
                <h2 style="text-align:center">Data Tidak Ada</h2>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <?php $this->load->view($form_dialog)?>
    <script src="<?php echo base_url() ?>desain/dist/js/pages/jquery.PrintArea.js" type="text/JavaScript"></script>
    <script type="text/javascript">
      $(document).ready(function () {
        data_hutang();
        data_lunas();
      });

      function print() {
      var mode = 'iframe'; //popup
      var close = mode == "popup";
      var options = {
          mode: mode,
          popClose: close
      };
      $("div.printableArea").printArea(options);
    }

    function print_lunas() {
    var mode = 'iframe'; //popup
    var close = mode == "popup";
    var options = {
        mode: mode,
        popClose: close
    };
    $("div.data_lunas").printArea(options);
  }

      function data_hutang() {
        var tanggal = $('#tanggal').val();
        $.ajax({
          type  : 'POST',
          url   : '<?php echo base_url('Hutang/data_hutang') ?>',
          data:{tanggal:tanggal},
          success : function(response){
            $('.hasil_belum_lunas').html(response);
            $('#myTable').DataTable();
          }
        })
      }

      function data_lunas() {
        var tanggal = $('#tanggal2').val();
        $.ajax({
          type  : 'POST',
          url   : '<?php echo base_url('Hutang/data_lunas') ?>',
          data:{tanggal:tanggal},
          success : function(response){
            // console.log(response);
            $('.hasil_lunas').html(response);
            $('#tabel_sudah_lunas').DataTable();
          }
        })
      }


      $(function(){
        var base_url = '<?php echo base_url()?>';
        function myajax_request(url,data,callback){
          $.ajax({
            type  : 'POST',
            url   : url,
            async : false,
            dataType : 'json',
            data:data,
            success : function(response){
              callback(response);
            }
          })
        }
        function addCommas(nStr)
        {
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

        $(document).on('click','.detail_pembelian',function(){
          var data_detail = {
            'no_nota' : $(this).attr('id'),
          };
          myajax_request(base_url+"PembelianObat/get_detail",data_detail,function(res){
            var tes="";
            for (var i = 0; i < res.length; i++) {
              tes += "<tr>" +
                "<td>"+res[i].idobat+"</td>" +
                "<td>"+res[i].nama_obat+"</td>" +
                "<td>"+res[i].no_batch+"</td>" +
                "<td>"+res[i].tanggal_expired+"</td>" +
                "<td>Rp."+addCommas(res[i].hrg_beli)+"</td>" +
                "<td>"+res[i].jumlah+"</td>" +
                "<td>Rp."+addCommas(res[i].diskon)+"</td>" +
                "<td>Rp."+addCommas(res[i].ppn)+"</td>" +
                "<td>Rp."+addCommas(res[i].total_harga)+"</td>" +
                "</tr>";

              }
              $("#no_nota").html(res[0].no_nota);
              $("#no_nota_s").html(res[0].no_nota_supplier);
              $("#tgl_transaksi").html(res[0].tanggal_masuk);
              $("#j_tempo").html(res[0].tanggal_jatuh_tempo);
              $("#supplier").html(res[0].nama);
              $(".sts").html(res[0].status);
              $("#t_disk").html("Rp."+addCommas(res[0].total_diskon));
              $("#t_ppn").html("Rp."+addCommas(res[0].total_ppn));
              $("#t_harga").html("Rp."+addCommas(res[0].total_transaksi));
              $("#bayar_final").html("Rp."+addCommas(res[0].total_bayar));
              $("#bayar").html("Rp."+addCommas(res[0].bayar));
              $("#sisa").html("Rp."+addCommas(res[0].sisa));
              $("#t_hut").html("Rp."+addCommas(res[0].total_hutang));
              $("#obat").html(tes);
            });
          });
        });

      </script>
