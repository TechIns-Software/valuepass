<?php
if (!isset($conn)) {
    include 'connection.php';
}
$title = "Homepage | ValuePass";
$home = 1;
include_once 'includes/header.php';
$idLanguage = $_SESSION["languageId"];
$destinations = getDestinations($conn, $idLanguage);
getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber,$destinations);
?>

<main>
    <!-- START SLIDER -->
    <div id="rev_slider_44_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="mask-showcase"
         data-source="gallery">
        <!-- Start revolution slider 5.4.8 fullscreen mode -->
        <div id="rev_slider_44" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.8">
            <ul>
                <!-- breakPoints 1042px,794px,479px-->
                <!-- start slide 01 -->
                <li data-index="rs-73" data-transition="zoomout" data-slotamount="default" data-hideafterloop="0"
                    data-hideslideonmobile="off" data-easein="Power1.easeInOut" data-easeout="Power2.easeInOut"
                    data-masterspeed="1500" data-rotate="0" data-saveperformance="off" data-title="01" data-param1="01"
                    data-description="">
                    <!-- main image -->
                    <img src="assets/img/slider_images/1small.jpg" alt="" data-bgcolor="#ccc"
                         data-bgposition="20% center" data-bgfit="cover" data-bgrepeat="no-repeat"
                         data-bgparallax="off" class="rev-slidebg" data-no-retina>
                    <div class="rev-slider-mask"></div>
                    <!-- main text layer -->
                    <div class="tp-caption tp-resizeme text-white text-center" id="slide-411-layer-01"
                         data-frames='[{"delay":200,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                         data-type="text" data-whitespace="nowrap" data-x="['center','center','center','center']"
                         data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                         data-voffset="['-50','-50','-50','-80']" data-width="auto" data-height="auto"
                         data-fontsize="['50','43','30','30']" data-lineheight="['70','45','40','40']"
                         data-letterspacing="['-2','-1','-1','-1']" data-responsive="off" data-responsive_offset="off"
                         data-paddingtop="['0','0','0','0']" data-paddingbottom="['0','0','0','0']"
                         data-paddingright="['0','0','0','0']" data-paddingleft="['0','0','0','0']"
                         style="text-shadow: 0 0 20px rgba(0,0,0,0.3); font-weight: 600;"> <?php echo $menu[157]; ?>
                        <br> <?php echo $menu[158]; ?>
                    </div>
                    <!-- btn layer -->
                    <a class="tp-caption tp-resizeme rs-btn btn_1" href="how.php" id="slide-411-layer-03"
                       onclick="window.location.href='how.php'" data-bs-toggle="modal" data-bs-target="#howitworks"
                       data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                       data-y="['middle','middle','middle','middle']" data-voffset="['152','130','50','0']"
                       data-whitespace="nowrap" data-type="button" data-responsive="off" data-responsive_offset="off"
                       data-frames='[{"delay":1200,"speed":1000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                       data-textAlign="['center','center','center','center']"><?php echo $menu[1] ?>
                    </a>


                </li>
                <!-- end slide 01 -->
                <!-- start slide 02 -->
                <li data-index="rs-74" data-transition="fadetotopfadefrombottom" data-slotamount="default"
                    data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power3.easeInOut"
                    data-easeout="Power3.easeInOut" data-masterspeed="1500" data-rotate="0" data-saveperformance="off"
                    data-title="02" data-param1="02" data-description="">
                    <!-- main image -->
                    <img src="assets/img/slider_images/2small.jpg" alt="" data-bgcolor="#ccc"
                         data-bgposition="60% center" data-bgfit="cover" data-bgrepeat="no-repeat"
                         data-bgparallax="off" class="rev-slidebg" data-no-retina>
                    <div class="rev-slider-mask"></div>
                    <!-- main text layer -->
                    <div class="tp-caption tp-resizeme alt-font text-white font-weight-600 text-center"
                         id="slide-411-layer-04"
                         data-frames='[{"delay":200,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                         data-type="text" data-whitespace="nowrap" data-x="['center','center','center','center']"
                         data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                         data-voffset="['-50','-50','-50','-80']" data-width="auto" data-height="auto"
                         data-fontsize="['60','43','25','25']" data-lineheight="['70','59','40','39']"
                         data-letterspacing="['-2','-1','-1','-1']" data-responsive="off" data-responsive_offset="off"
                         data-paddingtop="['0','0','0','0']" data-paddingbottom="['0','0','0','0']"
                         data-paddingright="['0','0','0','0']" data-paddingleft="['0','0','0','0']"
                         style="text-shadow: 0 0 20px rgba(0,0,0,0.3); font-weight: 600">  <?php echo $menu[159]; ?>
                        <br> <?php echo $menu[160]; ?>
                    </div>
                    <!-- btn layer -->
                    <a class="tp-caption tp-resizeme rs-btn btn_1" href="how.php" id="slide-411-layer-06"
                       onclick="window.location.href='how.php'" data-bs-toggle="modal" data-bs-target="#howitworks"
                       data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                       data-y="['middle','middle','middle','middle']" data-voffset="['152','130','50','0']"
                       data-whitespace="nowrap" data-type="button" data-responsive="off" data-responsive_offset="off"
                       data-frames='[{"delay":1200,"speed":1000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                       data-textAlign="['center','center','center','center']"
                       data-paddingleft="['34','34','34','34']"><?php echo $menu[1] ?>
                    </a>
                </li>
                <!-- end slide 02 -->
                <!-- start slide 03 -->
                <li data-index="rs-75" data-transition="fadetotopfadefrombottom" data-slotamount="default"
                    data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power3.easeInOut"
                    data-easeout="Power3.easeInOut" data-masterspeed="1500" data-rotate="0" data-saveperformance="off"
                    data-title="03" data-param1="03" data-description="">
                    <!-- main image -->
                    <img src="assets/img/slider_images/3small.jpg" alt="" data-bgcolor="#ccc"
                         data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                         data-bgparallax="off" class="rev-slidebg" data-no-retina>

                    <div class="rev-slider-mask"></div>

                    <!-- main text layer -->
                    <div class="tp-caption tp-resizeme text-white text-center" id="slide-411-layer-07"
                         data-frames='[{"delay":200,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                         data-type="text" data-whitespace="nowrap" data-x="['center','center','center','center']"
                         data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                         data-voffset="['-50','-50','-50','-80']" data-width="auto" data-height="auto"
                         data-fontsize="['60','43','25','25']" data-lineheight="['70','59','50','39']"
                         data-letterspacing="['-2','-1','-1','-1']" data-responsive="off" data-responsive_offset="off"
                         data-paddingtop="['0','0','0','0']" data-paddingbottom="['0','0','0','0']"
                         data-paddingright="['0','0','0','0']" data-paddingleft="['0','0','0','0']"
                         style="text-shadow: 0 0 20px rgba(0,0,0,0.3); font-weight: 600"> <?php echo $menu[161]; ?> <br>
                        <?php echo $menu[162]; ?>
                    </div>

                    <!-- btn layer -->
                    <a class="tp-caption tp-resizeme rs-btn btn_1" href="how.php" id="slide-411-layer-09"
                       onclick="window.location.href='how.php'" data-bs-toggle="modal" data-bs-target="#howitworks"
                       data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                       data-y="['middle','middle','middle','middle']" data-voffset="['152','130','50','0']"
                       data-whitespace="nowrap" data-type="button" data-responsive="off" data-responsive_offset="off"
                       data-frames='[{"delay":1200,"speed":1000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[-100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                       data-textAlign="['center','center','center','center']"><?php echo $menu[1] ?>
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
                <h2><?php echo $menu[14] ?></h2>

                <!--                <p class="fs-2"><strong> --><?php //echo $menu[15] ?><!-- </strong></p>-->
            </div>

        </div>
        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->


    <div id="how" class="container margin_80_55">
        <div class="main_title_2">
            <span><em></em></span>
            <h2><b> <?php echo $menu[16] ?></b></h2>
            <p><?php echo $menu[17] ?> </p>

        </div>

        <div id="reccomended_adventure2" class="owl-carousel owl-theme">

            <div class="item">
                <a class="box_feat ">
                    <!-- <i class="pe-7s-medal"></i> -->
                    <object class="SvgImage" data="assets/icons/fingerprint.svg"
                            type="image/svg+xml"></object>
                    <h3><?php echo $menu[18] ?>  </h3>
                    <p> <?php echo $menu[19] ?> </p>
                </a>
            </div>

            <div class="item">
                <a class="box_feat">
                    <object class="SvgImage" data="assets/icons/gift.svg"
                            type="image/svg+xml"></object>
                    <h3> <?php echo $menu[20] ?>  </h3>
                    <p><?php echo $menu[21] ?> </p>
                    <!-- Button trigger modal -->
                    <b class="custom-pop" type="button" data-bs-toggle="modal"
                       data-bs-target="#exampleModal"> <?php echo $menu[22] ?></b>
                </a>

            </div>

            <div class="item">
                <a class="box_feat">
                    <!-- <i class="pe-7s-culture"></i> -->
                    <object class="SvgImage" data="assets/icons/spring.svg"
                            type="image/svg+xml"></object>
                    <h3><?php echo $menu[27] ?> </h3>
                    <p><?php echo $menu[28] ?>  </p>
                    <b class="custom-pop" type="button" data-bs-toggle="modal"
                       data-bs-target="#exampleModal1"> <?php echo $menu[22] ?></b>
                </a>

            </div>

            <div class="item">
                <a class="box_feat">
                    <object class="SvgImage" data="assets/icons/smartphone.svg"
                            type="image/svg+xml"></object>
                    <h3> <?php echo $menu[30] ?></h3>
                    <p> <?php echo $menu[31] ?> </p>
                    <b class="custom-pop" type="button" data-bs-toggle="modal"
                       data-bs-target="#exampleModal3"> <?php echo $menu[22] ?></b>
                </a>
            </div>

            <div class="item">
                <a class="box_feat">
                    <object class="SvgImage" data="assets/icons/credit-card.svg"
                            type="image/svg+xml"></object>
                    <h3><?php echo $menu[32] ?>  </h3>
                    <p><?php echo $menu[33] ?> </p>
                    <b class="custom-pop" type="button" data-bs-toggle="modal"
                       data-bs-target="#exampleModal2"> <?php echo $menu[22] ?></b>
                </a>
            </div>

            <div class="item">
                <a class="box_feat">
                    <object class="SvgImage" data="assets/icons/support.svg"
                            type="image/svg+xml"></object>
                    <h3><?php echo $menu[34] ?> </h3>
                    <p> <?php echo $menu[35] ?> </p>
                    <b class="custom-pop" type="button" data-bs-toggle="modal"
                       data-bs-target="#exampleModal4"> <?php echo $menu[22] ?></b>
                </a>
            </div>


        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div style="min-height: 120px;"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalLabel"> <?php echo $menu[23] ?>

                        </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="col-lg-12 my-1 ">
                        <p class="my-1">  <?php echo $menu[13] ?> </p>
                        <p class="my-1"> <b>  <?php echo $menu[24] ?> </b> </p>
                    </div>

                    <?php if ($_SESSION['languageId'] == 1){   ?>
                        <h6> Επιλέγοντας 4 VP Vouchers το 1 είναι Δωρεάν </h6>
                        <h6> Επιλέγοντας 6 VP Vouchers τα 2 είναι Δωρεάν </h6>
                        <h6> Επιλέγοντας 8 VP Vouchers τα 3 είναι Δωρεάν </h6>
                        <h6>  Επιλέγοντας 10 VP Vouchers τα 4 είναι Δωρεάν </h6>
                        <p class="text-muted">Η προσφορά ισχύει ΜΟΝΟ για τα VP Vouchers και ΟΧΙ για τις δραστηριότητες.</p>
                    <?php  }else{?>

                        <h6>  Select 4 VP Vouchers and 1 of the 4 is Free </h6>
                        <h6>  Select 6 VP Vouchers and 2 of the 6 are Free </h6>
                        <h6>  Select 8 VP Vouchers and 3 of the 8 are Free </h6>
                        <h6>  Select 10 VP Vouchers and 4 of the 10 are Free </h6>
                        <p class="text-muted"> The offer only applies to the VP Vouchers, NOT the activities. </p>
                    <?php   }  ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1"
         aria-labelledby="exampleModalLabel1"
         aria-hidden="true">
        <div style="min-height: 120px;"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalLabel1"><?php echo $menu[29] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">


                        <p> •  <?php echo $menu[194] ?>  </p>
                        <p> •  <?php echo $menu[71] ?>  </p>


                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1"
         aria-labelledby="exampleModalLabel1"
         aria-hidden="true">
        <div style="min-height: 120px;"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalLabel1"><?php echo $menu[32] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>• <?php echo $menu[91] ?></p>
                    <p>• <?php echo $menu[92] ?></p>
                    <p>• <?php echo $menu[93] ?></p>
                    <p>• <?php echo $menu[94] ?></p>
                    <a target="_blank"
                       href="<?php echo $_SESSION["languageId"] == 1 ? 'terms_gr.pdf' : 'terms_gb.pdf' ?>"> <?php echo $menu[95] ?></a>

                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal3" tabindex="-1"
         aria-labelledby="exampleModalLabel1"
         aria-hidden="true">
        <div style="min-height: 120px;"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalLabel1"><?php echo $menu[177] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>    <?php echo $menu[178] ?></p>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal4" tabindex="-1"
         aria-labelledby="exampleModalLabel1"
         aria-hidden="true">
        <div style="min-height: 120px;"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
<!--                    <h5 class="modal-title" id="exampleModalLabel1">--><?php //echo $menu[177] ?><!-- </h5>-->
                    <h5 class="modal-title" id="exampleModalLabel1">Customer Care</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><b> Email:</b> <a href="mailto:customercare@valuepass.gr" class="icon-email">
                            customercare@valuepass.gr</a></p>
                    <p><b> WhatsApp:</b> <a
                                href="https://wa.me/+306931451910?text='Valuepass Support is available 24/7'"> <img
                                    src="assets/icons/whatsapp.png" height="20" width="20" class="img-fluid">
                            +306931451910</a></p>
                    <p><b> Viber:</b> <a href="https://msng.link/o/?306931451910=vi"> <img src="assets/icons/viber.png"
                                                                                           height="20" width="20"
                                                                                           class="img-fluid">
                            +306931451910</a></p>

                </div>
            </div>
        </div>
    </div>


    <div class="container container-custom margin_80_55 col-lg-12 ">

        <section class="add_bottom_45">
            <div class="main_title_2">
                <span><em></em></span>
                <h2><?php echo $menu[36] ?></h2>
                <p> <?php echo $menu[37] ?> </p>
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
                                    <small class="card-meta mb-2"><?php echo $destination->getNumberOfVendors(); ?><?php echo ' ' . $menu[3] ?></small>
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
<!-- <script src="assets/js/revapi44.js"></script> -->

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

<script src="assets/js/popper.min.js"></script>

<script src="changeLanguage.js"></script>
<script  src="assets/js/changeviberurl.js"></script>


</body>

</html>