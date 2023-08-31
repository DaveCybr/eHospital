<?php
$this->load->model('ModelRole');
$user_Roles = $this->db->get_where('user', array('id_user' => $_SESSION['id_login'],))->row_array();
$roles_Roles = explode(', ', $user_Roles['roles']);
foreach ($roles_Roles as $value) {
  $Menu_Roles[$value] = true;
  $this->db->reset_query();
  $this->db->select('group_roles_idgroup_roles');
  $this->db->group_by('group_roles_idgroup_roles');
  $Group_Roles = $this->db->get_where('roles', array('roles' => $value,))->result();
  foreach ($Group_Roles as $value) {
    $Menu_Group[$value->group_roles_idgroup_roles] = true;
  }
}
?>
<!-- ============================================================== -->
<!-- Info box -->
<!-- ============================================================== -->
<!--Grid column-->

<div class="row">
  <div class="row col-xl-12 col-md-12 col-sm-12">
    <div class="col-xl-12">
      <div class="card card-cascade narrower z-depth-1">
        <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

          <h4 id="info"><a href="#" class="white-text mx-3"><i class="fas fa-info-circle"></i> Informasi Kunjungan</a></h4>

        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-xl-2 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">No Kunjungan</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$idkunjungan; ?>" required readonly>

                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-2 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">No Antrian</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="no_antrian" id="no_antrian" class="form-control" placeholder="nokun" value="<?php echo @$kunjungan['no_antrian']; ?>" required readonly>

                </div>
              </div>
            </div>

            <div class="col-md-6 col-xl-3 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Tanggal Kunjungan</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo date('Y-m-d', strtotime($kunjungan['tgl'])); ?>" required readonly>

                </div>
              </div>
            </div>

            <div class="col-md-6 col-xl-2 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Jam Daftar</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="jenis_kunjungan" id="jenis_kunjungan" class="form-control" placeholder="jenis_kunjungan" value="<?php echo @$kunjungan['jam_daftar']; ?>" required readonly>

                </div>
              </div>
            </div>

            <div class="col-md-6 col-xl-3 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">No Bpjs</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="jenis_kunjungan" id="jenis_kunjungan" class="form-control" placeholder="nomor bpjs" value="<?php echo @$pasien['noBPJS']; ?>" required readonly>

                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-2 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Tujuan Poli</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="tupel" id="tupel" class="form-control" placeholder="tujuan pelayanan" value="<?php echo @$tupel['tujuan_pelayanan']; ?>" required readonly>

                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-2 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">No RM Pasien</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" required readonly>

                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-2 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Prolanis</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="no_rm" id="norm" class="form-control" placeholder="Bukan Prolanis" value="<?php echo @$pasien['pstprol']; ?>" required readonly>

                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Nama Pasien</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo @$pasien['namapasien']; ?>" required readonly>

                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3 col-sm-6">
              <div class="form-group">
                <label for="exampleInputuname">Jenis Kunjungan</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                  </div>
                  <input type="text" name="jenis_kunjungan" id="jenis_kunjungan" class="form-control" placeholder="jenis_kunjungan" value="<?php echo @$jenispasien['jenis_pasien']; ?>" required readonly>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <?php if ($hiv > 0) : ?>
    <div class="row col-md-12 ">
      <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 mb-12">
        <div class="alert alert-danger">
          <strong>Danger!</strong> Pasien pernah memiliki riwayat penyakit HIV
        </div>
      </div>

    </div>
  <?php endif; ?>
  <?php if ($kunjungan['sumber_dana'] == 7 || $kunjungan['sumber_dana'] == 9) : ?>
    <?php if ($_SESSION['poli'] != "IGD") : ?>
      <?php if ($kunjungan['status_bridging'] == 0) : ?>
        <div class="row col-md-12 ">
          <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 mb-12">
            <div class="alert alert-danger">
              <strong>Danger!</strong> bridging pendaftaran gagal dilakukan, lakukan bridging pendaftaran kembali sebelum melakukan pemeriksaan
              <a href="<?php echo base_url() . "Periksa/bridge_ulang_pendaftaran2/" . $idkunjungan ?>"><button class="btn btn-sm btn-primary pull-right">Bridging Sekarang</button>
              </a>
            </div>
          </div>

        </div>

      <?php endif; ?>
      <?php
      $jd = $this->ModelPeriksa->get_diagnosa(@$periksa['idperiksa'])->num_rows();
      if ($jd > 0 && $kunjungan['status_bridging_pemeriksaan'] == 0) : ?>

        <div class="row col-md-12 ">
          <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 mb-12">
            <div class="alert alert-danger">
              <strong>Danger!</strong> bridging pemeriksaan gagal dilakukan, lakukan bridging pemeriksa kembali sebelum pasien dipulangkan
              <!-- <a href="<?php echo base_url() . "Periksa/bridge_ulang2/" . $idkunjungan ?>"><button class="btn btn-sm btn-primary pull-right">Bridging Sekarang</button></a> -->
              <a href="<?php echo base_url() . "Periksa/bridge_ulang3/" . $idkunjungan ?>"><button class="btn btn-sm btn-primary pull-right">Bridging Sekarang</button></a>
            </div>
          </div>

        </div>
      <?php endif; ?>
      <?php if ($kunjungan['status_bridging_pemeriksaan'] == 1 && $kunjungan['nokun_bridging'] == NULL) : ?>
        <div class="row col-md-12 ">
          <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 mb-12">
            <div class="alert alert-danger">
              <strong>Danger!</strong> nomor pemeriksaan tidak tersimpan, lakukan bridging pemeriksan kembali sebelum pasien dipulangkan
              <a href="<?php echo base_url() . "Periksa/ambil_nokun_terbaru/" . $idkunjungan . "/" . $pasien['noBPJS'] ?>"><button class="btn btn-sm btn-primary pull-right">Bridging Sekarang</button></a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php else : ?>
      <div class="row col-md-12 ">
        <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 mb-12">
          <div class="alert alert-info">
            <strong>Info!</strong> Jika pasien tidak dirujuk ke rawat inap, silahkan lakukan bridging manual dengan cara klik tombol bridging rawat jalan. Tetapi jika pasien dirujuk ke rawat inap, lewati langkah tersebut dan langsung rujuk pasien ke rawat inap
            </a>
          </div>
        </div>

      </div>
    <?php endif; ?>
  <?php endif; ?>

  <div class="row col-xl-12 col-md-12 col-sm-12">

    <?php
    $jabatan = $_SESSION['jabatan'];
    $bidan = strpos($jabatan, "bidan");
    $perawat = strpos($jabatan, "pumu");
    $perawatG = strpos($jabatan, "pgig");
    $perawatI = strpos($jabatan, "pint");
    $perawatO = strpos($jabatan, "pozo");
    $perawatU = strpos($jabatan, "pugd");
    ?>
    <!--Grid column-->
    <?php if (@$bidan !== 0 && @$perawat !== 0 && @$perawatG !== 0 && @$perawatI !== 0 && @$perawatO !== 0 && @$perawatU !== 0) : ?>
      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <?php
              if (@$periksa['idperiksa'] !== null) {
                if (@$tupel['kode_tupel'] == "GIG") {
              ?>
                  <a type="button" class="btn-floating btn-lg purple lighten-2" data-toggle="modal" data-target="#periksaGig">

                  <?php
                } else {
                  ?>
                    <a type="button" class="btn-floating btn-lg purple lighten-2" data-toggle="modal" data-target="#periksaUmu">

                    <?php
                  }
                } else { ?>
                    <?php if (@$tupel['kode_tupel'] == "GIG") : ?>
                      <a type="button" class="btn-floating btn-lg purple lighten-2" href="<?php echo base_url(); ?>PoliGigi/input/<?php echo @$idkunjungan; ?>">
                      <?php else : ?>
                        <a type="button" class="btn-floating btn-lg purple lighten-2" href="<?php echo base_url(); ?>Periksa/pemeriksaan/<?php echo @$idkunjungan; ?>">
                        <?php endif; ?>
                      <?php
                    }
                      ?>
                      <i class="fas fa-stethoscope" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Pemeriksaan Pasien</p>
            </div>


          </div>
          <!--/.Card content-->

        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <?php if (@$periksa['idperiksa'] == null) { ?>
                <a type="button" class="btn-floating btn-lg grey lighten-2" data-toggle="modal" data-target="#modalLoginAvatarDemo">

                <?php
              } else { ?>
                  <?php
                  $jmldiagnosa = $this->ModelPeriksa->get_diagnosa(@$periksa['idperiksa'])->num_rows();
                  $jmltindakan = $this->ModelPeriksa->get_tindakan(@$periksa['idperiksa'])->num_rows();
                  if ($jmldiagnosa > 0 || $jmltindakan > 0) { ?>
                    <a type="button" class="btn-floating btn-lg lime darken-2" data-toggle="modal" data-target="#tindakanMedis">
                    <?php
                  } else { ?>
                      <a type="button" class="btn-floating btn-lg lime darken-2" href="<?php echo base_url(); ?>Periksa/tindakan/<?php echo @$periksa['idperiksa']; ?>">
                      <?php } ?>
                    <?php
                  }
                    ?><i class="fas fa-syringe" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Tindakan Medis</p>
            </div>


          </div>
          <!--/.Card content-->


        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <?php if (@$periksa['idperiksa'] == null) { ?>
                <a type="button" class="btn-floating btn-lg grey lighten-2" data-toggle="modal" data-target="#modalLoginAvatarDemo">
                <?php
              } else { ?>
                  <?php
                  $jmllab = $this->ModelPeriksa->get_lab(@$periksa['idperiksa'])->num_rows();
                  if ($jmllab > 0) { ?>
                    <a type="button" class="btn-floating btn-lg brown darken-2" data-toggle="modal" data-target="#permintaanLab">
                    <?php } else { ?>
                      <a type="button" class="btn-floating btn-lg brown darken-2" href="<?php echo base_url(); ?>Periksa/lab/<?php echo @$periksa['idperiksa']; ?>">
                    <?php
                  }
                }
                    ?>
                    <i class="fas fa-microscope" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Permintaan Laborat</p>
            </div>


          </div>

          <!--/.Card content-->

        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <?php if (@$periksa['idperiksa'] == null) { ?>
                <a type="button" class="btn-floating btn-lg grey lighten-2" data-toggle="modal" data-target="#modalLoginAvatarDemo">
                <?php
              } else { ?>
                  <?php
                  $jmlresep = $this->ModelPeriksa->get_resep(@$periksa['idperiksa'])->num_rows();
                  if ($jmlresep > 0) { ?>
                    <a type="button" class="btn-floating btn-lg g deep-orange darken-2" data-toggle="modal" data-target="#resepPasien">
                    <?php } else { ?>
                      <a type="button" class="btn-floating btn-lg g deep-orange darken-2" href="<?php echo base_url(); ?>Periksa/resep/<?php echo @$periksa['idperiksa']; ?>">
                      <?php } ?>
                    <?php
                  } ?>

                    <i class="fas fa-pills" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Buat Resep Pasien</p>
            </div>


          </div>
          <!--/.Card content-->

        </div>
        <!--/.Card-->

      </div>

      <!-- <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4"></div> -->
      <!--Grid column-->
      <?php if ($kunjungan['jenis_kunjungan'] == 0 || @$tupel['kode_tupel'] == "IGD") : ?>

        <!-- <div class="col-xl-3  col-sm-6 col-xs-6 mb-4"></div> -->
      <?php endif; ?>
      <!--Grid column-->
      <?php if ($_SESSION['poli'] != "IGD") : ?>

        <!-- <div class="col-xl-3 col-sm-6 col-xs-6 mb-4"></div> -->
      <?php endif; ?>
      <!--Grid column-->
    <?php endif; ?>
    <!--Grid column-->
    <!--Grid column-->
    <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

      <!--Card-->
      <div class="card white z-depth-2">

        <!--Card Data-->
        <div class="row mt-3">
          <div class="col-md-12 col-12 text-center">
            <a type="button" class="btn-floating btn-lg red lighten-2" data-toggle="modal" data-target="#riwayatKunjungan"><i class="fas fa-user-clock" aria-hidden="true"></i></a>
          </div>
        </div>
        <!--/.Card Data-->

        <!--Card content-->
        <div class="row my-3">
          <div class="col-md-12 col-12 text-center">
            <p class="text-primary font-up font-weight-bold">Riwayat Kunjungan</p>
          </div>


        </div>
        <!--/.Card content-->

      </div>
      <!--/.Card-->

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

      <!--Card-->
      <div class="card white z-depth-2">

        <!--Card Data-->
        <div class="row mt-3">
          <div class="col-md-12 col-12 text-center">
            <a type="button" class="btn-floating btn-lg light-green darken-1" data-toggle="modal" data-target="#riwayatPenyakit"><i class="fas fa-diagnoses" aria-hidden="true"></i></a>
          </div>
        </div>
        <!--/.Card Data-->

        <!--Card content-->
        <div class="row my-3">
          <div class="col-md-12 col-12 text-center">
            <p class="text-primary font-up font-weight-bold">Riwayat Penyakit</p>
          </div>


        </div>
        <!--/.Card content-->

      </div>
      <!--/.Card-->

    </div>
    <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

      <!--Card-->
      <div class="card white z-depth-2">

        <!--Card Data-->
        <div class="row mt-3">
          <div class="col-md-12 col-12 text-center">
            <a href="<?php echo base_url() ?>APO/Konsultasi/Chat/<?php echo $kunjungan['pasien_noRM'] ?>" type="button" class="btn-floating btn-lg green darken-1"><i class="fas fa-comment" aria-hidden="true"></i></a>
          </div>
        </div>
        <!--/.Card Data-->

        <!--Card content-->
        <div class="row my-3">
          <div class="col-md-12 col-12 text-center">
            <p class="text-primary font-up font-weight-bold">Riwayat Konsultasi</p>
          </div>


        </div>
        <!--/.Card content-->

      </div>
      <!--/.Card-->

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

      <!--Card-->
      <div class="card white z-depth-2">

        <!--Card Data-->
        <div class="row mt-3">
          <div class="col-md-12 col-12 text-center">
            <a type="button" class="btn-floating btn-lg orange darken-2" data-toggle="modal" data-target="#riwayatLab"><i class="fas fa-vial" aria-hidden="true"></i></a>
          </div>
        </div>
        <!--/.Card Data-->

        <!--Card content-->
        <div class="row my-3">
          <div class="col-md-12 col-12 text-center">
            <p class="text-primary font-up font-weight-bold">Riwayat Kunjungan Lab</p>
          </div>


        </div>
        <!--/.Card content-->

      </div>
      <!--/.Card-->

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

      <!--Card-->
      <div class="card white z-depth-2">

        <!--Card Data-->
        <div class="row mt-3">
          <div class="col-md-12 col-12 text-center">
            <a type="button" class="btn-floating btn-lg pink darken-2" data-toggle="modal" data-target="#dataPasien"><i class="fas fa-user-secret" aria-hidden="true"></i></a>
          </div>
        </div>
        <!--/.Card Data-->

        <!--Card content-->
        <div class="row my-3">
          <div class="col-md-12 col-12 text-center">
            <p class="text-primary font-up font-weight-bold">Data Diri Pasien</p>
          </div>


        </div>
        <!--/.Card content-->

      </div>
      <!--/.Card-->

    </div>
    <!--Grid column-->

    <?php if ($_SESSION['poli'] == "IGD" && $kunjungan['acc_ranap'] != 1 && ($kunjungan['sumber_dana'] == 7 || $kunjungan['sumber_dana'] == 9)) : ?>
      <!--Grid column-->
      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">

        <!--Card-->
        <div class="card white z-depth-2">

          <!--Card Data-->
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <a href="<?php echo base_url() . "Periksa/bridging_ugd/" . $idkunjungan ?>" type="button" class="btn-floating btn-lg pink darken-2"><i class="fas fa-link" aria-hidden="true"></i></a>
            </div>
          </div>
          <!--/.Card Data-->

          <!--Card content-->
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Bridging Rawat Jalan</p>
            </div>


          </div>
          <!--/.Card content-->

        </div>
        <!--/.Card-->

      </div>
      <!--Grid column-->
    <?php endif; ?>
    <?php if ((($_SESSION['poli'] != "IGD" && $kunjungan['rujuk_poli'] != 1) || ($_SESSION['poli'] == "IGD" && $kunjungan['rujukan_internal'] != 1))) : ?>

      <!-- <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">
        <div class="card white z-depth-2">
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <a type="button" class="btn-floating btn-lg red darken-1" data-toggle="modal" data-target="#rujuk_internal"><i class="fas fa-ambulance" aria-hidden="true"></i></a>
            </div>
          </div>
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <?php if ($_SESSION['poli'] == "IGD") : ?>
                <p class="text-primary font-up font-weight-bold">Rujuk Ke Rawat Inap</p>
              <?php else : ?>
                <p class="text-primary font-up font-weight-bold">Rujuk Ke UGD</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div> -->
    <?php endif; ?>

    <?php if ($kunjungan['sumber_dana'] == 7 || $kunjungan['sumber_dana'] == 9) : ?>

      <div class="col-xl-3 col-md-4 col-sm-6 col-xs-6 mb-4">
        <div class="card white z-depth-2">
          <div class="row mt-3">
            <div class="col-md-12 col-12 text-center">
              <?php if ($kunjungan['rujuk_lanjut'] == 1) : ?>
                <a href="<?php echo base_url() . "Periksa/CetakRujukan/" . $kunjungan['no_urutkunjungan'] ?>" target="_blank" type="button" class="btn-floating btn-lg green darken-1"><i class="fas fa-ambulance" aria-hidden="true"></i></a>
              <?php else : ?>
                <a type="button" class="btn-floating btn-lg green darken-1" data-toggle="modal" data-target="#rujukEksternal"><i class="fas fa-ambulance" aria-hidden="true"></i></a>
              <?php endif; ?>
            </div>
          </div>
          <div class="row my-3">
            <div class="col-md-12 col-12 text-center">
              <p class="text-primary font-up font-weight-bold">Rujuk Ke Rumah Sakit Lain</p>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

  </div>

  <?php $this->load->view("Periksa/modal_avatar") ?>
  <?php

  if (@$jmlresep > 0) {
    $resepku = $this->ModelPeriksa->get_resep(@$periksa['idperiksa'])->row_array();
    $this->load->view("Periksa/modal_large", array(
      'id' => 'resepPasien',
      'judul' => 'Resep Untuk Pasien Ini',
      'icon' => 'fas fa-user-secret',
      'view' => 'Periksa/form/resep',
      'edit' => 1,
      'link' => base_url() . "Periksa/edit_resep/" . $periksa['idperiksa'] . "/" . $resepku['resep_no_resep'],

    ));
  }
  if (@$jmllab > 0) {
    // die(var_dump($edit));
    $this->load->view("Periksa/modal_large", array(
      'id' => 'permintaanLab',
      'judul' => 'Permintaan Lab Untuk Pasien Ini',
      'icon' => 'fas fa-user-secret',
      'view' => 'Periksa/form/laborat',
      'edit' => 1,
      'link' => base_url() . "Periksa/edit_lab/" . $periksa['idperiksa']
    ));
  }
  if (@$jmlbhp > 0) {
    $this->load->view("Periksa/modal_large", array(
      'id' => 'bhpPasien',
      'judul' => 'Bahan Habis Pakai',
      'icon' => 'fas fa-user-secret',
      'view' => 'Periksa/form/bhp',
      'edit' => 0,
      'link' => base_url() . "Periksa/edit_lab/" . $periksa['idperiksa']
    ));
  }
  if (@$jmldiagnosa > 0 || @$jmltindakan > 0) {
    // die(var_dump($edit));
    $this->load->view("Periksa/modal_large", array(
      'id' => 'tindakanMedis',
      'judul' => 'Tindakan & Diagnosa Medis Yang Telah Dilakukan',
      'icon' => 'fas fa-user-secret',
      'view' => 'Periksa/form/tindakan',
      'edit' => 1,
      'link' => base_url() . "Periksa/edit_tindakan/" . $periksa['idperiksa']
    ));
  }
  if (@$periksa['idperiksa'] !== null) {
    if (@$tupel['kode_tupel'] == "GIG") {
      $this->load->view("Periksa/modal_new", array(
        'id' => 'periksaGig',
        'judul' => 'Hasil Periksa Gigi',
        'icon' => 'fas fa-user-secret',
        'view' => 'Periksa/form/periksa_gigi',
        'edit' => 1,
        'link' => base_url() . "PoliGigi/edit_pemeriksaan/" . $this->uri->segment(3)

      ));
    } else {
      $this->load->view("Periksa/modal_new", array(
        'id' => 'periksaUmu',
        'judul' => 'Hasil Periksa',
        'icon' => 'fas fa-user-secret',
        'view' => 'Periksa/form/periksa2',
        'edit' => 1,
        'link' => base_url() . "Periksa/edit_pemeriksaan/" . $this->uri->segment(3)
      ));
    }
  }
  $this->load->view("Periksa/modal_large", array(
    'id' => 'dataPasien',
    'judul' => 'Data Diri Pasien',
    'icon' => 'fas fa-user-secret',
    'view' => 'Periksa/form/data_pasien',
    'edit' => 0
  ));
  $this->load->view("Periksa/modal_large", array(
    'id' => 'riwayatLab',
    'judul' => 'Riwayat Kunjungan Laborat',
    'icon' => 'fas fa-user-secret',
    'view' => 'Periksa/riwayat/riwayat_laborat',
    'edit' => 0
  ));
  $this->load->view("Periksa/modal_large", array(
    'id' => 'riwayatPenyakit',
    'judul' => 'Riwayat Penyakit Pasien',
    'icon' => 'fas fa-user-secret',
    'view' => 'Periksa/riwayat/riwayat_penyakit',
    'edit' => 0
  ));
  $this->load->view("Periksa/modal_large", array(
    'id' => 'riwayatAlergi',
    'judul' => 'Riwayat Alergi Pasien',
    'icon' => 'fas fa-user-secret',
    'view' => 'Periksa/riwayat/riwayat_alergi',
    'edit' => 0
  ));
  $this->load->view("Periksa/modal_large", array(
    'id' => 'rujuk_internal',
    'judul' => 'Rujuk Ke ',
    'icon' => 'fas fa-user-secret',
    'view' => 'Periksa/form/rujuk',
    'edit' => 0
  ));
  $this->load->view("Periksa/modal_new", array(
    'id' => 'dokumentasiPasien',
    'judul' => 'Dokumentasi Pemeriksaan Pasien',
    'icon' => 'fas fa-user-secret',
    'view' => 'Periksa/dokumentasi'
  ));
  $this->load->view("Periksa/modal_new", array(
    'id' => 'assasmen_igd',
    'judul' => 'Assasmen Pasien IGD',
    'icon' => 'fas fa-user-secret',
    'view' => 'Demografi/view_igd'
  ));
  $this->load->view("Periksa/modal_new", array(
    'id' => 'riwayatKunjungan',
    'judul' => 'Riwayat Kunjungan Pasien',
    'icon' => 'fas fa-user-secret',
    'view' => 'Periksa/riwayat/riwayat_kunjungan2'
  ));
  echo form_close();
  ?>