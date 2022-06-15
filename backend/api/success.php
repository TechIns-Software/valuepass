<?php
//TODO: who makes the call
if (!isset($conn)) {
    include '../../connection.php';
}
$_POST['mid'];
$orderId = $_POST['orderId'];
//step 0-> get client info
$query0 = "SELECT U.id, U.name, U.email
        FROM Order AS O, User AS U
        WHERE O.idUser = U.id AND O.id = $orderId ;";
$stmt0 = $conn->prepare($query0);
if ($stmt0->execute()) {
    $idUser = $userName = $userEmail = '';
    $stmt0->bind_result($idUser, $userName, $userEmail);
    while ($stmt0->fetch()) {}
}
$stmt0->close();

//step 1 ->Order table(isPaid = true)
$query1 = "UPDATE Order
        SET isPaid = 1
        WHERE id = $orderId ;";
$stmt1 = $conn->prepare($query1);
$stmt1->execute();
$stmt1->affected_rows;
$stmt1->close();
//step 2-> VendorVoucher decrease reserved number
//get OrderVendorVoucher
//remove rows from OrderVendorVoucher
$query20 = "SELECT OVV.id, OVV.idVendorVoucher, OVV.isAdult, OVV.numberInfants
            FROM OrderVendorVoucher AS OVV
            OVV.idOrder = $orderId ;";
$stmt20 = $conn->prepare($query20);
$arrayOrderVendorVouchers = [];
if ($stmt20->execute()) {
    $idVOO = $idVendorOVV = $isAdultOVV = $numberInfantsVOO = '';
    $stmt20->bind_result($idVOO, $idVendorOVV , $isAdultOVV, $numberInfantsVOO);
    while ($stmt20->fetch()) {
        array_push(
            $arrayOrderVendorVouchers,
            [$idVOO, $idVendorOVV , $isAdultOVV, $numberInfantsVOO]
        );
    }
}
$stmt20->close();
$idsOrderVendorVouchers = array_map(
    'callbackFunctionGetSpecificElementsFromMultiDimensionArray',
    $arrayOrderVendorVouchers
);
//make ids with comma
$idsWithComma = '';
$query21 = "DELETE FROM OrderVendorVoucher WHERE id IN ( $idsWithComma )";
//step 3-> Create Voucher rows and send email
//TODO: i have to find idVendor
//TODO: think Payment is Order table
$query22 = "INSERT INTO Voucher(
                    idVendorVoucher, idVendor, idPayment, isAdult) VALUES ()";

foreach ($arrayOrderVendorVouchers as $arrayOfVoucher) {

}





function callbackFunctionGetSpecificElementsFromMultiDimensionArray(
    $oneDimensionArray
) {
    return $oneDimensionArray[0];
}
//Demension