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
        <title>SpellAssist - Home</title>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
          <header class="sticky-top py-3">
                  <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 1fr;">
                      <div>
                           <img class="nav" src="images/sa-title-small.png">
                      </div>
                      <nav class="d-flex align-items-center nav nav-masthead" style="justify-self: end;">
                        <a class="nav-link active" aria-current="page" href="">Home</a>
                        <a class="nav-link" href="logout.php">Sign Out</a>
                        <a class="nav-link" href="info.php">Importing/Exporting</a>
                        <a class="nav-link" href="faq.php">FAQ</a>
                  </nav>
                  </div>
             </header>
            <br/>
            <br/>
			
                <h1 class="my-5">Welcome to SpellAssist, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>

                <a href="app-characters.php" class="btn btn-lg btn-secondary fw-bold border-white">My Characters</a>
                <a href="app-spells.php" class="btn btn-lg btn-secondary fw-bold border-white">Browse Spells</a>
                <a href="app-import.php" class="btn btn-lg btn-secondary fw-bold border-white">Import Spell Data</a>
                <a href="app-export.php" class="btn btn-lg btn-secondary fw-bold border-white">Export Character Data</a>
                <a href="reset-password.php" class="btn btn-lg btn-secondary fw-bold border-white">Reset Password</a>
                <a href="logout.php" class="btn btn-lg btn-secondary fw-bold border-white">Sign Out of Your Account</a>
        </div>
</body>
</html>
