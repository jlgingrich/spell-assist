<?php
// Initialize the session
session_start();
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ header("location: login.php"); exit;
}
// Include config file
require_once "config.php";
// Define variables and initialize with empty values
$new_password = $confirm_password = ""; $new_password_err = $confirm_password_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate new password
    if(empty(trim($_POST["new_password"]))){ $new_password_err = "Please enter the new password.";
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){ $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]); if(empty($new_password_err) && ($new_password 
        != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE Users SET password = ? WHERE id = ?"; if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT); $param_id = $_SESSION["id"];
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy(); header("location: login.php"); exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
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
	<title>SpellAssist - Reset Password</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"> 
	<style>
        	.bg-img { background-image: url("images/background-top.png"); height: 100%; background-position: center; background-repeat: no-repeat; background-size: cover;}
       		ol { text-align: left;}
        	.wrapper{padding: 20px!important;}
	</style>
	<link href="cover.css" rel="stylesheet">
</head>
<body class="d-flex h-100 text-center text-white bg-img">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column wrapper">
	<h2>Reset Password</h2> 
        <p>Please fill out this form to reset your password.</p> <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group margin-bottom"> <label>New Password</label> <input type="password" 
                name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' 
                : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span> </div> <div 
            class="form-group margin-bottom">
                <label>Confirm Password</label> <input type="password" name="confirm_password" 
                class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"> 
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div> <div class="form-group margin-bottom"> <input type="submit" class="btn btn-lg 
                btn-secondary fw-bold border-white" value="Submit"> <a class="btn btn-lg btn-secondary 
                fw-bold border-white" href="index.php">Cancel</a>
            </div> </form> </div> </body>
</html>
