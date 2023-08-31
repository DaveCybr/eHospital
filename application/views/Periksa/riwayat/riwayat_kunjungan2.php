<div class="col-md-12 col-12 col-xl-12">
  <!-- Card Narrower -->
  <div class="card card-cascade narrower z-depth-1">
    <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
          <h4><a href="" class="white-text mx-3">Riwayat Kunjungan Pasien</a></h4>

    </div>
    <!-- Card content -->
    <div class="card-body">


        <div class="table-responsive table--no-card m-b-40">
          <table id="tabel_riwayat" class="table table-borderless table-striped table-earning">
          <thead>
            <th>#</th>
            <th>Nomor Kunjungan</th>
            <th>Tanggal Kunjungan</th>
            <th>Tujuan Poli</th>
            <th>Keluhan</th>
            <th>Riwayat Dulu</th>
            <th>Riwayat Sekarang</th>

            <th>Pemeriksaan</th>
            <th>Temp</th>
            <th>Sistole</th>
            <th>Diastole</th>
            <th>GDP</th>
            <th>Nadi</th>
            <th>RR</th>
            <th>Kesadaran</th>
            <th>BB</th>
            <th>TB</th>
          </thead>
          <tbody id="tabel_riwayat_kunjungan">
            <?php $data_kunjungan = $this->ModelPeriksa->get_riwayat_kunjungan2(@$pasien['noRM']); ?>
            <?php $no=1;foreach ($data_kunjungan as $data): ?>
                <tr class="data_kunjungan" id="<?php echo $data->idperiksa?>">
                  <td><?php echo $no++?>
                  <td><?php echo $data->no_urutkunjungan;?></td>
                  <td><?php echo date("d-m-Y",strtotime($data->tgl));?></td>
                  <td><?php echo $data->tujuan_pelayanan;?></td>
                  <td><?php echo $data->keluhan;?></td>
                  <td><?php echo $data->riwayat_dulu;?></td>
                  <td><?php echo $data->riwayat_skrg;?></td>
                  <td><?php echo $data->pemeriksaan_sekarang;?></td>
                  <td><?php echo $data->otemp;?></td>
                  <td><?php echo $data->osiastole;?></td>
                  <td><?php echo $data->odiastole;?></td>
                  <td><?php echo $data->gl_puasa;?></td>
                  <td><?php echo $data->onadi;?></td>
                  <td><?php echo $data->orr;?></td>
                  <td><?php echo $data->osadar;?></td>
                  <td><?php echo $data->obb;?></td>
                  <td><?php echo $data->otb;?></td>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        </div>

        <h3>Diagnosa</h3>
        <div class="table-responsive table--no-card m-b-40">
          <table id="tabel_riwayat" class="table table-borderless table-striped table-earning">
          <thead>
            <th>#</th>
            <th>Kode Sakit</th>
            <th>Nama Penyakit</th>

          </thead>
          <tbody id="diagnosa_kunjungan">
          </tbody>
        </table>
        </div>

        <h3>Resep</h3>
        <div class="table-responsive table--no-card m-b-40">
          <table class="table table-borderless table-striped table-earning">
          <thead>
            <th>#</th>
            <th>kode resep</th>
            <th>kode obat</th>
            <th>Nama obat</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Signa</th>
          </thead>
          <tbody id="resep_kunjungan">

          </tbody>
        </table>
        </div>


      </div>

      </div>

      <style>
        .gigi{
          display: inline-block;width:50px;height:auto;cursor: pointer;background-color:rgba(150, 40, 27, 1);color: white;
        }
      </style>
      <!-- <div class="row"> -->
      <div class="card color-bordered-table info-bordered-table" id="riwayat_gigi" hidden>
        <div class="card-body card-block">
          <div class="col-md-12 col">
              <div class="col col-md-12" id="gigi">

                </div>
          </div><br>
          <div class="col col-md-12" style="margin-left:150px;">
            <div class="col-md-12 col">
                <div class="col col-md-2"></div>
                <div class="col col-md-8" id="gigi2">

                </div>
                <div class="col-md-2 col"></div>
            </div><br>
            <div class="col-md-12 col">
                <div class="col col-md-2"></div>
                <div class="col col-md-8" id="gigi3">

                </div>
                <div class="col-md-2 col"></div>
            </div><br>
          </div>
          <div class="col-md-12 col">
              <div class="col col-md-12" id="gigi4">

              </div><br><br>
              <div class="col col-md-12">
                  <div style="width:80px;height:10px;background-color:#01c0c8;display:inline-block"></div><span style=""> Gigi Bermasalah</span><br>
                  <div style="width:80px;height:10px;background-color:rgba(150, 40, 27, 1);display:inline-block"></div><span style=""> Gigi Tidak Bermasalah</span><br>

              </div>
          </div>
        </div>
      </div>


    </div>
    <!-- Card Narrower -->

  </div>
</div>
<script>
var base_url = '<?php echo base_url()?>';

function myajax_request2(url,data,callback){
  $.ajax({
    type  : 'POST',
    url   : url,
    async : false,
    dataType : 'json',
    data:data,
    success : function(response){
      callback(response);
    }
  })
}
$(document).ready(function(){
  // alert('asd');
  $("#tabel_riwayat").dataTable();
  $(document).on("click",".data_kunjungan",function(){
    var idperiksa = $(this).attr("id");
    var data_detail = {
      'idperiksa' : idperiksa
    };
    // alert(idperiksa);
    myajax_request2(base_url+"Periksa/get_riwayat",data_detail,function(res){
      // alert(res);
      console.log(idperiksa);
      $("#diagnosa_kunjungan").html(res.diagnosa);
      // console.log(res.html_gigi);
      $("#gigi").html(res.html_gigi);
      $("#gigi2").html(res.html_gigi2);
      $("#gigi3").html(res.html_gigi3);
      $("#gigi4").html(res.html_gigi4);
      if (res.poli=="GIG") {
        $("#riwayat_gigi").removeAttr("hidden");
      }else{
        $("#riwayat_gigi").attr("hidden","hidden");
      }

      $("#resep_kunjungan").html(res.resep);

    })
  })
});
</script>
