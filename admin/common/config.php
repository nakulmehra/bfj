<?php
	error_reporting(0);
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = "bfj";
	try {
		$db = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$link = mysql_connect($hostname,$username,$password);
	mysql_select_db($dbname);
	
	
?>