<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<li class="header">MAIN NAVIGATION</li>

<li class="<?php
if ($active_menu == 'dashboard') {
    echo 'active';
}
?>"><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <span> Dashboard</span></a></li>


<li class="<?php
if ($active_menu == 'rider') {
    echo 'active';
}
?>"><a href="<?php echo base_url('admin/rider'); ?>"><i class="fa fa-file-text-o "></i> <span> Rider</span></a></li>


<li class="<?php
if ($active_menu == 'driver') {
    echo 'active';
}
?>"><a href="<?php echo base_url('admin/driver'); ?>"><i class="fa fa-file-text-o "></i> <span> Driver</span></a></li>


<li class="<?php
if ($active_menu == 'vehicle') {
    echo 'active';
}
?>"><a href="<?php echo base_url('admin/vehicle'); ?>"><i class="fa fa-file-text-o "></i> <span> Vehicle</span></a></li>




<!--<li class="treeview <?php if ($active_menu == 'jobtype') {  echo 'active'; } ?>">
<a href="#"><i class="fa fa-file-text-o"></i> <span> Job Type</span>
    <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
    </span>
</a>
<ul class="treeview-menu">

    <li class="<?php
    if ($active_sub_menu == 'jobtype') {
        echo 'active';
    }
    ?>"><a href="<?php echo base_url('admin/jobtype'); ?>"><i class="fa fa-circle-o"></i> Manage Job Type</a></li>
	
	
    <li class="<?php
    if ($active_sub_menu == 'jobsubtype') {
        echo 'active';
    }
    ?>"><a href="<?php echo base_url('admin/jobsubtype'); ?>"><i class="fa fa-circle-o"></i> Sub Job Type</a></li>
    
</ul>
</li>  -->



</ul>
</li>
</ul>
</li> 