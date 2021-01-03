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
                       DRIVER SIGN UP
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
                            <a href="<?php echo site_url('serviceprovider')?>"><i class="fal fa-angle-left"></i> Back</a>
                        </div>
                    </div>
                    <div class="col-6 col-xs-6 col-lg-6">
                        <div class="fb-your-restaurant-back-btn menu-responsive">
                            <a class="menu-responsive-menu" href="#">Menu <i class="fal fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php $this->load->view('inc_service_left');?>
                    <div class="col-sm-12 col-md-12 col-lg-9">
                        <div class="fb-dashbord">

						<?php $this->load->view('inc_error');?>
                       
                        <div class="login-form-main-section signup-form-main-section">
     <form name="frm-edit" id="frm-edit" action="<?php echo site_url($controller.'/driver_signup') ?>" method="post" enctype="multipart/form-data"  >
                                <input type="hidden" name="mode" id="mode" value="add_driver">
                        
        <div class="forgat-section">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">First Name<span>*</span></label>
                         <input type="text" id="user">
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">Last Name<span>*</span></label>
                         <input type="text" id="user">
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">Address <span>*</span></label>
                         <input type="text" id="user">
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">City <span>*</span></label>
                         <input type="text" id="user">
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">State <span>*</span></label>
                         <input type="text" id="user">
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">Zip <span>*</span></label>
                         <input type="text" id="user">
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">Email <span>*</span></label>
                         <input type="text" id="user">
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">Phone <span>*</span></label>
                         <input type="text" id="user">
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="password">Password <span>*</span></label>
                         <input type="password" id="password">
                         <!-- <div class="error-red">This field is required</div> -->
                     </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="password">Confirm Password <span>*</span></label>
                         <input type="password" id="password">
                         <!-- <div class="error-red">This field is required</div> -->
                     </div>
                </div>
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <input type="text" class="form-control rounded-0" readonly placeholder="ID Proof">
                        <label class="input-group-btn my-0">
                            <span class="btn btn-large btn-outline-primary rounded-0" id="browse">
                                Browse&hellip; 
                              <input id="csv-input" type="file" accept=".csv" multiple>
                            </span>
                        </label>
                     </div>
                </div>
            </div>
            <div class="forgat-button">
                <a href="select-category.html" type="button" class="forgat-button-style">Sign Up</a>
                <!--<button type="button" class="forgat-button-style">Sign In</button>-->
            </div>                        
        </div>
</form>        
    </div>
                      </div>
                    </div>

                </div>
          </div>
        </div>

    <?php $this->load->view('inc_footer');?>
	<?php $this->load->view('inc_common_footer_inner_js');?>    
</body>