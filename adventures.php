<?php
if (!isset($conn)) {
	include 'connection.php';
}
if (!isset($_GET['id'])) {
	header('location: index.php');
}
include 'backend/includeClasses.php';
include 'initializeExperience.php';
$title = "Adventures";
$home = 0;
include_once 'includes/header.php';
$idDestination = $_GET['id'];
$languageId = 1;
$vendors = getVendors($conn, $idDestination, $languageId);
$bestOffs = getVendors($conn, $idDestination, $languageId, true);
if (count($vendors) <= 0) {
	//   header('location: index.php');
}
?>

<main>
	<section class="header-video adventure">
		<div id="hero_video">
			<div class="wrapper">
				<div class="container container-custom">
					<h3 >Location Name</h3>
					<p>Hosted journeys to  extraordinary  and unique places.</p>
					<a href="#bestof" class="btn_1">Explore more</a>
				</div>
			</div>
		</div>

		<video src="assets/videos/vid2.mp4" autoplay loop playsinline muted></video>
		<!-- <img src="assets/img/10.jpg" alt="" class="header-video--media" data-video-src="video/adventure" data-teaser-source="video/adventure" data-provider="" data-video-width="1920" data-video-height="960"> -->
	</section>
	<!-- /header-video -->

	<div id="bestof" class="container container-custom margin_80_55">
		<section class="add_bottom_45">
			<div class="main_title_3">
				<span><em></em></span>
				<h2>Best of Experiences </h2>
				<p>Some of our favorite experiences </p>
			</div>

			<div id="reccomended" class="owl-carousel owl-theme">

				<div class="item">
					<div class="box_grid">
						<a href="adventure_page.php"><img src="assets/img/10.jpg" class="img-fluid" alt="" width="800" height="933">
						</a>
						<div class="wrapper best  ">
							<small>Historic</small>
							<h3><a href="adventure_page.php"><b>Syros :</b> Climbing</a></h3>
							<p class="text-muted my-0 label">5 hours /Small Group</p>
							
							<p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu</p>

							<span class="criteria"> Our Criteria Rating <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"> <i class="icon_star voted"></i> </i> <i class="icon_star "></i> </span>
							<p class=""> <span class="voucher_av">Vouchers Available <b> 4/10</b></span> </p>
							<p class="prev_price2 my-0"> Initial Price <s>120 € </s> <span class="perperson">per person</span></p>
							<p class="vpvoucher_price2 my-0  ">Buy VP Voucher <b>12€ </b> <span class="perperson">per person</span></p>
							<p class="vp_discount my-0 ">You Save 30% or 24 € </p>
							<p class="final_price2 my-0 mb-2"> Final Price <b>84€ </b> <span class="perperson">per person</span></p>
							<a href="adventure_page.php#book"><div class=" buy_button2" > Book Now  </div></a> 
						</div>
					</div>
				</div>
				
				<div class="item">
					<div class="box_grid">
						<a href="adventure_page.php"><img src="assets/img/4.jpg" class="img-fluid" alt="" width="800" height="933">
						</a>
						<div class="wrapper best  ">
							<small>Watersports</small>
							<h3><a href="adventure_page.php"><b>Syros :</b> Climbing</a></h3>
							<p class="text-muted my-0 label">2 hours /Big Group</p>
							<p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu. b</p>
							<span class="criteria"> Our Criteria Rating <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"> <i class="icon_star voted"></i> </i> <i class="icon_star "></i> </span>
							<p class=""> <span class="voucher_av">Vouchers Available <b> 4/10</b></span> </p>
							<p class="prev_price2 my-0"> Initial Price <s>120 € </s> <span class="perperson">per person</span></p>
							<p class="vpvoucher_price2 my-0  ">Buy VP Voucher <b>12€ </b> <span class="perperson">per person</span></p>
							<p class="vp_discount my-0 ">You Save 30% or 24 € </p>
							<p class="final_price2 my-0 mb-2"> Final Price <b>84€ </b> <span class="perperson">per person</span></p>
							<a href="adventure_page.php#book"><div class=" buy_button2" > Book Now  </div></a> 
						</div>
					</div>
				</div>
				<div class="item">
					<div class="box_grid">
						<a href="adventure_page.php"><img src="assets/img/slider_images/happy1.webp" class="img-fluid" alt="" width="800" height="933">
						</a>
						<div class="wrapper best  ">
							<small>Gastronomy</small>
							<h3><a href="adventure_page.php"><b>Syros :</b> Food</a></h3>
							<p class="text-muted my-0 label">2 hours /Big Group</p>
							<p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu. b</p>
							<span class="criteria"> Our Criteria Rating <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"> <i class="icon_star voted"></i> </i> <i class="icon_star "></i> </span>
							<p class=""> <span class="voucher_av">Vouchers Available <b> 4/10</b></span> </p>
							<p class="prev_price2 my-0"> Initial Price <s>120 € </s> <span class="perperson">per person</span></p>
							<p class="vpvoucher_price2 my-0  ">Buy VP Voucher <b>12€ </b> <span class="perperson">per person</span></p>
							<p class="vp_discount my-0 ">You Save 30% or 24 € </p>
							<p class="final_price2 my-0 mb-2"> Final Price <b>84€ </b> <span class="perperson">per person</span></p>
							<a href="adventure_page.php#book"><div class=" buy_button2" > Book Now  </div></a> 
						</div>
					</div>
				</div>
				<div class="item">
					<div class="box_grid">
						<a href="adventure_page.php"><img src="assets/img/slider_images/happy2.webp" class="img-fluid" alt="" width="800" height="933">
						</a>
						<div class="wrapper best  ">
							<small>Gastronomy</small>
							<h3><a href="adventure_page.php"><b>Syros :</b> Traditional </a></h3>
							<p class="text-muted my-0 label">3 hours /Small Group</p>
							<p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu. b</p>
							<span class="criteria"> Our Criteria Rating <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"> <i class="icon_star voted"></i> </i> <i class="icon_star "></i> </span>
							<p class=""> <span class="voucher_av">Vouchers Available <b> 4/10</b></span> </p>
							<p class="prev_price2 my-0"> Initial Price <s>120 € </s> <span class="perperson">per person</span></p>
							<p class="vpvoucher_price2 my-0  ">Buy VP Voucher <b>12€ </b> <span class="perperson">per person</span></p>
							<p class="vp_discount my-0 ">You Save 30% or 24 € </p>
							<p class="final_price2 my-0 mb-2"> Final Price <b>84€ </b> <span class="perperson">per person</span></p>
							<a href="adventure_page.php#book"><div class=" buy_button2" > Book Now  </div></a> 
						</div>
					</div>
				</div>
				<div class="item">
					<div class="box_grid">
						<a href="adventure_page.php"><img src="assets/img/slider_images/happy3.webp" class="img-fluid" alt="" width="800" height="933">
						</a>
						<div class="wrapper best  ">
							<small>Gastronomy</small>
							<h3><a href="adventure_page.php"><b>Syros :</b> Traditional </a></h3>
							<p class="text-muted my-0 label">3 hours /Small Group</p>
							<p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu. b</p>
							<span class="criteria"> Our Criteria Rating <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"> <i class="icon_star voted"></i> </i> <i class="icon_star "></i> </span>
							<p class=""> <span class="voucher_av">Vouchers Available <b> 4/10</b></span> </p>
							<p class="prev_price2 my-0"> Initial Price <s>120 € </s> <span class="perperson">per person</span></p>
							<p class="vpvoucher_price2 my-0  ">Buy VP Voucher <b>12€ </b> <span class="perperson">per person</span></p>
							<p class="vp_discount my-0 ">You Save 30% or 24 € </p>
							<p class="final_price2 my-0 mb-2"> Final Price <b>84€ </b> <span class="perperson">per person</span></p>
							<a href="adventure_page.php#book"><div class=" buy_button2" > Book Now  </div></a> 
						</div>
					</div>
				</div>
				<div class="item">
					<div class="box_grid">
						<a href="adventure_page.php"><img src="assets/img/slider_images/happy4.webp" class="img-fluid" alt="" width="800" height="933">
						</a>
						<div class="wrapper best  ">
							<small>Gastronomy</small>
							<h3><a href="adventure_page.php"><b>Syros :</b> Traditional </a></h3>
							<p class="text-muted my-0 label">3 hours /Small Group</p>
							<p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu. b</p>
							<span class="criteria"> Our Criteria Rating <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"> <i class="icon_star voted"></i> </i> <i class="icon_star "></i> </span>
							<p class=""> <span class="voucher_av">Vouchers Available <b> 4/10</b></span> </p>
							<p class="prev_price2 my-0"> Initial Price <s>120 € </s> <span class="perperson">per person</span></p>
							<p class="vpvoucher_price2 my-0  ">Buy VP Voucher <b>12€ </b> <span class="perperson">per person</span></p>
							<p class="vp_discount my-0 ">You Save 30% or 24 € </p>
							<p class="final_price2 my-0 mb-2"> Final Price <b>84€ </b> <span class="perperson">per person</span></p>
							<a href="adventure_page.php#book"><div class=" buy_button2" > Book Now  </div></a> 
						</div>
					</div>
				</div>


			</div>

		</section>
	</div>



	<div class="container   text-center my-2">
		<div class="main_title_3 d-block">
			<h2>Type of experience</h2>
		</div>
		<div class="form-check form-check-inline ">
			<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" />
			<label class="form-check-label" for="inlineCheckbox1">Category 1</label>
		</div>

		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
			<label class="form-check-label" for="inlineCheckbox2">Category 2</label>
		</div>

		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" />
			<label class="form-check-label" for="inlineCheckbox3"> Category 3 </label>
		</div>
	</div>



	<div class="container">
		<div class="isotope-wrapper">
			<div class="row">

				<?php
				// foreach ($bestOffs as $vendorBestOff) {

				// }
				?>


					<div class="col-xl-4 col-lg-6 col-md-6 isotope-item popular">
					<div class="box_grid">
						<figure>
							<a href="adventure_page.php#book"><img src="assets/img/10.jpg" class="img-fluid" alt="" width="800" height="533">
							</a>
						</figure>
						<div class="wrapper best  ">
							<small>Historic</small>
							<h3><a href="adventure_page.php#book"><b>Syros :</b> Climbing</a></h3>
							<p class="text-muted my-0 label">3 hours /Small Group</p>
							<p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu. b</p>

							<span class="criteria"> Our Criteria Rating <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"> <i class="icon_star voted"></i> </i> <i class="icon_star "></i> </span>
							<p class=""> <span class="voucher_av">Vouchers Available <b> 4/10</b></span> </p>
							<p class="prev_price2 my-0"> Initial Price <s>120 € </s> <span class="perperson">per person</span></p>
							<p class="vpvoucher_price2 my-0  ">Buy VP Voucher <b>12€ </b> <span class="perperson">per person</span></p>
							<p class="vp_discount my-0 ">You Save 30% or 24 € </p>
							<p class="final_price2 my-0 mb-2"> Final Price <b>84€ </b> <span class="perperson">per person</span></p>
							<a href="adventure_page.php#book"><div class=" buy_button2" > Book Now  </div></a> 
						</div>
						</div>
					</div>


					<div class="col-xl-4 col-lg-6 col-md-6 isotope-item popular">
					<div class="box_grid">
						<figure>
							<a href="adventure_page.php#book"><img src="assets/img/4.jpg" class="img-fluid" alt="" width="800" height="533">
							</a>
						</figure>
						<div class="wrapper best  ">
							<small>Historic</small>
							<h3><a href="adventure_page.php#book"><b>Syros :</b> Swimming</a></h3>
							<p class="text-muted my-0 label">3 hours /Small Group</p>
							<p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu. b</p>

							<span class="criteria"> Our Criteria Rating <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"> <i class="icon_star voted"></i> </i> <i class="icon_star "></i> </span>
							<p class=""> <span class="voucher_av">Vouchers Available <b> 4/10</b></span> </p>
							<p class="prev_price2 my-0"> Initial Price <s>120 € </s> <span class="perperson">per person</span></p>
							<p class="vpvoucher_price2 my-0  ">Buy VP Voucher <b>12€ </b> <span class="perperson">per person</span></p>
							<p class="vp_discount my-0 ">You Save 30% or 24 € </p>
							<p class="final_price2 my-0 mb-2"> Final Price <b>84€ </b> <span class="perperson">per person</span></p>
							<a href="adventure_page.php#book"><div class=" buy_button2" > Book Now  </div></a> 
						</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-6 col-md-6 isotope-item popular">
					<div class="box_grid">
						<figure>
							<a href="adventure_page.php#book"><img src="assets/img/4.jpg" class="img-fluid" alt="" width="800" height="533">
							</a>
						</figure>
						<div class="wrapper best  ">
							<small>Historic</small>
							<h3><a href="adventure_page.php#book"><b>Syros :</b> Swimming</a></h3>
							<p class="text-muted my-0 label">3 hours /Small Group</p>
							<p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu. b</p>

							<span class="criteria"> Our Criteria Rating <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"> <i class="icon_star voted"></i> </i> <i class="icon_star "></i> </span>
							<p class=""> <span class="voucher_av">Vouchers Available <b> 4/10</b></span> </p>
							<p class="prev_price2 my-0"> Initial Price <s>120 € </s> <span class="perperson">per person</span></p>
							<p class="vpvoucher_price2 my-0  ">Buy VP Voucher <b>12€ </b> <span class="perperson">per person</span></p>
							<p class="vp_discount my-0 ">You Save 30% or 24 € </p>
							<p class="final_price2 my-0 mb-2"> Final Price <b>84€ </b> <span class="perperson">per person</span></p>
							<a href="adventure_page.php#book"><div class=" buy_button2" > Book Now  </div></a> 
						</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-6 col-md-6 isotope-item popular">
					<div class="box_grid">
						<figure>
							<a href="adventure_page.php#book"><img src="assets/img/slider_images/happy3.webp" class="img-fluid" alt="" width="800" height="533">
							</a>
						</figure>
						<div class="wrapper best  ">
							<small>Historic</small>
							<h3><a href="adventure_page.php#book"><b>Syros :</b> Swimming</a></h3>
							<p class="text-muted my-0 label">5 hours /Big Group</p>
							<p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu. b</p>

							<span class="criteria"> Our Criteria Rating <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"> <i class="icon_star voted"></i> </i> <i class="icon_star "></i> </span>
							<p class=""> <span class="voucher_av">Vouchers Available <b> 4/10</b></span> </p>
							<p class="prev_price2 my-0"> Initial Price <s>120 € </s> <span class="perperson">per person</span></p>
							<p class="vpvoucher_price2 my-0  ">Buy VP Voucher <b>12€ </b> <span class="perperson">per person</span></p>
							<p class="vp_discount my-0 ">You Save 30% or 24 € </p>
							<p class="final_price2 my-0 mb-2"> Final Price <b>84€ </b> <span class="perperson">per person</span></p>
							<a href="adventure_page.php#book"><div class=" buy_button2" > Book Now  </div></a> 
						</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-6 col-md-6 isotope-item popular">
					<div class="box_grid">
						<figure>
							<a href="adventure_page.php#book"><img src="assets/img/slider_images/happy2.webp" class="img-fluid" alt="" width="800" height="533">
							</a>
						</figure>
						<div class="wrapper best  ">
							<small>Watersports</small>
							<h3><a href="adventure_page.php#book"><b>Syros :</b> Scuba Diving</a></h3>
							<p class="text-muted my-0 label">5 hours /Big Group</p>
							<p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu. b</p>

							<span class="criteria"> Our Criteria Rating <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"> <i class="icon_star voted"></i> </i> <i class="icon_star "></i> </span>
							<p class=""> <span class="voucher_av">Vouchers Available <b> 4/10</b></span> </p>
							<p class="prev_price2 my-0"> Initial Price <s>120 € </s> <span class="perperson">per person</span></p>
							<p class="vpvoucher_price2 my-0  ">Buy VP Voucher <b>12€ </b> <span class="perperson">per person</span></p>
							<p class="vp_discount my-0 ">You Save 30% or 24 € </p>
							<p class="final_price2 my-0 mb-2"> Final Price <b>84€ </b> <span class="perperson">per person</span></p>
							<a href="adventure_page.php#book"><div class=" buy_button2" > Book Now  </div></a> 
						</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-6 col-md-6 isotope-item popular">
					<div class="box_grid">
						<figure>
							<a href="adventure_page.php#book"><img src="assets/img/slider_images/happy1.webp" class="img-fluid" alt="" width="800" height="533">
							</a>
						</figure>
						<div class="wrapper best  ">
							<small>Historic</small>
							<h3><a href="adventure_page.php#book"><b>Syros :</b> Swimming</a></h3>
							<p class="text-muted my-0 label">5 hours /Big Group</p>
							<p>Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu. b</p>

							<span class="criteria"> Our Criteria Rating <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"> <i class="icon_star voted"></i> </i> <i class="icon_star "></i> </span>
							<p class=""> <span class="voucher_av">Vouchers Available <b> 4/10</b></span> </p>
							<p class="prev_price2 my-0"> Initial Price <s>120 € </s> <span class="perperson">per person</span></p>
							<p class="vpvoucher_price2 my-0  ">Buy VP Voucher <b>12€ </b> <span class="perperson">per person</span></p>
							<p class="vp_discount my-0 ">You Save 30% or 24 € </p>
							<p class="final_price2 my-0 mb-2"> Final Price <b>84€ </b> <span class="perperson">per person</span></p>
							<a href="adventure_page.php#book"><div class=" buy_button2" > Book Now  </div></a> 
						</div>
						</div>
					</div>

				</div>


			</div>
			<!-- /row -->
		</div>
	</div>

	</div>


</main>
<!-- /main -->

<footer>
	<div class="container margin_60_35">
		<div class="row">
			<div class="col-lg-5 col-md-12 pe-5">
				<p><img src="assets/img/valuepass3logo.png" width="100" height="100" alt=""></p>
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
				<ul class="links">
					<li><a href="#"> <?php echo $menu[1] ?></a></li>
					<li><a href="#"> <?php echo $menu[4] ?> </a></li>
					<li><a href="cart-1.php"><?php echo $menu[7] ?></a></li>
					<li><a href="#"> <?php echo $menu[5] ?></a></li>

				</ul>
			</div>
			<div class="col-lg-3 col-md-6">
				<h5><?php echo $menu[9] ?></h5>
				<ul class="contacts">
					<li><a href="tel://61280932400"><i class="ti-mobile"></i> + 61 23 8093 3400</a></li>
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

<!-- SPECIFIC SCRIPTS -->
<!-- <script src="assets/js/video_header.js"></script>
	<script>
		HeaderVideo.init({
			container: $('.header-video'),
			header: $('.header-video--media'),
			videoTrigger: $("#video-trigger"),
			autoPlayVideo: true
		});
	</script> -->

<!-- COLOR SWITCHER  -->
<!-- <script src="js/switcher.js"></script> -->
<!-- <div id="style-switcher">
        <h6>Color Switcher <a href="#"><i class="ti-settings"></i></a></h6>
        <div>
            <ul class="colors" id="color1">
                <li>
                    <a href="#" class="default" title="Default"></a>
                </li>
                <li>
                    <a href="#" class="aqua" title="Aqua"></a>
                </li>
                <li>
                    <a href="#" class="green_switcher" title="Green"></a>
                </li>
                <li>
                    <a href="#" class="orange" title="Orange"></a>
                </li>
                <li>
                    <a href="#" class="blue" title="Blue"></a>
                </li>
                <li>
                    <a href="#" class="beige" title="Beige"></a>
                </li>
                <li>
                    <a href="#" class="gray" title="Gray"></a>
                </li>
                <li>
                    <a href="#" class="green-2" title="Green"></a>
                </li>
                <li>
                    <a href="#" class="navy" title="Navy"></a>
                </li>
                <li>
                    <a href="#" class="peach" title="Peach"></a>
                </li>
                <li>
                    <a href="#" class="purple" title="Purple"></a>
                </li>
                <li>
                    <a href="#" class="red" title="Red"></a>
                </li>
                <li>
                    <a href="#" class="violet" title="Violet"></a>
                </li>
            </ul>
        </div>
    </div> -->


</body>

<script src="changeLanguage.js"></script>

</html>