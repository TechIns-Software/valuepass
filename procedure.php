<?php

// # We receive the page from user details and if ok redirects to ValuePass Server

if (!isset(
    $_POST['name'],
    $_POST['email'],
    $_POST['promotions']

)) {
    exit('Bad Request!');
}
session_start();
$cartArray = unserialize($_SESSION['cart']);
include 'backend/includeClasses.php';
$cart = new \ValuePass\Cart($cartArray);
$products = $cart->readyForSendingVendorVoucherData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
</head>
<body>
<form id="myForm" action="https://valuepass.gr/request/payment/pay.php" method="post">
    <?php
    foreach ($products as $counter=> $product) {
        $idVendorVoucher = $product['idVendorVoucher'];
        $isAdult = $product['isAdult'];
        $numberInfants = $product['numberInfants'];
        ?>
        <input hidden name="products['<?php echo $counter;?>'][idVendorVoucher]"
               value="<?php echo $idVendorVoucher;?>">
        <input hidden name="products['<?php echo $counter;?>'][isAdult]"
               value="<?php echo $isAdult;?>">
        <input hidden name="products['<?php echo $counter;?>'][numberInfants]"
               value="<?php echo $numberInfants;?>">

    <?php
    }
    ?>


</form>
</body>
<script type="text/javascript">
    document.getElementById('myForm').submit();
</script>
</html>
