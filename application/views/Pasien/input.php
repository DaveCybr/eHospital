<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card card-cascade narrower z-depth-1 animated fadeInRight">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                  <h4><a href="" class="white-text mx-3">Input Data Pasien</a></h4>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('Pasien/insert');?>
              <?php echo @$error;?>
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
