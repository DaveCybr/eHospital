<style>
.form-group{
  margin-bottom: 5px;
}
</style>
 <div class="card">
   <div class="card-body card-block">
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="kode_jasa" class=" form-control-label">Kode Jasa</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="kode_jasa" id="kode_jasa" class="form-control" placeholder="Kode Jasa" value="<?php echo @$jasa_pelayanan['kode_jasa']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="nama" class=" form-control-label">Nama Jasa Pelayanan</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Jasa Pelayanan" value="<?php echo @$jasa_pelayanan['nama']; ?>" required>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="nama" class=" form-control-label">Poli</label>
            </div>
            <div class="col-12 col-md-9">
              <select name="poli" id="pilih_jenis_pasien" class="mdb-select colorful-select dropdown-info sm-form">
                <!-- <option value="" disabled selected>Pilih</option> -->
                  <!-- <?php foreach ($tupel as $value): ?>
                    <option id="<?php echo $value->kode_tupel;?>" value="<?php echo $value->kode_tupel;?>" <?php if (@$jasa_pelayanan['tujuan_pelayanan_kode_tupel']==$value->kode_tupel) {
                      echo "selected";
                    }?>><?php echo $value->tujuan_pelayanan;?></option>
                  <?php endforeach; ?> -->
                  <option value="001">POLI UMUM</option>
                  <option value="002">POLI GIGI</option>
                  <option value="005">UGD</option>
                  <option value="ranap">RANAP</option>
              </select>
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="hrg_1" class=" form-control-label">Harga (Rawat jalan)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="hrg_1" id="hrg_1" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['hrg_1']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="hrg_2" class=" form-control-label">Harga (Kelas 3)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="hrg_2" id="hrg_2" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['hrg_2']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="hrg_3" class=" form-control-label">Harga (Kelas 2)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="hrg_3" id="hrg_3" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['hrg_3']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="hrg_4" class=" form-control-label">Harga (Kelas 1)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="hrg_4" id="hrg_4" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['hrg_4']; ?>">
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="hrg_2" class=" form-control-label">Harga (VIP)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="hrg_5" id="hrg_5" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['hrg_5']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_dokter_1" class=" form-control-label">Jasa Dokter (Rawat Jalan)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_dokter_1" id="jasa_dokter_1" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_dokter_1']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_dokter_2" class=" form-control-label">Jasa Dokter (Kelas 3)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_dokter_2" id="jasa_dokter_2" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_dokter_2']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_dokter_3" class=" form-control-label">Jasa Dokter (Kelas 2)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_dokter_3" id="jasa_dokter_3" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_dokter_3']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_dokter_4" class=" form-control-label">Jasa Dokter (Kelas 1)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_dokter_4" id="jasa_dokter_4" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_dokter_4']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_dokter_5" class=" form-control-label">Jasa Dokter (VIP)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_dokter_5" id="jasa_dokter_5" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_dokter_5']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_perawat_1" class=" form-control-label">Jasa Perawat (Rawat Jalan)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_perawat_1" id="jasa_perawat_1" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_perawat_1']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_perawat_2" class=" form-control-label">Jasa Perawat (Kelas 3)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_perawat_2" id="jasa_perawat_2" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_perawat_2']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_perawat_3" class=" form-control-label">Jasa Perawat (Kelas 2)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_perawat_3" id="jasa_perawat_3" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_perawat_3']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_perawat_4" class=" form-control-label">Jasa Perawat (Kelas 1)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_perawat_4" id="jasa_perawat_4" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_perawat_4']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_perawat_5" class=" form-control-label">Jasa Perawat (VIP)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_perawat_5" id="jasa_perawat_5" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_perawat_5']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_resepsionis_1" class=" form-control-label">Jasa Resepsionis (Rawat Jalan)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_resepsionis_1" id="jasa_resepsionis_1" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_resepsionis_1']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_resepsionis_2" class=" form-control-label">Jasa Resepsionis (Kelas 3)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_resepsionis_2" id="jasa_resepsionis_2" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_resepsionis_2']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_resepsionis_3" class=" form-control-label">Jasa Resepsionis (Kelas 2)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_resepsionis_3" id="jasa_resepsionis_3" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_resepsionis_3']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_resepsionis_4" class=" form-control-label">Jasa Resepsionis (Kelas 1)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_resepsionis_4" id="jasa_resepsionis_4" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_resepsionis_4']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_resepsionis_5" class=" form-control-label">Jasa Resepsionis (VIP)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_resepsionis_5" id="jasa_resepsionis_5" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_resepsionis_5']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_analis_1" class=" form-control-label">Jasa Analis (Rawat Jalan)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_analis_1" id="jasa_analis_1" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_analis_1']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_analis_2" class=" form-control-label">Jasa Analis (Kelas 3)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_analis_2" id="jasa_analis_2" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_analis_2']; ?>"  >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_analis_3" class=" form-control-label">Jasa Analis (Kelas 2)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_analis_3" id="jasa_analis_3" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_analis_3']; ?>"  >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_analis_4" class=" form-control-label">Jasa Analis (Kelas 1)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_analis_4" id="jasa_analis_4" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_analis_4']; ?>"  >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_analis_5" class=" form-control-label">Jasa Analis (VIP)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_analis_5" id="jasa_analis_5" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_analis_5']; ?>"  >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_admin_1" class=" form-control-label">Jasa Admin (Rawat Jalan)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_admin_1" id="jasa_admin_1" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_admin_1']; ?>"  >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_admin_2" class=" form-control-label">Jasa Admin (Kelas 3)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_admin_2" id="jasa_admin_2" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_admin_2']; ?>"  >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_admin_3" class=" form-control-label">Jasa Admin (Kelas 2)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_admin_3" id="jasa_admin_3" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_admin_3']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_admin_4" class=" form-control-label">Jasa Admin (Kelas 1)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_admin_4" id="jasa_admin_4" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_admin_4']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_ob_1" class=" form-control-label">Jasa OB (Rawat Jalan)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_ob_1" id="jasa_ob_1" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_ob_1']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_ob_2" class=" form-control-label">Jasa OB (Kelas 3)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_ob_2" id="jasa_ob_2" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_ob_2']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_ob_3" class=" form-control-label">Jasa OB (Kelas 2)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_ob_3" id="jasa_ob_3" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_ob_3']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_ob_4" class=" form-control-label">Jasa OB (Kelas 1)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_ob_4" id="jasa_ob_4" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_ob_4']; ?>" >
            </div>
    </div>
    <div class="row form-group">
            <div class="col col-md-3">
              <label for="jasa_ob_5" class=" form-control-label">Jasa OB (VIP)</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="number" name="jasa_ob_5" id="jasa_ob_5" class="form-control" placeholder="Rp.0" value="<?php echo @$jasa_pelayanan['jasa_ob_5']; ?>" >
            </div>
    </div>

  </div>
</div>
