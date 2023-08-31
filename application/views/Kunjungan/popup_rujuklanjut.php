<div class="modal fade" id="ganti_tupel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <?php echo form_open(base_url()."Kunjungan/ganti_tupel");?>
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Ganti Tujuan Pelayanan</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">

        <div class="row form-group">
            <div class="col col-md-">
                <label for="jenis_pasien" class=" form-control-label">Ganti Ke</label>
            </div>
            <div class="col-12 col-md-9">
              <?php foreach ($tupel as $value): ?>
                <div class="custom-control custom-radio">
                  <input type="radio" id="<?php echo $value->kode_tupel?>" name="tupel" value="<?php echo $value->kode_tupel?>" class="custom-control-input ganti_tupel"  required <?php if ($value->kode_tupel=="UMU"): ?>
                    checked
                  <?php endif; ?>>

                  <label class="custom-control-label" for="<?php echo $value->kode_tupel?>"><?php echo $value->tujuan_pelayanan?></label>
                </div>
              <?php endforeach; ?>


            </div>
        </div>
        <div id="rujuklanjut">
        <h2> RUJUK LANJUT </h2>
        <table>
          <tr>
            <th> Fasilitas Kesehatan rujuk lanjut</th>
            <th> tanggal rencana berkunjung </th>
          </tr>
          <tr>
            <td><select id="jabatan" name="jabatan">
                    <option value="spesialis">spesialis</option>
                    <option value="spesialis">spesialis</option>
                    <option value="spesialis">spesialis</option>
                  </select>
            </td>
            <td>
              <input type="date">
            </td>
          </tr>
        </table>

        <h3> Spesialis </h3>
        <table>
          <tr>
            <td> Spesialis </td>
            <td> sub.spesialis </td>
          </tr>
          <tr>
            <td><select id="usia" name="usia">
                    <option value="anak">anak</option>
                    <option value="anak">anak</option>
                    <option value="anak">anak</option>
                  </select>
            </td>
            <td> <select id="usia" name="usia">
                    <option value="anak">anak</option>
                    <option value="anak">anak</option>
                    <option value="anak">anak</option>
                  </select>
          </td>
          </tr>
          <tr>
            <td>Sarana</sarana>
          </tr>
          <tr>
            <td><select id="sarana" name="sarana">
                    <option value="sarana">sarana</option>
                    <option value="sarana">sarana</option>
                  </select>
            </td>
          </tr>
        </table>
        <button type="button">cari Rujukan</button>

        <h2>Daftar Faskes Rujukan</h2>
        <table>
          <tr>
            <th>NO</th>
            <th>Faskes</th>
            <th>Kelas</th>
            <th>Kantor Cabang</th>
            <th>Alamat</th>
            <th>Telp</th>
            <th>Jarak</th>
            <th>Total Rujukan</th>
            <th>kapasistas</th>
            <th>Jadwal</th>
            <th>pilih</th>
            <th></th>

          </tr>
        </table>
    </div>
        <input type="hidden" name="nokun" class="ganti_nokun">

        <input type="hidden" name="no_rm" class="no_rm">
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="no_antrian" class=" form-control-label">No Antrian
                    Sebelumnya</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="text" name="no_antrian" id="no_antrian" class="form-control"
                       placeholder="no antrian" value="<?php echo $no_antrian; ?>" required>
            </div>
        </div>
      </div>
<div class="modal-footer">
  <button type="submit" class="btn btn-outline-success waves-effect" >Simpan</button>
        <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">CLOSE</a>
      </div>
      <?php echo form_close();?>
    </div>
    <!--/.Content-->
  </div>
</div>
