<div class="col-sm-12 col-md-4 col-lg-3">
<form name="frm-edit" id="frm-edit" action="<?php echo site_url($controller.'/find_business') ?>" method="GET">
<input type="hidden" name="mode_search" id="mode_search" value="search_driver">

                    <div class="find-business-left-bar">
                        <ul>
                            <li class="find-business-main-li">
                                <a href="javascript:void(0);" class="main-category-head">
                                    Categories <span><i class="fal fa-angle-down"></i></span>
                                </a>
                                <ul class="checkbox-menus">
<?php 
$c=0;
 foreach($cats as $key => $value){
	 $chk_status = '';
	 if (isset($_GET['cats']) && $_GET['cats']!='') {
		
		//$sel_cats = implode(",", $_GET['cats']);
		$sel_cats = $_GET['cats'];
		
		if (in_array($value['category_id'], $sel_cats)){
			$chk_status = 'checked';
		}
			 
	 }
	 
	 ?>                                
                                    <li>
                                        <div class="check-box">
                                            <input id="blanket_<?php echo $c?>" name="cats[]" value="<?php echo $this->common->getDbValue($value['category_id']); ?>" <?php echo $chk_status?> class="filled-in" type="checkbox">
                                            <label for="blanket_<?php echo $c?>"><?php echo $this->common->getDbValue($value['name_en']); ?></label>
                                            <span class="check-box-plus"><i class="fal fa-plus"></i></span>
                                        </div>
                                        
                                    </li>
                                    <?php
$c ++;									
									 } ?>
                                </ul>
                            </li>   
                            <li class="find-business-main-li">
                                <a href="javascript:void(0);" class="main-category-head">
                                    Origin <span><i class="fal fa-angle-down"></i></span>
                                </a>
                                <ul class="checkbox-menus">
                                    <div class="origination-address">
                                        Origination address
                                    </div>
                                    <div class="origination-address-textarea">
                                        <textarea name="pickup_location" id="pickup_location" placeholder="Enter Origination Address"><?php echo isset($_GET['pickup_location']) ? $_GET['pickup_location'] : ''; ?></textarea>
                                    </div>
                                </ul>
                            </li>
                            <li class="find-business-main-li">
                                <a href="javascript:void(0);" class="main-category-head">
                                    Destination <span><i class="fal fa-angle-down"></i></span>
                                </a>
                                <ul class="checkbox-menus">
                                    <div class="origination-address">
                                        Destination address
                                    </div>
                                    <div class="origination-address-textarea">
                                        <textarea name="destination_location" id="destination_location" placeholder="Enter Destination Address"><?php echo isset($_GET['destination_location']) ? $_GET['destination_location'] : ''; ?></textarea>
                                    </div>
                                </ul>
                            </li>  
                            <li class="find-business-main-li">
                                <a href="javascript:void(0);" class="main-category-head">
                                    Date of listing <span><i class="fal fa-angle-down"></i></span>
                                </a>
                                <ul class="checkbox-menus">
                                    <div class="date-listing-inputs">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group trans-shipment-city-postcode">
                                                    <input type="text" name="pickup_date" id="pickup_date" class="form-control datepicker" value="<?php echo isset($_GET['pickup_date']) ? $_GET['pickup_date'] : ''; ?>" placeholder="Earliest">
                                                    <img src="<?php echo base_url();?>assets/images/input-calender-icon.png" alt="input-up-arrow-icon" />
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group trans-shipment-city-postcode">
                                                    <input type="text" name="drop_destination_date" id="drop_destination_date" value="<?php echo isset($_GET['drop_destination_date']) ? $_GET['drop_destination_date'] : ''; ?>" class="form-control datepicker" placeholder="Latest">
                                                    <img src="<?php echo base_url();?>assets/images/input-calender-icon.png" alt="input-up-arrow-icon" />
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </ul>
                                <div class="submit-date-btn">
                                        <button type="submit" class="forgat-button-style">Go</button>
                                        </div>
                            </li>                          
                        </ul>                    
                    </div>
</form>                    
                </div>
                