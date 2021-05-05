<?php
$user = "ProgUser";
$password = "itsaSECUREpassword";
$database = "spell_assist";
$table = "Levels";

try {
  echo "<h2>TODO</h2><ul>";
  foreach($link->query("SELECT * FROM $table") as $row) {
    echo "<li>" . $row[0] . " " . $row[1] . "</li>";
  }
  echo "</ul>";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>