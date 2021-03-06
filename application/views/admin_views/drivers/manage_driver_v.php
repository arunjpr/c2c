<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Drivers
        <small>Manage Drivers</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Drivers</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
             
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12" >
                    <a href="<?php echo base_url('admin/driver/add_driver'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add Drivers </a>
                </div>
                <div class="col-md-12" style="margin-top: 25px;">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL#</th>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th> 
<!--                                <th>Address</th> -->
<!--                                <th>Dob</th> -->
                                <th>Gender</th> 
                                <th>Added<br>By</th> 
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl = 1; ?>
                            <?php foreach ($driver_info as $user_data) { ?>
                                <?php $memberObj = $this->session->userdata; ?>
                            <tr>
                                    <td><?php echo $sl++; ?></td>
                                    <td><img src="<?php echo base_url() ?>/assets/backend/img/driver/profile/<?php echo $user_data['Image'] ?>" style="width: 60px;height: 30px;"></td>
                                    <td><?php echo $user_data['Name']; ?></td>
                                    <td><?php echo $user_data['Mobile']; ?></td>
                                    <td><?php echo $user_data['Email']; ?></td>
<!--                                    <td><?php // echo $user_data['Address']; ?></td>-->
<!--                                    <td><?php // echo $user_data['Dob']; ?></td>-->
                                    <td>
                                        <?php 
                                        $gender=$user_data['Gender'];
                                        if($gender==1){
                                            echo 'Male';
                                            }
                                        if($gender==2){
                                            echo 'Female';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $memberObj['admin_name']; ?></td>
                                    
                                    <td>
                                        <?php
                                        $status = $user_data['Status'];
                                        if ($status == 1) {
                                            echo "<a href='" . base_url('admin/driver/unpublished_driver/' . $user_data['Id'] . '') . "' class='btn btn-block btn-success btn-xs' data-toggle='tooltip' title='Click to inactive'><i class='fa fa-arrow-down'></i> Active</a>";
                                        } else {
                                            echo "<a href='" . base_url('admin/driver/published_driver/' . $user_data['Id'] . '') . "' class='btn btn-block btn-warning btn-xs' data-toggle='tooltip' title='Click to active'><i class='fa fa-arrow-up'></i> Inactive</a>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/driver/edit_driver/' . $user_data['Id'] . ''); ?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo base_url('admin/driver/view_driver/' . $user_data['Id'] . ''); ?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                                        <a href="<?php echo base_url('admin/driver/remove_driver/' . $user_data['Id'] . '') ?>" class="btn btn-danger btn-xs check_delete" data-toggle="tooltip" title="Delete"><i class="fa fa-remove"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- /.table -->
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</section>