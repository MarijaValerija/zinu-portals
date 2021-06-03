<?php
	session_start();
	
	if(isset($_SESSION["role"]) && $_SESSION["role"] == 1){
		header("location: index.php");
		exit;
	}
	
	$album_id = $_GET["id"];
	$image = $_GET["image"];
	
	require_once "db_config.php";
	
	mysqli_query($link, "update albums set cover = NULL where cover = $image") or die("Invalid query: " . mysqli_error($link));
	mysqli_query($link, "delete from images where id = $image") or die("Invalid query: " . mysqli_error($link));
	
	header("location: album.php?id=" . $album_id);
?>