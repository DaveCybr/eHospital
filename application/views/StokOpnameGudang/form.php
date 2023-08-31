<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <?php echo form_open_multipart('StokOpnameGudang/insert/');?>
        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header aqua-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
              <h4><a href="" class="white-text mx-3">Stok Opname</a></h4>
            </div>
            <div class="card-body card-block">
              <button type="button" class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" data-target="#tabel_obat" data-placement="top" title="" data-original-title="scrollmodal" moda>
                                            <i class="fa fa-search"></i> Cari Obat
                </button>
              <div class="col-sm-12 row">
                <div class="form-group animated flipIn col-md-6 col-sm-12">
                  <label for="exampleInputuname">Tanggal :</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo date("Y-m-d") ?>">
                  </div>
                </div>
                <div class="form-group animated flipIn col-md-12 col-sm-12">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped ">
                      <thead>
                        <tr>
                          <th>Nama Obat</th>
                          <th>No Batch</th>
                          <th>Harga</th>
                          <th>Satuan</th>
                          <th>Stok Komputer</th>
                          <th>Stok Real</th>
                          <th>Selisih</th>
                          <th>Selisih Harga</th>
                          <th>keterangan</th>
                          <th width="%5">opsi</th>
                        </tr>
                      </thead>
                      <tbody id="tabel_opname">

                      </tbody>
                      </table>
                    </div>
                </div>


                <div class="col col-sm-12 com-md-12">
                  <button type="button" class="btn btn-outline-secondary btn-sm pull-left" onclick="window.history.back()"><i class="fa fa-reply"></i> Kembali</button>
                  <button type="submit" class="btn btn-primary btn-sm pull-right">SIMPAN</button>
                </div>


              </div>
            </div>
          </div>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="tabel_obat" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scrollmodalLabel">List Batch Dari Obat Ini</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-sm-12">
          <div class="table-responsive ">
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
                  </td>
                </tr>
                <?php $no++;  endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="scrollmodal" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scrollmodalLabel">List Batch Dari Obat Ini</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="tBatch" class="table table-bordered table-hover table-striped ">
            <thead>
              <tr>
                <th>Nama Obat</th>
                <th>No Batch</th>
                <th>Expired Date</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Satuan</th>

                <th width="%5">opsi</th>
              </tr>
            </thead>
            <tbody id="tabel_batch">

            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
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
      myajax_request(base_url+"StokOpnameGudang/list_batch",data_detail,function(res){
        kosongkan_array();

        $("tbody#tabel_opname").append(res.html);
        // var html = "";
        // for (var i = 0; i < res.length; i++) {
        //   html += "<tr>"+
        //   "<td>"+res[i].nama_obat+"</td>"+
        //   "<td>"+res[i].no_batch+"</td>"+
        //   "<td>"+res[i].ed+"</td>"+
        //   "<td>"+res[i].stok_akhir+"</td>"+
        //   "<td>"+res[i].harga_beli+"</td>"+
        //   "<td>"+res[i].satuan+"</td>"+
        //   "<td><button onclick=\"pilih(`"+res[i].idgudang_obat+"`,`"+kode_obat+"`,`"+res[i].no_batch+"`,`"+res[i].nama_obat+"`,`"+res[i].stok_akhir+"`,`"+res[i].harga_beli+"`,`"+res[i].satuan+"`)\" type='button' id='"+i+"' class='btn-floating blue-gradient' data-toggle='tooltip' data-placement='top' title='' data-original-title='TambahKan'><i class='fa fa-check'></i></button></td>"+
        //   "</tr>";
        //   no_batch.push(res[i].no_batch);
        //   ed.push(res[i].ed);
        //   stok.push(res[i].stok_akhir);
        //   id_pengadaan.push(res[i].idgudang_obat);
        //   nama_obat = res[i].nama_obat;
        // }
        // $("#tabel_batch").html(html);
        // $("#tBatch").dataTable();
        // $("#scrollmodal").modal("toggle");
        $("#tabel_obat").modal("toggle");
        // $("#scrollmodal").css('overflow-y', 'auto');
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

  function pilih(id_p, kode_obat, no_batch, nama_obat, stok, harga, satuan) {
    // alert(no_batch);
    var list_batch=[];
    // alert($(this).attr("id"));
    // var id= $(this).attr("id");
    if (list_batch.indexOf(id_p) > -1) {
      alert("Obat dengan no batch ini telah ditambahkan sebelumnya");
    }else{
      var markup = "<tr>" +
      "<td><input hidden value='"+ id_p +"' name='id_pengadaan[]'><input hidden value='"+ kode_obat +"' name='kode_obat[]'><input type='hidden' name='nama[]' value='"+nama_obat+"'>"+ nama_obat +"</td>" +
      "<td><input type='hidden' name='no_batch[]' class='form-control' value='"+no_batch+"'>"+no_batch+"</td>" +
      "<td><input type='hidden' id='harga_beli"+id_p+"' name='harga_beli[]' class='form-control' value='"+harga+"'>"+harga+"</td>" +
      "<td><input type='hidden' name='satuan[]' class='form-control' value='"+satuan+"'>"+satuan+"</td>" +
      "<td><input type='number' id='jumlah_komp"+id_p+"' class='form-control jml_beli' name='jumlah_komp[]' readonly value='"+stok+"'></td>" +
      "<td><input type='number'min='0' id='jumlah_real"+id_p+"' class='form-control jml_beli' name='jumlah_real[]' onkeyup='hitung(`"+id_p+"`)'></td>" +
      "<td><input type='number' readonly id='selisih"+id_p+"' class='form-control jml_beli' name='selisih[]'></td>" +
      "<td ><input type='hidden' id='selisih_harga"+id_p+"' class='form-control jml_beli' name='selisih_harga[]'><span id='tx_selisih_harga"+id_p+"''></span></td>" +
      "<td ><input type='text' id='ket' class='form-control' name='keterangan[]'></td>" +
      "<td><button type=\"button\"  class=\"hapus btn btn-danger btn-sm btn-circle\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Data\"><i class=\"fa fa-trash\"></i></button></td>"+
      "</tr>";
      $("tbody#tabel_opname").append(markup);
      // $("#scrollmodal").modal('toggle');
      list_batch.push(id_p);
    }

    //
    // $("#kode").val(batch);
    // $("#nama").val(nama);
    // $("#stok_komputer").val(stok);
    // $("#harga").val(harga);
    // $("#satuan").val(satuan);
    // $("#scrollmodal").modal("toggle");
    // $("#tabel_obat").modal("toggle");
  }

  function coba() {
    alert("cas");
  }

  function hitung(id) {
    // alert(id);
    var stok_k = $("#jumlah_komp"+id).val();
    var stok_r = $("#jumlah_real"+id).val();
    var sel = parseInt(stok_r) - parseInt(stok_k);
    var tot = sel * $("#harga_beli"+id).val();
    $("#selisih"+id).val(sel);
    $("#selisih_harga"+id).val(tot);
    $("#tx_selisih_harga"+id).html(tot);
  }
  </script>
