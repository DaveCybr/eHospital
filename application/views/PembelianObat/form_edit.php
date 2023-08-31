
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
      <div class="col-md-6">
        <div class="row form-group">
                  <div class="col-md-3">
                    <label for="no_nota_supplier" class=" form-control-label">No Nota Supplier</label>
                  </div>
                  <div class="col-md-9">
                      <input type="text" name="no_nota_supplier" id="no_nota_supplier" class="form-control" placeholder="xxxxxxxxx" value="<?php echo @$nota['no_nota_supplier'];?>">
                  </div>
        </div>
        <div class="row form-group">
                <div class="col-md-3">
                  <label for="supplier" class=" form-control-label">Supplier</label>
                </div>
                <div class="col-md-6">
                  <select name="supplier" id="supplier" class="mdb-select colorful-select dropdown-info sm-form">
                      <option value="" disabled selected>Pilih Supplier</option>
                      <?php foreach ($supplier as $value): ?>
                        <option value="<?php echo $value->kode_sup;?>" id="<?php echo $value->kode_sup;?>" <?php if (@$nota['supplier_kode_sup']=$value->kode_sup): ?>
                          selected
                        <?php endif; ?>><?php echo @$value->nama;?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
        </div>
      </div>
        <div class="col-md-6">
          <div class="row form-group">
                  <div class="col-md-3">
                    <label for="tanggal_masuk" class=" form-control-label">Tanggal Masuk</label>
                  </div>
                  <div class="col-md-9">
                      <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" value="<?php echo @$nota['tanggal_masuk'] ?>" required>
                  </div>
          </div>

          <div class="row form-group">
                  <div class="col-md-3">
                    <label for="jatuh_tempo" class=" form-control-label">Jatuh Tempo</label>
                  </div>
                  <div class="col-md-9">
                      <input type="date" name="jatuh_tempo" id="jatuh_tempo" class="form-control" value="<?php echo @$nota['tanggal_jatuh_tempo'] ?>">
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
        <a href="#" data-toggle="modal" data-target="#scrollmodal"><button type="button" class="btn btn-success btn-sm btn_tambah" data-toggle="tooltip" data-placement="right" data-original-title="2. Tambahkan list obat yang sudah dibeli" id="tambahkan"><i class="fa fa-plus"></i> Input Obat</button></a>
      </div>
      <div class="col-md-12" style="margin-top:20px;">

          <div class="table-responsive">
              <table id="list_pembelian_obat" class="table editable-table table-bordered table-striped m-b-0">
                <thead>
                  <tr>
                    <th>Kode Obat / Nama Obat</th>
                    <th>No Batch</th>
                    <th>Expired Date</th>
                    <th>Satuan</th>
                    <th>Harga Beli</th>
                    <th>Jumlah</th>
                    <th>Diskon</th>
                    <th>PPN (10%)</th>
                    <th>Total Harga</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody id="obat">
                  <?php foreach ($detail_nota as $value): ?>
                    <?php
                      $besar = '';
                      $sedang = '';
                      $kecil = '';
                      if ($value->satuan_beli==$value->satuan_besar) {
                        $besar = 'selected';
                      }
                      if ($value->satuan_beli==$value->satuan_sedang) {
                        $sedang = 'selected';
                      }
                      if ($value->satuan_beli==$value->satuan_kecil) {
                        $kecil = 'selected';
                      }
                      $option = "<select kode='".$value->idobat."' name='satuan_beli' class='mdb-select colorful-select dropdown-info sd-form pil_satuan'>
                        <option ".$besar." value='".$value->satuan_besar."' harga='".$value->harga_beli_satuan_besar."'>".$value->satuan_besar."</option>
                        <option ".$sedang." value='".$value->satuan_sedang."' harga='".$value->harga_beli_satuan_sedang."'>".$value->satuan_sedang."</option>
                        <option ".$kecil." value='".$value->satuan_kecil."' harga='".$value->harga_beli_satuan_kecil."'>".$value->satuan_kecil."</option>
                      </select>";
                    ?>
                    <tr>
                      <td><input hidden value='<?php echo $value->satuan_beli?>' name='satuan[]' id='satuan<?php echo $value->idobat?>'><input hidden value='<?php echo $value->idobat?>' name='id_obat[]'><?php echo $value->idobat.'/'.$value->nama_obat?></td>
                      <td><input type='text' name='no_batch[]' class='form-control' value="<?php echo $value->no_batch?>"></td>
                      <td><input type='date' name='ed[]' class='form-control' value="<?php echo $value->tanggal_expired?>"></td>
                      <td><?php echo $option ?></td>
                      <td><input type='number' id='hrg<?php echo $value->idobat?>' kode='<?php echo $value->idobat?>' name='harga_beli[]' class='form-control beli' value='<?php echo $value->hrg_beli?>'></td>
                      <td><input type='number' id='jml<?php echo $value->idobat?>' kode='<?php echo $value->idobat?>' class='form-control jml_beli' name='jumlah[]' value='<?php echo $value->jumlah?>'></td>
                      <td><input class='diskon_obat form-control diskon' id='diskon<?php echo $value->idobat?>' kode='<?php echo $value->idobat?>' value='<?php echo $value->diskon?>'  type='number' name='diskon[]'></td>
                      <td><input class='ppn_obat form-control' type='number' kode='<?php echo $value->idobat?>' id='ppn<?php echo $value->idobat?>' value='<?php echo $value->ppn?>' name='ppn[]'></td>
                      <td><input class='ttl_harga_obat ttl_harga<?php echo $value->idobat?>' type='hidden' value='<?php echo $value->total_harga?>' name='ttl_harga[]'><span id='label_ttl_<?php echo $value->idobat?>'>Rp.<?php echo number_format($value->total_harga)?></span></td>
                      <td><button type="button"  class="hapus btn btn-danger btn-sm btn-circle" data-toggle="tooltip" data-placement="top" data-original-title="Hapus Data"><i class="fa fa-trash"></i></button></td>
                    </tr>
                    <input type="hidden" value="<?php echo $value->idobat?>" class="list_id_obat">
                  <?php endforeach; ?>

                  <!-- <input type="hidden" id="tot_diskon" value="" name="tot_diskon">
                  <input type="hidden" id="tot_ppn" value="" name="tot_ppn"> -->
                  <input type="hidden" id="tot_harga" value="<?php echo $nota['total_transaksi']?>" name="tot_harga">
                  <input type="hidden" class="bayar_final" value="<?php echo $nota['total_bayar']?>" name="bayar_final">
                  <input type="hidden" class="sisa" value="<?php echo $nota['sisa']?>" name="sisa">
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6"><strong>TOTAL</strong></th>
                        <!-- <th id="t_disk">Rp.0</th>
                        <th id="t_ppn">Rp.0</th>
                        <th id="t_harga">Rp.0</th> -->
                        <th><input type="number" id="tot_diskon" value="<?php echo $nota['total_diskon']?>" name="tot_diskon" class="form-control"></th>
                        <th><input type="number" id="tot_ppn" value="<?php echo $nota['total_ppn']?>" name="tot_ppn" class="form-control"></th>
                        <th id="t_harga">Rp.<?php echo number_format($nota['total_transaksi'])?></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th colspan="6"><strong>TOTAL YANG HARUS DIBAYAR (TOTAL HARGA+PPN 10%) - DISKON</strong></th>
                        <th colspan="3" id="bayar_final">Rp.<?php echo number_format($nota['total_bayar'])?></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th colspan="6"><strong>BAYAR</strong></th>
                        <th colspan="3" id="bayar"><input type="number" class="bayar form-control" value="<?php echo $nota['bayar']?>" name="bayar" required></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th colspan="6"><strong>SISA</strong></th>
                        <th colspan="3" id="sisa">Rp.<?php echo number_format($nota['sisa'])?></th>
                        <th></th>
                    </tr>
                </tfoot>
              </table>
          </div>
          <!-- END DATA TABLE-->
        </div>
    </div>
  </div>
</div>


<script src="<?php echo base_url();?>desain/assets/custom/pengadaanobat.js"></script>
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
