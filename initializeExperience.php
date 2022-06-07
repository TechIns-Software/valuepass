<?php
session_start();
if (!isset($_SESSION['languageName'], $_SESSION['languageId'])) {
    $_SESSION['languageName'] = 'english';
    $_SESSION['languageId'] = 1;
}
$languageId = $_SESSION['languageId'];
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = serialize([]);
}