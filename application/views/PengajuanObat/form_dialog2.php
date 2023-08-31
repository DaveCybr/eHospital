
<!-- modal small -->
			<div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="smallmodalLabel">Detail Nota</h5>
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
															 <img src="<?php echo base_url() ?>desain/assets/images/<?php echo $this->Core->logo_klinik()?>" style="max-width: 55px;"/>
															  <?php echo strtoupper($this->Core->nama_klinik())?>
															 </h2>



                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- info row -->
                          <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                              <br><br>No Nota ,
                              <address>
                                <strong id="no_nota">-</strong><br>
                              </address>
                              Supplier ,
                              <address>
                                <strong id="supplier">-</strong><br>
                              </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                              <br><br>No Nota Supplier ,
                              <address>
                                <strong id="no_nota_s">-</strong><br>
                              </address>
                              Tanggal Transaksi ,
                              <address>
                                <strong id="tgl_transaksi">-</strong><br>
                              </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                              <br><br>Tanggal Jatuh Tempo ,
                              <address>
                                <strong id="j_tempo">-</strong><br>
                              </address>
                              Status ,
                              <address>
                                <strong class="sts">-</strong><br>
                              </address>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </section>
                  <div class="table-responsive">
                      <table id="list_pembelian_obat" class="table editable-table table-bordered table-striped m-b-0">
                        <thead>
                          <tr>
                            <th>Kode Obat</th>
                            <th>Nama Obat</th>
                            <th>No Batch</th>
                            <th>Expired Date</th>
                            <th>Harga Beli</th>
                            <th>Jumlah</th>
                            <th>Diskon (%)</th>
                            <th>PPN (%)</th>
                            <th>Total Harga</th>
                          </tr>
                        </thead>
                        <tbody id="obat">
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6"><strong>TOTAL</strong></th>
                                <th id="t_disk">0 %</th>
                                <th id="t_ppn">0 %</th>
                                <th id="t_harga">Rp.0</th>
                            </tr>
                            <tr>
                                <th colspan="6"><strong>TOTAL TRANSAKSI (TOTAL HARGA+PPN 10%) - DISKON</strong></th>
                                <th colspan="3" id="bayar_final">Rp.0</th>
                            </tr>
                            <tr>
                                <th colspan="6"><strong>BAYAR</strong></th>
                                <th colspan="3" id="bayar">Rp.0</th>
                            </tr>
                            <tr>
                                <th colspan="6"><strong>SISA</strong></th>
                                <th colspan="3" id="sisa">Rp.0</th>
                            </tr>
                            <tr>
                                <th colspan="6"><strong>STATUS PEMBAYARAN</strong></th>
                                <th colspan="3" class="sts">Lunas</th>
                            </tr>
                        </tfoot>
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
