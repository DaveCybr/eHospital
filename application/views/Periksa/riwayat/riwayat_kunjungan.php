<div class="col-md-12 col-12 col-xl-12">
  <!-- Card Narrower -->
  <div class="card card-cascade narrower z-depth-1">
    <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
          <h4><a href="" class="white-text mx-3">Riwayat Kunjungan Pasien</a></h4>

    </div>
    <!-- Card content -->
    <div class="card-body">


        <div class="table-responsive table--no-card m-b-40">
          <table class="table table-borderless table-striped table-earning">
          <thead>
            <th>Tanggal Kunjungan</th>
            <th>Tujuan Poli</th>
            <th>Opsi</th>
          </thead>
          <tbody id="resep">
              <?php $data_kunjungan = $this->ModelPeriksa->get_riwayat_kunjungan(@$pasien['noRM']); ?>
            <?php foreach ($data_kunjungan as $data): ?>
              <tr>
                <td><?php echo date("d-m-Y",strtotime($data->tgl))?>
                <td><?php echo $data->tujuan_pelayanan?></td>
                <td>
                    <a class="btn btn-info" data-toggle="collapse" data-parent="#accordion2" href="#kunjungan<?php echo $data->no_urutkunjungan; ?>" aria-expanded="true" aria-controls="collapseOne11">
                      <i class="fa fa-list"></i></a>
                    </a>
                    <tr>
                      <td colspan="3" style="padding: 0rem !important;"><div id="kunjungan<?php echo $data->no_urutkunjungan; ?>" class="collapse" role="tabpanel" aria-labelledby="headingOne11" style="padding: 1rem !important;">
                        <div class="table-responsive">
                          <table class="table color-bordered-table info-bordered-table" style="color: #000;background-color: #fff;">
                          <thead>
                            <th>No</th>
                            <th>Pelayanan</th>
                            <th>Opsi</th>
                          </thead>
                        <tbody>
                          <tr>
                              <td>1</td>
                              <td>Pemeriksaan</td>
                              <td>
                                  <a class="btn btn-info" data-toggle="collapse" data-parent="#accordion2" href="#periksa<?php echo $data->no_urutkunjungan; ?>" aria-expanded="true" aria-controls="collapseOne11">
                                    <i class="fa fa-list"></i></a>
                                  </a>
                                  <tr>
                                    <td colspan="3" style="padding: 0rem !important;"><div id="periksa<?php echo $data->no_urutkunjungan; ?>" class="collapse" role="tabpanel" aria-labelledby="headingOne11" style="padding: 1rem !important;">

                                      <?php
                                      if ($data->tupel_kode_tupel=='GIG') {
                                        $this->load->view('Periksa/riwayat/riwayat_periksa_gigi',array('hasil_periksa'=>$this->ModelPeriksa->get_periksa_pasien($data->no_urutkunjungan)));
                                      }else{
                                        $this->load->view('Periksa/form/periksa3',array('hasil_periksa'=>$this->ModelPeriksa->get_periksa_pasien($data->no_urutkunjungan)));
                                      }?>
                                    </td>
                                  </tr>
                              </td>
                          </tr>
                          <tr>
                              <td>2</td>
                              <td>Tindakan Dan Diagnosa</td>
                              <td>
                                  <a class="btn btn-info" data-toggle="collapse" data-parent="#accordion2" href="#tindakan<?php echo $data->no_urutkunjungan; ?>" aria-expanded="true" aria-controls="collapseOne11">
                                    <i class="fa fa-list"></i></a>
                                  </a>
                                  <tr>
                                    <td colspan="3" style="padding: 0rem !important;"><div id="tindakan<?php echo $data->no_urutkunjungan; ?>" class="collapse" role="tabpanel" aria-labelledby="headingOne11" style="padding: 1rem !important;">
                                    <?php $this->load->view('Periksa/riwayat/riwayat_tindakan',array('hasil_periksa'=>$this->ModelPeriksa->get_periksa_pasien($data->no_urutkunjungan)));?>
                                    </td>
                                  </tr>
                              </td>
                          </tr>
                          <tr>
                              <td>3</td>
                              <td>Permintaan Laborat</td>
                              <td>
                                  <a class="btn btn-info" data-toggle="collapse" data-parent="#accordion2" href="#laborat<?php echo $data->no_urutkunjungan; ?>" aria-expanded="true" aria-controls="collapseOne11">
                                    <i class="fa fa-list"></i></a>
                                  </a>
                                  <tr>
                                    <td colspan="3" style="padding: 0rem !important;"><div id="laborat<?php echo $data->no_urutkunjungan; ?>" class="collapse" role="tabpanel" aria-labelledby="headingOne11" style="padding: 1rem !important;">
                                      <?php $this->load->view('Periksa/riwayat/riwayat_laborat',array('hasil_periksa'=>$this->ModelPeriksa->get_periksa_pasien($data->no_urutkunjungan)));?>
                                    </td>
                                  </tr>
                              </td>
                          </tr>
                          <tr>
                              <td>4</td>
                              <td>Resep</td>
                              <td>
                                  <a class="btn btn-info" data-toggle="collapse" data-parent="#accordion2" href="#resep<?php echo $data->no_urutkunjungan; ?>" aria-expanded="true" aria-controls="collapseOne11">
                                    <i class="fa fa-list"></i></a>
                                  </a>
                                  <tr>
                                    <td colspan="3" style="padding: 0rem !important;"><div id="resep<?php echo $data->no_urutkunjungan; ?>" class="collapse" role="tabpanel" aria-labelledby="headingOne11" style="padding: 1rem !important;">
                                      <?php $this->load->view('Periksa/riwayat/riwayat_resep',array('hasil_periksa'=>$this->ModelPeriksa->get_periksa_pasien($data->no_urutkunjungan)));?>
                                    </td>
                                  </tr>
                              </td>
                          </tr>
                        </tbody>
                        </table>
                      </div>
                    </div></td>
                    </tr>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        </div>


      </div>

      </div>

    </div>
    <!-- Card Narrower -->

  </div>
</div>
