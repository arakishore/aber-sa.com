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
                       Assign Driver
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
                            <a href="<?php echo site_url('serviceprovider/my_shipment_details/'.$request_id)?>"><i class="fal fa-angle-left"></i> Back</a>
                        </div>
                    </div>
                    <div class="col-6 col-xs-6 col-lg-6">
                        <div class="fb-your-restaurant-back-btn menu-responsive">
                            <a class="menu-responsive-menu" href="#">Menu <i class="fal fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">

                        <div class="fb-dashbord">
                        <?php $this->load->view('inc_error');?>
                        <div class="card">
<?php if (isset($my_drivers) && sizeof($my_drivers)>0) {  ?>                            
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-borderless">
                                  <thead>
                                   <tr>
                                     <th>Name</th>
                                     <th>Email Address</th>
                                     <th>Contact Number</th>
                                     <th>Chat</th>
                                     <th>Status</th>
                                     <th>Assign</th>
                                   </tr>
                                   </thead>
                                   <tbody>
<?php  $i=0;
                               //  print_r($child_user);
								foreach($my_drivers as $key => $value){
								$i++;
								$status = $this->common->getDbValue($value['status_flag']);
								?>                                   
                                    <tr>
                                    <td>
                                                            <?php echo $this->common->getDbValue($value['first_name']); ?>
                                                            <?php echo $this->common->getDbValue($value['middle_name']); ?>
                                                            <?php echo $this->common->getDbValue($value['last_name']); ?>
                                    
                                    </td>
                                    <td><?php echo $this->common->getDbValue($value['email']); ?></td>
                                    <td><?php echo $this->common->getDbValue($value['mobile']); ?></td>
                                    <td><i class="fa fa-weixin" aria-hidden="true"></i></td>
                                    <td>Free</td>
                                    <td>
                                    <?php if($sel_driver_id==$value['user_id']){?>
                                    <b class="bussy">Assigned</b>                                    
                                    <?php } else { ?>
                                    <b class="active">
                                    <a href="<?php echo site_url($controller.'/get_assign_driver/'.$request_id.'/'.$this->common->getDbValue($value['user_id'])) ?>" onClick="return confirm('Are you sure want to assign this driver?');">
                                    Assign</a></b>
                                    <?php } ?>
                                    </td>
                                    </tr>
<?php } ?>
                                  
                                    </tbody>
                                </table>
                            </div>
<?php } ?>                            
                        </div>
                      </div>
                    </div>

                </div>
          </div>
        </div>

    <?php $this->load->view('inc_footer');?>
	<?php $this->load->view('inc_common_footer_inner_js');?>    
    
</body>