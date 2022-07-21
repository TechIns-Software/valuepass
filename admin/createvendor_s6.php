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

                        <div class="col-lg-4">
                            <label for="location" class="form-label">Διαλέξτε Τύπο</label>
                            <select id="type" class="form-control">
                                <option selected value="1">Δημιουργία για κάθε μέρα ξεχωριστά</option>
                                <option value="2">Δημιουργία για όλη την εβδομάδα</option>
                            </select>
                        </div>

                        <div class="col-12 dissapear" id="option1">
                            <div class="row">
                                <?php
                                /// IMPORTANT  THIS ARRAY MUST BE SAME IN JS !!!!!!!!
                                $weekdays = ['Monday', 'Tuesday', 'Wendsday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                /// IMPORTANT  THIS ARRAY MUST BE SAME IN JS !!!!!!!!  
                                foreach ($weekdays as $weekday) {
                                ?>
                                    <div class=" col-lg-4 col-md-6  my-3 ">
                                        <label for="exampleInputPassword1" class="form-label">
                                            <?php echo  $weekday ?>
                                        </label>

                                        <input type="number" class="form-control numbervoucher" placeholder="Number of Voucher" id="<?php echo $weekday . "_number" ?>">

                                        <div id="<?php echo $weekday . "_res" ?>">

                                        </div>

                                    </div>


                                <?php    } ?>
                                <div class="col-lg-12 col-md-12  my-3">
                                    <div id="geninpt"></div>
                                </div>
                            </div>

                        </div>

                        <div class="col-12 my-3 dissapear" id="option2">
                            <input type="number" id="fixedVoucher" class="form-control" placeholder="Εισαγωγή  Διαθέσιμων Voucher για κάθε μέρα">
                        </div>

                    </div>
                </form>
            </div>
            <button onclick="sendData()" class="btn btn-danger p-2 my-3" id="createbtn6">Επόμενο Στάδιο</button>

        </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

        <script src="js/createvendor6.js"></script>

        <?php
        include_once "footer.php";

        ?>