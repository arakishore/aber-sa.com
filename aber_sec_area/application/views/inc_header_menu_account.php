<?php
$session_user_data = $this->session->userdata('user_data');
?>
<header class="wow fadeInDown">
        <div class="trans-header-main">
            <div class="trans-menu-layout-black"></div>            
            <button type="button" class="trans-menu-icon trans-nav-trigger trans-js-nav-trigger"><span></span><span></span><span></span></button>
            <div class="trans-header-logo-section">
                <a href="index.html">
                    <img src="<?php echo base_url();?>assets/images/logo.png" alt="logo" />
                </a>
            </div>
            <div class="trans-header-join-menu">
                <ul>
                    <li><a href="<?php echo site_url('serviceprovider')?>"><?php echo (isset($session_user_data['first_name']))?$session_user_data['first_name']:''?></a> &nbsp;&nbsp; | &nbsp;&nbsp;</li>
                    <li><a href="<?php echo site_url('serviceprovider')?>"><img src="<?php echo base_url();?>assets/images/menu-user-icon.png" alt="menu-user-icon" /></a></li>
                </ul>
            </div>
            <div class="trans-header-menu-section">                    
                <div class="trans-responsive-menu-logo-section">
                    <a href="index.html">
                        <img src="<?php echo base_url();?>assets/images/logo.png" alt="logo" />
                    </a>
                </div>
                <ul>
                    <li><a href="<?php echo site_url()?>" class="<?php if(isset($act_id) && $act_id==1){ echo 'active';}?>">Home</a></li>
                    <li><a href="<?php echo site_url('about_us')?>" class="<?php if(isset($act_id) && $act_id==2){ echo 'active';}?>">About Us</a></li>
                    <li><a href="<?php echo site_url('serviceprovider/my_shipment')?>" class="<?php if(isset($act_id) && $act_id==3){ echo 'active';}?>">My Deliveries</a></li>
                </ul>
            </div>                
            <div class="clearfix"></div>            
        </div>        
    </header> 