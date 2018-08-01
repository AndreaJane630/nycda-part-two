<?php

	session_start();
	
	// user should not be here if he/she not logged in:
	
	if (!$_SESSION["loggedIn"]) {
		echo "If you are NOT logged in you should not be here";
		exit();
	}			
		
	/*if (!$_SESSION["loggedIn"]) {
		header('Location: index.php'); 
		exit();
	}*/
	
	$msg = " you are now logged in  ";

	require_once('inc/dbConnect.php'); // the whole purpose of this section is retrieve the name of the course student enrolled in
	  
	$sql = 'SELECT cname FROM courses INNER JOIN registry ON courses.ccode = registry.ccode AND registry.s_id = ?';	
	$stmt = $conn->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param(i,$_SESSION['student']); // the student id which will connect you to the course id in the registry
	
	$stmt->bind_result($coursename);
	$stmt->execute();
	
	if ($stmt->error) {
		echo "There was an error: " . $stmt->error;
		exit;
	}
	
	$stmt->store_result();
	
	if (!$stmt->num_rows) {
		$course_msg = "You are not enrolled in any courses";
	} 
	else {
		$course_msg = "Your courses: ";
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
	
.courses {
	width: 150px;
	height: 40px;
	padding: 11px 20px;
	border: 1px solid #ffcb04;
	colof: #ffcb04;
	align-self: center;
	text-transform: uppercase;
	font-size: .7rem;
	font-weight: 700;
	letter-spacing: 1px;
	transition: .25s ease-out;
}
#topbar .courses:hover {
	background: #ffcb04;;
	color: #1a1919;
}
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
	top: 540px;
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
	font-size: 2.1rem;
	letter-spacing: 1px;
	line-height: 1.4;
	text-align: center;
	margin: 0 auto;
}
/*h1:before {
	position: absolute;
	top: -20px;
	left: 48%;
	content: "";
	width: 50px;
	height: 2px;
	background: #ffcb04;
}*/
h3 {
	margin: 0 auto;
	font-family: Roboto, sans-serif;
	font-size: 1.55rem;
	text-align: center;
	line-height: 1.2;
}
p {
	margin-top: 20px;
	font-family: Roboto, sans-serif;
	font-size: 1.2rem;
	text-align: center;
	font-weight: bold;
	color: #785e54;
}
#studentInfo p:first-of-type {
	font-size: 1.25rem;
	color: #1a1919;
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
		<h1><?php echo $_SESSION['name'] . ",";?> </h1>	
		<h3><?php echo $msg;?><span>!</span></h3>
		<p><?php echo $course_msg;?></p>
			
		<p><?php while ( $stmt->fetch() ) {
				echo $coursename . "<br><br>";
			} ?>
		</p>
		
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







