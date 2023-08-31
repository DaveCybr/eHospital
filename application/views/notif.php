
<?php if ($_SESSION['jabatan']=='apotek' || $_SESSION['jabatan']=='keuangan'): ?>
  <?php $jumlah_total = 0;$jml=$this->Core->get_jatuh_tempo();$jml2= $this->Core->get_kadaluarsa();?>
  <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-bell"></i>
          <span class="notify badge badge-danger jumlah_notif_apotek"><?php echo $jumlah_total; ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
          <ul>
              <li>
                  <div class="drop-title">Notifications</div>
              </li>
              <li>

                  <div class="message-center tujuan_<?php echo $_SESSION['poli']?>">
                    <?php
                      if ($jml > 0) {
                        $jumlah_total +=1;
                      }
                      if ($jml2 > 0) {
                        $jumlah_total +=1;
                      }
                    ?>
                      <!-- Message -->
                      <?php if ($jumlah_total==0) {?>
                        <br>
                        <center><p><i>Tidak ada pemberitahuan untuk saat ini</i></  p></center>

                      <?php
                    }else{?>
                      <?php if ($jml > 0): ?>

                        <a href="<?php echo base_url()."Hutang"?>">
                            <div class="mail-contnet">
                                <h5>Hutang Jatuh Tempo</h5> <span class="mail-desc">Ada <?php echo $jml?> hutang akan jatuh tempo!!!</span></div>

                        </a>
                      <?php endif; ?>
                      <?php if ($jml2 > 0): ?>

                        <a href="<?php echo base_url()."Obat/kadaluarsa"?>">
                            <div class="mail-contnet">
                                <h5>Obat Kadaluarsa</h5> <span class="mail-desc">Ada <?php echo $jml2?> obat akan kadaluarsa!!!</span></div>

                        </a>
                      <?php endif; ?>
                    <?php
                    }
                      ?>

                    <input type="hidden" value="<?php echo $jumlah_total;?>" id="tot_notif">
                  </div>
              </li>
              <li>
                  <a class="nav-link text-center link" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
              </li>
          </ul>
      </div>
  </li>
<?php endif; ?>
<?php if ($_SESSION['jabatan']=='lab'): ?>
  <?php $jml=$this->Core->get_kunjungan_lab();?>
  <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-bell"></i>
          <span class="notify badge badge-danger jumlah_<?php echo $_SESSION['poli']?>"><?php echo $jml ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
          <ul>
              <li>
                  <div class="drop-title">Notifications </div>
              </li>
              <li>

                  <div class="message-center tujuan_<?php echo $_SESSION['poli']?>">

                      <!-- Message -->
                      <?php if ($jml==0) {?>
                        <br>
                        <center><p><i>Tidak ada pemberitahuan untuk saat ini</i></  p></center>

                      <?php
                    }else{?>

                      <a href="<?php echo base_url()."KunjunganLab"?>">
                          <div class="mail-contnet">
                              <h5>Permintaan Laborat</h5> <span class="mail-desc">Ada <?php echo $jml?> permintaan laborat belum dilayani,cek sekarang!!!</span></div>

                      </a>

                    <?php
                    }
                      ?>


                  </div>
              </li>
              <li>
                  <a class="nav-link text-center link" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
              </li>
          </ul>
      </div>
  </li>
<?php endif; ?>
<?php if ($_SESSION['jabatan']=='resepsionis'): ?>
  <?php $jml=$this->Core->hit_data(null);?>
  <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-bell"></i>
          <span class="notify badge badge-danger jumlah_<?php echo $_SESSION['poli']?>"><?php echo $jml ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
          <ul>
              <li>
                  <div class="drop-title">Notifications</div>
              </li>
              <li>

                  <div class="message-center tujuan_<?php echo $_SESSION['poli']?>">

                      <!-- Message -->
                      <?php if ($jml==0) {?>
                        <br>
                        <center><p><i>Tidak ada pemberitahuan untuk saat ini</i></  p></center>

                      <?php
                    }else{?>

                      <a href="<?php echo base_url()."Admisi"?>">
                          <div class="mail-contnet">
                              <h5>Permintaan admisi</h5> <span class="mail-desc">Ada <?php echo $jml?> permintaan admisi belum dilayani,cek sekarang!!!</span></div>

                      </a>

                    <?php
                    }
                      ?>


                  </div>
              </li>
              <li>
                  <a class="nav-link text-center link" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
              </li>
          </ul>
      </div>
  </li>
<?php endif; ?>
<?php if ($_SESSION['poli']!=NULL && $_SESSION['jabatan']!='resepsionis' &&  $_SESSION['poli']!='RANAP' && $_SESSION['jabatan']!='kasir' && $_SESSION['jabatan']!='keuangan'): ?>
  <?php $jml=$this->Core->get_kunjungan($_SESSION['poli']);?>
  <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-bell"></i>
          <span class="notify badge badge-danger jumlah_<?php echo $_SESSION['poli']?>"><?php echo $jml ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
          <ul>
              <li>
                  <div class="drop-title">Notifications</div>
              </li>
              <li>

                  <div class="message-center tujuan_<?php echo $_SESSION['poli']?>">

                      <!-- Message -->
                      <?php if ($jml==0) {?>
                        <br>
                        <center><p><i>Tidak ada pemberitahuan untuk saat ini</i></  p></center>

                      <?php
                    }else{?>

                      <a href="<?php echo base_url()."Kunjungan"?>">
                          <div class="mail-contnet">
                              <h5>Kunjungan Pasien</h5> <span class="mail-desc">Ada <?php echo $jml?> pasien belum di periksa</span></div>

                      </a>

                    <?php
                    }
                      ?>


                  </div>
              </li>
              <li>
                  <a class="nav-link text-center link" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
              </li>
          </ul>
      </div>
  </li>
<?php endif; ?>
