<?php
//$mysqli -> real_escape_string(escapestring)
function getDestinations($conn, $idLanguage, $idDestination = 0) : array{
    if ($idDestination != 0) {
        $addition = " AND D.id = $idDestination ";
    } else {
        $addition = '';
    }
    $query1 = "SELECT D.id, DT.name, DT.description, D.image1, D.image2
                FROM Destination AS D, DestinationTranslate AS DT
                WHERE D.id = DT.idDestination AND DT.idLanguage = ?
                AND D.isOkForShowing = 1 $addition
                ORDER BY id ASC;";
    $query2 = "SELECT COUNT(id), idDestination FROM Vendor
                WHERE isOkForShowing = 1
                GROUP BY idDestination
                ORDER BY idDestination ASC;";
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
            $numberVendors = isset($sums[$counter]) ? intval($sums[$counter]) : 0;
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

function getDestination($conn, $idDestination, $idLanguage) : \ValuePass\Destination | null{
    $query = "SELECT D.id, DT.name, DT.description, D.image2
                FROM Destination AS D, DestinationTranslate AS DT
                WHERE D.id = $idDestination AND D.id = DT.idDestination
                  AND DT.idLanguage = $idLanguage AND D.isOkForShowing = 1";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        $id = $name = $description = $image2 = '';
        $stmt->bind_result($id, $name, $description, $image2);
        while ($stmt->fetch()) {}
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

function getVendors($conn, $idDestination, $idLanguage, $isBestOff = false) : array {
    $idDestination = $conn->real_escape_string($idDestination);
    if ($isBestOff) {
        $query0 = "SELECT V.id
            FROM Vendor AS V, BestOff AS BO
            WHERE V.idDestination = ? AND V.id = BO.idVendor AND V.isOkForShowing = 1";
    } else {
        $query0 = "SELECT V.id
            FROM Vendor AS V
            WHERE V.idDestination = ? AND V.isOkForShowing = 1";
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

function getVendor($conn, $idVendor, $idLanguage, $fullOption = true) : \ValuePass\Vendor | null{
    $query = "SELECT V.id, V.priceAdult, V.originalPrice, V.discount,
                        V.priceKid, V.idDestination, V.imageBasic, VT.name,
                        CVT.name, CV.id, V.forHowManyPersonsIs, V.googleMapsImage,
                        V.childAcceptance, V.infantTolerance
              FROM Vendor AS V, VendorTranslate AS VT, CategoryVendor as CV,
                        CategoryVendorTranslate CVT
              WHERE V.id = ? AND V.id = VT.idVendor AND VT.idLanguage = ?
                        AND CV.id = V.idCategory AND CV.id = CVT.idCategoryVendor
                        AND CVT.idLanguage = ?
                        AND V.isOkForShowing = 1";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('iii', $idVendor, $idLanguage, $idLanguage);
    if ($stmt->execute()) {
        $id = $priceAdult = $originalPrice = $discount = $priceKid = $idDestination = $image = $name = $categoryName = $categoryId = $forHowManyPersonsIs = $googleMapsImage = $childAcceptance = $infantTolerance = '';
        $stmt->bind_result($id, $priceAdult, $originalPrice, $discount, $priceKid, $idDestination, $image, $name, $categoryName, $categoryId, $forHowManyPersonsIs, $googleMapsImage, $childAcceptance, $infantTolerance);
        while ($stmt->fetch()) {}
        if (!$id) {
            return null;
        }
        $vendor = New \ValuePass\Vendor(
            $id, $categoryId, $categoryName, $idDestination, $priceAdult, $originalPrice,
            $discount, $priceKid, $image, $name, $forHowManyPersonsIs, $googleMapsImage,
            $childAcceptance, $infantTolerance
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

        $dayNumberToday = date('d');
        $monthNumberToday = intval(date('m')) + 1;
        $yearNumberToday = date('Y');
        $query3 = "SELECT VV.starterVouchers, VV.existenceVoucher
                FROM VendorVoucher AS VV
                WHERE VV.idVendor = $id
                AND day(VV.dateVoucher) = $dayNumberToday
                AND month(VV.dateVoucher) = $monthNumberToday
                AND year(VV.dateVoucher) = $yearNumberToday";
        $stmt3 = $conn->prepare($query3);
        if ($stmt3->execute()) {
            $starterVouchers = $existenceVoucher = 0;
            $stmt3->bind_result($starterVouchers, $existenceVoucher);
            while ($stmt3->fetch()) {}
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
                        $previousImportant = $headImportant;
                    }
                }
                if (isset($importantInformation)) {
                    $vendor->addImportantInformation($importantInformation);
                }
            }
        }


    }
    return $vendor;
}

function getCategoriesVendors($conn, $idLanguage, $idDestination) : array {
    $idDestination = $conn->real_escape_string($idDestination);
    $query = "SELECT DISTINCT(CV.id), CVT.name
            FROM Vendor AS V, CategoryVendor AS CV, CategoryVendorTranslate AS CVT
            WHERE CVT.idLanguage = $idLanguage AND CVT.idCategoryVendor = CV.id
            AND V.idDestination = ? AND V.idCategory = CV.id AND V.isOkForShowing = 1";
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
    $query = "SELECT VV.id, DATE_FORMAT(VV.dateVoucher, '%Y-%m-%d %H:%i:%s'),
            V.priceAdult, V.priceKid, V.infantPrice
            FROM VendorVoucher AS VV, Vendor AS V
            WHERE VV.idVendor = ? AND VV.existenceVoucher > ? AND DATE(VV.dateVoucher) = ?
            AND V.id = VV.idVendor AND V.isOkForShowing = 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $idVendor, $numberVoucher, $date);
    $possiblePackages = [];
    if ($stmt->execute()) {
        $id = $date1 = $priceAdult = $priceKid = $infantPrice = '-1';
        $stmt->bind_result($id, $date1, $priceAdult, $priceKid, $infantPrice);
        while ($stmt->fetch()) {
            array_push($possiblePackages, [$id, $date1, $priceAdult, $priceKid, $infantPrice]);
        }
    }
    return $possiblePackages;
}

function getVendorForCart($conn, $idVendorVoucher, $idLanguage) : array {
    $query = "SELECT V.priceAdult, V.priceKid, V.infantPrice, V.imageBasic, V.id, VV.dateVoucher
            FROM Vendor AS V, VendorVoucher AS VV
            WHERE VV.id = $idVendorVoucher AND VV.idVendor = V.id";
    $stmt = $conn->prepare($query);
    $priceAdult = $priceKid = $priceInfant = $imageBasic = $idVendor = $dateVoucher = -1;
    if ($stmt->execute()) {
        $stmt->bind_result($priceAdult, $priceKid, $priceInfant, $imageBasic, $idVendor, $dateVoucher);
        while ($stmt->fetch()) {}
    }
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


//Get all Languages
function getAllLanguages($conn)
{
    $query = "Select * FROM Language;";
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
    $query="SELECT m.id, mt.name
            FROM MenuTranslate as mt, Menu as m
            where mt.idMenu = m.id and mt.idLanguage = ?
            ORDER BY m.id;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $lang);

    if ($stmt->execute()) {
        $name = $idMenu = '';
        $stmt->bind_result($idMenu, $name);

        $menu= [];
        while ($stmt->fetch()) {
//            $menu[$idMenu - 1] = $name;
            array_push($menu, $name);
        }
    }
    return $menu;
}


function getLanguageIcon ($conn,$langId){
    $query = "Select icon FROM Language where id =$langId; ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $icon = '';
    $stmt->bind_result( $icon);
    $language_icon = '';
    while ($stmt->fetch()) {
        $language_icon = $icon;
    }
    $stmt->close();
    return $language_icon;
}


function createArrayVouchersSortedFromCart($conn, $cart, $idLanguage) {
    $allVouchers = [];

    $nameVendorArray = [];
    $dateVoucherArray = [];
    $adultsArray = [];
    $childrenArray = [];
    $infantsArray = [];
    $amountPayArray = [];
    $imageVendorArray = [];
    $idVendorArray = [];
    foreach ($cart as $arrayVouchersWant) {
        $idVendorDisplayed = $arrayVouchersWant[0]->getIdVendor();
        $arrayPrices = getVendorForCart($conn, $arrayVouchersWant[0]->getIdVendorVoucher(), $idLanguage);
        $priceAdult = $arrayPrices[0];
        $priceChild = $arrayPrices[1];
        $priceInfant = $arrayPrices[2];
        $imageVendor = $arrayPrices[3];
        $dateVoucher = $arrayPrices[4];
        $nameVendor = $arrayPrices[5];
        $adults = 0;
        $children = 0;
        $infants = 0;
        foreach ($arrayVouchersWant as $voucherWant) {
            if ($voucherWant->isAdult()) {
                $voucherWant->setPrice($priceAdult + $voucherWant->getNumberOfInfant() * $priceInfant);
            } else {
                $voucherWant->setPrice($priceChild);

            }
            array_push($allVouchers, $voucherWant);
            $infants = $infants + $voucherWant->getNumberOfInfant();
            $voucherWant->isAdult() ? $adults = $adults + 1 : $children = $children + 1;
        }
        array_push($idVendorArray, $idVendorDisplayed);
        array_push($nameVendorArray, $nameVendor);
        array_push($dateVoucherArray, $dateVoucher);
        array_push($adultsArray, $adults);
        array_push($childrenArray, $children);
        array_push($infantsArray, $infants);
        array_push($imageVendorArray, $imageVendor);
        $amountPay = $priceAdult * $adults + $priceChild * $children + $priceInfant * $infants;
        array_push($amountPayArray, $amountPay);
    }
    //sort from bigger to smaller
    usort($allVouchers, function($a, $b) {
        return $b->getPrice() - $a->getPrice();
    });
    return array(
        'allVouchers'=>$allVouchers,
        'nameVendor'=>$nameVendorArray,
        'dateVoucher'=>$dateVoucherArray,
        'imageVendor'=>$imageVendorArray,
        'adults'=>$adultsArray,
        'children'=>$childrenArray,
        'infants'=>$infantsArray,
        'amountPay'=>$amountPayArray,
        'vendorId'=>$idVendorArray
    );
}

function calculatePriceCart($arrayVouchers) {
    $canOrder = true;
    if (count($arrayVouchers) < 2 || count($arrayVouchers) > 11) {
        $canOrder = false;
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
    return array(
        'totalPay'=>$totalToPay,
        'moneyEarned'=>$less,
        'vouchersPay'=>$lengthHowManyPay,
        'canOrder'=>$canOrder
    );
}


function getTemplateVoucher($package = [], $adults = 0, $children = 0, $infants = 0, $idVendor = 0, $nameVendor = '') {
    if (count($package) == 0) {
        $message = "<div class='col-lg-12 vouchertemplate2'>";
        $message .= " <div class='container'> <div  class='row'> ";
        $message .=   "   <div class='col'><div style='min-height: 5px;'></div> ";
        $message .=       "  <div class='title '>";
        $message .=      "  </div> ";
        $message .=   " </div> ";
        $message .=  " </div> ";
        $message .=  " <div class='row border-bottom'> ";
        $message .=      " <div class='col-12'> ";
        $message .=       "  <div class='price text-center'> ";
        $message .=          " <h5> Unfortunately no Vouchers found for that day </h5> ";
        $message .=  " </div> ";
        $message .=  "</div> ";
        return $message;
    }

    $VoucherId = $package[0];
    $date = $package[1];
    $priceAdult = $package[2];
    $priceKid = $package[3];
    $priceInfant = $package[4];
    $totalPrice = $priceAdult * $adults + $priceKid * $children + $priceInfant * $infants;
// $message = "<div class='col-lg-12  vouchertemplate'>" ;

// $message .= "<div class='title'> <h4>  Experience Name $VoucherId  </h4> </div> <div class='pricebreakdown'> <h5>Price Breakdown </h5> <ul>";
//     $message .= " <li> Adults  : <b>$adults  x </b> <span> 5 €</span>   </li>";
//     $message .=  "<li> Children  : <b> $children  x</b>  <span> 15 €</span> </li>";
//     $message .= "<li>  Infants  : <b> $infants x </b </li>  <span> 40 €</span> </ul> </div> <div class='price'>";
//     $message .= "  <h5 >Price <b>  €</b> <br> <small>All taxes and fees included</small>   </h5></div> <div class='addtocartsection'>";
//     $message .= "  <button onclick=\"addToCart({'voucherVendorId': $VoucherId ,'adults': $adults, 'children': $children, 'infants': $infants, 'idVendor': $idVendor});\">Add To Cart</button> </div>" ;
//     $message .= " </div>";

    $day = substr($date, 0, 10);
    $hour = substr($date, 11);

    $message = "<div class='col-lg-12 vouchertemplate2'>";
    $message .= " <div class='container'> <div  class='row'> ";
    $message .=   "   <div class='col'><div style='min-height: 5px;'></div> ";
    $message .=       "  <div class='title '>";
    $message .=        "  <h4> <span style='color: black'>Experience Name: </span> $nameVendor </h4> ";
    $message .=      "  </div> ";
    $message .=   " </div> ";
    $message .=  " </div> ";

    $message .=  " <div class='row border-bottom'> ";
    $message .=      " <div class='col-12'> ";
    $message .=       "  <div class='price text-center'> ";
    $message .=          " <h5> Date </h5> ";
    $message .=          " <ul> ";
    $message .=             " <li> Day : <b> $day </b></li>";
    $message .=             " <li> Hour : <b> $hour </b></li> ";
    $message .=     " </ul> ";
    $message .=  " </div> ";
    $message .=  "</div> ";

    $message .=  " <div class='row border-bottom'> ";
    $message .=      " <div class='col-8  py-2'> ";
    $message .=       "  <div class='pricebreakdown2'> ";
    $message .=          " <h5>Price Breakdown </h5> ";
    $message .=          " <ul> ";
    $message .=             " <li> Adults : <b>$adults  </b> x <span> $priceAdult €</span> </li> ";
    if ($children != 0) {
        $message .=             " <li> Children : <b> $children </b> x <span> $priceKid €</span> </li> ";
    }
    if ($infants != 0) {
        $message .=         " <li> Infants : <b> $infants  </b> x <span> $priceInfant € </span></li> ";
    }
    $message .=     " </ul> ";
    $message .=  " </div> ";
    $message .=  "</div> ";
    $message .= " <div class='col  py-2'> ";
    $message .=  " <div class='price'> ";
    $message .=    "     <h5 >Total Price  </h5> ";
    $message .=     "   <h4> $totalPrice € </h4> ";
    $message .=      " <small> All taxes and fees included</small>  ";
    $message .=  " </div> ";
    $message .=   " </div> ";
    $message .=  "  </div> ";

    $message .=  " <div class='row'> ";
    $message .=   "  <div class='col'> ";
    $message .=     "   <div class='addtocartsection'> ";
    $message .=     "  <button onclick=\"addToCart({'voucherVendorId': $VoucherId ,'adults': $adults, 'children': $children, 'infants': $infants, 'idVendor': $idVendor});\">Add To Cart</button> </div>" ;
    $message .=   "  </div> ";
    $message .=   " </div> ";

    $message .=   " </div> ";
    $message .=   " </div> ";
    $message .=  " </div> ";
    return $message ;

}

function getAvailableVendorVoucher($conn, $arrayIVendorVoucherWithAmount) {
    $query = "SELECT VV.id
            FROM VendorVoucher AS VV
            WHERE VV.id = ? AND VV.existenceVoucher > ?;";
    $stmt = $conn->prepare($query);
    $idVendorVoucher = $amountVouchers = 0;
    $stmt->bind_param('ii', $idVendorVoucher, $amountVouchers);
    $vendorVouchers = [];
    foreach ($arrayIVendorVoucherWithAmount as $idVendorVoucher => $amountVouchers) {
        $id = 0;
        $stmt->execute();
        $stmt->bind_result($id);
        while ($stmt->fetch()) {}
        if ($id != 0) {
            array_push($vendorVouchers, $idVendorVoucher);
        }
    }
    $stmt->close();
    return $vendorVouchers;

}
