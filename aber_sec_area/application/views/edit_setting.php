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
                                <span class="breadcrumb-item active">Edit Setting</span>
                            </div>

                            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                        </div>

                        <div class="header-elements d-none">
                            <div class="breadcrumb justify-content-center">
                                <a href="<?php echo site_url($this->ctrl_name."/list_all");?>" class="breadcrumb-elements-item">
                                    <button type="button" class="btn btn-success btn-sm"><i class="icon-plus2 mr-2"></i> Back</button>
                                </a>

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
						<h5 class="card-title">Edit Setting</h5>
			    </div>


				  <div class="card-body">

<form action="<?php echo site_url($this->ctrl_name.'/edit_setting/'.$id)?>" name="ed_pg_frm" id="ed_pg_frm" method="post" class="form-horizontal" enctype="multipart/form-data">
<input type="hidden" name="mode_edt" id="mode_edt" value="edit_att">

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name">Key :</label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="username" name="username" disabled placeholder="Key" value="<?php echo $this->common->getDbValue($sel_rs['key'])?>">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name">Value :<span class="text-danger">*</span></label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="value" name="value" required placeholder="Value" value="<?php echo $this->common->getDbValue($sel_rs['value'])?>">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"></label>
                                    <div class="col-lg-9">
                                        <button type="submit" class="btn bg-blue">Save <i class="icon-paperplane ml-2"></i></button>
                                        <a href="<?php echo site_url($this->ctrl_name.'/list_all')?>"><button type="button" class="btn btn-light  ml-2">Cancel</button></a>
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
