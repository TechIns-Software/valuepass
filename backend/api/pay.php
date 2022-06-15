<?php
//TODO: authentication
//bind param if work with string of types
if (!isset($_POST['products'])) {
    exit("No arguments provided");
}
//TODO: our connection
if (!isset($conn)) {
    include '../../connection.php';
}
$products = $_POST['products'];
$idsVendorsVoucher = [];
foreach ($products as $product) {
    $idProduct = $product['idVendor'];
    $isAdult = $product['isAdult'];
    if (!isset($idsVendorsVoucher[$idProduct])) {
        $idsVendorsVoucher[$idProduct] = 1;
    } else {
        $idsVendorsVoucher[$idProduct] =
            $idsVendorsVoucher[$idProduct] + 1;
    }
}
$flagEverythingExists = true;
foreach ($idsVendorsVoucher as $idVendorVoucher) {
    //see if id exists ->existence + reserved
    $query = "";


    $condition = false;
    if ($condition) {
        $flagEverythingExists = false;
        break;
    }
}
$error = false;
if ($flagEverythingExists) {
    //change status of vouchers
    foreach ($products as $product) {
        $idProduct = $product['idVendor'];
        $query = "UPDATE VendorVoucher
            SET reserved = reserved + 1
            WHERE id = $idProduct ;";
        $stmt = $conn->prepare($query);
        if (!$stmt->execute()) {
            $error = true;
        }

    }

} else {
    $message = "Some Voucher that you selected have just be taken! We are very sorry...";
}
if ($error) {
    $message = "Something went wrong!";
} else {
    //create redirect link
}
//https://stackoverflow.com/questions/5647461/how-do-i-send-a-post-request-with-php
//https://reqbin.com/code/php/ky6hlmcs/php-post-request-example
$curl = curl_init();
