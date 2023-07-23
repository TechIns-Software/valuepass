<?php
// Setting Content Security Policy
header("Content-Security-Policy: default-src 'self';");

// Setting X-Content-Type-Options
header("X-Content-Type-Options: nosniff");

// Setting X-Frame-Options
header('X-Frame-Options: SAMEORIGIN');

// # We receive the page from user details and if ok redirects to ValuePass Server
if (!isset(
    $_POST['name'],
    $_POST['email'],
    $_POST['phone'],
    $_POST['phoneCode']
)) {
    exit('Bad Request!');
}
if (!isset($conn)) {
    require 'connection.php';
}
$query = "SELECT name FROM Version WHERE id = 11";
$stmt = $conn->prepare($query);
$vesselId = '-4';
if ($stmt->execute()) {
    $stmt->bind_result($vesselId);
    $stmt->fetch();
}
$stmt->close();
session_start();
// Setting cookie with HttpOnly flag
setcookie('cookie_name', 'cookie_value', [
    'httponly' => true,
    'samesite' => 'Strict', // Requires PHP 7.3.0 or newer
]);
include 'backend/includeClasses.php';
$cartArray = unserialize($_SESSION['cart']);
$cart = new \ValuePass\Cart($cartArray);
$products = $cart->readyForSendingVendorVoucherData();
if (!isset($_SESSION["languageId"])) {
    $_SESSION["languageId"] = 2;
}
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
    <input hidden name='name' value='<?php echo $_POST['name']?>'>
    <input hidden name='email' value='<?php echo $_POST['email']?>'>
    <input hidden name='phone' value='<?php echo $_POST['phone']?>'>
    <input hidden name='phoneCode' value='<?php echo $_POST['phoneCode']?>'>
    <input hidden name='language' value='<?php echo $idLanguage;?>'>
    <input hidden name='vessel' value='<?php echo $vesselId;?>'>
    <?php
    foreach ($products as $counter=> $product) {
        $idVendorVoucher = $product['idVendorVoucher'];
        $isAdult = $product['isAdult'];
        $numberInfants = $product['numberInfants'];
        ?>
        <input hidden name="products['<?php echo $counter;?>'][idVendorVoucher]"
               value="<?php echo $idVendorVoucher;?>">
        <input hidden name="products['<?php echo $counter;?>'][isAdult]"
               value="<?php echo ($isAdult ? 1: 0);?>">
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