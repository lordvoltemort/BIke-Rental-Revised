<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="w3.css">
<script type="text/javascript">
    function test(test) {
        var temp = test;
        alert(temp);
        var updateVal = 'NULL';
    var xmlhttp;
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
//            document.getElementById("txtHint").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET","http://localhost/BIke-Rental-Revised/bootstrap-datetimepicker-master/sample in bootstrap v3/updateBikesTable.php?q="+updateVal, true);
    xmlhttp.send();

    }
</script>
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
<script type="text/javascript">
    
</script>

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
            $temp = $row['bike_id'];
            echo "<td> " . " <input type = 'checkbox' checked >" . "</td>";    
        }else{
            $temp = $row['bike_id'];
            echo "<td>" . " <input type = 'checkbox' onclick = 'passImageId( $temp )'  >" . "</td>";    
//            $imageValue =  $row['image_id'];
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
    <br><br><input type="submit" name="Submit" class="w3-button w3-block w3-green">
</body>
</html> 