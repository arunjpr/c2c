<?php
include("../lib/database.php");
include("../lib/function.php");

$id = $_POST['id'];
$action = $_POST['action'];

if($action=='Category'){ //Category Delete
		
		$delete = mysqli_query($conn,"DELETE FROM category WHERE id='".$id."'");
		if($delete){
			
			echo "1";
			
		}else{
			
			echo "0";
			
		}

}else if($action=='coupans'){ //Category Delete
		
		$delete = mysqli_query($conn,"DELETE FROM coupans WHERE c_id='".$id."'");
		if($delete){
			
			echo "1";
			
		}else{
			
			echo "0";
			
		}
		
}else if($action=='Customer'){ // CUSTOMER DELETE
	
	    $delete = mysqli_query($conn,"DELETE FROM customer WHERE Id='".$id."'");
		if($delete){
			
			echo "1";
			
		}else{
			
			echo "0";
			
		}
	
	
}else if($action=='SubCategory'){ // SUB CATEGORY DELETE
	
	    $delete = mysql_query("DELETE FROM sub_category WHERE id='".$id."'");
		if($delete){
			
			echo "1";
			
		}else{
			
			echo "0";
			
		}
	
	
}else if($action=='SubChildCategory'){ // SUB CHILD CATEGORY DELETE
	
	    $delete = mysql_query("DELETE FROM sub_child_category WHERE id='".$id."'");
		if($delete){
			
			echo "1";
			
		}else{
			
			echo "0";
			
		}
	
	
}else if($action=='video_pdf'){ // PAYMENT DELETE
	
		$sql = "DELETE FROM video_pdf WHERE id='".$id."'";
		$delete = $conn->query($sql);
		if($delete){
			
			echo "1";
			
		}else{
			
			echo "0";
			
		}
	
	
}else if($action=='Test'){ // TEST DELETE
	
	    $delete = mysql_query("DELETE FROM test WHERE id='".$id."'");
		if($delete){
			
			echo "1";
			
		}else{
			
			echo "0";
			
		}
	
	
}else if($action=='Banner'){ // BANNER DELETE
	
	    $delete = mysql_query("DELETE FROM banner WHERE id='".$id."'");
		if($delete){
			
			echo "1";
			
		}else{
			
			echo "0";
			
		}
	
	
}else if($action=='Question'){ // QUESTION DELETE
	
	    $delete = mysql_query("DELETE FROM test_question WHERE id='".$id."'");
		if($delete){
			
			echo "1";
			
		}else{
			
			echo "0";
			
		}
	
	
}else if($action=='Size'){ // SIZE DELETE
	
	    $delete = mysql_query("DELETE FROM size WHERE id='".$id."'");
		if($delete){
			
			echo "1";
			
		}else{
			
			echo "0";
			
		}
	
	
}else if($action=='Order'){ // ORDER DELETE
	
	    $delete = mysql_query("DELETE FROM `orders` WHERE O_Id='".$id."'");
		if($delete){
			
			echo "1";
			
		}else{
			
			echo "0";
			
		}
	
	
}else if($action=='Review'){ // REVIEW DELETE
	
	    $delete = mysql_query("DELETE FROM review WHERE id='".$id."'");
		if($delete){
			
			echo "1";
			
		}else{
			
			echo "0";
			
		}
	
}else{
	
	echo "0";

}	

?>