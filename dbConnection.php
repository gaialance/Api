<?php
	//setup connection to db
  	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // error reporting
  	$servername = "localhost";
	$username = "root";
	$password = "";

	$dbConnection = new mysqli($servername, $username, $password, 'demo1');
	$dbConnection->set_charset('utf8mb4'); // charset
?>