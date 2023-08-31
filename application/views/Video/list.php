
<?php echo form_open('Antrian/delete_video');?>

<div class="row">
  <div class="col-12">
      <div class="card card-cascade narrower z-depth-1">
        <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
          <div>
                <button type="button" class="btn btn_hapus btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data"><i class="fas fa-trash-alt mt-0"></i></button>
                <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jumlah Item Terpilih"><span id="jumlah_pilih">0</span></button>
              </div>
              <a href="" class="white-text mx-3">Video Antrian</a>
              <div>
                <a href="<?php base_url(); ?>input_video" class="float-right">
                  <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><i class="fas fa-pencil-alt mt-0"></i></button>
                </a>
              </div>
        </div>
        <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th width="10%">
                      <input type="checkbox" class="form-check-input select-all" id="tableMaterialChec">
                      <label class="form-check-label" for="tableMaterialChec"></label>
                    </th>
                    <th>No</th>
                      <th>Nama Video</th>
                      <th>Video</th>
                      <th>Status</th>
                      <!-- <th>Urutan Tampil</th> -->
                      <th width="%5">opsi</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($video as $data):
                  $id_check = $data->id;?>
                  <tr>

                    <td>
                      <input type="checkbox" class="form-check-input id_checkbox" id="tableMaterialCheck<?php echo $id_check ?>" name="id[]" value="<?php echo $id_check ?>">
                      <label class="form-check-label" for="tableMaterialCheck<?php echo $id_check ?>"></label>
                    </td>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $data->nama_video ?></td>
                      <td><video width="100%" height="100" controls id="myVideo">
                        <source id="video_src" src="<?php echo base_url(); ?>desain/video/<?php echo $data->url?>" type="video/mp4">
                      </video></td>
                      <td><span class="badge <?php echo $data->status==1?"badge-success":"badge-danger"?>"><?php echo $data->status==1?"aktif":"tidak aktif"?></span></td>
                      <!-- <td><?php echo $data->urutan ?></td> -->

                      <td>
                        <?php if ($data->status==1): ?>
                          <a href="<?php echo base_url().'Antrian/nonaktifkan_video/'.$id_check; ?>">
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Nonaktif">
                              Non Aktifkan
                            </button>
                          </a>
                          <?php else: ?>
                            <a href="<?php echo base_url().'Antrian/aktifkan_video/'.$id_check; ?>">
                              <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Aktif">
                                Aktifkan
                              </button>
                            </a>
                        <?php endif; ?>
                      </td>
                  </tr>
                <?php  endforeach; ?>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="alert"><?php echo $this->Core->Hapus_disable(); ?></div>
<div id="modal"><?php echo $this->Core->Hapus_aktif(); ?></div>

<?php echo form_close();?>
