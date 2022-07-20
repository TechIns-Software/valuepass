<?php
$string = file_get_contents("example.json");
$data = json_decode($string, true);

var_dump($data);
if (isset($data['John'])) {
//    echo "sdfghj";
}