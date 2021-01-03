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
                        <div class="fb-dashbord">
                        <div class="card-dash mt-3">
                                <div class="card-content">
                                    <div class="row row-group">
                                        <div class="col-12 col-lg-6 col-xl-6 border-light">
                                            <div class="card-body">
                                              <h5 class="mb-0">9526 <span class="float-right"><i class="fa fa-shopping-cart"></i></span></h5>
                                                <div class="progress my-3" style="height:3px;">
                                                   <div class="progress-bar" style="width:55%"></div>
                                                </div>
                                              <p class="mb-0 small-font">Total Orders </p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 col-xl-6 border-light">
                                            <div class="card-body">
                                              <h5 class=" mb-0">8323 <span class="float-right"><i class="fa fa-usd"></i></span></h5>
                                                <div class="progress my-3" style="height:3px;">
                                                   <div class="progress-bar" style="width:55%"></div>
                                                </div>
                                              <p class="mb-0 small-font">Total Revenue </p>
                                            </div>
                                        </div>
                                        <!-- <div class="col-12 col-lg-6 col-xl-3 border-light">
                                            <div class="card-body">
                                              <h5 class="mb-0">6200 <span class="float-right"><i class="fa fa-eye"></i></span></h5>
                                                <div class="progress my-3" style="height:3px;">
                                                   <div class="progress-bar" style="width:55%"></div>
                                                </div>
                                              <p class="mb-0 small-font">Visitors </p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 col-xl-3 border-light">
                                            <div class="card-body">
                                              <h5 class="mb-0">5630 <span class="float-right"><i class="fa fa-envelope"></i></span></h5>
                                                <div class="progress my-3" style="height:3px;">
                                                   <div class="progress-bar" style="width:55%"></div>
                                                </div>
                                              <p class="mb-0 small-font">Messages </p>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                             </div>
                             <div class="card">
                            <div class="card-header">Recent Order
                            <div class="card-action">
                           
                             </div>
                        </div>
                        <div class="table-responsive">
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
                               <tbody><tr>
                                <td><a href="<?php echo site_url('serviceprovider/my_shipment_details')?>">Iphone 5</a></td>
                                <td><img src="<?php echo base_url();?>assets/images/shipment-pic-img.jpg" class="product-img" alt="product img"></td>
                                <td>#9405822</td>
                                <td>$ 1250.00</td>
                                <td>03 Aug 2017</td>
                                <td>Picked Up</td>
                               </tr>

                               <tr>
                                <td>Earphone GL</td>
                                <td><img src="<?php echo base_url();?>assets/images/shipment-pic-img.jpg" class="product-img" alt="product img"></td>
                                <td>#9405820</td>
                                <td>$ 1500.00</td>
                                <td>03 Aug 2017</td>
                                <td>Booked</td>
                               </tr>

                               <tr>
                                <td>HD Hand Camera</td>
                                <td><img src="<?php echo base_url();?>assets/images/shipment-pic-img.jpg" class="product-img" alt="product img"></td>
                                <td>#9405830</td>
                                <td>$ 1400.00</td>
                                <td>03 Aug 2017</td>
                                <td>Dispatched</td>
                               </tr>

                               <tr>
                                <td>Clasic Shoes</td>
                                <td><img src="<?php echo base_url();?>assets/images/shipment-pic-img.jpg" class="product-img" alt="product img"></td>
                                <td>#9405825</td>
                                <td>$ 1200.00</td>
                                <td>03 Aug 2017</td>
                                <td>Delivered</td>
                               </tr>

                               <tr>
                                <td>Hand Watch</td>
                                <td><img src="<?php echo base_url();?>assets/images/shipment-pic-img.jpg" class="product-img" alt="product img"></td>
                                <td>#9405840</td>
                                <td>$ 1800.00</td>
                                <td>03 Aug 2017</td>
                                <td>Dispatched</td>
                               </tr>
                               
                               <tr>
                                <td>Clasic Shoes</td>
                                <td><img src="<?php echo base_url();?>assets/images/shipment-pic-img.jpg" class="product-img" alt="product img"></td>
                                <td>#9405825</td>
                                <td>$ 1200.00</td>
                                <td>03 Aug 2017</td>
                                <td>Booked</td>
                               </tr>

                            </tbody></table>
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