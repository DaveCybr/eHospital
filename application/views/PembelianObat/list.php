<?php echo form_open('PembelianObat/delete'); ?>

<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <div>
          <button type="button" class="btn btn_hapus btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data"><i class="fas fa-trash-alt mt-0"></i></button>
          <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jumlah Item Terpilih"><span id="jumlah_pilih">0</span></button>
        </div>
        <a href="" class="white-text mx-3">Pembelian Obat</a>
        <div>
          <a href="<?php base_url(); ?>PembelianObat/input" class="float-right">
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data Baru"><i class="fas fa-pencil-alt mt-0"></i></button>
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-hover table-striped table-bordered ">
            <thead>
              <tr>
                <th width="10%">
                  <input type="checkbox" class="form-check-input select-all" id="tableMaterialChec">
                  <label class="form-check-label" for="tableMaterialChec"></label>
                </th>
                <th>No Nota</th>
                <th>No Nota Supllier</th>
                <th style="text-align:right;">Tanggal Masuk</th>
                <th>Supplier</th>
                <th style="text-align:right;">Total</th>
                <th style="text-align:right;">Bayar</th>
                <th style="text-align:right;">Sisa</th>
                <th>Status</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($pembelian_obat as $data) { ?>
                <?php $id_check = $data->no_nota; ?>
                <tr>
                  <td>
                    <input type="checkbox" class="form-check-input id_checkbox" id="tableMaterialCheck<?php echo $id_check ?>" name="id[]" value="<?php echo $id_check ?>">
                    <label class="form-check-label" for="tableMaterialCheck<?php echo $id_check ?>"></label>
                  </td>
                  <td><?php echo $data->no_nota ?></td>
                  <td><?php echo $data->no_nota_supplier ?></td>
                  <td style="text-align:right;"><?php echo date("d-m-Y", strtotime($data->tanggal_masuk)) ?></td>
                  <td><?php echo $data->nama ?></td>
                  <td style="text-align:right;"><?php echo "Rp." . number_format($data->total_bayar, 2, ",", "."); ?></td>
                  <td style="text-align:right;"><?php echo "Rp." . number_format($data->bayar, 2, ",", "."); ?></td>
                  <td style="text-align:right;"><?php echo "Rp." . number_format($data->sisa, 2, ",", "."); ?></td>
                  <td><?php echo $data->status ?></td>
                  <td>
                    <!-- <a href="<?php base_url() ?>/PembelianObat/edit/<?php echo $data->no_nota; ?>">
                        <button type="button" class="btn btn-warning btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                          <i class="fa fa-edit"></i>
                        </button>
                        </a> -->
                    <a href="#" data-toggle="modal" data-target="#smallmodal">
                      <button id="<?php echo $id_check; ?>" type="button" class="detail_nota btn btn-primary btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Nota">
                        <i class="fa fa-eye"></i>
                      </button>
                    </a>
                    <!-- <a href="<?php echo base_url() . "PembelianObat/edit/" . $id_check ?>">
                        <button type="button" class="btn btn-warning btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Nota Pembelian">
                          <i class="fa fa-edit"></i>
                        </button>
                        </a> -->
                  </td>
                </tr>
              <?php
                $no++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="alert"><?php echo $this->Core->Hapus_disable(); ?></div>
<div id="modal"><?php echo $this->Core->Hapus_aktif(); ?></div>
<?php echo form_close(); ?>
<?php $this->load->view($form_dialog) ?>
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

    $(document).on('click', '.detail_nota', function() {
      var data_detail = {
        'no_nota': $(this).attr('id'),
      };
      myajax_request(base_url + "PembelianObat/get_detail", data_detail, function(res) {
        // console.log(res);
        var tes = "";
        for (var i = 0; i < res.length; i++) {
          tes += "<tr>" +
            "<td>" + res[i].idobat + "</td>" +
            "<td>" + res[i].nama_obat + "</td>" +
            // "<td>"+res[i].no_batch+"</td>" +
            "<td></td>" +
            "<td>" + res[i].tanggal_expired + "</td>" +
            "<td>Rp." + addCommas(res[i].hrg_beli) + "</td>" +
            "<td>" + res[i].jumlah + "</td>" +
            "<td>" + res[i].diskon + "%</td>" +
            "<td>" + res[i].ppn + "%</td>" +
            "<td>Rp." + addCommas(res[i].total_harga) + "</td>" +
            "</tr>";

        }
        $("#no_nota").html(res[0].no_nota);
        $("#no_nota_s").html(res[0].no_nota_supplier);
        $("#tgl_transaksi").html(res[0].tanggal_masuk);
        $("#j_tempo").html(res[0].tanggal_jatuh_tempo);
        $("#supplier").html(res[0].nama);
        $(".sts").html(res[0].status);
        $("#t_disk").html(res[0].total_diskon + "%");
        $("#t_ppn").html(res[0].total_ppn + "%");
        $("#t_harga").html("Rp." + addCommas(res[0].total_transaksi));
        $("#bayar_final").html("Rp." + addCommas(res[0].total_bayar));
        $("#bayar").html("Rp." + addCommas(res[0].bayar));
        $("#sisa").html("Rp." + addCommas(res[0].sisa));
        $("#obat").html(tes);
      });
    });

    function addCommas(nStr) {
      nStr += '';
      x = nStr.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
    }
  });
</script>