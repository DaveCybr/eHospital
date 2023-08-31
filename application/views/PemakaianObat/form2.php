
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
      <div class="col-md-9">
      </div>
      <div class="col-md-12" style="margin-top:20px;">
        <a href="#" ><button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="Tampilkan obat" id="tampil"><i class="fa fa-eye"></i> Tampilkan Obat</button></a>
        <div class="col-md-4">

          <select class="mdb-select colorful-select dropdown-info md-form" id="filter" name="tupel" required>
            <option value="" disabled selected>Dipakai Oleh</option>
            <option value="UMU" >PETUGAS POLI UMUM</option>
            <option value="GIG" >PETUGAS POLI GIGI</option>
            <!-- <option value="OBG" >KE OBSGYN</option>
            <option value="INT" >KE INTERNIS</option>
            <option value="IGD" >KE IGD</option>
            <option value="OZON" >KE OZON</option> -->
            <option value="RANAP" >PETUGAS RANAP</option>
            <option value="LAB" >PETUGAS LABORAT</option>
          </select>

        </div>
        <br><br><br>
        <h3>Obat Terpilih</h3>
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
  $(document).on("click","#tampil",function(){
    $("#scrollmodal").modal("toggle");
  })
  var list_obat = [];
  $(document).on('click','.hapus',function(){
    // alert("dhakd");
    // deleteRow(this);
    var row = (this);
    var index = row.parentNode.parentNode.rowIndex;
    var index_array = index-1;
    list_obat.splice(index_array, 1);
    $(this).parent().parent().remove();
  });
  $(document).on("click",".tambah_obat",function(){
    // alert($(this).attr("id"));
    var kode_obat= $(this).attr("id");
    var nama_obat= $(this).attr("nama_obat");
    if (list_obat.indexOf(kode_obat) > -1) {
      alert("Obat ini telah ditambahkan sebelumnya");
    }else{
      var markup = "<tr>" +
      "<td><input hidden value='"+ kode_obat +"' name='id_obat[]'>"+kode_obat+"/"+ nama_obat +"</td>" +
      "<td><input type='number' id='jml"+kode_obat+"' kode='"+kode_obat+"' class='form-control jml_beli' name='jumlah[]' value='1'></td>" +
      "<td><button type=\"button\"  class=\"hapus btn btn-danger btn-sm btn-circle\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Data\"><i class=\"fa fa-trash\"></i></button></td>"+
      "</tr>";
      $("tbody#obat").append(markup);
      list_obat.push(kode_obat);
    }

  })
});
</script>
