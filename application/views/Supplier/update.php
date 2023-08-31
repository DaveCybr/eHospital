<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>SUPPLIER</strong>
              <small> Form Input</small>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('Supplier/update');?>
              <?php echo @$error;?>

              <div class="card">
              <div class="card-body card-block">
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="text-input" class=" form-control-label">Kode Supplier</label>
                </div>
                <div class="col-md-2 col-sm-9">
                  <input type="text" name="kode_sup" id="kode_sup" maxlength="3" class="form-control" placeholder="---" value="<?php echo @$supplier['kode_sup']; ?>" required readonly>
                </div>
              </div>
              <?php $this->load->view($form)?>


              <?php echo $this->Core->btn_input(); ?>
              <?php echo form_close(); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
