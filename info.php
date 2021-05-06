<?php
// Initialize the session
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        $signedin = true;
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
    <title>SpellAssist - Importing/Exporting</title>
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
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
                           <a class="nav-link" href="app-home.php">Home</a>
                           <?php if ($signedin == true): ?>
                              <a class="nav-link" href="logout.php">Sign Out</a>
                           <?php else: ?>
                              <a class="nav-link" href="login.php">Sign In</a>
                           <?php endif ?>
                           <a class="nav-link active" aria-current="page" href="info.php">Importing/Exporting</a>
                           <a class="nav-link" href="faq.php">FAQ</a>
                      </nav>
                  </div>
             </header>
            <br/>
            <br/>

          <main class="px-3">
                <h1>Importing and Exporting</h1>
                <h3>Importing Spell Data from 5eTools</h3>
                  <ol>
                    <li>Travel to the Spells page on <a href="https://5e.tools/spells.html" target="_blank">5eTools</a>.</li>
                    <li>Locate the spells you want to import and add them to the pinned list by right-clicking on a spell and pressing "Pin".</li>
                    <li>Once you've assembled the list of spells to import, right-click on any spell in the pinned list, press "Download JSON Data", and save the JSON file to somewhere easily retrieveable.</li>
                    <li>Sign in to Spell Assist and click on "Import Spell Data".</li>
                    <li>Select the JSON file called "spells-sublist-data.json" and press "Upload".</li>
                    <li>The spells that you selected have now been imported into SpellAssist and can be added to your characters!</li>
                  </ol>
                <h3>Exporting Character Data</h3>
                  <ol>
                    <li></li>
                  </ol>
          </main>
        </div>
</body>
</html>
