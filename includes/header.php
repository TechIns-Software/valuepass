<?php
include 'initializeExperience.php';
include 'backend/includeClasses.php';


if (!isset($conn)) {
    include 'connection.php';
}
include_once 'backend/finalLibrary.php';
$menu = GetMenu($conn, $_SESSION['languageId']);
$languages = getAllLanguages($conn);
$cartArray = unserialize($_SESSION['cart']);

$cartHeader = new \ValuePass\Cart($cartArray);
$cartHeader->checkIfVendorVouchersInCartStillExists($conn);
$_SESSION['cart'] = serialize($cartHeader->getArrayGroupVouchersWant());
$cartArray = unserialize($_SESSION['cart']);

$url = $_SERVER['REQUEST_URI'];
$lang_icon = getLanguageIcon($conn, $_SESSION["languageId"]);
$voucherNumber = $cartHeader->getNumberOfVoucher();
$destinations = getDestinations($conn, $_SESSION["languageId"]);

function getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber, $destinations) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> <?php echo $title ?></title>
    <!-- Favicons-->
    <link rel="shortcut icon" href="assets/img/logo.jpg" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="assets/img/logo2.jpg">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="assets/img/logo2.jpg">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="assets/img/logo2.jpg">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="assets/img/logo2.jpg">

    <!-- GOOGLE WEB FONT -->
    <!--	<link rel="preconnect" href="https://fonts.gstatic.com">-->
    <!--	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">-->
    <!--	<link rel="preconnect" href="https://fonts.googleapis.com">-->
    <!--	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>-->
    <!--	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">-->
    <!--	<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;1,300;1,400&display=swap" rel="stylesheet">-->

    <!-- BASE CSS -->
    <link href="assets/bootstrap-5.1.3/dist/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css?v=2.8" rel="stylesheet">
    <link href="assets/css/vendors.css" rel="stylesheet">

    <!-- REVOLUTION SLIDER CSS -->
    <link rel="stylesheet" type="text/css" href="assets/revolution-slider/css/font-awesome2.css">
    <link rel="stylesheet" type="text/css" href="assets/revolution-slider/css/settings.css">
    <link rel="stylesheet" type="text/css" href="assets/revolution-slider/css/layers.css">
    <link rel="stylesheet" type="text/css" href="assets/revolution-slider/css/navigation.css">

    <link rel="stylesheet" type="text/css" href="assets/css/layerslider.css">
    <!-- FOR FLAGS -->
    <link rel="stylesheet" type="text/css" href="assets/css/flags.css">

    <!--	<script src="https://kit.fontawesome.com/16f09725b0.js" crossorigin="anonymous"></script>-->
    <script src="assets/js/fontawesome.js"></script>
    <!-- Modernizr -->
    <script src="assets/js/modernizr.js"></script>

</head>
<body>
<div id="page">
    <?php
    if (strpos($url, 'client.php') !== false || strpos($url, 'cart-1.php') !== false || strpos($url, 'cancel.php') !== false || strpos($url, 'how.php') !== false && $home == false) { ?>
        <header class="header menu_fixed  cart-bg">
            <div id="preloader">
                <div data-loader="circle-side"></div>
            </div><!-- /Page Preload -->
            <div id="logo">
                <a href="index.php" class="fs-3 fw-bolder">
                    <img src="assets/img/valuepassLogo.png" width="140" height="70" alt="" class="logo_normal ">
                    <img src="assets/img/valuepassLogo.png" width="120" height="55" alt="" class="logo_sticky ">
                </a>
            </div>
            <ul id="top_menu">
                <li></li>
                <li><a href="cart-1.php" class="cart-menu-btn" title="Cart"><strong
                                id="cartNumberShow"><?php echo $voucherNumber; ?></strong></a></li>
                <!-- <li><a href="wishlist.html" class="wishlist_bt_top" title="Your wishlist">Your wishlist</a></li> -->
            </ul>
            <!-- /top_menu -->
            <a href="#menu" class="btn_mobile">
                <div class="hamburger hamburger--spin" id="hamburger">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </a>
            <nav id="menu" class="main-menu">
                <ul>
                    <li><span><a href="#"><?php echo $menu[36] ?></span></a>
                        <ul >
                            <?php
                            foreach ($destinations as $destination) {
                                ?>
                                <li>
                                    <a  class="icon-location"
                                       href="adventures.php?id=<?php echo $destination->getId(); ?>"><?php echo $destination->getName(); ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><span><a href="how.php"><?php echo $menu[1] ?></a></span></li>
                    <li><span><a href="#"><?php echo $menu[4] ?></span></a>
                        <ul class="customercare">
                            <li>
                                <a href="https://api.whatsapp.com/send/?phone=306931451910&text=Welcome+to+ValuePass%21+How+can+we+help+you%3F+&type=phone_number&app_absent=0">
                                    <img src="assets/icons/whatsapp.png" height="20" width="20" class="img-fluid">
                                    +306931451910</a></li>
                            <li><a class="viberlink" href="viber://add?number=306931451910"> <img
                                            src="assets/icons/viber.png" height="20" width="20" class="img-fluid">
                                    +306931451910</a></li>
                            <li><a href="mail:customercare@valuepass.gr" class="icon-email">
                                    customercare@valuepass.gr</a></li>
                            <li><a class="icon-question"> FAQ’s</a></li>
                        </ul>
                    </li>
                    <li><a><span class="flag-icon flag-icon-<?php echo $lang_icon ?>"></span> </a>
                        <ul>
                            <?php

                            foreach ($languages as $language) { ?>
                                <li><a href="javascript:void(0);"
                                       onclick="changeLanguage('<?php echo $language[0] ?>');"><span
                                                class="flag-icon flag-icon-<?php echo $language[2] ?>"></span></a></li>
                            <?php } ?>

                        </ul>
                    </li>
                    <!-- <li><span><a href="adventure_page.php">Experience Page</a></span></li> -->
                    <!-- <li><span><a href="#" target="_parent">Buy VP</a></span></li> -->
                </ul>
            </nav>
        </header>

    <?php } else { ?>

        <header class="header menu_fixed">
            <div id="preloader">
                <div data-loader="circle-side"></div>
            </div><!-- /Page Preload -->
            <div id="logo">
                <a href="index.php" class="fs-3 fw-bolder">
                    <img src="assets/img/valuepassLogo.png" width="140" height="70" alt="" class="logo_normal ">
                    <img src="assets/img/valuepassLogo.png" width="120" height="55" alt="" class="logo_sticky ">
                </a>
            </div>
            <ul id="top_menu">
                <li></li>
                <li><a href="cart-1.php" class="cart-menu-btn" title="Cart"><strong
                                id="cartNumberShow"><?php echo $voucherNumber; ?></strong></a></li>
                <!-- <li><a href="wishlist.html" class="wishlist_bt_top" title="Your wishlist">Your wishlist</a></li> -->
            </ul>
            <!-- /top_menu -->
            <a href="#menu" class="btn_mobile">
                <div class="hamburger hamburger--spin" id="hamburger">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </a>
            <nav id="menu" class="main-menu">
                <ul>
                    <li><span><a href="#"><?php echo $menu[36] ?></span></a>
                        <ul >
                            <?php
                            foreach ($destinations as $destination) {
                                ?>
                                <li>
                                    <a  class="icon-location"
                                        href="adventures.php?id=<?php echo $destination->getId(); ?>"><?php echo $destination->getName(); ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><span><a href="how.php"><?php echo $menu[1] ?></a></span></li>
                    <li><span><a href="#"><?php echo $menu[4] ?> </span></a>
                        <ul class="customercare">
                            <li><a href="https://wa.me/+306931451910?text='Valuepass Support is available 24/7'">
                                    <img
                                            src="assets/icons/whatsapp.png" height="20" width="20"
                                            class="img-fluid">
                                    +306931451910</a></li>
                            <li><a class="viberlink" href="viber://add?number=306931451910"> <img
                                            src="assets/icons/viber.png" height="20" width="20" class="img-fluid">
                                    +306931451910</a></li>
                            <li><a href="mail:customercare@valuepass.gr" class="icon-email">
                                    customercare@valuepass.gr</a></li>
                            <li><a class="icon-question"> FAQ’s</a></li>
                        </ul>
                    </li>
                    <li><a><span class="flag-icon flag-icon-<?php echo $lang_icon ?>"></span> </a>
                        <ul>
                            <?php

                            foreach ($languages as $language) { ?>
                                <li><a href="javascript:void(0);"
                                       onclick="changeLanguage('<?php echo $language[0] ?>');"><span
                                                class="flag-icon flag-icon-<?php echo $language[2] ?>"></span></a>
                                </li>
                            <?php } ?>

                        </ul>
                    </li>
                    <!-- <li><span><a href="adventure_page.php">Experience Page</a></span></li> -->
                    <!-- <li><span><a href="#" target="_parent">Buy VP</a></span></li> -->
                </ul>
            </nav>
        </header>
    <?php } ?>
    <!-- /header -->
    <?php
    }
    ?>

