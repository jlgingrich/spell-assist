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
        <title>SpellAssist - My Characters</title>
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
	     <br/><br/>
	     <div class="row">
                          <h1 class="my-3"><b>Characters</b></h1>
                             <div class="col-sm">
                             <ul class="overflow-auto pretty bg-dark">
                             <?php
                                 $query = "SELECT characterid, charactername FROM Characters WHERE userid = ?";
                                 $stmt = $link -> prepare($query);
                                 $stmt -> bind_param("i", $id);
                                 $id = $_SESSION['id'];
                                 $stmt -> execute();
                                 $result = $stmt -> get_result();
                                 while($row = $result -> fetch_assoc()) {
                                    $address = "app-characters.php?".http_build_query($row);
                                    echo "<li><a href='$address'>".$row['charactername']."</a></li>";
                                 }
                                 $result->close();
                             ?>
                             </ul>

                             <a href="app-new-char.php" class="btn fw-bold border-white">Create New Character</a>
			     <?php
				$address = "app-delete-char.php?characterid=".$_GET['characterid'];
                                echo "<a href='$address' class='btn fw-bold border-white'>Remove Character</a>";
                             ?>
			     <a href="app-characters.php" class="btn btn-secondary fw-bold border-white">Refresh</a>
                             </div>
                             <div class="col-sm overflow-auto">
                                                    <div class="pretty bg-dark">
                    <i><b><?php echo htmlspecialchars($_GET["charactername"]); ?></i></b>
                    <table>
                    <thead>
                      <tr>
                      <th>Name</th>
                      <th>Level</th>
                      <th>Prepared</th>
                      <th>Always Prepared</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr></tr>
                    <?php
                            $query = "SELECT spellname, lvl, IF(prepared, 'true', 'false') prepared, IF(alwaysprepared, 'true', 'false') alwaysprepared FROM Spells NATURAL JOIN HasSpell WHERE characterid = ? ORDER BY lvl;";
                            $stmt = $link -> prepare($query);
                            $stmt -> bind_param("i", $id);
                            $id = $_GET['characterid'];
                            $stmt -> execute();
                            $result = $stmt -> get_result();
                            while($row = $result -> fetch_assoc()) {
                                            $address = "app-spells.php?".http_build_query($row);
                                            echo '<tr class="align-top">';
                                            echo "<td><a href='$address'>".$row['spellname']."</a></td>";
                                            echo "<td>".$row['lvl']."</td>";
                                            echo "<td>".$row['prepared']."</td>";
                                            echo "<td>".$row['alwaysprepared']."</td>";
                                            echo "</tr>";
                            }
                            $result->close();
                    ?>
                    </tbody>
                    </table>
                    </div>
                                                    <?php
                                                    $address = "add-spell-char.php?id=".$id;
                    				    echo "<a href='$address' class='btn fw-bold border-white'>Add</a>";
                                                    $address = "remove-spell-char.php?id=".$id;
                                                    echo "<a href='$address' class='btn fw-bold border-white'>Remove</a>";
                                                    ?>
                     </div>
             </div>
     </div>
</body>
</html>
