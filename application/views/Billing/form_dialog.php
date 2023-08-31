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
                  <div class="table-responsive table table-striped">
				              <?php echo form_open_multipart(base_url().'Billing/tagihan');?>
				              <?php echo @$error;echo form_hidden('no_kunjungan', $this->uri->segment(3));?>
                        <table class="table" id="list_resep">
                        <thead>
                          <th>Kode Obat </th>
                          <th>Nama Obat </th>
                          <th>Harga</th>
                          <th>Jumlah</th>
                          <th>Total</th>
													<!-- <th>Jumlah Diambil</th> -->
                        </thead>
                        <tbody id="resep">
													<tr><td colspan="6"><h6>Resep</h6></td></tr>
													<?php foreach ($detail_resep as $data): ?>
														<tr>
														<td><input type="hidden" name="iddetail_resep[]" value="<?php echo $data->iddetail_resep?>">
															<input type="hidden" name="idobat[]" value="<?php echo $data->idobat?>"><?php echo $data->idobat?></td>
														<td><?php echo $data->nama_obat?></td>
														<td><input type="hidden" name="harga[]" id="harga_<?php echo $data->class="harga_resep";?>" value="<?php echo $data->harga?>"> <i>Rp.</i><?php echo number_format($data->harga,2,",",".")?></td>
														<td><input type="hidden" name="jumlah_awal[]" value="<?php echo $data->jumlah?>"><?php echo $data->jumlah?></td>
														<td id="t_total_v_<?php echo $data->iddetail_resep;?>"><input type="hidden" class="total_harga" name="total_harga[]" id="total_<?php echo $data->iddetail_resep;?>" value="<?php echo $data->total_harga?>"><i>Rp.</i><?php echo number_format($data->total_harga,2,",",".")?></td>
														<!-- <td><input type='number' name='jumlah_akhir[]' id="<?php echo $data->iddetail_resep;?>" class="form-control edit_jumlah" value="<?php echo $data->jumlah?>"></td> -->
													</tr>
													<?php endforeach; ?>
													<?php if (!empty($detail_bhp)): ?>
														<tr><td colspan="6"><h6>Bahan Habis Pakai</h6></td></tr>
														<?php foreach ($detail_bhp as $data): ?>
															<tr>
															<td><?php echo $data->idobat?></td>
															<td><?php echo $data->nama_obat?></td>
															<td><i>Rp.</i><?php echo number_format($data->harga,2,",",".")?></td>
															<td><?php echo $data->jumlah?></td>
															<td><i>Rp.</i><?php echo number_format($data->total_harga,2,",",".")?></td>
															<td></td>
														</tr>
														<?php endforeach; ?>
													<?php endif; ?>
                        </tbody>
                      	</table>
												<p class="pull-left">Grand Total : <input type="hidden" id="grand_total" value="<?php echo $total_resep;?>"><i>Rp</i> <?php echo number_format($total_resep,2,",",".")?></p>
												<!-- <button type="submit" name="simpan" class="btn btn-success pull-right">Simpan</button> -->
											</form>
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
	<script>
		// $(document).on('keyup','.edit_jumlah',function(){
		// 	var id = $(this).attr('id');
		// 	var total_s = parseInt($(this).val())*parseInt($("#harga_"+id).val());
		// 	$("#total_"+id).val(total_s);
		// 	$("#t_total_V_"+id).html("<i>Rp.</i>"+total_s);
		// 	var grand_total = [];
		// 	$('.total_harga').each(function(){
    //    grand_total.push($(this).val());
    //   });
		// 	var total =0;
		// 	for(var i=0;i<grand_total.length;i++){
    //       total = parseInt(total)+parseInt(grand_total[i]);
    //   }
		// 	// alert(harga);
		// 	// total = $(this).val()*harga;
		// 	alert(total);
		// });
	</script>
