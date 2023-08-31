<?php echo form_open(base_url()."PengajuanObat/insert_pemberian/".$this->uri->segment(3))?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header text-center">
        <h4>Permintaan Obat</h4>
      </div>
      <div class="col col-md-12" style="margin-left:20px;">
    </div>
      <div class="card-body">
        <div class="table-responsive">
          <table  class="table color-table info-table tab ">
              <thead>
                  <tr><th>#</th>
                      <th>Kode Obat</th>
                      <th>Nama Obat</th>
                      <th>Jumlah</th>
                      <th>Stok Tersedia</th>
                      <th width="%5">Jumlah Disetujui</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($detail as $value):
                  ?>
                  <?php
                  $gudang = $this->db
                  ->select("sum(stok_akhir) as stok")
                  ->get_where("list_batch_gudang",array("obat_idobat"=>$value->obat_idobat))->row();
                  $stok_gudang = !empty($gudang)?$gudang->stok:0;
                  ?>
                      <td><input type="hidden" name="iddetail[]" value="<?php echo $value->iddetail_permintaan?>"><input type="hidden" name="idobat[]" value="<?php echo $value->obat_idobat?>"><?php echo $no; ?></td>
                      <td><?php echo $value->obat_idobat; ?></td>
                      <td><?php echo $value->nama_obat; ?></td>
                      <td><?php echo $value->jumlah; ?></td>
                      <td><?php echo $stok_gudang; ?></td>
                      <td><input type="number" stok="<?php echo $stok_gudang;?>" minta="<?php echo $value->jumlah?>" class="form-control beri" name="jumlah_beri[]"></td>
                  </tr>
                <?php $no++;  endforeach; ?>
              </tbody>
            </table>

        </div>
      </div>

            <?php echo $this->Core->btn_input()?>
    </div>

  </div>

</div>
<?php echo form_close();?>
<script>
$(document).ready(function(){
  $(document).on("keyup",".beri",function(){
    var jumlah = parseInt($(this).val());
    var stok = parseInt($(this).attr("stok"));
    if (jumlah > stok) {
      alert("jumlah beri melebihi stok tersedia");
    }
  })
})

</script>
