
<div class="table-responsive">
  <table class="table color-bordered-table info-bordered-table" style="color: #000;background-color: #fff;">
    <thead>
    <th>Kode Obat</th>
    <th>Nama Obat</th>
    <th>Jumlah</th>
    <th>Harga</th>
    <th>Total Harga</th>
    <th>Signa</th>
  </thead>
  <tbody id="resep">
      <?php $data_resep = $this->ModelPeriksa->get_resep(@$hasil_periksa['idperiksa']); ?>
    <?php foreach ($data_resep->result() as $data): ?>
      <tr>
        <td><?php echo $data->idobat?>
        <td><?php echo $data->nama_obat?></td>
        <td><?php echo $data->jumlah?></td>
        <td><?php echo $data->harga?></td>
        <td><?php echo $data->total_harga?></td>
        <td><?php echo $data->signa?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
