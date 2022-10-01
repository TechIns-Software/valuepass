<?php
if (!isset($conn)) {
	include 'connection.php';
}
$title = "How it works | ValuePass";
$home = 0;
include_once 'includes/header.php';
$idLanguage = $_SESSION["languageId"];
$destinations = getDestinations($conn, $idLanguage);
getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber);
?>

<main>
	<div style="min-height: 90px;"></div>
	<div id="how" class="container margin_80_55">
		<div class="main_title_2">
			<h1> <b>How it works </b></h1>
			<p>Learn how you can spend less money and doing it more</p>
		</div>

	</div>


	<section id="questions" class="section">
		<div class="container">
			<div class="row">
				<!--Start Accordion-->
				<div class="col-12">
					<div class="panel-group accordion-main" id="accordion">

						<!--About accordion #9-->

						<div class="panel-heading collapsed " data-bs-toggle="collapse" href="#collapse1" role="button" aria-expanded="true" aria-controls="collapseExample">
							<h6 class="panel-title accordion-toggle">
								<b>Step 1. </b> Choose your Destination
							</h6>
						</div>
						<div id="collapse1" class=" collapse">
							<div class="panel-body">
								<div class="row p-4">
									<div class="col-lg-4 col-md-6 col-6">
										<h3 class="text-muted">Syros</h3>
									</div>
									<div class="col-lg-4 col-md-6 col-6">
										<h3 class="text-muted">Tinos</h3>
									</div>
									<div class="col-lg-4 col-md-6 col-6">
										<h3 class="text-muted">Mykonos</h3>
									</div>
									<div class="col-lg-4 col-md-6 col-6">
										<h3 class="text-muted">Paros</h3>
									</div>
									<div class="col-lg-4 col-md-6 col-6">
										<h3 class="text-muted">Naxos</h3>
									</div>
									<div class="col-lg-4 col-md-6 col-6">
										<h3 class="text-muted">Santorini</h3>
									</div>
									<div class="col-lg-4 col-md-6 col-6">
										<h3 class="text-muted">Chania-Crete</h3>
									</div>
									<div class="col-lg-4 col-md-6 col-6">
										<h3 class="text-muted">Athens</h3>
									</div>
								</div>
							</div>
						</div>


						<div class="panel-heading collapsed " data-bs-toggle="collapse" href="#collapse2" role="button" aria-expanded="true" aria-controls="collapseExample">
							<h6 class="panel-title accordion-toggle">
								<b>Step 2. </b> Choose your experience / Book your activity / Choose your schedule / Add to the cart
							</h6>
						</div>
						<div id="collapse2" class=" collapse">
							<div class="panel-body px-4">

								<p> • Buy your vouchers on board reserve your spot, and pay the provider with a discount when you arrive at your activity location. (Check your activity voucher once you book for full details). </p>
							</div>
						</div>



						<div class="panel-heading  collapsed" data-bs-toggle="collapse" href="#collapse3" role="button" aria-expanded="true" aria-controls="collapseExample">
							<h6 class="panel-title accordion-toggle">
								<b>Step 3. </b> Buy at least two (2) Vouchers with 3 or more you get for free vouchers and your presents never end!
							</h6>

						</div>
						<div id="collapse3" class=" collapse">
							<div class="panel-body">
								<div class="row px-4">
									<p class="m-0"> Save from 20% to 30% discount on the initial price </p>

									<h6> <i class="fa-solid fa-money-bill"></i> 3 Vouchers from + extra <b> 1 </b> free Voucher </h6>


									<h6> <i class="fa-solid fa-money-bill"></i> 4 Vouchers from + extra <b>2 </b> free Voucher </h6>


									<h6> <i class="fa-solid fa-money-bill"></i> 5 Vouchers from + extra <b> 3</b> free Voucher </h6>


									<h6> <i class="fa-solid fa-money-bill"></i> 6 Vouchers from + extra <b> 4 </b> free Voucher </h6>


									<h6> <i class="fa-solid fa-money-bill"></i> 7 Vouchers from + extra <b> 4 </b> free Voucher </h6>

								</div>

							</div>
						</div>


						<div class="panel-heading  collapsed" data-bs-toggle="collapse" href="#collapse4" role="button" aria-expanded="true" aria-controls="collapseExample">
							<h6 class="panel-title accordion-toggle">
								<b>Step 4. </b> Enter your name, phone number, and email address here.
							</h6>
						</div>
						<div id="collapse4" class=" collapse">
							<div class="panel-body">
								<div class="row px-4">
									<p class="m-0"> <b> Name : </b> </p>
									<p class="m-0"> <b> Phone: </b> <small>(all calls are made through Viber, Whatsapp, or other free calling apps unless otherwise stated)</small> </p>
									<p class="m-0"> <b> Email : </b> </p>
									<ul>
                                        <li> • By signing up, I agree that the activity provider may be informed of my booking via email under the ValuePass privacy policy</li>
                                        <li> •	We inform you that your personal data is used exclusively and only for the scope you have submitted to us and is destroyed after three months. (name, phone number, email).</li>
                                        <li> • We inform you that your personal data is used exclusively and only for the scope you have submitted to us and is destroyed after three months. (name, phone number, email)</li>
									</ul>

								</div>

							</div>
						</div>

						<div class="panel-heading collapsed  " data-bs-toggle="collapse" href="#collapse5" role="button" aria-expanded="true" aria-controls="collapseExample">
							<h6 class="panel-title accordion-toggle">
								<b>Step 5. </b> Pay with your credit card and receive the QR code and all needed information in your email <small> (Supplier Information – Contact Details + Google Maps Location Pin, etc.)</small>
							</h6>
						</div>
						<div id="collapse5" class=" collapse">
							<div class="panel-body">
								<div class="row px-4">
									<ul>
										<li> • If you are unable to attend the attraction, you must cancel it at least from 12 hours to 24 hours in advance, depending on the activity provider. (Check your activity voucher once you book for full details)</li>
										<li> • We would like to inform you that your credit card details are immediately deleted at the end of the payment process. </li>
									</ul>
								</div>

							</div>
						</div>





					</div>
					<!--/.row-->
				</div>
			</div>
		</div>
		<!--/.container-->
		</div>
	</section>


	<div class="container container-custom margin_80_55 col-lg-12 ">
		<section class="add_bottom_45">
			<div class="main_title_2">
				<span><em></em></span>
				<h2>Destinations</h2>
				<p>Check here the available destinations</p>
			</div>

			<div id="reccomended_adventure" class="owl-carousel owl-theme">

				<!-- version 1 carsouel ready css
						<div class="item">
							<a href="adventure-detail.html" class="grid_item_adventure">
								<figure>
									<div class="score"><strong>7.9</strong></div>
									<img src="assets/img/10.jpg" class="img-fluid" alt="">
									<div class="info">
										<em>3 days in Patagonia</em>
										<h3>Horseback ride through Valencia</h3>
									</div>
								</figure>
							</a>
						</div>  -->
				<?php
				foreach ($destinations as $destination) {
				?>
					<div class="item" onclick="location.href='./adventures.php?id=<?php echo $destination->getId(); ?>';">
						<div class="card text-white card-has-bg click-col" style="background-image:url('images/location_images/<?php echo $destination->getImage1(); ?>');">
							<!-- <img class="card-img d-none" src="https://source.unsplash.com/600x900/?mykonos" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?"> -->
							<div class="card-img-overlay d-flex flex-column">
								<div class="card-body">
								</div>
								<div class="card-footer">
									<h4 class="card-title mt-0 "><a class="text-white" href="adventures.php?id=<?php echo $destination->getId(); ?>"><?php echo $destination->getName(); ?></a></h4>
									<small class="card-meta mb-2"><?php echo $destination->getNumberOfVendors(); ?> Activities</small>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
				?>



			</div>

		</section>
	</div>


</main>


<footer>
	<div class="container margin_60_35">
		<div class="row">
			<div class="col-lg-5 col-md-12 pe-5">
				<p><img src="assets/img/valuepassLogo.png" width="180" height="100" alt="Logo"></p>
				<p>Escape the tourist traps with unforgettable travel experiences.<br> Get beneath the surface of these destinations.<br>
					All our proposals are hand-picked by our team! </p>
				<b> Get inspired for your next trip </b>

				<div class="follow_us">
					<ul>
						<li><?php echo $menu[12] ?> </li>
						<li><a><i class="ti-facebook"></i></a></li>
						<li><a><i class="ti-twitter-alt"></i></a></li>
						<li><a><i class="ti-google"></i></a></li>
						<li><a><i class="ti-pinterest"></i></a></li>
						<li><a><i class="ti-instagram"></i></a></li>
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
                    <li><a href="<?php echo $idLanguage == 1 ? 'terms_gr.pdf':'terms_gb.pdf' ?>" target="_blank"><?php echo $menu[10] ?></a></li>
					<li><a><?php echo $menu[11] ?></a></li>
					<li><span>© ValuePass</span></li>
				</ul>
			</div>
		</div>
	</div>
</footer>
<!--/footer-->
</div>
<!-- page -->


<div id="toTop"></div><!-- Back to top button -->

<!-- COMMON SCRIPTS -->
<script src="assets/js/common_scripts.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/validate.js"></script>

<!-- SLIDER REVOLUTION SCRIPTS  -->
<script src="assets/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
<script src="assets/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.actions.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.migration.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.video.min.js"></script>
<script src="assets/js/revapi44.js"></script>

<script>
	var tpj = jQuery;

	var revapi44;
	tpj(document).ready(function() {
		if (tpj("#rev_slider_44").revolution == undefined) {
			revslider_showDoubleJqueryError("#rev_slider_44");
		} else {
			revapi44 = tpj("#rev_slider_44").show().revolution({
				sliderType: "standard",
				jsFileLocation: "assets/revolution-slider/js/",
				sliderLayout: "fullscreen",
				dottedOverlay: "none",
				delay: 4500,
				navigation: {
					keyboardNavigation: "on",
					keyboard_direction: "horizontal",
					mouseScrollNavigation: "off",
					mouseScrollReverse: "default",
					onHoverStop: "off",
					touch: {
						touchenabled: "on",
						touchOnDesktop: "on",
						swipe_threshold: 75,
						swipe_min_touches: 1,
						swipe_direction: "horizontal",
						drag_block_vertical: false
					},
					arrows: {
						enable: true,
						style: 'erinyen',
						tmp: '',
						rtl: false,
						hide_onleave: true,
						hide_onmobile: true,
						hide_under: 767,
						hide_over: 9999,
						hide_delay: 0,
						hide_delay_mobile: 0,

						left: {
							container: 'slider',
							h_align: 'left',
							v_align: 'center',
							h_offset: 60,
							v_offset: 0
						},

						right: {
							container: 'slider',
							h_align: 'right',
							v_align: 'center',
							h_offset: 60,
							v_offset: 0
						}
					},
					bullets: {
						enable: true,
						style: 'zeus',
						direction: 'horizontal',
						rtl: false,

						container: 'slider',
						h_align: 'center',
						v_align: 'bottom',
						h_offset: 0,
						v_offset: 30,
						space: 7,

						hide_onleave: false,
						hide_onmobile: false,
						hide_under: 0,
						hide_over: 767,
						hide_delay: 200,
						hide_delay_mobile: 1200
					},
				},
				responsiveLevels: [1240, 1025, 778, 480],
				visibilityLevels: [1920, 1500, 1025, 768],
				gridwidth: [1200, 991, 778, 480],
				gridheight: [1025, 1366, 1025, 868],
				lazyType: "none",
				shadow: 0,
				spinner: "spinner4",
				stopLoop: "off",
				stopAfterLoops: -1,
				stopAtSlide: -1,
				shuffle: "off",
				autoHeight: "on",
				fullScreenAutoWidth: "on",
				fullScreenAlignForce: "off",
				fullScreenOffsetContainer: "",
				disableProgressBar: "on",
				hideThumbsOnMobile: "on",
				hideSliderAtLimit: 0,
				hideCaptionAtLimit: 0,
				hideAllCaptionAtLimit: 0,
				debugMode: false,
				fallbacks: {
					simplifyAll: "off",
					nextSlideOnWindowFocus: "off",
					disableFocusListener: false,
				}
			});
		}
	});
</script>




<script src="changeLanguage.js"></script>



</body>

</html>