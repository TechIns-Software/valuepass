<?php
if (!isset($conn)) {
    include 'connection.php';
}
$title = "FAQS | ValuePass";
$home = 0;
include_once 'includes/header.php';
$idLanguage = $_SESSION["languageId"];
$destinations = getDestinations($conn, $idLanguage);
getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber, $destinations);
?>

<main>
    <div style="min-height: 90px;"></div>
    <div id="how" class="container margin_80_55">

        <div class="row ">
            <div class="main_title_2">
                <h1><b>FAQS ? </b></h1>
                <p><?php echo $menu[74]; ?> </p>
            </div>
        </div>

    </div>
    <section id="questions" class="section pb-5">
        <div class="container">
            <div class="row ps-3">
                <div class="col-12 ">
                    <h4>1.<b>  <?php echo $menu[247]?></b></h4>
                    <p><?php echo $menu[248]?> </p>
                </div>

                <div class="col-12 ">
                    <h4>2.<b> <?php echo $menu[249]?></b></h4>
                    <p class="my-1">
                        <?php echo $menu[250]?>
                    </p>
                    <p class="my-1">
                        <?php echo $menu[251]?>
                    </p>
                    <p class="my-1">
                        <?php echo $menu[252]?>
                    </p>
                </div>



                <div class="col-12 ">
                    <h4>3.<b><?php echo $menu[253]?></b></h4>
                    <p class="my-1">
                        <?php echo $menu[254]?>
                    </p>
                    <p class="my-1">
                        <?php echo $menu[256]?>
                    </p>
                    <p class="my-1">
                        <?php echo $menu[257]?>
                    </p>
                </div>
                <div class="col-12 ">
                    <h4>4.<b>  <?php echo $menu[258]?></b></h4>
                    <p class="my-1">
                        <?php echo $menu[259]?>
                    </p>
                    <p class="my-1"> <?php echo $menu[260]?></p>

                    <h5 class="text-decoration-underline">
                        <?php echo $menu[255]?>
                    </h5>

                    <h6><i class="fa-solid fa-money-bill"></i>  <?php echo $menu[242] ?> </h6>
                    <h6><i class="fa-solid fa-money-bill"></i>  <?php echo $menu[243] ?> </h6>
                    <h6><i class="fa-solid fa-money-bill"></i>  <?php echo $menu[244] ?> </h6>
                    <h6><i class="fa-solid fa-money-bill"></i>  <?php echo $menu[245] ?> </h6>
                    <p class="text-muted"> <?php echo $menu[246] ?></p>

                </div>

                <div class="col-12 ">
                    <h4>5.<b> <?php echo $menu[262] ?></b></h4>
                    <p class="my-1">
                        <?php echo $menu[263] ?>
                      </p>
                    <p class="my-1">
                        <?php echo $menu[264] ?>
                    </p>
                    <p class="my-1">
                        <?php echo $menu[265] ?>
                    </p>
                </div>

                <div class="col-12 ">
                    <h4>6.<b> <?php echo $menu[266] ?></b></h4>
                    <p class="my-1"><?php echo $menu[267] ?></p>
                    <p class="my-1">
                        <?php echo $menu[268] ?>
                    </p>
                    <p class="my-1"><b>
                            <?php echo $menu[269] ?>
                        </b>
                    </p>
                    <p class="my-1"> <?php echo $menu[270] ?> </p>
                    <p class="my-1"><?php echo $menu[271] ?></p>
                </div>

                <div class="col-12 ">
                    <h4>7.<b> <?php echo $menu[272] ?></b></h4>
                    <p class="my-1"><?php echo $menu[273] ?> </p>

                </div>

                <div class="col-12 ">
                    <h4>8.<b> <?php echo $menu[274] ?> </b></h4>
                    <p class="my-1"><?php echo $menu[275] ?>
                    </p>

                </div>

                <div class="col-12 ">
                    <h4>9.<b> <?php echo $menu[276] ?></b></h4>
                    <p class="my-1"><?php echo $menu[277] ?>
                    </p>
                    <b> <?php echo $menu[278] ?>  </b>

                    <p class="my-1"> <?php echo $menu[279] ?></p>

                    <p class="my-1">
                        <?php echo $menu[280] ?>
                    </p>

                    <p class="my-1">
                        <?php echo $menu[281] ?>
                    </p>

                    <b class="my-1">
                        <?php echo $menu[282] ?>
                    </b>

                    <p class="my-1">
                        <?php echo $menu[283] ?>
                    </p>

                    <p class="my-1">
                        <?php echo $menu[284] ?>
                    </p>


                </div>

            </div>
        </div>

        </div>
    </section>

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