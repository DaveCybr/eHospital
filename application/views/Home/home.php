<!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-wallet"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?php echo $total_pasien['total'];?></h3>
                                        <h5 class="text-muted m-b-0">Total Pasien</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="ti-user"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?php echo $pasien_baru['total']?></h3>
                                        <h5 class="text-muted m-b-0">Pasien Baru</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?php echo $kunjungan['total']?></h3>
                                        <h5 class="text-muted m-b-0">Kunjungan</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"><?php echo $kunjungan_baru['total']?></h3>
                                        <h6 class="text-muted m-b-0">Kunjungan Hari Ini</h6></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- /row -->
                <div class="row">
                  <!-- column -->
                  <div class="col-lg-12">
                      <div class="card">
                          <div class="card-body">
                              <h4 class="card-title">Grafik Kunjungan Pasien (<?php echo date('Y')?>)</h4><br><br>
                              <div class="well col col-md-4">
                                <select class="form-control" id="filter" name="filter">
                                  <option value="<?php echo date("Y-m-d")?>" id="harian" link="<?php echo base_url()?>Home/filter_harian">Hari Ini</option>
                                  <option value="<?php echo date('Y-m-d',strtotime('-6 days'))?>" id="mingguan" link="<?php echo base_url()?>Home/filter_data">7 Hari Terakhir</option>
                                  <option value="<?php echo date('Y-m-d')?>" id="bulanan" link="<?php echo base_url()?>Home/filter_data">Bulan Ini</option>
                                  <option value="<?php echo date('Y-m-d')?>" id="tahunan" link="<?php echo base_url()?>Home/filter_data">Tahun Ini</option>
                                </select>
                              </div><br><br>
                              <div class="col col-md-12">
                                <div id="bar-chart" style="width:100%; height:400px;"></div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- column -->
                </div>
                <!-- /.row -->
<script>
$(document).ready(function(){
        list_transaksi_today();   //pemanggilan fungsi tampil event.
        //fungsi tampil event
        function list_transaksi_today(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url()?>Home/filter_harian',
                async : false,
                dataType : 'json',
                beforeSend: function () {
                       $('#filter').hide();
                       $('#loader').show();
                   },
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
     beforeSend: function () {
            // $('#filter').hide();
            $('#loader').show();
        },
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
          data:['Poli Umum','Poli Gigi','Poli Internis','Poli Obsgyn','UGD/IGD']
      },
      toolbox: {
          show : true,
          feature : {

              magicType : {show: true, type: ['line', 'bar']},
              restore : {show: true},
              saveAsImage : {show: true}
          }
      },
      color: ["#55ce63", "#009efb","#674172","#D35400","#2E3131"],
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
