<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";

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
        <title>SpellAssist - All Spells</title>
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
                        <a class="nav-link active" aria-current="page" href="app-home.php">Home</a>
                        <a class="nav-link" href="logout.php">Sign Out</a>
                        <a class="nav-link" href="info.php">Importing/Exporting</a>
                        <a class="nav-link" href="faq.php">FAQ</a>
                  </nav>
                  </div>
             </header>
            <br/>
            <br/>

                <div class="row">
                        <h1 class="my-3"><b>Spells</b></h1>
                                <div class="col-sm">
                                <div class="pretty bg-dark overflow-auto">
				<table class="pretty bg-dark align-top table-hover" style="table-layout: fixed;">
                                <thead>
                                        <tr>
                                        <th>Name</th>
                                        <th>Level</th>
                                        <th>School</th>
                                        <th>Verbal</th>
                                        <th>Somatic</th>
                                        <th>Concentration</th>
                                        <th>Ritual</th>
                                        </tr>
                                </thead>
                                <tbody>
                                <tr></tr>
                                <?php
                                        $query = "SELECT spellname, levelname, schoolname, IF(verbal, 'true', 'false') verbal, IF(somatic, 'true', 'false') somatic, IF(concentration, 'true', 'false') concentration, IF(ritual, 'true', 'false') ritual FROM Spells JOIN Schools ON (Schools.abbreviation = Spells.school) JOIN Levels ON (Levels.abbreviation = Spells.lvl) ORDER BY spellname";
                                        $stmt = $link -> prepare($query);
                                        $stmt -> execute();
                                        $result = $stmt -> get_result();
                                        while($row = $result -> fetch_assoc()) {
                                                        $address = "app-spells.php?".http_build_query(array("spellname" => $row['spellname']));
                                                        echo '<tr class="align-top">';
                                                        echo "<td><a href='$address'>".$row['spellname']."</a></td>";
                                                        echo "<td>".$row['levelname']."</td>";
                                                        echo "<td>".$row['schoolname']."</td>";
                                                        echo "<td>".$row['verbal']."</td>";
                                                        echo "<td>".$row['somatic']."</td>";
                                                        echo "<td>".$row['concentration']."</td>";
                                                        echo "<td>".$row['ritual']."</td>";
                                                        echo "</tr>";                                        }
                                        $result->close();
                                ?>
                                </tbody>
                                </table>
				</div>
                                <a href="app-spells.php" class="btn btn-secondary fw-bold border-white">Refresh</a>
                        </div>
                        <div class="col-sm overflow-auto">
                                <ul class="pretty bg-dark">
					<?php
                                        $query = "SELECT spellname, levelname, schoolname, IF(verbal, 'true', 'false') verbal, IF(somatic, 'true', 'false') somatic, IF(concentration, 'true', 'false') concentration, IF(ritual, 'true', 'false') ritual FROM Spells JOIN Levels ON lvl = Levels.abbreviation JOIN Schools ON school = Schools.abbreviation WHERE spellname = ? LIMIT 1;";
                                        $stmt = $link -> prepare($query);
                                        $stmt -> bind_param("s", $spellname);
                                        $spellname = $_GET['spellname'];
                                        $stmt -> execute();
                                        $result = $stmt -> get_result();
                                        while($row = $result -> fetch_assoc()) {
					echo "<li><b><i>".$row['spellname']."</i></b></li>";
					echo "<li><b>Level:</b> ".$row['levelname']."</li>";
                                        echo "<li><b>School:</b> ".$row['schoolname']."</li>";
                                        echo "<li><b>Verbal:</b>  ".$row['verbal']."</li>";
                                        echo "<li><b>Somatic:</b>  ".$row['somatic']."</li>";
                                        echo "<li><b>Concentration:</b>  ".$row['concentration']."</li>";
					echo "<li><b>Ritual:</b>  ".$row['ritual']."</li>";
                                        }
					$result->close();
                                	?>
				</ul>
                        </div>
                </div>
        </div>
</body>
</html>
