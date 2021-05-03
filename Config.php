<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'ProgUser');
	define('DB_PASSWORD', 'itsaSECUREpassword');
	define('DB_DATABASE', 'spell_assist');
$link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>