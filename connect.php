<?php
	$dbHost='localhost';
	$dbUser='root';
	$dbPass='';
	$dbName='db_sf';
	$con = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);
	mysqli_set_charset($con, "utf8");
	
?>