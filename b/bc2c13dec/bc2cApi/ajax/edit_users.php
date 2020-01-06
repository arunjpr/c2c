<?php
include("../lib/database.php");
include("../lib/function.php");

$id = $_POST['Id'];
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$date = $_POST['date'];
$gender = $_POST['gender'];
$role = $_POST['role'];



if($_FILES['f_image']['name']!=""){
$tmp=$_FILES['f_image']['tmp_name'];
$file=time().basename($_FILES['f_image']['name']);
$serverpath="../img/faculty/".$file;
move_uploaded_file($tmp,$serverpath);
}else{
$file = $_POST['file1'];	
}

//print_r($_POST);die;


	
	$updateCategory = mysqli_query($conn,"UPDATE `customer` SET `Name`='$name',`Email`='$email',`Mobile`='$mobile',`Gender`='$gender',`Dob`='$date',`Role`='$role',`Status`='1',`created_on`=now() WHERE Id='".$id."'");
	
	if($updateCategory){
		
		echo "1";
		
	}else{
		
		echo "2";
		

	
}


?>