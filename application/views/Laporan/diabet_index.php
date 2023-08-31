<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <h4><a href="" class="white-text mx-3">Pasien Diabetes</a></h4>
      </div>
      <div class="card-body">
        <!-- <div class="row form-group">
          <div class="col-4 col-md-4">
            <label for="nama_satuan" class=" form-control-label">Bulan</label>
            <select id="bulan" class="mdb mdb-select">
              <?php
                for ($i=1; $i <= 12 ; $i++) {
                  ?>
                  <option <?php if ((int)$bulan == $i): ?>
                    selected
                  <?php endif; ?> value="0<?php echo $i?>">0<?php echo $i?></option>
                <?php
                }
              ?>
            </select>
          </div>
          <div class="col-4 col-md-4">
            <label for="nama_satuan" class=" form-control-label">Tahun</label>
            <select id="tahun" class="mdb mdb-select">
              <?php
                for ($i=0; $i <= 7 ; $i++) {
                  ?>
                  <option <?php if (date("Y",strtotime("-".$i." Year"))==$tahun): ?>
                    selected
                  <?php endif; ?> value="<?php echo date("Y",strtotime("-".$i." Year"))?>"><?php echo date("Y",strtotime("-".$i." Year"))?></option>
                <?php
                }
              ?>
            </select>
          </div>
          <div class="col-4 col-md-4">
            <button id="cari" class="btn btn-sm btn-primary">Cari</button>
          </div>
        </div> -->

        <table id="example_blm" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th width="1%">No</th>
                <th>Nomor RM</th>
                <th>Nomor BPJS</th>
                <th>Nama pasien</th>
                <th>Prol</th>
                <th>Prb</th>
                <th>Status Terkendali</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php $pro_prb=0;$prb=0;$pro=0;$berkunjung = 0;$bpjs=0;$non_bpjs=0;$status="Tidak";$tidak_terkendali = 0 ; $total=0;$terkendali=0;$jml = 1;$no=1;foreach ($pasien_aktif as $value): ?>
                <?php
                  // if ($value->noBPJS!="0000000000000" && ($value->pstprol==NULL || $value->pstprol=='') && $value->sudah_update !=1  && $jml <= 5) {
                  //   ambil_peserta_prolanis($value->noBPJS);
                  //
                  //   $jml ++;
                  // }

                  if ($value->pstprol=="DM" || $value->pstprol=="DM, HT" && ($value->pstprb=="" || $value->pstprb==NULL)) {
                    $pro++;
                  }else{
                    if ($value->pstprol=="DM" && $value->pstprb=="DM" ) {
                      $pro_prb++;
                    }else{
                      if ($value->pstprb=="DM" && ($value->pstprol=="" || $value->pstprol==NULL)) {
                        $prb++;
                      }

                    }
                  }
                  $bpjs++;

                  $terakhir = explode("-",$value->kunjungan_terakhir);
                  // die($terakhir[0]);
                  if ($terakhir[0]==$tahun && $terakhir[1]==$bulan) {
                    $res = $this->ModelLaporan->cek_kunj($value->noRM,$bulan,$tahun);
                    if ($res != NULL) {
                      if (($res->gl_puasa <=130 && $res->gl_puasa >=80)) {
                        $bg = "#3fc380";
                        $terkendali++;
                        $status = "Terkendali";
                      }else{
                        $bg = "#e74c3c";
                        $tidak_terkendali++;
                        $status="Tidak";
                      }
                      $berkunjung++;
                    }else{
                      $bg = "";
                      $status="Belum Berkunjung";
                    }
                  }else{
                    $bg = "";
                    $status="Belum Berkunjung";
                  }

                  $total++;
                ?>
                <tr style="background-color:<?php echo $bg?>">
                  <?php if ($bg==""): ?>
                    <td ><?php echo $no;?></td>
                    <td ><?php echo $value->noRM?></td>
                    <td ><?php echo $value->noBPJS;?></td>
                    <td ><?php echo $value->namapasien;?></td>
                    <td><?php echo $value->pstprol;?></td>
                    <td><?php echo $value->pstprb;?></td>
                    <td ><?php echo $status;?></td>
                    <td>
                      <button  type="button" class="btn btn-warning btn-sm riwayat" norm="<?php echo $value->noRM?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Riwayat">
                        Riwayat
                      </button>
                    </td>
                  <?php else: ?>
                    <td style="color:white;"><?php echo $no;?></td>
                    <td style="color:white;"><?php echo $value->noRM?></td>
                    <td style="color:white;"><?php echo $value->noBPJS;?></td>
                    <td style="color:white;"><?php echo $value->namapasien;?></td>
                    <td style="color:white;"><?php echo $value->pstprol;?></td>
                    <td style="color:white;"><?php echo $value->pstprb;?></td>
                    <td style="color:white;"><?php echo $status;?></td>
                    <td style="color:white;">
                      <button  type="button" class="btn btn-warning btn-sm riwayat" norm="<?php echo $value->noRM?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Riwayat">
                        Riwayat
                      </button>
                    </td>
                  <?php endif; ?>


                </tr>

              <?php $no++; endforeach; ?>
              <p>Total Pasien Terdiagnosa : <?php echo $pasien+$tot_non?>, BPJS : <?php echo $pasien?>, Non BPJS : <?php echo $tot_non?></p>
              <p>Prolanis DM Aktif: <?php echo $bpjs?>
                <!-- , PRB DM: <?php echo $prb?>
                , PRO&PRB DM : <?php echo $pro_prb?> -->
                <!-- , Total Flag DM: <?php echo $pro+$prb+$pro_prb?> -->

              </p>
              <p>Berkunjung Bulan Ini : <?php echo $berkunjung?></p>
              <p>Terkendali : <?php echo $terkendali?></p>
              <p>Tidak Terkendali : <?php echo $tidak_terkendali?></p>
              <p>Persentase Pasien DM Terkendali (Terkendali/Total Flag DM): <?php echo round($terkendali/($bpjs),2)*100?>%</p>
              <a href="<?php echo base_url("Laporan/cetak_dm")?>"><button class="btn btn-sm btn-primary">Download Data</button></a>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="modal_dm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Riwayat kunjungan</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th width="1%">No</th>
                <th>Tanggal Kunjungan</th>
                <th>GL Puasa</th>
                <!-- <th>GL Post Prandial</th> -->
              </tr>
            </thead>
            <tbody id="riwayat_pasien">
            </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">Close</a>
          </div>
    </div>
    <!--/.Content-->
  </div>
</div>

<script>
  $(document).ready(function(){
    //   $("#example_blm").DataTable({
    //
    //         "processing": true,
    //         "serverSide": true,
    //         "order": [],
    //
    //         "ajax": {
    //             "url": "<?php echo base_url('Laporan/get_data_dm')?>",
    //             "type": "POST"
    //         },
    //
    //         "columnDefs": [
    //         {
    //             "targets": [ 0 ],
    //             "orderable": false,
    //         },],
    //         "rowCallback": function( row, data, index ) {
    //           // console.log(data[6]);
    //           if ( data[6] == "Terkendali" ) {
    //             $("td:eq(6)", row).css("background-color","green");
    //             $("td:eq(6)", row).css("color","white");
    //
    //           }
    //
    //           if ( data[6] == "Tidak" ) {
    //             $("td:eq(6)", row).css("background-color","red");
    //             $("td:eq(6)", row).css("color","white");
    //
    //           }
    //         }
    //
    // });
      $("#example_blm").DataTable({});
      $(document).on("click","#cari",function(){
        let bulan = $("#bulan").val();
        let tahun = $("#tahun").val();
        window.location.href = '<?php echo base_url("Laporan/pasien_diabetes/")?>'+bulan+'/'+tahun
      })
      $(document).on("click",".riwayat",function(){
        let norm = $(this).attr("norm");
        $.ajax({
          type: 'POST',
          url: '<?php echo base_url();?>Laporan/get_riwayat_dm/',
          data: {norm: norm},
          success: function (response) {
            $("#riwayat_pasien").html(response);
          }
      })
      $("#modal_dm").modal("toggle");
    })
  })

</script>
