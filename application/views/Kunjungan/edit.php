<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>KUNJUNGAN</strong>
              <small> Form Edit</small>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('Kunjungan/update');
              echo form_hidden('no_antrian', $this->uri->segment(3));?>
              <?php echo @$error;?>
              <div class="card">
                <div class="card-body card-block">

                  <div class="row form-group">
                          <div class="col col-md-3">
                            <label for="no_antrian" class=" form-control-label">No Antrian</label>
                          </div>
                          <div class="col-12 col-md-9">
                              <input type="text" name="no_antrian" id="no_antrian" class="form-control" placeholder="no antrian" value="<?php echo @$kunjungan['no_antrian']; ?>" required>
                          </div>
                  </div>
              <?php $this->load->view($form)?>

                <?php echo $this->Core->btn_input()?>
              <?php echo form_close(); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
