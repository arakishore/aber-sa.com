<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc_metacss');?>
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-datepicker.css" type="text/css" />

        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.js"></script>

        <!-- Theme JS files -->
        <script src="<?php echo base_url() ?>global_assets/js/plugins/visualization/d3/d3.min.js"></script>
        <script src="<?php echo base_url() ?>global_assets/js/plugins/visualization/c3/c3.min.js"></script>
        <style>
        .row-sm>div {
            padding-left: 10px;
            padding-right: 10px;
        }
        .rounded {
            border-radius: 3px !important;
        }
        .t-15 {
            top: 16px;
        }
        .r-5 {
            right: 12px;
        }
        .pos-absolute {
            position: absolute;
        }
        .square-8 {
            display: inline-block;
            width: 8px;
            height: 8px;
        }
        .rounded-circle {
            border-radius: 50%;
        }
        .bg-danger {
            background-color: #dc3545 !important;
        }
        .pd-25 {
            padding: 25px;
        }
        .align-items-center {
            align-items: center !important;
        }
        .d-flex {
            display: flex !important;
        }
        .tx-60 {
            font-size: 60px;
        }
        .lh-0 {
            line-height: 0;
        }
        .tx-white {
            color: #fff;
        }
        .op-7 {
            opacity: 0.7;
        }
        .ion-bag:before {
            content: "\f110";
        }
        .mg-l-20 {
            margin-left: 20px;
        }
        .tx-10 {
            font-size: 10px;
        }
        .tx-uppercase {
            text-transform: uppercase;
        }
        .tx-spacing-1 {
            letter-spacing: 0.5px;
        }
        .tx-white-8 {
            color: rgba(255, 255, 255, 0.8);
        }
        .tx-mont {
            font-family: "Montserrat", "Fira Sans", "Helvetica Neue", Arial, sans-serif;
        }
        .tx-medium {
            font-weight: 500;
        }
        .mg-b-10 {
            margin-bottom: 10px;
        }
        .tx-24 {
            font-size: 24px;
        }
        .lh-1 {
            line-height: 1.1;
        }
        .tx-white {
            color: #fff;
        }
        .tx-lato {
            font-family: "Lato", "Helvetica Neue", Arial, sans-serif;
        }
        .tx-bold {
            font-weight: 700;
        }
        .mg-b-2 {
            margin-bottom: 2px;
        }
        .tx-11 {
            font-size: 11px;
        }
        .tx-white-6 {
            color: rgba(255, 255, 255, 0.6);
        }
        .tx-roboto {
            font-family: "Roboto", "Helvetica Neue", Arial, sans-serif;
        }
        .tileswti .card-body{
            height: 108px;
        }
        .neworder{
            background-image: url("<?php echo base_url()?>global_assets/basket-cart.png");
            background-repeat: no-repeat;
            background-position-y:center;
        }
        .totalorder{
            background-image: url("<?php echo base_url()?>global_assets/shop44-512.png");
            background-repeat: no-repeat;
            background-position-y:center;
        }
        .revenue{
            background-image: url("<?php echo base_url()?>global_assets/cash2.png");
            background-repeat: no-repeat;
            background-position-y:center;
        }
        .customers{
            background-image: url("<?php echo base_url()?>global_assets/customer.png");
            background-repeat: no-repeat;
            background-position-y:center;
        }
        .products{
            background-image: url("<?php echo base_url()?>global_assets/cube-icon-ice-png-clip-art.png");
            background-repeat: no-repeat;
            background-position-y:center;
        }
        .driver{
            background-image: url("<?php echo base_url()?>global_assets/driver-icon-10.png");
            background-repeat: no-repeat;
            background-position-y:center;
            
        }
        .carryboy{
            background-image: url("<?php echo base_url()?>global_assets/carry-box-1649174-1399164.png");
            background-repeat: no-repeat;
            background-position-y:center;
            
        }
        .inventory{
            background-image: url("<?php echo base_url()?>global_assets/ice-and-meltwater-thumbnail.jpg");
            background-repeat: no-repeat;
            background-position-y:center;
            
        }
        .driverslocation1{
            background-image: url("<?php echo base_url()?>global_assets/location.png");
            background-repeat: no-repeat;
            background-position-y:center;
            
        }
        .bag{
            background-image: url("<?php echo base_url()?>global_assets/bag.png");
            background-repeat: no-repeat;
            background-position-y:center;
            
        }
        .bag2{
            background-image: url("<?php echo base_url()?>global_assets/bag2.png");
            background-repeat: no-repeat;
            background-position-y:center;
            
        }
        .location{
            background-image: url("<?php echo base_url()?>global_assets/placeholder-filled-point.png");
            background-repeat: no-repeat;
            background-position-y:center;
            
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
                                <a href="<?php echo site_url("home"); ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                                <span class="breadcrumb-item active"><?php echo (isset($title)) ? $title : '' ?></span>
                            </div>
                            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">
                    <!-- Quick stats boxes -->
                    <div class="row tileswti">
                        
                        <div class="col-lg-3">
                            <!-- Members online -->
                            <a href="<?php echo site_url("customers");?>">
                            <div class="card bg-teal-400">
                                <div class="totalorder card-body">
                                <div class="d-flex align-items-center float-right">
                                        <div class="mg-l-20">
                                            <div class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10 text-right">Total customers</div>
                                            <div class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1 text-right"><?php echo $cust_cnt?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                            <!-- /members online -->
                        </div>
                        
                        <!--<div class="col-lg-3">
                           
                            <div class="card bg-pink-400">
                                <div class="revenue card-body">
                                <div class="d-flex align-items-center float-right">
                                        
                                        <div class="mg-l-10">
                                            <div class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10 text-right">Total drivers</div>
                                            <div class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1 text-right"><?php echo $driv_cnt;?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>-->
                        <div class="col-lg-3">
                        <a href="<?php echo site_url("service_providers");?>">
                            <div class="card bg-blue-400">
                                <div class="customers card-body">
                                <div class="d-flex align-items-center float-right">
                                    
                                    
                                        <div class="mg-l-20">
                                            <div class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10 text-right">Total service providers</div>
                                            <div class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1 text-right"><?php echo $ser_provid_cnt?></div>
                                        </div>
                                   
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    
                    <!-- /quick stats boxes -->
                    <!-- Main charts -->
                    <!-- /main charts -->
                </div>
                <!-- /content area -->
                <!-- Footer -->
                <?php $this->load->view('inc_footer');?>
                <!-- /footer -->
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
        
        <?php //this->load->view('inc_footer_firebase');?>
    </body>
    

</html>