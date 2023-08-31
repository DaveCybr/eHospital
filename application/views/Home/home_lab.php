<!-- ============================================================== -->
<!-- Info box -->
<!-- ============================================================== -->
<!--Grid column-->

<div class="row">

  <!--Grid column-->
  <div class="col-xl-3 col-md-6 mb-4">

    <!--Card-->
    <div class="card purple-gradient z-depth-2">

      <!--Card Data-->
      <div class="row mt-3">
        <div class="col-md-5 col-5 text-left pl-4">
          <a type="button" href="<?php echo base_url()."Pasien"?>" class="btn-floating btn-lg purple accent-2 ml-4"><i class="fas fa-restroom" aria-hidden="true"></i></a>
        </div>

        <div class="col-md-7 col-7 text-right pr-5">
          <h5 class="ml-4 mt-4 mb-2 font-weight-bold white-text"><?php echo number_format($total_pasien['total']);?></h5>
          <p class="font-small white-text font-weight-bold">Pasien Sekarang</p>
        </div>
      </div>
      <!--/.Card Data-->

      <!--Card content-->
      <div class="row my-3">
        <div class="col-md-7 col-7 text-left pl-4">
          <p class="font-small white-text font-up">Total Pasien Lalu</p>
        </div>

        <div class="col-md-5 col-5 text-right pr-5">
          <p class="font-small white-text"><?php echo number_format($last_pasien['total'])?></p>
        </div>
      </div>
      <div class="row ">
        <div class="col-md-7 col-7 text-left pl-4">
          <p class="font-small white-text font-up">Peningkatan</p>
        </div>

        <div class="col-md-5 col-5 text-right pr-5">
          <p class="font-small white-text"><?php echo number_format($total_pasien['total']-$last_pasien['total'])?></p>
        </div>
      </div>
      <!--/.Card content-->

    </div>
    <!--/.Card-->

  </div>
  <!--Grid column-->

  <!--Grid column-->
  <div class="col-xl-3 col-md-6 mb-4">

    <!--Card-->
    <div class="card blue-gradient z-depth-2">

      <!--Card Data-->
      <div class="row mt-3">
        <div class="col-md-5 col-5 text-left pl-4">
          <a type="button" href="#" data-toggle="modal" data-target="#kunjungan_lab" class="btn-floating btn-lg light-blue accent-2 ml-4"><i class="fas fa-user-clock" aria-hidden="true"></i></a>
        </div>

        <div class="col-md-7 col-7 text-right pr-5">
          <h5 class="ml-4 mt-4 mb-2 font-weight-bold white-text"><?php echo number_format($kunjlab['total'])?></h5>
          <p class="font-small white-text font-weight-bold">Kunjungan Laborat</p>
        </div>
      </div>
      <!--/.Card Data-->

      <!--Card content-->
      <div class="row my-3">
        <div class="col-md-7 col-7 text-left pl-4">
          <p class="font-small white-text font-up ml-4 ">Belum analisa</p>
        </div>

        <div class="col-md-5 col-5 text-right pr-5">
          <p class="font-small white-text"><?php echo number_format($b_analis['total'])?></p>
        </div>
      </div>

      <div class="row ">
        <div class="col-md-7 col-7 text-left pl-4">
          <p class="font-small white-text font-up ml-4">Sudah Analisa</p>
        </div>

        <div class="col-md-5 col-5 text-right pr-5">
          <p class="font-small white-text"><?php echo number_format($s_analis['total'])?></p>
        </div>
      </div>
      <!--/.Card content-->

    </div>
    <!--/.Card-->

  </div>
  <!--Grid column-->
  <div class="col-xl-3 col-md-6 mb-4">

    <!--Card-->
    <div class="card peach-gradient z-depth-2">

      <!--Card Data-->
      <div class="row mt-3">
        <div class="col-md-5 col-5 text-left pl-4">
          <a type="button" href="<?php echo base_url()."Home/kamar_kosong"?>" target="_blank" class="btn-floating btn-lg ambar accent-2 ml-4"><i class="fas fa-street-view" aria-hidden="true"></i></a>
        </div>

        <div class="col-md-7 col-7 text-right pr-5">
          <h5 class="ml-4 mt-4 mb-2 font-weight-bold white-text"><?php echo number_format($kamar_kosong['jumlah'])?></h5>
          <p class="font-small white-text font-weight-bold">Kamar Kosong</p>
        </div>
      </div>
      <!--/.Card Data-->

      <!--Card content-->
      <div class="row my-3">
        <div class="col-md-7 col-7 text-left pl-4">
          <p class="font-small white-text font-up ml-4 ">Kamar Terpakai</p>
        </div>

        <div class="col-md-5 col-5 text-right pr-5">
          <p class="font-small white-text"><?php echo number_format($kamar_terisi['jumlah'])?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-7 col-7 text-left pl-4">
          <p class="font-small white-text font-up ml-4 ">Total Kamar</p>
        </div>

        <div class="col-md-5 col-5 text-right pr-5">
          <p class="font-small white-text"><?php echo number_format($total_kamar['jumlah'])?></p>
        </div>
      </div>
      <!--/.Card content-->

    </div>
    <!--/.Card-->

  </div>
  <!--Grid column-->
  <div class="col-xl-3 col-md-6 mb-4">

    <!--Card-->
    <div class="card aqua-gradient z-depth-2">

      <!--Card Data-->
      <div class="row mt-3">
        <div class="col-md-5 col-5 text-left pl-4">
          <a type="button" href="<?php echo base_url()."Laporan/lab"?>" class="btn-floating btn-lg light-green lighten-2 ml-4"><i class="fas fa-user-injured" aria-hidden="true"></i></a>
        </div>

        <div class="col-md-7 col-7 text-right pr-5">
          <h5 class="ml-4 mt-4 mb-2 font-weight-bold white-text"><?php echo number_format($kunjungan_baru['total'])?></h5>
          <p class="font-small white-text font-weight-bold">Kunjungan Hari Ini</p>
        </div>
      </div>
      <!--/.Card Data-->

      <!--Card content-->
      <div class="row">
        <div class="col-md-7 col-7 text-left pl-4">
          <p class="font-small white-text font-up ml-4">Kunjungan Kemarin</p>
        </div>

        <div class="col-md-5 col-5 text-right pr-5">
          <p class="font-small white-text"><?php echo number_format($kunjungan_kemarin['total'])?></p>
        </div>
      </div>
      <div class="row ">
        <div class="col-md-7 col-7 text-left pl-4">
          <p class="font-small white-text font-up ml-4">Bulan Ini</p>
        </div>

        <div class="col-md-5 col-5 text-right pr-5">
          <p class="font-small white-text"><?php echo number_format($kunjungan_bulan_ini['total'])?></p>
        </div>
      </div>
      <div class="row ">
        <div class="col-md-7 col-7 text-left pl-4">
          <p class="font-small white-text font-up ml-4">Bulan Lalu</p>
        </div>

        <div class="col-md-5 col-5 text-right pr-5">
          <p class="font-small white-text"><?php echo number_format($kunjungan_bulan_lalu['total'])?></p>
        </div>
      </div>
      <!--/.Card content-->

    </div>
    <!--/.Card-->

  </div>
  <!--Grid column-->
  </div>
  <!-- Column -->
  <!-- ============================================================== -->
  <!-- End Info box -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- Over Visitor, Our income , slaes different and  sales prediction -->
  <!-- ============================================================== -->
  <section class="m-t-40"><!--Card-->
    <div class="card card-cascade narrower">

      <!--Section: Chart-->
      <section>

        <!--Grid row-->
        <div class="row">

          <!--Grid column-->
          <div class="col-xl-4 col-lg-12 mr-0">

            <!--Card image-->
            <div class="view view-cascade gradient-card-header light-blue lighten-1">
              <h4 class="h4-responsive mb-0">Grafik Kunjungan Pasien (<?php echo date('Y')?>)</h4>
            </div>
            <!--/Card image-->

            <!--Card content-->
            <div class="card-body card-body-cascade pb-0">

              <!--Panel data-->
              <div class="row card-body pt-3">

                <!--First column-->
                <div class="col-md-12">

                  <!--Date select-->
                  <p class="lead"><span class="badge info-color p-2">Data range</span></p>
                  <select class="mdb-select colorful-select dropdown-info md-form" id="filter" name="filter">
                    <option value="" disabled selected>Choose time period</option>
                    <option value="<?php echo date("Y-m-d")?>" id="harian" link="<?php echo base_url()?>Home/filter_harian">Hari Ini</option>
                    <option value="<?php echo date('Y-m-d',strtotime('-6 days'))?>" id="mingguan" link="<?php echo base_url()?>Home/filter_data">7 Hari Terakhir</option>
                    <option value="<?php echo date('Y-m-d')?>" id="bulanan" link="<?php echo base_url()?>Home/filter_data">Bulan Ini</option>
                    <option value="<?php echo date('Y-m-d')?>" id="tahunan" link="<?php echo base_url()?>Home/filter_data">Tahun Ini</option>

                  </select>



                </div>
                <!--/First column-->


            </div>
            <!--/Panel data-->

          </div>
          <!--/.Card content-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-xl-8 col-lg-12 mb-4 col-sm-12">

          <!--Card image-->
          <div class="view view-cascade gradient-card-header grey lighten-5">

            <!-- Chart -->
            <!-- <div id="morris-area-chart" style="height: 340px;"></div> -->
            <!-- <canvas id="bar-chart" height="175"></canvas> -->
            <div id="bar-chart" style="width:100%; height:400px;"></div>

          </div>
          <!--/Card image-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

    </section>
    <!--Section: Chart-->
  </div>
  <!--/.Card-->
</section>

<?php
$this->load->view("Periksa/modal_large",array(
  'id'=>'kunjungan_lab',
  'judul' => 'Daftar Permintaan Laborat Belum Dianalisa',
  'icon' => 'fas fa-user-secret',
  'view' => 'Home/form_lab',
  'edit' => 0
));
?>
  <script>
  $(document).ready(function(){
          list_transaksi_today();   //pemanggilan fungsi tampil event.
          //fungsi tampil event
          function list_transaksi_today(){
              $.ajax({
                  type  : 'GET',
                  url   : '<?php echo base_url()?>Home/filter_harian',
                  async : false,
                  dataType : 'json',
                  success: function(response) {
                    $("#loader").hide();
                    $("#filter").show();
                    // console_log(response);
                    chart(response);
                  }

                })
          };
  })
  $(document).on('change','#filter',function(){
     var tgl = $("#filter option:selected").val();
     var filter = $("#filter option:selected").attr('id');
     var link = $("#filter option:selected").attr('link');
     // alert(link);
     $.ajax({
       type: 'POST',
       url: link,
       data: { tgl: tgl,jenis:filter},
       dataType : 'json',
       // beforeSend: function () {
       //        // $('#filter').hide();
       //        $('#loader').show();
       //    },
       success: function(response) {
         $("#loader").hide();
         // $("#filter").show();
         chart(response);
         // alert(response.label);
       }
     });
  });

  function chart(response){
    // ==============================================================
    // Bar chart option
    // ==============================================================
    var myChart = echarts.init(document.getElementById('bar-chart'));

    // specify chart configuration item and data
    option = {
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['Poli Umum','Poli Gigi','Poli Internis','Poli Obsgyn','UGD/IGD','Poli Ozon']
        },
        toolbox: {
            show : true,
            feature : {

                magicType : {show: true, type: ['line', 'bar']},
                // restore : {show: true},
                saveAsImage : {show: true}
            },

        },
        color: ["#55ce63", "#009efb","#674172","#D35400","#2E3131","#5f41f4"],
        calculable : true,
        xAxis : [
            {
                type : 'category',
                data : response.label
                // data : ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec']
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : response.data
    };


    // use configuration item and data specified to show chart
    myChart.setOption(option, true), $(function() {
                function resize() {
                    setTimeout(function() {
                        myChart.resize()
                    }, 100)
                }
                $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
            });


  }

  </script>
