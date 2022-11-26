<?php
//$mysqli -> real_escape_string(escapestring)
function getDestinations($conn, $idLanguage): array
{
    $query1 = "SELECT D.id, DT.name, DT.description, D.image1, D.image2
                FROM Destination AS D, DestinationTranslate AS DT
                WHERE D.id = DT.idDestination AND DT.idLanguage = ?
                AND D.isOkForShowing = 1 AND D.showIt = 1
                ORDER BY id ASC;";
    $query2 = "SELECT COUNT(V.id), D.id
                FROM Vendor AS V, Destination AS D
                WHERE V.isOkForShowing = 1 AND V.isActiveNow = 1
                    AND D.id = V.idDestination AND D.showIt = 1
                GROUP BY D.id
                ORDER BY D.id ASC;";
    $stmt1 = $conn->prepare($query1);
    $stmt1->bind_param('i', $idLanguage);
    $stmt2 = $conn->prepare($query2);
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
            $numberVendors = isset($sums[$id]) ? intval($sums[$id]) : 0;
            if ($numberVendors == 0) {
                continue;
            }
            $destination = new \ValuePass\Destination(
                $id, $name, $description,
                $image1, $image2, $numberVendors
            );
            array_push($destinations, $destination);
            $counter = $counter + 1;
        }
    }
    $stmt1->close();
    return $destinations;
}

function getDestination($conn, $idDestination, $idLanguage): \ValuePass\Destination|null
{
    $query = "SELECT D.id, DT.name, DT.description, D.image2
                FROM Destination AS D, DestinationTranslate AS DT
                WHERE D.id = $idDestination AND D.id = DT.idDestination
                  AND DT.idLanguage = $idLanguage
                  AND D.isOkForShowing = 1 AND D.showIt = 1";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        $id = $name = $description = $image2 = '';
        $stmt->bind_result($id, $name, $description, $image2);
        while ($stmt->fetch()) {
        }
    }
    if ($id == "") {
        $destination = null;
    } else {
        $destination = new \ValuePass\Destination(
            intval($id), $name, $description,
            image2: $image2
        );
    }
    $stmt->close();
    return $destination;
}

function getVendors($conn, $idDestination, $idLanguage, $isBestOff = false): array
{
    $idDestination = $conn->real_escape_string($idDestination);
    if ($isBestOff) {
        $query0 = "SELECT V.id
            FROM Vendor AS V, BestOff AS BO
            WHERE V.idDestination = ? AND V.id = BO.idVendor
              AND V.isOkForShowing = 1 AND V.isActiveNow = 1;";
    } else {
        $query0 = "SELECT V.id
            FROM Vendor AS V
            WHERE V.idDestination = ? AND V.isOkForShowing = 1
                AND V.isActiveNow = 1;";
    }
    $stmt = $conn->prepare($query0);
    $stmt->bind_param('i', $idDestination);
    $vendors = [];
    if ($stmt->execute()) {
        $id = "";
        $ids = [];
        $stmt->bind_result($id);
        while ($stmt->fetch()) {
            array_push($ids, $id);
        }

    }
    $stmt->close();
    foreach ($ids as $id) {
        $vendor = getVendor($conn, $id, $idLanguage, false);
        array_push($vendors, $vendor);
    }
    return $vendors;
}

function getVendor($conn, $idVendor, $idLanguage, $fullOption = true): \ValuePass\Vendor|null
{
    $query = "SELECT V.id, V.priceAdult, V.originalPrice, V.discount,
                        V.priceKid, V.idDestination, V.imageBasic, VT.name,
                        CVT.name, CV.id, V.forHowManyPersonsIs, V.googleMapsImage,
                        V.childAcceptance, V.infantTolerance, V.minAgeAdult,
                        V.minAgeKid
              FROM Vendor AS V, VendorTranslate AS VT, CategoryVendor as CV,
                        CategoryVendorTranslate CVT
              WHERE V.id = ? AND V.id = VT.idVendor AND VT.idLanguage = ?
                        AND CV.id = V.idCategory AND CV.id = CVT.idCategoryVendor
                        AND CVT.idLanguage = ?
                        AND V.isOkForShowing = 1 AND V.isActiveNow = 1;";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('iii', $idVendor, $idLanguage, $idLanguage);
    if ($stmt->execute()) {
        $id = $priceAdult = $originalPrice = $discount = $priceKid = $idDestination
            = $image = $name = $categoryName = $categoryId = $forHowManyPersonsIs
            = $googleMapsImage = $childAcceptance = $infantTolerance = $minAgeAdult
            = $minAgeKid = '';
        $stmt->bind_result($id, $priceAdult, $originalPrice, $discount, $priceKid, $idDestination, $image, $name, $categoryName, $categoryId, $forHowManyPersonsIs, $googleMapsImage, $childAcceptance, $infantTolerance, $minAgeAdult, $minAgeKid);
        while ($stmt->fetch()) {
        }
        if (!$id) {
            return null;
        }
        $vendor = new \ValuePass\Vendor(
            $id, $categoryId, $categoryName, $idDestination, $priceAdult, $originalPrice,
            $discount, $priceKid, $image, $name, $forHowManyPersonsIs, $googleMapsImage,
            $childAcceptance, $infantTolerance, $minAgeAdult, $minAgeKid
        );
        $query1 = "SELECT LBT.name
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
            $stmt2->bind_result($nameRated, $stars);
            while ($stmt2->fetch()) {
                $vendor->addRatedCategory(new \ValuePass\RatedCategory($nameRated, $stars));
            }
        }
        date_default_timezone_set('Europe/Athens');
        $dayNumberToday = date('d');
        $monthNumberToday = intval(date('m'));
        $yearNumberToday = date('Y');
        $query3 = "SELECT SUM(VV.starterVouchers), SUM(VV.existenceVoucher)
                FROM VendorVoucher AS VV
                WHERE VV.idVendor = $id
                AND day(VV.dateVoucher) = $dayNumberToday
                AND month(VV.dateVoucher) = $monthNumberToday
                AND year(VV.dateVoucher) = $yearNumberToday";
        $stmt3 = $conn->prepare($query3);
        if ($stmt3->execute()) {
            $starterVouchers = $existenceVoucher = 0;
            $stmt3->bind_result($starterVouchers, $existenceVoucher);
            while ($stmt3->fetch()) {
            }
            $starterVouchers = $starterVouchers ?: 0;
            $existenceVoucher = $existenceVoucher ?: 0;
            $vendor->setMaxVouchersToday($starterVouchers);
            $vendor->setAvailableVouchersToday($existenceVoucher);
        }
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
                $stmt4->bind_result($descriptionFull, $descriptionBig, $paymentActivityHead, $paymentActivityDesc);
                while ($stmt4->fetch()) {
                }
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
            $query8 = "SELECT IIHT.name, IIDT.name, IIH.id
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
                $headImportant = $previousImportant = $descriptionImportant = $idHead = '';
                $stmt8->bind_result($headImportant, $descriptionImportant, $idHead);
                while ($stmt8->fetch()) {
                    if ($previousImportant == $idHead) {
                        if (!isset($importantInformation)) {
                            $importantInformation = new \ValuePass\ImportantInformation($headImportant);
                        }
                        $importantInformation->addDescription($descriptionImportant);
                    } else {
                        if (isset($importantInformation)) {
                            $vendor->addImportantInformation($importantInformation);
                        }
                        $importantInformation = new \ValuePass\ImportantInformation($headImportant);
                        $importantInformation->addDescription($descriptionImportant);
                        $previousImportant = $idHead;
                    }
                }
                if (isset($importantInformation)) {
                    $vendor->addImportantInformation($importantInformation);
                }
            }
            $query9 = "SELECT DISTINCT DATE_FORMAT(dateVoucher, '%Y-%m-%d')
                    FROM VendorVoucher AS VV
                    WHERE VV.idVendor = $id
                        AND VV.existenceVoucher > 0";
            $stmt9 = $conn->prepare($query9);
            $availableDates = [];
            if ($stmt9->execute()) {
                $dateString = "";
                $stmt9->bind_result($dateString);
                while ($stmt9->fetch()) {
                    array_push($availableDates, $dateString);
                }
            }
            $vendor->setAvailableDates($availableDates);
        }


    }
    return $vendor;
}

function getCategoriesVendors($conn, $idLanguage, $idDestination): array
{
    $idDestination = $conn->real_escape_string($idDestination);
    $query = "SELECT DISTINCT(CV.id), CVT.name
            FROM Vendor AS V, CategoryVendor AS CV, CategoryVendorTranslate AS CVT
            WHERE CVT.idLanguage = $idLanguage AND CVT.idCategoryVendor = CV.id
            AND V.idDestination = ? AND V.idCategory = CV.id
              AND V.isOkForShowing = 1 AND V.isActiveNow = 1;";
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

function getMaxVendorVoucher($conn, $idVendorVoucher): int
{
    $query = "SELECT existenceVoucher
            FROM VendorVoucher
            WHERE id = $idVendorVoucher ;";
    $stmt = $conn->prepare($query);
    $number = 0;
    if ($stmt->execute()) {
        $stmt->bind_result($number);
        while ($stmt->fetch()) {
        }
    }
    return $number;
}

function getPossibleVouchersPackages($conn, $idVendor, $numberVoucher, $date): array
{
    $query = "SELECT VV.id, DATE_FORMAT(VV.dateVoucher, '%Y-%m-%d %H:%i:%s'),
            V.priceAdult, V.priceKid, V.infantPrice, V.hourCancel, V.discount, V.originalPrice ,V.forHowManyPersonsIs,
            V.priceKidVendor, VV.starterVouchers, VV.existenceVoucher
            FROM Vendor AS V, VendorVoucher AS VV 
            WHERE VV.idVendor = ? AND VV.existenceVoucher >= ? AND DATE(VV.dateVoucher) = ?
            AND V.id = VV.idVendor
              AND V.isOkForShowing = 1 AND V.isActiveNow = 1;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $idVendor, $numberVoucher, $date);
    $possiblePackages = [];
    if ($stmt->execute()) {
        $id = $date1 = $priceAdult = $priceKid = $infantPrice = $hourCancel =
        $discount = $originalPrice = $forHowManyPersonsIs = $priceKidVendor =
        $starterVouchers = $existenceVoucher = '-1';
        $stmt->bind_result($id, $date1, $priceAdult, $priceKid, $infantPrice, $hourCancel, $discount, $originalPrice, $forHowManyPersonsIs, $priceKidVendor, $starterVouchers, $existenceVoucher);
        while ($stmt->fetch()) {
            array_push($possiblePackages, [$id, $date1, $priceAdult, $priceKid, $infantPrice, $hourCancel, $discount, $originalPrice, $forHowManyPersonsIs, $priceKidVendor, $starterVouchers, $existenceVoucher]);
        }
    }
    return $possiblePackages;
}

function getVendorForCart($conn, $idVendorVoucher, $idLanguage): array
{
    $query = "SELECT V.priceAdult, V.priceKid, V.infantPrice, V.imageBasic, V.id, V.hourCancel , VV.dateVoucher,
            V.discount, V.originalPrice,V.forHowManyPersonsIs, V.priceKidVendor
            FROM Vendor AS V, VendorVoucher AS VV
            WHERE VV.id = $idVendorVoucher AND VV.idVendor = V.id";
    $stmt = $conn->prepare($query);
    $priceAdult = $priceKid = $priceInfant = $imageBasic = $idVendor = $hourCancel = $dateVoucher = $discount = $originalPrice = $forHowManyPersonsIs = $priceKidVendor = -1;
    if ($stmt->execute()) {
        $stmt->bind_result($priceAdult, $priceKid, $priceInfant, $imageBasic, $idVendor, $hourCancel, $dateVoucher, $discount, $originalPrice, $forHowManyPersonsIs, $priceKidVendor);
        while ($stmt->fetch()) {
        }
    }
    $query2 = "SELECT VT.name
            FROM VendorTranslate AS VT
            WHERE VT.idVendor = $idVendor AND idLanguage = $idLanguage";
    $stmt2 = $conn->prepare($query2);
    $vendorName = "";
    if ($stmt2->execute()) {
        $stmt2->bind_result($vendorName);
        while ($stmt2->fetch()) {
        }
    }
    return [$priceAdult, $priceKid, $priceInfant, $imageBasic, $dateVoucher, $vendorName, $hourCancel, $discount, $originalPrice, $forHowManyPersonsIs, $priceKidVendor];
}


//Get all Languages
function getAllLanguages($conn)
{
    $query = "Select id, language, icon FROM Language;";
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
function GetMenu($conn, $lang)
{
    $query = "SELECT m.id, mt.name
            FROM MenuTranslate as mt, Menu as m
            where mt.idMenu = m.id and mt.idLanguage = ?
            ORDER BY m.id;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $lang);

    if ($stmt->execute()) {
        $name = $idMenu = '';
        $stmt->bind_result($idMenu, $name);

        $menu = [];
        while ($stmt->fetch()) {
            //so to have the same errors in local, if duplicate rows
            $menu[$idMenu - 1] = $name;
//            array_push($menu, $name);
        }
    }
    return $menu;
}


function getLanguageIcon($conn, $langId)
{
    $query = "Select icon FROM Language where id =$langId; ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $icon = '';
    $stmt->bind_result($icon);
    $language_icon = '';
    while ($stmt->fetch()) {
        $language_icon = $icon;
    }
    $stmt->close();
    return $language_icon;
}


function createArrayVouchersSortedFromCart($conn, $cart, $idLanguage)
{
    $allVouchers = [];

    $nameVendorArray = [];
    $dateVoucherArray = [];
    $adultsArray = [];
    $childrenArray = [];
    $infantsArray = [];
    $amountPayArray = [];
    $imageVendorArray = [];
    $idVendorArray = [];
    $hourCancels = [];
    $saved = [];
    $payVendorAdult = [];
    $payVendorChild = [];
    $payVendorInfant = [];
    $priceAdultArray = [];
    $priceChildArray = [];
    $priceInfantArray = [];
    $originalPriceAdult = [];
    $originalPriceKid = [];
    $saved = [];
    $forHowManyPersonsIsArray = [];
    foreach ($cart as $arrayVouchersWant) {
        $idVendorDisplayed = $arrayVouchersWant[0]->getIdVendor();
        $arrayPrices = getVendorForCart($conn, $arrayVouchersWant[0]->getIdVendorVoucher(), $idLanguage);
        $priceAdult = $arrayPrices[0];
        $priceChild = $arrayPrices[1];
        $priceInfant = $arrayPrices[2];
        $imageVendor = $arrayPrices[3];
        $dateVoucher = $arrayPrices[4];
        $nameVendor = $arrayPrices[5];
        $hourCancel = $arrayPrices[6];
        $discount = $arrayPrices[7];
        $originalPrice = $arrayPrices[8];
        $forHowManyPersonsIs = $arrayPrices[9];
        $priceKidVendor = $arrayPrices[10];

        $totalToPayAdultToVendor = $originalPrice - ($originalPrice * ($discount / 100)) - $priceAdult;
        $percentPayedToVendor = $totalToPayAdultToVendor / $priceAdult;
        $totalToPayKidToVendor = $priceKidVendor - ($priceKidVendor * ($discount / 100)) - $priceChild;
        $totalToPayInfantToVendor = $percentPayedToVendor * $priceInfant;


        $adults = 0;
        $children = 0;
        $infants = 0;
        $totalPay = 0;
        foreach ($arrayVouchersWant as $voucherWant) {
            if ($voucherWant->isAdult()) {
                $voucherWant->setPrice($priceAdult + $voucherWant->getNumberOfInfant() * $priceInfant);
            } else {
                $voucherWant->setPrice($priceChild);

            }
            $totalPay = $totalPay + $voucherWant->getPrice();
            array_push($allVouchers, $voucherWant);
            $infants = $infants + $voucherWant->getNumberOfInfant();
            $voucherWant->isAdult() ? $adults = $adults + 1 : $children = $children + 1;
        }

        array_push($originalPriceAdult, $originalPrice);
        array_push($originalPriceKid, $priceKidVendor);
        array_push($idVendorArray, $idVendorDisplayed);
        array_push($nameVendorArray, $nameVendor);
        array_push($dateVoucherArray, $dateVoucher);
        array_push($adultsArray, $adults);
        array_push($childrenArray, $children);
        array_push($infantsArray, $infants);
        array_push($imageVendorArray, $imageVendor);
        $amountPay = $priceAdult * $adults + $priceChild * $children + $priceInfant * $infants;
        array_push($amountPayArray, $amountPay);
        array_push($hourCancels, $hourCancel);

        array_push($payVendorAdult, $totalToPayAdultToVendor);
        array_push($payVendorChild, $totalToPayKidToVendor);
        array_push($payVendorInfant, $totalToPayInfantToVendor);
        array_push($priceAdultArray, $priceAdult);
        array_push($priceChildArray, $priceChild);
        array_push($priceInfantArray, $priceInfant);
        array_push($saved, ($discount / 10) * $totalPay);
        array_push($forHowManyPersonsIsArray, $forHowManyPersonsIs);
    }
    //sort from bigger to smaller
    usort($allVouchers, function ($a, $b) {
        return $b->getPrice() - $a->getPrice();
    });
    return array(
        'allVouchers' => $allVouchers,
        'nameVendor' => $nameVendorArray,
        'dateVoucher' => $dateVoucherArray,
        'imageVendor' => $imageVendorArray,
        'adults' => $adultsArray,
        'children' => $childrenArray,
        'infants' => $infantsArray,
        'amountPay' => $amountPayArray,
        'hourCancels' => $hourCancels,
        'vendorId' => $idVendorArray,
        'payVendorAdult' => $payVendorAdult,
        'payVendorChild' => $payVendorChild,
        'payVendorInfant' => $payVendorInfant,
        'priceAdultArray' => $priceAdultArray,
        'priceChildArray' => $priceChildArray,
        'priceInfantArray' => $priceInfantArray,
        'saved' => $saved,
        'forHowManyPersonsIsArray' => $forHowManyPersonsIsArray,
        'originalPriceAdult' => $originalPriceAdult,
        'originalPriceKid' => $originalPriceKid
    );
}

function calculatePriceCart($conn, $arrayVouchers)
{
    $menu = GetMenu($conn, $_SESSION["languageId"]);

    $canOrder = true;
    if (count($arrayVouchers) < 2 || count($arrayVouchers) > \ValuePass\Cart::$MAX_VOUCHERS) {
        $canOrder = false;
    }
    if (count($arrayVouchers) == 1) {
        $idVendorVoucherOneItem = $arrayVouchers[0]->getIdVendorVoucher();
        $forHowManyPersonIs = checkIfIsGroupVendorVoucher($conn, $idVendorVoucherOneItem);
        if ($forHowManyPersonIs > 1) {
            $canOrder = true;
        }
    }
    $lengthHowManyPay = count($arrayVouchers);
    if (count($arrayVouchers) <= 3) {
        $lengthHowManyPay = count($arrayVouchers);
    } elseif (count($arrayVouchers) <= 5) {
        $lengthHowManyPay = count($arrayVouchers) - 1;
    } elseif (count($arrayVouchers) <= 7) {
        $lengthHowManyPay = count($arrayVouchers) - 2;
    } elseif (count($arrayVouchers) <= 9) {
        $lengthHowManyPay = count($arrayVouchers) - 3;
    } else { //we do not care if more than 11, he cannot order
        $lengthHowManyPay = count($arrayVouchers) - 4;
    }
    $totalToPay = 0;
    $less = 0;
    for ($counter = 0; $counter < count($arrayVouchers); $counter++) {
        if ($counter + 1 <= $lengthHowManyPay) {
            $totalToPay = $totalToPay + $arrayVouchers[$counter]->getPrice();
        } else {
            $less = $less + $arrayVouchers[$counter]->getPrice();
        }
    }
    //there is no case of 0 Vouchers
    if (count($arrayVouchers) == 1) {
        if ($canOrder) {
            $messageModal = $menu[164] . '  ' . count($arrayVouchers) . ' ' . $menu[165] . ' ' . $menu[166] . ' 2 ' . $menu[167] . ' 
          3 ' . $menu[168] . ' 4 Vouchers ' . $menu[169];
        } else {
            $messageModal = $menu[114];
        }
    } elseif (count($arrayVouchers) == 2) {
        $messageModal = $menu[164] . '  ' . count($arrayVouchers) . ' ' . $menu[165] . ' ' . $menu[166] . ' 2 ' . $menu[167] . ' 
          1 ' . $menu[168] . ' 4 Vouchers ' . $menu[169];
    } elseif (count($arrayVouchers) == 3) {
        $messageModal = $menu[164] . ' ' . count($arrayVouchers) . ' ' . $menu[165] . ' ' . $menu[166] . ' 1 ' . $menu[167] . ' 
          1 ' . $menu[168] . ' 4 Vouchers ' . $menu[169];
    } elseif (count($arrayVouchers) == 4) {
        $messageModal = $menu[164] . ' ' . count($arrayVouchers) . ' ' . $menu[165] . ' 
        1 Voucher ' . $menu[169];
    } elseif (count($arrayVouchers) == 5) {
        $messageModal = $menu[164] . ' ' . count($arrayVouchers) . ' ' . $menu[165] . ' ' . $menu[166] . ' 1 ' . $menu[167] . ' 
          2 ' . $menu[168] . ' 6 Vouchers ' . $menu[169];
    } elseif (count($arrayVouchers) == 6) {
        $messageModal = $menu[164] . ' ' . count($arrayVouchers) . ' ' . $menu[165] . ' 
        2 Vouchers ' . $menu[169];
    } elseif (count($arrayVouchers) == 7) {
        $messageModal = $menu[164] . ' ' . count($arrayVouchers) . ' ' . $menu[165] . ' ' . $menu[166] . ' 1 ' . $menu[167] . ' 
           3 ' . $menu[168] . ' 8 Vouchers ' . $menu[169];
    } elseif (count($arrayVouchers) == 8) {
        $messageModal = $menu[164] . ' ' . count($arrayVouchers) . ' ' . $menu[165] . '
          3 Vouchers ' . $menu[169];
    } elseif (count($arrayVouchers) == 9) {
        $messageModal = $menu[164] . ' ' . count($arrayVouchers) . ' ' . $menu[165] . ' ' . $menu[166] . ' 1 ' . $menu[167] . ' 
            4 Vouchers ' . $menu[169];
    } elseif (count($arrayVouchers) == 10) {
        $messageModal = $menu[164] . ' ' . count($arrayVouchers) . ' ' . $menu[165] . '
          4 Vouchers ' . $menu[169];
//        You can select 1 more voucher || MESSAGE ABOVE
    } else { // 11 vouchers
        $messageModal = $menu[164] . ' ' . count($arrayVouchers) . ' ' . $menu[165] .
            $menu[173] . '4 Vouchers ' . $menu[169] . ' ' . $menu[171];
    }

    return array(
        'totalPay' => $totalToPay,
        'moneyEarned' => $less,
        'vouchersPay' => $lengthHowManyPay,
        'canOrder' => $canOrder,
        'messageModal' => $messageModal
    );
}


function getTemplateVoucher($package = [], $adults = 0, $children = 0, $infants = 0, $idVendor = 0, $nameVendor = '', $numberOfPackages = 1)
{
    $greekMonths = array('Ιανουαρίου', 'Φεβρουαρίου', 'Μαρτίου', 'Απριλίου', 'Μαΐου', 'Ιουνίου', 'Ιουλίου', 'Αυγούστου', 'Σεπτεμβρίου', 'Οκτωβρίου', 'Νοεμβρίου', 'Δεκεμβρίου');
    if ($_SESSION["languageId"] == 2) {
        $message1 = "Unfortunately no Vouchers found for that day";
    } else {
        $message1 = "Δυστυχώς, δεν βρέθηκαν διαθέσιμα vouchers για αυτή την ημερομηνία";
    }

    if (count($package) == 0) {
        $message = "<div class='col-lg-12 vouchertemplate2'>";
        $message .= " <div class='container'> <div  class='row'> ";
        $message .= "   <div class='col'><div style='min-height: 5px;'></div> ";
        $message .= "  <div class='title '>";
        $message .= "  </div> ";
        $message .= " </div> ";
        $message .= " </div> ";
        $message .= " <div class='row border-bottom'> ";
        $message .= " <div class='col-12'> ";
        $message .= "  <div class='price text-center'> ";
        $message .= " <h5>$message1</h5>";
        $message .= " </div> ";
        $message .= "</div> ";
        return $message;
    }

    $VoucherId = $package[0];
    $date = $package[1];
    $priceAdult = $package[2];
    $priceKid = $package[3];
    $priceInfant = $package[4];
    $hourCancel = $package[5];
    $discount = $package[6];
    $originalPrice = $package[7];
    $forHowManyPersonsIs = $package[8];
    $priceKidVendor = $package[9];
    $starterVouchers = $package[10];
    $existenceVoucher = $package[11];


    if ($_SESSION["languageId"] == 2) {
        $message1 = "Unfortunately no Vouchers found for that day";
        $message2 = "Add to Cart";
        $message3 = "Experience Name: ";
        $message4 = "Day: ";
        $message5 = "Starting Time: ";
        $message6 = "Price Breakdown  ";
        $message6a = "ValuePass Voucher Price";
        $message6b1 = "Pay ";
        $message6b2 = " later";
        $message6b3 = " at your Activity Location";
        if ($forHowManyPersonsIs == 99) {
            $message7 = " Group: ";
        } else if ($forHowManyPersonsIs > 1) {
            $message7 = " Group of " . $forHowManyPersonsIs;
        } else {
            $message7 = " Adults: ";
        }

        $message8 = " Children: ";
        $message9 = " Infants: ";
        $message10 = " Total VP Voucher Price ";
        $message11 = "All taxes and fees included ";
        $message12 = "Date ";
        $message13 = "You can cancel your activity before ";
        $message14 = "by supplier Cancellation policy";
        $message15 = "ValuePass vouchers are not cancelled, but we are always looking to offer you the best alternative
        solutions regarding the activity providers we promote if something goes wrong. You will find more information
        in your confirmation email.";
        $message16 = "Vouchers Available ";
    } else {
        $message1 = "Δυστυχώς, δεν βρέθηκαν διαθέσιμα vouchers για αυτή την ημερομηνία";
        $message2 = "Προσθήκη στο καλάθι";
        $message3 = "Ονομασία Εμπειρίας: ";
        $message4 = "Ημέρα: ";
        $message5 = "Ώρα Έναρξης: ";
        $message6 = "Ανάλυση Τιμής";
        $message6a = "Τιμή VP Voucher";
        $message6b1 = "Πληρώστε ";
        $message6b2 = " αργότερα ";
        $message6b3 = " την δραστηριότητα";

        if ($forHowManyPersonsIs == 99) {
            $message7 = " Group: ";
        } else if ($forHowManyPersonsIs > 1) {
            $message7 = " Group με " . $forHowManyPersonsIs . " άτομα ";
        } else {
            $message7 = " Ενήλικες: ";
        }
        $message8 = " Παιδιά: ";
        $message9 = " Μωρά: ";
        $message10 = "Σύνολο Τιμής VP Voucher ";
        $message11 = "Περιλαμβάνονται όλοι φόροι";
        $message12 = "Ημερομηνία";

        $message13 = "Μπορείς να ακυρώσεις τη δραστηριότητα μέχρι τις ";
        $message14 = "σύμφωνα με την πολιτική ακύρωσης του προμηθευτή";
        $message15 = "Τα ValuePass vouchers δεν παρέχουν τη δυνατότητα ακύρωσης και επιστροφής χρημάτων, 
        ωστόσο πάντα προσπαθούμε να σας προσφέρουμε τις καλύτερες εναλλακτικές λύσεις σύμφωνα με τις δυνατότητες
         των προμηθευτών των δραστηριοτήτων που προωθούμε, σε περίπτωση μη πραγματοποίησης της δραστηριότητας.";
        $message16 = " Διαθέσιμα Vouchers Σήμερα ";

    }


    $totalPrice = $priceAdult * $adults + $priceKid * $children + $priceInfant * $infants;

    $totalToPayAdultToVendor = $originalPrice - ($originalPrice * ($discount / 100)) - $priceAdult;
    $percentPayedToVendor = $totalToPayAdultToVendor / $priceAdult;
    $totalToPayKidToVendor = $priceKidVendor - ($priceKidVendor * ($discount / 100)) - $priceKid;

    $totalToPayInfantToVendor = $percentPayedToVendor * $priceInfant;

    //echo date('M jS', $timeStampCancel)
    $dateTimestamp = strtotime($date);
    $day = date('d/m', $dateTimestamp);
    if ($_SESSION["languageId"] == 2) {
        $hour = date('h:i A', $dateTimestamp);
    } else { //greek language fixme when new languages added
        $hour = date('h:i ', $dateTimestamp) . (date('A', $dateTimestamp) == 'AM' ? 'π.μ.' : 'μ.μ.');
    }
    $button = '';
    $message = '';
    if ($numberOfPackages > 1) {
        $button = "<div class='btn buy_button '  data-bs-toggle='collapse'
     data-bs-target='#multiCollapseExample{$VoucherId}'  role='button' aria-expanded='false' 
     aria-controls='multiCollapseExample{$VoucherId}'><a>  <span class='vpicon' > VP </span> $message5  $hour </a></div>";

        $message = "<div class=' collapse ' data-parent='#optionbuttons' id='multiCollapseExample{$VoucherId}' >";
    }


    $message .= "<div class='col-12 vouchertemplate '   >";
    $message .= " <div class='container '> <div  class='row'> ";
    $message .= "   <div class='col-12'><div style='min-height: 5px;'></div> ";
    $message .= "  <div class='title '>";
    $message .= "  <h4> <span style='color: black'>$message3 </span> $nameVendor </h4> ";
    $message .= "  <h4> <span style='color: black'>PRICE KID </span> $priceKidVendor </h4> ";
    $message .= "  </div> ";
    $message .= " </div> ";
    $message .= " </div> ";

    $message .= " <div class='row border-bottom'> ";
    $message .= " <div class='col-12 col-lg-12 d-flex justify-content-between'> ";
    $message .= "  <div class='price '> ";
    $message .= " <h5> $message12 </h5> ";
    $message .= " <ul> ";
    $message .= " <li> $message4  <b> $day </b></li>";
    $message .= " <li> $message5 <b> $hour </b></li> ";
    $message .= " </ul> ";
    $message .= " </div> ";
        $message .= " <div> <p class='voucher_av'>$message16 <b> $existenceVoucher/$starterVouchers</b> </p> </div>";
    $message .= " </div> ";
    $message .= "</div> ";

    $message .= " <div class='row border-bottom'> ";
    $message .= " <div class='col-12 col-lg-12'> ";
    $message .= "  <div class='pricebreakdown2'> ";
    $message .= " <h5>$message6 </h5> ";
//    $message .= " <h6 class='fw-bolder' >$message6a </h6> ";
    if ($_SESSION['languageId'] == 1){
        $message .= '<h6 class="fw-bolder"> Τιμή  <span class="vpicon">VP </span> Voucher </h6>';
    }else{
        $message .= '<h6 class="fw-bolder"> <span class="vpicon">VP </span> Vouchers Price </h6>' ;
    }
    $message .= " <ul class='border-bottom m-0'> ";
    if ($adults != 0) {
        $totalAdultPrice = $adults * $priceAdult;
        $message .= " <li class='d-flex justify-content-between'> <div> $message7 <b>$adults  </b> x <span> $priceAdult €</span> </div> 
                    <div><p class='vpicon m-0 '> $totalAdultPrice  € </p> </div> </li> ";
    }
    if ($children != 0) {
        $totalChildrenPrice = $children * $priceKid;
        $message .= " <li class='d-flex justify-content-between'> 
 <div>  $message8 <b> $children </b> x <span> $priceKid €</span> </div> 
 <div> <p class='vpicon m-0 '> $totalChildrenPrice  €  </p> </div> </li> ";
    }
    if ($infants != 0) {
        $totalInfantPrice = $infants * $priceInfant;
        $message .= " <li class='d-flex justify-content-between'>
  <div>  $message9 <b> $infants  </b> x <span> $priceInfant € </span> </div>
  <div>  <p class='vpicon m-0 '> $totalInfantPrice  €  </p> </div>
  </li> ";

    }

    $message .= " </ul> ";
    $message .= " <h6 class='fw-bolder'>$message6b1  <span class='laterText'> $message6b2 </span>  $message6b3</h6> ";
    $message .= " <ul> ";
    if ($adults != 0) {
        $totalAdultPriceVendor = $adults * $totalToPayAdultToVendor;
        $totalExAdult = $adults * $originalPrice;
        $message .= " <li class='d-flex justify-content-between'>
  <div>  $message7 <b>$adults  </b> x <span> $totalToPayAdultToVendor €</span> </div>
   <div><span class='exprice'>$totalExAdult € </span>  <span class='real-price '> $totalAdultPriceVendor  €  </span> </div>
   </li> ";
    }
    if ($children != 0) {
        $totalChildrenPriceVendor = $children * $totalToPayKidToVendor;
        $totalExChildren = $children * $priceKid;
        $message .= " <li class='d-flex justify-content-between'>
  <div>  $message8 <b> $children </b> x <span> $totalToPayKidToVendor €</span> </div>
   <div><span class='exprice'>$totalExChildren  € </span>  <span class='real-price'> $totalChildrenPriceVendor  €  </span> </div>
   </li> ";
    }
    if ($infants != 0) {
        $totalInfantPriceVendor = $infants * $totalToPayInfantToVendor;
        $message .= " <li class='d-flex justify-content-between'> 
 <div>  $message9 <b> $infants  </b> x <span> $totalToPayInfantToVendor € </span> </div>
   <div>  <p class='fw-bolder m-0 '> $totalInfantPriceVendor  €  </p> </div>
 </li> ";
    }


    $cancelTimestamp = strtotime($date) - 3600 * $hourCancel;
    if ($_SESSION["languageId"] == 2) {
        $cancelDate = date('h:i A F jS ', $cancelTimestamp);
    } else { //greek language fixme when new languages added
        $cancelDate = date('h:i  ', $cancelTimestamp)
            . (date('A', $cancelTimestamp) == 'AM' ? 'π.μ.' : 'μ.μ.')
            . date(' j ', $cancelTimestamp)
            . $greekMonths[intval(date('m', $cancelTimestamp)) - 1];
    }

    $message .= " </ul> ";
    $message .= " </div> ";
    $message .= "</div> ";

    $message .= " <div class='col-12 price '> ";
    $message .= "     <h5 class='fw-bolder'>$message10 </h5> ";
    $message .= "   <h4 class='vpicon'> $totalPrice € </h4> ";
    $message .= "</div> ";


    $message .= " <div class='col-12 lastsection'> ";
    $message .= " <div class='price'> ";

    $message .= " <small> $message11</small>  ";
    $message .= " <p><i class='icon_calendar'></i> $message13 <b> $cancelDate </b> $message14   </p> ";
    $message .= "<p> <b class='vpicon'>VP </b> $message15  </p> ";
    $message .= " </div> ";
    $message .= "   <div class='addtocartsection'> ";
    $message .= "  <button class='btn btn-primary 'data-bs-toggle='modal' data-bs-target='#questionmodal' onclick=\"addToCart({'voucherVendorId': $VoucherId ,'adults': $adults, 'children': $children, 'infants': $infants, 'idVendor': $idVendor});\"> $message2 </button> </div>";
    $message .= "  </div> ";
    $message .= " </div> ";
    $message .= "  </div> ";

    $message .= " </div> ";
    $message .= " </div> ";

    if ($numberOfPackages > 1) {
        $message .= " </div> ";
    }
    return [$message, $button];

}

function getAvailableVendorVoucher($conn, $arrayIVendorVoucherWithAmount)
{
    $query = "SELECT VV.id
            FROM VendorVoucher AS VV
            WHERE VV.id = ? AND VV.existenceVoucher >= ?;";
    $stmt = $conn->prepare($query);
    $idVendorVoucher = $amountVouchers = 0;
    $stmt->bind_param('ii', $idVendorVoucher, $amountVouchers);
    $vendorVouchers = [];
    foreach ($arrayIVendorVoucherWithAmount as $idVendorVoucher => $amountVouchers) {
        $id = 0;
        $stmt->execute();
        $stmt->bind_result($id);
        while ($stmt->fetch()) {
        }
        if ($id != 0) {
            array_push($vendorVouchers, $idVendorVoucher);
        }
    }
    $stmt->close();
    return $vendorVouchers;

}

function checkIfIsGroupVendorVoucher($conn, $idVendorVoucher)
{
    $query = "SELECT V.forHowManyPersonsIs
            FROM VendorVoucher AS VV, Vendor AS V
            WHERE VV.idVendor = V.id
                AND VV.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $idVendorVoucher);
    $forHowManyPersonIs = 0;
    if ($stmt->execute()) {
        $stmt->bind_result($forHowManyPersonIs);
        while ($stmt->fetch()) {
        }
    }
    $stmt->close();
    return $forHowManyPersonIs;

}

