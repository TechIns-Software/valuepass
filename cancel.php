<?php
if (!isset($conn)) {
    include 'connection.php';
}
$title = "Cancel Voucher";
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
<main class=" container-fluid cancelbg " >
    <div style="min-height: 150px;"></div>
    <div  class="row ">
        <div class="col-12 text-center">
            <img class="img-fluid" src="assets/img/logo.jpg" width="200" height="200">

        </div>


        <div class="col-12 ">
            <h3>You can cancel your voucher here </h3>
            <h5>Just add below the voucher code</h5>
        </div>

        <div class="col-12 text-center">
        <input type="text" class="form-control" placeholder="Add The Voucher Code">
            <button class="btn btn-info w-100 my-5"> Cancel Voucher </button>
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

</html>