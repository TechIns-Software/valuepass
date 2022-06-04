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
    $querySelections = "SELECT V.id, V.priceAdult, V.originalPrice, V.discount,
    V.priceKid, V.image, VT.name, VT.descriptionSmall, CV.name, C.id ";
    $querySelections .= " FROM Vendor AS V, VendorTranslate AS VT, CategoryVendor as CV,
                CategoryVendorTranslate CVT ";
    if ($isBestOff) {
        $querySelections .= " , BestOff AS BO, BestOffOrder AS BOO ";
    }
    $querySelections .= " WHERE V.idDestination = ? AND VT.idLanguage = ? AND V.id = VT.idVendor
                AND CV.id = V.idCategory AND CV.id = CVT.idCategoryVendor ";
    if ($isBestOff) {
        $querySelections = $querySelections
            ." V.id = BO.idVendor AND BOO.idBestOff = BO.id 
            ORDER BY BOO.number ASC";
    }
    $stmt = $conn->prepare($querySelections);
    $stmt->bind_param('ii', $idDestination, $idLanguage);
    $vendors = [];
    if ($stmt->execute()) {
        $id = $priceAdult = $originalPrice = $discount = $priceKid = $image = $name = $description = $categoryName = $categoryId = '';
        $stmt->bind_result($id, $priceAdult, $originalPrice, $discount, $priceKid, $image, $description, $name, $categoryName);
        while ($stmt->fetch()) {
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
                    $vendor->addRatedCategory($nameRated, $stars);
                }
            }

            //TODO vouchers available;
            $query3 = "";




        }
        array_push($vendors, $vendor);
    }
    return $vendors;
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


