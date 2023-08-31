
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('58f10ec738925cc9cf18', {
    cluster: 'ap1',
    forceTLS: true
  });

  var channel = pusher.subscribe('ci_pusher');
  channel.bind('my-event', function(data) {
    $("#kunjungan_"+data.pasien_noRM).remove();
    // alert(JSON.stringify(data));
    var html = "";
    var poli = $("#poli_sekarang").val();
    var kode_tupel = data.tupel_kode_tupel;
    var warna = 'badge-primary';
    var type = "IN";
    if (kode_tupel == "UMU"){
      warna = "badge-success";
      type = "U";
    }else if(kode_tupel == "OBG"){
      warna = "badge-info";
      type = "O";
    }else if (kode_tupel == "GIG") {
      warna = "badge-warning";
      type = "G"
    }
    else if (kode_tupel == "IGD") {
      warna = "badge-danger";
      type = "IG"
    }

    var jk='';
    if (data.jenis_kunjungan == 1) {
      jk = "Lama";
    } else {
      jk = "Baru";
    }
    var no = [];
    $('.no_kunjungan_hari_ini').each(function(){
      no.push($(this).text());
    });
    var pnjng_no = no.length+1;
    html+='<tr id="kunjungan_'+data.pasien_noRM+'">'+
    '<td class="no_kunjungan_hari_ini">'+pnjng_no+'</td>'+
    '<td>'+data.pasien_noRM+'</td>'+
    '<td>'+data.nama+'</td>'+
    '<td><h4><span class="badge badge-pill '+warna+'">'+data.tujuan_pelayanan+'</span></h4></td>'+
    '<td>'+type+data.no_antrian+'</td>'+
    '<td>'+data.jam_daftar+'</td>'+
    '<td>'+jk+'</td>'+
    '<td class="periksa">'+
    '<a href="'+data.url+'">'+
    '<button type="button" class="btn btn-primary btn-sm periksa">'+
    '<i class="fa fa-medkit"></i> Periksa'+
    '</button>'+
    '</a>'+
    '<a href="#">'+
      '<button type="button" class="btn btn-success periksa btn-sm panggilan_pasien" antrian="'+poli+'"-"'+data.no_antrian+'">'+
        '<i class="fa fa-medkit"></i> Panggil Pasien'+
      '</button>'+
    '</a>'+
    '</td>'+
    '</tr>';
    var user = $("#user_jabatan").val();
    if (kode_tupel==poli || user=="kasir") {
      var audio = new Audio('http://utamahusada.esolusindo.com/desain/assets/custom/qr_reader/audio/notif.mp3');
      audio.play();
      $("#tabel_belum_periksa").append(html);
      // $("#tabel_belum_periksa").dataTable();
      var total = parseInt($(".total_billing").text());
      total +=1;
      $(".total_billing").text(total);
      var jumlah_pasien = parseInt($(".jumlah_"+kode_tupel).text())+1;
      $(".jumlah_"+kode_tupel).text(jumlah_pasien);
      var html = '<a href="<?php echo base_url()."Kunjungan"?>">'+
          '<div class="mail-contnet">'+
              '<h5>Kunjungan Pasien</h5> <span class="mail-desc">Ada '+jumlah_pasien+' pasien belum di periksa</span></div>'+
      '</a>';
      $(".tujuan_"+kode_tupel).html(html);

    }
  });
