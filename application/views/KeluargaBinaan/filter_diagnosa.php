<div class="table-responsive table--no-card m-b-40">
  <table class="table table-borderless table-striped table-earning table-striped">
  <thead>
    <th>Kode Penyakit</th>
    <th>Nama Penyakit</th>
    <th>Tanggal Pemeriksaan</th>
  </thead>
  <tbody id="resep">
    <?php foreach ($data_penyakit as $data): ?>
      <tr>
        <td><?php echo $data->kodeicdx?>
        <td><?php echo $data->nama_penyakit?></td>
        <td><?php echo date("d-m-Y",strtotime($data->jam))?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
