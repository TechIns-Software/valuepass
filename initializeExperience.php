<?php
session_start();
if (!isset($_SESSION['languageName'], $_SESSION['"anguageId"])) {
    $_SESSION['languageName'] = 'english';
    $_SESSION['"anguageId"] = 2;
}
$languageId = $_SESSION['"anguageId"];
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = serialize([]);
}
?>
