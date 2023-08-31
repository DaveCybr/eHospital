<style>
  .form-group {
    margin-bottom: 5px;
  }
</style>
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
      <div class="col col-md-3">
        <label for="idobat" class=" form-control-label">No Barcode</label>
      </div>
      <div class="col-12 col-md-9">
        <input type="text" name="idobat" id="idobat" class="form-control" placeholder="xxxxxxxxxxxx" value="<?php echo @$obat['idobat']; ?>" required <?php if ($this->uri->segment(2) == 'edit') : ?> readonly <?php endif; ?>>

      </div>
    </div>
    <div class="row form-group">
      <div class="col col-md-3">
        <label for="nama_obat" class=" form-control-label">Nama Obat</label>
      </div>
      <div class="col-12 col-md-9">
        <input type="text" name="nama_obat" id="nama_obat" class="form-control" placeholder="Nama Obat" value="<?php echo @$obat['nama_obat']; ?>" required>

      </div>
    </div>
    <div class="row form-group">
      <div class="col col-md-3">
        <label for="kategori_obat" class=" form-control-label">Kategori Obat</label>
      </div>
      <div class="col-12 col-md-9">
        <select name="kategori_obat" class="mdb-select colorful-select dropdown-info sm-form" required>
          <option value="" selected disabled>Pilih Kategori Obat</option>
          <?php foreach ($kategori_obat as $value) : ?>
            <option value="<?php echo $value->idkategori_obat; ?>" <?php if (@$obat['kategori_obat_idkategori_obat'] == $value->idkategori_obat) {
                                                                      echo "selected";
                                                                    } ?>><?php echo $value->kategori_obat; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="row form-group">
      <div class="col col-md-3">
        <label for="jenis_obat" class=" form-control-label">Jenis Obat</label>
      </div>
      <div class="col-12 col-md-9">
        <select name="jenis_obat" class="mdb-select colorful-select dropdown-info sm-form" required>
          <option value="" selected disabled>Pilih Jenis Obat</option>
          <?php foreach ($jenis_obat as $value) : ?>
            <option value="<?php echo $value->idjenis_obat; ?>" <?php if (@$obat['jenis_obat_idjenis_obat'] == $value->idjenis_obat) {
                                                                  echo "selected";
                                                                } ?>><?php echo $value->jenis_obat; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="row form-group">
      <div class="col col-md-3">
        <label for="jenis_obat" class=" form-control-label">Kelompok Obat</label>
      </div>
      <div class="col-12 col-md-9">
        <select name="kelompok_obat" class="mdb-select colorful-select dropdown-info sm-form" required>
          <option value="" selected disabled>Pilih Kelompok Obat</option>
          <option value="Narkotika" <?php if (@$obat['kelompok_obat'] == "Narkotika") : ?>selected<?php endif; ?>>Narkotika</option>
          <option value="Psikotropika" <?php if (@$obat['kelompok_obat'] == "Psikotropika") : ?>selected<?php endif; ?>>Psikotropika</option>
          <option value="Lainnya" <?php if (@$obat['kelompok_obat'] == "Lainnya") : ?>selected<?php endif; ?>>Lainnya</option>
        </select>
      </div>
    </div>

    <div class="row form-group">
      <div class="col col-md-3">
        <label for="status_obat" class=" form-control-label">Status Obat</label>
      </div>
      <div class="col-12 col-md-9">
        <select name="status" class="mdb-select colorful-select dropdown-info sm-form" required>
          <option value="" selected disabled>Pilih Status Obat</option>
          <option value="Tidak Aktif" <?php if (@$obat['status'] == "Tidak Aktif") : ?>selected<?php endif; ?>>Tidak Aktif</option>
          <option value="Aktif" <?php if (@$obat['status'] == "Aktif") : ?>selected<?php endif; ?>>Aktif</option>

        </select>
      </div>
    </div>

    <div class="row form-group">
      <div class="col col-md-3">
        <label for="dosis" class=" form-control-label">Dosis</label>
      </div>
      <div class="col-12 col-md-9">
        <input type="text" name="dosis" id="dosis" class="form-control" placeholder="Dosis" value="<?php echo @$obat['dosis']; ?>">

      </div>
    </div>

    <div class="row form-group">
      <div class="col col-md-3">
        <label for="kegunaan" class=" form-control-label">Kegunaan</label>
      </div>
      <div class="col-12 col-md-9">
        <textarea name="kegunaan" id="kegunaan" class="form-control" placeholder="Kegunaan Obat" value=""><?php echo @$obat['kegunaan']; ?></textarea>
      </div>
    </div>

    <div class="row form-group">
      <div class="col col-md-3">
        <label for="Kandungan" class=" form-control-label">Kandungan Obat</label>
      </div>
      <div class="col-12 col-md-9">
        <textarea name="kandungan" id="kandungan" class="form-control" placeholder="Kandungan Obat" value=""><?php echo @$obat['kandungan_obat']; ?></textarea>

      </div>
    </div>
    <div class="row form-group">
      <div class="col-sm-12 col-md-3">
        <label for="satuan_obat" class=" form-control-label">Satuan Obat</label>
      </div>
      <div class="col-sm-12 col-md-3">
        <select name="satuan_besar" id="satuan_besar" class="mdb-select colorful-select dropdown-info sm-form" required>
          <option value="" selected disabled>-- Satuan Besar --</option>
          <?php foreach ($satuan as $value) : ?>
            <option value="<?php echo $value->nama_satuan; ?>" <?php if (@$obat['satuan_besar'] == $value->nama_satuan) {
                                                                  echo "selected";
                                                                } ?>><?php echo $value->nama_satuan; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-3 col-sm-12">
        <select name="satuan_sedang" id="satuan_sedang" class="mdb-select colorful-select dropdown-info sm-form" required>
          <option value="" disabled selected>-- Satuan Sedang --</option>
          <?php foreach ($satuan as $value) : ?>
            <option value="<?php echo $value->nama_satuan; ?>" <?php if (@$obat['satuan_sedang'] == $value->nama_satuan) {
                                                                  echo "selected";
                                                                } ?>><?php echo $value->nama_satuan; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-3 col-sm-3">
        <select name="satuan_kecil" id="satuan_kecil" class="mdb-select colorful-select dropdown-info sm-form" required>
          <option value="" disabled selected>-- Satuan Kecil --</option>
          <?php foreach ($satuan as $value) : ?>
            <option value="<?php echo $value->nama_satuan; ?>" <?php if (@$obat['satuan_kecil'] == $value->nama_satuan) {
                                                                  echo "selected";
                                                                } ?>><?php echo $value->nama_satuan; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-sm-12 col-md-3">
        <label for="jumlah_satuan_besar" class=" form-control-label">Satu <span id="besar"><?php if ($this->uri->segment(2) == 'edit') {
                                                                                              echo @$obat['satuan_besar'];
                                                                                            } else {
                                                                                              echo "Satuan Besar";
                                                                                            } ?></span></label>
      </div>
      <div class="col-sm-12 col-md-3">
        <input type="number" name="jumlah_satuan_besar" id="jumlah_satuan_besar" class="form-control" placeholder="0" value="<?php echo @$obat['jml_satuan_besar']; ?>" required>
        <small class="label_sedang"><?php if ($this->uri->segment(2) == 'edit') {
                                      echo @$obat['satuan_sedang'];
                                    } else {
                                      echo "satuan sedang";
                                    } ?></small>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-sm-12 col-md-3">
        <label for="jumlah_satuan_sedang" class=" form-control-label">Satu <span id="sedang"><?php if ($this->uri->segment(2) == 'edit') {
                                                                                                echo @$obat['satuan_sedang'];
                                                                                              } else {
                                                                                                echo "Satuan Sedang";
                                                                                              } ?></span></label>
      </div>
      <div class="col-sm-12 col-md-3">
        <input type="number" name="jumlah_satuan_sedang" id="jumlah_satuan_sedang" class="form-control" placeholder="0" value="<?php echo @$obat['jml_satuan_sedang']; ?>" required>
        <small class="label_kecil"><?php if ($this->uri->segment(2) == 'edit') {
                                      echo @$obat['satuan_kecil'];
                                    } else {
                                      echo "satuan kecil";
                                    } ?></small>
      </div>
    </div>


    <div class="row form-group">
      <div class="col-sm-12 col-md-3">
        <label for="satuan_sedang" class=" form-control-label">Harga Beli Obat Per Satuan</label>
      </div>
      <div class="col-sm-12 col-md-3">
        <input type="text" name="harga_satuan_besar" id="harga_satuan_besar" class="money form-control" placeholder="0" value="<?php echo @$obat['harga_beli_satuan_besar']; ?>" required>
        <small class="form-text text-muted">Harga Beli Satuan Besar</small>
      </div>
      <div class="col-sm-12 col-md-3">
        <input type="text" name="harga_satuan_sedang" id="harga_satuan_sedang" class="money form-control" placeholder="0" value="<?php echo @$obat['harga_beli_satuan_sedang']; ?>" readonly>
        <small class="form-text text-muted">Harga Beli Satuan Sedang</small>
      </div>
      <div class="col-sm-12 col-md-3">
        <input type="text" name="harga_satuan_kecil" id="harga_satuan_kecil" class="money form-control" placeholder="0" value="<?php echo @$obat['harga_beli_satuan_kecil']; ?>" readonly>
        <small class="form-text text-muted">Harga Beli Satuan Kecil</small>
      </div>
    </div>
    <div class="row form-group">
      <div class="col col-md-3">
        <label for="hrg_1" class=" form-control-label">Harga Jual (Rawat Jalan)</label>
      </div>
      <div class="col-12 col-md-9">
        <input type="text" name="hrg_1" id="hrg_1" min="0" class="money form-control" placeholder="Rp.0" value="<?php echo @$obat['harga_1']; ?>">

      </div>
    </div>


    <div class="row form-group">
      <div class="col col-md-3">
        <label for="hrg_2" class=" form-control-label">Harga Jual (Kelas 3) </label>
      </div>
      <div class="col-12 col-md-9">
        <input type="text" name="hrg_2" id="hrg_2" class="money form-control" placeholder="Rp.0" value="<?php echo @$obat['harga_2']; ?>">

      </div>
    </div>


    <div class="row form-group">
      <div class="col col-md-3">
        <label for="hrg_3" class=" form-control-label">Harga Jual (Kelas 2)</label>
      </div>
      <div class="col-12 col-md-9">
        <input type="text" name="hrg_3" id="hrg_3" class="money form-control" placeholder="Rp.0" value="<?php echo @$obat['harga_3']; ?>">

      </div>
    </div>
    


    <div class="row form-group">
      <div class="col col-md-3">
        <label for="hrg_4" class=" form-control-label">Harga Jual (Kelas 1)</label>
      </div>
      <div class="col-12 col-md-9">
        <input type="text" name="hrg_4" id="hrg_4" class="money form-control" placeholder="Rp.0" value="<?php echo @$obat['harga_4']; ?>">

      </div>
    </div>
    <div class="row form-group">
      <div class="col col-md-3">
        <label for="hrg_5" class=" form-control-label">Harga Jual (VIP)</label>
      </div>
      <div class="col-12 col-md-9">
        <input type="text" name="hrg_5" id="hrg_5" class="money form-control" placeholder="Rp.0" value="<?php echo @$obat['harga_5']; ?>">

      </div>
    </div>
    <div class="row form-group" hidden>
      <div class="col col-md-3">
        <label for="hrg_5" class=" form-control-label">Harga Jual (Ozon)</label>
      </div>
      <div class="col-12 col-md-9">
        <input type="text" name="hrg_ozon" id="hrg_ozon" class="money form-control" placeholder="Rp.0" value="<?php echo @$obat['harga_ozon']; ?>">

      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>desain/assets/custom/obat.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>desain/dist/simple.money.format.js"></script>
<script type="text/javascript">
  $('.money').simpleMoneyFormat();
</script>