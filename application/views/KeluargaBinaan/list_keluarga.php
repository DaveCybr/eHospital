<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <div>
              <!-- <button type="button" class="btn btn_hapus btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data"><i class="fas fa-trash-alt mt-0"></i></button>
              <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jumlah Item Terpilih"><span id="jumlah_pilih">0</span></button> -->
            </div>
            <a href="" class="white-text mx-3">Perawat Keluarga Binaan</a>
            <div>
              <a href="<?php echo base_url() ?>K_Binaan/KBPasien/inputKeluarga/<?php echo $perawat['idkb_perawat'] ?>" class="float-right">
                <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><i class="fas fa-pencil-alt mt-0"></i></button>
              </a>
            </div>
      </div>
      <div class="card-body row">
        <div class="col-sm-6">
          <div class="row form-group">
              <div class="col col-md-4">
                <label for="nik_dokter" class="form-control-label">NIK Perawat</label>
              </div>
              <div class="col-8 col-md-8">
                <input type="text" name="nik" id="nik" disabled class="form-control" value="<?php echo @$perawat['NIK']; ?>">
              </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row form-group">
              <div class="col col-md-4">
                <label for="nama" class=" form-control-label">Nama Perawat</label>
              </div>
              <div class="col-8 col-md-8">
                <input type="text" name="nama" id="nama" disabled class="form-control" value="<?php echo @$perawat['nama']; ?>">
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="row form-group">
              <div class="col col-md-12">
                <label for="nama" class=" form-control-label">Status Kunjungan</label>
                <select class="mdb-select colorful-select dropdown-info md-form initialized" name="status_kunjungan" id="status_kunjungan">
                  <option value="1">Semua</option>
                  <option value="2">Sudah Berkunjung</option>
                  <option value="3">Belum Dikunjungi</option>
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
          <button onclick="filter()" type="button" name="button" class="btn btn-info">Cari</button>
        </div>
        <div class="filter row">

        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalDiagnosa" tabindex="-1" role="dialog" aria-labelledby="ModalDiagnosaLabel1">
    <div class="modal-dialog modal-fluid" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalDiagnosaLabel1">Riwayat Pasien</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body filterDiagnosa">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
var table;
$(document).ready(function () {
  filter();
});

// function kunjungan(idbinaan, nik) {
//   $.ajax({
//       type  : 'POST',
//       url   : '<?php echo base_url() ?>K_Binaan/KBPasien/insert_kunjungan',
//       data  : {id:idbinaan, nik:nik},
//       success : function(response){
//         // alert(response);
//           if (response == 1) {
//             // alert("Berhasil");
//             var html = '<button type="button" class="btn btn-sm aqua-gradient">'+
//                           '<i class="fas fa-check"></i> Sudah Terkunjungi'+
//                         '</button>';
//             $("#col"+idbinaan).html(html);
//           }else {
//             alert("Gagal");
//           }
//       }
//   });
// }

function filter() {
  var tahun = $("#tahun").val();
  var bulan = $("#bulan").val();
  var status_kunjungan = $("#status_kunjungan").val();
  var tanggal = tahun+"-"+bulan;
  $.ajax({
      type  : 'POST',
      url   : '<?php echo base_url() ?>K_Binaan/KBPasien/filter_keluarga/<?php echo $perawat['idkb_perawat'] ?>',
      data  : {tanggal:tanggal, status_kunjungan:status_kunjungan},
      success : function(response){
        $(".filter").html(response);
        makeTabel();
      }
  });
}

function filterDiagnosa(norm) {
  // alert(norm);
  $.ajax({
      type  : 'POST',
      url   : '<?php echo base_url() ?>K_Binaan/KBPasien/filter_diagnosa/'+norm,
      data  : {},
      success : function(response){
        // alert(response);
        $(".filterDiagnosa").html(response);
      }
  });
}
function filterKunjungan(norm) {
  // alert(norm);
  $.ajax({
      type  : 'POST',
      url   : '<?php echo base_url() ?>K_Binaan/KBPasien/filter_kunjungan/'+norm,
      data  : {},
      success : function(response){
        // alert(response);
        $(".filterDiagnosa").html(response);
      }
  });
}

function makeTabel() {
  var table = $('#TablePasien').DataTable({
      "columnDefs": [{
          "visible": false,
          "targets": 2
      }],
      "order": [
          [2, 'asc']
      ],
      "displayLength": 25,
      "drawCallback": function(settings) {
          var api = this.api();
          var rows = api.rows({
              page: 'current'
          }).nodes();
          var last = null;
          api.column(2, {
              page: 'current'
          }).data().each(function(group, i) {
              if (last !== group) {
                  $(rows).eq(i).before('<tr class="group"><td colspan="99">' + group + '</td></tr>');
                  last = group;
              }
          });
      }
  });
}
</script>
