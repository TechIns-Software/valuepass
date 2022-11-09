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
$vendor = getVendor($conn, $idVendor, $languageId);
if (is_null($vendor)) {
    header('location: index.php');
}
getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber);
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
    body::after {
        content: <?php echo $stringPreLoad;?>;
        display: none;
    },
    .displayNone {
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
                    <h4><b><?php echo $vendor->getName(); ?></b></h4>
                </div>

                <div class="col-lg-6 col-md-12  ">
                    <section id="description">
                        <div class="panel-group accordion-main my-2" id="accordion">

                            <div class="panel description">
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


                        <div class="panel-group accordion-main my-2 " id="accordion">

                            <div class="panel aboutActivity">
                                <div class="panel-heading collapsed " data-bs-toggle="collapse" href="#collapse2"
                                     role="button" aria-expanded="true" aria-controls="collapseExample">
                                    <h6 class="panel-title accordion-toggle">
                                        <?php echo $menu[61] ?>
                                    </h6>
                                </div>
                                <div id="collapse2" class=" collapse">
                                    <div class="panel-body">
                                        <ul class="p-2">
                                            <!--                                            <li><i class="fa fa-arrow-right"-->
                                            <!--                                                   aria-hidden="true"></i> -->
                                            <?php //echo $menu[134]; ?><!--  </li>-->
                                            <li><p class="headStyle p-0"><i class="fa fa-arrow-right"
                                                                        aria-hidden="true"></i>  <?php echo $menu[189]; ?>
                                                </p>

                                            <small> <?php echo $menu[135]; ?></small></li>
                                            <li><p class="headStyle p-0"><i class="fa fa-arrow-right"
                                                                        aria-hidden="true"></i> <?php echo $menu[190]; ?>
                                                </p>
                                                <small> <?php echo $menu[191]; ?> </small>
                                            </li>
                                            <li><p class="headStyle p-0"><i class="fa fa-arrow-right"
                                                                        aria-hidden="true"></i> <?php echo $menu[192]; ?>
                                                </p>
                                                <small> <?php echo $menu[193]; ?> </small>
                                            </li>

                                            <?php
                                            foreach ($vendor->getAboutActivityArray() as $aboutActivity) {
                                                ?>
                                                <li class=headStyle ">
                                                    <p class="headStyle "><i class="fa fa-arrow-right"
                                                                            aria-hidden="true"></i> <?php echo $aboutActivity->getHead(); ?>
                                                    </p>
                                                    <small class="  descrStyle">
                                                        <?php echo $aboutActivity->getDescription(); ?>

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
                        <div class="panel-group accordion-main my-2" id="accordion">

                            <div class="panel highlights">
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
                            <p class="voucher_av ">
                                <?php echo $menu[45] ?>
                                <b><?php echo $vendor->getAvailabilityTodayVoucher(); ?></b>
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
                                <div class="col">
                                    <p class="vp_discount my-0 "><?php echo $menu[50] ?> <?php echo $vendor->getDiscount(); ?>
                                        % <?php echo $menu[51] ?>
                                    </p>
                                </div>
                            </div>

                            <!-- <p class="final_price1 m-0 mb-2"> Final Price <span class="final_price1_value">84€ </span></p> <span class="perperson">per person</span> </p> -->
                            <button class=" my-2 btn buy_button "><a href="#book"><?php echo $menu[52] ?> </a></button>
                            <p class="my-0 offerText"> <?php echo $menu[57].''.$menu[58].''.$menu[59]; ?> </p>
                        </div>

                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-lg-12  col-md-12 ">

                    <div class="panel-group accordion-main my-2" id="accordion">
                        <!--About accordion #9-->
                        <div class="panel discriptionBig">
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
                        <div class="panel includedServices">
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
                        <div class="panel importantInfos">
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

                                <div class="panel ratedcategories">
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

            <div class="row">

                <div class="col-12 shadow bgbanner2">

                    <div class="banner_title2 ">
                        <p>  <?php echo $menu[38] ?>  </p>
                        <p>  <?php echo $menu[124] ?>  </p>
                        <p> <?php echo $menu[39] ?>   </p>
                        <p> <?php echo $menu[40] ?>   </p>
                        <p> <?php echo $menu[41] ?>   </p>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <div style="min-height: 20px"></div>
    <section id="book">
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-8 col-md-12">

                    <div class="box_detail booking">
                        <div class="price">
                            <span>    <?php echo $menu[67] ?> </span>
                            <span style="display: none">    <?php echo $vendor->getForHowManyPersonsIs(); ?> </span>
                        </div>
                        <div class="panel-dropdown">
                            <a href="#">
                                <span id="adultsLabel">
                                    <?=$vendor->getLabelAdults($menu[68], $menu[174], $menu[175], true)?>
                                </span>
                                <span class="" id="adultsLabelNext"></span>
                                <span class="displayNone" id="childrenLabel"><?=$menu[69]?></span>
                                <span class="displayNone" id="childrenLabelNext"></span>
                                <span class="displayNone" id="infantsLabel"><?=$menu[70]?></span>
                                <span class="displayNone" id="infantsLabelNext"></span>
                                <span class="displayNone" id="displayTotalWord">
                                    <span class="<?php echo ($vendor->getForHowManyPersonsIs() != 1 ? 'displayNone': '')?>"><?=$menu[104];?></span>
                                </span>
                                <span class="qtyTotal"></span></a>
                            <div class="panel-dropdown-content right">
                                <div class="qtyButtons">
                                    <label>
                                        <?=$vendor->getLabelAdults($menu[68], $menu[174], $menu[175])?>
                                    </label>
                                    <input id="adultsInput" type="text" name="qtyInput" value="0">
                                </div>
                                <div <?php echo !$vendor->isChildAcceptance() || $vendor->getForHowManyPersonsIs() != 1 ? 'class="displayNone"' : '' ?>
                                        class="qtyButtons">
                                    <label><?php echo $menu[69] ?> <small><?=$vendor->getLabelChild();?></small> </label>
                                    <input id="childrenInput" type="text" name="qtyInput" value="0">
                                </div>
                                <div <?php echo !$vendor->isInfantTolerance() | $vendor->getForHowManyPersonsIs() != 1 ? 'class="displayNone"' : ''; ?>
                                        class="qtyButtons">
                                    <label><?php echo $menu[70] ?> <small><?=$vendor->getLabelInfant();?></small></label>
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
                    <div id="optionbuttons" class="d-flex"></div>
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
                    foreach ($bestOffs as $vendorBO) {
                        $moneySaved = $vendorBO->getOriginalPrice() * ($vendorBO->getDiscount() / 100);
                        $totalToPay = $vendorBO->getOriginalPrice() - $moneySaved - $vendorBO->getPriceAdult();

                        ?>
                        <div class="item">
                            <div class="box_grid">
                                <a href="adventure_page.php?id=<?php echo $vendorBO->getId(); ?>">
                                    <img src="vendorImages/<?php echo $vendorBO->getId() . '/' . $vendorBO->getPathToImage(); ?>"
                                         class="img-fluid" alt="" width="800" height="933">
                                </a>
                                <div class="wrapper best ">
                                    <small><?php echo $vendorBO->getCategoryName(); ?></small>
                                    <h3 class="vendorname"><a
                                                href="adventure_page.php?id=<?php echo $vendorBO->getId(); ?>"><?php echo $vendorBO->getName(); ?></a>
                                    </h3>
                                    <p class="text-muted my-0 label"><?php echo implode(' / ', $vendorBO->getLabelsBoxNames()); ?></p>

                                    <span class="criteria">
											 <?php echo $menu[44] ?>
                                             <?php echo str_repeat('<i class="icon_star voted"></i>', $vendorBO->getAverageRated()) ?>
                                             <?php echo str_repeat('<i class="icon_star"></i>', $vendorBO::$MAX_STARS - $vendorBO->getAverageRated()) ?>
										</span>
                                    <p class="">
                                        <span class="voucher_av">
                                            <?php echo $menu[45] ?>
                                            <b> <?php echo $vendorBO->getAvailabilityTodayVoucher(); ?></b>
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
                                        <div class="col">
                                            <p class="vp_discount my-0 "> <?php echo $menu[50] ?> <?php echo $vendorBO->getDiscount(); ?>
                                                % <?php echo $menu[51] ?>
                                            </p>
                                        </div>
                                    </div>

                                    <a href="adventure_page.php?id=<?php echo $vendorBO->getId(); ?>">
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

    <div class="modal fade " id="questionmodal" tabindex="-1" aria-labelledby="questionmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="questionmodaltitle">ValuePass</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modalBodyInitial" class="modal-body">
                    <?php echo $menu[125]; ?> <b><?php echo $vendor->getName(); ?>  </b> <?php echo $menu[126]; ?>
                </div>
                <div id="modalBodyError" class="modal-body displayNone"></div>
                <div id="modalFooterInitial" class="modal-footer">
                    <a href="<?php echo './adventures.php?id=' . $vendor->getIdDestination(); ?>">
                        <button type="button" class=" btn-cshopping"
                                data-bs-dismiss="modal"><?php echo $menu[127]; ?></button>
                    </a>
                    <a href="cart-1.php">
                        <button type="button" class="btn-gtcart"><?php echo $menu[128]; ?></button>
                    </a>
                </div>
            </div>
        </div>
    </div>


</main>

<?php include_once 'includes/footer.php';
footer($menu, $languages)
?>

<script src="assets/js/common_scripts.js"></script>
<script src="assets/js/main.js?v=1.4"></script>
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
    var availableDates = <?php echo json_encode($vendor->getAvailableDates())?>;
    $(function () {
        const minDate = new Date();
        minDate.setDate(minDate.getDate());
        const maxDate = new Date();
        maxDate.setDate(maxDate.getDate() + 91);
        $('input[name="dates"]').daterangepicker({
            autoUpdateInput: false,
            singleDatePicker: true,
            autoApply: true,
            parentEl: '.scroll-fix',
            minDate: minDate,
            maxDate: maxDate,
            opens: 'left',
            isInvalidDate: function(date) {
                // for (var _ = 0; _ < availableDates.length; _++) {
                //     var dateAvailable = availableDates[_];
                //     console.log(dateAvailable);
                    if (!availableDates.includes(date.format('YYYY-MM-DD'))) {
                        return true;
                    }
                // }

            },
            locale: {
                <?php
                if ($languageId == 1) {
                    ?>
                daysOfWeek: [
                    "Κυρ",
                    "Δευ",
                    "Τρι",
                    "Τετ",
                    "Πεμ",
                    "Παρ",
                    "Σαβ"
                ],
                "monthNames": [
                    "Ιανουάριος",
                    "Φεβρουάριος",
                    "Μάρτιος",
                    "Απρίλιος",
                    "Μάιος",
                    "Ιούνιος",
                    "Ιούλιος",
                    "Αύγουστος",
                    "Σεπτέμβριος",
                    "Οκτώβριος",
                    "Νοέμβριος",
                    "Δεκέμβριος"
                ],
                cancelLabel: 'Ακύρωση',
                applyLabel: 'Επιλογή'
                <?php
                }
                ?>

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

<script src="backend/js/cart.js?v=1.4"></script>
<script>
    var lengthImagesSlider = <?php echo count($vendor->getImages())?>;
</script>
<script src="assets/js/mySlider.js"></script>
</body>
</html>
