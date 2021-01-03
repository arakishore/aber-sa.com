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
                    Dashbord
                </div>
            </div>
        </div>
        <div class="trans-caet-banner-bottom-img"></div>
    </div>
    <div class="container">
        <div class="fb-your-restaurant-main-left">
            <div class="row">
                <!-- <div class="col-6 col-xs-6 col-lg-6">
                        <div class="fb-your-restaurant-back-btn">
                            <a href="#"><i class="fal fa-angle-left"></i> Back</a>
                        </div>
                    </div> -->
                <div class="col-6 col-xs-6 col-lg-6">
                    <div class="fb-your-restaurant-back-btn menu-responsive">
                        <a class="menu-responsive-menu" href="#">Menu <i class="fal fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $this->load->view('inc_customer_left');?>

                <div class="col-sm-12 col-md-12 col-lg-9">
                    <div class="fb-dashbord">
                        <div class="card-dash mt-3">
                            <div class="card-content">
                                <div class="row row-group">
                                    <div class="col-3 col-lg-3 col-xl-3 border-light">
                                        <a href="<?php echo site_url('customer/my_shipment/Requested')?>">
                                            <div
                                                class="card-body <?php echo (isset($request_status) && $request_status=="Requested" ) ? 'active' : '';?>">
                                                <h5 class="mb-0"><b>Requested</b></h5>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-3 col-lg-3 col-xl-3 border-light">
                                        <a href="<?php echo site_url('customer/my_shipment/Ongoing')?>">
                                            <div
                                                class="card-body <?php echo (isset($request_status) && $request_status=="Ongoing" ) ? 'active' : '';?>">
                                                <h5 class="mb-0">Ongoing</h5>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-3 col-lg-3 col-xl-3 border-light">
                                        <a href="<?php echo site_url('customer/my_shipment/Scheduled')?>">
                                            <div
                                                class="card-body <?php echo (isset($request_status) && $request_status=="Scheduled" ) ? 'active' : '';?>">
                                                <h5 class="mb-0">Scheduled</h5>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-3 col-lg-3 col-xl-3 border-light">
                                        <a href="<?php echo site_url('customer/my_shipment/Completed')?>">
                                            <div
                                                class="card-body <?php echo (isset($request_status) && $request_status=="Completed" ) ? 'active' : '';?>">
                                                <h5 class="mb-0">Completed</h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">

                            <div class="table-responsive">
                            <?php 
                            if(isset($all_request) && sizeof($all_request)>0){

                             
                            ?>
                                <table class="table align-items-center table-flush table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Shipment Title</th>
                                            <th>Photo</th>
                                            <th>Shipment ID</th>
                                            <th>Total Amount</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($all_request as $key => $value){ 

                       $consignment_image =         $value['consignment_image']  ;
                               
    //    $sel_photo = base_url().'assets/images/shipment-pic-img.jpg';
        if(sizeof($consignment_image)>0){
            $cons_images = $consignment_image[0];
        } else {
            $cons_images = back_path . "uploads/noimage.png";
        }
		 
        
                                    ?>
                                        <tr>
                                        <td>
								<a href="<?php echo site_url('customer/my_shipment_details/'.$this->common->getDbValue($value['request_id']))?>">
								<?php echo $this->common->getDbValue($value['request_title']); ?></a></td>
                                <td><img src="<?php echo $cons_images?>" class="<?php echo $this->common->getDbValue($value['request_title']); ?>" alt="<?php echo $this->common->getDbValue($value['request_title']); ?>"></td>
                                                    <td><?php echo $this->common->getDbValue($value['shipment_id']); ?></td>
                                            <td>SR <?php echo $this->common->getDbValue($value['budget_amount']); ?></td>
                                            <td><?php echo $this->common->getDateFormat($value['insert_date'], 'd M Y');; ?></td>
                                            <td><?php echo $this->common->getDbValue($value['request_status']); ?></td>
                                        </tr>
                                    <?php }?>

                                    </tbody>
                                </table>
                                <?php } else {
                                echo "No order is found";
                            }
                            ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('inc_footer');?>

    <?php $this->load->view('inc_common_footer_inner_js');?>


</body>