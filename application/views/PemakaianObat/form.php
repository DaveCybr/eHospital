
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
      <div class="col-md-9">
        <a href="#" ><button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="Tampilkan obat" id="tampil"><i class="fa fa-eye"></i> Tampilkan Obat</button></a>
        <?php if ($this->uri->segment(3)==''): ?>
          <select class="mdb-select colorful-select dropdown-info md-form" id="filter" name="tupel" required>
            <option value="" disabled selected>Tujuan Obat Dikeluarkan</option>
            <option value="UMU" >KE POLI UMUM</option>
            <option value="GIG" >KE POLI GIGI</option>
            <option value="OBG" >KE OBSGYN</option>
            <option value="INT" >KE INTERNIS</option>
            <option value="IGD" >KE IGD</option>
          </select>
        <?php endif; ?>
        <!-- <a href="#" data-toggle="modal" data-target="#scrollmodal"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="cari obat" id="tambahkan"><i class="fa fa-plus"></i> Cari Obat</button></a> -->
      </div>
      <div class="col-md-12" style="margin-top:20px;">
        <div class="table-responsive tabel-obat">
          <table id="myTable" class="table table-bordered table-hover table-striped ">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th>Kode/No Barcode Obat</th>
                <th>Nama Obat</th>
                <th width="%5">opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($obat as $data):
                $id = $data->idobat;?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data->idobat; ?></td>
                  <td><?php echo $data->nama_obat; ?></td>
                  <td>
                    <button type="button" id="<?php echo $id;?>" class="list_batch btn-floating aqua-gradient" data-toggle="tooltip" data-placement="top" title="" data-original-title="TambahKan" >
                      <i class="fa fa-check"></i>
                    </button>

                    <!-- <button type="button" id="<?php echo $id;?>" satuan="<?php echo $data->satuan_besar.",".$data->satuan_sedang.",".$data->satuan_kecil;?>" harga="<?php echo $data->harga_beli_satuan_besar.",".$data->harga_beli_satuan_sedang.",".$data->harga_beli_satuan_kecil;?>" nm="<?php echo $data->idobat."/".$data->nama_obat?>"
                    class="btn-floating aqua-gradient cari_batch" data-toggle="tooltip" data-placement="top" title="" data-original-title="TambahKan" >
                    <i class="fa fa-check"></i>
                  </button> -->
                </td>
              </tr>
              <?php $no++;  endforeach; ?>
            </tbody>
          </table>
        </div>
        <br>
        <h3>Obat Terpilih</h3>
        <div class="table-responsive">
          <table id="list_pembelian_obat" class="table editable-table table-bordered table-striped m-b-0">
            <thead>
              <tr>
                <th>Kode Obat / Nama Obat</th>
                <th>No Batch</th>
                <th>Expired Date</th>
                <th>Jumlah</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="obat">
              <!-- <input type="hidden" id="tot_diskon" value="" name="tot_diskon">
              <input type="hidden" id="tot_ppn" value="" name="tot_ppn"> -->
              <input type="hidden" id="tot_harga" value="" name="tot_harga">
              <input type="hidden" class="bayar_final" value="" name="bayar_final">
              <input type="hidden" class="sisa" value="" name="sisa">
            </tbody>
          </table>
        </div>
        <!-- END DATA TABLE-->
      </div>
    </div>
  </div>
</div>
<script>
$(".tabel-obat").hide();
$(document).ready(function(){
  $("#tampil").click(function(){
    $(".tabel-obat").show();

  })
  var no_batch = [];
  var ed = [];
  var stok = [];
  var id_pengadaan = [];
  var jml_resep=0;
  var nama_obat = '';
  var kode_obat='';
  var detail =0 ;
  var list_batch=[];
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
  function kosongkan_array(){
    no_batch = [];
    ed = [];
    stok = [];
    id_pengadaan = [];
  }
  $(document).on('click','.list_batch',function(){
    kode_obat = $(this).attr('id');
    var data_detail = {
      'kode_obat' : $(this).attr('id'),
    };
    var jml = $(this).attr("jumlah");
    myajax_request(base_url+"Resep/get_batch",data_detail,function(res){
      kosongkan_array();
      var html = "";
      for (var i = 0; i < res.length; i++) {
        html += "<tr>"+
        "<td>"+res[i].no_batch+"</td>"+
        "<td>"+res[i].ed+"</td>"+
        "<td>"+res[i].stok+"</td>"+
        "<td><button type='button' id='"+i+"' class='tambah_batch btn-floating aqua-gradient' data-toggle='tooltip' data-placement='top' title='' data-original-title='TambahKan'><i class='fa fa-check'></i></button></td>"+
        "</tr>";
        no_batch.push(res[i].no_batch);
        ed.push(res[i].ed);
        stok.push(res[i].stok);
        id_pengadaan.push(res[i].id_pengadaan);
        nama_obat = res[i].nama_obat;
      }
      $("#tabel_batch").html(html);
      $("#tBatch").dataTable();
      $("#scrollmodal").modal("toggle");
    });
  });
  $(document).on('click','.hapus',function(){
    // alert("dhakd");
    // deleteRow(this);
    var row = (this);
    var index = row.parentNode.parentNode.rowIndex;
    var index_array = index-1;
    list_batch.splice(index_array, 1);
    $(this).parent().parent().remove();
  });
  $(document).on("click",".tambah_batch",function(){
    // alert($(this).attr("id"));
    var id= $(this).attr("id");
    if (list_batch.indexOf(id_pengadaan[id]) > -1) {
      alert("Obat dengan no batch ini telah ditambahkan sebelumnya");
    }else{
      var markup = "<tr>" +
      "<td><input hidden value='"+ kode_obat +"' name='id_obat[]'><input type='hidden' name='id_pengadaan[]' value='"+id_pengadaan[id]+"'>"+kode_obat+"/"+ nama_obat +"</td>" +
      "<td><input type='hidden' name='no_batch[]' class='form-control' value='"+no_batch[id]+"'>"+no_batch[id]+"</td>" +
      "<td><input type='hidden' name='ed[]' class='form-control'></td>" +
      "<td><input type='number' id='jml"+kode_obat+"' kode='"+kode_obat+"' class='form-control jml_beli' name='jumlah[]' value='1'></td>" +
      "<td><button type=\"button\"  class=\"hapus btn btn-danger btn-sm btn-circle\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Data\"><i class=\"fa fa-trash\"></i></button></td>"+
      "</tr>";
      $("tbody#obat").append(markup);
      $("#scrollmodal").modal('toggle');
      list_batch.push(id_pengadaan[id]);
    }

  })
});
</script>
