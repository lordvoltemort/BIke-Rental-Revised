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

    
    <!-- FAQ sectio start here -->
            
            <a class="cd-faq-trigger" href="#0">
            <header>
                <h1>FAQ Section get your answer .</h1>
            </header>
            </a>
                            <div class="cd-faq-content">
            <section class="cd-faq">
                <ul class="cd-faq-categories">
                    <li><a class="selected" href="#basics">Basics</a></li>
                    <li><a href="#mobile">Mobile</a></li>
                    <li><a href="#account">Account</a></li>
                    <li><a href="#payments">Payments</a></li>
                    <li><a href="#privacy">Privacy</a></li>
                    <li><a href="#delivery">Delivery</a></li>
                </ul> <!-- cd-faq-categories -->
        
                <div class="cd-faq-items">
                    <ul id="basics" class="cd-faq-group">
                        <li class="cd-faq-title"><h2>Basics</h2></li>
                        <li>
                            <a class="cd-faq-trigger" href="#0">How do I change my password?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae quidem blanditiis delectus corporis, possimus officia sint sequi ex tenetur id impedit est pariatur iure animi non a ratione reiciendis nihil sed consequatur atque repellendus fugit perspiciatis rerum et. Dolorum consequuntur fugit deleniti, soluta fuga nobis. Ducimus blanditiis velit sit iste delectus obcaecati debitis omnis, assumenda accusamus cumque perferendis eos aut quidem! Aut, totam rerum, cupiditate quae aperiam voluptas rem inventore quas, ex maxime culpa nam soluta labore at amet nihil laborum? Explicabo numquam, sit fugit, voluptatem autem atque quis quam voluptate fugiat earum rem hic, reprehenderit quaerat tempore at. Aperiam.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">How do I sign up?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi cupiditate et laudantium esse adipisci consequatur modi possimus accusantium vero atque excepturi nobis in doloremque repudiandae soluta non minus dolore voluptatem enim reiciendis officia voluptates, fuga ullam? Voluptas reiciendis cumque molestiae unde numquam similique quas doloremque non, perferendis doloribus necessitatibus itaque dolorem quam officia atque perspiciatis dolore laudantium dolor voluptatem eligendi? Aliquam nulla unde voluptatum molestiae, eos fugit ullam, consequuntur, saepe voluptas quaerat deleniti. Repellendus magni sint temporibus, accusantium rem commodi?</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">Can I remove a post?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis provident officiis, reprehenderit numquam. Praesentium veritatis eos tenetur magni debitis inventore fugit, magnam, reiciendis, saepe obcaecati ex vero quaerat distinctio velit.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">How do reviews work?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis provident officiis, reprehenderit numquam. Praesentium veritatis eos tenetur magni debitis inventore fugit, magnam, reiciendis, saepe obcaecati ex vero quaerat distinctio velit.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
                    </ul> <!-- cd-faq-group -->
        
                    <ul id="mobile" class="cd-faq-group">
                        <li class="cd-faq-title"><h2>Mobile</h2></li>
                        <li>
                            <a class="cd-faq-trigger" href="#0">How does syncing work?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit quidem delectus rerum eligendi mollitia, repudiandae quae beatae. Et repellat quam atque corrupti iusto architecto impedit explicabo repudiandae qui similique aut iure ipsum quis inventore nulla error aliquid alias quia dolorem dolore, odio excepturi veniam odit veritatis. Quo iure magnam, et cum. Laudantium, eaque non? Tempore nihil corporis cumque dolor ipsum accusamus sapiente aliquid quis ea assumenda deserunt praesentium voluptatibus, accusantium a mollitia necessitatibus nostrum voluptatem numquam modi ab, sint rem.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">How do I upload files from my phone or tablet?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi tempore, placeat quisquam rerum! Eligendi fugit dolorum tenetur modi fuga nisi rerum, autem officiis quaerat quos. Magni quia, quo quibusdam odio. Error magni aperiam amet architecto adipisci aspernatur! Officia, quaerat magni architecto nostrum magnam fuga nihil, ipsum laboriosam similique voluptatibus facilis nobis? Eius non asperiores, nesciunt suscipit veniam blanditiis veritatis provident possimus iusto voluptas, eveniet architecto quidem quos molestias, aperiam eum reprehenderit dolores ad deserunt eos amet. Vero molestiae commodi unde dolor dicta maxime alias, velit, nesciunt cum dolorem, ipsam soluta sint suscipit maiores mollitia assumenda ducimus aperiam neque enim! Quas culpa dolorum ipsam? Ipsum voluptatibus numquam natus? Eligendi explicabo eos, perferendis voluptatibus hic sed ipsam rerum maiores officia! Beatae, molestias!</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">How do I link to a file or folder?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis provident officiis, reprehenderit numquam. Praesentium veritatis eos tenetur magni debitis inventore fugit, magnam, reiciendis, saepe obcaecati ex vero quaerat distinctio velit.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
                    </ul> <!-- cd-faq-group -->
        
                    <ul id="account" class="cd-faq-group">
                        <li class="cd-faq-title"><h2>Account</h2></li>
                        <li>
                            <a class="cd-faq-trigger" href="#0">How do I change my password?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis earum autem consectetur labore eius tenetur esse, in temporibus sequi cum voluptatem vitae repellat nostrum odio perspiciatis dolores recusandae necessitatibus, unde, deserunt voluptas possimus veniam magni soluta deleniti! Architecto, quidem, totam. Fugit minus odit unde ea cupiditate ab aperiam sed dolore facere nihil laboriosam dolorum repellat deleniti aliquam fugiat laudantium delectus sint iure odio, necessitatibus rem quisquam! Ipsum praesentium quam nisi sint, impedit sapiente facilis laudantium mollitia quae fugiat similique. Dolor maiores aliquid incidunt commodi doloremque rem! Quaerat, debitis voluptatem vero qui enim, sunt reiciendis tempore inventore maxime quasi fugiat accusamus beatae modi voluptates iste officia esse soluta tempora labore quisquam fuga, cum. Sint nemo iste nulla accusamus quam qui quos, vero, minus id. Eius mollitia consequatur fugit nam consequuntur nesciunt illo id qui									s reprehenderit obcaecati voluptates corrupti, minus! Possimus, perspiciatis!</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">How do I delete my account?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo tempore soluta, minus magnam non blanditiis dolore, in nam voluptas nobis minima deserunt deleniti id animi amet, suscipit consequuntur corporis nihil laborum facere temporibus. Qui inventore, doloribus facilis, provident soluta voluptas excepturi perspiciatis fugiat odit vero! Optio assumenda animi at! Assumenda doloremque nemo est sequi eaque, ipsum id, labore rem nisi, amet similique vel autem dolore totam facilis deserunt. Mollitia non ut libero unde accusamus praesentium sint maiores, illo, nemo aliquid?</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">How do I change my account settings?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis provident officiis, reprehenderit numquam. Praesentium veritatis eos tenetur magni debitis inventore fugit, magnam, reiciendis, saepe obcaecati ex vero quaerat distinctio velit.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">I forgot my password. How do I reset it?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum at aspernatur iure facere ab a corporis mollitia molestiae quod omnis minima, est labore quidem nobis accusantium ad totam sunt doloremque laudantium impedit similique iste quasi cum! Libero fugit at praesentium vero. Maiores non consequuntur rerum, nemo a qui repellat quibusdam architecto voluptatem? Sequi, possimus, cupiditate autem soluta ipsa rerum officiis cum libero delectus explicabo facilis, odit ullam aperiam reprehenderit! Vero ad non harum veritatis tempore beatae possimus, ex odio quo.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
                    </ul> <!-- cd-faq-group -->
        
                    <ul id="payments" class="cd-faq-group">
                        <li class="cd-faq-title"><h2>Payments</h2></li>
                        <li>
                            <a class="cd-faq-trigger" href="#0">Can I have an invoice for my subscription?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit quidem delectus rerum eligendi mollitia, repudiandae quae beatae. Et repellat quam atque corrupti iusto architecto impedit explicabo repudiandae qui similique aut iure ipsum quis inventore nulla error aliquid alias quia dolorem dolore, odio excepturi veniam odit veritatis. Quo iure magnam, et cum. Laudantium, eaque non? Tempore nihil corporis cumque dolor ipsum accusamus sapiente aliquid quis ea assumenda deserunt praesentium voluptatibus, accusantium a mollitia necessitatibus nostrum voluptatem numquam modi ab, sint rem.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">Why did my credit card or PayPal payment fail?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur accusantium dolorem vel, ad, nostrum natus eos, nemo placeat quos nisi architecto rem dolorum amet consectetur molestiae reprehenderit cum harum commodi beatae necessitatibus. Mollitia a nostrum enim earum minima doloribus illum autem, provident vero et, aspernatur quae sunt illo dolorem. Corporis blanditiis, unde, neque, adipisci debitis quas ullam accusantium repudiandae eum nostrum quis! Velit esse harum qui, modi ratione debitis alias laboriosam minus eaque, quod, itaque labore illo totam aut quia fuga nemo. Perferendis ipsa laborum atque assumenda tempore aspernatur a eos harum non id commodi excepturi quaerat ullam, explicabo, incidunt ipsam, accusantium quo magni ut! Ratione, magnam. Delectus nesciunt impedit praesentium sed, aliquam architecto dolores quae, distinctio consectetur obcaecati esse, consequuntur vel sit quis blanditiis possimus dolorum. Eaque architecto doloremque aliquid quae cumque, vi									tae perferendis enim, iure fugiat, soluta aut!</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">Why does my bank statement show multiple charges for one upgrade?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis provident officiis, reprehenderit numquam. Praesentium veritatis eos tenetur magni debitis inventore fugit, magnam, reiciendis, saepe obcaecati ex vero quaerat distinctio velit.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
                    </ul> <!-- cd-faq-group -->
        
                    <ul id="privacy" class="cd-faq-group">
                        <li class="cd-faq-title"><h2>Privacy</h2></li>
                        <li>
                            <a class="cd-faq-trigger" href="#0">Can I specify my own private key?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit quidem delectus rerum eligendi mollitia, repudiandae quae beatae. Et repellat quam atque corrupti iusto architecto impedit explicabo repudiandae qui similique aut iure ipsum quis inventore nulla error aliquid alias quia dolorem dolore, odio excepturi veniam odit veritatis. Quo iure magnam, et cum. Laudantium, eaque non? Tempore nihil corporis cumque dolor ipsum accusamus sapiente aliquid quis ea assumenda deserunt praesentium voluptatibus, accusantium a mollitia necessitatibus nostrum voluptatem numquam modi ab, sint rem.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">My files are missing! How do I get them back?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis provident officiis, reprehenderit numquam. Praesentium veritatis eos tenetur magni debitis inventore fugit, magnam, reiciendis, saepe obcaecati ex vero quaerat distinctio velit.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">How can I access my account data?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus magni vero deserunt enim et quia in aliquam, rem tempore voluptas illo nisi veritatis quas quod placeat ipsa! Error qui harum accusamus incidunt at libero ipsum, suscipit dolorum esse explicabo in eius voluptates quidem voluptatem inventore amet eaque deserunt veniam dignissimos excepturi? Dolore, quo amet nostrum autem nemo. Sit nam assumenda, corporis ea sunt distinctio nostrum doloribus alias, beatae nesciunt dolore saepe consequuntur minima eveniet porro dolor officiis maiores ab obcaecati officia enim aliquam. Itaque fuga molestiae hic accusantium atque corporis quia id sequi enim vero? Hic aperiam sint facilis aliquam quia, accusamus tenetur earum totam enim est, error. Iusto, reiciendis necessitatibus molestias. Voluptatibus eos explicabo repellat nesciunt nam vero minima.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">How can I control if other search engines can link to my profile?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis provident officiis, reprehenderit numquam. Praesentium veritatis eos tenetur magni debitis inventore fugit, magnam, reiciendis, saepe obcaecati ex vero quaerat distinctio velit.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
                    </ul> <!-- cd-faq-group -->
        
                    <ul id="delivery" class="cd-faq-group">
                        <li class="cd-faq-title"><h2>Delivery</h2></li>
                        <li>
                            <a class="cd-faq-trigger" href="#0">What should I do if my order hasn't been delivered yet?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit quidem delectus rerum eligendi mollitia, repudiandae quae beatae. Et repellat quam atque corrupti iusto architecto impedit explicabo repudiandae qui similique aut iure ipsum quis inventore nulla error aliquid alias quia dolorem dolore, odio excepturi veniam odit veritatis. Quo iure magnam, et cum. Laudantium, eaque non? Tempore nihil corporis cumque dolor ipsum accusamus sapiente aliquid quis ea assumenda deserunt praesentium voluptatibus, accusantium a mollitia necessitatibus nostrum voluptatem numquam modi ab, sint rem.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">How can I find your international delivery information?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis provident officiis, reprehenderit numquam. Praesentium veritatis eos tenetur magni debitis inventore fugit, magnam, reiciendis, saepe obcaecati ex vero quaerat distinctio velit.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">Who takes care of shipping?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis provident officiis, reprehenderit numquam. Praesentium veritatis eos tenetur magni debitis inventore fugit, magnam, reiciendis, saepe obcaecati ex vero quaerat distinctio velit.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">How do returns or refunds work?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit quidem delectus rerum eligendi mollitia, repudiandae quae beatae. Et repellat quam atque corrupti iusto architecto impedit explicabo repudiandae qui similique aut iure ipsum quis inventore nulla error aliquid alias quia dolorem dolore, odio excepturi veniam odit veritatis. Quo iure magnam, et cum. Laudantium, eaque non? Tempore nihil corporis cumque dolor ipsum accusamus sapiente aliquid quis ea assumenda deserunt praesentium voluptatibus, accusantium a mollitia necessitatibus nostrum voluptatem numquam modi ab, sint rem.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">How do I use shipping profiles?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis provident officiis, reprehenderit numquam. Praesentium veritatis eos tenetur magni debitis inventore fugit, magnam, reiciendis, saepe obcaecati ex vero quaerat distinctio velit.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">How does your UK Next Day Delivery service work?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis provident officiis, reprehenderit numquam. Praesentium veritatis eos tenetur magni debitis inventore fugit, magnam, reiciendis, saepe obcaecati ex vero quaerat distinctio velit.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">How does your Next Day Delivery service work?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis provident officiis, reprehenderit numquam. Praesentium veritatis eos tenetur magni debitis inventore fugit, magnam, reiciendis, saepe obcaecati ex vero quaerat distinctio velit.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">When will my order arrive?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis provident officiis, reprehenderit numquam. Praesentium veritatis eos tenetur magni debitis inventore fugit, magnam, reiciendis, saepe obcaecati ex vero quaerat distinctio velit.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
        
                        <li>
                            <a class="cd-faq-trigger" href="#0">When will my order ship?</a>
                            <div class="cd-faq-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis provident officiis, reprehenderit numquam. Praesentium veritatis eos tenetur magni debitis inventore fugit, magnam, reiciendis, saepe obcaecati ex vero quaerat distinctio velit.</p>
                            </div> <!-- cd-faq-content -->
                        </li>
                    </ul> <!-- cd-faq-group -->
                </div> <!-- cd-faq-items -->
                <a href="#0" class="cd-close-panel">Close</a>
            </section> <!-- cd-faq -->
            <script src="js/jquery-2.1.1.js"></script>
            <script src="js/jquery.mobile.custom.min.js"></script>
            <script src="js/main.js"></script> <!-- Resource jQuery -->
        </div>
        
    <!-- end of FAQ section-->
	
    <!-- start of adventure and review -->
    <div class="adventure-left">
						
    </div>
    
    <div class="adventure-right">
		<!--container-->

            <div class="container">


            <!--Wrap-->
            <div id="wrapReview">
            <div id="main">
            <div class="row">
            <div class="col-md-5">
            <h3 class="headingReview">Comments and Responses</h3>
            </div>
            <div class="col-md-7">
            <div id="upper_blank"></div>
            </div>
            </div>
            </div>

            <p id="pReview">Your email address will not be published. Required fields are marked *</p>

            <!--Form Start-->

            <div id='form'>
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post" id="commentform" action="index.php">
                        <div id="comment-name" class="form-row">
                            <input type = "text" placeholder = "Name (required)" name = "name"  id = "nameReview" >
                        </div>
                        <div id="comment-email" class="form-row">
                            <input type = "text" placeholder = "Mail (will not be published) (required)" name = "email"  id = "emailReview">
                        </div>
                        <div id="comment-message" class="form-row">
                            <textarea name = "comment" placeholder = "Message" id = "commentReview" ></textarea>
                        </div>
                        <input type="submit" name="dsubmit" id="commentSubmit" value="Submit Comment">
                        <input style="width: 30px" type="checkbox" value="1" name="subscribe" id="subscribe" checked="checked">
                        <p1><b>Notify me when new comments are added.</b></p1>
                        </form>
                    </div>
                </div>
                </div>
            </div>

            <!--Reply Section-->
            <div id="second">
                <div class="row">
                    <div class="col-md-2">
                        <h3 class="second_heading" id="flip"><b>Previous comment ...</b></h3>
                    </div>	
                    <div class="col-md-10">
                        <div class="blankReview"></div>
                    </div>
                </div>
            </div>
            <div id = 'panel' >
            <?php 
                    $con=mysqli_connect("localhost","Rahul","Koqa313*@3","testing");
                        // Check connection
                        if (mysqli_connect_errno())
                          {
                          echo "Failed to connect to MySQL: " . mysqli_connect_error();
                          }

                        $result = mysqli_query($con,"SELECT * FROM commentsection");
                        
                        echo "<table >";
                        while($row = mysqli_fetch_array($result))
                              {
                        //          echo "<tr> <td> " . $row['name'] . " </td><td> comment" . $row['comment'] . " </td> </tr>"; //these are the fields that you have stored in your database table employee
                                echo "<div id='middle'>";
                                echo "";
                                echo "<p style='color:red'>" . $row['name']." </p>";
                                echo " " . $row['comment']." <br>";
                                echo "<form>";
//                                echo "<input type = 'button' value = 'reply' name = 'dreply' id = 'inner_reply'>";
                                echo "</form>";
                                echo "</div>";
                              }
                         echo "</table>";
                        mysqli_close($con);
                 ?>
            
            	</div>

            </div>
    </div>
    <!-- end of adventure and review -->    
    
</body>
</html>

<?php
   if(isset($_POST['comment'])&&isset($_POST['name'])&&isset($_POST['email']))
    {
        $comment = trim($_POST['comment']);
        
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        
        if(!empty($comment)&&!empty($name)&&!empty($email))
        {
            //$qry = "INSERT INTO commentsection (comment ,name, email ) VALUES ( '$comment' , '$name', '$title')";
            $query = "INSERT INTO commentsection VALUES ('".mysqli_real_escape_string($mysql_connect,$name )."','".mysqli_real_escape_string($mysql_connect,$email )."','".mysqli_real_escape_string($mysql_connect, $comment)."')";
            if($query_run = mysqli_query($mysql_connect, $query))
            {
                header('Location: index.php');
            }
            else
            {
                echo 'Sorry, we couldn\'t register you at this time. Try again later.';
            }
        }
    }        
?>