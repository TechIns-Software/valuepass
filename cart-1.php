<?php
/*
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/16f09725b0.js" crossorigin="anonymous"></script>
 */
if (!isset($conn)) {
    include 'connection.php';
}
$title = "Cart";
include_once 'includes/header.php';
include 'initializeExperience.php';
include 'backend/includeClasses.php';
include 'backend/finalLibrary.php';
$cart = unserialize($_SESSION['cart']);
?>
<main>
<!--    FIXME: height unset makes it the back image(svg file blue only for navbar-->
    <div style="height: unset;max-height: 85px;background: #0a53be" class="hero_in cart_section">
        <div class="wrapper">
            <div class="container">

                <!-- End bs-wizard -->
            </div>
        </div>
    </div>
    <div style="min-height: 25px;background-color: white"></div>
    <!--/hero_in-->
    <div class="bg_color_1">
        <div class="container margin_60_35">
            <div class="row">
                <?php
                //TODO: We need that calculation in backend as well, so make function
                $voucherWant1 = new \ValuePass\VoucherWant(1,true, 3);
                $voucherWant2 = new \ValuePass\VoucherWant(1,true, 0);
                $voucherWant3 = new \ValuePass\VoucherWant(1, false);
                $voucherWant4 = new \ValuePass\VoucherWant(1,false);
                array_push($cart, [$voucherWant1, $voucherWant2, $voucherWant3, $voucherWant4]);
                $voucherWant1 = new \ValuePass\VoucherWant(1,true, 3);
                $voucherWant2 = new \ValuePass\VoucherWant(1,true, 0);
                $voucherWant3 = new \ValuePass\VoucherWant(1, false);
                $voucherWant4 = new \ValuePass\VoucherWant(1,false);
                array_push($cart, [$voucherWant1, $voucherWant2, $voucherWant3, $voucherWant4]);
                if (count($cart) == 0) {

                } else {
                    ?>
                    <div class="col-lg-8">
                    <div class="box_cart">
                    <table class="table cart-list">
                    <thead>
                    <tr>
                        <th>
                            Activity
                        </th>
                        <th>
                            Vouchers
                        </th>
                        <th>
                            Total Price
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $allVouchers = [];
                    foreach ($cart as $arrayVouchersWant) {
                        $arrayPrices = getVendorForCart($conn,$arrayVouchersWant[0]->getIdVendorVoucher());
//                        $priceAdult = $arrayPrices[0];
//                        $priceChild = $arrayPrices[1];
//                        $priceInfant = $arrayPrices[2];
                        $priceAdult = 10;
                        $priceChild = 5;
                        $priceInfant = 2;
                        $adults = 0;
                        $children = 0;
                        $infants = 0;
                        foreach ($arrayVouchersWant as $voucherWant) {
                            if ($voucherWant->isAdult()) {
                                $voucherWant->setPrice($priceAdult + $voucherWant->getNumberOfInfant() * $priceInfant);
                            } else {
                                $voucherWant->setPrice($priceChild);

                            }
                            array_push($allVouchers, $voucherWant);
                            $infants = $infants + $voucherWant->getNumberOfInfant();
                            $voucherWant->isAdult() ? $adults = $adults + 1 : $children = $children + 1;
                        }
                        //TODO: getVendor name and image

                        $amountPay = $priceAdult * $adults + $priceChild * $children + $priceInfant * $infants;
                    ?>
                        <tr>
                            <td>
                                <div class="thumb_cart">
                                    <img src="http://via.placeholder.com/150x150/ccc/fff/thumb_cart_1.jpg" alt="Image">
                                </div>
                                <span class="item_cart">Persius delenit has cu</span>
                            </td>
                            <td>
                                Adults: <?php echo $adults;?>
                                <br>
                                Children: <?php echo $children;?>
                                <br>
                                Infants: <?php echo $infants;?>
                            </td>
                            <td>
                                <strong><?php echo $amountPay;?>€</strong>
                            </td>
                            <td class="options" style="width:5%; text-align:center;">
                                <a href="javascript:deleteItem(0);"><i class="icon-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    //sort from bigger to smaller
                    usort($allVouchers, function($a, $b) {
                        return $b->getPrice() - $a->getPrice();
                    });
                    ?>
                    </tbody>
                    </table>
                    </div>
                    </div>
                    <!-- /col -->
                    <?php
                    $canOrderVouchers = true;
                    if (count($allVouchers) < 2 || count($allVouchers) > 11) {
                        $canOrderVouchers = false;
                    }
                    $lengthHowManyPay = count($allVouchers);
                    if (count($allVouchers) > 3 && count($allVouchers) <= 5) {
                        $lengthHowManyPay = count($allVouchers) - 1;
                    } elseif (count($allVouchers) <= 7) {
                        $lengthHowManyPay = count($allVouchers) - 2;
                    } elseif (count($allVouchers) <= 9) {
                        $lengthHowManyPay = count($allVouchers) - 3;
                    } elseif (count($allVouchers) <= 11) {
                        $lengthHowManyPay = count($allVouchers) - 4;
                    }
                    $totalToPay = 0;
                    $less = 0;
                    for ($counter = 0; $counter < count($allVouchers); $counter++) {
                        if ($counter + 1 <= $lengthHowManyPay) {
                            $totalToPay = $totalToPay + $allVouchers[$counter]->getPrice();
                        } else {
                            $less = $less + $allVouchers[$counter]->getPrice();
                        }
                    }
                    ?>
                    <aside class="col-lg-4">
                        <div style="min-height: 30px;background-color: white"></div>
                        <div class="box_detail">
                            <div id="total_cart">
                                Total <span class="float-end">
                                <span style="text-decoration: line-through"><?php echo $totalToPay + $less;?></span> / <?php echo $totalToPay;?>$
                            </span>
                            </div>
                            <ul class="cart_details">
                                <li>Total Vouchers Get<span><?php echo count($allVouchers);?></span></li>
                                <li>Vouchers Pay<span><?php echo $lengthHowManyPay;?></span></li>
                                <li>Vouchers Get Free<span><?php echo count($allVouchers) - $lengthHowManyPay;?></span></li>
                            </ul>
                            <input type="button" value="Checkout" class="btn btn-secondary btn_1 full-width purchase" <?php echo ($canOrderVouchers ? '' : 'disabled');?>>
                            <!--                        <div class="text-center"><small>No money charged in this step</small></div>-->
                        </div>
                    </aside>
                    <?php
                }
                ?>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->
</main>
<!--/main-->

<footer>
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-5 col-md-12 pe-5">
                <p><img src="img/logo.svg" width="150" height="36" alt=""></p>
                <p>Mea nibh meis philosophia eu. Duis legimus efficiantur ea sea. Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu. Nihil facilisi indoctum an vix, ut delectus expetendis vis.</p>
                <div class="follow_us">
                    <ul>
                        <li>Follow us</li>
                        <li><a href="#0"><i class="ti-facebook"></i></a></li>
                        <li><a href="#0"><i class="ti-twitter-alt"></i></a></li>
                        <li><a href="#0"><i class="ti-google"></i></a></li>
                        <li><a href="#0"><i class="ti-pinterest"></i></a></li>
                        <li><a href="#0"><i class="ti-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 ms-lg-auto">
                <h5>Useful links</h5>
                <ul class="links">
                    <li><a href="about.html">About</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="register.html">Register</a></li>
                    <li><a href="blog.html">News &amp; Events</a></li>
                    <li><a href="contacts.html">Contacts</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5>Contact with Us</h5>
                <ul class="contacts">
                    <li><a href="tel://61280932400"><i class="ti-mobile"></i> + 61 23 8093 3400</a></li>
                    <li><a href="mailto:info@Panagea.com"><i class="ti-email"></i> info@Panagea.com</a></li>
                </ul>
                <div id="newsletter">
                    <h6>Newsletter</h6>
                    <div id="message-newsletter"></div>
                    <form method="post" action="assets/newsletter.php" name="newsletter_form" id="newsletter_form">
                        <div class="form-group">
                            <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                            <input type="submit" value="Submit" id="submit-newsletter">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/row-->
        <hr>
        <div class="row">
            <div class="col-lg-6">
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
                    <li><img src="img/cards_all.svg" alt=""></li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul id="additional_links">
                    <li><a href="#0">Terms and conditions</a></li>
                    <li><a href="#0">Privacy</a></li>
                    <li><span>© Panagea</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--/footer-->
</div>
<!-- page -->

<!-- Sign In Popup -->
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>Sign In</h3>
    </div>
    <form>
        <div class="sign-in-wrapper">
            <a href="#0" class="social_bt facebook">Login with Facebook</a>
            <a href="#0" class="social_bt google">Login with Google</a>
            <div class="divider"><span>Or</span></div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email">
                <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" value="">
                <i class="icon_lock_alt"></i>
            </div>
            <div class="clearfix add_bottom_15">
                <div class="checkboxes float-start">
                    <label class="container_check">Remember me
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="float-end mt-1"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
            </div>
            <div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>
            <div class="text-center">
                Don’t have an account? <a href="register.html">Sign up</a>
            </div>
            <div id="forgot_pw">
                <div class="form-group">
                    <label>Please confirm login email below</label>
                    <input type="email" class="form-control" name="email_forgot" id="email_forgot">
                    <i class="icon_mail_alt"></i>
                </div>
                <p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
                <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
            </div>
        </div>
    </form>
    <!--form -->
</div>
<!-- /Sign In Popup -->

<div id="toTop"></div><!-- Back to top button -->

<!-- COMMON SCRIPTS -->
<script src="assets/js/common_scripts.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/validate.js"></script>

<!-- COLOR SWITCHER  -->
<!-- <script src="js/switcher.js"></script>
<div id="style-switcher">
    <h6>Color Switcher <a href="#"><i class="ti-settings"></i></a></h6>
    <div>
        <ul class="colors" id="color1">
            <li>
                <a href="#" class="default" title="Default"></a>
            </li>
            <li>
                <a href="#" class="aqua" title="Aqua"></a>
            </li>
            <li>
                <a href="#" class="green_switcher" title="Green"></a>
            </li>
            <li>
                <a href="#" class="orange" title="Orange"></a>
            </li>
            <li>
                <a href="#" class="blue" title="Blue"></a>
            </li>
            <li>
                <a href="#" class="beige" title="Beige"></a>
            </li>
            <li>
                <a href="#" class="gray" title="Gray"></a>
            </li>
            <li>
                <a href="#" class="green-2" title="Green"></a>
            </li>
            <li>
                <a href="#" class="navy" title="Navy"></a>
            </li>
            <li>
                <a href="#" class="peach" title="Peach"></a>
            </li>
            <li>
                <a href="#" class="purple" title="Purple"></a>
            </li>
            <li>
                <a href="#" class="red" title="Red"></a>
            </li>
            <li>
                <a href="#" class="violet" title="Violet"></a>
            </li>
        </ul>
    </div>
</div> -->

</body>

</html>