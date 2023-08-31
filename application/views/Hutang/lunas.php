<?php if ($lunas == '' || $lunas == null): ?>
  <br>
  <br>
  <h2 style="text-align:center">Data Tidak Ada</h2>
<?php else: ?>
<table id="tabel_sudah_lunas" class="table table-striped table-bordered ">
  <thead>
    <tr>
      <th>No</th>
      <th>No Nota</th>
      <th>Supplier</th>
      <th>Tanggal Pembelian</th>
      <th>Tanggal Jatuh Tempo</th>
      <th>Total Transaksi</th>
      <th>Bayar</th>
      <th>Total Hutang</th>
      <th>Status</th>
      <th width="%5">opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; foreach ($lunas as $data):
      ?>
      <td><?php echo $no; ?></td>
      <td><?php echo $data->no_nota; ?></td>
      <td><?php echo $data->nama; ?></td>
      <td><?php echo date("d-m-Y", strtotime($data->tanggal)); ?></td>
      <td><?php echo date("d-m-Y", strtotime($data->tanggal_jatuh_tempo)); ?></td>
      <td><?php echo "Rp.".number_format($data->total_bayar,2,",","."); ?></td>
      <td><?php echo "Rp.".number_format($data->bayar,2,",","."); ?></td>
      <!-- <td><?php echo "Rp.".number_format($data->sisa,2,",","."); ?></td> -->
      <td><?php echo "Rp.".number_format($data->total_hutang,2,",","."); ?></td>
      <td><?php echo $data->status?></td>
      <td>
        <a href="#" data-toggle="modal" data-target="#smallmodal">
          <button id="<?php echo $data->no_nota?>" type="button" class="detail_pembelian btn btn-primary btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Pembelian">
            <i class="fa fa-eye"></i>
          </button>
        </a>
      </td>
    </tr>
    <?php $no++;  endforeach; ?>
  </tbody>
</table>


<div class="data_lunas" id="DivIdToPrint" style="width:100%;" hidden>
  <h1 align="center" class="m-0">SIMTERIK</h1>
  <!-- <h4 align="center"> <?php echo $this->Core->alamat_klinik()?></h4> -->
  <br>
  <br>
  <div class="col-12 text-center">
    <h2>Data Lunas</h2>
  </div>
  <br>
  <br>
  <table id="tabel_sudah_lunas" class="table table-striped table-bordered ">
    <thead>
      <tr>
        <th>No</th>
        <th>No Nota</th>
        <th>Supplier</th>
        <th>Tanggal Pembelian</th>
        <th>Tanggal Jatuh Tempo</th>
        <th>Total Transaksi</th>
        <th>Bayar</th>
        <th>Total Hutang</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($lunas as $data):
        ?>
        <td><?php echo $no; ?></td>
        <td><?php echo $data->no_nota; ?></td>
        <td><?php echo $data->nama; ?></td>
        <td><?php echo date("d-m-Y", strtotime($data->tanggal)); ?></td>
        <td><?php echo date("d-m-Y", strtotime($data->tanggal_jatuh_tempo)); ?></td>
        <td><?php echo "Rp.".number_format($data->total_bayar,2,",","."); ?></td>
        <td><?php echo "Rp.".number_format($data->bayar,2,",","."); ?></td>
        <td><?php echo "Rp.".number_format($data->total_hutang,2,",","."); ?></td>
        <td><?php echo $data->status?></td>
      </tr>
      <?php $no++;  endforeach; ?>
    </tbody>
  </table>
</div>
<?php endif; ?>
