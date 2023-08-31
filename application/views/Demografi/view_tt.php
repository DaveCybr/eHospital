
<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
              <h3><a href="" class="white-text mx-3">TIMBANG TERIMA PASIEN</a><h3>
              </div>
              <div class="card-body card-block">
                <?php echo form_open_multipart('Asesmen/insert_timbangterima');?>
                <?php echo @$error;?>
                <input type="hidden" name="nomerkun" value="<?php echo $this->uri->segment(3)?>">
                <div class="card-body card-block">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="card border-info" style="border: 2px solid;">
                        <div class="card-header bg-info text-white">
                          <strong>TANDA VITAL</strong>
                        </div>
                        <div class="card-body card-block">
                          <div class="row p-t-20 p-b-50">
                            <div class="col-xl-12 col-md-12 col-sm-12">

                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text suhu">Suhu</span>
                                </div>
                                <input type="text" class="form-control" aria-label="" name="suhu" value="<?php echo @$timbang['suhu'] ?>" readonly>
                                <div class="input-group-append">
                                  <span class="input-group-text">^C</span>
                                </div>

                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">

                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Sistole</span>
                                </div>
                                <input type="text" class="form-control" aria-label="" name="siastole" value="<?php echo @$timbang['sistole'] ?>" readonly>
                                <div class="input-group-append">
                                  <span class="input-group-text">mmhg</span>
                                </div>

                                <div class="input-group-prepend">
                                  <span class="input-group-text">Diastole</span>
                                </div>
                                <input type="text" class="form-control" aria-label="" name="diastole" value="<?php echo @$timbang['diastole'] ?>" readonly>
                                <div class="input-group-append">
                                  <span class="input-group-text">mmhg</span>
                                </div>

                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">

                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Nadi</span>
                                </div>
                                <input type="text" class="form-control" aria-label="" name="nadi" value="<?php echo @$timbang['nadi'] ?>" readonly>
                                <div class="input-group-append">
                                  <span class="input-group-text">x/menit</span>
                                </div>
                                <div class="input-group-prepend">
                                  <span class="input-group-text">RR</span>
                                </div>
                                <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['respirasi'] ?>" readonly>
                                <div class="input-group-append">
                                  <span class="input-group-text">x/menit</span>
                                </div>

                              </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">

                              <div class="input-group" style="margin-bottom:40px">
                                <div class="input-group-prepend">
                                  <span class="input-group-text suhu">Keluhan</span>
                                </div>
                                <input type="text" class="form-control" aria-label="" name="keluhan" value="<?php echo @$timbang['keluhan_umum'] ?>" readonly>
                                <!-- <div class="input-group-append">
                                <span class="input-group-text">^C</span>
                              </div> -->

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>B1 (SISTEM PERNAPASAN)</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row p-t-20">
                          <!-- <div class="col col-md-7"> -->
                          <label class=" form-control-label">Keluhan napas :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['keluhan_napas'] ?>" readonly>

                          <label class=" form-control-label">Irama napas :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['irama_napas'] ?>" readonly>

                          <label class=" form-control-label">Suara napas :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['suara_napas'] ?>" readonly>

                          <!-- <div class="col-xl-12 col-md-12 col-sm-12"> -->
                          <br>
                          <div class="input-group mt-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text suhu">Oksigen</span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="oksigen" value="<?php echo @$timbang['oksigen'] ?>" readonly>
                            <div class="input-group-append">
                              <span class="input-group-text">L/menit</span>
                            </div>

                          </div>
                          <!-- </div> -->

                        </div>
                      </div>
                    </div>


                  </div>

                  <div class="col-lg-6">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>B2 (SISTEM KARDIOVASKULER)</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row p-t-20">

                          <label class=" form-control-label">Keluhan nyeri dada :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['nyeri_dada'] ?>" readonly>

                          <label class=" form-control-label">Irama Jantung :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['irama_jantung'] ?>" readonly>

                          <label class=" form-control-label">CRT :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['crt'] ?>" readonly>

                          <label class=" form-control-label">Konjungtiva Pucat :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['konjungtiva'] ?>" readonly>

                          <!-- </div> -->

                        </div>
                      </div>
                    </div>


                  </div>
                  <div class="col-lg-6">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>B3 (SISTEM PERSARAFAN)</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row p-t-20">

                          <label class=" form-control-label">kesadaran :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['kesadaran'] ?>" readonly>

                          <!-- <div class="col-sm-12 col-md-2"> -->
                          <label class=" form-control-label">GCS :</label>
                          <!-- </div> -->
                          <!-- <div class="col-sm-12 col-lg-10 row"> -->
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">E :</span>
                            </div>
                            <input type="number" min="1" max="6" class="ea form-control in_max" aria-label="" name="GCS_E" value="<?php echo @$timbang['gcs_e'] ?>" readonly>
                            <div class="input-group-prepend">
                              <span class="input-group-text">V :</span>
                            </div>
                            <input type="number" min="1" max="6" class="va form-control in_max" aria-label="" name="GCS_V" value="<?php echo @$timbang['gcs_v'] ?>" readonly>
                            <div class="input-group-prepend">
                              <span class="input-group-text">M :</span>
                            </div>
                            <input type="number" min="1" max="6" class="ma form-control in_max" aria-label="" name="GCS_M" value="<?php echo @$timbang['gcs_m'] ?>" readonly>
                          </div>
                          <!-- </div> -->
                          <label class=" form-control-label">Keluhan Pusing :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['keluhan_pusing'] ?>" readonly>

                          <label class=" form-control-label">Pupil :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['pupil'] ?>" readonly>


                          <!-- <div class="col-xl-12 col-md-12 col-sm-12"> -->

                          <div class="input-group mt-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text suhu">Diameter</span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="diameter1" value="<?php echo @$timbang['diameter_pupil'] ?>" readonly>
                            <div class="input-group-append">
                              <span class="input-group-text">mm</span>
                            </div>



                          </div>
                          <!-- </div> -->
                          <label class=" form-control-label">Nyeri :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['nyeri'] ?>" readonly>

                          <div class="input-group mb-3" >
                            <div class="input-group-prepend">
                              <span class="input-group-text suhu">Skala Nyeri</span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="skala_nyeri" value="<?php echo @$timbang['skala_nyeri'] ?>" readonly>
                            <div class="input-group-append">
                              <span class="input-group-text">Lokasi Nyeri</span>
                            </div>

                            <input type="text" class="form-control" aria-label="" name="lokasi_nyeri" value="<?php echo @$timbang['lokasi_nyeri'] ?>" readonly>


                          </div>
                          <!-- </div> -->

                        </div>
                      </div>
                    </div>


                  </div>
                  <div class="col-lg-6">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>B4 (SISTEM PERKEMIHAN)</strong>
                      </div>
                      <div class="card-body card-block"  style="padding-bottom:360px">
                        <div class="row p-t-20">

                          <label class=" form-control-label">Keluhan :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['keluhan_perkemihan'] ?>" readonly>

                          <label class=" form-control-label">Anuria :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['anuria'] ?>" readonly>

                          <label class=" form-control-label">Kandung Kemih :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['kandung_kemih'] ?>" readonly>

                          <label class=" form-control-label">Nyeri Tekan :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['nyeri_tekan'] ?>" readonly>

                          <label class=" form-control-label">Alat Bantu :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['alat_bantu'] ?>" readonly>

                          <label class=" form-control-label">Intake cairan :</label>
                          <!-- </div> -->
                          <!-- <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['intake_cair'] ?>" readonly> -->

                          <div class="input-group mt-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Oral</span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="oral" value="<?php echo @$timbang['oral'] ?>" readonly>
                            <div class="input-group-append">
                              <span class="input-group-text">cc/hr</span>
                            </div>

                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Parenteral</span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="parenteral" value="<?php echo @$timbang['parenteral'] ?>" readonly>
                            <div class="input-group-append">
                              <span class="input-group-text">cc/hr</span>
                            </div>

                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Produksi urine</span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="produksi_urine" value="<?php echo @$timbang['produksi_urine'] ?>" readonly>
                            <div class="input-group-append">
                              <span class="input-group-text">ml/hr</span>
                            </div>

                            <div class="input-group-append">
                              <span class="input-group-text">Warna</span>
                            </div>

                            <input type="text" class="form-control" aria-label="" name="warna_urine" value="<?php echo @$timbang['warna_urine'] ?>" readonly>


                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Bau</span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="bau_urine" value="<?php echo @$timbang['bau_urine'] ?>" readonly>

                          </div>
                          <!-- </div> -->

                        </div>
                      </div>
                    </div>


                  </div>


                  <div class="col-lg-6">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>B5 (SISTEM PENCERNAAN)</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row p-t-20">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text suhu">Lingkaran abdomen</span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="abdomen" value="<?php echo @$timbang['abdomen'] ?>" readonly>
                            <div class="input-group-append">
                              <span class="input-group-text">cm</span>
                            </div>
                          </div>

                          <label class=" form-control-label">Mukosa mulut :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['mukosa_mulut'] ?>" readonly>


                          <label class=" form-control-label">Tenggorokan :</label>
                          <!-- </div> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['tenggorokan'] ?>" readonly>

                          <label class=" form-control-label">Abdomen :</label>
                          <!-- </div> -->
                          <!-- <div class="col-12 col-md-12 row"> -->
                          <input type="text" class="form-control rr" aria-label="" name="rr" value="<?php echo @$timbang['abdomen_2'] ?>" readonly>


                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text suhu">Lokasi Nyeri Tekan</span>
                            </div>
                            <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['lokasi_nyeri_tekan'] ?>" readonly>
                            <!-- <div class="input-group-append">
                            <span class="input-group-text">cm</span>
                          </div> -->
                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text suhu">Lokasi Jejas</span>
                          </div>
                          <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['lokasi_jejas'] ?>" readonly>
                          <!-- <div class="input-group-append">
                          <span class="input-group-text">cm</span>
                        </div> -->
                        </div>

                        <label class="form-control-label">Mual :</label>
                        <!-- </div> -->
                        <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['mual'] ?>" readonly>

                        <label class=" form-control-label">Muntah :</label>
                        <!-- </div> -->
                        <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['muntah'] ?>" readonly>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text suhu">Bising Usus</span>
                          </div>
                          <input type="text" class="form-control" aria-label="" name="bising_usus" value="<?php echo @$timbang['bising_usus'] ?>" readonly>
                          <div class="input-group-append">
                            <span class="input-group-text">x/menit</span>
                          </div>
                        </div>
                        <label class=" form-control-label">Terpasang NGT :</label>
                        <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['ngt'] ?>" readonly>

                        <label class=" form-control-label">Diet :</label>
                        <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['diet'] ?>" readonly>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text suhu">Frekuensi</span>
                          </div>
                          <input type="text" class="form-control" aria-label="" name="frekuensi" value="<?php echo @$timbang['frekuensi'] ?>" readonly>
                          <div class="input-group-append">
                            <span class="input-group-text">x/hari</span>
                          </div>

                          <div class="input-group-append">
                            <span class="input-group-text">Jumlah</span>
                          </div>

                          <input type="text" class="form-control" aria-label="" name="jumlah" value="<?php echo @$timbang['jumlah'] ?>" readonly>


                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text suhu">Jenis</span>
                          </div>
                          <input type="text" class="form-control" aria-label="" name="jenis" value="<?php echo @$timbang['jenis'] ?>" readonly>

                          <div class="input-group-append">
                            <span class="input-group-text">BAB</span>
                          </div>

                          <input type="text" class="form-control" aria-label="" name="bab" value="<?php echo @$timbang['bab'] ?>" readonly>

                          <div class="input-group-append">
                            <span class="input-group-text">x/hari</span>
                          </div>

                        </div>
                        <label class=" form-control-label">Konsistensi :</label>
                        <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['konsistensi'] ?>" readonly>

                        <label class=" form-control-label">Konstipasi :</label>
                        <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['konstipasi'] ?>" readonly>

                      </div>


                    </div>
                    <!-- </div> -->

                  </div>
                </div>
              </div>


            </div>
            <div class="col-lg-6">
              <div class="card border-info" style="border: 2px solid;">
                <div class="card-header bg-info text-white">
                  <strong>B6 (MUSKULOSKLETAL DAN INTEGUMEN)</strong>
                </div>
                <div class="card-body card-block">
                  <div class="row p-t-20">
                    <label class=" form-control-label">Sendi :</label>
                    <!-- </div> -->
                    <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['sendi'] ?>" readonly>

                    <label class=" form-control-label">Frakture :</label>
                    <!-- </div> -->
                    <div class="col-12 col-md-12 row">
                      <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['frakture'] ?>" readonly>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text suhu">Lokasi Frakture</span>
                        </div>
                        <input type="text" class="form-control" aria-label="" name="lokasi_fraktur" value="<?php echo @$timbang['lokasi_frakture'] ?>" readonly>
                        <!-- <div class="input-group-append">
                        <span class="input-group-text">cm</span>
                      </div> -->
                    </div>
                    </div>
                    <label class=" form-control-label">Traksi/spalks/gips :</label>
                    <!-- </div> -->
                    <div class="col-12 col-md-12 row">
                      <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['gips'] ?>" readonly>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text suhu">Lokasi Gips</span>
                        </div>
                        <input type="text" class="form-control" aria-label="" name="lokasi_gips" value="<?php echo @$timbang['lokasi_gips'] ?>" readonly>
                        <!-- <div class="input-group-append">
                        <span class="input-group-text">cm</span>
                      </div> -->
                    </div>
                    </div>
                    <label class=" form-control-label">Kompartemen syndrome:</label>
                    <!-- </div> -->
                    <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['syndrome'] ?>" readonly>

                    <label class=" form-control-label">Kulit :</label>
                    <!-- </div> -->
                    <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['kulit'] ?>" readonly>

                    <label class=" form-control-label">Akral :</label>
                    <!-- </div> -->
                    <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['akral'] ?>" readonly>

                    <label class=" form-control-label">Turgor :</label>
                    <!-- </div> -->
                    <input type="text" class="form-control mb-3" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['turgor'] ?>" readonly>


                    <label class=" form-control-label">Luka :</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text suhu">Luka Jenis</span>
                      </div>
                      <input type="text" class="form-control" aria-label="" name="jenis_luka" value="<?php echo @$timbang['jenis_luka'] ?>" readonly>

                      <div class="input-group-append">
                        <span class="input-group-text">Luas Luka</span>
                      </div>

                      <input type="text" class="form-control" aria-label="" name="luas_luka" value="<?php echo @$timbang['luas_luka'] ?>" readonly>


                    </div>
                    <!-- </div> -->
                    <input type="text" class="form-control" aria-label="" name="lokasi_jejas" value="<?php echo @$timbang['jenis_luka2'] ?>" readonly>

                    <!-- </div> -->

                  </div>
                </div>
              </div>


            </div>
            <div class="col-lg-12">
                          <div class="card border-info" style="border: 2px solid;">
                            <div class="card-header bg-info text-white">
                              <strong>LAIN LAIN</strong>
                            </div>
                            <div class="card-body card-block">
                              <div class="row p-t-20">
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text suhu">Lainnya</span>
                                  </div>
                                  <!-- <input type="text" class="form-control" aria-label="" name="lainnya" value="<?php echo @$timbang['lainnya'] ?>" readonly> -->
                                  <textarea class="form-control" readonly rows="4" name="rekomendas"><?php echo @$asesmen['lainnya']; ?></textarea>




                                </div>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text suhu">Rekomendasi</span>
                                  </div>
                                  <!-- <input type="text" class="form-control" aria-label="" name="rekomendasi" value="<?php echo @$timbang['rekomendasi'] ?>" readonly> -->

                                  <textarea class="form-control" readonly rows="4" name="rekomendasi"><?php echo @$asesmen['rekomendasi']; ?></textarea>


                                </div>
                                <!-- </div> -->

                              </div>
                            </div>
                          </div>


                        </div>


          </div>
        </div>
        <?php echo form_close(); ?>
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
