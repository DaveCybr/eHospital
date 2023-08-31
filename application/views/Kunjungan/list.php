<!-- <meta http-equiv="refresh" content="300"> -->
<?php echo form_open('Kunjungan/delete');
$jabatan = $_SESSION['jabatan'];
$resepsionis = strpos($jabatan, "resepsionis");
$this->load->view("vendor/autoload.php");
?>
<?php if ($resepsionis === 0) { ?>
  <style>
    .periksa {
      display: none;
    }
  </style>
<?php
} else { ?>
  <style>
    .hapus-kunjungan {
      display: none;
    }

    .ganti-kunjungan {
      display: none;
    }

    .edit-keluhan {
      display: none;
    }
  </style>
<?php
} ?>
<?php if ($resepsionis !== 0) : ?>
  <style>
    .add_pasien {
      display: none;
    }

    .text-header {
      font-size: 20px;
    }
  </style>
<?php endif; ?>
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <a href="" class="white-text mx-3 text-header">Kunjungan Pasien</a>
        <div>
          <!-- <a href="#" data-toggle="modal" data-target="#smallmodal" class="add_pasien">
            <button type="button" id="scan" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Scan QR Code"><h4><i class="fas fa-qrcode mt-0"></i></h4></button>
          </a> -->
          <a href="<?php base_url(); ?>Kunjungan/sinkronKunjungan" class="float-right">
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ambil Pendaftaran Web Antrian">Sinkron Kunjungan</button>
          </a>
          <a href="<?php base_url(); ?>Kunjungan/input" class="float-right add_pasien">
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru">
              <h4><i class="fas fa-pencil-alt mt-0"></i>
            </button>
          </a>
        </div>
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


        <ul class="nav nav-tabs customtab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home2" role="tab">
              <span class="hidden-sm-up">
                <i class="fas fa-user-clock"></i>
              </span>
              <span class="hidden-xs-down">Daftar Tunggu</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#profile2" role="tab">
              <span class="hidden-sm-up">
                <i class="fas fa-user-check"></i>
              </span>
              <span class="hidden-xs-down">Sudah Periksa</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#PCare" role="tab">
              <span class="hidden-sm-up">
                <i class="fas fa-user-check"></i>
              </span>
              <span class="hidden-xs-down">pendaftaran PCare</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#periksaPC" role="tab">
              <span class="hidden-sm-up">
                <i class="fas fa-user-check"></i>
              </span>
              <span class="hidden-xs-down">pemeriksaan PCare</span></a>
          </li>

        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active p-20" id="home2" role="tabpanel">
            <?php $this->load->view('Kunjungan/belum') ?>
          </div>
          <div class="tab-pane  p-20" id="profile2" role="tabpanel">
            <?php $this->load->view('Kunjungan/sudah') ?>
          </div>
          <div class="tab-pane  p-20" id="PCare" role="tabpanel">
            <?php $this->load->view('Kunjungan/daftarPCare') ?>
          </div>
          <div class="tab-pane  p-20" id="periksaPC" role="tabpanel">
            <?php $this->load->view('Kunjungan/pemeriksaanPCare') ?>
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
<!-- <div id="kunjungan_belum">
        asdaskdjaskdhakjshdkjah
      </div> -->
<?php echo form_close(); ?>
<?php echo $this->Core->Fungsi_JS_Hapus(); ?>
<script type="text/javascript">
  $(document).ready(function() {
    $("#loader").hide();
    $('#example_blm').DataTable({
        "columnDefs": [{
          "targets": [0],
          "visible": false,
          "searchable": false
        }]
      }


    );
    $('#example_sdh').DataTable({
      "columnDefs": [{
        "targets": [0],
        "visible": false,
        "searchable": false
      }]
    });
    $('#daftarPCare_table').DataTable();
    $('#periksa1_table').DataTable();
    $(document).on("click", ".panggilan_pasien", function() {
      var no_antrian = $(this).attr("antrian");
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>Antrian/panggil/',
        data: {
          antrian: no_antrian
        },
        beforeSend: function() {
          // $('#kunjungan_belum').hide();
          // $('#loader').show();
        },
        success: function(response) {
          alert(response);
          // $("#loader").hide();
          // $('#kunjungan_belum').show('medium');
          // $("#kunjungan_belum").html(response);
          // $('#example_blm').DataTable();
        }
      });
    })
  });


  function filter_kunjungan() {
    var tgl = $("#tanggal").val();

    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>Kunjungan/filter_belum/' + tgl,
      data: {
        filter_tgl: tgl
      },
      beforeSend: function() {
        $('#kunjungan_belum').hide();
        $('#loader').show();
      },
      success: function(response) {
        // console.log(response);
        $("#loader").hide();
        $('#kunjungan_belum').show('medium');
        $("#kunjungan_belum").html(response);
        $('#example_blm').DataTable();
      }
    });
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>Kunjungan/filter_sudah/' + tgl,
      data: {
        filter_tgl: tgl
      },
      beforeSend: function() {
        $('#kunjungan_sudah').hide();
        $('#loader').show();
      },
      success: function(response) {
        // alert(response);
        $("#loader").hide();
        $('#kunjungan_sudah').show('medium');
        $("#kunjungan_sudah").html(response);
        $('#example_sdh').DataTable();
      }
    });
  }
</script>
<!-- Central Modal Large Info-->
<div class="modal fade" id="ganti_tupel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <?php echo form_open(base_url() . "Kunjungan/ganti_tupel"); ?>
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Ganti Tujuan Pelayanan</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">

        <div class="row form-group">
          <div class="col col-md-">
            <label for="jenis_pasien" class=" form-control-label">Ganti Ke</label>
          </div>
          <div class="col-12 col-md-9">
            <?php foreach ($tupel as $value) : ?>
              <div class="custom-control custom-radio">
                <input type="radio" id="<?php echo $value->kode_tupel ?>" name="tupel" value="<?php echo $value->kode_tupel ?>" class="custom-control-input ganti_tupel" required <?php if ($value->kode_tupel == "UMU") : ?> checked <?php endif; ?>>

                <label class="custom-control-label" for="<?php echo $value->kode_tupel ?>"><?php echo $value->tujuan_pelayanan ?></label>
              </div>
            <?php endforeach; ?>


          </div>
        </div>
        <input type="hidden" name="nokun" class="ganti_nokun">

        <input type="hidden" name="no_rm" class="no_rm">
        <div class="row form-group">
          <div class="col col-md-3">
            <label for="no_antrian" class=" form-control-label">No Antrian
              Sebelumnya</label>
          </div>
          <div class="col-12 col-md-9">
            <input type="text" name="no_antrian" id="no_antrian" class="form-control" placeholder="no antrian" value="<?php echo $no_antrian; ?>" readonly>
          </div>
        </div>
        <div class="row form-group">
          <div class="col col-md-">
            <label for="jenis_pasien" class=" form-control-label">Ganti Pembayaran</label>
          </div>
          <div class="col-12 col-md-9">
            <?php foreach ($jenis_pasien as $value) : ?>
              <div class="custom-control custom-radio">
                <input type="radio" id="<?php echo $value->kode_jenis ?>" name="jenis" value="<?php echo $value->jenis_pasien ?>" class="custom-control-input" required <?php if ($value->kode_jenis == 1) : ?> checked <?php endif; ?>>

                <label class="custom-control-label" for="<?php echo $value->kode_jenis ?>"><?php echo $value->jenis_pasien ?></label>
              </div>
            <?php endforeach; ?>


          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-success waves-effect">Simpan</button>
        <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">CLOSE</a>
      </div>
      <?php echo form_close(); ?>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- Central Modal Large Info-->


<!-- Central Modal Large Info-->
<div class="modal fade" id="keluhan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <?php echo form_open(base_url() . "Kunjungan/edit_keluhan"); ?>
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Edit Keluhan</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <input type="hidden" name="nokun" class="ganti_nokun">
        <input type="hidden" name="no_rm" class="no_rm">
        <div class="row form-group">
          <div class="col col-md-3">
            <label for="no_antrian" class=" form-control-label">Keluhan</label>
          </div>
          <div class="col-12 col-md-9">
            <textarea class="form-control" placeholder="Keluhan" id="edit_keluhan" name="keluhan"></textarea>
          </div>
        </div>
        <!-- <div class="row form-group">
                  <div class="col col-md-3"></div>
                  <div class="col col-md-9">
                    Prolanis : <span id="prolanis"></span> Prb : <span id="prb"></span>
                  </div>
                </div>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="no_antrian" class=" form-control-label">BB</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="number" name="bb" id="editbb" class="form-control"
                    placeholder="BB" value="" onblur="hitung_imt()" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="no_antrian" class=" form-control-label">TB</label>
                    </div>
                    <div class="col-12 col-md-9">
                      <input type="number" name="tb" id="edit_tb" class="form-control"
                      placeholder="TB" value="" onblur="hitung_imt()" required>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="imt" class=" form-control-label">IMT</label>
                      </div>
                      <div class="col-12 col-md-9">
                        <input type="text" name="imt" id="imt" class="form-control"
                        placeholder="IMT" value="" required>
                      </div>
                    </div>

                    <div class="row form-group">
                      <div class="col col-md-3">
                        <label for="sistole" class=" form-control-label">Sistole</label>
                        </div>
                        <div class="col-12 col-md-9">
                          <input type="number" name="sistole" id="sistole" class="form-control"
                          placeholder="Sistole" value="" required>
                        </div>
                      </div>

                      <div class="row form-group">
                        <div class="col col-md-3">
                          <label for="diastole" class=" form-control-label">Diastole</label>
                          </div>
                          <div class="col-12 col-md-9">
                            <input type="number" name="diastole" id="diastole" class="form-control"
                            placeholder="Diastole" value="" required>
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-3">
                            <label for="nadi" class=" form-control-label">Nadi/Heart Rate</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <input type="number" name="nadi" id="nadi" class="form-control"
                              placeholder="Nadi/Heart Rate" value="" required>
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="rr" class=" form-control-label">RespRate</label>
                              </div>
                              <div class="col-12 col-md-9">
                                <input type="number" name="rr" id="rr" class="form-control"
                                placeholder="RespRate" value="" required>
                              </div>
                            </div>

                            <div class="row form-group">
                              <div class="col col-md-3">
                                <label for="spo2" class=" form-control-label">SpO2</label>
                                </div>
                                <div class="col-12 col-md-9">
                                  <input type="number" name="spo2" id="spo2" class="form-control"
                                  placeholder="SpO2" value="" required>
                                </div>
                              </div> -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-success waves-effect">Simpan</button>
          <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">CLOSE</a>
        </div>
        <?php echo form_close(); ?>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <!-- Central Modal Large Info-->

  <!-- Trigger the modal with a button -->
  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#riwayatKunjungan">Open Modal</button> -->




  <script>
    $(document).on("click", ".ganti_tupel", function() {
      var poli = $(this).val();
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>Kunjungan/no_urut/' + poli,
        data: {
          poli: poli
        },
        success: function(response) {
          $("#no_antrian").val(response);
        }
      })
    });
  </script>