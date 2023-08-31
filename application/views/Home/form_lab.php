<div class="table-responsive">
  <table id="table_sajian" class="table table-striped table-bordered ">
  <thead>
      <tr>
          <th>POLI</th>
          <th width="50%">Jumlah Kunjungan belum dianlisa</th>
      </tr>
  </thead>
  <tbody id="sajian">
      <?php
      $data_poli = array(
        'OZO' => 'POLI OZON',
        'UMU' => 'POLI UMUM',
        'GIG' => 'POLI GIGI',
      	'OBG' => 'POLI OBSGYN',
      	'INT'	=> 'POLI INTERNIS',
      	'IGD'	=> 'IGD',
        'RANAP' => "RAWAT INAP"

      );

      foreach ($daftar as $value): ?>
        <tr>
            <th><?php echo $data_poli[$value->unit_layanan]?></th>
            <th><?php echo $value->jumlah?></th>
        </tr>
      <?php endforeach; ?>
  </tbody>

  </table>
</div>
