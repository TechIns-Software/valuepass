<?php

function conditionForPackage() : bool {
    return
        is_numeric($_POST['adults']) &&
        is_numeric($_POST['children']) &&
        is_numeric($_POST['infants']) &&
        (
            (
                $_POST['infants'] > 0 && $_POST['adults'] > 0
            ) ||
            $_POST['infants'] == 0) &&
        ($_POST['adults'] + $_POST['children'] > 0);
}


function findProductInCart($idVoucher) {
    $alreadyProducts = unserialize($_SESSION['cart']);
    for ($x = 0; $x < count($alreadyProducts); $x++) {
        $voucher = $alreadyProducts[$x];
        if ($voucher->getId() == $idVoucher) {
            return $x;
        }
    }
    return -1;
}
if (!isset($_POST['action'])) {
    exit("No Action Provided");
}

session_start();
if (!isset($conn)) {
    include '../connection.php';
}
include 'finalLibrary.php';
include 'includeClasses.php';
$message = "You did not provide the request correctly";
$message2 = "";


if ($_POST['action'] == 'addProduct') {
    if (isset($_POST['product'])) {
        $product = $_POST['product'];
        //TODO: change condition + add vendorId condition
        if (!isset(
                $product["voucherVendorId"],
                $product["adults"],
                $product["children"],
                $product["idVendor"],
                $product["infants"]
            ) || !is_numeric($product["infants"])) {
            $message = "Something went wrong";
        } else {

            $vouchersWant = [];
            $idVendor = $product["idVendor"];
            for ($counter = 0; $counter < $product["adults"]; $counter++) {
                if ($counter == 0) {
                    $numberOfInfantsInAdult = $product["infants"];
                } else {
                    $numberOfInfantsInAdult = 0;
                }
                $voucherWant = new \ValuePass\VoucherWant(
                    $product["voucherVendorId"], $idVendor,true, $numberOfInfantsInAdult);
                array_push($vouchersWant, $voucherWant);
            }
            for ($counter = 0; $counter < $product["children"]; $counter++) {
                $voucherWant = new \ValuePass\VoucherWant(
                    $product["voucherVendorId"], $idVendor,false);
                array_push($vouchersWant, $voucherWant);
            }
            if (count($vouchersWant) == 0) {
                $message = "Please select at least one Voucher!";
            } else {
                $cart = new \ValuePass\Cart(unserialize($_SESSION['cart']));
                $message = $cart->addItemsToCart($vouchersWant, $conn);
                $message2 = $cart->getNumberOfVoucher();
                if ($message == "OK") {
                    $_SESSION['cart'] = serialize($cart->getArrayGroupVouchersWant());

                }
            }
        }

    }

} elseif ($_POST['action'] == 'deleteProduct') {
    if (isset($_POST['item']) && is_numeric($_POST['item'])) {

        $idItem = $_POST['item'];

        //new trial
        $cart = new \ValuePass\Cart(unserialize($_SESSION['cart']));
        $message = $cart->removeItemFromCart($idItem);
        if ($message == "OK") {
            $_SESSION['cart'] = serialize($cart->getArrayGroupVouchersWant());
        }
    }
} elseif ($_POST['action'] == 'getPackagesAvailable') {
    if (isset(
        $_POST['adults'],
        $_POST['children'],
        $_POST['infants'],
        $_POST['idVendor'],
        $_POST['date'],
        $_POST['nameVendor']
    )) {
        if (conditionForPackage()) {
            $idVendor = $_POST['idVendor'];
            $dateSelected = $_POST['date'];
            $totalVouchersWant = $_POST['adults'] + $_POST['children'];
            $possiblePackages= getPossibleVouchersPackages(
                $conn, $idVendor, $totalVouchersWant, $dateSelected
            );
            $adults = $_POST['adults'];
            $children = $_POST['children'];
            $infants = $_POST['infants'];
            $nameVendor = $_POST['nameVendor'];
            //return HTML
            if (count($possiblePackages) == 0) {
                $message = getTemplateVoucher() ;
            } else {
                $message = '';
                foreach ($possiblePackages as $possiblePackage) {
                    $message .= getTemplateVoucher($possiblePackage ,$adults ,$children ,$infants ,$idVendor, $nameVendor) ;
                }
            }
        }
    }
} elseif ($_POST['action'] == 'checkOut') {
    //TODO: our payment provider must rejects payments after 10 minutes
    $cart = new \ValuePass\Cart(unserialize($_SESSION['cart']));
    $progress = $cart->progressForPayment();
    if ($progress) {

        $dataToSend = $cart->getConcentratedVendorVoucherIds();


    } else {
        $message = $progress;
    }
} 
echo json_encode([$message, $message2]);
