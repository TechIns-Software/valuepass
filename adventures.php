<?php
if (!isset($conn)) {
	include 'connection.php';
}
if (!isset($_GET['id'])) {
	header('location: index.php');
}
$title = "Adventures";
$home = 0;
include_once 'includes/header.php';
$idDestination = $_GET['id'];
$languageId = $_SESSION["languageId"];
$destination = getDestination($conn, $idDestination, $languageId);
$vendors = getVendors($conn, $idDestination, $languageId);
$bestOffs = getVendors($conn, $idDestination, $languageId, true);
$availableCategories = getCategoriesVendors($conn, $languageId, $idDestination);
if (count($vendors) <= 0) {
	//   header('location: index.php');
}
?>

<main>
	<section style="background: url('images/location_images/<?php echo $destination->getImage2();?>') 50% 50% " class="header-video adventure">
		<div id="hero_video">
			<div class="wrapper">
				<div class="container container-custom">
                    <br>
					<h3><?php echo $destination->getName();?></h3>
				</div>
			</div>
		</div>

<!--		<video src="assets/videos/vid2.mp4" autoplay loop playsinline muted></video>-->
<!--		 <img src="assets/img/10.jpg" alt="" class="header-video--media" data-video-src="video/adventure" data-teaser-source="video/adventure" data-provider="" data-video-width="1920" data-video-height="960">-->
	</section>
	<!-- /header-video -->
    <div class="bg_color_1 shadow bgbanner">
        <div class="container container-custom margin_80_55 ">
            <div class="main_title_2">
                <h6 class="text-center destbannertext" style="color: white">
                    Buy at least 2 vouchers for different activities and
                    up to 3 in order to get more for free !
                   <br>
                   <br>
                 <p > Your gifts never end !  </p> 
                </h6>
            </div>

        </div>
        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->
	<div id="bestof" class="container container-custom margin_80_55">
		<section class="add_bottom_45">
			<div class="main_title_3">
				<span><em></em></span>
				<h2>Best of Experiences </h2>
				<!-- <p>Some of our favorite experiences </p> -->
			</div>


<!--            TODO : FIX ME -->
			<div id="reccomended" class="owl-carousel owl-theme">

                <?php
                foreach ($bestOffs as $vendor) {
                    $moneySaved = $vendor->getOriginalPrice() * ($vendor->getDiscount() / 100);
                    $totalToPay = $vendor->getOriginalPrice() - $moneySaved - $vendor->getPriceAdult();

                    ?>
                    <div class="item">
                        <div class="box_grid">
                            <a href="adventure_page.php?id=<?php echo $vendor->getId();?>">
                                <img src="vendorImages/<?php echo $vendor->getId().'/'. $vendor->getPathToImage();?>"
                                     class="img-fluid" alt="" width="800" height="933">
                            </a>
                            <div class="wrapper best ">
                                <small><?php echo $vendor->getCategoryName();?></small>
                                <h3 class="vendorname"><a href="adventure_page.php?id=<?php echo $vendor->getId();?>"><?php echo $vendor->getName();?></a></h3>
                                <p class="text-muted my-0 label"><?php echo implode(' / ', $vendor->getLabelsBoxNames());?></p>

                                <span class="criteria">
                                    Our Criteria Rating
                                    <?php echo str_repeat('<i class="icon_star voted"></i>',$vendor->getAverageRated())?>
                                    <?php echo str_repeat('<i class="icon_star"></i>', $vendor::$MAX_STARS - $vendor->getAverageRated())?>
                                </span>
                                <p class=""> <span class="voucher_av">Vouchers Available <b> 4/10</b></span> </p>
                                <p class="vpvoucher_price2 my-0  "> Buy VP Voucher <b><?php echo $vendor->getPriceAdult();?>€ </b> <span class="perperson">per person</span></p>
                                <p class="prev_price2 my-0"> <b>Initial Price</b> <s><?php echo $vendor->getOriginalPrice();?> € </s> <span class="perperson">per person</span></p>
                                <p class="vp_discount my-0 ">You Save <?php echo $vendor->getDiscount();?>%</p>
                                <p class="final_price2 my-0 mb-2"> Final Price <b><?php echo $totalToPay;?>€ </b> <span class="perperson">per person </span></p>
                                <a href="adventure_page.php?id=<?php echo $vendor->getId();?>"><div class=" buy_button2" > Book Now  </div></a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>


			</div>

		</section>
	</div>



	<div class="container text-center my-2">
		<div class="main_title_3 d-block">
			<h2>Type of experience</h2>
		</div>
		<div class="form-check form-check-inline">
			<input onclick="changeCategory(this.value,this.checked)" class="form-check-input" type="checkbox" id="inlineCheckboxminus1" value="-1" />
			<label class="form-check-label" for="inlineCheckboxminus1"> <b> All</b> </label>
		</div>
		<?php
		foreach ($availableCategories as $availableCategory) {
			$idAvailableCategory = $availableCategory[0];
		?>
			<div class="form-check form-check-inline ">
				<input onclick="changeCategory(this.value,this.checked)" class="form-check-input" type="checkbox" id="inlineCheckbox<?php echo $idAvailableCategory; ?>" value="<?php echo $idAvailableCategory; ?>" />
				<label class="form-check-label" for="inlineCheckbox<?php echo $idAvailableCategory; ?>"><?php echo $availableCategory[1]; ?></label>
			</div>
		<?php
		}
		?>

	</div>



	<div class="container">
		<div class="isotope-wrapper">
			<div class="row" id="experiences">
				<!--                TODO: add link for specific vendor, and criteria rated somehow, image link-->
				<?php
				foreach ($vendors as $vendor) {
					$moneySaved = $vendor->getOriginalPrice() * ($vendor->getDiscount() / 100);
					$totalToPay = $vendor->getOriginalPrice() - $moneySaved - $vendor->getPriceAdult();
				?>

                <div id="exper<?php echo $vendor->getId();?>" class="col-xl-4 col-lg-6 col-md-6 isotope-item popular" data-category="<?php echo $vendor->getCategoryId();?>">
                    <div class="box_grid">
                        <figure>
                            <a href="adventure_page.php?id=<?php echo $vendor->getId();?>">
                                <img src="vendorImages/<?php echo $vendor->getId().'/'. $vendor->getPathToImage();?>" class="img-fluid" alt="" width="800" height="533">
                            </a>
                        </figure>
                        <div class="wrapper best  ">
                            <small><?php echo $vendor->getCategoryName();?></small>
                            <h3><a href="adventure_page.php?id=<?php echo $vendor->getId();?>"><b><?php echo $vendor->getName();?></b></a></h3>
                            <p class="text-muted my-0 label"><?php echo implode(' / ', $vendor->getLabelsBoxNames());?></p>
                            <span class="criteria">
                                Our Criteria Rating
                                <?php echo str_repeat('<i class="icon_star voted"></i>',$vendor->getAverageRated())?>
                                <?php echo str_repeat('<i class="icon_star"></i>', $vendor::$MAX_STARS - $vendor->getAverageRated())?>
                            </span>
                            <p class=""> <span class="voucher_av">Vouchers Available <b> 4/10</b></span> </p>
                            <p class="vpvoucher_price2 my-0  "> Buy VP Voucher <b><?php echo $vendor->getPriceAdult();?>€ </b> <span class="perperson">per person </span></p>
                            <p class="prev_price2 my-0"> <b>Initial Price</b> <s><?php echo $vendor->getOriginalPrice();?> € </s> <span class="perperson">per person</span></p>
                            <p class="vp_discount my-0 ">You Save <?php echo $vendor->getDiscount();?>% </p>
                            <p class="final_price2 my-0 mb-2"> Final Price <b><?php echo $totalToPay;?>€ </b> <span class="perperson">per person</span></p>
                            <a href="adventure_page.php?id=<?php echo $vendor->getId();?>"><div class=" buy_button2" > Book Now  </div></a>
                        </div>
                    </div>
                </div>

                <?php
                }
                ?>

            </div>
        </div>
    </div>


</main>
<!-- /main -->

<footer>
	<div class="container margin_60_35">
		<div class="row">
			<div class="col-lg-5 col-md-12 pe-5">
				<!-- <p><img src="assets/img/valuepass3logo.png" width="100" height="100" alt=""></p> -->
				<p><img src="assets/img/valuepassLogo.png" width="180" height="100" alt="Logo"></p>
				<p>Escape the tourist traps with unforgettable travel experiences . Get beneath the surface of these destinations .
					All our proposals are hand-picked by our team! . </p>
				<b> Get inspired for your next trip </b>
				<div class="follow_us">
					<ul>
						<li><?php echo $menu[12] ?> </li>
						<li><a href="#0"><i class="ti-facebook"></i></a></li>
						<li><a href="#0"><i class="ti-twitter-alt"></i></a></li>
						<li><a href="#0"><i class="ti-google"></i></a></li>
						<li><a href="#0"><i class="ti-pinterest"></i></a></li>
						<li><a href="#0"><i class="ti-instagram"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 ms-lg-auto">
				<h5> <?php echo $menu[8] ?></h5>
				<ul class="links ">
					<li><a href="#"><?php echo $menu[6] ?></a>
						<ul>

							<?php
							foreach ($languages  as $language) {  ?>
								<li class=" ps-3"><a href="javascript:void(0);" onclick="changeLanguage('<?php echo $language[0] ?>');"><span class="flag-icon flag-icon-<?php echo $language[2] ?>"></span> <?php echo $language[1] ?></a> </li>
							<?php	} ?>

						</ul>
					</li>

					<li><a href="#"> <?php echo $menu[4] ?> </a></li>
					<li><a href="cart-1.php"><?php echo $menu[7] ?></a></li>

				</ul>
			</div>
			<div class="col-lg-3 col-md-6">
				<h5><?php echo $menu[9] ?></h5>
				<ul class="contacts">
					<li><a href="mailto:info@valuepass.com"><i class="ti-email"></i> info@valuepass.com</a></li>
				</ul>
			</div>
		</div>
		<!--/row-->
		<hr>
		<div class="row">
			<!-- <div class="col-lg-6">
				<ul id="footer-selector">
					<li>
						<div class="styled-select" id="lang-selector">
							<select>
								<option value="English" selected>English</option>
								<option value="French">French</option>
								<option value="Spanish">Spanish</option>
								<option value="Russian">Russian</option>
							</select>
						</div>
					</li>
					<li>
						<div class="styled-select" id="currency-selector">
							<select>
								<option value="US Dollars" selected>US Dollars</option>
								<option value="Euro">Euro</option>
							</select>
						</div>
					</li>

				</ul>
			</div> -->
			<div class="col-lg-12">
				<ul id="additional_links">
					<li><a href="#0"><?php echo $menu[10] ?></a></li>
					<li><a href="#0"><?php echo $menu[11] ?></a></li>
					<li><span>© ValuePass</span></li>
				</ul>
			</div>
		</div>
	</div>
</footer>
<!--/footer-->
</div>
<!-- page -->

<!-- Sign In Popup -->
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
	<div class="small-dialog-header">
		<h3>Sign In</h3>
	</div>
	<form>
		<div class="sign-in-wrapper">
			<a href="#0" class="social_bt facebook">Login with Facebook</a>
			<a href="#0" class="social_bt google">Login with Google</a>
			<div class="divider"><span>Or</span></div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" name="email" id="email">
				<i class="icon_mail_alt"></i>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="password" id="password" value="">
				<i class="icon_lock_alt"></i>
			</div>
			<div class="clearfix add_bottom_15">
				<div class="checkboxes float-start">
					<label class="container_check">Remember me
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
				<div class="float-end mt-1"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
			</div>
			<div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>
			<div class="text-center">
				Don’t have an account? <a href="register.html">Sign up</a>
			</div>
			<div id="forgot_pw">
				<div class="form-group">
					<label>Please confirm login email below</label>
					<input type="email" class="form-control" name="email_forgot" id="email_forgot">
					<i class="icon_mail_alt"></i>
				</div>
				<p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
				<div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
			</div>
		</div>
	</form>
	<!--form -->
</div>
<!-- /Sign In Popup -->

<div id="toTop"></div><!-- Back to top button -->

<!-- COMMON SCRIPTS -->
<script src="assets/js/common_scripts.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/validate.js"></script>

<script src="changeLanguage.js"></script>
<script src="assets/js/allExperiences.js"></script>
<script src="assets/js/typeOfExperience.js"></script>
</body>

</html>