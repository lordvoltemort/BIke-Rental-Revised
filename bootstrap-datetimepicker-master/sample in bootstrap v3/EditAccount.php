<!DOCTYPE html>
<html>
<head>
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
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}
table#t01 th	{
    background-color: black;
    color: white;
}

</style>
</head>
<body>

<?php
require 'core.inc.php';

@$user_id = $_SESSION['user_id'];
@$sql = " UPDATE bikes SET user_id = '$user_id' ,start_date = '$start',end_date='$end'  WHERE bike_id= '$q' ";
@$con = mysqli_connect('localhost','Rahul','Koqa313*@3');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
if(loggedin())
{
    $firstname = getuserfield('username');
    $surname = getuserfield('surname');
    echo 'user email is : '.$firstname.'<br/>';
    echo ' Surname is : '.$surname.'<br/>';

	mysqli_select_db($con,"testing");
	$sql="SELECT * FROM users ";
	$result = mysqli_query($con,$sql);
	
	echo "<table style='width:100%' id='t01'>
	<tr>
	<th>user_id</th>
	<th>username</th>
	<th>firstname</th>
	<th>lastname</th>	
	</th>";
	while($row = @mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>" . $row['user_id'] . "</td>";
		echo "<td>" . $row['username'] . "</td>";
		echo "<td>" . $row['firstname'] . "</td>";
		echo "<td>" . $row['surname'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
	mysqli_close($con);

}else{
	echo "Please login first";
	echo "<a href='index.php'>Click here to move to login page.</a>	";
}
?>
</body>
</html> 