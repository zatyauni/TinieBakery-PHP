<?php
	$conn = new mysqli("localhost","root","","tinie");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>
