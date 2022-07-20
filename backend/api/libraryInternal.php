<?php
//TODO include classes
function getDestinations($conn, $idMaxDestination = 0) : array{
    //get languages as an argument
    ////////////////
    $query1 = "SELECT D.id, DT.name, DT.description, D.image1, D.image2
                FROM Destination AS D, DestinationTranslate AS DT
                WHERE D.id = DT.idDestination
                  AND D.id > ?
                ORDER BY id ASC;";
    $query2 = "SELECT COUNT(id), idDestination FROM Vendor
                WHERE isCompleted = 1
                AND D.id > ?
                GROUP BY idDestination
                ORDER BY idDestination ASC;";
    $stmt1 = $conn->prepare($query1);
    $stmt1->bind_param('i', $idMaxDestination);
    $stmt2 = $conn->prepare($query2);
    $stmt2->bind_param('i', $idMaxDestination);
    //up here
    $destinations = [];
    if ($stmt2->execute()) {
        $id = $name = $description = $image1 = $sum = $idDestination = $image2 = '';
        $stmt2->bind_result($sum, $idDestination);
        $sums = [];
        while ($stmt2->fetch()) {
            $sums[$idDestination] = $sum;
        }
        $stmt2->close();
        $stmt1->execute();
        $stmt1->bind_result($id, $name, $description, $image1, $image2);
        $counter = 1;
        while ($stmt1->fetch()) {
            //todo: if language not specific there is error->one language at the time
            $numberVendors = isset($sums[$counter]) ? intval($sums[$counter]) : 0;
            $destinations[$id] = array(
                ''
            );
            $destination = new \ValuePass\Destination(
                $id, $name, $description,
                $image1, $image2, $numberVendors
            );
            array_push($destinations, $destination);

            $counter = $counter + 1;
        }
    }
//    var_dump($destinations);
    $stmt1->close();
    return $destinations;
}

/*
 * return: associative array:
 *      refreshAll when a new language is added
 *      languages array of associative array (id, name)
 */
function languagesLog($conn, $numberLanguages) {
    $query0 = "SELECT L.id, L.language
            FROM Language AS L";
    $stmt0 = $conn->prepare($query0);
    $idLanguage = $languageName = "";
    $stmt0->execute();
    $stmt0->bind_result($idLanguage, $languageName);
    $languages = [];
    while ($stmt0->fetch()) {
        $associativeLang = array(
            'id'=> $idLanguage,
            'name'=> $languageName
        );
        array_push($languages, $associativeLang);
    }
    $answer_returned = array(
        'languages'=> $languages
    );
    if ($numberLanguages == count($languages)) {
        $answer_returned['refreshAll'] = false;
    } else {
        $answer_returned['refreshAll'] = true;
    }
    return $answer_returned;
}
function getVendorsIds($conn) : array {
    $query0 = "SELECT V.id
            FROM Vendor AS V
            WHERE V.isCompleted = 1";
    $stmt = $conn->prepare($query0);
    $ids = [];
    if ($stmt->execute()) {
        $id = "";
        $stmt->bind_result($id);
        while ($stmt->fetch()) {
            array_push($ids, $id);
        }

    }
    $stmt->close();
    return $ids;
}

function getVendorsNew($conn, $idVendor, $idLanguage) {
    $query = "SELECT V.id, V.priceAdult, V.originalPrice, V.discount,
                        V.priceKid, V.idDestination, V.imageBasic, VT.name, CVT.name, CV.id, V.forHowManyPersonsIs
              FROM Vendor AS V, VendorTranslate AS VT, CategoryVendor as CV,
                        CategoryVendorTranslate CVT
              WHERE V.id = ? AND V.id = VT.idVendor AND VT.idLanguage = ?
                        AND CV.id = V.idCategory AND CV.id = CVT.idCategoryVendor";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $idVendor, $idLanguage);
    if ($stmt->execute()) {
        $id = $priceAdult = $originalPrice = $discount = $priceKid = $idDestination = $image = $name = $categoryName = $categoryId = $forHowManyPersonsIs = '';
        $stmt->bind_result($id, $priceAdult, $originalPrice, $discount, $priceKid, $idDestination, $image, $name, $categoryName, $categoryId, $forHowManyPersonsIs);
        while ($stmt->fetch()) {}
        if (!$id) {
            return null;
        }
        $vendor = New \ValuePass\Vendor(
            $id, $categoryId, $categoryName, $idDestination, $priceAdult, $originalPrice,
            $discount, $priceKid, $image, $name, $forHowManyPersonsIs
        );
        $query1 ="SELECT LBT.name
                FROM LabelsBox LB, VendorLabelsBox AS VLB, LabelsBoxTranslate AS LBT
                WHERE VLB.idVendor = $id AND LBT.idLanguage = $idLanguage 
                AND LBT.idLabelsBox = LB.id AND LB.id = VLB.idLabelsBox
                ORDER BY LB.id ASC;";
        $stmt1 = $conn->prepare($query1);
        if ($stmt1->execute()) {
            $nameLB = '';
            $stmt1->bind_result($nameLB);
            while ($stmt1->fetch()) {
                $vendor->addLabelBoxName($nameLB);
            }
        }


        $query2 = "SELECT RCT.nameCategory, RCV.stars
                FROM RatedCategory RC, Rated AS RCV, RatedCategoryTranslate AS RCT
                WHERE RCV.idVendor = $id AND RCT.idLanguage = $idLanguage 
                AND RCT.idRatedCategory = RC.id AND RC.id = RCV.idRatedCategory
                ORDER BY RC.orderNumber ASC;";
        $stmt2 = $conn->prepare($query2);
        if ($stmt2->execute()) {
            $nameRated = $stars = '';
            $stmt2->bind_result($nameRated , $stars);
            while ($stmt2->fetch()) {
                $vendor->addRatedCategory(new \ValuePass\RatedCategory($nameRated, $stars));
            }
        }

        //TODO vouchers available;
        //getVoucherAvailability()
        $query3 = "";

        $query4 = "SELECT VT.descriptionFull, VT.descriptionBig, P.head, P.description
                FROM Vendor AS V, PaymentInfoActivityTranslate AS P, VendorTranslate AS VT
                WHERE V.id = $id
                  AND VT.idLanguage = $idLanguage AND VT.idVendor = V.id
                  AND P.idLanguage = $idLanguage AND V.idPaymentInfoActivity = P.idPaymentInfoActivity";
        $stmt4 = $conn->prepare($query4);
        if ($stmt4->execute()) {
            $descriptionFull = $descriptionBig = $paymentActivityHead = $paymentActivityDesc = '';
            $stmt4->bind_result($descriptionFull, $descriptionBig, $paymentActivityHead, $paymentActivityDesc);
            while ($stmt4->fetch()) {}
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
                    WHERE H.idVendor = $id AND HT.idHighlight = H.id
                    AND HT.idLanguage = $idLanguage";
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
                    AND IST.idLanguage = $idLanguage
                    ORDER BY icon DESC ";
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
                    AND AAT.idLanguage = $idLanguage";
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
                    if (isset($importantInformation)) {
                        $vendor->addImportantInformation($importantInformation);
                    }
                    $importantInformation = new \ValuePass\ImportantInformation($headImportant);
                    $importantInformation->addDescription($descriptionImportant);
                    $previousImportant = $headImportant;
                }
            }
            if (isset($importantInformation)) {
                $vendor->addImportantInformation($importantInformation);
            }
        }


    }
    return $vendor;
}

