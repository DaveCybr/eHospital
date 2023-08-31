<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>Jadwal Dokter</strong>
              <small> Form Input</small>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('Jadwal/insert');?>
              <?php echo @$error;?>
              <?php $this->load->view($form)?>


              <button type="submit" class="btn btn-primary btn-sm">SIMPAN</button>
              <input type="hidden" name="nik_dokter" value="" id="nik_dokter">
              <?php echo form_close(); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modaldokter" tabindex="-1" role="dialog" aria-labelledby="modaljapelLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scrollmodalLabel">Daftar Dokter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="example" class="table table-hover table-borderless table-striped">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>NIK</th>
                          <th>Nama Dokter</th>
                          <th>Jabatan</th>
                          <th>Opsi</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($pegawai as $data) {?>
                      <?php $id_check = $data->NIK;
                      ?>
                      <tr>
                          <td><?php echo $no;?></td>
                          <td><?php echo $data->NIK?></td>
                          <td><?php echo $data->nama?></td>
                          <td><?php echo $data->jabatan?></td>
                          <td><button type="button" nik="<?php echo $id_check?>" nama="<?php echo $data->nama?>" class="btn btn-circle btn-primary pilih" data-toggle="tooltip" data-placement="right" data-original-title="pilih" data-dismiss="modal">
                              <i class="fas fa-edit"></i>
                            </button>
                          </td>
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
