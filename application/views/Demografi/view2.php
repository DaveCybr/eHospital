<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
              <h3><a href="" class="white-text mx-3">ASESMEN AWAL KEPERAWATAN</a><h3>
              </div>

              <div class="card-body card-block">
                <?php echo form_open_multipart('Asesmen/insert');?>
                <?php echo @$error;?>
                <div class="card-body card-block">
                  <!-- <div class="row form-group">
                    <div class="col col-md-2">
                      <label for="nokun" class=" form-control-label">NO.Kunjungan :</label>
                    </div>
                    <div class="col-12 col-md-4">
                      <input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$kunjungan['no_urutkunjungan']; ?>" required readonly>
                    </div>
                    <div class="col col-md-1">
                      <label for="tanggal" class=" form-control-label">Tanggal</label>
                    </div>
                    <div class="col-12 col-md-4">
                      <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo @$kunjungan['tgl']; ?>" required readonly>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col col-md-2">
                      <label for="norm" class=" form-control-label">Pasien :</label>
                    </div>
                    <div class="col-12 col-md-3">
                      <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" required readonly>
                    </div>
                    <div class="col-12 col-md-4">
                      <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo @$pasien['namapasien']; ?>" required readonly>
                    </div>
                    <div class="col-12 col-md-3">
                      <input type="text" name="jenis_kunjungan" id="jenis_kunjungan" class="form-control" placeholder="jenis_kunjungan" value="<?php echo @$jenispasien['jenis_pasien']; ?>" required readonly>
                    </div>
                  </div> -->
                  <?php if ($_SESSION['poli']=="OBG"): ?>

                  <div class="col-lg-12 row">
                    <div class="card">
                      <div class="card-header aqua-gradient text-white">
                        <strong><b>Riwayat Kehamilan, Persalinan dan Nifas yang lalu</b>:</strong>
                      </div>
                      <div class="card-body card-block">
                        <?php $riwayat = $this->ModelPeriksa->get_riwayat_obgyn($kunjungan['pasien_noRM'])->result(); ?>
                              <div class="table-responsive" id="riwayat">
                                <table id="example" class="table table-striped table-hover">
                                  <thead>
                                    <th>NO</th>
                                    <th>Tahun Partus</th>
                                    <th>Tempat Partus</th>
                                    <th>Umur Hamil</th>
                                    <th>Jenis Persalinan</th>
                                    <th>Penolong</th>
                                    <th>Penyulit</th>
                                    <th>JK</th>
                                    <th>BB</th>
                                    <th>H/M</th>
                                  </thead>
                                  <tbody>
                                    <?php $no=0; foreach ($riwayat as $value): $no++;?>
                                      <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $value->tahunpartus; ?></td>
                                        <td><?php echo $value->tempatpartus; ?></td>
                                        <td><?php echo $value->umurhamil; ?></td>
                                        <td><?php echo $value->jenispersalinan; ?></td>
                                        <td><?php echo $value->penolong; ?></td>
                                        <td><?php echo $value->penyulit; ?></td>
                                        <td><?php echo $value->jk; ?></td>
                                        <td><?php echo $value->bb." Kg"; ?></td>
                                        <td><?php echo $value->hm; ?></td>
                                      </tr>
                                    <?php endforeach; ?>
                                  </tbody>
                                </table>
                              </div>
                              <div id="tambahriwayat" class="modal fade" role="dialog"aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                  <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h4 class="modal-title">Tambah Riwayat</h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                                          class="fa fa-window-close"></i></button>
                                          </div>
                                          <div class="modal-body">
                                              <?php echo form_open_multipart('Pasien/insert_riwayatobgyn'); ?>
                                              <input type="text" name="norm" value="<?php echo @$pasien['noRM']; ?>" hidden>
                                              <input type="text" name="nokun" value="<?php echo @$idkunjungan; ?>" hidden>
                                              <?php echo @$error; ?>
                                              <?php $this->load->view('Pasien/riwayatobgyn') ?>
                                              <?php echo $this->Core->btn_input() ?>
                                              <?php echo form_close(); ?>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                      </div>
                    </div>
                  </div>

                <?php endif; ?>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>ASESMEN AWAL KEPERAWATAN</strong>
                        </div>
                        <div class="card-body card-block">
                          <div class="row p-t-20 p-b-50">
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Tanggal Kunjungan</label>
                                <div class="input-group mb-3">
                                  <input type="date" class="form-control" aria-label="" name="tanggal_kunjungan" value="<?php echo date("Y-m-d",strtotime(@$demografi['tanggal_kunjungan']))?>" readonly>
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Pukul : </span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="tanggal_jam_kunjungan" value="<?php echo date('H:i:s',strtotime(@$demografi['jam_kunjungan'])) ?>" readonly>
                                  <div class="input-group-append">
                                    <span class="input-group-text">WIB</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Keluhan Pasien</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-face-sad"></i></span>
                                  </div>
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo $kunjungan['keluhan']?>" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Sumber Data</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-face-sad"></i></span>
                                  </div>
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['sumberdata']?>" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Rujukan</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <!-- <span class="input-group-text"><i class="ti-face-sad"></i></span> -->
                                  </div>
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['rujukan']?>" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Dokter</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-notepad"></i></span>
                                  </div>
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['dokter']?>" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">RS</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-notepad"></i></span>
                                  </div>
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['rs']?>" readonly>
                                </div>
                              </div>
                            </div>

                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Lainnya</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-notepad"></i></span>
                                  </div>
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['aak_lainnya']?>" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Diagnosa rujukan</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-notepad"></i></span>
                                  </div>
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['diagnosa_rujukan']?>" readonly>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>ASESMEN KEPERAWATAN</strong>
                        </div>
                        <div class="card-body card-block">
                          <div class="row p-t-20">

                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Keadaan Umum</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-notepad"></i></span>
                                  </div>
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['keadaan']?>" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">GCS</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">E</span>
                                  </div>
                                  <input type="number" min="1" max="6" class="form-control in_max" aria-label="" name="GCS_E" value="<?php echo @$demografi['GCS_E'] ?>" readonly>
                                  <div class="input-group-append">
                                    <span class="input-group-text">M</span>
                                  </div>
                                  <input type="number" min="1" max="6" class="form-control in_max" aria-label="" name="GCS_M" value="<?php echo @$demografi['GCS_M'] ?>" readonly>
                                  <div class="input-group-append">
                                    <span class="input-group-text">V</span>
                                  </div>
                                  <input type="number" min="1" max="6" class="form-control in_max" aria-label="" name="GCS_V" value="<?php echo @$demografi['GCS_V'] ?>" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Tanda Vital (TTV)</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text suhu">Suhu</span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="suhu" value="<?php echo @$demografi['suhu'] ?>" readonly>
                                  <div class="input-group-append">
                                    <span class="input-group-text">^C</span>
                                  </div>

                                </div>

                                <!-- <div class="col-xl-12 col-md-12 col-sm-12"> -->
                                  <div class="form-group animated flipIn">
                                    <label for="exampleInputuname">Kesadaran</label>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-notepad"></i></span>
                                      </div>
                                      <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['kesadaran']?>" readonly>
                                    </div>
                                  </div>
                                <!-- </div> -->
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Sistole</span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="siastole" value="<?php echo @$demografi['siastole'] ?>" required readonly>
                                  <div class="input-group-append">
                                    <span class="input-group-text">mmhg</span>
                                  </div>

                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Diastole</span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="diastole" value="<?php echo @$demografi['diastole'] ?>" readonly>
                                  <div class="input-group-append">
                                    <span class="input-group-text">mmhg</span>
                                  </div>

                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Nadi</span>
                                  </div>
                                  <input type="text" class="form-control" aria-label="" name="nadi" value="<?php echo @$demografi['nadi'] ?>" required readonly>
                                  <div class="input-group-append">
                                    <span class="input-group-text">x/menit</span>
                                  </div>
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">RR</span>
                                  </div>
                                  <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$demografi['rr'] ?>" required readonly>
                                  <div class="input-group-append">
                                    <span class="input-group-text">x/menit</span>
                                  </div>

                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>Fungsional</strong>
                        </div>
                        <div class="card-body card-block">
                          <div class="row ">

                            <div class="col-xl-12 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">ADL</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-notepad"></i></span>
                                  </div>
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['adl']?>" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-6 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Alat Bantu</label>
                                <input type="text" class="form-control" name="alatbantu" value="<?php echo @$demografi['alatbantu'] ?>" readonly>
                              </div>
                            </div>
                            <div class="col-xl-6 col-md-12 col-sm-12">
                              <div class="form-group animated flipIn">
                                <label for="exampleInputuname">Cacat Tubuh</label>
                                <input type="text" class="form-control" name="cacattubuh" value="<?php echo @$demografi['cacattubuh'] ?>" readonly>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="col-lg-12">
                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>PSIKOSIAL - EKONOMI - SPIRITUAL</strong>
                        </div>
                        <div class="card-body card-block">

                            <div class="row p-t-20 p-b-50">
                          <div class="col-xl-4 col-md-4 col-sm-12">
                            <div class="form-group animated flipIn">
                              <label for="exampleInputuname">Status Emosional</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ti-notepad"></i></span>
                                </div>
                                <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['semosi']?>" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-4 col-sm-12">
                            <div class="form-group animated flipIn">
                              <label for="exampleInputuname">Status Perkawinan</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ti-notepad"></i></span>
                                </div>
                                <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['seperkawinan']?>" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-4 col-sm-12">
                            <div class="form-group animated flipIn">
                              <label for="exampleInputuname">Tinggal Dengan</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ti-notepad"></i></span>
                                </div>
                                <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['tinggal_dengan']?>" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-4 col-sm-12">
                            <div class="form-group animated flipIn">
                              <label for="exampleInputuname">Pekerjaan</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ti-notepad"></i></span>
                                </div>
                                <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['pekerjaan']?>" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-4 col-sm-12">
                            <div class="form-group animated flipIn">
                              <label for="exampleInputuname">Cara Pembayaran</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ti-notepad"></i></span>
                                </div>
                                <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['cara_pembayaran']?>" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-4 col-sm-12">
                            <div class="form-group animated flipIn">
                              <label for="exampleInputuname">Agama</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ti-notepad"></i></span>
                                </div>
                                <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['agama']?>" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-4 col-sm-12">
                            <div class="form-group animated flipIn">
                              <label for="exampleInputuname">Kebiasaan</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ti-notepad"></i></span>
                                </div>
                                <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['adl']?>" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-8 col-md-8 col-sm-12">
                            <div class="form-group animated flipIn">
                              <label for="exampleInputuname">Nilai - Nilai Budaya Dalam keluarga yang Mepengaruhi pada kesalahan</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ti-notepad"></i></span>
                                </div>
                                <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['kebudayaan'].' , '.@$demografi['kebudayaan_lain']?>" readonly>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>KOMUNIKASI DAN EDUKASI</strong>
                        </div>
                        <div class="card-body card-block">
                          <div class="row form-group">
                            <div class="col col-md-4">
                              <label class=" form-control-label">Masalah Bicara :</label>
                            </div>
                            <div class="col-12 col-md-12 row">
                              <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['masbir'].' , '.@$demografi['masbir_lain']?>" readonly>

                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-5">
                              <label class=" form-control-label">Bahasa Sehari - Hari :</label>
                            </div>
                            <div class="col-12 col-md-12 row">
                              <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['bahasa']?>" readonly>

                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col col-md-7">
                                <label class=" form-control-label">Potensial Kebutuhan Edukasi :</label>
                              </div>
                              <div class="col-12 col-md-12 row">
                                <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['potensi']?>" readonly>

                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>RIWAYAT KESEHATAN</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row form-group">
                                <div class="col col-md-4">
                                  <label class=" form-control-label">Riwayat Alergi :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <input type="text" name="keluhan" class="form-control mb-3" value="<?php echo @$demografi['alergi']?>" readonly>

                                  <!-- <div class="col-12 col-lg-12 custom-control custom-radio"> -->
                                    <!-- <label class="custom-control-label" for="alergi3"> -->
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Alergi Jenis</span>
                                        </div>
                                        <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['alergi']?>" readonly>

                                        <div class="input-group-append">
                                          <span class="input-group-text">Reaksi</span>
                                        </div>
                                        <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['reaksi_alergi']?>" readonly>

                                      </div>
                                    <!-- </label> -->
                                  <!-- </div> -->
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-5">
                                  <label class=" form-control-label">Riwayat Penyakit Dulu :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['penyakit_dulu']?>" readonly>

                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-7">
                                  <label class=" form-control-label">Riwayat Penyakit Keluarga :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['riwayat_penyakit_keluarga']?>" readonly>

                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-7">
                                  <label class=" form-control-label">Riwayat Operasi :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['riwayat_operasi']?>" readonly>

                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-7">
                                  <label class=" form-control-label">Riwayat Tranfusi :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['riwayat_transfusi']?>" readonly>

                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-7">
                                  <label class=" form-control-label">Golongan Darah :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['golongan_darah']?>" readonly>

                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="col-lg-6">
                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>PENILAIAN NYERI</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row form-group">
                                <div class="col col-md-4">
                                  <label class=" form-control-label">Adakan Keluhan Nyeri :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['keluhan_nyeri']?>" readonly>

                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-5">
                                  <label class=" form-control-label">Penyebab / Provoke :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <!-- <div class="col-12 col-lg-12 custom-control custom-radio"> -->
                                    <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['penyebab_provoke']?>" readonly>

                                  <!-- </div> -->
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-7">
                                  <label class=" form-control-label">Kualitas / Quality :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['kualitas_quality']?>" readonly>

                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-5">
                                  <label class=" form-control-label">Lokasi / Radius :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['lokasi_radius']?>" readonly>

                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-4">
                                  <label class=" form-control-label">Intensitas / Scala :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <input type="text" name="keluhan" class="form-control mb-3" value="<?php echo @$demografi['intensitas']?>" readonly><br>

                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Lainnya</span>
                                        </div>
                                        <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['intensitas']?>" readonly>

                                        <div class="input-group-append">
                                          <span class="input-group-text">Score</span>
                                        </div>
                                        <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['intensitas_score']?>" readonly>

                                        </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-7">
                                  <label class=" form-control-label">Kategori Nyeri :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['kategori_nyeri']?>" readonly>

                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-4">
                                  <label class=" form-control-label">Durasi Nyeri :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-12 custom-control custom-radio">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Mulai Kapan</span>
                                      </div>
                                      <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['durasi_nyeri_mk']?>" readonly>

                                      <div class="input-group-append">
                                        <span class="input-group-text">Berapa Lama</span>
                                      </div>
                                      <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['durasi_nyeri_bl']?>" readonly>

                                      <div class="input-group-append">
                                        <span class="input-group-text">Frekuensi</span>
                                      </div>
                                      <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['durasi_nyeri_f']?>" readonly>

                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col col-md-5">
                                  <label class=" form-control-label">Nyeri Hilang Jika :</label>
                                </div>
                                <div class="col-12 col-md-12 row">
                                  <div class="col-12 col-lg-12 custom-control custom-radio">
                                    <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['nyeri_hilang']?>" readonly>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>PENILAIAN RESIKO JATUH</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row form-group">
                                <div class="col-12 col-md-12 row">
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['prj_umur']?>" readonly>

                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-12 col-md-12 row">
                                  <div class="col col-md-2">
                                    <label class=" form-control-label">Total Skor :</label>
                                  </div>
                                  <div class="col-12 col-lg-10 custom-control custom-radio">
                                    <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['prj_skor']?>" readonly>

                                  </div>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-12 col-md-12 row">
                                  <div class="col col-md-2">
                                    <label class=" form-control-label">Kategori :</label>
                                  </div>
                                  <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['prj_kategori']?>" readonly>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>PENILAIAN NUTRISI</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row form-group col-12">
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">BB</span>
                                    </div>
                                      <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['pn_bb']?>" readonly>
                                    <div class="input-group-append">
                                      <span class="input-group-text">/Kg</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">TB</span>
                                    </div>
                                    <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['pn_tb']?>" readonly>

                                    <div class="input-group-append">
                                      <span class="input-group-text">cm</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">LILA</span>
                                    </div>
                                    <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['pn_lila']?>" readonly>

                                    <div class="input-group-append">
                                      <span class="input-group-text">cm</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">IMT</span>
                                    </div>
                                    <input type="text" name="keluhan" class="form-control" value="<?php echo @$demografi['pn_imt']?>" readonly>

                                    <div class="input-group-append">
                                      <span class="input-group-text">kh/cm2</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row form-group col-12">
                                <div class="card-header col-12">
                                  <strong>Malnutrion Screening Tool (MST)</strong> untuk pasien dewasa
                                </div><br>
                                <div class="col-lg-6 row">
                                  <strong>1. Apakah ada penurunan berat badan yang tidak diinginkan selam 6 bulan terakhir?</strong>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="mst_11" checked name="mst_1" class="custom-control-input" value="Tidak">
                                    <label class="custom-control-label" for="mst_11">Tidak : skor 0</label>
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="mst_12" name="mst_1" class="custom-control-input" value="Tidak Yakin">
                                    <label class="custom-control-label" for="mst_12">Tidak Yakin : skor 1</label>
                                  </div>
                                  <div class="col-12 col-lg-12 custom-control custom-radio">
                                    <input type="radio" id="mst_13" name="mst_1" class="custom-control-input" value="lain">
                                    <label class="custom-control-label" for="mst_13">Ya, 1-5kg (skor 1), 6-10 (skor 2), 10-15 (skor 3), <= 15 (skor 4)</label>
                                    <input type="text" class="form-control" placeholder="Penurunan Berat badan" name="mst_1_lain">
                                  </div>
                                  <br><br><br><br>
                                  <strong>2. Apakah asupan makan menurun dikarenakan adanya penurunan nafsu makan atau kesulitan menerima makanan ?</strong>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="mst_21" checked name="mst_2" class="custom-control-input" value="Tidak">
                                    <label class="custom-control-label" for="mst_21">Tidak : skor 0</label>
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="mst_22" name="mst_2" class="custom-control-input" value="Ya">
                                    <label class="custom-control-label" for="mst_22">Ya : skor 2</label>
                                  </div>
                                </div>
                                <div class="col-lg-6 bg-secondary">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">TOTAL SKOR :</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="" name="mst_skor" value="0">
                                  </div>
                                  <b>Keterangan :</b><br>
                                  Skor 0 - 1 : Tidak beresiko<br>
                                  Skor 3 - 4 : beresiko (memerlukan asesmen gizi)<br>
                                  Skor <= 4  : Malnutrisi
                                </div>
                              </div>
                              <div class="row form-group col-12">
                                <div class="card-header col-12">
                                  <strong>Modifikasi strongkids</strong> untuk pasien anak
                                </div><br>
                                <div class="col-lg-6 row">
                                  <strong class="col-12">1. Apakah ada penyakit yang beresiko Malnutrisi atau adakah tindakan pembedahan besar?</strong>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="strongkids11" checked name="strongkids1" class="custom-control-input" value="Tidak">
                                    <label class="custom-control-label" for="strongkids11">Tidak : skor 0</label>
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="strongkids12" name="strongkids1" class="custom-control-input" value="Ya">
                                    <label class="custom-control-label" for="strongkids12">Ya : skor 2</label>
                                  </div>
                                  <br><br>
                                  <strong class="col-12">2. Apakah pasien tampak kurus ?</strong>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="strongkids21" checked name="strongkids2" class="custom-control-input" value="Tidak">
                                    <label class="custom-control-label" for="strongkids21">Tidak : skor 0</label>
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="strongkids22" name="strongkids2" class="custom-control-input" value="Ya">
                                    <label class="custom-control-label" for="strongkids22">Ya : skor 1</label>
                                  </div>
                                  <br><br>
                                  <strong class="col-12">3. Apakah terdapat salah satu dari kondisi berikut (dalam 1 minggu terakhir) ?</strong>
                                  <div class="col-12">
                                    - Diare >5x/hari dan/atau muntah >3xhari <br>
                                    - Asupan makan berkurang
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="strongkids31" checked name="strongkids3" class="custom-control-input" value="Tidak">
                                    <label class="custom-control-label" for="strongkids31">Tidak : skor 0</label>
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="strongkids32" name="strongkids3" class="custom-control-input" value="Ya">
                                    <label class="custom-control-label" for="strongkids32">Ya : skor 1</label>
                                  </div>
                                  <br><br>
                                  <strong class="col-12">4. Apakah terjadi penurunan berat badan ataukah tidak ada peningkatan berat badan dalam 1 bulan terakhir ?</strong>
                                  <div class="col-12 col-lg-4 custom-control custom-radio">
                                    <input type="radio" id="strongkids41" checked name="strongkids4" class="custom-control-input" value="Tidak">
                                    <label class="custom-control-label" for="strongkids41">Tidak : skor 0</label>
                                  </div>
                                  <div class="col-12 col-lg-6 custom-control custom-radio">
                                    <input type="radio" id="strongkids42" name="strongkids4" class="custom-control-input" value="Ya">
                                    <label class="custom-control-label" for="strongkids42">Ya : skor 1</label>
                                  </div>
                                </div>
                                <div class="col-lg-6 bg-secondary">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">TOTAL SKOR :</span>
                                    </div>
                                    <input type="text" value="0" class="form-control" aria-label="" name="strongkids_skor">
                                  </div>
                                  <b>Keterangan :</b><br>
                                  Skor 0 - 1 : Tidak beresiko<br>
                                  Skor 3 - 4 : beresiko (memerlukan asesmen gizi)<br>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php echo form_close(); ?>
                    <?php if ($_SESSION['poli']=="OBG"): ?>

                      <div class="row">
                      <div class="col-lg-12">
                        <div class="card">
                          <div class="card-header bg-success text-white">
                            <strong>Riwayat Kesehatan Sekarang :</strong>
                          </div>
                          <input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$idkunjungan; ?>" hidden>
                          <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" hidden>
                          <div class="card-body card-block">
                                <h3> <b>1. Riwayat Menstruasi</b> </h3><hr>
                                <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group row">
                                          <label class="control-label text-right col-md-6">Menarche Umur :</label>
                                          <div class="col-md-6">
                                              <p class="form-control-static"> <?php echo @$demografi['menarche_umur']; ?> </p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group row">
                                          <label class="control-label text-right col-md-6">Lamanya Haid :</label>
                                          <div class="col-md-6">
                                              <p class="form-control-static"> <?php echo @$demografi['lamahaid']; ?> Hari</p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group row">
                                          <label class="control-label text-right col-md-6">Siklus :</label>
                                          <div class="col-md-6">
                                              <p class="form-control-static"> <?php echo @$demografi['siklus']; ?> Hari</p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group row">
                                          <label class="control-label text-right col-md-2">Keluhan :</label>
                                          <div class="col-md-6">
                                              <p class="form-control-static"> <?php echo @$demografi['keluhan_obgyn']; ?></p>
                                          </div>
                                      </div>
                                  </div>
                                </div>


                                <h3> <b>2. Riwayat Kehamilan (Jika Pasien Hamil)</b> </h3><hr>
                                <div class="row">
                                  <div class="col-md-2">
                                      <div class="form-group row">
                                          <label class="control-label text-right col-md-4">G :</label>
                                          <div class="col-md-8">
                                              <p class="form-control-static"> <?php echo @$demografi['g']; ?></p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group row">
                                          <label class="control-label text-right col-md-4">P :</label>
                                          <div class="col-md-8">
                                              <p class="form-control-static"> <?php echo @$demografi['p']; ?></p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group row">
                                          <label class="control-label text-right col-md-4">A :</label>
                                          <div class="col-md-8">
                                              <p class="form-control-static"> <?php echo @$demografi['a']; ?></p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group row">
                                          <label class="control-label text-right col-md-5">HPHT :</label>
                                          <div class="col-md-7">
                                              <p class="form-control-static"> <?php echo @$demografi['hpht']; ?></p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group row">
                                          <label class="control-label text-right col-md-4">HPL :</label>
                                          <div class="col-md-8">
                                              <p class="form-control-static"> <?php echo @$demografi['hpl']; ?></p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group row">
                                          <label class="control-label text-right col-md-4">UK :</label>
                                          <div class="col-md-8">
                                              <p class="form-control-static"> <?php echo @$demografi['uk']; ?></p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group row">
                                          <label class="control-label text-right col-md-4">Keluhan yang dirasakan selama hamil ini :</label>
                                          <div class="col-md-8">
                                              <p class="form-control-static"><input type="text" class="form-control" value="<?php echo @$demografi['keluhanhamil']; ?>" readonly></p>
                                          </div>
                                      </div>
                                  </div>
                                </div>

                            <h3> <b>3. Riwayat Ginektologi</b> </h3><hr>
                                <div class="row form-group">

                                  <div class="col-12 col-md-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Infertilitas" value="Infertilitas" name="infertilitas" class="custom-control-input" <?php if (@$demografi['infertilitas'] !== null){ echo "checked";}?>>
                                        <label class="custom-control-label" for="Infertilitas">Infertilitas</label>
                                    </div>
                                  </div>
                                  <div class="col-12 col-md-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Infeksi" value="Infeksi Virus" name="Infeksi" class="custom-control-input" <?php if (@$demografi['infeksivirus'] !== null){ echo "checked";}?>>
                                        <label class="custom-control-label" for="Infeksi">Infeksi Virus</label>
                                    </div>
                                  </div>
                                  <div class="col-12 col-md-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="PMS" value="PMS" name="PMS" class="custom-control-input" <?php if (@$demografi['pms'] !== null){echo "checked";}?>>
                                        <label class="custom-control-label" for="PMS">PMS</label>
                                    </div>
                                  </div>
                                  <div class="col-12 col-md-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Cervitiscronis" value="Cervitiscronis" name="Cervitiscronis" class="custom-control-input" <?php if (@$demografi['cervitiscronis'] !== null){echo "checked";}?>>
                                        <label class="custom-control-label" for="Cervitiscronis">Cervitiscronis</label>
                                    </div>
                                  </div>
                                  <div class="col-12 col-md-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Endometriosis" value="Endometriosis" name="Endometriosis" class="custom-control-input" <?php if (@$demografi['endometriosis'] !== null){echo "checked";}?>>
                                        <label class="custom-control-label" for="Endometriosis">Endometriosis</label>
                                    </div>
                                  </div>
                                  <div class="col-12 col-md-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Myoma" value="Myoma" name="Myoma" class="custom-control-input" <?php if (@$demografi['myoma'] !== null){echo "checked";}?>>
                                        <label class="custom-control-label" for="Myoma">Myoma</label>
                                    </div>
                                  </div>
                                  <div class="col-12 col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="ok" value="Opreasi Kandungan" name="ok" class="custom-control-input" <?php if (@$demografi['ok'] !== null){echo "checked";}?>>
                                        <label class="custom-control-label" for="ok">Opreasi Kandungan</label>
                                    </div>
                                  </div>
                                  <div class="col-12 col-md-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="Perkosaan" value="Perkosaan" name="Perkosaan" class="custom-control-input" <?php if (@$demografi['perkosaan'] !== null){echo "checked";}?>>
                                        <label class="custom-control-label" for="Perkosaan">Perkosaan</label>
                                    </div>
                                  </div>
                                  <div class="col-12 col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="pcb" value="Post Coital Bleeding" name="pcb" class="custom-control-input" <?php if (@$demografi['pcb'] !== null){ echo "checked";}?>>
                                        <label class="custom-control-label" for="pcb">Post Coital Bleeding</label>
                                    </div>
                                  </div>
                                  <div class="col-12 col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="fa" value="Flour Albus" name="fag" class="custom-control-input" <?php if (@$demografi['fag'] !== null){echo "checked";}?>>
                                        <label class="custom-control-label" for="fa">Flour Albus</label>
                                    </div>
                                  </div>

                                  <div class="col col-md-2 text-right">
                                    <label class=" form-control-label">Gatal :</label>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="gatal1" name="gatal" value="Ya" class="custom-control-input" <?php if (@$demografi['gatal'] == 'Ya'){echo "checked";}?>>
                                        <label class="custom-control-label" for="gatal1">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="gatal2" name="gatal" value="Tidak" class="custom-control-input" <?php if (@$demografi['gatal'] == null || @$demografi['gatal'] == 'Tidak'){echo "checked";}?>>
                                        <label class="custom-control-label" for="gatal2">Tidak</label>
                                    </div>
                                  </div>
                                  <div class="col col-md-2 text-right">
                                    <label class=" form-control-label">Berbau :</label>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="berbau1" name="berbau" value="Ya" class="custom-control-input" <?php if (@$demografi['berbau'] == 'Ya'){echo "checked";}?>>
                                        <label class="custom-control-label" for="berbau1">Ya</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="berbau2" name="berbau" value="Tidak" class="custom-control-input" <?php if (@$demografi['berbau'] == null || @$demografi['gatal'] == 'Tidak'){echo "checked";}?>>
                                        <label class="custom-control-label" for="berbau2">Tidak</label>
                                    </div>
                                  </div>

                              </div>

                            <h3> <b>4. Riwayat KB</b> </h3><hr>
                            <div class="row">
                              <div class="col-md-8">
                                  <div class="form-group row">
                                      <label class="control-label text-right col-md-5">Metode KB yang pernah dipakai :</label>
                                      <div class="col-md-7">
                                          <p class="form-control-static"> <input type="text" class="form-control" value="<?php echo @$demografi['metodekb']; ?>" readonly></p>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group row">
                                      <label class="control-label text-right col-md-4">Lamanya :</label>
                                      <div class="col-md-8">
                                          <p class="form-control-static"><?php echo @$demografi['lamakb']; ?> tahun</p>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group row">
                                      <label class="control-label text-right col-md-2">Komplikasi :</label>
                                      <div class="col-md-8">
                                          <p class="form-control-static"> <input type="text" class="form-control" value="<?php echo @$demografi['komplikasi']; ?>" readonly> </p>
                                      </div>
                                  </div>
                              </div>
                            </div>


                          </div>
                        </div>    </div>

                      </div>

                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
      function hitung_imt(){
        // alert("hdja");
        var tb = $("#tb").val();
        var bb = $("#bb").val();
        if (tb=='') {
          tb=0;
        }
        if (bb=='') {
          bb=0;
        }
        var imt = parseInt(bb / ((tb/100)*(tb/100)));
        if (isNaN(imt) || imt<0) {
          imt=0;
        }
        $("#imt").val(imt);
      }
      function coba() {
        if ($("input#lain_ridul_check:checked").length == 0) {
          $("#lain_ridul").attr('disabled', true);
        } else {
          $("#lain_ridul").attr('disabled', false)
          $("#lain_ridul").focus();;
        }
      }
      </script>
