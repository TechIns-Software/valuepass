<?php
if (!isset($conn)) {
    include 'connection.php';
}
if (!isset($_GET['id'])) {
    header('location: index.php');
}
$title = "Vendor page";
$home = 0;
include_once 'includes/header.php';

$idVendor = $_GET['id'];
$languageId = $_SESSION["languageId"];
//$languageId = 2;
$vendor = getVendor($conn, $idVendor, $languageId);
if (is_null($vendor)) {
    header('location: index.php');
}
$bestOffs = getVendors($conn, $vendor->getIdDestination(), $languageId, true);
?>
<input value="<?php echo $vendor->getId(); ?>" id="vendorId" hidden>
<style>
    <?php
    $counter = 0;
    $stringPreLoad = '';
    foreach ($vendor->getImages() as $imagePath) {
        echo ".image$counter {background-image: url(vendorImages/$idVendor/$imagePath);}";
        $stringPreLoad .= " url('vendorImages/$idVendor/$imagePath') ";
        $counter = $counter + 1;
    }
    ?>
    body::after{
        content: <?php echo $stringPreLoad;?>;
        display: none;
    }
</style>
<main>
    <section id="sliderElement" class="hero_in hotels_detail image0"
             style="background-size: cover;">

    </section>
    <!--/hero_in-->

    <!-- Slider -->
    <!--    <div id="full-slider-wrapper">-->
    <!--        <div id="layerslider" style="width:100%;height:650px;">-->
    <!--            --><?php
    //            $dummyCounter = 0;
    //            foreach ($vendor->getImages() as $imagePath) {
    //                ?>
    <!--                <div class="ls-slide" data-ls="slidedelay: 5000; transition2d:85;">-->
    <!--                    <img src="vendorImages/-->
    <?php //echo $vendor->getId() . '/' . $imagePath; ?><!--" class="ls-bg"-->
    <!--                         alt="Slide background">-->
    <!--                </div>-->
    <!--                --><?php
    //            }
    //            ?>
    <!---->
    <!--        </div>-->
    <!--    </div>-->
    <!-- End layerslider -->

    <div class="bg_color_1 shadow bgbanner2">

        <div class="banner_title2 ">
            <p>  <?php echo $menu[57] ?> </p>
            <p> <?php echo $menu[58] ?> </p>
            <p>  <?php echo $menu[59] ?> </p>
        </div>


        <!-- /container -->
    </div>


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
                <!---->
                <!--                <div class="col-lg-12  col-md-12 title-vendor">-->
                <!--                    <h3>--><?php //echo $vendor->getName(); ?><!--</h3>-->
                <!--                </div>-->
                <div class="col-12 text-center">
                    <h5><b><?php echo $vendor->getName(); ?></b></h5>
                </div>

                <div class="col-lg-6 col-md-12  ">
                    <section id="description">
                        <div class="panel-group accordion-main my-2" id="accordion">
                            <!--About accordion #9-->
                            <div class="panel">
                                <div class="panel-heading   " data-bs-toggle="collapse" href="#collapse1" role="button"
                                     aria-expanded="true" aria-controls="collapseExample">
                                    <h6 class="panel-title accordion-toggle">
                                        <?php echo $menu[60] ?>
                                    </h6>
                                </div>
                                <div id="collapse1" class=" collapse show">
                                    <div class="panel-body px-2">
                                        <p class="details">
                                            <?php echo $vendor->getDescriptionBig(); ?>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/.row-->


                        <div class="panel-group accordion-main my-2" id="accordion">
                            <!--About accordion #9-->
                            <div class="panel">
                                <div class="panel-heading collapsed " data-bs-toggle="collapse" href="#collapse2"
                                     role="button" aria-expanded="true" aria-controls="collapseExample">
                                    <h6 class="panel-title accordion-toggle">
                                        <?php echo $menu[61] ?>
                                    </h6>
                                </div>
                                <div id="collapse2" class=" collapse">
                                    <div class="panel-body">
                                        <ul class="px-2">
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
                        <!--/.row-->
                    </section>

                    <section>


                        <div class="panel-group accordion-main my-2" id="accordion">
                            <!--About accordion #9-->
                            <div class="panel">
                                <div class="panel-heading  collapsed" data-bs-toggle="collapse" href="#collapse3"
                                     role="button" aria-expanded="true" aria-controls="collapseExample">
                                    <h6 class="panel-title accordion-toggle">
                                        <?php echo $menu[62] ?>
                                    </h6>
                                </div>
                                <div id="collapse3" class=" collapse">
                                    <div class="panel-body">
                                        <ul class="px-2">
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
								 <?php echo $menu[44] ?>
								<?php echo str_repeat('<i class="icon_star voted"></i>', $vendor->getAverageRated()) ?>
                                <?php echo str_repeat('<i class="icon_star"></i>', $vendor::$MAX_STARS - $vendor->getAverageRated()) ?>
							</span>
                            <p class=" voucher_av ">
                                <?php echo $menu[45] ?>
                                <b>4/10</b>
                            </p>
                            <div class="row ">
                                <div class="col d-flex nowrap buyvp_label"> <?php echo $menu[46] ?> </div>
                                <div class="col buyvp_value">
                                    <b><?php echo $vendor->getPriceAdult(); ?>€ </b>
                                    <span class="perperson">
                                        <?php echo $vendor->getForHowManyPersonsIsString();?>
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col"> <?php echo $menu[47] ?></div>
                                <div class="col from_price"> <?php echo $vendor->getOriginalPrice(); ?> €</div>
                            </div>

                            <div class="row">
                                <div class="col"> <?php echo $menu[48] ?></div>
                                <div class="col pay_value">
                                    <b><?php echo $totalToPay; ?>€ </b>
                                    <span class="perperson">
                                        <?php echo $vendor->getForHowManyPersonsIsString();?>
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <p class="vp_discount my-0 "><?php echo $menu[50] ?> <?php echo $vendor->getDiscount(); ?>% <?php echo $menu[51] ?>
                                        </p>
                                </div>
                            </div>

                            <!-- <p class="final_price1 m-0 mb-2"> Final Price <span class="final_price1_value">84€ </span></p> <span class="perperson">per person</span> </p> -->
                            <button class=" my-2 btn buy_button "><a href="#book"><?php echo $menu[52] ?> </a></button>
                            <p class="my-0 perperson"> <?php echo $menu[13]; ?> </p>


                        </div>

                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-lg-12  col-md-12 ">

                    <div class="panel-group accordion-main my-2" id="accordion">
                        <!--About accordion #9-->
                        <div class="panel">
                            <div class="panel-heading  collapsed" data-bs-toggle="collapse" href="#collapse4"
                                 role="button" aria-expanded="true" aria-controls="collapseExample">
                                <h6 class="panel-title accordion-toggle">
                                    <?php echo $menu[63] ?>
                                </h6>
                            </div>
                            <div id="collapse4" class=" collapse">
                                <div class="panel-body px-2">
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


                    <div class="panel-group accordion-main my-2" id="accordion">
                        <!--About accordion #9-->
                        <div class="panel">
                            <div class="panel-heading  collapsed" data-bs-toggle="collapse" href="#collapse6"
                                 role="button" aria-expanded="true" aria-controls="collapseExample">
                                <h6 class="panel-title accordion-toggle">
                                    <?php echo $menu[64] ?>
                                </h6>
                            </div>
                            <div id="collapse6" class=" collapse">
                                <div class="panel-body px-2">
                                    <ul>
                                        <?php
                                        if (count($vendor->getIncludedServicesArray()) > 0) {
                                            foreach ($vendor->getIncludedServicesArray() as $includeServices) {
                                                ?>
                                                <li>
                                                    <?php if ($includeServices->getIcon() == 1) { ?>
                                                        <i style="color:green" class="fa fa-check fa-lg"
                                                           aria-hidden="true"></i>
                                                        <span> <?php echo $includeServices->getName(); ?> </span>
                                                    <?php } else { ?>
                                                        <i style="color:red" class="fa fa-exclamation-triangle"
                                                           aria-hidden="true"></i>
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

                    <div class="panel-group accordion-main my-2" id="accordion">
                        <!--About accordion #9-->
                        <div class="panel">
                            <div class="panel-heading  collapsed" data-bs-toggle="collapse" href="#collapse7"
                                 role="button" aria-expanded="true" aria-controls="collapseExample">
                                <h6 class="panel-title accordion-toggle">
                                    <?php echo $menu[65] ?>
                                </h6>
                            </div>
                            <div id="collapse7" class=" collapse">
                                <div class="panel-body px-2">
                                    <div class="map_section ">
                                        <img src="vendorImages/<?php echo $vendor->getId() . '/' . $vendor->getGoogleMapsImage(); ?>"
                                             class="img-fluid" alt="map">
                                    </div>
                                    <ul>
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
                                                            <li>
                                                                <i class="fas fa-arrow-circle-right fa-lg"></i> <?php echo $bullet; ?>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
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
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="panel-group accordion-main my-2" id="accordion">
                                <!--About accordion #9-->
                                <div class="panel">
                                    <div class="panel-heading  collapsed" data-target="#collapse8"
                                         data-bs-toggle="collapse" href="#collapse8" role="button">
                                        <h6 class="panel-title accordion-toggle">
                                            <?php echo $menu[66] ?>
                                        </h6>
                                    </div>
                                    <div id="collapse8" class=" collapse">
                                        <div class="panel-body px-2">

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
    </div>

    <div style="min-height: 20px"></div>
    <section id="book">
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-8">

                    <div class="box_detail booking">
                        <div class="price">
                            <span>    <?php echo $menu[67] ?> </span>

                        </div>


                        <!-- TODO : To  make the adults label to display like this ex (2 adults ,3 children ,1 Infant) -->
                        <div class="panel-dropdown">
                            <a href="#"> <?php echo $menu[68] ?>  <span class="qtyTotal">0</span></a>
                            <div class="panel-dropdown-content right">
                                <div class="qtyButtons">
                                    <label><?php echo $menu[68] ?> <small> (13-99)</small></label>
                                    <input id="adultsInput" type="text" name="qtyInput" value="0">
                                </div>
                                <div class="qtyButtons">
                                    <label><?php echo $menu[69] ?></label>
                                    <input id="childrenInput" type="text" name="qtyInput" value="0">
                                </div>
                                <div class="qtyButtons">
                                    <label><?php echo $menu[70] ?></label>
                                    <input id="infantsInput" type="text" name="qtyInput" value="0">
                                </div>
                            </div>
                        </div>

                        <div class="form-group input-dates">
                            <input id="date" class="form-control" type="text" name="dates"
                                   placeholder="<?php echo $menu[72] ?>">
                            <i class="icon_calendar"></i>
                        </div>


                        <button onclick="getPackagesAvailable();" class=" add_top_30 btn_1 full-width purchase">
                            <?php echo $menu[67] ?>
                        </button>
                        <!-- <a href="wishlist.html" class="btn_1 full-width outline wishlist"><i class="icon_heart"></i> Add to wishlist</a> -->
                        <div class="text-center"><small><?php echo $menu[73] ?></small></div>
                    </div>
                    <div id="option"></div>
                    <div style="min-height: 10px;"></div>
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
                    <h2>You might be interested in... </h2>
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
                                    <img src="vendorImages/<?php echo $vendor->getId() . '/' . $vendor->getPathToImage(); ?>"
                                         class="img-fluid" alt="" width="800" height="933">
                                </a>
                                <div class="wrapper best ">
                                    <small><?php echo $vendor->getCategoryName(); ?></small>
                                    <h3 class="vendorname"><a
                                                href="adventure_page.php?id=<?php echo $vendor->getId(); ?>"><?php echo $vendor->getName(); ?></a>
                                    </h3>
                                    <p class="text-muted my-0 label"><?php echo implode(' / ', $vendor->getLabelsBoxNames()); ?></p>

                                    <span class="criteria">
											 <?php echo $menu[44] ?>
											<?php echo str_repeat('<i class="icon_star voted"></i>', $vendor->getAverageRated()) ?>
                                        <?php echo str_repeat('<i class="icon_star"></i>', $vendor::$MAX_STARS - $vendor->getAverageRated()) ?>
										</span>
                                    <p class=""><span class="voucher_av"><?php echo $menu[45] ?> <b> 4/10</b></span></p>
                                    <div class="row ">
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
                                        <div class="col from_price"> <?php echo $vendor->getOriginalPrice(); ?>€
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col"> <?php echo $menu[49] ?> </div>
                                        <div class="col pay_value">
                                            <b><?php echo $totalToPay; ?>€ </b>
                                            <span class="perperson">
                                                <?php echo $vendor->getForHowManyPersonsIsString();?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <p class="vp_discount my-0 "> <?php echo $menu[50] ?> <?php echo $vendor->getDiscount(); ?>% <?php echo $menu[51] ?>
                                                </p>
                                        </div>
                                    </div>

                                    <a href="adventure_page.php?id=<?php echo $vendor->getId(); ?>">
                                        <div class=" buy_button2"> <?php echo $menu[52] ?> </div>
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
                            foreach ($languages as $language) { ?>
                                <li class=" ps-3"><a href="javascript:void(0);"
                                                     onclick="changeLanguage('<?php echo $language[0] ?>');"><span
                                                class="flag-icon flag-icon-<?php echo $language[2] ?>"></span> <?php echo $language[1] ?>
                                    </a></li>
                            <?php } ?>

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
                    <li><span>© Valuepass</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--/footer-->


<!-- page -->

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
    $(function () {
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
        $('input[name="dates"]').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY'));
            $(this).attr('value2', picker.startDate.format('YYYY-MM-DD'))
            // $(this).val(picker.startDate.format('MM-DD-YY') + ' > ' + picker.endDate.format('MM-DD-YY'));
        });
        $('input[name="dates"]').on('cancel.daterangepicker', function (ev, picker) {
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
<script>
    var lengthImagesSlider = <?php echo count($vendor->getImages())?>;
</script>
<script src="assets/js/mySlider.js"></script>
</html>