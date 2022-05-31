<?php
//$mysqli -> real_escape_string(escapestring)
function getDestinations($conn) : array{
    $query1 = "SELECT id, name, description, image1 FROM Destination ORDER BY id ASC;";
    $query2 = "SELECT SUM(id), idDestination FROM Vendor GROUP BY idDestination ORDER BY idDestination ASC;";
    $stmt1 = $conn->prepare($query1);
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

function getDestination($conn) : \ValuePass\Destination{
    $query = "SELECT id, name, description, image2 FROM Destination;";
    $stmt = $conn->prepare($query);
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

function getBestOff($conn, $idDestination) : array{
    $idDestination = $conn->real_escape_string($idDestination);
    $vendors = getVendors($conn, $idDestination, isBestOff: true);

}

function getVendors($conn, $idDestination, $isBestOff = false) : array {
    $idDestination = $conn->real_escape_string($idDestination);
    $querySelections = "SELECT V.id, V.name, V.originalPrice, V.discount, V.priceAdult, V.image, C.name ";
    if ($isBestOff) {
        $query = $querySelections
            ." FROM Vendor AS V, BestOff AS B, OrderBestOff AS O WHERE V.id = B.idVendor AND O.idBestOff = B.id AND V.idDestination = ? AND C.id = V.idCategory  ORDER BY O.number ASC";
    } else {
        $query = $querySelections ." FROM Vendor AS V, CategoryVendor as C WHERE V.idDestination = ? AND C.id = V.idCategory";
    }
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $idDestination);
    $vendors = [];
    if ($stmt->execute()) {
        $id = $name = $originalPrice = $discount = $priceAdult = $image = $categoryName = '';
        $stmt->bind_result($id, $name, $originalPrice, $discount, $priceAdult, $image, $categoryName);
        while ($stmt->fetch()) {
            $vendor = New \ValuePass\Vendor(
                $id, $name, $idDestination, $image, $priceAdult,
                $discount, $originalPrice, $categoryName
            );
            $query1 = "SELECT LB.name FROM LabelsBox LB, VendorLabelsBox AS VLB WHERE VBX.idVendor = $id AND LB.id = VBX.idLabelsBox ORDER BY LB.order ASC;";
            $stmt1 = $conn->prepare($query1);
            if ($stmt1->execute()) {
                $nameLB = '';
                $stmt1->bind_result($nameLB);
                while ($stmt1->fetch()) {
                    $vendor->addLabelBoxName($nameLB);
                }
            }

            //TODO criteria what to show->add to vendor

            if (!$isBestOff) {

                $query2 = "SELECT image FROM VendorImages AS VI WHERE VI.id = $id;";
                $stmt2 = $conn->prepare($query2);
                if ($stmt2->execute()) {
                    $image = '';
                    $stmt2->bind_result($image);
                    while ($stmt2->fetch()) {
                        $vendor->addImage($image);
                    }
                }


                //TODO vouchers available;
                $query2 = "";

            }





        }
        array_push($vendors, $vendor);
    }
    return $vendors;
}


function getCategoriesVendors($conn, $idDestination) : array {
    $idDestination = $conn->real_escape_string($idDestination);
    $query = "SELECT C.id, C.name FROM Vendor AS V, CategoryVendor AS C WHERE V.idCategory = C.id AND V.idDestination = ?";
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


