
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="nama_satuan" class=" form-control-label">Status Bridging</label>
            </div>
            <div class="col-12 col-md-9">
              <?php if ($pcare->status==1): ?>
                <span class="badge badge-success">Bridging Aktif</span>
                <a href="<?php echo base_url("Pcare/non_aktifkan")?>"><button type="button" class="btn btn-sm btn-primary">Matikan</button></a>
              <?php else: ?>
                <span class="badge badge-danger">Bridging Tidak Aktif</span>
                <a href="<?php echo base_url("Pcare/aktifkan")?>"><button type="button" class="btn btn-sm btn-primary">Hidupkan</button></a>
              <?php endif; ?>
            </div>
    </div>

    <div class="row form-group">
            <div class="col col-md-3">
              <label for="nama_satuan" class=" form-control-label">Password Baru</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="password" id="nama_satuan" class="form-control" placeholder="Password"  required>
            </div>
    </div>
  </div>

</div>
