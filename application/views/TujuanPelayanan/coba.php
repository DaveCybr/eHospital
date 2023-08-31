<?php echo form_open('TujuanPelayanan/delete');?>
<div class="col-lg-12">
  <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
    <div class="au-card-title" style="background-image:url('<?php echo base_url(); ?>desain/images/bg-title-01.jpg');">
      <div class="bg-overlay bg-overlay--blue"></div>
      <h3 class="text-center">
                            <i class="zmdi zmdi-account-calendar"></i>LIST TUJUAN PELAYANAN</h3>
      <a href="<?php base_url(); ?>TujuanPelayanan/input">
        <button class="au-btn-plus" type="button"><i class="zmdi zmdi-plus"></i>
        </button>
      </a>
      <!-- hapus -->

      <button type="button" class="btn btn-secondary m-l-10 m-b-10 badges-del btn-sm">
        Terpilih
        <span class="badge badge-light baris_dipilih" id="jumlah_pilih">0</span>
      </button>
      <div id="alert"><?php echo $this->Core->Hapus_disable(); ?></div>
      <div id="modal"><?php echo $this->Core->Hapus_aktif(); ?></div>
      <!-- selesai -->
    </div>
    <div class="au-task js-list-load">
      <div class="au-task__title">
            <table id="example" class="table table-borderless table-striped">
                    <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th>Tujuan Pelayanan</th>
                            <th>Poli Sakit</th>
                            <th width="%">opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; foreach ($tujuan_pelayanan as $data_tupel):
                        $id_check = $data_tupel->kode_tupel;?>
                        <tr>
                            <td><div class="checkbox">
                                <label for="<?php echo $id_check ?>" class="form-check-label ">
                                  <input type="checkbox" id="<?php echo $id_check ?>" name="id[] " value="<?php echo $id_check ?>" class="form-check-input id_checkbox"><?php echo $no;?>
                                </label>
                              </div></td>

                            <td><?php echo $data_tupel->tujuan_pelayanan; ?></td>
                            <td><?php if ($data_tupel->polisakit == 1) {
                              echo "Ya";
                            } else {
                              echo "Tidak";
                            }?>
                           </td>


                            <td><a href="<?php base_url()?>/TujuanPelayanan/edit/<?php echo $data_tupel->kode_tupel;?>">
                              <button type="button" class="item-table-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                <i class="zmdi zmdi-edit"></i>
                              </button>
                            </a></td>
                        </tr>
                      <?php $no++;  endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                          <th>#</th>

                          <th>Tujuan Pelayanan</th>

                          <th>PoliSakit</th>
                          <th>opsi</th>
                        </tr>
                    </tfoot>
                </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo form_close();?>
<?php echo $this->Core->Fungsi_JS_Hapus(); ?>
