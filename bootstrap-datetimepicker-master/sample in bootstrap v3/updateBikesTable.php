<?php
	require 'core.inc.php';
	$imageId= $_GET['q'];

	$con = mysqli_connect("localhost","Rahul","Koqa313*@3");
	if (!$con) {
		die('Could not connect: ' . mysqli_error($con));
	}
	mysqli_select_db($con,"testing");

	$sql = " UPDATE bikes SET user_id = NULL ,start_date = NULL,end_date=NULL  WHERE bike_id= '$imageId' ";
	$result = mysqli_query($con,$sql);

?>