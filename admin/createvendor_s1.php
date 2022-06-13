<?php
if (!isset($conn)) {
    include '../connection.php';
}

$_SESSION['step'] = 1;

$title = "Δημιουργία Vendor | Step " . $_SESSION['step'];

include_once "header.php";
include 'admin_library.php';

$vendorid = 0;

$destinations = GetAllDestinations($conn);

$categories = GetAllCategories($conn);
$paymentsInfos = GetAllPaymentInfos($conn);
?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">

            <div class="col-12 loc_title">
                <h4>Δημιουργία Vendor </h4>
                <h5> Step : <?php echo $_SESSION['step'];  ?> </h5>
            </div>
            <form id="createvendor1" class="form border container">
                <div class="row">
                    <div class="col-lg-4 col-md-12  my-3">
                        <label for="location" class="form-label"> Choose Location - Island</label>
                        <select name="location" id="location" class="form-control">
                            <?php foreach ($destinations as $destination) {   ?>
                                <option value="<?php echo $destination[1] ?>"><?php echo $destination[0] ?></option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class=" col-lg-4 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Price Adult</label>
                        <input type="number" name="priceAdult" class="form-control" id="priceadult">
                    </div>


                    <div class=" col-lg-4 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Original Price</label>
                        <input type="number" name="originalPrice" class="form-control" id="originalPrice">
                    </div>

                    <div class=" col-lg-4 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Discount </label>
                        <input type="number" name="discount" class="form-control" id="discount">
                    </div>


                    <div class=" col-lg-4 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Price Kid</label>
                        <input type="number" name="priceKid" class="form-control" id="priceKid">
                    </div>


                    <div class=" col-lg-4 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Infant Price</label>
                        <input type="number" name="priceInfant" class="form-control" id="priceInfant">
                    </div>



                    <div class="col-lg-4 col-md-12  my-3">
                        <label for="category" class="form-label"> Choose Category </label>
                        <select name="category" id="category" class="form-control">
                            <?php foreach ($categories as $categorie) {   ?>
                                <option value="<?php echo $categorie[1] ?>"><?php echo $categorie[0] ?></option>

                            <?php } ?>
                        </select>
                    </div>



                    <div class="col-lg-4 col-md-12  my-3">
                        <label for="paymentinfo" class="form-label"> Choose Payment Info Activity </label>
                        <select name="paymentinfo" id="paymentinfo" class="form-control">

                            <?php foreach ($paymentsInfos as $paymentsInfo) {   ?>
                                <option value="<?php echo $paymentsInfo[1] ?>"><?php echo $paymentsInfo[0] ?></option>

                            <?php } ?>
                        </select>
                    </div>

                </div>
                <a class="btn btn-danger p-2 my-3" id="createbtn1" href="createvendor_s2.php?id=<?php echo $vendorid; ?>">Next Step</a>
            </form>

        </div>
    </div>



    <script src="js/createvendor1.js"></script>

    <?php

    include_once "footer.php";

    ?>