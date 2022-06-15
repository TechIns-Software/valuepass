<?php

$url = $_SERVER['REQUEST_URI'];

if (!isset($conn)) {
	include 'connection.php';
}
// MAYBE TODO : FIND THE WAY FOR RELATIVE PATH
include 'backend/finalLibrary.php';
$languages =  getAllLanguages($conn);

$menu = GetMenu($conn, $_SESSION['languageId']);
// print_r($menu );
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
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="assets\bootstrap-5.1.3\dist\css\bootstrap.css" rel="stylesheet">
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/vendors.css" rel="stylesheet">

	<!-- REVOLUTION SLIDER CSS -->
	<link rel="stylesheet" type="text/css" href="assets/revolution-slider/css/font-awesome2.css">
	<link rel="stylesheet" type="text/css" href="assets/revolution-slider/css/settings.css">
	<link rel="stylesheet" type="text/css" href="assets/revolution-slider/css/layers.css">
	<link rel="stylesheet" type="text/css" href="assets/revolution-slider/css/navigation.css">

	<!-- FOR FLAGS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" type="text/css">

	<script src="https://kit.fontawesome.com/16f09725b0.js" crossorigin="anonymous"></script>
	<!-- Modernizr -->
	<script src="assets/js/modernizr.js"></script>

</head>

<body>

	<div id="page">

		<?php

		if ($home == true) { ?>

			<header class="header menu_fixed">
				<div id="preloader">
					<div data-loader="circle-side"></div>
				</div><!-- /Page Preload -->
				<div id="logo" >
					<a href="index.php" >
						<img src="assets/img/valuepass3logo.png" width="80" height="80" alt="" class="logo_normal">
						<img src="assets/img/valuepass3logo.png" width="60" height="60" alt="" class="logo_sticky"> 
					</a>
				</div>
				<ul id="top_menu">
					<!-- <li><a href="#sign-in-dialog" id="sign-in" class="login" title="Sign In">Sign In</a></li> -->
					<li> </li>
					<!-- for number in cart just add strong elemnt inside li  -->
					 <li><a href="#" class="cart-menu-btn " title="Cart"></a></li>
					<!--<li><a href="wishlist.html" class="wishlist_bt_top" title="Your wishlist">Your wishlist</a></li>  -->
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
						<li><span><a href="index.php#how"><?php echo $menu[1] ?></a></span></li>
						<li><span><a href="index.php"><?php echo $menu[6] ?></a></span>
							<ul>

								<?php
								foreach ($languages  as $language) {  ?>
									<li><a href="javascript:void(0);" onclick="changeLanguage('<?php echo $language[0] ?>');"><span class="flag-icon flag-icon-<?php echo $language[2] ?>"></span> <?php echo $language[1] ?></a> </li>
								<?php	} ?>

							</ul>
						</li>
						<li><span><a href="#"><?php echo $menu[4] ?></a></span></li>
						<!-- <li><span><a href="adventure_page.php">Experience Page</a></span></li> -->
						<!-- <li><span><a href="#" target="_parent">Buy VP</a></span></li> -->
					</ul>
				</nav>
			</header>

		<?php	} else if (strpos($url ,'cart-1.php') !== false) { ?>
			<header class="header menu_fixed bg-primary">
				<div id="preloader">
					<div data-loader="circle-side"></div>
				</div><!-- /Page Preload -->
				<div id="logo">
					<a href="index.php" class="fs-3 fw-bolder"> 
						<img src="assets\img\valuepass3logo.png" width="60" height="60" alt="" class="logo_normal">
						<img src="assets\img\valuepass3logo.png" width="60" height="60" alt="" class="logo_sticky"> 
					</a>
				</div>
				<ul id="top_menu">
					<li></li>
					<li><a href="#" class="cart-menu-btn" title="Cart"></a></li>
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
						<li><span><a href="index.php"> <?php echo $menu[0] ?> </a></span></li>

						<li><span><a href="index.php"> <?php echo $menu[6] ?> </a></span>
							<ul>
								<?php

								foreach ($languages  as $language) {  ?>
									<li><a href="javascript:void(0);" onclick="changeLanguage('<?php echo $language[0] ?>');"><span class="flag-icon flag-icon-<?php echo $language[2] ?>"></span> <?php echo $language[1] ?></a> </li>
								<?php	} ?>

							</ul>
						</li>
						<li><span><a href="adventures.php?id=1"> <?php echo $menu[3] ?> </a></span></li>
						<!-- <li><span><a href="adventure_page.php">Experience Page</a></span></li> -->
						<!-- <li><span><a href="#" target="_parent">Buy VP</a></span></li> -->
					</ul>
				</nav>
			</header>

		<?php } else{ 	?>

			<header class="header menu_fixed">
				<div id="preloader">
					<div data-loader="circle-side"></div>
				</div><!-- /Page Preload -->
				<div id="logo">
					<a href="index.php" class="fs-3 fw-bolder">
						<img src="assets/img/valuepass3logo.png" width="60" height="60" alt="" class="logo_normal">
						<img src="assets/img/valuepass3logo.png" width="60" height="60" alt="" class="logo_sticky"> 
					</a>
				</div>
				<ul id="top_menu">
					<li></li>
					<li><a href="#" class="cart-menu-btn" title="Cart"></a></li>
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
						<li><span><a href="index.php"> <?php echo $menu[0] ?> </a></span></li>

						<li><span><a href="index.php"> <?php echo $menu[6] ?> </a></span>
							<ul>
								<?php

								foreach ($languages  as $language) {  ?>
									<li><a href="javascript:void(0);" onclick="changeLanguage('<?php echo $language[0] ?>');"><span class="flag-icon flag-icon-<?php echo $language[2] ?>"></span> <?php echo $language[1] ?></a> </li>
								<?php	} ?>

							</ul>
						</li>
						<li><span><a href="adventures.php?id=1"> <?php echo $menu[3] ?> </a></span></li>
						<!-- <li><span><a href="adventure_page.php">Experience Page</a></span></li> -->
						<!-- <li><span><a href="#" target="_parent">Buy VP</a></span></li> -->
					</ul>
				</nav>
			</header>




		<?php } ?>
		<!-- /header -->