<div class="modal fade" id="<?php echo @$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fluid modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead"><?php echo @$judul ?></p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <?php $this->load->view($view) ?>
      </div>
      <div class="modal-footer" style="background-color:#ffffff;">
        <?php if (@$edit == 1 && @$kunjungan['billing'] != 1) : ?>
          <a type="button" class="btn btn-outline-warning waves-effect" href="<?php echo $link ?>">EDIT</a>
        <?php endif; ?>
        <button class="btn btn-primary to-top-modal" type="button">Kembali Keatas</button>
        <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
      </div>
      <!--Footer-->

    </div>
    <!--/.Content-->
  </div>
</div>