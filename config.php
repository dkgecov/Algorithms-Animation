<?php
	$user = "root";
	$host = "localhost";
	$pass = "root";
	$db   = "users";
	
	try {
		$conn = new PDO("mysql:host=$host;dbname=$db;", $user, $pass);
	} catch(PDOException $e) {
		echo "Error: ".$e->getMessage();
		exit;
	}
	$conn->query("SET NAMES utf8");
?>
