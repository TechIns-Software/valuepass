<?php
//TODO: authentication
if (!isset($_POST["destinations"])) {
    exit('Error: missing arguments');
}

if (!isset($conn)) {
    //TODO: our db connection
    include 'connection.php';
}
$destinations = $_POST["destinations"];
$stringOfIdDestinations= implode(",",$destinations);
//STEP 1: Get Languages
$languages = [];
$query1 = "SELECT id, language, icon
        FROM Language
        ORDER BY id";
$stmt1 = $conn->prepare($query1);
if ($stmt1->execute()) {
    $id = $language = $icon = "";
    $stmt1->bind_result($id, $language, $icon);
    while ($stmt1->fetch()) {
        $languages[$id] = array("language"=>$language, "icon"=>$icon);
    }
}

//TODO: image transfer someway
//https://www.codexworld.com/how-to/save-image-from-url-using-php/
//Maybe will work with cURL library
//file_get_contents("http://www.freshdirect.com",false,stream_context_create(
//    array("http" => array("user_agent" => "any"))
//));


//STEP 2: Get Destinations
$destinations = [];
$destinationsIds = [];
$query2 = "SELECT D.id, DT.idLanguage, D.image1, D.image2, DT.name, DT.description
        FROM Destination AS D, DestinationTranslate as DT
        WHERE D.id = DT.idDestination
        ORDER BY D.id";
$stmt2 = $conn->prepare($query2);
if ($stmt2->execute()) {
    $id = $idLanguage = $image1 = $image2 = $name = $desciption = '';
    $stmt2->bind_result($id, $idLanguage, $image1, $image2, $namem, $desciption);
    while ($stmt2->fetch()) {
        if (in_array($destinationsIds, $id)) {
            array_push($destinationsIds, $id);
        }
        $languagesStructure = array($idLanguage=>array("name"=>$name, "description"=>$desciption));
        if (isset($destinations[$id])) {
            array_push($destinations[$id]["languages"], $languagesStructure);
        } else {
            $inlineStructure = array("languages"=>$languagesStructure, "image1"=>$image1, "image2"=>$image2);
            $destinations[$id] = $inlineStructure;
        }
    }
}

