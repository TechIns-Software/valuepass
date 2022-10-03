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
if (!isset($idLanguage)) {
    $idLanguage = $_SESSION["languageId"];
}
if (!isset($cartArray)) {
    $cartArray = unserialize($_SESSION['cart']);
}
getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber);
?>
<main>
    <!--    FIXME: height unset makes it the back image(svg file blue only for navbar-->

        <div class="container container-custom margin_80_55">
            <div class="row">
                <?php
                if (count($cartArray) == 0) { ?>
                    <div class="col-lg-12  novoucherincard">
                        <h3 class="my-5">No Vouchers in the card</h3>
                      <h4 id="noVouchers" class="my-5">
                          Go Back and select your Experience
                      </h4>
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

                                        </th>
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
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                                <div class="thumb_cart d-inline">
                                                    <img src="vendorImages/<?php echo $vendorId[$counter].'/'.$imageVendor?>" alt="Image">
                                                </div>
                                            </td>
                                            <td>   <span class="item_cart"><?php echo $nameVendor; ?></span> </td>
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
                                                <a class="btn btn-danger" href="javascript:deleteItem(<?php echo $counter;?>);"><i class="icon-trash"></i></a>
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
                    ?>
                    <aside class="col-lg-4">
                        <div style="min-height: 30px;background-color: transparent"></div>
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
                            <a href="adventure_page.php"><button  class="btn btn-warning  full-width " > Continue Shopping</button> </a>
                            <input onclick="window.location = './client.php'" type="button" value=" <?php echo ($calculateCartObject['canOrder'] ? 'Checkout' : 'Select at least 2 vouchers to continue'); ?>" class="btn btn-secondary btn_1 full-width purchase" <?php echo ($calculateCartObject['canOrder'] ? '' : 'disabled'); ?>>
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

<?php include_once 'includes/footer.php';
footer($menu,$languages)

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
<script src="backend/js/cart.js"></script>
<script>goBackInHistory('noVouchers')</script>

</html>