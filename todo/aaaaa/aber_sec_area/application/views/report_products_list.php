<?php
  $session_user_data = $this->session->userdata('user_data');
?>
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
                                <a href="<?php echo site_url("home"); ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                                <span class="breadcrumb-item "><?php echo (isset($title)) ? $title : '' ?></span>
                                <span class="breadcrumb-item active"><?php echo (isset($sub_heading)) ? $sub_heading : '' ?></span>
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
                    <div class="card">

                        <div class="card-body collapse1">
                            <form name="frm-edit" id="frm-edit" action="<?php echo site_url($fun_name) ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="mode" id="mode" value="condtion">

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Date Range:</label>
                                            <div class="col-lg-7">
                                                <div class="input-group">

                                                    <input type="text" name="date_range" id="date_range" class="form-control daterange-left" value="">
                                                    <span class="input-group-append">
                                                        <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                             if(isset($date_range)){
                             ?>
                             <div class="row">
                                   
                                   <div class="col-md-12">
                                   Date : <?php echo $date_range?>
                                   </div>
                             </div>
                             <?php   
                             }
                             ?>  

                            </form>
                        </div>
                    </div>
                    <?php
$error = (isset($error) && $error!="") ? $error :'';
if ($error) {
    ?>
                    <div class="alert bg-danger text-white alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">Error! </span> <?php echo $error ?>
                    </div>
                    <?php }?>
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
                    <div class="card pt-2 ">
                    <?php if (isset($results) && sizeof($results)>0) { ?>
                        <div class="table-responsive">
						<table class="table table-hover datatablecustom">
                            <thead>
                                <tr class="bg-blue ">
		                            <th width="4%">#</th>
		                            <th  >Name (ENG)</th>
                                    <th  >Name (Arabic)</th>
                                    
		                           
		                            <th width="27%">Sale Price</th>
                                    <th width="27%">KG / Unit Bag</th>
                                    
                                    
		                            <th width="18%">Image</th>
                                    
                                    <th width="8%">Total Order</th>
		                          
		                        </tr>
		                    </thead>
		                    <tbody>
                                <?php  $i=0;
									foreach($results as $key => $value){
									$i++;
									$status = $this->common->getDbValue($value['status']);
									
								 						
									
								?>                            
		                         <tr class="  border-left-3  <?php echo ($status == "Active") ? 'border-left-success' : 'border-left-danger' ?>  tr<?php echo $this->common->getDbValue($value['status']); ?>">
                                    <td valign="top"><?php echo $i?></td>
                                    <td valign="top"><strong><?php echo $this->common->getDbValue($value['name_en']); ?></strong></td>
		                            <td valign="top"><strong><?php echo $this->common->getDbValue($value['name']); ?></strong></td>
                                   
		                            <td valign="top"><?php echo $this->currencymodal->format($value['sale_price'], currency_code, 1);?></td>
                                    <td valign="top"><?php echo $this->common->getDbValue($value['kg_bag'] * 1); ?> / <?php echo $this->common->getDbValue($value['unit_bag']  * 1); ?> <?php echo $this->common->getDbValue($value['unit']); ?></td>
                                    
                                   
		                            <td valign="top">
                                    <?php 
										if($value['main_image']!=''){
											$photo = back_path.'uploads/prod_images/'.stripslashes($value['main_image']);
										} else {
											$photo = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';	
										}
									?>
                                   <img src="<?php echo $photo?>" height="50">
                                </td>
		                            
                                    <td valign="top" class="text-center"><?php echo $this->common->getDbValue($value['total_product']); ?></td>
		                           
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
                            </tbody>
                        </table>

                       


                    </div>
                    <!-- /basic datatable -->
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
            dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
            }
        });
        // Scrollable datatable
       $('.datatablecustom').DataTable({
            
            columnDefs: [{
                orderable: false,
                targets: [0]
            }],
            autoWidth: false,
            scroller:true,
            scrollX: true,
            scrollY: '70vh',
            scrollCollapse: false,
            "paging": false,
            "bLengthChange": false, //thought this line could hide the LengthMenu
            "bInfo": true,
            "aaSorting": [],
            'columnDefs': [
                { "width": "10", "targets": 1 },
                 ],
            fixedColumns: {
                leftColumns: 1,
                rightColumns:0
            },
            buttons: {            
                dom: {
                    button: {
                        className: 'btn btn-light'
                    }
                },
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            }
        });


        // Show calendars on left
        $('#date_range').daterangepicker({
            autoUpdateInput: false,
            opens: 'left',
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-light'
        }, function(start_date, end_date) {
            // $('#date_range').val(chosen_date.format('YYYY-MM-DD'));
            $('#date_range').val(start_date.format('YYYY/MM/DD') + ' - ' + end_date.format('YYYY/MM/DD'));

        });
        </Script>
    </body>

</html>