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
                       Notifications
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
<?php if (isset($todays_not) && sizeof($todays_not)>0) {  ?>                                        
                        <div class="fb-notification-messages-main">
                            <div class="fb-noti-message-date">
                                Notifications list
                            </div>
<?php foreach($todays_not as $key => $value){  ?>                            
                            <div class="fb-noti-msg-section">   
                                <div class="fb-noti-msg-time">
                                    <?php echo $this->common->getDateFormat($value['not_date'], 'd-M-Y h:i');; ?>
                                </div>
                                <div class="fb-noti-msg-head">
                                    <?php echo $this->common->getDbValue($value['not_title']); ?>
                                </div>
                                <div class="fb-noti-msg-txt">
                                    <?php echo $this->common->getDbValue($value['not_text']); ?>
                                </div>
                            </div>
<?php } ?>                            
                            
                        </div> 
<?php } else { ?>
<div class="alert alert-warning" role="alert">
  No notifications found!
</div>
<?php } ?>                        
                    </div>
                </div>                                
            </div>
        </div>

    <?php $this->load->view('inc_footer');?>

    <!--Main JS-->
    <?php $this->load->view('inc_common_footer_inner_js');?>    
    
</body>