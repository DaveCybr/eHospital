<!-- modal small -->
			<div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="smallmodalLabel">Daftar Batch Obat</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="card">
								<div class="card-body card-block">
                  <section class="invoice">
                          <!-- title row -->
                          <div class="row">
                            <div class="col-xs-12">
                              <h2 class="page-header">
                                <img src="<?php echo base_url(); ?>desain/assets/images/kdtg.png" style="max-width: 55px;"/> Klinik Dokterku
                              </h2>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- info row -->
                          <div class="row invoice-info">
                            <div class="col-sm-12 invoice-col"><br>
                              <h4>Daftar Batch Tersedia Dari Obat <span id="nama_obat" ></span></h4><br>
                            </div>
                          <!-- /.row -->
                        </section>
                  <div class="table-responsive">
                      <table id="tBatch" class="table editable-table table-bordered table-striped m-b-0">
                        <thead>
                          <tr>
                            <th>No Batch</th>
                            <th>Expired Date</th>
                            <th>Jumlah Resep</th>
                            <th>Stok Tersedia</th>
                            <th>Jumlah Diberikan</th>
                            <th>Opsi</th>
                          </tr>
                        </thead>
                        <tbody id="tabel_batch" >
                        </tbody>

                      </table>
                  </div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
								<button class="btn btn-danger btn-md pull-right" data-dismiss="modal">close</button>
						</div>
			</div>
		</div>
	</div>
			<!-- end modal small -->
