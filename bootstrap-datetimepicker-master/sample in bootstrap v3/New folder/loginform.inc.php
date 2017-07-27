<?php 
if(isset($_POST['username']) && isset($_POST['password']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(!empty($username) && !empty($password))
	{
		$password_hash = md5($password);
		$query = "SELECT user_id FROM users WHERE username='".mysqli_real_escape_string($mysql_connect, $username)."' AND password='".mysqli_real_escape_string($mysql_connect, $password_hash)."'";
		if($query_run = mysqli_query($mysql_connect, $query))
		{
			$query_run = mysqli_query($mysql_connect, $query);
			
			$query_num_rows = mysqli_num_rows($query_run);
			if($query_num_rows==0)
			{
        echo '<div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert"
              aria-hidden="true">
              &times;
              </button>
              Invalid userid/password.
              </div>';
				//echo 'Invalid username/password.';
			}
			else if($query_num_rows==1)
			{
				$query_row = mysqli_fetch_assoc($query_run);
				$user_id = $query_row['user_id'];
				$_SESSION['user_id'] = $user_id;
				header('Location: loginform.inc.php');
			}
		}
	}
	else
	{
		echo 'You must enter a username and password.';
	}
}
?>

<html lang="en" class="no-js">
<head>
<title>Bike Rental Portal</title>
	<meta charset="UTF-8">
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="./jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
  	<script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>


    <link rel="stylesheet" type="text/css" href="footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
  	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->

  	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	<link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">	
  	<link rel="stylesheet" type="text/css" href="Homepage.css">
    <link rel="stylesheet" type="text/css" href="w3.css">
    <script type="text/javascript" src="Homepage.js"></script>
    <div class="topheadNav-left">
	    <!-- this is use for icon in head -->
        <div id="mySideIconnav" class="sideIconnav">
          <a href="javascript:void(0)" class="closebtn" onclick="closeIconNav()">&times;</a>
          <a href="#">About</a>
          <a href="#">Services</a>
          <a href="#">Clients</a>
          <a href="#">Contact</a>
        </div>
        
        <!-- Use any element to open the sidenav -->
        <span onclick="openIconNav()">
            <div class="containerMenuIcon" onclick="myFunction(this)">
              <div class="bar1"></div>
              <div class="bar2"></div>
              <div class="bar3"></div>
            </div>
        </span>    
    </div>
    <!-- this portion is use to display the heading of the page -->
    <!-- in this portion we provide the sigin signup button as well as logout-->
    <div class="topheadNav-right">
        <ul class="topHeadnav">
          <li><a href="#home">Home</a></li>
          <li><a href="#news">News</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#" onclick="document.getElementById('id02').style.display='block'" >Sign Up</a></li>
          <img src="IMAGES/flat_heros_02.png" width="80px" height="50px" class="w3-rounder w3-container" style="float: right;">
		  <li class="icon">
            <a href="javascript:void(0);" onclick="myTopHeadNav()">&#9776;</a>
          </li>
            <div class="dropdownAcountSection" style="float:right;  padding-right:40px;" >

              <button class="dropbtnAccountSection">Account</button>
              <div class="dropdown-content">
                <a href="Edit form/view.<?php  ?>">My Account</a>
                <a href ="#" onclick="document.getElementById('id01').style.display='block' " class="w3-tiny w3-container w3-border-red">Login</a>
                <a href="EditAccount.php">Edit Account</a>
                <a href="logout.php" style="display: inline-block; color: black;">Logout</a>
              </div>
			</div>
        </ul>
    </div>
    
</head>
<body >

<!-- start of sign up-->
<div id="id02" class="modalSignUp">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">×</span>
  <form class="modal-contentSignUp animate" action="SignUpModal.php" method="POST">
    <div class="containerSignUp">
      <label><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required value="<?php if(isset($email)) { echo $email; } ?>">

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>

      <label><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="password_confirm" required>

      <label><b>First Name</b></label>
      <input type="text" placeholder="First Name" name="firstname" required value="<?php if(isset($firstname)) { echo $firstname; } ?>">

      <label><b>Last Name</b></label>
      <input type="text" placeholder="Last name" name="surname" required value="<?php if(isset($surname)) { echo $surname; } ?>">

      <input type="checkbox" checked="checked"> Remember me
      <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtnSignUp">Cancel</button>
        <button type="submit" class="signupbtn">Sign Up</button>
      </div>
    </div>
  </form>
</div>

<!--end of sign up -->

<!--Start of Loginform-->
    
<div class="w3-container">
    <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width: 600px">
            <div class="w3-center"><br>
            <span onclick="document.getElementById('id01').style.display = 'none' " class="   w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
<!--                <img src="flat_heros_02.png" alt="Avtar" style="width: 30%" class="w3-circle w3-margin-top">   -->
            </div>
                <form class="w3-container" action="<?php echo $current_file; ?>" method="POST">
                    <div class="w3-section" >
                        <label><b>Username</b></label>
                        <input type="text" name="username" class="w3-input w3-border w3-margin-bottom" placeholder="Enter username" > 
                        <label><b>Password</b></label>
                      <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="password" >
                      
                      <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
                      <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
                    </div>
                </form>
                     <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
                        <span class="w3-right w3-padding w3-hide-small">Forgot<a href="#">Password?</a></span>
                    </div>
        </div>
    </div>
</div>

<!--End of loginform -->


    <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
    <div id="mainBody">
	    <!-- Here image will display automatically one by one-->
        <div>
            <img id="imgBanner" src="" alt="" />
        </div>
        <!-- Image diplay end here-->    
	
	<!-- date and time menu will display here -->	     
	<!-- Start of date and time box-->
        <div class="DateAndTimeCssStyle">
            <div class="container">
                <form onsubmit="return checkDate()" method="get" action="BookingPage.php" class="form-horizontal"  role="form">
                    
                        <div class="form-group">
                            <label for="dtp_input1" class="col-md-2 control-label">Start date and time</label>
                            <div class="input-group date form_datetime col-md-5" data-date="2017-09-16 05:25:07Z" data-date-format="dd MM yyyy  HH:ii p" data-link-field="dtp_input1" >
                                <input class="form-control" name="Start_trip" id="startDate" size="16" type="text" value="" required>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                            <input type="hidden" id="dtp_input1" value="" /><br/>
                        </div>
                    
                        <div class="form-group">
                            <label for="dtp_input1" class="col-md-2 control-label">End Date and time</label>
                            <div class="input-group date form_datetime col-md-5" data-date="2017-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                                <input class="form-control" name="end_trip" id="enddate" size="16" type="text" value="" required>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                            <input type="hidden" id="dtp_input1" value="" /><br/>
                        </div>
                        <input type="submit" value="search" id="searchButton" class="w3-button w3-block w3-red w3-section w3-padding">
                </form>
            </div>
        </div>  

    <!-- end of date and time -->
    
    <script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>

    <!-- start of FAQ section -->


    <!-- end of FAQ section -->
    
	
    <!-- start of adventure and review -->
    <div class="adventure-left">
						
    </div>
    
    <div class="adventure-right">
		
    </div>
    <!-- end of adventure and review -->    


    <div class="">
    	
    </div>

    <!-- footer start here  -->
    <div class="w3-container w3-white">

      <div class="col-md-6">
          <div class="text-center center-block" >
              <p class="txt-railway"> Connect with us </p><br />
                  <a href="https://www.facebook.com"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
                <a href="https://twitter.com"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a>
                <a href="https://plus.google.com"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>
                <a href="mailto:rahuldas.das@gmail.com"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
          </div>
          <hr>
    </div>
    <div class="col-md-6">
      <br><br>
      <span>Total visit : </span>
      <a href="http://www.reliablecounter.com" target="_blank"><img src="http://www.reliablecounter.com/count.php?page=localhost/BIke-Rental-Revised/bootstrap-datetimepicker-master/sample in bootstrap v3/loginform.inc.php&digit=style/plain/6/&reloads=0" alt="" title="" border="0"></a><br /><a href="http://" target="_blank" style="font-family: Geneva, Arial; font-size: 9px; color: #330010; text-decoration: none;"></a>
    </div>
   </div> 

    <!-- end of footer -->
    
</body>
</html>

