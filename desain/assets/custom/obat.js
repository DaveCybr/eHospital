$(document).ready(function(){
  var hsb = $("#harga_satuan_besar");
  var hss = $("#harga_satuan_sedang");
  var hsk = $("#harga_satuan_kecil");
  var jb = $("#jumlah_satuan_besar");
  var js = $("#jumlah_satuan_sedang");
  $(document).on('keyup',hsb,function(){
    var hrg_s = parseInt(hsb.val()/jb.val());
    var hrg_k = parseInt(hsb.val()/(jb.val()*js.val()));
    if (!isNaN(hrg_s)) {
      hss.val(hrg_s);
    }else{
      hss.val(0);
    }
    if(!isNaN(hrg_k)){
      hsk.val(hrg_k);
    } else{
      hsk.val(0);
    }
  });
  $(document).on("change","#satuan_besar",function(){
    // alert("dajkda");
    $("#besar").text($(this).val());
  })
  $(document).on("change","#satuan_besar",function(){
    $("#besar").text($(this).val());
  })
  $(document).on("change","#satuan_sedang",function(){
    $("#sedang").text($(this).val());
    $(".label_sedang").text($(this).val());
  })
  $(document).on("change","#satuan_kecil",function(){
    // $("#sedang").text($(this).val());
    $(".label_kecil").text($(this).val());
  })
});
