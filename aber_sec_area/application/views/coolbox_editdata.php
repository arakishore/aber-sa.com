<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view('inc_metacss');?>
        <script src="<?php echo base_url() ?>global_assets/js/plugins/forms/selects/select2.min.js"></script>
        <script src="<?php echo base_url() ?>global_assets/js/plugins/forms/styling/uniform.min.js"></script>
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
                                <a href="<?php echo site_url("home"); ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                                <a href="<?php echo site_url($controller.'/coolbox'); ?>" class="breadcrumb-item"><span class="breadcrumb-item "><?php echo (isset($title)) ? $title : '' ?></span></a>
                                <span class="breadcrumb-item active"><?php echo (isset($sub_heading)) ? $sub_heading : '' ?></span>
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
                        <span class="font-weight-semibold">Success! </span><?php echo $success ?>
                    </div>
                    <?php }?>
                    <?php
$error = $this->session->flashdata('error');
if ($error) {
    ?>
                    <div class="alert bg-danger text-white alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">Error! </span> <?php echo $error ?>
                    </div>
                    <?php }?>
                    <?php
$warning = $this->session->flashdata('warning');
if ($warning) {
    ?>
                    <div class="alert bg-danger text-white alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">Warning! </span> <?php echo $warning ?>
                    </div>
                    <?php }?>
                    <!-- Basic datatable -->


                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title "><?php echo (isset($sub_heading)) ? $sub_heading : '' ?> </h5>
                        </div>
                        <div class="card-body">
                        <form name="frm-edit" id="frm-edit" action="<?php echo site_url($controller . '/editcoolbox/'.$uuid) ?>" method="post" enctype="multipart/form-data"  >
                                <input type="hidden" name="mode" id="mode" value="submitform">
                                <input type="hidden" name="email_old" id="email_old" value="<?php echo isset($records['box_name']) ? $this->common->getDbValue($records['box_name']) : ''; ?>">
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="first_name">Box Name (Arabic):<span class="text-danger">*</span></label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="box_name" name="box_name" placeholder="" value="<?php echo isset($records['box_name']) ? $this->common->getDbValue($records['box_name']) : ''; ?>">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="first_name">Box Name (ENG):<span class="text-danger">*</span></label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="box_name_en" name="box_name_en" placeholder="" value="<?php echo isset($records['box_name_en']) ? $this->common->getDbValue($records['box_name_en']) : ''; ?>">

                                    </div>
                                </div>
                                
								<div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="first_name">Box Sixe :<span class="text-danger">*</span></label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="box_size" name="box_size" placeholder="" value="<?php echo isset($records['box_size']) ? $this->common->getDbValue($records['box_size']) : ''; ?>">

                                    </div>
                                </div>
                                                                

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="status">Status :</label>
                                    <div class="col-lg-9">
                                    <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input-styled-success" value="Active" name="status" id="status1" <?php if (isset($records['status']) && $records['status'] == 'Active')  {  echo 'checked'; } ?>>
                                                Active
                                            </label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                 <input type="radio" class="form-check-input-styled-danger" value="Inactive" name="status" id="status2" <?php if (isset($records['status']) && $records['status'] == 'Inactive')  {  echo 'checked'; } ?>>
                                                In-Active
                                            </label>
                                        </div>
                                        <div class="hidedefault validation-invalid-label mt-2" id="error_phonenumber">Please select status</div>
                                    </div>

                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"></label>
                                    <div class="col-lg-9">
                                        <button type="submit" class="btn bg-blue">Submit <i class="icon-paperplane ml-2"></i></button>
                                        <a href="<?php echo site_url($controller.'/coolbox'); ?>"><button type="button" class="btn btn-light  ml-2">Cancel</button></a>
                                    </div>
                                </div>
                            </form>
                            
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
        <script>
        $(document).ready(function() {

            $(".form-control").removeClass("border-danger");
            $("#frm-edit").submit(function(e) {
                var isError = false;
                var errMsg = "";
                var errMsg_alert = "";
                $(".form-control").removeClass("border-danger");


                if (!$("#box_name").val()) {
                    isError = true;
                    //$("#error_first_name").show()
                    $("#box_name").addClass("border-danger");

                }

                if (!$("#box_name_en").val()) {
                    isError = true;
                    //$("#error_first_name").show()
                    $("#box_name_en").addClass("border-danger");

                }
				
                if (!$("#box_size").val()) {
                    isError = true;
                    // $("#error_mobile_number1").show()
                    $("#box_size").addClass("border-danger");
                }

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