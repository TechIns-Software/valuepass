<?php
/*
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/16f09725b0.js" crossorigin="anonymous"></script>
 */
if (!isset($conn)) {
    include 'connection.php';
}

$title = "Cart";
$home = 0;
$urr = $_SERVER['REQUEST_URI'];

include_once 'includes/header.php';
if (!isset($idLanguage)) {
    $idLanguage = $_SESSION["languageId"];
}
if (!isset($cartArray)) {
    $cartArray = unserialize($_SESSION['cart']);
}
getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber);
?>
<script src="backend/js/cart.js"></script>
<main>
    <!--    FIXME: height unset makes it the back image(svg file blue only for navbar-->

    <div class="container container-custom margin_80_55">
        <div class="row">
            <?php
            if (count($cartArray) == 0) { ?>
                <div class="col-lg-12  novoucherincard text-center">
                    <h3 class="my-5"><?php echo $menu[129]; ?></h3>
                    <button id="noVoucherBack" class="btn btn-primary">
                        <?php echo $menu[130]; ?>
                    </button>
                    <script>goBackInHistory('noVoucherBack')</script>
                </div>

            <?php } else {

                ?>
                <div style="min-height: 110px;"></div>
                <div class="col-12 ">
                    <h2>   <?php echo $menu[97]; ?> </h2>
                </div>
                <div class="col-lg-7 col-md-12  ">
                    <div class="row">

                        <?php
                        $objectVouchersDisplay = createArrayVouchersSortedFromCart($conn, $cartArray, $idLanguage);
                        $vendorId = $objectVouchersDisplay['vendorId'];
                        $allVouchers = $objectVouchersDisplay['allVouchers'];
                        $nameVendorArray = $objectVouchersDisplay['nameVendor'];
                        $dateVoucherArray = $objectVouchersDisplay['dateVoucher'];
                        $imageVendorArray = $objectVouchersDisplay['imageVendor'];
                        $adultsArray = $objectVouchersDisplay['adults'];
                        $childrenArray = $objectVouchersDisplay['children'];
                        $infantsArray = $objectVouchersDisplay['infants'];
                        $amountPayArray = $objectVouchersDisplay['amountPay'];
                        $hourCancels = $objectVouchersDisplay['hourCancels'];
                        for ($counter = 0;
                             $counter < count($nameVendorArray);
                             $counter++) {
                            $nameVendor = $nameVendorArray[$counter];
                            $dateVoucher = $dateVoucherArray[$counter];
                            $adults = $adultsArray[$counter];
                            $children = $childrenArray[$counter];
                            $infants = $infantsArray[$counter];
                            $amountPay = $amountPayArray[$counter];
                            $imageVendor = $imageVendorArray[$counter];
                            $hourCancel = $hourCancels[$counter];
                            ?>

                            <div class="col-12 cart-voucher  ">
                                <div class="row">
                                    <div class="col-4 ">
                                        <div class="thumb_cart" >
                                            <img class="img-fluid" src="vendorImages/<?php echo $vendorId[$counter] . '/' . $imageVendor ?>"
                                                 alt="Image">
                                        </div>
                                    </div>

                                    <div class="col-8 ">
                                        <h5 class="py-1">
                                            <span ><?php echo $nameVendor; ?></span>
                                        </h5>

                                        <h6 class="text-end price ">
                                            <strong><?php echo $amountPay; ?>€</strong>
                                        </h6>

                                    </div>

                                    <div class="col-12 py-3 ">
<!--                                        <p class=" m-0   icon-adult  ">Initial Price X NumberOfPersons  </p>-->
                                        <p class="text-muted d-inline icon-adult">
                                            <?php
                                            $flagTemp = false;
                                            if ($adults != 0) {
                                                $flagTemp = true;
                                                echo $menu[110] .' : ' .$adults;
                                            }
                                            if ($children != 0) {
                                                echo ($flagTemp ? ' | ':'') .$menu[111] .' : ' .$children;
                                            } else {
                                                $flagTemp = false;
                                            }
                                            if ($infants != 0) {
                                                echo ($flagTemp ? ' | ':'') .$menu[112] .' : ' .$infants;
                                            }
                                            ?>
                                        </p>
                                        <p class=" m-0  icon-calendar"> <?php echo date_format(date_create($dateVoucher), 'M d, Y'); ?> </p>
                                        <p class=" m-0  icon-clock">
                                            Starting Time:
                                            <?php echo date_format(date_create($dateVoucher), 'h:i A'); ?>
                                        </p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class=" m-0 text-danger">
                                                    <?php
                                                    $timeStampCancel = strtotime($dateVoucher) - 3600 * $hourCancel;
                                                    //date('Y-m-d h:i:s', $timeStampCancel);
                                                    ?>
                                                    Cancel Before <?php echo date('h:i A', $timeStampCancel);?>
                                                    on
                                                    <br>
                                                    <?php echo date('M jS', $timeStampCancel);?>
                                                    by Supplier Cancellation policy
                                                </p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p style="margin-bottom: 0px!important;" class="text-end fa-2x">
                                                    <a href="javascript:deleteItem(<?php echo $counter; ?>);">
                                                        <i class="icon-trash"></i></a>
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        <?php } ?>
                    </div>
                </div>
                <?php
                $calculateCartObject = calculatePriceCart($conn, $allVouchers);
                ?>
                <div class="col-lg-5 col-12">
                    <div class="box_detail">
                        <div id="total_cart">
                            <?php echo $menu[104]; ?> <span class="float-end">
                                    <?php
                                    if ($calculateCartObject['moneyEarned'] != 0) {
                                        ?>
                                        <span style="text-decoration: line-through;color: red">
                                            <?php echo $calculateCartObject['totalPay'] + $calculateCartObject['moneyEarned']; ?>
                                        </span> /
                                        <?php
                                    }
                                    echo $calculateCartObject['totalPay'] . ' €';
                                    ?>
                                </span>
                        </div>
                        <ul class="cart_details">
                            <?php
                            if ($calculateCartObject['moneyEarned'] != 0) {
                                ?>
                            <li class="border-bottom"> Additionally Earned Discount on vouchers
                                <span>
                                    <?php
                                    $extraDiscount = 100 * (
                                            $calculateCartObject['moneyEarned'] /
                                                ($calculateCartObject['totalPay'] + $calculateCartObject['moneyEarned'])
                                        );
                                    echo "$extraDiscount%";
                                    ?>

                                </span>
                            </li>

                                <?php
                            }
                            ?>
                            <li class="border-bottom">  <?php echo $menu[105]; ?>
                                <span><?php echo count($allVouchers); ?></span></li>
                            <li class="border-bottom"> <?php echo $menu[106]; ?>
                                <span><?php echo $calculateCartObject['vouchersPay']; ?></span></li>
                            <li class="border-bottom"> <?php echo $menu[107]; ?>
                                <span><?php echo count($allVouchers) - $calculateCartObject['vouchersPay']; ?></span>
                            </li>
                        </ul>
                        <button id="btnContinue"
                                class="btn btn-warning  my-2 w-100 p-3"> <?php echo $menu[108]; ?> </button>
                        <script>goBackInHistory('btnContinue');</script>
                        <!--                            <input onclick="window.location = './client.php'" type="button"  class="btn btn-secondary btn_1 my-2 full-width purchase" >-->

                        <button class="btn btn-success purchase  w-100 p-2" data-bs-toggle="modal"
                                data-bs-target="#purchasemodal" <?php echo($calculateCartObject['canOrder'] ? '' : 'disabled'); ?>>
                            <?php echo($calculateCartObject['canOrder'] ? $menu[109] : $menu[114]); ?></button>

                        <p class="text-muted py-3">ValuePass vouchers are not cancelled but we are always looking to offer you the
                            best alternative solutions regarding the activity providers we promote if something goes wrong. You will find more information in your
                            confirmation email</p>
                    </div>


                </div>
                <?php
            }
            ?>


        </div>
        <!-- /row -->
    </div>


    <!-- Modal -->
    <div class="modal fade" id="purchasemodal" tabindex="-1"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div style="min-height: 150px;"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center"
                        id="exampleModalLabel"> <?php echo $menu[122]; ?>

                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">

                    <!--                    <h5 class="offertitle">  </h5>-->
                    <h4 class="offermessage"> <?php echo $calculateCartObject['messageModal']; ?></h4>
                    <button id="seeMoreActivities"
                            class="btn btn-info w-100 my-2 p-3 "> <?php echo $menu[121]; ?>  </button>
                    <br>
                    <script>goBackInHistory('seeMoreActivities');</script>
                    <a href="./client.php" class=" btn btn-success my-2 w-100  p-1">  <?php echo $menu[109]; ?>  </a>
                </div>
            </div>
        </div>
    </div>


</main>
<!--/main-->

<?php include_once 'includes/footer.php';
footer($menu, $languages)

?>


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
<script src="changeLanguage.js"></script>
<!--<script>goBackInHistory('noVouchers')</script>-->

</html>