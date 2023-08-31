<div class="row p-t-20">
  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">No Inventaris</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="ti-target"></i></span>
        </div>
        <input type="text" name="noinventaris" class="form-control" placeholder="no inventaris" value="<?php echo $inventaris['noinven']?>" readonly required>
        </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Nama Inventaris</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
        </div>
        <input type="text" name="nama_inventaris" id="kategori_obat" class="form-control" placeholder="nama inventaris" value="<?php echo $inventaris['nama'] ?>" required>
        </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Ruangan Inventaris</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
        </div>
        <input type="text" name="ruangan" id="ruangan" class="form-control" placeholder="nama ruangan" value="<?php echo @$inventaris['namaruangan']; ?>" required>
        <input type="hidden" name="idruangan" id="idruangan" value="<?php echo @$inventaris['ruangan_idruangan']?>">
        </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Tanggal Beli/Catat</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
        </div>
        <input type="date" name="tgl_catat" id="kategori_obat" class="form-control"  value="<?php echo @$inventaris['tglbeli']; ?>" required>

        </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Harga</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Rp</span>
        </div>
        <input type="number" name="harga" id="harga" class="form-control" placeholder="0" value="<?php echo @$inventaris['harga']; ?>" required>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Jumlah</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
        </div>
        <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="0" value="<?php echo @$inventaris['jumlah']; ?>" required>
    </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Nilai Inventaris</label>
      <div class="input-group mb-3">
        <div class="input-group-append">
          <span class="input-group-text" id="basic-addon1">Rp</span>
        </div>
        <input type="text" readonly name="nilinven" id="niven" class="form-control" placeholder="0" value="<?php echo number_format(@$inventaris['nilinven']); ?>" required>
        <input type="hidden" readonly name="nilai_inventaris" id="niven1" class="form-control" placeholder="0" value="<?php echo @$inventaris['nilinven']; ?>" required>

      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Waktu Penyusutan</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="ti-timer"></i></span>
        </div>
        <input type="number" name="waktu" id="waktu" class="form-control" placeholder="0" value="<?php echo @$inventaris['lamasusut']; ?>" required>
          <div class="input-group-append">
            <span class="input-group-text" id="basic-addon1">Bulan</span>
          </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Jumlah Nilai Susut</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Rp</span>
        </div>
        <input type="number" name="jumlah_susut" readonly id="jumlah_susut" class="form-control" placeholder="0" value="<?php echo $inventaris['nilsusut']?>" required>
    </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Cara pembayaran</label>
      <div class="input-group mb-3 p-t-10">
        <div class="input-group-prepend">
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" id="pn1" name="cara_bayar" value="KAS" class="custom-control-input" required <?php echo $inventaris['transaksi']=="KAS"?"checked":''; ?>>

          <label class="custom-control-label" for="pn1">KAS</label>
        </div>
        <div class="custom-control custom-radio ml-3">
          <input type="radio" id="pn2" name="cara_bayar" value="HUTANG" class="custom-control-input" required <?php echo $inventaris['transaksi']=="HUTANG"?"checked":''; ?>>

          <label class="custom-control-label" for="pn2">HUTANG</label>
        </div>
        <!-- <input type="radio" name="cara_bayar" value="KAS" checked><span class="m-l-10">KAS</span> -->
        <!-- <input type="radio" class="m-l-30" name="cara_bayar" value="HUTANG" ><span class="m-l-10">HUTANG</span> -->
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Nilai Residu</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Rp</span>
        </div>
        <input type="number" name="nilai_residu" id="nilai_residu" class="form-control" placeholder="0" value="<?php echo @$inventaris['residu']; ?>" required>

        </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Penyusutan</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Rp</span>
        </div>
        <input type="text" name="p" id="penyusutan" readonly class="form-control" placeholder="0" value="<?php echo @$inventaris['susut']; ?>" required>
        <input type="hidden" name="penyusutan" id="penyusutan1" readonly class="form-control" placeholder="0" value="<?php echo @$inventaris['susut']; ?>" required>

      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Nilai Buku</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Rp</span>
        </div>
        <input type="text" name="nilbuk" id="nilai_buku" readonly class="form-control" placeholder="0" value="<?php echo @$inventaris['nibuku']; ?>" required>
        <input type="hidden" name="nilai_buku" id="nilai_buku1" readonly class="form-control" placeholder="0" value="<?php echo @$inventaris['nibuku']; ?>" required>

        </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">No Rek Akuntansi</label>
      <div class="input-group mb-3">
        <input type="text" name="rek_akuntansi" id="rek_akuntansi" class="form-control" placeholder="no rek akuntansi" value="<?php echo $inventaris['rekakun']?>" required>
        <div class="input-group-append">
            <span class="input-group-text" id="basic-addon1" ><i class="ti-search"></i></span>
        </div>
    </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Nama Rek Akuntansi</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
        </div>
        <input type="text" readonly name="nama_akuntansi" id="nama_akuntansi" class="form-control" placeholder="nama rekening akuntasi" value="<?php echo @$rekakun['namarek']; ?>" required>
    </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">No Rek By Susut</label>
      <div class="input-group mb-3">
        <input type="text" name="rek_susut" id="rek_susut" class="form-control" placeholder="no rek susut" value="<?php echo @$inventaris['rekbiaya']; ?>" required>
        <div class="input-group-append">

            <span class="input-group-text" id="basic-addon1" ><i class="ti-search"></i></span>
        </div>
      </div>
    </div>
  </div>

    <div class="col-md-3">
      <div class="form-group animated flipIn">
        <label for="exampleInputuname">Nama By Susut</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="ti-slice"></i></span>
          </div>
          <input type="text" readonly name="nama_rek_susut" id="nama_rek_susut" class="form-control" placeholder="nama rekening susut" value="<?php echo @$rekbiaya['namarek']; ?>" required>

          </div>
      </div>
    </div>
</div>
<?php $this->load->view('Inventaris/form_dialog',$no_rek)?>

<?php $this->load->view('Inventaris/form_dialog2',$ruangan)?>
<script>
$(document).ready(function(){
    $("#list_ruangan").dataTable();
  $(document).on('focus','#ruangan',function(){
    $("#modalruangan").modal('toggle');
  })
  $(document).on('click','.ruangan',function(){
    var id = $(this).attr('norek');
    var nama= $(this).attr('namarek');
    $("#idruangan").val(id);
    $("#ruangan").val(nama);
    $("#modalruangan").modal('toggle');
  })
  $(document).on('click','.rek_akun',function(){
    var no_rek = $(this).attr('norek');
    var nama_akun = $(this).attr('namarek');
    $("#rek_akuntansi").val(no_rek);
    $("#nama_akuntansi").val(nama_akun);
    $("#smallmodal").modal('toggle');
  })
  $(document).on('click','.rek_susut',function(){
    var no_rek = $(this).attr('norek');
    var nama_akun = $(this).attr('namarek');
    $("#rek_susut").val(no_rek);
    $("#nama_rek_susut").val(nama_akun);
    $("#smallmodal").modal('toggle');
  })
  $(document).on('focus','#rek_akuntansi',function(){
    $('#list_rekening').dataTable();
    $("#list_rekening").find(".rek").addClass('rek_akun');
    $("#list_rekening").find(".rek").removeClass('rek_susut');
    $("#smallmodal").modal('toggle');
  })
  $(document).on('focus','#rek_susut',function(){
    $('#list_rekening').dataTable();
    $("#list_rekening").find(".rek").addClass('rek_susut');
    $("#list_rekening").find(".rek").removeClass('rek_akun');
    $("#smallmodal").modal('toggle');
  })
  $(document).on('blur','#harga',function(){
    var harga = $(this).val();
    var jumlah = $("#jumlah").val();
    if (jumlah=='') {
      jumlah =0;
    }
    var nilinven = harga*jumlah;
    $("#niven").val(addCommas(nilinven));
    $("#niven1").val(nilinven);
  })
  $(document).on('blur','#jumlah',function(){
    var harga = $("#harga").val();
    var jumlah = $(this).val();
    if (harga=='') {
      jumlah =0;
    }
    var nilinven = harga*jumlah;
    $("#niven").val(addCommas(nilinven));
    $("#niven1").val(nilinven);
  })
  $(document).on("blur","#waktu",function(){
    var nilai = $("#niven1").val();
    // alert(nilai);
    var waktu = $(this).val();
    var susutan = parseInt(nilai/waktu);
    if(isNaN(susutan)){
      susutan = 0;
    }
    $("#penyusutan").val(addCommas(susutan));
    $("#penyusutan1").val(susutan);
  });
  $(document).on("blur","#nilai_residu",function(){
    var residu = $(this).val();
    var penyusutan = $("#penyusutan1").val();
    var nilinven = $("#niven1").val();
    var tot = parseInt(residu)+parseInt(penyusutan);
    // alert(tot);
    var nilbuk = parseInt(nilinven-tot);
    if (!isNaN(nilbuk)) {
      $("#nilai_buku").val(addCommas(nilbuk));
      $("#nilai_buku1").val(nilbuk);
    }
  })
  // $(document).bind("keyup change",'#nilai_residu',function(){
  //   alert("hdjahd");
  // });
  // $(document).on('blur','#nilai_residu',function(){
  //   var penyusutan = $("#penyusutan1").val();
  //   var residu = $(this).val();
  //   var nilbuk = parseInt(residu-penyusutan);
  //   $("#nilai_buku").val(addCommas(nilbuk));
  //   $("#nilai_buku1").val(nilbuk);
  // })
  function addCommas(nStr)
{
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

})

</script>
