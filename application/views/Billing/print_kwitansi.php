<style>
  @media print{
    .left-sidebar,.page-titles,.button_opsi,.footer,.opsi,.asuransi,.diskon{display: none;}
    #footer_tagihan{display: inline;}
  }
</style>
<script>
  window.print();
</script>
<div class="row form-material">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3><b>Bukti Pembayaran</b></h3>  <span class="pull-right">NO : <?php echo $no?></span>
                <p style="position:relative;right:10">Nomor Kunjungan <?php echo $data['kunjungan_no_urutkunjungan']?></p>
                <hr>
                <div class="row" id="form_tagihan">
                    <div class="col-md-12">
                        <div class="pull-left" style="margin-left:20px;">
                            <address>
                              <div class="row">

                                <div class="col-xs-12">
                                  <h2 class="page-header">
                                    <img src="<?php echo base_url() ?>desain/assets/images/logo_simetrik.png" style="max-width: 55px;"/> SIMETRIK
                                  </h2>
                                  <p class="text-muted m-l-5" style="width:350px"><?php echo ($this->Core->alamat_klinik())?></p>
                                </div>

                                <!-- /.col -->
                              </div>

                            </address>
                        </div>
                    </div>
                </div>
                <!-- <hr> -->
                <div class="row" id="form_tagihan">
                    <div class="col-md-12">
                      <center><b><h4>BUKTI PEMBAYARAN TAGIHAN</h4></b></center>
                        <div class="pull-left" style="margin-left:20px;">
                          <address>
                            <p>Jember, <?php echo date('d-m-Y',strtotime($data['tanggal']))?></p>
                          </address>
                          <table>
                            <tr>
                              <td><b>Telah Diterima Dari</b></td>
                              <td colspan="3"> : </td>
                              <td><b><?php echo $pasien?></b></td>
                            </tr>
                            <tr>
                              <td><b>Sejumlah</b></td>
                              <td colspan="3"> : </td>
                              <td><span class="">Rp.<?php echo number_format($nominal)?></span><b>  (<?php echo $terbilang?>)</b></td>
                            </tr>
                            <tr>
                              <td><b>Untuk</b></td>
                              <td colspan="3"> : </td>
                              <td><b>Pembayaran pelayanan rawat jalan <?php echo strtolower($data['tujuan_pelayanan'])?> </b></td>
                            </tr>
                          </table>
                        </div>
                        <div class="pull-right text-right">
                          <br><br>
                            <address>
                                <h6>Yang Menerima,</h6>
                                <h4 class="font-bold"></h4><br><br>
                                <p class="text-muted m-l-30">(<?php echo $operator?>)</p>
                            </address>
                        </div>
                    </div>

                    <div class="col-md-12">

                    </div>

                    <div class="col-md-12">

                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
