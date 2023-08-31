
<?php echo form_open('TempatTidur/delete');?>

<div class="row">
  <div class="col-12">
      <div class="card card-cascade narrower z-depth-1">
        <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

              <a href="" class="white-text mx-3">Set UP Tempat Tidur</a>

        </div>
        <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th width="10%">#</th>
                      <th>Ruang</th>
                      <th>Kelas</th>
                      <th>Status</th>

                      <th width="%5">opsi</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($tempat_tidur as $data):
                  $id_check = $data->no_tt;?>
                  <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $data->nama_kamar; ?></td>
                      <td><?php echo $data->kelas; ?></td>
                      <td><?php if ($data->status_terisi == 0) {
                        echo "Ready/Kosong";
                      }
                      elseif ($data->status_terisi == 2) {
                        echo "Proses Disiapkan";
                      } else {
                        echo "Terpakai";
                      }?></td>


                      <td>

                        <?php if ($data->status_terisi == 2): ?>
                          <a href="<?php echo base_url().'TempatTidur/ready/'.$id_check; ?>">
                          <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                            Ready
                          </button>
                          </a>
                          <?php else: ?>
                            <?php if ($data->status_terisi == 1): ?>
                              <a href="<?php echo base_url().'TempatTidur/setup_kamar/'.$id_check; ?>">
                              <button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                Setup
                              </button>
                              </a>
                            <?php endif; ?>
                        <?php endif; ?>


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
<div id="alert"><?php echo $this->Core->Hapus_disable(); ?></div>
<div id="modal"><?php echo $this->Core->Hapus_aktif(); ?></div>

<?php echo form_close();?>
