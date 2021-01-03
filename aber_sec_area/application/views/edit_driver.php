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
                       EDIT DRIVER
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
                        
     <form name="frm-edit" id="frm-edit" action="<?php echo site_url($controller.'/edit_driver/'.$user_id) ?>" method="post" enctype="multipart/form-data"  >
                                <input type="hidden" name="mode" id="mode" value="updatedriver">

        <div class="forgat-section">

            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">First Name<span>*</span></label>
                         <input type="text" id="first_name" name="first_name" value="<?php echo isset($results['first_name'])?$this->common->getDbValue($results['first_name']):''; ?>">
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">Last Name<span>*</span></label>
                         <input type="text" name="last_name" id="last_name" value="<?php echo isset($results['last_name'])?$this->common->getDbValue($results['last_name']):''; ?>">
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">Email <span>*</span></label>
                         <input type="text" name="email" id="email" value="<?php echo isset($results['email'])?$this->common->getDbValue($results['email']):''; ?>" readonly>
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">Phone <span>*</span></label>
                         <input type="text" name="mobile" id="mobile" value="<?php echo isset($results['mobile'])?$this->common->getDbValue($results['mobile']):''; ?>">
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">Address </label>
                         <input type="text" name="address_name" id="address_name" value="<?php echo isset($results_address['address_name'])?$this->common->getDbValue($results_address['address_name']):''; ?>">
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">City </label>
                         <input type="text" name="city_id" id="city_id" value="<?php echo isset($results_address['city_id'])?$this->common->getDbValue($results_address['city_id']):''; ?>">
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">State</label>
                         <input type="text" name="state_id" id="state_id" value="<?php echo isset($results_address['state_id'])?$this->common->getDbValue($results_address['state_id']):''; ?>">
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">Zip </label>
                         <input type="text" name="postcode" id="postcode" value="<?php echo isset($results_address['postcode'])?$this->common->getDbValue($results_address['postcode']):''; ?>">
                         <!--<div class="error-red">This field is required</div>-->
                     </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="user">Status </label>
                        <select name="status_flag" id="status_flag">
                            <option value="Active" <?php if($results['status_flag']=="Active"){?> selected <?php } ?>>Active</option>
                            <option value="Inactive" <?php if($results['status_flag']=="Inactive"){?> selected <?php } ?>>Inactive</option>                        
                        </select>
                     </div>
                </div>
                                
				<div class="col-sm-8 col-md-8 col-lg-6">
                    <div class="form-group">
                        <input type="text" class="form-control rounded-0" readonly placeholder="ID Proof">
                        <label class="input-group-btn my-0">
                            <span class="btn btn-large btn-outline-primary rounded-0" id="browse">
                                Browse&hellip; 
                              <input id="id_proof" name="id_proof" type="file" multiple>
                            </span>
                        </label>
                     </div>
                </div>


                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                    <?php 
if($results['id_proof']!=''){
			$id_proof = base_url().'uploads/id_proof/'.stripslashes($results['id_proof']);
?>
                        <a href="<?php echo $id_proof?>" target="_blank">VIEW ID PROOF</a>
                    <?php } ?>    
                     </div>
                </div>

                
            </div>
            <div class="forgat-button">
                <button type="submit" class="forgat-button-style">Edit</button>
            </div>                        
        </div>
</form>        

     <form name="frm-edit" id="frm-edit" action="<?php echo site_url($controller.'/edit_driver/'.$user_id) ?>" method="post" enctype="multipart/form-data"  >
                                <input type="hidden" name="mode_pass" id="mode_pass" value="updateDriverPassword">

<div class="forgat-section">

            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="password">Password <span>*</span></label>
                         <input type="password" id="password" name="password">
                         <!-- <div class="error-red">This field is required</div> -->
                     </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="password">Confirm Password <span>*</span></label>
                         <input type="password" id="cpassword" name="cpassword">
                         <!-- <div class="error-red">This field is required</div> -->
                     </div>
                </div>                
            </div>
          
            <div class="forgat-button">
                <button type="submit" class="forgat-button-style">Change Password</button>
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