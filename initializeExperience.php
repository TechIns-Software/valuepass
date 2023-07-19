<?php
session_start();
if (!isset($_SESSION['languageName'], $_SESSION["languageId"])) {
    if(isset($_GET['lang']) && $_GET['lang'] == 'gr') {
        $_SESSION["languageId"] = 1;
    } else {
        $_SESSION['languageName'] = 'english';
        $_SESSION["languageId"] = 2;
    }
}
$languageId = $_SESSION["languageId"];
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = serialize([]);
}
?>
