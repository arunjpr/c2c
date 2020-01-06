<?php
//ob_start();
//session_start();
//if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) @ob_start("ob_gzhandler"); else @ob_start();
error_reporting(1); 
ini_set('arg_separator.output','&amp;');


	/* Live Server database Info */
	define('DBSERVER',"localhost");
	define('DBNAME',"c2c_dev");
	define('DBUSER',"c2c_dev");
	define('DBPASS',"c2c_dev");
// Database Connection Establishment String
//$conn = new mysqli(DB_HOST, DB_USER, DBPASS, DBNAME);
$conn = new mysqli(DBSERVER, DBUSER, DBPASS, DBNAME);



if ($conn->connect_error) { // Check connection
    die("Connection failed: " . $conn->connect_error);
}



	?>

                            
                            
                            
                            
