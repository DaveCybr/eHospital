
<?php echo form_open('Catatan/delete');?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

            <a href="" class="white-text mx-3">Catatan Obat</a>

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-bordered table-striped ">
              <thead>
                  <tr>
                      <th width="10%">#
                      </th>
                      <th>Catatan</th>
                      <th>Saran</th>
                      <th width="10%">Opsi</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($catatan as $data) {?>
                  <?php $id_check = $data->id;?>
                  <tr>
                      <td><?php echo $no?>
                      </td>
                      <td><?php echo $data->catatan?></td>
                      <td><?php echo $data->saran?></td>
                      <td><a href="<?php base_url()?>Catatan/edit/<?php echo $data->id;?>">
                        <button type="button" class="btn btn-warning btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                          <i class="fa fa-edit"></i>
                        </button>
                      </a></td>
                  </tr>
                <?php
                $no++;
                }?>
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
