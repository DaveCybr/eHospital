<?php echo form_open(base_url()."Susut/susutkan")?>
<div class="row">
  <div class="col-12">
    <div class="card card-cascade narrower z-depth-1">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <a href="" class="white-text mx-3"><h3>Susutan</h3></a>
      </div>
      <div class="card-body">
        <div class="row col-md-12">
          <div class="col-md-3">
              <input type="date" name="tanggal" id="kategori_obat" class="form-control" placeholder="no rek" value="<?php echo date("Y-m-d")?>" required>

          </div>

          <div class="col-md-9">
            <button class="btn btn-primary" type="submit">Susutkan</button>
          </div>
        </div>

        <div class="table-responsive">
          <table id="myTable" class="table table-striped table-bordered">
              <thead>
                  <tr>
                      <th>No Inventaris</th>
                      <th>Nama Inventaris</th>
                      <th>Total Harga</th>
                      <th>Tanggal Susut</th>
                      <th>Nilai Susut</th>
                      <th>Nilai Buku</th>
                    </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($susut as $value):
                  ?>
                      <td><?php echo $value->noninven; ?></td>
                      <td><?php echo $value->nama; ?></td>
                      <td><?php echo "Rp.".number_format($value->nilinven,2,',','.');?></td>
                      <td><?php echo date("d-m-Y",strtotime($value->tglsusut)); ?></td>
                      <td><?php echo "Rp.".number_format($value->nilsusut,2,',','.'); ?></td>
                      <td><?php echo "Rp.".number_format($value->nilbuku,2,',','.'); ?></td>

                  </tr>
                <?php $no++;  endforeach; ?>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo form_close()?>
