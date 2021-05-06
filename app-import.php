<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
        { header("location: login.php");
        exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SpellAssist - Import Spell Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
    <style>
        .bg-img {
         background-image: url("images/background-top.png");
         height: 100%;
         background-position: center;
         background-repeat: no-repeat;
         background-size: cover;
       }

       ol {
         text-align: left;
       }

        .wrapper{padding: 20px!important}
    </style>
    <link href="cover.css" rel="stylesheet">
</head>
<body class="d-flex h-100 text-center text-white bg-img">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column wrapper">
        <h2>Upload Spell Data</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <p>Select JSON file to upload:</p>
			<div class="form-group margin-bottom">
				<input class="btn btn-lg btn-secondary fw-bold border-white" type="file" accept=".json" name="fileToUpload" id="fileToUpload">
			</div>
			<div class="form-group margin-bottom">
				<input class="btn btn-lg btn-secondary fw-bold border-white" type="submit" value="Upload" name="submit">
			</div>
			<p>See <a href="info.php">Importing/Exporting</a> for additional help, or <a href="app-home.php">go back</a>.</p>
        </form>
    </div>
</body>

