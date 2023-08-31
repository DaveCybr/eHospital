
<?php echo form_open('Perencanaan/delete');?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-hover table-striped table-bordered ">
              <thead>
                  <tr>
                    <th width="10%">
                      <input type="checkbox" class="form-check-input select-all" id="tableMaterialChec">
                      <label class="form-check-label" for="tableMaterialChec"></label>
                    </th>

                      <th style="text-align:right;">Tanggal</th>
                      <th>Supplier</th>
                      <th>Status</th>
                      <th>Opsi</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($perencanaan as $data) {?>
                  <?php $id_check = $data->idperencanaan;?>
                  <tr>
                    <td>
                      <input type="checkbox" class="form-check-input id_checkbox" id="tableMaterialCheck<?php echo $id_check ?>" name="id[]" value="<?php echo $id_check ?>">
                      <label class="form-check-label" for="tableMaterialCheck<?php echo $id_check ?>"></label>
                    </td>
                      <td style="text-align:right;"><?php echo date("d-m-Y",strtotime($data->tanggal))?></td>
                      <td><?php echo $data->nama?></td>
                      <td><?php echo $data->status==0?"Belum Dikoreksi":"Sudah Dikoreksi"?></td>
                      <td>
                          <?php if($data->status==0):?>
                        <a class="fitur_terbatas" href="<?php base_url()?>/Perencanaan/persetujuan/<?php echo $data->idperencanaan;?>">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Koreksi Perencanaan">
                          <!--<i class="fa fa-edit"></i>-->Koreksi
                        </button>
                        </a>
                        <?php else:?>
                        <a href="<?php base_url()?>/Perencanaan/detail_perencanaan/<?php echo $data->idperencanaan;?>">
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lihat Detail">
                          <i class="fa fa-edit"></i> Lihat Detail
                        </button>
                        </a>
                        <?php endif?>

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
