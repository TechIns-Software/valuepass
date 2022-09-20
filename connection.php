<?php

$servername = "localhost";
$username = "u503457546_demovaluepassvm";
$password = "lCtfo[0NM3V2KV]o*3";
$dbname = "u503457546_demovaluepassvm";
try {
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
} catch (Exception $e) {
    $username = "root";
    $password = "";
    $dbname = "valuepassvm";
    try {
        $conn = mysqli_connect($servername, $username, $password, $dbname);
    } catch (Exception $e1) {
        die("Connection failed");
    }
}


?>