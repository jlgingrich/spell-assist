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
$spellname  = "";
$spellname_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["spellname"]))){
        $spellname_err = "Please enter a name.";
    } else{
        // Prepare an insert statement
        $sql = "INSERT INTO HasSpell (characterid, spellname, prepared, alwaysprepared) VALUES (?, ?, 0, 0);";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "is", $param_charid, $param_spellname);

            // Set parameters
			$param_charid = trim($_GET["id"]);
            $param_spellname = trim($_POST["spellname"]);
			
			if(isset($_POST["prepared"])){
				$prepared = 1;
			}
			if(isset($_POST["alwaysprepared"])){
				$alwaysprepared = 1;
			}
			if(empty($preparedbox) && empty($alwaysbox)){
				$prepared = 0;
				$alwaysprepared = 0;
			}
			
            // Attempt to execute the prepared statement
            mysqli_stmt_execute($stmt);
			
			header("location: app-characters.php");
			
            // Close statement
            mysqli_stmt_close($stmt);
        }
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

       ol {
         text-align: left;
       }

        .wrapper{padding: 20px!important}
    </style>
    <link href="cover.css" rel="stylesheet">
</head>
<body class="d-flex h-100 text-center text-white bg-img">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column wrapper">
        <h2>Add Spell to Character</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group margin-bottom">
                <label>Spell Name</label>
                <input type="text" name="spellname" class="form-control <?php echo (!empty($spellname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $spellname; ?>">
                <span class="invalid-feedback"><?php echo $spellname_err; ?></span>
            </div>
			<input type="checkbox" name="prepared" value="prepared">
			<label>Prepared</label>
			<input type="checkbox" name="alwaysprepared" value="alwaysprepared">
			<label>Always Prepared</label>
			<div class="form-group margin-bottom">
                <input type="submit" class="btn btn-lg btn-secondary fw-bold border-white" value="Submit">
                <input type="reset" class="btn btn-lg btn-secondary fw-bold border-white" value="Reset">
            </div>
            <p><a href="app-characters.php">Go back</a>.</p>
        </form>
    </div>
</body>
</html>