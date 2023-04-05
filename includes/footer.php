<?php


function footer($menu, $languages)
{ ?>

    <footer>
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-3 col-md-12 ">
                    <p class="text-center "><img src="assets/img/valuepassLogo.png" class="footerlogo " alt="Logo"></p>
                    <div class="follow_us text-center">
                        <h5> <?php echo $menu[12] ?>  </h5>
                        <ul>
                            <li><a><img class="img-fluid" src="assets/img/facebook.png" height="45" width="45"> </a></li>
                            <li><a><img class="img-fluid" src="assets/img/instagram.png" height="55" width="55"></a></li>
                        </ul>
                    </div>

                    <div class="text-center d-none d-md-block">
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
                        </ul>
                    </div>
                </div>

                <div class=" col-lg-3 col-md-6  text-center"  >

                    <h5 class="border-bottom  icon-down-1 " id="collapsetitle" data-bs-toggle="collapse"
                        href="#collapse5" role="button"
                        aria-expanded="false" aria-controls="collapseExample"
                        id="collapsebox">  <?php echo $menu[9] ?> </h5>

                    <div id="collapse5"  class="  collapse show">
                        <div class="">
                            <div class="row px-4">
                                <ul class="links ">
                                    <h5 class="m-0" > <?php echo $menu[4] ?></h5>
                                    <li>
                                        <ul class="ps-3" >
                                            <li>
                                                <a  href="https://api.whatsapp.com/send/?phone=306931451910&text=Welcome+to+ValuePass%21+How+can+we+help+you%3F+&type=phone_number&app_absent=0">
                                                    <img src="assets/icons/whatsapp.png" height="20" width="20" class="img-fluid">+
                                                    306931451910</a></li>
                                            <li><a class="viberlink" href="viber://add?number=306931451910"> <img
                                                            src="assets/icons/viber.png" height="20" width="20" class="img-fluid">
                                                    +306931451910</a></li>
                                            <li><a href="mailto:customercare@valuepass.gr" class="icon-email">
                                                    customercare@valuepass.gr</a></li>

                                        </ul>

                                    </li>

                                    <ul class="ps-3">
                                        <h5 class="m-1"><?php echo $menu[132] ?> </h5>
                                        <li> <a href="mailto:sales@valuepass.gr"> sales@valuepass.gr</a> </li>
                                    </ul>


                                    <ul  class="ps-3">
                                        <h5  class="m-1"><?php echo $menu[133] ?> </h5>
                                        <li> <a href="mailto:info@valuepass.gr">info@valuepass.gr </a> </li>
                                    </ul>
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>


            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <ul id="additional_links">
                        <li><a href="<?php echo $_SESSION["languageId"] == 1 ? 'terms_gr.pdf' : 'terms_gb.pdf' ?>"
                               target="_blank"><?php echo $menu[10] ?></a></li>
                        <li><a href="<?php echo $_SESSION["languageId"] == 1 ? 'cancel_policy_gr.pdf' : 'cancel_policy_gb.pdf' ?>"
                               target="_blank"><?php echo $menu[11] ?></a></li>
                        <li><span>© ValuePass</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <div id="toTop"></div><!-- Back to top button -->
<?php } ?>