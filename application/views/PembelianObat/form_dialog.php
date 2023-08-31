<!-- modal small -->
			<div class="modal fade" id="smallmodal" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="smallmodalLabel">Pembelian Obat baru</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="card">
								<div class="card-body card-block">
									<div class="row form-group">
													<div class="col col-md-3">
														<label for="nama_obat" class=" form-control-label">Nama Obat</label>
													</div>
													<div class="col-12 col-md-9">
															<select name="nama_obat" id="search_obat" class="form-control">
																	<option value="">-- Cari Obat --</option>
																	<?php foreach ($obat as $value): ?>
																		<option value="<?php echo $value->idobat;?>" <?php if (@$pembelian_obat['obat_idobat']==$value->idobat) {
																			echo "selected";
																		}?>><?php echo $value->idobat."-".$value->nama_obat;?>
																	</option>
																	<?php endforeach; ?>
															</select>
													</div>
									</div>
									<div class="row form-group">
													<div class="col col-md-3">
														<label for="no_batch" class=" form-control-label">No Batch</label>
													</div>
													<div class="col-12 col-md-9">
															<input type="text" name="no_batch" id="no_batch" class="form-control" placeholder="xxxxxx" value="">
													</div>
									</div>
									<div class="row form-group">
													<div class="col col-md-3">
														<label for="tgl_ex" class=" form-control-label">Tanggal Expired</label>
													</div>
													<div class="col-12 col-md-9">
															<input type="date" name="tgl_ex" id="tgl_ex" class="form-control" placeholder="" value="">
													</div>
									</div>
									<div class="row form-group">
													<div class="col col-sm-12 col-md-3">
														<label for="hrg_bl" class=" form-control-label">Satuan Obat</label>
													</div>
													<div class="col-sm-12 col-md-3">
														<select name="satuan_obat" id="satuan_obat" class="form-control">
															<option value="">-- Satuan Obat --</option>
														</select>
													</div>

													<div class="col-sm-12 col-md-3">
															<input type="number" name="hrg_bl" id="hrg_bl" class="form-control" placeholder="0" value="">
															<small class="form-text text-muted">Harga Beli Terakhir</small>
													</div>
									</div>
									<div class="row form-group">
													<div class="col col-md-3">
														<label for="jml" class=" form-control-label">Jumlah</label>
													</div>
													<div class="col-12 col-md-9">
															<input type="number" name="jml" id="jml" class="form-control" placeholder="0" value="">
													</div>
									</div>
									<div class="row form-group">
													<div class="col col-md-3">
														<label for="dis" class=" form-control-label">Diskon</label>
													</div>
													<div class="col-12 col-md-9">
															<input type="number" name="dis" id="dis" class="form-control" placeholder="0" value="">
													</div>
									</div>
									<div class="row form-group">
													<div class="col col-md-3">
														<label for="ppn_brng" class=" form-control-label">PPN (10%)</label>
													</div>
													<div class="col-12 col-md-9">
															<input type="number" name="ppn_brng" id="ppn_brng" class="form-control" placeholder="0" value="" readonly>
													</div>
									</div>
									<button type="button" id="add_obat" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Tambahkan</button>
								</div>
							</div>
						</div>
			</div>
		</div>
	</div>
			<!-- end modal small -->
