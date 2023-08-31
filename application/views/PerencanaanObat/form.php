
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
      <div class="col-md-6">
        <div class="row form-group">
                <div class="col-md-3">
                  <label for="supplier" class=" form-control-label">Supplier</label>
                </div>
                <div class="col-md-6">
                  <!-- <select name="supplier" id="supplier" class="mdb-select colorful-select dropdown-info sm-form" required>
                      <option disabled selected>Pilih Supplier</option>
                      <?php foreach ($supplier as $value): ?>
                        <option value="<?php echo $value->kode_sup;?>" id="<?php echo $value->kode_sup;?>"><?php echo @$value->nama;?></option>
                      <?php endforeach; ?>
                  </select> -->
                  <input type="text" id="nama_sup" class="form-control" placeholder="Nama Supplier" readonly required>
                  <input type="text" name="supplier" id="supplier" class="form-control" hidden required>
                </div>
                <div class="col-md-2">
                  <a href="#" data-toggle="modal" data-target="#scrollmodal_sup"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="Tambahkan Supplier" id="tambahkan_sup"><i class="fa fa-user"></i> Tambah Supplier</button></a>
                </div>
        </div>
      </div>
        
    </div>
  </div>
</div>
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
      <div class="col-md-9">
        <a href="#" data-toggle="modal" data-target="#scrollmodal"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="2. Tambahkan list obat yang sudah dibeli" id="tambahkan"><i class="fa fa-plus"></i> Input Obat</button></a>
      </div>
      <div class="col-md-12" style="margin-top:20px;">

          <div class="table-responsive">
              <table id="list_pembelian_obat" class="table editable-table table-bordered table-striped m-b-0">
                <thead>
                  <tr>
                    <th >Kode Obat / Nama Obat</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody id="obat">
                  
                </tbody>

              </table>
          </div>
          <!-- END DATA TABLE-->
        </div>
    </div>
  </div>
</div>
	<script type="text/javascript" src="<?php echo base_url();?>desain/dist/simple.money.format.js"></script>
	<script type="text/javascript">
		$('.money').simpleMoneyFormat();
	</script>

<!--<script src="<?php echo base_url();?>desain/assets/custom/pengadaanobat.js"></script>-->
<script>
$(document).ready(function(){
    $(document).on("click",".add_obat2",function(){
        var kode = $(this).attr("id");
        var nama = $(this).attr("nm");
        var markup = "<tr>" +
        "<td><input hidden value='"+ kode +"' name='id_obat[]'><input hidden value='' name='satuan[]' id='satuan"+kode+"'>"+ nama +"</td>" +
        "<td><button type=\"button\"  class=\"hapus btn btn-danger btn-sm btn-circle\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Data\"><i class=\"fa fa-trash\"></i></button></td>"+
        "</tr>";
        $("tbody#obat").append(markup);
        $("#scrollmodal").modal('toggle');
    })
})
$(function(){
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
  $('.tanggal_new').pickadate({
  // min: new Date(2015,3,20),
  format: 'dd-mm-yyyy',
  formatSubmit: 'yyyy-mm-dd',
  min: true
})
$('.tanggal_new2').pickadate({
// min: new Date(2015,3,20),
format: 'dd-mm-yyyy',
formatSubmit: 'yyyy-mm-dd',
max: true
})

  $(document).on('click','.hapus_detail',function(){
    var data_detail = {
      'id' : $(this).attr('id'),
    };
    var index_row = $(this);
    myajax_request(base_url+"PembelianObat/hapus_detail",data_detail,function(res){
      if(res.success){
        deleteRowLab(index_row);
      }
    });
  });

  $(document).on("change","#search_obat",function(){
    var data = {
     'id_obat' : $("#search_obat option:selected").val()
    };
    myajax_request(base_url+"PembelianObat/get_satuan",data,function(respone){
     var mark = ""
     if (respone.length>0) {
       for(var i=0;i<respone.length;i++){
         mark += '<option value ="'+respone[i].harga_satuan+'" nama_satuan="'+respone[i].label+'">'+respone[i].satuan+'</option>'
       }
       $("#hrg_bl").val(respone[0].harga_satuan);
     }else{
       mark += '<option value="">-- Satuan Obat --</option>';
       $("#hrg_bl").val(0);
     }
     $("#satuan_obat").html(mark);

    });
  });
});
</script>
