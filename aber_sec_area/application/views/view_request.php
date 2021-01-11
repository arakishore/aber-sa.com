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
                                <span class="breadcrumb-item active"><?php echo (isset($sub_heading))?$sub_heading:''?>                                
                                </span>
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
                            <h6 class="card-title"><?php echo (isset($sub_heading))?$sub_heading:''?> (<?php echo $this->common->getDbValue($requests['request_title']); ?>)</h6>
                        </div>
                        <div class="card-body">

<ul class="nav nav-tabs nav-tabs-highlight">
                                <li class="nav-item"><a href="#highlighted-tab1" class="nav-link <?php echo ($tab==1)?'active':'' ?>" data-toggle="tab"><i class="icon-user mr-2"></i> Request Info</a></li>
                                <li class="nav-item"><a href="#highlighted-tab2" class="nav-link <?php echo ($tab==2)?'active':'' ?>" data-toggle="tab"><i class="icon-users2  mr-2"></i>Bids (<?php echo sizeof($req_quotes)?>)</a></li>
                            </ul>                            

                            <div class="tab-content">
                                <div class="tab-pane fade <?php echo ($tab==1)?'show active':'' ?>" id="highlighted-tab1">
                                    <form name="frm-edit" id="frm-edit" action="<?php echo site_url($this->ctrl_name.'/view_customer/'.$id) ?>" method="post">
                                        <input type="hidden" name="mode" id="mode" value="submitform">
<legend class="font-weight-semibold text-uppercase font-size-sm">Shipment Listing Information</legend>


<div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="first_name">Request Status :</label>
                                            <div class="col-lg-6">
                                                <?php echo $this->common->getDbValue($requests['request_status']); ?>
                                            </div>
                                </div>
                                
          <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="first_name">Delivery Title :</label>
                                            <div class="col-lg-6">
                                                <?php echo $this->common->getDbValue($requests['request_title']); ?>
                                            </div>
                                </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="email">Shipment ID :</label>
                                            <div class="col-lg-9">
                                                #<?php echo $this->common->getDbValue($requests['shipment_id']); ?>
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
                                                <?php echo $this->common->getDateFormat($requests['insert_date'], 'd-M-Y h:i');; ?> 
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="business_type">Ends :</label>
                                            <div class="col-lg-9">
<?php
 $date1 = date('Y-m-d',strtotime($this->common->getDbValue($requests['pickup_date'])));
 $date2 = date('Y-m-d',strtotime($this->common->getDbValue($requests['insert_date'])));
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
                                                 <?php echo $this->common->getDbValue($requests['distance_mile']); ?>
                                            </div>
                                      </div>                                        


<div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="gender">Travel Time :</label>
                                            <div class="col-lg-9">
                                                 <?php echo $this->common->getDbValue($requests['expected_travelling_time']); ?> HRS
                                            </div>
                                      </div>
                                        

                                                 
                                                 
<div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="gender"># of Quotes :</label>
                                            <div class="col-lg-9">
                                                 <?php echo sizeof($req_quotes)?>
                                            </div>
                                      </div>
                                        

                                        
<legend class="font-weight-semibold text-uppercase font-size-sm">Origin, Destination</legend>


<div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="gender">Collection :</label>
                                            <div class="col-lg-9">
                                                 <?php echo $this->common->getDbValue($requests['pickup_location']); ?><br/>
                                                 Collection : <?php echo $this->common->getDateFormat($requests['pickup_date'], 'd M Y'); ?>
                                            </div>
                                      </div>
                                        
<div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="gender">Delivery :</label>
                                            <div class="col-lg-9">
                                                 <?php echo $this->common->getDbValue($requests['destination_location']); ?><br/>
                                                 Delivery : <?php echo $this->common->getDateFormat($requests['drop_destination_date'], 'd M Y'); ?>
                                            </div>
                                      </div>  
                                        
<legend class="font-weight-semibold text-uppercase font-size-sm"><?php echo $this->common->getDbValue($requests['category_name']); ?> & <?php echo $this->common->getDbValue($requests['subcategory_name']); ?></legend>

<?php if (isset($items) && sizeof($items)>0) {  
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
									foreach($items as $key => $itm){
										
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
                   
                   
                                        
                                                                                                                        
                                                                                                                                                                
                                  </form>

                                    
                                </div>

<div class="tab-pane fade   <?php echo ($tab==2)?'show active':'' ?>  " id="highlighted-tab2">
                                    

                                    <?php
						 if (isset($req_quotes) && sizeof($req_quotes)>0) { 
					    ?>
                                    <div class="table-responsive">
                                        <table class="table dashboarddatatable1" width="100%">
                                            <thead>
                                                <tr class="bg-blue ">
                                                    <th width="13%">Bid By</th>
                                                    <th width="18%">Bid Amount</th>
                                                    <th width="25%">Transport Time</th>
                                                    <th width="10%">Note</th>
                                                    <th width="10%">App Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  $i=0;
                               //  print_r($child_user);
								foreach($req_quotes as $key => $value){
								$i++;
								$status = $this->common->getDbValue($value['quote_seeker_approval']);
								?>
                                                <tr class="  border-left-3  <?php echo ($status == 1) ? 'border-left-success' : 'border-left-danger' ?>  tr<?php echo $this->common->getDbValue($value['quote_seeker_approval']); ?>">
                                                    <td valign="top"><?php echo $this->common->getDbValue($value['first_name']); ?> <?php echo $this->common->getDbValue($value['last_name']); ?></td>
                                                    <td valign="top"><strong>
                                                            SR <?php echo $this->common->getDbValue($value['quote_amount']); ?>
                                                        </strong></td>

                                                    <td valign="top">
													<strong>Pickup Date -</strong> <?php echo $this->common->getDateFormat($value['pickup_date'], 'Y-m-d'); ?><br>
                                                    <strong>Drop Date -</strong> <?php echo $this->common->getDateFormat($value['drop_date'], 'Y-m-d'); ?>
                                                    </td>
                                                    <td valign="top"><?php echo $this->common->getDbValue($value['quote_note']); ?></td>
                                                    <td valign="top">
													<?php 
														if($value['quote_approval_date']) {
															echo $this->common->getDateFormat($value['quote_approval_date'], 'Y-m-d');
														} else { 
															echo '--';
														}
													?> </td>
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
        <div id="modal_theme_primary_addchildpoup" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h6 class="modal-title">Add Branch User</h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                    <div id="err_div_addpop" class="hidedefault alert bg-danger text-white alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                <span class="font-weight-semibold">Warning! <span id="span_err_div_addpop"></span> </span>
                            </div>
                        <form name="addchildpoup" id="addchildpoup" class="form-horizontal" action="<?php echo site_url($controller.'/view_customer/'.$id.'?tab=2') ?>" method="post" enctype="multipart/form-data">
                            <div id="err_info_div_pop" class="hidedefault alert bg-danger text-white alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                <span class="font-weight-semibold">Warning! <span id="span_err_info_div_pop"></span> </span>
                            </div>
                            <input type="hidden" name="mode_pop" id="mode_pop" value="addchildpoup">
                            <input type="hidden" name="tab" id="tab" value="2">

                            <div class="modal-body">

                                <div class="row">


                                    <div class="col-md-12">
                                        <fieldset>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Name:</label>
                                                <div class="col-lg-9">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="text" id="first_name_pop" name="first_name"  placeholder="First name" class="form-control">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <input type="text" id="last_name_pop" name="last_name" placeholder="Last name" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Email:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" id="email_pop" name="email"  placeholder="email"  class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Phone #:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" id="mobile_pop" name="mobile"  placeholder="Mobile" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Password:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" id="passphrase_pop" name="passphrase"  placeholder="Password" class="form-control">
                                                </div>
                                            </div>


                                        </fieldset>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" name="btnaddchildpoup" id="btnaddchildpoup" class="btn bg-primary">Submit</button>
                            </div>





                        </form>


                    </div>


                </div>
            </div>
        </div>
        <!-- /primary modal -->

        <!-- Primary modal -->
        <div id="modal_theme_primary" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h6 class="modal-title"></h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">

                        <form name="frmUpdateData" id="frmUpdateData" class="form-horizontal" action="<?php echo site_url($controller.'/view_customer/'.$id.'?tab=2') ?>" method="post" enctype="multipart/form-data">
                            <div id="err_info_div_pop" class="hidedefault alert bg-danger text-white alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                <span class="font-weight-semibold">Warning! <span id="span_err_info_div_pop"></span> </span>
                            </div>
                            <input type="hidden" name="mode_pop" id="mode_pop" value="frmUpdateData">
                            <input type="hidden" name="tab" id="tab" value="2">
                            <input type="hidden" name="childid" id="childid" value="">
                            <div class="modal-body">
                                <!--  <div class="form-group row">

                                    <div class="col-sm-6">
                                        <label>First name</label>
                                        <input type="text" id="first_name_pop" name="first_name"  placeholder="First name" class="form-control">
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Last name</label>
                                        <input type="text" id="last_name_pop" name="last_name"  placeholder="Last name" class="form-control">
                                    </div>

                                </div> -->
                                <div class="form-group row">
                                    <div class="col-sm-12">



                                        <div class="row">
                                            <label class="col-form-label col-lg-2">Status </label>
                                            <div class="col-lg-10">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input-styled-success" value="Active" name="status" id="status1_pop">
                                                        Active
                                                    </label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input-styled-danger" value="Inactive" name="status" id="status2_pop">
                                                        In-Active
                                                    </label>
                                                </div>
                                                <div class="hidedefault validation-invalid-label mt-2" id="error_phonenumber">Please select status</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" name="btnUpdateData" id="btnUpdateData" class="btn bg-primary">Save changes</button>
                            </div>



                            <div id="err_div_pop" class="hidedefault alert bg-danger text-white alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                <span class="font-weight-semibold">Warning! <span id="span_err_div_pop"></span> </span>
                            </div>



                            <fieldset>
                                <legend class="font-weight-semibold text-uppercase font-size-sm">Edit Login Details</legend>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="password">Password :<span class="text-danger">*</span></label>
                                    <div class="col-lg-9"><input type="password" class="form-control" id="login_password_pop" name="login_password" placeholder="Enter Password" value="" autocomplete="off" required> </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"></label>
                                    <div class="col-lg-9">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="button" name="btnChangePassword" id="btnChangePassword" class="btn bg-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>


                    </div>


                </div>
            </div>
        </div>
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