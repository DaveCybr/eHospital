<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
              <h4><a href="" class="white-text mx-3">Edit Bahan Habis Pakai Jasa Pelayanan</a></h4>

            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('JasaBHP/update/'.$this->uri->segment(3));?>
              <?php echo @$error;?>
              <?php $this->load->view($form)?>
              <?php echo $this->Core->btn_input()?>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scrollmodalLabel">List Batch Dari Obat Ini</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-bordered table-hover table-striped ">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th>Kode/No Barcode Obat</th>
                <th>Nama Obat</th>
                <th width="%5">opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($obat as $data):
                $id = $data->idobat;?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data->idobat; ?></td>
                  <td><?php echo $data->nama_obat; ?></td>
                  <td>
                    <button type="button" id="<?php echo $id;?>" nama="<?php echo $data->nama_obat?>" class="btn-floating aqua-gradient obat" data-toggle="tooltip" data-placement="top" title="" data-original-title="TambahKan" >
                      <i class="fa fa-check"></i>
                    </button>
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
  <div class="modal fade" id="modal_jasa" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scrollmodalLabel">Daftar Jasa Pelayanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table id="table_jasa" class="table table-bordered table-hover table-striped ">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th>Kode Jasa</th>
                  <th>Nama Jasa</th>
                  <th width="%5">opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($jasa_pelayanan as $data):
                  $id = $data->kode_jasa;?>
                  <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $data->kode_jasa; ?></td>
                    <td><?php echo $data->nama; ?></td>
                    <td>
                      <button type="button" id="<?php echo $id;?>" nama="<?php echo $data->nama?>" class="btn-floating aqua-gradient jasa" data-toggle="tooltip" data-placement="top" title="" data-original-title="TambahKan" >
                        <i class="fa fa-check"></i>
                      </button>
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