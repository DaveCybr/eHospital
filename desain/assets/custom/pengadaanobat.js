$(function(){
  var no_batch = $("#no_batch");
  var tgl_ex = $("#tgl_ex");
  var hrg_bl = $("#hrg_bl");
  var jml = $("#jml");
  var dis = $("#dis");
  var ppn_brng = $("#ppn_brng");
  var g_transaksi;
  var list_obat = [];
  $(document).ready(function(){
    $(".list_id_obat").each(function(){
      list_obat.push($(this).val());
    })
  })

  function cek_ppn(){
    return (hrg_bl.val()*jml.val())*0.1;
  }
  hrg_bl.keyup(function(){
    var ppn = cek_ppn();
    ppn_brng.val(ppn);
  });


  // $(document).on("change","#satuan_obat",function(){
  //   var harga = $("#satuan_obat option:selected").val();
  //   $("#hrg_bl").val(harga);
  //   var ppn = cek_ppn();
  //   ppn_brng.val(ppn);
  // });
  jml.keyup(function(){
    var ppn = cek_ppn();
    ppn_brng.val(ppn);
  });
  $(document).on('click','.add_obat',function(){
    var th = $(this);
    var satuan = $(this).attr("satuan").split(",");
    var harga_satuan = $(this).attr("harga").split(",");
    var option = "";
    for (var i = 0; i < satuan.length; i++) {
      option += "<option value='"+satuan[i]+"' harga='"+harga_satuan[i]+"'>"+satuan[i]+"</option>";
    }
    var data ={
      'id_obat' : $(th).attr('id'),
      'nama_obat' : $(th).attr('nm'),
      'hrg_bl' : harga_satuan[0],
      'jml' : 1,
      'dis' : 0,
      'ppn_brng' : 0,
      'satuan' :  option,
    };
    if (list_obat.indexOf(data.id_obat) > -1) {
      alert("Obat ini telah ditambahkan sebelumnya");
    }else{
      tambahobat(data);
      if ($("#tot_ppn").val()!=0||$("#tot_diskon").val()!=0) {
        _total();
        total_final();
      }else{
        _total();
      }
      list_obat.push(data.id_obat);
    }

  });

  function flush_form(){
    tgl_ex.val("");
    no_batch.val("");
    hrg_bl.val("");
    jml.val("");
    dis.val("");
    dis.ppn_brng.val("");
  };

  $(document).on('click','.hapus',function(){
    // deleteRow(this);
    var row = (this);
    var index = row.parentNode.parentNode.rowIndex;
    var index_array = index-1;
    list_obat.splice(index_array, 1);
    $(this).parent().parent().remove();
    if ($("#tot_ppn").val()!=0||$("#tot_diskon").val()!=0) {
      _total();
      total_final();
    }else{
      _total();
    }
  });

  $(document).on('click','.pilih_obat',function(){
    var data = {
      'id_obat' : $(this).attr("id")
    };
    myajax_request(base_url+"PembelianObat/get_obat",data,tambahobat);
  });
  function prefix() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 1; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
  }
  function tambahobat(res) {
    var pr = prefix();
    var kode = res.id_obat;
    var nama = res.nama_obat,no_batch = res.no_batch,tgl_ex=res.tgl_ex,
    hrg_bl = res.hrg_bl,jml=res.jml,dis=res.dis,ppn=res.ppn_brng,satuan=res.satuan;
    var ttl_harga = parseInt((hrg_bl*jml));

    var option = "<select kode='"+kode+"' name='satuan_beli' class='mdb-select"+kode+" colorful-select dropdown-info sd-form pil_satuan'>"+res.satuan+"</select>";
    var markup = "<tr>" +
    "<td><input hidden value='"+ kode +"' name='id_obat[]'><input hidden value='' name='satuan[]' id='satuan"+kode+"'>"+ nama +"</td>" +
    "<td><input type='text' name='no_batch[]' class='form-control'></td>" +
    "<td><input type='date' name='ed[]' class='form-control'></td>" +
    "<td>"+option+"</td>" +
    "<td><input type='text' min='0' id='hrg"+kode+"' kode='"+kode+"' name='harga_beli[]' class='money"+kode+" form-control beli' value="+hrg_bl+" onkeydown='return alphaOnly(event);'></td>" +
    "<td><input type='number' min='1' id='jml"+kode+"' kode='"+kode+"' class='form-control jml_beli' name='jumlah[]' value='1'></td>" +
    "<td><input class='diskon_obat form-control diskon' id='diskon"+kode+"' kode='"+kode+"' value='0'  min='0' type='number' name='diskon[]'></td>" +
    "<td><input class='ppn_obat form-control' type='number' min='0' kode='"+kode+"' id='ppn"+kode+"' value='0' name='ppn[]'></td>" +
    "<td style='text-align:right;'><input class='ttl_harga_obat ttl_harga"+kode+"' type='hidden' value='"+ttl_harga+"' name='ttl_harga[]'><span id='label_ttl_"+kode+"'>Rp."+addCommas(ttl_harga)+"</span></td>" +
    "<td><button type=\"button\"  class=\"hapus btn btn-danger btn-sm btn-circle\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Data\"><i class=\"fa fa-trash\"></i></button></td>"+
    "</tr>";
    $("tbody#obat").append(markup);
    $("#scrollmodal").modal('toggle');
    $('.mdb-select'+kode).material_select();
    $('.money'+kode).simpleMoneyFormat();

  }
  $(document).on("blur",".diskon",function(){
    $("#tot_diskon").val(0);
    $("#tot_ppn").val(0);
    var kode = $(this).attr("kode");
    var diskon = $(this).val();
    if (diskon=='' || diskon<0) {
      $(this).val(0);
    }
      hitung_total_saja(kode);

  })
  $(document).on("blur","#tot_diskon",function(){
    // var kode = $(this).attr("kode");
    // var tot_diskon = $(this).val();
    // if (tot_diskon=='' || tot_diskon<0) {
    //   $(this).val(0);
    // }
    //   // hitung_total_saja(kode);
    // _total_2($(this),$("#tot_ppn"));
    _total_baru();

  })
  $(document).on("blur","#tot_ppn",function(){
    // var kode = $(this).attr("kode");
    // var tot_ppn = $(this).val();
    // if (tot_ppn=='' || tot_ppn<0) {
    //   $(this).val(0);
    // }
    //   // hitung_total_saja(kode);
    // _total_2($("#tot_diskon"),$(this));
    _total_baru();
  })
  $(document).on("blur",".ppn_obat",function(){
    $("#tot_diskon").val(0);
    $("#tot_ppn").val(0);
    var kode = $(this).attr("kode");
    var ppn = $(this).val();
    if (ppn=='' || ppn<0) {
      $(this).val(0);
    }
      hitung_total_saja(kode);

  })
  $(document).on("blur",".jml_beli",function(){
    var jml = $(this).val();
    var kode = $(this).attr("kode");
    if (jml=='' || jml<1) {
      $(this).val(1);
    }
      hitung_total_saja(kode);

  })
  $(document).on("blur",".beli",function(){
    var hrg = $(this).val();
    var kode = $(this).attr("kode");
    if (hrg=='' || hrg<0) {
      $(this).val(0);
    }
      hitung_total_saja(kode);

  })
  function hitung_total_saja(kode){

    var hrg = removeComas($("#hrg"+kode).val());
    var jml = $("#jml"+kode).val();
    var diskon = $("#diskon"+kode).val();
    var ppn = $("#ppn"+kode).val();
    console.log(hrg);
    var diskon_percent = parseInt(diskon)/100;
    var ppn_pecent = parseInt(ppn)/100;
    var total_ppn = parseInt(hrg)*parseInt(jml)*ppn_pecent;
    var total_diskon = parseInt(hrg)*parseInt(jml)*diskon_percent;

    console.log(total_ppn);
    if (!isFinite(total_ppn)) {
      total_ppn = 0;
    }
    if (!isFinite(total_diskon)) {
      total_diskon = 0;
    }
    console.log(total_ppn);
    var ttl = (((parseInt(hrg)*parseInt(jml))+parseInt(total_ppn))-parseInt(total_diskon));
    console.log(ttl);
    if (isNaN(ttl)) {
      ttl = 0;
    }
    $("#label_ttl_"+kode).text("Rp."+addCommas(ttl));
    $(".ttl_harga"+kode).val(ttl);
    if ($("#tot_ppn").val()!=0||$("#tot_diskon").val()!=0) {
      _total();
      total_final();
    }else{
      _total();
    }
  }
  $(document).on("change",".pil_satuan",function(){
    var kode = $(this).attr("kode");
    var hrg = $("option:selected",this).attr("harga");
    var satuan = $("option:selected",this).val();
    var jml = $("#jml"+kode).val();
    $("#hrg"+kode).val(hrg);
    $("#hrg"+kode).simpleMoneyFormat();
    $("#satuan"+kode).val(satuan);
    hitung_total_saja(kode);

  })
  function _total_baru() {
    $('.ppn_obat').each(function(){
      var kode = $(this).attr("kode");
      $("#ppn"+kode).val(0);
      $("#diskon"+kode).val(0);
      hitung_total_saja(kode);
    });
    total_final();
  }
  function total_final(){
    var hrg = $("#tot_harga").val();
    var ppn = $("#tot_ppn").val();
    var diskon = $("#tot_diskon").val();
    var diskon_percent = parseInt(diskon)/100;
    var ppn_pecent = parseInt(ppn)/100;
    var total_ppn = parseInt(hrg)*ppn_pecent;
    var total_diskon = parseInt(hrg)*diskon_percent;

    // console.log(total_ppn);
    if (!isFinite(total_ppn)) {
      total_ppn = 0;
    }
    if (!isFinite(total_diskon)) {
      total_diskon = 0;
    }
    // console.log(total_ppn);
    var ttl = (parseInt(hrg)+parseInt(total_ppn))-parseInt(total_diskon);
    // console.log(ttl);

    $("#bayar_final").text("Rp."+addCommas(ttl));
    $(".bayar_final").val(ttl);

  }
  // function _total_2(dis,ppn){
  //   var total_diskon = [];
  //   var total_ppn = [];
  //   var total_harga = [];
  //   var total_ppn_final = 0;
  //   var total_diskon_final = 0;
  //   var total_harga_final = 0;
  //   var bayar = 0;
  //   $('.ttl_harga_obat').each(function(){
  //     total_harga.push($(this).val());
  //   });
  //   for(var i=0;i<total_harga.length;i++){
  //     total_harga_final = total_harga_final+parseInt(total_harga[i]);
  //   }
  //   total_diskon_final = dis.val();
  //   total_ppn_final = ppn.val();
  //   bayar = (parseInt(total_harga_final)+parseInt(total_ppn_final))-parseInt(total_diskon_final);
  //   if(bayar<0){
  //     bayar = 0;
  //   }
  //   $("#t_disk").text("Rp."+addCommas(total_diskon_final));
  //   $("#t_ppn").text("Rp."+addCommas(total_ppn_final));
  //   $("#t_harga").text("Rp."+addCommas(total_harga_final));
  //   $("#tot_diskon").val(total_diskon_final);
  //   $("#tot_ppn").val(total_ppn_final);
  //   $("#tot_harga").val(total_harga_final);
  //   $("#bayar_final").text("Rp."+addCommas(bayar));
  //   $(".bayar_final").val(bayar);
  //   g_transaksi = bayar;
  //   cek_sisa();
  // }
  $(document).on('keyup','.bayar',function(){
    var bayar = removeComas($(this).val());
    var transaksi = $(".bayar_final").val();
    var sisa = parseInt(transaksi)-parseInt(bayar);
    // if(sisa<0){
    //   sisa=0;
    // }
    console.log(transaksi);
    console.log(sisa);
    // if (!isNaN(sisa)) {
      $(".sisa").val(sisa);
      $("#sisa").text("Rp."+addCommas(sisa));
    // }else{
    //   $("#sisa").text("Rp.0");
    //   $(".sisa").val(0);
    // }
  });

  function _total(){
    // var total_diskon = [];
    // var total_ppn = [];
    var total_harga = [];
    // var total_ppn_final = 0;
    // var total_diskon_final = 0;
    var total_harga_final = 0;
    // var bayar = 0;
    // $('.diskon_obat').each(function(){
    //   total_diskon.push($(this).val());
    // });
    // $('.ppn_obat').each(function(){
    //   total_ppn.push($(this).val());
    // });
    $('.ttl_harga_obat').each(function(){
      total_harga.push($(this).val());
    });
    for(var i=0;i<total_harga.length;i++){
      // total_diskon_final = total_diskon_final+parseInt(total_diskon[i]);
      // total_ppn_final = total_ppn_final+parseInt(total_ppn[i]);
      total_harga_final = total_harga_final+parseInt(total_harga[i]);
    }
    // bayar = (parseInt(total_harga_final)+parseInt(total_ppn_final))-parseInt(total_diskon_final);
    // if(bayar<0){
    //   bayar = 0;
    // }
    // $("#t_disk").text("Rp."+addCommas(total_diskon_final));
    // $("#t_ppn").text("Rp."+addCommas(total_ppn_final));
    $("#t_harga").text("Rp."+addCommas(total_harga_final));
    // $("#tot_diskon").val(total_diskon_final);
    // $("#tot_ppn").val(total_ppn_final);
    $("#tot_harga").val(total_harga_final);
    $("#bayar_final").text("Rp."+addCommas(total_harga_final));
    $(".bayar_final").val(total_harga_final);
    // g_transaksi = bayar;
    // cek_sisa();
  }
  // $(document).on('keyup','.bayar',function(){
  //   cek_sisa();
  // });
  function cek_sisa(){
    var bayar = $(".bayar").val();
    var sisa = g_transaksi-bayar;
    // if(sisa<0){
    //   sisa=0;
    // }
    if (!isNaN(sisa)) {
      $(".sisa").val(sisa);
      $("#sisa").text("Rp."+addCommas(sisa));
    }else{
      $("#sisa").text("Rp.0");
      $(".sisa").val(0);
    }
  }
  // function deleteRow(r) {
  //   var i = r.parentNode.parentNode.rowIndex;
  //   document.getElementById("list_pembelian_obat").deleteRow(i);
  // }
  function addCommas(nStr){
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
  function removeComas(nilai){
    var hasil   = nilai.split(',');
    var shasil = "";
    for (var i = 0; i < hasil.length; i++) {
        shasil = shasil +""+ hasil[i];
    }
    return shasil;

  }
  function alphaOnly(event) {
    // alert("dhakd");
    var key = event.keyCode;
    if (key >= 48 && key <= 57){
      return key;
    };
  };

});
