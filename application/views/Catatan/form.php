
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="nama_satuan" class=" form-control-label">catatan</label>
            </div>
            <div class="col-12 col-md-9">
              <textarea name="catatan" class="form-control" placeholder="Catatan"><?php echo $catatan->catatan?></textarea>
                <!-- <input type="text" name="password" id="nama_satuan" class="form-control" placeholder="Password"  required> -->
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="nama_satuan" class=" form-control-label">saran</label>
            </div>
            <div class="col-12 col-md-9">
              <textarea name="saran" class="form-control" placeholder="Saran"><?php echo $catatan->saran?></textarea>
                <!-- <input type="text" name="password" id="nama_satuan" class="form-control" placeholder="Password"  required> -->
            </div>
    </div>

  </div>

</div>
