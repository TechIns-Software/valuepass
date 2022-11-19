
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

                                        <h6 class="text-end price ">
                                            <strong><?php echo $amountPay; ?>€</strong>
                                        </h6>

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
                                                    echo "<li> Group  $menu[174]  $forHowManyPersonsIs  $menu[175]   : $adults X $priceAdult €</li>";
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
                                                    echo " Group  $menu[174]  $forHowManyPersonsIs  $menu[175]  : $adults ";
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
                                                <p class="valuepasswin"> <?php echo $menu[144] ;?> <span> <?=$saved?> € </span> <?php echo $menu[181] ;?>  ValuePass Experiences </p>
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

                        <p class="text-muted py-3"> <?php echo $menu[135] ?> </p>
                    </div>


                </div>
                <?php
            }
            ?>


        </div>
        <!-- /row -->
    </div>

    <div class="content-wrapper">
        <div class="container-fluid">

            <h3>Αγαπητέ πελάτη, </h3>

            <p>Σας ευχαριστούμε που επιλέξατε την πλατφόρμα Valuepass για τις εμπειρίες σας.
                Είμαστε στην ευχάριστη θέση να σας ενημερώσουμε ότι η κράτησή σας επιβεβαιώθηκε!
            </p>

            <p> Η πλατφόρμα ValuePass είναι διαθέσιμη στο πλοίο και σας παρέχει πάντα επιλεγμένες εμπειρίες για να
                κάνετε τη διαμονή σας αξέχαστη!
                Με το παρόν μπορείτε να βρείτε το κωδικο QR, που είναι απαραίτητο να ενεργοποιηθεί για την εμπειρία σας.
            </p>

            <p> Βεβαιωθείτε ότι έχετε έτοιμο τον κωδικό QR (παρακάτω) για γρήγορη σάρωση και έλεγχο κατά την άφιξη.</p>

            ////IMAGE QR CODES


            <div>
                <ul>
                    <li> Αριθμός κράτησης: XXX333SSSS
                        <small> (Σε περίπτωση που δεν μπορείτε να σαρώσετε το QR) </small>
                    </li>
                    <li> Ονομασία εμπειρίας:<b> Sushi & Champagne @ ONO Concept , Σύρος </b></li>
                    <li>
                        Αριθμός voucher: <b> 2 vouchers ValuePass</b>
                    </li>
                    <li> Ημερομηνία & ώρα κράτησης:<b>
                            12:00, Δευτέρα 15 Αυγούστου 2022  </b>
                    </li>
                    <h5>Στοιχεία Προμηθευτή:</h5>
                    <li>Τηλέφωνο: <b>  +30 2284089500  </b></li>
                    <li>Ηλεκτρονική Διεύθυνση: <b>  +30 2284089500  </b></li>
                    <li>Ιστοσελίδα: <b>  +30 2284089500 </b> </li>
                    <li>Υπεύθυνος επικοινωνίας: <b>  +30 2284089500 </b> </li>
                    <li>Τοποθεσία:<b>  Παραλία Αγκαθωπές, Σύρος </b>
                        https://goo.gl/maps/Kg1Tscqqs6dgAT6c9
                    </li>
                </ul>
            </div>

            <div class="informationBox"> Θα θέλαμε να σας ενημερώσουμε ότι θα λάβετε ένα email υπενθύμισης έως και 6 ώρες πριν από την προθεσμία ακύρωσης, σύμφωνα με την πολιτική ακύρωσης που έχει ορίσει ο πάροχος της δραστηριότητας. Σε αυτό το μήνυμα ηλεκτρονικού ταχυδρομείου, θα πρέπει να επιβεβαιώσετε τη δραστηριότητά σας, ή μπορείτε να την ακυρώσετε μέσω του αυτοματοποιημένου συστήματος μας. Επίσης έχετε την επιλογή να την επαναπρογραμματίσετε ανάλογα με τη διαθεσιμότητα του παρόχου δραστηριότητάς σας. Επιπλέον θα σας δοθεί η δυνατότητα επιλογής νέων δραστηριοτήτων</div>


            <div>
                <h4> Λεπτομέρειες Κράτησης:</h4>
                <p> <b>  Πληροφορίες παραλαβής:</b> Εάν έχετε επιλέξει τις υπηρεσίες για τη μεταφορά σας, ενημερώστε τον πάροχο της δραστηριότητάς σας για την τοποθεσία σας.</p>
            </div>
        </div>

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
                    <h4 class="offermessage">  <?php echo $calculateCartObject['messageModal']; ?></h4>
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
<script src="assets/js/main.js?v=1.6"></script>
<script src="assets/js/validate.js"></script>

</body>
<script src="changeLanguage.js"></script>
<!--<script>goBackInHistory('noVouchers')</script>-->

</html>
