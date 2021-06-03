<?php
	session_start();
	
	if(isset($_SESSION["role"]) && $_SESSION["role"] == 1){
		header("location: index.php");
		exit;
	}
	
	$album_id = $_GET["id"];
	$photo_id = $_GET["image"];
	
	require_once "db_config.php";
	
	mysqli_query($link, "update albums set cover = $photo_id where id = $album_id") or die("Invalid query: " . mysqli_error($link));
	
	header("location: albums.php");
?>