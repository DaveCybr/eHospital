
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <h4><a href="" class="white-text mx-3">Penanggung Jawab Lab</a></h4>
      </div>
      <div class="card-body">
        <div class="card-body card-block">
          <?php echo form_open_multipart('PenanggungJawab/update');?>
          <?php echo @$error;?>
        <div class="row form-group">
                <div class="col col-md-3">
                  <label for="nama_satuan" class=" form-control-label">Penanggung Jawab</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="nama" value="<?php echo @$penanggung_jawab['nama']; ?>" required>
                </div>
        </div>
      </div>
      <?php echo $this->Core->btn_input()?>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
</div>

<!-- Modal -->
<!-- modal small -->
<div class="modal fade" id="smallmodal2" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="smallmodalLabel">Daftar Dokter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body card-block">
            <section class="invoice">
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12">
                  <h2 class="page-header">
                    <img src="<?php echo base_url(); ?>desain/assets/images/rsuh_7.png" style="max-width: 55px;"/> Utama Husada
                  </h2>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-12 invoice-col"><br>
                  <h4>Daftar Dokter RSUH</h4><br>
                </div>
                <!-- /.row -->
              </section>
              <div class="table-responsive">

                <table class="table" id="dokter">
                  <thead>
                    <th>NO</th>
                    <th>Nama Dokter</th>
                    <th>Opsi</th>

                  </thead>
                  <tbody id="dokter">
                    <?php $no=1;foreach ($dokter as $value): ?>
                      <tr>
                        <td><?php echo $no++?></td>
                        <td><?php echo $value->nama?></td>
                        <td><button class="btn btn-sm btn-primary pilih" nama="<?php echo $value->nama?>"><i class="fa fa-check"></i></button></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger btn-md pull-right" data-dismiss="modal">close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end modal small -->


  <div class="loader" id="loader">
    <div class="loader__figure"></div>
    <!-- <p class="loader__label"></p> -->
  </div>
  <script>

  $(document).ready(function(){
    $("#loader").hide();
    $(document).on("focus","#nama",function(){
      $("#smallmodal2").modal("toggle");
    })

    $(document).on("click",".pilih",function(){
      var nama = $(this).attr("nama");
      $("#nama").val(nama);
      $("#smallmodal2").modal("toggle");
    })


  });
</script>
