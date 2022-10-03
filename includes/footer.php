<?php


function footer($menu,$languages){ ?>

    <footer>
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-5 col-md-12 pe-5">
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

                        <li><a href="how.php"> <?php echo $menu[4] ?> </a></li>
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
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <ul id="additional_links">
                        <li><a href="<?php echo $_SESSION["languageId"] == 1 ? 'terms_gr.pdf' : 'terms_gb.pdf' ?>"
                               target="_blank"><?php echo $menu[10] ?></a></li>
                        <li><a><?php echo $menu[11] ?></a></li>
                        <li><span>© ValuePass</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <div id="toTop"></div><!-- Back to top button -->



<?php  } ?>