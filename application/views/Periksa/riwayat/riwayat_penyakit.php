<div class="col-md-12 col-12 col-xl-12">
  <!-- Card Narrower -->
  <div class="card card-cascade narrower z-depth-1">
    <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
          <h4><a href="" class="white-text mx-3">Riwayat Penyakit Pasien</a></h4>

    </div>

    <!-- Card content -->
    <div class="card-body">

      <div class="table-responsive table--no-card m-b-40">
        <table class="table table-borderless table-striped table-earning table-striped">
        <thead>
          <th>Kode Penyakit</th>
          <th>Nama Penyakit</th>
          <th>Tanggal Pemeriksaan</th>
        </thead>
        <tbody id="resep">
          <?php $data_penyakit = @$this->ModelPeriksa->get_riwayat_penyakit(@$pasien['noRM']);?>
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

      </div>

    </div>
    <!-- Card Narrower -->

  </div>
