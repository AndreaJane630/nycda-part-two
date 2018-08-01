<?php

	session_start();
	
	require_once('inc/dbConnect.php');
	
	function checkstudent($email) {
		
		global $conn;
		$sql = 'SELECT * FROM students WHERE email = ?';     
		$stmt = $conn->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param('s',$email);
		$stmt->execute();
		if ($stmt->error) {
			echo "There was an error: " . $stmt->error;
			exit();
		}
		else {
			$stmt->store_result();
			if ( $stmt->num_rows ) {				
				return false;
			}
			else {
				return true;
			}
		}
	}  // end of function

	function sanitizeInput($loginInput) {
		$loginInput = trim($loginInput);
		$loginInput = stripslashes($loginInput);
		$loginInput = htmlentities($loginInput);
		return $loginInput;
	}
	
	$fname = "";
	$lname = "";
	$email = '';
	$password = '';
	$confirmPassword = '';
	$course = "";
	$out = "";
	$errcount = 0;
	
	// Do I need to sanitize the course name? It's hardcoded, but could it be changed with dev tools by some hacker?
	
	if (isset($_POST['submit'])) {
		
		$fname = sanitizeInput($_POST['firstname']);
		$lname = sanitizeInput($_POST['lastname']);
		$email = sanitizeInput($_POST['email']);
		$password = sanitizeInput($_POST['password']);
		$confirmPassword = sanitizeInput($_POST['confirmPassword']);
		$course = sanitizeInput($_POST['course']);
		
		if (empty($fname) || empty($lname) || empty($email) || empty($password) 
			|| empty($confirmPassword) || empty($course)) {
			$errcount++;
			$out = "Not all fields were entered. \r\n";
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //if email is not valid, set error
			$out = "Invalid Email/Username. \r\n";
			$errcount++;
		}
		elseif (!checkstudent($email)) {
			$out .= "That username/email is taken";
			$errcount++;
		}
		elseif (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)){
			$out = "Invalid Password \r\n";
			$out .= "Required: 8-20 chars, 1 each: \r\n";
			$out .= "a-z, A-Z, 0-9, special char \r\n";
			$errcount++;
		}
		elseif ($password != $confirmPassword) {
			$out = "Passwords Don't Match";
			$errcount++;
		}
		  			
		// we're ready to add a new student!
		 
		if (!$errcount) {
			
			global $conn;
		
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$sql ='INSERT INTO students (fname, lname, email, pwd) VALUES (?,?,?,?)';
			$stmt = $conn->stmt_init();
			$stmt->prepare($sql);
			$stmt->bind_param('ssss',$fname, $lname, $email, $hash);
			$stmt->execute();
			if ($stmt->error) {
				echo "Error in adding student: " . $stmt->error;
				exit();
			}
			
			$last_id = $conn->insert_id;  // get the unique id of the new student 
											
			$sql ='INSERT INTO registry (s_id, ccode) VALUES (?,?)';
			$stmt = $conn->stmt_init();
			$stmt->prepare($sql);
			$stmt->bind_param('is',$last_id, $course);
			$stmt->execute();
			if ($stmt->error) {
				echo "Error in adding to registry: " . $stmt->error;
				exit();
			}
			else {
				$out = $fname . "\r\n You are now registered and may login"; // or, Thank you for registering with NYCDA - you may now login	
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
	
	h2 {
		margin: 0;
		font-size: 2rem;
	}
	
	input[type=submit] {
		transition: .25s ease-out;
		margin-bottom: 58px;
		
	}
	#firstname {
		margin-top: 15px;
	}
	fieldset {
		height: 100px;
		padding: 10px;
		box-sizing: border-box;
		text-align: center;
	}
	legend {
		font-size: 1rem
	}
	select {
		
		width: 75%;
		height: 50px;
			
	}
	#course {
		padding: 10px;
		box-sizing: border-box;
		font-size: 1.1rem;
		font-family: Roboto,sans-serif;
		
	}
	input[type=submit]:hover {
		background: #1a1919;
		color: #fefefe;
	}
	input:first-of-type {
		margin-top: 25px;
	}

	span.popup {
		animation-duration: 4.5s;
		top: 0;
	}
	input, fieldset {
		width: 75%;
		margin-left: auto;
		margin-right: auto;
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
		
		<h2>Student Sign Up</h2>
		<?php if ($out != "") {$out = nl2br($out); echo "<span class='popup'>$out</span>";} ?>
		
		<form method="post" action=""  name="loginForm" id="loginForm">	
			<input type="text" name="firstname" id="firstname" placeholder="First Name" maxlength="32">
			<input type="text" name="lastname" id="lastname" placeholder="Last Name" maxlength="32">			
			<input type="text" name="email" id="email" placeholder="Email Address"> 
			<input id="password" name="password" type="password" placeholder="Password" maxlength="20">
			<input id="confirmPassword" name="confirmPassword" type="password" placeholder="Confirm Password">
			<fieldset>
				<legend>Select Your Course</legend>
				<select id="course" name="course">
					<option value='SFWEINT'>Software Engineering Intensive</option>
					<option value='JSEVEINT'>Evening JavaScript Intensive</option>
					<option value='WBDV100'>Web Development 100</option>
					<option value='FRNTND101'>Front End 101</option>
					<option value='UXDSNINT'>UX Design Intensive</option>
					<option value='UXDSEVEINT'>Evening UX Design Intensive</option>
					<option value='UIUXDS101'>UIUX Design 101</option>
				</select>
			</fieldset>				
			
			<input type="submit" name="submit" value="APPLY NOW">

		</form>	
				
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