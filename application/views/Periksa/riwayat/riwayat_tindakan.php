<h6 class="title-1 m-b-25">DIAGNOSA PENYAKIT</h6>
<div class="table-responsive">
  <table class="table color-bordered-table info-bordered-table" style="color: #000;background-color: #fff;">
    <thead>
    <th width="15%" class="text-right">Kode ICDX</th>
    <th>Penyakit</th>
    <th width="27%">Status Penyakit</th>
  </thead>
  <tbody id="diagnosa">
    <?php foreach ($this->ModelPeriksa->get_diagnosa(@$hasil_periksa['idperiksa'])->result() as $data): ?>
      <tr>
        <td><?php echo $data->kodesakit ?></td>
        <td><?php echo $data->nama_penyakit ?></td>
        <td><?php echo $data->status_sakit ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>



<h6 class="title-1 m-b-25">TINDAKAN</h6>
<div class="table-responsive">
  <table class="table color-bordered-table info-bordered-table" style="color: #000;background-color: #fff;">
    <thead>
    <th>Jasa</th>
    <th>Harga</th>
  </thead>
  <tbody id="diagnosa">
    <?php foreach ($this->ModelPeriksa->get_tindakan(@$hasil_periksa['idperiksa'])->result() as $data): ?>
      <tr>
        <td><?php echo $data->jsmedis ?></td>
        <td><?php echo "Rp. ".number_format($data->harga,0,",",".") ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
