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
$param_charid  = "";
$param_spellname  = "";
$prep  = 0;
$allprep = 0;

// Processing form data when form is submitted
if(isset($_POST["submit"])){
        // Prepare an insert statement
        $sql = "INSERT INTO HasSpell (characterid, spellname, prepared, alwaysprepared) VALUES (?, ?, ?, ?);";

        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isii", $param_charid, $param_spellname, $prep, $allprep);

            // Set parameters
            $param_charid = $_GET["id"];
            $param_spellname = $_POST["spellname"];
            $prep = $_POST["prepared"];
            $allprep = $_POST["alwaysprepared"];

            // Attempt to execute the prepared statement
            mysqli_stmt_execute($stmt);
            header("location: app-characters.php");

            // Close statement
            mysqli_stmt_close($stmt);
        }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SpellAssist - Add Spell to Character</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
    <style>
        .bg-img {
			background-image: url("images/background-top.png");
			height: 100%;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}

        .wrapper{padding: 20px!important}
    </style>
    <link href="cover.css" rel="stylesheet">
</head>
<body class="d-flex h-100 text-center text-white bg-img">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column wrapper">
        <h2>Add Spell to Character</h2>
        <form action="" method="post">
            <div class="form-group margin-bottom">
                <label>Spell Name</label>
                <select name="spellname" class="form-control">
					<option selected>Choose Spell to Add</option>
					<?php
						$query = "SELECT spellname FROM Spells";
						$stmt = $link -> prepare($query);
						$stmt -> execute();
						$result = $stmt -> get_result();
						while($row = $result -> fetch_assoc()) {
							echo "<option value='" . $row['spellname'] . "'>" . $row['spellname'] . "</option>";
    					}
						$result->close();
					?>
				</select>
            </div>
            <div class="form-group margin-bottom">
                <label>Prepared: </label>
                <input type="radio" name="prepared" value=1>Yes
                <input type="radio" name="prepared" value=0 checked>No
            </div>
            <div class="form-group margin-bottom">
                <label>Always Prepared</label>
                <input type="radio" name="alwaysprepared" value=1>Yes
                <input type="radio" name="alwaysprepared" value=0 checked>No
            </div>
            <div class="form-group margin-bottom">
                <input type="submit" name="submit" class="btn btn-lg btn-secondary fw-bold border-white" value="Submit">
                <input type="reset" class="btn btn-lg btn-secondary fw-bold border-white" value="Reset">
            </div>
            <p><a href="app-characters.php">Go back</a>.</p>
        </form>
    </div>
</body>
</html>
