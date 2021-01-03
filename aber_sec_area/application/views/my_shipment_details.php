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
        
        <div class="trans-caet-banner-bottom-img"></div>      
    </div>  
    <div class="trans-shipment-detials-main">
        <div class="container">
        <?php $this->load->view('inc_error');?>
            <div class="trans-shipment-steps-main">
                <div class="trans-shipment-steps-head">
                    <?php echo $this->common->getDbValue($requests['request_title']); ?>
                </div>
                <div class="trans-shipment-steps">
                    <div class="trans-shipment-steps-point active">
                        <div class="trans-shipment-steps-circle"><span>1</span></div>
                        <div class="trans-shipment-steps-name">
                            Active
                        </div>
                    </div>
                    <div class="trans-shipment-steps-point <?php if($my_quotes['quote_seeker_approval']==1){?> active <?php } ?>">
                        <div class="trans-shipment-steps-circle"><span>2</span></div>
                        <div class="trans-shipment-steps-name">
                            Booked
                        </div>
                    </div>
                    <div class="trans-shipment-steps-point <?php if($requests['request_sub_status']=='Dispatched' || $requests['request_sub_status']=='Picked Up' || $requests['request_sub_status']=='Delivered'){?> active <?php } ?>">
                        <div class="trans-shipment-steps-circle"><span>3</span></div>
                        <div class="trans-shipment-steps-name">
                            Dispatched
                        </div>
                    </div>
                    <div class="trans-shipment-steps-point <?php if($requests['request_sub_status']=='Picked Up' || $requests['request_sub_status']=='Delivered'){?> active <?php } ?>">
                        <div class="trans-shipment-steps-circle"><span>4</span></div>
                        <div class="trans-shipment-steps-name">
                            Picked Up
                        </div>
                    </div>
                    <div class="trans-shipment-steps-point <?php if($requests['request_sub_status']=='Delivered'){?> active <?php } ?>">
                        <div class="trans-shipment-steps-circle"><span>5</span></div>
                        <div class="trans-shipment-steps-name">
                            Delivered
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
<?php if (isset($my_quotes) && $my_quotes['quote_seeker_approval']==1) {  ?>             
            <div class="trans-price-accepted-main">
                <div class="trans-price-accepted-seciton">
                    <div class="trans-price-accepted-head">
                        Your price of SR <?php echo number_format($this->common->getDbValue($my_quotes['quote_amount'])),2; ?> is accepted by <span> <?php echo $this->common->getDbValue($customer['first_name']); ?> <?php echo $this->common->getDbValue($customer['last_name']); ?> </span>
                    </div>
                    <div class="trans-booking-date-section">
                       
                    </div>
                    <div class="trans-price-accepted-content">
                    <?php echo $this->common->getDbValue($my_quotes['quote_note']); ?>
                    </div>
                </div>
                <div class="trans-price-accepted-action-btns">
                    <div class="trans-shipment-deleverd-btn">
                        <a href="javascript:void(0);" class="trans-btn-shipment-deleverd">                      
                        <div id="selector">
                          <select class="form-control rounded-0" onChange="getChange_Status(this.value)">
                          
                            <option class="white" value="Booked">Booked</option>                          
                            <option class="white" value="Dispatched" <?php if($requests['request_sub_status']=='Dispatched'){?> selected <?php } ?>>Dispatched</option>
                            <option class="white" value="Picked Up" <?php if($requests['request_sub_status']=='Picked Up'){?> selected <?php } ?>>Picked Up</option>
                            <option class="white" value="Delivered" <?php if($requests['request_sub_status']=='Delivered'){?> selected <?php } ?>>Shipment Delivered </option>
                          </select>
                          <i class="fa fa-chevron-down"></i>
                        </div></a>
                    </div>

                    <div class="trans-shipment-deleverd-btn">
                        <a href="<?php echo site_url('serviceprovider/assign_driver/'.$request_id)?>" class="trans-btn-shipment-deleverd">Assign Driver</a>
                    </div>
                </div>
                <div class="clearfix"></div>
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
                                    <td>
                                        <div class="transporter-name"><?php echo $this->common->getDbValue($qts['first_name']); ?> <?php echo $this->common->getDbValue($qts['last_name']); ?></div>
                                        <div class="transporter-ratings">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </td>
                                </tr>
                        <?php } ?>        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php } ?>            
            <div class="row">
                <div class="col-sm-8 col-md-8 col-lg-9">
                    
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
                    <div class="right-payment-section">
                        <div class="payment-section-head">
                            Quote
                        </div>
                        <div class="payment-section-amount quote-right-price">
                            SR <?php echo number_format($this->common->getDbValue($my_quotes['quote_amount']),2); ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
<?php
//echo $price = number_format($this->common->getDbValue($my_quotes['quote_amount']),2);
$price = $my_quotes['quote_amount'];
$taxRate=$VAT_PERCENTAGE;
$tax=$price*$taxRate/100;
$admn_fees = $price*$ADMIN_COMMISSION/100;
$grand_total = ($price + $tax + $admn_fees);
?>                    
                    <div class="right-payment-section payment-small-section">
                        <div class="payment-section-head">
                            Auction Service Fee: 
                        </div>
                        <div class="payment-section-amount">
                            +<?php echo number_format($this->common->getDbValue($admn_fees),2); ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="right-payment-section payment-small-section">
                        <div class="payment-section-head">

                            Tax (<?php echo $VAT_PERCENTAGE; ?>%):
                        </div>
                        <div class="payment-section-amount">
                            <?php echo number_format($this->common->getDbValue($tax),2); ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="right-payment-section payment-total-section">
                        <div class="payment-section-head">
                            Total
                        </div>
                        <div class="payment-section-amount">
                            SR <?php echo number_format($this->common->getDbValue($grand_total),2); ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="right-payment-section payment-small-section">
                        <div class="payment-section-head">
                            Payment Method
                        </div>
                        <div class="payment-section-amount">
                            Online 
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
<?php if (isset($cons_images) && sizeof($cons_images)>0) {  ?>                    
                    <div class="shipment-listing-info-head">
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
        </div>
    </div> 
    <?php $this->load->view('inc_footer');?>
<script>
function getChange_Status(my_val) {
	if(my_val!='Booked'){
		window.location.href = "<?php echo site_url('serviceprovider/change_ship_status/'.$request_id)?>?sel_status="+my_val;
	}
}
</script>
    <!--Main JS-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>                
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/create-listing.js"></script>    
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>    
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/slick.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/common_inner.js"></script>
</body>