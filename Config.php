<?php
// Database connection is stored as DigitalOcean environment variables
/* Attempt to connect to MySQL database */
$link = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>