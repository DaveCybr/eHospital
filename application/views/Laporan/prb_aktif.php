<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <h4><a href="" class="white-text mx-3">Pasien PRB Aktif</a></h4>
      </div>
      <div class="card-body">
        <table id="example_blm" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th width="1%">No</th>
              <th>Nomor RM</th>
              <th>Nomor BPJS</th>
              <th>Nama pasien</th>
              <th>Pro</th>
              <th>Prb</th>
              <th>Status</th>
              <th>Kunjungan Terakhir</th>
            </tr>
          </thead>
          <tbody>
            <?php $pro_prb_dm_ht=0;$prb_dm_ht=0;$pro_prb_ht=0;$pro_prb_dm=0;$prb_dm=0;$prb_ht=0;$a=0;$total=0;$aktif=0;$no=1;foreach ($pasien as $value): ?>
              <?php

                if ($value->pstprb!="" && $value->pstprb!=NULL) {
                  // if ($value->) {
                  //   // code...
                  // }
                  if (date("m")==date("m",strtotime($value->kunjungan_terakhir)) && date("Y")==date("Y",strtotime($value->kunjungan_terakhir)) ) {
                    $aktif++;
                    $a=1;
                  }else{
                    $a=0;
                  }
                  if ($value->pstprb=="DM" && ($value->pstprol=="" || $value->pstprol==NULL)) {
                    $prb_dm++;
                  }
                  if ($value->pstprb=="HT" && ($value->pstprol=="" || $value->pstprol==NULL)) {
                    $prb_ht++;
                  }

                  if ($value->pstprb=="HT" && $value->pstprol=="HT") {
                    $pro_prb_ht++;
                  }
                  if ($value->pstprb=="DM" && $value->pstprol=="DM") {
                    $pro_prb_dm++;
                  }

                  if ($value->pstprb=="DM, HT" && $value->pstprol!="DM, HT") {
                    $prb_dm_ht++;
                  }
                  if ($value->pstprb=="DM, HT" && $value->pstprol=="DM, HT") {
                    $pro_prb_dm_ht++;
                  }
                  $total++;

                }
              ?>
              <?php if ($value->pstprb!="" && $value->pstprb!=NULL): ?>
                <?php if ($a==1): ?>
                  <tr style="background-color:#3fc380">
                    <td style="color:white;"><?php echo $no;?></td>
                    <td style="color:white;"><?php echo $value->noRM?></td>
                    <td style="color:white;"><?php echo $value->noBPJS;?></td>
                    <td style="color:white;"><?php echo $value->namapasien;?></td>
                    <td style="color:white;"><?php echo $value->pstprol;?></td>
                    <td style="color:white;"><?php echo $value->pstprb;?></td>
                    <td style="color:white;"><?php echo "Aktif";?></td>
                    <td style="color:white;"><?php echo date("d-m-Y",strtotime($value->kunjungan_terakhir))?></td>
                  </tr>
                <?php else: ?>
                  <tr>
                    <td ><?php echo $no;?></td>
                    <td ><?php echo $value->noRM?></td>
                    <td ><?php echo $value->noBPJS;?></td>
                    <td ><?php echo $value->namapasien;?></td>
                    <td><?php echo $value->pstprol;?></td>
                    <td><?php echo $value->pstprb;?></td>
                    <td><?php echo "Tidak";?></td>
                    <td><?php echo date("d-m-Y",strtotime($value->kunjungan_terakhir))?></td>
                  </tr>
                <?php endif; ?>

              <?php $no++;endif; ?>

            <?php  endforeach; ?>
          </tbody>
          <p>Total PRB : <?php echo $total?></p>
          <p>PRB DM : <?php echo $prb_dm?></p>
          <p>PRB HT : <?php echo $prb_ht?></p>
          <p>PRB DM/HT: <?php echo $prb_dm_ht?></p>
          <p>PRO PRB DM : <?php echo $pro_prb_dm?></p>
          <p>PRO PRB HT : <?php echo $pro_prb_ht?></p>
          <p>PRO PRB DM/HT : <?php echo $pro_prb_dm_ht?></p>

          <p>Kunjungan Bulan Ini : <?php echo $aktif?></p>
          <p>Persentase Pasien Aktif Bulan Ini : <?php echo round($aktif/$total,2)*100?>%</p>

          </table>
        </div>
      </div>
    </div>
</div>

<script>
  $(document).ready(function(){
    $("#example_blm").DataTable();

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
