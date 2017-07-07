<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="w3.css">
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body >

<?php
require 'core.inc.php';

//echo "<br>image id is : ". $q ."<br> and startdate is : ". $startdate . "<br> enddate is : " .$enddate;

@$user_id = $_SESSION['user_id'];
@$sql = " UPDATE bikes SET user_id = '$user_id' ,start_date = '$start',end_date='$end'  WHERE bike_id= '$q' ";
@$con = mysqli_connect('localhost','Rahul','Koqa313*@3');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
if(loggedin())
{

	echo '
	<center><img src="IMAGES/kochi.jpg" width="300px" height="300px;"  class="w3-circle	w3-padding"></center> 
	<input type="button" name="upload" value ="upload" class="w3-button w3-red w3-round w3-small">
	';
    $firstname = getuserfield('username');
    $surname = getuserfield('surname');
    echo 'user email is : '.$firstname.'<br/>';
    echo ' Surname is : '.$surname.'<br/>';

	mysqli_select_db($con,"testing");
	@$sql="SELECT * FROM bikes WHERE image_id = '".$q."'";
	$result = mysqli_query($con,$sql);
	
	echo "<table>
	<tr>
	<th>user_id</th>
	<th>bike_id</th>
	<th>start_date</th>
	<th>end_date</th>
	<th>image_id</th>
	</tr>";
	while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>" . $row['user_id'] . "</td>";
		echo "<td>" . $row['bike_id'] . "</td>";
		echo "<td>" . $row['start_date'] . "</td>";
		echo "<td>" . $row['end_date'] . "</td>";
		echo "<td>" . $row['image_id'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
	mysqli_close($con);

}else{

	echo "Please login first";
	echo " <div> </div>";
}
?>
</body>
</html> 