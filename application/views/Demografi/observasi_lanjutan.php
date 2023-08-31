<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
          <div>
            </div>
            <a href="" class="white-text mx-3">Observasi Lanjutan</a>
            <div>
            </div>
      </div>
      <div class="card-body">
        <div class="row form-group">
          <div class="col col-md-2">
            <label for="nokun" class=" form-control-label">NO.Kunjungan :</label>
          </div>
          <div class="col-12 col-md-4">
            <input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$kunjungan['no_urutkunjungan']; ?>" required readonly>
          </div>
          <div class="col col-md-1">
            <label for="tanggal" class=" form-control-label">Tanggal</label>
          </div>
          <div class="col-12 col-md-4">
            <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo @$kunjungan['tgl']; ?>" required readonly>
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
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header young-passion-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
          <div>
            </div>
            <a href="" class="white-text mx-3">Observasi Lanjutan</a>
            <div>
              <a data-toggle="modal" data-target="#responsive-modal" class="float-right">
                <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><i class="fas fa-pencil-alt mt-0"></i></button>
              </a>
            </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-striped table-bordered">
              <thead>
                  <tr>
                      <th width="4%">#</th>
                      <th>Tanggal / Jam</th>
                      <th>GCS</th>
                      <th>TD</th>
                      <th>N</th>
                      <th>RR</th>
                      <th>S</th>
                      <th>Sat</th>
                      <th>Keluhan</th>
                      <!-- <th width="%5">opsi</th> -->
                  </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($observasi as $data):
                  $id_check = $data->idobservasi;?>
                  <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $data->tgl." ".$data->jam; ?></td>
                      <td><?php echo $data->gcs; ?></td>
                      <td><?php echo $data->td; ?></td>
                      <td><?php echo $data->n; ?></td>
                      <td><?php echo $data->rr; ?></td>
                      <td><?php echo $data->s; ?></td>
                      <td><?php echo $data->sat; ?></td>
                      <td><?php echo $data->keluhan; ?></td>
                  </tr>
                <?php $no++;  endforeach; ?>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <?php echo form_open_multipart('Asesmen/insert_Observasi'); ?>
  <input type="hidden" name="pasien"  value="<?php echo @$pasien['noRM']; ?>" required readonly>
  <input type="hidden" name="kunjungan" value="<?php echo @$kunjungan['no_urutkunjungan']; ?>" required readonly>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
              <?php echo @$error; ?>
                  <div class="card card-cascade narrower z-depth-1">
                    <div class="view view-cascade gradient-card-header young-passion-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                        <div></div>
                          <a href="" class="white-text mx-3">Observasi Lanjutan</a>
                          <div></div>
                    </div>
                    <div class="card-body row">
                      <div class="col-md-12 col-xl-6">
                        <div class="form-group animated flipIn">
                          <label for="exampleInputuname">Tanggal</label>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="ti-date"></i></span>
                            </div>
                            <input type="date" name="tanggal" class="form-control tanggalku" value="<?php echo date("Y-m-d") ?>" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-xl-6">
                        <div class="form-group animated flipIn">
                          <label for="exampleInputuname">Jam</label>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="ti-clock"></i></span>
                            </div>
                            <input type="time" name="jam"class="form-control" value="<?php echo date("H:i:s") ?>" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-xl-6">
                        <div class="form-group animated flipIn">
                          <label for="exampleInputuname">GCS</label>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="ti-clock"></i></span>
                            </div>
                            <input type="text" name="gcs"class="form-control" placeholder="GCS" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-xl-6">
                        <div class="form-group animated flipIn">
                          <label for="exampleInputuname">TD</label>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="ti-clock"></i></span>
                            </div>
                            <input type="text" name="td" class="form-control" placeholder="td" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-xl-6">
                        <div class="form-group animated flipIn">
                          <label for="exampleInputuname">N</label>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="ti-clock"></i></span>
                            </div>
                            <input type="text" name="n" class="form-control" placeholder="n" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-xl-6">
                        <div class="form-group animated flipIn">
                          <label for="exampleInputuname">RR</label>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="ti-clock"></i></span>
                            </div>
                            <input type="text" name="rr" class="form-control" placeholder="rr" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-xl-6">
                        <div class="form-group animated flipIn">
                          <label for="exampleInputuname">S</label>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="ti-clock"></i></span>
                            </div>
                            <input type="text" name="s" class="form-control" placeholder="s" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-xl-6">
                        <div class="form-group animated flipIn">
                          <label for="exampleInputuname">Sat</label>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="ti-clock"></i></span>
                            </div>
                            <input type="text" name="sat" class="form-control" placeholder="sat" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-xl-12">
                        <div class="form-group animated flipIn">
                          <label for="exampleInputuname">Keluhan</label>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="ti-clock"></i></span>
                            </div>
                            <input type="text" name="keluhan" class="form-control" placeholder="keluhan pasien" required>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
