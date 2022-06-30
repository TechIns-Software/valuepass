<?php
if (!isset($conn)) {
    include '../connection.php';
}

// if (!isset($_SESSION['vendorcreateid']) && $_SESSION['vendorcreatestep'] == 1) {
//     header("createvendor_s1.php");
// } else {
//     $_SESSION['vendorcreatestep']++;
// }


$title = "Δημιουργία Vendor | Step 6";
include_once "header.php";
include 'admin_library.php';


?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">

            <div class="col-12 ">
                <h4>Δημιουργία Vendor </h4>
                <h5> Step : 6</h5>

                <form id="createvendor1" class="form  container-fluid">
                    <div class="row">
                        <?php showDay('day0'); ?>
                        <div class="col-lg-12 col-md-12  my-3">
                            <div id="geninpt"></div>
                        </div>

                    </div>
                </form>
            </div>
            <button class="btn btn-danger p-2 my-3" id="createbtn6">Επόμενο Στάδιο</button>
            <button onclick="getData()" class="btn btn-warning p-2 my-3" id="get">Get data</button>
        </div>

        <script src="js/createvendor6.js"></script>
        <?php

        function showDay($nameDay)
        {
            /// IMPORTANT  THIS ARRAY MUST BE SAME IN JS !!!!!!!!
            $weekdays = ['Monday', 'Tuesday', 'Wendsday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            /// IMPORTANT  THIS ARRAY MUST BE SAME IN JS !!!!!!!!

            foreach ($weekdays as $weekday) {

        ?>

                <div class=" col-lg-4 col-md-6  my-3">
                    <label for="exampleInputPassword1" class="form-label">
                        <?php echo  $weekday ?>
                    </label>

                    <input type="number" class="form-control numbervoucher" placeholder="Number of Voucher" id="<?php echo $weekday . "_number" ?>">

                    <div id="<?php echo $weekday . "_res" ?>">

                    </div>

                </div>
        <?php }
        }






        include_once "footer.php";

        ?>