<div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scrollmodalLabel">DETAIL OBAT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body card-block">
            <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="idobat" class=" form-control-label">No Barcode</label>
                    </div>
                    <div class="col-12 col-md-9">
                      <input type="text" name="idobat" id="idobat" class="form-control" placeholder="xxxxxxxxxxxx" value="" disabled>
                    </div>
            </div>
            <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="nama_obat" class=" form-control-label">Nama Obat</label>
                    </div>
                    <div class="col-12 col-md-9">
                      <input type="text" name="nama_obat" id="nama_obat" class="form-control" placeholder="-" value="" readonly>
                    </div>
            </div>
            <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="kategori_obat" class=" form-control-label">Kategori Obat</label>
                    </div>
                    <div class="col-12 col-md-9">
                      <input type="text" name="kategori" id="kategori_obat" class="form-control" placeholder="-" value="" readonly>
                    </div>
            </div>
            <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="jenis_obat" class=" form-control-label">Jenis Obat</label>
                    </div>
                    <div class="col-12 col-md-9">
                      <input type="text" name="jenis" id="jenis_obat" class="form-control" placeholder="-" value="" readonly>
                    </div>
            </div>
            <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="dosis" class=" form-control-label">Dosis</label>
                    </div>
                    <div class="col-12 col-md-9">
                      <input type="text" name="dosis" id="dosis" class="form-control" placeholder="-" value="" readonly>
                    </div>
            </div>
            <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="kegunaan" class=" form-control-label">Kegunaan</label>
                    </div>
                    <div class="col-12 col-md-9">
                   <textarea name="kegunaan" id="kegunaan" class="form-control" placeholder="-" value="" readonly>kegunaan</textarea>
                    </div>
            </div>

            <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="Kandungan" class=" form-control-label">Kandungan Obat</label>
                    </div>
                    <div class="col-12 col-md-9">
                      <textarea name="kandungan" id="kandungan" class="form-control" placeholder="-" value="" readonly>kandungan</textarea>

                    </div>
            </div>
            <div class="row form-group">
                    <div class="col-sm-12 col-md-3">
                      <label for="satuan_obat" class=" form-control-label">Satuan Obat</label>
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <input type="text" name="satuan_besar" id="satuan_besar" class="form-control" placeholder="-" value="" readonly>
                      <small class="form-text text-muted">Satuan Besar</small>
                    </div>
                    <div class="col-md-3 col-sm-12">
                      <input type="text" name="satuan_sedang" id="satuan_sedang" class="form-control" placeholder="-" value="" readonly>
                      <small class="form-text text-muted">Satuan Sedang</small>
                    </div>
                    <div class="col-md-3 col-sm-3">
                      <input type="text" name="satuan_kecil" id="satuan_kecil" class="form-control" placeholder="-" value="" readonly>
                      <small class="form-text text-muted">Satuan Kecil</small>
                    </div>
            </div>
            <div class="row form-group">
                    <div class="col-sm-12 col-md-3">
                      <label for="satuan_sedang" class=" form-control-label">Harga Beli Obat Per Satuan</label>
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <input type="text" name="harga_satuan_besar" id="harga_satuan_besar" class="form-control" placeholder="0" value="" readonly>
                      <small class="form-text text-muted">Harga Beli Satuan Besar</small>
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <input type="text" name="harga_satuan_sedang" id="harga_satuan_sedang" class="form-control" placeholder="0" value="" readonly>
                      <small class="form-text text-muted">Harga Beli Satuan Sedang</small>
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <input type="text" name="harga_satuan_kecil" id="harga_satuan_kecil" class="form-control" placeholder="0" value="" readonly>
                      <small class="form-text text-muted">Harga Beli Satuan Kecil</small>
                    </div>
            </div>
            <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="hrg_1" class=" form-control-label">Harga Jual</label>
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <input type="text" name="rawat_jalan" id="rawat_jalan" class="form-control" placeholder="0" value="" readonly>
                      <small class="form-text text-muted">Rawat jalan</small>
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <input type="text" name="kelas_3" id="kelas_3" class="form-control" placeholder="0" value="" readonly>
                      <small class="form-text text-muted">Kelas 3</small>
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <input type="text" name="harga_satuan_kecil" id="kelas_2" class="form-control" placeholder="0" value="<?php echo @$obat['harga_beli_satuan_kecil']; ?>" readonly>
                      <small class="form-text text-muted">Kelas 2</small>
                    </div>
            </div>
            <div class="row form-group">
                    <div class="col-sm-12 col-md-3">
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <input type="text" name="kelas_1" id="kelas_1" class="form-control" placeholder="0" value="" readonly>
                      <small class="form-text text-muted">Kelas 1</small>
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <input type="text" name="vip" id="vip" class="form-control" placeholder="0" value="0" readonly>
                      <small class="form-text text-muted">VIP</small>
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <input type="text" name="ozon" id="ozon" class="form-control" placeholder="0" value="0" readonly>
                      <small class="form-text text-muted">Ozon</small>
                    </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </div>
</div>
