<html>
<body>

<script type="text/javascript" src = "Homepage.js"></script>

<div id="txtHint"><b>user info will be listed here...</b></div>
<div id="dateHint"></div>
</body>
</html>

<?php
	require 'core.inc.php';
	require 'connect.inc.php';
	$startdate = $_REQUEST['Start_trip'];
	$enddate = $_REQUEST['end_trip'];
	$resultstart = DateTime::createFromFormat('d M Y  h:i A', $startdate);
	$start = $resultstart->format('Y-m-d H:i:s');
	$resultend = DateTime::createFromFormat('d M Y - h:i A', $enddate);
	$end = $resultend->format('Y-m-d H:i:s');
	$_SESSION["sdate"] = $start;
	$_SESSION["edate"] = $end ;

	$interval = $resultend->diff($resultstart);
    echo $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
    $elapsed1 = $interval->format('%a');
    $elapsed2 = $interval->format('%h');
    $test = ($elapsed1 * 24 );
    $elapsed3 = $interval->format('%i');
    $test2 = $elapsed3 /60;
    echo $totalTime=  $elapsed2 + $test + $test2;
    $_SESSION["totalTime"] = $totalTime; 

/**************************************************************************************************************** 
 *                                                                                                              * 
 * Here we check that user is login or not If loggedin then all then avaibale as well bookek bike photos are    *
 * shown the difference is that if we are not loggedin then we cannot proceed forward                           *
 * If logged in then we can book a bike                                                                         *
 * By clicking that book button we send our userid,start date and end date it will upadted to databse.
 *                                                                                                              *
 ****************************************************************************************************************/
	if(loggedin())
	{
		$userid = getuserfield('user_id');		
		$GLOBALS['firstname'] = getuserfield('username');
		$GLOBALS['surname'] = getuserfield('surname');
		echo 'You\'re logged in, '.$firstname.' '.$surname.'.<br/> userid is '. $userid;
		echo '<a href="logout.php">Log Out</a>';

		displayImageWithButton();
		displayImageWithoutButton();

	}
	else{
		echo "Please login first for booking... To proceed forward.";
		echo "";
		displayImageWithButton();		
		displayImageWithoutButton();

	}

		function displayImageWithButton() {
		$con=mysqli_connect("localhost","Rahul","Koqa313*@3");
		mysqli_select_db($con,"testing");

		$startdate = $_REQUEST['Start_trip'];
		$enddate = $_REQUEST['end_trip'];
//		$startdate =  "16 September 2017 05:25 am";
		$resultstart = DateTime::createFromFormat('d M Y  h:i A', $startdate);
		
		$resultend = DateTime::createFromFormat('d M Y - h:i A', $enddate);
		

		$qry = "SELECT bikes.user_id , images.image , images.image_id FROM `bikes` INNER JOIN images ON bikes.image_id = images.image_id AND bikes.user_id IS NULL ;";
			$result = mysqli_query($con,$qry);
			while ($row = mysqli_fetch_array($result)) {
			echo "<form method = 'POST' action = '' >";
			$s = '<img height ="300" width ="300" src="data:image/jpg;base64,' .$row['image']. ' " ';
			echo '<img height ="300" width ="300" src="data:image/jpg;base64,' .$row['image']. ' "  >';
			@$GLOBALS['image_id'] = $row['image_id'];
			@$s = $s +'id = ' + $row['image_id'] +' >';
			$start = $resultstart->format('Y-m-d H:i:s');	
			$end = $resultend->format('Y-m-d H:i:s');
			echo '<br> <input type ="button" name = "getId" value = "Click to book" onclick = " passImageId(
			\''.str_replace("'", "\\'", $s).'\', \''.str_replace("'", "\\'", $start).'\',\''.str_replace("'", "\\'", $end).'\')">  ';
			echo "</form>";
		}
		mysqli_close($con);
		
	}

	function displayImageWithoutButton() {
		$con=mysqli_connect("localhost","Rahul","Koqa313*@3");
		mysqli_select_db($con,"testing");
		$qry = "SELECT bikes.user_id , images.image , images.image_id FROM `bikes` INNER JOIN images ON bikes.image_id = images.image_id AND bikes.user_id IS NOT null ;";
			$result = mysqli_query($con,$qry);
			while ($row = mysqli_fetch_array($result)) {
			echo "<form method = 'POST' action = '' >";
			$s = '<img height ="300" width ="300" src="data:image/jpg;base64,' .$row['image']. ' " ';
			echo '<img height ="300" width ="300" src="data:image/jpg;base64,' .$row['image']. ' "  >';
			@$GLOBALS['image_id'] = $row['image_id'];
			@$s = $s +'id = ' + $row['image_id'] +' >';
			echo "</form>";
		}
		mysqli_close($con);
	}

/***************************************************************************************************************
 * this function is used to update the bikes table when user is valid and book a bike 
****************************************************************************************************************/
/*	
	function functionName($x,$startdate,$enddate,$user_id )
	{	
		$con=mysqli_connect("localhost","Rahul","Koqa313*@3");
		mysqli_select_db($con,"testing");
//		echo "Bike id is : $x";
		$startdate = $_REQUEST['Start_trip'];
		$enddate = $_REQUEST['end_trip'];
//		$startdate =  "16 September 2017 05:25 am";
		$resultstart = DateTime::createFromFormat('d M Y  h:i A', $startdate);
		$start = $resultstart->format('Y-m-d H:i:s');
		$resultend = DateTime::createFromFormat('d M Y - h:i A', $enddate);
		$end = $resultend->format('Y-m-d H:i:s');
		echo $sql = " UPDATE bikes SET user_id = '$user_id' ,start_date = '$start',end_date='$end'  WHERE bike_id= '$x' ";
		
	}
*/	
?>