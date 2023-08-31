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
          <a type="button" href="<?php echo base_url()."Home/pasien_baru"?>" target="_blank" class="btn-floating btn-lg light-blue accent-2 ml-4"><i class="fas fa-user-clock" aria-hidden="true"></i></a>
        </div>

        <div class="col-md-7 col-7 text-right pr-5">
          <h5 class="ml-4 mt-4 mb-2 font-weight-bold white-text"><?php echo number_format($pasien_baru['total'])?></h5>
          <p class="font-small white-text font-weight-bold">Pasien Baru Hari Ini</p>
        </div>
      </div>
      <!--/.Card Data-->

      <!--Card content-->
      <div class="row my-3">
        <div class="col-md-7 col-7 text-left pl-4">
          <p class="font-small white-text font-up ml-4 ">Kemarin</p>
        </div>

        <div class="col-md-5 col-5 text-right pr-5">
          <p class="font-small white-text"><?php echo number_format($pasien_kemarin['total'])?></p>
        </div>
      </div>

      <div class="row ">
        <div class="col-md-7 col-7 text-left pl-4">
          <p class="font-small white-text font-up ml-4">Bulan Ini</p>
        </div>

        <div class="col-md-5 col-5 text-right pr-5">
          <p class="font-small white-text"><?php echo number_format($pasien_bulan_ini['total'])?></p>
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
          <a type="button" href="<?php echo base_url()."Home/kunjungan_saat_ini"?>" target="_blank" class="btn-floating btn-lg light-green lighten-2 ml-4"><i class="fas fa-user-injured" aria-hidden="true"></i></a>
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
          <p class="font-small white-text font-up ml-4">Kemarin</p>
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

  <div class="col-xl-3 col-md-6 mb-4">


    <div class="card aqua-gradient z-depth-2">

      <div class="row mt-3">
        <div class="col-md-5 col-5 text-left pl-4">
          <a type="button" href="#<?php echo base_url()."Home/kunjungan_saat_ini"?>" target="_blank" class="btn-floating btn-lg light-green lighten-2 ml-4"><i class="fas fa-user-injured" aria-hidden="true"></i></a>
        </div>

        <div class="col-md-7 col-7 text-right pr-5">
          <h5 class="ml-4 mt-4 mb-2 font-weight-bold white-text"><?php echo number_format($hutang_rekanan['total'])?></h5>
          <p class="font-small white-text font-weight-bold">Hutang Rekanan</p>
        </div>
      </div>

    </div>

  </div>

  <!-- <div class="col-xl-3 col-md-6 mb-4">

    <div class="card purple-gradient z-depth-2">

      <div class="row mt-3">
        <div class="col-md-5 col-5 text-left pl-4">
          <a type="button" href="#<?php echo base_url()."Home/kunjungan_saat_ini"?>" target="_blank" class="btn-floating btn-lg light-purple lighten-2 ml-4"><i class="fas fa-user-injured" aria-hidden="true"></i></a>
        </div>

        <div class="col-md-7 col-7 text-right pr-5">
          <h5 class="ml-4 mt-4 mb-2 font-weight-bold white-text"><?php echo number_format($kunjungan_baru['total'])?></h5>
          <p class="font-small white-text font-weight-bold">Pendapatan</p>
        </div>
      </div>

    </div>


  </div> -->


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
<section class="m-t-40">
  <div class="row">
    <div class="col-12">
      <div class="card card-cascade narrower z-depth-1">
        <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
          <div>
                <!-- <button type="button" class="btn btn_hapus btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data"><i class="fas fa-trash-alt mt-0"></i></button> -->
                <!-- <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jumlah Item Terpilih"><span id="jumlah_pilih">0</span></button> -->
              </div>
              <a href="" class="white-text mx-3">Pemantauan Capaian Keluarga Binaan</a>
              <div>
                <!-- <a href="" class="float-right" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                  <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><i class="fas fa-pencil-alt mt-0"></i></button>
                </a> -->
              </div>
        </div>
        <div class="card-body row">
          <div class="col-sm-3">
            <div class="row form-group">
                <div class="col col-md-12">
                  <label for="nama" class=" form-control-label">Dokter Penanggung Jawab</label>
                  <select class="mdb-select colorful-select dropdown-info md-form initialized" name="iddokter" id="iddokter">
                    <option value="">Semua</option>
                    <?php foreach ($kb_dokter as $value): ?>
                      <option value="<?php echo $value->idkb_dokter ?>"><?php echo $value->nama ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="row form-group">
                <div class="col col-md-12">
                  <label for="nama" class=" form-control-label">Tahun</label>
                  <select class="mdb-select colorful-select dropdown-info md-form initialized" name="tahun" id="tahun">
                    <?php for ($i=2020; $i <= date("Y"); $i++) { ?>
                      <option value="<?php echo $i ?>" <?php echo $selbulan = (date("Y") == $i) ? "selected" : "" ;  ?>><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="row form-group">
                <div class="col col-md-12">
                  <label for="nama" class=" form-control-label">Bulan</label>
                  <select class="mdb-select colorful-select dropdown-info md-form initialized" name="bulan" id="bulan">
                    <option value="1" <?php echo $selbulan = (date("m") == 1) ? "selected" : "" ;  ?>>Januari</option>
                    <option value="2" <?php echo $selbulan = (date("m") == 2) ? "selected" : "" ;  ?>>Februari</option>
                    <option value="3" <?php echo $selbulan = (date("m") == 3) ? "selected" : "" ;  ?>>Maret</option>
                    <option value="4" <?php echo $selbulan = (date("m") == 4) ? "selected" : "" ;  ?>>April</option>
                    <option value="5" <?php echo $selbulan = (date("m") == 5) ? "selected" : "" ;  ?>>Mei</option>
                    <option value="6" <?php echo $selbulan = (date("m") == 6) ? "selected" : "" ;  ?>>Juni</option>
                    <option value="7" <?php echo $selbulan = (date("m") == 7) ? "selected" : "" ;  ?>>Juli</option>
                    <option value="8" <?php echo $selbulan = (date("m") == 8) ? "selected" : "" ;  ?>>Agustus</option>
                    <option value="9" <?php echo $selbulan = (date("m") == 9) ? "selected" : "" ;  ?>>September</option>
                    <option value="10"<?php echo $selbulan = (date("m") == 10) ? "selected" : "" ;  ?>>Oktober</option>
                    <option value="11"<?php echo $selbulan = (date("m") == 11) ? "selected" : "" ;  ?>>November</option>
                    <option value="12"<?php echo $selbulan = (date("m") == 12) ? "selected" : "" ;  ?>>Desember</option>
                  </select>
                </div>
            </div>
          </div>
          <div class="col-sm-3">
            <button onclick="filter_kunjungan()" type="button" name="button" class="btn btn-info">Cari</button>
          </div>
          <div class="table-responsive">

          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
  $( document ).ready(function() {
      filter_kunjungan();
  });

  function filter_kunjungan() {
    var tahun = $("#tahun").val();
    var bulan = $("#bulan").val();
    var iddokter = $("#iddokter").val();
    var tanggal = tahun+"-"+bulan;
    $.ajax({
        type  : 'POST',
        url   : '<?php echo base_url() ?>K_Binaan/KBPasien/filterPerawat',
        data  : {tanggal:tanggal, idkb:iddokter},
        success : function(response){
          $(".table-responsive").html(response);
        }
    });
  }

  </script>
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
            data:['Poli Umum','Poli Gigi','UGD/IGD']
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
