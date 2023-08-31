<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>ASESMEN GAWAT DARURAT</strong>
              <small> Form</small>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('Asesmen/insert_igd');?>
              <?php echo @$error;?>
              <div class="card-body card-block">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>ASESMEN AWAL KEPERAWATAN</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row p-t-20 p-b-50">
                          <div class="col-xl-12 col-md-12 col-sm-12">
                            <div class="form-group animated flipIn">
                              <label for="exampleInputuname">Tanggal Kunjungan</label>
                              <div class="input-group mb-3">
                                <input type="date" class="form-control" aria-label="" name="tanggal_kunjungan" value="<?php echo @$asesmen['tanggal']?>" readonly>
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Pukul : </span>
                                </div>
                                <input type="text" class="form-control" aria-label="" name="tanggal_jam_kunjungan" value="<?php echo date('H:i:s',strtotime(@$asesmen['jam'])) ?>" readonly>
                                <div class="input-group-append">
                                  <span class="input-group-text">WIB</span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-12 col-sm-12">
                            <div class="form-group animated flipIn">
                              <label for="exampleInputuname">Sumberdata </label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ti-notepad"></i></span>
                                </div>
                                <input type="text" name="keluhan" class="form-control" value="<?php echo @$asesmen['sumberdatalain']!=NULL?@$asesmen['sumberdatalain']:@$asesmen['sumberdata']?>" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-12 col-sm-12">
                            <div class="form-group animated flipIn">
                              <label for="exampleInputuname">Rujukan </label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ti-notepad"></i></span>
                                </div>
                                <input type="text" name="keluhan" class="form-control" value="<?php echo @$asesmen['rujukan'].", ".@$asesmen['rujukanrs'].@$asesmen['rujukandokter'].@$asesmen['rujukanlain']?>" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-12 col-sm-12">
                            <div class="form-group animated flipIn">
                              <label for="exampleInputuname">Diagnosa Rujukan </label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ti-notepad"></i></span>
                                </div>
                                <input type="text" name="keluhan" class="form-control" value="<?php echo @$asesmen['diagnosa_rujukan']?>" readonly>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>ASESMEN GAWAT DARURAT</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">Keluhan Utama:</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <textarea class="form-control" rows="2" readonly name="keluhan_utama"><?php echo @$asesmen['keluhan_utama']; ?></textarea>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">Riwayat Penyakit:</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <textarea class="form-control" rows="4" readonly name="riwayat_penyakit"><?php echo @$asesmen['riwayat_penyakit']; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card border-info" style="border: 2px solid;">
                      <div class="card-header bg-info text-white">
                        <strong>PRIMARY SURVEY</strong>
                      </div>
                      <div class="card-body card-block">
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">AIRWAY:</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <input type="text" name="keluhan" class="form-control" value="<?php echo @$asesmen['airway']?>" readonly>

                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">BREATHING :</label>
                          </div>
                          <div class="col-12 col-md-10 row">
                            <input type="text" name="keluhan" class="form-control" value="<?php echo @$asesmen['breathing']?>" readonly>

                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-6">
                            <div class="card border-info" style="border: 2px solid;">
                              <div class="card-header bg-info text-white">
                                <strong>CIRCULATION</strong>
                              </div>
                              <div class="card-body card-block">
                                <div class="row form-group">
                                  <!-- <div class="col col-md-2">
                                  <label class=" form-control-label">Sistole :</label>
                                </div>
                                <div class="col-sm-12 col-lg-10 row p-b-10">
                                <div class="col-12 col-lg-9 input-group">
                                <input type="text" class="form-control" aria-label="" name="sistole" value="<?php echo @$asesmen['sistole'] ?>">
                              </div>
                            </div>
                            <div class="col col-md-2">
                            <label class=" form-control-label">Diastole :</label>
                          </div>
                          <div class="col-sm-12 col-lg-10 row p-b-10">
                          <div class="col-12 col-lg-9 input-group">
                          <input type="text" class="form-control" aria-label="" name="diastole" value="<?php echo @$asesmen['diastole'] ?>">
                        </div>
                      </div> -->

                      <div class="col-sm-12 col-md-2">
                        <label class=" form-control-label">N :</label>
                      </div>
                      <div class="col-sm-12 col-lg-10 row">
                        <input type="text" name="keluhan" class="form-control mb-3" value="<?php echo @$asesmen['n']?>" readonly>

                      </div>

                      <div class="col-sm-12 col-md-2">
                        <label class=" form-control-label">CRT :</label>
                      </div>
                      <div class="col-12 col-md-10 row">
                        <input type="text" name="keluhan" class="form-control mb-3" value="<?php echo @$asesmen['crt']?>" readonly>

                      </div>

                      <div class="col-sm-12 col-md-3">
                        <label class=" form-control-label">Warna Kulit :</label>
                      </div>
                      <div class="col-sm-12 col-md-9 row">
                        <input type="text" name="keluhan" class="form-control mb-3" value="<?php echo @$asesmen['warna_kulit']?>" readonly>

                      </div>

                      <div class="col-sm-12 col-md-3">
                        <label class=" form-control-label">pendarahan :</label>
                      </div>
                      <div class="col-sm-12 col-md-9 row">
                        <input type="text" name="keluhan" class="form-control mb-3" value="<?php echo @$asesmen['pendarahan']?>" readonly>

                      </div>

                      <div class="col-sm-12 col-md-3">
                        <label class=" form-control-label">Turgor Kulit :</label>
                      </div>
                      <div class="col-sm-12 col-md-9 row">
                        <input type="text" name="keluhan" class="form-control" value="<?php echo @$asesmen['tugor_kulit']?>" readonly>

                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="card border-info" style="border: 2px solid;">
                  <div class="card-header bg-info text-white">
                    <strong>DISABILITY</strong>
                  </div>
                  <div class="card-body card-block">
                    <div class="row form-group">

                      <div class="col-sm-12 col-md-2">
                        <label class=" form-control-label">Respon :</label>
                      </div>
                      <div class="col-sm-12 col-lg-10 row">
                        <input type="text" name="keluhan" class="form-control mb-3" value="<?php echo @$asesmen['respon']?>" readonly>

                      </div>

                      <div class="col-sm-12 col-md-2">
                        <label class=" form-control-label">Pupil :</label>
                      </div>
                      <div class="col-sm-12 col-lg-10 row">
                        <input type="text" name="keluhan" class="form-control mb-3" value="<?php echo @$asesmen['pupil']?>" readonly>

                      </div>

                      <div class="col-sm-12 col-md-2">
                        <label class=" form-control-label">Reflek :</label>
                      </div>
                      <div class="col-sm-12 col-lg-10 row ">
                        <div class="input-group" style="padding-bottom:9px">
                          <input type="text" class="form-control" readonly aria-label="" name="reflek1" value="<?php echo @$asesmen['reflek1'] ?>">
                          <div class="input-group-prepend">
                            <span class="input-group-text">/</span>
                          </div>
                          <input type="text" class="form-control" aria-label="" readonly name="reflek2" value="<?php echo @$asesmen['reflek2'] ?>">
                        </div>
                      </div>


                      <div class="col-sm-12 col-md-2">
                        <label class=" form-control-label">GCS :</label>
                      </div>
                      <div class="col-sm-12 col-lg-10 row">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">E :</span>
                          </div>
                          <input type="number" readonly min="1" max="6" class="ea form-control in_max" aria-label="" name="GCS_E" value="<?php echo @$asesmen['GCS_E'] ?>">
                          <div class="input-group-prepend">
                            <span class="input-group-text">V :</span>
                          </div>
                          <input type="number" readonly min="1" max="6" class="va form-control in_max" aria-label="" name="GCS_V" value="<?php echo @$asesmen['GCS_V'] ?>">
                          <div class="input-group-prepend">
                            <span class="input-group-text">M :</span>
                          </div>
                          <input type="number" readonly min="1" max="6" class="ma form-control in_max" aria-label="" name="GCS_M" value="<?php echo @$asesmen['GCS_M'] ?>">
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="card border-info" style="border: 2px solid;">
      <div class="card-header bg-info text-white">
        <strong>SECONDARY SURVEY</strong>
      </div>
      <div class="card-body card-block row">
        <div class="col-sm-12 col-lg-4">
          <img src="<?php echo base_url() ?>desain/OrganIGD.PNG" alt="">
        </div>

        <div class="col-sm-12 col-lg-4">
          <div class="row p-t-20 p-b-50">
            <div class="col-xl-12 col-md-12 col-sm-12">
              <div class="form-group animated flipIn">
                <label for="exampleInputuname">Cidera</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-label="" name="tanggal_kunjungan" value="<?php echo @$asesmen['cidera']?>" readonly>

                </div>
              </div>
            </div>
            <div class="col-xl-12 col-md-12 col-sm-12">
              <div class="form-group animated flipIn">
                <label for="exampleInputuname">Cidera Lain</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-label="" name="tanggal_kunjungan" value="<?php echo @$asesmen['cidera_lain']?>" readonly>

                </div>
              </div>
            </div>
          </div>
          <!-- <div class="col-sm-12 col-lg-12 custom-control custom-radio"> -->
            <br>
            Skala Resiko Cidera :
            <input type="text" class="form-control" aria-label="" name="tanggal_kunjungan" value="<?php echo @$asesmen['skalacidera']?>" readonly>

          <!-- </div> -->
        </div>

        <div class="col-sm-12 col-lg-4">
          <div class="row p-t-20 p-b-50">
            <div class="col-xl-12 col-md-12 col-sm-12">
              <div class="form-group animated flipIn">
                <label for="exampleInputuname">Luka</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-label="" name="tanggal_kunjungan" value="<?php echo @$asesmen['luka']?>" readonly>

                </div>
              </div>
            </div>
            <div class="col-xl-12 col-md-12 col-sm-12">
              <div class="form-group animated flipIn">
                <label for="exampleInputuname">Luka Lain</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-label="" name="tanggal_kunjungan" value="<?php echo @$asesmen['luka_lain']?>" readonly>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <hr>
        </div>
        <div class="col-sm-6 col-lg-4">
          <div class="col-12 col-lg-12 input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Skala Nyeri :</span>
            </div>
            <input type="text" class="form-control" readonly aria-label="" name="skalanyeri" value="<?php echo @$asesmen['skalanyeri'] ?>">
          </div>
          <br>
          <div class="col-12 col-lg-12 input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Berat Badan :</span>
            </div>
            <input type="text" class="form-control" readonly aria-label="" name="bb" value="<?php echo @$asesmen['bb'] ?>">
            <div class="input-group-prepend">
              <span class="input-group-text">Kg</span>
            </div>
          </div>
          <br>
          <div class="col-12 col-lg-12 input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Tinggi Badan :</span>
            </div>
            <input type="text" class="form-control" readonly aria-label="" name="tb" value="<?php echo @$asesmen['tb'] ?>">
            <div class="input-group-prepend">
              <span class="input-group-text">CM</span>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-lg-6 text-right">
          <img src="<?php echo base_url() ?>desain/skala-nyeri.JPG" alt="">
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-sm-12">
      <?php $this->load->view("Demografi/view_igd_pengkajian") ?>
    </div>


    <div class="col-lg-4 col-sm-12">
      <div class="card border-info" style="border: 2px solid;">
        <div class="card-header bg-info text-white">
          <strong>DIAGNOSIS KEPERAWATAN</strong>
        </div>
        <?php $this->load->view("Demografi/view_igd_diagnosis") ?>
      </div>
    </div>

    <div class="col-lg-4 col-sm-12">
      <div class="card border-info" style="border: 2px solid;">
        <div class="card-header bg-info text-white">
          <strong>RENCANA / TINDAKAN KEPERAWATAN</strong>
        </div>
        <?php $this->load->view("Demografi/view_igd_tindakan") ?>
      </div>
    </div>
  </div>


</div></div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php echo form_close()?>
<script type="text/javascript">
function coba() {
  if ($("input#lain_ridul_check:checked").length == 0) {
    $("#lain_ridul").attr('disabled', true);
  } else {
    $("#lain_ridul").attr('disabled', false)
    $("#lain_ridul").focus();;
  }
}
$(document).ready(function(){
  $(document).on("blur",".ea",function(){
    if ($(this).val()>6) {
      $(".eb").val(6);
    }else{

      $(".eb").val($(this).val());
    }
  })
  $(document).on("blur",".va",function(){
    if ($(this).val()>6) {
      $(".vb").val(6);
    }else{

      $(".vb").val($(this).val());
    }
  })
  $(document).on("blur",".ma",function(){
    if ($(this).val()>6) {
      $(".mb").val(6);
    }else{

      $(".mb").val($(this).val());
    }
  })
  $(document).on("click",".pupil_a",function(){
    var nilai = $(this).val();
    // if (nilai=="Unrespon") {
    $(".pupil_b").val(nilai);
    // }
  })
})
</script>
