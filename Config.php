<?php
	$db = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);
	echo $db

	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}
?>