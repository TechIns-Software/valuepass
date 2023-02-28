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
$_SESSION["lastDestinationId"] = 0;
$_SESSION["lastDestinationId"] = $idDestination;
$languageId = $_SESSION["languageId"];

$destination = getDestination($conn, $idDestination, $languageId);
if (is_null($destination)) {
    header('location: index.php');
}
getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber,$destinations);
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
    <script>
        const globalIdLanguage = <?php echo $languageId; ?>
    </script>
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
                <?php
                if(count($bestOffs) > 0) {
                ?>
                    <span><em></em></span>
                    <h2><?php echo $menu[42] ?> </h2>
                <?php
                }
                ?>
				<!-- <p>Some of our favorite experiences </p> -->
			</div>
            <?php
            if (count($bestOffs) > 0) {
                include_once 'bestoffs.php';
                bestoffs($bestOffs,$menu);
            }
            $counterCollapseVendor = $GLOBALS['counterForCollapseVendor'] ?? 1;
            ?>


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

                <div id="exper<?php echo $vendor->getId();?>" class="col-xl-4 col-lg-6 col-md-6 isotope-item popular " data-category="<?php echo $vendor->getCategoryId();?>">
                    <div class="box_grid">
                        <figure>
                            <a href="adventure_page.php?id=<?php echo $vendor->getId();?>">
                                <img src="vendorImages/<?php echo $vendor->getId().'/'. $vendor->getPathToImage();?>" class="img-fluid" alt="" width="800" height="533">
                            </a>
                        </figure>
                        <div class="wrapper best  ">
                            <small><?php echo $vendor->getCategoryName();?></small>
                            <div class="bookmarkContainer "> <?php echo $menu[48] ;?> <span class="text-decoration-line-through"><?php echo $vendor->getOriginalPrice();?>€ </span>
                                <br>   <?php echo ($vendor->getPriceAdult()+$totalToPay) ;?> €/ <span class="buyNow_part2_perperson">  <?php echo $vendor->getForHowManyPersonsIsString($menu[183],$menu[184],$menu[185],$menu[186]);?> </span>  </div>

                            <div style="margin-top: -60px">
                                <?php echo $vendor->getId() == 5 ? '<p class="sellout_label2 ">' . $menu[203] . '    </p>' : ''; ?>
                                <h3 class="vendorname"><a
                                            href="adventure_page.php?id=<?php echo $vendor->getId(); ?>"><?php echo $vendor->getName(); ?></a>
                                </h3>
                                <p class=" label"><?php echo implode(' / ', $vendor->getLabelsBoxNames()); ?></p>
                                <p class="criteria">
                                    <?php echo $menu[44] ?>
                                    <?php echo str_repeat('<i class="icon_star voted"></i>', $vendor->getAverageRated()) ?>
                                    <?php echo str_repeat('<i class="icon_star"></i>', $vendor::$MAX_STARS - $vendor->getAverageRated()) ?>
                                </p>
                                <div class="row my-1">
                                    <div class="col-12  ">
                                        <b class="my-1" style="font-size: 15px">
                                            <?php if ($_SESSION['languageId'] == 1) { ?>
                                                Κερδίστε <span class="vpicon"> έκπτωση </span> μέσω του <span
                                                        class="vpicon"> VP </span>  Voucher
                                            <?php } else { ?>

                                                Get a <span class="vpicon"> discount</span>  via  <span class="vpicon">VP </span> Voucher
                                            <?php } ?>
                                        </b>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="d-flex justify-content-end">
                                                                         <b style="font-size: 15px">
                                        <?php echo $menu[48]; ?> <b class="exprice" ><?php echo $vendor->getOriginalPrice(); ?>€ </b>
                                    </b>
                                    </div>
                                    <div class="col-12 win-text ">
                                        <?php if ($_SESSION['languageId'] == 1) { ?>
                                            Εξοικονομήστε <?php echo($vendor->getOriginalPrice() - $totalToPay - $vendor->getPriceAdult()) ?> €</span> από την αρχική τιμή <br>
                                            χρησιμοποιώντας το <span class="vpicon">VP </span> Voucher
                                        <?php } else { ?>
                                            Save <span
                                                    class="vpicon"> <?php echo($vendor->getOriginalPrice() - $totalToPay - $vendor->getPriceAdult()) ?> €</span>  on the initial price
                                            <br>
                                            using  <span class="vpicon">VP </span> Voucher
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="p-0 m-0  "><b style=" font-size: 15px; font-weight: 800"> <?php if ($_SESSION['languageId'] == 1) { ?>
                                                    Πληρώστε στην τοποθεσία<br>
                                                    της δραστηριότητας
                                                <?php } else { ?>
                                                    Pay at the activity location
                                                <?php } ?>
                                            </b>
                                        </div>
                                        <div class=""><b style="font-weight: 800"><?php echo $totalToPay; ?>
                                                €/ <?php echo $vendor->getForHowManyPersonsIsString($menu[183], $menu[184], $menu[185], $menu[186]); ?></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2  ">
                                    <a href="adventure_page.php?id=<?php echo $vendor->getId(); ?>">
                                    <div class="d-flex justify-content-between offerContainer align-items-start">

                                        <div>
                                            <p class=" text-white my-auto " style="font-size: 15px">
                                                <?php if ($_SESSION['languageId'] == 1) { ?>
                                                    Κάντε Κράτηση εν πλω<br>
                                                    μέσω <span class="vpicon"> VP </span> Voucher

                                                <?php } else { ?>
                                                    Book on board <span class="vpicon">VP </span> Voucher
                                                <?php } ?>
                                            </p>
                                        </div>
                                        <div class="my-auto"> <?php echo $vendor->getPriceAdult(); ?> €/ <span
                                                    class="buyNow_part2_perperson">  <?php echo $vendor->getForHowManyPersonsIsString($menu[183], $menu[184], $menu[185], $menu[186]); ?> </span> </div>

                                    </div>
                                    </a>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    $counterCollapseVendor = $counterCollapseVendor + 1;
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
<script src="assets/js/main.js?v=1.6"></script>
<script src="assets/js/validate.js"></script>

<script src="changeLanguage.js"></script>
<script src="assets/js/allExperiences.js"></script>
<script src="assets/js/typeOfExperience.js"></script>
<script src="assets/js/voucherDetailsToggle.js"></script>
</body>

</html>