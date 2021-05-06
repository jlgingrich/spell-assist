<?php
// Include config file
require_once "config.php";

$charid = $_POST["characterid"];
array_map('unlink', glob("uploads/*.csv"));

// Generate export file
$file = fopen("uploads/".$charid.".csv", "w");
$query = "SELECT spellname, IF(prepared, 'true', 'false') prepared, IF(alwaysprepared, 'true', 'false') alwaysprepared FROM HasSpell WHERE characterid = ?;";
$stmt = $link -> prepare($query);
$stmt -> bind_param("i", $charid);
$stmt -> execute();
$result = $stmt -> get_result();
while($row = $result -> fetch_assoc()) {
    fputcsv($file, $row);
}
$result->close();

// Present file for download
header("location: uploads/".$charid.".csv");
exit;
?>
