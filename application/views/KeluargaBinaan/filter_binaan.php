<div class="col-sm-4">
  <div class="card blue-gradient z-depth-2">
    <div class="row mt-3">
      <div class="col-md-5 col-5 text-left pl-4">
        <a type="button" href="#" target="_blank" class="btn-floating btn-lg light-blue lighten-2 ml-4 waves-effect waves-light"><i class="fas fa-user" aria-hidden="true"></i></a>
      </div>
      <div class="col-md-7 col-7 text-right pr-5">
        <h5 class="ml-4 mt-4 mb-2 font-weight-bold white-text"><?php echo $totalPasien = $keluarga->num_rows() ?></h5>
        <p class="font-small white-text font-weight-bold">Semua Pasien</p>
      </div>
    </div>
  </div>
</div>
<div class="col-sm-4">
  <div class="card aqua-gradient z-depth-2">
    <div class="row mt-3">
      <div class="col-md-5 col-5 text-left pl-4">
        <a type="button" href="#" target="_blank" class="btn-floating btn-lg light-green lighten-2 ml-4 waves-effect waves-light"><i class="fas fa-user-check" aria-hidden="true"></i></a>
      </div>
      <div class="col-md-7 col-7 text-right pr-5">
        <h5 class="ml-4 mt-4 mb-2 font-weight-bold white-text"><?php echo $PasienSudah = $this->ModelKBinaan->getAllKunjungan($tanggal,$perawat['NIK'])->num_rows() ?></h5>
        <p class="font-small white-text font-weight-bold">Pasien Sudah Dikunjungi</p>
      </div>
    </div>
  </div>
</div>
<div class="col-sm-4">
  <div class="card peach-gradient z-depth-2">
    <div class="row mt-3">
      <div class="col-md-5 col-5 text-left pl-4">
        <button type="button" class="btn-floating btn-lg btn-warning ml-4 waves-effect waves-light"><i class="fas fa-user-tag" aria-hidden="true"></i></button>
      </div>
      <div class="col-md-7 col-7 text-right pr-5">
        <h5 class="ml-4 mt-4 mb-2 font-weight-bold white-text"><?php echo $totalPasien - $PasienSudah ?></h5>
        <p class="font-small white-text font-weight-bold">Pasien Belum Dikunjungi</p>
      </div>
    </div>
  </div>
</div>
<div class="table-responsive col-sm-12">
  <?php if ($status_kunjungan == 1) {
    $this->load->view("KeluargaBinaan/binaan_semua");
  }elseif ($status_kunjungan == 2) {
    $this->load->view("KeluargaBinaan/binaan_sudah");
  }elseif ($status_kunjungan == 3) {
    $this->load->view("KeluargaBinaan/binaan_belum");
  } ?>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Form Input Program / Kegiatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
              <div class="card-body card-block">
                <?php echo form_open_multipart('K_Binaan/KBPasien/insert_kunjungan'); ?>
                <?php echo @$error; ?>

                <div class="card">
                  <div class="card-body card-block">

                    <div class="row form-group">
                      <div class="col col-md-3">
                        <label for="tgl" class=" form-control-label">Tanggal</label>
                      </div>
                      <div class="col-12 col-md-9">
                        <input type="date" name="tgl" id="tgl" class="form-control"
                        placeholder="tanggal" <?php if (is_null(@$kunjungan['tgl'])): ?>
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
                            <input type="text" id="noRMkun" name="pasien_noRM"
                            onchange="select_rm()" class="form-control"
                            placeholder="No. Rekamedik" aria-label=""
                            aria-describedby="basic-addon1" autofocus
                            value="<?php echo @$this->uri->segment(3); ?>">
                          </div>
                          <input type="text" id="namakun" class="form-control"
                          placeholder="Nama Pasien" aria-label=""
                          aria-describedby="basic-addon1" readonly>
                        </div>
                        <input style="margin-bottom:5px" type="text" id="no_bpjs" class="form-control"
                        placeholder="No BPJS" aria-label=""
                        aria-describedby="basic-addon1" readonly>
                        <input type="text" style="margin-bottom:5px"  id="alamatkun" class="form-control"
                        placeholder="Alamat Pasien" aria-label=""
                        aria-describedby="basic-addon1" readonly>


                        <input type="text" style="margin-bottom:5px"   id="terakhir" class="form-control"
                        placeholder="Kunjungan Terakhir" aria-label=""
                        aria-describedby="basic-addon1" readonly>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col col-md-3">
                        <label for="jenis_kunjungan" class=" form-control-label">Asal Pasien</label>
                      </div>
                      <div class="col-12 col-md-9">

                        <div class="custom-control custom-radio">
                          <input type="radio" id="asal_pasien1" name="asal_pasien" value="Datang Sendiri" class="custom-control-input" checked>
                          <label class="custom-control-label" for="asal_pasien1">Datang Sendiri</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input type="radio" id="asal_pasien2" name="asal_pasien" value="Rujukan Dokter" class="custom-control-input" required>
                          <label class="custom-control-label" for="asal_pasien2">Rujukan Dokter</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input type="radio" id="asal_pasien3" name="asal_pasien" value="Rujukan Bidan" class="custom-control-input" required>
                          <label class="custom-control-label" for="asal_pasien3">Rujukan Bidan</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input type="radio" id="asal_pasien4" name="asal_pasien" value="Lainnya" class="custom-control-input" required>
                          <label class="custom-control-label" for="asal_pasien4">Lainnya</label>
                        </div>

                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col col-md-3">
                        <label for="jenis_kunjungan" class=" form-control-label">Jenis
                          Kunjungan</label>
                        </div>
                        <div class="col-12 col-md-9">

                          <div class="custom-control custom-radio">
                            <input type="radio" id="jenis_kunjungan_lama" name="jenis_kunjungan"
                            value="1"
                            class="custom-control-input" <?php if (@$kunjungan['jenis_kunjungan'] == '1') {
                              echo "checked";
                            } ?>>
                            <label class="custom-control-label" for="jenis_kunjungan_lama">Lama</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input type="radio" id="jenis_kunjungan_baru" name="jenis_kunjungan"
                            value="0"
                            class="custom-control-input" <?php if (@$kunjungan['jenis_kunjungan'] == '0') {
                              echo "checked";
                            } ?> required>
                            <label class="custom-control-label" for="jenis_kunjungan_baru">Baru</label>
                          </div>

                        </div>
                      </div>
                      <div class="row form-group">
                        <div class="col col-md-3">
                          <label for="jenis_kunjungan" class=" form-control-label">Pembayaran</label>
                        </div>
                        <div class="col-12 col-md-9">
                          <select name="jenis_pembayaran" id="sumber_dana" class="mdb-select_M colorful-select dropdown-info sm-form">
                            <?php foreach ($jenis_pasien as $value): ?>
                              <option value="<?php echo $value->kode_jenis?>"><?php echo $value->jenis_pasien?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="row form-group">
                        <div class="col col-md-3">
                          <label for="keluhan" class=" form-control-label">Keluhan</label>
                        </div>
                        <div class="col-12 col-md-9">
                          <textarea name="keluhan" id="keluhan" class="form-control"
                          placeholder="keluhan"
                          value="<?php echo @$kunjungan['keluhan']; ?>" required></textarea>
                        </div>
                      </div>
                      <div class="row form-group">
                        <div class="col col-md-3">
                          <label for="keluhan" class=" form-control-label">Berat Badan Dan Tinggi Badan</label>
                        </div>
                        <div class="col-6 col-md-3">
                          <input type="number" name="bb" id="bb" min="2" class="form-control"
                          placeholder="BB"
                          value="<?php echo @$kunjungan['bb']; ?>" required>
                        </div>

                        <div class="col-6 col-md-3">
                          <input type="number" name="tb" id="tb" min="50" class="form-control"
                          placeholder="TB"
                          value="<?php echo @$kunjungan['tb']; ?>" required>


                        </div>
                      </div>
                      <div class="row form-group">
                        <div class="col col-md-3">
                          <label for="jenis_pasien" class=" form-control-label">Tujuan
                            Pelayanan</label>
                          </div>
                          <div class="col-12 col-md-3">
                            <select name="tujuan_pelayanan" id="select_tujuan" class="poli mdb-select_M colorful-select dropdown-info sm-form">
                              <?php foreach ($tupel as $value): ?>
                                <option value="<?php echo $value->kode_tupel; ?>" <?php if (@$kunjungan['tujuan_pelayanan'] == $value->kode_tupel) {
                                  echo "selected";
                                } ?>><?php echo $value->tujuan_pelayanan; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="col-12 col-md-3">
                            <div class="custom-control custom-radio m-l-10">
                                  <input type="radio" id="kunj_sehat" name="kunjungansakit" value="0" onchange="getPoli()" class="kunjungansakit custom-control-input">
                              <label class="custom-control-label" for="kunj_sehat">Kunjungan Sehat</label>
                            </div>
                          </div>
                          <div class="col-12 col-md-3">
                            <div class="custom-control custom-radio m-l-10">
                                  <input type="radio" id="kunj_sakit" checked name="kunjungansakit" value="1" onchange="getPoli()" class="kunjungansakit custom-control-input">
                              <label class="custom-control-label" for="kunj_sakit">Kunjungan Sakit</label>
                            </div>
                          </div>
                        </div>
                        </div>
                      </div>
                      <input type="hidden" name="kdprovider" id="kdprovider" value="">
                      <?php echo $this->Core->btn_input() ?>
                      <?php echo form_close(); ?>
                    </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script src="<?php echo base_url(); ?>desain/assets/node_modules/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
function select_rm(noRMkun) {
  // alert(noRMkun);
  $("#noRMkun").val(noRMkun);
  var norm = noRMkun;
  norm = pad(norm,8);
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url();?>Pasien/searchrm/' + norm,
    data: {norm_pasien: norm},
    success: function (response) {
      if (response == "0") {
        swal({
          title: "Pasien Tidak Ditemukan!",
          timer: 3000,
          showConfirmButton: true
        });
        $('#namakun').val("Tidak Ditemukan");
      } else {
        $('#namakun').val(response);
      }

    }
  });
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url();?>Pasien/searchrma/' + norm,
    data: {norm_pasien: norm},
    dataType : 'json',
    success: function (response) {

      $('#namakun').val(response.res.nama);
      $('#alamatkun').val(response.alamat);
      $("#sumber_dana").html(response.sumber_dana);

      $("#bb").val(response.bb);
      $("#tb").val(response.tb);

      $("#no_bpjs").val(response.bpjs);
      $("#terakhir").val(response.terakhir);

      $("#kdprovider").val(response.kdprovider);
      // if (response.status!=0) {
      // }
      if (response.status!=0) {
        alert(response.message);
      }
    }
  });
  $('#noRMkun').val(norm);
  cekkunjungan();
}

function cekkunjungan() {
  var noRM = $('#noRMkun').val();
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url();?>Kunjungan/hitung_riwayat/' + noRM,
    success: function (response) {
      if (response > 0) {
        $('#jenis_kunjungan_lama').prop("checked", true);
        $('#jenis_kunjungan_baru').prop("checked", false);
      } else {
        $('#jenis_kunjungan_baru').prop("checked", true);
        $('#jenis_kunjungan_lama').prop("checked", false);
      }
      // alert(response);
    },
    error: function(e) {
      // alert(e);
    }
  });
  // alert(noRM) ;
}
function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}

function no_urut() {
  var poli = $(".poli option:selected").val();
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url();?>Kunjungan/no_urut/' + poli,
    data: {poli: poli},
    success: function (response) {
      $("#no_antrian").val(response);
    }
  });
}

function pilih_pasien(noRM, nama, alamat,jenis) {
  var noRM;
  var nama;
  var alamat;
  var jenis;
  $("#noRMkun").val(noRM);
  $("#namakun").val(nama);
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url();?>Pasien/searchrma/' + noRM,
    data: {norm_pasien: noRM},
    dataType: 'json',
    success: function (response) {
      $('#alamatkun').val(response.alamat);
      $("#sumber_dana").html(response.sumber_dana);

      $("#no_bpjs").val(response.bpjs);
      $("#terakhir").val(response.terakhir);
      $("#bb").val(response.bb);
      $("#tb").val(response.tb);

      $("#kdprovider").val(response.kdprovider);
      if (response.status!=0) {
        alert(response.message);
      }
    }
  });
  // $("#alamatkun").val(alamat);
  cekkunjungan();
  // alert(jenis);
}

var table;
$(document).ready(function () {
  $('.mdb-select_M').material_select();
});

function getPoli() {
  var data = $("input[type='radio'].kunjungansakit:checked").val();
  // alert(data);
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url();?>Kunjungan/ambil_poli',
    data: {polisakit: data},
    success: function (response) {
      // alert(response);
      $("#select_tujuan").html(response);
      $("#select_tujuan").material_select();
    }
  });
}


!function ($) {
  "use strict";

  var SweetAlert = function () {
  };

  //examples
  SweetAlert.prototype.init = function () {


    //Auto Close Timer
    $('#nasdopasid').click(function () {
      swal({
        title: "Pasien Tidak Ditemukan!",
        timer: 3000,
        showConfirmButton: true
      });
    });


  },
  //init
  $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing
function ($) {
  "use strict";
  $.SweetAlert.init()
}(window.jQuery);


</script>
