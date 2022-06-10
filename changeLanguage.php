<?php
session_start();
$langSelected = $_POST["language"];

 $_SESSION["lang"] = $langSelected ;


// if ($langSelected == "greek") {
//     $_SESSION["language"] = "greek";
// } elseif ($langSelected == "english") {
//     $_SESSION["language"] = "english";
// }elseif ($langSelected == "france") {
//     $_SESSION["language"] = "france";
// }
echo $_SESSION["language"];
?>