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
                       My Driver
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
                        
                        <div class="card">
                            <div class="step-one-next-btn">
                                <a href="<?php echo site_url('serviceprovider/driver_signup')?>" class="btn-over-effect btn-add"> + Add</a>
                            </div>

                            <div class="table-responsive">
<?php if (isset($my_drivers) && sizeof($my_drivers)>0) {  ?>                            
                                <table class="table align-items-center table-flush table-borderless">
                                  <thead>
                                   <tr>
                                     <th>Name</th>
                                     <th>Email Address</th>
                                     <th>Contact Number</th>
                                     <th>Chat</th>
                                     <th>Status</th>
                                     <th>Action</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                    <tr>
                                        <td>Mark</td>
                                        <td>mark.j@gmail.com</td>
                                        <td>(+966) 123 1234</td>
                                        <td><i class="fa fa-weixin" aria-hidden="true"></i></td>
                                        <td><i class="fa fa-check green" aria-hidden="true"></i></i></td>
                                        <td><i class="fas fa-pen"></i> Edit</td>
                                    </tr>

                                   <tr>
                                    <td>Mark</td>
                                    <td>mark.j@gmail.com</td>
                                    <td>(+966) 123 1234</td>
                                    <td><i class="fa fa-weixin" aria-hidden="true"></i></td>
                                    <td><i class="fa fa-times red" aria-hidden="true"></i></td>
                                    <td><i class="fas fa-pen"></i> Edit</td>
                                   </tr>

                                   <tr>
                                    <td>Mark</td>
                                    <td>mark.j@gmail.com</td>
                                    <td>(+966) 123 1234</td>
                                    <td><i class="fa fa-weixin" aria-hidden="true"></i></td>
                                    <td><i class="fa fa-times red" aria-hidden="true"></i></td>
                                    <td><i class="fas fa-pen"></i> Edit</td>
                                   </tr>

                                   <tr>
                                    <td>Mark</td>
                                    <td>mark.j@gmail.com</td>
                                    <td>(+966) 123 1234</td>
                                    <td><i class="fa fa-weixin" aria-hidden="true"></i></td>
                                    <td><i class="fa fa-check green" aria-hidden="true"></i></i></td>
                                    <td><i class="fas fa-pen"></i> Edit</td>
                                   </tr>

                                   <tr>
                                    <td>Mark</td>
                                    <td>mark.j@gmail.com</td>
                                    <td>(+966) 123 1234</td>
                                    <td><i class="fa fa-weixin" aria-hidden="true"></i></td>
                                    <td><i class="fa fa-times red" aria-hidden="true"></i></td>
                                    <td><i class="fas fa-pen"></i> Edit</td>
                                   </tr>
                                   
                                   <tr>
                                    <td>Mark</td>
                                    <td>mark.j@gmail.com</td>
                                    <td>(+966) 123 1234</td>
                                    <td><i class="fa fa-weixin" aria-hidden="true"></i></td>
                                    <td><i class="fa fa-check green" aria-hidden="true"></i></i></td>
                                    <td><i class="fas fa-pen"></i> Edit</td>
                                   </tr>

                                    </tbody>
                                </table>
<?php } else { ?>
<div class="alert alert-warning" role="alert">
  No drivers found!
</div>
<?php } ?>                                  
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