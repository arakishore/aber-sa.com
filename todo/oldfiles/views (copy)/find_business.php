<!doctype html>
<html lang=en-US>
<head>
<?php $this->load->view('inc_header_commoncss');?>
<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">    
</head>
<body>    
    <?php $this->load->view('inc_header_menu_account');?>   
    <div class="trans-menu-join-bg">
        <img src="<?php echo base_url();?>assets/images/banner-right-section-img.png" alt="banner-right-section-img" />
    </div>  
    <div class="trans-banner-section trans-select-category-banner">
        <div class="trans-blank-section"></div>
        <div class="container">
            <div class="trans-banner-section-content">
                <div class="trans-banner-content-line"></div>
                <div class="trans-select-category-head">
                    Find Business
                </div>                
            </div>
        </div>
       
        <div class="trans-caet-banner-bottom-img"></div>      
    </div>  
    <div class="trans-select-cate-section-main">
        <div class="container">  

                                          
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="find-business-left-bar">
                        <ul>
                            <li class="find-business-main-li">
                                <a href="javascript:void(0);" class="main-category-head">
                                    Categories <span><i class="fal fa-angle-down"></i></span>
                                </a>
                                <ul class="checkbox-menus">
                                    <li>
                                        <div class="check-box">
                                            <input id="blanket" class="filled-in" type="checkbox">
                                            <label for="blanket">Household Goods</label>
                                            <span class="check-box-plus"><i class="fal fa-plus"></i></span>
                                        </div>
                                        <ul class="checkbox-inner-section">
                                            <li><a href="javascript:void(0);">New Menu</a></li>
                                            <li><a href="javascript:void(0);">Menu New</a></li>
                                            <li><a href="javascript:void(0);">Inner Checkbox</a></li>
                                            <li><a href="javascript:void(0);">New Menu</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="check-box">
                                            <input id="blanket" class="filled-in" type="checkbox">
                                            <label for="blanket">Moving</label>
                                            <span class="check-box-plus"><i class="fal fa-plus"></i></span>
                                        </div>
                                        <ul class="checkbox-inner-section">
                                            <li><a href="javascript:void(0);">New Menu</a></li>
                                            <li><a href="javascript:void(0);">Menu New</a></li>
                                            <li><a href="javascript:void(0);">Inner Checkbox</a></li>
                                            <li><a href="javascript:void(0);">New Menu</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="check-box">
                                            <input id="blanket" class="filled-in" type="checkbox">
                                            <label for="blanket">Vehicles</label>
                                            <span class="check-box-plus"><i class="fal fa-plus"></i></span>
                                        </div>
                                        <ul class="checkbox-inner-section">
                                            <li><a href="javascript:void(0);">New Menu</a></li>
                                            <li><a href="javascript:void(0);">Menu New</a></li>
                                            <li><a href="javascript:void(0);">Inner Checkbox</a></li>
                                            <li><a href="javascript:void(0);">New Menu</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="check-box">
                                            <input id="blanket" class="filled-in" type="checkbox">
                                            <label for="blanket">Motercyles</label>
                                            <span class="check-box-plus"><i class="fal fa-plus"></i></span>
                                        </div>
                                        <ul class="checkbox-inner-section">
                                            <li><a href="javascript:void(0);">New Menu</a></li>
                                            <li><a href="javascript:void(0);">Menu New</a></li>
                                            <li><a href="javascript:void(0);">Inner Checkbox</a></li>
                                            <li><a href="javascript:void(0);">New Menu</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>   
                            <li class="find-business-main-li">
                                <a href="javascript:void(0);" class="main-category-head">
                                    Origin <span><i class="fal fa-angle-down"></i></span>
                                </a>
                                <ul class="checkbox-menus">
                                    <div class="origination-address">
                                        Origination address
                                    </div>
                                    <div class="origination-address-textarea">
                                        <textarea name="origination address" placeholder="Enter Origination Address"></textarea>
                                    </div>
                                </ul>
                            </li>
                            <li class="find-business-main-li">
                                <a href="javascript:void(0);" class="main-category-head">
                                    Destination <span><i class="fal fa-angle-down"></i></span>
                                </a>
                                <ul class="checkbox-menus">
                                    <div class="origination-address">
                                        Destination address
                                    </div>
                                    <div class="origination-address-textarea">
                                        <textarea name="origination address" placeholder="Enter Destination Address"></textarea>
                                    </div>
                                </ul>
                            </li>  
                            <li class="find-business-main-li">
                                <a href="javascript:void(0);" class="main-category-head">
                                    Date of listing <span><i class="fal fa-angle-down"></i></span>
                                </a>
                                <ul class="checkbox-menus">
                                    <div class="date-listing-inputs">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group trans-shipment-city-postcode">
                                                    <input type="text" name="city post code" class="form-control datepicker" placeholder="Earliest">
                                                    <img src="<?php echo base_url();?>assets/images/input-calender-icon.png" alt="input-up-arrow-icon" />
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group trans-shipment-city-postcode">
                                                    <input type="text" name="city post code" class="form-control datepicker" placeholder="Latest">
                                                    <img src="<?php echo base_url();?>assets/images/input-calender-icon.png" alt="input-up-arrow-icon" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="submit-date-btn">
                                            <a href="javascript:void(0);" class="btn-submit-date">Go</a>
                                        </div>
                                    </div>
                                </ul>
                            </li>                          
                        </ul>                    
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-9">
                    <div class="select-sort-btn">
                        <a href="javascript:void(0);" class="btn-select-sort">
                            Select Sort 
                            <span>
                                <i class="fa fa-sort-amount-desc"></i>
                                <i class="fa fa-sort-amount-asc"></i>
                            </span>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                    <div class="find-business-list-section-main">
                        <div class="find-business-list-section">
                            <div class="find-business-list-img">
                                <img src="<?php echo base_url();?>assets/images/shipment-pic-img.jpg" alt="shipment-pic-img" />
                            </div>
                            <div class="find-business-list-content">
                                <div class="find-business-list">
                                    <div class="find-business-list-head">
                                        <a href="<?php echo site_url('serviceprovider/shipment_details')?>">2016 Harley Devidson street</a>
                                    </div>
                                    <div class="find-business-list-cate-icon">
                                        <div class="list-cate-icon-one">
                                            <span><i class="fas fa-car"></i></span>
                                            <span>Car & Light Trucks</span>
                                        </div>
                                        <div class="list-cate-icon-one list-cate-icon-one-small">
                                            <span><i class="fal fa-clock"></i></span>
                                            <span>1d 14h</span>
                                        </div>
                                        <div class="list-cate-icon-one">
                                            <span><i class="fas fa-weight-hanging"></i></span>
                                            <span>128.8kg </span>
                                        </div>
                                        <div class="list-cate-icon-one list-cate-icon-one-small">
                                            <span><i class="fas fa-map-marker-alt"></i></span>
                                            <span>1484 Km</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="find-business-list-right">
                                        <div class="list-sestnation-up">
                                            <span><img src="<?php echo base_url();?>assets/images/table-up-arrow-img.png" alt="table-up-arrow-img" /> </span>
                                            <span>Ludhiana Residential</span>
                                        </div>
                                        <div class="list-sestnation-up">
                                            <span><img src="<?php echo base_url();?>assets/images/table-down-arrow-img.png" alt="table-up-arrow-img" /></span> 
                                            <span>Winnipeg,MB,Canada</span>
                                        </div>
                                        <div class="list-offer-price-section">
                                            Offer <span>$1300</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="find-business-list-section">
                            <div class="find-business-list-img">
                                <img src="<?php echo base_url();?>assets/images/shipment-pic-img.jpg" alt="shipment-pic-img" />
                            </div>
                            <div class="find-business-list-content">
                                <div class="find-business-list">
                                    <div class="find-business-list-head">
                                        2016 Harley Devidson street
                                    </div>
                                    <div class="find-business-list-cate-icon">
                                        <div class="list-cate-icon-one">
                                            <span><i class="fas fa-car"></i></span>
                                            <span>Car & Light Trucks</span>
                                        </div>
                                        <div class="list-cate-icon-one list-cate-icon-one-small">
                                            <span><i class="fal fa-clock"></i></span>
                                            <span>1d 14h</span>
                                        </div>
                                        <div class="list-cate-icon-one">
                                            <span><i class="fas fa-weight-hanging"></i></span>
                                            <span>128.8kg </span>
                                        </div>
                                        <div class="list-cate-icon-one list-cate-icon-one-small">
                                            <span><i class="fas fa-map-marker-alt"></i></span>
                                            <span>1484 Km</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="find-business-list-right">
                                        <div class="list-sestnation-up">
                                            <span><img src="<?php echo base_url();?>assets/images/table-up-arrow-img.png" alt="table-up-arrow-img" /> </span>
                                            <span>Ludhiana Residential</span>
                                        </div>
                                        <div class="list-sestnation-up">
                                            <span><img src="<?php echo base_url();?>assets/images/table-down-arrow-img.png" alt="table-up-arrow-img" /></span> 
                                            <span>Winnipeg,MB,Canada</span>
                                        </div>
                                        <div class="list-offer-price-section">
                                            Offer <span>$1300</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="find-business-list-section">
                            <div class="find-business-list-img">
                                <img src="<?php echo base_url();?>assets/images/shipment-pic-img.jpg" alt="shipment-pic-img" />
                            </div>
                            <div class="find-business-list-content">
                                <div class="find-business-list">
                                    <div class="find-business-list-head">
                                        2016 Harley Devidson street
                                    </div>
                                    <div class="find-business-list-cate-icon">
                                        <div class="list-cate-icon-one">
                                            <span><i class="fas fa-car"></i></span>
                                            <span>Car & Light Trucks</span>
                                        </div>
                                        <div class="list-cate-icon-one list-cate-icon-one-small">
                                            <span><i class="fal fa-clock"></i></span>
                                            <span>1d 14h</span>
                                        </div>
                                        <div class="list-cate-icon-one">
                                            <span><i class="fas fa-weight-hanging"></i></span>
                                            <span>128.8kg </span>
                                        </div>
                                        <div class="list-cate-icon-one list-cate-icon-one-small">
                                            <span><i class="fas fa-map-marker-alt"></i></span>
                                            <span>1484 Km</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="find-business-list-right">
                                        <div class="list-sestnation-up">
                                            <span><img src="<?php echo base_url();?>assets/images/table-up-arrow-img.png" alt="table-up-arrow-img" /> </span>
                                            <span>Ludhiana Residential</span>
                                        </div>
                                        <div class="list-sestnation-up">
                                            <span><img src="<?php echo base_url();?>assets/images/table-down-arrow-img.png" alt="table-up-arrow-img" /></span> 
                                            <span>Winnipeg,MB,Canada</span>
                                        </div>
                                        <div class="list-offer-price-section">
                                            Offer <span>$1300</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagination-seciton">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);">
                                        <i class="fal fa-angle-left"></i> 
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        1
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        2
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        3
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <i class="fal fa-angle-right"></i> 
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    <?php $this->load->view('inc_footer');?>

    <!--Main JS-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>                
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/common.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/create-listing.js"></script>    
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>    

    <script>
        $(".main-category-head").on("click", function(){            
            $(this).siblings(".checkbox-menus").slideToggle("slow");
            $(this).parent().siblings().find(".checkbox-menus").slideUp("slow");
        });
        $(".check-box-plus").on("click", function(){            
            $(this).parent().siblings(".checkbox-inner-section").slideToggle("slow");
            $(this).parent().parent().toggleClass("active");
            $(this).parent().parent().siblings().find(".checkbox-inner-section").slideUp("slow");
            $(this).parent().parent().siblings().removeClass("active");
        });        
        $(".btn-select-sort").on("click", function(){
            $(this).toggleClass("show-asc");
        });
    </script>

</body>