<?php echo form_open_multipart('APO/Kunjungan/insert'); ?>
<?php echo @$error; ?>
<div class="row p-5">
  <div class="col-lg-12 col-xlg-12 col-md-12">
    <div class="col-xl-12">
      <div class="card card-cascade narrower z-depth-1">
        <div class="view view-cascade gradient-card-header aqua-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

              <h4 id="info"><a href="#" class="white-text mx-3"><i class="fas fa-stethoscope"></i> Pendaftaran Pasien Online</a></h4>

        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-xl-3 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">No RM Pasien</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="pasien_noRM" id="pasien_noRM" class="form-control" placeholder="pasien_noRM" value="<?php echo $_SESSION['noRM'] ?>" required="" readonly="">

                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Nama Pasien</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo $_SESSION['nama'] ?>" required="" readonly="">

                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">No Bpjs</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="nomor bpjs" value="<?php echo @$_SESSION['noBPJS'] ?>" required="" readonly="">

                </div>
              </div>
            </div>

            <div class="col-md-6 col-xl-3 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Tanggal :</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="date" name="tgl" id="tgl" class="form-control" placeholder="Tanggal" value="<?php echo date("Y-m-d") ?>" required="" readonly="">

                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Jenis Pasien</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <select name="jenis_kunjungan" id="select" class="form-control mdb-select">
                      <?php foreach ($jenis_pasien as $value): ?>
                        <option value="<?php echo $value->kode_jenis;?>" <?php if ($value->kode_jenis == 7 && $_SESSION['jenis'] == 1) {
                          echo "selected";
                        }?>><?php echo $value->jenis_pasien;?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Pembayaran</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <select name="jenis_pembayaran" id="select" class="form-control mdb-select">
                      <?php foreach ($jenis_pasien as $value): ?>
                        <option value="<?php echo $value->kode_jenis;?>" <?php if ($value->kode_jenis == 7 && $_SESSION['jenis'] == 1) {
                          echo "selected";
                        }?>><?php echo $value->jenis_pasien;?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Jenis Kunjungan</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <select name="jenis_kunjungan" id="jenis_kunjungan" class="form-control mdb-select jenis_kunjungan" onchange="jenis_kunjungan_on()">
                      <option value="1">Kunjungan Sakit</option>
                      <option value="0">Kunjungan Sehat</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Tujuan Poli</label>
                <div class="input-group mb-3 form_jenis_kunjungan">

                </div>
              </div>
            </div>
            <div class="col-md-2 col-xl-2 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">No Antrian Terakhir</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="no_antrian" id="no_antrian" class="form-control" placeholder="nokun" value="26" required="" readonly="">

                </div>
              </div>
            </div>

            <div class="col-md-6 col-xl-6 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Keluhan</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="keluhan" id="keluhan" class="form-control" placeholder="Keluhan Pasien" value="" required="">

                </div>
              </div>
            </div>
            <div class="col-md-2 col-xl-2 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Berat Badan</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="bb" id="bb" class="form-control" placeholder="Berat Badan (Kg)" value="" required="">

                </div>
              </div>
            </div>
            <div class="col-md-2 col-xl-2 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Tinggi Badan</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="tb" id="tb" class="form-control" placeholder="Tinggi Badan (cm)" value="" required="">

                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <?php echo $this->Core->btn_input() ?>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
$(document).ready(function () {
  no_urut();
  jenis_kunjungan_on();
});


function no_urut() {
  var poli = $(".tujuan_pelayanan option:selected").val();
  // alert(poli);
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url();?>Kunjungan/no_urut/' + poli,
    data: {poli: poli},
    success: function (response) {
      $("#no_antrian").val(response);
    }
  });
}

function jenis_kunjungan_on() {
  var jenis = $("#jenis_kunjungan option:selected").val();
  // alert(jenis);
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url();?>APO/Kunjungan/jenis_pelayanan/' + jenis,
    data: {jenis: jenis},
    success: function (response) {
      $(".form_jenis_kunjungan").html(response);
      $('.tujuan_pelayanan').material_select();
    }
  });
}
</script>
