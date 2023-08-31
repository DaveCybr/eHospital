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



<br>
<?php echo form_open_multipart('Periksa/insert_obgyn');?>
<?php echo @$error;?>

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
                        <p class="form-control-static"> <?php echo $periksa['manarche_umur']; ?> </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="control-label text-right col-md-6">Lamanya Haid :</label>
                    <div class="col-md-6">
                        <p class="form-control-static"> <?php echo $periksa['lamahaid']; ?> Hari</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="control-label text-right col-md-6">Siklus :</label>
                    <div class="col-md-6">
                        <p class="form-control-static"> <?php echo $periksa['siklus']; ?> Hari</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="control-label text-right col-md-2">Keluhan :</label>
                    <div class="col-md-6">
                        <p class="form-control-static"> <?php echo $periksa['keluhan_obgyn']; ?></p>
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
                        <p class="form-control-static"> <?php echo $periksa['g']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group row">
                    <label class="control-label text-right col-md-4">P :</label>
                    <div class="col-md-8">
                        <p class="form-control-static"> <?php echo $periksa['p']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group row">
                    <label class="control-label text-right col-md-4">A :</label>
                    <div class="col-md-8">
                        <p class="form-control-static"> <?php echo $periksa['a']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group row">
                    <label class="control-label text-right col-md-5">HPHT :</label>
                    <div class="col-md-7">
                        <p class="form-control-static"> <?php echo $periksa['hpht']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group row">
                    <label class="control-label text-right col-md-4">HPL :</label>
                    <div class="col-md-8">
                        <p class="form-control-static"> <?php echo $periksa['hpl']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group row">
                    <label class="control-label text-right col-md-4">UK :</label>
                    <div class="col-md-8">
                        <p class="form-control-static"> <?php echo $periksa['uk']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="control-label text-right col-md-4">Keluhan yang dirasakan selama hamil ini :</label>
                    <div class="col-md-8">
                        <p class="form-control-static"><input type="text" class="form-control" value="<?php echo $periksa['keluhanhamil']; ?>" readonly></p>
                    </div>
                </div>
            </div>
          </div>

      <h3> <b>3. Riwayat Ginektologi</b> </h3><hr>
          <div class="row form-group">

            <div class="col-12 col-md-2">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="Infertilitas" value="Infertilitas" name="infertilitas" class="custom-control-input" <?php if ($periksa['infertilitas'] !== null){ echo "checked";}?>>
                  <label class="custom-control-label" for="Infertilitas">Infertilitas</label>
              </div>
            </div>
            <div class="col-12 col-md-2">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="Infeksi" value="Infeksi Virus" name="Infeksi" class="custom-control-input" <?php if ($periksa['infeksivirus'] !== null){ echo "checked";}?>>
                  <label class="custom-control-label" for="Infeksi">Infeksi Virus</label>
              </div>
            </div>
            <div class="col-12 col-md-2">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="PMS" value="PMS" name="PMS" class="custom-control-input" <?php if ($periksa['pms'] !== null){echo "checked";}?>>
                  <label class="custom-control-label" for="PMS">PMS</label>
              </div>
            </div>
            <div class="col-12 col-md-2">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="Cervitiscronis" value="Cervitiscronis" name="Cervitiscronis" class="custom-control-input" <?php if ($periksa['cervitiscronis'] !== null){echo "checked";}?>>
                  <label class="custom-control-label" for="Cervitiscronis">Cervitiscronis</label>
              </div>
            </div>
            <div class="col-12 col-md-2">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="Endometriosis" value="Endometriosis" name="Endometriosis" class="custom-control-input" <?php if ($periksa['endometriosis'] !== null){echo "checked";}?>>
                  <label class="custom-control-label" for="Endometriosis">Endometriosis</label>
              </div>
            </div>
            <div class="col-12 col-md-2">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="Myoma" value="Myoma" name="Myoma" class="custom-control-input" <?php if ($periksa['myoma'] !== null){echo "checked";}?>>
                  <label class="custom-control-label" for="Myoma">Myoma</label>
              </div>
            </div>
            <div class="col-12 col-md-3">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="ok" value="Opreasi Kandungan" name="ok" class="custom-control-input" <?php if ($periksa['ok'] !== null){echo "checked";}?>>
                  <label class="custom-control-label" for="ok">Opreasi Kandungan</label>
              </div>
            </div>
            <div class="col-12 col-md-2">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="Perkosaan" value="Perkosaan" name="Perkosaan" class="custom-control-input" <?php if ($periksa['perkosaan'] !== null){echo "checked";}?>>
                  <label class="custom-control-label" for="Perkosaan">Perkosaan</label>
              </div>
            </div>
            <div class="col-12 col-md-3">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="pcb" value="Post Coital Bleeding" name="pcb" class="custom-control-input" <?php if ($periksa['pcb'] !== null){ echo "checked";}?>>
                  <label class="custom-control-label" for="pcb">Post Coital Bleeding</label>
              </div>
            </div>
            <div class="col-12 col-md-3">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="fa" value="Flour Albus" name="fag" class="custom-control-input" <?php if ($periksa['fag'] !== null){echo "checked";}?>>
                  <label class="custom-control-label" for="fa">Flour Albus</label>
              </div>
            </div>

            <div class="col col-md-2 text-right">
              <label class=" form-control-label">Gatal :</label>
            </div>
            <div class="col-md-2">
              <div class="custom-control custom-radio">
                  <input type="radio" id="gatal1" name="gatal" value="Ya" class="custom-control-input" <?php if ($periksa['gatal'] == 'Ya'){echo "checked";}?>>
                  <label class="custom-control-label" for="gatal1">Ya</label>
              </div>
              <div class="custom-control custom-radio">
                  <input type="radio" id="gatal2" name="gatal" value="Tidak" class="custom-control-input" <?php if ($periksa['gatal'] == null || $periksa['gatal'] == 'Tidak'){echo "checked";}?>>
                  <label class="custom-control-label" for="gatal2">Tidak</label>
              </div>
            </div>
            <div class="col col-md-2 text-right">
              <label class=" form-control-label">Berbau :</label>
            </div>
            <div class="col-md-2">
              <div class="custom-control custom-radio">
                  <input type="radio" id="berbau1" name="berbau" value="Ya" class="custom-control-input" <?php if ($periksa['berbau'] == 'Ya'){echo "checked";}?>>
                  <label class="custom-control-label" for="berbau1">Ya</label>
              </div>
              <div class="custom-control custom-radio">
                  <input type="radio" id="berbau2" name="berbau" value="Tidak" class="custom-control-input" <?php if ($periksa['berbau'] == null || $periksa['gatal'] == 'Tidak'){echo "checked";}?>>
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
                    <p class="form-control-static"> <input type="text" class="form-control" value="<?php echo $periksa['metodekb']; ?>" readonly></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group row">
                <label class="control-label text-right col-md-4">Lamanya :</label>
                <div class="col-md-8">
                    <p class="form-control-static"><?php echo $periksa['lamakb']; ?> tahun</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label text-right col-md-2">Komplikasi :</label>
                <div class="col-md-8">
                    <p class="form-control-static"> <input type="text" class="form-control" value="<?php echo $periksa['komplikasi']; ?>" readonly> </p>
                </div>
            </div>
        </div>
      </div>


    </div>
  </div>    </div>

</div>
