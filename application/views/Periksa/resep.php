<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <?php echo form_open_multipart('Periksa/input_resep',array("id"=>"form_resep"));?>
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                  <h4><a href="" class="white-text mx-3">Resep untuk pasien</a></h4>
            </div>
            <div class="card-body card-block">
              <div class="col-md-12">
              <div class="row p-t-20">
                <div class="row col-xl-3 col-md-6 col-sm-6">
                  <div class="form-group animated flipIn">
                    <label for="exampleInputuname">NO PEMERIKSAAN</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span>
                      </div>
                      <input type="text" name="nopem" id="nopem" class="form-control" placeholder="nokun" value="<?php echo $this->uri->segment(3) ?>" required readonly>

                    </div>
                  </div>
                </div>
                <div class="row col-xl-3 col-md-6 col-sm-6">
                  <div class="form-group animated flipIn">
                    <label for="exampleInputuname">TANGGAL</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                      </div>
                      <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo date('Y-m-d'); ?>" required readonly>

                    </div>
                  </div>
                </div>
                <div class="row col-xl-3 col-md-6 col-sm-6">
                  <div class="form-group animated flipIn">
                    <label for="exampleInputuname">NO RM PASIEN</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                      </div>
                      <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$pasien['noRM']; ?>" required readonly>

                    </div>
                  </div>
                </div>
                <div class="row col-xl-3 col-md-6 col-sm-6">
                  <div class="form-group animated flipIn">
                    <label for="exampleInputuname">NAMA PASIEN</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                      </div>
                      <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo @$pasien['namapasien']; ?>" required readonly>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row col-md-12">
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#scrollmodal_alergi" style="margin-top: 30px;margin-bottom:10px;"> <i class="fa fa-plus" ></i>Tambah Alergi</button>
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="list_alergi">
                  <thead>
                    <th>Alergi Reaksi</th>
                    <th>Makanan / Minuman / Obat yang dikonsumsi</th>
                    <th>Jenis Penyakit</th>
                    <th>Tanggal</th>
                    <th width="10%"><i class="fa fa-gear"></i></th>
                  </thead>
                  <tbody id="alergi">
                    <?php if ($this->uri->segment(4)!=''): ?>

                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>

              <div class="row col-md-12">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#scrollmodal" style="margin-top: 30px;margin-bottom:10px;"> <i class="fa fa-search" ></i> Cari Obat </button>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="list_resep">
                    <thead>
                      <th>Kode Obat </th>
                      <th>Nama Obat </th>
                      <th>Stok Tersedia</th>
                      <th>Harga</th>
                      <th>Jumlah</th>
                      <th>Signa</th>
                      <!-- <th>pulves</th> -->
                      <th>Total</th>
                      <th width="10%"><i class="fa fa-gear"></i></th>
                    </thead>
                    <tbody id="resep">
                      <?php if ($this->uri->segment(4)!=''): ?>

                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
            <!-- <div class="card-footer"> -->
            <!-- <?php echo $this->Core->btn_input(); ?> -->
            <div class="card-footer" style='display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;'>
              <div class="col col-sm-12 com-md-12">
                <button type="button" class="btn btn-outline-secondary btn-sm pull-left" onclick="window.history.back()"><i class="fa fa-reply"></i> Kembali</button>
                <button type="button" class="btn btn-primary btn-sm pull-right simpan">SIMPAN</button>
              </div>
            </div>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>

<div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="max-width: fit-content;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scrollmodalLabel">Cari Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-bordered table-hover table-striped ">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th>Kode/No Barcode Obat</th>
                <th>Nama Obat</th>
                <th>Kandungan Obat</th>
                <th>Dosis</th>
                <th width="%5">opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($resep as $data):
                $id = $data->idobat;?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data->idobat; ?></td>
                  <td><?php echo $data->nama_obat; ?></td>
                  <td><?php echo $data->kandungan_obat; ?></td>
                  <td><?php echo $data->dosis; ?></td>

                  <td>
                    <button id="<?php echo $id;?>"  class="btn-floating aqua-gradient add_obat" data-toggle="tooltip" data-placement="top" title="" data-original-title="TambahKan" >
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

  <div class="modal fade" id="scrollmodal_alergi" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scrollmodalLabel">Tambah Alergi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <div class="row form-group">
              <div class="col col-md-3">
                <label for="alergi_reaksi" class=" form-control-label">Alergi Reaksi</label>
              </div>
              <div class="col-12 col-md-9">
                <input type="text" name="alergi_reaksi" id="alergi_reaksi" class="form-control" placeholder="Alergi Reaksi" value="<?php echo @$riwayatalergi['alergi_reaksi']; ?>" required>
              </div>
            </div>

            <div class="row form-group">
              <div class="col col-md-3">
                <label for="konsumsi" class=" form-control-label">Makanan / Minuman / Obat yang dikonsumsi</label>
              </div>
              <div class="col-12 col-md-9">
                <input type="text" name="konsumsi" id="konsumsi" class="form-control" placeholder="Yang Di Konsumsi" value="<?php echo @$riwayatalergi['konsumsi']; ?>" required>
              </div>
            </div>

            <div class="row form-group">
              <div class="col col-md-3">
                <label for="jenis_penyakit" class=" form-control-label">Jenis Penyakit</label>
              </div>
              <div class="col-12 col-md-9">
                <input type="text" name="jenis_penyakit" id="jenis_penyakit" class="form-control" placeholder="Jenis Penyakit" value="<?php echo @$riwayatalergi['jenis_penyakit']; ?>" required>
              </div>
            </div>

            <div class="row form-group">
              <div class="col col-md-3">
                <label for="tgl_alergi" class=" form-control-label">Tanggal</label>
              </div>
              <div class="col-12 col-md-9">
                <input type="date" name="tgl_alergi" id="tgl_alergi" class="form-control" placeholder="Tanggal" value="<?php echo @$riwayatalergi['tgl_alergi']; ?>" required>
              </div>
            </div>
            <button type="button" class="btn btn-primary btn-sm pull-right add_alergi">Tambah</button>
            </div>
          </div>
        </div>
      </div>
    </div>

  <script type="text/javascript">
  $(document).on("click",".add_obat",function(){
    // alert("jdkajd");
    var idobat = $(this).attr('id');
    // alert(idobat);
    select_obat(idobat);
  })
  var list_batch = [];
  function select_obat(kode) {
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>Periksa/cariobat/' + kode,
      data: { idobat: kode },
      dataType:'json',
      async : false,
      success: function(response) {
        console.log(response);
        if(response.status==0){
          alert("Stok Obat Habis");
        }else{
          // alert(response.harga);
          tambahobat(response);
        }

      }
    });
  }
  $(document).on('keyup','.input_jumlah',function(){
    var object = this;
    var kode = $(this).attr("id");
    var hrg = $("#hrg_"+kode).val();
    var stok = parseInt($("#stok_"+kode).val());
    var jml = parseInt($(this).val());
    var total = hrg*jml;
    if(jml>stok){
      alert("Jumlah permintaan melebihi stok tersedia");
      $(object).val('');

      $("#total_"+kode).text('Rp.'+addCommas(0));
    }else{
      $("#ttl_"+kode).val(total);
      $("#total_"+kode).text('Rp.'+addCommas(total));
    }
    // alert(hrg);
  });

  function prefix() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 1; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
  }
  function tambahobat(res) {
    var pr = prefix();
    var kode = res.id_obat;
    var kode_bpjs = res.kdbpjs;
    var nama = res.nama_obat;
    var dosis = res.dosis;
    var harga =res.harga;
    var markup = "<tr>" +
    "<td><input hidden value='"+ kode_bpjs +"' name='kode_bpjs[]'><input hidden value='"+ kode +"' name='kode[]'>"+ kode +"</td>" +
    "<td><input hidden value='"+ nama +"' name='nama[]'>"+ nama +"</td>" +
    "<td><input hidden value='"+ res.stok+"' name='stok_tersedia[]' id='stok_"+pr+kode+"'>"+ res.stok +"</td>" +
    "<td><input hidden value='"+ harga +"' name='harga[]' id='hrg_"+pr+kode+"'>Rp."+addCommas(harga) +"</td>" +
    "<td><input type='number' value='' obat='"+kode+"' name='jumlah[]' id='"+pr+kode+"' class='input_jumlah form-control' required  style='max-width:100px;'></td>" +
    "<td><input type='text' name='signa[]' value='' class='signa form-control' required></td>" +
    "<td><input hidden value='' name='ttl_harga[]' id='ttl_"+pr+kode+"'><p id='total_"+pr+kode+"'></p></td>" +
    "<td><button type=\"button\"' class=\"btn-danger hapus item-table\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Obat\"><i class=\"fa fa-trash\"></i></button></td>" +
    "</tr>";
    if (list_batch.indexOf(kode) > -1) {
      alert("Obat telah ada, silahkan edit jumlah");
    }else{
      $("tbody#resep").append(markup);
      list_batch.push(kode);
      $("#scrollmodal").modal('toggle');
    }
  }

  $(document).on("click",".add_alergi",function(){
    var alergi_reaksi = $("#alergi_reaksi").val();
    var konsumsi = $("#konsumsi").val();
    var jenis_penyakit = $("#jenis_penyakit").val();
    var tgl_alergi = $("#tgl_alergi").val();
    var html ="<tr>" +
      "<td><input hidden value='"+ alergi_reaksi +"' name='alergi_reaksi[]'>"+ alergi_reaksi +"</td>" +
      "<td><input hidden value='"+ konsumsi +"' name='konsumsi[]'>"+ konsumsi +"</td>" +
      "<td><input hidden value='"+ jenis_penyakit +"' name='jenis_penyakit[]'>"+ jenis_penyakit +"</td>" +
      "<td><input hidden value='"+ tgl_alergi +"' name='tgl_alergi[]'>"+ tgl_alergi +"</td>" +
      "<td><button type=\"button\"' class=\"btn-danger hapus_alergi item-table\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Alergi\"><i class=\"fa fa-trash\"></i></button></td>" +
      "</tr>";
      $("#alergi").append(html);
      var alergi_reaksi = $("#alergi_reaksi").val("");
      var konsumsi = $("#konsumsi").val("");
      var jenis_penyakit = $("#jenis_penyakit").val("");
      var tgl_alergi = $("#tgl_alergi").val("");
      $("#scrollmodal_alergi").modal('toggle');

  })

  function deleteRowlab(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("list_resep").deleteRow(i);
  }
  $(document).on("click",".hapus_alergi",function(){
    var row = (this);
    var index = row.parentNode.parentNode.rowIndex;
    $(this).parent().parent().remove();
  })
  $(document).on("click",".hapus",function(){
    var row = (this);
    var index = row.parentNode.parentNode.rowIndex;
    var index_array = index-1;
    list_batch.splice(index_array, 1);
    $(this).parent().parent().remove();
    // document.getElementById("tabel_resep").deleteRow(index);
  })
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

  $(document).on("click",".simpan",function(){
    var status = 0;
    $(".input_jumlah").each(function(){
      var kode = $(this).attr("obat");
      var jumlah = $(this).val();
      var th = $(this);
      if (jumlah=='' || jumlah<=0) {
        alert("harap isi jumlah obat")
        th.focus();
        status=1;
        return false;
      }
      // alert(kode);
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>Obat/cek_stok/' + kode,
        data: { idobat: kode,jumlah:jumlah},
        dataType:'json',
        async : false,
        success: function(response) {
          // alert(response.kode);
          console.log(response);
          if(response.status==0){
            alert("Stok Obat "+response.nama_obat+" telah sisa "+response.sisa+" , silahkan edit jumlah atau ganti dengan obat lain");
            status = 1;
            th.focus();
          }

        }
      });
      if (status==1) {
        return false;
      }
    })
    if (status==0) {
      $("#form_resep").submit();
      $(".simpan").attr("disabled","disabled")
    }
  })
</script>
