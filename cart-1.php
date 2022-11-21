<?php
$greekMonths = array('Ιανουαρίου', 'Φεβρουαρίου', 'Μαρτίου', 'Απριλίου', 'Μαΐου', 'Ιουνίου', 'Ιουλίου', 'Αυγούστου', 'Σεπτεμβρίου', 'Οκτωβρίου', 'Νοεμβρίου', 'Δεκεμβρίου');

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
getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber,$destinations);
?>
<script src="backend/js/cart.js?v=1.4"></script>
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
                    <script>goBackInHistory('noVoucherBack',<?php echo  $_SESSION['lastDestinationId']?>)</script>
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
                        $payVendorAdultArray = $objectVouchersDisplay['payVendorAdult'];
                        $payVendorChildArray = $objectVouchersDisplay['payVendorChild'];
                        $payVendorInfantArray = $objectVouchersDisplay['payVendorInfant'];
                        $priceAdultArray = $objectVouchersDisplay['priceAdultArray'];
                        $priceChildArray = $objectVouchersDisplay['priceChildArray'];
                        $priceInfantArray = $objectVouchersDisplay['priceInfantArray'];
                        $savedArray = $objectVouchersDisplay['saved'];
                        $forHowManyPersonsIsArray = $objectVouchersDisplay['forHowManyPersonsIsArray'];
                        $originalPriceAdultArray = $objectVouchersDisplay['originalPriceAdult'];
                        $originalPriceKidArray = $objectVouchersDisplay['originalPriceKid'];
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
                            $forHowManyPersonsIs = $forHowManyPersonsIsArray[$counter];
                            $originalPriceAdult = $originalPriceAdultArray[$counter];
                            $originalPriceKid = $originalPriceKidArray[$counter];
                            ?>

                            <div class="col-12 cart-voucher  ">
                                <div class="row">
                                    <div class="col-4 ">
                                        <div class="thumb_cart">
                                            <img class="img-fluid"
                                                 src="vendorImages/<?php echo $vendorId[$counter] . '/' . $imageVendor ?>"
                                                 alt="Image">
                                        </div>
                                    </div>

                                    <div class="col-8 ">
                                        <h5 class="py-1">
                                            <span><?php echo $nameVendor; ?></span>
                                        </h5>

                                    </div>

                                    <div class="col-12 py-3  ">
                                        <p class=" m-0   fw-bolder">
                                            <?php echo $_SESSION['languageId'] == 1? 'Tιμή  <span class="vpicon">VP </span> Voucher'
                                                : '<span class="vpicon">VP </span> Vouchers Price'   ?>
                                        </p>
                                        <ul class="border-bottom my-1">
                                            <?php
                                            if ($adults != 0) {
                                                $totalAdultsPrice = $adults * $priceAdult;
                                                if ($forHowManyPersonsIs == 99) {
                                                    echo "<li class='d-flex justify-content-between'>
                                                <div>  Group : $adults X $priceAdult € </div>
                                                  <div><p class='vpicon m-0 '> $totalAdultsPrice  € </p> </div> 
                                                 </li>";
                                                } else if ($forHowManyPersonsIs > 1) {

                                                    echo "<li class='d-flex justify-content-between'>
 <div> Group  $menu[174]  $forHowManyPersonsIs  $menu[175]   : $adults X $priceAdult € </div>
 <div><h5 class='vpicon m-0 '> $totalAdultsPrice  € </h5> </div> 
 </li>";
                                                } else {
                                                    echo "<li class='d-flex justify-content-between'> 
 <div> $menu[68]: $adults X $priceAdult € </div> 
  <div><h5 class='vpicon m-0 '> $totalAdultsPrice  € </h5> </div> 
 </li>";
                                                }

                                            }
                                            if ($children != 0) {
                                                $totalChildrenPrice = $children * $priceChild;
                                                echo "<li class='d-flex justify-content-between' >
<div>  $menu[69]: $children X $priceChild € </div>
  <div><h5 class='vpicon m-0 '> $totalChildrenPrice  € </h5> </div> 
</li>";

                                            }
                                            if ($infants != 0) {
                                                $totalInfantPrice = $infants * $priceInfant;
                                                echo "<li class='d-flex justify-content-between'> 
<div>  $menu[70]: $infants X $priceInfant € </div>
  <div><h5 class='vpicon m-0 '> $totalInfantPrice  € </h5> </div> 
</li>";

                                            }
                                            ?>
                                        </ul>


                                        <p class=" m-0 fw-bolder  ">

                                            <?php echo $menu[49] ?> <span class="laterText">  <?php echo $menu[197] ?>   </span> <?php echo $menu[198] ?>
                                        </p>
                                        <ul>
                                            <?php
                                            if ($adults != 0) {
                                                $payVendorAdultTotal = $adults * $payVendorAdult;
                                                $totalExPrice = $adults * $originalPriceAdult;
                                                if ($forHowManyPersonsIs == 99) {
                                                    echo "<li class='d-flex justify-content-between'>
  <div>  Group : $adults X $payVendorAdult € </div>
  <div><b class=' m-0 '> $totalExPrice / $payVendorAdultTotal  € </b> </div> 
  </li>";
                                                } else if ($forHowManyPersonsIs > 1) {
                                                    echo "<li class='d-flex justify-content-between'>
 <div>  Group  $menu[174]  $forHowManyPersonsIs  $menu[175] : $adults X $payVendorAdult € </div>
  <div><b class=' m-0 '> $totalExPrice / $payVendorAdultTotal  € </b> </div> 
 </li>";
                                                } else {
                                                    echo "<li class='d-flex justify-content-between'>
 <div> $menu[68]: $adults X $payVendorAdult € </div> 
  <div><b class=' m-0 '> $totalExPrice / $payVendorAdultTotal  € </b> </div> 
 </li>";
                                                }

                                            }
                                            if ($children != 0) {
                                                $payVendorChildTotal = $children * $payVendorChild;
                                                $totalExPrice = $children * $originalPriceKid;
                                                echo "<li class='d-flex justify-content-between'>
<div> $menu[69]: $children X $payVendorChild € </div> 
  <div><b class=' m-0 '> $totalExPrice / $payVendorChildTotal  € </b> </div> 
</li>";
                                            }
                                            if ($infants != 0) {
                                                $payVendorInfantTotal = $infants * $payVendorInfant;
                                                echo "<li class='d-flex justify-content-between'>
<div>  $menu[70]: $infants X $payVendorInfant € </div>
  <div><b class=' m-0 '> $payVendorInfantTotal  € </b> </div> 
</li>";
                                            }
                                            ?>

                                        </ul>
<!--                                        <div class='col-12 price '>-->
<!--                                            <h5 class='fw-bolder'>  --><?php //echo $menu[104]; ?><!--    </h5>-->
<!--                                            <h4 class='vpicon'> --><?php //echo $amountPay; ?><!-- € </h4>-->
<!--                                        </div>-->
                                        <div class="col-12 text-success">
                                            <b> <?php echo $menu[201]?></b>
                                        </div>


                                        <p class=" fw-bolder  m-0  d-inline icon-adult">
                                            <?php
                                            $flagTemp = false;
                                            if ($adults != 0) {
                                                $flagTemp = true;

                                                if ($forHowManyPersonsIs == 99) {
                                                    echo "Group : $adults ";
                                                } else if ($forHowManyPersonsIs > 1) {
                                                    echo " Group  $menu[174]  $forHowManyPersonsIs  $menu[175]  : $adults ";
                                                } else {
                                                    echo $menu[110] . ' : ' . $adults;
                                                }
                                            }
                                            if ($children != 0) {
                                                echo ($flagTemp ? ' | ' : '') . $menu[111] . ' : ' . $children;
                                                $flagTemp = true;
                                            }
                                            if ($infants != 0) {
                                                echo ($flagTemp ? ' | ' : '') . $menu[112] . ' : ' . $infants;
                                            }
                                            ?>
                                        </p>
                                        <p class=" fw-bolder m-0  icon-calendar">
                                            <?php
                                            if ($idLanguage == 2) {
                                                echo date_format(date_create($dateVoucher), 'M d, Y');
                                            } else {//fixme greek only
                                                echo date_format(date_create($dateVoucher), 'j ');
                                                echo $greekMonths[intval(date_format(date_create($dateVoucher), 'm')) - 1];
                                                echo date_format(date_create($dateVoucher), ', Y');
//                                                echo date(strtotime(date_create($dateVoucher)), 'M ')
//                                                    .date_format(date_create($dateVoucher), 'd, Y');
                                            }
                                            ?>
                                        </p>
                                        <p class=" fw-bolder m-0  icon-clock">
                                            <?php
                                            if ($idLanguage == 2) {
                                                echo date_format(date_create($dateVoucher), 'h:i A');
                                            } else {//fixme greek only
                                                echo date_format(date_create($dateVoucher), 'h:i ')
                                                    . ((date_format(date_create($dateVoucher), 'A') == 'AM') ? 'π.μ.' : 'μ.μ.');
                                            }
                                            ?>
                                        </p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class=" m-0 text-danger">
                                                    <?php
                                                    $timeStampCancel = strtotime($dateVoucher) - 3600 * $hourCancel;

                                                    echo $menu[138];
                                                    if ($idLanguage == 2) {
                                                        echo date(' h:i A', $timeStampCancel);
                                                    } else {//fixme greek only
                                                        echo date(' h:i ', $timeStampCancel)
                                                            . ((date('A', $timeStampCancel) == 'AM') ? 'π.μ.' : 'μ.μ.');
                                                    }
                                                    ?>
                                                    <br>
                                                    <?php
                                                    if ($idLanguage == 2) {
                                                        echo date('F jS', $timeStampCancel);
                                                    } else {//fixme greek only
                                                        echo date('j ', $timeStampCancel)
                                                            . $greekMonths[intval(date('m', $timeStampCancel)) - 1];
                                                    }
                                                    echo ' '. $menu[139];
                                                    ?>

                                                </p>
                                                <b class="valuepasswin"> <?php echo $menu[144]; ?> <span class="laterText">
                                                        <?php echo $saved ?> € </span> <?php echo $menu[181]; ?>
                                                     <span class="vpicon"> VP</span>  Voucher</b>
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
                    <div class="row">
                        <div class="col-12  d-flex justify-content-between">
                            <div></div>
                            <div class="me-3">
                                <?php
                                $calculateCartObject = calculatePriceCart($conn, $allVouchers);
                                if ($calculateCartObject['moneyEarned'] != 0) {
                                    ?>
                                    <h5 class="my-0" style="text-decoration: line-through;color: black">
                                        <?php
                                        echo $calculateCartObject['totalPay'] + $calculateCartObject['moneyEarned'];
                                        ?>
                                    </h5>
                                    <?php
                                }
                                ?> </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <div class="">
                                <h5 class='fw-bolder me-3'>
                                    <?php echo $_SESSION['languageId'] == 1 ? 'Σύνολο Τιμής <span class="vpicon"> VP </span> Voucher ' :
                                        'Total  <span class="vpicon"> VP </span> Voucher Price' ?> </h5>
                            </div>
                            <div class="text-end">
                                <h4 class='my-0 vpicon'> <?php echo $calculateCartObject['totalPay']; ?> € </h4>
                                <small class="text-success me-3"> <?php echo $menu[202]?></small>
                            </div>

                        </div>
                    </div>
                    <div class="box_detail">

                        <ul class="cart_details">
                            <?php
                            if ($calculateCartObject['moneyEarned'] != 0) {
                                ?>
                                <li class="border-bottom d-flex justify-content-between"> <div>  <?php echo $menu[188]; ?> </div>
                                    <span>
                                    <?php
                                    $extraDiscount = round(100 * (
                                            $calculateCartObject['moneyEarned'] /
                                            ($calculateCartObject['totalPay'] + $calculateCartObject['moneyEarned'])
                                        ), 2);
                                    echo "$extraDiscount%";
                                    ?>

                                </span>
                                </li>

                                <?php
                            }
                            ?>

                            <li class="border-bottom d-flex justify-content-between">  <div>  <?php echo $menu[106]; ?> </div>
                                <span><?php echo $calculateCartObject['vouchersPay']; ?></span></li>
                            <li class="border-bottom d-flex justify-content-between"> <div>  <?php echo $menu[107]; ?> </div>
                                <span><?php echo count($allVouchers) - $calculateCartObject['vouchersPay']; ?></span>
                            </li>
                            <li class="border-bottom d-flex justify-content-between"> <div>  <?php echo $menu[105]; ?> </div>
                                <span><?php echo count($allVouchers); ?></span></li>
                        </ul>
                        <?php ?>
                        <?php if ( !count($cartArray) == 1 && $calculateCartObject['canOrder'] ){  ?>
                            <button id="btnContinue"
                                    class="btn btn-warning  my-2 w-100 p-3"> <?php echo $menu[108]; ?> </button>
                            <script>goBackInHistory('btnContinue',<?php echo  $_SESSION['lastDestinationId']?>);</script>
                        <?php    } ?>

                        <!--                            <input onclick="window.location = './client.php'" type="button"  class="btn btn-secondary btn_1 my-2 full-width purchase" >-->

                        <button class="btn btn-success purchase  w-100 p-2" data-bs-toggle="modal"
                                data-bs-target="#purchasemodal" <?php echo($calculateCartObject['canOrder'] ? '' : 'disabled'); ?>>
                            <?php echo($calculateCartObject['canOrder'] ? $menu[109] : $menu[114]); ?></button>

                        <p class="text-muted py-3"> <?php echo $menu[135] ?> </p>
                    </div>


                </div>
                <?php
            }
            ?>


        </div>
        <!-- /row -->
    </div>


    <?php
    if (count($cartArray) != 0) {
        ?>
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
                    <div class="modal-body ">

                        <!--                    <h5 class="offertitle">  </h5>-->
                        <h4 class="offermessage2"><b> <?php echo $calculateCartObject['messageModal']; ?> </b></h4>
                        <h5 class="offermessage2"> <?php echo $menu[172]; ?></h5>
                        <button id="seeMoreActivities"
                                class=" btn-cshopping2 w-100 my-2 p-3 "> <?php echo $menu[121]; ?>  </button>
                        <br>
                        <script>goBackInHistory('seeMoreActivities',<?php echo  $_SESSION['lastDestinationId']?>);</script>

                        <a href="./client.php" class="  ">
                            <button class="btn btn-cshopping my-2 w-100  p-1">   <?php echo $menu[109]; ?> </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>


</main>
<!--/main-->

<?php include_once 'includes/footer.php';
footer($menu, $languages)

?>


<!-- COMMON SCRIPTS -->
<script src="assets/js/common_scripts.js"></script>
<script src="assets/js/main.js?v=1.6"></script>
<script src="assets/js/validate.js"></script>
</body>
<script src="changeLanguage.js"></script>
<!--<script>goBackInHistory('noVouchers')</script>-->

</html>