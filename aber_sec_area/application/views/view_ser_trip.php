<?php
$tab = (isset($tab) && $tab!="")?$tab :'1';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view('inc_metacss');?>
        <script src="<?php echo base_url() ?>global_assets/js/demo_pages/form_layouts.js"></script>
        <script src="<?php echo base_url() ?>global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
    </head>

    <body>
        <!-- Main navbar -->
        <?php $this->load->view('inc_topmenu');?>
        <!-- /main navbar -->
        <!-- Page content -->
        <div class="page-content">
            <!-- Main sidebar -->
            <?php $this->load->view('inc_leftmenu');?>
            <!-- /main sidebar -->
            <!-- Main content -->
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header page-header-light">
                    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                        <div class="d-flex">
                            <div class="breadcrumb">
                                <a href="<?php echo site_url("home");?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                                <a href="<?php echo site_url($this->ctrl_name);?>" class="breadcrumb-item"><span class="breadcrumb-item "><?php echo (isset($this->pg_title))?$this->pg_title:''?></span></a>
                                <span class="breadcrumb-item active"><?php echo (isset($sub_heading))?$sub_heading:''?></span>
                            </div>
                            <!-- <i href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a> -->
                        </div>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">
                    <?php
						$success = $this->session->flashdata('success');
						if ($success) {
					?>
                    <div class="alert bg-success text-white alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">Success! </span><?php echo $success?>
                    </div>
                    <?php }?>
                    <?php
						$error = $this->session->flashdata('error');
						if ($error) {
					?>
                    <div class="alert bg-danger text-white alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">Error! </span> <?php echo $error?>
                    </div>
                    <?php }?>
                    <?php
						$warning = $this->session->flashdata('warning');
						if ($warning) {
					?>
                    <div class="alert bg-danger text-white alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">Warning! </span> <?php echo $warning?>
                    </div>
                    <?php }?>
                    <!-- Basic datatable -->


                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h6 class="card-title"><?php echo (isset($sub_heading))?$sub_heading:''?> (<?php echo $this->common->getDbValue($customer['first_name']); ?> <?php echo $this->common->getDbValue($customer['last_name']); ?>) </h6>
                        </div>
                     
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-highlight">
                                <li class="nav-item"><a href="<?php echo site_url('service_providers/view_service_provider/'.$id.'/?tab=1') ?>" class="nav-link <?php echo ($tab==1)?'active':'' ?>"><i class="icon-user mr-2"></i> Service Provider Info</a></li>
                                <li class="nav-item"><a href="<?php echo site_url('service_providers/view_service_provider/'.$id.'/?tab=2') ?>" class="nav-link <?php echo ($tab==2)?'active':'' ?>"><i class="icon-users2  mr-2"></i>Drivers</a></li>
                                <li class="nav-item"><a href="<?php echo site_url('service_providers/view_service_provider/'.$id.'/?tab=3') ?>" class="nav-link <?php echo ($tab==3)?'active':'' ?>"><i class="icon-basket  mr-2"></i>Trips Completed( <?php echo sizeof($order_completed)?>) </a></li>
                            </ul>

                            <div class="tab-content">
                                
                              

                              <input type="hidden" name="mode" id="mode" value="submitform">
<legend class="font-weight-semibold text-uppercase font-size-sm">Shipment Listing Information</legend>

<div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="first_name">Request Status :</label>
                                            <div class="col-lg-6">
                                                <?php echo $this->common->getDbValue($requests_det['request_status']); ?>
                                            </div>
                                </div>
          <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="first_name">Delivery Title :</label>
                                            <div class="col-lg-6">
                                                <label><?php echo $this->common->getDbValue($requests_det['request_title']); ?></label>
                                            </div>
                                </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="email">Shipment ID :</label>
                                            <div class="col-lg-9">
                                                #<?php echo $this->common->getDbValue($requests_det['shipment_id']); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="mobile">Customer :</label>
                                            <div class="col-lg-9">
                                                <?php echo $this->common->getDbValue($customer['first_name']); ?> <?php echo $this->common->getDbValue($customer['last_name']); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="gender">Date Listed :</label>
                                            <div class="col-lg-9">
                                                <?php echo $this->common->getDateFormat($requests_det['insert_date'], 'd-M-Y h:i');; ?> 
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="business_type">Ends :</label>
                                            <div class="col-lg-9">
<?php
 $date1 = date('Y-m-d',strtotime($this->common->getDbValue($requests_det['pickup_date'])));
 $date2 = date('Y-m-d',strtotime($this->common->getDbValue($requests_det['insert_date'])));
 $diff = abs(strtotime($date2) - strtotime($date1));
 $years = floor($diff / (365*60*60*24));
 $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
 $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
?>                                       
                                       <?php echo $this->common->getDbValue($days); ?> Days
                                          </div>
                                        </div>
                                        
<div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="gender">Miles :</label>
                                            <div class="col-lg-9">
                                                 <?php echo $this->common->getDbValue($requests_det['distance_mile']); ?>
                                            </div>
                                      </div>                                        


<div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="gender">Travel Time :</label>
                                            <div class="col-lg-9">
                                                 <?php echo $this->common->getDbValue($requests_det['expected_travelling_time']); ?> HRS
                                            </div>
                                      </div>
                                        

                                                 
                                                 

                                        
<legend class="font-weight-semibold text-uppercase font-size-sm">Origin, Destination</legend>


<div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="gender">Collection :</label>
                                            <div class="col-lg-9">
                                                 <?php echo $this->common->getDbValue($requests_det['pickup_location']); ?><br/>
                                                 Collection : <?php echo $this->common->getDateFormat($requests_det['pickup_date'], 'd M Y'); ?>
                                            </div>
                                      </div>
                                        
<div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="gender">Delivery :</label>
                                            <div class="col-lg-9">
                                                 <?php echo $this->common->getDbValue($requests_det['destination_location']); ?><br/>
                                                 Delivery : <?php echo $this->common->getDateFormat($requests_det['drop_destination_date'], 'd M Y'); ?>
                                            </div>
                                      </div>  
                                        
<legend class="font-weight-semibold text-uppercase font-size-sm">
Request Items : 
<?php echo $this->common->getDbValue($requests_det['category_name']); ?> & <?php echo $this->common->getDbValue($requests_det['subcategory_name']); ?></legend>

<?php if (isset($requests_items) && sizeof($requests_items)>0) {  
$total_weight = 0;
?> 
<div class="table-responsive">
                            <table class="table dashboarddatatable" width="100%">
                                <thead>
                                    <tr class="bg-blue ">
                                        <th width="3%">#</th>
                                        <th width="28%" align="left">Length</th>
                                        <th width="25%" align="left">Width</th>
                                        <th width="30%" align="left">Height</th>
                                        <th width="14%" align="left">Kerb Weight</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
									$i=1;
									foreach($requests_items as $key => $itm){
										
									$total_weight = $total_weight + $this->common->getDbValue($itm['consignment_weight']);	
									?>
                                    <tr class="  border-left-3">
                                        <td valign="top"><?php echo $i?></td>
                                        <td align="left" valign="top"><strong><?php echo $this->common->getDbValue($itm['consignment_length']); ?> <?php echo $this->common->getDbValue($itm['consignment_length_unit']); ?></strong></td>
                                        <td align="left" valign="top"><?php echo $this->common->getDbValue($itm['consignment_width']); ?> <?php echo $this->common->getDbValue($itm['consignment_width_unit']); ?></td>
                                        <td align="left" valign="top"><?php echo $this->common->getDbValue($itm['consignment_height']); ?> <?php echo $this->common->getDbValue($itm['consignment_height_unit']); ?></td>
                                        <td align="left" valign="top"><?php echo $this->common->getDbValue($itm['consignment_weight']); ?> <?php echo $this->common->getDbValue($itm['consignment_weight_unit']); ?></td>
                                    </tr>
                                    <?php 
									$i++;
									} ?>
                                    
                                    <tr class="  border-left-3">
                                      <td valign="top">&nbsp;</td>
                                      <td valign="top">&nbsp;</td>
                                      <td valign="top">&nbsp;</td>
                                      <td valign="top"><strong>Total Weight : </strong></td>
                                      <td valign="top"><?php echo $total_weight?> KG</td>
                                    </tr>                                    
                                </tbody>
                            </table>                            
            </div>
<?php } ?>            
                   
                   
                                        
                                                                                                                        
                                                                                                                                                                
                                                          
                            </div>
                                        
                                                              
<br/>
<h4>Shipment Pictures</h4>
<br/>
                                    <?php
						 if (isset($consignment_images) && sizeof($consignment_images)>0) { 
					    ?>
                                    <div class="table-responsive">
                                        <table class="table dashboarddatatable1" width="100%">
                                            <thead>
                                                <tr class="bg-blue ">
                                                    <th width="20%">Image</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  $i=0;
                               //  print_r($child_user);
								foreach($consignment_images as $key => $value){
								$i++;
								//$status = $this->common->getDbValue($value['status_flag']);
								?>
                                                <tr class="  border-left-3 ">
                                                    <td valign="top">
                                            <?php 
										if($value['image_name']!=''){
											$photo = back_path.'uploads/consignmentimage/'.stripslashes($value['image_name']);
										} else {
											$photo = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';	
										}
									?>
                                            <img src="<?php echo $photo?>" width="150" height="150">                                                    
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                      </div>
                                    <?php } else {
                        ?>
                                    <div class=" text-center  card-body border-top-info1">
                                        No record found
                                    </div>
                                    <?php    
                            }?>
                            
<br/>
<h4>Final Consignment Completed Images</h4>
<br/>
                                    <?php
						 if (isset($consignment_images_comp) && sizeof($consignment_images_comp)>0) { 
					    ?>
                                    <div class="table-responsive">
                                        <table class="table dashboarddatatable1" width="100%">
                                            <thead>
                                                <tr class="bg-blue ">
                                                    <th width="20%">Image</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  $i=0;
                               //  print_r($child_user);
								foreach($consignment_images_comp as $key => $value){
								$i++;
								//$status = $this->common->getDbValue($value['status']);
								?>
                                                <tr class="  border-left-3">
                                                    <td valign="top">
                                            <?php 
										if($value['image_name']!=''){
											$photo = back_path.'uploads/consignmentimage/'.stripslashes($value['image_name']);
										} else {
											$photo = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';	
										}
									?>
                                            <img src="<?php echo $photo?>" width="150" height="150">                                                    
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
          </div>
                                    <?php } else {
                        ?>
                                    <div class=" text-center  card-body border-top-info1">
                                        No record found
                                    </div>
                                    <?php    
                            }?>                            
                                </div>

                                

                                
                                

                            </div>


                        </div>
                    </div>

                </div>
                <!-- /content area -->
                <!-- Footer -->
                <?php $this->load->view('inc_footer');?>
                <!-- /footer -->
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->

        <!-- Primary modal -->
        
        <!-- /primary modal -->

        <!-- Primary modal -->
        
        <!-- /primary modal -->


        <script>
          var childuserdata = JSON.stringify(<?php echo json_encode($child_user )?>);
        if (window.sessionStorage) {
            //sessionStorage.setItem("childuserdata", JSON.stringify('<?php echo json_encode($child_user); ?>'));
        }
        // Scrollable datatable
        var table = $('.datatablecustom').DataTable({
            autoWidth: false,
            "bFilter": false,
            "paging": false,
            "bLengthChange": false, //thought this line could hide the LengthMenu
            "bInfo": true,
            "aaSorting": [],
            'columnDefs': [{
                "targets": [0, 1, 2, 4],
                "orderable": false
            }]
        });

        $(document).ready(function() {
            //addchildpoup
            $('.addchildpoup').on('click', function(e) {


                //passphrase
                $('#modal_theme_primary_addchildpoup').modal('show');

            });
            //btnaddchildpoup
            $('#btnaddchildpoup').on('click', function(e) {
                var isError = false;
                var errMsg = "";
                var errMsg_alert = "";
                var passphrase_pop = $('#passphrase_pop').val();
                var mobile_pop = $('#mobile_pop').val();
                var last_name_pop = $('#last_name_pop').val();
                var first_name_pop = $('#first_name_pop').val();

                if (first_name_pop == "") {
                    isError = true;
                    error_msg = "Please enter first name";
                    //return false;
                }
                if (last_name_pop == "") {
                    isError = true;
                    error_msg = "Please enter last name";
                    //return false;
                }
                if (mobile_pop == "") {
                    isError = true;
                    error_msg = "Please enter mobile";
                    //return false;
                }

                if (passphrase_pop == "") {
                    isError = true;
                    error_msg = "Please enter password";
                    //return false;
                }
                if (!isError) {
                    $("#addchildpoup").submit();
                } else {
                    //alert("11");
                    $("#span_err_div_addpop").html(error_msg);
                    $("#err_div_addpop").show();
                }
                return false;
            });

            //btnUpdateData
            childuserdata = $.parseJSON(childuserdata);
         //   var childuserdata = $.parseJSON(sessionStorage.getItem("childuserdata"));

            //     console.log(childuserdata)
            $('#btnUpdateData').on('click', function(e) {
                var isError = false;
                var errMsg = "";
                var errMsg_alert = "";
                $('#mode_pop').val('frmUpdateData');
                if (!isError) {
                    $("#frmUpdateData").submit();
                } else {
                    //alert("11");
                    $("#span_err_info_div_pop").html(error_msg);
                    $("#err_info_div_pop").show();
                }
                return false;
            });

            $('#btnChangePassword').on('click', function(e) {
                var isError = false;
                var errMsg = "";
                var errMsg_alert = "";
                var login_password_pop = $('#login_password_pop').val();
                $('#mode_pop').val('frmChangePassword');

                if (login_password_pop == "") {
                    isError = true;
                    error_msg = "Please enter password";
                    //return false;
                }
                if (!isError) {
                    $("#frmUpdateData").submit();
                } else {
                    //alert("11");
                    $("#span_err_div_pop").html(error_msg);
                    $("#err_div_pop").show();
                }
                return false;
            });

            $('.childuserpop').on('click', function(e) {
                var aid = $(this).data("userid"); // will return the number 123
                //  
                /*   $.each(childuserdata,function(key,value){
                    console.log(value);
                }); */
                //     console.log(childuserdata[aid].first_name);
                var lastname = childuserdata[aid].last_name;
                if (lastname == null)
                    lastname = "";
                $(".modal-title").html(childuserdata[aid].first_name + " " + lastname);
                $("#childid").val(aid);

                //   $("#first_name_pop").val(childuserdata[aid].first_name);
                //    $("#last_name_pop").val(lastname);
                //     $("#mobile_pop").val(childuserdata[aid].mobile);
                //    
                var status = childuserdata[aid].status;

                if (status == "Active") {
                    $("#status1_pop").prop("checked", true);
                }
                if (status == "Inactive") {
                    $("#status2_pop").prop("checked", true);
                }

                //    $(".modal-title").html(childuserdata[aid].mobile);
                //   $(".modal-title").html(childuserdata[aid].status);
                //passphrase
                $('#modal_theme_primary').modal('show');

            });

            $(".form-control").removeClass("border-danger");
            $("#frm-edit").submit(function(e) {
                var isError = false;
                var errMsg = "";
                var errMsg_alert = "";
                $(".form-control").removeClass("border-danger");


                /*if (!$("#name_title").val()) {
                    isError = true;
                    //$("#error_first_name").show()
                    $("#name_title").addClass("border-danger");

                }*/


                //frd_email
                if (isError) {
                    return false;
                } else {
                    $("#frm-edit").submit();
                }

                return false;
            });


        });
        </script>
    </body>

</html>