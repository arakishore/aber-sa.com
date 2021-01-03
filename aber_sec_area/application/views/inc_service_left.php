<?php
$session_user_data = $this->session->userdata('user_data');
?>
<div class="col-sm-12 col-md-12 col-lg-3">                        
                        <div class="fb-left-bar-section-main">
                            <button type="button" class="fb-left-cross fb-nav-trigger fb-js-nav-trigger"><span></span><span></span><span></span></button>
                            <div class="fb-left-bar-profile-section">
                                <div class="fb-left-bar-profile-img">
                              
                                    <img src="<?php echo $session_user_data['user_photo'];?>" alt="user images"/>
                                </div>
                                <div class="fb-left-bar-profile">
                                    <div class="fb-left-bar-profile-name">
                                      <?php echo (isset($session_user_data['first_name']))?$session_user_data['first_name']:''?>
                                      <?php echo (isset($session_user_data['last_name']))?$session_user_data['last_name']:''?>
                                    </div>
                                    <a class="fb-left-bar-edit-profile" href="<?php echo site_url($controller.'/edit_profile')?>">Edit profile</a>
                                </div>
                            </div>
                            <ul class="fb-left-bar-menus">
                                <li><a href="<?php echo site_url('serviceprovider')?>" <?php if(isset($l_s_act) && $l_s_act==1){ echo 'class="active"';}?>>Dashbord<span><i class="fal fa-angle-right"></i> </span></a></li>
                                <li><a href="<?php echo site_url('serviceprovider/find_business')?>" <?php if(isset($l_s_act) && $l_s_act==6){ echo 'class="active"';}?>>Find Business<span><i class="fal fa-angle-right"></i> </span></a></li>
                                <li><a href="<?php echo site_url('serviceprovider/notifications')?>" <?php if(isset($l_s_act) && $l_s_act==2){ echo 'class="active"';}?>>Notifications <span><i class="fal fa-angle-right"></i> </span></a></li>
                                <li><a href="<?php echo site_url('serviceprovider/my_shipment')?>" <?php if(isset($l_s_act) && $l_s_act==3){ echo 'class="active"';}?>>My Shipment<span><i class="fal fa-angle-right"></i> </span></a></li>
                                <li><a href="<?php echo site_url('serviceprovider/review')?>" <?php if(isset($l_s_act) && $l_s_act==4){ echo 'class="active"';}?>>Review<span><i class="fal fa-angle-right"></i> </span></a></li>
                                <li><a href="<?php echo site_url('serviceprovider/my_drivers')?>" <?php if(isset($l_s_act) && $l_s_act==5){ echo 'class="active"';}?>>My Drivers<span><i class="fal fa-angle-right"></i> </span></a></li>
                                <li><a href="<?php echo site_url($controller.'/change_password')?>" <?php if(isset($l_s_act) && $l_s_act==7){ echo 'class="active"';}?>>Change Password<span><i class="fal fa-angle-right"></i> </span></a></li>
                                <li><a href="<?php echo site_url('serviceprovider/logout')?>">Log Out</a></li>
                            </ul>
                        </div>
                    </div>