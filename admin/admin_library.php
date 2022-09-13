<?php

//Get all Languages
function getAllLanguages($conn, $flag = false)
{
    if ($flag == false) {
        $query = "Select * FROM Language WHERE id = 2";
    } else {
        $query = "Select * FROM Language  ";
    }

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
    $last_id = 0; //DEFAULT first ID is 1, so if no row, return 0
    // $result=mysqli_query($conn,$query); test
    // $rowcount=mysqli_num_rows($result); test

    if ($stmt->execute()) {

        $stmt->bind_result($last_id);
        while ($stmt->fetch()) {
        }

    }
    // echo json_encode([$message]);
    $stmt->close();
    if (!is_numeric($last_id)) {
        $last_id = 0;
    }
    return $last_id;
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

// Add one row in IncludedService
function addrowIncludedService($conn, $id, $icon)
{
    $query = "INSERT INTO `IncludedService` (`id`,`icon`) VALUES ( $id , '$icon')";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}

// Add Location for all existing  languages
function AddLabelBoxTranslate($conn, $idlabelbox, $idlang, $name)
{
    $query = "INSERT INTO `LabelsBoxTranslate` (`idLabelsBox`, `idLanguage`, `name`) VALUES (?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $idlabelbox, $idlang, $name);
    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη Label"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }
    $stmt->close();
}

// Add IncludedService for all existing  languages
function AddIncludedServiceTranslate($conn, $idIncludedService, $idlang, $name)
{
    $query = "INSERT INTO `IncludedServiceTranslate` (`idIncludedService`, `idLanguage`, `name`) VALUES (?,?,?)";
    echo $query;
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $idIncludedService, $idlang, $name);
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
    $stmt->bind_param('iis', $idCategory, $idlang, $name);
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
    $name = $id_dest = '';
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
    $name = $id_cat = '';
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
    $query = "SELECT piat.head , piat.idPaymentInfoActivity, piat.description FROM PaymentInfoActivity as pia , PaymentInfoActivityTranslate as piat WHERE piat.idLanguage = 2 AND piat.idPaymentInfoActivity = pia.id group by piat.idPaymentInfoActivity ; ";
    $stmt = $conn->prepare($query);

    $stmt->execute();
    $head = $id_paymentinfo = $temp = '';
    $stmt->bind_result($head, $id_paymentinfo, $temp);
    $paymentsInfos = [];
    while ($stmt->fetch()) {
        array_push($paymentsInfos, [$head, $id_paymentinfo, $temp]);
    }
    $stmt->close();
    return $paymentsInfos;
}


// Add Data in the Vendor page
function AddVendor1(
    $conn, $destId, $priceAdult, $originalPrice, $discount,
    $priceKid, $infantPrice, $idCategory, $paymentCategoryId, $howManyForVoucher
)
{

    $query = "INSERT INTO `Vendor` (`idDestination` , `priceAdult` , `originalPrice`, `discount`, `priceKid` ,`infantPrice` , `idCategory` , `idPaymentInfoActivity`,  `imageBasic`, `forHowManyPersonsIs`,`googleMapsString`)
     VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('idddddiisis', $destId, $priceAdult, $originalPrice, $discount, $priceKid,
        $infantPrice, $idCategory, $paymentCategoryId, $_SESSION['basicImage'], $howManyForVoucher, $_SESSION['mapImage']);
    if ($stmt->execute()) {
        unset($_SESSION['basicImage']);
        unset($_SESSION['mapImage']);

        echo json_encode(["success", "Επιτυχής Προσθήκη Vendor"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }

    $lastid = $conn->insert_id;
    // echo "THIS IS THE LAST ID ". $lastid ;
    $_SESSION['vendorcreateid'] = $lastid;
    $_SESSION['vendorcreatestep'] = 1;
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
function addAboutActivityTranslate($conn, $last_id, $id_lang, $head, $description)
{

    $query = "INSERT INTO `AboutActivityTranslate` (`idAboutActivity`, `idLanguage`, `head`, `description`)  VALUES (?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iiss', $last_id, $id_lang, $head, $description);

    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη Activity"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }

    $stmt->close();
}


// Add one row in Highlight
function addrowHighlight($conn, $id)
{
    $query = "INSERT INTO `Highlight` (`idVendor`) VALUES ($id)";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}


// Add Data in the HighlightTranslate table
function addHighlightTranslate($conn, $last_id, $id_lang, $name)
{

    $query = "INSERT INTO `HighlightTranslate` (`idHighlight`, `idLanguage`, `name`)  VALUES (?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $last_id, $id_lang, $name);

    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη Highlight"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }

    $stmt->close();
}

function getAllIncludeServices($conn)
{

    $query = "select ins.id , inst.name from IncludedService as ins ,IncludedServiceTranslate as inst where ins.id = inst.idIncludedService  group by inst.idIncludedService ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $id = $name = '';
    $stmt->bind_result($id, $name);
    $includedServices = [];
    while ($stmt->fetch()) {
        array_push($includedServices, [$id, $name]);
    }
    $stmt->close();
    return $includedServices;
}


// Add Data in the addVendorIncludedService table
function addVendorIncludedService($conn, $idVendor, $idIncludedService)
{

    $query = "INSERT INTO `VendorIncludedService` (`idVendor`,`idIncludedService`)  VALUES (?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $idVendor, $idIncludedService);

    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη VendorIncludedService"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }

    $stmt->close();
}


function addrowImportantHead($conn, $id, $idvendor)
{
    $query = "INSERT INTO `ImportantInformationHead` (`id`,`idVendor`) VALUES ($id,$idvendor)";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}


// Add Data in the addVendorIncludedService table
function addImportantInformationHeadTranslate($conn, $idImportantInformationHead, $idlang, $name)
{

    $query = "INSERT INTO `ImportantInformationHeadTranslate` (`idImportantInformationHead`,`idLanguage`,`name`)  VALUES (?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $idImportantInformationHead, $idlang, $name);

    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη VendorIncludedService"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }

    $stmt->close();
}


function addrowImportantInformationDescription($conn, $id, $idimportant)
{
    $query = "INSERT INTO `ImportantInformationDescription` (`id`,`idImportantInformationHead`) VALUES ($id,$idimportant)";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}

// Add Data in the addVendorIncludedService table
function addImportantInformationDescriptionTranslate($conn, $idImportantInformationDescription, $idLanguage, $name)
{
    $query = "INSERT INTO `ImportantInformationDescriptionTranslate` (`idImportantInformationDescription`, `idLanguage`, `name`)  VALUES (?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $idImportantInformationDescription, $idLanguage, $name);

    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη VendorIncludedService"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }

    $stmt->close();
}


function addVendorTranslate($conn, $idVendor, $idLanguage, $name, $descbig, $descfull)
{
    $query = "INSERT INTO `VendorTranslate` (`idVendor`, `idLanguage`, `name`, `descriptionBig`, `descriptionFull`)  VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iisss', $idVendor, $idLanguage, $name, $descbig, $descfull);

    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη VendorTranslate"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }

    $stmt->close();
}


function addrowRatedCategory($conn, $id)
{
    $query = "INSERT INTO `RatedCategory` (`id`, `orderNumber`) VALUES ($id,99)";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}


function AddRatedCategoryTranslate($conn, $idlRatedCategory, $idlang, $name)
{
    $query = "INSERT INTO `RatedCategoryTranslate` (`idRatedCategory`, `idLanguage`, `nameCategory`) VALUES (?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $idlRatedCategory, $idlang, $name);
    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη Label"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }
    $stmt->close();
}


function getRatedCategories($conn)
{
    $query = "SELECT rc.id,rct.nameCategory FROM RatedCategory AS rc , RatedCategoryTranslate AS rct WHERE rc.id = rct.idRatedCategory GROUP BY rct.idRatedCategory ; ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $id = $categoryName = '';
    $stmt->bind_result($id, $categoryName);
    $ratedCategories = [];
    while ($stmt->fetch()) {
        array_push($ratedCategories, [$id, $categoryName]);
    }
    $stmt->close();
    return $ratedCategories;
}


function AddRated($conn, $id_cat, $idVendor, $stars)
{

    $query = "INSERT INTO `Rated` (`idRatedCategory`, `idVendor`, `stars`) VALUES (?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iii', $id_cat, $idVendor, $stars);
    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη Label"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }
    $stmt->close();
}


function CheckImage1($conn, $id)
{

    $query = "SELECT image1 FROM Destination  WHERE id = $id ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $image1 = '';
    $stmt->bind_result($image1);
    $text = '';
    while ($stmt->fetch()) {
        $text = $image1;
    }
    $stmt->close();
    return $text;
}


function getAllLabels($conn)
{

    $query = "SELECT lb.id , lbt.name FROM LabelsBox AS lb ,LabelsBoxTranslate AS lbt WHERE lb.id = lbt.idLabelsBox  GROUP BY  lbt.idLabelsBox ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $id = $name = '';
    $stmt->bind_result($id, $name);
    $includedServices = [];
    while ($stmt->fetch()) {
        array_push($includedServices, [$id, $name]);
    }
    $stmt->close();
    return $includedServices;
}


function addSelectedLalels($conn, $idVendor, $idLabelsBox)
{

    $query = "INSERT INTO `VendorLabelsBox` (`idVendor`,`idLabelsBox`)  VALUES (?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $idVendor, $idLabelsBox);

    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη Label "]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }

    $stmt->close();
}

function getAvailableExperiences($conn, $idLoc)
{
    $query = "SELECT v.id, vt.name  FROM Vendor AS v, VendorTranslate AS vt WHERE v.id = vt.idVendor AND v.idDestination = $idLoc GROUP BY v.id ";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $id = $name = $description = '';
    $stmt->bind_result($id, $name);
    $availableExperiences = [];
    while ($stmt->fetch()) {
        array_push($availableExperiences, [$id, $name]);
    }
    $stmt->close();

    return $availableExperiences;
}

function getBestofLocation($conn, $location)
{

    $query = "SELECT id , idVendor FROM BestOff WHERE idDestination = $location ";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $id = $idVendor = '';
    $stmt->bind_result($id, $idVendor);
    $bestofbylocations = [];
    while ($stmt->fetch()) {
        array_push($bestofbylocations, [$id, $idVendor]);
    }

    $stmt->close();
    return $bestofbylocations;
}

function DeleteBestofByLocation($conn, $id)
{
    $query = "DELETE FROM `BestOff` WHERE   idDestination = $id ;";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}


function addBestoff($conn, $idloc, $idVendor)
{
    $query = "INSERT INTO `BestOff` (`idDestination`, `idVendor`) VALUES (?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $idloc, $idVendor);
    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη Best off"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }
    $stmt->close();
}

function finalizeVendor($conn, $idVendor)
{
    $query = "UPDATE Vendor SET isCompleted = 1 WHERE id = $idVendor";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}

function addVoucherRules($conn, $idVendor = -1, $isDateRestrict = false, $dayString = '', $timeVoucher = '', $numberVoucher = 999)
{
    if ($isDateRestrict) {
        $query = "INSERT INTO `VoucherGenerateOptions` (`idVendor`, `isDateRestrict`, `dayString`, `timeVoucher`, `numberVoucher`) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('iissi', $idVendor, $isDateRestrict, $dayString, $timeVoucher, $numberVoucher);
    } else {
        $query = "INSERT INTO `VoucherGenerateOptions` (`idVendor`, `isDateRestrict`, `dayString`, `timeVoucher`, `numberVoucher`) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('iissi', $idVendor, $isDateRestrict, $dayString, $timeVoucher, $numberVoucher);
    }


    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη Vendor Rule"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }
    $stmt->close();

}

function checkLogin($conn, $username, $password, $fromwho)
{
    if ($fromwho == 'admin') {
        $query = "SELECT id , name, surname   FROM Admin WHERE username= '" . $username . "' and password ='" . $password . "' ";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $id = $name = $surname = '';
        $stmt->bind_result($id, $name, $surname);
        $loginUser = [];
        while ($stmt->fetch()) {
            array_push($loginUser, [$id, $name, $surname]);
        }
        if (empty($loginUser)) {
            echo json_encode(array('success' => 0));
        } else {

            $_SESSION['admin'] = $loginUser[0][0];
            $_SESSION['adminName'] = $loginUser[0][1];
            $_SESSION['adminSurname'] = $loginUser[0][2];

            echo json_encode(array('success' => 1 ));
        }

    } else if ($fromwho == 'vendor') {
        $query = "SELECT idVendor, email, phone  FROM VendorLogin WHERE username= '" . $username . "' and password ='" . $password . "' ";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $id = $email = $phone = '';
        $stmt->bind_result($id, $email, $phone);
        $loginUser = [];
        while ($stmt->fetch()) {
            array_push($loginUser, [$id, $email, $phone]);
        }
        if (empty($loginUser)) {
            echo json_encode(array('success' => 0));
        } else {
            $_SESSION['idVendor'] = $loginUser[0][0];
            $_SESSION['email'] = $loginUser[0][1];
            $_SESSION['phone'] = $loginUser[0][2];
            if ( !isset($_SESSION['tempurl'])){
                $_SESSION['tempurl'] = "index.php";
            }
            echo json_encode(array('success' => 1,'tempurl' => $_SESSION['tempurl']));
        }

    }
    $stmt->close();
}

function addVendorPasswords($conn, $id, $username, $password)
{
    $query = "INSERT INTO `VendorLogin` (`idVendor`, `username`, `password` ) VALUES ( $id ,'$username','$password')";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}


function random_password($length = 7)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr(str_shuffle($chars), 0, $length);
    return $password;
}

// Get All Suppliers
function GetAllSuppliers($conn)
{
    $query = "SELECT id,username,name,description FROM Suppliers  ";

    $stmt = $conn->prepare($query);

    $stmt->execute();
    $id = $username = $name = $description = '';
    $stmt->bind_result($id, $username, $name, $description);
    $suppliers = [];
    while ($stmt->fetch()) {
        array_push($suppliers, [$id, $username, $name, $description]);
    }
    $stmt->close();
    return $suppliers;
}

// Get All Usernames
function GetAllUsernames($conn)
{
    $query = "SELECT username FROM Suppliers  ";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $username = '';
    $stmt->bind_result($username);
    $usernames = [];
    while ($stmt->fetch()) {
        array_push($usernames, $username);
    }
    $stmt->close();
    return $usernames;
}

// Add Supplier
function addSupplier($conn,  $username, $password, $name, $description,)
{
    $query = "INSERT INTO `Suppliers` (`username`, `password`, `name`, `description`) VALUES ('$username','$password','$name','$description')";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}
function getVendorsWithoutSupplier($conn){
    $query = "SELECT V.id ,V.imageBasic , Vt.name FROM Vendor as V ,VendorTranslate as Vt ,VoucherSuppliers as Vs where Vt.idVendor = V.id AND Vs.idVendor!=V.id ";

    $stmt = $conn->prepare($query);

    $stmt->execute();
    $id = $imageBasic = $name = '';
    $stmt->bind_result($id, $imageBasic, $name);
    $vendors = [];
    while ($stmt->fetch()) {
        array_push($vendors, [$id, $imageBasic, $name]);
    }
    $stmt->close();
    return $vendors;
}

function getVendorsSupplier($conn, $id,$hassupplier = true){
    if ($hassupplier) {
        $query = "SELECT V.id ,V.imageBasic , Vt.name FROM Vendor as V ,VendorTranslate as Vt ,VoucherSuppliers as Vs where Vt.idVendor = V.id AND Vs.idVendor=V.id and Vs.idSupplier= $id  ";
    }else{
        $query = "Select V.id, V.imageBasic, VT.name
from Vendor AS V, VendorTranslate AS VT
Where V.id = VT.idVendor AND V.id NOT IN
(
    Select Vs.idVendor
    From VoucherSuppliers as Vs, Vendor as V
    Where Vs.idVendor = V.id
)  ";

    }
    $stmt = $conn->prepare($query);

    $stmt->execute();
    $id = $imageBasic = $name = '';
    $stmt->bind_result($id, $imageBasic, $name);
    $vendors = [];
    while ($stmt->fetch()) {
        array_push($vendors, [$id, $imageBasic, $name]);
    }
    $stmt->close();
    return $vendors;
}

function DeleteSupplierVendor ($conn,$supplier_id){
    $query = "DELETE FROM `VoucherSuppliers` WHERE   idSupplier = $supplier_id ;";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}

function addVendorToSupplier($conn, $supplier_id, $idVendor)
{
    $query = "INSERT INTO `VoucherSuppliers` (`idSupplier`, `idVendor`) VALUES (?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $supplier_id, $idVendor);
    if ($stmt->execute()) {
        echo json_encode(["success", "Επιτυχής Προσθήκη"]);
    } else {
        echo json_encode(["fail", "Υπήρξε Κάποιο Θέμα"]);
    }
    $stmt->close();
}





