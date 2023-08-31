<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <div>
              <!-- <button type="button" class="btn btn_hapus btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data"><i class="fas fa-trash-alt mt-0"></i></button> -->
              <!-- <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jumlah Item Terpilih"><span id="jumlah_pilih">0</span></button> -->
            </div>
            <a href="" class="white-text mx-3">Capaian Target Keluarga Binaan</a>
            <div>
              <!-- <a href="" class="float-right" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><i class="fas fa-pencil-alt mt-0"></i></button>
              </a> -->
              <button type="button" id="print" class="btn btn-outline-white btn-rounded btn-sm px-2 float-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print Data"><i class="fas fa-print mt-0"></i></button>
            </div>
      </div>
      <div class="card-body row">
        <div class="col-sm-3">
          <div class="row form-group">
              <div class="col col-md-12">
                <label for="nama" class=" form-control-label">Dokter Penanggung Jawab</label>
                <select class="mdb-select colorful-select dropdown-info md-form initialized" name="iddokter" id="iddokter">
                  <?php if ($_SESSION['nik'] == "199306182019021000" || $_SESSION['jabatan'] == "root"): ?>
                    <option value="">Semua</option>
                    <?php foreach ($dokter as $value): ?>
                      <option value="<?php echo $value->idkb_dokter ?>"><?php echo $value->nama ?></option>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <option value="<?php echo $this->ModelKBinaan->getDokter($_SESSION['nik'])->row_array()['idkb_dokter'] ?>"><?php echo $_SESSION['karyawan'] ?></option>
                  <?php endif; ?>

                </select>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="row form-group">
              <div class="col col-md-12">
                <label for="nama" class=" form-control-label">Tahun</label>
                <select class="mdb-select colorful-select dropdown-info md-form initialized" name="tahun" id="tahun">
                  <?php for ($i=2020; $i <= date("Y"); $i++) { ?>
                    <option value="<?php echo $i ?>" <?php echo $selbulan = (date("Y") == $i) ? "selected" : "" ;  ?>><?php echo $i ?></option>
                  <?php } ?>
                </select>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="row form-group">
              <div class="col col-md-12">
                <label for="nama" class=" form-control-label">Bulan</label>
                <select class="mdb-select colorful-select dropdown-info md-form initialized" name="bulan" id="bulan">
                  <option value="1" <?php echo $selbulan = (date("m") == 1) ? "selected" : "" ;  ?>>Januari</option>
                  <option value="2" <?php echo $selbulan = (date("m") == 2) ? "selected" : "" ;  ?>>Februari</option>
                  <option value="3" <?php echo $selbulan = (date("m") == 3) ? "selected" : "" ;  ?>>Maret</option>
                  <option value="4" <?php echo $selbulan = (date("m") == 4) ? "selected" : "" ;  ?>>April</option>
                  <option value="5" <?php echo $selbulan = (date("m") == 5) ? "selected" : "" ;  ?>>Mei</option>
                  <option value="6" <?php echo $selbulan = (date("m") == 6) ? "selected" : "" ;  ?>>Juni</option>
                  <option value="7" <?php echo $selbulan = (date("m") == 7) ? "selected" : "" ;  ?>>Juli</option>
                  <option value="8" <?php echo $selbulan = (date("m") == 8) ? "selected" : "" ;  ?>>Agustus</option>
                  <option value="9" <?php echo $selbulan = (date("m") == 9) ? "selected" : "" ;  ?>>September</option>
                  <option value="10"<?php echo $selbulan = (date("m") == 10) ? "selected" : "" ;  ?>>Oktober</option>
                  <option value="11"<?php echo $selbulan = (date("m") == 11) ? "selected" : "" ;  ?>>November</option>
                  <option value="12"<?php echo $selbulan = (date("m") == 12) ? "selected" : "" ;  ?>>Desember</option>
                </select>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <button onclick="printPasien()" type="button" name="button" class="btn btn-info">Cari</button>
        </div>
        <div class="table-responsive">

        </div>
      </div>
    </div>
  </div>
</div>


<div class="printableArea" hidden>

</div>
<script src="<?php echo base_url() ?>/desain/dist/js/pages/jquery.PrintArea.js" type="text/JavaScript"></script>
<script>
$(document).ready(function() {
    $("#print").click(function() {
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: close
        };
        $("div.printableArea").printArea(options);
    });
});
</script>

<script type="text/javascript">
$( document ).ready(function() {
  printPasien();
});

function kunjungan() {
  var tahun = $("#tahun").val();
  var bulan = $("#bulan").val();
  var iddokter = $("#iddokter").val();
  var tanggal = tahun+"-"+bulan;
  $.ajax({
      type  : 'POST',
      url   : '<?php echo base_url() ?>K_Binaan/KBPasien/filterPerawat',
      data  : {tanggal:tanggal, idkb:iddokter},
      success : function(response){
        $(".table-responsive").html(response);
      }
  });
}

function printPasien() {
  var tahun = $("#tahun").val();
  var bulan = $("#bulan").val();
  var iddokter = $("#iddokter").val();
  var tanggal = tahun+"-"+bulan;
  $.ajax({
      type  : 'POST',
      url   : '<?php echo base_url() ?>K_Binaan/KBPasien/printPasien',
      data  : {tanggal:tanggal, idkb:iddokter},
      success : function(response){
        $(".printableArea").html(response);
        kunjungan();
      }
  });
}

</script>
