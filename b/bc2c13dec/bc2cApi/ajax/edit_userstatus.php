<?php
include("../lib/database.php");
///include("../lib/function.php");

$id = $_POST['Id'];


//print_r($_POST);
$Detials = mysqli_query($conn,"SELECT `Status` FROM customer Where `Id` = '".$id."'");
$Check = mysqli_fetch_array($Detials);
$status = $Check['Status'];

if($status == 0){
    
    $statuss = 1;
}
else
{
    
    $statuss = 0;
}




	
	$updateCoupan = mysqli_query($conn,"UPDATE `customer` SET `Status` = '$statuss'  WHERE `Id`='".$id."'");
	
	if($updateCoupan){
		
		echo "1";
		
	}else{
		
		echo "2";
		
	}
	



?>