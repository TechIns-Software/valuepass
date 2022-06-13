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
    $query = "INSERT INTO `LabelsBox` (`id`,`orderNumber`) VALUES ( $id , 99 )";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}


// Add Location for all existing  languages
function AddLabelBoxTranslate($conn, $idlabelbox, $idlang, $name)
{
    $query = "INSERT INTO `LabelsBoxTranslate` (`idLabelsBox`, `idLanguage`, `name`) VALUES (?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $idlabelbox, $idlang,  $name);
    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη Label"]);
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
        echo json_encode(["success", "Επιτυχής Προσθήκη Κατηγορίας"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }
    $stmt->close();
}



// Get All Destinations
function GetAllDestinations($conn)
{
    $query = "SELECT dt.name , dt.idDestination  FROM Destination as d , DestinationTranslate as dt where dt.idDestination = d.id group by dt.idDestination ;
    ";
    $stmt = $conn->prepare($query);

    $stmt->execute();
    $name = $id_dest =  '';
    $stmt->bind_result($name, $id_dest);
    $destinations = [];
    while ($stmt->fetch()) {
        array_push($destinations, [$name, $id_dest]);
    }
    $stmt->close();
    return $destinations;
}



// Get All Categories
function GetAllCategories($conn)
{
    $query = "SELECT cvt.name,cvt.idCategoryVendor FROM CategoryVendor as cv , CategoryVendorTranslate as cvt WHERE cvt.idCategoryVendor = cv.id group by cvt.idCategoryVendor ; ";
    $stmt = $conn->prepare($query);

    $stmt->execute();
    $name = $id_cat =  '';
    $stmt->bind_result($name, $id_cat);
    $categories = [];
    while ($stmt->fetch()) {
        array_push($categories, [$name, $id_cat]);
    }
    $stmt->close();
    return $categories;
}




// Get All PaymentInfos
function GetAllPaymentInfos($conn)
{
    $query = "SELECT piat.head , piat.idPaymentInfoActivity FROM PaymentInfoActivity as pia , PaymentInfoActivityTranslate as piat WHERE piat.idPaymentInfoActivity = pia.id group by piat.idPaymentInfoActivity ; ";
    $stmt = $conn->prepare($query);

    $stmt->execute();
    $head = $id_paymentinfo =  '';
    $stmt->bind_result($head, $id_paymentinfo);
    $paymentsInfos = [];
    while ($stmt->fetch()) {
        array_push($paymentsInfos, [$head, $id_paymentinfo]);
    }
    $stmt->close();
    return $paymentsInfos;
}



// Add Data in the Vendor page 
function AddVendor1($conn,  $destId,  $priceAdult,  $originalPrice,  $discount,  $priceKid, $infantPrice, $idCategory, $paymentCategoryId) {

    $query = "INSERT INTO `Vendor` (`idDestination` , `priceAdult` , `originalPrice`, `discount`, `priceKid` ,`infantPrice` , `idCategory` , `idPaymentInfoActivity` )
     VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('idddddii', $destId , $priceAdult , $originalPrice , $discount ,  $priceKid  , $infantPrice, $idCategory, $paymentCategoryId);

    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη Vendor"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }

    $lastid = $conn->insert_id;
    // echo "THIS IS THE LAST ID ". $lastid ;
    $_SESSION['vendorcreateid'] =    $lastid ;
    $_SESSION['vendorcreatestep'] =  1 ;
    $stmt->close();

}


// Add one row in AboutActivity
function addrowAboutActivity($conn, $id)
{
    $query = "INSERT INTO `AboutActivity` (`idVendor`) VALUES ($id)";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}




// Add Data in the addAboutActivityTranslate table
function addAboutActivityTranslate($conn , $last_id , $id_lang ,$head,$description) {

    $query = "INSERT INTO `AboutActivityTranslate` (`idAboutActivity`, `idLanguage`, `head`, `description`)  VALUES (?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iiss', $last_id , $id_lang , $head , $description);

    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη Activity"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }

    $stmt->close();

}