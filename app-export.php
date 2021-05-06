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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SpellAssist - Export Character Data</title>
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
        <h2>Export Character Data</h2>
        <form action="download.php" method="post" enctype="multipart/form-data">
            <div class="form-group margin-bottom">
                <label>Character to Export</label>
                <select name="characterid" class="form-control">
					<option selected>Choose Character to Export</option>
					<?php
						$query = "SELECT characterid, charactername FROM Characters WHERE userid = ?";
						$stmt = $link -> prepare($query);
						$stmt -> bind_param("i", $id);
						$id = $_SESSION['id'];
						$stmt -> execute();
						$result = $stmt -> get_result();
						while($row = $result -> fetch_assoc()) {
							echo "<option value='" . $row['characterid'] . "'>" . $row['charactername'] . "</option>";
    					}
						$result->close();
					?>
				</select>
            </div>
            <div class="form-group margin-bottom">
                <input type="submit" name="submit" class="btn btn-lg btn-secondary fw-bold border-white" value="Submit">
                <input type="reset" class="btn btn-lg btn-secondary fw-bold border-white" value="Reset">
            </div>
            <p><a href="app-home.php">Go back</a>.</p>
        </form>
    </div>
</body>
</html>
