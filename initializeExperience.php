<?php
// Setting Content Security Policy
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline';");

// Setting X-Content-Type-Options
header("X-Content-Type-Options: nosniff");

// Setting X-Frame-Options
header('X-Frame-Options: SAMEORIGIN');
session_start();
if (!isset($_SESSION['languageName'], $_SESSION["languageId"])) {
    if(isset($_GET['lang']) && $_GET['lang'] == 'el') {
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
if (!isset($_SESSION['guest'])) {
    date_default_timezone_set('Europe/Athens');
    $_SESSION['guest'] = 1;
    if (!isset($conn)) {
        include 'connection.php';
    }
    $query = "INSERT INTO Guests (dateLog, userAgent) VALUES (?,?)";
    $stmt = $conn->prepare($query);
    $dateLog = date('Y-m-d H:i:s');
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $stmt->bind_param('ss', $dateLog, $userAgent);
    $stmt->execute();
    $stmt->close();

}
setcookie('cookie_name', 'cookie_value', [
    'httponly' => true,
    'samesite' => 'Strict', // Requires PHP 7.3.0 or newer
]);
?>
