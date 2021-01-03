<!doctype html>
<html lang=en-US>
<head>
<?php $this->load->view('inc_header_commoncss');?>
</head>
<body>    
    <?php $this->load->view('inc_header_menu');?>  
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
                    About Us
                </div>                
            </div>
        </div> 
        <div class="trans-caet-banner-bottom-img"></div>      
    </div> 
    <div class="trans-about-us-main about-page">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 trans-about-col-img">
                <div class="trans-about-us-img wow fadeInLeft">
                    <img src="<?php echo base_url();?>uploads/para_images/<?php echo $this->common->getDbValue($cms_data_6['cms_image'])?>" alt="home-about-us-img" />
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 trans-about-col">
                <div class="trans-about-us-content wow fadeInRight">
                    <div class="trans-banner-content-line"></div>
                    <div class="trans-aboutus-head">
                        <?php echo $this->common->getDbValue(trim($cms_data_6['cms_title']))?>
                    </div>
                    <div class="trans-aboutus-content">
                    <?php echo $this->common->getDbValue(trim($cms_data_6['cms_desc']))?>  
                       
                    </div>
                </div>
            </div>
        </div>  
                    
    </div>      
    <?php $this->load->view('inc_footer');?>  

    <?php $this->load->view('inc_common_footer_js');?>     
    
</body>