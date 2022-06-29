<?php
if (!isset($conn)) {
    include '../connection.php';
}



$title = "Δημιουργία Vendor | Step  1" ;

include_once "header.php";
include 'admin_library.php';


$destinations = GetAllDestinations($conn);

$categories = GetAllCategories($conn);
$paymentsInfos = GetAllPaymentInfos($conn);
?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">

            <div class="col-12 loc_title">
                <h4>Δημιουργία Vendor </h4>
                <h5> Step : 1 </h5>
            </div>
            <form id="createvendor1" class="form border container">
                <div class="row">
                    <div class="col-lg-4 col-md-12  my-3">
                        <label for="location" class="form-label">Διαλέξτε Τοποθεσία - Νησί </label>
                        <select name="location" id="location" class="form-control">
                            <?php foreach ($destinations as $destination) {   ?>
                                <option value="<?php echo $destination[1] ?>"><?php echo $destination[0] ?></option>

                            <?php } ?>
                        </select>
                    </div>


                    <div class=" col-lg-4 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Κανονική  Τιμή</label>
                        <input type="number" name="originalPrice" class="form-control" id="originalPrice">
                    </div>

                    <div class=" col-lg-4 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Τιμή  Eνήλικα</label>
                        <input type="number" name="priceAdult" class="form-control" id="priceadult">
                    </div>

                    <div class=" col-lg-4 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Εκπτωση (%) </label>
                        <input type="number" name="discount" class="form-control" id="discount">
                    </div>


                    <div class=" col-lg-4 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Τιμή Παιδίου </label>
                        <input type="number" name="priceKid" class="form-control" id="priceKid">
                    </div>


                    <div class=" col-lg-4 col-md-12  my-3">
                        <label for="exampleInputPassword1" class="form-label">Τιμή μωρού</label>
                        <input type="number" name="priceInfant" class="form-control" id="priceInfant">
                    </div>



                    <div class="col-lg-4 col-md-12  my-3">
                        <label for="category" class="form-label"> Επιλογή Κατηγορίας</label>
                        <select name="category" id="category" class="form-control">
                            <?php foreach ($categories as $categorie) {   ?>
                                <option value="<?php echo $categorie[1] ?>"><?php echo $categorie[0] ?></option>

                            <?php } ?>
                        </select>
                    </div>



                    <div class="col-lg-4 col-md-12  my-3">
                        <label for="paymentinfo" class="form-label"> Επιλογή Πληρωμής   </label>
                        <select name="paymentinfo" id="paymentinfo" class="form-control">

                            <?php foreach ($paymentsInfos as $paymentsInfo) {
                                $show = (($paymentsInfo[0] == 2.1) ? 'Πληρωμή Νωρίτερα': 'Πληρωμή Νωρίτερα - κατά την διάρκεια');
                                echo $paymentsInfo[2];
                                ?>
                                <option value="<?php echo $paymentsInfo[1] ?>"><?php echo $show ?></option>

                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-12  my-3">
                        <label for="numberOfPeoplePerVoucher" class="form-label">Πόσα άτομα αντιστοιχίζεται το Voucher</label>
                        <input type="number" value="1" name="numberOfPeoplePerVoucher" class="form-control" id="numberOfPeoplePerVoucher">
                    </div>
                    <div class="col-sm-9 my-3">
                        <input type="file" class="custom-file-input" id="file">
                        <label class="custom-file-label" for="file">Φωτογραφία</label>
                    </div>
                    <div class="col-sm-3 my-3">
                        <button onclick="addImage(event);" class="form-control">Ανέβασμα</button>
                    </div>

                </div>
                <a class="btn btn-danger p-2 my-3" id="createbtn1" href="createvendor_s2.php">Επόμενο Βήμα</a>
            </form>

        </div>
    </div>



    <script src="js/createvendor1.js"></script>

    <?php

    include_once "footer.php";

    ?>