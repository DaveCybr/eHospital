<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
              <a href="" class="white-text mx-3"><h3>Input Jurnal</h3></a>

            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('Jurnal/input',array("id"=>"form_jurnal"));?>
              <?php echo @$error;?>
              <div class="row p-t-20">
                <div class="col-md-12 col-xl-6">
                  <div class="form-group animated flipIn">
                    <label for="exampleInputuname">Tanggal</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                      </div>
                      <input type="date" name="tanggal" class="form-control" value="<?php echo date("Y-m-d")?>">
                    </div>
                  </div>
                </div>

                <div class="col-md-12 col-xl-12">
                  <div class="form-group animated flipIn">
                    <label for="exampleInputuname">Keterangan</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
                      </div>
                      <textarea class="form-control" rows="3" name="keterangan"></textarea>

                    </div>
                  </div>
                </div>
              </div>
              <div class="row col-md-12">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_mbesar" style="margin-top: 30px;margin-bottom:10px;"> <i class="fa fa-search" ></i> Cari Buku </button>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="tabel_detail">
                    <thead>
                      <tr>
                        <th>No Rek</th>
                        <th>Jenis</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                        <th width="10%">Opsi</th></tr>
                      </thead>
                      <tbody id="detail">

                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="2">Balance</th>
                          <th class="balance_debet">Rp.0</th>
                          <th class="balance_kredit">Rp.0</th>
                          <th width="10%"></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
                <div class="card-footer" style='    display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;
                /* flex-wrap: wrap; */'>
                <div class="col col-sm-12 com-md-12">
                <button type="button" class="btn btn-outline-secondary btn-sm pull-left" onclick="window.history.back()"><i class="fa fa-reply"></i> Kembali</button>
                    <button type="button" id="simpan" class="btn btn-primary btn-sm pull-right">SIMPAN</button>
                </div>
                </div>
                <?php echo form_close(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal_mbesar" tabindex="-1" role="dialog" aria-labelledby="modaljapelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scrollmodalLabel">Buku Besar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table id="example" class="table table-hover table-borderless table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>No Akun</th>
                  <th>Nama</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($mbesar as $data) {?>
                  <?php $id_check = $data->norek_mbesar;
                  ?>

                  <?php if (strlen($data->norek_mbesar) >= 5): ?>
                    <tr>
                      <td><?php echo $no;?></td>
                      <td><?php echo $data->norek_mbesar?></td>
                      <td><?php echo $data->namarek?></td>
                      <td>
                        <button norek="<?php echo $data->norek_mbesar?>" namarek="<?php echo $data->namarek?>" type="button" class="btn-floating purple-gradient pilih_buku" data-toggle="tooltip" data-placement="right" data-original-title="pilih" data-dismiss="modal">
                          <i class="fas fa-edit"></i>
                        </button>
                      </td>
                    </tr>
                    <?php
                    $no++;?>
                  <?php endif; ?>
                  <?php
                }?>
              </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
  var debet = 0;
  var kredit = 0;

  function hitung_debet(){
    debet = 0;
    $(".debet").each(function(){
      var nilai = $(this).val();
      if (nilai=='') {
        nilai = 0;
      }
      debet += parseInt(nilai);
    });
    $(".balance_debet").text("Rp."+addCommas(debet));
  }
  function hitung_kredit(){
    kredit = 0;
    $(".kredit").each(function(){
      var nilai = $(this).val();
      if (nilai=='') {
        nilai = 0;
      }
      kredit += parseInt(nilai);
    });
    $(".balance_kredit").text("Rp."+addCommas(kredit));
  }
  function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("tabel_detail").deleteRow(i);
    hitung_kredit();
    hitung_debet();

  }
  function addCommas(nStr){
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
  $(document).ready(function(){
    $(document).on("keyup",".debet",function(){
      hitung_debet();
    })
    $(document).on("keyup",".kredit",function(){
      hitung_kredit();
    })
    $(document).on("blur",".debet",function(){
      hitung_debet();
    })
    $(document).on("blur",".kredit",function(){
      hitung_kredit();
    })
    $(document).on("click","#simpan",function(){
      if (debet!=kredit || debet==0 || kredit==0) {
        alert("Data tidak balance");
      }else{
        $("#form_jurnal").submit();
      }
    })
    $(document).on("click",".pilih_buku",function(){
      var norek = $(this).attr("norek");
      var nama = $(this).attr("namarek");
      html='';
      html += '<tr>'+
      '<td><input type="hidden" name="norek_detail[]" value="'+norek+'">'+norek+'</td>'+
      '<td><input type="hidden" name="namarek_detail[]" value="'+nama+'">'+nama+'</td>'+
      '<td><input type="number" min="0" width="100%" class="form-control debet" name="debet[]" value="0" required></td>'+
      '<td><input type="number" min="0" width="100%" class="form-control kredit" name="kredit[]" value="0" required></td>'+
      '<td><button type="button" onclick="deleteRow(this)" class="btn-danger btn btn-circle" data-toggle="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-trash"></i></button></td>'+
      '</tr>';
      $("#detail").append(html);
    })
  })
</script>
