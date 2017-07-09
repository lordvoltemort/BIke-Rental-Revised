<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<script type="text/javascript" src = "Homepage.js"></script>

<div id="txtHint"><b>user info will be listed here...</b></div>
<div id="dateHint"></div>


<div class="container">

<div class="page-header">
    <h1>Product Slider </h1>
</div>

<!-- Product Slider - START -->


<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-9">
                <h3>Products Showcase using carousel and Bootstrap</h3>
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-chevron-left btn btn" href="#carousel-example"
                        data-slide="prev"></a><a class="right fa fa-chevron-right btn" href="#carousel-example"
                            data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">


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
    
    /*$datetime1 = new DateTime();
    $datetime2 = new DateTime('2017-06-23 17:13:00');*/
    
    $interval = $resultend->diff($resultstart);
    $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
    echo $elapsed;

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
		

		$qry = "SELECT bikes.user_id , images.image , images.image_id,images.name FROM bikes INNER JOIN images ON bikes.image_id = images.image_id AND bikes.user_id IS NULL ;";
			$result = mysqli_query($con,$qry);
			while ($row = mysqli_fetch_array($result)) {
			echo "<form method = 'POST' action = '' >";
			$s = '<img height ="300" width ="300" src="data:image/jpg;base64,' .$row['image']. ' " ';
//			echo '<img height ="300" width ="300" src="data:image/jpg;base64,' .$row['image']. ' "  >';
			echo '<div class="col-sm-3">
                            <div class="col-item">
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>'.$row['name'].'</h5>
                                            <h5 class="price-text-color">$9.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="photo">
                                    <img src="data:image/jpg;base64,' .$row['image']. ' " class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm"></a>
                                       ';
			@$GLOBALS['image_id'] = $row['image_id'];
			@$s = $s +'id = ' + $row['image_id'] +' >';
			$start = $resultstart->format('Y-m-d H:i:s');	
			$end = $resultend->format('Y-m-d H:i:s');
			echo '<a href = "#" name = "getId" onclick = " passImageId(\''.str_replace("'", "\\'", $s).'\', \''.str_replace("'", "\\'", $start).'\',\''.str_replace("'", "\\'", $end).'\')">Click here </a>';
			/*echo '<br> <input type ="button" name = "getId" value = "Click to book" onclick = " passImageId(
			\''.str_replace("'", "\\'", $s).'\', \''.str_replace("'", "\\'", $start).'\',\''.str_replace("'", "\\'", $end).'\')">  ';*/
			 echo '</p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="#" class="hidden-sm">More details</a>
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>';
			echo "</form>";
		}
		echo '</div><br>';
		mysqli_close($con);
		
	}

	function displayImageWithoutButton() {
		$con=mysqli_connect("localhost","Rahul","Koqa313*@3");
		mysqli_select_db($con,"testing");
		$qry = "SELECT bikes.user_id , images.image , images.image_id,images.name FROM `bikes` INNER JOIN images ON bikes.image_id = images.image_id AND bikes.user_id IS NOT null ;";
			$result = mysqli_query($con,$qry);
			while ($row = mysqli_fetch_array($result)) {
			echo "<form method = 'POST' action = '' >";
			$s = '<img height ="300" width ="300" src="data:image/jpg;base64,' .$row['image']. ' " ';
			//echo '<img height ="300" width ="300" src="data:image/jpg;base64,' .$row['image']. ' "  >';
			echo '<div class="col-sm-3">
                            <div class="col-item">
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>'.$row['name'].'</h5>
                                            <h5 class="price-text-color">$19.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i>
                                            <i class="price-text-color fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="photo">
                                    <img src="data:image/jpg;base64,' .$row['image']. ' " class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Not avaibale</a>
                                        </p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="#" class="hidden-sm">More details</a>
                                        </p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>';
			@$GLOBALS['image_id'] = $row['image_id'];
			@$s = $s +'id = ' + $row['image_id'] +' >';
			echo "</form>";
		}
		mysqli_close($con);
	}
?>


                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.col-item
{
    border: 2px solid #2323A1;
    border-radius: 5px;
    background: #FFF;
}
.col-item .photo img
{
    margin: 0 auto;
    width: 100%;
}

.col-item .info
{
    padding: 10px;
    border-radius: 0 0 5px 5px;
    margin-top: 1px;
}
.col-item:hover .info {
    background-color: rgba(215, 215, 244, 0.5); 
}
.col-item .price
{
    /*width: 50%;*/
    float: left;
    margin-top: 5px;
}

.col-item .price h5
{
    line-height: 20px;
    margin: 0;
}

.price-text-color
{
    color: #00990E;
}

.col-item .info .rating
{
    color: #003399;
}

.col-item .rating
{
    /*width: 50%;*/
    float: left;
    font-size: 17px;
    text-align: right;
    line-height: 52px;
    margin-bottom: 10px;
    height: 52px;
}

.col-item .separator
{
    border-top: 1px solid #FFCCCC;
}

.clear-left
{
    clear: left;
}

.col-item .separator p
{
    line-height: 20px;
    margin-bottom: 0;
    margin-top: 10px;
    text-align: center;
}

.col-item .separator p i
{
    margin-right: 5px;
}
.col-item .btn-add
{
    width: 50%;
    float: left;
}

.col-item .btn-add
{
    border-right: 1px solid #CC9999;
}

.col-item .btn-details
{
    width: 50%;
    float: left;
    padding-left: 10px;
}
.controls
{
    margin-top: 20px;
}
[data-slide="prev"]
{
    margin-right: 10px;
}
</style>

<!-- Product Slider - END -->

</div>

</body>
</html>