<?php
if (!isset($conn)) {
    include '../connection.php';
}

$title = "Δημιουργία Προμηθευτή";
include_once "header.php";
include 'admin_library.php';

$notAvailableUsernames = GetAllUsernames($conn);

?>

    <script>
        var _notAvailableUsers = JSON.parse('<?php echo  json_encode($notAvailableUsernames); ?>');
    </script>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="loc_title text-center">
                <h4>Δημιουργία Προμηθευτή</h4>
            </div>

            <form id="supplierform" >

                <div class="form-group ">
                    <label for="suppliername">Όνομα Προμηθευτή</label>
                    <input type="text" class="form-control" id="suppliername" name="suppliername">
                </div>
                <div class="form-group">
                    <label for="supplierdescription">Περιγραφή Προμηθευτή </label>
                    <input type="text" class="form-control" id="supplierdescription"  name="supplierdescription">
                </div>

                <div class="form-group">
                    <label for="supplierusername">Username(πάνω απο 4 χαρακτήρες)</label>
                    <input type="email" class="form-control" id="supplierusername" name="supplierusername">
                    <label class="displayNone"   id="messageError">Μη Διαθέσιμο Username</label>
                    <label class="displayNone" id="messageSuccess"> Διαθέσιμο Username</label>
                </div>

                <div class="form-group">
                    <label for="supplierpassword">Passwword (πάνω απο 8 χαρακτήρες)</label>
                    <input type="text" class="form-control" id="supplierpassword" name="supplierpassword">
                    <label class="displayNone"   id="messageError1">Μη Αποδεκτό Password</label>
                    <label class="displayNone" id="messageSuccess1"> Αποδεκτό Password</label>
                </div>

                <h5 class="fw-bolder">* Παρακαλούμε αποθηκεύστε το Username και το Password για μελλοντική χρήση * </h5>


                <button type="submit" class="btn btn-primary" id="submitbtn">Δημιουργία Προμηθευτή</button>
            </form>
        </div>
    </div>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
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

    <script src="..\assets\jquery\jquery3.6.0.min.js"></script>
    <script src="js/supplier_creation.js"></script>

<?php

include_once "footer.php";

?>