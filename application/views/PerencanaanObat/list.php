
<?php echo form_open('Perencanaan/delete');?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <div>
              <button type="button" class="btn btn_hapus btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data"><i class="fas fa-trash-alt mt-0"></i></button>
              <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jumlah Item Terpilih"><span id="jumlah_pilih">0</span></button>
            </div>
            <a href="" class="white-text mx-3">Perencanaan Obat</a>
            <div>
              <a href="<?php base_url(); ?>Perencanaan/input" class="float-right">
              <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><i class="fas fa-pencil-alt mt-0"></i></button>
            </a>
            </div>
      </div>
      <ul class="nav nav-tabs customtab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#home2" role="tab">
            <span class="hidden-sm-up">
              <i class="fas fa-user-clock"></i>
            </span>
            <span class="hidden-xs-down">Belum Dikoreksi</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#profile2" role="tab">
              <span class="hidden-sm-up">
                <i class="fas fa-user-check"></i>
              </span>
              <span class="hidden-xs-down">Sudah Dikoreksi</span></a>
            </li>
        </ul>

      <div class="tab-content">
        <div class="tab-pane active p-20" id="home2" role="tabpanel">
          <?php $this->load->view('PerencanaanObat/belum') ?>
        </div>
        <div class="tab-pane  p-20" id="profile2" role="tabpanel">
          <?php $this->load->view('PerencanaanObat/sudah') ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="alert"><?php echo $this->Core->Hapus_disable(); ?></div>
<div id="modal"><?php echo $this->Core->Hapus_aktif(); ?></div>
<?php echo form_close();?>
<?php $this->load->view($form_dialog)?>
<script>
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
    myajax_request(base_url+"Perencanaan/get_detail",data_detail,function(res){
      var tes="";
      // alert(res);
      for (var i = 0; i < res.length; i++) {
        tes += "<tr>" +
              "<td>"+res[i].idobat+"</td>" +
              "<td>"+res[i].nama_obat+"</td>" +
              "<td>"+res[i].no_batch+"</td>" +
              "<td>"+res[i].tanggal_expired+"</td>" +
              "<td>Rp."+addCommas(res[i].hrg_beli)+"</td>" +
              "<td>"+res[i].jumlah+"</td>" +
              "<td>"+res[i].diskon+"%</td>" +
              "<td>"+res[i].ppn+"%</td>" +
              "<td>Rp."+addCommas(res[i].total_harga)+"</td>" +
              "</tr>";

      }
      $("#no_nota").html(res[0].no_nota);
      $("#no_nota_s").html(res[0].no_nota_supplier);
      $("#tgl_transaksi").html(res[0].tanggal_masuk);
      $("#j_tempo").html(res[0].tanggal_jatuh_tempo);
      $("#supplier").html(res[0].nama);
      $(".sts").html(res[0].status);
      $("#t_disk").html(res[0].total_diskon+"%");
      $("#t_ppn").html(res[0].total_ppn+"%");
      $("#t_harga").html("Rp."+addCommas(res[0].total_transaksi));
      $("#bayar_final").html("Rp."+addCommas(res[0].total_bayar));
      $("#bayar").html("Rp."+addCommas(res[0].bayar));
      $("#sisa").html("Rp."+addCommas(res[0].sisa));
      $("#obat").html(tes);
    });
  });
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
});

</script>
