<style>
.form-group{
  margin-bottom: 5px;
}
</style>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Nama</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="text" name="nama" id="nama" class="form-control" placeholder="nama" value="<?php echo @$pegawai['nama']; ?>" required>
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="status_karyawan" class=" form-control-label">Status Karyawan</label>
      </div>
      <div class="col-12 col-md-9">
        <select name="status_karyawan" id="select" class="form-control" required>
          <option>...Pilih Pegawai...</option>
          <option value="1" <?php if (@$pegawai['status_karyawan'] == 1) {echo "selected";} ?> >aktif</option>
          <option value="0" <?php if (@$pegawai['status_karyawan'] == 0) {echo "selected";} ?>>non-aktif</option>
        </select>
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="jabatan" class=" form-control-label">Jabatan</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="jabatan" value="<?php echo @$pegawai['jabatan']; ?>" required>
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="tgl_lahir" class=" form-control-label">Tanggal Lahir</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" value = "<?php echo @$pegawai['tgl_lahir'];?>" required>
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="alamat" class=" form-control-label">Alamat</label>
      </div>
      <div class="col-12 col-md-9">
          <textarea name="alamat" id="alamat" class="form-control" placeholder="alamat" rows="8" cols="80" required><?php echo @$pegawai['alamat'] ?></textarea>
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="kota" class=" form-control-label">Kota</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="text" name="kota" id="kota" class="form-control" placeholder="kota "value="<?php echo @$pegawai['kota'] ?>" required>
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="telepon" class=" form-control-label">Telepon</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="telepon" id="telepon" class="form-control" placeholder="telepon "value="<?php echo @$pegawai['telepon'] ?>" required>
      </div>
</div>

<div class="row form-group">
  <div class="col-6">
    <div class="form-group">
      <label for="tgl_masuk" class="form-control-label">Tanggal Masuk</label>
      <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control" placeholder="Tanggal Masuk" value="<?php echo @$pegawai['tgl_masuk'] ?>" required>
    </div>
  </div>
  <div class="col-6">
    <div class="form-group">
      <label for="tgl_keluar" class="form-control-label">Tanggal Keluar</label>
      <input type="date" name="tgl_keluar" id="tgl_keluar" class="form-control"  value="<?php echo @$pegawai['tgl_keluar'] ?>">
    </div>
  </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
        <label for="gapok" class=" form-control-label">Gaji Pokok</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="gapok" id="gapok" value="1000" min="0" step="0.01" data-number-to-fixed="2" class="form-control" placeholder="gaji pokok"value="<?php echo @$pegawai['gapok'] ?>" required>
      </div>
</div>

<div class="row form-group">
      <div class="col col-md-3">
          <label for="uang_makan" class=" form-control-label">Uang Makan</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="uang_makan" id="uang_makan" class="form-control" placeholder="uang makan" value="<?php echo @$pegawai['uang_makan'] ?>">
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
          <label for="uang_bensin" class=" form-control-label">Uang Bensin</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="uang_bensin" id="uang_bensin" class="form-control "placeholder="uang bensin" value="<?php echo @$pegawai['uang_bensin'] ?>">
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
          <label for="tunjangan_keluarga" class=" form-control-label">Tunjangan Keluarga</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="tunjangan_keluarga" id="tunjangan_keluarga" class="form-control" placeholder="tunjangan keluarga"value="<?php echo @$pegawai['tunjangan_keluarga'] ?>">
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
          <label for="tunjangan_profesi" class=" form-control-label">Tunjangan Profesi</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="tunjangan_profesi" id="tunjangan_profesi" class="form-control" placeholder="tunjangan profesi" value="<?php echo @$pegawai['tunjangan_profesi'] ?>" >
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
          <label for="tunjangan_jabatan" class=" form-control-label">Tunjangan Jabatan</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="tunjangan_jabatan" id="tunjangan_jabatan" class="form-control" placeholder="tunjangan jabatan"value="<?php echo @$pegawai['tunjangan_jabatan'] ?>">
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
          <label for="tunjangan_bpjstk" class=" form-control-label">Tunjangan BPJS Kesehatan</label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="tunjangan_bpjskes" id="tunjangan_bpjskes" class="form-control" placeholder="tunjangan BPJS Kesehatan" value="<?php echo @$pegawai['tunjangan_bpjskes'] ?>">
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
          <label for="tunjangan_bpjstk" class=" form-control-label">Tunjangan BPJS Ketenagakerjaan </label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="tunjangan_bpjstk" id="tunjangan_bpjstk" class="form-control" placeholder="tunjangan BPJS Ketenagakerjaan" value="<?php echo @$pegawai['tunjangan_bpjstk'] ?>">
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
          <label for="potongan_bpjskes" class=" form-control-label">Potongan BPJS Kesehatan </label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="potongan_bpjskes" id="potongan_bpjskes" class="form-control" placeholder="tunjangan BPJS Kesehatan" value="<?php echo @$pegawai['potongan_bpjskes'] ?>">
      </div>
</div>
<div class="row form-group">
      <div class="col col-md-3">
          <label for="potongan_bpjstk" class=" form-control-label">Potongan BPJS Ketenagakerjaan </label>
      </div>
      <div class="col-12 col-md-9">
          <input type="number" name="potongan_bpjstk" id="potongan_bpjstk" class="form-control" placeholder="tunjangan BPJS Ketenagakerjaan" value="<?php echo @$pegawai['potongan_bpjstk'] ?>">
      </div>
</div>
</div>
</div>
