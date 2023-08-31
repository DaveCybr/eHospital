
<?php echo form_open('Kejur/delete');?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header text-center">
        <h4>KELOMPOK JURNAL</h4>
      </div>
      <div class="card-body">
        <a href="<?php base_url(); ?>Kejur/input" class="float-right">
          <h4><span class="badge badge-pill badge-success badge-atas">Tambah kelompok</span></h4>
          <button class="btn btn-circle btn-lg btn-success btn-atas" type="button"><i class="fa fa-plus"></i>
          </button>
        </a>
        <!-- hapus -->
          <h4 class="badge-hapus"><span class="badge badge-pill badge-danger">Terpilih <span id="jumlah_pilih">0</span></span></h4>

        <div id="alert"><?php echo $this->Core->Hapus_disable(); ?></div>
        <div id="modal"><?php echo $this->Core->Hapus_aktif(); ?></div>
        <div class="table-responsive">
          <table id="myTable" class="table color-table info-table table-bordered table-striped ">
          <thead>
              <tr>
                  <th width="5%">#</th>
                  <th>No Rek</th>
                  <th>Nama Kelompok</th>
                  <th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach ($kelompok as $data) {?>
              <?php $id_check = $data->norek;?>
              <tr>
                  <td><div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input id_checkbox" id="customCheck<?php echo $id_check ?>" id="<?php echo $id_check ?>" name="id[]" value="<?php echo $id_check ?>">
                    <label class="custom-control-label" for="customCheck<?php echo $id_check ?>"></label>
                  </div>
                  </td>
                  <td><?php echo $data->norek?></td>
                  <td><?php echo $data->namakel?></td>
                  <td><a href="<?php base_url()?>Kejur/edit/<?php echo $data->norek;?>">
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
<?php echo form_close();?>
<?php echo $this->Core->Fungsi_JS_Hapus(); ?>
