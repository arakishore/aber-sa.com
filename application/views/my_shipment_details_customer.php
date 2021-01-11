<!doctype html>
<html lang=en-US>

<head>
    <?php $this->load->view('inc_header_commoncss');?>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/slick.css">
    <style>
        .activetr{
            background-color: #ccc;
        }
        </style>
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
        <form name="frm_request_detail" id="frm_request_detail" action="<?php echo site_url("customer/my_shipment_details/".$request_id);?>" method="post">
        <input type="hidden" name="mode" id="mode" value="doRequestAction">
        <input type="hidden" name="action_flag" id="action_flag" value="0">
        <div class="container">
            <?php $this->load->view('inc_error');?>
            <div class="trans-shipment-steps-main">
                <div class="trans-shipment-steps-head">
                    <?php echo $this->common->getDbValue($requests['request_title']); ?>
                </div>
                <?php
                    if($requests['is_editable']==1){
                    ?>
                <div class="trans-price-accepted-action-btns">
                    
                    <div class="trans-price-accepted-btns">
                        <a href="<?php echo site_url("customer/shipment_details_edit/".$requests['uuid']);?>">
                            <span><i class="fal fa-pencil-alt"></i></span> <span>Edit</span>
                        </a>
                    </div>
                             
                    <!-- <div class="trans-price-accepted-btns">
                        <a href="javascript:void(0);">
                            <span><i class="fal fa-map-marker-alt"></i></span> <span>Confirm my Collection Address</span>
                        </a>
                    </div> -->
                   <!--  <div class="trans-shipment-deleverd-btn">
                        <a href="javascript:void(0);" class="trans-btn-shipment-deleverd">Shipment Delivered</a>
                    </div> -->
                </div>
                <?php }?>  
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
                        class="trans-shipment-steps-point <?php if(in_array('Pick Up',$request_status) || in_array('Picked Up',$request_status)){?> active <?php } ?>">
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
            <?php
            if($requests['service_pro_user_id']!=0){

            
            ?>
            <div class="trans-price-accepted-main">
                <div class="trans-price-accepted-seciton">
                    <div class="trans-price-accepted-head">
                        Congratulations! Your Shipment is been successfully booked.
                    </div>
                    <div class="transport-details-amount-section">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="transport-details-section">
                                    <div class="transport-details-img">
                                        <img src="<?php echo $this->common->getDbValue($requests['service_pro_profile_pic']); ?>" style="width:80px; height:auto" alt="default-img" />
                                    </div>
                                    <div class="transport-details-txt">
                                        <div class="transport-details-txt-head">
                                        <?php echo $this->common->getDbValue($requests['service_pro_first_name']); ?> <?php echo $this->common->getDbValue($requests['service_pro_last_name']); ?>
                                        </div>
                                        <div class="transport-details-txt-semihead">
                                            xyz
                                        </div>
                                        <div class="transport-details-number">
                                        <?php echo $this->common->getDbValue($requests['service_pro_mobile']); ?>
                                        </div>
                                        <div class="transport-details-email">
                                        <?php echo $this->common->getDbValue($requests['service_pro_email']); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="service-provider-amount">
                                    <div class="transport-details-txt-head">
                                    <?php echo $this->common->getDbValue($requests['enterprise_name']); ?>
                                    </div>
                                    <div class="transport-details-price">
                                        <?php
                                         $req_quotes = $requests['bids_list'];
                                         $first_bid=0;
                                         $selected_bid_tr="";
                                         $current_selected_bid = [];
                                         foreach($req_quotes as $key => $qts){
                                             if($qts['service_pro_user_id']==$requests['service_pro_user_id']){
                                                echo 'SR '. number_format($qts['quote_amount'],2);
                                             }
                                         }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>                                                
                    </div>
                </div>
                <?php
                    if($requests['is_editable']==1){
                    ?>
                <div class="trans-price-accepted-action-btns">
                    
                    <div class="trans-price-accepted-btns">
                        <a href="<?php echo site_url("customer/shipment_details/".$requests['uuid']);?>">
                            <span><i class="fal fa-pencil-alt"></i></span> <span>Edit</span>
                        </a>
                    </div>
                             
                    <!-- <div class="trans-price-accepted-btns">
                        <a href="javascript:void(0);">
                            <span><i class="fal fa-map-marker-alt"></i></span> <span>Confirm my Collection Address</span>
                        </a>
                    </div> -->
                   <!--  <div class="trans-shipment-deleverd-btn">
                        <a href="javascript:void(0);" class="trans-btn-shipment-deleverd">Shipment Delivered</a>
                    </div> -->
                </div>
                <?php }?>          
                <div class="clearfix"></div>
            </div>
            <?php }?>
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
                                    <td>Action</td>
                                    <td>Chat</td>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $req_quotes = $requests['bids_list'];
                            if(sizeof($req_quotes)>0){

                            
                            $first_bid=0;
                            $selected_bid_tr="";
                            $current_selected_bid = [];
                            foreach($req_quotes as $key => $qts){
                                $selected_bid_tr = "";
                                if($first_bid==0){
                                    $first_bid = $qts['service_pro_user_id'];
                                    $selected_bid_tr = "activetr";
                                    $current_selected_bid = $qts;
                                } 
                                $qts['bid_amount_info'][0]['amt'] = number_format($qts['bid_amount_info'][0]['amt'],2);
                                $qts['bid_amount_info'][1]['amt'] = number_format($qts['bid_amount_info'][1]['amt'],2);
                                $qts['bid_amount_info'][2]['amt'] = number_format($qts['bid_amount_info'][2]['amt'],2);
                                $qts['bid_amount_info'][1]['amt'] = number_format($qts['bid_amount_info'][3]['amt'],2);
                                ?>
                                <tr id="trclass<?php echo $qts['service_pro_user_id']?>" class="trclass <?php echo $selected_bid_tr?>">
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
                                    <td> <a href="javascript:void(0);" class="vide_detail" data-jsondata='<?php echo json_encode($qts) ?>' id="<?php echo $qts['service_pro_user_id']?>" > Detail</a>

                                    </td>
                                    <td class="text-center">
                                        <span class="message-section-block">
                                            <span><i class="fal fa-comment-lines"></i></span>

                                        </span>

                                    </td>
                                </tr>
                                <?php }
                            } else {
                                ?>
                               
                                     <tr>
                                         <td colspan="4">Yet no bid is placed</td>
                                     </tr>
                                <?php
                            }
                                ?>
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
                                            Collection <?php echo $this->common->getDateFormat($requests['pickup_date'], 'd M Y'); ?>  
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
                                                Collection <?php echo $this->common->getDateFormat($requests['drop_destination_date'], 'd M Y'); ?>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-3" id="bid_details_info"> 
          <?php
               if(sizeof($req_quotes)>0){

        ?>                                       
                <input type="hidden" id="service_provider_id" name="service_provider_id" value="<?php echo isset($current_selected_bid['service_pro_user_id']) ? $current_selected_bid['service_pro_user_id']:'0';?> ">
                <div class="right-payment-section">
                        <div class="payment-section-head">
                            Quote
                        </div>
                        <div class="payment-section-amount quote-right-price" >
                            SR <span id="bid_details_info_quote"><?php echo isset($current_selected_bid['bid_amount_info']) ? number_format($current_selected_bid['bid_amount_info'][0]['amt'],2):'0';?> </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="right-payment-section payment-small-section"  id="bid_details_info_admin_section">
                        <div class="payment-section-head"  id="bid_details_info_admin_label">
                        <?php echo isset($current_selected_bid['bid_amount_info']) ? $current_selected_bid['bid_amount_info'][2]['label']:'Admin Fee';?>
                        </div>
                        <div class="payment-section-amount" id="bid_details_info_admin_amt">
                        <?php echo isset($current_selected_bid['bid_amount_info']) ? number_format($current_selected_bid['bid_amount_info'][2]['amt'],2):'0';?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="right-payment-section payment-small-section">
                        <div class="payment-section-head" id="bid_details_info_vat_label">
                          <?php echo isset($current_selected_bid['bid_amount_info']) ? $current_selected_bid['bid_amount_info'][1]['label']:'VAT';?>
                        </div>
                        <div class="payment-section-amount" id="bid_details_info_vat_amt">
                        <?php echo isset($current_selected_bid['bid_amount_info']) ? number_format($current_selected_bid['bid_amount_info'][1]['amt'],2):'0';?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="right-payment-section payment-total-section">
                        <div class="payment-section-head">
                            Total
                        </div>
                        <div class="payment-section-amount" id="bid_details_info_total">
                       SR <?php echo isset($current_selected_bid['bid_amount_info']) ? number_format($current_selected_bid['bid_amount_info'][3]['amt'],2):'0';?>
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
                        <?php
                        if($requests['service_pro_user_id']==0){
            
                        
                        ?>                      
                    <div class="price-action-btn-section">
                        <a href="javascript:void(0);" data-html="after-accept-offer-my_shipment_details.html" class="bid-accept-btn" id="btn_accept">Accept</a>
                        <a href="javascript:void(0);" class="bid-reject-btn" id="btn_reject">Reject</a>
                    </div>  
                    <?php }?>
                    <?php }?>
                                       
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

<?php

$cons_final_images = $requests['complete_consignment_image'];
if (isset($cons_final_images) && sizeof($cons_final_images)>0) {  ?>                    
                    <div class="shipment-listing-info-head">
                        Consignment Images
                    </div>
                    <div class="shipment-pictures-section">
                    <!-- /.carousel -->
                        <div class="trans_main_slider">
                        <?php foreach($cons_final_images as $key => $imgs){ 
						
						 
							$sel_photo = $imgs;		 
							 
							 					
						?>
                          <div>
                            <img src="<?php echo $sel_photo?>" alt="slider" width="300" height="200">
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
                <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $this->common->getDbValue($requests['destination_latitude']); ?>,<?php echo $this->common->getDbValue($requests['destination_longitude']); ?>&amp;key=AIzaSyBs3Ci13XYyV1cPcs88UVbkOjn05c1r4gY"></iframe>
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

                </form>
    </div>
    <?php $this->load->view('inc_footer');?>
    <script>
 
    </script>
    <!--Main JS-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/create-listing.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/slick.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/common_inner.js"></script>
    <script>
        //vide_detail
        $(document).ready(function(){  
            $('.vide_detail').click(function() {
               
                $(".trclass").removeClass("activetr");
                var id = $(this).attr('id');
                var jsondata = JSON.parse(JSON.stringify($(this).data('jsondata')));

                $("#trclass"+id).addClass("activetr");
                $("#service_provider_id").val(jsondata.service_pro_user_id);
                console.log("jsondata",jsondata.bid_amount_info);
                var bid_amount_info = jsondata.bid_amount_info;
                $("#bid_details_info_quote").html(bid_amount_info[0].amt)
               
                $("#bid_details_info_vat_label").html(bid_amount_info[1].label)
                $("#bid_details_info_vat_amt").html(bid_amount_info[1].amt)
                $("#bid_details_info_admin_label").html(bid_amount_info[2].label)
                $("#bid_details_info_admin_amt").html(bid_amount_info[2].amt)
                $("#bid_details_info_total").html("SR "+bid_amount_info[3].amt)
                console.log("aaa ",bid_amount_info[1].amt);
                
            })
            $('#btn_accept').click(function() {
                $("#action_flag").val("1");
                $("#frm_request_detail").submit();
            });
            $('#btn_reject').click(function() {
                $("#action_flag").val("2");
                $("#frm_request_detail").submit();
            });
        });
        </script>
</body>