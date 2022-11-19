<?php
$greekMonths = array('Ιανουαρίου', 'Φεβρουαρίου', 'Μαρτίου', 'Απριλίου', 'Μαΐου', 'Ιουνίου', 'Ιουλίου', 'Αυγούστου', 'Σεπτεμβρίου', 'Οκτωβρίου', 'Νοεμβρίου', 'Δεκεμβρίου');
if (!isset($conn)) {
    include 'connection.php';
}
$title = "Checkout";
$home = 0;
include_once 'includes/header.php';
$idLanguage = $_SESSION["languageId"];
if ($voucherNumber == 0) {
    header('location: index.php');
}
getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber,$destinations);
?>
<link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

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
    .iti {
        display: block;
    }

</style>
<main class="center-screen container-fluid center-screen">
    <div style="min-height: 120px;"></div>
    <div class="row py-5">
        <div class="col-md-6 ">

            <div class="col-12">
                <form id="clientForm" class="row container" method="post" action="procedure.php">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>  <?php echo $menu[150]; ?></h4>
                        <p> <?php echo $menu[151]; ?></p>

                        <div class="form-floating my-2">
                            <input name="name" id="fullname" class="form-control"
                                   placeholder="<?php echo $menu[152]; ?>" required>
                            <label for="incomePartner"><?php echo $menu[152]; ?></label>
                        </div>
                        <div class="form-floating my-2">
                            <input type="email" name="email" id="email" class="form-control"
                                   placeholder="Email" required>
                            <label for="incomePartner">Email</label>
                        </div>
                        <div class="my-2">
                            <input type="tel" name="phone" id="phone" class="form-control"
                                   placeholder="<?php echo $menu[153]; ?>" required>
                        </div>
                        <p class="text-center">
                             <?php echo $menu[154]; ?>
                        </p>

                        <p class="form-check">
                            •  <?php echo $menu[180]; ?>
                            <a href="<?php echo $idLanguage == 1 ? 'terms_gr.pdf' : 'terms_gb.pdf' ?>"
                               target="_blank">
                                <b>  <?php echo $menu[148] ?> </b>
                            </a>
                            <?php echo $_SESSION["languageId"] == 1 ? ' της Valuepass' : null ?>
                        </p>
                        <div class="form-check">
                            <!--                            <input class="form-check-input" type="checkbox" value="" id="terms">-->
                            <label class="form-check-label" for="terms">
                                • <?php echo $menu[146]; ?>
                                <a href="<?php echo $idLanguage == 1 ? 'terms_gr.pdf' : 'terms_gb.pdf' ?>"
                                   target="_blank">
                                    <b>  <?php echo $menu[148] ?> </b>
                                </a>
                                <?php echo $_SESSION["languageId"] == 1 ? ' της Valuepass' : null ?>
                                <!--                                --><?php //echo $menu[147] ?>
                                <!--                                <a href="#"> <b>-->
                                <?php //echo $menu[149] ?><!--  </b>  </a>-->
                            </label>


                        </div>


                        <div class="form-check ">
                            <label class="form-check-label " for="emailmarketing">
                                •  <?php echo $menu[155]; ?>
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

        <div class="col-md-6  ">

            <div class="row ">
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
                ?>

                <div class="col-12  ">
                    <h3>  <?php echo $menu[182]; ?> </h3>
                </div>

                <div class='col-12 price ps-4  '>
                    <h5 class='fw-bolder'>  <?php echo $menu[104]; ?>  <span class='vpicon'>
                        <?php
                        $calculateCartObject = calculatePriceCart($conn, $allVouchers);
                        if ($calculateCartObject['moneyEarned'] != 0) {
                            ?>
                            <span style="text-decoration: line-through;color: red">
                            <?php
                            echo $calculateCartObject['totalPay'] + $calculateCartObject['moneyEarned'];
                            ?>
                            </span> /
                            <?php
                        }
                        echo $calculateCartObject['totalPay'];
                        ?>
                        €
                    </span>   </h5>

                </div>

            </div>

            <div class="fixedHeightContainer">
            <span class="content">

            <div class="row">
                <?php
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

                                        <!--                                        <h6 class="text-end price ">-->
                                        <!--                                            <strong>-->
                                        <?php //echo $amountPay; ?><!--€</strong>-->
                                        <!--                                        </h6>-->

                                    </div>

                                    <div class="col-12  ">
                                        <p class=" m-0   fw-bolder">
                                              <?php echo $menu[163]; ?>
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
 <div>  Group  $menu[174] $forHowManyPersonsIs  $menu[175] :  $adults X $priceAdult € </div>
 <div><p class='vpicon m-0 '> $totalAdultsPrice  € </p> </div> 
 </li>";
                                                    } else {
                                                        echo "<li  class='d-flex justify-content-between'>
 <div>  $menu[68]: $adults X $priceAdult € </div>
 <div><p class='vpicon m-0 '> $totalAdultsPrice  € </p> </div> 
 </li>";
                                                    }
                                                }
                                                if ($children != 0) {
                                                    $totalChildrenPrice = $children * $priceChild;
                                                    echo "<li class='d-flex justify-content-between'> 
<div>  $menu[69]: $children X $priceChild € </div>
 <div><p class='vpicon m-0 '> $totalChildrenPrice  € </p> </div> 
</li>";
                                                }
                                                if ($infants != 0) {
                                                    $totalInfantPrice = $infants * $priceInfant;
                                                    echo "<li class='d-flex justify-content-between'>
<div>  $menu[70]: $infants X $priceInfant € </div>
<div><p class='vpicon m-0 '> $totalInfantPrice  € </p> </div> 
</li>";

                                                }
                                                ?>
                                            </ul>


                                        <!--                                        <h4 class=" text-end  ">-->
                                        <?php //echo $menu[187];?><!--  <strong>-->
                                        <?php //echo $amountPay; ?><!--€</strong> </h4>-->
                                        <p class=" m-0  fw-bolder  ">
                                        <?php echo $menu[156]; ?>
                                                </p>
                                            <ul class="my-1">
                                            <?php
                                            if ($adults != 0) {
                                                $totalAdultsPriceVendor = $adults * $payVendorAdult;
                                                if ($forHowManyPersonsIs == 99) {
                                                    echo "<li class='d-flex justify-content-between'>
 <div>  Group : $adults X $payVendorAdult € </div>
<div><p class='vpicon m-0 '> $totalAdultsPriceVendor  € </p> </div> 
 </li>";
                                                } else if ($forHowManyPersonsIs > 1) {
                                                    echo "<li  class='d-flex justify-content-between'>
 <div> Group  $menu[174]  $forHowManyPersonsIs  $menu[175] : $adults X $payVendorAdult €  </div>
<div><p class='vpicon m-0 '> $totalAdultsPriceVendor  € </p> </div> 
 </li>";
                                                } else {
                                                    echo "<li class='d-flex justify-content-between'>
 <div> $menu[68]: $adults X $payVendorAdult € </div> 
<div><p class='vpicon m-0 '> $totalAdultsPriceVendor  € </p> </div> 
 </li>";
                                                }
                                            }
                                            if ($children != 0) {
                                                $totalChildrenPriceVendor = $children * $payVendorChild;
                                                echo "<li class='d-flex justify-content-between'>
<div>  $menu[69]: $children X $payVendorChild € </div>
<div><p class='vpicon m-0 '> $totalChildrenPriceVendor  € </p> </div> 
</li>";

                                            }
                                            if ($infants != 0) {
                                                $totalInfantPriceVendor = $infants * $payVendorInfant;
                                                echo "<li class='d-flex justify-content-between'>
<div>  $menu[70]: $infants X $payVendorInfant € </div>
<div><p class='vpicon m-0 '> $totalInfantPriceVendor  € </p> </div> 
</li>";

                                            }
                                            ?>

                                            </ul>

                                            <div class='col-12 price '>
                                            <h5 class='fw-bolder'>  <?php echo $menu[104]; ?>    </h5>
                                            <h4 class='vpicon'> <?php echo $amountPay; ?> € </h4>
                                        </div>


                                        <p class="  m-0  d-inline icon-adult fw-bolder">
                                            <?php
                                            $flagTemp = false;
                                            if ($adults != 0) {
                                                $flagTemp = true;

                                                if ($forHowManyPersonsIs == 99) {
                                                    echo "Group : $adults ";
                                                } else if ($forHowManyPersonsIs > 1) {
                                                    echo " Group  $menu[174]  $forHowManyPersonsIs  $menu[175] : $adults ";
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
                                        <p class="m-0 icon-calendar fw-bolder">
                                            <?php
                                            if ($idLanguage == 2) {
                                                echo date_format(date_create($dateVoucher), 'M d, Y');
                                            } else {//fixme greek only
                                                echo date_format(date_create($dateVoucher), 'j ');
                                                echo $greekMonths[intval(date_format(date_create($dateVoucher), 'm')) - 1];
                                                echo date_format(date_create($dateVoucher), ', Y');
                                            }
                                            ?>
                                        <p class="m-0 icon-clock fw-bolder">
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
                                                    echo $menu[139]; ?>

                                                </p>
                                                <p class="valuepasswin"> <?php echo $menu[144]; ?> <span> <?= $saved ?> € </span> <?php echo $menu[181]; ?>  ValuePass Experiences </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                    </div>

                <?php } ?>
            </div>

                     </span>
            </div>

            <div class="row">
                <div class="col-12">
                    <p class="text-muted py-3"> <?php echo $menu[135] ?> </p>
                </div>
            </div>
        </div>


    </div>
</main>


<?php include_once 'includes/footer.php';
footer($menu, $languages)

?>
</body>

<script>
    const phoneInputField = document.getElementById("phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        preferredCountries: ["gr", "us", "gb", "es", "de", "fr", "it", "br", "cn"],
        utilsScript:
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
    const form = document.getElementById('clientForm');
    form.onsubmit = (e) => {
        e.preventDefault();
        var myInput = document.createElement('input');
        myInput.setAttribute('name', 'phoneCode');
        myInput.setAttribute('value', phoneInput.s.dialCode);
        myInput.setAttribute("type", "hidden");
        form.appendChild(myInput);
        form.submit();
    }
</script>
<script src="assets/js/common_scripts.js"></script>
<script src="assets/js/main.js?v=1.6"></script>


<script src="changeLanguage.js"></script>
<script src="assets/js/start.js?v=1.1"></script>
</html>