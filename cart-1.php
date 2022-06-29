<?php
/*
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/16f09725b0.js" crossorigin="anonymous"></script>
 */
if (!isset($conn)) {
    include 'connection.php';
}

$title = "Cart";
$home = 0 ;
$urr = $_SERVER['REQUEST_URI'];

include_once 'includes/header.php';

if (!isset($cartArray)) {
    $cartArray = unserialize($_SESSION['cart']);
}
?>
<main>
    <!--    FIXME: height unset makes it the back image(svg file blue only for navbar-->

        <div class="container container-custom margin_80_55">
            <div class="row">
                <?php
                //TODO: We need that calculation in backend as well, so make function
                if (count($cartArray) == 0) { ?>
                    <div class="col-lg-12  novoucherincard">
                        <h3 class="my-5">No Vouchers in the card</h3>
                      <h4 class="my-5"> <a href="adventures.php">Go Back and select your Experience</a> </h4>
                    </div>

                <?php   } else {

                ?>
                <div style="min-height: 110px;"></div>
                    <div class="col-lg-8 ">
                        <div class="box_cart">
                            <table class="table cart-list">
                                <thead>
                                    <tr>
                                        <th>
                                            Activity
                                        </th>
                                        <th>
                                            Date
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
                                    $objectVouchersDisplay = createArrayVouchersSortedFromCart($conn, $cartArray);
                                    $vendorId = $objectVouchersDisplay['vendorId'];
                                    $allVouchers = $objectVouchersDisplay['allVouchers'];
                                    $nameVendorArray = $objectVouchersDisplay['nameVendor'];
                                    $dateVoucherArray = $objectVouchersDisplay['dateVoucher'];
                                    $imageVendorArray = $objectVouchersDisplay['imageVendor'];
                                    $adultsArray = $objectVouchersDisplay['adults'];
                                    $childrenArray = $objectVouchersDisplay['children'];
                                    $infantsArray = $objectVouchersDisplay['infants'];
                                    $amountPayArray = $objectVouchersDisplay['amountPay'];
                                    for ($counter = 0; $counter < count($nameVendorArray); $counter++) {
                                        $nameVendor = $nameVendorArray[$counter];
                                        $dateVoucher = $dateVoucherArray[$counter];
                                        $adults = $adultsArray[$counter];
                                        $children = $childrenArray[$counter];
                                        $infants = $infantsArray[$counter];
                                        $amountPay = $amountPayArray[$counter];
                                        $imageVendor = $imageVendorArray[$counter];
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="thumb_cart">
                                                    <img src="vendorImages/<?php echo $vendorId.'/'.$imageVendor?>" alt="Image">
                                                </div>
                                                <span class="item_cart"><?php echo $nameVendor; ?></span>
                                            </td>
                                            <td>
                                                <?php echo $dateVoucher; ?>
                                            </td>
                                            <td>
                                                Adults: <?php echo $adults; ?>
                                                <br>
                                                Children: <?php echo $children; ?>
                                                <br>
                                                Infants: <?php echo $infants; ?>
                                            </td>
                                            <td>
                                                <strong><?php echo $amountPay; ?>€</strong>
                                            </td>
                                            <td class="options" style="width:5%; text-align:center;">
                                                <a href="javascript:deleteItem(<?php echo $counter;?>);"><i class="icon-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /col -->
                    <?php
                    $calculateCartObject = calculatePriceCart($allVouchers);
                    //                    TODO: when voucher is 1 or 0
                    ?>
                    <aside class="col-lg-4">
                        <div style="min-height: 30px;background-color: white"></div>
                        <div class="box_detail">
                            <div id="total_cart">
                                Total <span class="float-end">
                                    <?php
                                    if ($calculateCartObject['moneyEarned'] != 0) {
                                        ?>
                                        <span style="text-decoration: line-through">
                                            <?php echo $calculateCartObject['totalPay'] + $calculateCartObject['moneyEarned']; ?>
                                        </span> /
                                        <?php
                                    }
                                    echo $calculateCartObject['totalPay'];
                                    ?>
                                </span>
                            </div>
                            <ul class="cart_details">
                                <li>Total Vouchers Get<span><?php echo count($allVouchers); ?></span></li>
                                <li>Vouchers Pay<span><?php echo $calculateCartObject['vouchersPay']; ?></span></li>
                                <li>Vouchers Get Free<span><?php echo count($allVouchers) - $calculateCartObject['vouchersPay']; ?></span></li>
                            </ul>
                            <input onclick="" type="button" value="Checkout" class="btn btn-secondary btn_1 full-width purchase" <?php echo ($calculateCartObject['canOrder'] ? '' : 'disabled'); ?>>
                            <!--                        <div class="text-center"><small>No money charged in this step</small></div>-->
                        </div>
                    </aside>
                <?php
                }
                ?>

            </div>
            <!-- /row -->
        </div>
  

    

</main>
<!--/main-->

<footer>
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-5 col-md-12 pe-5">
            <p><img src="assets/img/valuepassLogo.png" width="180" height="100" alt="Logo"></p>
                <p>Escape the tourist traps with unforgettable travel experiences . Get beneath the surface of these destinations .
                    All our proposals are hand-picked by our team! . </p>
                <b> Get inspired for your next trip </b>
                <div class="follow_us">
                    <ul>
                        <li><?php echo $menu[12] ?> </li>
                        <li><a href="#0"><i class="ti-facebook"></i></a></li>
                        <li><a href="#0"><i class="ti-twitter-alt"></i></a></li>
                        <li><a href="#0"><i class="ti-google"></i></a></li>
                        <li><a href="#0"><i class="ti-pinterest"></i></a></li>
                        <li><a href="#0"><i class="ti-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 ms-lg-auto">
                <h5> <?php echo $menu[8] ?></h5>
                <ul class="links ">
                    <li><a href="#"><?php echo $menu[6] ?></a>
                        <ul>

                            <?php
                            foreach ($languages  as $language) {  ?>
                                <li class=" ps-3"><a href="javascript:void(0);" onclick="changeLanguage('<?php echo $language[0] ?>');"><span class="flag-icon flag-icon-<?php echo $language[2] ?>"></span> <?php echo $language[1] ?></a> </li>
                            <?php    } ?>

                        </ul>
                    </li>

                    <li><a href="#"> <?php echo $menu[4] ?> </a></li>
                    <li><a href="cart-1.php"><?php echo $menu[7] ?></a></li>

                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5><?php echo $menu[9] ?></h5>
                <ul class="contacts">
                    <li><a href="tel://61280932400"><i class="ti-mobile"></i> + 61 23 8093 3400</a></li>
                    <li><a href="mailto:info@valuepass.com"><i class="ti-email"></i> info@valuepass.com</a></li>
                </ul>
            </div>
        </div>
        <!--/row-->
        <hr>
        <div class="row">
            <!-- <div class="col-lg-6">
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

				</ul>
			</div> -->
            <div class="col-lg-12">
                <ul id="additional_links">
                    <li><a href="#0"><?php echo $menu[10] ?></a></li>
                    <li><a href="#0"><?php echo $menu[11] ?></a></li>
                    <li><span>© ValuePass</span></li>
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
                Don’t have an account? <a href="#">Sign up</a>
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
<script src="backend/js/cart.js"></script>

</html>