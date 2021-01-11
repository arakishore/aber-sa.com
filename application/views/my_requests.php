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
                       My Requests
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
                                            <a href="<?php echo site_url('serviceprovider/my_requests')?>">
                                                <div class="card-body <?php if(isset($l_s_act_in) && $l_s_act_in==2){ echo 'active';}?>">
                                                  <h5 class="mb-0">My Requests</h5>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-12 col-lg-6 col-xl-6 border-light">
                                            <a href="<?php echo site_url('serviceprovider/my_shipment')?>">
                                                <div class="card-body <?php if(isset($l_s_act_in) && $l_s_act_in==1){ echo 'active';}?>">
                                                  <h5 class="mb-0"><b>My Shipment</b> </h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                             </div>
                             <div class="card">

<?php if (isset($requests) && sizeof($requests)>0) {  ?> 
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush table-borderless">
                              <thead>
                               <tr>
                                 <th>Shipment Title</th>
                                 <th>Photo</th>
                                 <th>Shipment ID</th>
                                 <th>Date</th>
                                 <th>Status</th>
                               </tr>
                               </thead>
                               <tbody>
<?php foreach($requests as $key => $value){ 
					
		$sSql = "SELECT *  FROM `lt_request_consignment_imgs` WHERE request_id=".$value['request_id']." ORDER BY consignment_img_id";
        $query = $this->db->query($sSql);
        $cons_images = $query->row_array();
		
		$sel_photo = base_url().'assets/images/shipment-pic-img.jpg';
		if($cons_images) {
			$sel_photo = base_url().'uploads/consignmentimage/'.$cons_images['image_name'];
		}
				?>                               
                               <tr>
                                <td>
								<a href="<?php echo site_url('serviceprovider/my_shipment_details/'.$this->common->getDbValue($value['request_id']))?>">
								<?php echo $this->common->getDbValue($value['request_title']); ?></a></td>
                                <td><img src="<?php echo $sel_photo?>" class="product-img" alt="product img"></td>
                                <td><?php echo $this->common->getDbValue($value['shipment_id']); ?></td>
                                <td><?php echo $this->common->getDateFormat($value['insert_date'], 'd M Y');; ?></td>
                                <td><?php echo $this->common->getDbValue($value['request_status']); ?></td>
                               </tr>
<?php } ?>

                            </tbody></table>
                        </div>
<?php } else { ?>
<div class="alert alert-warning" role="alert">
  No requests found!
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