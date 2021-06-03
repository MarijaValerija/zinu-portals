<?php
	$link = mysqli_connect('0.0.0.0:3306', 'sps', 'JVZXZyaSaFMgsv8N'); 

	if(!$link) {
		die('not connected' . mysqli_error());
	}

	$db_selected = mysqli_select_db($link, 'sps');

	if(!$db_selected) {
		die('not connected' . mysqli_error());
	}
?>