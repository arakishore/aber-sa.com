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
                                <a href="<?php echo site_url($this->ctrl_name."/add_product");?>" class="breadcrumb-elements-item">
                                    <button type="button" class="btn btn-success btn-sm"><i class="icon-plus2 mr-2"></i> Add New</button>
                                </a>

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
                        <?php if (isset($results) && sizeof($results)>0) { ?>
                        <div class="table-responsive">
						<table class="table table-hover datatable-responsive">
                            <thead>
                                <tr class="bg-blue ">
		                            <th width="4%">#</th>
		                            <th  >Name (ENG)</th>
                                    <th  >Name (Arabic)</th>
                                    
		                            <th width="20%">Category</th>
		                            <th width="27%">Sale Price</th>
                                    <th width="27%">KG</th>
                                    <th width="27%">Unit Bag</th>
                                    <th width="27%">Unit</th>
		                            <th width="18%">Image</th>
		                            <th width="8%">Status</th>
		                            <th width="8%">Actions</th>
		                        </tr>
		                    </thead>
		                    <tbody>
                                <?php  $i=0;
									foreach($results as $key => $value){
									$i++;
									$status = $this->common->getDbValue($value['status']);
									
									$main_cat = $this->common->getOneRow('product_category', "where category_id=" . $value['category_id']);
									$sub_cat = $this->common->getOneRow('product_category', "where category_id=" . $value['sub_category_id']);									
									
								?>                            
		                         <tr class="  border-left-3  <?php echo ($status == "Active") ? 'border-left-success' : 'border-left-danger' ?>  tr<?php echo $this->common->getDbValue($value['status']); ?>">
                                    <td valign="top"><?php echo $i?></td>
                                    <td valign="top"><strong><?php echo $this->common->getDbValue($value['name_en']); ?></strong></td>
		                            <td valign="top"><strong><?php echo $this->common->getDbValue($value['name']); ?></strong></td>
                                    <td><?php echo isset($main_cat['name'])?$this->common->getDbValue($main_cat['name']):''; ?> - <?php echo isset($sub_cat['name'])?$this->common->getDbValue($sub_cat['name']):''; ?></td>
		                            <td valign="top"><?php echo $this->currencymodal->format($value['sale_price'], currency_code, 1);?></td>
                                    <td valign="top"><?php echo $this->common->getDbValue($value['kg_bag']); ?></td>
                                    <td valign="top"><?php echo $this->common->getDbValue($value['unit_bag']); ?></td>
                                    <td valign="top"><?php echo $this->common->getDbValue($value['unit']); ?></td>
		                            <td valign="top">
                                    <?php 
										if($value['main_image']!=''){
											$photo = back_path.'uploads/prod_images/'.stripslashes($value['main_image']);
										} else {
											$photo = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';	
										}
									?>
                                   <img src="<?php echo $photo?>" width="150">
                                </td>
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
                                            <a href="<?php echo site_url($this->ctrl_name.'/edit_product/'.$this->common->getDbValue($value['product_id'])) ?>" class="list-icons-item text-primary-600" data-popup="tooltip" title="" data-original-title="Edit"><i class="icon-pencil7"></i></a>
<?php //if($query->num_rows()==0){ ?>
                                            <a href="<?php echo site_url($this->ctrl_name.'/delete_product/'.$this->common->getDbValue($value['product_id']))?>" class="list-icons-item text-danger-600" title="Delete" onClick="return confirm('Are you sure want to delete this record?');"><i class="icon-trash"></i></a>
<?php //} ?>                                            

                                        </div></td>
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
                       
                        location.href = "<?php echo site_url('master/deleteitem/'.urlencode(base64_encode('mst_exepert_category')).'/') ?>"+aid;

                    }
                    
                }
            });
        });
        </Script>
    </body>

</html>