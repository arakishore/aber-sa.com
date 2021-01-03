<?php
$session_user_data = $this->session->userdata('user_data');
?>
<div class="col-sm-12 col-md-12 col-lg-3">                        
                        <div class="fb-left-bar-section-main">
                            <button type="button" class="fb-left-cross fb-nav-trigger fb-js-nav-trigger"><span></span><span></span><span></span></button>
                            <div class="fb-left-bar-profile-section">
                                <div class="fb-left-bar-profile-img">
                                <?php
$sel_photo = base_url().'assets/images/user-img.jpg';
if($session_user_data['profile_pic']) {
	$sel_photo = base_url().'uploads/profile_pics/'.$session_user_data['profile_pic'];
}
?>
                <img src="<?php echo $sel_photo;?>" alt="user images" />
                                </div>
                                <div class="fb-left-bar-profile">
                                    <div class="fb-left-bar-profile-name">
                                    <?php echo (isset($session_user_data['first_name']))?$session_user_data['first_name']:''?>
                    <?php echo (isset($session_user_data['last_name']))?$session_user_data['last_name']:''?>
                                    </div>
                                    <a class="fb-left-bar-edit-profile" href="#<?php echo site_url('customer/edit_profile')?>">Edit
                    profile</a>
                                </div>
                            </div>
                            <ul class="fb-left-bar-menus">
                            <li><a href="<?php echo site_url('customer')?>"
                    <?php if(isset($l_s_act) && $l_s_act==1){ echo 'class="active"';}?>>Dashbord<span><i
                            class="fal fa-angle-right"></i> </span></a></li>
                                <li><a href="#payment-options.html" >Payment Options <span><i class="fal fa-angle-right"></i> </span></a></li>
                                <li><a href="#notifications.html">Notifications <span><i class="fal fa-angle-right"></i> </span></a></li>
                                <li><a href="#my-shipment.html">My Shipment<span><i class="fal fa-angle-right"></i> </span></a></li>
                                <li><a href="#review.html">Review<span><i class="fal fa-angle-right"></i> </span></a></li>   
                                <li><a href="<?php echo site_url('customer/log_out')?>">Log Out</a></li>
                            </ul>
                        </div>
                    </div>
