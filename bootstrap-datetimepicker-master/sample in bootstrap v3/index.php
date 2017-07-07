<?php 
require 'core.inc.php';
require 'connect.inc.php';
if(loggedin())
{   
	$firstname = getuserfield('username');
	$surname = getuserfield('surname');
	echo 'You\'re logged in, '.$firstname.' '.$surname.'.<br/>';
	echo '<a href="logout.php"><button>Logout</button></a>';
	header("Location: index.php");
    
}
else
{
	include 'loginform.inc.php';
}	
?>
