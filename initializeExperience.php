<?php
// Setting Content Security Policy
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline';");

// Setting X-Content-Type-Options
header("X-Content-Type-Options: nosniff");

// Setting X-Frame-Options
header('X-Frame-Options: SAMEORIGIN');
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
setcookie('cookie_name', 'cookie_value', [
    'httponly' => true,
    'samesite' => 'Strict', // Requires PHP 7.3.0 or newer
]);
?>
