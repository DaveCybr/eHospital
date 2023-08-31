<?php echo form_open(base_url()."Resep/insert_tebusan")?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header text-center">
        <h4>Permintaan Resep</h4>
      </div><br><br>
      <div class="col col-md-12" style="margin-left:20px;">
        <table>
        <tr><td><h5>Nama pasien</h5></td><td><h5>:</h5></td><td><h5><b> <?php echo $pasien['namapasien']?></b></h5></td>
        </tr>
        <tr><td><h5>Asal Poli</h5></td><td><h5>:</h5></td><td><h5><b><?php echo $pasien['tujuan_pelayanan']?></b></h5></td>
      </tr>
      </table>
    </div>
      <div class="card-body">
        <div class="table-responsive">
          <table  class="table color-table info-table tab ">
              <thead>
                  <tr><th>#</th>
                      <th>Kode Obat</th>
                      <th>Nama Obat</th>
                      <th>Jumlah</th>
                      <th>Signa</th>
                      <th width="%5">opsi</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($detail as $value):
                  ?>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $value->obat_idobat; ?></td>
                      <td><?php echo $value->nama_obat; ?></td>
                      <td><?php echo $value->jumlah; ?></td>
                      <td><?php echo $value->signa?></td>
                      <td>
                        <a a href="#" data-toggle="modal" data-target="#smallmodal">
                        <button no="<?php echo $no;?>" nama="<?php echo $value->nama_obat;?>" detil="<?php echo $value->iddetail_resep?>" signa="<?php echo $value->signa?>" jumlah="<?php echo $value->jumlah?>" id="<?php echo $value->obat_idobat?>" type="button" class="list_batch btn btn-success btn-sm open_dialog" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambahkan Obat">
                          <i class="fa fa-plus"></i>
                        </button>
                        </a>
                      </td>
                  </tr>
                <?php $no++;  endforeach; ?>
              </tbody>
            </table>
            <br><br>
            <h4>Obat Diberikan</h4>
            <table  class="table color-table danger-table tab ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>no</th>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Jumlah Resep</th>
                        <th>Jumlah Diberikan</th>
                        <th>Signa</th>
                        <th>No Batch</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody id="pemberian_resep">

                </tbody>
              </table>
              <input type="hidden" name="kode_resep" value="<?php echo $this->uri->segment(3)?>"><br><br>
        </div>
      </div>

            <?php echo $this->Core->btn_input()?>
    </div>

  </div>

</div>
<?php echo form_close();?>
<?php $this->load->view("Resep/form_dialog")?>
<script>
$(function(){
  $(document).on("click",".open_dialog",function(){
    var nama = $(this).attr("nama");
    $("#nama_obat").html(nama);
  })
  var no_batch = [];
  var ed = [];
  var signa = '';
  var stok = [];
  var id_pengadaan = [];
  var jml_resep=0;
  var nama_obat = '';
  var kode_obat='';
  var detail =0 ;
  var no =0;
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
    signa = $(this).attr('signa');
    detail = $(this).attr('detil');
    no = $(this).attr("no");
    var data_detail = {
      'kode_obat' : $(this).attr('id'),
    };
    var jml = $(this).attr("jumlah");
    myajax_request(base_url+"Resep/get_batch2",data_detail,function(res){
      kosongkan_array();
      var html = "";
      for (var i = 0; i < res.length; i++) {
        html += "<tr>"+
        "<td>"+res[i].no_batch+"</td>"+
        "<td>"+res[i].ed+"</td>"+
        "<td><input type='hidden' id='resep_"+res[i].id_pengadaan+"' value='"+jml+"'>"+jml+"</td>"+
        "<td><input type='hidden' id='stok_"+res[i].id_pengadaan+"' value='"+res[i].stok+"'>"+res[i].stok+"</td>"+
        "<td><input type='number' id='batch"+i+"' name='jumlah_beri' placholder='0' class='form-control'></td>"+
        "<td><button type='button' id='"+i+"' id_pengadaan='"+res[i].id_pengadaan+"' class='tambah_batch btn btn-sm btn-success'><i class='fa fa-plus'></i></button></td>"+
        "</tr>";
        no_batch.push(res[i].no_batch);
        ed.push(res[i].ed);
        stok.push(res[i].stok);
        id_pengadaan.push(res[i].id_pengadaan);
        nama_obat = res[i].nama_obat;
      }
      jml_resep = jml;
      $("#tabel_batch").html(html);
      $("#tBatch").dataTable();
    });
  });
  $(document).on("click",".tambah_batch",function(){
    // alert($(this).attr("id"));
    var id= $(this).attr("id");

    var jml_beri = parseInt($("#batch"+id).val());
    var id_pengadaan_baru = $(this).attr("id_pengadaan");
    var stok = parseInt($("#stok_"+id_pengadaan_baru).val());
    var resep_jml = parseInt($("#resep_"+id_pengadaan_baru).val());
    var beri = 0;
    $(".beri_"+kode_obat).each(function(){
      beri += parseInt($(this).val());
    })
    // alert(beri);
    beri += jml_beri;
    if (jml_beri==0) {
      alert("Masukkan jumlah diberikan");
    }
    else if(jml_beri > resep_jml){
      alert("Jumlah beri melebihi resep");
    }
    else if(beri > resep_jml){
      alert("Sebelumnya telah ditambah obat yang sama dan jumlah beri melebihi resep yang diminta");
    }
    else if (list_batch.indexOf(id_pengadaan[id]) > -1) {
      alert("Obat dengan no batch ini telah ditambahkan sebelumnya");
    }else if(jml_beri > stok){
      alert("Stok tidak mencukupi");
    }else{
      var no_beri =1;
      $(".no_beri").each(function(){
        no_beri+=1;
      });
      var html = "<tr>"+
      "<td  class='no_beri'>"+no_beri+"</td>"+
      "<td>"+no+"</td>"+
      "<td><input type='hidden' name='id_detail_resep[]' value='"+detail+"'><input type='hidden' name='id_pengadaan[]' value='"+id_pengadaan[id]+"'><input type='hidden' name='kode_obat[]' value='"+kode_obat+"'>"+kode_obat+"</td>"+
      "<td>"+nama_obat+"</td>"+
      "<td><input type='hidden' name='jumlah_resep[]' value='"+jml_resep+"'>"+jml_resep+"</td>"+
      "<td><input type='hidden' class='beri_"+kode_obat+"' name='jumlah_beri[]' value='"+jml_beri+"'>"+jml_beri+"</td>"+
      "<td><input type='hidden' name='signa[]' value='"+signa+"'>"+signa+"</td>"+
      "<td><input type='hidden' name='list_batch[]' value='"+no_batch[id]+"'>"+no_batch[id]+"</td>"+
      "<td><button type='button' class='btn btn-sm btn-danger hapus'><i class='fa fa-cut'></i></button></td>"+
      "</tr>";
      $("#pemberian_resep").append(html);
      list_batch.push(id_pengadaan[id]);
      $("#smallmodal").modal("toggle");
    }

  })

  $(document).on("click",".hapus",function(){
    var row = (this);
    var index = row.parentNode.parentNode.rowIndex;
    var index_array = index-1;
    list_batch.splice(index_array, 1);
    $(this).parent().parent().remove();
    // document.getElementById("tabel_resep").deleteRow(index);
  })
});

</script>
