
      <?php echo form_open_multipart('KunjunganLab/input_labkun');?>
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                  <h4><a href="" class="white-text mx-3">Pasien Form</a></h4>

            </div>
            <div class="card-body card-block">

              <?php echo @$error;?>

                <div class="row form-group">
                      <div class="col col-md-2">
                        <label for="nokun" class=" form-control-label">NO. Kunjungan :</label>
                      </div>
                      <div class="col-12 col-md-2">
                        <input type="text" name="nokun" id="nokun" class="form-control" placeholder="No Kunjungan" value="<?php echo $this->uri->segment(3) ?>" required readonly>
                          <input type="text" name="nokunlab" id="nokunlab" class="form-control" placeholder="nokunlab" value="<?php echo $this->uri->segment(4) ?>" required readonly>
                      </div>
                      <div class="col col-md-2">
                        <label for="idlab" class=" form-control-label">NO. Kunjungan Laborat :</label>
                      </div>
                      <div class="col-12 col-md-2">
                          <input type="text" name="idlab" id="idlab" class="form-control" placeholder="No Kunjungan Laborat" value="<?php echo $this->uri->segment(4) ?>" required readonly>
                      </div>
                      <div class="col col-md-1">
                        <label for="tanggal" class=" form-control-label">Tanggal</label>
                      </div>
                      <div class="col-12 col-md-2">
                          <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo $kunjungan['tgl']; ?>" required readonly>
                      </div>
                </div>

                <div class="row form-group">
                      <div class="col col-md-2">
                        <label for="norm" class=" form-control-label">Pasien :</label>
                      </div>
                      <div class="col-12 col-md-3">
                          <input type="text" name="no_rm" id="norm" class="form-control" placeholder="norm" value="<?php echo @$kunjungan['noRM']; ?>" required readonly>
                      </div>
                      <div class="col-12 col-md-4">
                          <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="nama_pasien" value="<?php echo @$kunjungan['namapasien']; ?>" required readonly>
                      </div>
                      <div class="col-12 col-md-3">
                          <input type="text" name="jenis_kunjungan" id="jenis_kunjungan" class="form-control" placeholder="jenis_kunjungan" value="<?php echo @$kunjungan['jenis_pasien']; ?>" required readonly>
                      </div>
                </div>
              </div>
              </div>
              </div>
              </div>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="card card-cascade narrower z-depth-1">
                      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                            <h4><a href="" class="white-text mx-3">Laboratorium</a></h4>

                      </div>
                      <div class="card-body card-block">
                        <div class="row form-group">
                              <div class="col col-md-2">
                                <label for="rujukan" class=" form-control-label">Rujukan:</label>
                              </div>
                              <div class="col-12 col-md-4">
                                  <input type="text" name="rujukan" id="rujukan" class="form-control" placeholder="rujukan" value="<?php echo $kunjungan['rujukan'] ?>">
                              </div>
                              <div class="col col-md-2">
                                <label for="rujukan" class=" form-control-label">Analis:</label>
                              </div>
                              <div class="col-12 col-md-4">
                                  <input type="hidden" name="analis" id="analis" class="form-control" placeholder="analis" value="<?php echo $_SESSION['nik'] ?>">
                                  <input type="text" class="form-control" placeholder="analis" value="<?php echo $_SESSION['karyawan'] ?>" readonly>
                              </div>
                        </div>
                        <div class="row form-group">
                              <div class="col col-md-2">
                                <label for="perwat1" class=" form-control-label">Perawat 1:</label>
                              </div>
                              <div class="col-12 col-md-4">
                                  <input type="text" name="perawat1" id="perawat1" class="form-control" placeholder="Perawat 1" value="<?php echo $kunjungan['perawat1_kun'] ?>">
                              </div>
                              <div class="col col-md-2">
                                <label for="perwat2" class=" form-control-label">Perawat 2:</label>
                              </div>
                              <div class="col-12 col-md-4">
                                  <input type="text" name="perawat2" id="perawat2" class="form-control" placeholder="Perawat 2" value="<?php echo $kunjungan['perawat2_kun'] ?>">
                              </div>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered table-hover table-striped" id="lab">
                          <thead>
                            <th width="20%">KD Lab</th>
                            <th >Jenis Pemeriksaan</th>
                            <th>Hasil</th>
                            <th>Nilai Normal</th>
                          </thead>
                          <tbody id="lab">
                            <?php $no = 0; foreach ($lab as $value):
                              $lab = $this->ModelLaborat->get_data_edit($value->kodelab);
                              if ($value->type!=NULL || $value->type!='') {
                                $type = $value->type;
                                $min = 'min="'.$value->min.'"';
                                $max = 'max="'.$value->max.'"';
                              }else{
                                $type = "text";
                                $min = '';
                                $max = '';

                              }
                               ?>

                              <tr>
                                <td><?php echo $value->kodelab ?> <input type="text" name="kodelab[]" value="<?php echo $value->kodelab ; ?>" hidden> <input type="text" name="id[]" value="<?php echo $value->iddetaillab; ?>" hidden></td>
                                <td><?php echo $value->nama ?>  <input type="hidden" name="nama_lab-<?php $hapus_spasi=str_replace(' ','', $value->nama); echo $hapus_spasi ?>" value="<?php echo $value->nama; ?>" > <input type="text" name="hrg[]" value="<?php echo $lab["hrg_1"]; ?>" hidden> </td>
                                <td><?php if (strlen($value->kodelab) > 1): ?>
                                  <input type="hidden" name="nama_lab_<?php $hapus_spasi=str_replace(' ','', $value->nama); echo $hapus_spasi ?>" value="" oninput="add_array()">
                                  <input type="<?php echo $type?>" <?php echo $min." ".$max;?> name="hasil[]" placeholder="Hasil : <?php echo $value->nama ?>" class="form-control lab_<?php echo $type?>">
                                <?php else: ?>
                                  <input type="hidden" name="nama_<?php $hapus_spasi=str_replace(' ','', $value->nama); echo $hapus_spasi ?>" value="" >
                                  <input type="<?php echo $type?>" <?php echo $min." ".$max;?> name="hasil[]" placeholder="Hasil : <?php echo $value->nama ?>" class="form-control" value="<?php echo $value->hasil;?>" readonly> </td>

                                <?php endif; ?></td>
                                <td><?php echo $lab['nilai_normal'];?>  <input type="text" name="nilai_normal[]" value="<?php echo $lab["nilai_normal"]; ?>" hidden> </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>

                      </div>
                      <!-- <div class="card-footer"> -->
                        <?php echo $this->Core->btn_input(); ?>
                      <!-- </div> -->
                  </div>
                </div>
              </div>


              <?php echo form_close(); ?>

<script type="text/javascript">
function select_lab(kode) {
   $.ajax({
     type: 'POST',
     url: '<?php echo base_url();?>Periksa/labsearch/' + kode,
     data: { kode_lab: kode },
     success: function(response) {
       $("tbody#lab").append(response);
     }
   });

}

function select_kode_lab(kode){
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url();?>Periksa/labsearchkode/' + kode,
    data: { kode_lab: kode },
    success: function(response) {
      $('#kode').val(response);
    }
  });
}

function tambahlab(kode, jenis) {
  var kode;
  var jenis;
          var markup = "<tr>" +
              "<td><input hidden value='"+ kode +"' name='kode_lab[]'>"+ kode +"</td>" +
              "<td><input hidden value='"+ jenis +"' name='jenis_lab[]'>"+ jenis +"</td>" +
              "<td><button type=\"button\" onclick='deleteRowlab(this)' class=\"btn-danger item-table\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Lab\"><i class=\"fas fa-trash\"></i></button></td>" +
              "</tr>";
          $("tbody#lab").append(markup);
}

function deleteRowlab(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("lab").deleteRow(i);
    }
$(document).ready(function(){
  $(".lab_number").on("blur",function(){
    var min = parseInt($(this).attr("min"));
    var max = parseInt($(this).attr("max"));
    var nilai = $(this).val();
    if (nilai < min) {
      nilai = min;
    }
    else if (nilai > max) {
      nilai=max;
    }else{
      nilai=nilai;
    }
    $(this).val(nilai);
  })
})
</script>
