

    <div class="row form-group">
            <div class="col col-md-3">
              <label for="nama" class=" form-control-label">Nama Kelompok</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="nama_kelompok" id="nama_kelompok" class="form-control" placeholder="Nama Kelompok" value="<?php echo @$laborat['nama_kelompok']; ?>">
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="nama" class=" form-control-label">Jenis Lab</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="jenis_lab" id="jenis_lab" class="form-control" placeholder="Jenis Lab" value="<?php echo @$laborat['jenis_lab']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="nama" class=" form-control-label">Nilai Normal</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="nilai_normal" id="nilai_normal" class="form-control" placeholder="Nilai Normal" value="<?php echo @$laborat['nilai_normal']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="hrg_1" class=" form-control-label">BPJS</label>
            </div>
            <div class="col-12 col-md-9">
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="lama" name="bpjs" value="1" <?php if (@$laborat['bpjs']=='1') {
                  echo "checked";
          }?> required>
                <label class="custom-control-label" for="lama">Lama</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="baru" name="bpjs" value="0" <?php if (@$laborat['bpjs']=='0') {
                  echo "checked";
          }?> required>
                <label class="custom-control-label" for="baru">Baru</label>
              </div>

            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="hrg_1" class=" form-control-label">Harga (Rawat Jalan)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="hrg_1" id="hrg_1" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['hrg_1']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="hrg_2" class=" form-control-label">Harga (Kelas 3)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="hrg_2" id="hrg_2" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['hrg_2']; ?>">
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="hrg_3" class=" form-control-label">Harga (Kelas 2)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="hrg_3" id="hrg_3" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['hrg_3']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="hrg_4" class=" form-control-label">Harga (Kelas 1)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="hrg_4" id="hrg_4" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['hrg_4']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="hrg_2" class=" form-control-label">Harga (VIP)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="hrg_5" id="hrg_5" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['hrg_5']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_dokter_1" class=" form-control-label">Jasa Dokter (Rawat Jalan)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_dokter_1" id="jasa_dokter_1" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_dokter_1']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_dokter_2" class=" form-control-label">Jasa Dokter (Kelas 3)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_dokter_2" id="jasa_dokter_2" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_dokter_2']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_dokter_3" class=" form-control-label">Jasa Dokter (Kelas 2)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_dokter_3" id="jasa_dokter_3" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_dokter_3']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_dokter_4" class=" form-control-label">Jasa Dokter (Kelas 1)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_dokter_4" id="jasa_dokter_4" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_dokter_4']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_dokter_5" class=" form-control-label">Jasa Dokter (VIP)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_dokter_5" id="jasa_dokter_5" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_dokter_5']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_perawat_1" class=" form-control-label">Jasa Perawat (Rawat Jalan)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_perawat_1" id="jasa_perawat_1" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_perawat_1']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_perawat_2" class=" form-control-label">Jasa Perawat (Kelas 3)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_perawat_2" id="jasa_perawat_2" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_perawat_2']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_perawat_3" class=" form-control-label">Jasa Perawat (Kelas 2)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_perawat_3" id="jasa_perawat_3" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_perawat_3']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_perawat_4" class=" form-control-label">Jasa Perawat (Kelas 1)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_perawat_4" id="jasa_perawat_4" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_perawat_4']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_perawat_5" class=" form-control-label">Jasa Perawat (VIP)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_perawat_5" id="jasa_perawat_5" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_perawat_5']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_resepsionis_1" class=" form-control-label">Jasa Resepsionis (Rawat Jalan)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_resepsionis_1" id="jasa_resepsionis_1" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_resepsionis_1']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_resepsionis_2" class=" form-control-label">Jasa Resepsionis (Kelas 3)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_resepsionis_2" id="jasa_resepsionis_2" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_resepsionis_2']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_resepsionis_3" class=" form-control-label">Jasa Resepsionis (Kelas 2)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_resepsionis_3" id="jasa_resepsionis_3" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_resepsionis_3']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_resepsionis_4" class=" form-control-label">Jasa Resepsionis (Kelas 1)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_resepsionis_4" id="jasa_resepsionis_4" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_resepsionis_4']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_resepsionis_5" class=" form-control-label">Jasa Resepsionis (VIP)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_resepsionis_5" id="jasa_resepsionis_5" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_resepsionis_5']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_analis_1" class=" form-control-label">Jasa Analis (Rawat Jalan)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_analis_1" id="jasa_analis_1" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_analis_1']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_analis_2" class=" form-control-label">Jasa Analis (Kelas 3)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_analis_2" id="jasa_analis_2" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_analis_2']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_analis_3" class=" form-control-label">Jasa Analis (Kelas 2)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_analis_3" id="jasa_analis_3" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_analis_3']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_analis_4" class=" form-control-label">Jasa Analis (Kelas 1)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_analis_4" id="jasa_analis_4" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_analis_4']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_analis_5" class=" form-control-label">Jasa Analis (VIP)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_analis_5" id="jasa_analis_5" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_analis_5']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_admin_1" class=" form-control-label">Jasa Admin (Rawat Jalan)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_admin_1" id="jasa_admin_1" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_admin_1']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_admin_2" class=" form-control-label">Jasa Admin (Kelas 3)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_admin_2" id="jasa_admin_2" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_admin_2']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_admin_3" class=" form-control-label">Jasa Admin (Kelas 2)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_admin_3" id="jasa_admin_3" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_admin_3']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_admin_4" class=" form-control-label">Jasa Admin (Kelas 1)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_admin_4" id="jasa_admin_4" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_admin_4']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_ob_1" class=" form-control-label">Jasa OB (Rawat Jalan)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_ob_1" id="jasa_ob_1" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_ob_1']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_ob_2" class=" form-control-label">Jasa OB (Kelas 3)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_ob_2" id="jasa_ob_2" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_ob_2']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_ob_3" class=" form-control-label">Jasa OB (Kelas 2)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_ob_3" id="jasa_ob_3" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_ob_3']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_ob_4" class=" form-control-label">Jasa OB (Kelas 1)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_ob_4" id="jasa_ob_4" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_ob_4']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_ob_5" class=" form-control-label">Jasa OB (VIP)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_ob_5" id="jasa_ob_5" class="form-control" placeholder="Rp.0" value="<?php echo @$laborat['jasa_ob_5']; ?>" >
            </div>
    </div>

  </div>
</div>
