
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="tgl" class=" form-control-label">Tanggal</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="date" name="tgl" id="tgl" class="form-control" placeholder="tanggal" <?php if (is_null(@$kunjungan['tgl'])): ?>
                  value="<?php echo date('Y-m-d'); ?>" <?php else: ?> value="<?php echo @$kunjungan['tgl']; ?>"
                <?php endif; ?> required>
            </div>
    </div>

    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jenis_pasien" class=" form-control-label">Rekam Medis</label>
            </div>
            <div class="col-12 col-md-9 ">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button class="btn btn-info" type="button" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-search"></i> Cari </button>
                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="myLargeModalLabel">List Pasien</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>

                        <div class="modal-body">
                          <div class="table-responsive">
                              <table id="tbl_pasien" class="table color-table info-table table-striped">
                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>No Rekam Medis</th>
                                              <!-- <th>No BPJS</th> -->

                                              <th>Nama Pasien </th>
                                              <th>Jenis Kelamin</th>
                                              <th>Umur</th>
                                              <th>alamat</th>
                                              <th>Opsi</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                  </table>
                            </div>
                        </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                </div>
                </div>
                <div class="input-group-prepend">
                  <input type="text" id="noRM" name="pasien_noRM" class="form-control" placeholder="No. Rekamedik" aria-label="" aria-describedby="basic-addon1" readonly>
                </div>
                <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama Pasien" aria-label="" aria-describedby="basic-addon1" readonly>
              </div>
              <input type="text" id="alamat" class="form-control" name="alamat" placeholder="Alamat Pasien" aria-label="" aria-describedby="basic-addon1" readonly>
            </div>
    </div>

            <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="jenis_kunjungan" class=" form-control-label">Jenis Kunjungan</label>
                    </div>
                    <div class="col-12 col-md-9">
                      <div class="form-check">
                          <div class="radio">

                            <label for="radio1" class="form-check-label ">
                                <input type="radio" id="jenis_kunjungan" name="jenis_kunjungan" value="1" class="form-check-input" <?php if (@$kunjungan['jenis_kunjungan']=='Lama') {
                                  echo "checked";
                          }?> required>Lama
                            </label>

                          </div>
                          <div class="radio">

                            <label for="radio1" class="form-check-label ">
                                <input type="radio" id="jenis_kunjungan" name="jenis_kunjungan" value="0" class="form-check-input" <?php if (@$kunjungan['jenis_kunjungan']=='Baru') {
                                  echo "checked";
                          }?> required>Baru
                            </label>
                          </div>
                      </div>
                    </div>
            </div>
            <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="jenis_kunjungan" class=" form-control-label">Pembayaran</label>
                    </div>
                    <div class="col-12 col-md-9">
                      <select class="form-control">
                        <option value="1">Umum</option>
                      </select>
                    </div>
            </div>
            <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="keluhan" class=" form-control-label">Keluhan</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <textarea name="keluhan" id="keluhan" class="form-control" placeholder="keluhan" value="<?php echo @$kunjungan['keluhan']; ?>" required></textarea>
                    </div>
            </div>
            <div class="row form-group">
                    <div class="col col-md-">
                      <label for="jenis_pasien" class=" form-control-label">Tujuan Pelayanan</label>
                    </div>
                    <div class="col-12 col-md-9">
                      <select name="tujuan_pelayanan" id="select" class="form-control select2">
                          <option>...Tujuan Pelayanan...</option>
                          <?php foreach ($tupel as $value): ?>
                            <option value="<?php echo $value->kode_tupel;?>" <?php if (@$kunjungan['tujuan_pelayanan'] == $value->kode_tupel) {
                              echo "selected";
                            }?>><?php echo $value->tujuan_pelayanan;?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
            </div>



    <!-- <div class="row form-group">
            <div class="col col-md-">
              <label for="bb" class=" form-control-label">Berat Badan</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="bb" id="bb" class="form-control" placeholder="berat badan" value="<?php echo @$kunjungan['bb']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="tb" class=" form-control-label">Tinggi Badan</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="tb" id="tb" class="form-control" placeholder="tinggi badan" value="<?php echo @$kunjungan['tb']; ?>" required>
            </div>
    </div> -->


<script type="text/javascript">

function pilih_pasien(noRM, nama, alamat, no_bpjs) {
  var noRM;
  var nama;
  var alamat;
  $("#noRM").val(noRM);
  $("#nama").val(nama);
  $("#alamat").val(alamat);
  $("#no_bpjs").val(no_bpjs);
}

function select_rm(noRM){
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url();?>Periksa/labsearchkode/' + kode,
    data: { kode_lab: kode },
    success: function(response) {
      $('#kode').val(response);
    }
  });
}

var table;
$(document).ready(function () {
  //datatables
  table = $('#tbl_pasien').DataTable({

    "processing": true,
    "serverSide": true,
    "order": [],

    "ajax": {
      "url": "<?php echo site_url('Kunjungan/get_data_pasien')?>",
      "type": "POST"
    },

    "columnDefs": [
      {
        "targets": [0],
        "orderable": false
      }
    ]
  });

});

// $(document).ready(function(){
//   $(document).on("click",".cek_nobpjs",function(){
//     var data = {
//       'nobpjs' : $("#noBPJS").val(),
//     };
//     if ($("#noBPJS").val()=="") {
//       alert("Harap isi no bpjs");
//     }else{
//       myajax_request(base_url+"Pasien/cek_bpjs",data,function(res){
//         if (res.status==1) {
//           var data = res.res;
//           $("#namapasien").val(data.nama);
//           $("#tgl_lahir").val(data.tglLahir);
//           $("#pekerjaan").val(data.jnsPeserta.nama);
//           $("#telepon").val(data.noHP);
//           // alert(data.nama);
//           if (data.sex=="P") {
//             $("#p").attr("checked","checked");
//             $("#l").removeAttr("checked");
//           }else{
//             $("#l").attr("checked","checked");
//             $("#p").removeAttr("checked");
//           }
//           alert(res.message);
//
//         }else if(res.status==2){
//
//           alert(res.message);
//         }else{
//           var data = res.res;
//           $("#namapasien").val(data.nama);
//           $("#tgl_lahir").val(data.tglLahir);
//           $("#pekerjaan").val(data.jnsPeserta.nama);
//           $("#telepon").val(data.noHP);
//           // alert(data.nama);
//           if (data.sex=="P") {
//             $("#p").attr("checked","checked");
//             $("#l").removeAttr("checked");
//           }else{
//             $("#l").attr("checked","checked");
//             $("#p").removeAttr("checked");
//           }
//         }
//       });
//     }
//   })
// })


</script>
