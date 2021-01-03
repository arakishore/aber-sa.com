<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('inc_metacss');?>

	<!-- Core JS files -->
	 
	<!-- Theme JS files -->
	<script src="<?php echo base_url()?>global_assets/js/plugins/editors/ckeditor/ckeditor.js"></script>
 

	<script src="<?php echo base_url()?>assets/js/app.js"></script>
    
    <script src="<?php echo base_url()?>global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
	
    <script src="<?php echo base_url()?>global_assets/js/demo_pages/form_select2.js"></script>
    
	<!-- /theme JS files -->    
	<script src="<?PHP echo base_url()?>web_editor/ckeditor.js"></script>
    
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
                                <span class="breadcrumb-item ">Settings</span>
                                <span class="breadcrumb-item active">Change Password</span>
                            </div>

                            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                        </div>

                        <div class="header-elements d-none">
                            <div class="breadcrumb justify-content-center">
                            </div>
                        </div>
                    </div>

                </div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">

				<!-- Page length options -->
			  <div class="card">
				<div class="card-header header-elements-inline">
						<h5 class="card-title">Change Password</h5>
			    </div>


				  <div class="card-body">

<?php
if($errormsg!=""){$msg=$errormsg; $class="message error"; $text="Error!";}else{$msg="";$class="";}
	if($suss!=""){
		//echo "***".$suss;
		$msg=$suss; 
		$class="message success";
		$text="Success!";
} else {
		//$msg="";
} 
?>
<?php if($msg!=''){ ?>                            
<div class="alert alert-danger"><strong>Error!</strong> <?php echo $msg?></div>       
<?php } ?>                             
<form action="<?php echo site_url($this->ctrl_name.'/change_pass')?>" method="post" class="form-horizontal" enctype="multipart/form-data">
<input type="hidden" name="mode_edt" id="mode_edt" value="edit_att">

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name">Email :</label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="username" name="username" readonly placeholder="Username" value="<?php echo $this->common->getDbValue($admin_details['email'])?>">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name">Old Password :<span class="text-danger">*</span></label>
                                    <div class="col-lg-9"><input type="password" class="form-control" id="old_password" name="old_password" required placeholder="Old Password" value="<?php echo $this->common->getDbValue($admin_details['user_pass'])?>">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name">New Password :<span class="text-danger">*</span></label>
                                    <div class="col-lg-9"><input type="password" class="form-control" id="txt_password" name="txt_password" required placeholder="New Password" value="">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name">Confirm Password : <span class="text-danger">*</span></label>
                                    <div class="col-lg-9"><input type="password" class="form-control" id="confirm_password" name="confirm_password" required placeholder="Confirm Password" value="">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"></label>
                                    <div class="col-lg-9">
                                        <button type="submit" class="btn bg-blue">Save <i class="icon-paperplane ml-2"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
				</div>
				<!-- /page length options -->


			</div>
			<!-- /content area -->


			<!-- Footer -->
			<?php $this->load->view('inc_footer');?>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
