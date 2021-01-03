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
                
<li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==1){ echo ' nav-item-expanded nav-item-open';}?>">
<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Customers</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
    <li class="nav-item"><a href="<?php echo site_url('customers') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Customers List</a></li>
    </ul>
</li>       

<li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==2){ echo ' nav-item-expanded nav-item-open';}?>">
<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Products</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
    <li class="nav-item"><a href="<?php echo site_url('products/categorylistall') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==3){ echo 'active';}?>">Category</a></li>
    <li class="nav-item"><a href="<?php echo site_url('products') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Products</a></li>
    <li class="nav-item"><a href="<?php echo site_url('coupon') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==2){ echo 'active';}?>">Coupon</a></li>
    </ul>
</li>         

<li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==3){ echo ' nav-item-expanded nav-item-open';}?>">
<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Province</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
    
    <li class="nav-item"><a href="<?php echo site_url('zone/province') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==4){ echo 'active';}?>">Province List</a></li>
    <li class="nav-item"><a href="<?php echo site_url('zone/district') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==5){ echo 'active';}?>">District List</a></li>
    
  <!--   <li class="nav-item"><a href="<?php echo site_url('zone') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">City List</a></li> -->
    <!-- <li class="nav-item"><a href="<?php echo site_url('zone/zonearea') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==2){ echo 'active';}?>">Zone List</a></li> -->
    <!-- <li class="nav-item"><a href="<?php echo site_url('mobile_phones') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==3){ echo 'active';}?>">Mobile Phones List</a></li> -->
    </ul>
</li> 

<li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==4){ echo ' nav-item-expanded nav-item-open';}?>">
<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Drivers / Carry Boy</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
    <li class="nav-item"><a href="<?php echo site_url('drivers') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Drivers List</a></li>
    <li class="nav-item"><a href="<?php echo site_url('carry_boy') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==2){ echo 'active';}?>">Carry Boy List</a></li>
    <li class="nav-item"><a href="<?php echo site_url('security') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==3){ echo 'active';}?>">Security List</a></li>
    </ul>
</li>

<li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==5){ echo ' nav-item-expanded nav-item-open';}?>">
<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Vehicles</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
    <li class="nav-item"><a href="<?php echo site_url('vehicles') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Vehicles List</a></li>
    </ul>
</li>

<li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==9){ echo ' nav-item-expanded nav-item-open';}?>">
<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Media</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
    <li class="nav-item"><a href="<?php echo site_url('media') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Media List</a></li>
    </ul>
</li>

<li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==6){ echo ' nav-item-expanded nav-item-open';}?>">
<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Orders</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
    <li class="nav-item"><a href="<?php echo site_url('orders/new_orders') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">New Orders</a></li>
    <li class="nav-item"><a href="<?php echo site_url('orders/confirmed_orders') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Confirmed Orders</a></li>
    <li class="nav-item"><a href="<?php echo site_url('orders/ready_to_ship') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Ready to ship</a></li>
    <li class="nav-item"><a href="<?php echo site_url('orders/shipped') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Shipped</a></li>
    <li class="nav-item"><a href="<?php echo site_url('orders/delivered') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Delivered</a></li>
    <li class="nav-item"><a href="<?php echo site_url('orders/cancelled') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Cancelled</a></li>    
    <li class="nav-item"><a href="<?php echo site_url('orders/returned') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Returned</a></li>
    <li class="nav-item"><a href="<?php echo site_url('orders/refunds') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Refunds</a></li>    
    <li class="nav-item"><a href="<?php echo site_url('orders/missed_orders') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Missed Orders</a></li>
    <li class="nav-item"><a href="<?php echo site_url('order_status') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==100){ echo 'active';}?>">Order Status</a></li>
    </ul>
</li>

<!-- 
<li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==7){ echo ' nav-item-expanded nav-item-open';}?>">
<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Payments</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
    <li class="nav-item"><a href="<?php echo site_url('payments') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Payments Methods</a></li>
    </ul>
</li>
 -->
<li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==8){ echo ' nav-item-expanded nav-item-open';}?>">
<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Reports</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
    <li class="nav-item"><a href="<?php echo site_url('reports') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Reports</a></li>
    </ul>
</li>

<li class="nav-item nav-item-submenu <?php if(isset($this->m_act) && $this->m_act==10){ echo ' nav-item-expanded nav-item-open';}?>">
<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Administration</span></a>
    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
    <li class="nav-item"><a href="<?php echo site_url('administration') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==1){ echo 'active';}?>">Staff List</a></li>
    <li class="nav-item"><a href="<?php echo site_url('cms/notification') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==2){ echo 'active';}?>">Notification</a></li>
    <li class="nav-item"><a href="<?php echo site_url('cms/emailtemplate') ?>" class="nav-link <?php if(isset($l_s_act) && $l_s_act==3){ echo 'active';}?>">Email Template</a></li>
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