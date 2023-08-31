
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <h3><a href="" class="white-text mx-3">Antrian Loket</a></h3>

      </div>

      <div class="card-body">

        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Antrian Loket</h4>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#antrianbaru" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Pasie Baru</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#antrianlama" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Pasien Lama</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane active" id="antrianbaru" role="tabpanel">
                              <div class="col-md-12">
                                  <div class="card">
                                      <div class="card-body p-b-0">
                                          <h4 class="card-title">Antrian Loket Pasien Baru</h4>

                                       </div>
                                      <!-- Nav tabs -->
                                      <ul class="nav nav-tabs customtab" role="tablist">
                                          <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#baru_belum" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Belum Di Panggil</span></a> </li>
                                          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#baru_sudah" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Sudah Di Panggil</span></a> </li>
                                      </ul>
                                      <!-- Tab panes -->
                                      <div class="tab-content">
                                          <div class="tab-pane active" id="baru_belum" role="tabpanel">
                                              <div class="p-20">
                                                <div class="table-responsive" id="kunjungan_sudah">
                                                  <table  class="table table-bordered table-striped hover-table">
                                                          <thead>
                                                              <tr>
                                                                  <th>#</th>
                                                                  <th>Nomor Antrian</th>
                                                                  <th>Opsi</th>
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                            <?php $no=1; foreach ($baru_belum as $value): ?>
                                                              <tr>
                                                                  <td><?php echo $no++?></td>
                                                                  <td><?php echo $value->jenis_kunjungan."".$value->no_antrian?></td>
                                                                  <td><button id="<?php echo $value->idantrian_loket?>" antrian="<?php echo "LOKET1-".$value->no_antrian."-".$value->jenis_kunjungan?>" class="btn btn-success panggilan_pasien" class="btn btn-success" type="button">Panggil</button></td>
                                                              </tr>
                                                            <?php endforeach; ?>
                                                          </tbody>
                                                      </table>
                                                </div>
                                              </div>
                                          </div>
                                          <div class="tab-pane" id="baru_sudah" role="tabpanel">
                                            <div class="p-20">
                                              <div class="table-responsive" id="kunjungan_sudah">
                                                <table  class="table table-bordered table-striped hover-table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Nomor Antrian</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php $no=1; foreach ($baru_sudah as $value): ?>
                                                              <tr>
                                                                  <td><?php echo $no++?></td>
                                                                  <td><?php echo $value->jenis_kunjungan."".$value->no_antrian?></td>
                                                                  <td><button id="<?php echo $value->idantrian_loket?>" antrian="<?php echo "LOKET1-".$value->no_antrian."-".$value->jenis_kunjungan?>" class="btn btn-success panggilan_pasien" class="btn btn-success" type="button">Panggil</button></td>
                                                              </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="antrianlama" role="tabpanel">
                              <div class="col-md-12">
                                  <div class="card">
                                      <div class="card-body p-b-0">
                                          <h4 class="card-title">Antrian Loket Pasien Lama</h4>

                                       </div>
                                      <!-- Nav tabs -->
                                      <ul class="nav nav-tabs customtab" role="tablist">
                                          <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#lama_belum" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Belum Di Panggil</span></a> </li>
                                          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#lama_sudah" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Sudah Di Panggil</span></a> </li>
                                      </ul>
                                      <!-- Tab panes -->
                                      <div class="tab-content">
                                          <div class="tab-pane active" id="lama_belum" role="tabpanel">
                                            <div class="p-20">
                                              <div class="table-responsive" id="kunjungan_sudah">
                                                <table  class="table table-bordered table-striped hover-table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Nomor Antrian</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php $no=1; foreach ($lama_belum as $value): ?>
                                                              <tr>
                                                                  <td><?php echo $no++?></td>
                                                                  <td><?php echo $value->jenis_kunjungan."".$value->no_antrian?></td>
                                                                  <td><button id="<?php echo $value->idantrian_loket?>" antrian="<?php echo "LOKET2-".$value->no_antrian."-".$value->jenis_kunjungan?>" class="btn btn-success panggilan_pasien" type="button">Panggil</button></td>
                                                              </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="tab-pane" id="lama_sudah" role="tabpanel">
                                            <div class="p-20">
                                              <div class="table-responsive" id="kunjungan_sudah">
                                                <table  class="table table-bordered table-striped hover-table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Nomor Antrian</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php $no=1; foreach ($lama_sudah as $value): ?>
                                                              <tr>
                                                                  <td><?php echo $no++?></td>
                                                                  <td><?php echo $value->jenis_kunjungan."".$value->no_antrian?></td>
                                                                  <td><button id="<?php echo $value->idantrian_loket?>" antrian="<?php echo "LOKET2-".$value->no_antrian."-".$value->jenis_kunjungan?>" class="btn btn-success panggilan_pasien" type="button">Panggil</button></td>
                                                              </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $(document).on("click",".panggilan_pasien",function(){
      var no_antrian = $(this).attr("antrian");
      var id = $(this).attr("id");
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>Antrian/panggil/',
        data: { antrian: no_antrian,id:id },
        beforeSend: function () {
               // $('#kunjungan_belum').hide();
               // $('#loader').show();
           },
        success: function(response) {
          alert(response);
          // $("#loader").hide();
          // $('#kunjungan_belum').show('medium');
          // $("#kunjungan_belum").html(response);
          // $('#example_blm').DataTable();
          location.reload();
        }
      });
    })
  });

</script>
