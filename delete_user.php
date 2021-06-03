<?php
	session_start();
	
	if(isset($_SESSION["role"]) && $_SESSION["role"] != 3){
		header("location: index.php");
		exit;
	}
	
	$id = $_GET["id"];
	
	require_once "db_config.php";
	
	mysqli_query($link, "delete from users where id = $id") or die("Invalid query: " . mysqli_error($link));
	
	header("location: users.php");
?>