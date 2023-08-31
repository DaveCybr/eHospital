<!-- <link href="<?php echo base_url(); ?>desain/assets/node_modules/sweetalert/sweetalert.css" rel="stylesheet"
type="text/css"> -->
<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1 animated fadeInRight">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
              <h4><a href="" class="white-text mx-3">Kunjungan Pasien</a></h4>
              <div>
                <a href="#" class="float-right" data-toggle="modal" data-target="#tambahpasien">
                  <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Pasien Baru"><i class="fas fa-user-plus mt-0"></i></button>
                </a>
              </div>
            </div>

            <div class="card-body card-block">
              <?php echo form_open_multipart(base_url('Kunjungan/insert2')); ?>
              <?php echo @$error; ?>

              <div class="card">
                <div class="card-body card-block">

                  <div class="row col-12 form-group">
                    <div class="col col-md-3">
                      <label for="tgl" class=" form-control-label">Tanggal</label>
                    </div>
                    <div class="col-12 col-md-9">
                      <input type="date" name="tgl" id="tgl" class="form-control" placeholder="tanggal" <?php if (is_null(@$kunjungan['tgl'])) : ?> value="<?php echo date('Y-m-d'); ?>" <?php else : ?> value="<?php echo @$kunjungan['tgl']; ?>" <?php endif; ?> required>
                    </div>
                  </div>

                  <div class="row col-12 form-group">
                    <div class="col col-md-3">
                      <label for="jenis_pasien" class=" form-control-label">Rekam Medis</label>
                    </div>
                    <div class="col-12 col-md-9 ">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <button class="btn btn-info" type="button" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-search"></i> Cari
                          </button>
                        </div>
                        <div class="input-group-prepend">
                          <input type="text" id="noRMkun" name="pasien_noRM" onchange="select_rm()" class="form-control" placeholder="No. Rekamedik" aria-label="" aria-describedby="basic-addon1" autofocus value="<?php echo @$this->uri->segment(3); ?>">
                        </div>

                        <input type="text" id="namakun" class="form-control" placeholder="Nama Pasien" aria-label="" aria-describedby="basic-addon1" readonly>
                      </div>

                      <input style="margin-bottom:5px" type="text" id="no_bpjs" class="form-control" placeholder="No BPJS" aria-label="" aria-describedby="basic-addon1" readonly>

                      <input type="text" style="margin-bottom:5px" id="alamatkun" class="form-control" placeholder="Alamat Pasien" aria-label="" aria-describedby="basic-addon1" readonly>


                      <input type="text" style="margin-bottom:5px" id="terakhir" class="form-control" placeholder="Kunjungan Terakhir" aria-label="" aria-describedby="basic-addon1" readonly>
                    </div>
                  </div>
                  <div class="row col-12 form-group">
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
                  <div class="row col-12 form-group">
                    <div class="col col-md-3">
                      <label for="jenis_kunjungan" class=" form-control-label">Jenis
                        Kunjungan</label>
                    </div>
                    <div class="col-12 col-md-9">

                      <div class="custom-control custom-radio">
                        <input type="radio" id="jenis_kunjungan_lama" name="jenis_kunjungan" value="1" class="custom-control-input" <?php if (@$kunjungan['jenis_kunjungan'] == '1') {
                                                                                                                                      echo "checked";
                                                                                                                                    } ?>>
                        <label class="custom-control-label" for="jenis_kunjungan_lama">Lama</label>
                      </div>
                      <div class="custom-control custom-radio">
                        <input type="radio" id="jenis_kunjungan_baru" name="jenis_kunjungan" value="0" class="custom-control-input" <?php if (@$kunjungan['jenis_kunjungan'] == '0') {
                                                                                                                                      echo "checked";
                                                                                                                                    } ?> required>
                        <label class="custom-control-label" for="jenis_kunjungan_baru">Baru</label>
                      </div>

                    </div>
                  </div>
                  <div class="row col-12 form-group">
                    <div class="col col-md-3">
                      <label for="jenis_kunjungan" class=" form-control-label">Pembayaran</label>
                    </div>
                    <div class="col-12 col-md-9">
                      <select name="jenis_pembayaran" id="sumber_dana" class="mdb-select colorful-select dropdown-info sm-form">
                        <?php foreach ($jenis_pasien as $value) : ?>

                          <option value="<?php echo $value->kode_jenis ?>"><?php echo $value->jenis_pasien ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                  </div>
                  <!-- <div class="row form-group">
                    <div class="col col-md-3">
                    <label for="keluhan" class=" form-control-label">TKP</label>
                  </div>
                  <div class="col-12 col-md-9">
                  <div class="custom-control custom-radio">
                  <input type="radio" id="rajal" name="tkp" value="10" class="custom-control-input" required>

                  <label class="custom-control-label" for="rajal">Rawat Jalan</label>
                </div>
                <div class="custom-control custom-radio">

                <input type="radio" id="ranap" name="tkp" value="20" class="custom-control-input" required>

                <label class="custom-control-label" for="ranap">Rawat Inap</label>
              </div>
              <div class="custom-control custom-radio">

              <input type="radio" id="promotif" name="tkp" value="50" class="custom-control-input" required>

              <label class="custom-control-label" for="promotif">Promotif</label>
            </div>

          </div>
        </div> -->

                  <div class="row col-12 form-group">
                    <div class="col col-md-3">
                      <label for="keluhan" class=" form-control-label">Keluhan</label>
                    </div>
                    <div class="col-12 col-md-9">
                      <textarea name="keluhan" id="keluhan" class="form-control" placeholder="keluhan" value="<?php echo @$kunjungan['keluhan']; ?>" required></textarea>
                    </div>
                  </div>


                  <div class="row form-group">
                    <div class="col col-md-3">
                      <!-- <label for="keluhan" class=" form-control-label">Berat Badan Dan Tinggi Badan</label> -->
                    </div>
                    <div class="col-6 col-md-3">
                      Prolanis : <span id="prolanis"></span>
                    </div>

                    <div class="col-6 col-md-3">
                      PRB : <span id="prb"></span>
                    </div>
                  </div>

                  <div class="col-12 form-group">
                    <h2>
                      Pemeriksaan Fisik
                      <hr />
                    </h2>
                  </div>
                  <div class="row">
                    <div class="col col-md-3">

                    </div>
                    <div class="row col col-md-9">
                      <div class="col-md-6 col-md">
                        <div class="form-group">
                          <label for="keluhan" class=" form-control-label">Berat Badan</label>
                          <?php $bb = (@$kunjungan['bb'] > 0 || @$kunjungan['bb'] != null) ? @$kunjungan['bb'] : '60'; ?>

                          <input type="number" name="bb" id="bb" min="2" class="form-control" placeholder="BB" value="<?php echo @$bb; ?>" onblur="hitung_imt()" required>
                        </div>
                      </div>

                      <div class="col-md-6 col-md">
                        <div class="form-group">
                          <label for="keluhan" class=" form-control-label">Tinggi Badan (Cm)</label>
                          <?php $tb = (@$kunjungan['tb'] > 0 || @$kunjungan['tb'] != null) ? @$kunjungan['tb'] : '160'; ?>

                          <input type="number" name="tb" id="tb" min="50" class="form-control" placeholder="TB" value="<?php echo @$tb; ?>" onblur="hitung_imt()" required>
                        </div>
                      </div>

                      <div class="col-md-6 col-md">
                        <div class="form-group">
                          <label for="imt" class=" form-control-label">IMT</label>
                          <input type="text" name="imt" id="imt" class="form-control" placeholder="IMT" value="<?php echo @$kunjungan['imt']; ?>" required>
                        </div>
                      </div>

                      <div class="col-md-6 col-md">
                        <div class="form-group">
                          <label for="suhu" class=" form-control-label">Suhu</label>
                          <?php $suhu = (@$kunjungan['suhu'] > 0 || @$kunjungan['suhu'] != null) ? @$kunjungan['suhu'] : '35'; ?>
                          <input type="text" name="suhu" id="suhu" class="form-control" placeholder="Suhu" value="<?php echo @$suhu; ?>" required>
                        </div>
                      </div>

                      <div class="col-md-6 col-md">
                        <div class="form-group">
                          <label for="keluhan" class=" form-control-label">Lingkar Perut</label>
                          <input type="number" name="lingkarPerut" id="lingkarPerut" min="25" class="form-control" placeholder="Lingkar Perut" <?php if (@$kunjungan['lingkar_perut'] != null || @$kunjungan['lingkar_perut'] > 0) : ?> value="  <?php echo @$kunjungan['lingkar_perut']; ?>" <?php else : ?> value="90" <?php endif; ?> required>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="col-12 form-group">
                    <h2>
                      Tekanan Darah
                      <hr />
                    </h2>
                  </div>

                  <div class="row">
                    <div class="col col-md-3">

                    </div>
                    <div class="row col col-md-9">
                      <div class="col-md-6 col-md">
                        <div class="form-group">
                          <label for="keluhan" class=" form-control-label">Sistole</label>
                          <input type="number" name="sistole" id="sistole" min="80" class="form-control" placeholder="sistole" value="120" required>
                        </div>
                      </div>

                      <div class="col-md-6 col-md">
                        <div class="form-group">
                          <label for="keluhan" class=" form-control-label">Diastole</label>
                          <input type="number" name="diastole" id="diastole" min="20" class="form-control" placeholder="diastole" value="80" required>
                        </div>
                      </div>

                      <div class="col-md-6 col-md">
                        <div class="form-group">
                          <label for="keluhan" class=" form-control-label">RespRate (rr)/min</label>
                          <input type="number" name="rr" id="rr" min="5" class="form-control" placeholder="Resp Rate" value="20" required>
                        </div>
                      </div>

                      <div class="col-md-6 col-md">
                        <div class="form-group">
                          <label for="keluhan" class=" form-control-label">SpO2</label>
                          <input type="number" name="spo2" id="spo2" min="5" class="form-control" placeholder="SpO2" value="95" required>
                        </div>
                      </div>
                      <div class="col-md-6 col-md">
                        <div class="form-group">
                          <label for="keluhan" class=" form-control-label">Nadi/Heart Rate</label>
                          <input type="number" name="heartRate" id="heartRate" min="5" class="form-control" placeholder="Heart Rate" value="98" required>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- <div class="row form-group">

          <div class="col col-md-2">
            <label for="keluhan" class=" form-control-label">Berat Badan, Tinggi Badan, Lingkar Perut</label>
          </div>
          <div class="col-6 col-md-2">
            <input type="number" name="bb" id="bb" min="2" class="form-control"
            placeholder="BB"
            value="<?php echo @$kunjungan['bb']; ?>" required>
          </div>

          <div class="col-6 col-md-2">
            <input type="number" name="tb" id="tb" min="50" class="form-control"
            placeholder="TB"
            value="<?php echo @$kunjungan['tb']; ?>" required>
          </div>

          <div class="col-6 col-md-2">
            <input type="number" name="lingkarPerut" id="lingkarPerut" min="25" class="form-control"
            placeholder="Lingkar Perut" value="<?php echo @$kunjungan['lingkar_perut']; ?>"
            required>
          </div>
        </div> -->
                  <!-- <div class="row form-group">
          <div class="col col-md-2">
            <label for="keluhan" class=" form-control-label">sistole, Diastole, Nadi/respRate (RR), SpO2, Heart rate</label>
          </div>
          <div class="col-6 col-md-2">
            <input type="number" name="sistole" id="sistole" min="80" class="form-control"
            placeholder="sistole"
            value="120" required>
          </div>

          <div class="col-6 col-md-2">
            <input type="number" name="diastole" id="diastole" min="20" class="form-control"
            placeholder="diastole"
            value="80" required>
          </div>

          <div class="col-6 col-md-2">
            <input type="number" name="rr" id="rr" min="5" class="form-control"
            placeholder="Resp Rate" value="12"
            required>
          </div>
          <div class="col-6 col-md-2">
            <input type="number" name="spo2" id="spo2" min="5" class="form-control"
            placeholder="SpO2" value="90"
            required>
          </div>

          <div class="col-6 col-md-2">
            <input type="number" name="heartRate" id="heartRate" min="5" class="form-control"
            placeholder="Heart Rate" value="80"
            required>
          </div>
        </div> -->
                  <div class="col-12 form-group">
                    <h2>

                      <hr />
                    </h2>
                  </div>

                  <div class="row col-12 form-group">
                    <div class="col col-md-2">
                      <label for="jenis_pasien" class=" form-control-label">Tujuan
                        Pelayanan</label>
                    </div>

                    <div class="col-12 col-md-3">
                      <select name="tujuan_pelayanan" onchange="no_urut()" id="select" class="poli mdb-select colorful-select dropdown-info sm-form">
                        <?php foreach ($tupel as $value) : ?>
                          <option value="<?php echo $value->kode_tupel; ?>" <?php if (@$kunjungan['tujuan_pelayanan'] == $value->kode_tupel) {
                                                                              echo "selected";
                                                                            } ?>><?php echo $value->tujuan_pelayanan; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-12 col-md-3">
                      <div class="custom-control custom-radio m-l-10">
                        <input type="radio" id="kunj_sehat" name="kunjungansakit" value="0" class="kunjungansakit custom-control-input">
                        <label class="custom-control-label" for="kunj_sehat">Kunjungan Sehat</label>
                      </div>
                    </div>
                    <div class="col-12 col-md-3">
                      <div class="custom-control custom-radio m-l-10">
                        <input type="radio" id="kunj_sakit" checked name="kunjungansakit" value="1" class="kunjungansakit custom-control-input">
                        <label class="custom-control-label" for="kunj_sakit">Kunjungan Sakit</label>
                      </div>
                    </div>
                  </div>
                  <div class="row col-12 form-group">
                    <div class="col col-md-2">
                      <label for="no_antrian" class=" form-control-label">No Antrian
                        Sebelumnya</label>
                    </div>
                    <div class="col-12 col-md-10">
                      <input type="text" name="no_antrian" id="no_antrian" class="form-control" placeholder="no antrian" value="<?php echo $no_antrian; ?>" required>
                    </div>
                  </div>
                </div>

              </div>
              <input type="hidden" name="kdprovider" id="kdprovider" value="">
              <?php echo $this->Core->btn_input() ?>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">

  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">List
          Pasien</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X
        </button>
      </div>

      <div class="modal-body">
        <div class="table-responsive">
          <table id="tbl_pasien" class="table table-hover table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>No BPJS</th>
                <th>Nama Pasien</th>
                <th>Jenis Kelamin</th>
                <th>Umur</th>
                <th>alamat</th>
                <th>Telepon</th>
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
<div id="tambahpasien" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Pasien Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-window-close"></i></button>
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart('Pasien/insert'); ?>
        <?php echo @$error; ?>
        <?php $this->load->view('Pasien/form2') ?>
        <?php echo $this->Core->btn_input() ?>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>desain/assets/node_modules/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
  function select_rm() {
    var norm = $("#noRMkun").val();
    norm = pad(norm, 8);
    // alert(norm);
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>Pasien/searchrm/' + norm,
      data: {
        norm_pasien: norm
      },
      success: function(response) {
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
      url: '<?php echo base_url(); ?>Pasien/searchrma/' + norm,
      data: {
        norm_pasien: norm
      },
      dataType: 'json',
      success: function(response) {
        // alert(response);
        console.log(response);
        $('#alamatkun').val(response.alamat);
        $("#sumber_dana").html(response.sumber_dana);

        $("#bb").val(response.bb);
        $("#tb").val(response.tb);
        $("#prolanis").text(response.pstprol);
        $("#prb").text(response.pstprb);

        $("#namakun").val(response.nama);
        $("#no_bpjs").val(response.bpjs);
        $("#terakhir").val(response.terakhir);

        $("#kdprovider").val(response.kdprovider);
        if (response.status != 0) {
          // alert(response.message);
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
      url: '<?php echo base_url(); ?>Kunjungan/hitung_riwayat/' + noRM,
      success: function(response) {
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

  function pad(str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
  }

  function no_urut() {
    var poli = $(".poli option:selected").val();
    var jenis = $("#sumber_dana option:selected").val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>Kunjungan/no_urut/' + poli + "/" + jenis,
      data: {
        poli: poli
      },
      success: function(response) {
        $("#no_antrian").val(response);
      }
    });
  }

  function pilih_pasien(noRM, nama, alamat, jenis) {
    var noRM;
    var nama;
    var alamat;
    var jenis;
    $("#noRMkun").val(noRM);
    $("#namakun").val(nama);
    // alert(noRM);
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>Pasien/searchrma2/' + noRM,
      data: {
        norm_pasien: noRM
      },
      dataType: 'json',
      success: function(response) {
        // alert(response);
        // console.log(response);
        $('#alamatkun').val(response.alamat);
        $("#sumber_dana").html(response.sumber_dana);

        $("#no_bpjs").val(response.bpjs);
        $("#terakhir").val(response.terakhir);
        $("#bb").val(response.bb);
        $("#tb").val(response.tb);
        if (response.lingkar_perut != null || response.lingkar_perut < 0) {
          var lingkar_perut = response.lingkar_perut;
        } else {
          var lingkar_perut = 90;
        }
        $("#lingkarPerut").val(lingkar_perut);

        $("#prolanis").text(response.pstprol);
        $("#prb").text(response.pstprb);
        hitung_imt();

        if (response.status == 1) {
          $("#kdprovider").val(response.kdprovider);
          alert(response.message);
        } else if (response.status == 3) {
          alert(response.message);
        }
      }
    });
    // $("#alamatkun").val(alamat);
    cekkunjungan();
    // alert(jenis);
  }

  var table;
  $(document).ready(function() {
    $(document).on("click", ".kunjungansakit", function() {
      var data = $(this).val();
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>Kunjungan/ambil_poli',
        data: {
          polisakit: data
        },
        success: function(response) {
          // alert(response);
          $("#select").html(response);

        }
      });
    })

    //datatables
    cekkunjungan();
    var norm = $("#noRMkun").val();
    if (norm !== "") {
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>Pasien/searchrm/' + norm,
        data: {
          norm_pasien: norm
        },
        success: function(response) {
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
        url: '<?php echo base_url(); ?>Pasien/searchrma/' + norm,
        data: {
          norm_pasien: norm
        },
        dataType: 'json',
        success: function(response) {
          $('#alamatkun').val(response.alamat);
          $("#sumber_dana").html(response.sumber_dana);

          $("#no_bpjs").val(response.bpjs);
          $("#terakhir").val(response.terakhir);
          $("#prolanis").text(response.pstprol);
          $("#prb").text(response.pstprb);
          $("#bb").val(response.bb);
          $("#tb").val(response.tb);
          $("#kdprovider").val(response.kdprovider);
          // alert(response.sumber_dana);

          if (response.status != 0) {
            alert(response.message);
          }
        }
      });
    }


    table = $('#tbl_pasien').DataTable({

      "processing": true,
      "serverSide": true,
      "order": [],

      "ajax": {
        "url": "<?php echo site_url('Kunjungan/get_data_pasien') ?>",
        "type": "POST"
      },

      "columnDefs": [{
        "targets": [0],
        "orderable": false
      }]
    });

  });


  ! function($) {
    "use strict";

    var SweetAlert = function() {};

    //examples
    SweetAlert.prototype.init = function() {


        //Auto Close Timer
        $('#nasdopasid').click(function() {
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
  function($) {
    "use strict";
    $.SweetAlert.init()
  }(window.jQuery);

  $(document).ready(function() {
    $(document).on("click", ".cek_nobpjs", function() {
      var data = {
        'nobpjs': $("#noBPJS").val(),
      };
      if ($("#noBPJS").val() == "") {
        alert("Harap isi no bpjs");
      } else {
        myajax_request(base_url + "Pasien/cek_bpjs", data, function(res) {
          if (res.status == 1) {
            var data = res.res;
            $("#namapasien").val(data.nama);
            $("#tgl_lahir").val(data.tglLahir);
            $("#pekerjaan").val(data.jnsPeserta.nama);
            $("#telepon").val(data.noHP);
            // alert(data.nama);
            if (data.sex == "P") {
              $("#p").attr("checked", "checked");
              $("#l").removeAttr("checked");
            } else {
              $("#l").attr("checked", "checked");
              $("#p").removeAttr("checked");
            }
            alert(res.message);

          } else if (res.status == 2) {

            alert(res.message);
          } else {
            var data = res.res;
            $("#namapasien").val(data.nama);
            $("#tgl_lahir").val(data.tglLahir);
            $("#pekerjaan").val(data.jnsPeserta.nama);
            $("#telepon").val(data.noHP);
            // alert(data.nama);
            if (data.sex == "P") {
              $("#p").attr("checked", "checked");
              $("#l").removeAttr("checked");
            } else {
              $("#l").attr("checked", "checked");
              $("#p").removeAttr("checked");
            }
          }
        });
      }
    })
  })

  function hitung_imt() {

    var bb = parseInt($('#bb').val());
    var tb = parseInt($('#tb').val());

    if (bb > 0 && tb > 0) {
      var tb_in_meter = tb / 100;
      var imt = bb / (tb_in_meter * tb_in_meter);
      imt = Math.round(imt * 100) / 100;
    } else {
      imt = 0;
    }

    // console.log(imt);
    $('#imt').val(imt);
  }
</script>