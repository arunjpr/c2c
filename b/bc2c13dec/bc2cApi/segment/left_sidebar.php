<?php
$url =  $_SERVER['PHP_SELF']; 
$urlArray = explode("/",$url);
$page = $urlArray[3];
?>

<div id="sidebar">
<a href="#" class="visible-phone"><i class="icon icon-reorder"></i> Menu</a>
  <ul>
  
	<li class="<?php if($page=='dashboard.php'){ echo "active";}?>"><a href="dashboard.php"><i class="icon icon-dashboard"></i> <span>Dashboard</span></a></li>
	
    <li class="submenu <?php if($page=='manage_admin.php' || $page=='view_admin.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-th-list"></i> <span>Admin </span></a>
      <ul>
        <li class="<?php if($page=='manage_admin.php' || $page=='view_admin.php'){ echo "active";}?>"><a href="manage_admin.php">Manage Admin</a></li>
      </ul>
    </li>


      
    
    



     <li class="submenu <?php if($page=='add_vehicle.php' || $page=='manage_vehicle_list.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-home"></i> <span>Vehicle</span></a>
     <ul>
     <li class="<?php if($page=='add_vehicle.php'){ echo "active";}?>"><a href="add_vehicle.php">Add Vehicle</a></li>
        <li class="<?php if($page=='manage_vehicle_list.php'){ echo "active";}?>"><a href="manage_qbank_subcategory.php">Manage Vehicle</a></li>
     </ul>
    </li>

  
<!--    <li class="submenu <?php if($page=='add_test.php' || $page=='manage_test.php' || $page=='edit_test.php' || $page=='add_question.php' || $page=='manage_test_question.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-home"></i> <span>Coupans</span></a>-->
<!--      <ul>-->
<!--      <li class="<?php if($page=='add_qscategory.php'){ echo "active";}?>"><a href="add_coupans.php">Add Coupans</a></li>-->
<!--        <li class="<?php if($page=='manage_test.php' || $page=='edit_test.php' || $page=='add_question.php' || $page=='manage_test_question.php'){ echo "active";}?>"><a href="manage_coupans.php">Manage Coupans</a></li>-->
<!--      </ul>-->
<!--    </li>-->


	<li class="submenu <?php if($page=='change_password.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-wrench"></i> <span>Setting </span></a>
      <ul>
        <li class="<?php if($page=='change_password.php'){ echo "active";}?>"><a href="change_password.php">Change Password</a></li>
      </ul>
    </li>
  </ul>
</div>

<script>


</script>