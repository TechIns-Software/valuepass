<?php
$servername="localhost";
$username="root";
$password="";
$dbname="valuepassdb";
//$servername="localhost";
//$username="u503457546_valuepassdb";
//$password="1234Valuepassbdtest";
//$dbname="u503457546_valuepassdb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}

?>