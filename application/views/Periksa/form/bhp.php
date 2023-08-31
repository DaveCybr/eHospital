<h2 class="title-1 m-b-25">PEMAKAIAN OBAT</h2>
<div class="table-responsive table--no-card m-b-40">
  <table class="table table-borderless table-striped table-earning">
  <thead>
    <th>Kode Obat</th>
    <th>Nama Obat</th>
    <th>Jumlah</th>
    <!-- <th>Harga</th>
    <th>Total Harga</th> -->
    <!-- <th>No Batch</th> -->
  </thead>
  <tbody id="resep">
      <?php $data_resep = $this->ModelPeriksa->get_bhp(@$periksa['idperiksa']); ?>
    <?php foreach ($data_resep->result() as $data): ?>
      <tr>
        <td><?php echo $data->idobat?>
        <td><?php echo $data->nama_obat?></td>
        <td><?php echo $data->jumlah?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
