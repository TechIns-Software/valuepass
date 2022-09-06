<?php
if (!isset($conn)) {
    include '../connection.php';
}

$title = "Προμηθευτές";
include_once "header.php";
include 'admin_library.php';


$suppliers = GetAllSuppliers($conn);
?>



    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="loc_title text-center">
                <h4>Όλοι οι διαθέσιμοι Προμηθευτές</h4>
                <hr>
                <h5>Επιλέξτε τον Προμηθευτή <br> και δείτε ποιους vendors ανήκει </h5>
            </div>

            <ul class="list-group d-flex justify-content-between">

                <?php foreach ($suppliers as $supplier) {  ?>
                    <li class="list-group-item"><a href="see_supplier_vendors.php?id=<?php echo $supplier[0] ?>"><?php echo $supplier[2] ?></a> </li>
                <?php }     ?>
            </ul>



        </div>
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



<?php

include_once "footer.php";

?>