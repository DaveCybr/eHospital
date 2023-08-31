<?php echo form_open('Penyakit/delete');?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

            <a href="" class="white-text mx-3">Penyakit</a>
            <div>
              <a href="<?php base_url(); ?>Penyakit/input" class="float-right">
                <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><i class="fas fa-pencil-alt mt-0"></i></button>
              </a>
            </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
            <table id="tbl_penyakit" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>kodeicdx</th>
                            <th>Nama Penyakit</th>
                            <th width="5%">Wabah</th>
                            <th width="5%">Nular</th>
                            <th width="5%">BPJS</th>
                            <th width="5%">Non-Spesialis</th>
                            <th width="15%">opsi</th>
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
<?php echo form_close();?>
<script type="text/javascript">

			var table;
			$(document).ready(function () {

				//datatables
				table = $('#tbl_penyakit').DataTable({

					"processing": true,
					"serverSide": true,
					"order": [],

					"ajax": {
						"url": "<?php echo site_url('Penyakit/get_data_penyakit')?>",
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
