<div class="row p-t-20">
  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">No Rekam Medis</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
        </div>
        <input type="hidden" name="noRM" id="noRM" class="form-control" placeholder="" value="<?php if ($this->uri->segment(2)=="input") {
          echo @$noRM;
        }else{echo @$pasien['noRM'];} ?>">
          <input type="text" name="noRMshow" id="noRM" class="form-control" placeholder="" value="<?php if ($this->uri->segment(2)=="input") {
            echo @$noRM;
          }else{echo @$pasien['noRM'];} ?>" readonly>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Foto Pasien (jika ada)</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-instagram"></i></span>
        </div>
        <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
        <input type="file" name="filefoto" id="foto" class="form-control dropify" accept="image/x-png,image/gif,image/jpeg">
      </div>
    </div>
  </div>
  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Jenis Pasien</label>
      <div class="input-group mb-3">
        <select name="jenis_pasien" id="pilih_jenis_pasien" class="mdb-select colorful-select dropdown-info sm-form">
          <!-- <option value="" readonly selected>Pilih</option> -->
            <?php foreach ($jenis_pasien as $value): ?>
              <option id="<?php echo $value->jenis_pasien;?>" value="<?php echo $value->kode_jenis;?>" <?php if (@$pasien['jenis_pasien_kode_jenis']==$value->kode_jenis) {
                echo "selected";
              }?>><?php echo $value->jenis_pasien;?></option>
            <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>

  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">No BPJS</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
        </div>
        <input type="text" name="noBPJS" <?php if (@$pasien['jenis_pasien_kode_jenis']!=7 || @$pasien['jenis_pasien_kode_jenis']!=9): ?>
          readonly
        <?php endif; ?> id="noBPJS" class="form-control" placeholder="isikan nomor BPJS" value="<?php echo @$pasien['noBPJS']; ?>" required>
        <div class="input-group-append">
          <span class="input-group-text cek_nobpjs" id="basic-addon1"><i class="ti-reload" id="icon-cek"></i></span>
        </div>
      </div>
    </div>
  </div>

    <div class="col-md-12 col-xl-6">
      <div class="form-group animated flipIn">
        <label for="exampleInputuname">Nama Pasien</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
          </div>
          <input type="text" style="text-transform: uppercase;" name="namapasien" id="namapasien" class="form-control" placeholder="Nama Pasien" value="<?php echo @$pasien['namapasien']; ?>" required onkeydown="return alphaOnly(event);" >
        </div>
      </div>
    </div>
    <!-- <div class="col-md-12 col-xl-6">
      <div class="form-group animated flipIn">
        <label for="exampleInputuname">Tanggal Lahir</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="ti-timer"></i></span>
          </div>
          <input type="date" data-date="" data-date-format="DD-MMMM-YYYY" max="<?php echo date("Y-m-d");?>" required name="tgl_lahir" id="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" value="<?php echo @$pasien['tgl_lahir']; ?>" required>

        </div>
      </div>
    </div> -->
   <div class="col-md-12 col-xl-6">
      <div class="form-group animated flipIn">
        <label for="exampleInputuname">Tanggal Lahir</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="ti-timer"></i></span>
          </div>
          <input type="date" max="<?php echo date("Y-m-d");?>" required name="tgl_lahir" id="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" value="<?php echo @$pasien['tgl_lahir']; ?>" required>

        </div>
      </div>
    </div>



  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">No Asuransi Lain</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
        </div>
        <input type="text" name="noAsuransiLain" readonly id="noAsuransiLain" class="form-control" placeholder="isikan nomor Asuransi (jika ada)" value="<?php echo @$pasien['noAsuransiLain']; ?>">
      </div>
    </div>
  </div>
  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Status Perkawinan</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-reddit"></i></span> -->
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" id="belum" name="perkawinan" value="Belum Kawin" class="custom-control-input kawin"  required checked>

          <label class="custom-control-label" for="belum">Belum Kawin</label>
        </div>
        <div class="custom-control custom-radio m-l-10">

              <input type="radio" id="kawin" name="perkawinan" value="Kawin" class="custom-control-input kawin"  required>

          <label class="custom-control-label" for="kawin">Kawin</label>
        </div>
        <div class="custom-control custom-radio m-l-10">

              <input type="radio" id="janda" name="perkawinan" value="Janda/Duda" class="custom-control-input kawin"  required>

          <label class="custom-control-label" for="janda">Janda/Duda</label>
        </div>

      </div>
    </div>
  </div>
  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Nama Suami/Istri</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
        </div>
        <input type="text" name="suami_istri" style="text-transform: uppercase" id="suami_istri" readonly class="form-control" placeholder="Nama Suami/Istri" value="<?php echo @$pasien['suami_istri']; ?>" onkeydown="return alphaOnly(event);">
      </div>
    </div>
  </div>
  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Nama Orangtua</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
        </div>
        <input type="text" name="orangtua" style="text-transform: uppercase" id="orangtua" class="form-control" placeholder="Nama Orangtua" value="<?php echo @$pasien['orangtua']; ?>" onkeydown="return alphaOnly(event);">
      </div>
    </div>
  </div>


  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Suku</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-dribbble"></i></span>
        </div>
        <input type="text" class="form-control" placeholder="xxxxxx" aria-label="" name="suku" aria-describedby="basic-addon1" value="Jawa">
      </div>
    </div>
  </div>
  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Jenis Kelamin</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-reddit"></i></span> -->
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" id="l" name="jenis_kelamin" value="L" class="custom-control-input" <?php if (@$pasien['jenis_kelamin']=='L') {
            echo "checked";
    }?> required>

          <label class="custom-control-label" for="l">Laki - Laki</label>
        </div>
        <div class="custom-control custom-radio m-l-10">

              <input type="radio" id="p" name="jenis_kelamin" value="P" class="custom-control-input" <?php if (@$pasien['jenis_kelamin']=='P') {
                echo "checked";
              }?> required>

          <label class="custom-control-label" for="p">Perempuan</label>
        </div>

      </div>
    </div>
  </div>
  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Tinggal Dengan</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-reddit"></i></span> -->
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" id="tinggal_dengan1" checked name="tinggal_dengan" value="Orang Tua" <?php if (@$demografi['tinggal_dengan']=='Orang Tua') {echo "checked";} ?> class="custom-control-input tinggal">
          <label class="custom-control-label" for="tinggal_dengan1">Orang Tua</label>
        </div>
        <div class="custom-control custom-radio m-l-10">
          <input type="radio" id="tinggal_dengan2" name="tinggal_dengan" value="Suami/Istri" <?php if (@$demografi['tinggal_dengan']=='Suami') {echo "checked";} ?> class="custom-control-input tinggal">
          <label class="custom-control-label" for="tinggal_dengan2">Suami/Istri</label>
        </div>
        <div class="custom-control custom-radio m-l-10">
          <input type="radio" id="tinggal_dengan3" name="tinggal_dengan" value="Anak" <?php if (@$demografi['tinggal_dengan']=='Anak') {echo "checked";} ?> class="custom-control-input tinggal">
          <label class="custom-control-label" for="tinggal_dengan3">Anak</label>
        </div>
        <div class="custom-control custom-radio m-l-10">
          <input type="radio" id="tinggal_dengan4" name="tinggal_dengan" value="Sendiri" <?php if (@$demografi['tinggal_dengan']=='Sendiri') {echo "checked";} ?> class="custom-control-input tinggal">
          <label class="custom-control-label" for="tinggal_dengan4">Sendiri</label>
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" id="tinggal_dengan5" name="tinggal_dengan" class="custom-control-input tinggal" value="lain">
          <label class="custom-control-label" for="tinggal_dengan5"><input type="text" required name="tinggal_dengan_lain" class="form-control tinggal_lain" placeholder="Lain - Lain" readonly> </label>
      </div>
      </div>
    </div>
  </div>


  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Agama</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-dribbble"></i></span> -->
        </div>
        <select name="agama" id="select" class="mdb-select colorful-select dropdown-info sm-form">
            <option value="islam" <?php if (@$pasien['agama']=="islam"): ?>
              selected
            <?php endif; ?>>Islam</option>
            <option value="kristen"  <?php if (@$pasien['agama']=="kristen"): ?>
              selected
            <?php endif; ?>>Kristen</option>
            <option value="hindu"  <?php if (@$pasien['agama']=="hindu"): ?>
              selected
            <?php endif; ?>>Hindu</option>
            <option value="budha"  <?php if (@$pasien['agama']=="budha"): ?>
              selected
            <?php endif; ?>>Budha</option>
            <option value="katolik"  <?php if (@$pasien['agama']=="katolik"): ?>
              selected
            <?php endif; ?>>Katolik</option>
            <option value="konghucu"  <?php if (@$pasien['agama']=="konghucu"): ?>
              selected
            <?php endif; ?>>Konghucu</option>
        </select>
      </div>
    </div>
  </div>

      <div class="col-md-12 col-xl-6">
        <div class="form-group animated flipIn">
          <label for="exampleInputuname">Provinsi</label>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-home"></i></span> -->
            </div>
            <input type="text" size="100%" style="min-width:370px;text-transform:uppercase;" name="provinsi" id="provinsi" class="form-control" placeholder="provinsi" value="<?php if ($this->uri->segment(2)=="input") {
              echo "JAWA TIMUR";
            }else{echo @$pasien['provinsi']; }?>" required>
    </div>
        </div>
      </div>

    <div class="col-md-12 col-xl-6">
      <div class="form-group animated flipIn">
        <label for="exampleInputuname">Kota</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-home"></i></span> -->
          </div>
          <input type="text" name="kota" size="100%" style="min-width:370px;text-transform:uppercase;" id="kota" class="form-control" placeholder="Kota" value="<?php if ($this->uri->segment(2)=="input") {
            echo "KABUPATEN JEMBER";
          }else{echo @$pasien['kota']; }?>" required>
  </div>
      </div>
    </div>
  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Detail Alamat</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-direction"></i></span>
        </div>
        <input type="text" class="form-control" style="text-transform: uppercase" value="<?php echo @$pasien['alamat']; ?>" name="alamat" placeholder="Alamat Pasien" aria-label="No BPJS" aria-describedby="basic-addon1">
      </div>
    </div>
  </div>

  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Telepon</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-headphone-alt"></i></span>
        </div>
        <input type="number" name="telepon" id="telepon" class="form-control" placeholder="Telepon" value="<?php echo @$pasien['telepon']; ?>">
      </div>
    </div>
  </div>


  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Pekerjaan</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-timer"></i></span> -->
        </div>
        <!-- <select name="pekerjaan" id="select2" class="select2 custom-form" required>
          <option value="" readonly selected>Pilih</option>
            <?php foreach ($list_pekerjaan as $value): ?>
              <option value="<?php echo $value->pekerjaan;?>" <?php if (@$pasien['pekerjaan']==$value->pekerjaan) {
                echo "selected";
              }?>><?php echo $value->pekerjaan;?></option>
            <?php endforeach; ?>
        </select> -->
        <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" style="min-width:370px;" size="100%">
        <!-- <textarea class="form-control" id="pekerjaan"></textarea> -->
      </div>
    </div>
  </div>
  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Tanggal Daftar</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
        </div>
        <input type="date" name="tgl_daftar" id="tgl_daftar" class="form-control" placeholder="Tanggal Daftar" value="<?php if($this->uri->segment(2)=='input'){echo date('Y-m-d');}else{echo @$pasien['tgl_daftar'];} ?>" required>
</div>
    </div>
  </div>

  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Email</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-email"></i></span>
        </div>
        <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo @$pasien['email']; ?>">
</div>
    </div>
  </div>
  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Kunjungan Terakhir</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-alarm-clock"></i></span>
        </div>
        <input type="text" name="" id="kunjungan_terakhir" class="form-control" placeholder="Kunjungan Terakhir" value="<?php if($this->uri->segment(2)=="input"){echo date("d/m/Y");}else{ echo @$pasien['kunjungan_terakhir'];} ?>" readonly>
        <input type="hidden" name="kunjungan_terakhir" id="kunjungan_terakhir" class="form-control" placeholder="Kunjungan Terakhir" value="<?php if($this->uri->segment(2)=="input"){echo date("d-m-Y");}else{ echo @$pasien['kunjungan_terakhir'];} ?>">

      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){

});
var base_url = '<?php echo base_url()?>';
function myajax_request(url,data,callback){
  $.ajax({
      type  : 'POST',
      url   : url,
      async : false,
      dataType : 'json',
      beforeSend:function(){
        $("#icon-cek").addClass("fa fa-spin");
      },
      data:data,
      success : function(response){

          callback(response);
      },
      complete:function(){
        $("#icon-cek").removeClass("fa fa-spin");
      }
  })
}
$(document).ready(function(){
  $(document).on("click",".cek_nobpjs",function(){
    var data = {
      'nobpjs' : $("#noBPJS").val(),
    };
    if ($("#noBPJS").val()=="") {
      alert("Harap isi no bpjs");
    }else{
      myajax_request(base_url+"Pasien/cek_bpjs_v4",data,function(res){
        // console.log(res.aktif);
        if (res.aktif == true) {
          var tglLahir = res.tglLahir;
          var tglLahirSplit = tglLahir.split('-');
          if (confirm('Pasien Terdaftar di '+res.kdProviderPst.nmProvider+' dengan Tagihan Rp. '+res.tunggakan+'. Apakah Akan tetap dilayani?') == true) {
            $("#namapasien").val(res.nama);
            $("#tgl_lahir").val(tglLahirSplit[2]+'-'+tglLahirSplit[1]+'-'+tglLahirSplit[0]);
            $("#pekerjaan").val(res.jnsPeserta.nama);
            $("#telepon").val(res.noHP);
            if (res.sex=="P") {
             $("#p").attr("checked","checked");
             $("#l").removeAttr("checked");
           }else{
             $("#l").attr("checked","checked");
             $("#p").removeAttr("checked");
           }
          }else {
            return false;
          }
        } else {
          alert('Kartu Tidak Aktif');
        }
        // confirm('Pasien ini tidak aktif ,Akan tetap dilayani?'+res['aktif']);
        // if (res.status==1) {
        //   var data = res.res;
        //   // alert(data.nama);
        //   if (data.sex=="P") {
        //     $("#p").attr("checked","checked");
        //     $("#l").removeAttr("checked");
        //   }else{
        //     $("#l").attr("checked","checked");
        //     $("#p").removeAttr("checked");
        //   }
        //   alert(res.message);
        //
        // }else if(res.status==2){
        //
        //   alert(res.message);
        // }else{
        //   var data = res.res;
        //   $("#namapasien").val(data.nama);
        //   $("#tgl_lahir").val(data.tglLahir);
        //   $("#pekerjaan").val(data.jnsPeserta.nama);
        //   $("#telepon").val(data.noHP);
        //   // alert(data.nama);
        //   if (data.sex=="P") {
        //     $("#p").attr("checked","checked");
        //     $("#l").removeAttr("checked");
        //   }else{
        //     $("#l").attr("checked","checked");
        //     $("#p").removeAttr("checked");
        //   }
        // }
      });
    }
  })
})
function alphaOnly(event) {
  // alert("dhakd");
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || key == 8 || key==32 || key==9 || (key>=37 && key<=40) );
};
$(document).ready(function(){
  $(document).on("click",".kawin",function(){
    // alert($(this).val());
    if ($(this).val()=="Kawin") {
      $("#suami_istri").removeAttr("readonly")
    }else{
      $("#suami_istri").val("")
      $("#suami_istri").attr("readonly","readonly")

    }
  })
  $(document).on("click",'.tinggal',function(){
    var val = $(this).val();
    if (val=='lain') {
      $(".tinggal_lain").removeAttr('readonly');
    }else{
      $(".tinggal_lain").attr("readonly","readonly");
    }
  })

  $(document).on("change","#pilih_jenis_pasien",function(){
    var nilai = $("option:selected",this).val();
    if (nilai==1) {
      $("#noBPJS").attr('readonly','readonly');
      $('#noAsuransiLain').attr('readonly','readonly');
    }
    else if (nilai==7 || nilai==9) {
      $("#noBPJS").removeAttr('readonly');
      $('#noAsuransiLain').attr('readonly','readonly');
    }else{
      $("#noBPJS").attr('readonly','readonly');
      $('#noAsuransiLain').removeAttr('readonly');
    }
  })

  $('.tanggal_new').pickadate({
    // min: new Date(2015,3,20),
    format: 'dd-mm-yyyy',
    formatSubmit: 'yyyy-mm-dd',
    max: true
  })

})
</script>
