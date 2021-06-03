<?php
	session_start();
	
	if(isset($_SESSION["role"]) && $_SESSION["role"] == 1){ //pārbauda vai tāda vērtība IR un pārbauda lomu
		header("location: index.php");
		exit;
	}
	
	$album_id = $_GET["id"];
	
	require_once "db_config.php";
	
	mysqli_query($link, "delete from albums where id = $album_id") or die("Invalid query: " . mysqli_error($link)); //Funkcija tiek izmantota, lai vienkāršotu vaicājuma izpildi pret datu bāzi, kuru attēlo saites parametrs.
	mysqli_query($link, "delete from images where album_id = $album_id") or die("Invalid query: " . mysqli_error($link));
	
	header("location: albums.php");
?>