<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('welcome/do_upload');?>

 <?php echo form_upload(['name'=>'userfile']); ?>

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>