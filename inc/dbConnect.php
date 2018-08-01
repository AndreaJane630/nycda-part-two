<?php

$conn = new mysqli('localhost', 'root', 'root', 'nycda');
if ($conn->connect-errno) {
	echo "Connection Failed: " . $conn->connect_error;
	exit; //die("Fatal Error");
}

?>