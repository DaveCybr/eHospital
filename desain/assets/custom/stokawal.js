$(function(){
  var no_batch = $("#no_batch");
  var tgl_ex = $("#tgl_ex");
  var hrg_bl = $("#hrg_bl");
  var jml = $("#jml");
  var dis = $("#dis");
  var ppn_brng = $("#ppn_brng");
  var g_transaksi;
  var list_obat = [];


  function cek_ppn(){
    return (hrg_bl.val()*jml.val())*0.1;
  }
  hrg_bl.keyup(function(){
    var ppn = cek_ppn();
    ppn_brng.val(ppn);
  });

  $(document).on("change","#satuan_obat",function(){
    var harga = $("#satuan_obat option:selected").val();
    $("#hrg_bl").val(harga);
    var ppn = cek_ppn();
    ppn_brng.val(ppn);
  });
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
      'hrg_bl' : harga_satuan[2],
      'jml' : 1,
      'dis' : 0,
      'ppn_brng' : 0,
      'satuan' :  satuan[2],
    };
    if (list_obat.indexOf(data.id_obat) > -1) {
      alert("Obat ini telah ditambahkan sebelumnya");
    }else{
      tambahobat(data);
      _total();
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
    _total();
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
    var satuan = res.satuan;
    var kode = res.id_obat;
    var harga = res.hrg_bl;
    var nama = res.nama_obat,no_batch = res.no_batch,tgl_ex=res.tgl_ex,
    hrg_bl = res.hrg_bl,jml=res.jml,dis=res.dis,ppn=res.ppn_brng,satuan=res.satuan;
    var ttl_harga = (parseInt((hrg_bl*jml))+parseInt(ppn))-parseInt(dis);

    var option = "<select kode='"+kode+"' class='mdb-select"+kode+" colorful-select dropdown-info sd-form pil_satuan'>"+res.satuan+"</select>";
    var markup = "<tr>" +
    "<td><input type='hidden' name='harga[]' value='"+harga+"'><input hidden value='"+ kode +"' name='id_obat[]'>"+ nama +"</td>" +
    "<td><input type='text' name='no_batch[]' class='form-control'></td>" +
    "<td><input type='date' name='ed[]' class='form-control'></td>" +
    "<td><input type='hidden' name='satuan[]' value='"+satuan+"'>"+satuan+"</td>" +
    "<td><input type='number' id='jml"+kode+"' kode='"+kode+"' class='form-control jml_beli' name='jumlah[]' value='1'></td>" +
    "<td><button type=\"button\"  class=\"hapus btn btn-danger btn-sm btn-circle\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Data\"><i class=\"fa fa-trash\"></i></button></td>"+
    "</tr>";
    $("tbody#obat").append(markup);
    $("#scrollmodal").modal('toggle');
    // $('.mdb-select'+kode).material_select();
  }
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

});
