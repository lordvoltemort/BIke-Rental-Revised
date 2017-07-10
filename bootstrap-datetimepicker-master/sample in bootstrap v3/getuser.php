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
</style>
</head>
<body>

<?php
require 'core.inc.php';
$q = $_GET['q'];
//echo "<br>image id is : ". $q ."<br> and startdate is : ". $startdate . "<br> enddate is : " .$enddate;

echo $start = $_SESSION["sdate"];
$end = $_SESSION["edate"];
$user_id = $_SESSION['user_id'];

/*
    $resultstart = DateTime::createFromFormat('d M Y  h:i A', $start);
    $start = $resultstart->format('Y-m-d H:i:s');
    $resultend = DateTime::createFromFormat('d M Y - h:i A', $end);
    $end = $resultend->format('Y-m-d H:i:s');
    
    $datetime1 = new DateTime();
    $datetime2 = new DateTime('2017-06-23 17:13:00');
    
    $interval = $resultend->diff($resultstart);
    $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
    echo $elapsed;
*/



//$sql = " UPDATE users SET user_id = '$user_id' ,start_date = '$start',end_date='$end'  WHERE bike_id= '$q' ";
$con = mysqli_connect('localhost','Rahul','Koqa313*@3');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
if(loggedin())
{
    $firstname = getuserfield('username');
    $surname = getuserfield('surname');
    echo 'You\'re logged in, '.$firstname.' '.$surname.'.<br/>';
}    

mysqli_select_db($con,"testing");
//$sql="SELECT * FROM bikes WHERE image_id = '".$q."'";
$sql = " UPDATE bikes SET user_id = '$user_id' ,start_date = '$start',end_date='$end'  WHERE image_id= '$q' ";
$result = mysqli_query($con,$sql);


/*
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
*/

?>
</body>
</html> 