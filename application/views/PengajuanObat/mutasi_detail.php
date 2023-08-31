<div class="row">
    <div class="col-12">
        <div class="card row">
            <div class="card-header text-center">
                <h4>Detail Mutasi Obat</h4>
            </div>
            <div class="card-body row">
                <div class="col-md-6">
                    <div class="form-group animated">
                        <label for="paket_kode_elearning">Tujuan Unit Mutasi : </label>
                        <div class="form-group animated">
                            <b><?= $permintaan['asal'] ?></b>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group animated">
                        <label for="paket_kode_elearning">Pegawai : </label>
                        <div class="form-group animated">
                            <b><?= $permintaan['NIK'] ?></b>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group animated">
                        <label for="paket_kode_elearning">Tanggal : </label>
                        <div class="form-group animated">
                            <b><?= date("d-m-Y", strtotime($permintaan['tanggal'])) ?></b>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group animated">
                        <label for="paket_kode_elearning">Waktu : </label>
                        <div class="form-group animated">
                            <b><?= $permintaan['jam'] ?></b>
                        </div>
                    </div>
                </div>
                <h5>Daftar Obat Mutasi</h5>
                <div class="table-responsive">
                    <table class="table color-table info-table tab ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Obat</th>
                                <th>Nama Obat</th>
                                <th>Jumlah Mutasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($detail as $value) :
                            ?>
                                <td><input type="hidden" name="iddetail[]" value="<?php echo $value->iddetail_permintaan ?>"><input type="hidden" name="idobat[]" value="<?php echo $value->obat_idobat ?>"><?php echo $no; ?></td>
                                <td><?php echo $value->obat_idobat; ?></td>
                                <td><?php echo $value->nama_obat; ?></td>
                                <td><?php echo $value->jumlah_beri; ?></td>
                                </tr>
                            <?php $no++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>