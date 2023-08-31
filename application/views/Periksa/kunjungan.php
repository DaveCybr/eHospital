<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <?php echo form_open_multipart('Periksa/kunjungan',array("id"=>"form_kunjungan"));?>
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

                  <h4><a href="" class="white-text mx-3">Riwayat Kunjungan Pasien</a></h4>

            </div>
            <div class="card-body card-block">
              <div class="col-md-12">
              <div class="row p-t-20">
                <div class="row col-xl-3 col-md-6 col-sm-6">
                  <div class="form-group animated flipIn">
                    <label for="exampleInputuname">NO.PEMERIKSAAN</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span>
                      </div>
                      <input type="text" name="nopem" id="nopem" class="form-control" placeholder="nokun" value="<?php echo $this->uri->segment(3) ?>" required readonly>

                    </div>
                  </div>
                </div>
                <div class="row col-xl-3 col-md-6 col-sm-6">
                  <div class="form-group animated flipIn">
                    <label for="exampleInputuname">TANGGAL</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                      </div>
                      <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo date('Y-m-d'); ?>" required readonly>

                    </div>
                  </div>
                </div>
                <div class="row col-xl-3 col-md-6 col-sm-6">
                  <div class="form-group animated flipIn">
                    <label for="exampleInputuname">NO RM PASIEN</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                      </div>
                      <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" required readonly>

                    </div>
                  </div>
                </div>
                <div class="row col-xl-3 col-md-6 col-sm-6">
                  <div class="form-group animated flipIn">
                    <label for="exampleInputuname">NAMA PASIEN</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                      </div>
                      <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo @$pasien['namapasien']; ?>" required readonly>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row col-md-12">
              <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#scrollmodal_alergi" style="margin-top: 30px;margin-bottom:10px;"> <i class="fa fa-plus" ></i>Tambah Alergi</button> -->
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="list_alergi">
                  <thead>
                    <th>no periksa</th>
                    <th>tanggal</th>
                    <th>kode cus</th>
                    <th>keluhan</th>
                    <th>riwayat dulu</th>
                    <th>riwayat sekarang</th>
                    <th>otem</th>
                    <th>osadar</th>
                    <th>osistol</th>
                    <th>odiastol</th>
                    <th>onadi</th>
                    <th width="10%"><i class="fa fa-gear"></i></th>
                  </thead>
                  <tbody id="">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tbody>
                </table>
              </div>
            </div>

              <div class="row col-md-12">
                <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#scrollmodal" style="margin-top: 30px;margin-bottom:10px;"> <i class="fa fa-search" ></i> Cari Obat </button> -->
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="">
                    <thead>
                      <th>no asasment </th>
                      <th>tanggal</th>
                      <th>no periksa</th>
                      <th>kode cus</th>
                      <th>kode sakit</th>
                      <th>nama penyakit</th>
                      <!-- <th>pulves</th> -->
                      <th></th>
                      <th width="10%"><i class="fa fa-gear"></i></th>
                    </thead>
                    <tbody id="">
                      <td></td>
                      <td></td>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="row col-md-12">
                <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#scrollmodal" style="margin-top: 30px;margin-bottom:10px;"> <i class="fa fa-search" ></i> Cari Obat </button> -->
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="">
                    <thead>
                      <th>no resep</th>
                      <th>tanggal</th>
                      <th>no periksa</th>
                      <th>kode cus</th>
                      <th>resep no</th>
                      <th>kode res</th>
                      <th>kode brg</th>
                      <th>nama brg</th>
                      <th>jumlah</th>
                      <th>satuan</th>
                      <th>dosis</th>
                      <th>signa</th>
                      <th>pulv</th>

                      <!-- <th>pulves</th> -->
                      <th></th>
                      <th width="10%"><i class="fa fa-gear"></i></th>
                    </thead>
                    <tbody id="">
                      <td></td>
                      <td></td>
                      <td></td>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
            <!-- <div class="card-footer"> -->
            <!-- <?php echo $this->Core->btn_input(); ?> -->
            <div class="card-footer" style='display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;'>
              <div class="col col-sm-12 com-md-12">
                <button type="button" class="btn btn-outline-secondary btn-sm pull-left" onclick="window.history.back()"><i class="fa fa-reply"></i> Kembali</button>
              </div>
            </div>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>
