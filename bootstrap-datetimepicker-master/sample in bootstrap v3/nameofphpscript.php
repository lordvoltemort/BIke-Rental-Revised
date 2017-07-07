<?php

require 'core.inc.php';
require 'connect.inc.php';
 
$status = '0';
 
if(isset($_POST['homepage']) && $_POST['homepage'] == '1')
{
	$status = $_POST['homepage'];
}
 
$mysqli = new mysqli('localhost', 'Rahul', 'Koqa313*@3', 'testing');
 
// check connection
if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
}	
 
// assuming there is a checkstatus field in the table
$mysqli = "UPDATE bikes SET checkstatus =  ? , start_date = NULL , end_date = NULL , user_id = NULL  WHERE bike_id = '10001'";
 
mysqli_query($mysql_connect,$mysqli);
 
?>
