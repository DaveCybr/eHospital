<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>LABORATURIUM</strong>
              <small> Form Input</small>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('Laborat/insert');?>
              <?php echo @$error;?>
              <div class="card">
                <div class="card-body card-block">
                  <div class="row form-group">
                          <div class="col col-md-3">
                            <label for="kode_jasa" class=" form-control-label">Kode Lab</label>
                          </div>
                          <div class="col-12 col-md-9">
                              <input type="text" name="kode_lab" id="kode_lab" maxlength="7" class="form-control" placeholder="_ _ _" value="<?php echo @$laborat['kode_lab']; ?>" required>
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
