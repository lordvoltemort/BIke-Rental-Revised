<html>

<head>
<link rel="stylesheet" type="text/css" href="w3.css">
<title>View Records</title>
</head>

<body>
<div class="w3-container w3-bordered">


<?php

/*

VIEW-PAGINATED.PHP

Displays all data from 'players' table

This is a modified version of view.php that includes pagination

*/



// connect to the database

include('connect-db.php');
require '../core.inc.php';

$uid = $_SESSION['user_id'];

// number of results to show per page

$per_page = 3;



// figure out the total pages in the database

$result = mysql_query("SELECT * FROM users WHERE user_id = '$uid'");

$total_results = mysql_num_rows($result);

$total_pages = ceil($total_results / $per_page);



// check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)

if (isset($_GET['page']) && is_numeric($_GET['page']))

{

$show_page = $_GET['page'];



// make sure the $show_page value is valid

if ($show_page > 0 && $show_page <= $total_pages)

{

$start = ($show_page -1) * $per_page;

$end = $start + $per_page;

}

else

{

// error - show first set of results

$start = 0;

$end = $per_page;

}

}

else

{

// if page isn't set, show first set of results

$start = 0;

$end = $per_page;

}



// display pagination



echo "<p><a href='view.php'>View All</a> | <b>My Account:</b> ";

for ($i = 1; $i <= $total_pages; $i++)

{

echo "<a href='view-paginated.php?page=$i'>$i</a> ";

}

echo "</p>";

		displayimage();
echo '
		<form method="post" enctype="multipart/form-data"><br>
<!-- 		<center><img src="../IMAGES/flat_heros_02.png" width="300px" height="300px;"  class="w3-circle"></center> -->
		<center><input type="file" class = "w3-tiny" name="image" /><br><br>
		<input type="submit" name="submitImage" class ="w3-tiny w3-round" value="upload"></center>
		</form>

';

if (isset($_POST['submitImage'])) {
		if (getimagesize($_FILES['image']['tmp_name'])== FALSE) {
			echo "Please select an image";
		}
		else{
			$image = addslashes($_FILES['image']['tmp_name']);
			$name =addslashes($_FILES['image']['name']);
			$image = file_get_contents($image);
			$image = base64_encode($image);
			saveimage($name,$image);

		}
	}
	
	function saveimage($name,$image)
	{	
		$uid = $_SESSION['user_id'];
		$con=mysqli_connect("localhost","Rahul","Koqa313*@3");
		mysqli_select_db($con,"testing");
		$qry="UPDATE users SET userimage = '$image' , imageName= '$name' WHERE user_id ='$uid' ;";
		
		$result = mysqli_query($con,$qry);
		if ($result == true) {

			echo "<br>Image uploaded";
		}
		else{
			echo "<br>Image not uploaded";	
		}

	}

	function displayimage(){
		$con=mysqli_connect("localhost","Rahul","Koqa313*@3");
		mysqli_select_db($con,"testing");
		$uid = $_SESSION['user_id'];	
		$qry = "SELECT userImage FROM users WHERE user_id ='$uid' ;";
		$result = mysqli_query($con,$qry);
 		
		while ($row = mysqli_fetch_array($result)) {
			echo '<center><img width="300px" height="300px;"  class="w3-circle w3-card-4" src="data:image/jpg;base64,' .$row['userImage']. ' "  ></center>';
			}
		mysqli_close($con);
		
	}



// display data in table

echo "<table style='width:100%' class = 'w3-table w3-bordered w3-striped w3-hoverable w3-card-4'>";




// loop through results of database query, displaying them in the table

for ($i = $start; $i < $end; $i++)

{

// make sure that PHP doesn't try to show results that don't exist

if ($i == $total_results) { break; }



// echo out the contents of each row into a table

echo "<tr>";
	echo "<th> User id</th>";	
	echo '<td>' . mysql_result($result, $i, 'user_id') . '</td>';
	echo '<td><a href="edit.php?id=' . mysql_result($result, $i, 'user_id') . '">Edit</a></td>';
echo "</tr>";

echo "<tr>";
echo "<th>First name</th>";
echo '<td>' . mysql_result($result, $i, 'firstname') . '</td>';
echo '<td><a href="edit.php?id=' . mysql_result($result, $i, 'user_id') . '">Edit</a></td>';
echo "</tr>";

echo "<tr>";
echo "<th>Email</th>";
echo '<td>' . mysql_result($result, $i, 'username') . '</td>';
echo '<td><a href="edit.php?id=' . mysql_result($result, $i, 'user_id') . '">Edit</a></td>';
echo "</tr>";

echo "<tr>";
echo "<th>Last name</th>";
echo '<td>' . mysql_result($result, $i, 'surname') . '</td>';
echo '<td><a href="edit.php?id=' . mysql_result($result, $i, 'user_id') . '">Edit</a></td>';
echo "</tr>";









echo "</tr>";

}

// close table>

echo "</table>";



// pagination



?>



</div>

</body>

</html>