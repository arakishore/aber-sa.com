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
                            <h6 class="card-title"><?php echo (isset($sub_heading))?$sub_heading:''?> </h6>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-highlight">
                                <li class="nav-item"><a href="#highlighted-tab1" class="nav-link <?php echo ($tab==1)?'active':'' ?>" data-toggle="tab"><i class="icon-user mr-2"></i> Service Provider Info</a></li>
                                <li class="nav-item"><a href="#highlighted-tab2" class="nav-link <?php echo ($tab==2)?'active':'' ?>" data-toggle="tab"><i class="icon-users2  mr-2"></i>Drivers</a></li>
                                <li class="nav-item"><a href="#highlighted-tab3" class="nav-link <?php echo ($tab==3)?'active':'' ?>" data-toggle="tab"><i class="icon-basket  mr-2"></i>Trips (Completed) </a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade <?php echo ($tab==1)?'show active':'' ?>" id="highlighted-tab1">
                                    <form name="frm-edit" id="frm-edit" action="<?php echo site_url($this->ctrl_name.'/view_customer/'.$id) ?>" method="post">
                                        <input type="hidden" name="mode" id="mode" value="submitform">


                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="first_name">Name :</label>
                                            <div class="col-lg-9">
                                                <?php echo isset($records['first_name'])?$this->common->getDbValue($records['first_name']):''; ?>
                                                <?php echo isset($records['middle_name'])?$this->common->getDbValue($records['middle_name']):''; ?>
                                                <?php echo isset($records['last_name'])?$this->common->getDbValue($records['last_name']):''; ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="email">Email :</label>
                                            <div class="col-lg-9">
                                                <?php echo isset($records['email'])?$this->common->getDbValue($records['email']):''; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="mobile">Mobile :</label>
                                            <div class="col-lg-9">
                                                <?php echo isset($records['mobile'])?$this->common->getDbValue($records['mobile']):''; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="gender">Gender :</label>
                                            <div class="col-lg-9">
                                                <?php echo isset($records['gender'])?$this->common->getDbValue($records['gender']):''; ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="business_type">Register Date :</label>
                                            <div class="col-lg-9">
                                                <?php echo isset($records['added_date'])?$this->common->getDbValue($records['added_date']):''; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="customer_shipping_address">Address (<?php echo sizeof($customer_shipping_address)?>):</label>
                                            <div class="col-lg-10">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="row">

                                                            <?php
                                            if(isset($customer_shipping_address) && sizeof($customer_shipping_address)>0){
                                            $ki=0;
                                                    foreach($customer_shipping_address as $key => $valueAddess){
                                                        $ki++;
                                            ?>
                                                            <div class="col-md-6 border-left-3 border-left-slate">
                                                                <strong>Address (<?php echo $ki?>):</strong> <strong><?php echo isset($valueAddess['address_name'])?$this->common->getDbValue($valueAddess['address_name']):''; ?></strong> <?php echo isset($valueAddess['address_1'])?$this->common->getDbValue($valueAddess['address_1']):''; ?><br />
                                                                District : <?php echo isset($valueAddess['district_name_en'])?$this->common->getDbValue($valueAddess['district_name_en']):''; ?> <br />
                                                                State : <?php echo isset($valueAddess['state_name_en'])?$this->common->getDbValue($valueAddess['state_name_en']):''; ?> <br />
                                                                Pin Code : <?php echo isset($valueAddess['postcode'])?$this->common->getDbValue($valueAddess['postcode']):''; ?> <br />
                                                                Longitude : <?php echo isset($valueAddess['longitude'])?$this->common->getDbValue($valueAddess['longitude']):''; ?> <br />
                                                                Latitude : <?php echo isset($valueAddess['latitude'])?$this->common->getDbValue($valueAddess['latitude']):''; ?> <br />

                                                            </div>
                                                            <?php    
                                                    }
                                            }
                                            ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="enterprise_name">Enterprise Name :</label>
                                            <div class="col-lg-9"><input type="text" class="form-control" id="enterprise_name" name="enterprise_name" placeholder="" value="<?php echo isset($records['enterprise_name']) ? $this->common->getDbValue($records['enterprise_name']) : ''; ?>" required1> </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="user_language">Language :</label>
                                            <div class="col-lg-9">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input-styled-success" value="EN" name="user_language" id="user_language1" <?php if (isset($records['user_language']) && $records['user_language'] == 'EN')  {  echo 'checked'; } ?>>
                                                        EN
                                                    </label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input-styled-danger" value="LA" name="user_language" id="user_language2" <?php if (isset($records['user_language']) && $records['user_language'] == 'LA')  {  echo 'checked'; } ?>>
                                                        Arabic
                                                    </label>
                                                </div>
                                                <div class="hidedefault validation-invalid-label mt-2" id=" ">Please select status</div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="push_notification">Push notification :</label>
                                            <div class="col-lg-9">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input-styled-success" value="1" name="push_notification" id="push_notification1" <?php if (isset($records['push_notification']) && $records['push_notification'] == '1')  {  echo 'checked'; } ?>>
                                                        Yes
                                                    </label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input-styled-danger" value="0" name="push_notification" id="push_notification2" <?php if (isset($records['push_notification']) && $records['push_notification'] == '0')  {  echo 'checked'; } ?>>
                                                        No
                                                    </label>
                                                </div>
                                                <div class="hidedefault validation-invalid-label mt-2" id=" ">Please select push notification</div>
                                            </div>
                                        </div>
                                        
                                        

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2" for="status">User Status :</label>
                                            <div class="col-lg-9">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input-styled-success" value="Active" name="status" id="status1" <?php if (isset($records['status_flag']) && $records['status_flag'] == 'Active')  {  echo 'checked'; } ?>>
                                                        Active
                                                    </label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input-styled-danger" value="Inactive" name="status" id="status2" <?php if (isset($records['status_flag']) && $records['status_flag'] == 'Inactive')  {  echo 'checked'; } ?>>
                                                        In-Active
                                                    </label>
                                                </div>
                                                <div class="hidedefault validation-invalid-label mt-2" id=" ">Please select status</div>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2"></label>
                                            <div class="col-lg-9">
                                                <button type="submit" class="btn bg-blue">Submit <i class="icon-paperplane ml-2"></i></button>
                                            </div>
                                        </div>
                                    </form>

                                    <form class="form-horizontal" action="<?php echo site_url($controller.'/view_customer/'.$id) ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="mode" id="mode" value="edit_content_password">

                                        <fieldset>
                                            <legend class="font-weight-semibold text-uppercase font-size-sm">Edit Login Details</legend>
                                            <div class="form-group row">
                                                <label class="col-form-label col-lg-2" for="mobile">Email  :<span class="text-danger">*</span></label>
                                                <div class="col-lg-9"><input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Email" value="<?php echo isset($records['email'])?$this->common->getDbValue($records['email']):''; ?>" autocomplete="off" required readonly></div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-lg-2" for="password">Password :<span class="text-danger">*</span></label>
                                                <div class="col-lg-9"><input type="password" class="form-control" id="login_password" name="login_password" placeholder="Enter Password" value="" autocomplete="off" required> </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-lg-2"></label>
                                                <div class="col-lg-9">
                                                    <button type="submit" class="btn bg-blue">Submit <i class="icon-paperplane ml-2"></i></button>

                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>

                                </div>
                                <div class="tab-pane fade   <?php echo ($tab==2)?'show active':'' ?>  " id="highlighted-tab2">
                                    <!--<div class="float-right mb-2"><a href="javascript:void(0);" class="addchildpoup">
                                            <button type="button" class="btn btn-success btn-sm"><i class="icon-plus2 mr-2"></i> Add Branch user</button>
                                        </a></div>-->

                                    <?php
						 if (isset($child_user) && sizeof($child_user)>0) { 
					    ?>
                                    <div class="table-responsive">
                                        <table class="table dashboarddatatable1" width="100%">
                                            <thead>
                                                <tr class="bg-blue ">
                                                    <th width="6%">#</th>
                                                    <th width="18%">Name</th>
                                                    <th width="23%">Email</th>

                                                    <th width="16%">Mobile</th>
                                                    <th width="17%">Address</th>


                                                    <th width="10%">Status</th>
                                                    <th width="10%">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  $i=0;
                               //  print_r($child_user);
								foreach($child_user as $key => $value){
								$i++;
								$status = $this->common->getDbValue($value['status_flag']);
								?>
                                                <tr class="  border-left-3  <?php echo ($status == "Active") ? 'border-left-success' : 'border-left-danger' ?>  tr<?php echo $this->common->getDbValue($value['status_flag']); ?>">
                                                    <td valign="top"><?php echo $i?></td>
                                                    <td valign="top"><strong>
                                                            <?php echo $this->common->getDbValue($value['first_name']); ?>
                                                            <?php echo $this->common->getDbValue($value['middle_name']); ?>
                                                            <?php echo $this->common->getDbValue($value['last_name']); ?>
                                                        </strong></td>
                                                    <td valign="top"><?php echo $this->common->getDbValue($value['email']); ?></td>

                                                    <td valign="top"><?php echo $this->common->getDbValue($value['mobile']); ?></td>
                                                    <td valign="top"></br>
                                                      <strong>Address :</strong> <?php echo $this->common->getDbValue($value['address_1']); ?><br>
                                                      <strong>City :</strong> <?php echo $this->common->getDbValue($value['state_name_en']); ?><br>
                                                      <strong>State :</strong> <?php echo $this->common->getDbValue($value['district_name_en']); ?><br>
                                                    <strong>Pin Code:</strong> <?php echo $this->common->getDbValue($value['postcode']); ?></td>


                                                    <td valign="top">
                                                        <?php
                                        if($status=="Active"){echo '<span class="badge badge-success">Active</span>';}
                                        ?>
                                                        <?php
                                        if($status=="Inactive"){echo '<span class="badge badge-danger">Inactive</span>';}
                                        ?>
                                                    </td>
                                                    <td valign="top">
                                                        <div class="list-icons">
                                                            <!--<a href="javascript:void(0);" id="<?php echo $this->common->getDbValue($value['user_id'])?>" data-userid="<?php echo $this->common->getDbValue($value['user_id'])?>" class="childuserpop list-icons-item text-primary-600" data-popup="tooltip" title="" data-original-title="Edit"><i class="icon-pencil7"></i></a>-->
                                                            <?php //if($query->num_rows()==0){ ?>
                                                            <!--<a href="<?php echo site_url($this->ctrl_name.'/delete_project/')?>" class="list-icons-item text-danger-600" title="Delete" onClick="return confirm('Are you sure want to delete this record?');"><i class="icon-trash"></i></a>-->
                                                            <?php //} ?>

                                                        </div>
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

                                <div class="tab-pane fade  <?php echo ($tab==3)?'show active':'' ?>" id="highlighted-tab3">
                                    <?php
if (isset($order_completed) && sizeof($order_completed) > 0) {
    ?>
                                    <table class="table table-hover datatablecustom">
                                        <thead>
                                            <tr class="bg-blue ">

                                                <th style="width:2%">#</th>
                                                <th style="width:auto">Deliver to </th>
                                                <th style="width:auto">Phone</th>
                                                <th style="width:auto">Mode</th>
                                                <th style="width:auto">Total</th>
                                                <th>Order Date</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
$i = 0;
    foreach ($order_completed as $key => $value) {
        $i++;
        ?>
                                            <tr>
                                                <td><?php echo stripslashes($value['invoice_no']) ?></td>
                                                <td><?php echo stripslashes($value['shipping_firstname']) ?> <?php echo stripslashes($value['shipping_lastname']) ?></td>
                                                <td><?php echo stripslashes($value['telephone']) ?></td>
                                                <td><?php echo stripslashes($value['payment_method']) ?></td>
                                                <td><?php echo $this->currencymodal->format($value['total'], currency_code, 1);

        ?></td>
                                                <td>
                                                    <?php echo $this->common->getDateFormat($value['date_added'], 'd-m-Y'); ?>

                                                <td><a href="<?php echo site_url('orders/orderdetail/' . $value['oorder_uid']."?l_s_act=".$l_s_act."&page=".$page) ?>">Detail</a>


                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>

<div class="row">
                                        <div class="col-xl-12 text-center  ">
                                            <ul class="pagination-flat justify-content-center twbs-flat pagination pull-right">
                                                <?php echo $this->common->ajaxpagingnation_lux_new($page,$order_completed_total,$maxm,'7',$fun_name,$other_para); ?>

                                            </ul>
                                        </div>
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
                                                            <input type="text" id="last_name_pop" name="last_name"  placeholder="Last name" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Email:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" id="email_pop" name="email"   placeholder="eugene@kopyov.com" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Phone #:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" id="mobile_pop" name="mobile"  placeholder="Mobile"  class="form-control">
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