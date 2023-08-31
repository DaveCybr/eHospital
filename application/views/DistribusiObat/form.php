<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
      <div class="row col-md-9">
        <a href="#" data-toggle="modal" data-target="#scrollmodal"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="Tambahkan list obat yang ada di stok gudang" id="tambahkan"><i class="fa fa-plus"></i> Input Obat</button></a>
        <div class="col-xl-2 col-md-6 col-sm-6">
          <select class="mdb-select colorful-select dropdown-info sm-form" name="penerima">
            <option value="" selected>Penerima</option>
            <option value="Apotek">Apotek</option>
            <option value="UGD">UGD</option>
          </select>
        </div>
      </div>
      <div class="col-md-12" style="margin-top:20px;">

          <div class="table-responsive">
              <table id="list_pembelian_obat" class="table editable-table table-bordered table-striped m-b-0">
                <thead>
                  <tr>
                    <th>Kode Obat / Nama Obat</th>
                    <th>Stok Tersedia</th>
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
	<script type="text/javascript" src="<?php echo base_url();?>desain/dist/simple.money.format.js"></script>
	<script type="text/javascript">
		$('.money').simpleMoneyFormat();
	</script>

<script>
$(document).ready(function(){

    var list_obat = [];
    $(document).on("click",".add_obat",function(){
      
        var kode = $(this).attr("id");
        var nama = $(this).attr("nm");
        <?php
          $gudang = $this->db->select("sum(stok_akhir) as stok")->get_where("list_batch_gudang",array("obat_idobat"=>$value->obat_idobat))->row();
          $stok_gudang = !empty($gudang)?$gudang->stok:0;
        ?>
        var markup = "<tr>" +
        "<td><input hidden value='"+ kode +"' name='id_obat[]'><input hidden value='' name='satuan[]' id='satuan"+kode+"'>"+ nama +"</td>" +
        "<td>"+ nama +"</td>"+
        "<td><input class='form-control' value='' name='jumlah[]'></td>" +
        "<td><button type=\"button\"  class=\"hapus btn btn-danger btn-sm btn-circle\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Data\"><i class=\"fa fa-trash\"></i></button></td>"+
        "</tr>";

        if (list_obat.indexOf(kode) > -1) {
          alert("Obat ini telah ditambahkan sebelumnya");
        }else{
          $("tbody#obat").append(markup);
          $("#scrollmodal").modal('toggle');

          list_obat.push(kode);
        }
    })

    $(document).on('click','.hapus',function(){
      // deleteRow(this);
      var row = (this);
      var index = row.parentNode.parentNode.rowIndex;
      var index_array = index-1;
      list_obat.splice(index_array, 1);
      $(this).parent().parent().remove();

    });
})

</script>
