<!-- modal small -->
			<div class="modal fade" id="modalruangan" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="smallmodalLabel">Daftar Ruangan</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="card">
								<div class="card-body card-block">
                      <table id="list_ruangan" class="table editable-table table-bordered table-striped m-b-0">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama ruangan</th>
                            <th>Opsi</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php $no=1; foreach ($ruangan as $value): ?>
                            <tr>
                              <td><?php echo $no++?></td>
                              <td><?php echo $value->namaruangan?></td>
                              <td>
                                <button type="button" norek="<?php echo $value->idruangan?>" namarek="<?php echo $value->namaruangan?>" class="ruangan btn btn-success btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pilih"><i class="fa fa-check"></i></button></a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
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
