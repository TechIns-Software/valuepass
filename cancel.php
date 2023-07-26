<?php
if (!isset($conn)) {
    include 'connection.php';
}
$title = "Cancel Voucher";
$home = 0;
include_once 'includes/header.php';
$idLanguage = $_SESSION["languageId"];

getHeader($title, $home, $menu, $languages, $url, $lang_icon, $voucherNumber,$destinations);
?>


<main class=" container-fluid cancelbg ">
    <div style="min-height: 120px;"></div>
    <div class="row ">
        <div class="col-12 text-center">
            <img class="img-fluid" src="assets/img/logo.jpg" width="200" height="200">
        </div>


        <div class="col-12">
            <div class="row">

                <div class="col-lg-6 col-md-12">
                    <img src="assets/img/cancel_photo.jpg" class="img-fluid" >
                </div>


                <div class="col-lg-6 col-md-12 text-center">


                    <h3>You can cancel your voucher here </h3>
                    <h5>Just add below the voucher code</h5>
                    <input type="text" class="form-control" placeholder="Add The Voucher Code">
                    <button class="btn btn-info w-100 my-5" data-bs-toggle="modal" data-bs-target="#exampleModal"> Cancel Voucher</button>
                </div>

            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div style="min-height: 120px;"></div>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voucher Cancellation</h5>

                            <i type="button"  data-bs-dismiss="modal"
                               aria-label="Close" class="fa-solid fa-circle-xmark"></i>
                        </div>
                        <div class="modal-body">
                        <h3>Your voucher has successful cancel. </h3>
                        </div>
                        <div class="modal-footer">

                               <a class="btn btn-primary" href="index.php"> Explore other Experiences </a>
                        </div>
                    </div>
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
<script src="assets/js/main.js?v=1.6"></script>
<script src="changeLanguage.js"></script>

</html>