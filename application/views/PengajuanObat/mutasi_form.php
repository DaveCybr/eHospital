<div class="row">
    <div class="col-md-2">
        <div class="form-group animated">
            <label for="paket_kode_elearning">Tujuan Unit Mutasi :</label>
        </div>
    </div>
    <div class="col-md-9">
        <div class="form-group animated">
            <select name="asal_unit" id="asal_unit" class="select-wrapper mdb-select colorful-select dropdown-info sm-form" style="width:90%">
                <option value="APOTEK">APOTEK</option>
                <!-- <option value="UGD">UGD</option> -->
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <label for="paket_kode_elearning">Tambah Obat Mutasi </label>
    </div>
    <div class="col-md-9">
        : <a href="#" data-toggle="modal" data-target="#scrollmodal"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="2. Tambahkan list obat yang ada di Gudang" id="tambahkan"><i class="fa fa-plus"></i> Input Obat</button></a>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body card-block">
        <div class="row form-group">
            <div class="col-md-12" style="margin-top:20px;">
                <h5>Daftar Obat Mutasi</h5>
                <div class="table-responsive">
                    <table id="list_pembelian_obat" class="table editable-table table-bordered table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>Kode Obat / Nama Obat</th>
                                <th>Satuan Terkecil</th>
                                <th>Jumlah Mutasi</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody id="obat">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>desain/dist/simple.money.format.js"></script>
<script type="text/javascript">
    $('.money').simpleMoneyFormat();
</script>
<script>
    $(document).ready(function() {

        var list_obat = [];
        $(document).on("click", ".add_obat", function() {
            var kode = $(this).attr("id");
            var nama = $(this).attr("nm");
            var satuan = $(this).attr("satuan").split(',');
            var markup = "<tr>" +
                "<td><input hidden value='" + kode + "' name='id_obat[]'><input hidden value='' name='satuan[]' id='satuan" + kode + "'>" + nama + "</td>" +
                "<td><input hidden class='form-control' value='" + satuan[2] + "' name='satuan_terkecil[]'>" + satuan[2] + "</td>" +
                "<td><input class='form-control' value='' name='jumlah[]'></td>" +
                "<td><button type=\"button\"  class=\"hapus btn btn-danger btn-sm btn-circle\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Data\"><i class=\"fa fa-trash\"></i></button></td>" +
                "</tr>";

            if (list_obat.indexOf(kode) > -1) {
                alert("Obat ini telah ditambahkan sebelumnya");
            } else {
                $("tbody#obat").append(markup);
                $("#scrollmodal").modal('toggle');

                list_obat.push(kode);
            }
        })

        $(document).on('click', '.hapus', function() {
            // deleteRow(this);
            var row = (this);
            var index = row.parentNode.parentNode.rowIndex;
            var index_array = index - 1;
            list_obat.splice(index_array, 1);
            $(this).parent().parent().remove();

        });
    })
</script>