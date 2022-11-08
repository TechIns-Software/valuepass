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
<style>
    @media(max-width: 600px) {
        #backimageDest {
            max-height: 450px;
        }
    }
</style>
<main>
	<section id="backimageDest" style="background: url('images/location_images/<?php echo $destination->getImage2();?>') 50% 50% " class="header-video adventure">
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
    <div class="bg_color_1 shadow bgbanner2">

            <div class="banner_title2 ">
                <p class="flex-nowrap ">  <?php echo $menu[57] ?> </p>
                <p class="flex-nowrap"> <?php echo $menu[58] ?> </p>
                <p class="flex-nowrap">  <?php echo $menu[59] ?> </p>
                <!--				   <p class="fs-2"> <strong> Your gifts never end </strong>  </p> -->
            </div>


        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->
	<div id="bestof" class="container container-custom margin_80_55 ">
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


                                <div class="row  buyNow_part">
                                    <div class="col-12 d-flex justify-content-between nowrap ">
                                        <div class="buyvp_label" >  <?php echo $menu[46] ?>  <span class="nowText">  <?php echo $menu[195] ?> </span>    </div>
                                        <div class="buyvp_price">  <b class="nowText"><?php echo $vendor->getPriceAdult();?>€ </b>/ <span class="perperson">  <?php echo $vendor->getForHowManyPersonsIsString($menu[183],$menu[184],$menu[185],$menu[186]);?> </span></div>
                                    </div>
                                    <div class="col-12 ">
                                        <b >
                                         <?php  echo $_SESSION["languageId"] == 1? 'To':''  ?>  <span class="nowText">VP</span> <?php echo $menu[196] ?>
                                        </b>
                                    </div>
                                </div>
                                <div class="row paylater_box">
                                    <div class="col-12 pay_value  d-flex justify-content-between  ">
                                        <div ><?php echo $menu[49] ?> <span class="laterText">  <?php echo $menu[197] ?> </span> </div>
                                        <div>
                                            <span class="from_price"> <?php echo $vendor->getOriginalPrice();?>€ </span>
                                            <span class="laterText"><?php echo $totalToPay;?>   € </span> / <span class="perperson">  <?php echo $vendor->getForHowManyPersonsIsString($menu[183],$menu[184],$menu[185],$menu[186]);?> </span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <p  class="my-0">  <?php echo $menu[198] ?> </p>
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

                            <div class="row  buyNow_part">
                                <div class="col-12 d-flex justify-content-between nowrap ">
                                    <div class="buyvp_label" >  <?php echo $menu[46] ?>  <span class="nowText">  <?php echo $menu[195] ?> </span>    </div>
                                    <div class="buyvp_price">  <b class="nowText"><?php echo $vendor->getPriceAdult();?>€ </b>/ <span class="perperson">  <?php echo $vendor->getForHowManyPersonsIsString($menu[183],$menu[184],$menu[185],$menu[186]);?> </span></div>
                                </div>
                                <div class="col-12 ">
                                    <b >
                                        <?php  echo $_SESSION["languageId"] == 1? 'To':''  ?>  <span class="nowText">VP</span> <?php echo $menu[196] ?>
                                    </b>
                                </div>
                            </div>
                            <div class="row paylater_box">
                                <div class="col-12 pay_value  d-flex justify-content-between  ">
                                    <div ><?php echo $menu[49] ?> <span class="laterText">  <?php echo $menu[197] ?> </span> </div>
                                    <div>
                                        <span class="from_price"> <?php echo $vendor->getOriginalPrice();?>€ </span>
                                        <span class="laterText"><?php echo $totalToPay;?>   € </span> / <span class="perperson">  <?php echo $vendor->getForHowManyPersonsIsString($menu[183],$menu[184],$menu[185],$menu[186]);?> </span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <p  class="my-0">  <?php echo $menu[198] ?> </p>
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

<?php include_once 'includes/footer.php';
footer($menu,$languages)

?>


<!-- COMMON SCRIPTS -->
<script src="assets/js/common_scripts.js"></script>
<script src="assets/js/main.js?v=1.4"></script>
<script src="assets/js/validate.js"></script>

<script src="changeLanguage.js"></script>
<script src="assets/js/allExperiences.js"></script>
<script src="assets/js/typeOfExperience.js"></script>
</body>

</html>