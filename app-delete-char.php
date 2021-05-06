<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
        { header("location: login.php");
        exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$param_charid = 0;

// Processing form data when form is submitted
            // Prepare an insert statement
        $sql = "DELETE FROM HasSpell WHERE characterid = ?;";
	$sql2 = "DELETE FROM Characters WHERE characterid = ?;";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_charid);

            // Set parameters
            $param_charid = $_GET["characterid"];

            // Attempt to execute the prepared statement
            mysqli_stmt_execute($stmt);
			
	
			
            // Close statement
            mysqli_stmt_close($stmt);
        }
	
	if($stmt = mysqli_prepare($link, $sql2)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_charid);

            // Set parameters
            $param_charid = $_GET["characterid"];

            // Attempt to execute the prepared statement
            mysqli_stmt_execute($stmt);

            // Close statement
            mysqli_stmt_close($stmt);
        }

	header("location: app-characters.php");

    // Close connection
    mysqli_close($link);
?>
