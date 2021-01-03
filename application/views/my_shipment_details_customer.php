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
                            <?php echo ($requests['request_sub_status'] == 'Cancel' ) ? 'Cancel' : 'Active'; ?>
                        </div>
                    </div>
                    <div
                        class="trans-shipment-steps-point <?php if(in_array('Booked',$request_status)){?> active <?php } ?>">
                        <div class="trans-shipment-steps-circle"><span>2</span></div>
                        <div class="trans-shipment-steps-name">
                            Booked
                        </div>
                    </div>
                    <div
                        class="trans-shipment-steps-point <?php if(in_array('Dispatched',$request_status)){?> active <?php } ?>">
                        <div class="trans-shipment-steps-circle"><span>3</span></div>
                        <div class="trans-shipment-steps-name">
                            Dispatched
                        </div>
                    </div>
                    <div
                        class="trans-shipment-steps-point <?php if(in_array('Pick Up',$request_status)){?> active <?php } ?>">
                        <div class="trans-shipment-steps-circle"><span>4</span></div>
                        <div class="trans-shipment-steps-name">
                            Picked Up
                        </div>
                    </div>
                    <div
                        class="trans-shipment-steps-point <?php if(in_array('Delivered',$request_status)){?> active <?php } ?>">
                        <div class="trans-shipment-steps-circle"><span>5</span></div>
                        <div class="trans-shipment-steps-name">
                            Delivered
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
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
                                    <td>Chat</td>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $req_quotes = $requests['bids_list'];
                            foreach($req_quotes as $key => $qts){ ?>
                                <tr>
                                    <td>
                                        <div class="transporter-price-section">SR
                                            <?php echo number_format($this->common->getDbValue($qts['quote_amount']),2); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="transporter-name">
                                            <?php echo $this->common->getDbValue($qts['service_pro_first_name']); ?>
                                            <?php echo $this->common->getDbValue($qts['service_pro_last_name']); ?>
                                        </div>
                                        <div class="transporter-ratings">
                                            <?php for($i=1;$i<=$qts['service_pro_ratings'];$i++){
                                            ?>
                                            <i class="fas fa-star"></i>
                                            <?php    
                                              }  ?>


                                        </div>
                                    </td>

                                    <td>
                                        <span class="message-section-block">
                                            <span><i class="fal fa-comment-lines"></i></span>

                                        </span>

                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-md-8 col-lg-9">
                                              <?php
                                              $customer = $requests['customer_info'];
                                              ?>
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
                                        <?php echo $this->common->getDbValue($customer['first_name']); ?>
                                        <?php echo $this->common->getDbValue($customer['last_name']); ?>
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
                                        Budget
                                    </div>
                                    <div class="shipment-listing-contnet">
                                        SR <?php echo $this->common->getDbValue($requests['budget_amount']); ?>
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
                            SR4,800
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="right-payment-section payment-small-section">
                        <div class="payment-section-head">
                            Auction Service Fee:
                        </div>
                        <div class="payment-section-amount">
                            +0.00
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="right-payment-section payment-small-section">
                        <div class="payment-section-head">
                            Vat:
                        </div>
                        <div class="payment-section-amount">
                            15%
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="right-payment-section payment-total-section">
                        <div class="payment-section-head">
                            Total
                        </div>
                        <div class="payment-section-amount">
                            SR4,800
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

                    <div class="price-action-btn-section">
                        <a href="after-accept-offer-my_shipment_details.html" class="bid-accept-btn">Accept</a>
                        <a href="javascript:void(0);" class="bid-reject-btn">Reject</a>
                    </div>
                                       
<?php 
$cons_images = $requests['consignment_image'];
 
    if (isset($cons_images) && sizeof($cons_images)>0) {  ?>                    
                    <div class="shipment-listing-info-head">
                        Shipment Pictures
                    </div>
                    <div class="shipment-pictures-section">
                    <!-- /.carousel -->
                        <div class="trans_main_slider">
                        <?php foreach($cons_images as $key => $imgs){ 
						
							$sel_photo = base_url().'assets/images/user-img.jpg';
							$sel_photo = $imgs;					
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
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d121048.04380827247!2d73.82958079999999!3d18.5401344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1607749861136!5m2!1sen!2sin"
                        allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>

            <?php
            
            $items = $requests['requests_items'];
            if (isset($items) && sizeof($items)>0) {  ?>            
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
        if (my_val != 'Booked') {
            window.location.href =
                "<?php echo site_url('serviceprovider/change_ship_status/'.$request_id)?>?sel_status=" + my_val;
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