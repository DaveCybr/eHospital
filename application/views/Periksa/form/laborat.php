<h2 class="title-1 m-b-25">PERMINTAAN LABORAT</h2>
<div class="table-responsive table--no-card m-b-40">
  <table class="table table-borderless table-striped table-earning">
  <thead>
    <th width="15%" class="text-right">Kode Lab</th>
    <th>Jenis Lab</th>
    <th>Nilai Normal</th>
    <th>Hasil</th>
  </thead>
  <tbody id="diagnosa">
    <?php foreach ($this->ModelPeriksa->get_lab(@$periksa['idperiksa'])->result() as $data): ?>
      <tr>
        <td><?php echo $data->kodelab ?></td>
        <td><?php echo $data->nama?></td>
        <td><?php echo $data->nilainormal?></td>
        <td><?php echo $data->hasil?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
