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
                                <span class="breadcrumb-item ">Settings</span>
                                <!--<span class="breadcrumb-item active"><?php echo (isset($heading))?$heading:''?></span>-->
                            </div>

                            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                        </div>

                        <div class="header-elements d-none">
                            <div class="breadcrumb justify-content-center">
                               <!-- <a href="<?php echo site_url($this->ctrl_name."/add_tips");?>" class="breadcrumb-elements-item">
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
						<h5 class="card-title">Settings List </h5>
				  </div>

				  <table width="100%" class="table datatable-basic table-bordered table-striped table-hover">

					  <thead>
						  <tr class="bg-table-tr">
						    <th width="31%" >Key</th>
							  <th width="62%" >Value</th>
							  <th width="7%"  class="text-center">Actions</th>
						  </tr>
					  </thead>
					  <tbody>
<?php 
			  $i=1;
			  foreach($sel_rs as $det){			  
	  
?>                          
						  <tr>
						    <td><strong><?php echo $this->common->getDbValue($det['key'])?></strong></td>
							  <td><?php echo $this->common->getDbValue($det['value'])?></td>
							  <td class="text-center">
							    <div class="list-icons">
							      <a href="<?php echo site_url($this->ctrl_name.'/edit_setting/'.$det['setting_id'])?>" class="list-icons-item text-primary-600" data-popup="tooltip" title="" data-original-title="Edit"><i class="icon-pencil7"></i></a>
						        </div>
						      </td>
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
	<script>
	 // Setting datatable defaults
	 $.extend( $.fn.dataTable.defaults, {
            autoWidth: false,
            columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 4 ]
            }],
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
            }
        });

        // Basic datatable
        $('.datatable-basic').DataTable({
        columnDefs: [{
            orderable: false,
            targets: [4]
        }],
        autoWidth: true,
        
        scrollCollapse: true,
        "paging": true,
        "bLengthChange": true, //thought this line could hide the LengthMenu
        "bInfo": true,
        "aaSorting": [],
        /*  fixedColumns : {
					leftColumns : 2,
					rightColumns : 1
				},  */
        "bFilter": true,
        responsive: true,
    });
	</script>	
</body>
 
</html>
