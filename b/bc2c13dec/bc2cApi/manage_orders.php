<?php 
require_once("lib/database.php");
require_once("lib/function.php");

if($_SESSION['id']!=''){
	$id = $_SESSION['id'];
}else{
	header("Location:logout.php");
}

$Detials = mysqli_query($conn,"SELECT * FROM `orders` INNER JOIN customer ON customer.Id=orders.User_Id INNER JOIN pickup_location ON pickup_location.User_Id=orders.Order_Id;");
//print_r($Detials);die;
?>
<!DOCTYPE html>
<html lang="en">
<!--Head-part-->
   <?php include("segment/head.php");?>
<!--close-Head-part-->
<body>

<!--Header-part-->
   <?php include("segment/header.php");?>   
<!--close-Header-part--> 

<!--sidebar-menu-->
    <?php include("segment/left_sidebar.php");?>
<!--close-sidebar-menu-->

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Users</a> <a href="javascript:void(0);" class="current">Manage Bookings</a></div>
    <h1>Manage Bookings</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
  <form class="form-horizontal" method="post" action=" "   id="validation" enctype="multipart/form-data">
       <!--Message-Part-Start-->
			<div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Status Update Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Something went wrong.please try again. 
			</div>
			
			<div class="alert alert-error1" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Warning ! </strong>Status Not Update. Please try again. 
			</div>
			<!--Message-Part-End-->
		


        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Manage Orders</h5>
			<!--<a href="add_subcategory.php?shop_id=<?=base64_encode($id)?>"><button class="btn btn-success pull-right">Add Sub Category</button></a>-->
          </div>
          <div class="widget-content nopadding">
		  <div class="table-responsive">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Gender</th>
                  <th>Dob</th>
                  <th>Role</th>
                  <th>Helpers</th>
                  <th>Pickup Lat</th>
                  <th>Pickup Long</th>
                  <th>Time</th>
                  <th>Date</th>
                  <th>Destinations</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
			  $sn=1;
			  while($Users = mysqli_fetch_array($Detials)){
		    	 $sId =  $Users['Id'];
                $Status = $Users['Status']; ?>
                <tr class="gradeX<?=$Users['Id']?>">
                  <td class="center"><?=$sn;?></td>
                   <td><?php echo $Users['Name']; ?></td>
                  <td><?php echo $Users['Email']; ?></td>
                  <td><?php echo $Users['Mobile']; ?></td>
                  <td><?php echo $Users['Gender']; ?></td>
                  <td><?php echo $Users['Dob']; ?></td>
                  <td><?php echo $Users['Role']; ?></td>
                  <td><?php echo $Users['Helpers_Required']; ?></td>
                  <td><?php echo $Users['P_Latitude']; ?></td>
                  <td><?php echo $Users['P_Longitude']; ?></td>
                  <td><?php echo $Users['P_Time']; ?></td>
                  <td><?php echo $Users['P_Date']; ?></td>
                   <td>
                       <button class="btn btn-success btn-mini"><a style="color:white; text-decoretion:none; padding:10px;" href="manage_destinations.php?id=<?=base64_encode($Users['Id']);?>">Destinations</a></button></td>
                  
                 
		 
		                        <?php
		                        
                                 $cars[]=$Users['Id'];
                                 
                                        ?>  
                  <td><?php if($Users['Status']=='1'){ echo '<button class="btn btn-success btn-mini">Success</button>'; }else if($Users['Status']=='2'){ echo '<button class="btn btn-success btn-mini">Running</button>'; } else { echo '<button class="btn btn-danger btn-mini">Pending</button>';} ?></td>                        
                  <!--<td><?php if($Users['Status']=='1'){ echo '<button   id='.sizeof($cars).' class="btn btn-success btn-mini" onclick='."'approveuser(this.id)'".' >Active</button>'; }else{ echo '<button id='.sizeof($cars).'  class="btn btn-danger btn-mini" onclick='."'approveuser(this.id)'".'>Inactive</button>';} ?></td>-->
                 <td><a href="#?id=<?=base64_encode($Users['O_Id']);?>"><span class="icon-edit"><span></a> &nbsp;&nbsp;
                
				  <a href="javascript:void(0);" onclick="Delete('<?php print $Users['O_Id'];?>','<?php print "Order";?>')"><span class="icon-trash"><span></a></td>
                </tr>
                    
                    	<input type="hidden" name="Status" value="<?php echo $Status; ?>">
                    
                    	
                    	</form>
			  <?php   $sn++;}  ?>
              </tbody>
            </table>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
    <?php include("include/footer.php");?>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.tables.js"></script>
<script src="js/developer.js"></script>

<script>

function approveuser(id){

       var Id = id;
    // trid=id.split('-')[1];
       confirm('Are you Sure' +" "+ Id);
    	var form_data = new FormData();
    	form_data.append('Id',Id);

    
                	$.ajax({
 					url: 'ajax/edit_userstatus.php', // point to server-side PHP script 
 					dataType: 'text',  // what to expect back from the PHP script, if anything
 					cache: false,
 					contentType: false,
 					processData: false,
 					data: form_data,                        
 					type: 'post',
 				    success: function (result) {
 						//alert('Successfully');return false;
 						//$('.test').html(result);
 				if(result==1){
    			  $("#validation")[0].reset();
    			  $(".error").hide();
    			  $('.alert-success').show();
    			  setTimeout(function() { $(".alert-success").hide(); }, 3000);
    		  }else if (result==2){
    			  $('.alert-error').show();
    			  setTimeout(function() { $(".alert-error").hide(); }, 3000);
    		  }else if (result==3){
    			  $('.alert-error2').show();
    			  setTimeout(function() { $(".alert-error2").hide(); }, 3000);
    		  }else{
    			  $("#cat_validation")[0].reset();
    			  $(".error").hide();
    			  $('.alert-error1').show();
    			  setTimeout(function() { $(".alert-error1").hide(); }, 3000);
    		  }
 				     }
 				    });
}

// $(document).ready(function() { 
// 	        $(document).delegate(".btn-mini","click",function(){
	            
	       
                   
//                     var Id = $("#id").val();
//                     confirm(Id);
//                   console.log(Id);
			        			       
			        
// 					var form_data = new FormData();
                                
                   
//                     form_data.append('Id',Id);

//                                         //if(AddCoupon()){s
						

// 					$.ajax({
// 					url: 'ajax/edit_userstatus.php', // point to server-side PHP script 
// 					dataType: 'text',  // what to expect back from the PHP script, if anything
// 					cache: false,
// 					contentType: false,
// 					processData: false,
// 					data: form_data,                        
// 					type: 'post',
// 				    success: function (result) {
// 						//alert(result);return false;
// 						//$('.test').html(result);
// 					 if(result==1){
// 						  $(".form-horizontal")[0].reset();
// 						  $('.alert-success').show();
// 				          setTimeout(function() { $(".alert-success").hide(); location.reload(); }, 4000);
// 					  }else if (result==2){
// 						  $('.alert-error').show();
// 				          setTimeout(function() { $(".alert-error").hide(); }, 4000);
// 					  }else{
// 						  $('.alert-error1').show();
// 				          setTimeout(function() { $(".alert-error1").hide(); }, 4000);
// 					  }
// 				     }
// 				    });
				
// 					//}
				
				
// 		});
		
// 	});
</script>
</body>
</html>
