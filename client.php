<?php
if (!isset($conn)) {
    include 'connection.php';
}
$title = "Checkout";
$home = 0;
include_once 'includes/header.php';
$idLanguage = $_SESSION["languageId"];

getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber);
//TODO: future maybe client needs to fill up banks field f.e. region
?>

<style>
    .fixedHeightContainer {
        height: 60vh;
        overflow: auto;
    }

    .content {
        overflow-x: hidden;
        overflow-y: auto;
        display: inline-block;
        background: #fff;
    }

    .content div {
        /*width: 95%;*/
    }

    .orderItem div {
        padding: 10px 25px;
    }

</style>
<main class="center-screen container-fluid center-screen">
    <div style="min-height: 120px;"></div>
    <div class="row">
        <div class="col-md-6">

            <div class="col-12">
                <form id="clientForm" class="row" method="post" action="procedure.php">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>  <?php echo $menu[150] ;?></h4>
                        <p> <?php echo $menu[151] ;?></p>

                        <div class="form-floating my-2">
                            <input name="name" id="fullname" class="form-control"
                                   placeholder="<?php echo $menu[152] ;?>" required>
                            <label for="incomePartner"><?php echo $menu[152] ;?></label>
                        </div>
                        <div class="form-floating my-2">
                            <input type="email" name="email" id="email" class="form-control"
                                   placeholder="Email" required>
                            <label for="incomePartner">Email</label>
                        </div>
                        <div class="form-floating my-2">
                            <input type="tel" name="phone" id="phone" class="form-control"
                                   placeholder="<?php echo $menu[153] ;?>" required>
                            <label for="incomePartner"><?php echo $menu[153] ;?></label>
                        </div>
                        <p class="text-center">
                            <?php echo $menu[154] ;?>
                        </p>
                        <div class="form-check">
<!--                            <input class="form-check-input" type="checkbox" value="" id="terms">-->
                            <label class="form-check-label" for="terms">
                                <?php echo $menu[146] ;?>
                                <a href="<?php echo $idLanguage == 1 ? 'terms_gr.pdf' : 'terms_gb.pdf' ?>"
                                   target="_blank">
                                  <b>  <?php echo $menu[148] ?> </b>
                                </a>

                                <?php echo $menu[147] ?>
                                <a href="#"> <b><?php echo $menu[149] ?>  </b> </a>
                            </label>
                        </div>


                        <div class="form-check ">
                            <input name="promotions" class="form-check-input" type="checkbox" checked value=""
                                   id="emailmarketing">
                            <label class="form-check-label " for="emailmarketing">
                                <?php echo $menu[155] ;?>
                            </label>
                        </div>
                        <div class="form-group my-4 text-center">
                            <input style="font-weight: bold;color: white" type="submit" id="continue"
                                   class="btn btn-primary form-control" value="<?php echo $menu[109] ?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6 ">
            <div class="fixedHeightContainer">
 <span class="content">
            <div class="row">

                <div class="col-12">
                  <h3> Order Summary </h3>
                </div>



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
                $payVendorAdultArray = $objectVouchersDisplay['payVendorAdult'];
                $payVendorChildArray = $objectVouchersDisplay['payVendorChild'];
                $payVendorInfantArray = $objectVouchersDisplay['payVendorInfant'];
                $priceAdultArray = $objectVouchersDisplay['priceAdultArray'];
                $priceChildArray = $objectVouchersDisplay['priceChildArray'];
                $priceInfantArray = $objectVouchersDisplay['priceInfantArray'];
                $savedArray = $objectVouchersDisplay['saved'];
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
                    $payVendorAdult = $payVendorAdultArray[$counter];
                    $payVendorChild = $payVendorChildArray[$counter];
                    $payVendorInfant = $payVendorInfantArray[$counter];
                    $priceAdult = $priceAdultArray[$counter];
                    $priceChild = $priceChildArray[$counter];
                    $priceInfant = $priceInfantArray[$counter];
                    $saved = $savedArray[$counter];
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
                                        <p class=" m-0   icon-users">
                                            ValuePass Voucher Price
                                            <ul>
                                                <?php
                                                if ($adults != 0) {
                                                    echo "<li>Adults: $adults X $priceAdult €</li>";
                                                }
                                                if ($children != 0) {
                                                    echo "<li>Children: $children X $priceChild €</li>";

                                                }
                                                if ($infants != 0) {
                                                    echo "<li>Infants: $infants X $priceInfant €</li>";

                                                }
                                                ?>
                                            </ul>

                                        </p>
                                        <p class=" m-0  icon-money ">
                                            Pay to the Provider
                                            <ul>
                                            <?php
                                            if ($adults != 0) {
                                                echo "<li>Adults: $adults X $payVendorAdult €</li>";
                                            }
                                            if ($children != 0) {
                                                echo "<li>Children: $children X $payVendorChild €</li>";

                                            }
                                            if ($infants != 0) {
                                                echo "<li>Infants: $infants X $payVendorInfant €</li>";

                                            }
                                            ?>

                                            </ul>

                                        </p>
                                        <p class="  m-0  d-inline icon-adult">
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

                                            <?php echo date_format(date_create($dateVoucher), 'h:i A'); ?>
                                        </p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class=" m-0 text-danger">
                                                    <?php
                                                    $timeStampCancel = strtotime($dateVoucher) - 3600 * $hourCancel;
                                                    //date('Y-m-d h:i:s', $timeStampCancel);
                                                    ?>
                                                    <?php  echo  $menu[138] ;?> <?php echo date('h:i A', $timeStampCancel);?>

                                                    <br>
                                                    <?php echo date('F jS', $timeStampCancel);?>
                                                    <?php  echo  $menu[139] ;?>

                                                </p>
                                                <p class="valuepasswin"> Saved <span> <?=$saved?> € </span> using  ValuePass Experiences </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                    </div>

                <?php } ?>
            </div>

                     </span>
            </div>
        </div>


    </div>
</main>


<?php include_once 'includes/footer.php';
footer($menu, $languages)

?>
</body>


<script src="assets/js/common_scripts.js"></script>
<script src="assets/js/main.js"></script>


<script src="changeLanguage.js"></script>
<script src="assets/js/start.js?v=1.1"></script>
</html>