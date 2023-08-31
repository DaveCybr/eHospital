
<div class="card">
  <div class="card-body card-block">

    <div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Dokter</label>
      </div>
      <div class="col-12 col-md-9">
        <input type="text" name="nik" id="dokter" class="form-control" placeholder="Dokter" value="<?php echo @$user['Nama']; ?>" required>
      </div>
    </div>

    <div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Jam Mulai Praktek</label>
      </div>
      <div class="col-5">
        <!-- <input type="password" name="jam_mulai" id="jam_mulai" class="form-control" placeholder="07:00" value="<?php echo @$user['password']; ?>" required> -->
        <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
          <input type="text" class="form-control" name="jam_mulai" value="07:00">
          <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-clock"></i></span>
          </div>
        </div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Jam Akhir Praktek</label>
      </div>
      <div class="col-5 ">
        <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
          <input type="text" class="form-control" name="jam_akhir" value="09:00">
          <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-clock"></i></span>
          </div>
        </div>
      </div>

    </div>


    <div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Hari Praktek</label>
      </div>
      <div class="col-12 col-md-9">
        <div class="opt_roles">
          <select multiple id="optgroup" name="hari[]" required>

            <optgroup label="Semua Hari">
              <option value="Mon">Senin</option>
              <option value="Tue">Selasa</option>
              <option value="Wed">Rabu</option>
              <option value="Thu">Kamis</option>
              <option value="Fri">Jumat</option>
              <option value="Sat">Sabtu</option>
            </optgroup>
          </select>
        </div>
      </div>
    </div>

  </div>

</div>

<script type="text/javascript">
$(document).ready(function(){
  $(document).on("focus","#dokter",function(){
    $("#modaldokter").modal("toggle");
  })
});
$(document).on("click",".pilih",function(){
  var nik = $(this).attr("nik");
  var nama = $(this).attr("nama");
  $("#nik_dokter").val(nik);
  $("#dokter").val(nik+" - "+nama);
});
function selected() {
  var jab = $('#jabatan').val();
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url();?>Jabatan/filter_roles/' + jab,
    data: { filter_jab: jab },
    success: function(response) {
      $('.opt_roles').html(response);
      $('#optgroup').multiSelect({
        selectableOptgroup: true
      });
    }
  });
}
</script>
