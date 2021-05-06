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
    <title>Spell Assist - FAQ</title>
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

     .qu, .an {
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
                           <a class="nav-link" href="info.php">Importing/Exporting</a>
                           <a class="nav-link active" aria-current="page" href="faq.php">FAQ</a>
                      </nav>
                  </div>
             </header>
            <br/>
            <br/>

          <main class="px-3">
                <h1>FAQ</h1>
                <h3 class="qu">Q: Why was SpellAssist created?</h3>
                  <p class="an">A: Personal interest in tabletop role-playing games such as D&D 5e and a preference for manually keeping track of character attributes via printed character sheets. While pen and paper are fantastic for not breaking immersion too much, it means lots of leafing through sourcebooks and time spent trying to find the specific page that has the information you're looking for, especially for spellcasting characters. The development of SpellAssist was actually initiated by a class project, which is why many of the backend details are the way they are, but will continue to be maintained and updated as a personal project thereafter.</p>
                <h3 class="qu">Q: Who created Spell Assist?</h3>
                  <p class="an">A: SpellAssist was created by J. Liam Gingrich, a Computer Science major with a Data Science minor in his third year of college. As expected, he is a self-identifying geek who games in person and online, though creative games are more his style than FPS or MMORPGs.</p>
                                <h3 class="qu">Q: Is SpellAssist open-source?</h3>
                  <p class="an">A: Yes! The repository can be found on <a href="https://github.com/jlgingrich/spell-assist">Github</a>, though at the moment the repository is not connected directly to the server and as such may be out-of-date.</p>
                                <h3 class="qu">Q: Is SpellAssist legal?</h3>
                  <p class="an">A: Probably? We don't directly use any content directly from <b>Wizards of the Coast</b>, so any material placed on our site by a third party is not our responsibility. That said, 5eTools is dubious at best, and we suggest having your own copies of the source books these materials come from, since they're nice to have anyways.</p>
          </main>
        </div>
</body>
</html>
