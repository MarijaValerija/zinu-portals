<?php
	session_start();
	$_SESSION = array();//jauns masīvs, kas nosedz ar sevi iepriekšējo sessiju
	session_destroy();
	header("location: index.php");
?>