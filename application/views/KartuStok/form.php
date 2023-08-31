
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
      <div class="col-md-9">
        <!-- <a href="#" ><button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="Tampilkan obat" id="tampil"><i class="fa fa-eye"></i> Tampilkan Obat</button></a> -->
        <!-- <a href="#" data-toggle="modal" data-target="#scrollmodal"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="cari obat" id="tambahkan"><i class="fa fa-plus"></i> Cari Obat</button></a> -->
      </div>
      <div class="col-md-12" style="margin-top:20px;">
        <div class="table-responsive tabel-obat">
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
                    <a target="_blank" href="<?php echo base_url()."KartuStok/cetak/".$id?>"><button type="button" id="<?php echo $id;?>" class="list_batch btn-floating aqua-gradient" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lihat Kartu Stok" >
                      <i class="fa fa-check"></i>
                    </button></a>
                </td>
              </tr>
              <?php $no++;  endforeach; ?>
            </tbody>
          </table>
        </div>
        <br>

      </div>
    </div>
  </div>
</div>
