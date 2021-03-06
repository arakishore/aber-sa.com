<!doctype html>
<html lang=en-US>
<head>
<?php $this->load->view('inc_header_commoncss');?>
</head>
<body>   
<?php $this->load->view('inc_header_menu');?> 
   
    <div class="trans-menu-join-bg">
        <img src="<?php echo base_url();?>assets/images/banner-right-section-img.png" alt="banner-right-section-img" />
    </div>  
    <div class="trans-banner-section">
        <div class="trans-blank-section"></div>
        <div class="container">
            <div class="trans-banner-section-content">
                <div class="trans-banner-content-line"></div>
                <div class="trans-banner-content-head">
                    Get easily connected 
                </div>
                <div class="trans-banner-content-txt wow fadeInDown" data-wow-delay="2.3s">
                    Carriers and Shippers connecting each other at one Finger touch
                </div>
            </div>
        </div>
        <div class="trans-banner-truck-img wow fadeInRight" data-wow-delay="2.3s">
            <img src="<?php echo base_url();?>assets/images/banner-truck-img.png" alt="banner-truck-img" />
        </div>
        <div class="trans-banner-go-down">
            <a href="#trans-category" class="slide-to">
                <img src="<?php echo base_url();?>assets/images/banner-go-down-arrow.png" alt="banner-go-down-arrow"/>
            </a>
        </div>
    </div> 
    <div id="trans-category" class="trans-cate-section-main">
        <img src="<?php echo base_url();?>assets/images/orrenge-squre-left.png" class="trans-cate-orrenge-img" alt="orrenge-squre-left" />
        <div class="container">
            <div class="trans-cate-section-respo swiper-container trans-cate-respo-slider">
                <div class="swiper-wrapper">
                <?php
                if(isset($categorySubcategory) && sizeof($categorySubcategory)>0){

                    foreach($categorySubcategory as $key => $result){
                        $category_id = $result['category_id'];
                        $name = $result['name'];
                         $image = $result['image'];
                ?>
                    <div class="swiper-slide">
                        <div class="trans-cate-content-section wow bounce" data-wow-delay="0.2s">
                            <a href="<?php echo site_url("request/subcategory/".$category_id);?>">
                                <div class="trans-cate-content-img">
                                    <img src="<?php echo $image;?>" class="trans-cate-gray-img" alt="<?php echo $name?>" />
                                    <img src="<?php echo $image;?>" class="trans-cate-white-img" alt="<?php echo $name?>" />
                                </div>
                                <div class="trans-cate-content-name">
                                    <?php echo $name?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php 
                    }
                }
                ?>     
                </div>
            </div>
        </div>
    </div>
    <div class="trans-about-us-main">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 trans-about-col-img">
                <div class="trans-about-us-img wow fadeInLeft">
                    <img src="<?php echo base_url();?>uploads/para_images/<?php echo $this->common->getDbValue($cms_data_1['cms_image'])?>" alt="home-about-us-img" />
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 trans-about-col">
                <div class="trans-about-us-content wow fadeInRight">
                    <div class="trans-banner-content-line"></div>
                    <div class="trans-why-choose-us-head">
                        Why choosee us
                    </div>
                    <div class="trans-aboutus-head">
                        <?php echo $this->common->getDbValue(trim($cms_data_1['cms_title']))?>
                    </div>
                    <div class="trans-aboutus-content">
                    <?php echo $this->common->getDbValue(trim($cms_data_1['cms_desc']))?>                        
                    </div>
                </div>
            </div>
        </div>                
    </div>
    <div class="trans-counter-section-main">
        <div class="trans-counter-section-blue-right">
            <img src="<?php echo base_url();?>assets/images/aboutus-blue-right-img.png" alt="aboutus-blue-right-img" />
        </div>
        <div class="container">
            <div class="trans-counter-section-respo">
                <div class="row trans-counter-section-row">
                    <div class="col-sm-4 col-md-4 col-lg-4 trans-counter-section-col">
                        <div class="trans-counter-main">
                            <div class="trans-counter-circle wow rotateOut">
                                <div class="trans-counter-circle-inner"></div>
                                <div class="trans-counter-circle-inner-count">
                                    <span class="wow zoomIn" data-wow-delay="1.4s">1.5M</span>
                                </div>                            
                            </div>
                            <div class="trans-counter-name wow zoomIn" data-wow-delay="1.4s">
                                CUSTOMERS
                            </div>
                        </div>
                    </div>  
                    <div class="col-sm-4 col-md-4 col-lg-4 trans-counter-section-col">
                        <div class="trans-counter-main">
                            <div class="trans-counter-circle trans-transporters-circle wow rotateOut">
                                <div class="trans-counter-circle-inner"></div>
                                <div class="trans-counter-circle-inner-count">
                                    <span class="wow zoomIn" data-wow-delay="1.4s">55000</span>
                                </div>                            
                            </div>
                            <div class="trans-counter-name wow zoomIn" data-wow-delay="1.4s">
                                TRANSPORTERS
                            </div>
                        </div>
                    </div>  
                    <div class="col-sm-4 col-md-4 col-lg-4 trans-counter-section-col">
                        <div class="trans-counter-main">
                            <div class="trans-counter-circle trans-listing-circle wow rotateOut">
                                <div class="trans-counter-circle-inner"></div>
                                <div class="trans-counter-circle-inner-count">
                                    <span class="wow zoomIn" data-wow-delay="1.4s">4.1M</span>
                                </div>                            
                            </div>
                            <div class="trans-counter-name wow zoomIn" data-wow-delay="1.4s">
                                LISTINGS
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>
    <div class="trans-mobile-application-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="trans-about-us-content wow fadeInLeft">
                        <div class="trans-banner-content-line"></div>
                        <div class="trans-why-choose-us-head">
                            Download
                        </div>
                        <div class="trans-aboutus-head">
                            <?php echo $this->common->getDbValue(trim($cms_data_3['cms_title']))?>
                        </div>
                        <div class="trans-aboutus-content">
                        <?php echo $this->common->getDbValue(trim($cms_data_3['cms_desc']))?>
                        </div>
                        <div class="trans-store-btns">
                            <a href="javascript:void(0);" class="trans-btns-hover-effect trans-google-store-btns">
                                <img src="<?php echo base_url();?>assets/images/mobile-app-google-play-btn.png" alt="mobile-app-google-play-btn" />
                            </a>
                            <a href="javascript:void(0);" class="trans-btns-hover-effect trans-google-store-btns trans-app-store-btns">
                                <img src="<?php echo base_url();?>assets/images/mobile-app-app-store-btn.png" alt="mobile-app-app-store-btn" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="trans-mobile-app-images">
                        <img src="<?php echo base_url();?>uploads/para_images/<?php echo $this->common->getDbValue($cms_data_3['cms_image'])?>" alt="mobile-app-big-mobile" class="mobile-app-big-mobile wow fadeInRight" />
                        <img src="<?php echo base_url();?>assets/images/mobile-app-small-mobile.png" alt="mobile-app-big-mobile" class="mobile-app-small-mobile wow fadeInLeft" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="trans-lets-get-started-main">
        <div class="trans-lets-get-left-blue">
            <img src="<?php echo base_url();?>assets/images/lets-get-started-blue-left.png" alt="lets-get-started-blue-left" />
        </div>
        <div class="container">
            <div class="trans-lets-get-head wow fadeInDown">
                <div class="trans-banner-content-line"></div>            
                <div class="trans-aboutus-head">
                    LETS GET <span>STARTED!</span>
                </div>
            </div>
            <div class="trans-lets-get-radio wow zoomIn">
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4 offset-lg-2">
                        <div class="trans-radio-btns">  
                            <div class="trans-radio-btn">
                                <input type="radio" id="f-option" name="selector">
                                <label for="f-option">
                                    <span class="trans-radio-icon">
                                        <img src="<?php echo base_url();?>assets/images/radio-customer-icon.png" alt="radio-customer-icon" />
                                        <span class="trans-radio-gray-circle"></span>
                                        <span class="trans-radio-gray-border"></span>
                                    </span>
                                    <span class="trans-radio-btn-txt">I am a Customer</span>
                                </label>
                                <div class="trans-check"><img src="<?php echo base_url();?>assets/images/saved-card-check.png" alt="saved-card-check" /> </div>
                            </div>                            
                            <div class="clearfix"></div>
                        </div>        
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">    
                        <div class="trans-radio-btns">                              
                            <div class="trans-radio-btn">
                                <input type="radio" id="s-option" name="selector">
                                <label for="s-option">
                                    <span class="trans-radio-icon">
                                        <img src="<?php echo base_url();?>assets/images/radio-service-provider-icon.png" alt="radio-customer-icon" />
                                        <span class="trans-radio-gray-circle trans-gray-2"></span>                                        
                                    </span>
                                    <span class="trans-radio-btn-txt"> I am a Service Provider</span>
                                </label>
                                <div class="trans-check"><img src="<?php echo base_url();?>assets/images/saved-card-check.png" alt="saved-card-check" /> </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <?php $this->load->view('inc_footer');?>  

    <?php $this->load->view('inc_common_footer_js');?>  
</body>