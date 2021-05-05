<?php
// Include config file
require_once "config.php";

// 
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Validate file metadata and move to working directory
if (basename($_FILES["fileToUpload"]["name"]) == "spells-sublist-data.json") {
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}

$strJsonFileContents = file_get_contents("uploads/spells-sublist-data.json");
$entries = json_decode($strJsonFileContents); // Parse JSON

$sql = "INSERT INTO Spells (spellname, lvl, school, verbal, somatic, concentration, ritual) VALUES (?, ?, ?, ?, ?, ?, ?);";

foreach ($entries as $key => $value) {
	if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "sisiiii", $spellname, $lvl, $school, $verbal, $somatic, $concentration, $ritual);

		// Set parameters
		$spellname = $value->name;
        $lvl = $value->level;
        $school = $value->school;
        if($value->components->v == 1){
                $verbal = 1;
        } else {
                $verbal = 0;
        }
        if($value->components->s == 1){
                $somatic = 1;
        } else {
                $somatic = 0;
        }
	    if($value->duration->concentration == 1){
                $concentration = 1;
        } else {
                $concentration = 0;
        }
        if($value->meta->ritual == 1){
                $ritual = 1;
        } else {
                $ritual = 0;
        }

		// Attempt to execute the prepared statement
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
}

header("location: app-home.php");
?>