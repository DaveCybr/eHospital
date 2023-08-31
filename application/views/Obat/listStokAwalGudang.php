
<?php echo form_open('Obat/delete');?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <a href="" class="white-text mx-3">History Input Stok Awal Gudang</a>
            <div>
              <a href="<?php echo base_url(); ?>Obat/stokAwalGudang" class="float-right">
                <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Input Stok Awal"><i class="fas fa-pencil-alt mt-0"></i></button>
              </a>
            </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-striped table-bordered">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Tanggal Input</th>
                  <th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach ($obat as $data) {?>
              <?php if ($data->kode_input!=NULL): ?>

                <tr>
                  <td><?php echo $no?></td>
                  <td><?php echo date("d-m-Y",strtotime($data->tanggal))?></td>
                  <td>
                    <a href="<?php echo base_url().'Obat/detailStokAwalGudang/'.$data->kode_input; ?>">
                    <button type="button" class="btn btn-sm btn-warning" data-toggle="tooltip" title="" data-original-title="Detail">
                      <i class="fa fa-edit"></i>
                    </button>
                    </a>
                  </td>
                </tr>
              <?php endif; ?>
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
