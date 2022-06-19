<?php
//TODO: authentication=>good to have, but we are checking, but you never know if something occurs

//TODO: our connection
if (!isset($conn)) {
    include '../../connection.php';
}
$everythingOk = true;
/*
 * NOTE: check if arguments is what expected
 * ARGUMENTS: array of objects(php associative array)
 *              that contains (idVendorVoucher, numberInfants, isAdult)
 *            idUser the user that wants to deliver
 */
if (isset($_POST['products'])) {
    if (is_array($_POST['products'])) { //TODO: check if this is right check
        if (count($_POST['products']) >= 2 && count($_POST['products']) <= 11) {
            $products = $_POST['products'];
            foreach ($products as $product) {
                if (isset(
                    $product['idVendor'],
                    $product['isAdult'],
                    $product['numberInfants'])
                ) {
                    if (
                        !is_numeric($product['idVendor']) ||
                        !is_numeric($product['isAdult']) ||
                        !is_numeric($product['numberInfants'])
                    ) {
                        $everythingOk = false;
                    }
                } else {
                    $everythingOk = false;
                }
            }
        } else {
            $everythingOk = false;
        }
    } else {
        $everythingOk = false;
    }
} else {
    $everythingOk = false;
}
if (isset($_POST['idUser'])) {
    if (is_numeric($_POST['idUser'])) {
        if (!checkIfUserExists($conn, $_POST['idUser'])) {
            $everythingOk = false;
        } else {
            $everythingOk = false;
        }
    }
} else {
    $everythingOk = false;
}
if (!$everythingOk) {
    exit("No right arguments provided");
}

$errorProcess = false;

$idUser = $_POST['idUser'];
$products = $_POST['products'];

/*
 * NOTE: gathering products ids and their quantity, in order to
 *      search them direct
 * RETURN: idsVendorsVoucher:
 *           associative array : key -> idVendorVoucher; value -> quantity
 */

$idsVendorsVoucher = [];
foreach ($products as $product) {
    $idProduct = $product['idVendorVoucher'];
    $isAdult = $product['isAdult'];
    if (!isset($idsVendorsVoucher[$idProduct])) {
        $idsVendorsVoucher[$idProduct] = 1;
    } else {
        $idsVendorsVoucher[$idProduct] =
            $idsVendorsVoucher[$idProduct] + 1;
    }
}


/*
 * NOTE: check every idVendorVoucher if we have the desirable quantities
 * RETURN: flagEverythingExists -> flag for if to continue
 *         associateVendorVoucherWithVendor -> so we can, if everything OK, have the
 *         idVendor for Voucher array and the following processes
 *         priceAdult, priceKid, infantPrice for payment
 */

$flagEverythingExists = true;
$associateVendorVoucherWithVendor = [];
foreach ($idsVendorsVoucher as $idVendorVoucher => $vouchersWant) {
    $query = "SELECT VV.existenceVoucher, VV.idVendor, V.priceAdult, V.priceKid, V.infantPrice
            FROM VendorVoucher AS VV, Vendor AS V
            WHERE VV.id = ? AND VV.existenceVoucher >= ?
            AND VV.idVendor = V.id";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $idVendorVoucher, $vouchersWant);
    $flagExists = false;
    if ($stmt->execute()) {
        $existenceVoucher = $idVendor = $priceAdult = $priceKid = $infantPrice = -1;
        $stmt->bind_result($existenceVoucher, $idVendor, $priceAdult, $priceKid, $infantPrice);
        while ($stmt->fetch()) {
            if (!isset($associateVendorVoucherWithVendor[$idVendorVoucher])) {
                $associateVendorVoucherWithVendor[$idVendorVoucher] =
                    array(
                        "idVendor"=>$idVendor,
                        "priceAdult"=>$priceAdult,
                        "priceKid"=>$priceKid,
                        "infantPrice"=>$infantPrice
                    );
            }
            $flagExists = true;
        }
    } else {
        $errorProcess = true;
    }

    if (!$flagExists) {
        $flagEverythingExists = false;
        break;
    }
}
/*
 * NOTE: change status of VendorVoucher, and continue process
 *      create OrderPayment and OrderVendorVoucher
 */
if ($flagEverythingExists && !$errorProcess) {
    //change status of vouchers
    foreach ($idsVendorsVoucher as $idVendorVoucher => $vouchersWant) {
        $query = "UPDATE VendorVoucher
            SET reserved = reserved + $vouchersWant ,
                existenceVoucher = existenceVoucher - $vouchersWant
            WHERE id = $idVendorVoucher ;";
        $stmtUpdateVendorVoucher = $conn->prepare($query);
        if (!$stmtUpdateVendorVoucher->execute()) {
            $errorProcess = true;
        }
        $stmtUpdateVendorVoucher->close();
    }
    $orderAmount = calculatePrice($products, $associateVendorVoucherWithVendor);
    /*
     * FIXME: in future a more secure orderIdPayment => that is uniq
     * $id.time().uniqid(mt_rand(),true) ->maybe use kind of
     * https://stackoverflow.com/questions/18121749/how-to-generate-a-unique-transaction-id-in-a-shopping-cart
     */
    $tempString = str_pad($idUser%100,2,"0",STR_PAD_LEFT);
    $orderIdPayment = date('msyd') . generateRandomString() . $tempString . generateRandomString();
    $query = "INSERT INTO OrderPayment(idUser, orderIdPayment, orderAmount)
            VALUES (?, ?, ?);";
    $stmtOrderPayment = $conn->prepare($query);
    $stmtOrderPayment->bind_param('isi',$idUser, $orderIdPayment, $orderAmount);
    if ($stmtOrderPayment->execute()) {
        $orderPaymentIdOurInternal = $conn->insert_id;
        $stmtOrderPayment->close();
        $queryForOrderVendorVoucher =
            "INSERT INTO OrderVendorVoucher(
                               idOrderPayment, idVendorVoucher, idVendor,
                               isAdult, numberInfants
                               ) ";
        $isFirstOrderVendorVoucher = true;
        $valuesOrderVendorVoucher = "";
        $bindParametersTypes = "";
        $bindParameters = [];
        foreach ($products as $product) {
            $idProduct = $product['idVendorVoucher'];
            $idVendor = $associateVendorVoucherWithVendor[$idProduct]['idVendor'];
            $isAdult = $product['isAdult'];
            $numberInfants = $product['numberInfants'];
            $bindParametersTypes .= "iiiii";
            $valueToAdd = " VALUES(?,?,?,?,?) ";
            if ($isFirstOrderVendorVoucher) {
                $isFirstOrderVendorVoucher = false;
            } else {
                $valueToAdd = ' , ' .$valueToAdd;
            }
            $valuesOrderVendorVoucher .= $valueToAdd;
            array_push(
                $bindParameters,
                $orderPaymentIdOurInternal,
                $idProduct,
                $idVendor,
                $isAdult,
                $numberInfants
            );
        }
        $queryForOrderVendorVoucher .= $valuesOrderVendorVoucher;
        $stmtOrderVendorVoucher = $conn->prepare($queryForOrderVendorVoucher);
        $stmtOrderVendorVoucher->bind_param($bindParametersTypes, ...$bindParameters);
        if ($stmtOrderVendorVoucher->execute()) {
            //
        } else {
            $errorProcess = true;
        }
    } else {
        $errorProcess = true;
        $stmtOrderPayment->close();
    }

} else {
    $message = "Some Voucher that you selected have just be taken! We are very sorry...";
}
/*
 * NOTE: we check again for errorProcess before redirect
 */
if ($errorProcess) {
    $message = "Something went wrong!";
    echo json_encode(
        array(
            'error'=>true,
            'message'=>$message
        )
    );
} else {
    //create redirect link and redirect
    $redirectLink = "";
    $orderIdPayment;
    $orderAmount;
    //do the process needed
    echo json_encode(
        array(
            'redirect'=>$redirectLink,
            'orderId'=>$orderIdPayment
        )
    );
    //TODO: can not use JS, from PHP should redirect, add in object attributes needed from Alpha Bank

    //https://stackoverflow.com/questions/5647461/how-do-i-send-a-post-request-with-php
    //https://reqbin.com/code/php/ky6hlmcs/php-post-request-example
    $curl = curl_init();
}

function generateRandomString($length = 20) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function calculatePrice($products, $associateVendorVoucherWithVendor) {
    $prices = [];
    foreach ($products as $product) {
        $idVendorVoucher = $product['idVendorVoucher'];
        $isAdult = $product['isAdult'];
        $numberInfants = $product['numberInfants'];
        if ($isAdult) {
            $price =
                $associateVendorVoucherWithVendor[$idVendorVoucher]['priceAdult']
                + $associateVendorVoucherWithVendor[$idVendorVoucher]['infantPrice'] * $numberInfants;
            array_push($prices, $price);
        } else {
            $price = $associateVendorVoucherWithVendor[$idVendorVoucher]['priceKid'];
            array_push($prices, $price);
        }
    }

    if (count($prices) <= 3) {
        $lengthHowManyPay = count($prices);
    } elseif (count($prices) <= 5) {
        $lengthHowManyPay = count($prices) - 1;
    } elseif (count($prices) <= 7) {
        $lengthHowManyPay = count($prices) - 2;
    } elseif (count($prices) <= 9) {
        $lengthHowManyPay = count($prices) - 3;
    } else { //we do not care if more than 11, he cannot order
        $lengthHowManyPay = count($prices) - 4;
    }
    sort($prices);
    $totalToPay = 0;
    for ($counter = 0; $counter < count($prices); $counter++) {
        if ($counter + 1 <= $lengthHowManyPay) {
            $totalToPay = $totalToPay + $prices[$counter];
        }
    }
    return $totalToPay;
}

function checkIfUserExists($conn, $idUser): bool
{
    $query = "SELECT name FROM User WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $idUser);
    $flag = false;
    if ($stmt->execute()) {
        $name = '';
        $stmt->bind_result($name);
        while ($stmt->fetch()) {
            $flag = true;
        }
    }
    $stmt->close();
    return $flag;
}
