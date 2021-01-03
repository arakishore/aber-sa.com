<?php
$session_user_data = $this->session->userdata('user_data');
 
if (isset($session_user_data['user_type']) && $session_user_data['user_type'] == "Customer") {
    $controller = "customer";
} else {
    $controller = "serviceprovider";
}
 
?>
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
                    if($controller=="customer"){
                    $this->load->view('inc_customer_left');
                    } else {
                        $this->load->view('inc_service_left');
                    }
                    ?>
                    <div class="col-sm-12 col-md-12 col-lg-9">                        
                        <div class="fb-notification-messages-main">
                            <div class="fb-noti-message-date">
                                Today
                            </div>
                            <div class="fb-noti-msg-section">   
                                <div class="fb-noti-msg-time">
                                    7:31 pm
                                </div>
                                <div class="fb-noti-msg-head">
                                    Message from your Delivery Guy
                                </div>
                                <div class="fb-noti-msg-txt">
                                    I'm waiting at the door, please collect your order.
                                </div>
                            </div>
                            <div class="fb-noti-msg-section">   
                                <div class="fb-noti-msg-time">
                                    7:22 pm
                                </div>
                                <div class="fb-noti-msg-head">
                                    Your order is arriving soon
                                </div>
                                <div class="fb-noti-msg-txt">
                                    Your order form Food Mania will be there at your door soon.
                                </div>
                            </div>
                        </div> 
                        <div class="fb-notification-messages-main">
                            <div class="fb-noti-message-date">
                                Yesterday
                            </div>
                            <div class="fb-noti-msg-section">   
                                <div class="fb-noti-msg-time">
                                    7:31 pm
                                </div>
                                <div class="fb-noti-msg-head">
                                    Message from your Delivery Guy
                                </div>
                                <div class="fb-noti-msg-txt">
                                    I'm waiting at the door, please collect your order.
                                </div>
                            </div>
                            <div class="fb-noti-msg-section">   
                                <div class="fb-noti-msg-time">
                                    7:22 pm
                                </div>
                                <div class="fb-noti-msg-head">
                                    Your order is arriving soon
                                </div>
                                <div class="fb-noti-msg-txt">
                                    Your order form Food Mania will be there at your door soon.
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>                                
            </div>
        </div>

    <?php $this->load->view('inc_footer');?>

    <!--Main JS-->
    <?php $this->load->view('inc_common_footer_inner_js');?>    
    
</body>