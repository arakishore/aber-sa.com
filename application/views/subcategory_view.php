<!doctype html>
<html lang=en-US>

<head>
    <?php $this->load->view('inc_header_commoncss');?>
</head>

<body>
    <?php $this->load->view('inc_header_menu');?>

    <div class="trans-menu-join-bg">
        <img src="<?php echo base_url();?>assets/images/banner-right-section-img.png" alt="banner-right-section-img" />
    </div>



    <div class="trans-banner-section trans-select-category-banner">
        <div class="trans-blank-section"></div>
        <div class="container">
            <div class="trans-banner-section-content">
                <div class="trans-banner-content-line"></div>
                <div class="trans-select-category-head">
                    select category
                </div>
            </div>
        </div>
        <div class="trans-caet-banner-bottom-img"></div>
    </div>
    <div class="trans-select-cate-section-main">
        <div class="container">
            <div class="trans-breadcurm-section">
                <ul>
                    <li><a href="javascript:void(0);">Home</a>/</li>
                    <li>Sub Category</li>
                </ul>
            </div>
            <div class="trans-select-cate-section">
                <div class="row">
                    <?php
                if(isset($categorySubcategory) && sizeof($categorySubcategory)>0){

                    foreach($categorySubcategory as $key => $result){
                        $sub_category_id = $result['category_id'];
                        $name = $result['name'];
                        $image = $result['image'];
                ?>
                    <div class="col-6 col-sm-3 col-md-3 col-lg-3">
                        <div class="trans-cate-content-section">
                            <a href="<?php echo site_url("request/step1/".$category_id."/".$sub_category_id);?>">
                                <div class="trans-cate-content-img">
                                    <img src="<?php echo $image;?>" class="trans-cate-gray-img"
                                        alt="<?php echo $name?>" />
                                    <img src="<?php echo $image;?>" class="trans-cate-white-img"
                                        alt="<?php echo $name?>" />

                                </div>
                                <div class="trans-cate-content-name">
                                    <?php echo $name?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php 
                    }
                }
                ?>
                </div>
            </div>
        </div>
    </div>


    <?php $this->load->view('inc_footer');?>

    <?php $this->load->view('inc_common_footer_js');?>
</body>