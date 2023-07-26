<?php
if (!isset($conn)) {
    include 'connection.php';
}
$title = "How it works | ValuePass";
$home = 0;
include_once 'includes/header.php';
$idLanguage = $_SESSION["languageId"];
$destinations = getDestinations($conn, $idLanguage);
getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber,$destinations);
?>

<main>
    <div style="min-height: 90px;"></div>
    <div id="how" class="container margin_80_55">


        <div class="row ">
            <div class="main_title_2">
                <h1><b><?php echo $menu[1]; ?> </b></h1>
                <p><?php echo $menu[74]; ?> </p>
            </div>
        </div>

    </div>


    <section id="questions" class="section">
        <div class="container">
            <div class="row">
                <!--Start Accordion-->
                <div class="col-12">
                    <div class="panel-group accordion-main" id="accordion">

                        <!--About accordion #9-->

                        <div class="panel-heading collapsed " data-bs-toggle="collapse" href="#collapse1"
                             role="button"
                             aria-expanded="true" aria-controls="collapseExample">
                            <h6 class="panel-title accordion-toggle">
                                <b><?php echo $menu[75]; ?> 1. </b> <?php echo $menu[76]; ?>
                            </h6>
                        </div>
                        <div id="collapse1" class=" collapse">
                            <div class="panel-body">
                                <div class="row p-4">
                                    <?php foreach ($destinations as $destination) { ?>
                                        <div class="col-lg-4 col-md-6 col-6">
                                            <h3 class="text-muted"> <?php echo $destination->getName(); ?> </h3>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>


                        <div class="panel-heading collapsed " data-bs-toggle="collapse" href="#collapse2"
                             role="button"
                             aria-expanded="true" aria-controls="collapseExample">
                            <h6 class="panel-title accordion-toggle">
                                <b><?php echo $menu[75]; ?> 2. </b> <?php echo $menu[77]; ?>
                                / <?php echo $menu[78]; ?>
                                / <?php echo $menu[79]; ?> /<?php echo $menu[80]; ?>
                            </h6>
                        </div>
                        <div id="collapse2" class=" collapse">
                            <div class="panel-body px-4">

                                <p> <?php echo $menu[81]; ?></p>
                            </div>
                        </div>


                        <div class="panel-heading  collapsed" data-bs-toggle="collapse" href="#collapse3"
                             role="button"
                             aria-expanded="true" aria-controls="collapseExample">
                            <h6 class="panel-title accordion-toggle">
                                <b><?php echo $menu[75]; ?>3. </b><?php echo $menu[82]; ?>
                            </h6>

                        </div>
                        <div id="collapse3" class=" collapse">
                            <div class="panel-body">
                                <div class="row px-4">
                                    <h5 class="text-decoration-underline"> <?php echo $menu[24] ?></h5>

                                    <h6>  <?php echo $menu[242] ?> </h6>
                                    <h6>  <?php echo $menu[243] ?> </h6>
                                    <h6>  <?php echo $menu[244] ?> </h6>
                                    <h6>  <?php echo $menu[245] ?> </h6>
                                    <p class="text-muted"> <?php echo $menu[246] ?></p>


                                </div>

                            </div>
                        </div>


                        <div class="panel-heading  collapsed" data-bs-toggle="collapse" href="#collapse4"
                             role="button"
                             aria-expanded="true" aria-controls="collapseExample">
                            <h6 class="panel-title accordion-toggle">
                                <b><?php echo $menu[75]; ?>4. </b> <?php echo $menu[85]; ?>
                            </h6>
                        </div>
                        <div id="collapse4" class=" collapse">
                            <div class="panel-body">
                                <div class="row px-4">
                                    <p class="m-0"><b> <?php echo $menu[86]; ?> : </b></p>
                                    <p class="m-0"><b> <?php echo $menu[87]; ?></b></p>
                                    <p class="m-0"><b> Email : </b></p>
                                    <ul>
                                        <li> • <?php echo $menu[92]; ?> </li>
                                        <li> • <?php echo $menu[93]; ?></li>
                                        <li> • <?php echo $menu[94]; ?></li>

                                        <b> <a target="_blank"
                                               href="<?php echo $_SESSION["languageId"] == 1 ? 'terms_gr.pdf' : 'terms_gb.pdf' ?>"> <?php echo $menu[95] ?></a>
                                        </b>


                                    </ul>

                                </div>

                            </div>
                        </div>

                        <div class="panel-heading collapsed  " data-bs-toggle="collapse" href="#collapse5"
                             role="button"
                             aria-expanded="true" aria-controls="collapseExample">
                            <h6 class="panel-title accordion-toggle">
                                <b><?php echo $menu[75]; ?>5. </b> <?php echo $menu[88]; ?>
                            </h6>
                        </div>
                        <div id="collapse5" class=" collapse">
                            <div class="panel-body">
                                <div class="row px-4">
                                    <ul>

                                        <li> • <?php echo $menu[90]; ?></li>
                                        <li> • <?php echo $menu[235]; ?></li>
                                        <li> • <?php echo $menu[236]; ?></li>
                                        <li> • <?php echo $menu[237]; ?></li>
                                        <li> • <?php echo $menu[238]; ?></li>


                                    </ul>
                                </div>

                            </div>
                        </div>


                    </div>
                    <!--/.row-->
                </div>

                <div class="col-12 text-end ">
                    <div class="">
                        <i onclick="window.location.href='index.php'"  class="m-0 p-0 btn fa-solid fa-circle-xmark fs-3"></i>
                    </div>

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
                <h2><?php echo $menu[36]; ?></h2>
                <p><?php echo $menu[96] ?></p>
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
                    <div class="item"
                         onclick="location.href='./adventures.php?id=<?php echo $destination->getId(); ?>';">
                        <div class="card text-white card-has-bg click-col"
                             style="background-image:url('images/location_images/<?php echo $destination->getImage1(); ?>');">
                            <!-- <img class="card-img d-none" src="https://source.unsplash.com/600x900/?mykonos" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?"> -->
                            <div class="card-img-overlay d-flex flex-column">
                                <div class="card-body">
                                </div>
                                <div class="card-footer">
                                    <h4 class="card-title mt-0 "><a class="text-white"
                                                                    href="adventures.php?id=<?php echo $destination->getId(); ?>"><?php echo $destination->getName(); ?></a>
                                    </h4>
                                    <small class="card-meta mb-2"><?php echo $destination->getNumberOfVendors(); ?><?php echo $menu[3] ?></small>
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

<?php include_once 'includes/footer.php';
footer($menu, $languages)
?>


<div id="toTop"></div><!-- Back to top button -->

<!-- COMMON SCRIPTS -->
<script src="assets/js/common_scripts.js"></script>
<script src="assets/js/main.js?v=1.6"></script>
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
    tpj(document).ready(function () {
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