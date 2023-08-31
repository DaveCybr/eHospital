

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <h4><a href="" class="white-text mx-3">Laporan Pendapatan Jasa Medis Per Dokter</a></h4>
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
              <label for="exampleInputuname">Pilih Karyawan</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                </div>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <input type="text" name="tgl_sampai" id="karyawan" class="form-control" nik="" required>
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
          <h4>Detail</h4>
          <div class="table-responsive">
            <div class="table-responsive" id="kunjungan_sudah">
              <table id="example" class="table table-striped table-bordered hover-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Jasa</th>
                    <th>Jumlah Pendapatan</th>
                  </tr>
                </thead>
                <tbody id="laporan">


                </tbody>
                <tfoot>
                  <tr>
                    <!-- <th>#</th> -->
                    <th colspan="2">Total</th>
                    <th id="total">Rp.0</th>
                  </tr>
                </tfoot>

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
<!-- Central Modal Large Info-->
  <div class="modal fade" id="daftar_dokter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <p class="heading lead">Daftar Dokter Prakter</p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <!--Body-->
        <div class="modal-body">
          <table id="myTable" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th width="10%"><input type="checkbox" class="form-check-input select-all" id="tableMaterialChec">
                        <label class="form-check-label" for="tableMaterialChec"></label>
                        </th>
                        <th>NIK</th>
                          <th>Nama</th>
                          <th>Jabatan</th>
                          <th width="%5">opsi</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach ($pegawai as $data_pegawai):
                      $id_check = $data_pegawai->NIK;?>
                      <tr>
                        <td><input type="checkbox" class="form-check-input id_checkbox" id="tableMaterialCheck<?php echo $id_check ?>" name="id[]" value="<?php echo $id_check ?>">
                          <label class="form-check-label" for="tableMaterialCheck<?php echo $id_check ?>"></label>
                        </td>
                        <td><?php echo $id_check; ?></td>
                          <td><?php echo $data_pegawai->nama; ?></td>
                          <td><?php echo $data_pegawai->jabatan; ?></td>
                          <td>
                            <a href="#">
                            <button type="button" nama="<?php echo $data_pegawai->nama;?>" nik="<?php echo $id_check?>" class="btn btn-circle btn-success pilih_pegawai" data-toggle="tooltip" data-placement="right" title="" data-original-title="Pilih">
                              <i class="fa fa-check"></i>
                            </button>
                            </a>
                          </td>
                      </tr>
                    <?php $no++;  endforeach; ?>
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
      $(document).on("click",".pilih_pegawai",function(){
        var nama = $(this).attr("nama");
        var nik = $(this).attr("nik");
        $("#karyawan").val(nama);
        $("#karyawan").attr("nik",nik);
        $("#daftar_dokter").modal("toggle");
      });
        $("#karyawan").focus(function(){

          $("#daftar_dokter").modal("toggle");
        })

        $("#loader").hide();
        $(document).on("click","#proses",function(){
          var tgl_mulai = $("#tgl_mulai").val();
          var tgl_sampai = $("#tgl_sampai").val();
          var nik = $("#karyawan").attr("nik");
          if (tgl_mulai=='') {
            alert("Harap pilih tanggal");
          }
          else if (tgl_sampai=='') {
            alert("Harap pilih tanggal");
          }else if(nik==''){

              alert("Harap pilih karyawan");
          }else{
            // alert(nik);
            $.ajax({
              type: 'POST',
              url: '<?php echo base_url();?>Laporan/get_jasa_all',
              data: { tgl_sampai:tgl_sampai,tgl_mulai:tgl_mulai,nik:nik },
              dataType : 'json',
              beforeSend: function () {
                     // $('#kunjungan_belum').hide();
                     $('#loader').show();
                 },
              success: function(response) {
                // alert(response);
                $("#loader").hide();
                // alert(response);
                var html = "";
                var no = 1;
                var total = 0;
                for (var i = 0; i < response.length; i++) {
                  html += '<tr>'+
                  '<td>'+no+'</td>'+
                  '<td>'+response[i].jsmedis+'</td>'+
                  '<td>Rp.'+addCommas(response[i].jumlah)+'</td>';
                  total += parseInt(response[i].jumlah);
                  no++;
                }
                $("#laporan").html(html);
                $("#total").html("Rp."+addCommas(total));
              }
            });
          }

        })
});
</script>
