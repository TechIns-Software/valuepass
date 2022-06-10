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
if ($_POST['action'] == 'signIn') {
    //request to our server
    $_SESSION['isLogged'] = 1;
    $_SESSION["userId"] = 1;
} elseif ($_POST['action'] == 'signUp') {
    //request to our server
    $_SESSION['isLogged'] = 1;
    $_SESSION["userId"] = 1;
} elseif ($_POST['action'] == 'logOut') {
    //this option only for if is log in
    session_destroy();
    $message = "OK";
}

if ($_POST['action'] == 'addProduct') {
    if (isset($_POST['product'])) {
        $product = $_POST['product'];
        //TODO: change condition + add vendorId condition
        if (!isset(
                $product["vendorId"],
                $product["adults"],
                $product["children"],
                $product["infants"]
            ) || !is_numeric($product["infants"])) {
            $message = "Something went wrong";
        } else {
            $product["vendorId"];
            $vouchersWant = [];

            for ($counter = 0; $counter < $product["adults"]; $counter++) {
                if ($counter == 0) {
                    $numberOfNumeric = $product["infants"];
                } else {
                    $numberOfNumeric = 0;
                }
                $voucherWant = new \ValuePass\VoucherWant(
                    1,true, $numberOfNumeric);
                array_push($vouchersWant, $voucherWant);
            }
            for ($counter = 0; $counter < $product["children"]; $counter++) {
                $voucherWant = new \ValuePass\VoucherWant(
                    1,false, $numberOfNumeric);
                array_push($vouchersWant, $voucherWant);
            }
            if (count($vouchersWant) == 0) {
                $message = "Please select at least one Voucher!";
            } else {

                $cart = new \ValuePass\Cart(unserialize($_SESSION['cart']));
                $message = $cart->addItemsToCart($vouchersWant, $conn);
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
        $_POST['date']
    )) {
        if (conditionForPackage()) {
            $idVendor = $_POST['idVendor'];
            $dateSelected = $_POST['date'];
            $totalVouchersWant = $_POST['adults'] + $_POST['children'];
            $possiblePackages= getPossibleVouchersPackages(
                $conn, $idVendor, $totalVouchersWant, $dateSelected
            );
            //return HTML
            if (count($possiblePackages) == 0) {
//                $message = did not find available options
            } else {
                $message = '';
                foreach ($possiblePackages as $possiblePackage) {
//                    $message .= add posible print it
                }
            }
        }
    }
} elseif ($_POST['action'] == 'checkOut') {
    if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == 1) {
        $userId = $_SESSION["userId"];
        //TODO: we have to reduce existence number and add column that
        // says that we are waiting if ok proccess
        //TODO: our payment provider must rejects payments after 10 minutes
        //request and payment proccess
    } else {
        $message = "You Have to Create or Sign in in your Account first";
    }
} 
echo json_encode([$message]);
