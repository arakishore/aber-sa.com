<!doctype html>
<html lang=en-US>

<head>
    <?php $this->load->view('inc_header_commoncss');?>
</head>

<body>
    <?php $this->load->view('inc_header_menu');?>

    <div class="trans-menu-join-bg">
        <img src="<?php echo base_url();?>assets/<?php echo base_url();?>assets/images/banner-right-section-img.png" alt="banner-right-section-img">
    </div>

    <div class="trans-banner-section trans-select-category-banner">
        <div class="trans-blank-section"></div>
        <div class="container">
            <div class="trans-banner-section-content">
                <div class="trans-banner-content-line"></div>
                <div class="trans-select-category-head">
                Confirm Details
                </div>
            </div>
        </div>

        <div class="trans-caet-banner-bottom-img"></div>
    </div>
    <div class="trans-select-cate-section-main">
        <div class="container">                 
        <div class="trans-shipment-details-main">
                <div class="trans-shipment-name-section">
                    <div class="trans-shipment-name-head">
                        Your Shipment
                    </div>
                    <div class="trans-shipment-name-content">
                    <?php echo (isset($postdata2['request_title'])) ? $postdata2['request_title'] : ''?>
                    </div>
                </div>
                <div class="trans-shipment-name-section trans-shipment-item-count">
                    <div class="trans-shipment-name-head">
                        Number of Items
                    </div>
                    <div class="trans-shipment-name-content">
                       <?php
                       $consignment_qty =  (isset($postdata2['consignment_qty'])) ? $postdata2['consignment_qty'] : '0';
                       $consignment_qty_temp =0;
                       if(isset($consignment_qty)){
                            foreach($consignment_qty as $key => $val){
                                $consignment_qty_temp = $consignment_qty_temp+ $val;
                            }
                        }
                        echo $consignment_qty_temp;
                       ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>                   
            <div class="confirm-details-form-main">
                
                <div class="order-top-details-section">
                    
                    <div class="order-top-details-tab">
                        <div class="order-top-tab-head">
                            Your Shipment
                        </div>
                        <div class="order-top-tab-content">
                        <?php echo (isset($postdata2['request_title'])) ? $postdata2['request_title'] : ''?>
                        </div>
                    </div>
                    <div class="order-top-details-tab">
                        <div class="order-top-details-icon">
                            <img src="<?php echo base_url();?>assets/images/input-up-arrow-icon.png" alt="input-up-arrow-icon" />
                        </div>
                        <div class="order-top-tab-txt">
                            <div class="order-top-tab-head">
                                Pickup
                            </div>
                            <div class="order-top-tab-content">
                            <?php echo (isset($postdata1['pickup_location'])) ? $postdata1['pickup_location'] : ''?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="order-top-details-tab">
                        <div class="order-top-details-icon">
                            <img src="<?php echo base_url();?>assets/images/input-down-arrow-icon.png" alt="input-up-arrow-icon" />
                        </div>
                        <div class="order-top-tab-txt">
                            <div class="order-top-tab-head">
                                Delivery
                            </div>
                            <div class="order-top-tab-content">
                            <?php echo (isset($postdata1['destination_location'])) ? $postdata1['destination_location'] : ''?>
                            </div>
                        </div>
                    </div>
                    <div class="order-top-details-tab">
                        <div class="btn-modify-section">
                            <a href="<?php echo site_url("request/step1");?>" class="modify-btn-section">
                                <span><i class="fas fa-pencil"></i></span> Modify
                            </a>
                        </div>
                    </div>
                </div>
                <div class="confirm-details-inner-section">
                    
                    <div class="pickup-delivery-datepicker-section">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group trans-shipment-city-postcode">
                                            <label>Pickup Date</label>
                                            <?php echo (isset($postdata1['pickup_date'])) ? $postdata1['pickup_date'] : ''?>
                                        </div>
                                    </div>
                                     
                                </div>                                
                            </div>                            
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group trans-shipment-city-postcode">
                                            <label>Delivery Date</label>
                                            <?php echo (isset($postdata1['drop_destination_date'])) ? $postdata1['drop_destination_date'] : ''?>
                                        </div>
                                    </div>
                                    
                                </div>                                
                            </div>                            
                        </div>
                    </div>
                     
                    <div class="form-group trans-shipment-city-postcode">
                    <label>Add Additional Details (Optional)</label>
                    <textarea name="consignment_note" id="consignment_note" class="trans-textarea-descri formclass"><?php echo (isset($postdata['consignment_note'])) ? $postdata['consignment_note'] : ''?></textarea>
                </div>
                    <div class="submit-btn-section">
                        <button type="button" class="btn-submit-section">Submit</button>
                    </div>
                </div>
            </div>          
        </div>
    </div> 


    <?php $this->load->view('inc_footer');?>

    <?php $this->load->view('inc_common_footer_js');?>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/create-listing-parameters.js"></script>
    <script>
    
    $(document).ready(function(){
    
});

    //btnstep1
    // Controll data
        $('#btnstep2').click(function(){
            $('#request_step2').submit();
        });

    </script>
</body>