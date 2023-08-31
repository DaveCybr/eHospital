<br>
<?php echo form_open('Supplier/delete');?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
          <div>
            <a href="<?php echo base_url(); ?>APO/Home" class="float-right">
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Kembali"><i class="fas fa-backward mt-0"></i></button>
          </a>
          </div>
            <a href="" class="white-text mx-3">Riwayat Kunjungan Pasien</a>
            <div></div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-striped table-bordered">
              <thead>
                  <tr>
                      <th width="10%">#</th>
                      <th>TGL. Kunjungan</th>
                      <th>Tujuan Pelayanan</th>
                      <th>Keluhan</th>
                      <th width="%5">Detail</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($riwayat as $data):
                  $id_check = $data->no_urutkunjungan;?>
                  <tr>

                      <td>
                        <?php echo $no++ ?>
                      </td>
                      <td><?php echo date("d-m-Y", strtotime($data->tgl)); ?></td>
                      <td><?php echo $data->tujuan_pelayanan; ?></td>
                      <td><?php echo $data->keluhan; ?></td>
                      <td>
                        <div id="<?php echo $id_check ?>myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Detail Riwayat</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                      <?php
                                        $periksa = $this->ModelPeriksa->get_periksa_pasien_mandiri($id_check);
                                        $idperiksa = $periksa["idperiksa"];
                                        $diagnosa = $this->db
                                        ->join("penyakit","diagnosa.kodesakit=penyakit.kodeicdx")
                                        ->where("periksa_idperiksa",$idperiksa)
                                        ->get("diagnosa")->result();

                                        $resep = $this->db
                                        ->join("detail_resep","resep.no_resep=detail_resep.resep_no_resep")
                                        ->join("obat","detail_resep.obat_idobat=obat.idobat")
                                        ->where("periksa_idperiksa",$idperiksa)
                                        ->get("resep")->result();
                                       ?>
                                       <div class="table-responsive">
                                       <h5>Diagnosa Pasien</h5>
                                      <table class="table table-striped table-bordered">
                                        <tr>
                                          <td>Kode Sakit</td>
                                          <td>Nama Penyakit</td>
                                        </tr>
                                        <?php foreach ($diagnosa as $val): ?>
                                          <tr>
                                            <td><?php echo $val->kodesakit ?></td>
                                            <td><?php echo $val->indonesia ?></td>
                                          </tr>
                                        <?php endforeach; ?>

                                      </table>
                                    </div>
                                      <br>
                                      <h5>Obat Pasien</h5>
                                      <div class="table-responsive">
                                      <table class="table table-striped table-bordered">
                                        <tr>
                                          <td>Nama Obat</td>
                                          <td>Signa</td>
                                        </tr>
                                        <?php foreach ($resep as $val): ?>
                                          <tr>
                                            <td><?php echo $val->nama_obat ?></td>
                                            <td><?php echo $val->signa ?></td>
                                          </tr>
                                        <?php endforeach; ?>

                                      </table>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <button type="button" class="btn btn-primary btn-floating" alt="default" data-toggle="modal" data-target="#<?php echo $id_check ?>myModal" data-placement="top" title="" data-original-title="Edit">
                          <i class="fa fa-list"></i>
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
<?php echo form_close();?>
