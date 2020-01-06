<?php
include("../lib/database.php");
include("../lib/function.php");

$id = $_POST['id'];
$file_type = $_POST['file_type'];
$category =  $_POST['category'];
$sub_cat =  $_POST['subcategory'];
$sub_child =  $_POST['childcategory'];
$type = $_POST['type'];
$title = $_POST['title'];
$sub = $_POST['sub_title'];
$descp = $_POST['descp'];
$price = $_POST['price'];
$coupan = $_POST['coupan'];
$shipping = $_POST['shipping'];
/*print_r($_POST);die;
$typeArray = explode(",", $type);
$titleArray = explode(",", $title);
$subArray = explode(",", $sub);
$descpArray = explode(",", $descp);
*/
//for($i=0; $i < count($typeArray); $i++){

if($_FILES['file']['name']!=""){
$tmp=$_FILES['file']['tmp_name'];
$file=time().basename($_FILES['file']['name']);
$serverpath="../img/file/".$file;
move_uploaded_file($tmp,$serverpath);
}
if($_FILES['files']['name']!=""){
$tmp=$_FILES['files']['tmp_name'];
$files=time().basename($_FILES['files']['name']);
$serverpath="../img/faculty/".$files;
move_uploaded_file($tmp,$serverpath);
}
			
	    $updateData = "UPDATE video_pdf SET file_type='$file_type',cat_id='".$category."',sub_cat_id='".$sub_cat."',sub_child_cat='".$sub_child."',type='".$type."',file='$file',title='".$title."',sub_title='".$sub."',`desc`='".$descp."',`dr_img`='$files',`price`='".$price."', `coupan_id`='".$coupan."',`shipping_charge`='".$shipping."',status='1',created_on=Now() WHERE `id`='".$id."'";
		   
			if(mysqli_query($conn,$updateData)){
		
		        echo "1";
		
        	}else{
		
		       echo "2";
		
	       }
			
//}

?>