
<?php echo form_open('Obat/delete');?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

            <a href="" class="white-text mx-3">Detail Stok Awal</a>

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-striped table-bordered">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Kode Obat</th>
                  <th>Nama Obat</th>
                  <th>No Batch</th>
                  <th>Jumlah Obat terinput</th>
              </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach ($obat as $data) {?>
              <tr>
                <td><?php echo $no?></td>
                <td><?php echo $data->idobat?></td>
                <td><?php echo $data->nama_obat?></td>

                <td><?php echo $data->no_batch?></td>
                <td><?php echo $data->jumlah?></td>

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
