<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Driver
        <small>Add Driver</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
        <li><a href="<?php echo base_url('admin/driver'); ?>"><i class="fa fa-cogs"></i> Manage Drivers</a></li>
        <li><a class="active"><i class="fa fa-cogs"></i> Add Driver</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Add Driver</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                
            </div>
        </div>
        <!-- form start -->
        <form role="form" name="add_form" action="<?php echo base_url('admin/driver/create_driver'); ?>" method="post" enctype="multipart/form-data" class="form-validation" >
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" name="Name" value="<?php echo set_value('Name'); ?>" class="form-control required" id="Name" placeholder="Enter name">
                            </div>
                            <span class="help-block error-message"><?php echo form_error('Name'); ?></span>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Mobile">Mobile</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" name="Mobile" value="<?php echo set_value('Mobile'); ?>" class="form-control required" id="Mobile" placeholder="Enter mobile">
                            </div>
                            <span class="help-block error-message"><?php echo form_error('Mobile'); ?></span>
                        </div>
                    </div>
                    
                </div>
                    
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                            <input type="text" name="Email" value="<?php echo set_value('Email'); ?>" class="form-control required" id="Email" placeholder="Enter email">
                        </div>
                        <span class="help-block error-message"><?php echo form_error('Email'); ?></span>
                    </div>
                </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Status">Active Status</label>
                            <select name="Status" class="form-control required" id="Status">
                                <option value="" selected="" disabled="">Select one</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <span class="help-block error-message"><?php echo form_error('Status'); ?></span>
                        </div>
                    </div>
                    
                     </div>
                    
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="License_Number">License Number</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                            <input type="text" name="License_Number" value="<?php echo set_value('License_Number'); ?>" class="form-control required" id="License_Number" placeholder="Enter license number">
                        </div>
                        <span class="help-block error-message"><?php echo form_error('License_Number'); ?></span>
                    </div>
                </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Gender">Gender Type</label>
                            <select name="Gender" class="form-control required" id="Gender">
                                <option value="" selected="" disabled="">Select one</option>
                                <option value="1">Male</option>
                                <option value="0">Female</option>
                            </select>
                            <span class="help-block error-message"><?php echo form_error('Gender'); ?></span>
                        </div>
                    </div>
                    </div>
                
 
                 
                
                <div class="row">
                    
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Address">Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" name="Address" value="<?php echo set_value('Address'); ?>" class="form-control required" id="Address" placeholder="Enter address">
                            </div>
                            <span class="help-block error-message"><?php echo form_error('Address'); ?></span>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="Vehicle Type">Vehicle Type</label>
                        <select name="v_type_id" class="form-control required" id="v_type_id">
                            <option value="" selected="" disabled="">select</option>
                            <option value = 1>Byke</option>;
                            <option value = 2>Auto</option>;
                            <option value = 1>Electric rickshaw </option>;


                        </select>
                        <span class="help-block error-message"><?php echo form_error('v_vehicle_driver_id'); ?></span>
                    </div>
                    </div>
                    
                    
                </div>
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="Image">Picture <span class="required">*</span></label>
                            <div class="input-group">
                                <?php echo form_upload(['name'=>'userfile','class'=>'form-control'])?>
                            </div>
                            <span class="help-block error-message"><?php if(isset($upload_error)) echo $upload_error ?></span>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="DL">Dl Picture<span class="required">*</span></label>
                            <div class="input-group">
                                <?php echo form_upload(['name'=>'dlfile','class'=>'form-control'])?>
                            </div>
                            <span class="help-block error-message"><?php if(isset($upload_error)) echo $upload_error ?></span>
                        </div>
                    </div>
                    
                   
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Name">Vehicle Name</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" name="v_vehicle_name" value="<?php echo set_value('v_vehicle_name'); ?>" class="form-control required" id="v_vehicle_name" placeholder="Enter vehicle name">
                            </div>
                            <span class="help-block error-message"><?php echo form_error('v_vehicle_name'); ?></span>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Number">Vehicle Number</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" name="v_vehicle_number" value="<?php echo set_value('v_vehicle_number'); ?>" class="form-control required" id="v_vehicle_number" placeholder="Enter vehicle number">
                            </div>
                            <span class="help-block error-message"><?php echo form_error('v_vehicle_number'); ?></span>
                        </div>
                    </div>
                    
                    <!-- /.col -->
                    
                </div>
                  <div class="row">
<!--                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Color">Vehicle Color </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                    <input type="text" name="v_vehicle_Color" value="<?php // echo set_value('v_vehicle_Color'); ?>" class="form-control required" id="v_vehicle_Color" placeholder="Enter vehicle color">
                                </div>
                                <span class="help-block error-message"><?php // echo form_error('v_vehicle_Color'); ?></span>
                            </div>
                        </div>-->
<!--                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Model Number">Vehicle Model Number</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" name="v_vehicle_model_no" value="<?php echo set_value('v_vehicle_model_no'); ?>" class="form-control required" id="v_vehicle_model_no" placeholder="Enter vehicle model number">
                            </div>
                            <span class="help-block error-message"><?php // echo form_error('v_vehicle_model_no'); ?></span>
                        </div>
                    </div>-->
                    </div>
                    
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Image">RC Picture <span class="required">*</span></label>
                            <div class="input-group">
                                <?php echo form_upload(['name'=>'rcfile','class'=>'form-control'])?>
                            </div>
                            <span class="help-block error-message"><?php if(isset($upload_error)) echo $upload_error ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="VehicleImage">Vehicle Picture <span class="required">*</span></label>
                            <div class="input-group">
                                <?php echo form_upload(['name'=>'vimagefile','class'=>'form-control'])?>
                            </div>
                            <span class="help-block error-message"><?php if(isset($upload_error)) echo $upload_error ?></span>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Details">Vehicle Detail</label>
                            <textarea id="v_vehicle_detail" name="v_vehicle_detail" ></textarea>
                                <script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
                                 <script>
                                      CKEDITOR.replace( 'v_vehicle_detail' );
                                </script>
                            <script src="<?php echo base_url(); ?>ckeditor/config.js"></script>
                              
                            <span class="help-block error-message"><?php echo form_error('v_vehicle_detail'); ?></span>
                        </div>
                    </div>
                    </div>
                
                
            </div>
            <div class="box-footer">
                <a href="<?php echo base_url('admin/driver'); ?>" class="btn btn-danger" data-toggle="tooltip" title="Go back"><i class="fa fa-remove"></i> Cancel</a>
                <button type="submit" value="upload" class="btn btn-success"><i class="fa fa-plus"></i> Add Info</button>
            </div>
        </form>
    </div>
</section>
<script type="text/javascript">
    document.forms['add_form'].elements['Status'].value = '<?php echo set_value('Status'); ?>';
     $(function () {
                $('#datepicker').datetimepicker();
            });
</script>