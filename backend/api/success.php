<?php
//TODO: who makes the call
if (!isset($conn)) {
    include '../../connection.php';
}
$_POST['digest'];
//check if order id exists
$orderId = $_POST['orderId'];
//TODO: validate who sends us, dunno maybe from digest

/*
 * NOTE: change status of paid order
 */
$query1 = "UPDATE Order
        SET isPaid = 1
        WHERE id = $orderId ;";
$stmt1 = $conn->prepare($query1);
$affectedRows = $conn->affected_rows;
$stmt1->execute();
$stmt1->close();
if ($affectedRows == 1) {
} else {
    exit('Something went wrong! 
    If you have made paid and you do not get your tickets, 
    then you can talk to our support team');
}
/*
 * NOTE: Taking client info while check arguments
 */
$validateAndIdentifyOrderFlag = false;
$query0 = "SELECT U.id, U.name, U.email
        FROM Order AS O, User AS U
        WHERE O.idUser = U.id AND O.id = $orderId ;";
$stmt0 = $conn->prepare($query0);
if ($stmt0->execute()) {
    $idUser = $userName = $userEmail = '';
    $stmt0->bind_result($idUser, $userName, $userEmail);
    while ($stmt0->fetch()) {
        $validateAndIdentifyOrderFlag = true;
    }
}
$stmt0->close();
if (!$validateAndIdentifyOrderFlag) {
    exit('Something went wrong! 
    If you have made paid and you do not get your tickets, 
    then you can talk to our support team');
}
/*
 * NOTE: Get OrderVendorVoucher (info about vouchers needed)
 */
$query20 = "SELECT OVV.id, OVV.idVendorVoucher, OVV.isAdult, OVV.numberInfants
            FROM OrderVendorVoucher AS OVV
            OVV.idOrder = $orderId ;";
$stmt20 = $conn->prepare($query20);
$arrayOrderVendorVouchers = [];
if ($stmt20->execute()) {
    $idOOV = $idVendorOVV = $isAdultOVV = $numberInfantsOOV = '';
    $stmt20->bind_result($idOOV, $idVendorOVV , $isAdultOVV, $numberInfantsOOV);
    while ($stmt20->fetch()) {
        array_push(
            $arrayOrderVendorVouchers,
            [$idOOV, $idVendorOVV , $isAdultOVV, $numberInfantsOOV]
        );
    }
}
$stmt20->close();
//step 2-> VendorVoucher decrease reserved number
/*
 * NOTE: inform VendorVoucher table
 * Step One: Keep what Vouchers the client has reserved =>$idsOrderVendorVouchers
 * Step Two: Gather them to one array for each VendorVoucher record => $idVendorVoucherAndAmounts
 * Step Three: Update VendorVoucher table
 */
$idsOrderVendorVouchers = array_map(
    'callbackFunctionGetSpecificElementsFromMultiDimensionArray',
    $arrayOrderVendorVouchers
);
$idVendorVoucherAndAmounts = array_map(
    'gatherIdVendorVouchers',
    $idsOrderVendorVouchers
);
foreach ($idVendorVoucherAndAmounts as $idVendorVoucher => $amount) {
    $query3 = "UPDATE VendorVoucher
            SET reserved = reserved - $amount
            WHERE id = $idVendorVoucher";
    $stmt3 = $conn->prepare($query3);
    $stmt3 -> execute();
    $stmt3->close();
}

//step 3-> Create Voucher rows and send email and somehow to one our page
/*
 * NOTE: Create Voucher rows
 */
$query4 = "INSERT INTO Voucher(
                    idVendorVoucher, idVendor, idOrder, isAdult, infantNumber) ";
$flagFirstVoucher = true;
$vouchersAdditionValuesString = "";
foreach ($arrayOrderVendorVouchers as $arrayOfVoucher) {
    //FIXME: check numberInfants to be 0 otherwise 0 insert
    $idVendorVoucher = $arrayOfVoucher[0];
    $idVendor = $arrayOfVoucher[1];
    $isAdult = $arrayOfVoucher[2];
    $numberInfants = $arrayOfVoucher[3];
    $voucherAddString = " VALUES ($idVendorVoucher, $idVendor, $orderId, $isAdult, $numberInfants) ";
    if ($flagFirstVoucher) {
        $flagFirstVoucher = false;
    } else {
        $voucherAddString = " , " .$voucherAddString;
    }
    $vouchersAdditionValuesString .= $voucherAddString;
}
$stmt4 = $conn->prepare($query4);
$stmt4->execute();
$stmt4->affected_rows;
$stmt4->close();

//TODO: show a page for his vouchers->somehow uniq id for one page to be responded to one OrderPayment
//redirect there






function callbackFunctionGetSpecificElementsFromMultiDimensionArray(
    $twoDimensionArray
) {
    return $twoDimensionArray[0];
}

function gatherIdVendorVouchers($idsArray) {
    $gatheredArray = [];
    foreach ($idsArray as $id) {
        if (isset($gatheredArray[$id])) {
            $gatheredArray[$id] = $gatheredArray[$id] + 1;
        } else {
            $gatheredArray[$id] = 1;
        }
    }
    return $gatheredArray;
}
