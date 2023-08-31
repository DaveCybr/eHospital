<!-- ============================================================== -->
<!-- Info box -->
<!-- ============================================================== -->
<!--Grid column-->

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
              <h4 class="h4-responsive mb-0">Grafik Kunjungan Ozon </h4>
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
                    <option value="<?php echo date('Y-m-d')?>" id="tahunan" link="<?php echo base_url()?>Grafik/filter_data">Tahun Ini</option>
                    <option value="<?php echo date('Y-m-d',strtotime("-1 year"))?>" id="tahunan" link="<?php echo base_url()?>Grafik/filter_data">Tahun Kemarin</option>

                  </select>



                </div>
                <!--/First column-->
                <div class="col-md-12 col-xl-12">
                  <div class="form-group animated flipIn"><br>
                    <label for="exampleInputuname">Unit Layanan</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-reddit"></i></span> -->
                      </div>
                      <div class="custom-control custom-radio">
                        <input type="radio" id="tinggal_dengan1" checked name="tinggal_dengan" value="RAJAL" class="custom-control-input unit_layanan">
                        <label class="custom-control-label" for="tinggal_dengan1">Rawat Jalan</label>
                      </div>
                      <div class="custom-control custom-radio">
                        <input type="radio" id="tinggal_dengan5" name="tinggal_dengan" class="custom-control-input unit_layanan" value="RANAP">
                        <label class="custom-control-label" for="tinggal_dengan5">Rawat Inap </label>
                    </div>
                    </div>
                  </div>

                  <!-- <div class="col-md-12 col-xl-6"> -->
                    <!-- <div class="table-responsive"> -->
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <td>Tahun</td>
                            <td id="tahun">0</td>
                          </tr>
                          <tr>
                            <td>Total Kunjungan</td>
                            <td id="total">0</td>
                          </tr>

                            <tr>
                              <td>Ozon Mayor</td>
                              <td id="o_mayor">0</td>
                            </tr>

                              <tr>
                                <td>Ozon Plastik</td>
                                <td id="o_plastik">0</td>
                              </tr>
                        </thead>
                      </table>
                    <!-- </div> -->
                  <!-- </div> -->
                </div>


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
<?php if ($_SESSION['jabatan']=='resepsionis'): ?>

  <!-- /.row -->
<?php endif; ?>
  <script>
  $(document).ready(function(){
          list_transaksi_today();   //pemanggilan fungsi tampil event.
          //fungsi tampil event
          function list_transaksi_today(){
              $.ajax({
                  type  : 'GET',
                  url   : '<?php echo base_url()?>Grafik/filter_harian',
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
     var unit = $(".unit_layanan:checked").val();
     // alert(unit);
     // alert(link);
     $.ajax({
       type: 'POST',
       url: link,
       data: { tanggal: tgl,jenis:filter,unit:unit},
       dataType : 'json',
       // beforeSend: function () {
       //        // $('#filter').hide();
       //        $('#loader').show();
       //    },
       success: function(response) {
         $("#loader").hide();
         // $("#filter").show();
         chart(response);
         $("#tahun").html(response.tahun);
         $("#total").html(response.total);
         $("#o_mayor").html(response.mayor);
         $("#o_plastik").html(response.plastik);
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
            data:['Ozon Mayor','Ozon Plastik']
        },
        toolbox: {
            show : true,
            feature : {

                magicType : {show: true, type: ['line', 'bar']},
                // restore : {show: true},
                saveAsImage : {show: true}
            },

        },
        color: ["#55ce63", "#009efb"],
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
