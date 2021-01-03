<?php
$session_user_data = $this->session->userdata('user_data');
if ((isset($session_user_data['user_type'])) && ($session_user_data['user_type'] == 'S' || $session_user_data['user_type'] == 'A')) {
    ?>

<?php
}

if ((isset($session_user_data['user_type'])) && $session_user_data['user_type'] == 'EMP') {
    ?>

<?php
}

?> <div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">




        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->

                <li class="nav-item">
                    <a href="<?php echo site_url("dashboard"); ?>" class="nav-link <?php if ($this->m_act == 0) {echo " active";}?>">
                        <i class="icon-home4"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>

                <li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==5){ echo ' nav-item-expanded nav-item-open';}?>">
                    <a href="#" class="nav-link"><i class="fas fa-shuttle-van"></i> <span>Masters</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="<?php echo site_url('categories/categorylistall') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==3){ echo 'active';}?>">Categories</a></li>
                    </ul>
                </li>
                         

                <li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==4){ echo ' nav-item-expanded nav-item-open';}?>">
                    <a href="#" class="nav-link"><i class="fas fa-people-carry"></i> <span>Resource Manage</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="<?php echo site_url('drivers') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Customer List</a></li>
                        <li class="nav-item"><a href="<?php echo site_url('carry_boy') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==2){ echo 'active';}?>">Service Providers</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==11){ echo ' nav-item-expanded nav-item-open';}?>">
                    <a href="#" class="nav-link"><i class="icon-file-text2"></i> <span>CMS</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="<?php echo site_url('cms/aboutus') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==5){ echo 'active';}?>">Pages List</a></li>
                    </ul>
                </li>
                
                <li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==10){ echo ' nav-item-expanded nav-item-open';}?>">
                    <a href="#" class="nav-link"><i class="icon-accessibility2"></i> <span>Administration</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="<?php echo site_url('administration') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Staff List</a></li>

                    </ul>
                </li>
                <li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==8){ echo ' nav-item-expanded nav-item-open';}?>">
                    <a href="#" class="nav-link"><i class="icon-graph"></i> <span>Payment Reports</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="<?php echo site_url('reports/order') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Payment Report</a></li>
                        <li class="nav-item"><a href="<?php echo site_url('reports/customers') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==2){ echo 'active';}?>">Transaction Report</a></li>
                       
                    </ul>
                </li>

            

                <li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==1){ echo ' nav-item-expanded nav-item-open';}?>">
                    <a href="#" class="nav-link"><i class="icon-man "></i> <span>Customers</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="<?php echo site_url('customers') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Customers List</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==2){ echo ' nav-item-expanded nav-item-open';}?>">
                    <a href="#" class="nav-link"><i class="icon-bag"></i> <span>Products</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="<?php echo site_url('products/categorylistall') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==3){ echo 'active';}?>">Category</a></li>
                        <li class="nav-item"><a href="<?php echo site_url('products') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Products</a></li>
                        <li class="nav-item"><a href="<?php echo site_url('coupon') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==2){ echo 'active';}?>">Coupon</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==3){ echo ' nav-item-expanded nav-item-open';}?>">
                    <a href="#" class="nav-link"><i class="icon-database"></i> <span>State / Cities</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">

                        <li class="nav-item"><a href="<?php echo site_url('zone/province') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==4){ echo 'active';}?>">State List</a></li>
                        <!--<li class="nav-item"><a href="<?php echo site_url('zone/district') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==5){ echo 'active';}?>">District List</a></li>-->

                        <!--   <li class="nav-item"><a href="<?php echo site_url('zone') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">City List</a></li> -->
                        <!-- <li class="nav-item"><a href="<?php echo site_url('zone/zonearea') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==2){ echo 'active';}?>">Zone List</a></li> -->
                        <!-- <li class="nav-item"><a href="<?php echo site_url('mobile_phones') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==3){ echo 'active';}?>">Mobile Phones List</a></li> -->
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==9){ echo ' nav-item-expanded nav-item-open';}?>">
                    <a href="#" class="nav-link"><i class="icon-images2 "></i> <span>Media</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="<?php echo site_url('media') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Media List</a></li>
                    </ul>
                </li>
                



                <li class="nav-item">
                    <a href="<?php echo site_url("dashboard/logout"); ?>" class="nav-link">
                        <i class="icon-switch2"></i>
                        <span>Logout</span>
                    </a>
                </li>
                <!-- /page kits -->

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>