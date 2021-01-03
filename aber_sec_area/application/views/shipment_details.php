<!doctype html>
<html lang=en-US>
<head>
<?php $this->load->view('inc_header_commoncss');?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker.min.css"> 
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/slick.css">   

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
                    NEW DELIVERY
                </div>                
            </div>
        </div>
<!--         <div class="trans-banner-truck-img">
            <img src="<?php echo base_url();?>assets/images/inner-pages-banner-truck.png" alt="banner-truck-img" />
        </div> -->  
        <div class="trans-caet-banner-bottom-img"></div>      
    </div>  
    <div class="trans-shipment-detials-main">
    
        <div class="container">
			<?php $this->load->view('inc_error');?>
            <div class="trans-shipment-steps-main">
                <div class="trans-shipment-steps-head">
                    <?php echo $this->common->getDbValue($requests['request_title']); ?>
                </div>                
            </div>                
            <div class="row" style="margin-top: 50px;">
                <div class="col-sm-8 col-md-8 col-lg-9 shipment-details-middle-content">                    
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="shipment-listing-info">
                                <div class="shipment-listing-info-head">
                                    Shipment Listing Information
                                </div>
                                <div class="shipment-listing-main">
                                    <div class="shipment-listing-head">
                                        Delivery Title
                                    </div>
                                    <div class="shipment-listing-contnet">
                                        <?php echo $this->common->getDbValue($requests['request_title']); ?>
                                    </div>
                                </div>
                                <div class="shipment-listing-main">
                                    <div class="shipment-listing-head">
                                        Shipment ID
                                    </div>
                                    <div class="shipment-listing-contnet">
                                        #<?php echo $this->common->getDbValue($requests['shipment_id']); ?>
                                    </div>
                                </div>
                                <div class="shipment-listing-main">
                                    <div class="shipment-listing-head">
                                        Customer
                                    </div>
                                    <div class="shipment-listing-contnet">
                                        <?php echo $this->common->getDbValue($customer['first_name']); ?> <?php echo $this->common->getDbValue($customer['last_name']); ?>
                                    </div>
                                </div>
                                <div class="shipment-listing-main">
                                    <div class="shipment-listing-head">
                                        Date Listed
                                    </div>
                                    <div class="shipment-listing-contnet">
                                        <?php echo $this->common->getDateFormat($requests['insert_date'], 'd-M-Y h:i');; ?> 
                                    </div>
                                </div>
                                
                                <div class="shipment-listing-main">
                                    <div class="shipment-listing-head">
                                        Ends
                                    </div>
                                    <div class="shipment-listing-contnet">
                                        <?php echo $this->common->getDbValue($requests['expected_travelling_time']); ?>  <br> <?php echo $this->common->getDateFormat($requests['latest_pickup_date'], 'd M Y'); ?> 
                                    </div>
                                </div>
								<div class="shipment-listing-main">
                                    <div class="shipment-listing-head">
                                        Miles
                                    </div>
                                    <div class="shipment-listing-contnet">
                                        <?php echo $this->common->getDbValue($requests['distance_mile']); ?>
                                    </div>
                                </div>

								<div class="shipment-listing-main">
                                    <div class="shipment-listing-head">
                                        Travel Time
                                    </div>
                                    <div class="shipment-listing-contnet">
                                        <?php echo $this->common->getDbValue($requests['expected_travelling_time']); ?> HRS
                                    </div>
                                </div>
                                                                
                                <div class="shipment-listing-main">
                                    <div class="shipment-listing-head">
                                        Budget
                                    </div>
                                    <div class="shipment-listing-contnet">
                                        SR <?php echo $this->common->getDbValue($requests['budget_amount']); ?>
                                    </div>
                                </div>
                                <div class="shipment-listing-main">
                                    <div class="shipment-listing-head">
                                        # of Quotes
                                    </div>
                                    <div class="shipment-listing-contnet">
                                        <?php echo sizeof($req_quotes)?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="shipment-listing-info">
                                <div class="shipment-listing-info-head">
                                    Origin, Destination
                                </div>
                                <div class="colection-head-section-main">
                                    <div class="colection-head-section">
                                        Collection
                                    </div>
                                    <div class="colection-head-content">
                                        <div class="colection-head-content-txt">
                                            <div class="colection-head-content-arrow">
                                                <img src="<?php echo base_url();?>assets/images/table-up-arrow-img.png" alt="table-up-arrow-img" />
                                            </div>
                                            <div class="colection-content-txt-head">
                                                <?php echo $this->common->getDbValue($requests['pickup_location']); ?>
                                            </div>
                                            <div class="colection-content-txt">
                                                Collection <?php echo $this->common->getDateFormat($requests['pickup_date'], 'd M Y'); ?> to <?php echo $this->common->getDateFormat($requests['latest_pickup_date'], 'd M Y'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="colection-head-section-main">
                                    <div class="colection-head-section">
                                        Delivery
                                    </div>
                                    <div class="colection-head-content">
                                        <div class="colection-head-content-txt">
                                            <div class="colection-head-content-arrow">
                                                <img src="<?php echo base_url();?>assets/images/table-down-arrow-img.png" alt="table-up-arrow-img" />
                                            </div>
                                            <div class="colection-content-txt-head">
                                                <?php echo $this->common->getDbValue($requests['destination_location']); ?>
                                            </div>
                                            <div class="colection-content-txt">
                                                Collection <?php echo $this->common->getDateFormat($requests['drop_destination_date'], 'd M Y'); ?> to <?php echo $this->common->getDateFormat($requests['latest_drop_destination_date'], 'd M Y'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-3">      
<?php if (isset($cons_images) && sizeof($cons_images)>0) {  ?>                               
                    <div class="shipment-listing-info-head shipment-picture">
                        Shipment Pictures
                    </div>
                    <div class="shipment-pictures-section">
                    <!-- /.carousel -->
                        <div class="trans_main_slider">
                        <?php foreach($cons_images as $key => $imgs){ 
						
							$sel_photo = base_url().'assets/images/user-img.jpg';
							if($imgs['image_name']) {
								$sel_photo = base_url().'uploads/consignmentimage/'.$imgs['image_name'];
							}						
						?>
                          <div>
                            <img src="<?php echo $sel_photo?>" alt="slider">
                          </div>
                        <?php } ?>   
                        </div>
                        <!-- /.carousel -->
                    </div>
<?php } ?>                    
                </div>
            </div>
            <div class="route-information-section-main">
                <div class="route-information-head">
                    Route Information
                </div>               
                <div class="route-information-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d121048.04380827247!2d73.82958079999999!3d18.5401344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1607749861136!5m2!1sen!2sin" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div> 
            </div>
            <div class="shipment-listing-info">
                <div class="shipment-listing-info-head">
                    <?php echo $this->common->getDbValue($requests['category_name']); ?> & <?php echo $this->common->getDbValue($requests['subcategory_name']); ?>
                </div>
                <div class="vehicle-name-details">
                    <?php echo $this->common->getDbValue($requests['request_title']); ?>
                </div>
                <div class="vehicle-name-details-content">
                    
                    <div class="vehicle-name-details-info vehicle-total-weight">
                        <div class="vehicle-count-details">
                            <?php echo $total_weight?> kg
                        </div>
                        <div class="vehicle-count-label">
                            Total Weight
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
<?php if (isset($items) && sizeof($items)>0) {  ?>            
            <div class="vehicel-full-information-section">
                <div class="vehicel-count-section">
                    <span>Vehicle Items</span>
                </div>
                <?php foreach($items as $key => $itm){ ?>
                <div class="row">
                    
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <div class="vehicel-full-main vehicel-full-size">
                            <div class="vehicel-full-information-head">
                                Length:
                            </div>
                            <div class="vehicel-full-information-txt">
                                <?php echo $this->common->getDbValue($itm['consignment_length']); ?> <?php echo $this->common->getDbValue($itm['consignment_length_unit']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <div class="vehicel-full-main vehicel-full-size">
                            <div class="vehicel-full-information-head">
                                Width:
                            </div>
                            <div class="vehicel-full-information-txt">
                                <?php echo $this->common->getDbValue($itm['consignment_width']); ?> <?php echo $this->common->getDbValue($itm['consignment_width_unit']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <div class="vehicel-full-main vehicel-full-size">
                            <div class="vehicel-full-information-head">
                                Height:
                            </div>
                            <div class="vehicel-full-information-txt">
                                <?php echo $this->common->getDbValue($itm['consignment_height']); ?> <?php echo $this->common->getDbValue($itm['consignment_height_unit']); ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <div class="vehicel-full-main">
                            <div class="vehicel-full-information-head">
                                Kerb Weight:
                            </div>
                            <div class="vehicel-full-information-txt">
                                <?php echo $this->common->getDbValue($itm['consignment_weight']); ?> <?php echo $this->common->getDbValue($itm['consignment_weight_unit']); ?>
                            </div>
                        </div>  
                    </div>
                    
                </div>
                <?php } ?>
            </div>
<?php } ?>
<?php if (isset($req_quotes) && sizeof($req_quotes)>0) {  ?>            
            <div class="trans-shipment-information-main">
                <div class="trans-shipment-information-head">
                    Shipment Information
                </div>
                <div class="trans-shipment-information-table">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <td>Price</td>
                            <td>Transporter/Courier</td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($req_quotes as $key => $qts){ ?>
                          <tr>
                            <td><div class="transporter-price-section">SR <?php echo number_format($this->common->getDbValue($qts['quote_amount']),2); ?></div></td>
                            <td><div class="transporter-name"><?php echo $this->common->getDbValue($qts['first_name']); ?> <?php echo $this->common->getDbValue($qts['last_name']); ?></div>
                              <div class="transporter-ratings"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> </div></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
<?php } ?>            
     <form name="frm-edit" id="frm-edit" action="<?php echo site_url($controller.'/shipment_details/'.$request_id) ?>" method="post" enctype="multipart/form-data"  >
		<input type="hidden" name="mode_add_bid" id="mode_add_bid" value="add_bid">
        <input type="hidden" name="request_user_id" id="request_user_id" value="<?php echo $this->common->getDbValue($requests['user_id']); ?>">
            
            <div class="place-quote-form-section">
                <div class="quote-starting-lowest-section">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="starting-input-section">
                                <div class="starting-input-label">  
                                    Enter Bid Amount
                                </div>
                                <div class="starting-input">
                                    <input type="text" name="quote_amount" id="quote_amount" value=""  required/>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="enter-lowest-amount-txt">
                                <div class="details-matter-icon">
                                    <i class="fal fa-exclamation-circle"></i>
                                </div> 
                                Enter a lowest amount to automatically underquote other services
                            </div>
                        </div>
                    </div>
                    <div class="check-box add-enaqel-fee">
                        <input id="terms" name="terms" class="filled-in" type="checkbox" required>
                        <label for="terms">Accept Term & Conditions</label>                        
                    </div>
                </div>

                <div class="quote-service-seciton-main">
                    <div class="quote-service-head">
                        Transport Timeframe <span><i class="fal fa-angle-down"></i></span>
                    </div>
                    <div class="drop-section-block-main">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="collection-field-form-section collection-field-left">
                                    <div class="collection-field-head">
                                        Pick Up  <span style="color: red;">*</span>
                                    </div>
                                    <div class="radio-btns collection-field-radio">  
                                                Will collect within days of booking
                                        <div class="clearfix"></div>                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group trans-shipment-city-postcode">
                                                <input type="text" name="pickup_date" id="pickup_date" required class="form-control datepicker" placeholder="">
                                                <img src="<?php echo base_url();?>assets/images/input-calender-icon.png" alt="input-up-arrow-icon" />
                                            </div>
                                        </div>
                                    </div>                                
                                     
                                </div>
                            </div> 
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="collection-field-form-section">
                                    <div class="collection-field-head">
                                        Drop <span style="color: red;">*</span>
                                    </div>
                                    <div class="radio-btns collection-field-radio">  
                                                Will collect within days of booking
                                        <div class="clearfix"></div>                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group trans-shipment-city-postcode">
                                                <input type="text" name="drop_date" id="drop_date" required class="form-control datepicker" placeholder="">
                                                <img src="<?php echo base_url();?>assets/images/input-calender-icon.png" alt="input-up-arrow-icon" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
                <!--<div class="quote-service-seciton-main quote-expiration-main">
                    <div class="quote-service-head">
                        Quote Expiration <span><i class="fal fa-angle-down"></i></span>
                    </div>
                    <div class="drop-section-block-main">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="radio-btns collection-field-radio">  
                                    <div class="radio-btn">
                                        <input type="radio" id="quote_expiration_1" name="quote_expiration"  value="0" checked>
                                        <label for="quote_expiration_1">
                                            Standard: 24 hours after auction has ended
                                        </label>
                                        <div class="check"></div>                                    
                                    </div>    
                                    <div class="clearfix"></div>                        
                                </div>
                                <div class="radio-btns collection-field-radio">  
                                    <div class="radio-btn">
                                        <input type="radio" id="quote_expiration_2" name="quote_expiration" value="1">
                                        <label for="quote_expiration_2">
                                            Custome: Before auciton ends
                                        </label>
                                        <div class="check"></div>                                    
                                    </div>    
                                    <div class="clearfix"></div>                        
                                </div>
                                <div class="quote-exp-date">
                                    Quote expires on 13-06-2017 @10:38 
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="enter-lowest-amount-txt">
                                    <div class="details-matter-icon">
                                        <i class="fal fa-exclamation-circle"></i>
                                    </div> 
                                    <div class="notes-head">Notes:</div>
                                    <span>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the.
                                    </span>
                                    <span>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem.
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="quote-service-seciton-main quote-expiration-main">
                    <div class="quote-service-head">
                        Note to Shipint Customer <span><i class="fal fa-angle-down"></i></span>
                    </div>
                    <div class="drop-section-block-main">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="note-shipping-customer">
                                    <textarea name="quote_note" id="quote_note"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="enter-lowest-amount-txt">
                                    <div class="details-matter-icon">
                                        <i class="fal fa-exclamation-circle"></i>
                                    </div> 
                                    <div class="notes-head">Notes:</div>
                                    <span>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the.
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem.
                                    </span>                                
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
<div class="forgat-button">
                <button type="submit" class="forgat-button-style">BID</button>
            </div>  
            </div>  
                                      
                        </div>
                    </div>
                </div>
            </div>
</form>            
        </div>
    </div> 
    <?php $this->load->view('inc_footer');?>

    <!--Main JS-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>                
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/create-listing.js"></script>    
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>    
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/slick.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/common_inner.js"></script>
    <script>
        $(".quote-service-head").on("click", function(){
            $(this).siblings(".drop-section-block-main").slideToggle("slow")
            $(this).toggleClass("active");
        });
    </script>    
</body>