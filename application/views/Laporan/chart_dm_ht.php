<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <h4><a href="" class="white-text mx-3">Pasien Hipertensi / HT</a></h4>
      </div>
      <div class="card-body row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Grafik Jumlah Pasien DM/HT sampai dengan bulan ini</h4>
                    <div>

                        <div id="bar-chart-dm-ht" style="width:100%; height:400px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- column -->

      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  var myChart = echarts.init(document.getElementById('bar-chart-dm-ht'));

  // specify chart configuration item and data
  option = {
      tooltip : {
          trigger: 'axis'
      },
      legend: {
          data:['Pasien DM','Pasien HT']
      },
      toolbox: {
          show : true,
          feature : {

              magicType : {show: true, type: ['line', 'bar']},
              restore : {show: true},
              saveAsImage : {show: true}
          }
      },
      color: ["#55ce63", "#009efb","#FFF000"],
      // calculable : true,
      xAxis : [
          {
              type : 'category',
              data : <?php echo json_encode($label)?>
          }
      ],
      yAxis : [
          {
              type : 'value'
          }
      ],
      series : [
          {
              name:'Pasien DM',
              type:'bar',
              data:<?php echo json_encode($data_dm)?>,

          },
          {
              name:'Pasien HT',
              type:'bar',
              data:<?php echo json_encode($data_ht)?>,

          }
      ]
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

})

</script>
