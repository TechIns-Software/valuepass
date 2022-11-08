<?php
// # We receive the page from user details and if ok redirects to ValuePass Server

if (!isset(
    $_POST['name'],
    $_POST['email'],
    $_POST['phone'],
    $_POST['phoneCode']
)) {
    exit('Bad Request!');
}
//if (isset($_POST['promotions'])) {
//    $promotions = true;
//} else {
//    $promotions = false;
//}
$promotions = true;
session_start();
include 'backend/includeClasses.php';
$cartArray = unserialize($_SESSION['cart']);
$cart = new \ValuePass\Cart($cartArray);
$products = $cart->readyForSendingVendorVoucherData();
$idLanguage = $_SESSION["languageId"];
if (!(count($products) >= 1 && count($products) <= \ValuePass\Cart::$MAX_VOUCHERS)) {
    exit('No right amount of vouchers');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
</head>
<body>
<form id="myForm" action="https://valuepass.gr/request/payment/pay.php" method="post">
    <input hidden name='promotions' value='<?php echo ($promotions) ? "1" : "0" ?>'>
    <input hidden name='name' value='<?php echo $_POST['name']?>'>
    <input hidden name='email' value='<?php echo $_POST['email']?>'>
    <input hidden name='phone' value='<?php echo $_POST['phone']?>'>
    <input hidden name='phoneCode' value='<?php echo $_POST['phoneCode']?>'>
    <input hidden name='language' value='<?php echo $idLanguage;?>'>
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
<?php
$_SESSION['cart'] = serialize([]);
?>