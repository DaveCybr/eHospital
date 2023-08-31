

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <div>
              <!-- <button type="button" class="btn btn_hapus btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data"><i class="fas fa-trash-alt mt-0"></i></button> -->
              <!-- <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jumlah Item Terpilih"><span id="jumlah_pilih">0</span></button> -->
            </div>
            <a href="" class="white-text mx-3">Dokter Penanggung Jawab</a>
            <div>
              <a href="" class="float-right" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><i class="fas fa-pencil-alt mt-0"></i></button>
              </a>
            </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                        <th width="10%">#
                          <!-- <input type="checkbox" class="form-check-input select-all" id="tableMaterialChec">
                        <label class="form-check-label" for="tableMaterialChec"></label> -->
                        </th>
                        <th>NIK</th>
                          <th>Nama</th>
                          <!-- <th>Jabatan</th>-->
                          <th>Anggota</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach ($dokter as $data_pegawai):
                      $id_check = $data_pegawai->idkb_dokter;?>
                      <tr>
                        <td>
                          <!-- <input type="checkbox" class="form-check-input id_checkbox" id="tableMaterialCheck<?php echo $id_check ?>" name="id[]" value="<?php echo $id_check ?>">
                          <label class="form-check-label" for="tableMaterialCheck<?php echo $id_check ?>"></label> -->
                          <?php echo $no ?>
                        </td>
                        <td><?php echo $data_pegawai->NIK; ?></td>
                          <td><?php echo $data_pegawai->nama; ?></td>
                          <!-- <td><?php echo $data_pegawai->jabatan; ?></td> -->
                          <td>
                            <a href="<?php echo base_url().'K_Binaan/KBDokter/list_perawat/'.$id_check; ?>">
                              <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="" data-original-title="Anggota Perawat">
                                <i class="fa fa-users"></i>
                              </button>
                            </a>
                            <a href="<?php echo base_url().'K_Binaan/KBDokter/HapusDokter/'.$data_pegawai->NIK; ?>">
                              <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="Hapus Dokter">
                                <i class="fa fa-trash"></i>
                              </button>
                            </a>
                          </td>
                      </tr>
                    <?php $no++;  endforeach; ?>
                  </tbody>
              </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">New message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div class="table-responsive">
                <table id="myTable" class="table table-bordered table-hover table-striped DataTable">
                        <thead>
                            <tr>
                              <th width="10%"><input type="checkbox" class="form-check-input select-all" id="tableMaterialChec">
                              <label class="form-check-label" for="tableMaterialChec"></label>
                              </th>
                              <th>NIK</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th width="%5">opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $no = 1; foreach ($pegawai as $data_pegawai):
                            $id_check = $data_pegawai->NIK;?>
                            <tr>
                              <td><input type="checkbox" class="form-check-input id_checkbox" id="tableMaterialCheck<?php echo $id_check ?>" name="id[]" value="<?php echo $id_check ?>">
                                <label class="form-check-label" for="tableMaterialCheck<?php echo $id_check ?>"></label>
                              </td>
                              <td><?php echo $id_check; ?></td>
                                <td><?php echo $data_pegawai->nama; ?></td>
                                <td><?php echo $data_pegawai->jabatan; ?></td>
                                <td>
                                  <a href="<?php echo base_url().'K_Binaan/KBDokter/tambah_dokter/'.$id_check; ?>">
                                  <button type="button" class="btn btn-circle btn-primary" data-toggle="tooltip" data-placement="right" title="" data-original-title="Edit">
                                    <i class="fa fa-plus"></i>
                                  </button>
                                  </a>
                                </td>
                            </tr>
                          <?php $no++;  endforeach; ?>
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
