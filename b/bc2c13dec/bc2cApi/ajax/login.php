<?php
session_start();
include("../lib/database.php");


$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "select * from admin where username='$username' and password='$password'";

	$rs = mysqli_query($conn,$sql) or die(mysql_error($conn));
	if(mysqli_num_rows($rs) > 0){
		$rc = mysqli_fetch_array($rs);
		
		 if($rc['status']==1){
			 
			 if($rc['type']=='Admin'){
			     echo "1";
			 }else{
				 echo "2"; 
			 }
			 $_SESSION['id'] = $rc['id'];
			 $_SESSION['name'] = $rc['name'];
			 $_SESSION['email'] = $rc['email'];
			 $_SESSION['type'] = $rc['type'];
			 
		 }else{
			 
			echo "3"; 
			
		 }
		
	}else{
		
		echo "0";
		
	}


?>