<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card"> <img class="card-img" src="<?php echo base_url()?>desain/assets/images/background/socialbg.jpg" height="456" alt="Card image">
            <div class="card-img-overlay card-inverse text-white social-profile d-flex justify-content-center">
                <div class="align-self-center"> <img src="<?php echo base_url()?>desain/assets/images/users/1.jpg" class="img-circle" width="100">
                    <h3 class="card-title"><?php echo $pegawai['nama']; ?></h3>
                    <h4 class="card-subtitle text-success"> <b><?php echo @$pegawai['jabatan']; ?></b></h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body"> <small class="text-muted">Email address </small><h6><?php echo @$pegawai['email']; ?></h6>
              <small class="text-muted p-t-30 db">Phone</small><h6><?php echo @$pegawai['telepon']; ?></h6>
              <small class="text-muted p-t-30 db">Address</small><h6><?php echo @$pegawai['alamat'].", ".@$pegawai['kota']; ?></h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <!-- <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Timeline</a> </li> -->
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#account" role="tab">User Account</a> </li>
                <!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Profile</a> </li> -->

            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- <div class="tab-pane" id="home" role="tabpanel">
                    <div class="card-body">
                        <div class="profiletimeline">
                            <div class="sl-item">
                                <div class="sl-left"> <img src="<?php echo base_url()?>desain/assets/images/users/1.jpg" alt="user" class="img-circle" /> </div>
                                <div class="sl-right">
                                    <div><a href="javascript:void(0)" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                        <p>assign a new task <a href="javascript:void(0)"> Design weblayout</a></p>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 m-b-20"><img src="<?php echo base_url()?>desain/assets/images/big/img1.jpg" class="img-responsive radius" /></div>
                                            <div class="col-lg-3 col-md-6 m-b-20"><img src="<?php echo base_url()?>desain/assets/images/big/img2.jpg" class="img-responsive radius" /></div>
                                            <div class="col-lg-3 col-md-6 m-b-20"><img src="<?php echo base_url()?>desain/assets/images/big/img3.jpg" class="img-responsive radius" /></div>
                                            <div class="col-lg-3 col-md-6 m-b-20"><img src="<?php echo base_url()?>desain/assets/images/big/img4.jpg" class="img-responsive radius" /></div>
                                        </div>
                                        <div class="like-comm"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="sl-item">
                                <div class="sl-left"> <img src="<?php echo base_url()?>desain/assets/images/users/2.jpg" alt="user" class="img-circle" /> </div>
                                <div class="sl-right">
                                    <div> <a href="javascript:void(0)" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                        <div class="m-t-20 row">
                                            <div class="col-md-3 col-xs-12"><img src="<?php echo base_url()?>desain/assets/images/big/img1.jpg" alt="user" class="img-responsive radius" /></div>
                                            <div class="col-md-9 col-xs-12">
                                                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. </p> <a href="javascript:void(0)" class="btn btn-success"> Design weblayout</a></div>
                                        </div>
                                        <div class="like-comm m-t-20"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="sl-item">
                                <div class="sl-left"> <img src="<?php echo base_url()?>desain/assets/images/users/3.jpg" alt="user" class="img-circle" /> </div>
                                <div class="sl-right">
                                    <div><a href="javascript:void(0)" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                        <p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper </p>
                                    </div>
                                    <div class="like-comm m-t-20"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                </div>
                            </div>
                            <hr>
                            <div class="sl-item">
                                <div class="sl-left"> <img src="<?php echo base_url()?>desain/assets/images/users/4.jpg" alt="user" class="img-circle" /> </div>
                                <div class="sl-right">
                                    <div><a href="javascript:void(0)" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                        <blockquote class="m-t-10">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!--second tab-->
                <!-- <div class="tab-pane" id="profile" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                <br>
                                <p class="text-muted">Johnathan Deo</p>
                            </div>
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                                <br>
                                <p class="text-muted">(123) 456 7890</p>
                            </div>
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                <br>
                                <p class="text-muted">johnathan@admin.com</p>
                            </div>
                            <div class="col-md-3 col-xs-6"> <strong>Location</strong>
                                <br>
                                <p class="text-muted">London</p>
                            </div>
                        </div>
                        <hr>
                        <p class="m-t-30">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries </p>
                        <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        <h4 class="font-medium m-t-30">Skill Set</h4>
                        <hr>
                        <h5 class="m-t-30">Wordpress <span class="pull-right">80%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                        </div>
                        <h5 class="m-t-30">HTML 5 <span class="pull-right">90%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                        </div>
                        <h5 class="m-t-30">jQuery <span class="pull-right">50%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                        </div>
                        <h5 class="m-t-30">Photoshop <span class="pull-right">70%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                        </div>
                    </div>
                </div> -->

                <div class="tab-pane active" id="account" role="tabpanel">
                    <div class="card-body">
                        <?php $this->load->view("Pegawai/detail/account")?>
                    </div>
                </div>
                <div class="tab-pane" id="settings" role="tabpanel">
                    <div class="card-body">
                      <?php echo form_open_multipart('User/update');
                      echo form_hidden('id', $this->uri->segment(3));?>
                      <?php echo @$error;?>
                      <?php $this->load->view("Pegawai/detail/setting")?>


                      <button type="submit" class="waves-effect waves-light btn blue m-b-xs text-right">SIMPAN</button>
                      <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
