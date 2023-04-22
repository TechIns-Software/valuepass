<?php
if (!isset($conn)) {
    include 'connection.php';
}
$title = "FAQS | ValuePass";
$home = 0;
include_once 'includes/header.php';
$idLanguage = $_SESSION["languageId"];
$destinations = getDestinations($conn, $idLanguage);
getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber, $destinations);
?>

<main>
    <div style="min-height: 90px;"></div>
    <div id="how" class="container margin_80_55">

        <div class="row ">
            <div class="main_title_2">
                <h1><b>FAQS ? </b></h1>
                <p><?php echo $menu[74]; ?> </p>
            </div>
        </div>

    </div>
    <section id="questions" class="section pb-5">
        <div class="container">
            <div class="row ps-3">
                <?php
                if ($_SESSION["languageId"] == 1) {
                    ?>

                    <div class="col-12 ">
                        <h4>1.<b> Είναι ασφαλής η πληρωμή μου;</b></h4>
                        <p> Ναι. Πράγματι, το ηλεκτρονικό σύστημα πληρωμών που χρησιμοποιούμε, κρυπτογραφεί τα στοιχεία
                            πληρωμής σας για να σας προστατεύσει από απάτες και μη εξουσιοδοτημένες συναλλαγές. Η
                            ValuePass χρησιμοποιεί διεθνώς αναγνωρισμένα ασφαλή συστήματα πληρωμών για την επεξεργασία
                            των συναλλαγών σας. Θα θέλαμε να σας ενημερώσουμε ότι τα στοιχεία της χρεωστικής/πιστωτικής
                            κάρτας σας διαγράφονται αμέσως μετά το τέλος της διαδικασίας πληρωμής. </p>
                    </div>

                    <div class="col-12 ">
                        <h4>2.<b> Μπορώ να κάνω αλλαγές στην κράτησή μου αφού την πραγματοποιήσω; </b></h4>
                        <p class="my-1">Εάν χρειάζεται να κάνετε αλλαγές, όπως να αφαιρέσετε κάποιον από την κράτησή σας ή
                            να ενημερώσετε τα στοιχεία επικοινωνίας σας, θα χρειαστεί να επικοινωνήσετε με τον πάροχο της
                            δραστηριότητάς. Θα βρείτε τα στοιχεία επικοινωνίας του παρόχου σας στο email επιβεβαίωσης. </p>
                        <p class="my-1">
                            Τα ValuePass Vouchers δεν παρέχουν τη δυνατότητα ακύρωσης ή επιστροφής χρημάτων, ωστόσο πάντα προσπαθούμε
                            να σας προσφέρουμε τις καλύτερες εναλλακτικές λύσεις σύμφωνα με τις δυνατότητες των παρόχων των
                            δραστηριοτήτων που προωθούμε, σε οποιαδήποτε περίπτωση μη πραγματοποίησης της δραστηριότητας από υπαιτιότητα του παρόχου.
                        </p>
                        <p class="my-1">  Υπάρχει δυνατότητα δωρεάν ακύρωσης της κράτησή σας συνήθως έως και 24 ώρες πριν από την ώρα έναρξης της δραστηριότητας, σύμφωνα με την πολιτική ακύρωσης του παρόχου. Θα βρείτε περισσότερες πληροφορίες στο email επιβεβαίωσης.</p>
                    </div>

                    <div class="col-12 ">
                        <h4>3.<b> Μπορώ να κάνω την κράτηση μου τώρα και να πληρώσω αργότερα;</b></h4>
                        <p class="my-1">Η πλατφόρμα της ValuePass σας δίνει την ευκαιρία να αγοράσετε τα Vouchers εν
                            πλω, να κρατήσετε τη θέση σας, και να πληρώσετε τον πάροχο με έκπτωση όταν φτάσετε στην
                            τοποθεσία της δραστηριότητας.</p>
                    </div>

                    <div class="col-12 ">
                        <h4>4.<b> Μπορώ να ακυρώσω το VP Voucher μου;</b></h4>
                        <p class="my-1">Τα ValuePass Vouchers δεν ακυρώνονται και η αξία τους δεν επιστρέφεται.
                            Ωστόσο, σε περίπτωση μη πραγματοποίησης της δραστηριότητας από υπαιτιότητα του παρόχου, σας
                            προσφέρουμε τις καλύτερες εναλλακτικές λύσεις σύμφωνα με τις δυνατότητες των προμηθευτών των
                            δραστηριοτήτων που προωθούμε.
                        </p>
                        <p class="my-1">Σε περίπτωση ακύρωσης δραστηριότητας από υπαιτιότητα του παρόχου, έχει την
                            υποχρέωση να σας προτείνει εναλλακτικές ημερομηνίες για την πραγματοποίησή της.
                            Εάν αυτές δεν σας εξυπηρετούν, η ValuePass είναι στη διάθεση σας με προτάσεις για
                            εναλλακτικές δραστηριότητες.
                        </p>
                        <p class="my-1">Στην περίπτωση, τέλος, που καμία από τις παραπάνω λύσεις δεν είναι εφικτή, η
                            ValuePass σας επιστρέφει την αξία αγοράς του VP Voucher σας!</p>
                    </div>
                    <div class="col-12 ">
                        <h4>5.<b> Πώς λειτουργούν τα δώρα μου;</b></h4>
                        <p class="my-1">Η ValuePass σας επιτρέπει να διαλέγετε τις πιο συναρπαστικές εμπειρίες,
                            προσφέροντας σας περισσότερα δώρα!</p>
                        <p class="my-1">Αγοράστε τουλάχιστον 2 VP Vouchers από την ίδια ή διαφορετικές δραστηριότητες.
                            Με την αγορά τεσσάρων (4) ή περισσοτέρων σας προσφέρουμε δωρεάν vouchers!</p>

                        <h5 class="text-decoration-underline"> Εξασφαλίστε έως και 30% έκπτωση από την αρχική τιμή.</h5>

                        <h6><i class="fa-solid fa-money-bill"></i> Επιλέγοντας 4 VP Vouchers το 1 είναι Δωρεάν </h6>
                        <h6><i class="fa-solid fa-money-bill"></i> Επιλέγοντας 6 VP Vouchers τα 2 είναι Δωρεάν </h6>
                        <h6><i class="fa-solid fa-money-bill"></i> Επιλέγοντας 8 VP Vouchers τα 3 είναι Δωρεάν </h6>
                        <h6><i class="fa-solid fa-money-bill"></i> Επιλέγοντας 10 VP Vouchers τα 4 είναι Δωρεάν </h6>

                        <p> Η προσφορά ισχύει ΜΟΝΟ για τα VP Vouchers και ΟΧΙ για τις δραστηριότητες.</p>

                    </div>

                    <div class="col-12 ">
                        <h4>6.<b> Μπορώ να αγοράσω μόνο 1 VP Voucher;</b></h4>
                        <p class="my-1">Σημαντική προϋπόθεση για να ολοκληρώσετε την πληρωμή σας, είναι να επιλέξετε
                            συνολικά δύο (2) ή περισσότερα Voucher, από την ίδια ή/και διαφορετικές δραστηριότητες.</p>
                        <p class="my-1">Τα Voucher μπορεί να αντιστοιχούν σε γκρουπ είτε να είναι ατομικά. </p>
                        <p class="my-1">Στην περίπτωση που το Voucher αντιστοιχεί σε γκρουπ, δεν είναι απαραίτητο να
                            αγοράσετε παραπάνω από ένα (1) VP Voucher. </p>
                    </div>

                    <div class="col-12 ">
                        <h4>7.<b> Πως επιβεβαιώνω την κράτηση της δραστηριότητας μου;</b></h4>
                        <p class="my-1">Μπορείτε να επιβεβαιώσετε, να ακυρώσετε ή να επαναπρογραμματίσετε τη
                            δραστηριότητά σας, εύκολα μέσω του email σας.</p>
                        <p class="my-1">Θα λάβετε ένα email υπενθύμισης, μετά την κράτηση της δραστηριότητάς σας, έως
                            και 6 ώρες πριν από την προθεσμία ακύρωσης της, σύμφωνα με την πολιτική ακύρωσης που έχει
                            ορίσει ο πάροχος της δραστηριότητας.</p>
                        <p class="my-1"><b> Σε αυτό το email, πρέπει να επιβεβαιώσετε την κράτησή σας για να διατηρήσετε
                                το
                                VP Voucher σας ενεργό. Διαφορετικά, το VP Voucher δεν είναι έγκυρο. </b>
                        </p>
                        <p class="my-1">Επίσης, μπορείτε να ακυρώσετε ή να επαναπρογραμματίσετε τη δραστηριότητάς σας
                            ανάλογα με τη διαθεσιμότητα του παρόχου.</p>
                        <p class="my-1">Μπορείτε να επιβεβαιώσετε ή να ακυρώσετε την κράτηση της δραστηριότητάς σας
                            επιλέγοντας απλώς το check box "Επιβεβαίωση" ή "Ακύρωση", στο email υπενθύμισης.</p>
                    </div>

                    <div class="col-12 ">
                        <h4>8.<b> Γιατί πρέπει να επιδείξω το VP Voucher (QR Code) όταν βρεθώ στη δραστηριότητα που έχω
                                επιλέξει; </b></h4>
                        <p class="my-1">Όταν φτάσετε στον τόπο διεξαγωγής της δραστηριότητας επιδεικνύετε το QR Code που
                            σας εχει αποσταλθεί στο email επιβεβαίωσης. Με τον τρόπο αυτό, γίνεται η επικύρωση της
                            κράτησης σας από τον πάροχο και κερδίζετε την έκπτωση για τη δραστηριότητα σας. </p>

                    </div>

                    <div class="col-12 ">
                        <h4>9.<b> Μπορώ να μεταβιβάσω την κράτηση μου σε άλλο πρόσωπο; </b></h4>
                        <p class="my-1">Το VP Voucher είναι μοναδικό, είναι προσωπικής χρήσης και συγκεκριμένης
                            ημερομηνίας.
                            Για οποιαδήποτε αλλαγή στο όνομα της κράτησης πρέπει να επικοινωνήσετε με τον πάροχο της
                            δραστηριότητας. Διαφορετικά, ο πάροχος της δραστηριότητας έχει το δικαίωμα να μην δεχτεί την
                            κράτηση σας.
                        </p>

                    </div>

                    <?php
                } else if ($_SESSION["languageId"] == 2) {
                    ?>

                    <div class="col-12 ">
                        <h4>1.<b> Is my payment secure?</b></h4>
                        <p>Yes. In fact, the online payment system that we use, encrypts your payment information to
                            protect you against fraud and unauthorized transactions. ValuePass uses internationally
                            recognized secure payment systems to process your transactions. Your payment method will be
                            charged once you book. Using your voucher, you directly pay the price of your booking with a
                            discount at your provider when you arrive at your activity location, securing the exchange
                            of the amount of your reservation. We would like to inform you that your debit/credit card
                            details are immediately deleted at the end of the payment process. </p>
                    </div>

                    <div class="col-12 ">
                        <h4>2.<b> Can I make changes to my booking after I book?</b></h4>
                        <p class="my-1">
                        If you need to make changes such as removing someone from your booking or updating your contact details, you must contact your activity provider.
                        You will find your provider’s contact information in your confirmation email.

                        </p>
                        <p class="my-1">
                        ValuePass Vouchers are non-refundable and cannot be canceled, however,
                        in the event that a problem arises due to the provider’s error, we are continually
                        searching for the best alternatives depending on the accessibility of the activity providers we promote.

                        </p>
                        <p class="my-1">
                        According to the cancellation policy set forth by the supplier of the activity,
                        you can cancel your booking up to 24 hours before the beginning of the activity.
                        You will find more information in your confirmation email.
                        </p>
                    </div>

                    <div class="col-12 ">
                        <h4>3.<b> Can I reserve now and pay later?</b></h4>
                        <p class="my-1">The ValuePass Experiences platform allows you to buy your vouchers on board,
                            reserve your spot, and pay the provider with a discount when you arrive at your activity
                            location.</p>
                    </div>

                    <div class="col-12 ">
                        <h4>4.<b>Can I cancel my VP voucher?</b></h4>
                        <p class="my-1">ValuePass Vouchers are non-refundable and cannot be canceled, however, in the
                            event that a problem arises due to the provider’s error, we are continually searching for
                            the best alternatives depending on the accessibility of the activity providers we promote.
                        </p>
                        <p class="my-1">In case an activity is canceled as a result of the provider's error, the
                            provider is required to suggest alternative dates for its implementation.
                            If none of these appeal to you, ValuePass is available to offer suggestions for alternative
                            activities.
                        </p>
                        <p class="my-1">Finally, ValuePass will refund the value of your voucher if none of the previous
                            alternatives work.</p>
                    </div>
                    <div class="col-12 ">
                        <h4>5.<b> How do my gifts work?</b></h4>
                        <p class="my-1">We offer you more gifts while letting you select the most thrilling
                            experiences!</p>
                        <p class="my-1">Purchase at least two (2) VP Vouchers from the same or separate activities. With
                            four (4) or more, you get free VP Vouchers and your rewards keep coming!</p>

                        <h5 class="text-decoration-underline"> Save up to 30% discount on the initial price</h5>

                        <h6><i class="fa-solid fa-money-bill"></i> Select 4 VP Vouchers and 1 of the 4 is Free </h6>
                        <h6><i class="fa-solid fa-money-bill"></i> Select 6 VP Vouchers and 2 of the 6 are Free </h6>
                        <h6><i class="fa-solid fa-money-bill"></i> Select 8 VP Vouchers and 3 of the 8 are Free </h6>
                        <h6><i class="fa-solid fa-money-bill"></i> Select 10 VP Vouchers and 4 of the 10 are Free </h6>

                        <p> The offer only applies to the VP Vouchers, NOT the activities.</p>

                    </div>

                    <div class="col-12 ">
                        <h4>6.<b> Can I buy one VP voucher?</b></h4>
                        <p class="my-1">To complete your payment, you must choose a total of two (2) or more vouchers,
                            from the same or different activities. </p>
                        <p class="my-1">The vouchers might apply to a person or a group.</p>
                        <p class="my-1">It is not essential to purchase more than one (1) voucher if the voucher covers
                            a group.</p>
                    </div>

                    <div class="col-12 ">
                        <h4>7.<b> How do I confirm my activity booking? </b></h4>
                        <p class="my-1">You can easily confirm, cancel, or reschedule your activity via email.</p>
                        <p class="my-1">You will receive a reminder email, after booking your activity, up to 6 hours
                            before the cancellation deadline, according to the cancellation policy set by the activity
                            provider. </p>
                        <p class="my-1"><b> In this email, you must confirm your booking to keep your voucher active.
                                Otherwise, the VP voucher is invalid. </b>
                        </p>
                        <p class="my-1">Also, you can cancel or reschedule it according to your activity provider’s
                            availability. </p>
                        <p class="my-1">You can confirm or cancel your activity booking by just checking the
                            “Confirmation” or the “Cancellation” check box, in the reminder email. </p>
                    </div>

                    <div class="col-12 ">
                        <h4>8.<b> Why do I have to show my VP Voucher (QR code) when I arrive at the location of my
                                activity?</b></h4>
                        <p class="my-1">You simply show the QR code that was sent to you in your confirmation email when
                            you arrive at the activity location. By doing this, you will receive the activity discount
                            and the supplier will validate the legitimacy of your reservation. </p>

                    </div>

                    <div class="col-12 ">
                        <h4>9.<b> Can I give my reservation to another person? </b></h4>
                        <p class="my-1">The VP Voucher is unique, for date-specific personal usage only. You must get in
                            touch with the activity provider if you need to update the name on the reservation.
                            Otherwise, the organizer of the activity has the right to reject your reservation.
                        </p>

                    </div>


                    <?php
                }
                ?>


            </div>
        </div>

        </div>
    </section>

</main>

<?php include_once 'includes/footer.php';
footer($menu, $languages)
?>


<div id="toTop"></div><!-- Back to top button -->

<!-- COMMON SCRIPTS -->
<script src="assets/js/common_scripts.js"></script>
<script src="assets/js/main.js?v=1.6"></script>
<script src="assets/js/validate.js"></script>

<!-- SLIDER REVOLUTION SCRIPTS  -->
<script src="assets/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
<script src="assets/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.actions.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.migration.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="assets/revolution-slider/js/extensions/revolution.extension.video.min.js"></script>
<script src="assets/js/revapi44.js"></script>

<script>
    var tpj = jQuery;

    var revapi44;
    tpj(document).ready(function () {
        if (tpj("#rev_slider_44").revolution == undefined) {
            revslider_showDoubleJqueryError("#rev_slider_44");
        } else {
            revapi44 = tpj("#rev_slider_44").show().revolution({
                sliderType: "standard",
                jsFileLocation: "assets/revolution-slider/js/",
                sliderLayout: "fullscreen",
                dottedOverlay: "none",
                delay: 4500,
                navigation: {
                    keyboardNavigation: "on",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation: "off",
                    mouseScrollReverse: "default",
                    onHoverStop: "off",
                    touch: {
                        touchenabled: "on",
                        touchOnDesktop: "on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    },
                    arrows: {
                        enable: true,
                        style: 'erinyen',
                        tmp: '',
                        rtl: false,
                        hide_onleave: true,
                        hide_onmobile: true,
                        hide_under: 767,
                        hide_over: 9999,
                        hide_delay: 0,
                        hide_delay_mobile: 0,

                        left: {
                            container: 'slider',
                            h_align: 'left',
                            v_align: 'center',
                            h_offset: 60,
                            v_offset: 0
                        },

                        right: {
                            container: 'slider',
                            h_align: 'right',
                            v_align: 'center',
                            h_offset: 60,
                            v_offset: 0
                        }
                    },
                    bullets: {
                        enable: true,
                        style: 'zeus',
                        direction: 'horizontal',
                        rtl: false,

                        container: 'slider',
                        h_align: 'center',
                        v_align: 'bottom',
                        h_offset: 0,
                        v_offset: 30,
                        space: 7,

                        hide_onleave: false,
                        hide_onmobile: false,
                        hide_under: 0,
                        hide_over: 767,
                        hide_delay: 200,
                        hide_delay_mobile: 1200
                    },
                },
                responsiveLevels: [1240, 1025, 778, 480],
                visibilityLevels: [1920, 1500, 1025, 768],
                gridwidth: [1200, 991, 778, 480],
                gridheight: [1025, 1366, 1025, 868],
                lazyType: "none",
                shadow: 0,
                spinner: "spinner4",
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                shuffle: "off",
                autoHeight: "on",
                fullScreenAutoWidth: "on",
                fullScreenAlignForce: "off",
                fullScreenOffsetContainer: "",
                disableProgressBar: "on",
                hideThumbsOnMobile: "on",
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLimit: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: "off",
                    nextSlideOnWindowFocus: "off",
                    disableFocusListener: false,
                }
            });
        }
    });
</script>


<script src="changeLanguage.js"></script>


</body>

</html>