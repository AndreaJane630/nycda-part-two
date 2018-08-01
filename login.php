<?php

	session_start();
	
	// user should not be here if already logged in:
	
	if ($_SESSION["loggedIn"]) {
		echo "If you are logged in you should not be here";
		exit();
	}
	/* I have changed this code - a user might have logged in, but then
	 they are redirected to the "welcome" page - if they click
	 the back button on the browser, they'll be taken back to the login 
	 page which is not good - so my solution is to send them back to the blog page
	 rather than displaying an error message*/
	
	/*if ($_SESSION["loggedIn"]) {
		header('Location: index.php'); 
		exit;
	}*/
				
	function sanitizeInput($loginInput) {
		$loginInput = trim($loginInput);
		$loginInput = stripslashes($loginInput);
		$loginInput = htmlentities($loginInput);
		return $loginInput;
	}
	
	$email = '';
	$password = '';
	$out = "";
	$errcount = 0;
	
	if (isset($_POST['submit'])) { //Did user click "LOG IN" button?
		
		$email = sanitizeInput($_POST['student-email']);
		$password = sanitizeInput($_POST['student-password']);
		
				
		if ( empty($email) ) {	
			$out = "Email address is required. \r\n";
			$errcount++;
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //if email is not valid, set error
			$out = "Invalid Email Address. \r\n";
			$errcount++;
		}
	    			
		if ( empty($password) ) {																											
			$out .= "A password is required.";		  
			$errcount++;
		}
		elseif (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)){ // Nice strong password 
			$out .= "Invalid Password";
			$errcount++;
		} 	
		
		if (!$errcount) {
			require_once('inc/dbConnect.php');
			$sql = 'SELECT s_id, fname, email, pwd FROM students WHERE email = ?';     
			$stmt = $conn->stmt_init();
			$stmt->prepare($sql);
			$stmt->bind_param('s',$email);
			$stmt->bind_result($id, $fn, $em, $pw);
			$stmt->execute();
			if ($stmt->error) {
				echo "There was an error: " . $stmt->error;
				exit;
			}
			else {
				$stmt->store_result();
				while ( $stmt->fetch() ) {
				
					if (password_verify($password, $pw)) { 
						$_SESSION["loggedIn"] = true;
						$_SESSION["student"] = $id;
						$_SESSION["name"] = $fn;
						header('Location: welcome.php'); 
						exit;
					}
				} 
				$out .= "Invalid Login Attempt"; // A variety of situations could cause you to be here
												// but this is not the place to clue user in as to what constitutes a valid password
												// that is for the apply/register page which I am working on		
			} 
		} 
	} 
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

	input[type=submit] {
		transition: .25s ease-out;
		margin-bottom: 58px;
		
	}
	input[type=submit]:hover {
		background: #1a1919;
		color: #fefefe;
	}
	#apply {
		margin-top: 75px;
		position: relative;
	}
	#apply:before {
		position: absolute;
		top: -40px;
		left: 48%;
		content: "";
		width: 50px;
		height: 2px;
		background: #ffcb04;
	}
		
	#apply p:first-of-type {
		width: 100%;
		text-align: center;
		letter-spacing: 1px;
	}
	
	#apply span {
		color: #D6AA00;
	}
	#apply span:hover {
		cursor: pointer;
		font-weight: bold;
	}
	#now {
		position: relative;
		width: 50%;
		background: #ffcb04;
		color: #1a1919;ssss
		text-align: center;
		font-weight: bold;
		height: 50px;
		margin: 30px auto 100px;
		height: 50px;
		transition: .25s ease-out;
			
	}
	#now:hover {
		background: #1a1919;
	}
		
	#now a {
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%);
		display: inline-block;
		text-decoration: none;
		color: #1a1919;
		font-size: .9rem;
		letter-spacing: 1px;
		
		text-transform: uppercase;
		font-weight: bold;
	}
	#now:hover a {		
		color: #fefefe;
	}
	@media (max-width: 1000px) {
		#now {
			width: 65%;
		}
	}
	
</style>
</head>
<body>

	<?php require_once('inc/chat-bubble.php'); ?>
	<?php require_once('inc/topbar.php'); ?>
		
	<div id="container">	
		
		<h2>Student Sign In</h2>
		<?php if ($out != "") {$out = nl2br($out); echo "<span class='popup'>$out</span>";} ?>
		
		<form method="post" action=""  name="loginForm" id="loginForm">	
			
			<input type="text" name="student-email" id="student-email" placeholder="Email Address"> 
			<input id="student-password" name="student-password" type="password" placeholder="Password">
			<input type="submit" name="submit" value="LOG IN">

		</form>	
		
		<div id="apply">	
			<h2>Not A Student Yet?</h2>	
			<p>Check out our <span>courses</span> or apply today!</p>
			<p id="now"><a href="apply.php">Apply Now</a></p>
		</div>
		
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






