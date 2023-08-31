<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <?php echo form_open_multipart('Periksa/input_ditin');?>
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>PASIEN</strong>
              <small> Form</small>
            </div>
            <div class="card-body card-block">

              <?php echo @$error;?>

              <div class="row form-group">
                <div class="col col-md-2">
                  <label for="nokun" class=" form-control-label">NO.PEMERIKSAAN :</label>
                </div>
                <div class="col-12 col-md-4">
                  <input type="text" name="nopem" id="nopem" class="form-control" placeholder="nopem" value="<?php echo $this->uri->segment(3) ?>" required readonly>
                </div>
                <div class="col col-md-1">
                  <label for="tanggal" class=" form-control-label">Tanggal</label>
                </div>
                <div class="col-12 col-md-4">
                  <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo date('Y-m-d'); ?>" required readonly>
                </div>
              </div>

              <div class="row form-group">
                <div class="col col-md-2">
                  <label for="norm" class=" form-control-label">Pasien :</label>
                </div>
                <div class="col-12 col-md-3">
                  <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" required readonly>
                </div>
                <div class="col-12 col-md-4">
                  <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo @$pasien['namapasien']; ?>" required readonly>
                </div>
                <div class="col-12 col-md-3">
                  <input type="text" name="jenis_kunjungan" id="jenis_kunjungan" class="form-control" placeholder="jenis_kunjungan" value="<?php echo @$jenispasien['jenis_pasien']; ?>" required readonly>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>




      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>DIAGNOSA</strong>
              <small>SubForm</small>
            </div>
            <div class="card-body card-block">
              <div class="row form-group">
                <div class="col-6">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#scrollmodal"> <i class="fa fa-search"></i> Tambah Diagnosa</button>
                </div>
              </div>
              <div class="table-responsive table table-striped">
                <table class="table color-table warning-table" id="diagnosa">
                  <thead>
                    <th width="15%" class="text-right">Kode ICDX</th>
                    <th>Penyakit</th>
                    <th width="27%">Status Penyakit</th>
                    <th width="10%"><i class="fa fa-gear"></i></th>
                  </thead>
                  <tbody id="diagnosa">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>TINDAKAN</strong>
              <small>SubForm</small>
            </div>
            <div class="card-body card-block">
              <div class="row form-group">
                <div class="col-12 col-md-6 row">
                  <div class="col-4">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modaljapel"> <i class="fa fa-search-plus"></i> TAMBAH JASA </button>
                  </div>
                </div>
              </div>
              <div class="table-responsive table table-striped">
                <table class="table color-table info-table" id="s_jasa">
                  <thead>
                    <th width="15%" class="text-right">Kode Jasa</th>
                    <th>Nama Jasa</th>
                    <th>Harga Jasa</th>
                    <th width="10%"><i class="fa fa-gear"></i></th>
                  </thead>
                  <tbody id="jasa">
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>Bahan Habis Pakai</strong>
              <small>SubForm</small>
            </div>
            <div class="card-body card-block">
              <div class="table-responsive table table-striped">
                <table class="table color-table success-table" id="bhp">
                  <thead>
                    <th>Kode / Nama Obat</th>
                    <th>Default Pemakaian</th>
                    <th>No Batch</th>
                    <th width="10%"><i class="fas fas-gear"></i>Opsi</th>
                  </thead>
                  <tbody id="default_bhp">
                  </tbody>
                </table>
              </div>

            </div>
            <!-- <div class="card-footer"> -->
            <?php echo $this->Core->btn_input(); ?>
            <!-- </div> -->
          </div>
        </div>
      </div>


      <?php echo form_close(); ?>

    </div>
  </div>
</div>
</div>
</div>

<div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scrollmodalLabel">LIST PENYAKIT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="penyakit" class="table table-borderless table-striped">
            <thead>
              <tr>
                <th width="10%">#</th>
                <th width="10%">kodeicdx</th>
                <th>Nama Penyakit</th>
                <th>Nama Penyakit (Indonesia)</th>
                <th>Wabah</th>
                <th width="%">Nular</th>
                <th width="%">BPJS</th>
                <th width="%">Non-Spesialis</th>
                <th width="%">opsi</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modaljapel" tabindex="-1" role="dialog" aria-labelledby="modaljapelLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scrollmodalLabel">List Jasa Pelayanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="example" class="table table-hover table-borderless table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Kode</th>
                <th>Nama Jasa Pelayanan</th>
                <th>harga </th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach ($modaljapel as $data) {?>
                <?php $id_check = $data->kode_jasa;
                ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data->kode_jasa?></td>
                  <td><?php echo $data->nama?></td>
                  <td><?php echo "Rp. ".number_format($data->hrg_1,0,",",".")?></td>
                  <td><button type="button"
                    onclick="select_jasa('<?php echo $data->kode_jasa?>', '<?php echo $data->nama?>', '<?php echo $data->hrg_1; ?>', '<?php echo $data->jasa_dokter_1; ?>', '<?php echo $data->jasa_perawat_1; ?>','<?php echo $data->jasa_admin_1; ?>', '<?php echo $data->jasa_resepsionis_1; ?>' )"
                    class="btn btn-circle btn-primary" data-toggle="tooltip" data-placement="right" data-original-title="pilih" data-dismiss="modal">
                    <i class="fas fa-edit"></i>
                  </button>
                </td>
              </tr>
              <?php
              $no++;
            }?>
          </tbody>

        </table>
      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">

$(document).ready(function() {

  //datatables
  var table = $('#penyakit').DataTable({

    "processing": true,
    "serverSide": true,
    "order": [],

    "ajax": {
      "url": "<?php echo site_url('Periksa/get_data_penyakit')?>",
      "type": "POST"
    },


    "columnDefs": [
      {
        "targets": [ 0 ],
        "orderable": false,
      },
    ],

  });

});

function select_diagnosa(kode,sakit) {
  var kode;
  var sakit;
  var markup = "<tr>" +
  "<td class='text-right'><input hidden value='"+ kode +"' name='kode_penyakit[]'>"+ kode +"</td>" +
  "<td><input hidden value='"+ sakit +"' name='sakit[]'>"+ sakit +"</td>" +
  "<td><select class='form-control' name='status_penyakit[]'> " +
  "<option value='Baru'>Baru</option> "+
  "<option value='Lama'>Lama</option>"+
  "<option value='Kunjungan Kasus Lama'>Kunjungan Kasus Lama</option>"+
  "</select></td>" +
  "<td><button type=\"button\" onclick='deleteRowdiag(this)' class=\"btn-danger btn btn-circle\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Lab\"><i class=\"fa fa-trash\"></i></button></td>" +
  "</tr>";
  $("tbody#diagnosa").append(markup);
}

function deleteRowdiag(r) {
  var i = r.parentNode.parentNode.rowIndex;
  document.getElementById("diagnosa").deleteRow(i);
}


var list_jasa = [];
function select_jasa(kode, jasa, harga, japeldokter, japelperawat, japeladmin, japelresepsionis) {
  if (list_jasa.indexOf(kode) > -1) {
    alert("Jasa ini telah ditambahkan sebelumnya");
  }else{
    var kode;
    var jasa;
    var harga;
    var japeldokter;
    var japelperawat;
    var japeladmin;
    var japelresepsionis;
    var markup = "<tr>" +
    "<td class='text-right'><input hidden value='"+ kode +"' name='kode_jasa[]'>"+ kode +"</td>" +
    "<td><input hidden value='"+ jasa +"' name='jasa[]'>"+ jasa + "</td>" +
    "<td><input hidden value='"+ harga +"' name='harga[]'>"+ harga +"<input hidden value='"+ japeldokter +"' name='japeldokter[]'><input hidden value='"+ japelperawat +"' name='japelperawat[]'><input hidden value='"+ japeladmin +"' name='japeladmin[]'><input hidden value='"+ japelresepsionis +"' name='japelresepsionis[]'></td>" +
    "<td><button id='"+kode+"' type=\"button\" onclick='deleteRow(this)' class=\"btn-danger hapus_jasa btn btn-circle\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Jasa\"><i class=\"fa fa-trash\"></i></button></td>" +
    "</tr>";
    $("tbody#jasa").append(markup);
    $.ajax({
      type  : 'POST',
      url   : '<?php echo base_url()."/Periksa/get_bhp"?>',
      data  : {kode:kode},
      success : function(response){
        // alert(response);
        if (response!='') {
          $("#default_bhp").append(response);
          $(".select"+kode).material_select();
        }
      }
    })
    list_jasa.push(kode);
  }

}
$(document).on("click",".hapus_jasa",function(){
  var row = (this);
  var id = $(this).attr("id");
  var index = row.parentNode.parentNode.rowIndex;
  var index_array = index-1;
  list_jasa.splice(index_array, 1);
  $(".bhp"+id).remove();
});

function deleteRow(r) {
  var i = r.parentNode.parentNode.rowIndex;
  document.getElementById("s_jasa").deleteRow(i);
}

function deleteBhp(r) {
  var i = r.parentNode.parentNode.rowIndex;
  document.getElementById("bhp").deleteRow(i);
}


</script>
