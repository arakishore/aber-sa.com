<!doctype html>
<html lang=en-US>
<head>
<?php $this->load->view('inc_header_commoncss');?>
</head>
<body>    
<?php $this->load->view('inc_header_menu_account');?> 

    
        <div class="blank-div-section"></div>
        <div class="trans-menu-join-bg">
            <img src="<?php echo base_url();?>assets/images/banner-right-section-img.png" alt="banner-right-section-img" />
        </div>  
        <div class="trans-banner-section trans-select-category-banner">
            <div class="trans-blank-section"></div>
            <div class="container">
                <div class="trans-banner-section-content">
                    <div class="trans-banner-content-line"></div>
                    <div class="trans-select-category-head">
                       Change Password
                    </div>                
                </div>
            </div> 
            <div class="trans-caet-banner-bottom-img"></div>      
        </div> 
        <div class="container">
            <div class="fb-your-restaurant-main-left">
                <div class="row">
                    <div class="col-6 col-xs-6 col-lg-6">
                        <div class="fb-your-restaurant-back-btn">
                            <a href="<?php echo site_url($controller)?>"><i class="fal fa-angle-left"></i> Back</a>
                        </div>
                    </div>

                    <div class="col-6 col-xs-6 col-lg-6">
                        <div class="fb-your-restaurant-back-btn menu-responsive">
                            <a class="menu-responsive-menu" href="#">Menu <i class="fal fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                   <?php 
				   if($controller=='serviceprovider') {
				   	$this->load->view('inc_service_left');
				   } else {
					   $this->load->view('inc_customer_left');
				   }
				   ?>                    <div class="col-sm-12 col-md-12 col-lg-9">
<?php $this->load->view('inc_error');?>                                            
                        <div class="fb-edit-profile-form">
                            
                            <form name="frm-edit" id="frm-edit" action="<?php echo site_url($controller . '/change_password') ?>" method="post" enctype="multipart/form-data"  >
                                <input type="hidden" name="mode" id="mode" value="change_password">
                            <div class="fb-edit-profile-form-section">
                                
                                <div class="form-group">
                                <label>Old Password</label>
                                            <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Old Password">
                                </div>
                                
								<div class="form-group">
                                            <label>New Password</label>
                                            <div class="form-group fb-general-details-input">
                                                <input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="New Password">
                                            </div>
                                        </div>    
                                        
									<div class="form-group">
                                            <label>Confirm Password</label>
                                            <div class="form-group fb-general-details-input">
                                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                                            </div>
                                        </div>                                                                    
                                        
                                
                                <div class="fb-login-btn-section">
                                    <button class="btn-over-effect fb-btn-login-btn" type="submit">Change Password</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>                                
            </div>
        </div>

    <?php $this->load->view('inc_footer');?>
	<?php $this->load->view('inc_common_footer_inner_js');?>    
</body>