<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>Dokumentasi Gambar</strong>
              <small> Form</small>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('Dokumentasi/insert');?>
              <?php echo @$error;?>

              <div class="row col-lg-12">
                <div class="col-lg-12">
                  <div class="card border-info" style="border: 2px solid;">
                    <div class="card-header bg-info text-white">
                      <strong>Data Kunjungan</strong>
                      <small>Form</small>
                    </div>
                    <div class="card-body card-block">

                      <div class="row p-t-20">
                        <div class="row col-xl-2 col-md-6 col-sm-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">No Kunjungan</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span>
                              </div>
                              <input type="text" name="nokun" id="nokun" class="form-control" placeholder="nokun" value="<?php echo @$idkunjungan; ?>" required readonly>

                            </div>
                          </div>
                        </div>
                        <div class="row col-xl-3 m-l-6 col-md-6 col-sm-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Tgl Berkunjung</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-timer"></i></span>
                              </div>
                              <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo date('Y-m-d'); ?>" required readonly>

                            </div>
                          </div>
                        </div>
                        <div class="row col-xl-2 col-md-6 col-sm-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">No Rekam Medis</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span>
                              </div>
                              <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" required readonly>

                            </div>
                          </div>
                        </div>
                        <div class="row col-xl-3 col-md-6 col-sm-6 m-l-1">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Nama Pasien</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                              </div>
                              <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo @$pasien['namapasien']; ?>" required readonly>

                            </div>
                          </div>
                        </div>
                        <div class="row col-xl-3 col-md-6 col-sm-6">
                          <div class="form-group animated flipIn">
                            <label for="exampleInputuname">Jenis Kunjungan</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
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
              <div class="row col-lg-12">
                <div class="col-lg-12">
                  <div class="card border-info" style="border: 2px solid;">
                    <div class="card-header bg-info text-white">
                      <strong>Data Kunjungan</strong>
                      <small>Form</small>
                    </div>
                    <div class="card-body card-block">

                      <div class="row p-t-20">
                        <div class="table-responsive">
                            <table id="tbl_pasien" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>File</th>
                                            <th width="15%">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="file">
                                      <tr>
                                          <td><input type="file" class="form-control" required name="userfile[]"></td>
                                          <td width="15%"></td>
                                      </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th width="15%"><button id="tambah" type="button" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</button></th>
                                        </tr>
                                    </tfoot>
                                </table>
                          <!-- </div> -->
                        </div>

                      </div>


                    </div>
                  </div>
                </div>
              </div>

                            <?php echo $this->Core->btn_input(); ?>
                            <?php echo form_close(); ?>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
  $(document).on("click","#tambah",function(){
    html = '<tr>'+
        '<td><input type="file" class="form-control" required name="userfile[]"></td>'+
        '<td width="15%"><button type="button" onclick="deleteRow(this)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>'+
    '</tr>';
    $("#file").append(html);
  })
})
function deleteRow(r) {
  var i = r.parentNode.parentNode.rowIndex;
  document.getElementById("tbl_pasien").deleteRow(i);
}
</script>
