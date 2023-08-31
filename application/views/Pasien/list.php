<?php echo form_open('Pasien/delete');?>
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

            <a href="" class="white-text mx-3">Data Pasien</a>
            <div>
              <a href="<?php base_url(); ?>Pasien/input" class="float-right">
              <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><i class="fas fa-pencil-alt mt-0"></i></button>
            </a>
            </div>
      </div>
      <div class="card-body">
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

                            <th>kunjungan terakhir</th>
                            <th width="15%">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo form_close();?>
<?php echo $this->Core->Fungsi_JS_Hapus(); ?>
<script type="text/javascript">

			var table;
			$(document).ready(function () {

				//datatables
				table = $('#tbl_pasien').DataTable({

					"processing": true,
					"serverSide": true,
					"order": [],

					"ajax": {
						"url": "<?php echo site_url('Pasien/get_data_pasien')?>",
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
