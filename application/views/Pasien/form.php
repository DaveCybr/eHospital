<style>
.form-group{
  margin-bottom: 5px;
}
</style>
    <div class="row form-group">
          <div class="col-9 col-md-9 ">
            <div class="row form-group">
              <div class="col col-md-4">
                <label for="noRM" class=" form-control-label">No Rekam Medis</label>
              </div>
              <div class="col-8 col-md-8">
                <input type="hidden" name="noRM" id="noRM" class="form-control" placeholder="" value="<?php if ($this->uri->segment(2)=="input") {
                  echo @$noRM;
                }else{echo @$noRM['noRM'];} ?>">
                  <input type="text" name="noRM" id="noRM" class="form-control" placeholder="" value="<?php if ($this->uri->segment(2)=="input") {
                    echo @$noRM;
                  }else{echo @$noRM['noRM'];} ?>" disabled>

              </div>
            </div>
            <div class="row form-group">
                    <div class="col col-md-4">
                      <label for="jenis_pasien" class=" form-control-label">Jenis Pasien</label>
                    </div>
                    <div class="col-3 col-md-3">
                      <select name="jenis_pasien" id="pilih_jenis_pasien" class="mdb-select colorful-select dropdown-info">
                          <?php foreach ($jenis_pasien as $value): ?>
                            <option value="<?php echo $value->kode_jenis;?>" <?php if (@$pasien['jenis_pasien_kode_jenis']==$value->kode_jenis) {
                              echo "selected";
                            }?>><?php echo $value->jenis_pasien;?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-4">
                  <label for="noBPJS" class=" form-control-label">No BPJS</label>
              </div>
              <div class="col-8 col-md-8">
                  <input type="text" name="noBPJS" id="noBPJS" disabled class="form-control" placeholder="isikan nomor BPJS" value="<?php echo @$pasien['noBPJS']; ?>">
                    <!-- <input type="hidden" name="lastBPJS" id="lastBPJS" class="form-control" value=""> -->
              </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-4">
                  <label for="noAsuransiLain" class=" form-control-label">No Asuransi Lain</label>
                </div>
                <div class="col-8 col-md-8">
                  <input type="text" name="noAsuransiLain" id="noAsuransiLain" disabled class="form-control" placeholder="isikan nomor Asuransi Lain (jika ada)" value="<?php echo @$pasien['noAsuransiLain']; ?>">
                </div>
            </div>

          </div>
          <div class="col col-md-3 col-3">
              <?php
              $uri = $this->uri->segment(2);
               if ($uri=="input") {?>
                <input type="file" name="filefoto" id="foto" class="form-control dropify" >
              <?php
              }else{
              ?>
                <div style="display:none;" id="frame_foto"><input type="file" name="filefoto" id="foto" class="form-control dropify"></div>
                <img id="fotopasien" src="<?php echo base_url(); ?>foto/foto_pasien/<?php echo $pasien['foto'];?>" width="130px" height="130px" style="max-height:130px;"><br>
                <!-- Button trigger modal -->
                <button type="submit" id="simpan_foto" class="btn btn-primary mb-1 btn-sm" style="display:none;float:right;margin-left:5px;">Update</button>
                <button type="button" id="cancel" class="btn btn-danger mb-1 btn-sm" style="display:none;float:right;">Batal</button>

                <button type="button" id="ganti_foto" class="btn btn-primary mb-1 btn-sm" data-toggle="modal" data-target="#staticModa" style="margin-top:10px;">Ganti foto pasien</button>
              <?php
              } ?>

          </div>
    </div>

    <div class="row form-group">
            <div class="col col-md-3">
              <label for="namapasien" class=" form-control-label">Nama Pasien</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" name="namapasien" id="namapasien" class="form-control" placeholder="Nama Pasien" value="<?php echo @$pasien['namapasien']; ?>" required>

            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="tgl_lahir" class=" form-control-label">Tanggal Lahir</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" name="tgl_lahir" id="tgl_lahir" class="tanggalku form-control" placeholder="Tanggal Lahir" value="<?php echo @$pasien['tgl_lahir']; ?>" required>

            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jenis_kelamin" class=" form-control-label">Jenis Kelamin</label>
            </div>
            <div class="col-12 col-md-9">
              <div class="custom-control custom-radio">
                <input type="radio" id="l" name="jenis_kelamin" value="L" class="custom-control-input" <?php if (@$pasien['jenis_kelamin']=='L') {
                  echo "checked";
          }?> required>

                <label class="custom-control-label" for="l">Laki - Laki</label>
              </div>
              <div class="custom-control custom-radio">

                    <input type="radio" id="p" name="jenis_kelamin" value="P" class="custom-control-input" <?php if (@$pasien['jenis_kelamin']=='P') {
                      echo "checked";
                    }?> required>

                <label class="custom-control-label" for="p">Perempuan</label>
              </div>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="agama" class=" form-control-label">Agama</label>
            </div>
            <div class="col-3 col-md-3">
                  <select name="agama" id="select" class="mdb-select colorful-select dropdown-info">
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
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="suku" class=" form-control-label">Suku</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" name="suku" id="suku" class="form-control" placeholder="Suku" value="<?php if ($this->uri->segment(2)=="input") {
                echo "Jawa";
              }else{echo @$pasien['suku'];} ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="alamat" class=" form-control-label">Alamat</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="textarea" name="alamat" id="alamat" class="form-control" placeholder="Alamat" value="<?php echo @$pasien['alamat']; ?>" required>

            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kota" class=" form-control-label">Kota</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" name="kota" id="kota" class="form-control" placeholder="Kota" value="<?php if ($this->uri->segment(2)=="input") {
                echo "Jember";
              }else{echo @$pasien['kota']; }?>" required>

            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="telepon" class=" form-control-label">Telepon</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" name="telepon" id="telepon" class="form-control" placeholder="Telepon" value="<?php echo @$pasien['telepon']; ?>">

            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="pekerjaan" class=" form-control-label">Pekerjaan</label>
            </div>
            <div class="col-3 col-sm-3">
              <!-- <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Pekerjaan" value="<?php echo @$pasien['pekerjaan']; ?>" required> -->
              <select name="pekerjaan" id="select" class="mdb-select colorful-select dropdown-info sm-form" >
                <option value="" disabled selected>--Pekerjaan--</option>
                  <?php foreach ($list_pekerjaan as $value): ?>
                    <option value="<?php echo $value->pekerjaan;?>" <?php if (@$pasien['pekerjaan']==$value->pekerjaan) {
                      echo "selected";
                    }?>><?php echo $value->pekerjaan; ?></option>
                  <?php endforeach; ?>
              </select>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="tgl_lahir" class=" form-control-label">Tanggal Daftar</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="date" name="tgl_daftar" id="tgl_daftar" class="form-control" placeholder="Tanggal Daftar" value="<?php if($this->uri->segment(2)=='input'){echo date('Y-m-d');}else{echo @$pasien['tgl_daftar'];} ?>" required>

            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="email" class=" form-control-label">Email</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo @$pasien['email']; ?>">

            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kunjungan_terakhir" class=" form-control-label">Kunjungan Terakhir</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" name="" id="kunjungan_terakhir" class="form-control" placeholder="Kunjungan Terakhir" value="<?php if($this->uri->segment(2)=="input"){echo date("Y-m-d");}else{ echo @$pasien['kunjungan_terakhir'];} ?>" disabled>
              <input type="hidden" name="kunjungan_terakhir" id="kunjungan_terakhir" class="form-control" placeholder="Kunjungan Terakhir" value="<?php if($this->uri->segment(2)=="input"){echo date("Y-m-d");}else{ echo @$pasien['kunjungan_terakhir'];} ?>">
            </div>
    </div>
<script>
 // $(function () {
   $(document).on("change","#pilih_jenis_pasien",function(){
     var nilai = $("option:selected",this).val();
     if (nilai==1) {
       $("#noBPJS").attr('disabled','disabled');
       $('#noAsuransiLain').attr('disabled','disabled');
     }
     else if (nilai==7 || nilai==9) {
       $("#noBPJS").removeAttr('disabled');
       $('#noAsuransiLain').attr('disabled','disabled');
     }else{
       $("#noBPJS").attr('disabled','disabled');
       $('#noAsuransiLain').removeAttr('disabled');
     }
   });

  // $(document).on('change','#noBPJS',function(){validasi_bpjs()});
  // $(document).on('focus','#namapasien',function(){validasi_bpjs()});
  // function validasi_bpjs() {
  //   var noBPJS=$("#noBPJS").val();
  //   $.ajax({
  //       type  : 'POST',
  //       url   : '<?php echo base_url()?>Pasien/cek_nobpjs',
  //       async : false,
  //       dataType : 'json',
  //       data:{noBPJS:noBPJS},
  //       success : function(data){
  //           var response = data.status;
  //           if (response==1) {
  //             alert("No BPJS "+noBPJS+" Telah Terdaftar!!!");
  //             $("#noBPJS").focus();
  //           };
  //       }
  //   })
  // }
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

 // });
</script>
