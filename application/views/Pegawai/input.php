<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>PEGAWAI</strong>
              <small> Form Input</small>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('Pegawai/insert');?>
              <?php echo @$error;?>
              <div class="card">
              <div class="card-body card-block">
              <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="text-input" class=" form-control-label">NIK</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" name="nik" id="nik" class="form-control" placeholder="NIK" required>
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
