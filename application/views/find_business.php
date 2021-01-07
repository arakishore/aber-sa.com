<!doctype html>
<html lang=en-US>
<head>
<?php $this->load->view('inc_header_commoncss');?>
<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">    
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
                    Find Business
                </div>                
            </div>
        </div>
       
        <div class="trans-caet-banner-bottom-img"></div>      
    </div>  
    <div class="trans-select-cate-section-main">

        <div class="container">  
    <div class="col-6 col-xs-6 col-lg-6">
                        <div class="fb-your-restaurant-back-btn">
                            <a href="<?php echo site_url('serviceprovider')?>"><i class="fal fa-angle-left"></i> Back</a>
                        </div>
                    </div>          
            <div class="row">
          
                <?php $this->load->view('inc_find_buss');?>
<?php if (isset($requests) && sizeof($requests)>0) {  ?>                  
                <div class="col-sm-12 col-md-8 col-lg-9">
                    <!--<div class="select-sort-btn">
                        <a href="javascript:void(0);" class="btn-select-sort">
                            Select Sort 
                            <span>
                                <i class="fa fa-sort-amount-desc"></i>
                                <i class="fa fa-sort-amount-asc"></i>
                            </span>
                            <div class="clearfix"></div>
                        </a>
                    </div>-->
					<?php foreach($requests as $key => $value){ 
					
		$sSql = "SELECT *  FROM `lt_request_consignment_imgs` WHERE request_id=".$value['request_id']." ORDER BY consignment_img_id";
        $query = $this->db->query($sSql);
        $cons_images = $query->row_array();
		
		$sel_photo = base_url().'assets/images/shipment-pic-img.jpg';
		if($cons_images) {
			$sel_photo = base_url().'uploads/consignmentimage/'.$cons_images['image_name'];
		}
		
 $date1 = date('Y-m-d',strtotime($this->common->getDbValue($value['pickup_date'])));
 $date2 = date('Y-m-d',strtotime($this->common->getDbValue($value['insert_date'])));
 $diff = abs(strtotime($date2) - strtotime($date1));
 $years = floor($diff / (365*60*60*24));
 $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
 $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
?>
                    <div class="find-business-list-section-main">
                        <div class="find-business-list-section">
                            <div class="find-business-list-img">
                                <img src="<?php echo $sel_photo?>" alt="shipment-pic-img" />
                            </div>
                            <div class="find-business-list-content">
                                <div class="find-business-list">
                                    <div class="find-business-list-head">
                                        <a href="<?php echo site_url('serviceprovider/shipment_details/'.$this->common->getDbValue($value['request_id']))?>"><?php echo $this->common->getDbValue($value['request_title']); ?></a>
                                    </div>
                                    <div class="find-business-list-cate-icon">
                                        <div class="list-cate-icon-one">
                                            <span><i class="fas fa-car"></i></span>
                                            <span><?php echo $this->common->getDbValue($value['category_name']); ?> & <?php echo $this->common->getDbValue($value['subcategory_name']); ?></span>
                                        </div>
                                        <div class="list-cate-icon-one list-cate-icon-one-small">
                                            <span><i class="fal fa-clock"></i></span>
                                            <span><?php echo $this->common->getDbValue($days); ?> Days</span>
                                        </div>
                                        <div class="list-cate-icon-one">
                                            <span><i class="fas fa-weight-hanging"></i></span>
                                            <span>128.8kg </span>
                                        </div>
                                        <div class="list-cate-icon-one list-cate-icon-one-small">
                                            <span><i class="fas fa-map-marker-alt"></i></span>
                                            <span><?php echo $this->common->getDbValue($value['distance_mile']); ?> Km</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="find-business-list-right">
                                        <div class="list-sestnation-up">
                                            <span><img src="<?php echo base_url();?>assets/images/table-up-arrow-img.png" alt="table-up-arrow-img" /> </span>
                                            <span><?php echo substr($this->common->getDbValue($value['pickup_location']),0,20); ?></span>
                                        </div>
                                        <div class="list-sestnation-up">
                                            <span><img src="<?php echo base_url();?>assets/images/table-down-arrow-img.png" alt="table-up-arrow-img" /></span> 
                                            <span><?php echo substr($this->common->getDbValue($value['destination_location']),0,20); ?></span>
                                        </div>
                                        <div class="list-offer-price-section">
                                            Offer <span>SR <?php echo $this->common->getDbValue($value['budget_amount']); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        
                        <?php if (isset($links)) { ?>
                            <div class="pagination-seciton"><?php echo $links ?></div>
                        <?php } ?>
                    </div>
                </div>
                <?php } else { ?>
<div class="alert alert-warning" role="alert">
  No requests found!
</div>
                <?php } ?>
            </div>
        </div>
    </div>   
    <?php $this->load->view('inc_footer');?>

    <!--Main JS-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>                
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/common.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/create-listing.js"></script>    
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>    

    <script>
        $(".main-category-head").on("click", function(){            
            $(this).siblings(".checkbox-menus").slideToggle("slow");
            $(this).parent().siblings().find(".checkbox-menus").slideUp("slow");
        });
        $(".check-box-plus").on("click", function(){            
            $(this).parent().siblings(".checkbox-inner-section").slideToggle("slow");
            $(this).parent().parent().toggleClass("active");
            $(this).parent().parent().siblings().find(".checkbox-inner-section").slideUp("slow");
            $(this).parent().parent().siblings().removeClass("active");
        });        
        $(".btn-select-sort").on("click", function(){
            $(this).toggleClass("show-asc");
        });
    </script>

</body>