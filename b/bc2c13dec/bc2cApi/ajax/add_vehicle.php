<?php
include("../lib/database.php");
include("../lib/function.php");
$v_name = $_POST['v_name'];
$v_color = $_POST['v_color'];
$v_num = $_POST['v_num'];

$v_detail = 'fdsfsdfs';
$rc = 'as.png';
$userid= 3;
$type_id=3;
$v_status=1;





$file ='as.png';

 
//$user_id = 5;
//$chkExit = "SELECT * FROM users WHERE Status='1' and Id='".$user_id."'";
//$chkExits= mysqli_query($conn,$chkExit);
//
//if(mysqli_num_rows($chkExits) > 0){
//	
//	echo "0";
//	
//}else{
	

//	
 $insertVahicle = mysqli_query($conn,"INSERT INTO `tbl_vehicle` (`v_id`, `v_user_id`, `v_type_id`, `v_name`, `v_image`, `v_color`, `v_detail`, `v_number`, `v_rc_image`, `v_status`, `v_created`) VALUES (Null, '$userid', '$type_id', '$v_name', 'as.png', '$v_color', '$v_detail', '$v_num', '$rc', '1', CURRENT_TIMESTAMP);");
	
//$insertVahicle = mysqli_query($conn,"INSERT INTO `tbl_vehicle` (`v_id`, `v_user_id`, `v_type_id`, `v_name`, `v_image`, `v_color`, `v_detail`, `v_number`, `v_rc_image`, `v_status`, `v_created`) VALUES (NULL, '1', '1', 'Palser bajaj', '5de4ee72238b0.jpeg', 'RED', NULL, '666732', '5de4dcea13e6d.jpeg', '1', '2019-12-02 03:58:58');");
	
	if($insertVahicle){
		
		echo "1";
		
	}else{
		
		echo "2";
		
	}
	
/*}*/


?>