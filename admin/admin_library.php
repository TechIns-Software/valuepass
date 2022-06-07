<?php

//Get all Languages
function getAllLanguages($conn)
{
    $query = "Select * FROM language";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $id = $language = $icon = '';
    $stmt->bind_result($id, $language, $icon);
    $languages = [];
    while ($stmt->fetch()) {
        array_push($languages, [$id, $language, $icon]);
    }
    $stmt->close();
    return $languages;
}

// Get last inserted id
function lastInstertedid($conn)
{
    $query = "SELECT id FROM destination ORDER BY id DESC LIMIT 0, 1";
    $stmt = $conn->prepare($query);

    if ($stmt->execute()) {
        $last_id = -1;
        $stmt->bind_result($last_id);
        while ($stmt->fetch()) {
        }

        if ($last_id == -1) {
            $message = "Wrong Credential";
        } else {
            $message = "Success";
        }
    }
    // echo json_encode([$message]);
    $stmt->close();
    return  $last_id;
}


// Add one row in Destinations 
function addrowDestination($conn, $id)
{
    $query = "INSERT INTO `destination`(`id`) VALUES ($id)";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}



function AddLocationTranslate($conn, $idlang, $iddest, $name, $descr)
{
    $query = "INSERT INTO `destinationtranslate`(`idLanguage`, `idDestination`, `name`, `description`) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iiss', $idlang, $iddest, $name, $descr);
    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη Περιοχής"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }
    $stmt->close();
}
