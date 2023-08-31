<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>TEMPAT TIDUR</strong>
              <small> Form Edit</small>
            </div>
            <div class="card-body card-block">
              <?php echo form_open_multipart('TempatTidur/update');
              echo form_hidden('no_tt', $this->uri->segment(3));?>
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
