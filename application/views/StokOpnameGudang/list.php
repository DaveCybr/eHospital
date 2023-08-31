<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
              <h4><a href="" class="white-text mx-3">Stok Opname</a></h4>

            </div>
            <div class="card-body card-block">
              <a href="<?php echo base_url()."StokOpnameGudang/input" ?>">
              <button type="button" class="btn btn-info btn-sm waves-effect waves-light" data-toggle="modal" data-target="#tabel_obat" data-placement="top" title="" data-original-title="scrollmodal" moda>
                                            <i class="fa fa-plus"></i> Tambah Stok Opname
                </button></a>
                <a href="#" data-toggle="modal" data-target="#opname" >
                <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target="#tabel_obat" data-placement="top" title="" data-original-title="scrollmodal" moda>
                  <i class="fa fa-print"></i> Cetak Stok Opname
                </button></a>

              <div class="table-responsive">
                <table id="myTable" class="table table-bordered table-hover table-striped ">
                  <thead>
                    <tr>
                      <th width="5%">#</th>
                      <th>No Batch</th>
                      <th>Nama Obat</th>
                      <th>Satuan</th>
                      <th>Harga Beli</th>
                      <th>Jumlah Komputer</th>
                      <th>Jumlah Real</th>
                      <th>Selisih</th>
                      <!-- <th width="%5">opsi</th> -->
                    </tr>
                  </thead>
                  <tbody id="tabel_batch">
                    <?php $no=1; foreach ($stok_opname as  $value): ?>
                      <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $value->no_batch ?></td>
                        <td><?php echo $value->nama ?></td>
                        <td><?php echo $value->satuan ?></td>
                        <td><?php echo $value->harga_beli ?></td>
                        <td><?php echo $value->jumlah_komp ?></td>
                        <td><?php echo $value->jumlah_real ?></td>
                        <td><?php echo $value->selisih ?></td>
                      </tr>
                    <?php $no++; endforeach; ?>
                  </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="opname" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scrollmodalLabel">Daftar Stok Opname</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-sm-12">
          <div class="table-responsive ">
            <table id="myTable" class="table table-bordered table-hover table-striped ">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th>Waktu Stok Opname</th>
                  <th width="%5">opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($opname as $data):
                  ?>
                  <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $data['waktu']; ?></td>
                    <td>
                      <a href="<?php echo base_url().'StokOpnameGudang/cetak/'.$data['tanggal']; ?>">
                      <button type="button" id="" class="list_batch btn-floating aqua-gradient" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cetak" >
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
  </div>
