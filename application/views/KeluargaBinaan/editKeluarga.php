<?php echo form_open_multipart('K_Binaan/KBPasien/update_pasien');?>
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <div>
              <!-- <button type="button" class="btn btn_hapus btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data"><i class="fas fa-trash-alt mt-0"></i></button> -->
              <!-- <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jumlah Item Terpilih"><span id="jumlah_pilih">0</span></button> -->
            </div>
            <a href="" class="white-text mx-3">Edit Keluarga Binaan</a>
            <div>
              <a href="" class="float-right" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><i class="fas fa-pencil-alt mt-0"></i></button>
              </a>
            </div>
      </div>
      <div class="card-body">
        <div class="col-sm-6">
          <div class="row form-group">
              <div class="col col-md-4">
                <label for="nik_dokter" class="form-control-label">NIK Perawat</label>
              </div>
              <div class="col-8 col-md-8">
                <input type="text" name="nik" id="nik" disabled class="form-control" value="<?php echo @$perawat['NIK']; ?>">
                <input type="hidden" name="idkb_perawat" id="idkb_perawat" class="form-control" value="<?php echo @$perawat['idkb_perawat']; ?>">
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
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                          <th>No.RM Pasien</th>
                          <th>Nama Pasien</th>
                          <th>Kepala Keluarga</th>
                          <th>Status Keluarga</th>
                          <th width="%5">Hapus</th>
                      </tr>
                  </thead>
                  <tbody id="insertKeluarga">
                    <?php foreach ($anggota as $val): ?>
                      <tr id="<?php echo $val->pasien_noRM ?>">
                        <td> <input type="hidden" name="norm[]" value="<?php echo $val->pasien_noRM ?>"><?php echo $val->pasien_noRM ?></td>
                        <td><?php echo $val->namapasien ?></td>
                        <td>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_kepala" id="radio<?php echo $val->pasien_noRM ?>" value="<?php echo $val->pasien_noRM ?>" required  <?php echo $retVal = ($val->pasien_noRM == $val->norm_kk) ? "checked" : "" ; ?> />
                            <label class="form-check-label" for="radio<?php echo $val->pasien_noRM ?>"> Kepala Keluarga </label>
                          </div>
                        </td>
                        <td>
                          <select class="mdb-selectbaru colorful-select dropdown-info md-form initialized" name="status_keluarga[]">'+
                            <option value="Suami" <?php echo $pilih = ($val->status_pasien == "Suami") ? "selected" : "" ; ?>>Suami</option>
                            <option value="Istri" <?php echo $pilih = ($val->status_pasien == "Istri") ? "selected" : "" ; ?>>Istri</option>
                            <option value="Anak"  <?php echo $pilih = ($val->status_pasien == "Anak") ? "selected" : "" ; ?>>Anak</option>
                            <option value="Saudara" <?php echo $pilih = ($val->status_pasien == "Saudara") ? "selected" : "" ; ?>>Saudara</option>
                          </select>
                        </td>
                        <td>
                          <!-- <button onclick="hapus('<?php echo $val->pasien_noRM ?>')" type="button=" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button> -->
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
              </table>
        </div>
        <button type="submit" name="button" class="btn btn-success">SIMPAN</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>

<div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">New message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div class="table-responsive">
                <table id="tbl_pasien" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <!-- <th>#</th> -->
                                <th>No Rekam Medis</th>
                                <th>Nama Pasien</th>
                                <th width="5%">Kelamin</th>
                                <th>Umur</th>
                                <th>alamat</th>
                                <th width="15%">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

function tambah(norm,nama) {
  var htmldrop = '<div class="form-check">'+
    '<input class="form-check-input" type="radio" name="status_kepala" id="radio'+norm+'" value="'+norm+'" required />'+
    '<label class="form-check-label" for="radio'+norm+'"> Kepala Keluarga </label>'+
  '</div>';
  var htmlst = '<select class="mdb-select2'+norm+' colorful-select dropdown-info md-form initialized" name="status_keluarga[]">'+
  '<option value="Suami">Suami</option>'+
  '<option value="Istri">Istri</option>'+
  '<option value="Anak">Anak</option>'+
  '<option value="Saudara">Saudara</option>'+
  '</select>';
  var html = "<tr id=\""+norm+"\">"+
  "<td><input type='hidden' name='norm[]' value='"+norm+"'>"+norm+"</td>"+
  "<td>"+nama+"</td>"+
  "<td>"+htmldrop+"</td>"+
  "<td>"+htmlst+"</td>"+
  "<td><button onclick=\"hapus('"+norm+"')\" type=\"button\" class=\"btn btn-sm btn-danger\"><i class=\"fas fa-trash\"></i></button></td>"+
  "</tr>";
  $("#insertKeluarga").append(html);
  $('.mdb-select'+norm).material_select();
  $('.mdb-select2'+norm).material_select();
}

function hapus(norm) {
  $("#"+norm).remove();
}

			var table;
			$(document).ready(function () {
        $('.mdb-selectbaru').material_select();

				//datatables
				table = $('#tbl_pasien').DataTable({

					"processing": true,
					"serverSide": true,
					"order": [],

					"ajax": {
						"url": "<?php echo site_url('K_Binaan/KBPasien/get_data_pasien/').$perawat['idkb_perawat']?>",
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

</script>
