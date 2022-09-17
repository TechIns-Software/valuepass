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
<!--TODO: bank link-->
<form id="myForm" action="https://valuepass.gr/request/payment/caller.php" method="post">
    <input hidden name="name" value="<?php echo $_POST['name'];?>">
    <input hidden name="email" value="<?php echo $_POST['email'];?>">
    <input hidden name="promotions" value="<?php echo $_POST['promotions'];?>">
    <?php
    foreach ($products as $counter=> $product) {
        $idVendorVoucher = $product['idVendorVoucher'];
        $isAdult = $product['isAdult'];
        $numberInfants = $product['numberInfants'];
        ?>
        <input hidden name="products['<?php echo $counter;?>']"
               value="<?php echo $idVendorVoucher;?>">
        <input hidden name="products['<?php echo $counter;?>']"
               value="<?php echo $isAdult;?>">
        <input hidden name="products['<?php echo $counter;?>']"
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
