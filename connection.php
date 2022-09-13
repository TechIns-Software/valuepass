<?php

$servername = "localhost";
$username = "u503457546_dbvaluepass";
$password = "9lw]G*4+Yb4FqSL3[q|";
$dbname = "u503457546_dbvaluepass";
try {
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
} catch (Exception $e) {
    $username = "root";
    $password = "";
    $dbname = "valuepassdb";
    try {
        $conn = mysqli_connect($servername, $username, $password, $dbname);
    } catch (Exception $e1) {
        die("Connection failed");
    }
}


?>