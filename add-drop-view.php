<?php

	session_start();
	
	$course = "";
	$out = "";
			
	// user should not be here if he/she is NOT logged in:
	
	if (!$_SESSION["loggedIn"]) {
		echo "If you are NOT logged in you should not be here";
		exit();
	}
	
	require_once('inc/dbConnect.php');
	
	function sanitizeInput($loginInput) {
		$loginInput = trim($loginInput);
		$loginInput = stripslashes($loginInput);
		$loginInput = htmlentities($loginInput);
		return $loginInput;
	}
	
	function checkcourse($id,$course) {
		
		global $conn;
		global $course;
		$sql = 'SELECT * FROM registry WHERE s_id = ? AND ccode = ?';     
		$stmt = $conn->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param('is',$id,$course);
		$stmt->execute();
		if ($stmt->error) {
			echo "There was an error: " . $stmt->error;
			exit();
		}
		else {
			$stmt->store_result();
			if ( $stmt->num_rows ) {	// student already has course			
				return true;
			}
			else {
				return false;  // o.k. to add this course
			}
		}
	}	
		
	if (isset($_POST['add']) || isset($_POST['drop'])){
		
		$course = sanitizeInput($_POST['course']); // is this necessary? it's not user input
		
		if ($course == "Choose" || empty($course)){
			$out = "Please select a course \r\n";
		}
		elseif (isset($_POST['add'])) { // go ahead and add the course
		
			if (checkcourse($_SESSION['student'],$course)) {
				$out = "You are in $course already. \r\n";
				$out .= "Try another?";
			}	
			else {
				
				global $conn;
				global $course;  // not sure whether or not I need to make this global
				$sql ='INSERT INTO registry (s_id, ccode) VALUES (?,?)';
				$stmt = $conn->stmt_init();
				$stmt->prepare($sql);
				$stmt->bind_param('is',$_SESSION['student'], $course);
				$stmt->execute();
				if ($stmt->error) {
					echo "Error in adding to registry: " . $stmt->error;
					exit();
				}
				else {  
					$out = $_SESSION['name'] . ",\r\n $course has been added!"; 	
				} 
			}
		}
		elseif (isset($_POST['drop'])) { // go ahead and drop the course
		
			if (!checkcourse($_SESSION['student'],$course)) {
				$out = "You aren't enrolled in $course";
			}	
			else {
				
				global $conn;
				global $course;
				
				$sql ='DELETE FROM registry WHERE s_id = ? AND ccode = ?';
				$stmt = $conn->stmt_init();
				$stmt->prepare($sql);
				$stmt->bind_param('is',$_SESSION['student'], $course);
				$stmt->execute();
				if ($stmt->error) {
					echo "Error in deleting from registry: " . $stmt->error;
					exit();
				}
				else {  
					$out = $_SESSION['name'] . ",\r\n $course has been dropped \r\n";
					$out .= "Add another?"; 	
				} 
			}
		}
	}
	elseif (isset($_POST['view'])) {
		
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
			$out = "You are not enrolled in any courses";
		} 
		else {
			$out = "Your courses: \r\n";
			
			while ( $stmt->fetch() ) {
				$out .= $coursename . "\r\n";
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

#studentInfo {
	margin: 0 auto;;
	max-width: 600px; 
	width: 75%;
	position: relative;
}
#studentInfo:after {
	position: absolute;
	bottom: -25px;
	left: 48%;
	content: "";
	width: 50px;
	height: 2px;
	background: #ffcb04;
}
h1 {    
	
	font-family: Roboto, sans-serif;
	font-size: 2.25rem;
	letter-spacing: 1px;
	line-height: 1.6;
	text-align: center;
	margin: 0;
}
h1:before {
	position: absolute;
	top: -25px;
	left: 48%;
	content: "";
	width: 50px;
	height: 2px;
	background: #ffcb04;
}
h3 {
	margin: 0 auto;
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

fieldset {
	height: 100px;
	padding: 10px;
	box-sizing: border-box;
	text-align: center;
	margin-top: 50px;
	background: lemonchiffon;
}	
legend {
	font-size: 1rem;
	font-weight: bold;
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
input, fieldset {
		width: 75%;
		margin-left: auto;
		margin-right: auto;
}
input[type=submit] {
	font-size: 1.25rem;
	width: 30%;
	display: inline-block;
	margin-right: 20px;
}
#buttons {
	text-align: center;
}
span.popup {
	animation-duration: 4.5s;
	top: 50%;
}
@media (max-width: 1000px) {
	h1 {
    	font-size: 2rem;
	}
	h3 {
		font-size: 1.25rem;
	}
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
	
	<div id="container">	
			
	<div id="studentInfo">	
		<h1><?php echo "Hi " . $_SESSION['name'] . ",";?> </h1>	
		<?php if ($out != "") {$out = nl2br($out); echo "<span class='popup'>$out</span>";} ?>		
	</div>
	
	<form method="post" action=""  name="addCourseForm" >	
			
		<fieldset>
			<legend>Add/Drop a Course</legend>
			<select id="course" name="course">
				<option value='Choose'>Please make a selection</option>
				<option value='SFWEINT'>Software Engineering Intensive</option>
				<option value='JSEVEINT'>Evening JavaScript Intensive</option>
				<option value='WBDV100'>Web Development 100</option>
				<option value='FRNTND101'>Front End 101</option>
				<option value='UXDSNINT'>UX Design Intensive</option>
				<option value='UXDSEVEINT'>Evening UX Design Intensive</option>
				<option value='UIUXDS101'>UIUX Design 101</option>
			</select>
		</fieldset>				
		<div id="buttons">
			<input type="submit" name="add" value="ADD">
			<input type="submit" name="drop" value="DROP">
			<input type="submit" name="view" value="VIEW">
		</div>

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







