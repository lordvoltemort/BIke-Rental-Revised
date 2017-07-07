<html>

<head>
<link rel="stylesheet" type="text/css" href="w3.css">
<title>View Records</title>

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



echo "<p><a href='view.php'>View All</a> | <b>View Page:</b> ";

for ($i = 1; $i <= $total_pages; $i++)

{

echo "<a href='view-paginated.php?page=$i'>$i</a> ";

}

echo "</p>";



// display data in table

echo "<table style='width:100%' id='t01'>";

echo "<tr> <th>ID</th> <th>First Name</th> <th>Last Name</th> <th></th> <th></th></tr>";



// loop through results of database query, displaying them in the table

for ($i = $start; $i < $end; $i++)

{

// make sure that PHP doesn't try to show results that don't exist

if ($i == $total_results) { break; }



// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . mysql_result($result, $i, 'user_id') . '</td>';

echo '<td>' . mysql_result($result, $i, 'firstname') . '</td>';

echo '<td>' . mysql_result($result, $i, 'surname') . '</td>';

echo '<td><a href="edit.php?id=' . mysql_result($result, $i, 'user_id') . '">Edit</a></td>';

echo '<td><a href="delete.php?id=' . mysql_result($result, $i, 'user_id') . '">Delete</a></td>';

echo "</tr>";

}

// close table>

echo "</table>";



// pagination



?>





</body>

</html>