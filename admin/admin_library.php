<?php

//Get all Languages
function getAllLanguages($conn)
{
    $query = "Select * FROM Language";
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
function lastInstertedid($conn, $table)
{
    $query = "SELECT id FROM $table ORDER BY id DESC LIMIT 0, 1";
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
    $query = "INSERT INTO `Destination` (`id`,`image1`,`image2`) VALUES ($id,'path1','path2')";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}


// Add Location for all existing  languages
function AddLocationTranslate($conn, $idlang, $iddest, $name, $descr)
{
    $query = "INSERT INTO `DestinationTranslate`(`idLanguage`, `idDestination`, `name`, `description`) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iiss', $idlang, $iddest, $name, $descr);
    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη Περιοχής"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }
    $stmt->close();
}




// Add one row in Labelbox
function addrowLabelBox($conn, $id)
{
    $query = "INSERT INTO `Labelsbox` (`id`,`orderNumber`) VALUES ( $id , 99 )";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}


// Add Location for all existing  languages
function AddLabelBoxTranslate($conn, $idlabelbox, $idlang, $name)
{
    $query = "INSERT INTO `LabelsBoxTranslate` (`idLabelsBox`, `idLAnguage`, `name`) VALUES (?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $idlabelbox, $idlang,  $name);
    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη Περιοχής"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }
    $stmt->close();
}




// Add one row in CategoryVendor
function addrowCategoryVendor($conn, $id)
{
    $query = "INSERT INTO `CategoryVendor` (`id`) VALUES ( $id )";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}


// Add Location for all existing  languages
function AddCategoryVendorTranslate($conn, $idCategory, $idlang, $name)
{
    $query = "INSERT INTO `CategoryVendorTranslate` (`idCategoryVendor`, `idLanguage`, `name`) VALUES (?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $idCategory, $idlang,  $name);
    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη Περιοχής"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }
    $stmt->close();
}



// Get All Destinations
function GetAllDestinations($conn,)
{
    $query = "SELECT dt.name , dt.idDestination  FROM Destination as d , DestinationTranslate as dt where dt.idDestination = d.id group by dt.idDestination ;
    ";
    $stmt = $conn->prepare($query);

    $stmt->execute();
    $name= $id_dest =  '';
    $stmt->bind_result($name, $id_dest);
    $destinations = [];
    while ($stmt->fetch()) {
        array_push($destinations, [$name, $id_dest]);
    }
    $stmt->close();
    return $destinations;
}