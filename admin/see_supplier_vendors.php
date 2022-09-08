<?php
if (!isset($conn)) {
    include '../connection.php';
}

$title = "Αντιστοίχιση  Vendor ";
include_once "header.php";
include 'admin_library.php';



if (isset($_GET['id']) &&  $_GET['id']) {
    $supplierid = $_GET['id'];
} else {
    echo "Υπήρξε κάποιο πρόβλημα. Προσπαθήστε αργότερα";
}

     $vendors = getVendorsSupplier($conn,$supplierid,true);
?>


    <div class="content-wrapper">
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-12 loc_title text-center border-bottom">
                    <h4> Προμηθευτής</h4>
                </div>

                <?php
                if ($vendors){
                foreach ($vendors as $vendor){ ?>
                    <div class="col-lg-4 col-md-2 col-sm-12 my-2">
                        <div class="card" style="width: 18rem;">
                            <img src="../assets/img/slider_images/2small.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php  echo  $vendor[2] ?></h5>
                                <p class="card-text"><?php echo $vendor[1] ?></p>
                                <!--                            <a href="#" class="btn btn-primary">Go somewhere</a>-->
                            </div>
                        </div>
                    </div>
                <?php }

                }else { ?>
                    <div class="col-12  text-center ">
                        <h4 class="p-5 my-5 text-muted"> Κανένας Vendor δεν έχει αντιστοιχεί με αυτόν τον Προμηθευτή</h4>
                        <a href="suppliers.php"> <button class="btn btn-info" >  Πήγαινε Πίσω </button> </a>
                    </div>

                <?php   } ?>



            </div>
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