<?php
$greekMonths = array('Ιανουαρίου','Φεβρουαρίου','Μαρτίου','Απριλίου','Μαΐου','Ιουνίου','Ιουλίου','Αυγούστου','Σεπτεμβρίου','Οκτωβρίου','Νοεμβρίου','Δεκεμβρίου');
if (!isset($conn)) {
    include 'connection.php';
}
$title = "Checkout";
$home = 0;
include_once 'includes/header.php';
$idLanguage = $_SESSION["languageId"];

getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber);
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
    <div class="row py-5">
        <div class="col-md-6 ">

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

                        <p  class="form-check">
                            <?php echo $menu[180] ;?>
                            <a href="<?php echo $idLanguage == 1 ? 'terms_gr.pdf' : 'terms_gb.pdf' ?>"
                               target="_blank">
                                <b>  <?php echo $menu[148] ?> </b>
                            </a>
                            <?php echo $_SESSION["languageId"] == 1? ' της Valuepass':null ?>
                        </p>
                        <div class="form-check">
<!--                            <input class="form-check-input" type="checkbox" value="" id="terms">-->
                            <label class="form-check-label" for="terms">
                                <?php echo $menu[146] ;?>
                                <a href="<?php echo $idLanguage == 1 ? 'terms_gr.pdf' : 'terms_gb.pdf' ?>"
                                   target="_blank">
                                  <b>  <?php echo $menu[148] ?> </b>
                                </a>
                                <?php echo $_SESSION["languageId"] == 1? ' της Valuepass':null ?>
<!--                                --><?php //echo $menu[147] ?>
<!--                                <a href="#"> <b>--><?php //echo $menu[149] ?><!--  </b>  </a>-->
                            </label>


                        </div>


                        <div class="form-check ">
<!--                            <input name="promotions" class="form-check-input" type="checkbox" checked value=""-->
<!--                                   id="emailmarketing">-->
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

        <div class="col-md-6  ">

            <div class="row ">

                <div class="col-12  " >
                    <h3>  <?php echo $menu[182]; ?> </h3>
                </div>

            </div>

            <div class="fixedHeightContainer">
            <span class="content">
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
                    $forHowManyPersonsIs= $forHowManyPersonsIsArray[$counter];
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

<!--                                        <h6 class="text-end price ">-->
<!--                                            <strong>--><?php //echo $amountPay; ?><!--€</strong>-->
<!--                                        </h6>-->

                                    </div>

                                    <div class="col-12 py-3 ">
                                        <p class=" m-0   icon-users">
                                              <?php echo $menu[163]; ?>
                                            <ul>
                                                <?php
                                                if ($adults != 0) {

                                                    if ($forHowManyPersonsIs == 99){
                                                        echo "<li> Group : $adults X $priceAdult €</li>";
                                                    }else if ($forHowManyPersonsIs >1){
                                                        echo "<li> Group  $menu[174] $forHowManyPersonsIs  $menu[175] :  $adults X $priceAdult €</li>";
                                                    }else{
                                                        echo "<li> $menu[68]: $adults X $priceAdult €</li>";
                                                    }
                                                }
                                                if ($children != 0) {
                                                    echo "<li>$menu[69]: $children X $priceChild €</li>";

                                                }
                                                if ($infants != 0) {
                                                    echo "<li>$menu[70]: $infants X $priceInfant €</li>";

                                                }
                                                ?>
                                            </ul>

                                        </p>
                                        <h4 class=" text-end  "><?php echo $menu[187];?>  <strong><?php echo $amountPay; ?>€</strong> </h4>
                                        <p class=" m-0  icon-money ">
                                        <?php echo $menu[156]; ?>
                                            <ul>
                                            <?php
                                            if ($adults != 0) {


                                                if ($forHowManyPersonsIs == 99){
                                                    echo "<li> Group : $adults X $payVendorAdult €</li>";
                                                }else if ($forHowManyPersonsIs >1){
                                                    echo "<li> Group  $menu[174]  $forHowManyPersonsIs  $menu[175] : $adults X $payVendorAdult €</li>";
                                                }else{
                                                    echo "<li> $menu[68]: $adults X $payVendorAdult €</li>";
                                                }
                                            }
                                            if ($children != 0) {
                                                echo "<li>$menu[69]: $children X $payVendorChild €</li>";

                                            }
                                            if ($infants != 0) {
                                                echo "<li>$menu[70]: $infants X $payVendorInfant €</li>";

                                            }
                                            ?>

                                            </ul>

                                        </p>
                                        <p class="  m-0  d-inline icon-adult">
                                            <?php
                                            $flagTemp = false;
                                            if ($adults != 0) {
                                                $flagTemp = true;

                                            if ($forHowManyPersonsIs == 99){
                                              echo  "Group : $adults ";
                                            }else if ($forHowManyPersonsIs >1){
                                                echo " Group  $menu[174]  $forHowManyPersonsIs  $menu[175] : $adults ";
                                            }else{
                                                echo $menu[110] .' : ' .$adults;
                                            }



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
                                        <p class="m-0 icon-calendar">
                                            <?php
                                            if ($idLanguage == 2) {
                                                echo date_format(date_create($dateVoucher), 'M d, Y');
                                            } else {//fixme greek only
                                                echo date_format(date_create($dateVoucher), 'j ');
                                                echo $greekMonths[intval(date_format(date_create($dateVoucher), 'm')) - 1];
                                                echo date_format(date_create($dateVoucher), ', Y');
                                            }
                                            ?>
                                        <p class="m-0 icon-clock">
                                            <?php
                                            if ($idLanguage == 2) {
                                                echo date_format(date_create($dateVoucher), 'h:i A');
                                            } else {//fixme greek only
                                                echo date_format(date_create($dateVoucher), 'h:i ')
                                                    .((date_format(date_create($dateVoucher), 'A') == 'AM') ? 'π.μ.' : 'μ.μ.');
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
                                                            .((date('A', $timeStampCancel) == 'AM') ? 'π.μ.' : 'μ.μ.');
                                                    }
                                                    ?>
                                                    <br>
                                                    <?php
                                                    if ($idLanguage == 2) {
                                                        echo date('F jS', $timeStampCancel);
                                                    } else {//fixme greek only
                                                        echo date('j ', $timeStampCancel)
                                                        .$greekMonths[intval(date('m', $timeStampCancel))-1];
                                                    }
                                                    echo $menu[139] ;?>

                                                </p>
                                                <p class="valuepasswin"> <?php echo $menu[144] ;?> <span> <?=$saved?> € </span> <?php echo $menu[181] ;?>  ValuePass Experiences </p>
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


<script src="assets/js/common_scripts.js"></script>
<script src="assets/js/main.js"></script>


<script src="changeLanguage.js"></script>
<script src="assets/js/start.js?v=1.1"></script>
</html>