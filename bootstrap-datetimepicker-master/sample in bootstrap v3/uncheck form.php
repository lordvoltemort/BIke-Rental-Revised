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
table#t01 th    {
    background-color: black;
    color: white;
}

</style>
</head>
<body>

<?php
require 'core.inc.php';
require 'connect.inc.php';


    $sql="SELECT * FROM bikes ";
    $result = mysqli_query($mysql_connect,$sql);
    
    echo "<table style='width:100%' id='t01'>
    <tr>
        <th>Bike id</th>
        <th>user_id</th>
        <th>start date</th>
        <th>end date</th>
        <th>image id</th>  
        <th>Status </th>   
    </th>";
    while($row = @mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['bike_id'] . "</td>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['start_date'] . "</td>";
        echo "<td>" . $row['end_date'] . "</td>";
        echo "<td>" . $row['image_id'] . "</td>";

  
        if (!$row['start_date'] || !$row['end_date']) {
            echo "<td> " . " <input type = 'checkbox' checked <?php echo isChecked() ?>  " . "</td>";    
        }else{
            echo "<td>" . " <input type = 'checkbox'   <?php  ?>  " . "</td>";    
            $imageValue =  $row['image_id'];
        }

        
        echo "</tr>";
    }
    
    echo "</table>";
    
    function isChecked() {
        echo "isChecked function is called";
    # perform SQL query
    # if value exists, set $exists to true
    if ($exists) {
        return "checked";
    } else {
        return "";
    }
}

    ?>
</body>
</html> 