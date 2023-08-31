
<?php echo form_open('Obat/delete');?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <a href="" class="white-text mx-3"><h6>Data Obat Akan Kadaluarsa</h6></a>

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-striped table-bordered">
          <thead>
              <tr>
                  <th width="10%">No
                  </th>
                  <th>ID/No Barcode</th>
                  <th>No Batch</th>
                  <th>Nama Obat</th>
                  <th>Expired</th>
                  <th>Sisa Obat</th>
                </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach ($obat as $data) {?>
              <?php $id_check = $data->idobat;?>
              <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data->idobat?></td>
                  <td><?php echo $data->no_batch?></td>
                  <td><?php echo $data->nama_obat?></td>
                  <td><?php echo date("d-m-Y",strtotime($data->tanggal_expired))?></td>
                  <td><?php echo $data->jumlah?></td>

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

  $(document).on('click','.detail_obat',function(){
    var data_obat = {
      'id_obat' : $(this).attr('id'),
    };
    // alert(data_obat.id_obat);
    myajax_request(base_url+"Obat/get_data_obat",data_obat,function(res){
      // alert(res.idobat);
      $("#idobat").val(res.idobat);
      $("#nama_obat").val(res.nama_obat);
      $("#kategori_obat").val(res.kategori_obat);
      $("#jenis_obat").val(res.jenis_obat);
      $("#dosis").val(res.dosis);
      $("#kegunaan").val(res.kegunaan);
      $("#kandungan").val(res.kandungan);
      $("#satuan_besar").val(res.satuan_besar);
      $("#satuan_sedang").val(res.satuan_sedang);
      $("#satuan_kecil").val(res.satuan_kecil);
      $("#harga_satuan_besar").val("Rp."+res.harga_beli_satuan_besar);
      $("#harga_satuan_sedang").val("Rp."+res.harga_beli_satuan_sedang);
      $("#harga_satuan_kecil").val("Rp."+res.harga_beli_satuan_kecil);
      $("#rawat_jalan").val("Rp."+res.harga_1);
      $("#kelas_3").val("Rp."+res.harga_2);
      $("#kelas_2").val("Rp."+res.harga_3);
      $("#kelas_1").val("Rp."+res.harga_4);
      $("#vip").val("Rp."+res.harga_5);
    });
  });
});

</script>
