<?php
//$mysqli -> real_escape_string(escapestring)
function getDestinations($conn, $idLanguage) : array{
    $query1 = "SELECT D.id, DT.name, DT.description, D.image1
                FROM Destination AS D, DestinationTranslate AS DT
                WHERE D.id = DT.idDestination AND DT.idLanguage = ?
                ORDER BY id ASC;";
    $query2 = "SELECT SUM(id), idDestination FROM Vendor
                GROUP BY idDestination
                ORDER BY idDestination ASC;";
    $stmt1 = $conn->prepare($query1);
    $stmt1->bind_param('i', $idLanguage);
    $stmt2 = $conn->prepare($query2);
    $destinations = [];
    if ($stmt1->execute() && $stmt2->execute()) {
        $id = $name = $description = $image1 = $sum = '';
        $stmt2->bind_result($sum);
        $sums = [];
        while ($stmt2->fetch()) {
            array_push($sums, $sum);
        }
        $stmt2->close();
        $stmt1->bind_result($id, $name, $description, $image1);
        $counter = 0;
        while ($stmt1->fetch()) {
            $destination = new \ValuePass\Destination(
                $id, $name, $description,
                image1: $image1, numberOfVendors: $sums[$counter]
            );
            array_push($destinations, $destination);
            $counter = $counter + 1;
        }
    }
    $stmt1->close();
    return $destinations;
}

function getDestination($conn, $idDestination, $idLanguage) : \ValuePass\Destination{
    $query = "SELECT DT.name, DT.description, D.image2
                FROM Destination AS D, DestinationTranslate AS DT
                WHERE D.id = ?; AND D.id = DT.idDestination AND DT.idLanguage = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $idDestination, $idLanguage);
    if ($stmt->execute()) {
        $id = $name = $description = $image2 = '';
        $stmt->bind_result($id, $name, $description, $image2);
        $destination = new \ValuePass\Destination(
            $id, $name, $description,
            image2: $image2
        );
    }
    $stmt->close();
    return $destination;
}

function getBestOff($conn, $idLanguage, $idDestination) : array{
    $idDestination = $conn->real_escape_string($idDestination);
    $vendors = getVendors($conn, $idDestination, $idLanguage, isBestOff: true);

}

function getVendors($conn, $idDestination, $idLanguage, $isBestOff = false) : array {
    $idDestination = $conn->real_escape_string($idDestination);
    if ($isBestOff) {
        $query0 = "SELECT V.id
            FROM Vendor AS V, BestOff AS BO, BestOffOrder AS BOO
            WHERE V.idDestination = ? AND V.id = BO.idVendor AND BOO.idBestOff = BO.id
            ORDER BY BOO.number ASC";
    } else {
        $query0 = "SELECT V.id
            FROM Vendor AS V
            WHERE V.idDestination = ?";
    }
    $stmt = $conn->prepare($query0);
    $stmt->bind_param('i', $idDestination);
    $vendors = [];
    if ($stmt->execute()) {
        $id = "";
        while ($stmt->fetch()) {
            $vendor = getVendor($conn, $id, $idLanguage, false);
            array_push($vendors, $vendor);
        }
    }
    return $vendors;
}

function getVendor($conn, $idVendor, $idLanguage, $fullOption = true) {
    $query = "SELECT V.id, V.priceAdult, V.originalPrice, V.discount,
                        V.priceKid, V.idDestination, V.image, VT.name, VT.descriptionSmall, CV.name, C.id
              FROM Vendor AS V, VendorTranslate AS VT, CategoryVendor as CV,
                        CategoryVendorTranslate CVT
              WHERE V.id = ? AND V.id = VT.idVendor AND VT.idLanguage = ?
                        AND CV.id = V.idCategory AND CV.id = CVT.idCategoryVendor";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $idVendor, $idLanguage);
    if ($stmt->execute()) {
        $id = $priceAdult = $originalPrice = $discount = $priceKid = $idDestination = $image = $name = $description = $categoryName = $categoryId = '';
        $stmt->bind_result($id, $priceAdult, $originalPrice, $discount, $priceKid, $idDestination, $image, $description, $name, $categoryName);
        while ($stmt->fetch()) {}
        $vendor = New \ValuePass\Vendor(
            $id, $categoryId, $categoryName, $idDestination, $priceAdult, $originalPrice,
            $discount, $priceKid, $description, $image, $name
        );

        $query1 ="SELECT LBT.name
                FROM LabelBox LB, VendorLabelsBox AS VLB, LabelsBoxTranslate AS LBT
                WHERE VLB.idVendor = $id AND LBT.idLanguage = $idLanguage 
                AND LBT.idLabelsBox = LB.id AND LB.id = VLB.idLabelsBox
                ORDER BY LB.order ASC;";
        $stmt1 = $conn->prepare($query1);
        if ($stmt1->execute()) {
            $nameLB = '';
            $stmt1->bind_result($nameLB);
            while ($stmt1->fetch()) {
                $vendor->addLabelBoxName($nameLB);
            }
        }


        $query2 = "SELECT RCT.nameCategory AND RCV.stars
                FROM RatedCategory RC, Rated AS RCV, RatedCategoryTranslate AS RCT
                WHERE RCV.idVendor = $id AND RCT.idLanguage = $idLanguage 
                AND RCT.idRatedCategory = RC.id AND RC.id = RCV.idRatedCategory
                ORDER BY RC.orderNumber ASC;";
        $stmt2 = $conn->prepare($query2);
        if ($stmt2->execute()) {
            $nameRated = $stars = '';
            $stmt1->bind_result($nameRated , $stars);
            while ($stmt1->fetch()) {
                $vendor->addRatedCategory(new \ValuePass\RatedCategory($nameRated, $stars));
            }
        }

        //TODO vouchers available;
        //getVoucherAvailability()
        $query3 = "";

        if ($fullOption) {
            //everything for Vendor
            $query4 = "SELECT VT.descriptionFull, VT.descriptionBig, P.head, P.description
                FROM Vendor AS V, PaymentInfoActivityTranslate AS P, VendorTranslate AS VT
                WHERE V.id = $id
                  AND VT.idLanguage = $idLanguage AND VT.idVendor = V.id
                  AND P.idLanguage = $idLanguage AND V.idPaymentInfoActivity = P.idPaymentInfoActivity";
            $stmt4 = $conn->prepare($query4);
            if ($stmt4->execute()) {
                $descriptionFull = $descriptionBig = $paymentActivityHead = $paymentActivityDesc = '';
                $stmt1->bind_result($descriptionFull, $descriptionBig, $paymentActivityHead, $paymentActivityDesc);
                while ($stmt1->fetch()) {}
                $vendor->addSimpleField($descriptionFull, $descriptionBig, $paymentActivityHead, $paymentActivityDesc);
            }

            $query5 = "SELECT image FROM VendorImages WHERE idVendor = $id";
            $stmt5 = $conn->prepare($query5);
            if ($stmt5->execute()) {
                $image = "";
                $stmt5->bind_result($image);
                while ($stmt5->fetch()) {
                    $vendor->addImage($image);
                }
            }

            $query5 = "SELECT HT.name
                    FROM Highlight AS H, HighlightTranslate AS HT
                    WHERE H.idVendor = $id AND HT.idHighlight = H.id";
            $stmt5 = $conn->prepare($query5);
            if ($stmt5->execute()) {
                $highlight = "";
                $stmt5->bind_result($highlight);
                while ($stmt5->fetch()) {
                    $vendor->addHighlight($highlight);
                }
            }

            $query6 = "SELECT IST.name, IS1.icon
                    FROM IncludedService AS IS1, VendorIncludedService AS VIS,
                    IncludedServiceTranslate AS IST
                    WHERE VIS.idVendor = $id AND VIS.idIncludedService = IS1.id
                    AND VIS.idIncludedService = IST.idIncludedService
                    AND IST.language = $idLanguage";
            $stmt6 = $conn->prepare($query6);
            if ($stmt6->execute()) {
                $nameService = $icon = '';
                $stmt6->bind_result($nameService, $icon);
                while ($stmt6->fetch()) {
                    $vendor->addIncludedService(new \ValuePass\IncludedService($nameService, $icon));
                }
            }

            $query7 = "SELECT AAT.head, AAT.description
                    FROM AboutActivity AS AA, AboutActivityTranslate AS AAT
                    WHERE AA.idVendor = $id AND AA.id = AAT.idAboutActivity
                    AND AAT.language = $idLanguage";
            $stmt7 = $conn->prepare($query7);
            if ($stmt7->execute()) {
                $headAboutActivity = $descriptionAboutActivity = '';
                $stmt7->bind_result($headAboutActivity, $descriptionAboutActivity);
                while ($stmt7->fetch()) {
                    $vendor->addActivity(new \ValuePass\AboutActivity($headAboutActivity, $descriptionAboutActivity));
                }
            }
            $query8 = "SELECT IIHT.name, IIDT.name
                    FROM ImportantInformationHead AS IIH, ImportantInformationHeadTranslate AS IIHT,
                    ImportantInformationDescription AS IID, ImportantInformationDescriptionTranslate AS IIDT
                    WHERE IIH.idVendor = $id
                    AND IIH.id = IID.idImportantInformationHead
                    AND IIH.id = IIHT.idImportantInformationHead
                    AND IID.id = IIDT.idImportantInformationDescription
                    AND IIHT.idLanguage = $idLanguage
                    AND IIDT.idLanguage = $idLanguage
                    ORDER BY IIH.id";
            $stmt8 = $conn->prepare($query8);
            if ($stmt8->execute()) {
                $headImportant = $previousImportant = $descriptionImportant = '';
                $stmt8->bind_result($headImportant, $descriptionImportant);
                while ($stmt8->fetch()) {
                    if ($previousImportant == $headImportant) {
                        $importantInformation->addDescription($descriptionImportant);
                    } else {
                        if (!isset($importantInformation)) {
                            $vendor->addImportantInformation($importantInformation);
                        }
                        $importantInformation = new \ValuePass\ImportantInformation($headImportant);
                    }
                }
                $vendor->addImportantInformation($importantInformation);
            }
        }


    }
    return $vendor;
}

function getCategoriesVendors($conn, $idLanguage, $idDestination) : array {
    $idDestination = $conn->real_escape_string($idDestination);
    $query = "SELECT CV.id, CVT.name
            FROM Vendor AS V, CategoryVendor AS CV, CategoryVendorTranslate AS CVT
            WHERE CVT.idLanguage = $idLanguage AND CVT.idCategoryVendor = CV.id
            AND V.idDestination = ? AND V.idCategory = CV.id";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $idDestination);
    $categories = [];
    if ($stmt->execute()) {
        $id = $name = '';
        $stmt->bind_result($id, $name);
        while ($stmt->fetch()) {
            array_push($categories, [$id, $name]);
        }
    }
    return $categories;
}

function voucherChangeStatus() {
//    TODO to be sent tou our BD
}

function getMaxVendorVoucher($conn, $idVendorVoucher) : int {
    $query = "SELECT existenceVoucher
            FROM VendorVoucher
            WHERE id = $idVendorVoucher ;";
    $stmt = $conn->prepare($query);
    $number = 0;
    if ($stmt->execute()) {
        $stmt->bind_result($number);
        while ($stmt->fetch()){}
    }
    return $number;
}

function getPossibleVouchersPackages($conn, $idVendor, $numberVoucher, $date) : array {
    $query = "SELECT id, DATE_FORMAT(dateVoucher, '%Y-%m-%d %H:%i:%s')
            FROM VendorVoucher
            WHERE idVendor = ? AND existenceVoucher > ? AND DATE(dateVoucher) = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $idVendor, $numberVoucher, $date);
    $possiblePackages = [];
    if ($stmt->execute()) {
        $id = $date1 = '-1';
        $stmt->bind_result($id, $date1);
        while ($stmt->fetch()) {
            array_push($possiblePackages, [$id, $date1]);
        }
    }
    return $possiblePackages;
}

//session already exists
function getVendorForCart($conn, $idVendorVoucher) : array {
    $query = "SELECT V.priceAdult, V.priceKid, V.infantPrice, V.imageBasic, V.id, VV.dateVoucher
            FROM Vendor AS V, VendorVoucher AS VV
            WHERE VV.id = $idVendorVoucher AND VV.idVendor = V.id";
    $stmt = $conn->prepare($query);
    $priceAdult = $priceKid = $priceInfant = $imageBasic = $idVendor = $dateVoucher = -1;
    if ($stmt->execute()) {
        $stmt->bind_result($priceAdult, $priceKid, $priceInfant, $imageBasic, $idVendor, $dateVoucher);
        while ($stmt->fetch()) {}
    }
    $idLanguage = $_SESSION['languageId'];
    $query2 = "SELECT VT.name
            FROM VendorTranslate AS VT
            WHERE VT.idVendor = $idVendor AND idLanguage = $idLanguage";
    $stmt2 = $conn->prepare($query2);
    $vendorName = "";
    if ($stmt2->execute()) {
        $stmt2->bind_result($vendorName);
        while ($stmt2->fetch()) {}
    }
    return [$priceAdult, $priceKid, $priceInfant, $imageBasic, $dateVoucher, $vendorName];
}

function checkIfVendorVouchersIsStillAvailableInLocalhost($conn, $cart) {
    $idsVendorVouchers = [];
    foreach ($cart as $arrayOfVoucherWant) {
        $idVendorVoucher = $arrayOfVoucherWant[0]->getIdVendorVoucher();
        if (isset($ids[$idVendorVoucher])) {
            $idsVendorVouchers[$idVendorVoucher] = $ids[$idVendorVoucher] + count($arrayOfVoucherWant);
        } else {
            $idsVendorVouchers[$idVendorVoucher] = count($arrayOfVoucherWant);
        }
    }
    foreach ($idsVendorVouchers as $idVendor => $sumOfVoucherWants) {

    }
}

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


//Get Menu with right language
function GetMenu($conn,$lang){
    $query="SELECT mt.name FROM MenuTranslate as mt, Menu as m where  mt.idMenu=m.id and mt.idLanguage=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $lang);

    if ($stmt->execute()) {
        $menu_options= [];
        $stmt->bind_result($menu_options);

        $menu= [];
        while ($stmt->fetch()) {
            array_push($menu, $menu_options);
        }
    }
    return $menu;
}

