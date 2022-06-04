<?php
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
    //
}

session_start();
if ($_POST['action'] == 'addProduct') {
    if (isset($_POST['product'])) {
        if (isset($_POST['name']) && isset($_POST['ageOver'])) {
            $idVoucher = $_POST['product'];
            if (findProductInCart($idVoucher) == -1) {
                //here
            }
            $name = $_POST['name'];
            $isAdult = $_POST['ageOver'] ? 1 : 0;
            $queryForPrice = 'SELECT ';
            //TODO check if is valid
            if (isset($_SESSION['cart'])) {
                $alreadyProducts = unserialize($_SESSION['cart']);
                array_push($alreadyProducts);
            }
        }

    }

} elseif ($_POST['action'] == 'deleteProduct') {
    if (isset($_POST['product'])) {

        $idVoucher = $_POST['product'];
        $position = findProductInCart($idVoucher);
        if ($position != -1) {
            //here
        }


    }
}
