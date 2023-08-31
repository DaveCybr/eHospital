
<?php echo form_open('Laporan/cetak_rekap_pasien',array("target"=>"_blank"));?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
            <h4><a href="" class="white-text mx-3">Cari Diagnosa Pasien</a></h4>
      </div>
      <div class="card-body">
        <div class="row p-t-20">
          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Dari Tanggal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                <input type="date" name="tgl_mulai" id="tgl" value="<?php echo date("Y-m-d")?>" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Sampai Tanggal</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <input type="date" name="tgl_sampai" id="tgl" value="<?php echo date("Y-m-d")?>" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Daftar Diagnosa</label>
              <div class="input-group mb-3">
                <!-- <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="ti-calendar"></i></span>
                </div> -->
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <!-- <div class="tags-default"> -->
                  <input type="text" id="diagnosa_baru" name="diagnosa" value="" data-role="tagsinput" placeholder="Daftar Diagnosa Dipilih" required />
                <!-- </div> -->
                <!-- <input type="date" name="tgl_sampai" id="tgl" value="<?php echo date("Y-m-d")?>" class="form-control" required> -->
              </div>

            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Cari diagnosa</label>
              <div class="input-group mb-3">

                <button class="btn btn-sm btn-primary" id="cari_diagnosa" type="button">Daftar Penyakit</button>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group animated flipIn">
              <label for="exampleInputuname">Filter</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <!-- <span class="input-group-text" id="basic-addon1"><i class="ti-instagram"></i></span> -->
                </div>
                <!-- <input type="text" name="noBPJS" id="noBPJS" class="form-control" placeholder="xxxxxxxxxxxxx" value="<?php echo @$pasien['noBPJS']; ?>"> -->
                <button type="submit" class="btn btn-info" target="_blank"><i class="fa fa-search"></i> Cari</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row col-md-12">
          <h2 >Cari Diagnosa Pasien</h2>
          <div class="table-responsive">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scrollmodalLabel">LIST PENYAKIT</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table id="penyakit" class="table table-borderless table-striped">
                    <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="10%">kodeicdx</th>
                            <th>Nama Penyakit</th>
                            <th>Nama Penyakit (Indonesia)</th>
                            <th>Wabah</th>
                            <th width="%">Nular</th>
                            <th width="%">BPJS</th>
                            <th width="%">Non-Spesialis</th>
                            <th width="%">opsi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php echo form_close();?>

<script type="text/javascript">

$(document).ready(function() {
    // $("#diagnosa_baru").val("kakakak");
    $(document).on("click","#cari_diagnosa",function(){
      $("#scrollmodal").modal("toggle");
    })
    //datatables
    var table = $('#penyakit').DataTable({

        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": "<?php echo site_url('Periksa/get_data_penyakit')?>",
            "type": "POST"
        },


        "columnDefs": [
        {
            "targets": [ 0 ],
            "orderable": false,
        },
        ],

    });

});

function select_diagnosa(kode,sakit) {
  var kode;
  var sakit;
  // $("#t_diagnosa").val(kode+" - "+sakit);
  // $("#diagnosa").val(kode);
  // alert(kode);
  // $("#diagnosa_baru").val("dhdjada");
  $('#diagnosa_baru').tagsinput('add', kode);
  $('#diagnosa_baru').tagsinput({
    allowDuplicates: false
  });
      // $("#diagnosa_baru").val("kakakak");
}
</script>
