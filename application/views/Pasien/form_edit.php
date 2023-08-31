<div class="row p-t-20">
  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">No Rekam Medis </label>
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
          <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-instagram"></i></span> -->
        </div>
        <div style="display:none;" id="frame_foto">
          <input type="file" name="filefoto" id="foto" class="form-control dropify">
        </div>
        <img id="fotopasien" src="<?php echo base_url(); ?>foto/foto_pasien/<?php echo $pasien['foto'];?>" width="130px" height="130px" style="max-height:130px;"><br>
        <!-- Button trigger modal -->
        <button type="submit" id="simpan_foto" class="btn btn-primary mb-1 btn-sm" style="display:none;float:right;margin-left:5px;">Update</button>
        <button type="button" id="cancel" class="btn btn-danger mb-1 btn-sm" style="display:none;float:right;">Batal</button>
        <br>
        <button type="button" id="ganti_foto" class="btn btn-primary mb-1 btn-sm" data-toggle="modal" data-target="#staticModa" style="margin-top:10px;">Ganti foto pasien</button>

        <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
        <!-- <input type="file" name="filefoto" id="foto" class="form-control dropify" > -->
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
          <input type="text" name="namapasien" id="namapasien" class="form-control" placeholder="Nama Pasien" value="<?php echo @$pasien['namapasien']; ?>" required onkeydown="return alphaOnly(event);" >
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
        <input type="text" name="noBPJS"  id="noBPJS" class="form-control" placeholder="isikan nomor BPJS" value="<?php echo @$pasien['noBPJS']; ?>">
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
      <label for="exampleInputuname">Nama Suami/Istri</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
        </div>
        <input type="text" name="suami_istri" id="suami_istri" class="form-control" placeholder="Nama Suami/Istri" value="<?php echo @$pasien['suami_istri']; ?>" onkeydown="return alphaOnly(event);">
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
        <input type="text" name="orangtua" id="orangtua" class="form-control" placeholder="Nama Orangtua" value="<?php echo @$pasien['orangtua']; ?>" onkeydown="return alphaOnly(event);">
      </div>
    </div>
  </div>

  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Tanggal Lahir</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-timer"></i></span>
        </div>
        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" value="<?php echo @$pasien['tgl_lahir']; ?>" required>
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
      <label for="exampleInputuname">Alamat</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-direction"></i></span>
        </div>
        <input type="text" class="form-control" value="<?php echo @$pasien['alamat']; ?>" name="alamat" placeholder="Alamat Pasien" aria-label="No BPJS" aria-describedby="basic-addon1">
      </div>
    </div>
  </div>

  <div class="col-md-12 col-xl-6">
    <div class="form-group animated flipIn">
      <label for="exampleInputuname">Kota</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="ti-home"></i></span>
        </div>
        <input type="text" name="kota" id="kota" class="form-control" placeholder="Kota" value="<?php if ($this->uri->segment(2)=="input") {
          echo "Jember";
        }else{echo @$pasien['kota']; }?>" required>
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
        <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" style="min-width:370px;" size="100%" value="<?php echo $pasien['pekerjaan']?>">
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
function alphaOnly(event) {
  // alert("dhakd");
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || key == 8 || key==32);
};
$(document).ready(function(){

  $(document).on("change","#pilih_jenis_pasien",function(){
    var nilai = $("option:selected",this).val();
    if (nilai==1) {
      $("#noBPJS").attr('readonly','readonly');
      $('#noAsuransiLain').attr('readonly','readonly');
    }else{
      $("#noBPJS").removeAttr('readonly');
      $('#noAsuransiLain').removeAttr('readonly');
    }
  })
  $(document).on('click','#ganti_foto',function(){
    $("#frame_foto").css('display','inline');
    $("#fotopasien").css('display','none');
    $("#ganti_foto").css('display','none');
    $("#cancel").css('display','inline');
    $("#simpan_foto").css('display','inline');

  });

  $(document).on('click','#cancel',function(){
    $("#frame_foto").css('display','none');
    $("#fotopasien").css('display','inline');
    $("#ganti_foto").css('display','inline');
    $("#cancel").css('display','none');
    $("#simpan_foto").css('display','none');

  });
})
</script>
