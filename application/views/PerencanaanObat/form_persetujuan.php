
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
      <div class="col-md-6">
        <div class="row form-group">
                <div class="col-md-3">
                  <label for="supplier" class=" form-control-label">Supplier</label>
                </div>
                <div class="col-md-6">
                  <input type="text" id="nama_sup" value="<?php echo $perencanaan->nama?>" class="form-control" placeholder="Nama Supplier" readonly required>
                  <input type="text" name="supplier" id="supplier" value="<?php echo $perencanaan->kode_sup?>" class="form-control" hidden required>
                </div>
                <div class="col-md-2">
                  <a href="#" data-toggle="modal" data-target="#scrollmodal_sup"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="Tambahkan Supplier" id="tambahkan_sup"><i class="fa fa-user"></i> Ganti Supplier</button></a>
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
        <!-- <a href="#" data-toggle="modal" data-target="#scrollmodal"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="2. Tambahkan list obat yang sudah dibeli" id="tambahkan"><i class="fa fa-plus"></i> Input Obat</button></a> -->
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
                  <?php foreach($detail_obat as $value):?>
                    <tr>
                        <td>
                          <input hidden value='<?php echo $value->iddetail_perencanaan?>' name='id_detail[]'>
                          <input hidden value='<?php echo $value->idobat?>' name='id_obat[]'>
                          <input hidden value='<?php echo $value->status_persetujuan?>' id="status_<?php echo $value->iddetail_perencanaan?>" name='status[]'><?php echo $value->nama_obat?></td>

                        <td><button type="button" detail="<?php echo $value->iddetail_perencanaan?>" id="setujui_<?php echo $value->iddetail_perencanaan?>"  class="setujui btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Setujui obat ini">Setuji</button></td>
                    </tr>
                  <?php endforeach?>
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

    $(document).on("click",".setujui",function(){
      var id = $(this).attr("detail");
      var status = $("#status_"+id).val();
      // alert(status);
      if (status==0) {
         $("#status_"+id).val("1");
         $("#setujui_"+id).text("Batalkan");

         $("#setujui_"+id).removeClass("btn-success");
         $("#setujui_"+id).addClass("btn-warning");
      }else{
         $("#status_"+id).val("0");
         $("#setujui_"+id).text("Setujui");
         $("#setujui_"+id).addClass("btn-success");
         $("#setujui_"+id).removeClass("btn-warning");
      }
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
