<html>
<body>

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

<script type="text/javascript">
	function passImageId(intvalue) {

	alert(intvalue);
  	var xhttp;
  	var val = intvalue;
		
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
  	} else {
  		// code for IE6, IE5
  		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  	}
  	xmlhttp.onreadystatechange = function() {
  		if (this.readyState == 4 && this.status == 200) {
  			document.getElementById("txtHint").innerHTML = this.responseText;
  		}
  	};
	xmlhttp.open("GET","http://localhost/BIke-Rental-Revised/bootstrap-datetimepicker-master/sample in bootstrap v3/updateBikesTable.php?q="+ intvalue,true);
	xmlhttp.send();

}

</script>


<div id="txtHint"><b>user info will be listed here...</b></div>
<div id="dateHint"></div>
</body>
</html>

<?php
	require 'core.inc.php';
	require 'connect.inc.php';
	
	displayImageWithButton();		

	function displayImageWithButton() {
	$con=mysqli_connect("localhost","Rahul","Koqa313*@3");
	mysqli_select_db($con,"testing");

		$qry = "SELECT * FROM bikes";
		$result = mysqli_query($con,$qry);
		
		echo "<table style='width:100%' id='t01'>
	    <tr>    
	        <th>Bike id</th>
	        <th>user_id</th>
	        <th>start date</th>
	        <th>end date</th>
	        <th>image id</th>  
	        <th>Status </th>   
	    </th>";


		while ($row = mysqli_fetch_array($result)) {
		echo "<form method = 'POST' action = '' >";
		echo "<tr>";
		$s = $row['bike_id'];	
        echo "<td>" . $row['bike_id'] . "</td>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['start_date'] . "</td>";
        echo "<td>" . $row['end_date'] . "</td>";
        echo "<td>" . $row['image_id'] . "</td>";
        echo "<td>" . " <input type = 'checkbox' onclick = 'passImageId( $s )' > " . "</td>";
	//	$s = '<img height ="300" width ="300" src="data:image/jpg;base64,' .$row['image']. ' " ';
		
		@$GLOBALS['image_id'] = $row['image_id'];
		@$s = $s +'id = ' + $row['image_id'] +' >';
	
//		echo '<br> <input type ="button" name = "getId" value = "Click to book" onclick = " passImageId(\''.str_replace("'", "\\'", $s).'\'">';
		        echo "</tr>";
		echo "</form>";
	}
	mysqli_close($con);
	
}


?>