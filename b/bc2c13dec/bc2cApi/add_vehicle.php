<?php
require_once("lib/database.php");
require_once("lib/function.php");
?>
<!DOCTYPE html>
<html lang="en">
<!--Head-part-->
   <?php include("segment/head.php");?>
  <link rel="stylesheet" href="css/datepicker.css" />

<!--close-Head-part-->
<body>

<!--Header-part-->
   <?php include("segment/header.php");?>   
<!--close-Header-part-->

<!--sidebar-menu-->
    <?php include("segment/left_sidebar.php");?>
<!--close-sidebar-menu--> 
<style> .error{ color:red;display:none; }</style>
	
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_test" class="tip-bottom">Faculty</a> <a href="javascript:void(0);" class="current">Add Faculty</a> </div>
  <h1>Add Vehicle</h1>
</div>
<div class="container-fluid">
  <hr>
  <div id="show"></div>
  
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Vehicle</h5>
        </div>
        <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="" autocomplete="off">
		  
		    <!--Message-Part-Start-->
		    <div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Vehicle Added Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Something went wrong.please try again. 
			</div>
			
			<div class="alert alert-error1" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Warning ! </strong>Test Name already exit. Please try to new. 
			</div>
			<!--Message-Part-End-->
			<div class="test"></div>
			
			
			<div class="control-group">
              <label class="control-label">Vehicle Name :</label>
              <div class="controls">
                <input type="text" placeholder="Vehicle Name" class="span6" id="v_name"/>
				<label id="error_name" class="error">Please Enter Test Name.</label>
              </div>
            </div>
            
            
            
			
			
            
            <div class="control-group">
              <label class="control-label">Vehicle Color :</label>
              <div class="controls">
                <input type="text" placeholder="Color" class="span6" id="v_color"/>
				<label id="error_color" class="error">Please Enter Color.</label>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Vehicle Number:</label>
              <div class="controls">
                <input type="text" placeholder="Enter Vehicle Number" class="span6" id="v_num"/>
                <label id="error_num" class="error">Please Enter Vehicle Number.</label>
              </div>
            </div>
            
            
                        
                   
                        
                        
			 <div class="form-actions">
              <input type="button" value="Submit" class="btn btn-success add_vehicle" >
            </div>
          </form>
        </div>
      </div>
      
      
    </div>
    
  </div>
 
</div></div>
<!--Footer-part-->
 <?php include("include/footer.php");?>
<!--end-Footer-part-->
<script src="js/developer.js"></script> 
<script src="js/developer-validation.js"></script>

<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script>  
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/matrix.js"></script> 

<script src="js/bootstrap-colorpicker.js"></script> 
<script src="js/matrix.form_common.js"></script> 
<script src="js/bootstrap-datepicker.js"></script> 





</body>
</html>
<script>
$(document).ready(function() { 
	        $(document).delegate(".add_vehicle","click",function(){
				 
                    var v_name = $("#v_name").val();
                    var v_color = $("#v_color").val();
                    var v_num = $("#v_num").val();
					var form_data = new FormData();
					form_data.append('v_name', v_name);
					form_data.append('v_color', v_color);
					form_data.append('v_num', v_num);	
                    
                    //if(AddCoupon()){
						

					$.ajax({
					url: 'ajax/add_vehicle.php', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                        
					type: 'post',
				    success: function (result) {
						//alert(result);return false;
						//$('.test').html(result);
					 if(result==1){
						  $(".form-horizontal")[0].reset();
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); location.reload(); }, 3000);
					  }else if (result==2){
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }else{
						  $('.alert-error1').show();
				          setTimeout(function() { $(".alert-error1").hide(); }, 3000);
					  }
				     }
				    });
				
					//}
				
				
		});
		
	});
	

</script>





			
			
