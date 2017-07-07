<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

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


<title>View Records</title>

</head>

<body>



<?php

/*

VIEW.PHP

Displays all data from 'players' table

*/



// connect to the database

include('connect-db.php');



// get results from database

$result = mysql_query("SELECT * FROM users")

or die(mysql_error());



// display data in table

echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>My Account</a></p>";



echo "<table style='width:100%' id='t01'>";

echo "<tr> <th>user_id</th> <th>First Name</th> <th>Last Name</th> <th></th> <th></th></tr>";



// loop through results of database query, displaying them in the table

while($row = mysql_fetch_array( $result )) {



// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . $row['user_id'] . '</td>';

echo '<td>' . $row['firstname'] . '</td>';

echo '<td>' . $row['surname'] . '</td>';

echo '<td><a href="edit.php?$user_id=' . $row['user_id'] . '">Edit</a></td>';

echo '<td><a href="delete.php?$user_id=' . $row['user_id'] . '">Delete</a></td>';

echo "</tr>";

}



// close table>

echo "</table>";

?>

</body>

</html>