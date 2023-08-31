<div class="col-md-12 col-12 col-xl-12">
  <!-- Card Narrower -->
  <div class="card card-cascade narrower z-depth-1">
    <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
          <h4><a href="" class="white-text mx-3">Rujuk Ke Poli Lain</a></h4>

    </div>

    <!-- Card content -->
    <div class="card-body">

      <!-- <div class="table-responsive table--no-card m-b-40"> -->
        <?php echo form_open(base_url()."Periksa/rujuk/".$this->uri->segment(3))?>
        <!-- <div class="col col-md-12"> -->
          <select name="tujuan_poli" id="select" class="mdb-select colorful-select dropdown-info sm-form" required>
              <option value="" disabled selected>Pilih Tujuan Poli</option>
              <!-- <option value="UMU">Poli Umum</option> -->
              <?php if ($_SESSION['poli']=="IGD"): ?>
                <option value="RANAP">Rawat Inap</option>
              <?php else: ?>
                <option value="IGD">IGD</option>
              <?php endif; ?>
          </select>
          <button class="btn btn-primary text-right" type="submit">Rujuk Sekarang</button>
        <!-- </div> -->
        <?php echo form_close()?>
      <!-- </div> -->

      </div>

    </div>
    <!-- Card Narrower -->

  </div>
