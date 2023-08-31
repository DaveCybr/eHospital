<?php if ($_SESSION['jabatan'] == "root" || $_SESSION['jabatan'] == "dumu" || $_SESSION['jabatan'] == "dgig"): ?>
<?php
$tgl = date("Y-m-d");
$poli = $_SESSION['poli'];
$this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
$this->db->join('jenis_pasien', 'kunjungan.sumber_dana = jenis_pasien.kode_jenis',"left");
$this->db->order_by('no_antrian', 'ASC');
$this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
if ($poli == null) {
  $this->db->where(array('sudah' => 0, 'tgl'=>$tgl,'acc_ranap !='=>1));
}else {
  if ($poli=='IGD' || $poli=='GIG') {
    $this->db->where(array('sudah' => 0, 'tgl'=>$tgl, 'tupel_kode_tupel' => $poli ,'acc_ranap !='=>1));
  }else{
    $this->db->where(array('sudah' => 0, 'tgl'=>$tgl, 'acc_ranap !='=>1));
    $this->db->group_start()
            ->where('tupel_kode_tupel !=','IGD')
            ->or_where('tupel_kode_tupel !=','GIG')
            ->group_end();
  }
}
$kunjungan = $this->db->get('kunjungan')->result();
$jml = 0;
 ?>
 <?php foreach ($kunjungan as $value): ?>
   <?php if ($value->status_online == 1):
     $baru = $this->Core->getChatBaca($value->pasien_noRM, 1)->num_rows();
     $jml += $baru;
     ?>

   <?php endif; ?>

 <?php endforeach; ?>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-comment"></i>
        <span class="notify badge badge-danger"><?php echo $jml ?></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
        <ul>
            <li>
                <div class="drop-title">Notifications Pendaftar Online </div>
            </li>
            <li>

                <div class="message-center">
                  <?php foreach ($kunjungan as $value): ?>
                    <?php if ($value->status_online == 1):
                      $baru = $this->Core->getChatBaca($value->pasien_noRM, 1)->num_rows();
                      ?>
                      <a href='<?php echo base_url()."APO/Konsultasi/Chat/".$value->pasien_noRM."/".$value->no_urutkunjungan;?>'>
                          <div class="mail-contnet">
                              <h5>Pasien : <b><?php echo $value->namapasien ?></b></h5> <span class="mail-desc">
                                <?php if ($baru <= 0): ?>
                                    Tidak Ada Pesan
                                  <?php else: ?>
                                    <?php echo $baru ?> Pesan Baru Belum Di Baca
                                <?php endif; ?>
                              </span></div>

                      </a>
                    <?php endif; ?>

                  <?php endforeach; ?>

                </div>
            </li>
            <li>
                <a class="nav-link text-center link" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
            </li>
        </ul>
    </div>
</li>
<div class="notifChat">

</div>
<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
<script type="text/javascript">

$(document).ready(function () {
  Pusher.logToConsole = true;
  var pusher = new Pusher('4f343bacaa7b3063150d', {
    cluster: 'ap1',
    forceTLS: true
  });

  var channel = pusher.subscribe('E-klinik');
  channel.bind('my-konsul', function(data) {
    // alert(JSON.stringify(data));
    var audio = new Audio('http://utamahusada.esolusindo.com/desain/assets/custom/qr_reader/audio/notif.mp3');
    audio.play();
    var html = '<div class="alert alert-info myalert animated fadeInRight">'+
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'+
        '<h3 class="text-success"><i class="fas fa-comment"></i> Pesan Baru</h3> Pesan dari '+data.nama_pasien+
    '<br><small>'+data.text+'</small></div>';
    $(".notifChat").html(html);
  });
});
</script>
<?php endif; ?>
