<?php
	
	// simple page to let student know that he/she has been logged out
	// but also takes care of destroying the session
	
	session_start();
	
	// user should not be here if he/she is NOT logged in:
	
	if (!$_SESSION["loggedIn"]) {
		echo "If you are NOT logged in you should not be here";
		exit();
	}
	
	$name = $_SESSION["name"]; // save for display purposes
	$_SESSION = array();
	session_destroy();
	$msg = " you are now logged out";
			
?>
 
<html>
<head>
	<title>Student Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico" type="image" sizes="48x48">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

	<?php require_once('inc/chat-bubble.css'); ?>
	<?php require_once('inc/login.css'); ?>

header {
	position: absolute;
	top: 70px;
	left: 0;
	right: 0;
	height: 300px;
	background-image: url(images/nycda-courses-page.jpg);
	background-position: center;
	background-size: cover;
}
#studentInfo {
	margin: 0;
	max-width: 750px;
	width: 65%;
	position: absolute;
	top: 520px;
	left: 50%;
	transform: translate(-50%, -50%);
}
#studentInfo:before {
	position: absolute;
	top: -20px;
	left: 48%;
	content: "";
	width: 50px;
	height: 2px;
	background: #ffcb04;
}
h1 {    
	text-transform: uppercase;
	font-family: Roboto, sans-serif;
	font-size: 2.25rem;
	letter-spacing: 1px;
	line-height: 1.6;
	text-align: center;
	margin-bottom: 0;
}
h3 {
	margin-top: 0;
	font-family: Roboto, sans-serif;
	font-size: 1.55rem;
	text-align: center;
}
p {
	margin-top: 0;
	font-family: Roboto, sans-serif;
	font-size: 1rem;
	font-weight: bold;
	text-align: center;
}
h3 > span {
	font-size: 2rem;
}


@media (max-width: 1000px) {
	h1 {
		
		font-size: 2rem;
	}
	h3 {
		
		font-size: 1.25rem;
	}
	   
@media (max-width: 350px) {
	h1 {
		
		font-size: 1.2rem;
	}
	h3 {
		
		font-size: 1rem;
	}
}
</style>
</head>
<body>
	<?php require_once('inc/chat-bubble.php'); ?>
	<?php require_once('inc/topbar.php'); ?>
	
	<header></header>
		
	<div id="studentInfo">	
		<h1><?php echo $name . ",";?> </h1>	
		<h3><?php echo $msg;?><span>!</span></h3>
	</div>
<script>
		 let elburger = document.getElementById('burger');
		 let eloverlay = document.getElementById('overlay');
		 		 
		 elburger.addEventListener('click', function() {
			this.classList.toggle("change"); 
			eloverlay.classList.toggle("show");
			
		});
</script> 		
</body>
</html>	







