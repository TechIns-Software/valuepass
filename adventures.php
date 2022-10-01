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
if (is_null($destination)) {
    header('location: index.php');
}
getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber);
$vendors = getVendors($conn, $idDestination, $languageId);
$bestOffs = getVendors($conn, $idDestination, $languageId, true);
$availableCategories = getCategoriesVendors($conn, $languageId, $idDestination);
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

            <div class="banner_title ">
                <p class="flex-nowrap">  <?php echo $menu[38] ?>  </p>
                <p class="flex-nowrap"> <?php echo $menu[39] ?>   </p>
                <p class="flex-nowrap"> <?php echo $menu[40] ?>   </p>
                <p class="flex-nowrap"> <?php echo $menu[41] ?>   </p>
                <!--				   <p class="fs-2"> <strong> Your gifts never end </strong>  </p> -->
            </div>


        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->
	<div id="bestof" class="container container-custom margin_80_55">
		<section class="add_bottom_45">
			<div class="main_title_3">
				<span><em></em></span>
				<h2><?php echo $menu[42] ?> </h2>
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
                            <a href="adventure_page.php?id=<?php echo $vendor->getId();?>">
                                <img src="vendorImages/<?php echo $vendor->getId().'/'. $vendor->getPathToImage();?>"
                                     class="img-fluid" alt="" width="800" height="933">
                            </a>
                            <div class="wrapper best ">
                                <small><?php echo $vendor->getCategoryName();?></small>
                                <h3 class="vendorname"><a href="adventure_page.php?id=<?php echo $vendor->getId();?>"><?php echo $vendor->getName();?></a></h3>
                                <p class="text-muted my-0 label"><?php echo implode(' / ', $vendor->getLabelsBoxNames());?></p>

                                <span class="criteria">
                                   <?php echo $menu[44] ?>
                                    <?php echo str_repeat('<i class="icon_star voted"></i>',$vendor->getAverageRated())?>
                                    <?php echo str_repeat('<i class="icon_star"></i>', $vendor::$MAX_STARS - $vendor->getAverageRated())?>
                                </span>
								<p class="">
                                    <span class="voucher_av">
                                        <?php echo $menu[45] ?>
                                        <b> <?php echo $vendor->getAvailabilityTodayVoucher();?> </b>
                                    </span>
                                </p>


								<div class="row">
									<div class="col d-flex nowrap buyvp_label"> <?php echo $menu[46] ?> </div>
									<div class="col buyvp_value">
                                        <b><?php echo $vendor->getPriceAdult();?>€ </b>
                                        <span class="perperson">
                                            <?php echo $vendor->getForHowManyPersonsIsString();?>
                                        </span>
                                    </div>
								</div>

								<div class="row">
									<div class="col"> <?php echo $menu[47] ?> </div>
									<div class="col from_price"> <?php echo $vendor->getOriginalPrice();?> € </div>
								</div>

								<div class="row">
									<div class="col"> <?php echo $menu[49] ?> </div>
									<div class="col pay_value">
                                        <b><?php echo $totalToPay;?>€ </b>
                                        <span class="perperson">
                                            <?php echo $vendor->getForHowManyPersonsIsString();?>
                                        </span>
                                    </div>
								</div>

								<div class="row">
									<div class="col">  <p class="vp_discount my-0 "><?php echo $menu[50] ?>  <?php echo $vendor->getDiscount();?>% <?php echo $menu[51] ?></p></div>

								</div>
                                <a href="adventure_page.php?id=<?php echo $vendor->getId();?>"><div class=" buy_button2" > <?php echo $menu[52] ?>  </div></a>
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
			<h2><?php echo $menu[43] ?> </h2>
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
                                <?php echo $menu[44] ?>
                                <?php echo str_repeat('<i class="icon_star voted"></i>',$vendor->getAverageRated())?>
                                <?php echo str_repeat('<i class="icon_star"></i>', $vendor::$MAX_STARS - $vendor->getAverageRated())?>
                            </span>
                            <p class="">
                                <span class="voucher_av">
                                    <?php echo $menu[45] ?>
                                    <b> <?php echo $vendor->getAvailabilityTodayVoucher();?></b>
                                </span>
                            </p>

							<div class="row ">
									<div class="col d-flex nowrap buyvp_label">  <?php echo $menu[46] ?> </div>
									<div class="col buyvp_value">
                                        <b><?php echo $vendor->getPriceAdult();?>€ </b>
                                        <span class="perperson">
                                            <?php echo $vendor->getForHowManyPersonsIsString();?>
                                        </span>
                                    </div>
								</div>

								<div class="row">
									<div class="col">  <?php echo $menu[48] ?> </div>
									<div class="col from_price"> <?php echo $vendor->getOriginalPrice();?> € </div>
								</div>

								<div class="row">
									<div class="col"> <?php echo $menu[49] ?> </div>
									<div class="col pay_value">
                                        <b><?php echo $totalToPay;?>€ </b>
                                        <span class="perperson">
                                            <?php echo $vendor->getForHowManyPersonsIsString();?>
                                        </span>
                                    </div>
								</div>

								<div class="row">
									<div class="col">  <p class="vp_discount my-0 "> <?php echo $menu[50] ?>  <?php echo $vendor->getDiscount();?>% <?php echo $menu[51] ?> </p></div>

								</div>

                            <a href="adventure_page.php?id=<?php echo $vendor->getId();?>"><div class=" buy_button2" > <?php echo $menu[52] ?> </div></a>
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
                <p><?php echo $menu[53] ?> <br><?php echo $menu[54] ?><br>
                    <?php echo $menu[55] ?> </p>
                <b> <?php echo $menu[56] ?></b>
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
                    <li><a href="<?php echo $idLanguage == 1 ? 'terms_gr.pdf':'terms_gb.pdf' ?>" target="_blank"><?php echo $menu[10] ?></a></li>
					<li><a href="#"><?php echo $menu[11] ?></a></li>
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

<script src="changeLanguage.js"></script>
<script src="assets/js/allExperiences.js"></script>
<script src="assets/js/typeOfExperience.js"></script>
</body>

</html>