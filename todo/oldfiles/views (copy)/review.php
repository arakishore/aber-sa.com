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
                              <li class="list-group-item bg-transparent">
                                <div class="media align-items-center">
                                  <img src="<?php echo base_url();?>assets/images/user-img.jpg" alt="user avatar" class="customer-img rounded-circle">
                                <div class="media-body ml-3">
                                  <h6 class="mb-0">iPhone X <small class="ml-4">08.34 AM</small></h6>
                                  <p class="mb-0 small-font">Sara Jhon : This i svery Nice phone in low budget.</p>
                                </div>
                                <div class="star">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                  <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                </div>
                              </div>
                              </li>
                              <li class="list-group-item bg-transparent">
                                <div class="media align-items-center">
                                  <img src="<?php echo base_url();?>assets/images/user-img.jpg" alt="user avatar" class="customer-img rounded-circle">
                                <div class="media-body ml-3">
                                  <h6 class="mb-0">Air Pod <small class="ml-4">05.26 PM</small></h6>
                                  <p class="mb-0 small-font">Danish Josh : The brand apple is original !</p>
                                </div>
                                 <div class="star">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                  <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                </div>
                              </div>
                              </li>
                              <li class="list-group-item bg-transparent">
                                <div class="media align-items-center">
                                  <img src="<?php echo base_url();?>assets/images/user-img.jpg" alt="user avatar" class="customer-img rounded-circle">
                                <div class="media-body ml-3">
                                  <h6 class="mb-0">Mackbook Pro <small class="ml-4">06.45 AM</small></h6>
                                  <p class="mb-0 small-font">Jhon Doe : Excllent product and awsome quality</p>
                                </div>
                                 <div class="star">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                  <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                </div>
                              </div>
                              </li>
                              <li class="list-group-item bg-transparent">
                                <div class="media align-items-center">
                                  <img src="<?php echo base_url();?>assets/images/user-img.jpg" alt="user avatar" class="customer-img rounded-circle">
                                <div class="media-body ml-3">
                                  <h6 class="mb-0">Air Pod <small class="ml-4">08.34 AM</small></h6>
                                  <p class="mb-0 small-font">Christine : The brand apple is original !</p>
                                </div>
                                 <div class="star">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                  <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                </div>
                              </div>
                              </li>
                              <li class="list-group-item bg-transparent">
                                <div class="media align-items-center">
                                  <img src="<?php echo base_url();?>assets/images/user-img.jpg" alt="user avatar" class="customer-img rounded-circle">
                                <div class="media-body ml-3">
                                  <h6 class="mb-0">Mackbook <small class="ml-4">08.34 AM</small></h6>
                                  <p class="mb-0 small-font">Michle : The brand apple is original !</p>
                                </div>
                                 <div class="star">
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <i class="fa fa-star" aria-hidden="true"></i>
                                  <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                  <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                </div>
                              </div>
                              </li>
                            </ul>
                        </div>
                    </div>
                </div>                                
            </div> 
        </div>

    <?php $this->load->view('inc_footer');?>
	<?php $this->load->view('inc_common_footer_inner_js');?>    

    
</body>