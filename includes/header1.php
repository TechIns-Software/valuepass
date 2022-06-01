

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title> <?php echo $title ?></title>
    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

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

	<script src="https://kit.fontawesome.com/16f09725b0.js" crossorigin="anonymous"></script>
    <!-- ALTERNATIVE COLORS CSS -->
    <link href="#" id="colors" rel="stylesheet">
	
	<!-- Modernizr -->
	<script src="assets/js/modernizr.js"></script>

</head>

<body>
		
	<div id="page">
		
	<header class="header menu_fixed bg-light ">
		<div id="preloader"><div data-loader="circle-side"></div></div><!-- /Page Preload -->
		<div id="logo">
			<a href="index.php" class="fs-3 fw-bolder">
				<!-- <img src="img/logo.svg" width="150" height="36" alt="" class="logo_normal">
				<img src="img/logo_sticky.svg" width="150" height="36" alt="" class="logo_sticky"> -->
				VALUEPASS
			</a>
		</div>
		<ul id="top_menu">
			<li><a href="cart-1.html" class="cart-menu-btn" style="color: black" title="Cart"><strong>4</strong></a></li>
			<li><a href="#sign-in-dialog" id="sign-in" style="color: black" class="login" title="Sign In">Sign In</a></li>
			<!-- <li><a href="wishlist.html" class="wishlist_bt_top" title="Your wishlist">Your wishlist</a></li> -->
		</ul>
		<!-- /top_menu -->
		<a href="#menu" class="btn_mobile">
			<div class="hamburger hamburger--spin" id="hamburger" style="color: black">
				<div class="hamburger-box">
					<div class="hamburger-inner" ></div>
				</div>
			</div>
		</a>
		<nav id="menu" class="main-menu">
			<ul>
				<li><span><a href="index.php" style="color: black">Home</a></span></li>
				<li><span><a href="adventures.php" style="color: black">Adventure</a></span></li>
				<li><span><a href="adventure_page.php" style="color: black">Experience Page</a></span></li>
				<!-- <li><span><a href="#" target="_parent">Buy VP</a></span></li> -->
			</ul>
		</nav>
	</header>
	<!-- /header -->
	