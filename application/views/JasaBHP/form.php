
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">

      <div class="col-md-12">
        <div class="row form-group">
          <div class="col col-md-3">
            <label for="nama_obat" class=" form-control-label">Jasa Pelayanan / Tindakan</label>
          </div>
          <div class="col-12 col-md-9">
            <input type="text" name="japel" id="japel" class="form-control" placeholder="Pilih Jasa Pelayanan" required>
            <input type="hidden" name="id_japel" id="id_japel">
          </div>
        </div>
        <br>
        <a href="#" ><button data-toggle="modal" data-target="#scrollmodal" type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="Cari obat"><i class="fa fa-eye"></i>Cari Obat</button></a>
      </div>
      <div class="col-md-12" style="margin-top:20px;">
        <h3>Bahan Bahan Yang Digunakan</h3>
        <div class="table-responsive">
          <table id="list_pembelian_obat" class="table editable-table table-bordered table-striped m-b-0">
            <thead>
              <tr>
                <th>Kode Obat / Nama Obat</th>
                <th>Jumlah</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="obat">
            </tbody>
          </table>
        </div>
        <!-- END DATA TABLE-->
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#table_jasa").dataTable();
  $("#japel").focus(function(){
    $("#modal_jasa").modal("toggle");

  });
  $(document).on("click",".jasa",function(){
    var nama = $(this).attr("nama");
    var id = $(this).attr("id");
    $("#id_japel").val(id);
    $("#japel").val(nama);
    $("#modal_jasa").modal("toggle");
  });
  var kode_obat = [];

  $(document).on('click','.hapus',function(){
    // alert("dhakd");
    // deleteRow(this);
    var row = (this);
    var index = row.parentNode.parentNode.rowIndex;
    var index_array = index-1;
    kode_obat.splice(index_array, 1);
    $(this).parent().parent().remove();
  });
  $(document).on("click",".obat",function(){
    // alert($(this).attr("id"));
    var id= $(this).attr("id");
    var nama= $(this).attr("nama");
    if (kode_obat.indexOf(id) > -1) {
      alert("Obat ini telah ditambahkan sebelumnya");
    }else{
      var markup = "<tr>" +
      "<td><input type='hidden' name='kode_obat[]' value='"+id+"'>"+id+"/"+nama+"</td>"+
      "<td><input type='number' name='jumlah[]' class='form-control' value=''></td>"+
      "<td><button type=\"button\"  class=\"hapus btn btn-danger btn-sm btn-circle\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Data\"><i class=\"fa fa-trash\"></i></button></td>"+
      "</tr>";
      $("tbody#obat").append(markup);
      $("#scrollmodal").modal('toggle');
      kode_obat.push(id);
    }

  })
});
</script>
