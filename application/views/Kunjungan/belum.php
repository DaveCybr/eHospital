<div class="row">
  <!-- <div class="col-12"> -->
  <div class="card card-cascade narrower z-depth-1">
    <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
      <a href="" class="white-text mx-3">Daftar Tunggu Pasien (Pasien Belum Di Periksa)</a>
    </div>
    <div class="card-body">
      <div class="table-responsive" id="kunjungan_belum">
        <table id="example_blm" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th width="1%">No</th>
              <th width="1%">No Antrian</th>
              <th width="1%">No Urut Pcare</th>
              <th>Pasien</th>
              <th>Keluhan</th>
              <th>BPJS</th>
              <th>No Asuransi lain</th>
              <th>Umur</th>
              <th>Tujuan</th>
              <?php if ($_SESSION['jabatan']=="resepsionis"): ?>
                <th>No tlp</th>
              <?php else: ?>
                <th>Jenis Kelamin</th>
              <?php endif; ?>
              <th>Jam</th>
              <th>Jenis</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody id="tabel_belum_periksa" >
            <?php $no=1;foreach ($kunjungan as $value): ?>
              <?php $id_check = $value->no_urutkunjungan;$warna = "badge-primary";
              $kdantrian = $value->sumber_dana==7?$value->kd_antrian_bpjs."".$value->no_antrian:$value->kd_antrian."".$value->no_antrian;
              $kdantrian_panggil = $value->sumber_dana==7?$value->kd_antrian_bpjs.".".$value->no_antrian:$value->kd_antrian.".".$value->no_antrian;

              ?>

              <tr id="kunjungan_<?php echo $value->pasien_noRM?>">
                <td><?php echo $no;?></td>
                <td><?php echo $kdantrian?></td>
                <td><?php echo $value->nourut_pcare;?></td>
                <!-- <td class="no_kunjungan_hari_ini"><?php echo $no;?></td> -->
                <td><?php echo $value->namapasien ?></td>
                <td>
                  <?php echo $value->keluhan ?>
                  <?php $skrinning = $this->db->get_where("skrinning",array('idskrinning' => $value->skrinning_idskrinning));?>
                  <?php if ($skrinning->num_rows() > 0): ?>
                    <span class="badge badge-pill peach-gradient"><?php echo $skrinning->row_array()["status"]?></span>
                  <?php endif; ?>
                </td>
                <td><?php echo $value->noBPJS ?></td>
                <td><?php echo $value->noAsuransiLain ?></td>
                <td><?php echo $this->Core->umur($value->tgl_lahir) ?></td>
                <td><?php $k = $value->kode_tupel;
                  $type = "IN";
                  if ($k == "UMU"){$warna = "badge-success"; $type="U";}elseif ($k == "IGD") {$warna = "badge-danger";$type="IG";}elseif($k == "OBG"){$warna = "badge-info";$type="O";}
                  elseif ($k == "GIG") {$warna = "badge-warning";$type="G";}elseif ($k == "OZO") {$warna = "badge-info";$type="OZ";} ?>
                  <h4><span class="badge badge-pill <?php echo $warna; ?>"><?php echo $value->tujuan_pelayanan;?></span></h4>
                  <?php if ($value->status_online == 1): ?><h5><span class="badge badge-pill blue-gradient">Pendaftar Online</span></h5>
                    <?php
                    $baru = $this->ModelChat->getChatBaca($value->pasien_noRM, 1)->num_rows();
                    if ($baru > 0) { ?>
                      <h5><span class="badge badge-pill peach-gradient">Pesan Baru <?php echo $baru ?></span></h5>
                    <?php }
                    ?>
                  <?php endif; ?>
                  <?php if ($value->status_online == 2): ?><h5><span class="badge badge-pill blue-gradient">Pendaftar Mandiri</span></h5><?php endif; ?>

                </td>
                <?php if ($_SESSION['jabatan']=="resepsionis"): ?>

                  <td><?php echo $value->telepon;?></td>
                <?php else: ?>
                  <td><?php echo $value->jenis_kelamin;?></td>

                <?php endif; ?>
                <td><?php echo date("H:i:s",strtotime($value->jam_daftar)); ?></td>
                <td><?php echo $value->sumber_dana==7?"<h4><span class='badge badge-pill badge-success'>".$value->jenis_pasien."</h4>":"<h4><span class='badge badge-pill badge-danger'>".$value->jenis_pasien."</h4>"?></td>
                  <td>
                    <div class="btn-group">
                      <a href="<?php echo $value->status_deposit==0 && $k!="IGD"?"#":base_url()."Periksa/index/".$value->no_urutkunjungan; ?>">
                        <button data-toggle="tooltip" data-placement="top" title="" data-original-title="Periksa" <?php echo $value->status_deposit==0 && $k!="IGD"?'disabled':''?> type="button" class="btn btn-primary periksa btn-sm">
                          <i class="fa fa-stethoscope"></i>
                        </button>
                      </a>
                      <?php if ($value->status_online == 1): ?>
                        <a href="<?php echo $value->status_deposit==0 && $k!="IGD"?"#":base_url()."APO/Konsultasi/Chat/".$value->pasien_noRM."/".$value->no_urutkunjungan; ?>" target="new">
                          <button data-toggle="tooltip" data-placement="top" title="" data-original-title="Chat Pasien" <?php echo $value->status_deposit==0 && $k!="IGD"?'disabled':''?> type="button" class="btn btn-info btn-sm">
                            <i class="fas fa-comments"></i>
                          </button>
                        </a>
                      <?php endif; ?>

                      <?php if ($k == "GIG"): ?>
                        <a href="#">
                          <button data-toggle="tooltip" data-placement="top" title="" data-original-title="Panggil" type="button" class="btn btn-success periksa btn-sm panggilan_pasien" antrian="<?php echo $_SESSION['poli']."-".$kdantrian."-".$id_check."-".$value->namapasien;?>">
                            <i class="fa fa-volume-up"></i>
                          </button>
                        </a>
                      <?php else: ?>
                        <?php if ($value->poli_panggil == "UMU"){ ?>
                          <a href="#">
                            <button data-toggle="tooltip" id="UMU-<?php echo $value->no_urutkunjungan?>" data-placement="top" title="" data-original-title="Panggil Poli Umum 1" type="button" class="btn btn-success periksa btn-sm panggilan_pasien hilang-UMU2-<?php echo $id_check ?>"
                              antrian="<?php echo $_SESSION['poli']."-".$kdantrian_panggil."-".$id_check."-".$value->namapasien;?>">
                              <i class="fa fa-volume-up"></i>
                            </button>
                          </a>
                        <?php }elseif ($value->poli_panggil == "UMU2"){ ?>
                          <a href="#">
                            <button data-toggle="tooltip" id="UMU-<?php echo $value->no_urutkunjungan?>" data-placement="top" title="" data-original-title="Panggil Poli Umum 1" type="button" class="btn btn-success periksa btn-sm panggilan_pasien hilang-UMU-<?php echo $id_check ?>"
                              antrian="<?php echo $_SESSION['poli']."2-".$kdantrian_panggil."-".$id_check."-".$value->namapasien;?>">
                              <i class="fa fa-volume-up"></i>
                            </button>
                          </a>
                        <? }else{?>
                          <a href="#">
                            <button data-toggle="tooltip" id="UMU-<?php echo $value->no_urutkunjungan?>" data-placement="top" title="" data-original-title="Panggil Poli Umum 1" type="button" class="btn btn-success periksa btn-sm panggilan_pasien hilang-UMU2-<?php echo $id_check ?>"
                              antrian="<?php echo $_SESSION['poli']."-".$kdantrian_panggil."-".$id_check."-".$value->namapasien;?>">
                              <i class="fa fa-volume-up"></i>
                            </button>
                          </a>
                          <a href="#">
                            <button data-toggle="tooltip" id="UMU2-<?php echo $value->no_urutkunjungan?>" data-placement="top" title="" data-original-title="Panggil Poli Umum 2" type="button" class="btn default-color periksa btn-sm panggilan_pasien hilang-UMU-<?php echo $id_check ?>"
                              antrian="<?php echo $_SESSION['poli']."2-".$kdantrian_panggil."-".$id_check."-".$value->namapasien;?>">
                              <i class="fa fa-volume-up"></i>
                            </button>
                          </a>
                        <?php }; ?>

                      <?php endif; ?>
                      <a href="#">
                        <button type="button" prb="<?php echo $value->pstprb ?>"
                          prol="<?php echo $value->pstprol ?>"
                          keluhan="<?php echo $value->keluhan ?>"
                          tb="<?php echo @$value->tb ?>"
                          bb="<?php echo @$value->bb ?>"
                          imt="<?php echo @$value->imt ?>"
                          lingkar_perut="<?php echo @$value->lingkar_perut?>"
                          sistole="<?php echo @$value->sistole?>"
                          diastole="<?php echo @$value->diastole?>"
                          rr="<?php echo @$value->rr?>"
                          heartRate="<?php echo @$value->heartRate?>"
                          spo2="<?php echo $value->spo2 ?>"
                          no_kun="<?php echo $value->no_urutkunjungan ?>"
                          no_rm="<?php echo $value->noRM ?>"
                          class="btn btn-success edit-keluhan btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ganti Keluhan">
                          <i class="fa fa-edit"></i>
                        </button>
                      </a>
                      <a href="<?php echo base_url()."Pasien/edit/".$value->pasien_noRM."/".$value->no_urutkunjungan; ?>">
                        <button type="button" class="btn btn-warning hapus-kunjungan btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data Pasien">
                          <i class="fa fa-edit"></i>
                        </button>
                      </a>
                      <a href="#">
                        <button type="button" no_kun="<?php echo $value->no_urutkunjungan?>" no_rm="<?php echo $value->noRM?>" class="btn btn-primary ganti-kunjungan btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ganti Tujuan Pelayanan Pasien">
                          <i class="fa fa-edit"></i>
                        </button>
                      </a>
                      <a href="<?php echo base_url()."Kunjungan/delete2/".$value->no_urutkunjungan; ?>">
                        <button type="button" class="btn btn-danger hapus-kunjungan btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Kunjungan">
                          <i class="fa fa-cut"></i>
                        </button>
                      </a>

                    </div>
                  </td>
                </tr>

                <?php $no++; endforeach; ?>


              </tbody>

            </table>
          </div>
        </div>
      </div>
      <!-- </div> -->
    </div>
    <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
    <script>

      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;

      var pusher = new Pusher('7d98f72380966ec579c6', {
        cluster: 'ap1',
        forceTLS: true
      });

      var channel = pusher.subscribe('ci_pusher3');
      channel.bind('my-event3', function(data) {
        // alert(data.poli);
        $(".hilang-"+data.poli+"-"+data.nokun).hidden();

      });

      $(document).ready(function(){

        $(document).on("click",".ganti-kunjungan",function(){
          var no = $(this).attr("no_kun");
          var no_rm = $(this).attr("no_rm");
          $(".ganti_nokun").val(no);
          $(".no_rm").val(no_rm);
          $("#ganti_tupel").modal("toggle");
        })

        $(document).on("click",".edit-keluhan",function(){
          var no = $(this).attr("no_kun");
          var no_rm = $(this).attr("no_rm");
          var keluhan = $(this).attr("keluhan");
          var bb = $(this).attr("bb");
          var tb = $(this).attr("tb");
          var lingkar_perut = $(this).attr("lingkar_perut");
          var heartRate = $(this).attr("heartRate");
          var sistole = $(this).attr("sistole");
          var diastole = $(this).attr("diastole");
          var imt = $(this).attr("imt");
          var spo2 = $(this).attr("spo2");
          var rr = $(this).attr("rr");
          var prol = $(this).attr("prol")==''?"-":$(this).attr("prol");
          var prb = $(this).attr("prb")==''?'-':$(this).attr("prb");
          $(".ganti_nokun").val(no);
          $(".no_rm").val(no_rm);
          $("#edit_keluhan").val(keluhan);
          $("#edit_tb").val(tb);
          $("#editbb").val(bb);
          $("#prolanis").text(prol);
          $("#prb").text(prb);
          if (lingkar_perut <= 0 ) {
            var lingkar_perut = 80;
          }
          $("#lingkar_perut").val(lingkar_perut);
          if (heartRate <= 0 ) {
            var heartRate = 80
          }
          $("#nadi").val(heartRate);
          if (sistole <= 0) {
            var sistole = 120;
          }
          $("#sistole").val(sistole);
          if (diastole <= 0 ) {
            var diastole = 75
          }
          $("#diastole").val(diastole);
          if (rr <= 0 ) {
            var rr = 20
          }
          $("#rr").val(rr);
          $("#imt").val(imt);
          if (spo2 <= 0 ) {
            var spo2 = 98
          }
          $("#spo2").val(spo2);
          console.log(imt);
          hitung_imt()
          $("#keluhan").modal("toggle");
        })
      })

      function hitung_imt() {

        var bb = parseInt($('#editbb').val());
        var tb = parseInt($('#edit_tb').val());

        var tb_in_meter = tb / 100;
        var imt = bb/(tb_in_meter*tb_in_meter);
        imt = Math.round(imt*100) /100;
        // console.log(imt);

        $('#imt').val(imt);
      }

    </script>
