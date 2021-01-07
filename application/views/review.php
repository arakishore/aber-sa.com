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
                       Review
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
                        <div class="card">
                            <div class="card-header">Customer Review
                             <div class="card-action">
                             </div>
                            </div>
                            <ul class="list-group list-group-flush">
                              <?php
                              if(isset($reviews) && sizeof($reviews)>0){

                                foreach($reviews as $key => $val){
                              ?>
                              <li class="list-group-item bg-transparent">
                                <div class="media align-items-center">
                                  <img src="<?php echo base_url();?>assets/images/user-img.jpg" alt="user avatar" class="customer-img rounded-circle">
                                <div class="media-body ml-3">
                                  <h6 class="mb-0"><?php echo $val['request_title']?> <small class="ml-4"><?php echo $val['service_pro_review_date']?></small></h6>
                                  <p class="mb-0 small-font"><?php echo $val['service_pro_review']?></p>
                                </div>
                                <div class="star">
                                  <?php
                                  for($i=1;$i<$val['service_pro_ratings'];$i++){
                                  ?>
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                   <?php }?>
                                </div>
                              </div>
                              </li>
                              <?php
                                }
                            }?>
                            </ul>
                        </div>
                    </div>
                </div>                                
            </div> 
        </div>

    <?php $this->load->view('inc_footer');?>
	<?php $this->load->view('inc_common_footer_inner_js');?>    

    
</body>