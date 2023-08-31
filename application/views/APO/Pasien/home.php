<div class="row p-5">
  <div class="col-lg-4 col-xlg-3 col-md-5">
      <div class="card"> <img class="card-img" src="http://klinikdokterku.com/wp-content/uploads/2020/01/WhatsApp-Image-2020-01-14-at-21.22.51.jpeg" height="456" alt="Card image">
          <div class="card-img-overlay card-inverse text-white social-profile d-flex justify-content-center">
              <div class="align-self-center"> <img src="<?php echo base_url()?>desain/user.png" class="img-circle" width="100">
                  <br>
                  <br>
                  <h3 class="card-title"><?php echo $_SESSION['nama'] ?></h3>
                  <h6 class="card-subtitle">Nama Pasien</h6>
                  <br>
                  <div class="row col 12 text-center">
                    <div class="col-md-6">
                      <h4 class="card-title"><?php echo $_SESSION['noRM'] ?></h4>
                      <h6 class="card-subtitle">No.Rekam Medis</h6>
                    </div>
                    <div class="col-md-6">
                      <h4 class="card-title"><?php echo $nobpjs = ($_SESSION['jenis'] == 1) ? $_SESSION['noBPJS'] : "Belum Terdaftar" ; ?></h4>
                      <h6 class="card-subtitle">No.BPJS</h6>
                    </div>
                  </div>
                  <!-- <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt </p> -->
              </div>
          </div>
      </div>
      <div class="card">
          <div class="card-body"> <small class="text-muted">Kunjungan Terakhir :</small>
              <h6><?php echo date("d-m-Y", strtotime($pasien['kunjungan_terakhir'])) ?></h6>
              <small class="text-muted p-t-30 db">NO. Telp :</small>
              <h6><?php echo $pasien['telepon'] ?></h6>
              <small class="text-muted p-t-30 db">Alamat :</small>
              <h6><?php echo $pasien['alamat'] .", ".$pasien['kota'] ?></h6>
          </div>
      </div>
  </div>

  <div class="col-lg-8 col-xlg-9 col-md-7">
    <div class="row">

    <!-- Conten Pendaftaran -->
    <div class="col-md-12">
      <div class="card card-cascade narrower z-depth-1">
        <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
              <h4 id="info"><a href="#" class="white-text mx-3"><i class="fas fa-info-circle"></i> Informasi Kunjungan</a></h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 align-self-center">
              <?php if ($status == 0): ?>
                <h4>Belum Melakukan Kunjungan Mandiri</h4>
                <h6 class="card-subtitle">Silakan Klik Daftar Kunjungan untuk Melakukan Kunjungan Mandiri !</h6>
                <?php else: ?>
                  <div class="row">
                    <div class="col-md-6 row">
                      <div class="col-md-12 text-center">
                        <h1 class="text-primary"><?php echo $kunjungan['kd_antrian']."".$kunjungan['no_antrian'] ?> </h1>
                      </div>
                      <div class="col-md-12 text-center">
                        No. Antrian Anda :<br>
                        Antrian Sekarang :
                        <?php if ($kunjungan['kode_tupel'] == "UMU" || $kunjungan['kode_tupel'] == "UMU2"): ?>
                          <label class="text-danger"><?php echo $antrian_Umum ?></label>
                          <?php else: ?>
                            <label class="text-danger"><?php echo $antrian_Gigi ?></label>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="col-md-6 row">
                      <div class="col-md-12 text-center">
                        <h1 class="text-primary"><?php echo $kunjungan['tujuan_pelayanan'] ?> </h1>
                      </div>
                      <div class="col-md-12 text-center">
                        Poli Dituju :
                      </div>
                    </div>
                  </div>
              <?php endif; ?>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Content Menu ------>
    <?php if ($status == 0): ?>
      <div class="col-xl-4 col-md-4 col-sm-6 col-xs-6 mb-4">
        <div class="card white z-depth-2">
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <a href="<?php echo base_url() ?>APO/Kunjungan/Pasien/<?php echo $_SESSION['noRM'] ?>" type="button" class="btn-floating btn-lg green lighten-2 waves-effect waves-light"><i class="fas fa-stethoscope" aria-hidden="true"></i></a>
            </div>
          </div>
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Daftar Kunjungan</p>
            </div>
          </div>
        </div>
      </div>
    <?php elseif($status == 1): ?>
      <div class="col-xl-4 col-md-4 col-sm-6 col-xs-6 mb-4">
        <div class="card white z-depth-2">
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <?php if ($status_konsul == 0): ?>
                  <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button> -->
                  <a href="#" type="button" class="btn-floating btn-lg aqua-gradient waves-effect waves-light" data-toggle="modal" data-target="#exampleModal"><i class="far fa-comment-alt"></i></a>

                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h4 class="modal-title" id="exampleModalLabel1">Dokter Online : <?php echo $kunjungan['tujuan_pelayanan'] ?></h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body">
                                <div class="table-responsive">
                                  <table class="table color-table info-table">
                                    <thead>
                                      <tr>
                                        <th>Nama Dokter</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                      </tr>
                                    </thead>
                                    <?php foreach ($this->ModelAPO->getStatusDokter($kunjungan['kode_tupel'])->result() as $value): ?>
                                      <tr>
                                        <td><?php echo $value->nama?></td>
                                        <td><?php echo $status_online = ($value->status_online == 1) ? "<label class='text-success'>Online</label>" : "Offline" ;?></td>
                                        <td>
                                          <?php if ($value->status_online == 1): ?>
                                            <a href="<?php echo base_url() ?>APO/Konsultasi/pesanPasienAwal/<?php echo $_SESSION['noRM'] ?>/<?php echo $kunjungan['no_urutkunjungan'] ?>/<?php echo $value->pegawai_NIK?>" type="button" class="btn-floating btn-sm aqua-gradient waves-effect waves-light"><i class="far fa-comment-alt"></i></a>
                                          <?php endif; ?>
                                        </td>
                                      </tr>
                                    <?php endforeach; ?>
                                  </table>
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                              </div>
                          </div>
                      </div>
                  </div>
                <?php else: ?>
                  <a href="<?php echo base_url() ?>APO/Konsultasi/ChatPasien/<?php echo $_SESSION['noRM'] ?>/<?php echo $kunjungan['no_urutkunjungan'] ?>" type="button" class="btn-floating btn-lg aqua-gradient waves-effect waves-light"><i class="far fa-comment-alt"></i></a>
              <?php endif; ?>
            </div>
          </div>
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Konsultasi</p>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>


    <div class="col-xl-4 col-md-4 col-sm-6 col-xs-6 mb-4">
      <div class="card white z-depth-2">
        <div class="row mt-3">
          <div class="col-md-12 col-12 text-center">
            <a href="<?php echo base_url() ?>APO/APO_RiwayatKunjungan/riwayat/<?php echo $_SESSION['noRM'] ?>" type="button" class="btn-floating btn-lg blue lighten-2 waves-effect waves-light"><i class="fas fa-user-clock" aria-hidden="true"></i></a>
          </div>
        </div>
        <div class="row my-3">
          <div class="col-md-12 col-12 text-center">
            <p class="text-primary font-up font-weight-bold">Riwayat Pemeriksaan</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-4 col-sm-6 col-xs-6 mb-4">
      <div class="card white z-depth-2">
        <div class="row mt-3">
          <div class="col-md-12 col-12 text-center">
            <a href="<?php echo base_url() ?>APO/LoginPasien/logout" type="button" class="btn-floating btn-lg red lighten-2 waves-effect waves-light"><i class="fa fa-power-off" aria-hidden="true"></i></a>
          </div>
        </div>
        <div class="row my-3">
          <div class="col-md-12 col-12 text-center">
            <p class="text-primary font-up font-weight-bold">Log Out</p>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>

</div>
