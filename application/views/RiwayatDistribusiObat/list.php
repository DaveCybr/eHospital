<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <div>

            </div>
            <a href="" class="white-text mx-3">Riwayat Distribusi Obat</a>
            <div>
              <!-- <a href="<?php base_url(); ?>PengajuanObat/input" class="float-right"> -->
              <!-- <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><i class="fas fa-pencil-alt mt-0"></i></button> -->
            </a>
            </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-hover table-striped table-bordered ">
              <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Penerima</th> 
                    <th>Opsi</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($riwayat_distribusi_obat as $data) {?>
                  <?php $id_check = $data->idpermintaan_unit;?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($data->tanggal))?></td>
                    <td><?php echo $data->jam; ?></td>
                    <td><?php echo $data->asal; ?></td>
                    <td>
                      <?php if ($_SESSION['poli']== 'IGD'): ?>
                        <!-- <i >Clear</i> -->
                        <?php else: ?>
                        

                          <a href="<?php echo base_url()."RiwayatDistribusiObat/detail/".$id_check?>" class="fitur_layani">
                            <button type="button" class="btn btn-primary btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail">
                              <i class="fa fa-eye"></i>
                            </button>
                          </a>
                        

                      <?php endif; ?>
                    </td>
                  </tr>
                <?php
                $no++;
                }?>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
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
    myajax_request(base_url+"PembelianObat/get_detail",data_detail,function(res){
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
