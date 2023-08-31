<!-- Central Modal Large Info-->
  <div class="modal fade" id="<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <p class="heading lead"><?php echo @$judul?></p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <!--Body-->
        <div class="modal-body">
          <!-- <div class="text-center">
            <i class="<?php echo $icon?> fa-4x mb-3 animated bounceIn"></i>

          </div> -->
          <?php $this->load->view($view)?>

        </div>

        <!--Footer-->
        <div class="modal-footer">
          <?php if (@$edit==1 && @$kunjungan['billing']!=1): ?>
            <a type="button" class="btn btn-outline-warning waves-effect" href="<?php echo $link?>">EDIT</a>
          <?php endif;
          // die(var_dump(@$edit));?>
          <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">CLOSE</a>
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <!-- Central Modal Large Info-->
