<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: app-home.php");
    exit;
}
?>

<!doctype html>
<html lang="en" class="h-100">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"><!doctype html>
    <title>SpellAssist - 5E D&D Spell Management</title>
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bg-img {
        background-image: url("images/background-full.png");

        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
     }
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
                           <a class="nav-link active" aria-current="page" href="app-home.php">Home</a>
                           <?php if ($signedin == true): ?>
                              <a class="nav-link" href="logout.php">Sign Out</a>
                           <?php else: ?>
                              <a class="nav-link" href="login.php">Sign In</a>
                           <?php endif ?>
                           <a class="nav-link" href="info.php">Importing/Exporting</a>
                           <a class="nav-link" href="faq.php">FAQ</a>
                      </nav>
                  </div>
             </header>
            <br/>
            <br/>
          <img src="images/sa-title.png">

          <main class="px-3">
                <h1>Losing track of your spells?</h1>
                <h1>Too many tabs open?</h1>
                <p class="lead">
					Pen and paper role-playing games are fun, but sometimes keeping track of the skills and abilities your character has can be a hassle.
					Spell Assist provides a simple and powerful solution to one facet of the problem: spells.
					Now you can keep track of your characters' spell lists and cast quickly and easily!
                </p>
				<a href="register.php" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Join!</a>
          </main>

         <footer class="mt-auto text-white-50"/>
        </div>
</body>
</html>
