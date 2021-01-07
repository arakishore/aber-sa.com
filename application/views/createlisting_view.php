<!doctype html>
<html lang=en-US>
<head>
<?php $this->load->view('inc_header_commoncss');?>
</head>
<body>   
<?php $this->load->view('inc_header_menu');?> 
   
<div class="trans-menu-join-bg">
        <img src="<?php echo base_url();?>assets/images/banner-right-section-img.png" alt="banner-right-section-img">
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
    <div class="trans-select-cate-section-main">
        <div class="container">            
            <div class="trans-listing-back-save-btn">
                <a href="javascript:Void(0);" class="btn-over-effect trans-listing-back-btn">
                    <img src="<?php echo base_url();?>assets/images/back-btn-arrow.png" alt="save-btn-icon"> <span>Go Back </span>
                </a>                
                <div class="clearfix"></div>
            </div>
            <div class="trans-listing-parameters-main">
                <div class="trans-listing-info-head">
                    Shipment Listing Information 
                </div>
                        
                <div class="form-group trans-shipment-city-postcode trans-shipinment-title">
                    <label>Shipinment Title</label>
                    <input type="text" name="city post code" class="form-control" placeholder="e.g. USA">                    
                </div>
                <div class="text-block">                    
                    <div class="trans-item-section-main">
                        <div class="trans-item-section-head">
                            Item 1
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-lg-2">
                                <div class="trans-item-lable-section">
                                    Quantity*
                                </div>                             
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-10">
                                <div class="form-group trans-list-para-postcode trans-qty-drop">  
                                    <select>
                                        <option>1</option>
                                        <option>2</option>
                                    </select>
                                    <span><i class="fal fa-angle-down"></i></span>
                                </div>        
                                <div class="clearfix"></div>                    
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-lg-2">                            
                                <div class="trans-item-lable-section">
                                    Weight*
                                </div>                             
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-10">
                                <div class="form-group trans-list-para-postcode">   
                                    <input type="text" name="city post code" class="form-control" placeholder="cm">
                                </div> 
                                <div class="clearfix"></div>                          
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-lg-2">                            
                                <div class="trans-item-lable-section">
                                    Lenght*
                                </div>                              
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-10">
                                <div class="form-group trans-list-para-postcode">                                
                                    <input type="text" name="city post code" class="form-control" placeholder="cm">
                                </div>                                                       
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-lg-2">                         
                                <div class="trans-item-lable-section">
                                    Width*
                                </div>                            
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-10">
                                <div class="form-group trans-list-para-postcode">            
                                    <input type="text" name="city post code" class="form-control" placeholder="cm">
                                </div>
                                <div class="clearfix"></div>                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-lg-2">                        
                                <div class="trans-item-lable-section">
                                    Height*
                                </div>   
                            </div>
                            <div class="col-sm-8 col-md-8 col-lg-10">
                                <div class="form-group trans-list-para-postcode">            
                                    <input type="text" name="city post code" class="form-control" placeholder="cm">
                                </div>
                                <div class="clearfix"></div>                            
                            </div>
                        </div>
                        <div class="form-group trans-shipment-city-postcode">
                            <label>Description</label>
                            <textarea name="description-main" class="trans-textarea-descri"></textarea>
                        </div>
                        <button class="btn trans-btns-hover-effect add-remove-btn" type="button" onclick="education_fields();"><i class="fal fa-plus"></i> Add </button>
                        <div class="clearfix"></div>    
                    </div>                    
                    <div class="clearfix"></div>
                    <div id="education_fields"></div>
                 </div> 
                 <div class="form-group trans-list-para-postcode add-photos-main-section">
                    <label>Add Photos</label>
                    <div class="add-photos-main-section-images">
                        <span data-multiupload="3">
                            <span data-multiupload-holder-3=""></span>
                            <span class="upload-photo">
                            <img src="<?php echo base_url();?>assets/images/multi-images-main-img.jpg" alt="plus img">
                            <input class="upload_pic_btn" type="file" multiple="" data-multiupload-src-3="">
                            <span data-multiupload-fileinputs-3=""></span>
                            </span>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                </div>  
                <div class="form-group trans-shipment-city-postcode">
                    <label>Add Additional Details (Optional)</label>
                    <textarea name="description-main" class="trans-textarea-descri"></textarea>
                </div>    
                <div class="trans-listing-back-save-btn">
                    <a href="create_a_listings.html" class="btn-over-effect trans-listing-back-btn trans-parameter-continue-btn">
                         <span> Continue </span><img src="<?php echo base_url();?>assets/images/back-btn-arrow.png" alt="save-btn-icon">
                    </a>                    
                    <div class="clearfix"></div>
                </div>       
            </div>          
        </div>
    </div>
 
   
    <?php $this->load->view('inc_footer');?>  

    <?php $this->load->view('inc_common_footer_js');?>  
    
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/create-listing-parameters.js"></script>     

</body>