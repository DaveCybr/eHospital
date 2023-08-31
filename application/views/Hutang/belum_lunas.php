
<?php if ($hutang == '' || $hutang == null): ?>
  <br>
  <br>
  <h2 style="text-align:center">Data Tidak Ada</h2>
<?php else: ?>
  <table id="myTable" class="table table-striped table-bordered ">
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
        <th width="%5">opsi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($hutang as $data_hutang):
        ?>
        <td><?php echo $no; ?></td>
        <td><?php echo $data_hutang->no_nota; ?></td>
        <td><?php echo $data_hutang->nama; ?></td>
        <td><?php echo date("d-m-Y", strtotime($data_hutang->tanggal)); ?></td>
        <td><?php echo date("d-m-Y", strtotime($data_hutang->tanggal_jatuh_tempo)); ?></td>
        <td><?php echo "Rp.".number_format($data_hutang->total_bayar,2,",","."); ?></td>
        <td><?php echo "Rp.".number_format($data_hutang->bayar,2,",","."); ?></td>
        <!-- <td><?php echo "Rp.".number_format($data_hutang->sisa,2,",","."); ?></td> -->
        <td><?php echo "Rp.".number_format($data_hutang->total_hutang,2,",","."); ?></td>
        <td>
          <a href="#" data-toggle="modal" data-target="#smallmodal">
            <button id="<?php echo $data_hutang->no_nota?>" type="button" class="detail_pembelian btn btn-primary btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Pembelian">
              <i class="fa fa-eye"></i>
            </button>
          </a>
          <?php if ($data_hutang->status == 'Belum Lunas'): ?>
            <a href="<?php echo base_url()."Hutang/lunasi/".$data_hutang->no_nota;?>" >
              <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lunasi Hutang Ini">
                <i class="fa fa-money-bill"> Lunas</i>
              </button>
            </a>
          <?php endif; ?>
        </td>
      </tr>
      <?php $no++;  endforeach; ?>
    </tbody>
  </table>

  <div class="printableArea" id="DivIdToPrint" style="width:100%;" hidden>
    <h1 align="center" class="m-0">SIMTERIK</h1>
    <!-- <h4 align="center"> <?php echo $this->Core->alamat_klinik()?></h4> -->
    <br>
    <br>
    <div class="col-12 text-center">
      <h2>Hutang Belum Lunas</h2>
    </div>
    <br>
    <br>
    <table id="myTable" class="table table-striped table-bordered " >
      <thead>
        <tr><th></th>
          <th>No Nota</th>
          <th>Supplier</th>
          <th>Tanggal Pembelian</th>
          <th>Tanggal Jatuh Tempo</th>
          <th>Total Transaksi</th>
          <th>Bayar</th>
          <th>Total Hutang</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; foreach ($hutang as $data_hutang):?>
          <td><?php echo $no; ?></td>
          <td><?php echo $data_hutang->no_nota; ?></td>
          <td><?php echo $data_hutang->nama; ?></td>
          <td><?php echo date("d-m-Y", strtotime($data_hutang->tanggal)); ?></td>
          <td><?php echo date("d-m-Y", strtotime($data_hutang->tanggal_jatuh_tempo)); ?></td>
          <td><?php echo "Rp.".number_format($data_hutang->total_bayar,2,",","."); ?></td>
          <td><?php echo "Rp.".number_format($data_hutang->bayar,2,",","."); ?></td>
          <!-- <td><?php echo "Rp.".number_format($data_hutang->sisa,2,",","."); ?></td> -->
          <td><?php echo "Rp.".number_format($data_hutang->total_hutang,2,",","."); ?></td>
        </tr>
        <?php $no++;  endforeach; ?>
      </tbody>
    </table>
  </div>

<?php endif; ?>
