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
						 if (isset($results) && sizeof($results)>0) { 
					    ?>
                        <div class="table-responsive">
                            <table class="table dashboarddatatable" width="100%">
                                <thead>
                                    <tr class="bg-blue ">
                                        <th width="2%">#</th>
                                        <th width="12%">Name</th>
                                        <th width="24%">Email</th>
                                        <th width="14%">Mobile</th>

                                        <th width="5%">Status</th>
                                        <th width="9%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $i=0;
								foreach($results as $key => $value){
								$i++;
                                $status = $this->common->getDbValue($value['status_flag']);
                                $sql = " and (parent_id = '".$value['user_id']."')";


								$sSql = "SELECT csa.*,mp.name as state_name, mp.name_en as state_name_en, md.name as district_name , md.name_en as district_name_en  FROM `customer_shipping_address` csa
								left join master_province mp on csa.state_id = mp.id
								left join master_city md on csa.district_id = md.id  where user_id='" . $value['user_id'] . "' and csa.is_default=1   ORDER BY csa.is_default DESC";
								$query = $this->db->query($sSql);
								$valueAddess = $query->row_array();

								
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
                                                <a href="<?php echo site_url($this->ctrl_name.'/view_customer/'.$this->common->getDbValue($value['user_id'])) ?>" class="list-icons-item text-primary-600" data-popup="tooltip" title="" data-original-title="VIEW"><i class="icon-file-stats"></i></a>
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