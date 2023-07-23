<?php

$servername = "localhost";
$username = "test";
$password = "test_pass";
$dbname = "valuepassdb";
try {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
} catch (Exception $e) {
    $username = "root";
    $password = "";
    $dbname = "valuepass_vm";
    try {
        $conn = mysqli_connect($servername, $username, $password, $dbname);
    } catch (Exception $e) {
        try {
            if (str_contains($_SERVER['REQUEST_URI'], 'preview')) {
                $username = "u503457546_vpvmpreview";
                $password = "c6!8rLgYfJ4yhIfieF^lJ!";
                $dbname = "u503457546_vpvmpreview";
            } elseif (str_contains($_SERVER['REQUEST_URI'], 'demo')) {
                $username = "u503457546_demovaluepassv";
                $password = "lCtfo[0NM3V2KV]o*3";
                $dbname = "u503457546_demovaluepassv";
            } else {
                $username = "u503457546_vpvmbeta";
                $password = "&s^m7IvySZ2cA*2rkfGI[1S";
                $dbname = "u503457546_vpvmbeta";
            }
            $conn = mysqli_connect($servername, $username, $password, $dbname);

        } catch (Exception $e) {
            die("Connection failed");

        }
    }

}


?>