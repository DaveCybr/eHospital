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

  $(document).on('click','.detail_nota',function(){
    var data_detail = {
      'no_nota' : $(this).attr('id'),
    };
    alert(data_detail.no_nota);
    // myajax_request(base_url+"PembelianObat/get_detail",data_detail,render_tabel);
  });

  function render_tabel(res) {
    var markup="";
    for(var i=0;i<res.lenght;i++){
      markup += "<tr>" +
            "<td>"+res.idobat[i]+"</td>" +
            "<td>"+res.nama_obat[i]+"</td>" +
            "<td>"+res.no_batch[i]+"</td>" +
            "<td>"+res.tanggal_expired[i]+"</td>" +
            "<td>"+res.hrg_beli[i]+"</td>" +
            "<td>"+res.jumlah[i]+"</td>" +
            "<td>"+res.diskon[i]+"</td>" +
            "<td>"+res.ppn[i]+"</td>" +
            "<td>"+res.total_harga[i]+"</td>" +
            "</tr>";

    }
    $("tbody#obat").html(markup);
  }

});
