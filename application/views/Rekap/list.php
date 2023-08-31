

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <h4><a href="" class="white-text mx-3">Rekapitulasi</a></h4>
      </div>
      <div class="card-body">
        <div class="row p-t-20">
          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Dari Tanggal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" value="<?php echo date("Y-m-d")?>" required>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Sampai Tanggal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <input type="date" name="tgl_sampai" id="tgl_sampai" class="form-control" value="<?php echo date("Y-m-d")?>" required>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Filter</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-instagram"></i></span> -->
                </div>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <button type="button" id="filter_data" class="btn btn-info"><i class="fa fa-search"></i>  Filter</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row col-md-12">
          <h2 >Laporan Kunjungan Loket</h2>
          <div class="table-responsive">
            <table id="kunjungan" class="table table-striped table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Poli</th>
                        <th>Jumlah Kunjungan</th>
                        <th>Sudah Billing</th>
                        <th>Belum Terbilling</th>
                        <th>Rujuk Rawat Inap</th>
                    </tr>
                </thead>
                <tbody id="data_kunjungan">
                </tbody>
              </table>
          </div>
        </div>
        <div class="row col-md-12 m-t-20">
          <h2 >Laporan Pendapatan</h2>
          <div class="table-responsive">
            <table id="kunjungan" class="table table-striped table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No Rekening</th>
                        <th>Nama Rekening</th>
                        <th>Kredit</th>
                    </tr>
                </thead>
                <tbody id="jurnal">
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(function(){
    function addCommas(nStr)
  {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
  }
    var base_url = '<?php echo base_url()?>';
    function myajax_request(url,data,callback){
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
    $(document).on("click","#filter_data",function(){
      var data = {
        'tgl_mulai' : $("#tgl_mulai").val(),
        'tgl_sampai': $("#tgl_sampai").val()
      };

      myajax_request(base_url+"Rekap/get_data",data,function(response){
        // alert(response)
        var kunjungan = '';
        var data_kunjungan = response.kunjungan;
        for (var i = 0; i < data_kunjungan.length; i++) {
          var no = i+1;
          kunjungan += '<tr>'+
          '<td>'+no+'</td>'+
          '<td>'+data_kunjungan[i].tujuan+'</td>'+
          '<td>'+data_kunjungan[i].jumlah+'</td>'+
          '<td>'+data_kunjungan[i].billing+'</td>'+
          '<td>'+data_kunjungan[i].non_billing+'</td>'+
          '<td>'+data_kunjungan[i].rujuk+'</td>';
        }
        var jurnal = response.jurnal;
        var html_jurnal = '';
        var total_kredit = 0;
        for (var i = 0; i < jurnal.length; i++) {
          var no = i+1;
          html_jurnal += '<tr>'+
          '<td>'+no+'</td>'+
          '<td>'+jurnal[i].norek+'</td>'+
          '<td>'+jurnal[i].namarek+'</td>'+
          '<td>Rp.'+addCommas(jurnal[i].kredit)+'</td>';
          total_kredit += parseInt(jurnal[i].kredit);
        }
        html_jurnal += '<tr>'+
        '<td>#</td>'+
        '<td colspan="2">TOTAL</td>'+
        '<td>Rp.'+addCommas(total_kredit)+'</td>';
        $("#data_kunjungan").html(kunjungan);
        $("#jurnal").html(html_jurnal);
      });
    })


  })
</script>
