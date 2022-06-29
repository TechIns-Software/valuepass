<?php
if (!isset($conn)) {
	include 'connection.php';
}
if (!isset($_GET['id'])) {
	header('location: index.php');
}
include 'backend/includeClasses.php';
include 'initializeExperience.php';
$title = "Vendor page";
$home = 0;
include_once 'includes/header.php';

$idVendor = $_GET['id'];
$languageId = $_SESSION["languageId"];
$vendor = getVendor($conn, $idVendor, $languageId);
$bestOffs = getVendors($conn, $vendor->getIdDestination(), $languageId, true);
if ($vendor == Null) {
	//    header('location: index.php');
}
?>
<input value="<?php echo $vendor->getId(); ?>" id="vendorId" hidden>
<main>
	<!-- <section class="hero_in hotels_detail ">
		<div class="wrapper ">
			<div class="container ">
				<h1 class="fadeInUp"><span></span>Vendor Page</h1>
			</div>
			<span class="magnific-gallery">
				<a href="assets/img/10.jpg" class="btn_photos" title="Photo title" data-effect="mfp-zoom-in">View photos <br>& videos</a>
				<a href="assets/img/4.jpg" title="Photo title" data-effect="mfp-zoom-in"></a>
				<a href="assets/img/2.jpg" title="Photo title" data-effect="mfp-zoom-in"></a>
			</span>
		</div>
	</section> -->
	<!--/hero_in-->

	<!-- Slider -->
	<div id="full-slider-wrapper">
		<div id="layerslider" style="width:100%;height:650px;">
			<?php
			$dummyCounter = 0;
			foreach ($vendor->getImages() as $imagePath) {
				$dummyArray = [
					'Unique <strong>Experience </strong>',
					'<strong>Enjoy</strong> Unforgettable Holidays',
					'<strong>Top Attractions</strong> to discover'
				];
			?>
				<div class="ls-slide" data-ls="slidedelay: 5000; transition2d:85;">
					<img src="vendorImages/<?php echo $vendor->getId() . '/' . $imagePath; ?>" class="ls-bg" alt="Slide background">
					<h3 class="ls-l slide_typo" style="top: 47%; left: 50%;" data-ls="offsetxin:0;durationin:2000;delayin:1000;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% bottom 0;offsetxout:0;rotatexout:90;transformoriginout:50% bottom 0;">
						<?php echo $dummyArray[$dummyCounter % 3] ?>
					</h3>
					<!-- <p class="ls-l slide_typo_2" style="top:55%; left:50%;" data-ls="durationin:2000;delayin:1000;easingin:easeOutElastic;">
                        Tours - Hotels - Restaurants
                    </p> -->
					<!--                    <p class="ls-l" style="top:70%; left:50%;" data-ls="durationin:2000;delayin:1400;easingin:easeOutElastic;"><a class="btn_1 rounded" data-ls="durationin:2000;delayin:1400;easingin:easeOutElastic;" href='#description'>Read Description</a></p>-->

				</div>
			<?php
				$dummyCounter = $dummyCounter + 1;
			}
			?>

		</div>
	</div>
	<!-- End layerslider -->


	<div class=" bg_color_1">
		<!--		<nav class="secondary_nav sticky_horizontal">-->
		<!--			<div class="container">-->
		<!--				<ul class="clearfix">-->
		<!--					<li><a href="#book" class="active">Buy VP Voucher</a></li>-->
		<!--				</ul>-->
		<!--			</div>-->
		<!--		</nav>-->
		<div class="container margin_60_35">
			<div class="row">
				<div class="col-lg-6 col-md-12   ">
					<section id="description">

						<div class=" d-flex    justify-content-between  my-4    collapsebtn" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
							<h2 class=" d-flex align-items-center   "> Description </h2>
							<span class="d-flex align-items-center fs-3"><i class="icon-plus"></i></span>
						</div>

						<div class="collapse shadow" id="collapseExample">
							<div class=" ">
								<div class="row">
									<div class="col-lg-8 col-md-12  ">
										<p class="details">
											<?php echo $vendor->getDescriptionBig(); ?>
										</p>
									</div>
								</div>
							</div>
						</div>


						<div class=" d-flex    justify-content-between my-4  " data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
							<h2 class=" d-flex align-items-center   "> About this Activity </h2>
							<span class="d-flex align-items-center fs-3"><i class="icon-plus"></i></span>
						</div>




						<div class="collapse shadow" id="collapseExample1">
							<div>
								<div class="row">
									<div class="col-lg-8 col-md-12  details ">
										<ul class="">
											<?php
											$aboutActivityArray = $vendor->getAboutActivityArray();
											for ($counter = 0; $counter < ceil(count($aboutActivityArray) / 2); $counter++) {
											?>
												<li><i class="fa fa-arrow-right" aria-hidden="true"></i>
													<?php echo $aboutActivityArray[$counter]->getHead(); ?>
													<small class="text-muted">
														<?php echo $aboutActivityArray[$counter]->getDescription(); ?>
													</small>
												</li>
											<?php
											}
											?>
											<li>
												<i class="fa fa-arrow-right" aria-hidden="true"></i>
												<?php echo $vendor->getPaymentInfoActivityDescription(); ?>
											</li>
										</ul>

									</div>
								</div>
							</div>
						</div>

					</section>

					<section>


						<div class=" d-flex    justify-content-between my-4  " data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
							<h4 class=" d-flex align-items-center   "> Highlights </h4>
							<span class="d-flex align-items-center fs-3"><i class="icon-plus"></i></span>
						</div>


						<div class="collapse shadow" id="collapseExample2">
							<div class=" ">
								<div class="row">
									<div class="col-lg-8 col-md-12  details ">
										<ul>
											<?php
											if (count($vendor->getHighlights()) > 0) {
												foreach ($vendor->getHighlights() as $highlight) {
											?>
													<li>
														<i class="fa fa-arrow-right" aria-hidden="true"></i>
														<?php echo $highlight; ?>
													</li>
											<?php
												}
											}
											?>

										</ul>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>


				<div class="col-lg-6 col-md-12 ">
					<?php

					$moneySaved = $vendor->getOriginalPrice() * ($vendor->getDiscount() / 100);
					$totalToPay = $vendor->getOriginalPrice() - $moneySaved - $vendor->getPriceAdult();
					?>
					<div class="box_grid">
						<div class="wrapper">
							<!--                            TODO: voucher available, Reserve Now your Spot & Pay Later for your activity-->
							<h3 id="nameVendor"><?php echo $vendor->getName(); ?></h3>
							<p>
								<span class="extras"><?php echo implode(' / ', $vendor->getLabelsBoxNames()); ?>
								</span>
							</p>
							<span class="criteria">
								Our Criteria Rating
								<?php echo str_repeat('<i class="icon_star voted"></i>', $vendor->getAverageRated()) ?>
								<?php echo str_repeat('<i class="icon_star"></i>', $vendor::$MAX_STARS - $vendor->getAverageRated()) ?>
							</span>
							<p class=" voucher_av ">
								Vouchers Available
								<b>4/10</b>
							</p>
							<p class="vpvoucher_price1 my-0">
								Buy VP Vouchers
								<span class="vpvoucher_price1_value"> <?php echo $vendor->getPriceAdult(); ?>€ </span>
								<span class="perperson">per person</span>
							</p>
							<p class=" prev_price my-0">
								Initial Price
								<span class="prev_price_value"><?php echo $vendor->getOriginalPrice(); ?> €</span>
								<span class="perperson">per person</span>
							</p>

							<p class="vp_discount my-0 ">
								Save
								<?php echo $vendor->getDiscount(); ?>%
							</p>
							<p class="final_price1 my-0">
								Final Price
								<span class="final_price1_value"><?php echo $totalToPay; ?>€ </span>
								<span class="perperson">per person</span>
							</p>
							<!-- <p class="final_price1 m-0 mb-2"> Final Price <span class="final_price1_value">84€ </span></p> <span class="perperson">per person</span> </p> -->
							<button class=" my-2 btn buy_button "> <a href="#book">Book Now </a> </button>
							<p class="my-0 perperson"> <?php echo $menu[13]; ?> </p>


						</div>

					</div>

				</div>



				<div class="container margin_60_35">

					<div class="row">
						<div class="col-lg-12  col-md-12 ">


							<div class=" d-flex    justify-content-between  my-3    " data-bs-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">
								<h4 class=" d-flex align-items-center   "> Full Description </h4>
								<span class="d-flex align-items-center fs-3"><i class="icon-plus"></i></span>
							</div>

							<div class="collapse shadow" id="collapseExample3">
								<div class=" ">
									<div class="row">
										<div class="col-lg-8 col-md-12  details ">
											<p>
												<?php echo $vendor->getDescriptionFull(); ?>
											</p>
										</div>
									</div>
								</div>
							</div>


						</div>
					</div>


					<div class="row">
						<div class="col-lg-12 includes">


							<div class=" d-flex    justify-content-between  my-3   " data-bs-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample4">
								<h4 class=" d-flex align-items-center   "> Includes </h4>
								<span class="d-flex align-items-center fs-3"><i class="icon-plus"></i></span>
							</div>




							<div class="collapse shadow" id="collapseExample4">
								<div class=" ">
									<div class="row">
										<div class="col-lg-8 col-md-12  details ">
											<ul>
												<?php
												if (count($vendor->getIncludedServicesArray()) > 0) {
													foreach ($vendor->getIncludedServicesArray() as $includeServices) {
												?>
														<li>
															<?php if ($includeServices->getIcon() == 1) { ?>
																<i style="color:green" class="fa fa-check fa-lg" aria-hidden="true"></i>
																<span> <?php echo $includeServices->getName(); ?> </span>
															<?php } else { ?>
																<i style="color:red" class="fas fa-engine-warning"></i>
																<span> <?php echo $includeServices->getName(); ?> </span>

															<?php } ?>

														</li>
												<?php
													}
												}
												?>
											</ul>
										</div>
									</div>
								</div>
							</div>

						</div>

					</div>



					<div class="row">
						<div class="col-lg-12">

							<div class=" d-flex    justify-content-between  my-3   " data-bs-toggle="collapse" href="#collapseExample5" role="button" aria-expanded="false" aria-controls="collapseExample5">
								<h4 class=" d-flex align-items-center   "> Important information </h4>
								<span class="d-flex align-items-center fs-3"><i class="icon-plus"></i></span>
							</div>

							<div class="collapse shadow" id="collapseExample5">
								<div class=" ">
									<div class="row">
										<div class="col-lg-8 col-md-12  details ">
											<?php
											if (count($vendor->getImportantInformationArray()) > 0) {
												foreach ($vendor->getImportantInformationArray() as $importantInformation) {
											?>
													<div class="col-sm-12 importantinfosli">
														<b> <?php echo $importantInformation->getHead(); ?> </b>
														<ul class="ps-3">
															<?php
															foreach ($importantInformation->getDescriptions() as $bullet) {
															?>
																<li><i class="fas fa-arrow-circle-right fa-lg"></i> <?php echo $bullet; ?></li>
															<?php
															}
															?>
														</ul>
													</div>
											<?php
												}
											}
											?>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>


					<div class="row">
						<div class="col-lg-12">
							<h5></h5>

							<div class=" d-flex    justify-content-between  my-3   " data-bs-toggle="collapse" href="#collapseExample6" role="button" aria-expanded="false" aria-controls="collapseExample6">
								<h5 class=" d-flex align-items-center   "> All of our supplies have met the seven standards of our rating : </h5>
								<span class="d-flex align-items-center fs-3"><i class="icon-plus"></i></span>
							</div>




							<div class="collapse shadow" id="collapseExample6">
								<div class=" ">
									<div class="row">
										<div class="col-lg-8 col-md-12   ">


											<?php
											foreach ($vendor->getRatedArray() as $ratedCategory) {
												if ($ratedCategory->getStars() != 0) {
											?>
													<div class="row">
														<div class="col-lg-3 ">
															<b><?php echo $ratedCategory->getName(); ?></b>
														</div>
														<div class="col-lg-3 text-start">
															<?php echo str_repeat('<i class="icon_star voted"></i>', $ratedCategory->getStars()); ?>
															<?php echo str_repeat('<i class="icon_star"></i>', $vendor::$MAX_STARS - $ratedCategory->getStars()); ?>
														</div>
													</div>
											<?php
												}
											}
											?>

										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>

		<div style="min-height: 20px"></div>
		<section id="book">
			<div class="container margin_60_35">
				<div class="row">
					<div class="col-lg-8">

						<div class="box_detail booking">
							<div class="price">
								<span>Check availability </span>

							</div>

							<div class="form-group input-dates">
								<input id="date" class="form-control" type="text" name="dates" placeholder="When..">
								<i class="icon_calendar"></i>
							</div>

							<div class="panel-dropdown">
								<a href="#">People <span class="qtyTotal">0</span></a>
								<div class="panel-dropdown-content right">
									<div class="qtyButtons">
										<label>Adults</label>
										<input id="adultsInput" type="text" name="qtyInput" value="0">
									</div>
									<div class="qtyButtons">
										<label>Children</label>
										<input id="childrenInput" type="text" name="qtyInput" value="0">
									</div>
									<div class="qtyButtons">
										<label>Infants</label>
										<input id="infantsInput" type="text" name="qtyInput" value="0">
									</div>
								</div>
							</div>


							<button onclick="getPackagesAvailable();" class=" add_top_30 btn_1 full-width purchase">Check availability</button>
							<!-- <a href="wishlist.html" class="btn_1 full-width outline wishlist"><i class="icon_heart"></i> Add to wishlist</a> -->
							<div class="text-center"><small>No money charged in this step</small></div>
						</div>
						<div id="option"></div>
					</div>
				</div>
			</div>
		</section>


		<?php
		if (count($bestOffs) > 0) {
		?>
			<div id="bestof" class="container container-custom margin_80_55">
				<section class="add_bottom_45">
					<div class="main_title_3">
						<span><em></em></span>
						<h2>Best of Experiences </h2>
						<!-- <p>Some of our favorite experiences </p> -->
					</div>

					<div id="reccomended" class="owl-carousel owl-theme">

						<?php
						foreach ($bestOffs as $vendor) {
							$moneySaved = $vendor->getOriginalPrice() * ($vendor->getDiscount() / 100);
							$totalToPay = $vendor->getOriginalPrice() - $moneySaved - $vendor->getPriceAdult();

						?>
							<div class="item">
								<div class="box_grid">
									<a href="adventure_page.php?id=<?php echo $vendor->getId(); ?>">
										<img src="vendorImages/<?php echo $vendor->getId() . '/' . $vendor->getPathToImage(); ?>" class="img-fluid" alt="" width="800" height="933">
									</a>
									<div class="wrapper best ">
										<small><?php echo $vendor->getCategoryName(); ?></small>
										<h3 class="vendorname"><a href="adventure_page.php?id=<?php echo $vendor->getId(); ?>"><?php echo $vendor->getName(); ?></a></h3>
										<p class="text-muted my-0 label"><?php echo implode(' / ', $vendor->getLabelsBoxNames()); ?></p>

										<span class="criteria">
											Our Criteria Rating
											<?php echo str_repeat('<i class="icon_star voted"></i>', $vendor->getAverageRated()) ?>
											<?php echo str_repeat('<i class="icon_star"></i>', $vendor::$MAX_STARS - $vendor->getAverageRated()) ?>
										</span>
										<p class=""> <span class="voucher_av">Vouchers Available <b> 4/10</b></span> </p>
										<p class="vpvoucher_price2 my-0  "> Buy VP Voucher <b><?php echo $vendor->getPriceAdult(); ?>€ </b> <span class="perperson">per person </span></p>
										<p class="prev_price2 my-0"> <b>Initial Price</b> <s><?php echo $vendor->getOriginalPrice(); ?> € </s> <span class="perperson">per person</span></p>
										<p class="vp_discount my-0 ">You Save <?php echo $vendor->getDiscount(); ?>%</p>
										<p class="final_price2 my-0 mb-2"> Final Price <b><?php echo $totalToPay; ?>€ </b> <span class="perperson">per person</span></p>
										<a href="adventure_page.php?id=<?php echo $vendor->getId(); ?>">
											<div class=" buy_button2"> Book Now </div>
										</a>
									</div>
								</div>
							</div>
						<?php
						}
						?>


					</div>

				</section>
			</div>
		<?php
		}
		?>


	</div>

</main>



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

			<div class="col-lg-12">
				<ul id="additional_links">
					<li><a href="#0"><?php echo $menu[10] ?></a></li>
					<li><a href="#0"><?php echo $menu[11] ?></a></li>
					<li><span>© TechIns</span></li>
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
				Don’t have an account? <a href="#">Sign up</a>
			</div>
			<div id="forgot_pw">
				<div class="form-group">
					<label>Please confirm login email below</label>
					<input type="email" class="form-control" name="email_forgot" id="email_forgot">
					<i class="icon_mail_alt"></i>
				</div>
				<p>You will receive an email containing a link allowing you to reset your password to a new
					preferred one.</p>
				<div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
			</div>
		</div>
	</form>
	<!--form -->
</div>
<!-- /Sign In Popup -->

<div id="toTop"></div><!-- Back to top button -->


<script src="assets/js/common_scripts.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/validate.js"></script>
<!-- INPUT QUANTITY  -->
<script src="assets/js/input_qty.js"></script>
<script src="changeLanguage.js"></script>


<!-- Layers Slider -->
<script src="assets/js/greensock.js"></script>
<script src="assets/js/layerslider.transitions.js"></script>
<script src="assets/js/layerslider.kreaturamedia.jquery.js"></script>
<script>
	'use strict';
	$('#layerslider').layerSlider({
		autoStart: true,
		navButtons: false,
		navStartStop: false,
		showCircleTimer: false,
		responsive: true,
		responsiveUnder: 1280,
		layersContainer: 1200,
		skinsPath: 'assets/css/layerslider/'
		// Please make sure that you didn't forget to add a comma to the line endings
		// except the last line!
	});
</script>



<!-- DATEPICKER  -->

<script>
	$(function() {
		const minDate = new Date();
		minDate.setDate(minDate.getDate() + 1);
		const maxDate = new Date();
		maxDate.setDate(maxDate.getDate() + 15);
		$('input[name="dates"]').daterangepicker({
			autoUpdateInput: false,
			singleDatePicker: true,
			parentEl: '.scroll-fix',
			minDate: minDate,
			maxDate: maxDate,
			opens: 'left',
			locale: {
				cancelLabel: 'Clear'
			}
		});
		$('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('DD-MM-YYYY'));
			$(this).attr('value2', picker.startDate.format('YYYY-MM-DD'))
			// $(this).val(picker.startDate.format('MM-DD-YY') + ' > ' + picker.endDate.format('MM-DD-YY'));
		});
		$('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});
	});
	document.querySelector('.icon_calendar').addEventListener(
		'click', () => {
			document.getElementById('date').click();
		}
	);
</script>




</body>
<script src="backend/js/cart.js"></script>

</html>