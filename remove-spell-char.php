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
$charactername  = "";
$charactername_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["charactername"]))){
        $charactername_err = "Please enter a name.";
    } else{
        // Prepare an insert statement
        $sql = "INSERT INTO Characters (charactername, userid) VALUES (?, ?);";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_charname, $param_id);

            // Set parameters
            $param_charname = trim($_POST["charactername"]);
			$param_id = trim($_SESSION["id"]);

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
        <h2>Create New Character</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group margin-bottom">
                <label>Character Name</label>
                <input type="text" name="charactername" class="form-control <?php echo (!empty($charactername_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $charactername; ?>">
                <span class="invalid-feedback"><?php echo $charactername_err; ?></span>
            </div>
			<div class="form-group margin-bottom">
                <input type="submit" class="btn btn-lg btn-secondary fw-bold border-white" value="Submit">
                <input type="reset" class="btn btn-lg btn-secondary fw-bold border-white" value="Reset">
            </div>
            <p><a href="app-characters.php">Go back</a>.</p>
        </form>
    </div>
</body>
</html>