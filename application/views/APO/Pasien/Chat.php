<style>
  .heightChat{
    height: 580px !important;
  }
  .liChat{
    margin-top: 0px !important;
  }
</style>
<div class="row">
    <div class="col-12">
        <div class="card m-b-0">
            <!-- .chat-row -->
            <div class="chat-main-box">
                <!-- .chat-left-panel -->
                <div class="chat-left-aside">
                    <div class="open-panel"><i class="ti-angle-right"></i></div>
                    <div class="chat-left-inner heightChat">
                        <div class="form-material p-3 b-b">
                            <h4 class="box-title">Pasien Pendaftar Online</h4>
                        </div>
                        <!-- <ul class="chatonline style-none ">
                          <?php foreach ($kunjungan as $value): ?>
                            <?php if ($value->status_online == 1): ?>
                              <?php
                                $baru = $this->ModelChat->getChatBaca($value->pasien_noRM, 1)->num_rows();

                               ?>
                              <li>
                                  <a href="<?php echo $value->status_deposit==0 && $k!="IGD"?"#":base_url()."APO/Konsultasi/Chat/".$value->pasien_noRM."/".$value->no_urutkunjungan;?>"class="<?php echo $norm ==$value->pasien_noRM? 'active':''; ?>">
                                    <img src="<?php echo base_url() ?>desain/user.png" alt="user-img" class="img-circle"> <span><?php echo $value->namapasien ?>
                                      <input type="hidden" value="0" id="baru<?php echo $value->pasien_noRM ?>">
                                      <?php if ($baru > 0): ?>
                                        <span class="badge badge-pill badge-danger"><i class="far fa-comment-alt"></i> <b class="jml-baca-<?php echo $value->pasien_noRM ?>"></b> <?php echo $baru ?></span>
                                      <?php endif; ?>
                                      <small class="text-success">Keluhan : <?php echo $value->keluhan ?></small>
                                    </span></a>
                              </li>
                            <?php endif; ?>

                          <?php endforeach; ?>
                            <li class="p-20"></li>
                        </ul> -->
                    </div>
                </div>
                <!-- .chat-left-panel -->
                <!-- .chat-right-panel -->
                <div class="chat-right-aside">
                    <div class="chat-main-header">
                        <div class="p-3 b-b">
                            <h4 class="box-title">Chat Message </h4>
                            <input type="hidden" id="no_kunjungan" value="<?php echo $no_kunjungan ?>">
                            <input type="hidden" id="pasien_noRM" value="<?php echo $norm ?>">
                        </div>
                    </div>
                    <div class="chat-rbox" style="height: 600px !important;">
                        <ul class="chat-list p-3 tmp-chat">
                            <!--chat Row -->
                            <?php
                              $status_baca = 0;
                             foreach ($chat as $value):
                               $baru = $this->ModelChat->getChatBaca($value->pasien_noRM, 0)->num_rows();
                               ?>
                             <?php if ($status_baca == 0): ?>
                               <?php if ($value->status_baca == 1): $status_baca = 1;?>
                                 <div class="col-md-12">
                                     <div class="card">
                                         <div class="box spring-warmth-gradient text-center">
                                             <h6> <b><?php echo $baru ?> Pesan Belum Dibalas</b> </h6>
                                         </div>
                                     </div>
                                 </div>
                               <?php endif; ?>
                             <?php endif; ?>
                              <?php if ($value->status == "2"): ?>
                                <li class="liChat">
                                    <div class="chat-img"><i class="fas fa-user-md"></i></div>
                                    <div class="chat-content">
                                        <h5><?php echo $this->ModelPegawai->get_data_edit($value->pegawai_NIK)["nama"]; ?></h5>
                                        <div class="box aqua-gradient text-white"><?php echo $value->text ?></div>
                                        <div class="chat-time"><?php echo date("H:i:s d-m-Y", strtotime($value->waktu)) ?></div>
                                    </div>
                                </li>
                                <?php else: ?>
                                  <li class="reverse liChat">
                                      <div class="chat-content">
                                        <h5><?php echo $this->ModelPasien->get_data_edit($value->pasien_noRM)->row_array()["namapasien"]; ?></h5>
                                        <div class="box blue-gradient text-white"><?php echo $value->text ?></div>
                                        <div class="chat-time"><?php echo date("H:i:s d-m-Y", strtotime($value->waktu)) ?></div>
                                      </div>
                                      <div class="chat-img"><i class="fas fa-user"></i></div>
                                  </li>
                              <?php endif; ?>

                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-body border-top">
                        <div class="row">
                            <div class="col-8">
                                <textarea placeholder="Type your message here" class="form-control border-0" id="text"></textarea>
                            </div>
                            <div class="col-4 text-right">
                                <button onclick="Send()" type="button" class="btn btn-info btn-rounded"><i class="far fa-paper-plane"></i> Kirim</button>
                                <!-- <button onclick="audioPlay()" type="button" class="btn btn-info btn-rounded"><i class="far fa-paper-plane"></i> Notif</button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .chat-right-panel -->
            </div>
            <!-- /.chat-row -->
        </div>
    </div>
</div>
<?php $waktu = date("H:i:s d-m-Y") ?>
<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
<script type="text/javascript">
function audioPlay() {
  var audio = new Audio('<?php echo base_url() ?>desain/assets/custom/qr_reader/audio/beep.mp3');
  audio.play();
}

$(document).ready(function () {

  $('.chat-rbox').animate({
    scrollTop: $('.chat-rbox').get(0).scrollHeight
  }, 1500);
  var pasien_noRM = $("#pasien_noRM").val();
  Pusher.logToConsole = true;
  var pusher = new Pusher('4f343bacaa7b3063150d', {
    cluster: 'ap1',
    forceTLS: true
  });

  var channel = pusher.subscribe('my-Pasien');
  channel.bind(pasien_noRM, function(data) {
    // alert(JSON.stringify(data));
      audioPlay();
      var html = '<li class="liChat">'+
          '<div class="chat-img"><i class="fas fa-user"></i></div><div class="chat-content">'+
              '<h5>'+data.nama_pegawai+'</h5>'+
              '<div class="box aqua-gradient text-white">'+data.text+'</div>'+
              '<div class="chat-time">'+data.waktui+'</div>'+
          '</div>'+
          '</li>';
      $(".tmp-chat").append(html);
      $('.chat-rbox').animate({
        scrollTop: $('.chat-rbox').get(0).scrollHeight
      }, 1500);
  });
});
// Enable pusher logging - don't include this in production


function Send(){
  // alert("SEND");
  var pasien_noRM = $("#pasien_noRM").val();
  var text = $("#text").val();
  var no_kunjungan = $("#no_kunjungan").val();
  $.ajax({
    type: 'POST',
    dataType: "json",
    url: '<?php echo base_url();?>APO/Konsultasi/pesanPasien/',
    data: { pasien_noRM: pasien_noRM, text:text, no_kunjungan:no_kunjungan },
    success: function(response) {
      // response = jQuery.parseJSON(data);
      // alert(response.text);
      var text = $("#text").val("");
      var html = '<li class="reverse liChat">'+
          '<div class="chat-content">'+
              '<h5>'+data.nama_pasien+'</h5>'+
              '<div class="box blue-gradient text-white">'+data.text+'</div>'+
              '<div class="chat-time">'+data.waktui+'</div>'+
          '</div><div class="chat-img"><i class="fas fa-user"></i></div>'+
          '</li>';
      $(".tmp-chat").append(html);
      $('.chat-rbox').animate({
        scrollTop: $('.chat-rbox').get(0).scrollHeight
      }, 1500);
    }
  });
}
</script>
