<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view('inc_metacss');?>
        <script src="<?php echo base_url()?>global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
        <script src="<?php echo base_url()?>global_assets/js/plugins/forms/selects/select2.min.js"></script>
        <script src="<?php echo base_url()?>global_assets/js/demo_pages/datatables_responsive.js"></script>
        <script src="<?php echo base_url()?>global_assets/js/plugins/notifications/bootbox.min.js"></script>
        <!-- 	    <script src="<?php echo base_url()?>global_assets/js/plugins/forms/selects/select2.min.js"></script>
 -->
        <!-- <script src="<?php echo base_url()?>global_assets/js/demo_pages/components_modals.js"></script> -->
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
                                <a href="<?php echo site_url("home");?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                                <span class="breadcrumb-item "><?php echo (isset($this->pg_title))?$this->pg_title:''?></span>
                                <span class="breadcrumb-item active"><?php echo (isset($sub_heading))?$sub_heading:''?></span>
                            </div>

                            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                        </div>

                        <div class="header-elements d-none">
                            <div class="breadcrumb justify-content-center">
                                <!--                                <a href="<?php echo site_url($this->ctrl_name."/add_type");?>" class="breadcrumb-elements-item">
                                    <button type="button" class="btn btn-success btn-sm"><i class="icon-plus2 mr-2"></i> Add New</button>
                                </a>
-->
                            </div>
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
                    <div class="card  ">
                        <?php
						 if (isset($requests_rs) && sizeof($requests_rs)>0) { 
					    ?>
                        <div class="table-responsive">
                            <table class="table dashboarddatatable" width="100%">
                                <thead>
                                    <tr class="bg-blue ">
                                        <th width="2%">#</th>
                                        <th width="11%">Request By</th>
                                        <th width="22%">Date</th>
                                        <th width="13%">Title</th>


                                        <th width="24%">Category</th>
                                        <th width="12%">Pic - Drop Dates</th>
                                        <th width="11%">Status</th>
                                        <th width="5%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $i=0;
								foreach($requests_rs as $key => $value){
								$i++;
                                $status = $this->common->getDbValue($value['request_status']);

								$sSql = " SELECT * FROM user_master_front WHERE user_id=".$this->common->getDbValue($value['user_id'])."  ";
								$query = $this->db->query($sSql);
								$user_rs = $query->row_array();
                                
								?>
                                    <tr class="  border-left-3">
                                        <td valign="top"><?php echo $i?></td>
                                        <td valign="top"><strong>
                                                <?php echo $this->common->getDbValue($user_rs['first_name']); ?>
                                                <?php echo $this->common->getDbValue($user_rs['middle_name']); ?>
                                                <?php echo $this->common->getDbValue($user_rs['last_name']); ?>
                                            </strong></td>
                                        <td valign="top"><?php echo $this->common->getDateFormat($value['insert_date'], 'Y-m-d'); ?></td>
                                        <td valign="top"><strong><?php echo $this->common->getDbValue($value['request_title']); ?></strong></td>


                                        <td valign="top"><strong><?php echo $this->common->getDbValue($value['category_name']); ?></strong> - <strong><?php echo $this->common->getDbValue($value['subcategory_name']); ?></strong></td>
                                        <td valign="top">
										From : <?php echo $this->common->getDateFormat($value['pickup_date'], 'Y-m-d'); ?> <br/>
                                        To : <?php echo $this->common->getDateFormat($value['drop_destination_date'], 'Y-m-d'); ?></td>
                                        <td valign="top">
                                            <?php echo $status;?>
                                        </td>
                                        <td valign="top">
                                            <div class="list-icons">
                                                <a href="<?php echo site_url($this->ctrl_name.'/view_request_detail/'.$this->common->getDbValue($value['request_id'])) ?>" class="list-icons-item text-primary-600" data-popup="tooltip" title="" data-original-title="VIEW BIDS"><i class="icon-file-stats"></i></a>
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

                        <?php if(isset($num_row) && $num_row>0){ ?>
                        <div class="row">
                            <div class="col-xl-12 text-center  ">
                                <ul class="pagination-flat justify-content-center twbs-flat pagination pull-right">
                                    <?php echo $this->common->ajaxpagingnation_admin_new($start,$num_row,$maxm,'',$fun_name,$other_para); ?>

                                </ul>
                            </div>
                        </div>
                        <?php } ?>
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
        // Scrollable datatable
        var table = $('.dashboarddatatable').DataTable({
            columnDefs: [{
                orderable: false,
                targets: [0]
            }],
            autoWidth: false,
            "lengthMenu": [
                [100],
                [100]
            ],
            scrollX: true,
            scrollY: '70vh',
            scrollCollapse: true,
            "paging": false,
            "bLengthChange": false, //thought this line could hide the LengthMenu

            "aaSorting": [],


            responsive: true,
        });

        // Custom bootbox dialog
        $('.bootbox_custom').on('click', function(e) {
            var aid = $(this).data("id") // will return the number 123

            bootbox.confirm({
                title: 'Confirm ',
                message: 'Are you sure you want to delete selected records ?',
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'Cancel',
                        className: 'btn-link'
                    }
                },
                callback: function(result) {


                    if (result) {

                        location.href = "<?php echo site_url('master/deleteitem/'.urlencode(base64_encode('mst_exepert_category')).'/') ?>" + aid;

                    }

                }
            });
        });
        </Script>
    </body>

</html>