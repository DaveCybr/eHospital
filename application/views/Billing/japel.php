<?php foreach ($this->ModelBilling->japel($id)->result() as $value): ?>
  <tr>
    <td>
      <?php echo $value->jsmedis ?>
    </td>
    <td>Biaya :</td>
  </tr>
  <tr>
    <td> Jasa Pelayanan Dokter</td>
    <td>
      <?php echo $value->japel_dokter ?>
    </td>
  </tr>
<?php endforeach; ?>
