<div class="col-12 text-center">
  <h2>Laporan Keluarga Binaan</h2>
</div>
<table class="col-12">
  <tr>
    <?php
    $dokter = $this->ModelKBinaan->getDokterPJ($iddokter);
    $nama_dokter = "Semua Dokter Penanggung Jawab";
    if ($dokter->num_rows() == 1) {
      $nama_dokter = $dokter->row_array()["nama"];
    } ?>
    <td width="20%">Dokter Penanggung Jawab </td><td>: <?php echo $nama_dokter ?></td>
  </tr>
  <tr>
    <td>Tanggal </td><td>: <?php echo date("M, Y", strtotime($tanggal)) ?></td>
  </tr>
</table>

<table class="table color-table table-hover table-striped ">
  <thead>
      <tr>
        <td>NO</td>
        <td>No. BPJS</td>
        <td>Nama Peserta</td>
        <td>Tanggal Lahir</td>
        <td>Jenis Kelamin</td>
        <td>No.Telp</td>
        <td>HT</td>
        <td>DM</td>
        <td>TDS</td>
        <td>TDD</td>
        <td>GDP</td>
        <td>Petugas PJ</td>
      </tr>
  </thead>
  <tbody>
    <?php $no=1; $jml_dm = 0; $jml_ht=0; $jml_dmht=0;
    foreach ($perawat as $data_perawat): ?>
      <?php foreach ($this->ModelKBinaan->getKeluarga(null, $data_perawat->idkb_perawat)->result() as $data_pasien):
        $riwayat = $this->ModelKBinaan->kunjunganAkhir($data_pasien->pasien_noRM)->row_array();
        $cek = $this->ModelKBinaan->getKunjungan($data_pasien->pasien_noRM, $tanggal); ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $data_pasien->noBPJS ?></td>
          <td><?php echo $data_pasien->namapasien ?></td>
          <td><?php echo date("d-m-Y", strtotime($data_pasien->tgl_lahir)); ?></td>
          <td><?php echo $data_pasien->jenis_kelamin ?></td>
          <td><?php echo $data_pasien->telepon ?></td>
          <td><?php if ($this->ModelKBinaan->get_riwayat_ht($data_pasien->pasien_noRM)->num_rows() > 0) {
            echo "<i class=\"fas fa-check\"></i>"; $jml_ht++;
          } ?></td>
          <td><?php if ($this->ModelKBinaan->get_riwayat_dm($data_pasien->pasien_noRM)->num_rows() > 0) {
            echo "<i class=\"fas fa-check\"></i>"; $jml_dm++;
          } ?></td>
          <td><?php echo $retVal = ($cek->num_rows() > 0) ? $riwayat['osiastole'] : "-" ; ?></td>
          <td><?php echo $retVal = ($cek->num_rows() > 0) ? $riwayat['odiastole'] : "-" ; ?></td>
          <td><?php echo $retVal = ($cek->num_rows() > 0) ? $riwayat['gl_puasa'] : "-" ; ?></td>
          <td><?php echo $data_perawat->nama ?></td>
        </tr>
      <?php endforeach; ?>
    <?php endforeach; ?>
  </tbody>

</table>
<table>
  <thead>
<tr>
  <th>Pasien DM </th><th>: <?php echo $jml_dm ?></th>
</tr>
<tr>
  <th>Pasien HT</th><th>: <?php echo $jml_ht ?></th>
</tr>
  </thead>
</table>
<br>
<br>
