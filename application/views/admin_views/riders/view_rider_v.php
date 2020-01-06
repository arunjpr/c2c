<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Rider
        <small>View Rider </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
        <li><a href="<?php echo base_url('admin/rider'); ?>"><i class="fa fa-cogs"></i> Manage Rider</a></li>
        <li class="active"><i class="fa fa-circle-o"></i> View Rider </li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">View Rider </h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                
            </div>
        </div>
<div class="box-body">
    <div class="row">
        <div class="col-md-12">
                <div class="col-lg-2 col-md-3">
                    <!--<img src="<?php echo base_url() ?>/assets/backend/img/rider/<?php echo $user_data['Image'] ?>" class="img-responsive img-thumbnail">-->
                    <div class="card" style="width: 18rem;">
  <img src="https://pbs.twimg.com/media/DY4qiZxWAAAiUIZ.jpg"  style="border: 2px #d2d2d2 solid; padding: 4px;"    width="154px" class="card-img-top" alt="...">
  
</div>
<br>
<div class="card" style="width: 18rem;">
  <img src="https://static1.fashionbeans.com/wp-content/uploads/2017/10/best-mens-medium-length-hairstyles2.jpg"     width="154px" class="card-img-top" alt="...">
  
</div>
                </div>
<div class="table-responsive panel">
    <table class="table">
    <tbody>
        <tr>

        <td class="text-success"><i class="fa fa-user"></i> Name :</td>

        <td class="text-left"><?php echo $user_data['Name']; ?></td>
    </tr>
    <tr>
        <td class="text-success"><i class="fa fa-mobile"></i> Mobile :</td>
        <td><?php echo $user_data['Mobile']; ?></td>
    </tr>

        <tr>
            <td class="text-success"><i class="fa fa-envelope-o"></i> Email :</td>
            <td><?php echo $user_data['Email']; ?></td>
        </tr>
        <tr>
            <td class="text-success"><i class="fa fa-calendar"></i> Birthday :</td>
            <td><?php echo $user_data['Dob']; ?></td>
        </tr>
        <tr>
            <td class="text-success"><i class="fa fa-home"></i> Address :</td>
            <td><?php echo $user_data['Address']; ?></td>
        </tr>

        </tbody>
    </table>
</div>
</div>
</div>
</div>
</div>
</section>
