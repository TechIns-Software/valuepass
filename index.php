<?php
if (!isset($conn)) {
	include 'connection.php';
}
$title = "Homepage | ValuePass";
$home = 1;
include_once 'includes/header.php';
$idLanguage = $_SESSION["languageId"];
$destinations = getDestinations($conn, $idLanguage);
?>

<main>
	<!-- START SLIDER -->
	<div id="rev_slider_44_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="mask-showcase" data-source="gallery">
		<!-- Start revolution slider 5.4.8 fullscreen mode -->
		<div id="rev_slider_44" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.8">
			<ul>
				<!-- start slide 01 -->
				<li data-index="rs-73" data-transition="zoomout" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power1.easeInOut" data-easeout="Power2.easeInOut" data-masterspeed="1500" data-rotate="0" data-saveperformance="off" data-title="01" data-param1="01" data-description="">
					<!-- main image -->
					<img src="assets/img/slider_images/1small.jpg" alt="" data-bgcolor="#ccc" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="off" class="rev-slidebg" data-no-retina>
					<div class="rev-slider-mask"></div>
					<!-- main text layer -->
					<div class="tp-caption tp-resizeme text-white text-center" id="slide-411-layer-01" data-frames='[{"delay":200,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]' data-type="text" data-whitespace="nowrap" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-50','-50','-115','-65']" data-width="auto" data-height="auto" data-fontsize="['50','43','40','25']" data-lineheight="['70','45','60','30']" data-letterspacing="['-2','-1','-1','-1']" data-responsive="off" data-responsive_offset="off" data-paddingtop="['0','0','0','0']" data-paddingbottom="['15','8','8','8']" data-paddingright="['0','0','0','0']" data-paddingleft="['0','0','0','0']" style="text-shadow: 0 0 20px rgba(0,0,0,0.3); font-weight: 600;"> Spend less <br>  doing more</div>
					<!-- btn layer -->
					<a class="tp-caption tp-resizeme rs-btn btn_1" href="#how" id="slide-411-layer-03" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['152','130','82','80']" data-whitespace="nowrap" data-type="button" data-responsive="off" data-responsive_offset="off" data-frames='[{"delay":1200,"speed":1000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']">How it works
					</a>
				</li>
				<!-- end slide 01 -->
				<!-- start slide 02 -->
				<li data-index="rs-74" data-transition="fadetotopfadefrombottom" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="1500" data-rotate="0" data-saveperformance="off" data-title="02" data-param1="02" data-description="">
					<!-- main image -->
					<img src="assets/img/slider_images/2small.jpg" alt="" data-bgcolor="#ccc" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="off" class="rev-slidebg" data-no-retina>
					<div class="rev-slider-mask"></div>
					<!-- main text layer -->
					<div class="tp-caption tp-resizeme alt-font text-white font-weight-600 text-center" id="slide-411-layer-04" data-frames='[{"delay":200,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]' data-type="text" data-whitespace="nowrap" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-50','-50','-115','-65']" data-width="auto" data-height="auto" data-fontsize="['60','43','30','25']" data-lineheight="['70','59','70','39']" data-letterspacing="['-2','-1','-1','-1']" data-responsive="off" data-responsive_offset="off" data-paddingtop="['0','0','0','0']" data-paddingbottom="['15','8','8','8']" data-paddingright="['0','0','0','0']" data-paddingleft="['0','0','0','0']" style="text-shadow: 0 0 20px rgba(0,0,0,0.3); font-weight: 600"> Discover authentic experiences <br> with a single click! </div>
					<!-- btn layer -->
					<a class="tp-caption tp-resizeme rs-btn btn_1" href="#how" id="slide-411-layer-06" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['152','130','82','80']" data-whitespace="nowrap" data-type="button" data-responsive="off" data-responsive_offset="off" data-frames='[{"delay":1200,"speed":1000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingleft="['34','34','34','34']">How it works
					</a>
				</li>
				<!-- end slide 02 -->
				<!-- start slide 03 -->
				<li data-index="rs-75" data-transition="fadetotopfadefrombottom" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="1500" data-rotate="0" data-saveperformance="off" data-title="03" data-param1="03" data-description="">
					<!-- main image -->
					<img src="assets/img/slider_images/3small.jpg" alt="" data-bgcolor="#ccc" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="off" class="rev-slidebg" data-no-retina>

					<div class="rev-slider-mask"></div>

					<!-- main text layer -->
					<div class="tp-caption tp-resizeme text-white text-center" id="slide-411-layer-07" data-frames='[{"delay":200,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]' data-type="text" data-whitespace="nowrap" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-50','-50','-115','-65']" data-width="auto" data-height="auto" data-fontsize="['60','43','30','25']" data-lineheight="['70','59','70','39']" data-letterspacing="['-2','-1','-1','-1']" data-responsive="off" data-responsive_offset="off" data-paddingtop="['0','0','0','0']" data-paddingbottom="['15','8','8','8']" data-paddingright="['0','0','0','0']" data-paddingleft="['0','0','0','0']" style="text-shadow: 0 0 20px rgba(0,0,0,0.3); font-weight: 600">Explore hand-picked gems <br> at your ease!  
					</div>

					<!-- btn layer -->
					<a class="tp-caption tp-resizeme rs-btn btn_1" href="#how" id="slide-411-layer-09" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['152','130','82','80']" data-whitespace="nowrap" data-type="button" data-responsive="off" data-responsive_offset="off" data-frames='[{"delay":1200,"speed":1000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']">How it works
					</a>
				</li>
				<!-- end slide 03 -->

			</ul>
		</div>
	</div>
	<!-- END REVOLUTION SLIDER -->

	<div class="bg_color_1 shadow bgbanner">
		<div class="container container-custom margin_80_55 ">
			<div class="banner_title3">
				<h2>ValuePass Offers are only Available Onboard</h2>

				<p class="fs-2"> <strong> Don't Miss it</strong></p>
			</div>

		</div>
		<!-- /container -->
	</div>
	<!-- /bg_color_1 -->


	<div id="how" class="container margin_80_55">
		<div class="main_title_2">
			<span><em></em></span>
			<h2> <b> Why ValuePass </b></h2>
			<p>Spend less doing more…</p>

		</div>
		<div class="row">
			<div class="col-lg-4 col-md-6">
				<a class="box_feat">
					<!-- <i class="pe-7s-medal"></i> -->
					<object class="SvgImage" data="assets/icons/fingerprint.svg" type="image/svg+xml"></object>
					<h3>Personalized </h3>
					<p>Pick your destination, attraction, schedule and create your own bucket list</p>
				</a>
			</div>
			
			<div class="col-lg-4 col-md-6">
				<a class="box_feat">
				<object class="SvgImage" data="assets/icons/gift.svg" type="image/svg+xml"></object>
					<h3> Pampered </h3>
                    <p>We always have a present for you. <br><?php echo $menu[13] ?></p>
				</a>
			</div>
			<div class="col-lg-4 col-md-6">
				<a class="box_feat">
					<!-- <i class="pe-7s-culture"></i> -->
					<object class="SvgImage" data="assets/icons/spring.svg" type="image/svg+xml"></object>
					<h3>Flexible </h3>
					<p>Free Cancellation,  Payment Options & Re-scheduling  </p>
                    <b class="custom-pop" data-container="body" data-toggle="popover" data-placement="top" content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." title="ValuePass vouchers are not canceled, but we are always looking to offer you the best alternative solutions regarding the activity providers we promote if something goes wrong.
            You'll find more information in your confirmation email
" >Read More</b>
				</a>
			</div>
			<div class="col-lg-4 col-md-6">
				<a class="box_feat">
				<object class="SvgImage" data="assets/icons/smartphone.svg" type="image/svg+xml"></object>
					<h3>Convenient </h3>
					<p> Control everything easily from your smartphone. <br> Receive detailed info at your preferred e-mail</p>
				</a>
			</div>

			<div class="col-lg-4 col-md-6">
				<a class="box_feat">
				<object class="SvgImage" data="assets/icons/credit-card.svg" type="image/svg+xml"></object>
					<h3>Secured </h3>
					<p>Highly secured payment procedure</p>
				</a>
			</div>
			<div class="col-lg-4 col-md-6 ">
				<a class="box_feat">
				<object class="SvgImage" data="assets/icons/support.svg" type="image/svg+xml"></object>
					<h3>Supportive </h3>
					<p>Ask everything you want to know. Our support team is here to answer every question </p>

				</a>
			</div>
		</div>

	</div>

	<div class="container container-custom margin_80_55 col-lg-12 ">
		<section class="add_bottom_45">
			<div class="main_title_2">
				<span><em></em></span>
				<h2>Destinations</h2>
				<p>Create your bucket list on board!</p>
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
                        <li><a><i class="ti-instagram"></i></a></li>
<!--						<li><a><i class="ti-twitter-alt"></i></a></li>-->
<!--						<li><a><i class="ti-google"></i></a></li>-->
<!--						<li><a><i class="ti-pinterest"></i></a></li>-->

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
					<li><a><?php echo $menu[10] ?></a></li>
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

<!-- Sign In Popup -->
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
	<div class="small-dialog-header">
		<h3>Sign In</h3>
	</div>
	<form>
		<div class="sign-in-wrapper">
			<a class="social_bt facebook">Login with Facebook</a>
			<a class="social_bt google">Login with Google</a>
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
<!-- <script src="assets/js/revapi44.js"></script> -->

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

<script src="assets/js/popper.min.js"></script>

<script>
        $(function () {
  $('[data-toggle="popover"]').popover();

});


    </script>

<script></script>
<script src="changeLanguage.js"></script>



</body>

</html>