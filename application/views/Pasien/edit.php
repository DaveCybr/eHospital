<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>PASIEN</strong>
              <small> Form Edit</small>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('Pasien/update');
              // echo form_hidden('noRM', $this->uri->segment(3));?>
              <?php echo @$error;?>
              <?php $this->load->view($form)?>
              <div class="card-footer row col col-sm-12">
              <div class="col col-sm-10">
              <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.history.back()"><i class="fas fa-reply"></i> Kembali</button>
              </div>
                <div class="col col-sm-2">
                  <button type="submit" class="btn btn-primary btn-sm" name="simpan_data">SIMPAN</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>
