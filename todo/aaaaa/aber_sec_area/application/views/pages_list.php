<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('inc_metacss');?>


 	<!-- /theme JS files -->    

    
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
                                <a href="<?php echo site_url("dashboard");?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                                <span class="breadcrumb-item ">CMS</span>
                                <span class="breadcrumb-item active">Pages Data</span>
                            </div>

                            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                        </div>

                        <div class="header-elements d-none">
                            <div class="breadcrumb justify-content-center">
                                <!--<a href="<?php echo site_url($this->ctrl_name."/add_type");?>" class="breadcrumb-elements-item">
                                    <button type="button" class="btn btn-success btn-sm"><i class="icon-plus2 mr-2"></i> Add New</button>
                                </a>-->

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
						<h5 class="card-title">Paragraph / Popups List</h5>
				  </div>

				  <table class="table datatable-basic table-bordered table-striped table-hover" width="100%">

					  <thead>
					  </thead>
					  <tbody>
                     
					    <?php 
			  $i=1;
			  foreach($sel_rs as $det){
				  
			  	$where_cond = " WHERE cms_parent_id=".$det['cms_id']." ORDER BY cms_id ";
			    $sub_rs = $this->common->getAllRow($this->tbl_name,$where_cond);
				  
?>                           
						  <tr>
						    <td width="2%"><?php echo $i?></td>
							  <td><strong><?php echo $this->common->getDbValue($det['cms_parent_name'])?></strong></td>
						  </tr>
						  <tr>
						    <td>&nbsp;</td>
						    <td><table class="table datatable-basic table-bordered" width="100%">
						      <thead>
						        <tr class="bg-table-tr">
						          <th width="24%"><font color="#000000">Paragraph / Page</font></th>
						          <th width="65%"><font color="#000000">Text</font></th>
						          <th width="11%" class="text-center"><font color="#000000">Actions</font></th>
					            </tr>
					          </thead>
						      <tbody>
<?php
			  foreach($sub_rs as $sub_det){
?>
						        <tr>
						          <td><?php echo $this->common->getDbValue($sub_det['cms_title'])?></td>
						          <td><?php echo substr(strip_tags($this->common->getDbValue($sub_det['cms_desc'])),0,250)?></td>
						          <td class="text-center">
<div class="list-icons">
                                            <a href="<?php echo site_url($this->ctrl_name.'/edit_att/'.$sub_det['cms_id'])?>" class="list-icons-item text-primary-600" data-popup="tooltip" title="" data-original-title="Edit"><i class="icon-pencil7"></i></a>
                                            <!--<a href="#" class="list-icons-item text-danger-600 bootbox_custom" data-vuid="09a053d5-88e7-4381-b7fb-8b93d5aa9b6f" data-popup="tooltip" title="" data-original-title="Delete"><i class="icon-trash"></i></a>-->
                                </div>                                  
                                  </td>
					            </tr>
<?php } ?>
					          </tbody>
					        </table></td>
					    </tr>
<?php 
$i++;
} ?>                          
					  </tbody>
				  </table>
				  
				  
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
