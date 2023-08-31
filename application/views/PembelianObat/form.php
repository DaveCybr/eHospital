<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
      <div class="col-md-6">
        <div class="row form-group">
          <div class="col-md-3">
            <label for="no_nota_supplier" class=" form-control-label">No Nota Supplier</label>
          </div>
          <div class="col-md-9">
            <input type="text" required name="no_nota_supplier" id="no_nota_supplier" class="form-control" placeholder="xxxxxxxxx" value="<?php echo @$pembelian_obat['no_nota_supplier']; ?>">
          </div>
        </div>
        <div class="row form-group">
          <div class="col-md-3">
            <label for="supplier" class=" form-control-label">Supplier</label>
          </div>
          <div class="col-md-6">
            <!-- <select name="supplier" id="supplier" class="mdb-select colorful-select dropdown-info sm-form" required>
                      <option disabled selected>Pilih Supplier</option>
                      <?php foreach ($supplier as $value) : ?>
                        <option value="<?php echo $value->kode_sup; ?>" id="<?php echo $value->kode_sup; ?>"><?php echo @$value->nama; ?></option>
                      <?php endforeach; ?>
                  </select> -->
            <input type="text" id="nama_sup" class="form-control" placeholder="Nama Supplier" readonly required>
            <input type="text" name="supplier" id="supplier" class="form-control" hidden required>
          </div>
          <div class="col-md-2">
            <a href="#" data-toggle="modal" data-target="#scrollmodal_sup"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="Tambahkan Supplier" id="tambahkan_sup"><i class="fa fa-user"></i> Tambah Supplier</button></a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row form-group">
          <div class="col-md-3">
            <label for="tanggal_masuk" class=" form-control-label">Tanggal Masuk</label>
          </div>
          <div class="col-md-9">
            <input type="date" required name="tanggal_masuk" id="tanggal_masuk" class="tanggal_new2 form-control" value="<?php echo @$pembelian_obat['tanggal_masuk'] ?>" required>
          </div>
        </div>

        <div class="row form-group">
          <div class="col-md-3">
            <label for="jatuh_tempo" class=" form-control-label">Jatuh Tempo</label>
          </div>
          <div class="col-md-9">
            <input type="date" required name="jatuh_tempo" id="jatuh_tempo" class="tanggal_new form-control" value="<?php echo @$pembelian_obat['jatuh_tempo'] ?>" required>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
      <div class="col-md-9">
        <a href="#" data-toggle="modal" data-target="#scrollmodal"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="2. Tambahkan list obat yang sudah dibeli" id="tambahkan"><i class="fa fa-plus"></i> Input Obat</button></a>
      </div>
      <div class="col-md-12" style="margin-top:20px;">

        <div class="table-responsive">
          <table id="list_pembelian_obat" class="table editable-table table-bordered table-striped m-b-0">
            <thead>
              <tr>
                <th>Kode Obat / Nama Obat</th>
                <th style="min-width:200px">No Batch</th>
                <th>Expired Date</th>
                <th style="min-width:100px">Satuan</th>
                <th style="min-width:200px;">Harga Beli</th>
                <th style="min-width:200px;">Jumlah</th>
                <th style="min-width:200px;">Diskon (%)</th>
                <th style="min-width:200px;">PPN (%)</th>
                <th>Total Harga</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="obat">
              <!-- <input type="hidden" id="tot_diskon" value="" name="tot_diskon">
                  <input type="hidden" id="tot_ppn" value="" name="tot_ppn"> -->
              <input type="hidden" id="tot_harga" value="" name="tot_harga">
              <input type="hidden" class="bayar_final" value="" name="bayar_final">
              <input type="hidden" class="sisa" value="" name="sisa">
            </tbody>
            <tfoot>
              <tr>
                <th colspan="6"><strong>TOTAL</strong></th>
                <!-- <th id="t_disk">Rp.0</th>
                        <th id="t_ppn">Rp.0</th>
                        <th id="t_harga">Rp.0</th> -->
                <th><input type="number" id="tot_diskon" min="0" value="0" name="tot_diskon" class="form-control"></th>
                <th><input type="number" id="tot_ppn" min="0" value="0" name="tot_ppn" class="form-control"></th>
                <th id="t_harga" style="text-align:right;">Rp.0</th>
                <th></th>
              </tr>
              <tr>
                <th colspan="6"><strong>TOTAL YANG HARUS DIBAYAR (TOTAL HARGA+PPN %) - DISKON %</strong></th>
                <th colspan="3" id="bayar_final" style="text-align:right;">Rp.0</th>
                <th></th>
              </tr>
              <tr>
                <th colspan="6"><strong>BAYAR</strong></th>
                <th colspan="3" id="bayar"><input style="direction: rtl;" type="text" min="0" class="money bayar form-control" name="bayar" required></th>
                <th></th>
              </tr>
              <tr>
                <th colspan="6"><strong>SISA</strong></th>
                <th colspan="3" id="sisa" style="text-align:right;">Rp.0</th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- END DATA TABLE-->
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>desain/dist/simple.money.format.js"></script>
<script type="text/javascript">
  $('.money').simpleMoneyFormat();
</script>

<script src="<?php echo base_url(); ?>desain/assets/custom/pengadaanobat.js"></script>
<script>
  $(function() {
    var base_url = '<?php echo base_url() ?>';

    function myajax_request(url, data, callback) {
      $.ajax({
        type: 'POST',
        url: url,
        async: false,
        dataType: 'json',
        data: data,
        success: function(response) {
          callback(response);
        }
      })
    }
    $('.tanggal_new').pickadate({
      // min: new Date(2015,3,20),
      format: 'dd-mm-yyyy',
      formatSubmit: 'yyyy-mm-dd',
      min: true
    })
    $('.tanggal_new2').pickadate({
      // min: new Date(2015,3,20),
      format: 'dd-mm-yyyy',
      formatSubmit: 'yyyy-mm-dd',
      max: true
    })

    $(document).on('click', '.hapus_detail', function() {
      var data_detail = {
        'id': $(this).attr('id'),
      };
      var index_row = $(this);
      myajax_request(base_url + "PembelianObat/hapus_detail", data_detail, function(res) {
        if (res.success) {
          deleteRowLab(index_row);
        }
      });
    });

    $(document).on("change", "#search_obat", function() {
      var data = {
        'id_obat': $("#search_obat option:selected").val()
      };
      myajax_request(base_url + "PembelianObat/get_satuan", data, function(respone) {
        var mark = ""
        if (respone.length > 0) {
          for (var i = 0; i < respone.length; i++) {
            mark += '<option value ="' + respone[i].harga_satuan + '" nama_satuan="' + respone[i].label + '">' + respone[i].satuan + '</option>'
          }
          $("#hrg_bl").val(respone[0].harga_satuan);
        } else {
          mark += '<option value="">-- Satuan Obat --</option>';
          $("#hrg_bl").val(0);
        }
        $("#satuan_obat").html(mark);

      });
    });
  });
</script>