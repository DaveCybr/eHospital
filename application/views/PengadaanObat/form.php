
<div class="card">
  <div class="card-body card-block">
    <div class="row form-group">
      <div class="col-md-9">
        <a href="#" data-toggle="modal" data-target="#scrollmodal"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="cari obat" id="tambahkan"><i class="fa fa-plus"></i> Cari Obat</button></a>
      </div>
      <div class="col-md-12" style="margin-top:20px;">

          <div class="table-responsive">
              <table id="list_pembelian_obat" class="table editable-table table-bordered table-striped m-b-0">
                <thead>
                  <tr>
                    <th>Kode Obat / Nama Obat</th>
                    <th>No Batch</th>
                    <th>Expired Date</th>
                    <th>Jumlah</th>
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
              </table>
          </div>
          <!-- END DATA TABLE-->
        </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url();?>desain/assets/custom/stokawal.js"></script>
