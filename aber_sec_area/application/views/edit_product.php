<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view('inc_metacss');?>
        <script src="<?php echo base_url()?>global_assets/js/plugins/forms/selects/select2.min.js"></script>
        <script src="<?php echo base_url()?>global_assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script src="<?php echo base_url()?>global_assets/js/demo_pages/form_layouts.js"></script>
        <script src="<?php echo base_url()?>global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
        <style>
                    
                    .image-preview-input {
                        position: relative;
                        overflow: hidden;
                        margin: 0px;    
                        color: #333;
                        background-color: #fff;
                        border-color: #ccc;    
                    }
                    .image-preview-input input[type=file] {
                        position: absolute;
                        top: 0;
                        right: 0;
                        margin: 0;
                        padding: 0;
                        font-size: 20px;
                        cursor: pointer;
                        opacity: 0;
                        filter: alpha(opacity=0);
                    }
                    .image-preview-input-title {
                        margin-left:2px;
                    }
                </style>
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
                            <form name="frm-edit" id="frm-edit" action="<?php echo site_url($this->ctrl_name.'/edit_product/'.$id) ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="mode" id="mode" value="submitform">

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="category_id">Category :<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="category_id" id="category_id" required1>
                                            <?php  $this->common->get_categorylist_parent_sub((isset($records['category_id']))?$records['category_id']:'0')?>
                                        </select>
                                    </div>
                                </div>
                                
								<div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name_title">Item Code:<span class="text-danger">*</span></label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="item_id" name="item_id" placeholder="Item Code" value="<?php echo isset($records['item_id'])?$this->common->getDbValue($records['item_id']):''; ?>">
                                        <!-- <div id="basic-error" class="validation-invalid-label" for="basic">This field is required.</div> -->
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name_title">Name (Arabic):<span class="text-danger">*</span></label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo isset($records['name'])?$this->common->getDbValue($records['name']):''; ?>">
                                        <!-- <div id="basic-error" class="validation-invalid-label" for="basic">This field is required.</div> -->
                                    </div>
                                </div>
                                
								<div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name_title">Name (ENG):<span class="text-danger">*</span></label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="name_en" name="name_en" placeholder="Name" value="<?php echo isset($records['name_en'])?$this->common->getDbValue($records['name_en']):''; ?>">
                                        <!-- <div id="basic-error" class="validation-invalid-label" for="basic">This field is required.</div> -->
                                    </div>
                                </div>

								<div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name_title">Price: <span class="text-danger">*</span></label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="price" name="price" placeholder="Price" value="<?php echo isset($records['price'])?$this->common->getDbValue($records['price']):''; ?>">
                                    </div>
                                </div>
                                
								<div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name_title">Sale Price: <span class="text-danger">*</span></label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="sale_price" name="sale_price" placeholder="Price" value="<?php echo isset($records['sale_price'])?$this->common->getDbValue($records['sale_price']):''; ?>">
                                    </div>
                                </div>
                                
								<div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name_title">Unit: </label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="unit" name="unit" placeholder="Unit" value="<?php echo isset($records['unit'])?$this->common->getDbValue($records['unit']):''; ?>">
                                    </div>
                                </div>                                

								<div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name_title">Unit Bag: </label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="unit_bag" name="unit_bag" placeholder="Unit" value="<?php echo isset($records['unit_bag'])?$this->common->getDbValue($records['unit_bag']):''; ?>">
                                    </div>
                                </div>                                

								<div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name_title">Kg/Bag: </label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="kg_bag" name="kg_bag" placeholder="Kg/Bag" value="<?php echo isset($records['kg_bag'])?$this->common->getDbValue($records['kg_bag']):''; ?>">
                                    </div>
                                </div>                                

								<div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name_title">Driver's Bonus/Bag: </label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="driver_bonus" name="driver_bonus" placeholder="Driver's Bonus/Bag" value="<?php echo isset($records['driver_bonus'])?$this->common->getDbValue($records['driver_bonus']):''; ?>">
                                    </div>
                                </div>                                

								<div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name_title">Carry boy's Bonus/Bag: </label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="carry_boy_bonus" name="carry_boy_bonus" placeholder="Carry Boy's Bonus/Bag" value="<?php echo isset($records['carry_boy_bonus'])?$this->common->getDbValue($records['carry_boy_bonus']):''; ?>">
                                    </div>
                                </div>                                

								<div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name_title">Stock Location: </label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="stock_location" name="stock_location" placeholder="Stock Location" value="<?php echo isset($records['stock_location'])?$this->common->getDbValue($records['stock_location']):''; ?>">
                                    </div>
                                </div>                                

								<div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name_title">ReOrder Point: </label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="re_order_point" name="re_order_point" placeholder="ReOrder Point" value="<?php echo isset($records['re_order_point'])?$this->common->getDbValue($records['re_order_point']):''; ?>">
                                    </div>
                                </div>                                
                                

                                                                                                                                
                                    <?php 
										if($records['main_image']!=''){
											$photo = back_path.'uploads/prod_images/'.stripslashes($records['main_image']);
										} else {
											$photo = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';	
										}
									?>                                
								<div class="form-group row">
                                    <label class="col-md-2 control-label"> Product Image </label>
                                    <div class="col-md-10">
                                        <div class="row col-md-5">
                                            <img src="<?php echo $photo?>" id="temppreviewimageki1" class="temppreviewimageki1" style="width:200px; height:auto;display:none1"> </div>
                                        <div class="row col-md-10">

                                            <div class="input-group image-preview1">

                                                <input type="text" class="form-control image-preview-filename1" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                                <span class="input-group-btn">
                                                    <!-- image-preview-clear button -->
                                                    <button type="button" class="btn btn-default image-preview-clear image-preview-clear1" style="display:none;" id=1>
                                                        <span class="glyphicon glyphicon-remove"></span> Clear
                                                    </button>
                                                    <!-- image-preview-input -->
                                                    <div class="btn btn-default image-preview-input">
                                                        <span class="glyphicon glyphicon-folder-open"></span>
                                                        <span class="image-preview-input-title image-preview-input-title1">Browse</span>
                                                        <input type="file" accept="image/png, image/jpeg, image/gif" class="browseimage" id="1" name="main_image" /> <!-- rename it -->

                                                    </div>
                                                </span>
                                            </div>


                                        </div>
                                    </div>
                                </div>								                                
                               
                                                                                  
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="status">Status :<span class="text-danger">*</span></label>
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
                                <!--  <div class="form-group">
                                        <label>Address:</label>
                                        <textarea rows="3" cols="3" class="form-control" placeholder="Enter address"></textarea>
                                    </div> -->
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"></label>
                                    <div class="col-lg-9">
                                        <button type="submit" class="btn bg-blue">Submit <i class="icon-paperplane ml-2"></i></button>
                                        <a href="<?php echo site_url($this->ctrl_name);?>"><button type="button" class="btn btn-light  ml-2">Cancel</button></a>
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


                if (!$("#category_id").val()) {
                    isError = true;
                    //$("#error_first_category_id").show()
                    $("#category_id").addClass("border-danger");

                }
                if (!$("#name").val()) {
                    isError = true;
                    //$("#error_first_name").show()
                    $("#name").addClass("border-danger");

                }
				
                if (!$("#name_en").val()) {
                    isError = true;
                    //$("#error_first_name").show()
                    $("#name_en").addClass("border-danger");

                }				
               
			    /*if (!$("#short_description").val()) {
                    isError = true;
                    //$("#error_first_name").show()
                    $("#short_description").addClass("border-danger");
                }		
                if (!$("#description").val()) {
                    isError = true;
                    //$("#error_first_name").show()
                    $("#description").addClass("border-danger");
                }*/			

                if (!$("#price").val()) {
                    isError = true;
                    //$("#error_first_name").show()
                    $("#price").addClass("border-danger");
                }				

                if (!$("#sale_price").val()) {
                    isError = true;
                    //$("#error_first_name").show()
                    $("#sale_price").addClass("border-danger");
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
        
 <script type="text/javascript">
        jQuery(document).ready(function($) {






            $(function() {


                //image 1
                // Create the close button
                var closebtn1 = $('<button/>', {
                    type: "button",
                    text: 'x',
                    id: 'close-preview1',
                    style: 'font-size: initial;',
                });
                closebtn1.attr("class", "close pull-right");
                // Set the popover default content
                $('.image-preview1').popover({
                    trigger: 'manual',
                    html: true,
                    title: "<strong>Preview</strong>" + $(closebtn1)[0].outerHTML,
                    content: "There's no image",
                    placement: 'bottom'
                });
                // Clear event
                $('.image-preview-clear').click(function() {
                    var imgid = $(this).attr('id');
                    $('.image-preview' + imgid).attr("data-content", "").popover('hide');
                    $('.image-preview-filename' + imgid).val("");
                    $('.image-preview-clear' + imgid).hide();
                    //$('.image-preview-input input:file').val("");
                    $(".image-preview-input-title" + imgid).text("Browse");
                    $(".temppreviewimageki" + imgid).attr("src", '');
                    $(".temppreviewimageki" + imgid).hide();
                });
                // Create the preview image
                $(".browseimage").change(function() {
                    var img = $('<img/>', {
                        id: 'dynamic',
                        width: 250,
                        height: 200,
                    });
                    var imgid = $(this).attr('id');
                    var file = this.files[0];
                    var reader = new FileReader();
                    // Set preview image into the popover data-content
                    reader.onload = function(e) {

                        $(".image-preview-input-title" + imgid).text("Change");
                        $(".image-preview-clear" + imgid).show();
                        $(".image-preview-filename" + imgid).val(file.name);
                        img.attr('src', e.target.result);

                        $(".temppreviewimageki" + imgid).attr("src", $(img)[0].src);
                        $(".temppreviewimageki" + imgid).show();
                        //img.attr('src', e.target.result);
                        //alert(e.target.result);
                        ///alert($(img)[0].outerHTML);
                        //$(".image-preview1").attr("data-content",$(img)[0].outerHTML).popover("show");
                    }
                    reader.readAsDataURL(file);
                });
                //end  
            });
        });

        // TableManageButtons.init();
        </script>        
    </body>

</html>